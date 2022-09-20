<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GastosProyecto */

$this->title = Yii::t('app', 'Create Gastos Proyecto');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gastos Proyectos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gastos-proyecto-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
