<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
/**
 * This is the model class for table "withdraw".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $sender
 * @property string $receiver
 * @property double $amount
 * @property string $txid
 * @property integer $type
 * @property integer $status
 * @property integer $manager_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $requested_at
 * @property integer $completed_at
 */
class Withdraw extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'withdraw';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'type', 'status', 'manager_id', 'created_at', 'updated_at', 'requested_at', 'completed_at'], 'integer'],
            [['amount'], 'number'],
            [['sender', 'receiver', 'txid'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'sender' => 'Sender',
            'receiver' => 'Receiver',
            'amount' => 'Amount',
            'txid' => 'Txid',
            'type' => 'Type',
            'status' => 'Status',
            'manager_id' => 'Manager ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'requested_at' => 'Requested At',
            'completed_at' => 'Completed At',
        ];
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'requested_at',
                'updatedAtAttribute' => 'completed_at',
            ],
        ];
    }
    /**
     * @inheritdoc
     * @return \common\models\query\WithdrawQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\WithdrawQuery(get_called_class());
    }
}
