<?php

namespace common\models;

use Yii;
use common\behaviors\CodeBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "wallet".
 *
 * @property integer $user_id
 * @property string $wallet_btc
 * @property string $wallet_eth
 * @property string $wallet_coin
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
    
     public function behaviors()
        {
            return [
                TimestampBehavior::className(),
                CodeBehavior::className(),
            ];
        }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'status', 'created_at','updated_at'], 'integer'],
            [['wallet_btc', 'wallet_eth', 'wallet_coin'], 'string', 'max' => 40],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'wallet_btc' => 'Wallet BTC',
            'wallet_eth' => 'Wallet ETH',
            'wallet_coin' => 'Wallet Coin',
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
