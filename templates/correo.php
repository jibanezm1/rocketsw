<style>
	.email {
		max-width: 100%;
		margin: 1rem auto;
		border-radius: 10px;
		border-top: #241e64 2px solid;
		border-bottom: #008993 2px solid;
		box-shadow: 0 2px 18px rgba(0, 0, 0, 0.2);
		padding: 1.5rem;
		font-family: Arial, Helvetica, sans-serif;
	}

	.email .email-head {
		border-bottom: 1px solid rgba(0, 0, 0, 0.2);
		padding-bottom: 1rem;
	}

	.email .email-head .head-img {
		max-width: 240px;
		padding: 0 0.5rem;
		display: block;
		margin: 0 auto;
	}

	.email .email-head .head-img img {
		width: 100%;
	}

	.email-body .invoice-icon {
		max-width: 80px;
		margin: 1rem auto;
	}

	.email-body .invoice-icon img {
		width: 100%;
	}

	.email-body .body-text {
		padding: 2rem 0 1rem;
		text-align: center;
		font-size: 1.15rem;
	}

	.email-body .body-text.bottom-text {
		padding: 4rem 0 1rem;
		text-align: center;
		font-size: 0.8rem;
	}

	.email-body .body-text .body-greeting {
		font-weight: bold;
		margin-bottom: 1rem;
	}

	.email-body .body-table {
		text-align: left;
	}

	.email-body .body-table table {
		width: 100%;
		font-size: 1.1rem;
	}

	.email-body .body-table table .total {
		background-color: hsla(4, 67%, 52%, 0.12);
		border-radius: 8px;
		color: #d74034;
	}

	.email-body .body-table table .item {
		border-radius: 8px;
		color: #d74034;
	}

	.email-body .body-table table th,
	.email-body .body-table table td {
		padding: 10px;
	}

	.email-body .body-table table tr:first-child th {
		border-bottom: 1px solid rgba(0, 0, 0, 0.2);
	}

	.email-body .body-table table tr td:last-child {
		text-align: right;
	}

	.email-body .body-table table tr th:last-child {
		text-align: right;
	}

	.email-body .body-table table tr:last-child th:first-child {
		border-radius: 8px 0 0 8px;
	}

	.email-body .body-table table tr:last-child th:last-child {
		border-radius: 0 8px 8px 0;
	}

	.email-footer {
		border-top: 1px solid rgba(0, 0, 0, 0.2);
	}

	.email-footer .footer-text {
		font-size: 0.8rem;
		text-align: center;
		padding-top: 1rem;
	}

	.email-footer .footer-text a {
		color: #d74034;
	}
</style>
</head>

<body>
	<div class="email">
		<div class="email-head">
			<div class="head-img">
				<img src="https://rocket.apolotec.cl/web/logo1.png" alt="damnitrahul-logo" />
			</div>
		</div>
		<div class="email-body">
			<div class="body-text">
				<div class="body-greeting">

					<?php

					use app\models\ContactoCliente;

					$contacto = ContactoCliente::find()->where(["idCliente" => $model->rutContacto])->one(); ?>
					Hola, <?php echo $contacto->nombreCliente; ?>!
				</div>
				Adjuntamos detalle de su solicitud de cotización: N°: <?php echo $model->idcotizacion; ?><br>
				<span style="font-size:13px"><strong>Evento a Cotizar:</strong><?php echo $model->evento; ?></span></h3>

				<span style="font-size:13px">Fecha de Cotizacion: <?php echo date('d/m/Y', strtotime($model->fecha)); ?></span></h3>

			</div>

			<div class="body-table">
				<table>
					<tr class="item">
						<th>Codigo</th>
						<th>Fotografia</th>
						<th>Nombre</th>
						<th>Cantidad</th>
						<th>Precio</th>
						<th>Total</th>
					</tr>
					<?php foreach ($model->detalle as $d) {
					?>
						<tr>

							<td><?php echo $d->idproducto0->SKU; ?></td>
							<td  align="center"><img style="width: 150px; padding:10px;" src="https://rocket.apolotec.cl/web/<?php $i = 0;
																												foreach ($d->idproducto0->fotosProductos as $foto) {
																													if ($i == 0) {
																														echo $foto->ruta;
																														$i++;
																													}
																												} ?>" /></td>
							<td  align="center"> <?php echo $d->idproducto0->nombreProducto; ?></td>


							<td  align="center"><?php echo number_format($d->cantidad, '0', ',', '.'); ?></td>
							<td  align="center">$<?php echo number_format($d->precio, '0', ',', '.'); ?></td>
							<td  align="center"><strong>$<?php echo number_format($d->total, '0', ',', '.'); ?></strong></td>

						</tr>
					<?php
					} ?>
					<tr class="total">
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th>Neto</th>
						<th><strong> $<?php echo number_format($model->totalNeto, '0', ',', '.') ?></strong></th>
					</tr>
					<tr class="total">
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th>IVA</th>
						<th><strong> $<?php echo number_format($model->IVA, '0', ',', '.')?></strong></th>
					</tr>
					<tr class="total">
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th>Total</th>
						<th>$<?php echo number_format($model->Total, '0', ',', '.') ?>
						</th>
					</tr>
				</table>
			</div>
			<div class="body-text bottom-text">
				Gracias!!!
			</div>
		</div>
		<div class="email-footer">
			<div class="footer-text">
				&copy; <a href="https://apolotec.cl" target="_blank">Apolotec SPA</a>
			</div>
		</div>
	</div>
</body>