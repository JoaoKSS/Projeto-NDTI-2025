<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Prontuario $model */

$this->title = 'Atualizar Prontuario: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Prontuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="prontuario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
