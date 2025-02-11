<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Recepcionista $model */

$this->title = 'Create Recepcionista';
$this->params['breadcrumbs'][] = ['label' => 'Recepcionistas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recepcionista-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
