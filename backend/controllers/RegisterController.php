<?php

namespace backend\controllers;

use backend\models\LoginForm;
use backend\models\AccountForm;
use backend\models\SignupForm;
use Intervention\Image\ImageManagerStatic;
use trntv\filekit\actions\DeleteAction;
use trntv\filekit\actions\UploadAction;
use Yii;
use yii\filters\VerbFilter;
use yii\imagine\Image;
use yii\web\Controller;
use common\models\User;
use common\models\Wallet;
use common\commands\AddToTreeTeamCommand;
class RegisterController extends Controller
{
    //public $defaultAction = 'index';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post']
                ]
            ]
        ];
    }

    /**
     * @return string|Response
     */
    public function actionIndex()
    {
        $this->layout = 'base';
        $username = Yii::$app->request->get('referrer');
        $referrer = '';
        if($username){
            // Check referrer
            $user = User::find()->where(['username'=> $username])->limit(1)->one();
            if($user){
                $wallet = Wallet::find()->where(['user_id'=>$user->id])->limit(1)->one();
                if($wallet && $wallet->amount_coin){
                    $referrer = $user->id;    
                }
            }
        }
        
        $model = new SignupForm();
        if($referrer){
            $model->referrer = $referrer;
        }else{

            if(Yii::$app->keyStorage->get('user.register_accept_no_referrer')){
                $model->referrer = Yii::$app->keyStorage->get('coin.defaultRefferer', '2');
            }else{
                Yii::$app->getSession()->setFlash('alert', [
                    'body' => Yii::t(
                        'frontend',
                        Yii::$app->keyStorage->get('user.register_accept_no_referrer_message','You must register with a referral link')
                    ),
                    'options' => ['class' => 'alert-error']
                ]);

                return $this->render('index', [
                    'model' => $model
                ]);
            }

        }
        if ($model->load(Yii::$app->request->post())) {
            $user = $model->signup();
            if ($user) {
                Yii::$app->commandBus->handle(new AddToTreeTeamCommand([
                    'user_id' => $model->referrer,
                    'related_id' => $user->id,
                ]));
                Yii::$app->getSession()->setFlash('alert', [
                    'body' => Yii::t(
                        'frontend',
                        'Your account has been successfully created. Check your email for further instructions.'
                    ),
                    'options' => ['class' => 'alert-success']
                ]);
                // Successfull
                //return $this->redirect(['account/verify']);
                return $this->render('verify', [
                    'model' => $user
                ]);
            }
        }

        return $this->render('index', [
            'model' => $model
        ]);
    }
}
