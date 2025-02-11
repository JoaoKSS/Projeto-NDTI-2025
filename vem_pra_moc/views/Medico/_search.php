<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\MedicoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="medico-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nome_completo') ?>

    <?= $form->field($model, 'crm') ?>

    <?= $form->field($model, 'telefone_primario') ?>

    <?= $form->field($model, 'telefone_secundario') ?>

    <?= $form->field($model, 'especialidade') ?> <!-- Campo de busca por especialidade -->

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'horario_atendimento') ?>

    <?php // echo $form->field($model, 'id_usuario') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
