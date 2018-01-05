<?php

namespace app\modules\landing\controllers;

use app\modules\landing\models\LandingForm;
use Yii;
use yii\web\Controller;

class DefaultController extends Controller
{

    public function beforeAction($action)
    {
        $this->layout = "@app/modules/landing/views/layouts/landing";
        return parent::beforeAction($action);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {
        $model = new LandingForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->refresh();
        }
        return $this->render('index', ['model' => $model]);
    }
}
