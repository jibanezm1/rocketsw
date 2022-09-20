<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\OrdenIngreso */
/* @var $form yii\widgets\ActiveForm */

$data = array(
    "Pago al contado" =>  "Pago al contado",
    "Pago a 30 Dias" =>  "Pago a 30 Dias",
    "Todo a 60 Dias" => "Pago a 60 Dias",
    "Todo a 90 Dias" => "Pago a 90 Dias",
    "Todo a 120 dias" => "Pago a 120 dias",
    "Otra (se detalla en la observacion)" => "Otra (se detalla en la observacion)",
);
$medio = array(
    "Transferencia" =>  "Transferencia",
    "Cheque" =>  "Cheque",
    "Deposito" =>  "Deposito",
    "Efectivo" =>  "Efectivo",
    "Otro" =>  "Otro",

);
// Contado, transferencia, 30 días, 60 días , 90 días, otra
?>

<div class="orden-ingreso-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, "rutProveedor")->widget(Select2::className(), [
                'data' => ArrayHelper::map(app\models\Proveedor::find()->all(), 'rutProveedor', function ($model) {
                    return $model->nombreProveedor;
                }),
            ])->label('Proveedor'); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'forma')->widget(Select2::className(), ['data' => $data]); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'medio')->widget(Select2::className(), ['data' => $medio]); ?>

        </div>

    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'terminos')->textArea(['maxlength' => true]) ?>
            <?= $form->field($model, 'idProyecto')->hiddenInput()->label(false) ?>

        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'observaciones')->textArea(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'pago')->textArea(['maxlength' => true]) ?>
        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-body">
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 30, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsAddress[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'iddetalleordeningreso',
                    'idproducto',
                    'cantidad',
                    'precio',
                ],
            ]); ?>

            <div class="container-items">
                <!-- widgetContainer -->
                <?php
                $a = 0;
                foreach ($modelsAddress as $i => $modelAddress) : ?>
                    <div class="panel-heading">

                        <div class="clearfix"></div>
                        <?php if ($i == 0) {
                        ?>
                            <div class="row">
                                <div style="text-align: center;" class="col-sm-3">
                                    <p>Producto</p>
                                </div>

                                <div style="text-align: center;" class="col-sm-2">
                                    <p>Cantidad</p>
                                </div>
                                <div style="text-align: center;" class="col-sm-2">
                                    <p>Valor $</p>
                                </div>

                                <div style="text-align: center;" class="col-sm-2">
                                    <p>Total</p>
                                </div>

                                <div style="text-align: center;" class="col-sm-1">
                                    <p>Acciones</p>
                                </div>
                            </div>
                        <?php
                        } ?>
                    </div>
                    <br>
                    <div class="item panel panel-default">
                        <!-- widgetBody -->

                        <div class="panel-body">
                            <?php
                            // necessary for update action.
                            if (!$modelAddress->isNewRecord) {
                                echo Html::activeHiddenInput($modelAddress, "[{$i}]iddetalleordeningreso");
                            }
                            ?>


                            <div class="row">
                                <div style="text-align: center;" class="col-sm-3">
                                    <?= $form->field($modelAddress, "[{$i}]idproducto")->widget(Select2::className(), [
                                        'data' => ArrayHelper::map(app\models\Producto::find()->all(), 'idproducto', function ($model) {
                                            return $model->nombreProducto . "(Precio Lista:" . $model->precioLista . ")";
                                        }),
                                    ])->label(false); ?>
                                </div>

                                <div style="text-align: center;" class="col-sm-2">
                                    <?= $form->field($modelAddress, "[{$i}]cantidad")->textInput(['maxlength' => true])->label(false) ?>
                                </div>
                                <div style="text-align: center;" class="col-sm-2">
                                    <?= $form->field($modelAddress, "[{$i}]precio")->textInput([
                                        'maxlength' => true,
                                        'onChange' => "calculador(this.id)"
                                    ])->label(false) ?>
                                </div>

                                <div style="text-align: center;" class="col-sm-2">
                                    <?= $form->field($modelAddress, "[{$i}]total")->textInput([
                                        'maxlength' => true,
                                        'tag' => 'totales'
                                    ])->label(false) ?>
                                </div>
                                <div style="text-align: center; display:none;">
                                    <?= $form->field($modelAddress, "[{$i}]iva")->textInput([
                                        'maxlength' => true,
                                    ])->label(false) ?>
                                </div>


                                <div class="col-sm-1">
                                    <div style="text-align: center;">
                                        <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                        <button onclick="calculador2()" type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                    </div>
                                </div>
                            </div><!-- .row -->
                        
                    </div>
                <?php $a++;
                endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="pull-right">
        <div class="col-md-4">
            <?= $form->field($model, 'totalNeto')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'IVA')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'Total')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
</div>

<div class="form-group">
    <?= Html::submitButton($modelAddress->isNewRecord ? 'Crear Nueva OC' : 'Actualizar OC', ['class' => 'btn btn-primary']) ?>
</div>


<?php ActiveForm::end(); ?>

</div>
<script>
    function calculador(id) {
        var res = id.split("-");


        var my_input1 = document.getElementById('detalleordeningreso-' + res[1] + '-cantidad').value;
        var my_input2 = document.getElementById('detalleordeningreso-' + res[1] + '-precio').value;
        var sum = parseInt(my_input1) * parseInt(my_input2);
        document.getElementById('detalleordeningreso-' + res[1] + '-total').value = sum.toFixed(0);
        var resultado = parseInt(sum) * 0.19;
        document.getElementById('detalleordeningreso-' + res[1] + '-iva').value = resultado.toFixed(0);



        var precio = 0;
        $('input[name$="[total]"]').each(function() {
            precio += 1 * ($(this).val());
        });
        document.getElementById('ordeningreso-totalneto').value = precio.toFixed(0);



        var iva = 0;
        $('input[name$="[iva]"]').each(function() {
            iva += 1 * ($(this).val());
        });
        document.getElementById('ordeningreso-iva').value = iva.toFixed(0);

        var suma = 0;
        $('input[name$="[total]"]').each(function() {
            suma += 1 * ($(this).val());
        });
        document.getElementById('ordeningreso-total').value = parseInt(suma.toFixed(0)) + parseInt(iva.toFixed(0));
        console.log(suma);

    }




    function calculador2() {


        Swal.fire({
            title: 'Precaución',
            text: "Seguro que desea Eliminar la fila?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar la fila!'
        }).then((result) => {




            var precio = 0;
            $('input[name$="[total]"]').each(function() {
                precio += 1 * ($(this).val());
            });
            document.getElementById('ordeningreso-totalneto').value = precio.toFixed(0);



            var iva = 0;
            $('input[name$="[iva]"]').each(function() {
                iva += 1 * ($(this).val());
            });
            document.getElementById('ordeningreso-iva').value = iva.toFixed(0);

            var suma = 0;
            $('input[name$="[total]"]').each(function() {
                suma += 1 * ($(this).val());
            });
            document.getElementById('ordeningreso-total').value = parseInt(suma.toFixed(0)) + parseInt(iva.toFixed(0));


            if (result.value) {
                Swal.fire(
                    'Eliminada!',
                    'Su fila ha sido eliminada.',
                    'success'
                );
            }
        })









    }
</script>