<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CajaChica */

$this->title = 'Update Caja Chica: ' . $model->idCajachica;
$this->params['breadcrumbs'][] = ['label' => 'Caja Chicas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idCajachica, 'url' => ['view', 'id' => $model->idCajachica]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="panel">
    <div class="panel-heading">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="panel-body">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>