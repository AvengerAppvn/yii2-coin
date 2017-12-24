<?php
namespace backend\models;

use cheatsheet\Time;
use common\commands\SendEmailCommand;
use borales\extensions\phoneInput\PhoneInputValidator;
use common\models\User;
use common\models\UserToken;
use backend\modules\user\Module;
use yii\base\Exception;
use yii\base\Model;
use Yii;
use yii\helpers\Url;
use himiklab\yii2\recaptcha\ReCaptchaValidator;
/**
 * Signup form
 */
class SignupForm extends Model
{
    /**
     * @var
     */
    public $username;
    /**
     * @var
     */
    public $email;
    /**
     * @var
     */
    public $password;
    
    /**
     * @var
     */
    public $referrer;
    
    /**
     * @var
     */
    public $phone;    
    public $reCaptcha;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            
            [['username','email','phone'], 'required'],
            
            ['username', 'unique',
                'targetClass'=>'\common\models\User',
                'message' => Yii::t('backend', 'This username has already been taken.')
            ],
            
            ['phone', 'unique',
                'targetClass'=>'\common\models\User',
                'message' => Yii::t('backend', 'This phone has already been used.')
            ],
            
            // [['phone'], PhoneInputValidator::className(),
                // 'message' => Yii::t('backend', 'This phone has not valid.')],
                
            [['username','email'], 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            
            ['email', 'email'],
            
            ['email', 'unique',
                'targetClass'=> '\common\models\User',
                'message' => Yii::t('backend', 'This email address has already been taken.')
            ],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            
            //don't use scenarios() here. Use 'on' instead 
            ['password_repeat', 'required', 'on' => 'update'],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match", 'on' => 'update' ],    
            ['reCaptcha', ReCaptchaValidator::className(), 'secret' => env('CAPTCHA_SERVERVERIFY')],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'username'=>Yii::t('backend', 'Username'),
            'email'=>Yii::t('backend', 'E-mail'),
            'password'=>Yii::t('backend', 'Password'),
            'reCaptcha' => '',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->phone = $this->phone;
            $user->referrer = $this->referrer;
            $user->status = User::STATUS_NOT_ACTIVE;
            $user->setPassword($this->password);
            if(!$user->save()) {
                throw new Exception("User couldn't be  created.");
            };
            
            $user->afterSignup();
        
            $token = UserToken::create(
                $user->id,
                UserToken::TYPE_ACTIVATION,
                Time::SECONDS_IN_A_DAY
            );
            
            Yii::$app->commandBus->handle(new SendEmailCommand([
                'subject' => Yii::t('backend', 'Activation email'),
                'view' => 'activation',
                'to' => $this->email,
                'params' => [
                    'name' => $user->username,
                    'logo'=> Url::to('@backendUrl/img/coin_logo.png'),
                    'url' => Url::to(['/account/activation', 'token' => $token->token], true)
                ]
            ]));
        
            return $user;
        }

        return null;
    }

    /**
     * @return bool
     */
    public function shouldBeActivated()
    {
        /** @var Module $userModule */
        $userModule = Yii::$app->getModule('user');
        if (!$userModule) {
            return false;
        } elseif ($userModule->shouldBeActivated) {
            return true;
        } else {
            return false;
        }
    }
}
