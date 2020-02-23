<?php

use common\models\world\CitySearch;
use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var $searchModel        common\models\world\CountrySearch
 * @var $dataProviderCities yii\data\ActiveDataProvider
 * @var $region             \common\models\world\Region
 */

$searchModel                       = new CitySearch();
$params                            = Yii::$app->request->queryParams;
$params['CitySearch']['region_id'] = $region->id;
$dataProvider                      = $searchModel->search($params);
//d($params);


\yii\widgets\Pjax::begin([
    'id'              => 'region-id-' . $region->id,
    'timeout'         => false,
    'enablePushState' => false,
]);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel'  => $searchModel,
    'columns'      => [
        ['class' => 'yii\grid\SerialColumn'],
        'country.title',
        'title',
        'population',
    ],
]);

\yii\widgets\Pjax::end();