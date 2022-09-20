<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box taskCard">
		<div class="rte">
			<h2 class="title">
            <?= Html::encode($this->title) ?>
            <?= Html::a('Crear un nuevo Usuario', ['create'], ['class' => 'btn btn-success']) ?>
        </div>



<div class="usuario-index">

 


    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'autoXlFormat'=>true,
        'toggleDataContainer' => ['class' => 'btn-group mr-2'],
        'export'=>[
            'showConfirmAlert'=>false,
            'target'=>GridView::TARGET_BLANK
        ],
        'pjax'=>true,
        'showPageSummary'=>true,
        'panel'=>[
            'type'=>'primary',
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'rutUsuario',
            'dv',
            'nombreUsuario',
            'apellidosUsuario',
            //'fechaIngreso',
            //'idTipoUsuario',
            //'clave',
            'correo',
            'telefono',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
</div>