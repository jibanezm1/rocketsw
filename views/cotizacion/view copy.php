<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Cotizacion */

if ($model->idProyecto) {
	$this->title = $model->idcotizacion;
	$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['site/inicio']];
	$this->params['breadcrumbs'][] = ['label' => $model->proyecto->cliente->nombreCliente, 'url' => ['cliente/proyectos?rutCliente=' . $model->proyecto->rutCliente]];
	$this->params['breadcrumbs'][] = ['label' => "#" . $model->idProyecto, 'url' => ['proyectos/view?id=' . $model->idProyecto]];
	$this->params['breadcrumbs'][] = $this->title;
} else {
	$this->title = $model->idcotizacion;
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cotizaciones'), 'url' => ['index']];
	$this->params['breadcrumbs'][] = $this->title;
}




\yii\web\YiiAsset::register($this);
?>

<div class="panel">
	<div class="panel-heading">
		<?= Html::a(Yii::t('app', 'Editar la cotización'), ['update', 'idcotizacion' => $model->idcotizacion, 'rutCliente' => $model->rutCliente, 'rutUsuario' => $model->rutUsuario, 'idempresa' => $model->idempresa], ['class' => 'btn btn-primary']) ?>
		<?= Html::a(Yii::t('app', 'Convertir en Venta'), ['nota', 'idcotizacion' => $model->idcotizacion, 'rutCliente' => $model->rutCliente, 'rutUsuario' => $model->rutUsuario, 'idempresa' => $model->idempresa], ['class' => 'btn btn-primary']) ?>
		<?= Html::a(Yii::t('app', 'Generar PDF'), ['generar', 'idcotizacion' => $model->idcotizacion, 'rutCliente' => $model->rutCliente, 'rutUsuario' => $model->rutUsuario, 'idempresa' => $model->idempresa], ['class' => 'btn btn-primary']) ?>
		<a class="btn btn-primary" onclick="correo(<?php echo  $model->idcotizacion; ?>, <?php echo $model->rutCliente; ?>, <?php echo $model->rutUsuario; ?>, <?php echo $model->idempresa; ?>,)">Enviar Via Correo</a>
		<?= Html::a(Yii::t('app', 'Eliminar'), ['delete', 'idcotizacion' => $model->idcotizacion, 'rutCliente' => $model->rutCliente, 'rutUsuario' => $model->rutUsuario, 'idempresa' => $model->idempresa], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
				'method' => 'post',
			],
		]) ?>
	</div>
	<div class="panel-body">
		<div class="invoice-masthead">
			<div class="invoice-text">
				<h3 class="h1 text-uppercase text-thin mar-no text-primary">COTIZACIÓN</h3>
			</div>
			<div class="invoice-brand" style="white-space:nowrap">
				<div class="invoice-logo">
					<img style="width:10%;" src="../web/logo1.png">
				</div>
			</div>
		</div>

		<div class="invoice-bill row">
			<div class="col-sm-6 text-xs-center">
				<address>
					<strong><?php echo $model->rutCliente0->nombreCliente; ?></strong><br><br>
					<?php echo $model->rutCliente0->direccionCliente; ?><br>
					<?php echo $model->rutCliente0->regionCliente; ?>, <?php echo $model->rutCliente0->comunaCliente; ?><br>
					<abbr title="Telefono">Telefono:</abbr> <a href="tel:1234567891" title="#" class="text-gray"><?php echo $model->rutCliente0->telefonoCliente; ?></a>
				</address>
			</div>
			<div class="col-sm-6 text-xs-center">
				<table class="invoice-details">
					<tbody>
						<tr>
							<td class="text-main text-bold">Cotización #</td>
							<td class="text-right text-info text-bold">COT-<?php echo $model->idcotizacion; ?></td>
						</tr>
						<tr>
							<td class="text-main text-bold">Status</td>
							<td class="text-right"><span class="badge badge-success">GENERADA</span></td>
						</tr>
						<tr>
							<td class="text-main text-bold">Fecha: </td>
							<td class="text-right"><?php echo date('d/m/Y', strtotime($model->fecha)); ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<hr class="new-section-sm bord-no">

		<div class="row">
			<div class="col-lg-12 table-responsive">
				<table class="table table-bordered invoice-summary">
					<thead>
						<tr class="bg-trans-dark">
							<th class="text-uppercase">Descripción</th>
							<th class="min-col text-center text-uppercase">Cant</th>
							<th class="min-col text-center text-uppercase">Precio</th>
							<th class="min-col text-right text-uppercase">Total</th>
						</tr>
					</thead>
					<tbody>

						<?php foreach ($model->detalle as $d) {
						?>

							<tr>
								<td>
									<strong><?php echo $d->idproducto0->SKU; ?></strong>
									<small><?php echo $d->idproducto0->nombreProducto; ?></small>
								</td>
								<td class="text-center"><?php echo number_format($d->cantidad, '0', ',', '.'); ?></td>
								<td class="text-center">$<?php echo number_format($d->precio, '0', ',', '.'); ?></td>
								<td class="text-right">$<?php echo number_format($d->total, '0', ',', '.'); ?></td>
							</tr>

						<?php
						} ?>



					</tbody>
				</table>
			</div>
		</div>

		<div class="clearfix">
			<table class="table invoice-total">
				<tbody>
					<tr>
						<td><strong>Total neto :</strong></td>
						<td>$<?php
								echo number_format($model->totalNeto, '0', ',', '.')
								?></td>
					</tr>
					<tr>
						<td><strong>IVA :</strong></td>
						<td>$<?php
								echo number_format($model->IVA, '0', ',', '.')
								?></td>
					</tr>
					<tr>
						<td><strong>TOTAL :</strong></td>
						<td class="text-bold h4">$
							<?php
							echo number_format($model->Total, '0', ',', '.')
							?></td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="text-right no-print">
			<a href="javascript:window.print()" class="btn btn-default"><i class="demo-pli-printer icon-lg"></i></a>
		</div>

		<hr class="new-section-sm bord-no">


	</div>
</div>
<style>
	.tableado {
		border-style: solid;
		border-width: 1px;
		border-color: #eeeeee;
	}

	/*****************globals*************/
	body {

		overflow-x: hidden;
	}

	img {
		max-width: 100%;
	}

	.preview {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-orient: vertical;
		-webkit-box-direction: normal;
		-webkit-flex-direction: column;
		-ms-flex-direction: column;
		flex-direction: column;
	}

	@media screen and (max-width: 996px) {
		.preview {
			margin-bottom: 20px;
		}
	}

	.preview-pic {
		-webkit-box-flex: 1;
		-webkit-flex-grow: 1;
		-ms-flex-positive: 1;
		flex-grow: 1;
	}

	.preview-thumbnail.nav-tabs {
		border: none;
		margin-top: 15px;
	}

	.preview-thumbnail.nav-tabs li {
		width: 18%;
		margin-right: 2.5%;
	}

	.preview-thumbnail.nav-tabs li img {
		max-width: 100%;
		display: block;
	}

	.preview-thumbnail.nav-tabs li a {
		padding: 0;
		margin: 0;
	}

	.preview-thumbnail.nav-tabs li:last-of-type {
		margin-right: 0;
	}

	.tab-content {
		overflow: hidden;
	}

	.tab-content img {
		width: 100%;
		-webkit-animation-name: opacity;
		animation-name: opacity;
		-webkit-animation-duration: .3s;
		animation-duration: .3s;
	}

	.card {
		margin-top: 50px;
		background: #eee;
		padding: 3em;
		line-height: 1.5em;
	}

	@media screen and (min-width: 997px) {
		.wrapper {
			display: -webkit-box;
			display: -webkit-flex;
			display: -ms-flexbox;
			display: flex;
		}
	}

	.details {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-orient: vertical;
		-webkit-box-direction: normal;
		-webkit-flex-direction: column;
		-ms-flex-direction: column;
		flex-direction: column;
	}

	.colors {
		-webkit-box-flex: 1;
		-webkit-flex-grow: 1;
		-ms-flex-positive: 1;
		flex-grow: 1;
	}

	.product-title,
	.price,
	.sizes,
	.colors {
		text-transform: UPPERCASE;
		font-weight: bold;
	}

	.checked,
	.price span {
		color: #ff9f1a;
	}

	.product-title,
	.rating,
	.product-description,
	.price,
	.vote,
	.sizes {
		margin-bottom: 15px;
	}

	.product-title {
		margin-top: 0;
	}

	.size {
		margin-right: 10px;
	}

	.size:first-of-type {
		margin-left: 40px;
	}

	.color {
		display: inline-block;
		vertical-align: middle;
		margin-right: 10px;
		height: 2em;
		width: 2em;
		border-radius: 2px;
	}

	.color:first-of-type {
		margin-left: 20px;
	}

	.add-to-cart,
	.like {
		background: #ff9f1a;
		padding: 1.2em 1.5em;
		border: none;
		text-transform: UPPERCASE;
		font-weight: bold;
		color: #fff;
		-webkit-transition: background .3s ease;
		transition: background .3s ease;
	}

	.add-to-cart:hover,
	.like:hover {
		background: #b36800;
		color: #fff;
	}

	.not-available {
		text-align: center;
		line-height: 2em;
	}

	.not-available:before {
		font-family: fontawesome;
		content: "\f00d";
		color: #fff;
	}

	.orange {
		background: #ff9f1a;
	}

	.green {
		background: #85ad00;
	}

	.blue {
		background: #0076ad;
	}

	.tooltip-inner {
		padding: 1.3em;
	}

	@-webkit-keyframes opacity {
		0% {
			opacity: 0;
			-webkit-transform: scale(3);
			transform: scale(3);
		}

		100% {
			opacity: 1;
			-webkit-transform: scale(1);
			transform: scale(1);
		}
	}

	@keyframes opacity {
		0% {
			opacity: 0;
			-webkit-transform: scale(3);
			transform: scale(3);
		}

		100% {
			opacity: 1;
			-webkit-transform: scale(1);
			transform: scale(1);
		}
	}

	/*# sourceMappingURL=style.css.map */
</style>
<script>
	function printDiv() {
		var divContents = document.getElementById("GFG").innerHTML;
		var a = window.open('', '', 'height=500, width=500');
		a.document.write('<html>');
		a.document.write('<body >');
		a.document.write(divContents);
		a.document.write('</body></html>');
		a.document.close();
		a.print();
	}

	function correo(a, b, c, d) {

		Swal.fire({
			title: 'Precaución',
			text: "Seguro que desea enviar la cotizacion via correo?",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si, enviar el correo!'
		}).then((result) => {

			Swal.fire({
				title: 'El correo se esta enviando.',
				showConfirmButton: false,
			})



			$.get('../cotizacion/correo', {
					idcotizacion: a,
					rutCliente: b,
					rutUsuario: c,
					idempresa: d
				},
				function(returnedData) {
					if (returnedData) {
						Swal.fire(
							'Correo!',
							'El correo ha sido enviado con exito.',
							'success'
						)
					} else {
						Swal.fire(
							'Correo!',
							'El correo no ha sido enviado, revise el correo del cliente.',
							'error'
						)
					}
				});
		});


	}
</script>