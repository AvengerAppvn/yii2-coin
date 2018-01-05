<?php
namespace app\modules\landing\models;

use himiklab\yii2\recaptcha\ReCaptchaValidator;
use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LandingForm extends Model
{
    public $reCaptcha;

    private $user = false;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // verifyCode needs to be entered correctly
            ['reCaptcha', ReCaptchaValidator::className(), 'secret' => env('CAPTCHA_SERVERVERIFY')],
        ];
    }

    public function attributeLabels()
    {
        return [
            'reCaptcha' => '',
        ];
    }


    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function next()
    {
        if ($this->validate()) {
            return true;
        }
        return false;
    }
}
