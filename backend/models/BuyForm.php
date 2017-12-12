<?php
namespace backend\models;

use cheatsheet\Time;
use common\commands\SendEmailCommand;
use common\models\User;
use common\models\UserToken;
use backend\modules\user\Module;
use yii\base\Exception;
use yii\base\Model;
use Yii;
use yii\helpers\Url;

/**
 * BuyForm form
 */
class BuyForm extends Model
{
    /**
     * @var
     */
    public $type;
    
    /**
     * @var
     */
    public $amount_coin;
    
    /**
     * @var
     */
    public $token;
    
    /**
     * @var
     */
    public $address;
    
    /**
     * @var
     */
    public $amount;
    
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['address', 'amount','amount_coin','token','type'], 'required'],
            [['address','token','type'], 'string'],
            [['amount','amount_coin'], 'number'],
        ];
    }
    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'address'=>Yii::t('backend', 'Address'),
            'amount_coin'=>Yii::t('backend', 'Amount of TKC'),
            'amount'=>Yii::t('backend', 'Amount'),
            'token'=>Yii::t('backend', 'Token'),
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
            $shouldBeActivated = $this->shouldBeActivated();
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->status = $shouldBeActivated ? User::STATUS_NOT_ACTIVE : User::STATUS_ACTIVE;
            $user->setPassword($this->password);
            if(!$user->save()) {
                throw new Exception("User couldn't be  saved");
            };
            $user->afterSignup();
            if ($shouldBeActivated) {
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
                        'url' => Url::to(['/account/activation', 'token' => $token->token], true)
                    ]
                ]));
            }
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
