<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ContactoCliente */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contacto-cliente-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombreCliente')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'correoCliente')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numeroCliente')->textInput(['maxlength' => true]) ?>

    <?php 
    
    if($_GET["rutCliente"]){
        echo $form->field($model, 'rutCliente')->hiddenInput(['value' => $_GET["rutCliente"]])->label(false);
    }
    
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
