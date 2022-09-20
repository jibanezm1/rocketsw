<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Proveedor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proveedor-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4">
            <?php
            
            if($model->isNewRecord){
                echo $form->field($model, 'rutProveedor')->textInput();
            }else{
               echo  $form->field($model, 'rutProveedor')->textInput([
                    'readonly' => true,
                ]);
            }
            
             ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'nombreProveedor')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'direccionProveedor')->textInput(['maxlength' => true]) ?>
        </div>

    </div>

    <div class="row">
        <div class="col-md-4">


            <?= $form->field($model, "regionProveedor")->widget(Select2::className(), [
                'data' => ArrayHelper::map(app\models\Region::find()->orderBy(['idregion' => SORT_ASC])->all(), 'idregion', 'nombreRegion'),
                'options' => [
                    'onchange' => '$.post("' . Yii::$app->urlManager->createUrl(["site/comunas?id="]) . '"+$(this).val(), function( data ) {
                        $("#proveedor-comunaproveedor").html( data );
                    })'
                ]

            ]); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, "comunaProveedor")->widget(Select2::className(), [
                'data' => ArrayHelper::map(app\models\Comunas::find()->orderBy(['id' => SORT_ASC])->all(), 'id', 'comuna')
            ]); ?>

        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'contacto')->textInput(['maxlength' => true]) ?>

        </div>

    </div>


    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'giroProveedor')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'telefonoProveedor')->textInput(['maxlength' => true]) ?>

        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'correoProveedor')->textInput(['maxlength' => true]) ?>
        </div>

    </div>









    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>