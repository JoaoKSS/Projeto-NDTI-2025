<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ProntuarioSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="prontuario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'paciente_id') ?>

    <?= $form->field($model, 'medico_id') ?>

    <?= $form->field($model, 'data_consulta') ?>

    <?= $form->field($model, 'diagnostico') ?>

    <?php // echo $form->field($model, 'prescricao') ?>

    <?php // echo $form->field($model, 'exames') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
