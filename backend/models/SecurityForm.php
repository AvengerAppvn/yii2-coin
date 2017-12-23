<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use Da\TwoFA\Manager;
/**
 * Login form
 */
class SecurityForm extends Model
{
    public $has2fa;
    public $one_time_password;
    public $twofa_ex_create_order;
    public $twofa_ex_cancel_order;
    public $twofa_lending;
    public $twofa_withdraw;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['one_time_password', 'required'],
            // has2fa must be a boolean value
            [['has2fa','twofa_ex_create_order','twofa_ex_cancel_order','twofa_lending','twofa_withdraw'], 'boolean'],
            ['one_time_password', 'string'],
            ['one_time_password', 'number',
                'message' => Yii::t('backend', 'The 2FA Code must be 6 digits.'),
            ],
            ['one_time_password', 'string', 
                'length' => 6,
                'message' => Yii::t('backend', 'The 2FA Code must be 6 digits.')],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'has2fa' => Yii::t('backend', 'Enable Two-Factor'),
            'twofa_ex_create_order' => Yii::t('backend', 'Exchange: Create Order'),
            'twofa_ex_cancel_order' => Yii::t('backend', 'Exchange: Cancel Order'),
            'twofa_lending' => Yii::t('backend', 'Lending'),
            'twofa_withdraw' => Yii::t('backend', 'Withdraw'),
            'one_time_password' => Yii::t('backend', 'Enter 2FA Code'),
        ];
    }
    
    public function authen(){
        $user = Yii::$app->user->identity;
        $manager = new Manager();
        $valid = $manager
            //->setCycles(2) // 120 seconds (60 seconds past and future respectively) 
            ->verify($this->one_time_password, $user->twofa_secret);
            
        if($valid){
            $user->authen_2fa = true;
        }else{
            $user->authen_2fa = false;
        }
        return $valid;
    }
}
