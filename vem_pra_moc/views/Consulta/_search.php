<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ConsultaSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="consulta-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'paciente_id') ?>

    <?= $form->field($model, 'medico_id') ?>

    <?= $form->field($model, 'especialidade_id') ?>

    <?= $form->field($model, 'hora_consulta') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'disponibilidade_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
