<?php

namespace app\modules\landing\controllers;

use app\modules\landing\models\LandingForm;
use common\models\Page;
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
        if(Yii::$app->session->get('next-landing-page')){
            return $this->render('index', ['model' => Page::findOne(1)]);
        }else {
            $model = new LandingForm();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->refresh();
            }
            return $this->render('form', ['model' => $model]);
        }
    }
}
