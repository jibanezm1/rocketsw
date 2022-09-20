<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OrdenIngreso */

$this->title = 'Crear OC';
$this->params['breadcrumbs'][] = ['label' => 'Ordenes de compra', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="panel">
    <div class="panel-heading">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="panel-body" style="padding:10px;">
    <?= $this->render('_form', [
        'model' => $model,
        'modelsAddress' => $modelsAddress,
    ]) ?>
    </div>
</div>

