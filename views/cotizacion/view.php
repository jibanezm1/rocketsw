<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Cotizacion */

$this->registerCssFile("../web/nifty/mail/assets/css/style.css");
$this->registerJsFile("../web/nifty/mail/assets/js/jspdf.min.js");
$this->registerJsFile("../web/nifty/mail/assets/js/html2canvas.min.js");
$this->registerJsFile("../web/nifty/mail/assets/js/main.js");





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
		<button id="download_btn" class="btn btn-primary">
			
			<span>Descargar</span>
		</button>
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
		<div class="cs-container">
			<div class="cs-invoice cs-style1">
				<div class="cs-invoice_in" id="download_section">
					<div class="cs-invoice_head cs-type1 cs-mb25">
						<div class="cs-invoice_left">
							<p class="cs-invoice_number cs-primary_color cs-mb0 cs-f16"><b class="cs-primary_color">Cotización N°:</b> <?php echo $model->idcotizacion; ?></p>
						</div>
						<div class="cs-invoice_right cs-text_right">
							<div class="cs-logo cs-mb5"><img style="width:20%;" src="../web/logo1.png" alt="Logo"></div>
						</div>
					</div>
					<div class="cs-invoice_head cs-mb10">
						<div class="cs-invoice_left">
							<b class="cs-primary_color">Anotaciones:</b>
							<p class="cs-mb8">Esta cotizacion tiene una validez de 10 dias a contar del dia de emision, en caso de requerir pasada la fecha deben solicitar una nueva.</p>
							<p><b class="cs-primary_color cs-semi_bold">Fecha Cotizacion:</b> <br><?php echo date('d/m/Y', strtotime($model->fecha)); ?></p>
						</div>
						<div class="cs-invoice_right cs-text_right">
							<b class="cs-primary_color">Apolotec SPA.</b>
							<p>
								<?php echo $model->rutCliente0->nombreCliente; ?>, <br />
								<?php echo $model->rutCliente0->direccionCliente; ?> <br />
								<?php echo $model->rutCliente0->region->nombreRegion; ?>, <?php echo $model->rutCliente0->comu->comuna; ?> <br />
								<abbr title="Telefono">Telefono:</abbr> <a href="tel:1234567891" title="#" class="text-gray"><?php echo $model->rutCliente0->telefonoCliente; ?></a>
							</p>
						</div>
					</div>
					<ul class="cs-list cs-style2">
						<li>
							<div class="cs-list_left">Student ID: <b class="cs-primary_color cs-semi_bold ">AS2534568</b></div>
							<div class="cs-list_right">Balance Due: <b class="cs-primary_color cs-semi_bold ">$ 3600</b></div>
						</li>
						<li>
							<div class="cs-list_left">Student Name: <b class="cs-primary_color cs-semi_bold ">Johan Smith</b></div>
							<div class="cs-list_right">Due Date: <b class="cs-primary_color cs-semi_bold ">25 Feb 2022</b></div>
						</li>
						<li>
							<div class="cs-list_left">Term: <b class="cs-primary_color cs-semi_bold ">Winter</b></div>
							<div class="cs-list_right">Statement For: <b class="cs-primary_color cs-semi_bold ">2022 Spring</b></div>
						</li>
					</ul>
					<div class="cs-table cs-style2">
						<div class="cs-round_border">
							<div class="cs-table_responsive">
								<table>
									<thead>
										<tr class="cs-focus_bg">

											<th class="cs-width_5 cs-semi_bold cs-primary_color">Descripción</th>
											<th class="cs-width_3 cs-semi_bold cs-primary_color">Cantidad</th>
											<th class="cs-width_2 cs-semi_bold cs-primary_color">Precio</th>
											<th class="cs-width_2 cs-semi_bold cs-primary_color">Total</th>


										</tr>
									</thead>
									<tbody>



										<?php foreach ($model->detalle as $d) {
										?>

											<tr>
												<td class="cs-width_5">
													<strong><?php echo $d->idproducto0->SKU; ?></strong>
													<small><?php echo $d->idproducto0->nombreProducto; ?></small>
												</td>
												<td class="cs-width_3"><?php echo number_format($d->cantidad, '0', ',', '.'); ?></td>
												<td class="cs-width_2">$<?php echo number_format($d->precio, '0', ',', '.'); ?></td>
												<td class="cs-width_2">$<?php echo number_format($d->total, '0', ',', '.'); ?></td>
											</tr>

										<?php
										} ?>



									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="cs-table cs-style2">
						<div class="cs-table_responsive">
							<table>
								<tbody>
									<tr style="    float: right;" class="cs-table_baseline">
										<td class="cs-width_5">
											<b class="cs-primary_color">Resumen</b><br />
											Aolotec SPA <br />Neto:$<?php
																	echo number_format($model->totalNeto, '0', ',', '.')
																	?><br /> IVA: $<?php
																					echo number_format($model->IVA, '0', ',', '.')
																					?><br />Total: <?php
																									echo number_format($model->Total, '0', ',', '.')
																									?>
										</td>

									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="cs-note">
						<div class="cs-note_left">
							<svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
								<path d="M416 221.25V416a48 48 0 01-48 48H144a48 48 0 01-48-48V96a48 48 0 0148-48h98.75a32 32 0 0122.62 9.37l141.26 141.26a32 32 0 019.37 22.62z" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
								<path d="M256 56v120a32 32 0 0032 32h120M176 288h160M176 368h160" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
							</svg>
						</div>
						<div class="cs-note_right">
							<p class="cs-mb0"><b class="cs-primary_color cs-bold">Note:</b></p>
							<p class="cs-m0">Here we can write a additional notes for the client to get a better understanding of this invoice.</p>
						</div>
					</div><!-- .cs-note -->
				</div>
				<div class="cs-invoice_btns cs-hide_print">
					<a href="javascript:window.print()" class="cs-invoice_btn cs-color1">
						<svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
							<path d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
							<rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
							<path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
							<circle cx="392" cy="184" r="24" />
						</svg>
						<span>Print</span>
					</a>

				</div>
			</div>
		</div>
	</div>
</div>


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



			$.get('correo', {
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