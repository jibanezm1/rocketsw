<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */

$this->title = Yii::t('app', 'Actualizar Producto: {name}', [
    'name' => $model->nombreProducto,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Productos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombreProducto, 'url' => ['view', 'id' => $model->idproducto]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Actualizar');
?>


<div class="panel">
    <div class="panel-heading">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="panel-body">
    <?= $this->render('_form2', [
        'model' => $model,
        'fotosProductos' => $fotosProductos,
        'documentos' => $documentos,
        'modelo' => $modelo,
        'modeloo' => $modeloo,
    ]) ?>
    </div>
</div>