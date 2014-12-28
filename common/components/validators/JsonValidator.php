<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/10/14
 * Time: 9:57 AM
 */

namespace common\components\validators;

use yii\validators\Validator;
use Yii;

class JsonValidator extends Validator{

    public function init(){
        parent::init();
        if(!$this->message){
            $this->message = Yii::t('common', '{attribute} must be a valid JSON');
        }
    }
    /**
     * @inheritdoc
     */
    public function validateValue($value)
    {
        if(!@json_decode($value)){
            return [$this->message, []];
        }
    }

    public function clientValidateAttribute($model, $attribute, $view)
    {
        return null;
    }


}