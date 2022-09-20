<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Banco */

$this->title = $model->nombreBanco;
$this->params['breadcrumbs'][] = ['label' => 'Bancos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="panel">
    <div class="panel-heading">
    <h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('Actualizar', ['update', 'id' => $model->idbanco], ['class' => 'btn btn-primary']) ?>
 
</p>
    </div>
    <div class="panel-body" style="padding:10px;">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            'nombreBanco',
            'tipoCTA',
            'nombreEjecutivo',
            'direccionEjecutivo',
            'correoEjecutivo',
            'telefonoEjecutivo',
        ],
    ]) ?>
    </div>
</div>


