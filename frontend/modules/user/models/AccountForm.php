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

    private $user;

    public function setUser($user)
    {
        $this->user = $user;
        $this->username = $user->username;
    }

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
                'message' => Yii::t('frontend', 'This username has already been taken.'),
                'filter' => function ($query) {
                    $query->andWhere(['not', ['id' => Yii::$app->user->getId()]]);
                }
            ],
            ['username', 'string', 'min' => 1, 'max' => 255],
            ['password', 'string'],
            [['password_confirm'], 'compare', 'compareAttribute' => 'password'],

        ];
    }

    public function attributeLabels()
    {
        return [
            'username'=>Yii::t('frontend', 'Username'),
            'password'=>Yii::t('frontend', 'Password'),
            'password_confirm'=>Yii::t('frontend', 'Confirm Password')
        ];
    }

    public function save()
    {
        $this->user->username = $this->username;
        if ($this->password) {
            $this->user->setPassword($this->password);
        }
        return $this->user->save();
    }
}
