<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CotizacionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cotizacion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'idcotizacion') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'totalNeto') ?>

    <?= $form->field($model, 'IVA') ?>

    <?= $form->field($model, 'Total') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <?php // echo $form->field($model, 'rutCliente') ?>

    <?php // echo $form->field($model, 'rutUsuario') ?>

    <?php // echo $form->field($model, 'mail') ?>

    <?php // echo $form->field($model, 'evento') ?>

    <?php // echo $form->field($model, 'validez') ?>

    <?php // echo $form->field($model, 'entrega') ?>

    <?php // echo $form->field($model, 'formaDePago') ?>

    <?php // echo $form->field($model, 'tipoDeMoneda') ?>

    <?php // echo $form->field($model, 'idempresa') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
