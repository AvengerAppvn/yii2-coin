<?php

namespace backend\controllers;

use Yii;
use common\models\Team;
use common\models\search\TeamSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TeamController implements the CRUD actions for Team model.
 */
class TeamController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Team models.
     * @return mixed
     */
    public function actionIndex()
    {
        $user = Yii::$app->user->identity;
        if (!Yii::$app->user->isGuest) {
            if ($user && $user->has2fa && !Yii::$app->session->get('authen_2fa')) {
                return $this->redirect(['/authen']);
            }
        }

        $searchModel = new TeamSearch();
        $searchModel->user_id = $user->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        $team = Team::find()
            ->select('sum(amount_btc_bonus) as total_btc_bonus,sum(amount_eth_bonus) as total_eth_bonus')
            ->where(['user_id'=>$user->id])
            ->one();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'total_btc_bonus' => $team->total_btc_bonus,
            'total_eth_bonus' => $team->total_eth_bonus,
        ]);
    }

    /**
     * Displays a single Team model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Team model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Team the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Team::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
