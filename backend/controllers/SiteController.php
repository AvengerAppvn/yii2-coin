<?php
namespace backend\controllers;

use common\components\keyStorage\FormModel;
use Yii;

/**
 * Site controller
 */
class SiteController extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function beforeAction($action)
    {
        $this->layout = Yii::$app->user->isGuest || !Yii::$app->user->can('loginToBackend') ? 'base' : 'common';
        return parent::beforeAction($action);
    }
    public function actionLanding()
    {
        $model = new FormModel([
            'keys' => [
                'frontend.maintenance' => [
                    'label' => Yii::t('backend', 'Landing'),
                    'type' => FormModel::TYPE_DROPDOWN,
                    'items' => [
                        'disabled' => Yii::t('backend', 'Disabled'),
                        'enabled' => Yii::t('backend', 'Enabled')
                    ]
                ],
            ]
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('alert', [
                'body' => Yii::t('backend', 'Settings was successfully saved'),
                'options' => ['class' => 'alert alert-success']
            ]);
            return $this->refresh();
        }

        return $this->render('landing', ['model' => $model]);
    }
    public function actionSettings()
    {
        $model = new FormModel([
            'keys' => [
                'coin.total' => [
                    'label' => Yii::t('backend', 'Total of coin ICO'),
                    'type' => FormModel::TYPE_TEXTINPUT
                ],
                'coin.sold' => [
                    'label' => Yii::t('backend', 'Sold coin'),
                    'type' => FormModel::TYPE_TEXTINPUT
                ],
                'web.total_user' => [
                    'label' => Yii::t('backend', 'Total user'),
                    'type' => FormModel::TYPE_TEXTINPUT
                ],
            ]
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('alert', [
                'body' => Yii::t('backend', 'Settings was successfully saved'),
                'options' => ['class' => 'alert alert-success']
            ]);
            return $this->refresh();
        }

        return $this->render('settings', ['model' => $model]);
    }
}
