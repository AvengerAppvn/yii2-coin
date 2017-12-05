<?php

namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;

class LogoutController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['post']
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

}
