<?php
namespace backend\controllers;

use common\components\keyStorage\FormModel;
use common\helpers\CoinbaseHelper;
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

    public function actionRate()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $cb = new CoinbaseHelper();

        $rateBtcUsd = Yii::$app->keyStorage->get('coin.rate-btc-usd');
        if (!$rateBtcUsd) {
            $rateBtcUsd = CoinbaseHelper::fetchRate('BTC');
            Yii::$app->keyStorage->set('coin.rate-btc-usd', $rateBtcUsd);
        }
        $data = $cb->rate();
        $rateUsd = Yii::$app->keyStorage->get('coin.rate-usd', '0.2');
        if ($data && $data->data) {
            foreach ($data->data as $dt) {
                if ($dt) {
                    if ($dt->base == 'BTC') {
                        $rateEthUsd = $dt->amount;
                        $rateCoinBtc = $rateBtcUsd !== 0 && $rateUsd !== 0 ? (1 / $rateBtcUsd) / $rateUsd : 0;
                        Yii::$app->keyStorage->set('coin.rate-btc-usd', $rateBtcUsd);
                        Yii::$app->keyStorage->set('coin.rate-btc', $rateCoinBtc);
                    }
                    if ($dt->base == 'ETH') {
                        $rateBtcUsd = $dt->amount;
                        $rateCoinEth = $rateEthUsd !== 0 && $rateUsd !== 0 ? (1 / $rateEthUsd) / $rateUsd : 0;
                        Yii::$app->keyStorage->set('coin.rate-eth-usd', $rateEthUsd);
                        Yii::$app->keyStorage->set('coin.rate-eth', $rateCoinEth);
                    }
                }

            }
        }
        return $data;
    }

    public
    function actionLanding()
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

    public
    function actionSettings()
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
