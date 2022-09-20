<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ClienteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cliente-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'rutCliente') ?>

    <?= $form->field($model, 'nombreCliente') ?>

    <?= $form->field($model, 'direccionCliente') ?>

    <?= $form->field($model, 'giroCliente') ?>

    <?= $form->field($model, 'telefonoCliente') ?>

    <?php // echo $form->field($model, 'regionCliente') ?>

    <?php // echo $form->field($model, 'comunaCliente') ?>

    <?php // echo $form->field($model, 'correoCliente') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
