<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Notification;

/**
 * NotificationSearch represents the model behind the search form about `common\models\Notification`.
 */
class NotificationSearch extends Notification
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'delivery_attempts', 'status'], 'integer'],
            [['notification_id', 'type', 'data', 'user_id', 'account_id', 'address', 'currency', 'amount_hash', 'transaction_id', 'resource_path', 'delivery_response', 'rawdata', 'created_at', 'updated_at'], 'safe'],
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
        $query = Notification::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'amount' => $this->amount,
            'delivery_attempts' => $this->delivery_attempts,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'notification_id', $this->notification_id])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'data', $this->data])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'account_id', $this->account_id])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'currency', $this->currency])
            ->andFilterWhere(['like', 'amount_hash', $this->amount_hash])
            ->andFilterWhere(['like', 'transaction_id', $this->transaction_id])
            ->andFilterWhere(['like', 'resource_path', $this->resource_path])
            ->andFilterWhere(['like', 'delivery_response', $this->delivery_response])
            ->andFilterWhere(['like', 'rawdata', $this->rawdata]);

        return $dataProvider;
    }
}
