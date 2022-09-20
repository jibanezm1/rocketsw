<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OrdenIngreso */

$this->title = ' Actualizar la Orden Ingreso: ' . $model->idordenIngreso;
$this->params['breadcrumbs'][] = ['label' => 'Orden Ingresos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idordenIngreso, 'url' => ['view', 'idordenIngreso' => $model->idordenIngreso, 'rutProveedor' => $model->rutProveedor]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="panel">
    <div class="panel-heading">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="panel-body" style="padding:10px;">
        <?= $this->render('_form', [
            'model' => $model,
            'modelsAddress' => $modelsAddress,
            'cliente' => $cliente
        ]) ?>
    </div>
</div>
