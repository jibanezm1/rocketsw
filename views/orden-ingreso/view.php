<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OrdenIngreso */


if ($model->idProyecto != 1) {
	$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['site/inicio']];
	$this->params['breadcrumbs'][] = ['label' => $model->proyecto->cliente->nombreCliente, 'url' => ['cliente/proyectos?rutCliente=' . $model->proyecto->rutCliente]];
	$this->params['breadcrumbs'][] = ['label' => "#" . $model->idProyecto, 'url' => ['proyectos/view?id=' . $model->idProyecto]];
	$this->params['breadcrumbs'][] = $this->title;
} else {
	$this->title = $model->idordenIngreso;
	$this->params['breadcrumbs'][] = ['label' => 'OC', 'url' => ['index']];
	$this->params['breadcrumbs'][] = $this->title;
}

\yii\web\YiiAsset::register($this);
?>
<div class="panel">
	<div class="panel-heading">
		<h1>OC Nº:<?= Html::encode($this->title) ?></h1>
		<p>
			<?= Html::a(Yii::t('app', 'Exportar a PDF OC'), [
				'generar23',
				'idordenIngreso' => $model->idordenIngreso,
				'rutProveedor' => $model->rutProveedor
			], ['class' => 'btn btn-primary']) ?>
			<?= Html::a('Eliminar OC', ['delete', 'idordenIngreso' => $model->idordenIngreso, 'rutProveedor' => $model->rutProveedor], [
				'class' => 'btn btn-danger',
				'data' => [
					'confirm' => 'Si usted elimina la orden se rebajara del inventario el stock de los productos que la contienen',
					'method' => 'post',
				],
			]) ?>
			<a class="btn btn-primary" onclick="correo(<?php echo  $model->idordenIngreso; ?>, <?php echo $model->rutProveedor; ?>, <?php echo $model->rutUsuario; ?>)">Enviar Via Correo</a>


		</p>
	</div>
	<div class="panel-body" style="padding:10px;">

		<div class="box taskCard">




			<?= DetailView::widget([
				'model' => $model,
				'attributes' => [
					'idordenIngreso',

					[

						'attribute' => 'fechaIngreso',

						'format' => ['date', 'php:d/m/Y']

					],
					'forma',
					'medio',
					'terminos',
					'observaciones',
					'rutProveedor0.nombreProveedor',
					'totalNeto',
					'Total'
				],
			]) ?>

			<table class="table">
				<thead>
					<tr>
						<th style="text-align: center;" width="14.2%" align="center">Codigo</th>
						<th style="text-align: center;" width="14.2%" align="center">Descripcion</th>
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
							
							<td width="14.2%" align="center"> <?php echo $d->idproducto0->nombreProducto; ?></td>
							<td width="14.2%" align="center"><?php echo number_format($d->cantidad, '0', ',', '.'); ?></td>
							<td width="14.2%" align="center">$<?php echo number_format($d->precio, '0', ',', '.'); ?></td>
							<td width="14.2%" align="center"><strong>$<?php echo number_format($d->total, '0', ',', '.'); ?></strong></td>
						</tr>

					<?php
					} ?>



				</tbody>
			</table>
		</div>
	</div>
</div>


<script>
	function correo(a, b, c) {

		Swal.fire({
			title: 'Precaución',
			text: "Seguro que desea enviar la OC via correo?",
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



			$.get('../orden-ingreso/correo', {
					idordenIngreso: a,
					rutProveedor: b,
					rutUsuario: c,
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