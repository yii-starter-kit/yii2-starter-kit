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

class JsonValidator extends Validator
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if ($this->message === null) {
            $this->message = Yii::t('common', '"{attribute}" must be a valid JSON');
        }
    }
    /**
     * @inheritdoc
     */
    public function validateValue($value)
    {
        if (!@json_decode($value)) {
            return [$this->message, []];
        }
    }

    /**
     * @inheritdoc
     */
    public function clientValidateAttribute($model, $attribute, $view)
    {
        /*$message = Yii::$app->getI18n()->format($this->message, [
            'attribute' => $model->getAttributeLabel($attribute)
        ], Yii::$app->language);
        return <<<"JS"
            try {
                JSON.parse(value);
            } catch (e) {
                messages.push('{$message}')
            }
JS;*/
    }
}
