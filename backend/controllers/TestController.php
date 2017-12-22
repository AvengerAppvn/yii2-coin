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
        $coinbase->getNotifications();
         return $this->render('index', [
            // 'searchModel' => $searchModel,
            // 'dataProvider' => $dataProvider
        ]);
    }
}
