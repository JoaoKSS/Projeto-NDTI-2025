<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\DisponibilidadehorarioSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="disponibilidadehorario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'medico_id') ?>

    <?= $form->field($model, 'dia_da_semana') ?>

    <?= $form->field($model, 'horario_inicio') ?>

    <?= $form->field($model, 'horario_fim') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
