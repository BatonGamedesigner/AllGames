<?php
namespace frontend\models;

use backend\models\UserRole;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\IdentityInterface;
use frontend\models\SignupForm;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const NAME = 'Пользователи сайта';
    const ONE_NAME = 'Пользователь';

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    const REGISTRATION_ACTIVE = 1;

    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    const SCENARIO_ENTITY = 'entity';
    const SCENARIO_USER = 'user';
    public $new_password;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%f_user}}';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' =>   TimestampBehavior::className(),
                /*'attributes'    =>  [
                    ActiveRecord::EVENT_BEFORE_INSERT   =>  ['create_at']
                ],*/
                'value' =>  new Expression('NOW()')
            ]
        ];
    }

    public function scenarios()
    {
        $s = parent::scenarios();

        $s[self::SCENARIO_CREATE] = ['username','new_password','email','role_id'];
        $s[self::SCENARIO_UPDATE] = ['username' ,'new_password','email','role_id'];
        $s[self::SCENARIO_ENTITY] = ['username' ,'new_password','email','role_id'];
        $s[self::SCENARIO_USER] = ['username' ,'new_password','email','role_id'];
        return $s;
    }

    /**
     * @inheritdoc
     */


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter' , 'filter'    =>  'trim'],
            [['username','new_password'],'required', 'on' => self::SCENARIO_CREATE],
            [['username'],'required', 'on' => self::SCENARIO_UPDATE],
            [['email'],'unique'],
            ['email','email'],
            [['username','!password_hash','!password_reset_token' , 'email' , 'new_password'],'string' , 'max' => 255],
            ['!auth_key', 'string', 'max' => 32],
            ['role_id','integer'],
            [['name_company','inn', 'fio_contact_person', 'contact_phone'],
                'string', 'max'=>255],
            [['surname','middlename', 'user_phone'],
                'string', 'max'=>255],
            ['agree', 'integer'],
            [['activate','code_signup'], 'safe'],

        ];
    }

    public function getRole()
    {
        return $this->hasOne(UserRole::className(),['id' => 'role_id']);
    }

    public function beforeSave($insert)
    {
        if($insert)
        {
            $this->generateAuthKey();

        }

        if(strlen($this->new_password))
        {
            $this->setPassword($this->new_password);
        }

        return parent::beforeSave($insert);
    }


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'activate' => self::REGISTRATION_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Имя',
            'new_password' => 'Новый пароль',
            'role_id'   =>  'Роль'

        ];
    }
}
