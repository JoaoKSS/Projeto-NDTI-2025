<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Recepcionista $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="recepcionista-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_recepcionista')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
