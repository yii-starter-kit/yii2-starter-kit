<?php
namespace common\helpers;

use yii\helpers\BaseStringHelper;
/**
 * StringHelper
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @author Alex Makarov <sam@rmcreative.ru>
 * @since 2.0
 */
class StringHelper extends BaseStringHelper
{
	
	public static function  Excerpt($string, $lines, $suffix, $wordsPerLine=80, $encoding = false)
	{
		return static::truncateHtml($string, $lines, $suffix, $wordsPerLine, $encoding);
	}
	
	protected static function truncateHtml($string, $count, $suffix, $wordsPerLine, $encoding)
	{
		$config = \HTMLPurifier_Config::create(null);
		$config->set('Cache.SerializerPath', \Yii::$app->getRuntimePath());
		$lexer = \HTMLPurifier_Lexer::create($config);
		$tokens = $lexer->tokenizeHTML($string, $config, null);
		$openTokens = 0;
		$totalCount = 0;
		$truncated = [];
		foreach ($tokens as $token) {
			if ($token instanceof \HTMLPurifier_Token_Start) { //Tag begins
				$openTokens++;
				$truncated[] = $token;
			} elseif ($token instanceof \HTMLPurifier_Token_Text && $totalCount <= $count) { //Text
				if (false === $encoding) {
					$token->data = self::truncateWords($token->data, ($count - $totalCount)*$wordsPerLine, '');
					$currentWords = str_word_count($token->data);
				} else {
					$token->data = self::truncate($token->data, ($count - $totalCount)*$wordsPerLine, '', $encoding) . ' ';
					$currentWords = mb_strlen($token->data, $encoding);
				}
				//$totalCount += $currentWords;
				if(!$token->is_whitespace)
					$totalCount += intval(ceil($currentWords/$wordsPerLine));//turn into lines
				if (1 === $currentWords) {
					$token->data = ' ' . $token->data;
				}
				$truncated[] = $token;
			} elseif ($token instanceof \HTMLPurifier_Token_End) { //Tag ends
				$openTokens--;
				$truncated[] = $token;
			} elseif ($token instanceof \HTMLPurifier_Token_Empty) { //Self contained tags, i.e. <img/> etc.
				if($token->name=='img')
				{
					//filter img tag
				}
				else
					$truncated[] = $token;
			}
			if (0 === $openTokens && $totalCount >= $count) {
				break;
			}
		}
		$context = new \HTMLPurifier_Context();
		$generator = new \HTMLPurifier_Generator($config, $context);
		return $generator->generateFromTokens($truncated) . $suffix;
	}
	
}