<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PagoVenta */


if ($model->venta->idProyecto) {
    $this->title = $model->idNotaVenta;
    $this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['site/inicio']];
    $this->params['breadcrumbs'][] = ['label' => $model->venta->proyecto->cliente->nombreCliente, 'url' => ['cliente/proyectos?rutCliente=' . $model->venta->proyecto->rutCliente]];
    $this->params['breadcrumbs'][] = ['label' => "#" . $model->venta->idProyecto, 'url' => ['proyectos/view?id=' . $model->venta->idProyecto]];
    $this->params['breadcrumbs'][] = $this->title;
} else {
    $this->title = $model->idNotaVenta;
    $this->params['breadcrumbs'][] = ['label' => 'Nota Ventas', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
}



\yii\web\YiiAsset::register($this);
?>



<div class="panel">
    <div class="panel-heading">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Actualizar', ['update', 'id' => $model->idPago], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Eliminar pago', ['delete', 'id' => $model->idPago], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Seguro que desea eliminar el pago?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>

    </div>
    <div class="panel-body" style="padding:10px;">
    <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'idPago',
                'idNotaVenta',
                'forma',
                'fecha',
                'banco.nombreBanco',
                [
                    'attribute' => 'factorizada',
                    'value' => function ($model) {
                        if ($model->factorizada == 1) {
                            return "Si";
                        } else {
                            return "No";
                        }
                    }
                ],

                'factoring.nombreFactoring',
                'porcentajePago',
                [
                    'attribute' => 'imagen',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return '<a target="_blank" class="btn bg-green" href="..' . $model->imagen . '">Ver pago</a>';
                    }
                ]
            ],
        ]) ?>
    </div>
</div>



