<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Alergia $model */

$this->title = 'Create Alergia';
$this->params['breadcrumbs'][] = ['label' => 'Alergias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alergia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
