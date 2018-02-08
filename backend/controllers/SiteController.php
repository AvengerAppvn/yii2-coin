<?php
namespace backend\controllers;

use common\components\keyStorage\FormModel;
use common\helpers\CoinbaseHelper;
use common\models\Page;
use backend\models\SendmailForm;
use common\models\User;
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
                        $rateBtcUsd = $dt->amount;
                        $rateCoinBtc = $rateBtcUsd !== 0 && $rateUsd !== 0 ? ($rateUsd / $rateBtcUsd) : 0;
                        Yii::$app->keyStorage->set('coin.rate-btc-usd', $rateBtcUsd);
                        Yii::$app->keyStorage->set('coin.rate-btc', $rateCoinBtc);
                    }
                    if ($dt->base == 'ETH') {
                        $rateEthUsd = $dt->amount;
                        $rateCoinEth = $rateEthUsd !== 0 && $rateUsd !== 0 ? ($rateUsd / $rateEthUsd) : 0;
                        Yii::$app->keyStorage->set('coin.rate-eth-usd', $rateEthUsd);
                        Yii::$app->keyStorage->set('coin.rate-eth', $rateCoinEth);
                    }
                }

            }
        }
        return $data;
    }

    public function actionLanding()
    {
        $model = new FormModel([
            'keys' => [
//                'frontend.maintenance' => [
//                    'label' => Yii::t('backend', 'Landing'),
//                    'type' => FormModel::TYPE_DROPDOWN,
//                    'items' => [
//                        'disabled' => Yii::t('backend', 'Disabled'),
//                        'enabled' => Yii::t('backend', 'Enabled')
//                    ]
//                ],
                'landing-page.footer.left' => [
                    'label' => Yii::t('backend', 'Landing page - Footer - Left'),
                    'type' => FormModel::TYPE_TEXTAREA,
                ],
                'landing-page.footer.right' => [
                    'label' => Yii::t('backend', 'Landing page - Footer - Right'),
                    'type' => FormModel::TYPE_TEXTAREA,
                ],
            ]
        ]);

        $change = false;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('alert', [
                'body' => Yii::t('backend', 'Settings was successfully saved'),
                'options' => ['class' => 'alert alert-success']
            ]);
            $change = true;
        }
        // id = 1
        $page = Page::findOne(1);
        if ($page && $page->load(Yii::$app->request->post()) && $page->save()) {
            $change = true;
        }

        if ($change) {
            return $this->refresh();
        }

        return $this->render('landing', ['model' => $model,'page' => $page,]);
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
                'coin.rate-usd' => [
                    'label' => Yii::t('backend', 'Prie Tickcoin'),
                    'type' => FormModel::TYPE_TEXTINPUT
                ],
                'web.total_user' => [
                    'label' => Yii::t('backend', 'Total user'),
                    'type' => FormModel::TYPE_TEXTINPUT
                ],

                'user.register_accept_no_referrer' => [
                    'label' => Yii::t('backend', 'Enable user register without referrer'),
                    'type' => FormModel::TYPE_CHECKBOX
                ],
                'user.register_accept_no_referrer_message' => [
                    'label' => Yii::t('backend', 'Message to user when register without referrer'),
                    'type' => FormModel::TYPE_TEXTAREA
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

    public function actionSendmail()
    {
        $model = new SendmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->send()) {
            return $this->render('success');
        } else {
            return $this->render('sendmail', [
                'model' => $model,
                'users' => User::find()->active()->notAdmin()->all(),
            ]);
        }
    }
}
