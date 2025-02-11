<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Disponibilidadehorario $model */

$this->title = 'Update Disponibilidadehorario: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Disponibilidadehorarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="disponibilidadehorario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
