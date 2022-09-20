<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\ContactoCliente;

/* @var $this yii\web\View */
/* @var $model app\models\Cotizacion */

\yii\web\YiiAsset::register($this);

function validar_rut($rut)
{
	$x = 2;
	$sumatorio = 0;
	for ($i = strlen($rut) - 1; $i >= 0; $i--) {
		if ($x > 7) {
			$x = 2;
		}

		
		$sumatorio = $sumatorio + ($rut * $x);
		$x++;
	}
	$digito = bcmod($sumatorio, 11);
	$digito = 11 - $digito;

	switch ($digito) {
		case 10:
			$digito = "k";
			break;
		case 11:
			$digito = "0";
			break;
	}

	return $digito;
}
?>
<div id="GFG" style="background-color:white; padding:20px;">
	<table>
		<tbody>
			<tr>
				<td><img style="width: 22%;padding: 10px;" src="tmp/logo.png" /></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>
					<h5><strong>Cotizacion Nº:</strong><?php echo $model->idcotizacion; ?></h5>
					<h5 style="margin-top: 5px;">Fecha de Cotizacion: <?php echo date('d/m/Y', strtotime($model->fecha)); ?> </h5>

				</td>
			</tr>
			<tr style="font-family:'Source Sans Pro',sans-serif">
				<td>
					<address>
						<strong><?php echo $model->idempresa0->nombreEmpresa; ?></strong><br>
						<strong>Rut: 77.901.920-9</strong><br>
						<strong>Direccion:</strong> Av Kennedy 6800 Of 619 Torre B<br>
						Region Metropolitana, Vitacura SANTIAGO Chile<br>
						<abbr title="Phone">Telefono:</abbr> <a href="tel:9 3944 5510" title="#" class="text-gray">+569 3944 5510</a><br>
						<abbr title="Phone">Whatsapp:</abbr> <a href="tel:9 9824 0188" title="#" class="text-gray">+56 9 9824 0188</a>


						<p><strong>Evento a Cotizar:</strong><?php echo $model->evento; ?></p>
					</address>
				</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>
					<address>
						<strong>Rut:<?php $dv = validar_rut($model->rutCliente0->rutCliente);
									echo $model->rutCliente0->rutCliente . "-" . $dv; ?></strong><br>
						<strong><?php echo $model->rutCliente0->nombreCliente; ?></strong><br>

						<?php echo $model->rutCliente0->direccionCliente; ?><br>
						<?php echo $model->rutCliente0->regionCliente; ?>, <?php echo $model->rutCliente0->comunaCliente; ?><br>


						<?php

						if ($model->rutContacto) {

							?>



							<?php $contacto = ContactoCliente::find()->where(["idCliente" => $model->rutContacto])->one(); ?>
							<p>Estimado: <?php echo $contacto->nombreCliente; ?></p>
							<p>Correo: <?php echo $contacto->correoCliente; ?></p>
							<address>
								<strong><?php echo $model->rutCliente0->nombreCliente; ?></strong><br>
								<?php echo $model->rutCliente0->direccionCliente; ?><br>
								<?php echo $model->rutCliente0->regionCliente; ?>, <?php echo $model->rutCliente0->comunaCliente; ?><br>
								<abbr title="Telefono">Telefono:</abbr> <a href="tel:1234567891" title="#" class="text-gray"><?php echo $model->rutCliente0->telefonoCliente; ?></a>
							</address>



						<?php

						} else {
						?>




						<?php
						}
						?>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>

		</tbody>
	</table>
	<br>
	<style>
		.myTable {
			border: solid 1px #DDEEEE;
			border-collapse: collapse;
			border-spacing: 0;
			font: normal 13px Arial, sans-serif;
		}

		.myTable thead th {
			background-color: #DDEFEF;
			border: solid 1px #DDEEEE;
			color: #336B6B;
			padding: 10px;
			text-align: left;
			text-shadow: 1px 1px 1px #fff;
		}

		.myTable tbody td {
			border: solid 1px #DDEEEE;
			color: #333;
			padding: 10px;
			text-shadow: 1px 1px 1px #fff;
		}

		.myTable-rounded {
			border: none;
		}

		.myTable-rounded thead th {
			background-color: #CCC;
			border: none;
			text-shadow: 1px 1px 1px #ccc;
			color: #333;
		}

		.myTable-rounded thead th:first-child {
			border-radius: 10px 0 0 0;
		}

		.myTable-rounded thead th:last-child {
			border-radius: 0 10px 0 0;
		}

		.myTable-rounded tbody td {
			border: none;
			border-top: solid 1px #957030;
			background-color: #EEE;
		}

		.myTable-rounded tbody tr:last-child td:first-child {
			border-radius: 0 0 0 10px;
		}

		.myTable-rounded tbody tr:last-child td:last-child {
			border-radius: 0 0 10px 0;
		}

		table.jp {
			border-width: 1px;
			border-style: solid;
			padding: 10px;
			border-color: #eeeeee;
		}

		td.jp {
			border-width: 1px;
			border-style: solid;
			padding: 18px;
			border-color: #eeeeee;
		}
	</style>
	<table class="myTable myTable-rounded" width="100%" cellspacing="2" cellpadding="0" border="1" align="center" bgcolor="#ffffff" bordercolor="#e6e7ed">
		<thead>
			<tr align="center" bgcolor="#042038" style="color: white;">
				<th style="text-align: center;" width="14.2%" align="center">Codigo</th>
				<th style="text-align: center;" width="14.2%" align="center">Fotografia</th>
				<th style="text-align: center;" width="14.2%" align="center">Nombre</th>

				<th style="text-align: center;" width="14.2%" align="center">Entrega</th>
				<th style="text-align: center;" width="14.2%" align="center">Cantidad</th>
				<th style="text-align: center;" width="14.2%" align="center">Precio Unitario</th>
				<th style="text-align: center;" width="14.2%" align="center">Total</th>
			</tr>
		</thead>
		<tbody>

			<?php
			$ds = 0;

			foreach ($model->detalle as $d) {

				if ($ds < 2) {


			?>
					<tr>
						<td width="14.2%" align="center"><?php echo $d->idproducto0->SKU; ?></td>
						<td width="14.2%" align="center"><img style="width: 150px; padding:10px;" src="../web/<?php
																												$i = 0;
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
					$ds++;
				}
			}

			?>



		</tbody>
	</table>
	<div style="width:100%">
		<table width="100%" cellspacing="2" cellpadding="0">
			<thead>
				<tr>

					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr>

					<td width="70%"></td>
					<td align="right" width="30%">Neto:<strong> $<?php
																	echo number_format($model->totalNeto, '0', ',', '.')
																	?></strong></td>
				</tr>
				<tr>

					<td width="70%"></td>
					<td align="right" width="30%">IVA:<strong> $<?php
																echo number_format($model->IVA, '0', ',', '.')
																?></strong></td>
				</tr>
				<tr>

					<td width="70%"></td>
					<td align="right" width="30%">TOTAL:<strong> $
							<?php
							echo number_format($model->Total, '0', ',', '.')
							?>

						</strong></td>
				</tr>
			</tbody>
		</table>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>

	</div>



	<table class="jp" width="100%" cellspacing="2" cellpadding="0" border="0" align="center" bgcolor="#ffffff">
		<tbody>
			<tr>
				<td width="50%">
					<p><strong>Evento a Cotizar: </strong><?php echo $model->evento; ?></p>
				</td>
				<td width="50%">
					<p><strong>Validez de la Cotización: </strong><?php echo $model->validez; ?></p>
				</td>
			</tr>
			<tr>
				<td width="50%">
					<p><strong>Entrega: </strong><?php echo $model->entrega; ?></p>
				</td>
				<td width="50%">
					<p><strong>Lugar de entrega Material:</strong>Santiago</p>
				</td>
			</tr>
			<tr>
				<td width="50%">
					<p><strong>Tipo de Moneda: </strong><?php echo $model->tipoDeMoneda; ?></p>
				</td>
				<td width="50%">
					<p><strong>Valores: </strong>NETOS (+ IVA)</p>
				</td>
			</tr>

			<tr>
				<td width="50%">
					<p><strong>Forma de Pago: </strong><?php echo $model->formaDePago; ?></p>
				</td>
				<td width="50%">
					<p><strong>Responsable Cotizacion: </strong><?php echo $model->rutUsuario0->nombreUsuario . " " . $model->rutUsuario0->apellidosUsuario; ?></p>
				</td>
			</tr>

			<tr>
				<td width="50%">
					<p><strong>Comentarios: </strong><?php echo $model->comentarios;   ?></p>
				</td>
				<td width="50%">
					<p><strong>Celular: </strong><?php echo $model->rutUsuario0->telefono;   ?></p>
				</td>
			</tr>
			<tr>
				<td width="50%">
					<p><strong>Flete: </strong><?php echo $model->flete;   ?></p>
				</td>
				<td width="50%">
					<p><strong>Mail: </strong><?php echo $model->rutUsuario0->correo; ?></p>
				</td>
			</tr>
			<tr>
				<td width="100%">
					<p><strong></p>
				</td>
			</tr>
			<tr>
				<td width="100%">
					<p><strong></p>
				</td>
			</tr>
			<tr>
				<td width="100%">
					<p><strong></p>
				</td>
			</tr>
			<tr>
				<td width="100%">
					<p><strong>Datos de Transferencia</p>
				</td>
			</tr>

			<tr>
				<td width="50%">
					<p><strong>Banco: </strong> BCI </p>
				</td>
			</tr>
			<tr>
				<td width="50%">
					<p><strong>CTA CTE: </strong> 70138478</p>
				</td>

			</tr>
			<tr>
				<td width="50%">
					<p><strong>Nombre: </strong> MYC Promociones Ltda. </p>
				</td>
			</tr>
			<tr>
				<td width="50%">
					<p><strong>Direccion de entrega: </strong> "msalinas@mcpromociones.cl"</p>
				</td>

			</tr>




		</tbody>
	</table>




	<!-- DivTable.com -->
</div>