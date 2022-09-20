<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProyectosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<link href="/web/nifty/css/proyectosinicio.css" rel="stylesheet">

<style>
    .modal-content {
        margin-top: 250px !important;
    }

    h3.title {
        width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    h4.title {
        width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .col-xs-12.col-md-6.i.green.card {
        margin-bottom: 29px !important;
    }
</style>
<?php
Modal::begin([
    'header' => '<h4>Crear Nuevo proyecto</h4>',
    'id' => 'modal',
    'size' => 'modal-lg',
]);

echo "<div id='modalContent'></div>";
Modal::end();
?>
<div class="panel">
    <div class="panel-heading">
        <h2 class="title">
            <?= Html::encode($this->title) ?> - <?php echo $cliente->nombreCliente; ?>
        </h2>
        <br>
        <?= Html::button('Crear un nuevo proyecto ', ['value' => Url::to('../proyectos/create?rutCliente=' . $rutCliente), 'class' => 'pull-left btn btn-primary btn-sm', 'id' => 'modalbutton']) ?>
        <br>
        <br>
        <br>
        <br>
        <div class="row">
            <div class="col-sm-12 mb-3">
                <input type="text" id="myFilter" class="form-control" onkeyup="myFunction()" placeholder="Filtrar por proyecto..">
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="panel-body">

        <div class="statsBar">
            <div class="row" id="myItems">
                <h1>En ejecución</h1>
                <div class="row">
                    <?php
                    if (empty(!$model1)) {
                        foreach ($model1 as $m) {
                    ?>
                            <div class="col-xs-12 col-md-6 i green card">
                                <a href="#" title="#" class="c">
                                    <h3 class="title">#<?php echo $m->idproyecto; ?></h3>
                                    <h4 class="title as"><?php echo $m->nombreProyecto; ?></h4>
                                    <h4 class="title">Creado por: <?php echo $m->usuario->nombreUsuario; ?></h4>

                                    <p>Fecha: <?php echo $m->fechaCreacion; ?></p>
                                    <div class="num" id="cventas"></div>
                                    <i class="zmdi ion-clipboard icon"></i>
                                    <a class="c ck" type="button" href="../proyectos/view?id=<?php echo $m->idproyecto; ?>" class="btn bg-dark-gray">
                                        Acceder

                                    </a>

                                </a>
                            </div>

                    <?php
                        }
                    } else {
                        echo "No existen proyectos asociados a este cliente.";
                    }

                    ?>
                </div>

                <hr>
                <br>
                <h1>Terminados</h1>
                <div class="row">
                    <?php
                    if (empty(!$model2)) {
                        foreach ($model2 as $m) {
                    ?>
                            <div class="col-xs-12 col-md-6 i green card">
                                <a href="#" title="#" class="c">
                                    <h3 class="title">#<?php echo $m->idproyecto; ?></h3>
                                    <h4 class="title as"><?php echo $m->nombreProyecto; ?></h4>
                                    <h4 class="title">Creado por: <?php echo $m->usuario->nombreUsuario; ?></h4>

                                    <p>Fecha: <?php echo $m->fechaCreacion; ?></p>
                                    <div class="num" id="cventas"></div>
                                    <i class="zmdi ion-clipboard icon"></i>
                                    <a class="c ck" type="button" href="../proyectos/view?id=<?php echo $m->idproyecto; ?>" class="btn bg-dark-gray">
                                        Acceder

                                    </a>

                                </a>
                            </div>

                    <?php
                        }
                    } else {
                        echo "No existen proyectos asociados a este cliente.";
                    }

                    ?>
                </div>

                <br>
                <h1>Deshabilitado</h1>
                <div class="row">
                    <?php
                    if (empty(!$model3)) {
                        foreach ($model3 as $m) {
                    ?>
                            <div class="col-xs-12 col-md-6 i green card">
                                <a href="#" title="#" class="c">
                                    <h3 class="title">#<?php echo $m->idproyecto; ?></h3>
                                    <h4 class="title as"><?php echo $m->nombreProyecto; ?></h4>
                                    <h4 class="title">Creado por: <?php echo $m->usuario->nombreUsuario; ?></h4>

                                    <p>Fecha: <?php echo $m->fechaCreacion; ?></p>
                                    <div class="num" id="cventas"></div>
                                    <i class="zmdi ion-clipboard icon"></i>
                                    <a class="c ck" type="button" href="../proyectos/view?id=<?php echo $m->idproyecto; ?>" class="btn bg-dark-gray">
                                        Acceder

                                    </a>

                                </a>
                            </div>

                    <?php
                        }
                    } else {
                        echo "No existen proyectos asociados a este cliente.";
                    }

                    ?>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    function myFunction() {
        var input, filter, cards, cardContainer, h5, title, i;
        input = document.getElementById("myFilter");
        filter = input.value.toUpperCase();
        cardContainer = document.getElementById("myItems");
        cards = cardContainer.getElementsByClassName("card");
        for (i = 0; i < cards.length; i++) {
            title = cards[i].querySelector("h4.as");
            if (title.innerText.toUpperCase().indexOf(filter) > -1) {
                cards[i].style.display = "";
            } else {
                cards[i].style.display = "none";
            }
        }
    }
</script>