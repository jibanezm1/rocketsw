<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BancoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banco-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'idbanco') ?>

    <?= $form->field($model, 'nombreBanco') ?>

    <?= $form->field($model, 'tipoCTA') ?>

    <?= $form->field($model, 'nombreEjecutivo') ?>

    <?= $form->field($model, 'direccionEjecutivo') ?>

    <?php // echo $form->field($model, 'correoEjecutivo') ?>

    <?php // echo $form->field($model, 'telefonoEjecutivo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
