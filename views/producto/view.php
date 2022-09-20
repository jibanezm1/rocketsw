<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\DetalleCotizacion;
use app\models\DetalleOrdenIngreso;
use app\models\DetalleNota;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */

$this->registerCssFile("../web/nifty/plugins/unitegallery/css/unitegallery.min.css");
$this->registerJsFile("../web/nifty/plugins/unitegallery/js/unitegallery.min.js");
$this->registerJsFile("../web/nifty/plugins/unitegallery/themes/tilesgrid/ug-theme-tilesgrid.js");


// plugins/unitegallery/themes/tilesgrid/ug-theme-tilesgrid.js


$this->title = $model->nombreProducto;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Productos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<style>
	.row.tabla {
		margin: 0px 0px 100px 20px;
	}
</style>
<div class="panel">
	<div class="panel-heading">
		<h1><?= Html::encode($this->title) ?></h1>
		<?= Html::a(Yii::t('app', 'Actualizar Producto'), ['update', 'id' => $model->idproducto], ['class' => 'btn btn-primary']) ?>

		<?php



		$session = Yii::$app->session;
		$session->open();
		$user_id = $session->get('usuario');

		if ($user_id->idTipoUsuario0->idTipoUsuario == 1) {
			echo Html::a(Yii::t('app', 'Deshabilitar'), ['delete', 'id' => $model->idproducto], [
				'class' => 'btn btn-danger',
				'data' => [
					'confirm' => Yii::t('app', 'Seguro que desea eliminar este producto	?'),
					'method' => 'post',
				],
			]);
		} ?>

	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-6">
				<?= DetailView::widget([
					'model' => $model,
					'attributes' => [
						'SKU',
						'nombreProducto',
						'descripcionProducto',
						'precioLista',
						'stock',
					],
				]) ?>
			</div>
			<div class="col-md-6">

				<div class="panel">



					<?php
					$indice = 1;

					if ($model->imagen) {
					?>
						<div style="text-align: center;">
							<img style="width: 70%;" src="<?php echo $model->imagen; ?>">

						</div>

					<?php
					} else {
					?>
						<div class="pad-all">
							<div id="demo-gallery">

								<?php

								foreach ($fotosProductos as $f) {
								?>
									<a href="../web/<?php echo $f->ruta; ?>">
										<img alt="The winding road" src="../web/<?php echo $f->ruta; ?>" data-image="../web/<?php echo $f->ruta; ?>" data-description="The winding road description" style="display:none">
									</a>

								<?php
								}
								?>
							</div>
						</div>
					<?php
					} ?>



				</div>
			</div>

		</div>
		<div class="row tabla">
			<div class="col-md-12">
				<h4>Listado de Documentos del producto</h4>
				<ul class="content-list">
					<?php foreach ($documentos as $documento) {
					?>

						<li><a target="_blank" href="<?php echo $documento->ruta; ?>">DESCARGAR</a> <?php echo $documento->descripcionArchivo; ?></li>


					<?php
					} ?>

				</ul>

				<hr>
			</div>

		</div>
		<div class="row tabla">
			<h2>Listado de ultimas Compras: <strong></strong></h2>

			<table class="table js-datatable">
				<thead>
					<tr>

						<th>Id Cotizacion</th>
						<th>Proveedor</th>
						<th>Cantidad</th>
						<th>Valor de compra unitario</th>
						<th>Total</th>
						<th>fecha</th>
						<th>Acciones</th>

					</tr>
				</thead>
				<tbody>

					<?php
					$models = DetalleOrdenIngreso::find()->where(['idproducto' => $model->idproducto])->all();

					foreach ($models as $model) {
					?>
						<tr>
							<td>
								<p><strong> </strong><?php echo $model->idordenIngreso; ?></p>
							</td>
							<td>
								<p><strong></strong><?php echo $model->idordenIngreso0->rutProveedor0->nombreProveedor; ?></p>
							</td>
							<td>
								<p><strong></strong><?php echo $model->cantidad; ?></p>
							</td>
							<td>
								<p><strong></strong><?php echo $model->precio; ?></p>
							</td>
							<td>
								<p><strong></strong><?php echo $model->total; ?></p>
							</td>
							<td>
								<p><strong></strong><?php echo Yii::$app->formatter->asDate($model->idordenIngreso0->fechaIngreso, 'd/M/Y'); ?></p>
							</td>
							<td> <?= Html::a('Ver Guia de ingreso', ['orden-ingreso/view', 'idordenIngreso' => $model->idordenIngreso, 'rutProveedor' => $model->idordenIngreso0->rutProveedor], ['class' => 'btn btn-primary']) ?></td>
						</tr>

					<?php
					}

					?>



				</tbody>
			</table>
		</div>
		<div class="row tabla">
			<h2 class="boxHeadline">Listado de ultimas cotizaciones: <strong></strong></h2>

			<table class="table js-datatable">
				<thead>
					<tr>

						<th>Id Cotizacion</th>
						<th>Empresa</th>
						<th>Cliente</th>
						<th>Cantidad</th>
						<th>Valor de venta Unitario</th>
						<th>Total</th>
						<th>fecha</th>
						<th>Acciones</th>

					</tr>
				</thead>
				<tbody>

					<?php
					$models = DetalleCotizacion::find()->where(['idproducto' => $model->idproducto])->all();

					foreach ($models as $model) {
					?>
						<tr>
							<td>
								<p><strong> </strong><?php echo $model->idcotizacion; ?></p>
							</td>
							<td>
								<p><strong></strong><?php echo $model->idcotizacion0->idempresa0->nombreEmpresa; ?></p>
							</td>
							<td>
								<p><strong></strong><?php echo $model->idcotizacion0->rutCliente0->nombreCliente; ?></p>
							</td>
							<td>
								<p><strong></strong><?php echo $model->cantidad; ?></p>
							</td>
							<td>
								<p><strong></strong><?php echo $model->precio; ?></p>
							</td>
							<td>
								<p><strong></strong><?php echo $model->total; ?></p>
							</td>
							<td>
								<p><strong></strong><?php echo Yii::$app->formatter->asDate($model->idcotizacion0->fecha, 'd/M/Y'); ?></p>
							</td>
							<td><?= Html::a(Yii::t('app', 'Ver cotizacion'),  ['cotizacion/view', 'idcotizacion' => $model->idcotizacion0->idcotizacion, 'rutCliente' => $model->idcotizacion0->rutCliente, 'rutUsuario' => $model->idcotizacion0->rutUsuario, 'idempresa' => $model->idcotizacion0->idempresa], ['class' => 'btn btn-primary']) ?></td>
						</tr>

					<?php
					}

					?>



				</tbody>
			</table>
		</div>
		<div class="row tabla">
			<h2 class="boxHeadline">Listado de ultimas Ventas: <strong></strong></h2>

			<table class="table js-datatable">
				<thead>
					<tr>

						<th>Id Venta</th>
						<th>Empresa</th>
						<th>Cliente</th>
						<th>Cantidad</th>
						<th>Valor de venta Unitario</th>
						<th>Total</th>
						<th>fecha</th>
						<th>Acciones</th>

					</tr>
				</thead>
				<tbody>

					<?php
					$models = DetalleNota::find()->where(['idproducto' => $model->idproducto])->all();

					foreach ($models as $model) {
					?>
						<tr>
							<td>
								<p><strong> </strong><?php echo $model->idNota; ?></p>
							</td>
							<td>
								<p><strong></strong><?php echo $model->idNota0->idempresa0->nombreEmpresa; ?></p>
							</td>
							<td>
								<p><strong></strong><?php echo $model->idNota0->rutCliente0->nombreCliente; ?></p>
							</td>
							<td>
								<p><strong></strong><?php echo $model->cantidad; ?></p>
							</td>
							<td>
								<p><strong></strong><?php echo $model->precio; ?></p>
							</td>
							<td>
								<p><strong></strong><?php echo $model->total; ?></p>
							</td>
							<td>
								<p><strong></strong><?php echo Yii::$app->formatter->asDate($model->idNota0->fecha, 'd/M/Y'); ?></p>
							</td>
							<td> <?= Html::a('Ver Venta', ['nota-venta/view', 'idNotaVenta' => $model->idNota0->idNotaVenta, 'rutCliente' => $model->idNota0->rutCliente, 'rutUsuario' => $model->idNota0->rutUsuario, 'idempresa' => $model->idNota0->idempresa], ['class' => 'btn btn-primary']) ?></td>
						</tr>

					<?php
					}

					?>



				</tbody>
			</table>
		</div>

	</div>
</div>


<script>
	jQuery(document).on('nifty.ready', function() {


		jQuery("#demo-gallery").unitegallery({
			tile_enable_shadow: false
		});


	});
</script>