<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ToolController implements the CRUD actions for Tool model.
 */
class ToolController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                ]
            ]
        ];
    }

    /**
     * Lists all Tool models.
     * @return mixed
     */
    public function actionIndex()
    {
        // $searchModel = new ToolSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // $dataProvider->sort = [
        //     'defaultOrder'=>['published_at'=>SORT_DESC]
        // ];
        return $this->render('index', [
            // 'searchModel' => $searchModel,
            // 'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Finds the Tool model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tool the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        // if (($model = Tool::findOne($id)) !== null) {
        //     return $model;
        // } else {
        //     throw new NotFoundHttpException('The requested page does not exist.');
        // }
    }
}
