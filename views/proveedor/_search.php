<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProveedorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proveedor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'rutProveedor') ?>

    <?= $form->field($model, 'nombreProveedor') ?>

    <?= $form->field($model, 'direccionProveedor') ?>

    <?= $form->field($model, 'giroProveedor') ?>

    <?= $form->field($model, 'telefonoProveedor') ?>

    <?php // echo $form->field($model, 'regionProveedor') ?>

    <?php // echo $form->field($model, 'comunaProveedor') ?>

    <?php // echo $form->field($model, 'correoProveedor') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
