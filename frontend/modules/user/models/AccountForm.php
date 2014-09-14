<?php
namespace frontend\modules\user\models;

use yii\base\Model;
use Yii;

/**
 * Account form
 */
class AccountForm extends Model
{
    public $username;
    public $password;
    public $password_confirm;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass'=>'\common\models\User', 'message' => \Yii::t('frontend', 'This username has already been taken.')],
            ['username', 'string', 'min' => 1, 'max' => 255],

            [['password_confirm'], 'compare', 'compareAttribute' => 'password'],

        ];
    }
}
