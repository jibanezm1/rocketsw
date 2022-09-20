<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cotizacion */

$this->title = Yii::t('app', 'Cotizacion Nº: {name}', [
    'name' => $model->idcotizacion,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cotizaciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idcotizacion, 'url' => ['view', 'idcotizacion' => $model->idcotizacion, 'rutCliente' => $model->rutCliente, 'rutUsuario' => $model->rutUsuario, 'idempresa' => $model->idempresa]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Actualizar');
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

