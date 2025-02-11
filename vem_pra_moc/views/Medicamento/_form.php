<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Medicamento $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="medicamento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome_medicamento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'historico_medico_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
