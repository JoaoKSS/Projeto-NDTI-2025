<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Administrador $model */

$this->title = 'Update Administrador: ' . $model->id_administrador;
$this->params['breadcrumbs'][] = ['label' => 'Administradors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_administrador, 'url' => ['view', 'id_administrador' => $model->id_administrador]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="administrador-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
