<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Historicomedico $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="historicomedico-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'historico_cirurgias')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'paciente_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'alergiasString')->textarea(['rows' => 3, 'placeholder' => 'Digite as alergias separadas por vírgula']) ?>

    <?= $form->field($model, 'doencasString')->textarea(['rows' => 3, 'placeholder' => 'Digite as doenças separadas por vírgula']) ?>

    <?= $form->field($model, 'medicamentosString')->textarea(['rows' => 3, 'placeholder' => 'Digite os medicamentos separados por vírgula']) ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
