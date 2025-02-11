<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Doenca $model */

$this->title = 'Update Doenca: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Doencas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="doenca-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
