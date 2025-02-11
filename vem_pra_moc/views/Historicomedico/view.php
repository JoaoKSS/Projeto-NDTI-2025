<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Historicomedico $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Historicomedicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="historicomedico-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Atualizar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem certeza de que deseja excluir este item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'historico_cirurgias:ntext',
            'paciente_id',
            [
                'label' => 'Alergias',
                'value' => function($model) {
                    $alergias = $model->alergias ?: [];
                    return implode(', ', array_map(function($alergia) {
                        return $alergia->descricao;
                    }, $alergias));
                },
            ],
            [
                'label' => 'Doenças',
                'value' => function($model) {
                    $doencas = $model->doencas ?: [];
                    return implode(', ', array_map(function($doenca) {
                        return $doenca->descricao;
                    }, $doencas));
                },
            ],
            [
                'label' => 'Medicamentos',
                'value' => function($model) {
                    $medicamentos = $model->medicamentos ?: [];
                    return implode(', ', array_map(function($medicamento) {
                        return $medicamento->nome_medicamento;
                    }, $medicamentos));
                },
            ],
        ],
    ]) ?>

</div>
