<?php
namespace backend\modules\api\v1\controllers;

use backend\modules\api\v1\resources\Article;
use common\helpers\CoinbaseHelper;
use common\models\Notification;
use common\models\Wallet;
use common\models\Deposit;
use Yii;
use yii\rest\ActiveController;

/**
 * Class NotificationController
 */
class NotificationController extends ActiveController
{
    /**
     * @var string
     */
    public $modelClass = 'backend\modules\api\v1\resources\Notification';
    /**
     * @var array
     */
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items'
    ];

    /**
     * @inheritdoc
     */

    public function actionAlert()
    {
        $raw_body = file_get_contents('php://input');
        if (empty($_POST)) {
            $_POST = json_decode($raw_body, true);
        }
        // echo $raw_body;
        // return;
        $signature = $_SERVER['HTTP_CB_SIGNATURE'];
        $authenticity = CoinbaseHelper::verify($raw_body, $signature);
        //$authenticity = true;
        if ($authenticity) {
            $params = $_POST;

            if (isset($params['id'])) {
                $notification_id = $params['id'];

                if (!Notification::find()->where(['notification_id' => $notification_id])->exists()) {

                    $model = new Notification();
                    $model->notification_id = $notification_id;
                    if (isset($params['type'])) {
                        $model->type = $params['type'];
                    }
                    //var_dump($notification);die;
                    if (isset($params['data'])) {
                        $data = $params['data'];
                        $model->data = json_encode($data);
                        if (isset($data['address'])) {
                            $model->address = $data['address'];
                        }
                    }

                    if (isset($params['additional_data'])) {
                        $additionalData = $params['additional_data'];

                        if (isset($additionalData['hash'])) {
                            $model->amount_hash = $additionalData['hash'];
                        }

                        if (isset($additionalData['transaction'])) {
                            $transactions = $additionalData['transaction'];
                            if (isset($transactions['id'])) {
                                $model->transaction_id = $transactions['id'];
                            }

                            if (isset($transactions['resource_path'])) {
                                $model->resource_path = $transactions['resource_path'];
                            }
                        }
                        if (isset($additionalData['amount'])) {
                            $amounts = $additionalData['amount'];

                            if (isset($amounts['amount'])) {
                                $model->amount = $amounts['amount'];
                            }
                            if (isset($amounts['currency'])) {
                                $model->currency = $amounts['currency'];
                            }
                        }
                    }

                    $model->rawdata = $raw_body;
                    //$model->created_at = $params['created_at'];
                    //$model->updated_at = $notification->getUpdatedAt();
                    $model->delivery_attempts = $params['delivery_attempts'];
                    //$model->delivery_response = json_encode($notification->getDeliveryResponse());

                    Yii::info('CREATE NEW NOTIFICATION...............');
                    if ($model->save() && $model->type == 'wallet:addresses:new-payment') {
                        // Add to Deposit
                        $deposit = new Deposit();
                        $deposit->sender = $model->amount_hash;
                        $deposit->receiver = $model->address;

                        $deposit->amount = $model->amount;
                        $wallet = null;

                        if ($model->currency == 'BTC') {
                            //var_dump($model->address);
                            $wallet = Wallet::find()->where(['wallet_btc' => $model->address])->limit(1)->one();

                            if ($wallet) {
                                $deposit->user_id = $wallet->user_id;
                            }

                            $deposit->type = 1;
                        } else {
                            $wallet = Wallet::find()->where(['wallet_eth' => $model->address])->limit(1)->one();
                            if ($wallet) {
                                $deposit->user_id = $wallet->user_id;
                            }
                            $deposit->type = 2;
                        }
                        $deposit->status = 0;
                        // Update Status
                        Yii::info('DEPOSIT ..............');
                        if ($wallet && $deposit->save()) {
                            $model->status = 1;
                            $model->save();
                            Yii::info('Update status notification ..............');

                            // Plus money
                            if ($wallet && $deposit->type == 1) {
                                $wallet->amount_btc += floatval($model->amount);
                                $wallet->save();
                                Yii::info('Plus BTC ..............:' . floatval($model->amount));
                            } else {
                                $wallet->amount_eth += floatval($model->amount);
                                $wallet->save();
                                Yii::info('Plus ETH..............:' . floatval($model->amount));
                            }
                        }
                       // var_dump($deposit->getErrors());die;
                    }

                    return 1;
                } else {
                    Yii::error('SCANNED... NOTIFICATION');
                    return 1;
                }
            }
            Yii::error('ERROR FORMAT');
            return 1;
        }

        Yii::error('ERROR AUTHEN FROM COINBASE');
        $this->setHeader(200);
    }

}
