<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\GastosCajaChica */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gastos-caja-chica-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'motivo')->textInput() ?>
    
    <?=

        $form->field($model, 'fechaGasto')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Fecha de Gasto ...'],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy/mm/dd'
            ]
        ]);
    ?>
    <div class="fileUploadWrap">
        <?= $form->field($model, 'documento')->fileInput([
            'multiple' => false,
            'id' => 'file1',
            'maxFiles' => 1,
            'accept' => 'image/*',
            'class' => 'form-control',
            'onchange' => 'javascript:updateList()'
        ]); ?>



        <div class="btn btn-green">Subir evidencia de gasto</div>

    </div>
        <div id="info" class="info"></div>

    <?= $form->field($model, 'monto')->textInput() ?>

    <?= $form->field($model, 'idCajachica')->hiddenInput()->label(false) ?>





    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

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
