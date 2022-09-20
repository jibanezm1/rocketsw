<?php

use app\models\GastosProyecto;
use app\models\NotaVenta;
use app\models\Cotizacion;
use app\models\OrdenIngreso;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Proyectos */

$this->title = $model->idproyecto;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['site/inicio']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>

<?php
Modal::begin([
    'header' => '<h4>Añadir un nuevo Gasto</h4>',
    'id' => 'modal',
    'size' => 'modal-lg',
]);

echo "<div id='modalContent'></div>";
Modal::end();
?>


<div class="panel">
    <div class="panel-heading">
        <h2 class="title">ID #<?= Html::encode($this->title) ?> - <?php echo $model->cliente->nombreCliente; ?></h2>
        <h4><?php echo $model->nombreProyecto; ?></h4>
    </div>
    <div class="panel-body">

        <h2 class="title">Acciones:</h2>

        <p>

            <?= Html::a('Nueva Cotización', ['cotizacion/creater', 'rutCliente' => $model->rutCliente, 'idProyecto' => $model->idproyecto], ['class' => 'btn btn-mint']) ?>
            <?= Html::a('Nueva OC', ['orden-ingreso/create', 'idProyecto' => $model->idproyecto], ['class' => 'btn btn-dark']) ?>
            <?= Html::a('Nueva Venta', ['nota-venta/create', 'id' => $model->idproyecto], ['class' => 'btn btn-purple']) ?>
            <?= Html::button('Nueva Rendicion de gastos ', ['value' => Url::to('../gastos-proyecto/create?idProyecto=' . $model->idproyecto), 'class' => 'btn btn-info', 'id' => 'modalbutton']) ?>
            <?= Html::a('Exportar Hoja Costo', ['eljota', 'id' => $model->idproyecto], ['class' => 'btn btn-success']) ?>


        </p>
        <br>
        <div class="box taskCard">
            <div class="rte">

                <div class="statsBar">
                    <div class="row">
                        <div class="col-xs-12 col-md-3 i yellow">

                            <div class="panel panel-warning panel-colorful media middle pad-all">
                                <div class="media-left">
                                    <div class="pad-hor">
                                        <i class="ion-bag icon-3x"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <p id="tcompras" class="text-2x mar-no text-semibold">0</p>
                                    <p class="mar-no">Total Compras</p>
                                </div>
                            </div>

                        </div>
                        <div class="col-xs-12 col-md-3 i pink">
                            <div class="panel panel-success panel-colorful media middle pad-all">
                                <div class="media-left">
                                    <div class="pad-hor">
                                        <i class="ion-clipboard icon-3x"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <p id="tcotizado" class="text-2x mar-no text-semibold">0</p>
                                    <p class="mar-no">Total Cotizado</p>
                                </div>
                            </div>


                        </div>
                        <div class="col-xs-12 col-md-3 i green">
                           
                        
                            <div class="panel panel-info panel-colorful media middle pad-all">
                                <div class="media-left">
                                    <div class="pad-hor">
                                        <i class="ion-pricetags icon-3x"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <p id="tventas" class="text-2x mar-no text-semibold">0</p>
                                    <p class="mar-no">Total Ventas</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3 i yellow">
                          
                        
                            <div class="panel panel-mint panel-colorful media middle pad-all">
                                <div class="media-left">
                                    <div class="pad-hor">
                                        <i class="ion-briefcase icon-3x"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <p id="ccgastos" class="text-2x mar-no text-semibold">0</p>
                                    <p class="mar-no">Total Gastos</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'idproyecto',
                'fechaCreacion',
                'nombreProyecto',
                'cliente.nombreCliente',
            ],
        ]) ?>








    </div>
</div>

<div class="panel">
    <div class="panel-heading">
        <h2 class="boxHeadline">Listado de compras: <strong></strong></h2>

    </div>
    <div class="panel-body">

        <table class="table js-datatable">
            <thead>
                <tr>

                    <th>Id Venta</th>
                    <th>Proveedor</th>
                    <th>Total</th>
                    <th>fecha</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>

                <?php
                $models = OrdenIngreso::find()->where(['idProyecto' => $model->idproyecto])->all();

                foreach ($models as $modelll) {
                ?>
                    <tr>
                        <td>
                            <p><strong> </strong><?php echo $modelll->idordenIngreso; ?></p>
                        </td>
                        <td>
                            <p><strong></strong><?php echo $modelll->rutProveedor0->nombreProveedor; ?></p>
                        </td>


                        <td>
                            <p><strong></strong><?php echo number_format($modelll->Total, 0, ' ', '.');  ?></p>
                        </td>
                        <td>
                            <p><strong></strong><?php echo Yii::$app->formatter->asDate($modelll->fechaIngreso, 'd/M/Y'); ?></p>
                        </td>
                        <td> <?= Html::a('Ver Compra', ['orden-ingreso/view', 'idordenIngreso' => $modelll->idordenIngreso, 'rutProveedor' => $modelll->rutProveedor], ['class' => 'btn btn-primary']) ?></td>
                    </tr>

                <?php
                }

                ?>



            </tbody>
        </table>
    </div>
</div>




<div class="panel">
    <div class="panel-heading">
        <h2 class="boxHeadline">Listado de ultimas Ventas: <strong></strong></h2>


    </div>
    <div class="panel-body" style="padding:10px;">


        <table class="table js-datatable">
            <thead>
                <tr>

                    <th>Id Venta</th>
                    <th>Empresa</th>
                    <th>Cliente</th>
                    <th>Evento</th>
                    <th>Total</th>
                    <th>fecha</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>

                <?php
                $models = NotaVenta::find()->where(['idProyecto' => $model->idproyecto])->all();

                foreach ($models as $modell) {
                ?>
                    <tr>
                        <td>
                            <p><strong> </strong><?php echo $modell->idNotaVenta; ?></p>
                        </td>
                        <td>
                            <p><strong></strong><?php echo $modell->idempresa0->nombreEmpresa; ?></p>
                        </td>
                        <td>
                            <p><strong></strong><?php echo $modell->rutCliente0->nombreCliente; ?></p>
                        </td>
                        <td>
                            <p><strong></strong><?php echo $modell->evento; ?></p>
                        </td>

                        <td>
                            <p><strong></strong><?php echo number_format($modell->Total, 0, ' ', '.'); ?></p>
                        </td>
                        <td>
                            <p><strong></strong><?php echo Yii::$app->formatter->asDate($modell->fecha, 'd/M/Y'); ?></p>
                        </td>
                        <td> <?= Html::a('Ver Venta', ['nota-venta/view', 'idNotaVenta' => $modell->idNotaVenta, 'rutCliente' => $modell->rutCliente, 'rutUsuario' => $modell->rutUsuario, 'idempresa' => $modell->idempresa], ['class' => 'btn btn-primary']) ?></td>
                    </tr>

                <?php
                }

                ?>



            </tbody>
        </table>
    </div>
</div>


<div class="panel">
    <div class="panel-heading">

        <h2 class="boxHeadline">Gastos del proyecto: <strong></strong></h2>

    </div>
    <div class="panel-body" style="padding:10px;">

        <table class="table js-datatable">
            <thead>
                <tr>

                    <th>Id Gasto</th>
                    <th>Fecha Gasto</th>
                    <th>Titulo</th>
                    <th>Motivo Gasto</th>
                    <th>Monto</th>
                    <th>Realizado por:</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>

                <?php
                $dales = GastosProyecto::find()->where(['idProyecto' => $model->idproyecto])->all();

                foreach ($dales as $dale) {
                ?>
                    <tr>
                        <td>
                            <p><strong> </strong><?php echo $dale->idGastos; ?></p>
                        </td>
                        <td>
                            <p><strong></strong><?php echo Yii::$app->formatter->asDate($dale->fechaGasto, 'd/M/Y'); ?></p>
                        </td>
                        <td>
                            <p><strong></strong><?php echo $dale->Titulo; ?></p>
                        </td>
                        <td>
                            <p><strong></strong><?php echo $dale->motivoGasto; ?></p>
                        </td>
                        <td>
                            <p><strong></strong><?php echo number_format($dale->monto, 0, ' ', '.'); ?></p>
                        </td>
                        <td>
                            <p><strong></strong><?php echo $dale->usuario->nombreUsuario; ?></p>
                        </td>

                        <td> <?= Html::a('Ver Gastos', ['gastos-proyecto/view', 'id' => $dale->idGastos], ['class' => 'btn btn-primary']) ?></td>
                    </tr>

                <?php
                }

                ?>



            </tbody>
        </table>

    </div>
</div>


<div class="panel">
    <div class="panel-heading">
        <h2 class="boxHeadline">Listado de cotizaciones: <strong></strong></h2>


    </div>
    <div class="panel-body" style="padding:10px;">

        <table class="table js-datatable">
            <thead>
                <tr>

                    <th>Id Cotizacion</th>
                    <th>Empresa</th>
                    <th>Empresa de venta</th>
                    <th>Valor neto Venta</th>
                    <th>IVA</th>
                    <th>Total</th>
                    <th>fecha</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>

                <?php
                $modelosos = Cotizacion::find()->where(['idProyecto' => $model->idproyecto])->all();

                foreach ($modelosos as $modeloso) {
                ?>
                    <tr>
                        <td>
                            <p><strong> </strong><?php echo $modeloso->idcotizacion; ?></p>
                        </td>
                        <td>
                            <p><strong></strong><?php echo $modeloso->cliente->nombreCliente; ?></p>
                        </td>
                        <td>
                            <p><strong></strong><?php echo $modeloso->idempresa0->nombreEmpresa; ?></p>
                        </td>
                        <td>
                            <p><strong></strong><?php echo number_format($modeloso->totalNeto, 0, ' ', '.');  ?></p>
                        </td>
                        <td>
                            <p><strong></strong><?php echo number_format($modeloso->IVA, 0, ' ', '.');  ?></p>
                        </td>
                        <td>
                            <p><strong></strong><?php echo number_format($modeloso->Total, 0, ' ', '.');  ?></p>
                        </td>
                        <td>
                            <p><strong></strong><?php echo Yii::$app->formatter->asDate($modeloso->fecha, 'd/M/Y'); ?></p>
                        </td>
                        <td><?= Html::a(Yii::t('app', 'Ver cotizacion'),  ['cotizacion/view', 'idcotizacion' => $modeloso->idcotizacion, 'rutCliente' => $modeloso->rutCliente, 'rutUsuario' => $modeloso->rutUsuario, 'idempresa' => $modeloso->idempresa], ['class' => 'btn btn-primary']) ?></td>
                    </tr>

                <?php
                }

                ?>



            </tbody>
        </table>

    </div>
</div>



<script>
    window.onload = function() {
        $.get('https://api.sbif.cl/api-sbifv3/recursos_api/dolar/2020/04', {
                apikey: 'ca5a65fcffdb1d25c087519c08f68e8af9ca88a7',
                formato: 'json',
            },
            function(returnedData) {




                Morris.Line({
                    element: "morris-line-chart1",
                    data: returnedData.Dolares,
                    xkey: "Fecha",
                    ykeys: ["Valor"],
                    labels: ["Valor Dolar del dia"],
                    hideHover: "auto",
                    resize: !0,
                    lineColors: ["#fe5621"]
                })


            }), $.get('../cotizacion/contarr?idProyecto=<?php echo $model->idproyecto; ?>',
            function(returnedData) {
                data = JSON.parse(returnedData);

                document.getElementById("tcotizado").innerHTML = data.tcotizado;
                document.getElementById("tcompras").innerHTML = "$" + data.tcompras;
                document.getElementById("tventas").innerHTML = "$" + data.tventas;
                document.getElementById("ccgastos").innerHTML = "$" + data.ccgastos;

                Morris.Donut({
                    element: "morris-donut-chart1",
                    data: [{
                        label: "Cantidad de Ventas",
                        value: data.cventas
                    }, {
                        label: "Cantidad de Compras",
                        value: data.ccompras
                    }, {
                        label: "Cantidad de Cotizaciones",
                        value: data.ccotizaciones
                    }],
                    resize: !0,
                    colors: ["#fe5621", "#2095f2", "#8ac249"]
                })

            });
    }
</script>