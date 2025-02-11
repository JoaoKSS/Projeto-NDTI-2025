<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Paciente;
use app\models\Medico;
use app\models\Especialidade;
use app\models\Disponibilidadehorario;

/** @var yii\web\View $this */
/** @var app\models\Consulta $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="consulta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'paciente_id')->dropDownList(
        ArrayHelper::map(Paciente::find()->all(), 'id', 'nome_completo'),
        ['prompt' => 'Selecione um Paciente']
    ) ?>

    <?= $form->field($model, 'medico_id')->dropDownList(
        ArrayHelper::map(Medico::find()->all(), 'id', 'nome_completo'),
        ['prompt' => 'Selecione um Médico']
    ) ?>

    <?= $form->field($model, 'especialidade_id')->dropDownList(
        ArrayHelper::map(Especialidade::find()->all(), 'id', 'nome_especialidade'),
        ['prompt' => 'Selecione uma Especialidade']
    ) ?>

    <?= $form->field($model, 'hora_consulta')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList(
        ['Agendado' => 'Agendado', 'Cancelado' => 'Cancelado', 'Realizado' => 'Realizado'],
        ['prompt' => 'Selecione um Status']
    ) ?>

    <?= $form->field($model, 'disponibilidade_id')->dropDownList(
        ArrayHelper::map(Disponibilidadehorario::find()->all(), 'id', function($model) {
            return $model->dia_da_semana . ' das ' . $model->horario_inicio . ' às ' . $model->horario_fim;
        }),
        ['prompt' => 'Selecione uma Disponibilidade']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
