<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Especialidade $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="especialidade-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome_especialidade')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
