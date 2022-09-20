<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\GastosProyecto */

if ($model->idProyecto) {
    $this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['site/inicio']];
    $this->params['breadcrumbs'][] = ['label' => $model->proyecto->cliente->nombreCliente, 'url' => ['cliente/proyectos?rutCliente=' . $model->proyecto->rutCliente]];
    $this->params['breadcrumbs'][] = ['label' => "#" . $model->idProyecto, 'url' => ['proyectos/view?id=' . $model->idProyecto]];
    $this->params['breadcrumbs'][] = $this->title;
}
\yii\web\YiiAsset::register($this);
?>

<div class="panel">
    <div class="panel-heading">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a(Yii::t('app', 'Eliminar Gasto'), ['delete', 'id' => $model->idGastos], [
                'class' => 'btn btn-primary',
                'data' => [
                    'confirm' => Yii::t('app', 'Seguro que desea eliminar el gasto?'),
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    </div>
    <div class="panel-body" style="padding:10px;">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'fechaGasto',
                'Titulo',
                'motivoGasto',
                'usuario.nombreUsuario',
                [
                    'format' => 'raw',
                    'label' => 'Tipo de Recibo',
                    'value' => function ($model) {
                        if ($model->tipoRecibo == 1) {
                            return "Factura";
                        }
                        if ($model->tipoRecibo == 2) {
                            return "Boleta";
                        }
                        if ($model->tipoRecibo == 3) {
                            return "Otro";
                        }
                    }
                ],
                [
                    'format' => 'raw',
                    'label' => 'Tipo de Documento',
                    'value' => function ($model) {
                        if ($model->tipoRecibo == 1) {
                            return "Transferencia";
                        }
                        if ($model->tipoRecibo == 2) {
                            return "Efectivo";
                        }
                        if ($model->tipoRecibo == 3) {
                            return "Cheque";
                        }
                    }
                ],
                [
                    'format' => 'raw',
                    'label' => 'Evidencia de Gasto',
                    'value' => function ($model) {
                        return '<a class="btn btn-primary" target="_blank" href="../../web' . $model->fotoGasto . '" > Descargar archivo </a>';
                    }
                ]

            ],
        ]) ?>
    </div>
</div>