<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ClienteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Listado de Clientes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel">
    <div class="panel-heading">

        <h3><?= Html::encode($this->title) ?></h3>
        <?= Html::a(Yii::t('app', 'Crear un nuevo Cliente'), ['create'], ['class' => 'btn btn-success']) ?></h2>
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

                            'rutCliente',
                            'nombreCliente',
                            'direccionCliente',
                            //'giroCliente',
                            //'telefonoCliente',
                            //'regionCliente',
                            //'comunaCliente',
                            'correoCliente',
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