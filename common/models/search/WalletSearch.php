<?php

namespace common\models\search;

use common\models\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Wallet;

/**
 * WalletSearch represents the model behind the search form about `common\models\Wallet`.
 */
class WalletSearch extends Wallet
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'status', 'created_at'], 'integer'],
            [['amount_btc', 'amount_eth', 'amount_coin', 'amount_bonus', 'amount_ico','bonus_btc','bonus_eth'], 'number'],
            [['wallet_btc', 'wallet_coin'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Wallet::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'wallet_btc', $this->wallet_btc])
            ->andFilterWhere(['like', 'wallet_coin', $this->wallet_coin]);

        return $dataProvider;
    }

    public function searchManager($params)
    {
        $userIds = Yii::$app->authManager->getUserIdsByRole(User::ROLE_ADMINISTRATOR);
        $query = Wallet::find()->where(['not in','user_id',$userIds]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if($params && isset($params['user_id'])){
            if(in_array($params['user_id'],$userIds)){
                $params['user_id'] = -1;
            }
        }
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'user_id' => $this->user_id,
            'amount_btc' => $this->amount_btc,
            'bonus_btc' => $this->bonus_btc,
            'amount_eth' => $this->amount_eth,
            'bonus_eth' => $this->bonus_eth,
            'amount_coin' => $this->amount_coin,
            'amount_bonus' => $this->amount_bonus,
            'amount_ico' => $this->amount_ico,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'wallet_btc', $this->wallet_btc])
            ->andFilterWhere(['like', 'wallet_coin', $this->wallet_coin]);

        return $dataProvider;
    }
}
