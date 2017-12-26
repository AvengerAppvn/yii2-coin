<?php

namespace app\modules\ticket;

use app\modules\ticket\models\User;
use Yii;

/**
 * ticket module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\ticket\controllers';

    public $mailSend = false;

    public $subjectAnswer = 'The answer to the site ticket';

    /** @var  User */
    public $userModel = false;

    public $qq = [
        'Exchange Question' => 'Exchange Question',
        'Replenishment of the LC' => 'Replenishment of the LC',
        'Deposit of funds' => 'Deposit of funds',
        'Withdrawing funds' => 'Withdrawing funds',
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
