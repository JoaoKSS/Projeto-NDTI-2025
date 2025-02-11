<?php

use app\models\Medico;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\MedicoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Médicos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medico-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Cadastrar Médico', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nome_completo',
            'crm',
            'email:email',
            [
                'attribute' => 'especialidade',
                'value' => function($model) {
                    return implode(', ', \yii\helpers\ArrayHelper::getColumn($model->especialidades, 'nome_especialidade'));
                },
                'label' => 'Especialidades',
            ],
            'telefone_primario',
            'telefone_secundario',

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Medico $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
