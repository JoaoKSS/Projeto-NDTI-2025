<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\jui\AutoComplete;

/** @var yii\web\View $this */
/** @var app\models\Paciente $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="paciente-form">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data']]); ?>

    <div class="form-group">
        <?= $form->field($model, 'nome_completo', ['options' => ['class' => 'col-md-6']])->widget(AutoComplete::classname(), [
            'clientOptions' => [
                'source' => Url::to(['usuario/autocomplete']),
            ],
            'options' => [
                'class' => 'form-control',
                'maxlength' => 100,
            ],
        ])->label('Nome') ?>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'data_nascimento', ['options' => ['class' => 'col-md-6']])->input('date', ['class' => 'form-control'])->label('Data de Nascimento') ?>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'sexo', ['options' => ['class' => 'col-md-6']])->dropDownList(
            [
                'M' => 'Masculino',
                'F' => 'Feminino',
                'O' => 'Outro'
            ],
            ['prompt' => 'Selecione o sexo', 'class' => 'form-control']
        )->label('Sexo') ?>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'rua', ['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true, 'class' => 'form-control'])->label('Rua') ?>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'numero', ['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => 10, 'class' => 'form-control'])->label('Número') ?>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'complemento', ['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true, 'class' => 'form-control'])->label('Complemento') ?>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'bairro', ['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => 50, 'class' => 'form-control'])->label('Bairro') ?>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'estado', ['options' => ['class' => 'col-md-6']])->dropDownList(
            [
                'AC' => 'Acre',
                'AL' => 'Alagoas',
                'AP' => 'Amapá',
                'AM' => 'Amazonas',
                'BA' => 'Bahia',
                'CE' => 'Ceará',
                'DF' => 'Distrito Federal',
                'ES' => 'Espírito Santo',
                'GO' => 'Goiás',
                'MA' => 'Maranhão',
                'MT' => 'Mato Grosso',
                'MS' => 'Mato Grosso do Sul',
                'MG' => 'Minas Gerais',
                'PA' => 'Pará',
                'PB' => 'Paraíba',
                'PR' => 'Paraná',
                'PE' => 'Pernambuco',
                'PI' => 'Piauí',
                'RJ' => 'Rio de Janeiro',
                'RN' => 'Rio Grande do Norte',
                'RS' => 'Rio Grande do Sul',
                'RO' => 'Rondônia',
                'RR' => 'Roraima',
                'SC' => 'Santa Catarina',
                'SP' => 'São Paulo',
                'SE' => 'Sergipe',
                'TO' => 'Tocantins'
            ],
            ['prompt' => 'Selecione um estado', 'id' => 'estado', 'class' => 'form-control']
        )->label('Estado') ?>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'cidade', ['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => 50, 'class' => 'form-control'])->label('Cidade') ?>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'cep', ['options' => ['class' => 'col-md-6']])->widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '99999-999',
            'class' => 'form-control'
        ])->label('CEP') ?>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'telefone_primario', ['options' => ['class' => 'col-md-6']])->widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '(99) 99999-9999',
            'class' => 'form-control'
        ])->label('Telefone Primário') ?>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'telefone_secundario', ['options' => ['class' => 'col-md-6']])->widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '(99) 99999-9999',
            'class' => 'form-control'
        ])->label('Telefone Secundário') ?>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'email', ['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true, 'class' => 'form-control'])->label('Email') ?>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'cpf', ['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => 11, 'class' => 'form-control'])->label('CPF') ?>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'nome_emergencia', ['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => 100, 'class' => 'form-control'])->label('Nome de Emergência') ?>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'contato_emergencia', ['options' => ['class' => 'col-md-6']])->widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '(99) 99999-9999',
            'class' => 'form-control'
        ])->label('Contato de Emergência') ?>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'id_usuario', ['options' => ['class' => 'col-md-6']])->dropDownList(
            \yii\helpers\ArrayHelper::map(\app\models\Usuario::find()->all(), 'id', 'email'),
            ['prompt' => 'Selecione um Email de usuário', 'class' => 'form-control']
        ) ?>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'documento_cpf', ['options' => ['class' => 'col-md-6']])->fileInput(['class' => 'form-control'])->label('Documento CPF') ?>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'documento_rg', ['options' => ['class' => 'col-md-6']])->fileInput(['class' => 'form-control'])->label('Documento RG') ?>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'documento_convenio', ['options' => ['class' => 'col-md-6']])->fileInput(['class' => 'form-control'])->label('Documento Convênio') ?>
    </div>

    <div class="form-group">
        <div class="col-md-12">
            <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS
$('#estado').change(function() {
    var estado = $(this).val();
    console.log('Estado selecionado: ' + estado); // Adicionar console.log para depuração
    $.get('index.php?r=paciente/cidades', { estado: estado }, function(data) {
        console.log('Cidades recebidas: ' + data); // Adicionar console.log para depuração
        $('#cidade').html(data);
    });
});
JS;
$this->registerJs($script);
?>