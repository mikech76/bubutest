<?php

use common\models\world\CitySearch;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $this  yii\web\View
 * @var $model common\models\world\CitySearch
 * @var $form  yii\widgets\ActiveForm
 */
//  document.querySelectorAll('input, textarea').forEach(el=>el.value = '')
?>
<div class="search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'countryTitle') ?>

    <?= $form->field($model, 'title') ?>


    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
        <?= Html::button('Очистить', [
            'class'   => 'btn btn-outline-secondary',
            'onclick' => "document.querySelectorAll('input, textarea').forEach(el=>el.value = '')",
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<hr>