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
use backend\models\SendBtc;
use backend\models\SendEth;
use common\commands\SendEmailCommand;
use yii\helpers\Url;
use common\helpers\CoinbaseHelper;
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
        $length = 35;
        $bytes = Yii::$app->getSecurity()->generateRandomKey($length);
        return "T".StringHelper::generateRandomString($bytes,$length);
    }
    
    public function actionMe()
    {
        $coin = new CoinbaseHelper();
        $btcAddress = $coin->createAddress();
        var_dump($btcAddress);die;
        $wallet = $this->findModel(Yii::$app->user->identity->id);
        if(!$wallet){
            //Create wallet
            $wallet = new Wallet();
            $wallet->user_id = Yii::$app->user->identity->id;
            $wallet->wallet_btc = $this->createWalletBtc();
            $wallet->wallet_eth = $this->createWalletEth();
            $wallet->save();
        }
        
        if(!$model->wallet_btc){
            // Create wallet btc. Call API
            $wallet->wallet_btc = $this->createWalletBtc();
            $wallet->save();
        }
        
        if(!$wallet->wallet_coin){
            // Create wallet coin
            $wallet->wallet_coin = $this->createWalletCoin();
            $wallet->save();
        }
        
        if(!$model->wallet_eth){
            // Create wallet eth
            $wallet->wallet_eth = $this->createWalletEth();
            $wallet->save();
        }
        
        $wallet_btc =  $wallet->wallet_btc;
        $wallet_eth = $wallet->wallet_eth;
        $wallet_coin = $wallet->wallet_coin;
        
        $searchModel = new WalletSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $sendBtc = new SendBtc();
        $sendEth = new SendEth();
        $sendCoin = new SendForm();
        return $this->render('me', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'wallet_btc' => $wallet_btc,
            'wallet_eth' => $wallet_eth,
            'wallet_coin' => $wallet_coin,
            'wallet' => $wallet,
            'modelBtc' => $sendBtc,
            'modelEth' => $sendEth,
            'modelCoin' => $sendCoin,
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
