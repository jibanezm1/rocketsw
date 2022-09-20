<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\GastosCajaChicaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gastos Caja Chicas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gastos-caja-chica-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Gastos Caja Chica', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_gastoCajaChica',
            'documento',
            'idCajachica',
            'monto',
            'fechaGasto',
            //'idProyecto',
            //'idGasto',
            //'motivo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
