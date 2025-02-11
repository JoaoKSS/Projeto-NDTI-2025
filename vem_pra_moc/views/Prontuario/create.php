<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Prontuario $model */

$this->title = 'Criar Prontuario';
$this->params['breadcrumbs'][] = ['label' => 'Prontuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prontuario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
