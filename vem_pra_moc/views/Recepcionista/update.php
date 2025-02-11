<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Recepcionista $model */

$this->title = 'Update Recepcionista: ' . $model->id_recepcionista;
$this->params['breadcrumbs'][] = ['label' => 'Recepcionistas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_recepcionista, 'url' => ['view', 'id_recepcionista' => $model->id_recepcionista]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="recepcionista-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
