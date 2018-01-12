<?php

namespace backend\controllers;

use backend\models\SecurityForm;
use backend\models\AccountForm;
use Intervention\Image\ImageManagerStatic;
use trntv\filekit\actions\DeleteAction;
use trntv\filekit\actions\UploadAction;
use Yii;
use yii\filters\VerbFilter;
use yii\imagine\Image;
use yii\web\Controller;

class AuthenController extends Controller
{
    public function actionIndex()
    {
        $this->layout = 'base';

        $model = new SecurityForm();
        if ($model->load(Yii::$app->request->post())) {
            if($model->authen()){
                return $this->redirect(['/ico']);
            }else{
                 Yii::$app->session->setFlash('alert', [
                    'options'=>['class'=>'alert-error'],
                    'body'=>Yii::t('backend', 'Wrong two code verification')
                ]);
            }
        }
        return $this->render('index', [
            'model' => $model
        ]);

    }
    
    public function actionCancel()
    {
        Yii::$app->user->logout();
        return $this->goBack();
    }
}
