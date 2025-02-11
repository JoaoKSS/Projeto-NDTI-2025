<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Historicomedico $model */

$this->title = 'create Histórico Médico';
$this->params['breadcrumbs'][] = ['label' => 'Historicomedicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="historicomedico-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
