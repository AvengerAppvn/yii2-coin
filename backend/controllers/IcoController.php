<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\BuyForm;
use common\commands\SendEmailCommand;
use cheatsheet\Time;
use common\models\UserToken;
/**
 * IcoController
 */
class IcoController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
            ]
        ];
    }

    /**
     * 
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new BuyForm();
        $ref_url = Yii::$app->getHomeUrl().'/register?referrer='.Yii::$app->user->identity->username;
        return $this->render('index', [
            'ref_url' => $ref_url,
            'model' => $model
        ]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    
    public function actionAmount($amount_coin = 0, $type = 'BTC')
    {
        
        if($type == 'BTC'){
            $rate = Yii::$app->keyStorage->get('coin.rate-btc', '1');
        }else{
            $rate = Yii::$app->keyStorage->get('coin.rate-eth', '2');
        }
        echo number_format($amount_coin * $rate,8);
    }
    
        
    public function actionToken()
    {
        $user = Yii::$app->user->identity;
        //$token = Yii::$app->getSecurity()->generateRandomKey(6);
         $token = UserToken::createBuy(
             $user->id,
             UserToken::TYPE_BUY,
             Time::SECONDS_IN_A_DAY
         );
        
        // Save Token to User
        Yii::$app->commandBus->handle(new SendEmailCommand([
            'subject' => Yii::t('backend', 'Token'),
            'view' => 'activation',
            'from' => 'smartkids210@gmail.com',
            'to' => 'lex4vn@gmail.com',
            'params' => [
                'token' => $token,
            ]
        ]));
        return 1;
    }
}
