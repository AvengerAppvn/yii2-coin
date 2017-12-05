<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "wallet".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $wallet_btc
 * @property string $wallet_coin
 * @property integer $status
 * @property integer $created_at
 *
 * @property User $user
 */
class Wallet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wallet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'wallet_btc', 'wallet_coin'], 'required'],
            [['user_id', 'status', 'created_at'], 'integer'],
            [['wallet_btc', 'wallet_coin'], 'string', 'max' => 40],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'wallet_btc' => 'Wallet Btc',
            'wallet_coin' => 'Wallet Coin',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\WalletQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\WalletQuery(get_called_class());
    }
}
