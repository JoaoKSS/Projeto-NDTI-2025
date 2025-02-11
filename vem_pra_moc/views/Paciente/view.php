<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Paciente $model */

$this->title = $model->usuario->nome;
$this->params['breadcrumbs'][] = ['label' => 'Pacientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="paciente-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem certeza de que deseja excluir este item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Cadastrar Histórico Médico', ['historicomedico/create', 'paciente_id' => $model->id], ['class' => 'btn btn-info']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nome',
            [
                'attribute' => 'data_nascimento',
                'value' => $model->dataNascimentoBrasil,
            ],
            'sexo',
            'rua',
            'numero',
            'complemento',
            'bairro',
            'cidade',
            'estado',
            'cep',
            'telefone_primario',
            'telefone_secundario',
            'email:email',
            'cpf',
            'nome_emergencia',
            'contato_emergencia',
            [
                'attribute' => 'id_usuario',
                'value' => $model->usuario->email,
            ],
            [
                'attribute' => 'documento_cpf',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->documento_cpf ? Html::a('Ver CPF', Url::to('@web/' . $model->documento_cpf), ['target' => '_blank']) : null;
                },
            ],
            [
                'attribute' => 'documento_rg',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->documento_rg ? Html::a('Ver RG', Url::to('@web/' . $model->documento_rg), ['target' => '_blank']) : null;
                },
            ],
            [
                'attribute' => 'documento_convenio',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->documento_convenio ? Html::a('Ver Carteira de Convênio', Url::to('@web/' . $model->documento_convenio), ['target' => '_blank']) : null;
                },
            ],
        ],
    ]) ?>

</div>
