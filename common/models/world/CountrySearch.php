<?php

namespace common\models\world;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\world\Region;

/**
 * RegionSearch represents the model behind the search form of `common\models\world\Region`.
 */
class CountrySearch extends Country
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'region_id'], 'integer'],
            [['title', 'description', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Country::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'  => [
                'defaultOrder' => [
                    'title' => SORT_ASC,
                ],
            ],
        ]);

        $this->load($params);

        if ( !$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id'         => $this->id,
            'region_id'  => $this->region_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['ilike', 'title', $this->title])
              ->andFilterWhere(['ilike', 'description', $this->description]);

        return $dataProvider;
    }
}
