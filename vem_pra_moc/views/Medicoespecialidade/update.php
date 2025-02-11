<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Medicoespecialidade $model */

$this->title = 'Update Medicoespecialidade: ' . $model->medico_id;
$this->params['breadcrumbs'][] = ['label' => 'Medicoespecialidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->medico_id, 'url' => ['view', 'medico_id' => $model->medico_id, 'especialidade_id' => $model->especialidade_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="medicoespecialidade-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
