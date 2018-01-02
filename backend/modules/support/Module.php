<?php

namespace app\modules\support;

use app\modules\support\models\User;
use Yii;

/**
 * ticket module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\support\controllers';

    public $mailSend = false;

    public $subjectAnswer = 'The answer to the site ticket';

    /** @var  User */
    public $userModel = false;

    public $qq = [
        'Support' => 'Support',
        'Other' => 'Other',
    ];

    public $admin = ['admin'];
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        User::$user = ($this->userModel !== false) ? $this->userModel : Yii::$app->user->identityClass;
        parent::init();
    }
}
