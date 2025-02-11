<?php

use app\models\Medicoespecialidade;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\MedicoespecialidadeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Médico Especialidades';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medicoespecialidade-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar Médico Especialidade', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'medico_id',
            'especialidade_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Medicoespecialidade $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'medico_id' => $model->medico_id, 'especialidade_id' => $model->especialidade_id]);
                 }
            ],
        ],
    ]); ?>


</div>
