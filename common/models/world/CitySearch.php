<?php

namespace common\models\world;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\world\Country;

/**
 * CitySearch represents the model behind the search form of `common\models\world\City`.
 */
class CitySearch extends City
{
    public $countryTitle;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'country_id', 'country_id'], 'integer'],
            [['title', 'description', 'population', 'countryTitle', 'created_at', 'updated_at'], 'safe'],
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
        //d($params);
        $query = City::find()->joinWith('country');

        $region_id = $params['CitySearch']['region_id'] ?? 0;

        // фильтр по Региону
        if ($region_id) {
            $query->andFilterWhere([
                'region_id' => $region_id,
            ]);
        }
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
            'sort'       => [
                'attributes'   => [
                    'country.title' => [
                        'asc'  => ['countries.title' => SORT_ASC],
                        'desc' => ['countries.title' => SORT_DESC],
                    ],
                    'title',
                    'population',
                ],
                'defaultOrder' => [
                    'population' => SORT_DESC,
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
            'country_id' => $this->country_id,
            'population' => $this->population,
        ]);

        $query->andFilterWhere(['ilike', 'cities.title', $this->title])
              ->andFilterWhere(['ilike', 'cities.description', $this->description])
              ->andFilterWhere(['ilike', 'countries.title', $this->countryTitle]);


        return $dataProvider;
    }
}
