<?php
namespace frontend\models;


use common\helpers\EmailHelper;
use frontend\models\User;
use yii\base\Model;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;

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
                'targetClass' => '\frontend\models\User',
//                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'Нет пользователья с такой почтой.'
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
//            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if ($user) {
            if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
                $user->generatePasswordResetToken();
            }

            if ($user->save()) {
                return EmailHelper::send(['passwordResetToken-html',compact('user')],'Заявка на сброс пароля для сайта ' . \Yii::$app->params['siteName'],null,$this->email);
            }
        }

        return false;
    }
}
