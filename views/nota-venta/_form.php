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
?>

<div class="cotizacion-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <div class="">
        <div class="row">
            <div class="col-md-12"><?= $form->field($model, 'factura')->textInput(['maxlength' => true]) ?></div>

        </div>
        <?php
        // necessary for update action.
        if ($cliente->isNewRecord) {
        ?>
            <div class="row">
                <div class="col-md-3">
                    <?php

                    $datos = Cliente::find()->select(['rutCliente'])->asArray()->all();
                    $array = [];

                    foreach ($datos as $d) {

                        array_push($array, $d["rutCliente"]);
                    }

                    echo $form->field($cliente, 'rutCliente')->widget(TypeaheadBasic::classname(), [
                        'data' => $array,
                        'options' => [
                            'placeholder' => 'Filter as you type ...',
                            'onChange' => "buscador(this)"
                        ],
                        'pluginOptions' => [
                            'highlight' => true,
                        ],

                    ]);
                    ?>


                </div>
                <div class="col-md-3"><?= $form->field($cliente, 'nombreCliente')->textInput(['maxlength' => true]) ?></div>
                <div class="col-md-3"><?= $form->field($cliente, 'direccionCliente')->textInput(['maxlength' => true]) ?></div>
                <div class="col-md-3"><?= $form->field($cliente, 'giroCliente')->textInput(['maxlength' => true]) ?></div>
            </div>

            <div class="row">
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
                <div class="col-md-3"><?= $form->field($cliente, 'correoCliente')->textInput(['maxlength' => true]) ?></div>
            </div>
    </div>

    <div class="row">



        <div class="col-md-12">
            <?= $form->field($model, 'evento')->textInput(['maxlength' => true]) ?>
        </div>

    </div>

    <div class="row">
        <div class="col-md-3">

            <?= $form->field($model, 'validez')->widget(Select2::className(), [
                'data' => $validez
            ]);  ?>

        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'entrega')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'formaDePago')->widget(Select2::className(), [
                'data' => $pago
            ]);  ?>

        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'tipoDeMoneda')->widget(Select2::className(), [
                'data' => $moneda
            ]);  ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'flete')->textArea(['maxlength' => true]) ?>

        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'comentarios')->textArea(['maxlength' => true]) ?>


        </div>
    </div>


<?php
        } else {
?>


    <div class="row">
        <div class="col-md-3">
            <?php

            $datos = Cliente::find()->select(['rutCliente'])->asArray()->all();
            $array = [];

            foreach ($datos as $d) {

                array_push($array, $d["rutCliente"]);
            }

            echo $form->field($cliente, 'rutCliente')->widget(TypeaheadBasic::classname(), [
                'data' => $array,
                'options' => [
                    'placeholder' => 'Filter as you type ...',
                    'onChange' => "buscador(this)",
                    'readonly' => true
                ],

                'pluginOptions' => [
                    'highlight' => true,
                ],

            ]);
            ?>


        </div>
        <div class="col-md-3"><?= $form->field($cliente, 'nombreCliente')->textInput(['maxlength' => true, 'readonly' => true]) ?>
            <?= $form->field($model, 'idProyecto')->hiddenInput()->label(false) ?>
        </div>
        <div class="col-md-3"><?= $form->field($cliente, 'direccionCliente')->textInput(['maxlength' => true, 'readonly' => true]) ?></div>
        <div class="col-md-3"><?= $form->field($cliente, 'giroCliente')->textInput(['maxlength' => true, 'readonly' => true]) ?></div>
    </div>

    <div class="row">
        <div class="col-md-3"><?= $form->field($cliente, 'telefonoCliente')->textInput(['readonly' => true]) ?></div>

        <div class="col-md-3"><?= $form->field($cliente, 'correoCliente')->textInput(['maxlength' => true, 'readonly' => true]) ?></div>
    </div>
</div>

<div class="row">



    <div class="col-md-12">
        <?= $form->field($model, 'evento')->textInput(['maxlength' => true]) ?>
        <?php echo Html::hiddenInput('idNotaVenta', $model->idNotaVenta); ?>
    </div>

</div>

<div class="row">
    <div class="col-md-3">

        <?= $form->field($model, 'validez')->widget(Select2::className(), [
                'data' => $validez
            ]);  ?>

    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'entrega')->textInput(['maxlength' => true]) ?>

    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'formaDePago')->widget(Select2::className(), [
                'data' => $pago
            ]);  ?>

    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'tipoDeMoneda')->widget(Select2::className(), [
                'data' => $moneda
            ]);  ?>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'flete')->textArea(['maxlength' => true]) ?>

    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'comentarios')->textArea(['maxlength' => true]) ?>


    </div>
</div>

<?php
        }
?>




















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
                'iddetalleNota',
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
                            echo Html::activeHiddenInput($modelAddress, "[{$i}]iddetalleNota");
                        }
                        ?>


                        <div class="row">
                            <div style="text-align: center;" class="col-sm-3">
                                <?= $form->field($modelAddress, "[{$i}]idproducto")->widget(Select2::className(), [
                                    'data' => ArrayHelper::map(app\models\Producto::find()->all(), 'idproducto', function ($model) {
                                        return $model->nombreProducto . "(Precio Lista:" . $model->precioLista . ")" . "(Stock:" . $model->stock . ")";
                                    }),
                                ])->label(false); ?>
                            </div>
                            <div style="text-align: center;" class="col-sm-2">
                                <?= $form->field($modelAddress, "[{$i}]tiempo")->textInput(['maxlength' => true])->label(false) ?>
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
    <?= Html::submitButton($modelAddress->isNewRecord ? 'Crear o transformar en venta' : 'Actualizar los datos de la nota de venta', ['class' => 'btn btn-primary']) ?>
</div>



<?php ActiveForm::end(); ?>

</div>


<script>
    function calculador(id) {
        var res = id.split("-");


        var my_input1 = document.getElementById('detallenota-' + res[1] + '-cantidad').value;
        var my_input2 = document.getElementById('detallenota-' + res[1] + '-precio').value;
        var sum = parseInt(my_input1) * parseInt(my_input2);
        document.getElementById('detallenota-' + res[1] + '-total').value = sum.toFixed(0);
        var resultado = parseInt(sum) * 0.19;
        document.getElementById('detallenota-' + res[1] + '-iva').value = resultado.toFixed(0);



        var precio = 0;
        $('input[name$="[total]"]').each(function() {
            precio += 1 * ($(this).val());
        });
        document.getElementById('notaventa-totalneto').value = precio.toFixed(0);



        var iva = 0;
        $('input[name$="[iva]"]').each(function() {
            iva += 1 * ($(this).val());
        });
        document.getElementById('notaventa-iva').value = iva.toFixed(0);

        var suma = 0;
        $('input[name$="[total]"]').each(function() {
            suma += 1 * ($(this).val());
        });
        document.getElementById('notaventa-total').value = parseInt(suma.toFixed(0)) + parseInt(iva.toFixed(0));
        console.log(suma);

    }

    function buscador() {
        var variable = $('#cliente-rutcliente').val();



        $.post('http://localhost:8888/cotizador/web/cliente/buscador', {
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
                    document.getElementById("cliente-correocliente").value = obj.correoCliente;
                    $('#regiones').val(obj.regionCliente);
                    $('#regiones').select2().trigger('change');

                    $('#comunas').val(obj.comunaCliente);
                    $('#comunas').select2().trigger('change');

                    document.getElementById("select2-regiones-container").innerHtml = obj.regionCliente;
                    document.getElementById("select2-comunas-container").innerHtml = obj.comunaCliente;

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
            document.getElementById('notaventa-totalneto').value = precio.toFixed(0);



            var iva = 0;
            $('input[name$="[iva]"]').each(function() {
                iva += 1 * ($(this).val());
            });
            document.getElementById('notaventa-iva').value = iva.toFixed(0);

            var suma = 0;
            $('input[name$="[total]"]').each(function() {
                suma += 1 * ($(this).val());
            });
            document.getElementById('notaventa-total').value = parseInt(suma.toFixed(0)) + parseInt(iva.toFixed(0));


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
</style>