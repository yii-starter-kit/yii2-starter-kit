<?php
/**
 * Eugine Terentev <eugine@terentev.net>
 */

namespace console\controllers;

use Yii;
use yii\base\InvalidConfigException;
use yii\console\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\Console;
use yii\helpers\FileHelper;
use yii\helpers\VarDumper;
use yii\i18n\GettextPoFile;

/**
 * Class ExtendedMessageController
 * @package console\controllers
 */
class ExtendedMessageController extends \yii\console\controllers\MessageController
{
    /**
     * @param bool $configFile
     * @param bool $newSourceLanguage
     * @throws Exception
     */
    public function actionReplaceSourceLanguage($configFile, $newSourceLanguage = false)
    {
        $config = [
            'translator' => 'Yii::t',
            'overwrite' => false,
            'removeUnused' => false,
            'sort' => false,
            'format' => 'php',
        ];

        $configFile = Yii::getAlias($configFile);
        if (!is_file($configFile)) {
            throw new Exception("The configuration file does not exist: $configFile");
        }

        $config = array_merge($config, require($configFile));

        if (!is_dir($config['sourcePath'])) {
            throw new Exception("The source path {$config['sourcePath']} is not a valid directory.");
        }

        $files = FileHelper::findFiles(realpath($config['sourcePath']), $config);

        $unremoved = [];
        foreach ($files as $fileName) {
            if (!is_array($config['translator'])) {
                $translator = [$config['translator']];
            }
            foreach ($translator as $currentTranslator) {
                $n = 0;
                $subject = file_get_contents($fileName);
                $replacedSubject = preg_replace_callback(
                    '/\b(\\\\)?' . $currentTranslator . '\s*\(\s*(\'.*?(?<!\\\\)\'|".*?(?<!\\\\)")\s*,\s*(\'.*?(?<!\\\\)\'|".*?(?<!\\\\)")\s*[,\)]/s',
                    function ($matches) use ($newSourceLanguage, $fileName, &$unremoved) {
                        $category = substr($matches[2], 1, -1);
                        $message = $matches[3];

                        if ($newSourceLanguage !== false) {
                            $message = eval("return {$message};");
                            $result = str_replace($message, Yii::t($category, $message, [], $newSourceLanguage), $matches[0]);
                        } else {
                            if (strpos($matches[0], ')') != strlen($matches[0]) - 1) {
                                $unremoved[$fileName][] = $message;
                                $result = $matches[0];
                            } else {
                                $result = $message;
                            }
                        }
                        return $result;

                    },
                    $subject,
                    -1,
                    $n
                );
                if (@file_put_contents($fileName, $replacedSubject) !== false) {
                    Console::output("File: {$fileName}; Translator: {$currentTranslator}; Affected: {$n}");
                } else {
                    Console::error("File: {$fileName}; Translator: {$currentTranslator}; Affected: {$n}");
                };
            }
        }
        if ($newSourceLanguage == false && !empty($unremoved)) {
            Console::output('Messages with params, can`t be removed by this tool. Remove it manually');
            foreach ($unremoved as $fileName => $messages) {
                $messages = implode(PHP_EOL, $messages);
                Console::output("$fileName:" . PHP_EOL . $messages);
            }
        }
    }

    /**
     * @param string $inputConfigFile
     * @param string $outputConfigFile
     * @throws InvalidConfigException
     * @throws \Exception
     */
    public function actionMigrate($inputConfigFile, $outputConfigFile)
    {
        $inputConfigFile = Yii::getAlias($inputConfigFile);
        if (!is_file($inputConfigFile)) {
            throw new \Exception("The configuration file does not exist: $inputConfigFile");
        }

        $inputConfig = array_merge([
            'translator' => 'Yii::t',
            'overwrite' => false,
            'removeUnused' => false,
            'sort' => false,
            'format' => 'php',
        ], require($inputConfigFile));

        switch ($inputConfig['format']) {
            case 'php':
                $messages = $this->readFromPhpInput($inputConfig);
                break;
            case 'db':
                $messages = $this->readFromDbInput($inputConfig);
                break;
            case 'po':
                $messages = $this->readFromPoInput($inputConfig);
                break;
            default:
                throw new InvalidConfigException('Unknown input format ' . $inputConfig['format']);
        }

        if ($this->confirm('All existing messages in the output source will be removed. Proceed?')) {
            $outputConfigFile = Yii::getAlias($outputConfigFile);
            if (!is_file($outputConfigFile)) {
                throw new \Exception("The configuration file does not exist: $outputConfigFile");
            }

            $outputConfig = array_merge([
                'translator' => 'Yii::t',
                'overwrite' => false,
                'removeUnused' => false,
                'sort' => false,
                'format' => 'php',
            ], require($outputConfigFile));

            switch ($outputConfig['format']) {
                case 'php':
                    $this->saveToPhpOutput($messages, $outputConfig);
                    break;
                case 'db':
                    $this->saveToDbOutput($messages, $outputConfig);
                    break;
                case 'po':
                    $this->saveToPoOutput($messages, $outputConfig);
                    break;
                default:
                    throw new InvalidConfigException('Unknown output format');
            }
        };
    }

    /**
     * @param $config
     * @return array
     */
    protected function readFromPhpInput($config)
    {
        $messages = [];
        foreach ($config['languages'] as $language) {
            $messagePath = Yii::getAlias("$config[messagePath]/$language");
            $files = FileHelper::findFiles(FileHelper::normalizePath($messagePath), ['only' => ['*.php']]);
            foreach ($files as $file) {
                $category = pathinfo($file, PATHINFO_FILENAME);
                $messages[$language][$category] = require($file);
            }
        }
        return $messages;
    }

    /**
     * @param $config
     * @return array
     * @throws InvalidConfigException
     * @throws \Exception
     */
    protected function readFromDbInput($config)
    {
        $messages = [];
        $db = Yii::$app->get(isset($config['db']) ? $config['db'] : 'db');
        $sourceMessageTable = isset($config['sourceMessageTable']) ? $config['sourceMessageTable'] : '{{%source_message}}';
        $messageTable = isset($config['messageTable']) ? $config['messageTable'] : '{{%message}}';
        if (!$db instanceof \yii\db\Connection) {
            throw new \Exception('The "db" option must refer to a valid database application component.');
        }
        $q = new \yii\db\Query;

        Console::output('Reading messages from database');
        $sourceMessages = $q->select(['*'])->from($sourceMessageTable)->all();
        foreach ($config['languages'] as $language) {
            $translations = $q->select(['*'])->from($messageTable)->where(['language' => $language])->indexBy('id')->all();
            foreach ($sourceMessages as $row) {
                $translation = ArrayHelper::getValue($translations, $row['id']);
                $messages[$language][$row['category']][$row['message']] = $translation ? $translation['translation'] : null;
            }
        }

        return $messages;

    }

    /**
     * @param $config
     * @return array
     */
    protected function readFromPoInput($config)
    {
        $poFile = new GettextPoFile();
        $pattern = '/(msgctxt\s+"(.*?(?<!\\\\))")?\s+' // context
            . 'msgid\s+((?:".*(?<!\\\\)"\s*)+)\s+' // message ID, i.e. original string
            . 'msgstr\s+((?:".*(?<!\\\\)"\s*)+)/'; // translated string
        $messages = [];
        foreach ($config['languages'] as $language) {
            $filePath = Yii::getAlias("$config[messagePath]/$language/$config[catalog].po");

            $content = file_get_contents($filePath);
            $matches = [];
            $matchCount = preg_match_all($pattern, $content, $matches);

            $messages[$language] = [];
            for ($i = 0; $i < $matchCount; ++$i) {
                $messages[$language][$matches[2][$i]][$this->decode($matches[3][$i])] = $this->decode($matches[4][$i]);
            }
        }
        return $messages;
    }

    /**
     * Decodes special characters in a message.
     * @param string $string message to be decoded
     * @return string the decoded message
     */
    protected function decode($string)
    {
        $string = preg_replace(
            ['/"\s+"/', '/\\\\n/', '/\\\\r/', '/\\\\t/', '/\\\\"/'],
            ['', "\n", "\r", "\t", '"'],
            $string
        );

        return substr(rtrim($string), 1, -1);
    }

    /**
     * @param $messages
     * @param $config
     */
    protected function saveToPhpOutput($messages, $config)
    {
        foreach ($messages as $language => $categories) {
            $dirName = FileHelper::normalizePath(Yii::getAlias($config['messagePath'] . '/' . $language));
            FileHelper::createDirectory($dirName);
            Console::output("Language: $language");
            foreach ($categories as $category => $msgs) {
                $array = VarDumper::export($msgs);
                $content = "<?php\r\nreturn $array;\r\n";
                $fileName = str_replace("\\", '/', "$dirName/$category.php");
                if (file_put_contents($fileName, $content)) {
                    Console::output("Saved $fileName");
                }
            }
        }
    }

    /**
     * @param $messages
     * @param $config
     * @throws InvalidConfigException
     * @throws \Exception
     * @throws \yii\db\Exception
     */
    protected function saveToDbOutput($messages, $config)
    {
        $db = Yii::$app->get(isset($config['db']) ? $config['db'] : 'db');
        $sourceMessageTable = isset($config['sourceMessageTable']) ? $config['sourceMessageTable'] : '{{%source_message}}';
        $messageTable = isset($config['messageTable']) ? $config['messageTable'] : '{{%message}}';
        if (!$db instanceof \yii\db\Connection) {
            throw new \Exception('The "db" option must refer to a valid database application component.');
        }

        $db->createCommand()->truncateTable($messageTable)->execute();
        $db->createCommand()->delete($sourceMessageTable)->execute();

        $insertedSourceMessages = [];
        foreach ($messages as $language => $categories) {
            Console::output("Language: $language");
            foreach ($categories as $category => $msgs) {
                $messagesCount = count($msgs, COUNT_RECURSIVE);
                $i = 0;
                Console::output("Category: $category");
                Console::startProgress(0, $messagesCount);
                foreach ($msgs as $m => $translation) {
                    Console::updateProgress(++$i, $messagesCount);
                    $lastId = array_search($m, ArrayHelper::getValue($insertedSourceMessages, $category, []));
                    if ($lastId == false) {
                        $db->createCommand()
                            ->insert($sourceMessageTable, ['category' => $category, 'message' => $m])->execute();
                        $lastId = $db->getLastInsertID($db->driverName == 'pgsql' ? 'i18n_source_message_id_seq' : null);
                        $insertedSourceMessages[$category][$lastId] = $m;
                    }
                    $db->createCommand()
                        ->insert($messageTable, ['id' => $lastId, 'language' => $language, 'translation' => $translation])->execute();
                }
                Console::endProgress();
            }
        }
    }

    /**
     * @param $messages
     * @param $config
     */
    protected function saveToPoOutput($messages, $config)
    {
        foreach ($messages as $language => $categories) {
            $poFile = new GettextPoFile();
            $merged = [];
            Console::output("Language: $language");
            foreach ($categories as $category => $msgs) {
                ksort($msgs);
                foreach ($msgs as $message => $translation) {
                    $merged[$category . chr(4) . $message] = $translation;
                }
                ksort($merged);
            }
            $poFile->save(
                FileHelper::normalizePath($config['messagePath'] . DIRECTORY_SEPARATOR . $language . DIRECTORY_SEPARATOR . (isset($config['catalog']) ? $config['catalog'] : $this->catalog) . '.po'),
                $merged
            );
        }
    }
}
