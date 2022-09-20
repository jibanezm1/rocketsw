<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use app\models\PagoVenta;

/* @var $this yii\web\View */
/* @var $model app\models\NotaVenta */

if ($model->idProyecto) {
	$this->title = $model->idNotaVenta;
	$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['site/inicio']];
	$this->params['breadcrumbs'][] = ['label' => $model->proyecto->cliente->nombreCliente, 'url' => ['cliente/proyectos?rutCliente=' . $model->proyecto->rutCliente]];
	$this->params['breadcrumbs'][] = ['label' => "#" . $model->idProyecto, 'url' => ['proyectos/view?id=' . $model->idProyecto]];
	$this->params['breadcrumbs'][] = $this->title;
} else {
	$this->title = $model->idNotaVenta;
	$this->params['breadcrumbs'][] = ['label' => 'Nota Ventas', 'url' => ['index']];
	$this->params['breadcrumbs'][] = $this->title;
}

\yii\web\YiiAsset::register($this);
?>
<?php
Modal::begin([
	'header' => '<h4>Gestionar pago de Factura</h4>',
	'id' => 'modal',
	'size' => 'modal-lg',
]);

echo "<div id='modalContent'></div>";
Modal::end();
?>
<style>
	.statsBar .i .c .icon {
		width: 50px !important;
	}


	.statsBar .i .c .icon,
	.statsBar .i .c:before {
		width: 55px !important;
	}

	.statsBar .i .c .num {
		font-size: 2.1rem !important;
	}
</style>
<style>
	.modal-content {
		margin-top: 100px !important;
	}

	h3.title {
		width: 200px;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
	}

	h4.title {
		width: 200px;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
	}
</style>
<div class="panel">
	<div class="panel-heading">
		<h1>Venta Nº:<?= Html::encode($this->title) ?></h1>



		<p>
			<?= Html::a('Actualizar datos y detalle de venta', ['update', 'idNotaVenta' => $model->idNotaVenta, 'rutCliente' => $model->rutCliente, 'rutUsuario' => $model->rutUsuario, 'idempresa' => $model->idempresa], ['class' => 'btn btn-primary']) ?>
			<?= Html::a('Eliminar Venta', ['delete', 'idNotaVenta' => $model->idNotaVenta, 'rutCliente' => $model->rutCliente, 'rutUsuario' => $model->rutUsuario, 'idempresa' => $model->idempresa], [
				'class' => 'btn btn-danger',
				'data' => [
					'confirm' => 'Al eliminar la venta el stock de venta sera reintegrado al inventario',
					'method' => 'post',
				],
			]) ?>
			<?= Html::button('Gestionar Pago ', ['value' => Url::to('../pago-venta/create?idNotaVenta=' . $model->idNotaVenta), 'class' => 'btn btn-primary', 'id' => 'modalbutton']) ?>

		</p>
		<h4> <a href="../cotizacion/view?idcotizacion=<?php echo $model->idCotizacion; ?>&rutCliente=<?php echo $model->rutCliente; ?>&rutUsuario=<?php echo $model->rutUsuario; ?>&idempresa=<?php echo $model->idempresa; ?>' title=" #"> <?php if ($model->idCotizacion) {
																																																												echo "Cotizacion de referencia: " . $model->idCotizacion;
																																																											} ?></a></h4>

	</div>

	<div class="panel-body">
		<div class="row">
			<div class="col-sm-6">
				<img style="width: 22%;padding: 10px;" src="/web/logo1.png" />
			</div>
			<div class="col-sm-6 text-right">
				<h5 style="margin-top: 30px;">Fecha de Cotizacion: <?php echo date('d/m/Y', strtotime($model->fecha)); ?> </h5>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-sm-6">
				<h5>Venta Nº:<?php echo $model->idNotaVenta; ?></h5>
				<address>
					<strong><?php echo $model->idempresa0->nombreEmpresa; ?></strong><br>
					Direccion: XXXXX<br>
					Region Metropolitana, Santiago<br>
					<abbr title="Phone">P:</abbr> <a href="tel:1234567891" title="#" class="text-gray">(+569) 40184459</a>
				</address>
			</div>

			<div class="col-sm-6 text-right">
				<address>
					<strong><?php echo $model->rutCliente0->nombreCliente; ?></strong><br><br>
					<?php echo $model->rutCliente0->direccionCliente; ?><br>
					<?php echo $model->rutCliente0->regionCliente; ?>, <?php echo $model->rutCliente0->comunaCliente; ?><br>
					<abbr title="Telefono">Telefono:</abbr> <a href="tel:1234567891" title="#" class="text-gray"><?php echo $model->rutCliente0->telefonoCliente; ?></a>
				</address>
			</div>
		</div>






		<div class="tableWrap table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th style="text-align: center;" width="14.2%" align="center">Codigo</th>
						<th style="text-align: center;" width="14.2%" align="center">Fotografia</th>
						<th style="text-align: center;" width="14.2%" align="center">Descripcion</th>
						<th style="text-align: center;" width="14.2%" align="center">Entrega</th>
						<th style="text-align: center;" width="14.2%" align="center">Cantidad</th>
						<th style="text-align: center;" width="14.2%" align="center">Precio Unitario</th>
						<th style="text-align: center;" width="14.2%" align="center">Total</th>
					</tr>
				</thead>
				<tbody>

					<?php foreach ($model->detalle as $d) {
					?>
						<tr>
							<td width="14.2%" align="center"><?php echo $d->idproducto0->SKU; ?></td>
							<td width="14.2%" align="center"><img style="width: 150px; padding:10px;" src="../web/<?php $i = 0;
																													foreach ($d->idproducto0->fotosProductos as $foto) {
																														if ($i == 0) {
																															echo $foto->ruta;
																															$i++;
																														}
																													} ?>" /></td>
							<td width="14.2%" align="center"> <?php echo $d->idproducto0->nombreProducto; ?></td>
							<td width="14.2%" align="center"> <?php echo $d->tiempo; ?></td>
							<td width="14.2%" align="center"><?php echo number_format($d->cantidad, '0', ',', '.'); ?></td>
							<td width="14.2%" align="center">$<?php echo number_format($d->precio, '0', ',', '.'); ?></td>
							<td width="14.2%" align="center"><strong>$<?php echo number_format($d->total, '0', ',', '.'); ?></strong></td>
						</tr>

					<?php
					} ?>



				</tbody>
			</table>


			<table style="float: right;margin-right: 15px;">
				<thead>
					<tr>

						<th></th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><strong>Neto: </strong></td>
						<td></td>
						<td></td>
						<td><strong> $<?php
										echo number_format($model->totalNeto, '0', ',', '.')
										?></strong></td>
					</tr>
					<tr>
						<td><strong>Iva: </strong></td>
						<td></td>
						<td></td>
						<td><strong> $<?php
										echo number_format($model->IVA, '0', ',', '.')
										?></strong></td>
					</tr>
					<tr>
						<td><strong>Total: </strong></td>
						<td></td>
						<td></td>
						<td><strong> $
								<?php
								echo number_format($model->Total, '0', ',', '.')
								?>

							</strong></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="row">
			<div class="col-md-6 tableado">
				<p><strong>Evento a Cotizar:</strong><?php echo $model->evento; ?></p>
			</div>
			<div class="col-md-6 tableado">
				<p><strong>Validez de la Cotización:</strong><?php echo $model->validez; ?></p>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 tableado">
				<p><strong>Entrega:</strong><?php echo $model->entrega; ?></p>
			</div>
			<div class="col-md-6 tableado">
				<p><strong>Lugar de entrega Material:</strong>Santiago</p>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 tableado">
				<p><strong>Tipo de Moneda:</strong><?php echo $model->tipoDeMoneda; ?></p>
			</div>
			<div class="col-md-6 tableado">
				<p><strong>Valores Netos:</strong>NETOS (+ IVA)</p>
			</div>
		</div>


		<div class="row">
			<div class="col-md-6 tableado">
				<p><strong>Forma de Pago:</strong><?php echo $model->formaDePago; ?></p>
			</div>
			<div class="col-md-6 tableado">
				<p><strong>Responsable Cotizacion:</strong><?php echo $model->rutUsuario0->nombreUsuario . " " . $model->rutUsuario0->apellidosUsuario; ?></p>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 tableado">
				<p><strong>Mail:</strong><?php echo $model->rutUsuario0->correo; ?></p>
			</div>
			<div class="col-md-6 tableado">
				<p><strong>Celular:</strong><?php echo $model->rutUsuario0->correo;   ?></p>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 tableado">
				<p><strong>Comentarios: </strong><?php echo $model->comentarios;   ?></p>
			</div>
			<div class="col-md-6 tableado">
				<p><strong>Flete: </strong><?php echo $model->flete;   ?></p>
			</div>
		</div>






	</div>


</div>


<br>
<br>




<div class="panel">
	<div class="panel-heading">
		<h2 class="boxHeadline">Pagos del proyecto: <strong></strong></h2>

	</div>
	<div class="panel-body">
		<div class="row">
			<div class="">

				<table class="table js-datatable">
					<thead>
						<tr>

							<th>Id Pago</th>
							<th>Fecha Pago</th>
							<th>Forma Pago</th>
							<th>Banco</th>
							<th>Factorizada</th>
							<th>Factoring:</th>
							<th>Porcentaje de pago:</th>
							<th>Acciones</th>

						</tr>
					</thead>
					<tbody>

						<?php
						$dales = PagoVenta::find()->where(['idNotaVenta' => $model->idNotaVenta])->all();

						foreach ($dales as $dale) {
						?>
							<tr>
								<td>
									<p><strong> </strong><?php echo $dale->idPago; ?></p>
								</td>
								<td>
									<p><strong></strong><?php echo Yii::$app->formatter->asDate($dale->fecha, 'd/M/Y'); ?></p>
								</td>
								<td>
									<p><strong></strong><?php
														if ($dale->forma == 1) {
															echo "Cheque o ValeVista";
														}
														if ($dale->forma == 2) {
															echo "Transferencia";
														}
														if ($dale->forma == 3) {
															echo "Factoring";
														}

														?></p>
								</td>
								<td>
									<p><strong></strong><?php echo $dale->banco->nombreBanco; ?></p>
								</td>
								<td>
									<p><strong></strong><?php if ($dale->factorizada == 1) {
															echo "Factorizada";
														} else {
															echo "No";
														} ?></p>
								</td>
								<td>
									<p><strong></strong><?php echo $dale->factoring->nombreFactoring; ?></p>
								</td>
								<td>
									<p><strong></strong><?php echo $dale->porcentajePago; ?>%</p>
								</td>

								<td> <?= Html::a('Ver Pago', ['pago-venta/view', 'id' => $dale->idPago], ['class' => 'btn btn-primary']) ?></td>
							</tr>

						<?php
						}

						?>



					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>