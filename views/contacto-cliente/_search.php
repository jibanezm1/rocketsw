<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ContactoClienteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contacto-cliente-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'idCliente') ?>

    <?= $form->field($model, 'nombreCliente') ?>

    <?= $form->field($model, 'correoCliente') ?>

    <?= $form->field($model, 'numeroCliente') ?>

    <?= $form->field($model, 'rutCliente') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
