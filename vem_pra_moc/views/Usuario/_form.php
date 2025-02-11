<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Especialidade;

/** @var yii\web\View $this */
/** @var app\models\Usuario $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="usuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'senha')->passwordInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'tipo_usuario')->dropDownList([
        'Atendente' => 'Atendente',
        'Medico' => 'Medico',
        'Cliente' => 'Cliente',
        'Administrador' => 'Administrador'
    ], ['prompt' => 'Selecione um tipo de usuário']) ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
