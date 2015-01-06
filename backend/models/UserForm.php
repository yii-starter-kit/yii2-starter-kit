<?php
namespace backend\models;

use common\models\User;
use common\models\UserProfile;
use yii\base\Model;
use Yii;

/**
 * Create user form
 */
class UserForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $status;
    public $role;

    private $_model;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass'=>'\common\models\User', 'filter'=>function($query){
                if(!$this->getModel()->isNewRecord){
                    $query->andWhere(['not', ['id'=>$this->getModel()->id]]);
                }
            }],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass'=> '\common\models\User', 'filter'=>function($query){
                if(!$this->getModel()->isNewRecord){
                    $query->andWhere(['not', ['id'=>$this->getModel()->id]]);
                }
            }],

            ['password', 'required', 'on'=>'create'],
            ['password', 'string', 'min' => 6],

            [['status'], 'boolean'],
            [['role'], 'in', 'range'=>array_keys(User::getRoles())],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('backend', 'Username'),
            'email' => Yii::t('backend', 'Email'),
            'password' => Yii::t('backend', 'Password'),
            'role' => Yii::t('backend', 'Role')
        ];
    }

    public function setModel($model)
    {
        $this->username = $model->username;
        $this->email = $model->email;
        $this->status = $model->status;
        $this->role = $model->role;
        $this->_model = $model;
        return $this->_model;
    }

    public function getModel()
    {
        if(!$this->_model){
            $this->_model = new User();
        }
        return $this->_model;
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function save()
    {
        if ($this->validate()) {
            $model = $this->getModel();
            $model->username = $this->username;
            $model->email = $this->email;
            $model->status = $this->status;
            $model->role = $this->role;
            if($this->password){
                $model->setPassword($this->password);
            }
            if($model->getIsNewRecord()){
                $model->generateAuthKey();
            }
            if($model->save() && $model->getIsNewRecord()){
                $model->afterSignup();
            }
            return !$model->hasErrors();
        }
        return null;
    }
}
