<?php

namespace frontend\modules\user\models;

use cheatsheet\Time;
use common\commands\SendEmailCommand;
use common\models\User;
use common\models\UserToken;
use Yii;
use yii\base\InvalidArgumentException;
use yii\base\Model;
use yii\helpers\Url;

/**
 * Password reset form
 */
class ResendEmailForm extends Model
{
    /**
     * @var user email
     */
    public $email;

    /**
     * Creates a form model given a token.
     *
     * @param  string $token
     * @param  array $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidArgumentException if token is empty or not valid
     */
    public function __construct($config = [])
    {
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\common\models\User',
                'filter' => ['status' => User::STATUS_NOT_ACTIVE],
                'message' => 'There is no user expecting activation with such email.'
            ],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'email' => Yii::t('frontend', 'E-mail')
        ];
    }

    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_NOT_ACTIVE,
            'email' => $this->email,
        ]);

        if ($user) {
            $token = UserToken::create($user->id, UserToken::TYPE_ACTIVATION, Time::SECONDS_IN_A_DAY);
            Yii::$app->commandBus->handle(new SendEmailCommand([
                'subject' => Yii::t('frontend', 'Activation email'),
                'view' => 'activation',
                'to' => $this->email,
                'params' => [
                    'url' => Url::to(['/user/sign-in/activation', 'token' => $token->token], true)
                ]
            ]));

            return true;
        }

        return false;
    }
}
