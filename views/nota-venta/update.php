<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\NotaVenta */

$this->title = 'Actualizar datos de la Venta Nº: ' . $model->idNotaVenta;
$this->params['breadcrumbs'][] = ['label' => 'Nota Ventas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idNotaVenta, 'url' => ['view', 'idNotaVenta' => $model->idNotaVenta, 'rutCliente' => $model->rutCliente, 'rutUsuario' => $model->rutUsuario, 'idempresa' => $model->idempresa]];
$this->params['breadcrumbs'][] = 'Actualizar datos de Venta';
?>


<div class="panel">
    <div class="panel-heading">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="panel-body" style="padding:10px;">
    <?= $this->render('_form', [
            'model' => $model,
            'modelsAddress' => $modelsAddress,
            'cliente' => $cliente,
        ]);
        ?>
    </div>
</div>