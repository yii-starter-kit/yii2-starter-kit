<?php
namespace backend\models;

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
            ['username', 'unique',
                'targetClass'=>'\common\models\User',
                'message' => Yii::t('backend', 'This username has already been taken.'),
                'filter' => function ($query) {
                    $query->andWhere(['not', ['id'=>Yii::$app->user->id]]);
                }
            ],
            ['username', 'string', 'min' => 1, 'max' => 255],
            ['password', 'string'],
            [['password_confirm'], 'compare', 'compareAttribute' => 'password']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('backend', 'Username'),
            'password' => Yii::t('backend', 'Password'),
            'password_confirm' => Yii::t('backend', 'Password Confirm')
        ];
    }
}
