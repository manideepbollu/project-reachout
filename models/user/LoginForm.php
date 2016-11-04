<?php

namespace app\models\user;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;

    public $user;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute)
    {
        if ($this->hasErrors())
            return;

        $user = $this->getUser($this->email);

        if (!($user and $this->isCorrectHash($this->$attribute,
                $user->password)))
            $this->addError('password', 'Incorrect username or password.');
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    private function getUser($email)
    {
        if (!$this->user)
            $this->user = $this->fetchUser($email);
        return $this->user;
    }

    private function fetchUser($email)
    {
        return User::findOne(['email' => $email]);
    }

    private function isCorrectHash($plaintext, $hash)
    {
        return Yii::$app->security->validatePassword($plaintext, $hash);
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if (!$this->validate())
            return false;
        $user = $this->getUser($this->email);

        if (!$user)
            return false;
        return Yii::$app->user->login(
            $user,
            $this->rememberMe ? 3600 * 24 * 30 : 0
        );
    }

}
