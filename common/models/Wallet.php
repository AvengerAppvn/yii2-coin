<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "wallet".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $wallet_btc
 * @property string $wallet_eth
 * @property string $wallet_coin
 * @property double $amount_btc
 * @property double $bonus_btc
 * @property double $amount_eth
 * @property double $bonus_eth
 * @property double $amount_coin
 * @property double $bonus_coin
 * @property double $amount_bonus
 * @property double $amount_ico
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
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
            [['user_id', 'wallet_btc', 'wallet_eth', 'wallet_coin'], 'required'],
            [['user_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['amount_btc', 'amount_eth', 'amount_coin', 'amount_bonus', 'amount_ico','bonus_btc','bonus_eth'], 'number'],
            [['wallet_btc', 'wallet_eth', 'wallet_coin'], 'string', 'max' => 100],
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
            'wallet_eth' => 'Wallet Eth',
            'wallet_coin' => 'Wallet Coin',
            'amount_btc' => 'Amount Btc',
            'bonus_btc' => 'Amount Btc',
            'amount_eth' => 'Amount Eth',
            'bonus_eth' => 'Amount Eth',
            'amount_coin' => 'Amount Coin',
            'amount_bonus' => 'Amount Bonus',
            'amount_ico' => 'Amount Ico',
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
