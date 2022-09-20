<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProveedorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Proveedores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel">
    <div class="panel-heading">

        <h3><?= Html::encode($this->title) ?></h3>
        <?= Html::a('Ingresar un nuevo Proveedor', ['create'], ['class' => 'btn btn-success']) ?>

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
                            ['class' => 'yii\grid\SerialColumn'],

                            'rutProveedor',
                            'nombreProveedor',
                            'direccionProveedor',
                            'giroProveedor',
                            'telefonoProveedor',
                            //'regionProveedor',
                            //'comunaProveedor',
                            //'correoProveedor',

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