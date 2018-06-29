<?php
namespace frontend\models;

use frontend\models\User;
use yii\base\Model;
use backend\models\UserRole;
use common\helpers\EmailHelper;



/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $surname;
    public $middlename;
    public $userPhone;
    public $email;
    public $password;
    public $status;
    public $confirmPassword;
    public $nameCompany;
    public $inn;
    public $fioChief;
    public $fioContactPerson;
    public $contactPhone;
    public $reCaptcha;
    public $iAgree;

    const SCENARIO_USER = 'user';
    const SCENARIO_ENTITY = 'entity';

    const NAME = 'Регистрация';


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //['username', 'filter', 'filter' => 'trim', 'on'=>self::SCENARIO_USER],
            //['username', 'required'],
           // ['username', 'unique', 'targetClass' => '\frontend\models\User', 'message' => 'This username has already been taken.'],
           // ['username', 'string', 'min' => 2, 'max' => 255],

            [['nameCompany', 'fioChief', 'fioContactPerson', 'contactPhone'], 'string', 'max' => 255],
            ['inn', 'string', 'min' => 10, 'max'=>10],

            [['nameCompany', 'inn','fioContactPerson', 'contactPhone'], 'required', 'on'=>self::SCENARIO_ENTITY],


            [['username','surname','middlename', 'userPhone'], 'string', 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\frontend\models\User', 'message' => 'Этот email адрес уже зарегистрирован'],

            ['iAgree','integer'],
            ['iAgree','required','requiredValue' => 1, 'message' => 'Вам необходимо дать согласие на обработку и хранение персональных данных для создания личного кабинета'],
            [['password','confirmPassword'], 'required'],
            [['password','confirmPassword'], 'string', 'min' => 6],
            ['confirmPassword', 'compare', 'compareAttribute' => 'password'],

            ['status', 'integer'],

            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' => '6LcztB0UAAAAAKOOIxuuIVIloVt1sr8b_iQUSvg7', 'uncheckedMessage' => 'Пожалуйста подтвердите что Вы не робот']


        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_USER] = ['password','confirmPassword', 'email', 'iAgree'];
        $scenarios[self::SCENARIO_ENTITY] = ['password','confirmPassword', 'email','nameCompany','inn','fioChief',
            'fioContactPerson','contactPhone', 'iAgree', 'reCaptcha'];
        return $scenarios;

    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if($this->status == UserRole::STATUS_ENTITY){
            $this->scenario = self::SCENARIO_ENTITY;
        }
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->agree = $this->iAgree;
            $user->code_signup = self::struuid();
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if($this->scenario == self::SCENARIO_ENTITY){ //для юр. лица
                $user->scenario = User::SCENARIO_ENTITY;

                $user->role_id = UserRole::STATUS_ENTITY;
                $user->name_company = $this->nameCompany;
                $user->inn = $this->inn;
                $user->fio_chief = $this->fioChief;
                $user->fio_contact_person = $this->fioContactPerson;
                $user->contact_phone = $this->contactPhone;
            }else{
                $user->role_id = UserRole::STATUS_USER;
                $user->surname = $this->surname;
                $user->middlename = $this->middlename;
                $user->user_phone = $this->userPhone;
            }

            if ($user->save()) {
                EmailHelper::send(['signup.php',['model' => $user]],'Подтверждение регистрации ' . \Yii::$app->params['siteName']);
                return $user;
            }else{
                return $user->errors;
            }
        }

        return null;
    }

    public function attributeLabels()
    {
        return [
            'username'  =>  'Имя',
            'password' => 'Пароль',
            'confirmPassword' => 'Подтвердите пароль',
            'nameCompany' => 'Наименование организации',
            'inn' => 'Инн',
            'fioChief' => 'ФИО руководителя',
            'fioContactPerson' => 'ФИО контактного лица',
            'contactPhone' => 'Контактный телефон',
            'reCaptcha' => 'reCaptcha',
            'status' => 'Выберите регистрацию',
            'surname' => 'Фамилия',
            'middlename' => 'Отчество',
            'userPhone' => 'Контактный телефон',
            'iAgree' => 'Я даю свое согласие на обработку и хранение персональных данных.',
        ];
    }

    public static function struuid($entropy=true)
    {
        $s = uniqid("", $entropy);
        $num = hexdec(str_replace(".", "", (string) $s));
        $index = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $base = strlen($index);
        $out = '';
        for ($t = floor(log10($num) / log10($base)); $t >= 0; $t--)
        {
            $a = floor($num / pow($base, $t));
            $out = $out.substr($index, $a, 1);
            $num = $num - ($a * pow($base, $t));
        }
        return $out;
    }
}
