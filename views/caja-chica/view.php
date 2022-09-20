<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use app\models\GastosCajaChica;



/* @var $this yii\web\View */
/* @var $model app\models\CajaChica */

$this->title = $model->idCajachica;
$this->params['breadcrumbs'][] = ['label' => 'Caja Chicas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<?php
Modal::begin([
    'header' => '<h4>Nueva rendicion de caja chica</h4>',
    'id' => 'modal',
    'size' => 'modal-lg',
]);

echo "<div  id='modalContent'></div>";
Modal::end();
?>
<div class="panel">
    <div class="panel-heading">
        <h1>Caja Chica N°:<?= Html::encode($this->title) ?></h1>
        <p>
            <?php
            $session = Yii::$app->session;
            $session->open();
            $user_id = $session->get('usuario');
            if ($user_id->rutUsuario == 101010 || $user_id->rutUsuario == 303030) {
                echo Html::a('Actualizar', ['update', 'id' => $model->idCajachica], ['class' => 'btn btn-primary']);
                echo Html::a('Eliminar', ['delete', 'id' => $model->idCajachica], [
                    'class' => 'btn bg-green',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]);
            }

            echo Html::a('Exportar Caja Chica', ['exportar', 'id' => $model->idCajachica], ['class' => 'btn btn-primary']);
            echo Html::a('Rendiciones en proyecto', ['create2'], ['class' => 'btn btn-primary']);


            ?>

            <?= Html::button('Nueva Rendicion General ', ['value' => Url::to('../gastos-caja-chica/create?idCajachica=' . $model->idCajachica), 'class' => 'btn btn-primary', 'id' => 'modalbutton']) ?>

        </p>
    </div>
    <div class="panel-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'idCajachica',
                [
                    'format' => 'Currency',
                    'attribute' => 'monto',
                    'format' => ['decimal', 0]


                ],
                'usuario.nombreUsuario',
                [
                    'attribute' => 'estado',
                    'value' => function ($model) {
                        if ($model->estado == 1) {
                            return "Activa";
                        }
                        if ($model->estado == 2) {
                            return "Pendiente";
                        }
                    }
                ],
                [
                    'format' => 'Currency',
                    'attribute' => 'saldo',
                    'format' => ['decimal', 0]


                ],
            ],
        ]) ?>
    </div>
</div>






<div class="panel">
    <div class="panel-heading">
        <h2 class="boxHeadline">Detalles de Gasto: <strong></strong></h2>
    </div>
    <div class="panel-body">

        <table class="table js-datatable">
            <thead>
                <tr>

                    <th>Id Gasto</th>
                    <th>Fecha Gasto</th>
                    <th>Motivo Gasto</th>
                    <th>Monto</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>

                <?php
                $dales = GastosCajaChica::find()->where(['idCajachica' => $model->idCajachica])->all();

                foreach ($dales as $dale) {
                ?>
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



                        <td> <a target="_blank" class="btn btn-success" href="../web/<?php echo $dale->documento; ?>">Ver rendicion</a></td>
                    </tr>

                <?php
                }

                ?>



            </tbody>
        </table>
    </div>
</div>



<style>
    #modalContent {
        margin-top: 0px !important;

    }
</style>