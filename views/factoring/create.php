<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Factoring */

$this->title = 'Crear nuevo Factoring';
$this->params['breadcrumbs'][] = ['label' => 'Factorings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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