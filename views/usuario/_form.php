<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
$age = array("1"=>"Administrador", "2"=>"Cotizador", "3" => "Cliente");

?>

<div class="usuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
    
    <div class="col-md-4">
    <?= $form->field($model, 'rutUsuario')->textInput() ?>
    </div>

    <div class="col-md-2">
    <?= $form->field($model, 'dv')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-3">
    <?= $form->field($model, 'nombreUsuario')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-3">
    <?= $form->field($model, 'apellidosUsuario')->textInput(['maxlength' => true]) ?>
    </div>
    
    </div>
    <div class="row">

    <div class="col-md-3">

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

    </div>
    <div class="col-md-3">
    <?= $form->field($model, 'clave')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-3">
    <?= $form->field($model, 'correo')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-3">
    <?= $form->field($model, 'idTipoUsuario')->widget(Select2::className(), [
    'data' => $age  ]);?>   
    </div>

    </div>



    <div class="form-group">
        <?= Html::submitButton('Crear nuevo Usuario', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
