<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

$empresa = array(
    'MC-'.$maximo => 'MC-'.$maximo,
    'SF-'.$maximo => 'SF-'.$maximo
);
/* @var $this yii\web\View */
/* @var $model app\models\Producto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-form">

<?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); // important ?>

    <div class="row">
        
        
        
        <?php if($maximo){
        ?>
        
                <div class="col-md-3"><?= $form->field($model, 'SKU')->widget(Select2::className(), [
                                'data' => $empresa ]);  ?>
                </div>
                

        <?php
        }else{
        ?>
                <div class="col-md-3"><?= $form->field($model, 'SKU')->textInput(['maxlength' => true]) ?></div>

        <?php            
        }
        ?>
        
        <div class="col-md-3"><?= $form->field($model, 'nombreProducto')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-3"><?= $form->field($model, 'stock')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-3"><?= $form->field($model, 'precioLista')->textInput(['maxlength' => true]) ?></div>
    </div>

    <div class="row">
        <div class="col-md-12"><?= $form->field($model, 'descripcionProducto')->textArea(['maxlength' => true]) ?></div>
    </div>

    <div class="row">
    <div class="col-md-6">
    <div class="fileUploadWrap">
                            <?= $form->field($modelo, 'ruta[]')->fileInput([
                                'multiple' => true,
                                'id' => 'file1',
                                'maxFiles' => 5,
                                'accept' => 'image/*',
                                'class' => 'form-control',
                                'onchange' => 'javascript:updateList()'
                                ]); ?>


                        	<div class="btn btn-green">Subir Fotos del Producto</div>
							
        </div>
        <div id="info" class="info"></div>
        </div>
        <div class="col-md-6">
        <div class="fileUploadWrap">
        <?= $form->field($modeloo, 'ruta[]')->fileInput([
                                'multiple' => true,
                                'id' => 'file2',
                                'accept' => 'image/*',
                                'maxFiles' => 5,
                                'class' => 'form-control',
                                'onchange' => 'javascript:updateList1()'
                                ]); ?>
                            <div class="btn btn-green">Subir Documentos del producto</div>
							<div class="info"></div>
        </div>
        <div id="info2" class="info"></div>
        </div>
    </div>


    
    

    

    

    

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar Producto'), ['class' => 'btn bg-purple']) ?>
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
    output.innerHTML = '<ul>'+children+'</ul>';
}

updateList1 = function() {
    console.log("clickksss");
    var input = document.getElementById('file2');
    var output = document.getElementById('info2');
    var children = "";
    for (var i = 0; i < input.files.length; ++i) {
        children += '<li>' + input.files.item(i).name + '</li>';
    }
    output.innerHTML = '<ul>'+children+'</ul>';
}
</script>