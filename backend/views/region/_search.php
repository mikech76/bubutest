<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\world\CountrySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="region-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'description') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::button('Reset', [
            'class'   => 'btn btn-outline-secondary',
            'onclick' => "document.querySelectorAll('input, textarea').forEach(el=>el.value = '')",
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
