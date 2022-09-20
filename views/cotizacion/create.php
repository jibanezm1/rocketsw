<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cotizacion */

$this->title = Yii::t('app', 'Crear una nueva Cotización');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cotizaciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>




<div class="panel">
    <div class="panel-heading">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="panel-body" style="margin:25px;">
        <?= $this->render('_form', [
            'model' => $model,
            'modelsAddress' => $modelsAddress,
            'cliente' => $cliente
        ]) ?>
    </div>
</div>