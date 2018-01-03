<?php

namespace console\controllers;
use common\models\Wallet;
use common\models\Deposit;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;
use common\helpers\CoinbaseHelper;
use common\models\Notification;
/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class NotificationController extends Controller
{
    public function actionIndex()
    {
        // Scan notification
        $coinbase = new CoinbaseHelper();
        $notifications = $coinbase->getNotifications();
        foreach ($notifications->all() as $notification) {
            //var_dump($notification);die;
            if (!Notification::find()->where(['notification_id' => $notification->getId()])->exists()) {

                $model = new Notification();

                $model->notification_id = $notification->getId();
                //var_dump($notification);die;

                $data = $notification->getData();
                $model->data = json_encode(array($notification->getData()));
                $model->type = $notification->getType();
                $model->address = $data->getAddress();

                if ($notification->getAdditionalData()) {
                    $additionalData = $notification->getAdditionalData();

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

                $model->rawdata = json_encode($notification->getRawData());
                $model->created_at = $notification->getCreatedAt();
                $model->updated_at = $notification->getUpdatedAt();
                $model->delivery_attempts = $notification->getDeliveryAttempts();
                $model->delivery_response = json_encode($notification->getDeliveryResponse());

                //var_dump($model->getErrors());die;

                echo "CREATE NEW NOTIFICATION...............";
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
                    echo "DEPOSIT ..............\n\t";
                    if ($wallet && $deposit->save()) {
                        $model->status = 1;
                        $model->save();
                        echo "Update status notification ..............\n";

                        // Plus money
                        if ($wallet && $deposit->type == 1) {
                            $wallet->amount_btc += floatval($model->amount);
                            $wallet->save();
                            echo "Plus BTC ..............:" . floatval($model->amount);
                        } else {
                            $wallet->amount_eth += floatval($model->amount);
                            $wallet->save();
                            echo "Plus ETH..............:" . floatval($model->amount);
                        }
                    }
                    // var_dump($deposit->getErrors());die;
                }


            }

        }
        // Scan notification not yet + account
        // Change status
        //$notis = Notification::find()->inactive()->all();
//        foreach ($notis as $noti) {
//
//            // Add to transaction Deposit
//
//            // Plus money
//
//            $noti->status = 1;
//            $noti->save();
//        }
    }
}
