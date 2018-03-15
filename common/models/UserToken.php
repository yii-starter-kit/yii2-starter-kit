<?php

namespace common\models;

use common\models\query\UserTokenQuery;
use Yii;
use yii\base\InvalidCallException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%user_token}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $type
 * @property string $token
 * @property integer $expire_at
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 */
class UserToken extends ActiveRecord
{
    public const TYPE_ACTIVATION = 'activation';
    public const TYPE_PASSWORD_RESET = 'password_reset';
    public const TYPE_LOGIN_PASS = 'login_pass';
    protected const TOKEN_LENGTH = 40;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_token}}';
    }

    /**
     * @return UserTokenQuery
     */
    public static function find()
    {
        return new UserTokenQuery(get_called_class());
    }

    /**
     * @param mixed $user_id
     * @param string $type
     * @param int|null $duration
     * @return bool|UserToken
     * @throws \yii\base\Exception
     */
    public static function create($user_id, $type, $duration = null)
    {
        $model = new self;
        $model->setAttributes([
            'user_id' => $user_id,
            'type' => $type,
            'token' => Yii::$app->security->generateRandomString(self::TOKEN_LENGTH),
            'expire_at' => $duration ? time() + $duration : null
        ]);

        if (!$model->save()) {
            throw new InvalidCallException;
        };

        return $model;

    }

    /**
     * @param $token
     * @param $type
     * @return bool|User
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public static function use($token, $type)
    {
        $model = self::find()
            ->where(['token' => $token])
            ->andWhere(['type' => $type])
            ->andWhere(['>', 'expire_at', time()])
            ->one();

        if ($model === null) {
            return null;
        }

        $user = $model->user;
        $model->delete();

        return $user;
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'type', 'token'], 'required'],
            [['user_id', 'expire_at'], 'integer'],
            [['type'], 'string', 'max' => 255],
            [['token'], 'string', 'max' => self::TOKEN_LENGTH]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'user_id' => Yii::t('common', 'User ID'),
            'type' => Yii::t('common', 'Type'),
            'token' => Yii::t('common', 'Token'),
            'expire_at' => Yii::t('common', 'Expire At'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @param int|null $duration
     */
    public function renew($duration)
    {
        $this->updateAttributes([
            'expire_at' => $duration ? time() + $duration : null
        ]);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->token;
    }
}
