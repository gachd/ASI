<!DOCTYPE html>

<html lang="en">

<head>

	<meta charset="UTF-8">

	<title>Listado de Socios</title>

</head>
<style>
	.ico.badge.badge-success {

		background-color: #08c222;





	}

	.ico.badge.badge-danger {

		background-color: #ff0000;





	}
</style>

<body>

	<div class="main">

		<div class="container-fluid">

			<div class="row panel table-responsive" id="mostrarSocios" >
				<div class="col-md-12">

					<div class="panel panel-default">


						<div class="panel-heading">
							<div class="panel-title">LISTADO DE SOCIOS</div>
						</div>

						<div class="panel-body">
							<div class="table  table_wrapper">

							<table class="table table-bordered table-responsive" id="t_personas">

								<thead>

									<tr>

										<td>RUT</td>

										<td>NOMBRE</td>

										<td>AP. PATERNO</td>

										<td>AP. MATERNO</td>

										<td>FICHA</td>

										<td>ESTADO </td>

									</tr>

								</thead>

								<tbody>

									<?php

									function getPuntosRut($rut)
									{

										$rutTmp = explode("-", $rut);

										return number_format($rutTmp[0], 0, "", ".") . '-' . $rutTmp[1];
									}

									foreach ($personas as $p) {

										$paterno = $p->prsn_apellidopaterno;

										$materno = $p->prsn_apellidomaterno;

										$nombre = $p->prsn_nombres;

										$rut = $p->prsn_rut;

										$estado = $p->estado;

										if ($estado == 1) {
											$glyphy = 'glyphicon glyphicon-remove';
											$badge = 'ico badge badge-danger';
										} else {

											$glyphy = 'glyphicon glyphicon-ok';
											$badge = 'ico badge badge-success';
										}

										echo '

                			            <tr>

                			            	<td>' . $rut . '</td>

                			            	<td>' . $nombre . '</td>

                			            	<td>' . $paterno . '</td>

                			            	<td>' . $materno . '</td>

                			            	<td><a href="' . base_url() . 'socios/ficha/detalle/' . $rut . '" target="_blank">

                			            	        <span class="glyphicon glyphicon-copy" aria-hidden="true"></span>

                			            	    </a>

											</td>
											
											<td><div hidden>' . $estado . '</div>
											<span class="' . $badge . '"><i class="' . $glyphy . '"></i></span>
											</td>

                			            	

                			            </tr>';
									}

									?>

								</tbody>

							</table>



							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

	</div>

</body>

<script language="javascript">
	$(document).ready(function() {



		$('#t_personas').DataTable({
			"oLanguage": {
				"sProcessing": "Procesando...",
				"sLengthMenu": "Mostrar _MENU_ registros",
				"sZeroRecords": "No se encontraron resultados",
				"sEmptyTable": "Ningún dato disponible en esta tabla",
				"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
				"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
				"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
				"sInfoPostFix": "",
				"sSearch": "Buscar:",
				"sUrl": "",
				"sInfoThousands": ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
					"sFirst": "Primero",
					"sLast": "Último",
					"sNext": "Siguiente",
					"sPrevious": "Anterior"
				},
				"oAria": {
					"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
			}
		});





		// var table = $('#example').DataTable();







	});


</script>

</html>