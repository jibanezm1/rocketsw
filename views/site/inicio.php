<?php

use app\models\Cliente;

?>

<link href="/web/nifty/css/proyectosinicio.css" rel="stylesheet">

<div class="panel">
    <div class="panel-body">


        <div class="row">
            <div class="col-sm-12 mb-3">
                <input type="text" id="myFilter" class="form-control" onkeyup="myFunction()" placeholder="Filtrar por el nombre del cliente..">
            </div>
            <div class="col-sm-12 mb-3">
                <input type="text" id="myFilter1" class="form-control" onkeyup="myFunction1()" placeholder="Filtrar por el rut de cliente..">
            </div>
        </div>
        <div class="statsBar">
            <div class="row" id="myItems">
                <?php

                $model = Cliente::find()->all();

                foreach ($model as $m) {
                ?>
                    <div class="col-xs-12 col-md-6 i pink card">
                        <a href="#" title="#" class="c">
                            <h3 class="title"><?php echo $m->nombreCliente; ?></h3>
                            <h3 style="display: none;" class="elrut"><?php echo $m->rutCliente; ?></h3>
                            <div class="num" id="cventas"></div>
                            <i class="zmdi ion-clipboard icon"></i>
                            <a class="c ck" type="button" href="../cliente/proyectos?rutCliente=<?php echo $m->rutCliente; ?>" class="btn bg-dark-gray">
                                Acceder

                            </a>

                        </a>
                    </div>

                <?php

                }
                ?>

            </div>
        </div>

    </div>
</div>
<script src="/web/nifty/js/proyectosinicio.js"></script>