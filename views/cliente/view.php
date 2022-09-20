<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Cotizacion;
use app\models\ContactoCliente;
use app\models\ContactoClienteSearch;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */

$this->title = $model->nombreCliente;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clientes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="panel">
	<div class="panel-heading">
		<h1><?= Html::encode($this->title) ?></h1>

		<p>
			<?= Html::a(Yii::t('app', 'Actualizar Datos cliente'), ['update', 'id' => $model->rutCliente], ['class' => 'btn bg-purple']) ?>
			<?= Html::a(Yii::t('app', 'Deshabilitar Cliente'), ['delete', 'id' => $model->rutCliente], [
				'class' => 'btn bg-red',
				'data' => [
					'confirm' => Yii::t('app', 'Seguro que desea Deshabilitar este cliente?'),
					'method' => 'post',
				],
			]) ?>
		</p>
		<br>
	</div>
	<div class="panel-body">

		<?= DetailView::widget([
			'model' => $model,
			'attributes' => [
				'rutCliente',
				'nombreCliente',
				'direccionCliente',
				'giroCliente',
				'telefonoCliente',
				'regionCliente',
				'comunaCliente',
				'correoCliente',
			],
		]) ?>

		<h2>Listado de Contactos: <strong></strong></h2>

		<?php

		$searchModel = new ContactoClienteSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->andWhere(["rutCliente" => $model->rutCliente]);
		echo  GridView::widget([
			'dataProvider' => $dataProvider,
			'filterModel' => $searchModel,

			'columns' => [
				['class' => 'yii\grid\SerialColumn'],

				'idCliente',
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'nombreCliente',
					'vAlign' => 'middle',
					'headerOptions' => ['class' => 'kv-sticky-column'],
					'contentOptions' => ['class' => 'kv-sticky-column'],
					'editableOptions' => [
						'asPopover' => false,
						'formOptions' => ['action' => ['/cliente/editbook']],
					]

				],
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'correoCliente',
					'vAlign' => 'middle',
					'headerOptions' => ['class' => 'kv-sticky-column'],
					'contentOptions' => ['class' => 'kv-sticky-column'],
					'editableOptions' => [
						'asPopover' => false,
						'formOptions' => ['action' => ['/cliente/editbook']],
					]

				],
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'numeroCliente',
					'vAlign' => 'middle',
					'headerOptions' => ['class' => 'kv-sticky-column'],
					'contentOptions' => ['class' => 'kv-sticky-column'],
					'editableOptions' => [
						'asPopover' => false,
						'formOptions' => ['action' => ['/cliente/editbook']],
					]

				],
				[
					'class' => 'yii\grid\ActionColumn',
					'template' => "{delete}",
					'buttons' => [
						'delete' => function ($url, $model) {
							return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['/contacto-cliente/delete', 'id' => $model->idCliente], ['title' => 'Excluir', 'data-method' => 'post', 'data-confirm' => "Deseja realmente excluir este item?"]);
						},
					],
				],
			],
		]);
		?>

		<h2 class="boxHeadline">Listado de ultimos Movimientos: <strong></strong></h2>

		<table class="table js-datatable">
			<thead>
				<tr>

					<th>Id Cotizacion</th>
					<th>Empresa</th>
					<th>Empresa de venta</th>
					<th>Valor neto Venta</th>
					<th>IVA</th>
					<th>Total</th>
					<th>fecha</th>
					<th>Acciones</th>

				</tr>
			</thead>
			<tbody>

				<?php
				$models = Cotizacion::find()->where(['rutCliente' => $model->rutCliente])->all();

				foreach ($models as $model) {
				?>
					<tr>
						<td>
							<p><strong> </strong><?php echo $model->idcotizacion; ?></p>
						</td>
						<td>
							<p><strong></strong><?php echo $model->cliente->nombreCliente; ?></p>
						</td>
						<td>
							<p><strong></strong><?php echo $model->idempresa0->nombreEmpresa; ?></p>
						</td>
						<td>
							<p><strong></strong><?php echo $model->totalNeto; ?></p>
						</td>
						<td>
							<p><strong></strong><?php echo $model->IVA; ?></p>
						</td>
						<td>
							<p><strong></strong><?php echo $model->Total; ?></p>
						</td>
						<td>
							<p><strong></strong><?php echo Yii::$app->formatter->asDate($model->fecha, 'd/M/Y'); ?></p>
						</td>
						<td><?= Html::a(Yii::t('app', 'Ver cotizacion'),  ['cotizacion/view', 'idcotizacion' => $model->idcotizacion, 'rutCliente' => $model->rutCliente, 'rutUsuario' => $model->rutUsuario, 'idempresa' => $model->idempresa], ['class' => 'btn btn-primary']) ?></td>
					</tr>

				<?php
				}

				?>



			</tbody>
		</table>
	</div>
</div>