<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Medicoespecialidade $model */

$this->title = $model->medico_id;
$this->params['breadcrumbs'][] = ['label' => 'Medicoespecialidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="medicoespecialidade-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'medico_id' => $model->medico_id, 'especialidade_id' => $model->especialidade_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'medico_id' => $model->medico_id, 'especialidade_id' => $model->especialidade_id], [
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
            'medico_id',
            'especialidade_id',
        ],
    ]) ?>

</div>
