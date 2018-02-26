<?php

namespace backend\controllers;

use backend\models\LoginForm;
use Yii;
use yii\web\Controller;

class LoginController extends Controller
{
    public function actionIndex()
    {
        return $this->redirect('landing');
        $this->layout = 'base';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            
            if($model->hasTwofa() && !$model->authen_2fa()){
                return $this->redirect(['/authen']);    
            }else{
                return $this->redirect(['/ico']);
            }
        } else {
            return $this->render('index', [
                'model' => $model
            ]);
        }
    }
}
