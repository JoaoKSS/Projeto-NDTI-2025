<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Especialidade;
use app\models\Usuario;

/** @var yii\web\View $this */
/** @var app\models\Medico $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="medico-form">
    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger">
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>

    <?php $form = ActiveForm::begin(['enableAjaxValidation' => false]); ?>

    <?= $form->field($model, 'nome_completo')->textInput(['maxlength' => 100]) ?>
    <?= $form->field($model, 'crm')->textInput(['maxlength' => 20]) ?>
    <?= $form->field($model, 'telefone_primario')->textInput(['maxlength' => 15]) ?>
    <?= $form->field($model, 'telefone_secundario')->textInput(['maxlength' => 15]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => 100]) ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Horários de Atendimento</h3>
        </div>
        <div class="panel-body">
            <div id="horarios-container">
                <div class="form-group horario-item">
                    <?= Html::label('Dia da Semana') ?>
                    <?= Html::dropDownList('DisponibilidadeHorario[dia_da_semana][]', null, [
                        'Segunda-feira' => 'Segunda-feira',
                        'Terça-feira' => 'Terça-feira',
                        'Quarta-feira' => 'Quarta-feira',
                        'Quinta-feira' => 'Quinta-feira',
                        'Sexta-feira' => 'Sexta-feira',
                        'Sábado' => 'Sábado',
                        'Domingo' => 'Domingo',
                    ], ['class' => 'form-control']) ?>
                    <?= Html::label('Horário Início') ?>
                    <?= Html::input('time', 'DisponibilidadeHorario[horario_inicio][]', null, ['class' => 'form-control']) ?>
                    <?= Html::label('Horário Fim') ?>
                    <?= Html::input('time', 'DisponibilidadeHorario[horario_fim][]', null, ['class' => 'form-control']) ?>
                </div>
            </div>
            <button type="button" id="add-horario" class="btn btn-primary">Adicionar Horário</button>
        </div>
    </div>

    <?= $form->field($model, 'id_usuario')->dropDownList(
        ArrayHelper::map(Usuario::find()->all(), 'id', 'email'),
        ['prompt' => 'Selecione um usuário']
    ) ?>
    <?= $form->field($model, 'especialidades_ids')->checkboxList(
        ArrayHelper::map(Especialidade::find()->all(), 'id', 'nome_especialidade')
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$js = <<<JS
$('#add-horario').on('click', function() {
    var template = $('.horario-item:first').clone();
    template.find('select, input').val('');
    $('#horarios-container').append(template);
});
JS;
$this->registerJs($js);
?>
