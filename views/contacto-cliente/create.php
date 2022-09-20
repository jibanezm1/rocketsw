<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ContactoCliente */

$this->title = Yii::t('app', 'Agregar nuevo Contacto al cliente');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cliente'), 'url' => ['cliente/view', 'id' => $_GET["rutCliente"]]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel">
    <div class="panel-heading">
    <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="panel-body">
    <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
