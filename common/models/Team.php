<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "team".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $related_id
 * @property double $amount_btc
 * @property double $amount_btc_bonus
 * @property double $amount_eth
 * @property double $amount_eth_bonus
 * @property double $amount_total_bonus
 * @property double $total_btc_bonus
 * @property double $total_eth_bonus
 * @property integer $level
 * @property integer $type
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Team extends \yii\db\ActiveRecord
{
    /**
     * @var
     */
    public $total_btc_bonus;
    /**
     * @var
     */
    public $total_eth_bonus;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'team';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id','related_id', 'level', 'type', 'status', 'created_at', 'updated_at'], 'integer'],
            [['amount_btc', 'amount_btc_bonus', 'amount_eth', 'amount_eth_bonus', 'amount_total_bonus'], 'required'],
            [['amount_btc', 'amount_btc_bonus', 'amount_eth', 'amount_eth_bonus', 'amount_total_bonus'], 'number'],
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
            'related_id' => 'Referrer',
            'level' => 'Level',
            'amount_btc' => 'BTC',
            'amount_btc_bonus' => 'BTC Bonus',
            'amount_eth' => 'ETH',
            'amount_eth_bonus' => 'ETH Bonus',
            'amount_total_bonus' => 'Total Bonus',
            'type' => 'Type',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'related_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefer()
    {
        return $this->hasOne(User::className(), ['id' => 'related_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRefer()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWallet()
    {
        return $this->hasOne(Wallet::className(), ['user_id' => 'user_id']);
    }
    /**
     * @inheritdoc
     * @return \common\models\query\TeamQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TeamQuery(get_called_class());
    }
}
