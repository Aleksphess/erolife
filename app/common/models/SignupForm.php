<?php
namespace common\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $subscription;
    public $city = '';
    public $phone = '';
	public $check = '';


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            //['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            [['email', 'username', 'password', 'city', 'phone'], 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот email/username уже используется'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {

        if (!$this->validate()) {
            return null;
        }


        $user               = new User();
        $user->username     = $this->username;
        $user->email        = $this->email;
        $user->subscription = $this->subscription;
        $user->phone        = $this->phone;

        $user->setPassword($this->password);
        $user->generateAuthKey();
       // var_dump($user);die();
        return $user->save() ? $user : null;
    }
}