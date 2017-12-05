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

    /**
     * Security
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->identity->twofa_secret) {
            $secret = Yii::$app->user->identity->twofa_secret;
        } else {
             $secret = (new Manager())->generateSecretKey();
             $model = User::findOne(Yii::$app->user->identity->id);
             $model->twofa_secret = $secret;
             $model->save();
        }
       
        // first we need to create our time-based one time password secret uri
        $totpUri = (new TOTPSecretKeyUriGeneratorService('Tickcoin', 'tickcoin@gmail.com', $secret))->run();
        
        $googleUri = (new GoogleQrCodeUrlGeneratorService($totpUri))->run();
        
        return $this->render('index', [ 
            'code' => $googleUri,
            'secret' => $secret
        ]);
    }

    
}
