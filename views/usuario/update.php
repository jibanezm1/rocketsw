<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = 'Actualizar Usuario: ' . $model->rutUsuario;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombreUsuario, 'url' => ['view', 'rutUsuario' => $model->rutUsuario, 'idTipoUsuario' => $model->idTipoUsuario]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="usuario-create">
<div class="box taskCard">
		<div class="rte">
			<h2 class="title">
            <?= Html::encode($this->title) ?>
            </h2>
        </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>