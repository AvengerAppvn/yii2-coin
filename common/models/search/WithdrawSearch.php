<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Withdraw;

/**
 * WithdrawSearch represents the model behind the search form about `common\models\Withdraw`.
 */
class WithdrawSearch extends Withdraw
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'type', 'status', 'manager_id', 'created_at', 'updated_at', 'requested_at', 'completed_at'], 'integer'],
            [['sender', 'receiver', 'txid'], 'safe'],
            [['amount'], 'number'],
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
        $query = Withdraw::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'amount' => $this->amount,
            'type' => $this->type,
            'status' => $this->status,
            'manager_id' => $this->manager_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'requested_at' => $this->requested_at,
            'completed_at' => $this->completed_at,
        ]);

        $query->andFilterWhere(['like', 'sender', $this->sender])
            ->andFilterWhere(['like', 'receiver', $this->receiver])
            ->andFilterWhere(['like', 'txid', $this->txid]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchUser($user_id)
    {
        $query = Withdraw::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->andFilterWhere([
            'user_id' => $user_id,
        ]);

        return $dataProvider;
    }
}
