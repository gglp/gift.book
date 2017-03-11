<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ActBook;

/**
 * ActBookSearch represents the model behind the search form about `frontend\models\ActBook`.
 */
class ActBookSearch extends ActBook
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'act_id', 'book_id'], 'integer'],
            [['price'], 'number'],
            [['inventory_number'], 'safe'],
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
        $query = ActBook::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'act_id' => $this->act_id,
            'book_id' => $this->book_id,
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'inventory_number', $this->inventory_number]);

        return $dataProvider;
    }
}
