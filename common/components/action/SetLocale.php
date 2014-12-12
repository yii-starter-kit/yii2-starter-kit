<?php
/**
 * Author: Eugine Terentev <eugine@terentev.net>
 */

namespace common\components\action;

use yii\base\Action;
use yii\base\InvalidParamException;
use Yii;

/**
 * Class SetLocale
 * @package common\components\action
 *
 * Example:
 *
 *   public function actions()
 *   {
 *       return [
 *           'set-locale'=>[
 *               'class'=>'common\components\actions\SetLocale',
 *               'locales'=>[
 *                   'en-US', 'ru-RU', 'ua-UA'
 *               ],
 *               'localeSessionKey'=>'user.locale',
 *               'callback'=>function($action){
 *                   return $this->controller->redirect(/.. some url ../)
 *               }
 *           ]
 *       ];
 *   }
*/

class SetLocale extends Action
{
    public $locales;
    public $localeSessionKey = 'user.locale';
    public $callback;



    public function run($locale)
    {
        if(is_array($this->locales) && !in_array($locale, $this->locales)){
            throw new InvalidParamException('Unacceptable locale');
        }
        Yii::$app->session->set($this->localeSessionKey, $locale);
        if($this->callback && $this->callback instanceof \Closure){
            return call_user_func_array($this->callback, [
                $this,
                $locale
            ]);
        }
        return Yii::$app->response->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
    }
}