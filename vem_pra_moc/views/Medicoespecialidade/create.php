<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Medicoespecialidade $model */

$this->title = 'Create Medicoespecialidade';
$this->params['breadcrumbs'][] = ['label' => 'Medicoespecialidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medicoespecialidade-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
