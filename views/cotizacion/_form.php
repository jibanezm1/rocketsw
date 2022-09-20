<?php

use app\models\Cliente;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\typeahead\TypeaheadBasic;
use kartik\typeahead\Typeahead;

/* @var $this yii\web\View */
/* @var $model app\models\Cotizacion */
/* @var $form yii\widgets\ActiveForm */

$age = array(
    1 => 'Pendiente',
    2 => 'Vencida',
    3 => 'Sin respuesta',
);


$entrega = array(
    'Inmediata' => 'Inmediata',
    '5 dias' => '5 dias',
    '15 a 20 dias' => '15 a 20 dias',
    '30 dias' => '30 dias',
    '60 dias' => '60 dias',
    '90 dias' => '90 dias',
    '120 dias' => '120 dias',
    'Otros' => 'Otros'

);

$validez = array(

    '5 dias' => '5 dias',
    '10 dias' => '10 dias',
    '15 dias' => '15 dias',
    'Otros' => 'Otros'

);

$pago = array(
    'Contado / transferencia' => 'Contado / transferencia',
    '30 dias' => '30 dias',
    '60 dias' => '60 dias',
    '90 dias' => '90 dias',
    '120 dias' => '120 dias'
);

$moneda = array(
    'Peso CLP' => 'Peso CLP',
    '$' => '$'
);

$flete = array(
    'Flete incluido' => 'Flete incluido',
    'Costo por cargo de cliente' => 'Costo por cargo de cliente'
);
?>

<div class="cotizacion-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    <div class="row">
        <?php
        // necessary for update action.
        if (!$model->isNewRecord) {
        ?>

            <div class="alert alert-success alert-dismissible" role="alert">
                <strong>Cambio de estados</strong> - Segun el curso de la Cotizacion realice los cambios.
            </div>


        <?php
            echo $form->field($model, 'estado')->widget(Select2::className(), [
                'data' => $age
            ]);
        }
        ?>
    </div>

    <div class="row">
        <div class="row">
            <div class="col-md-3">

                <?= $form->field($cliente, 'rutCliente')->widget(Select2::className(), [
                    'theme' => Select2::THEME_MATERIAL,
                    'data' => ArrayHelper::map(app\models\Cliente::find()->orderBy(['nombreCliente' => SORT_ASC])->all(), 'rutCliente', 'nombreCliente'),
                    'options' => [
                        'placeholder' => 'Buscar cliente ...',
                        'onChange' => "buscador(this)"
                    ]
                ]); ?>


            </div>
            <div class="col-md-3"><?= $form->field($cliente, 'nombreCliente')->textInput(['maxlength' => true]) ?></div>
            <div class="col-md-3"><?= $form->field($cliente, 'direccionCliente')->textInput(['maxlength' => true]) ?></div>
            <div class="col-md-3"><?= $form->field($cliente, 'giroCliente')->textInput(['maxlength' => true]) ?></div>
        </div>

        <div class="row">
            <div class="col-md-3"><?= $form->field($cliente, 'telefonoCliente')->textInput() ?></div>

            <div class="col-md-3"><?= $form->field($cliente, 'telefonoCliente')->textInput() ?></div>
            <div class="col-md-3">
                <?= $form->field($cliente, "regionCliente")->widget(Select2::className(), [
                    'data' => ArrayHelper::map(app\models\Region::find()->orderBy(['idregion' => SORT_ASC])->all(), 'idregion', 'nombreRegion'),
                    'options' => [
                        'onchange' => '$.post("' . Yii::$app->urlManager->createUrl(["site/comunas?id="]) . '"+$(this).val(), function( data ) {
                        $("#cliente-comunacliente").html( data );
                    })'
                    ]

                ]); ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($cliente, "comunaCliente")->widget(Select2::className(), [
                    'data' => ArrayHelper::map(app\models\Comunas::find()->orderBy(['id' => SORT_ASC])->all(), 'id', 'comuna')
                ]); ?>

            </div>

            <div class="col-md-3">

                <?php

                echo $form->field($model, 'rutContacto')->widget(Select2::className(), [
                    'theme' => Select2::THEME_MATERIAL,

                    'data' =>
                    ArrayHelper::map(app\models\ContactoCliente::find()
                        ->where(["rutCliente" => $cliente->rutCliente])
                        ->all(), 'idCliente', 'nombreCliente')
                ]);
                // necessary for update action.

                ?>




            </div>
        </div>
    </div>

    <div class="row">



        <div class="col-md-12">
            <?= $form->field($model, 'evento')->textInput(['maxlength' => true]) ?>
            <?php echo Html::hiddenInput('idCotizacion', $model->idcotizacion); ?>
            <?= $form->field($model, 'idProyecto')->hiddenInput()->label(false) ?>

        </div>

    </div>

    <div class="row">
        <div class="col-md-3">

            <?= $form->field($model, 'validez')->widget(Select2::className(), [
                'theme' => Select2::THEME_MATERIAL,
                'data' => $validez
            ]);  ?>

        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'entrega')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'formaDePago')->widget(Select2::className(), [
                'theme' => Select2::THEME_MATERIAL,
                'data' => $pago
            ]);  ?>

        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'tipoDeMoneda')->widget(Select2::className(), [
                'theme' => Select2::THEME_MATERIAL,
                'data' => $moneda
            ]);  ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'flete')->widget(Select2::className(), [
                'data' => $flete
            ]);  ?>

        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'comentarios')->textArea(['maxlength' => true]) ?>


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
                    'iddetalleCotizacion',
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
                                    <p>Tiempo de Entrega</p>
                                </div>
                                <div style="text-align: center;" class="col-sm-2">
                                    <p>Cantidad</p>
                                </div>
                                <div style="text-align: center;" class="col-sm-2">
                                    <p>Precio Neto</p>
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
                                echo Html::activeHiddenInput($modelAddress, "[{$i}]iddetalleCotizacion");
                            }
                            ?>


                            <div class="row">
                                <div style="text-align: center;" class="col-sm-3">
                                    <?= $form->field($modelAddress, "[{$i}]idproducto")->widget(Select2::className(), [
                                        'data' => ArrayHelper::map(app\models\Producto::find()->orderBy(['nombreProducto' => SORT_ASC])->all(), 'idproducto', function ($model) {
                                            return $model->nombreProducto . "(P:$" . $model->precioLista . " INV:" . $model->stock . ")";
                                        }),
                                    ])->label(false); ?>
                                </div>
                                <div style="text-align: center;" class="col-sm-2">

                                    <?= $form->field($modelAddress, "[{$i}]tiempo")->widget(Select2::className(), [
                                        'data' => $entrega
                                    ])->label(false);  ?>

                                </div>
                                <div style="text-align: center;" class="col-sm-2">
                                    <?= $form->field($modelAddress, "[{$i}]cantidad")->textInput([
                                        'maxlength' => true,
                                        'onChange' => "calculador(this.id)"
                                    ])->label(false) ?>
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
                    </div>
                <?php $a++;
                endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
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
    <?= Html::submitButton($modelAddress->isNewRecord ? 'Crear nueva Cotización' : 'Actualizar la Cotización', ['class' => 'btn btn-primary']) ?>
</div>


<?php ActiveForm::end(); ?>


</div>
<script>
    function format(input) {
        var num = input.value.replace(/\./g, '');
        if (!isNaN(num)) {
            num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g, '$1.');
            num = num.split('').reverse().join('').replace(/^[\.]/, '');
            input.value = num;
        } else {
            alert('Solo se permiten numeros');
            input.value = input.value.replace(/[^\d\.]*/g, '');
        }
    }

    function cleanChar(str, char) {
        console.log('cleanChar()'); // HACK: trace
        while (true) {
            var result_1 = str.replace(char, '');
            if (result_1 === str) {
                break;
            }
            str = result_1;
        }
        return str;
    }

    function calculador(id) {
        var res = id.split("-");


        var my_input1 = document.getElementById('detallecotizacion-' + res[1] + '-cantidad').value;
        var my_input2 = document.getElementById('detallecotizacion-' + res[1] + '-precio').value;
        var valor = cleanChar(my_input2, '.');

        console.log(valor);


        var sum = parseFloat(my_input1) * parseFloat(valor);
        document.getElementById('detallecotizacion-' + res[1] + '-total').value = sum.toFixed(0);
        var resultado = parseInt(sum) * 0.19;
        document.getElementById('detallecotizacion-' + res[1] + '-iva').value = resultado.toFixed(0);



        var precio = 0;
        $('input[name$="[total]"]').each(function() {
            precio += 1 * ($(this).val());
        });
        document.getElementById('cotizacion-totalneto').value = precio.toFixed(0);



        var iva = 0;
        $('input[name$="[iva]"]').each(function() {
            iva += 1 * ($(this).val());
        });
        document.getElementById('cotizacion-iva').value = iva.toFixed(0);

        var suma = 0;
        $('input[name$="[total]"]').each(function() {
            suma += 1 * ($(this).val());
        });
        document.getElementById('cotizacion-total').value = parseInt(suma.toFixed(0)) + parseInt(iva.toFixed(0));

    }

    function buscador() {
        var variable = $('#cliente-rutcliente').val();

        $.get('../cotizacion/listar', {
            id: variable
        }, function(data) {
            console.log(data);
            $("select#cotizacion-rutcontacto").html(data);
        });


        $.post('../cliente/buscador', {
                rut: variable
            },
            function(returnedData) {

                if (returnedData) {

                    Swal.fire({
                        title: 'Espera',
                        html: 'Estamos Cargando al <b></b> Cliente.',
                        timerProgressBar: true,
                        timer: 1500
                    });


                    var obj = JSON.parse(returnedData);

                    document.getElementById("cliente-nombrecliente").value = obj.nombreCliente;
                    document.getElementById("cliente-direccioncliente").value = obj.direccionCliente;
                    document.getElementById("cliente-girocliente").value = obj.giroCliente;
                    document.getElementById("cliente-telefonocliente").value = obj.telefonoCliente;

                    $('#regiones').val(obj.regionCliente);
                    $('#regiones').select2().trigger('change');

                    $('#comunas').val(obj.comunaCliente);
                    $('#comunas').select2().trigger('change');


                    Swal.close();

                } else {

                    Swal.fire({
                        title: 'Alerta',
                        text: "Cliente No existe",
                        icon: 'warning'
                    })

                }
            });

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
            document.getElementById('cotizacion-totalneto').value = precio.toFixed(0);



            var iva = 0;
            $('input[name$="[iva]"]').each(function() {
                iva += 1 * ($(this).val());
            });
            document.getElementById('cotizacion-iva').value = iva.toFixed(0);

            var suma = 0;
            $('input[name$="[total]"]').each(function() {
                suma += 1 * ($(this).val());
            });
            document.getElementById('cotizacion-total').value = parseInt(suma.toFixed(0)) + parseInt(iva.toFixed(0));


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


<style>
    .panel-body {
        padding: 0px 0px 0px 5px !important;
    }

    .item.panel.panel-default {
        margin-bottom: 0px !important;
    }

    .select2-container--material .select2-selection--single .select2-selection__rendered {
        padding: 6px;
        font-size: 1.5rem !important;
        float: left;
    }
</style>