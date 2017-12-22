<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Da\TwoFA\Manager;
use Da\TwoFA\Service\TOTPSecretKeyUriGeneratorService;
use Da\TwoFA\Service\GoogleQrCodeUrlGeneratorService;
use common\models\User;
use backend\models\SecurityForm;
/**
 * SecurityController implements the CRUD actions for Security model.
 */
class SecurityController extends Controller
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
    
    public function actionIndex()
    {
        $user = Yii::$app->user->identity;
        
        if ($user->twofa_secret) {
            $secret = Yii::$app->user->identity->twofa_secret;
        } else {
             $secret = ( new Manager())->generateSecretKey();
             $model = User::findOne(Yii::$app->user->identity->id);
             $model->twofa_secret = $secret;
             $model->save();
        }
       
        // first we need to create our time-based one time password secret uri
        $totpUri = (new TOTPSecretKeyUriGeneratorService('Tickcoin', 'tickcoin@gmail.com', $secret))->run();
        
        $googleUri = (new GoogleQrCodeUrlGeneratorService($totpUri))->run();
        $model = new SecurityForm();
        $model->has2fa = $user->has2fa;
        if ($model->load(Yii::$app->request->post())) {
            //var_dump($user->twofa_secret);die;
            
            $manager = new Manager();
            $valid = $manager
                        //->setCycles(2) // 120 seconds (60 seconds past and future respectively) 
                        ->verify($model->one_time_password, $user->twofa_secret);
            if($valid){
                $user->has2fa = $model->has2fa;
                if($user->save()){
                    return $this->redirect(['index']);
                }
            }else{
                Yii::$app->session->setFlash('alert', [
                'options'=>['class'=>'alert-error'],
                'body'=>Yii::t('backend', 'The 2FA Code typed was wrong.')
            ]);
            }
        }
        return $this->render('index', [ 
            'model' => $model,
            'code' => $googleUri,
            'secret' => $secret
        ]);
    }

    
}
