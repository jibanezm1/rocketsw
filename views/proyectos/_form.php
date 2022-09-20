<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Proyectos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyectos-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'nombreProyecto')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'descripcionProyecto')->textarea(['maxlength' => true]) ?>
    <?= $form->field($model, 'rutCliente')->hiddenInput()->label(false) ?>



    <div class="form-group">
        <?= Html::submitButton('Agregar nuevo Proyecto', ['class' => 'btn btn-primary']) ?>
    </div>
    <br>
    <?php ActiveForm::end(); ?>

</div>
