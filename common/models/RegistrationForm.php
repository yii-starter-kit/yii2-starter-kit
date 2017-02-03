<?php
/**
 * Created by PhpStorm.
 * User: gogl92
 * Date: 3/02/17
 * Time: 12:59 AM
 */

namespace common\models;

use dektrium\user\models\Profile;
use dektrium\user\models\RegistrationForm as BaseRegistrationForm;
use common\models\User;

class RegistrationForm extends BaseRegistrationForm
{
    /**
     * Add a new field
     * @var string
     */
    public $name;
    public $profilePicture;
    public $gender;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        //$rules[] = ['name', 'required'];
        $rules[] = ['picture', 'string', 'max' => 250];
        $rules[] = ['gender', 'boolean'];
        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        //TODO add labels for new files
        $labels['name'] = \Yii::t('user', 'Name');
        return $labels;
    }

    /**
     * @inheritdoc
     */
    public function loadAttributes(User $user)
    {
        // here is the magic happens
        $user->setAttributes([
            'email' => $this->email,
            'username' => $this->username,
            'password' => $this->password,
        ]);
        /** @var Profile $profile */
        $profile = \Yii::createObject(Profile::className());
        $profile->setAttributes([
            'name' => $this->name,
        ]);
        $user->setProfile($profile);
    }
}