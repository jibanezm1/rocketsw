<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = $model->nombreUsuario." ".$model->apellidosUsuario;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="box taskCard">
		<div class="rte">
			<h2 class="title">
            <?= Html::encode($this->title) ?>
            </h2>

    <p>
        <?= Html::a('Actualizar Usuario', ['update', 'rutUsuario' => $model->rutUsuario, 'idTipoUsuario' => $model->idTipoUsuario], ['class' => 'btn btn-primary']) ?>
       
    </p>
        </div>

  

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'rutUsuario',
            'dv',
            'nombreUsuario',
            'apellidosUsuario',
            'idTipoUsuario0.nombreTipo',
            'clave',
            'correo',
            'telefono',
        ],
    ]) ?>

</div>
