<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use yii\helpers\Console;
use common\helpers\CoinbaseHelper;
use common\models\Notification;
/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class NotificationController extends Controller
{
    public function actionIndex()
    {
        // Scan notification
        $coinbase = new CoinbaseHelper();
        $notifications = $coinbase->getNotifications();
        
        // Scan notification not yet + account
        // Change status
        $notis = Notification::find()->inactive()->all();
        foreach ($notis as $noti) {
            
            // Add to transaction Deposit
            
            // Plus money
            
            $noti->status = 1;
            $noti->save();
        }
    }
}
