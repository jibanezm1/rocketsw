<div class="row">
    <div class="col-lg-6">

        <!--Network Line Chart-->
        <!--===================================================-->
        <div id="demo-panel-network" class="panel">
            <div class="panel-heading">
               
                <h3 class="panel-title">Variación del dolar ultimos dias</h3>
            </div>



            <div class="panel">
                <div class="panel-body">
                    <div id="demo-morris-area-legend-full" class="text-center"></div>
                    <div id="morris-line-chart1" class="morris-full-content" style="height: 300px"></div>
                    <div class="">
                        <br><br><br>
                    </div>
                </div>
            </div>




        </div>
        <!--===================================================-->
        <!--End network line chart-->

    </div>
    <div class="col-lg-6">

        <!--Network Line Chart-->
        <!--===================================================-->
        <div id="demo-panel-network" class="panel">
            <div class="panel-heading">
                
            
                <h3 class="panel-title">Cantidades de movimientos</h3>
            </div>



            <div class="panel">
                <div class="panel-body">
                    <div id="demo-morris-area-legend-full" class="text-center"></div>
                    <div id="morris-donut-chart1" class="morris-full-content" style="height: 300px"></div>
                    <div class="">
                        <br><br><br>
                    </div>
                </div>
            </div>




        </div>
        <!--===================================================-->
        <!--End network line chart-->

    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="panel panel-warning panel-colorful media middle pad-all">
            <div class="media-left">
                <div class="pad-hor">
                    <i class="demo-pli-file-word icon-3x"></i>
                </div>
            </div>
            <div class="media-body">
                <p id="cventas" class="text-2x mar-no text-semibold"></p>
                <p class="mar-no">Cantidad Ventas</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-info panel-colorful media middle pad-all">
            <div class="media-left">
                <div class="pad-hor">
                    <i class="demo-pli-file-zip icon-3x"></i>
                </div>
            </div>
            <div class="media-body">
                <p id="tcompras" class="text-2x mar-no text-semibold">0</p>
                <p class="mar-no">Total de Compras</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-mint panel-colorful media middle pad-all">
            <div class="media-left">
                <div class="pad-hor">
                    <i class="demo-pli-camera-2 icon-3x"></i>
                </div>
            </div>
            <div class="media-body">
                <p id="tventas" class="text-2x mar-no text-semibold"></p>
                <p class="mar-no">Total de Ventas</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Ranking de Articulos mas vendidos:</h3>
            </div>

            <!--Data Table-->
            <!--===================================================-->
            <div class="panel-body">
                <div class="pad-btm form-inline">

                </div>
                <div class="table-responsive">
                    <table id="ranking1" class="table js-datatable ">
                        <thead>
                            <tr>

                                <th>Nombre producto</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $connection = Yii::$app->getDb();
                            $command = $connection->createCommand('SELECT 
            p.idproducto, p.nombreProducto, SUM(d.cantidad) as "totales"
            FROM
                producto p
                    INNER JOIN
                detalleNota d ON p.idproducto = d.idproducto
            GROUP BY p.idproducto
            ORDER BY totales DESC');
                            $result = $command->queryAll();





                            foreach ($result as $model) {

                            ?>
                                <tr>
                                    <td>
                                        <p><?php echo $model["nombreProducto"];  ?></p>
                                    </td>
                                    <td>
                                        <p><?php echo $model["totales"];  ?></p>
                                    </td>

                                </tr>

                            <?php
                            }

                            ?>



                        </tbody>
                    </table>
                </div>
                <hr class="new-section-xs">

            </div>
            <!--===================================================-->
            <!--End Data Table-->

        </div>
    </div>
</div>


<div class="row">
    <div class="col-xs-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Ranking de Articulos mas Cotizados:</h3>
            </div>

            <!--Data Table-->
            <!--===================================================-->
            <div class="panel-body">
                <div class="pad-btm form-inline">

                </div>
                <div class="table-responsive">
                    <table id="ranking1" class="table js-datatable ">
                        <thead>
                            <tr>


                                <th>Nombre producto</th>
                                <th>Cantidad</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $connection = Yii::$app->getDb();
                            $command = $connection->createCommand('SELECT 
            p.idproducto, p.nombreProducto, SUM(d.cantidad) as "totales"
            FROM
                producto p
                    INNER JOIN
                    detalleCotizacion d ON p.idproducto = d.idproducto
            GROUP BY p.idproducto
            ORDER BY totales DESC');
                            $result = $command->queryAll();





                            foreach ($result as $model) {

                            ?>
                                <tr>
                                    <td>
                                        <p><?php echo $model["nombreProducto"];  ?></p>
                                    </td>
                                    <td>
                                        <p><?php echo $model["totales"];  ?></p>
                                    </td>

                                </tr>

                            <?php
                            }

                            ?>



                        </tbody>
                    </table>
                </div>
                <hr class="new-section-xs">

            </div>
            <!--===================================================-->
            <!--End Data Table-->

        </div>
    </div>
</div>


<script>
    window.onload = function() {
        $.get('https://api.sbif.cl/api-sbifv3/recursos_api/dolar/2022', {
                apikey: 'ca5a65fcffdb1d25c087519c08f68e8af9ca88a7',
                formato: 'json',
            },
            function(returnedData) {




                Morris.Area({
                    element: "morris-line-chart1",
                    data: returnedData.Dolares,
                    xkey: "Fecha",
                    ykeys: ["Valor"],
                    labels: ["Valor Dolar del dia"],
                    hideHover: "auto",
                    resize: !0,
                    gridEnabled: true,
                    gridLineColor: 'rgba(0,0,0,.1)',
                    gridTextColor: '#8f9ea6',
                    gridTextSize: '11px',
                    behaveLikeLine: true,
                    smooth: true,
                    lineColors: ['#26a69a'],
                    pointSize: 0,
                    pointStrokeColors: ['#045d97'],
                    lineWidth: 0,
                    resize: true,
                    hideHover: 'auto',
                    fillOpacity: 0.9,
                    parseTime: false
                })


            }), $.get('../cotizacion/contar',
            function(returnedData) {
                data = JSON.parse(returnedData);

                document.getElementById("cventas").innerHTML = data.cventas;
                document.getElementById("tcompras").innerHTML = "$" + data.tcompras;
                document.getElementById("tventas").innerHTML = "$" + data.tventas;




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
                    colors: [
                        '#ec407a',
                        '#03a9f4',
                        '#d8dfe2'
                    ],
                    resize: true
                })

            });
    }
</script>