<?php

namespace common\models;

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
            [['notification_id', 'type', 'user_id', 'account_id'], 'required'],
            [['data', 'rawdata'], 'string'],
            [['delivery_attempts', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['notification_id', 'type', 'user_id', 'account_id', 'delivery_response'], 'string', 'max' => 50],
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
     * @return \common\models\query\NotificationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\NotificationQuery(get_called_class());
    }
}
