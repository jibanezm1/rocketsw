<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GastosProyecto */

$this->title = Yii::t('app', 'Update Gastos Proyecto: {name}', [
    'name' => $model->idGastos,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gastos Proyectos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idGastos, 'url' => ['view', 'id' => $model->idGastos]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="gastos-proyecto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
