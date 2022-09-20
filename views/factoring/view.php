<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Factoring */

$this->title = $model->nombreFactoring;
$this->params['breadcrumbs'][] = ['label' => 'Factoring', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="box taskCard">
    <div class="rte">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->idFactoring], ['class' => 'btn btn-primary']) ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idFactoring',
            'nombreFactoring',
        ],
    ]) ?>

</div>
</div>