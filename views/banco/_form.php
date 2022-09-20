<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Banco */
/* @var $form yii\widgets\ActiveForm */
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

$age = array(
    1 => 'Cta Corriente',
    2 => 'Chequera electronica',
    3 => 'otra',
);
?>


<div class="box taskCard">
    <div class="rte">
    <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-md-6"><?= $form->field($model, 'nombreBanco')->textInput() ?></div>
            <div class="col-md-6">  <?php
                echo $form->field($model, 'tipoCTA')->widget(Select2::className(), [
                    'data' => $age
                ]);
            
                ?></div>
          
        </div>
    
        <div class="row">
            <div class="col-md-6"><?= $form->field($model, 'nombreEjecutivo')->textInput() ?></div>
            <div class="col-md-6"><?= $form->field($model, 'direccionEjecutivo')->textInput() ?></div>
        </div>
    
        <div class="row">
            <div class="col-md-6"><?= $form->field($model, 'correoEjecutivo')->textInput() ?></div>
            <div class="col-md-6"><?= $form->field($model, 'telefonoEjecutivo')->textInput() ?></div>
        </div>
 

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>
</div>
