<?php

namespace common\helpers;

use Yii;
use Coinbase\Wallet\Client;
use Coinbase\Wallet\Configuration;
use Coinbase\Wallet\Resource\Address;
use common\models\Notification;

/**
 * CoinbaseHelper
 *
 */
class CoinbaseHelper
{

    public $client;
    public $configuration;

    public function __construct()
    {
        $apiKey = Yii::$app->keyStorage->get('coin.apiKey');
        $apiSecret = Yii::$app->keyStorage->get('coin.apiSecret');
        $this->configuration = Configuration::apiKey($apiKey, $apiSecret);
        //$this->configuration->setLogger($logger);
        $this->client = Client::create($this->configuration);
    }

    /**
     *
     */
    public function rate($currency = 'USD')
    {
        $cURL = curl_init();
        curl_setopt($cURL, CURLOPT_URL, 'https://api.coinbase.com/v2/prices/USD/spot?');
        curl_setopt($cURL, CURLOPT_HTTPGET, true);
        curl_setopt($cURL, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Accept: application/json',
            'CB-VERSION : 2017-11-29'
        ));
        $result = curl_exec($cURL);
        curl_close($cURL);
        return json_decode($result);
    }

    public static function fetchRate($currency = 'BTC')
    {
        //https://api.coinbase.com/v2/exchange-rates?currency=BTC
        //http://www.coloring.ws/pandas.htm

        $url = 'https://api.coinbase.com/v2/exchange-rates?currency=' . $currency;

        $cURL = curl_init();
        curl_setopt($cURL, CURLOPT_URL, $url);
        curl_setopt($cURL, CURLOPT_HTTPGET, true);
        curl_setopt($cURL, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Accept: application/json',
            'CB-VERSION : 2017-12-07'
        ));

        $result = curl_exec($cURL);
        curl_close($cURL);
        $json = json_decode($result, true);
        return $json['data']['rates']['USD'];
    }

    public static function fetchPriceUsd($currency = 'USD')
    {
        //https://api.coinbase.com/v2/prices/spot?currency=USD
        //http://www.coloring.ws/pandas.htm

        $url = 'https://api.coinbase.com/v2/prices/spot?currency=' . $currency;

        $cURL = curl_init();
        curl_setopt($cURL, CURLOPT_URL, $url);
        curl_setopt($cURL, CURLOPT_HTTPGET, true);
        curl_setopt($cURL, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Accept: application/json',
            'CB-VERSION : 2017-11-29'
        ));

        $result = curl_exec($cURL);
        curl_close($cURL);
        //var_dump($result);
        //die;
        $json = json_decode($result, true);
        return $json['data']['amount'];
    }

    public function createAddress($type = null)
    {
        $user = Yii::$app->user->identity;
        $accounts = $this->client->getAccounts();
        $addresses = [];
        foreach ($accounts->all() as $account) {
            if ($type == null) {
                $address = new Address(['name' => $account->getCurrency() . ' - ' . $user->username]);
                $this->client->createAccountAddress($account, $address);
                $addresses[$account->getCurrency()] = $address;
            } else {
                if ($type == $account->getCurrency()) {
                    $address = new Address(['name' => $account->getCurrency() . ' - ' . $user->username]);
                    $this->client->createAccountAddress($account, $address);
                    $addresses[$type] = $address;
                } else {
                    break;
                }
            }
        }
        return $addresses;
    }

    public function createWalletCoin()
    {
        $length = 35;
        $bytes = Yii::$app->getSecurity()->generateRandomKey($length);
        return "T" . StringHelper::generateRandomString($bytes, $length);
    }

    public function getAccountByCurrency($currency = 'BTC')
    {
        $accounts = $this->client->getAccounts();
        $addresses = [];
        foreach ($accounts->all() as $account) {
            if ($currency == $account->currency) {
                return $account;
            }
        }
    }

    public function getNotifications()
    {
        return $this->client->getNotifications();
        Yii::info('==========Total notification:' . count($notifications));
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

                $model->save();
                //var_dump($model->getErrors());die;
            }

        }

    }

    private function webhook()
    {
        // $raw_body = file_get_contents('php://input');
        // $signature = $_SERVER['HTTP_CB_SIGNATURE'];
        // $authenticity = $client->verifyCallback($raw_body, $signature); // boolean
    }

    public function authenticity($raw_body, $signature)
    {
        return $this->client->verifyCallback($raw_body, $signature);
    }

    public function getTransactions()
    {
        $accounts = $this->client->getAccounts();
        $addresses = [];
        //$transaction = new Transaction();

        foreach ($accounts->all() as $account) {
            //var_dump($account);
            //die;
            $transactions = $this->client->getAccountTransactions($account);
            foreach ($transactions->all() as $transaction) {
                var_dump($transaction);
                var_dump($transaction->getAmount()->getAmount());
            }

            //var_dump($notifications);
            //die;
        }
        die;


        $accounts = $this->client->getAccounts();
        $addresses = [];
        foreach ($accounts->all() as $account) {
            //var_dump($account);
            //die;
            $notifications = $this->client->getAccountTransactions($account);
            var_dump($notifications);
            //die;
        }

        // $url = 'https://api.coinbase.com/v2/notifications';

        // $cURL = curl_init();
        // curl_setopt($cURL, CURLOPT_URL, $url);
        // curl_setopt($cURL, CURLOPT_HTTPGET, true);
        // curl_setopt($cURL, CURLOPT_RETURNTRANSFER, 1);

        // curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
        //     'Content-Type: application/json',
        //     'Accept: application/json',
        //     'CB-VERSION : 2017-11-29'
        // ));

        // $result = curl_exec($cURL);
        // curl_close($cURL);


        // var_dump($notifications);
        // die;
        // $json = json_decode($result, true);
        // return $json['data']['amount'];
    }

    public function getOrders()
    {
        $orders = $this->client->getOrders();
        //var_dump($orders);
        $addresses = [];
        //$transaction = new Transaction();

        foreach ($orders->all() as $order) {
            //var_dump($account);
            //die;
            // $transactions = $this->client->getAccountTransactions($account);
            // foreach($transactions->all() as $transaction){
            //     var_dump($transaction);
            //     var_dump($transaction->getAmount()->getAmount());
            // }

            //var_dump($notifications);
            //die;
        }
        die;


        $accounts = $this->client->getAccounts();
        $addresses = [];
        foreach ($accounts->all() as $account) {
            //var_dump($account);
            //die;
            $notifications = $this->client->getAccountTransactions($account);
            //var_dump($notifications);
            //die;
        }

        // $url = 'https://api.coinbase.com/v2/notifications';

        // $cURL = curl_init();
        // curl_setopt($cURL, CURLOPT_URL, $url);
        // curl_setopt($cURL, CURLOPT_HTTPGET, true);
        // curl_setopt($cURL, CURLOPT_RETURNTRANSFER, 1);

        // curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
        //     'Content-Type: application/json',
        //     'Accept: application/json',
        //     'CB-VERSION : 2017-11-29'
        // ));

        // $result = curl_exec($cURL);
        // curl_close($cURL);


        // var_dump($notifications);
        // die;
        // $json = json_decode($result, true);
        // return $json['data']['amount'];
    }

    public function verify($raw_body, $signature)
    {
        return $this->client->verifyCallback($raw_body, $signature);
    }
}
