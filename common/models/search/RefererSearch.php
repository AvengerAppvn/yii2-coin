<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Referer;

/**
 * RefererSearch represents the model behind the search form about `common\models\Referer`.
 */
class RefererSearch extends Referer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'node', 'level', 'status', 'created_at', 'updated_at', 'logged_at'], 'integer'],
            [['username'], 'safe'],
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
        $query = Referer::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'node' => $this->node,
            'level' => $this->level,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'logged_at' => $this->logged_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username]);

        return $dataProvider;
    }
}
