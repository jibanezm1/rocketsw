<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GastosCajaChicaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gastos-caja-chica-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_gastoCajaChica') ?>

    <?= $form->field($model, 'documento') ?>

    <?= $form->field($model, 'idCajachica') ?>

    <?= $form->field($model, 'monto') ?>

    <?= $form->field($model, 'fechaGasto') ?>

    <?php // echo $form->field($model, 'idProyecto') ?>

    <?php // echo $form->field($model, 'idGasto') ?>

    <?php // echo $form->field($model, 'motivo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
