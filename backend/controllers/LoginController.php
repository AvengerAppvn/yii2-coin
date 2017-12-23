<?php

namespace backend\controllers;

use backend\models\LoginForm;
use backend\models\AccountForm;
use Intervention\Image\ImageManagerStatic;
use trntv\filekit\actions\DeleteAction;
use trntv\filekit\actions\UploadAction;
use Yii;
use yii\filters\VerbFilter;
use yii\imagine\Image;
use yii\web\Controller;

class LoginController extends Controller
{
    public function actionIndex()
    {
        $this->layout = 'base';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            
            if($model->hasTwofa() && !$model->authen_2fa()){
                return $this->redirect(['/authen']);    
            }else{
                return $this->goBack();
            }
        } else {
            return $this->render('index', [
                'model' => $model
            ]);
        }
    }
}
