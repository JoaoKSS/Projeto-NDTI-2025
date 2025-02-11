<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Medico $model */

$this->title = $model->nome_completo;
$this->params['breadcrumbs'][] = ['label' => 'Medicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="medico-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem certeza de que deseja excluir este médico?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nome_completo',
            'crm',
            'telefone_primario',
            'telefone_secundario',
            'email:email',
            // 'id_usuario', // Campo oculto
            [
                'label' => 'Especialidades',
                'value' => implode(', ', array_map(function($especialidade) {
                    return $especialidade->especialidade->nome_especialidade;
                }, $model->medicoespecialidades)),
            ],
            [
                'label' => 'Disponibilidade de Horários',
                'value' => implode(', ', array_map(function($disponibilidade) {
                    return $disponibilidade->dia_da_semana . ' das ' . $disponibilidade->horario_inicio . ' às ' . $disponibilidade->horario_fim;
                }, $model->disponibilidadeHorarios)),
            ],
        ],
    ]) ?>

</div>
