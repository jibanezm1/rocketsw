<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */

$this->title = Yii::t('app', 'Actualizar Cliente: {name}', [
    'name' => $model->nombreCliente,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clientes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombreCliente, 'url' => ['view', 'id' => $model->rutCliente]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Actualizar');
?>


<div class="panel">
    <div class="panel-heading">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="panel-body">
        <?= $this->render('_form', [
            'model' => $model,
            'modelsAddress' => null
        ]) ?>
    </div>
</div>