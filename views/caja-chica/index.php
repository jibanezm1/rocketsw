<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Caja-Chica');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel">
    <div class="panel-heading">

        <h3><?= Html::encode($this->title) ?></h3>
        <?php
        $session = Yii::$app->session;
        $session->open();
        $user_id = $session->get('usuario');
        if ($user_id->rutUsuario == 1) {
            echo Html::a(Yii::t('app', 'Crear nueva Caja-chica'), ['create'], ['class' => 'btn btn-success']);
        }

        ?>
    </div>
    <div class="panel-body">
        <div class="bootstrap-table">


            <div class="fixed-table-container" style="padding-bottom: 0px;">
                <div class="fixed-table-body">
                    <?php Pjax::begin(); ?>

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
                            'usuario.nombreUsuario',
                            'idCajachica',

                            [
                                'format' => 'Currency',
                                'attribute' => 'saldo',
                                'format' => ['decimal', 0]


                            ],


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
                                'attribute' => 'monto',
                                'format' => ['decimal', 0]


                            ],


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