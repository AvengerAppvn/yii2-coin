<?php

namespace backend\controllers;
use Yii;
use yii\web\Controller;
use common\helpers\CoinbaseHelper;
class NotificationController extends Controller
{

    public function actionIndex()
    {
        
        Yii::error('Nhan notification '.time());
        $raw_body = file_get_contents('php://input');
        Yii::error($raw_body);
        $signature = $_SERVER['HTTP_CB_SIGNATURE'];
        $coinbase = new CoinbaseHelper();
        if($coinbase->authenticity($raw_body,$signature)){
            Yii::error('Xac thuc duoc '.time());    
        }else{
            Yii::error('ERROR xac thuc '.time());    
        }
        return 1;
    }
}
