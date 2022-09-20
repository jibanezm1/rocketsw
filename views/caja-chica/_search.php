<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CajaChicaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="caja-chica-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'idCajachica') ?>

    <?= $form->field($model, 'monto') ?>

    <?= $form->field($model, 'rutUsuario') ?>

    <?= $form->field($model, 'estado') ?>

    <?= $form->field($model, 'saldo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
