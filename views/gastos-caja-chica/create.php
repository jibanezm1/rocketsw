<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GastosCajaChica */

$this->title = 'Create Gastos Caja Chica';
$this->params['breadcrumbs'][] = ['label' => 'Gastos Caja Chicas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gastos-caja-chica-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
