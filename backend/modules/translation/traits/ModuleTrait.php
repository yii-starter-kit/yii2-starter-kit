<?php

namespace backend\modules\translation\traits;


use Yii;

trait ModuleTrait
{

    /**
     * @return array
     */
    public function getLanguages()
    {
        $languages = [];
        foreach (Yii::$app->params['availableLocales'] as $locale => $name) {
            if ($locale !== Yii::$app->sourceLanguage)
                $languages[substr($locale, 0, 2)] = $name;
        }

        return $languages;
    }

}