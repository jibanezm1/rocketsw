<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CotizacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cotizaciones');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="panel">
    <div class="panel-heading">

        <h3><?= Html::encode($this->title) ?></h3>
        <?= Html::a(Yii::t('app', 'Crear una nueva Cotizacion'), ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <div class="panel-body">
        <div class="bootstrap-table">


            <div class="fixed-table-container" style="padding-bottom: 0px;">
                <div class="fixed-table-body">

                    <?php Pjax::begin(); ?>
                    <?php // echo $this->render('_search', ['model' => $searchModel]); 
                    ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'autoXlFormat' => true,
                        'toggleDataContainer' => ['class' => 'btn-group mr-2'],
                        'export' => [
                            'showConfirmAlert' => false,
                            'target' => GridView::TARGET_BLANK
                        ],
                        'pjax' => true,
                        'showPageSummary' => true,
                        'panel' => [
                            'type' => 'primary',
                        ],
                        'columns' => [

                            'idcotizacion',
                            [
                                'label' => 'Empresa',
                                'attribute' => 'idempresa',
                                'value' => 'idempresa0.nombreEmpresa'
                            ],
                            [
                                'label' => 'Clientes',
                                'attribute' => 'rutCliente',
                                'value' => 'cliente.nombreCliente'
                            ],

                            [

                                'attribute' => 'fecha',

                                'format' => ['date', 'php:d/m/Y']

                            ],

                            [
                                'format' => 'Currency',
                                'attribute' => 'totalNeto',
                                'format' => ['decimal', 0]


                            ],
                            [
                                'format' => 'Currency',
                                'attribute' => 'IVA',
                                'format' => ['decimal', 0]


                            ],
                            [
                                'format' => 'Currency',
                                'attribute' => 'Total',
                                'format' => ['decimal', 0]


                            ],


                            [
                                'label' => 'Estado',
                                'attribute' => 'estado',
                                'format' => 'raw',
                                'filter' => [
                                    1 => 'Pendiente',
                                    2 => 'Vencida',
                                    3 => 'Sin respuesta',
                                    4 => 'Procesada a ventas',

                                ],
                                'value' => function ($model) {

                                    //estados
                                    // 1 -> Pendiente
                                    // 2 -> Vencida
                                    // 3 -> Sin respuesta
                                    // 4 -> Procesada a ventas

                                    if ($model->estado == 1) {

                                        return "<span class='text-blue'><strong>Pendiente</strong></span>";
                                    } else {

                                        if ($model->estado == 2) {
                                            return "<span class='text-yellow'><strong>Vencida</strong></span>";
                                        } else {
                                            if ($model->estado == 3) {
                                                return "<span class='text-red'><strong>Sin respuesta</strong></span>";
                                            } else {
                                                if ($model->estado == 4) {
                                                    return "<span class='text-green'><strong>En venta</strong></span>";
                                                }
                                            }
                                        }
                                    }
                                }
                            ],
                            //'estado',

                            //'rutUsuario',
                            //'mail',
                            //'evento',
                            //'validez',
                            //'entrega',
                            //'formaDePago',
                            //'tipoDeMoneda',
                            //'idempresa',


                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>

                    <?php Pjax::end(); ?>
                </div>
            </div>

        </div>
        <div class="clearfix"></div>
    </div>
</div>