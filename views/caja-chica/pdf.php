<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use app\models\GastosCajaChica;




?>
<style>
    .center {
        margin-left: auto;
        margin-right: auto;
    }

    .myTable {
        border: solid 1px #DDEEEE;
        border-collapse: collapse;
        border-spacing: 0;
        font: normal 13px Arial, sans-serif;
    }

    .myTable thead th {
        background-color: #DDEFEF;
        border: solid 1px #DDEEEE;
        color: #336B6B;
        padding: 10px;
        text-align: left;
        text-shadow: 1px 1px 1px #fff;
    }

    .myTable tbody td {
        border: solid 1px #DDEEEE;
        color: #333;
        padding: 10px;
        text-shadow: 1px 1px 1px #fff;
    }

    .myTable-rounded {
        border: none;
    }

    .myTable-rounded thead th {
        background-color: #CCC;
        border: none;
        text-shadow: 1px 1px 1px #ccc;
        color: #333;
    }

    .myTable-rounded thead th:first-child {
        border-radius: 10px 0 0 0;
    }

    .myTable-rounded thead th:last-child {
        border-radius: 0 10px 0 0;
    }

    .myTable-rounded tbody td {
        border: none;
        border-top: solid 1px #957030;
        background-color: #EEE;
    }

    .myTable-rounded tbody tr:last-child td:first-child {
        border-radius: 0 0 0 10px;
    }

    .myTable-rounded tbody tr:last-child td:last-child {
        border-radius: 0 0 10px 0;
    }

    table.jp {
        border-width: 1px;
        border-style: solid;
        padding: 10px;
        border-color: #eeeeee;
    }

    td.jp {
        border-width: 1px;
        border-style: solid;
        padding: 18px;
        border-color: #eeeeee;
    }
</style>


<h3>Caja Chica Nº:<?php echo $model->idCajachica; ?></h3>
<p>Usuario:<?php echo $model->usuario->nombreUsuario; ?></p>
<p>Monto Asignado: <?php echo number_format($model->monto, '0', ',', '.'); ?></p>
<p>Fecha de Creacion de la caja chica: <?php echo $model->fechaCreacion; ?></p>
<p>Saldo de la caja chica: <?php echo number_format($model->saldo, '0', ',', '.'); ?></p>





<div id="GFG" style="background-color:white; padding:20px;">

    <h2 class="boxHeadline">Gastos rendidos: <strong></strong></h2>
    <?php
    $dales = GastosCajaChica::find()->where(['idCajachica' => $model->idCajachica])->all();

    foreach ($dales as $dale) {
    ?>
        <table class="center" border="1">
            <thead>
                <tr>

                    <th>Id Gasto</th>
                    <th>Fecha Gasto</th>
                    <th>Motivo Gasto</th>
                    <th>Monto</th>

                </tr>
            </thead>
            <tbody>


                <tr>
                    <td>
                        <p><strong> </strong><?php echo $dale->id_gastoCajaChica; ?></p>
                    </td>
                    <td>
                        <p><strong></strong><?php echo Yii::$app->formatter->asDate($dale->fechaGasto, 'd/M/Y'); ?></p>
                    </td>
                    <td>
                        <p><strong></strong><?php echo $dale->motivo; ?></p>
                    </td>


                    <td>
                        <p><strong></strong><?php echo number_format($dale->monto, 0, ' ', '.'); ?></p>
                    </td>

                </tr>
                <tr>





                </tr>





            </tbody>
        </table>
        <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br>
    <?php
    }

    ?>
</div>