<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Doenca $model */

$this->title = 'Create Doenca';
$this->params['breadcrumbs'][] = ['label' => 'Doencas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doenca-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
