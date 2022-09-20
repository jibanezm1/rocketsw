<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Banco */

$this->title = 'Update Banco: ' . $model->idbanco;
$this->params['breadcrumbs'][] = ['label' => 'Bancos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idbanco, 'url' => ['view', 'id' => $model->idbanco]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="panel">
    <div class="panel-heading">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="panel-body" style="padding:10px;">
        <?= $this->render('_form', [
            'model' => $model,
       
        ]) ?>
    </div>
</div>
