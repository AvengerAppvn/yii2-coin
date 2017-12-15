<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "buy".
 *
 * @property integer $id
 * @property integer $user_id
 * @property double $amount_coin
 * @property double $amount
 * @property string $token
 * @property integer $type
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Buy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'buy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'type', 'status', 'created_at', 'updated_at'], 'integer'],
            [['amount_coin', 'amount', 'token'], 'required'],
            [['amount_coin', 'amount'], 'number'],
            [['token'], 'string', 'max' => 10],
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
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'amount_coin' => 'Amount Coin',
            'amount' => 'Amount',
            'token' => 'Token',
            'type' => 'Type',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\BuyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\BuyQuery(get_called_class());
    }
}
