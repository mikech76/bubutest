<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/**
 * @var $this               yii\web\View
 * @var $searchModel        common\models\world\RegionSearch
 * @var $searchCity         common\models\world\CitySearch
 * @var $dataProvider       yii\data\ActiveDataProvider
 */

$this->title                   = 'Популяция городов мира';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="region-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_search', ['model' => $searchCity]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions'  => ['class' => 'div'],
        'layout'       => '{items}{pager}',
        'itemView'     => function($model, $key, $index, $widget) {
            return
                // Заголовок региона
                Html::tag('h2', Html::encode($model->title))
                // Грид с городами
                . $this->render('_citiesBlock', ['region' => $model]);
        },
    ]) ?>


</div>
