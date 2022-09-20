<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ContactoCliente */

$this->title = Yii::t('app', 'Update Contacto Cliente: {name}', [
    'name' => $model->idCliente,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contacto Clientes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idCliente, 'url' => ['view', 'id' => $model->idCliente]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="contacto-cliente-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
