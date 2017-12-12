<?php

namespace backend\controllers;

use Yii;
use common\models\Wallet;
use common\models\search\WalletSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helpers\StringHelper;
use backend\models\SendForm;
use common\commands\SendEmailCommand;
use yii\helpers\Url;
/**
 * WalletController implements the CRUD actions for Wallet model.
 */
class WalletController extends Controller
{
    public $defaultAction = 'me';
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
    
    private function createWalletBtc(){
          // Create wallet btc. Call API
        return 'alskjflaksjdlfasd';
    }
    
    private function createWalletEth(){
          // Create wallet eth. Call API
        return 'alskjflaksjdlfasd';
    }
    
    private function createWalletCoin(){
        $bytes = Yii::$app->getSecurity()->generateRandomKey($length);
        return "T".StringHelper::generateRandomString($bytes,$length);
    }
    
    public function actionMe()
    {
        $model = $this->findModel(Yii::$app->user->identity->id);
        if(!$model){
            //Create wallet
            $model = new Wallet();
            $model->user_id = Yii::$app->user->identity->id;
            $model->wallet_btc = $this->createWalletBtc();
            $model->wallet_eth = $this->createWalletEth();
            $model->save();
        }
        
        if(!$model->wallet_btc){
            // Create wallet btc. Call API
            $model->wallet_btc = $this->createWalletBtc();
            $model->save();
        }
        
        if(!$model->wallet_coin){
            // Create wallet coin
            $model->wallet_coin = $this->createWalletCoin();
            $model->save();
        }
        
        if(!$model->wallet_eth){
            // Create wallet eth
            $model->wallet_eth = $this->createWalletEth();
            $model->save();
        }
        
        $wallet_btc =  $model->wallet_btc;
        $wallet_eth = $model->wallet_eth;
        $wallet_coin = $model->wallet_coin;
        
        $searchModel = new WalletSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $sendModel = new SendForm();
        return $this->render('me', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'wallet_btc' => $wallet_btc,
            'wallet_eth' => $wallet_eth,
            'wallet_coin' => $wallet_coin,
            'model' => $sendModel,
        ]);
    }
    
    /**
     * Lists all Wallet models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WalletSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Wallet model.
     * @param integer $user_id
     * @return mixed
     */
    public function actionView($user_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($user_id),
        ]);
    }

    /**
     * Creates a new Wallet model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        Yii::$app->commandBus->handle(new SendEmailCommand([
            'subject' => Yii::t('backend', 'Activation email'),
            'view' => 'activation',
            'from' => 'smartkids210@gmail.com',
            'to' => 'lex4vn@gmail.com',
            'params' => [
                'url' => Url::to(['/account/activation', 'token' => $token->token], true)
            ]
        ]));
    }

    /**
     * Updates an existing Wallet model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $user_id
     * @return mixed
     */
    public function actionUpdate($user_id)
    {
        $model = $this->findModel($user_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Wallet model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $user_id
     * @return mixed
     */
    public function actionDelete($user_id)
    {
        $this->findModel($user_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Wallet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $user_id
     * @return Wallet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($user_id)
    {
        if (($model = Wallet::findOne($user_id)) !== null) {
            return $model;
        } else {
            return null;
        }
    }
}
