<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GastosProyectoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gastos-proyecto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'idGastos') ?>

    <?= $form->field($model, 'fechaGasto') ?>

    <?= $form->field($model, 'Titulo') ?>

    <?= $form->field($model, 'motivoGasto') ?>

    <?= $form->field($model, 'rutUsuario') ?>

    <?php // echo $form->field($model, 'idProyecto') ?>

    <?php // echo $form->field($model, 'fotoGasto') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
