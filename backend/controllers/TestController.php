<?php

namespace backend\controllers;

use Yii;
use common\models\Article;
use backend\models\search\ArticleSearch;
use \common\models\ArticleCategory;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\commands\AddToTreeTeamCommand;
use common\helpers\CoinbaseHelper;
/**
 * ArticleController implements the CRUD actions for Article model.
 */
class TestController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post']
                ]
            ]
        ];
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $coinbase = new CoinbaseHelper();
        //$coinbase->getOrders();
       // $coinbase->getTransactions();
        $notifications = $coinbase->getNotifications();
        Notification::find()->where([''])->all();
        // TODO
		foreach($notifications as $notification){
// 			$deposit = new Deposit();
// 				$deposit->sender = ;
// 				$deposit->receiver = ;
// 				$deposit->user_id = ;
// 				$deposit->amount = ;
// 				$deposit->type = ;
// 				$deposit->status = 0;
// 			$deposit->save();
		}
//		        return [
//            'id' => 'ID',
//            'user_id' => 'User ID',
//            'sender' => 'Address',
//            'receiver' => 'Receiver',
//            'amount' => 'Amount',
//            'type' => 'Type',
//            'status' => 'Status',
//            'created_at' => 'Created At',
//            'updated_at' => 'Updated At',
//        ];
         return $this->render('index', [
            // 'searchModel' => $searchModel,
            // 'dataProvider' => $dataProvider
        ]);
    }
}
