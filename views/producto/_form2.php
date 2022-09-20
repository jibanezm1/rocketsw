<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerCssFile("../web/nifty/plugins/unitegallery/css/unitegallery.min.css");
$this->registerJsFile("../web/nifty/plugins/unitegallery/js/unitegallery.min.js");
$this->registerJsFile("../web/nifty/plugins/unitegallery/themes/tilesgrid/ug-theme-tilesgrid.js");



/* @var $this yii\web\View */
/* @var $model app\models\Producto */
/* @var $form yii\widgets\ActiveForm */
?>






<div class="producto-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); // important 
    ?>

    <div class="row">
        <div class="col-md-6">
            <div class="col-md-6"><?= $form->field($model, 'SKU')->textInput(['maxlength' => true]) ?></div>
            <div class="col-md-6"><?= $form->field($model, 'nombreProducto')->textInput(['maxlength' => true]) ?></div>
            <div class="col-md-6"><?= $form->field($model, 'stock')->textInput(['maxlength' => true]) ?></div>
            <div class="col-md-6"><?php


                                    $session = Yii::$app->session;
                                    $session->open();
                                    $user_id = $session->get('usuario');

                                    if ($user_id->idTipoUsuario0->idTipoUsuario == 1) {
                                        echo $form->field($model, 'precioLista')->textInput(['maxlength' => true]);
                                    } else {
                                        echo $form->field($model, 'precioLista')->textInput(['maxlength' => true, 'readonly' => true]);
                                    }
                                    ?></div>
            <div class="col-md-12"><?= $form->field($model, 'descripcionProducto')->textArea(['maxlength' => true]) ?></div>
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

        <div class="col-md-6">
            <div class="box rte">

                <h4>Listado de Documentos del producto</h4>
                <ul class="content-list">
                    <?php foreach ($documentos as $documento) {
                    ?>
                        <li><?php echo $documento->descripcionArchivo; ?>
                            <?= Html::a(Yii::t('app', 'Eliminar'), ['eliminardocumento', 'id' => $documento->idproductoDocumentos, 'id2' => $model->idproducto], [

                                'data' => [
                                    'confirm' => Yii::t('app', 'Seguro que desea eliminar este producto	?'),
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </li>

                    <?php
                    } ?>

                </ul>

                <hr>
            </div>
        </div>


    </div>

    <div class="panel">
        <div class="pad-all">
            <div id="demo-gallery">


                <?php
                $indice = 1;
                foreach ($fotosProductos as $f) {
                ?>
                    <a href="../web/<?php echo $f->ruta; ?>">
                        <img alt="The winding road" src="../web/<?php echo $f->ruta; ?>" data-image="../web/<?php echo $f->ruta; ?>" data-description="The winding road description" style="display:none">
                    </a>

                <?php
                } ?>


            </div>
        </div>
    </div>




    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar Producto'), ['class' => 'btn bg-purple']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    jQuery(document).on('nifty.ready', function() {


        jQuery("#demo-gallery").unitegallery({
            tile_enable_shadow: false
        });


    });
    updateList = function() {
        var input = document.getElementById('file1');
        var output = document.getElementById('info');
        var children = "";
        for (var i = 0; i < input.files.length; ++i) {
            children += '<li>' + input.files.item(i).name + '</li>';
        }
        output.innerHTML = '<ul>' + children + '</ul>';
    }

    updateList1 = function() {
        console.log("clickksss");
        var input = document.getElementById('file2');
        var output = document.getElementById('info2');
        var children = "";
        for (var i = 0; i < input.files.length; ++i) {
            children += '<li>' + input.files.item(i).name + '</li>';
        }
        output.innerHTML = '<ul>' + children + '</ul>';
    }
</script>