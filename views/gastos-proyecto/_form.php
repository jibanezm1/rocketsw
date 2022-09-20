<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

$age = array(
    1 => 'Transferencia',
    2 => 'Efectivo',
    3 => 'Cheque',
);

$age1 = array(
    1 => 'Factura',
    2 => 'Boleta',
    3 => 'Otro',
);
/* @var $this yii\web\View */
/* @var $model app\models\GastosProyecto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gastos-proyecto-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'Titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'motivoGasto')->textInput(['maxlength' => true]) ?>
    <?=

        $form->field($model, 'fechaGasto')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Fecha de Gasto ...'],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy/mm/dd'
            ]
        ]);
    ?>
    <?= $form->field($model, 'monto')->textInput(['maxlength' => true]) ?>

    <?php
    echo $form->field($model, 'tipoDocumento')->widget(Select2::className(), [
        'data' => $age
    ]);

    ?>

    <?php
    echo $form->field($model, 'tipoRecibo')->widget(Select2::className(), [
        'data' => $age1
    ]);

    ?>
    <div class="fileUploadWrap">
        <?= $form->field($model, 'fotoGasto')->fileInput([
            'multiple' => false,
            'id' => 'file1',
            'maxFiles' => 1,
            'accept' => '*',
            'class' => 'form-control',
            'onchange' => 'javascript:updateList()'
        ]); ?>


        <div class="btn btn-green">Subir evidencia de gasto</div>

    </div>
    <div id="info" class="info"></div>
    <?= $form->field($model, 'rutUsuario')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'idProyecto')->hiddenInput()->label(false) ?>
    
    <div class="form-group checkboxes">
							<label>
								<input name="cajachica" type="checkbox">
								<span>Rendir en caja chica?</span>
							</label>
						</div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar Gasto'), ['class' => 'btn bg-indigo']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <br>
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