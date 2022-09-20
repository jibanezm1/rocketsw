<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PagoVentaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pago-venta-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idPago') ?>

    <?= $form->field($model, 'idNotaVenta') ?>

    <?= $form->field($model, 'forma') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'idbanco') ?>

    <?php // echo $form->field($model, 'factorizada') ?>

    <?php // echo $form->field($model, 'nombreFactorin') ?>

    <?php // echo $form->field($model, 'porcentajePago') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
