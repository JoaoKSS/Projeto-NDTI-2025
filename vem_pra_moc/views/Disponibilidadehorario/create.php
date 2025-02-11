<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Disponibilidadehorario $model */

$this->title = 'Create Disponibilidadehorario';
$this->params['breadcrumbs'][] = ['label' => 'Disponibilidadehorarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disponibilidadehorario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
