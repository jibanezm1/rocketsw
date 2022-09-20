<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);

try {
    $session = Yii::$app->session;
    $session->open();
    $user_id = $session->get('usuario');
    if (!$user_id) {
        return  Yii::$app->getResponse()->redirect('../site/login');
    }
} catch (\Exception $exception) {
    Yii::$app->getResponse()->redirect('../site/login');
}

?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>ROCKET | Apolotec SPA</title>

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <?php $this->head() ?>
</head>

<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->

<body>
    <?php $this->beginBody() ?>
    <div id="container" class="effect aside-float aside-bright mainnav-lg">

        <!--NAVBAR-->
        <!--===================================================-->
        <header id="navbar">
            <div id="navbar-container" class="boxed">

                <!--Brand logo & name-->
                <!--================================-->
                <div class="navbar-header">
                    <a href="/index" class="navbar-brand">
                        <img src="https://cdn-icons-png.flaticon.com/128/3163/3163746.png" alt="Nifty Logo" class="brand-icon">
                        <div class="brand-title">
                            <span class="brand-text">ROCKET</span>
                        </div>
                    </a>
                </div>
                <!--================================-->
                <!--End brand logo & name-->


                <!--Navbar Dropdown-->
                <!--================================-->
                <div class="navbar-content">
                    <ul class="nav navbar-top-links">

                        <!--Navigation toogle button-->
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <li class="tgl-menu-btn">
                            <a class="mainnav-toggle" href="#">
                                <i class="demo-pli-list-view"></i>
                            </a>
                        </li>
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <!--End Navigation toogle button-->




                    </ul>

                </div>
                <!--================================-->
                <!--End Navbar Dropdown-->

            </div>
        </header>
        <!--===================================================-->
        <!--END NAVBAR-->

        <div class="boxed">

            <!--CONTENT CONTAINER-->
            <!--===================================================-->
            <div id="content-container">
                <div id="page-head">

                    <div class="pad-all text-center">
                        <p1><?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],]) ?></p>
                    </div>
                </div>


                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">

                    <?= Alert::widget() ?>
                    <?= $content ?>



                </div>
                <!--===================================================-->
                <!--End page content-->

            </div>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->

            <!--MAIN NAVIGATION-->
            <!--===================================================-->
            <nav id="mainnav-container">
                <div id="mainnav">


                    <!--OPTIONAL : ADD YOUR LOGO TO THE NAVIGATION-->
                    <!--It will only appear on small screen devices.-->
                    <!--================================
                    <div class="mainnav-brand">
                        <a href="index.html" class="brand">
                            <img src="img/logo.png" alt="Nifty Logo" class="brand-icon">
                            <span class="brand-text">Nifty</span>
                        </a>
                        <a href="#" class="mainnav-toggle"><i class="pci-cross pci-circle icon-lg"></i></a>
                    </div>
                    -->



                    <!--Menu-->
                    <!--================================-->
                    <div id="mainnav-menu-wrap">
                        <div class="nano">
                            <div class="nano-content">


                                <div id="mainnav-profile" class="mainnav-profile">
                                    <div class="profile-wrap text-center">
                                        <div class="">
                                            <img class="img-responsive" src="/web/logo1.png" alt="Profile Picture">
                                        </div>
                                        <!-- <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
                                            <span class="pull-right dropdown-toggle">
                                                <i class="dropdown-caret"></i>
                                            </span>

                                            <span class="mnp-desc">Configuraciones</span>
                                        </a> -->
                                    </div>
                                    <div id="profile-nav" class="collapse list-group bg-trans">
                                        <!-- <a href="#" class="list-group-item">
                                            <i class="demo-pli-male icon-lg icon-fw"></i> * Mi Perfil
                                        </a> -->
                                        <a href="#" class="list-group-item">
                                            <i class="demo-pli-gear icon-lg icon-fw"></i> Configuración
                                        </a>

                                        <a href="<?php echo Url::to(['site/invalid']);  ?>" class="list-group-item">
                                            <i class="demo-pli-unlock icon-lg icon-fw"></i> Salir
                                        </a>
                                    </div>
                                </div>


                                <ul id="mainnav-menu" class="list-group">

                                    <!--Category name-->
                                    <li class="list-header">Modulos</li>

                                    <!--Menu list item-->
                                    <li>
                                        <a href="<?php echo Url::to(['site/inicio']);  ?>">
                                            <i class="demo-pli-computer-secure"></i>
                                            <span class="menu-title">Proyectos</span>
                                            <i class="arrow"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="inicio">
                                            <i class="ti-money"></i>
                                            <span id="dolar" class="menu-title"></span>
                                            <i class="arrow"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a aria-expanded="false" href="#">
                                            <i class="ti-id-badge"></i>
                                            <span class="menu-title">Clientes</span>
                                            <i class="arrow"></i>
                                        </a>
                                        <ul class="collapse" aria-expanded="false" style="height: 0px;">
                                            <li>

                                                <a href="<?php echo Url::to(['cliente/index']);  ?>" title="#">

                                                    Listado de Clientes

                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo Url::to(['cliente/create']);  ?>" title="#">
                                                    Agregar nuevo Cliente
                                                </a>
                                            </li>
                                            <li>

                                                <a href="<?php echo Url::to(['contacto/index']);  ?>" title="#">

                                                    Listado de Contactos

                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a aria-expanded="false" href="#">
                                            <i class="ti-archive"></i>
                                            <span class="menu-title">Productos</span>
                                            <i class="arrow"></i>
                                        </a>
                                        <ul class="collapse" aria-expanded="false" style="height: 0px;">
                                            <li>

                                                <a href="<?php echo Url::to(['producto/index']);  ?>" title="#">

                                                    Listado de Productos

                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo Url::to(['producto/create']);  ?>" title="#">
                                                    Agregar nuevo Producto
                                                </a>
                                            </li>
                                        </ul>
                                    </li>


                                    <li>
                                        <a aria-expanded="false" href="#">
                                            <i class="ti-truck"></i>
                                            <span class="menu-title">Proveedores</span>
                                            <i class="arrow"></i>
                                        </a>
                                        <ul class="collapse" aria-expanded="false" style="height: 0px;">
                                            <li>

                                                <a href="<?php echo Url::to(['proveedor/index']);  ?>" title="#">

                                                    Listado de Proveedores

                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo Url::to(['proveedor/create']);  ?>" title="#">
                                                    Agregar nuevo Proveedores
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="list-divider"></li>

                                    <li>
                                        <a aria-expanded="false" href="#">
                                            <i class="ti-check-box"></i>
                                            <span class="menu-title">Cotizaciones</span>
                                            <i class="arrow"></i>
                                        </a>
                                        <ul class="collapse" aria-expanded="false" style="height: 0px;">
                                            <li>

                                                <a href="<?php echo Url::to(['cotizacion/index']);  ?>" title="#">

                                                    Listado de Cotizaciones

                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo Url::to(['cotizacion/create']);  ?>" title="#">
                                                    Nueva Cotizaciones
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a aria-expanded="false" href="#">
                                            <i class="ti-notepad"></i>
                                            <span class="menu-title">OC</span>
                                            <i class="arrow"></i>
                                        </a>
                                        <ul class="collapse" aria-expanded="false" style="height: 0px;">
                                            <li>

                                                <a href="<?php echo Url::to(['orden-ingreso/index']);  ?>" title="#">

                                                    Listado de OC

                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo Url::to(['orden-ingreso/create']);  ?>" title="#">
                                                    Nueva OC
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a aria-expanded="false" href="#">
                                            <i class="ti-shopping-cart-full"></i>
                                            <span class="menu-title">Ventas</span>
                                            <i class="arrow"></i>
                                        </a>
                                        <ul class="collapse" aria-expanded="false" style="height: 0px;">
                                            <li>

                                                <a href="<?php echo Url::to(['nota-venta/index']);  ?>" title="#">

                                                    Listar Ventas

                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo Url::to(['nota-venta/create', 'id' => 1]);  ?>" title="#">
                                                    Nueva Venta
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a aria-expanded="false" href="#">
                                            <i class="ion-arrow-graph-up-left"></i>
                                            <span class="menu-title">Bancos</span>
                                            <i class="arrow"></i>
                                        </a>
                                        <ul class="collapse" aria-expanded="false" style="height: 0px;">
                                            <li>

                                                <a href="<?php echo Url::to(['banco/index']);  ?>" title="#">

                                                    Listar Bancos

                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo Url::to(['banco/create']);  ?>" title="#">
                                                    Nueva Banco
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a aria-expanded="false" href="#">
                                            <i class="ion-medkit"></i>
                                            <span class="menu-title">Factoring</span>
                                            <i class="arrow"></i>
                                        </a>
                                        <ul class="collapse" aria-expanded="false" style="height: 0px;">
                                            <li>

                                                <a href="<?php echo Url::to(['factoring/index']);  ?>" title="#">

                                                    Listar Factoring

                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo Url::to(['factoring/create']);  ?>" title="#">
                                                    Nueva Factoring
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a aria-expanded="false" href="#">
                                            <i class="ion-cash"></i>
                                            <span class="menu-title">Caja Chica</span>
                                            <i class="arrow"></i>
                                        </a>
                                        <ul class="collapse" aria-expanded="false" style="height: 0px;">
                                            <li>

                                                <a href="<?php echo Url::to(['caja-chica/index']);  ?>" title="#">

                                                    Listar Cajas

                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo Url::to(['caja-chica/create']);  ?>" title="#">
                                                    Nueva Caja Chica
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                </ul>




                            </div>
                        </div>
                    </div>
                    <!--================================-->
                    <!--End menu-->

                </div>
            </nav>
            <!--===================================================-->
            <!--END MAIN NAVIGATION-->

        </div>



        <!-- FOOTER -->
        <!--===================================================-->
        <footer id="footer">

            <!-- Visible when footer positions are fixed -->
            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
            <div class="show-fixed pad-rgt pull-right">
                You have <a href="#" class="text-main"><span class="badge badge-danger">3</span> pending action.</a>
            </div>



            <!-- Visible when footer positions are static -->
            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
            <div class="hide-fixed pull-right pad-rgt">
                14GB of <strong>512GB</strong> Free.
            </div>



            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
            <!-- Remove the class "show-fixed" and "hide-fixed" to make the content always appears. -->
            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

            <p class="pad-lft">&#0169; 2018 Your Company</p>



        </footer>
        <!--===================================================-->
        <!-- END FOOTER -->


        <!-- SCROLL PAGE BUTTON -->
        <!--===================================================-->
        <button class="scroll-top btn">
            <i class="pci-chevron chevron-up"></i>
        </button>
        <!--===================================================-->
    </div>
    <style>
        .select2-container--open {
            z-index: 9999999
        }
    </style>

    <script>
        jQuery(document).ready(function() {

            $.get('https://api.cmfchile.cl/api-sbifv3/recursos_api/dolar', {
                    apikey: 'ca5a65fcffdb1d25c087519c08f68e8af9ca88a7',
                    formato: 'json',
                },
                function(returnedData) {

                    document.getElementById("dolar").innerHTML = returnedData.Dolares[0].Valor;

                });


        });
    </script>




    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>