<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Proveedor */

$this->title = $model->nombreProveedor;
$this->params['breadcrumbs'][] = ['label' => 'Proveedor', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="panel">
    <div class="panel-heading">
        <h1><?= Html::encode($this->title) ?></h1>
        <p>
            <?= Html::a('Actualizar datos del proveedor', ['update', 'id' => $model->rutProveedor], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Eliminar Proveedor de la base de datos', ['delete', 'id' => $model->rutProveedor], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Seguro que desea eliminar el proveedor?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    </div>
    <div class="panel-body">
    <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'rutProveedor',
                'nombreProveedor',
                'direccionProveedor',
                'giroProveedor',
                'telefonoProveedor',

                'correoProveedor',
            ],
        ]) ?>
    </div>
</div>




