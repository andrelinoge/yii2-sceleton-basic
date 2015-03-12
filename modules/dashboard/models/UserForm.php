<?php

namespace app\modules\dashboard\models;

use Yii;
use yii\base\Model;
use app\models\User;
use yii\web\NotFoundHttpException;


class UserForm extends Model
{
    public $name;
    public $email;
    public $password;

    protected $user;

    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            ['name', 'string', 'min' => 3, 'max' => 255],

            ['email', 'email'],
            ['email', 'customUniquess'],

            ['password', 'safe'],
            ['password', 'string', 'min' => 4, 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    public function customUniquess($attribute, $params)
    {
        $query = User::find();
        $query->where(['email' => $this->email]);

        if ($this->user)
        {
            $query->andWhere([' != ', 'id', $this->user->id]);
        }

        if ($query->exists()) 
        {
            $this->addError($attribute, "{$this->email} already used");
        }
    }

    public function fetchUser($id)
    {
        $user = User::findOne($id);
        if (!$user)
        {
            throw new NotFoundHttpException("User with id '$id' not found");
        }

        $this->name  = $user->name;
        $this->email = $user->email;

        $this->user = $user;
    }

    public function create()
    {
        if ($this->validate()) 
        {
            $attributes = $this->getAttributes();
            unset($attributes['password']);

            $model = new User;
            $model->setAttributes($attributes);
            $model->setPassword($this->password);

            $model->is_email_confirmed = true;
            $model->save();

            $this->user = $model;

            return true;
        } 
        else 
        {
            return false;
        }
    }
    
    public function update()
    {
        if ($this->validate()) 
        {
            $attributes = $this->getAttributes();
            unset($attributes['password']);
            
            $this->user->setAttributes($attributes);
            $this->user->setPassword($this->password);

            $this->user->save();

            return true;
        } 
        else 
        {
            return false;
        }
    }

    public function getId()
    {
        return $this->user ? $this->user->id : '#';
    }
}
