<?php

use app\models\Recepcionista;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\RecepcionistaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Recepcionistas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recepcionista-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar Recepcionista', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_recepcionista',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Recepcionista $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_recepcionista' => $model->id_recepcionista]);
                 }
            ],
        ],
    ]); ?>


</div>
