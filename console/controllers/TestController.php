<?php

namespace console\controllers;

use common\models\Deposit;
use common\models\Wallet;
use Yii;
use yii\console\Controller;


class TestController extends Controller
{
    public function actionIndex()
    {
        Yii::error('Test.....');
        
        $deposit = new Deposit();
        $deposit->user_id = 2;
        $deposit->sender = '112312312GsEbcfBiQSmdfgfdgJv';
        $deposit->receiver = '19AiUnEx5UXeGsEbcfBiQSm772TJjddbJv';
        $deposit->amount = 2;
        $deposit->type = 1;
        $deposit->save();
        
        // Find wallet
        $wallet = Wallet::find()->where(['user_id'=>2])->limit(1)->one();
        if($deposit->type == 1){
            $wallet->amount_btc += $deposit->amount;
            $wallet->save();
        }
        if($deposit->type == 2){
            $wallet->amount_eth += $deposit->amount;  
            $wallet->save();
        }
        
    }
}
