<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsuarioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'rutUsuario') ?>

    <?= $form->field($model, 'dv') ?>

    <?= $form->field($model, 'nombreUsuario') ?>

    <?= $form->field($model, 'apellidosUsuario') ?>

    <?= $form->field($model, 'fechaIngreso') ?>

    <?php // echo $form->field($model, 'idTipoUsuario') ?>

    <?php // echo $form->field($model, 'clave') ?>

    <?php // echo $form->field($model, 'correo') ?>

    <?php // echo $form->field($model, 'telefono') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
