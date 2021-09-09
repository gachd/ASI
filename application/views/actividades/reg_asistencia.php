 <style type="text/css">
 	#datosActiv label {
 		font-size: 14px;
 	}

 	#datosActiv span {
 		font-size: 14px;
 	}

 	#datosActiv {
 		height: 100px;
 	}
 </style>
 <div class="container-fluid">
 	<?php
		foreach ($act_cal as $c) {
			$id = $c->id;
			$fecha = $c->fecha;
			$nom_act = $c->act_evento;
			$nombre = $c->act_nombre;
			$encargado = $c->act_responsable;
		}

		?>
 	<div class="panel panel-default">
 		<div class="panel-heading">REGISTRO DE ASISTENCIA</div>
 		<div class="panel-body">
 			<div id="datosActiv">
 				<h1>DATOS ACTIVIDAD</h1>
 				<div class="row">
 					<div class="col-md-5">
 						<input id="actId" name="actId" type="hidden" value="<?php echo $id; ?>">
 						<label>NOMBRE: </label><span class="label label-primary" id="nombre"><?php echo $nom_act . '' . $nombre; ?></span>
 					</div>
 					<div class="col-md-7">
 						<label>ENCARGADO: </label><span class="label label-primary" id="encargado"><?php echo $encargado; ?></span>
 					</div>
 				</div>
 				<div class="row">
 					<div class="col-md-5">
 						<label>FECHA: </label><span class="label label-primary" id="fecha"><?php echo $fecha; ?></span>
 					</div>
 					<div class="col-md-7">
 						<button type="button" class="btn btn-success" id="agregarPersona" onclick="agregarPersona()">
 							<i class="fa fa-plus"></i></button>
 						<button type="button" class="btn btn-primary" id="GuardarAsist" onclick="GuardarAsist()">
 							<i class="fa fa-floppy-o"></i></button>
 						<button type="button" class="btn btn-danger" id="BorrarAsist">
 							<i class="fa fa-eraser"></i></button>
 					</div>

 				</div>






 			</div>
 			<div class="well">
 				<div class="container-fluid">
 					<table width="100%" border="1" class="tbl-afiliacion">
 						<thead>
 							<tr>
 								<th width="15%">RUT</th>
 								<th width="30%">NOMBRES</th>
 								<th width="30%">APELLIDOS</th>
 								<th width="20%">TIPO PERSONA</th>
 							</tr>
 						</thead>
 						<tbody id="PersonaSelect">
 							<?php
								if ($asist_per != 0) {
									foreach ($asist_per as $a) {

										$nombres = $a->prsn_nombres;
										$rut = $a->prsn_rut;
										$apellidos = $a->prsn_apellidopaterno . ' ' . $a->prsn_apellidomaterno;
										$tipoPer = $a->prsn_tipoPersona;

										if ($tipoPer == 1) {
											$tipoPersona = 'SOCIO';
										}
										if ($tipoPer == 2) {
											$tipoPersona = 'BENEFICIARIO';
										}
										if ($tipoPer == 3) {
											$tipoPersona = 'EXTERNO';
										}
										if ($tipoPer == 4) {
											$tipoPersona = 'FUNCIONARIO';
										}
										echo '<tr><td> ' . $rut . '</td>
             									 	<td> ' . $nombres . '</td>
             									 	<td> ' . $apellidos . '</td>
              										<td> ' . $tipoPersona . '</td> 
        									</tr>';
									}
								}
								?>

 						</tbody>
 					</table>
 				</div>

 			</div>
 		</div>
 	</div>
 </div>