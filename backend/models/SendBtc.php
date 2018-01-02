<?php
namespace backend\models;

use cheatsheet\Time;
use common\commands\SendEmailCommand;
use common\models\User;
use common\models\Withdraw;
use common\models\Wallet;
use common\models\UserToken;
use backend\modules\user\Module;
use yii\base\Exception;
use yii\base\Model;
use Yii;
use yii\helpers\Url;

/**
 * SendBtc form
 */
class SendBtc extends Model
{
    /**
     * @var
     */
    public $address;
    
    /**
     * @var
     */
    public $amount;
    
    /**
     * @var
     */
    public $password;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['address', 'amount','password'], 'required'],
            ['address', 'string'],
            ['password', 'validatePassword'],
            ['amount', 'validateAmount'],
        ];
    }
    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'address'=>Yii::t('backend', 'Address '),
            'email'=>Yii::t('backend', 'E-mail'),
            'password'=>Yii::t('backend', 'Password'),
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     */
    public function validatePassword()
    {
        if (!$this->hasErrors()) {
            $user = Yii::$app->user->identity;
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError('password', Yii::t('backend', 'Incorrect password.'));
            }
        }
    }
    
    /**
     * Validates the amount.
     * This method serves as the inline validation for amount, it must bigger than bonus amount.
     */
    public function validateAmount()
    {
        if (!$this->hasErrors()) {
            $user = Yii::$app->user->identity;
            // Find amount bonus in wallet
            $wallet = Wallet::find()->where(['user_id'=>$user->id])->limit(1)->one();
            if (!$user || !$wallet || $this->amount > $wallet->bonus_btc) {
                $this->addError('amount', Yii::t('backend', 'Please enter the amount valid.'));
            }
        }
    }
    
    /**
     * Send coin to the address.
     * @return bool whether the user is sent in successfully
     * @throws ForbiddenHttpException
     */
    public function send()
    {
        if (!$this->validate()) {
            return false;
        }
        
        if(true){
            // TODO save to transaction of User
            $user = Yii::$app->user->identity;
            $withdraw = new Withdraw();
            $withdraw->user_id = $user->id;
            
            $wallet = Wallet::find()->where(['user_id'=>$user->id])->one();
            if($wallet){
                $withdraw->receiver = $this->address;
                $withdraw->amount = $this->amount;
                $withdraw->type = 1; // BTC
                $withdraw->sender = $wallet->wallet_btc;
                
                if($wallet->bonus_btc >= $this->amount){
                    $withdraw->save();    
                    
                    $wallet->bonus_btc -= $this->amount;
                    $wallet->save();
                    return true;
                }
            }

        }
        return false;
    }
}
