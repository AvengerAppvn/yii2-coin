<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
       
        return $this->render('index', [ 
            'code' => ''
        ]);
    }

    
}
