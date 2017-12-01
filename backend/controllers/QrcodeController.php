<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Da\QrCode\Action\QrCodeAction;

/**
 * 
 */
class QrcodeController extends Controller
{
    public function actions()
    {
        return [
            'index' => [
                'class' => QrCodeAction::className(),
                'text' => 'tikcoin', // default text
                'param' => 'v',
                'component' => 'qrcode' // if configured in our app as `qrcode` 
            ]
        ];
    }
}
