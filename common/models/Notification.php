<?php

namespace common\models;
use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "notification".
 *
 * @property integer $id
 * @property string $notification_id
 * @property string $type
 * @property string $data
 * @property string $user_id
 * @property string $account_id
 * @property string $address
 * @property string $currency
 * @property double $amount
 * @property string $amount_hash
 * @property string $transaction_id
 * @property string $resource_path
 * @property integer $delivery_attempts
 * @property string $delivery_response
 * @property string $rawdata
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data', 'rawdata'], 'string'],
            [['amount'], 'number'],
            [['delivery_attempts', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['notification_id', 'type', 'user_id', 'account_id', 'address', 'currency', 'transaction_id'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'notification_id' => 'Notification ID',
            'type' => 'Type',
            'data' => 'Data',
            'user_id' => 'User ID',
            'account_id' => 'Account ID',
            'address' => 'Address',
            'currency' => 'Currency',
            'amount' => 'Amount',
            'transaction_id' => 'Transaction ID',
            'delivery_attempts' => 'Delivery Attempts',
            'delivery_response' => 'Delivery Response',
            'rawdata' => 'Rawdata',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
 /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    /**
     * @inheritdoc
     * @return \common\models\query\NotificationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\NotificationQuery(get_called_class());
    }
}
