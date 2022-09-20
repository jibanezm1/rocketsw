<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\PagoVenta */
/* @var $form yii\widgets\ActiveForm */
$age = array(
    1 => 'Cheque o ValeVista',
    2 => 'Transferencia',
    3 => 'Factoring'
);
?>

<div class="pago-venta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idNotaVenta')->hiddenInput()->label(false) ?>


     <?= $form->field($model, 'forma')->widget(Select2::className(), [

                'data' => $age
            ]);  ?>

    <?=

        $form->field($model, 'fecha')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Fecha de Gasto ...'],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy/mm/dd'
            ]
        ]);
    ?>
    
    <?php  echo $form->field($model, 'idbanco')->widget(Select2::className(), [

                    'data' =>
                    ArrayHelper::map(app\models\Banco::find()->all(), 'idbanco', 'nombreBanco')
                ])->label("Banco"); ?>

    <?= $form->field($model, 'factorizada')->checkBox(['label' => 'Factorizada ?','data-size'=>'small', 'class'=>'bs_switch','style'=>'margin-bottom:4px;', 'id'=>'active']) ?>

    <?php  echo $form->field($model, 'idFactoring')->widget(Select2::className(), [
                    'data' =>
                    ArrayHelper::map(app\models\Factoring::find()->all(), 'idFactoring', 'nombreFactoring')
                ])->label("Factoring"); ?>
    <?= $form->field($model, 'porcentajePago')->textInput()->label("Porcentaje de pago 0 - 100") ?>
        <div class="fileUploadWrap">
        <?= $form->field($model, 'imagen')->fileInput([
            'multiple' => false,
            'id' => 'file1',
            'maxFiles' => 1,
            'accept' => '*',
            'class' => 'form-control',
            'onchange' => 'javascript:updateList()'
        ]); ?>


        <div class="btn btn-green">Subir evidencia de gasto</div>
            <div id="info" class="info"></div>

        </div>
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<br><br>
</div>
<script>
    updateList = function() {
        var input = document.getElementById('file1');
        var output = document.getElementById('info');
        var children = "";
        for (var i = 0; i < input.files.length; ++i) {
            children += '<li>' + input.files.item(i).name + '</li>';
        }
        output.innerHTML = '<ul>' + children + '</ul>';
    }
</script>
