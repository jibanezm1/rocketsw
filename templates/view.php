<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\GastosCajaChica */

$this->title = $model->id_gastoCajaChica;
$this->params['breadcrumbs'][] = ['label' => 'Gastos Caja Chicas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="gastos-caja-chica-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_gastoCajaChica], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_gastoCajaChica], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_gastoCajaChica',
            'documento',
            'idCajachica',
            'monto',
            'fechaGasto',
            'idProyecto',
            'idGasto',
            'motivo',
        ],
    ]) ?>

</div>
