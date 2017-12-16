<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "team".
 *
 * @property integer $id
 * @property integer $user_id
 * @property double $amount_btc
 * @property double $amount_btc_bonus
 * @property double $amount_eth
 * @property double $amount_eth_bonus
 * @property double $amount_total_bonus
 * @property integer $level
 * @property integer $type
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Team extends \yii\db\ActiveRecord
{
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
            [['user_id', 'level', 'type', 'status', 'created_at', 'updated_at'], 'integer'],
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
            'amount_btc' => 'Amount Btc',
            'amount_btc_bonus' => 'Amount Btc Bonus',
            'amount_eth' => 'Amount Eth',
            'amount_eth_bonus' => 'Amount Eth Bonus',
            'amount_total_bonus' => 'Amount Total Bonus',
            'level' => 'Level',
            'type' => 'Type',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
