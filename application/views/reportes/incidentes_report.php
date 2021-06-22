<?php

header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-type:   application/x-msexcel; charset=utf-8");
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="actividades.xls"');
header('Cache-Control: max-age=0'); ?>

<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
<p>Stadio Italiano di concepción</p>
<p style="font-size:16px; font-weight:600;">Reporte de sucesos </p>
<?php
$this->load->library('session');
$usuario = $this->session->userdata('id');
function dias_transcurridos($fecha_i, $fecha_f)
{
	$dias = (strtotime($fecha_i) - strtotime($fecha_f)) / 86400;
	$dias = abs($dias);
	$dias = floor($dias);
	return $dias;
}
if (!empty($incidentes)) {

	/*inicio*/
	echo ' <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                            <th>Fecha</th>
                                            <th>Reporto</th>
                                            <th>Sector</th>
                                            <th>Dependencia</th>
                                            <th>Categoria</th>
                                            <th>Descripción</th>
                                            <th>Asignado a</th>
											<th>Tiempo<br>Est.</th>
                                            <th>Tiempo<br>Trans.</th>
                                            <th>Estado</th>
                                            <th>Prioridad</th>';



	echo '
                                        </tr>
                                    </thead>
                                    <tbody>';
	foreach ($incidentes as $i) {

		$date_report = date('d/m/y H:i', strtotime($i->ri_fecha_report));

		$fun = $this->model_report->getFunID($i->ri_usuario);
		foreach ($fun as $f) {
			$fun_nombre = $f->nombre_fun;
			$fun_paterno = $f->paterno;
		}


		if ($i->ri_estado == 0) {
			$estado = '<span class="label label-success">Abierto</span>';
		} else {
			$estado = '<span class="label label-default">Cerrado</span>
    ';
		}

		switch ($i->ri_prioridad) {
			case "1":
				$color = "info";
				break;
			case "2":
				$color = "warning";
				break;
			case "3":
				$color = "danger";
				break;
		}


		$alert_tiempo = "";
		$dias_transcurridos = "";
		$date_requerimiento = date('Y/m/d', strtotime($i->ri_fecha_report));
		$date_cierre = date('Y/m/d', strtotime($i->ri_fecha_cierre));
		$fechaactual = date("Y/m/d");
		if ($i->ri_estado == 0) {

			$dias_transcurridos = dias_transcurridos($date_requerimiento, $fechaactual);
			if (($dias_transcurridos > $i->ri_tiempo) && ($i->ri_tiempo <> 0)) {
				$alert_tiempo = 'style="background:lightyellow;"';
			}
		} else {
			$dias_transcurridos = dias_transcurridos($date_requerimiento, $date_cierre);
		}



		echo '<tr ' . $alert_tiempo . '>
				 
				 <td  class="clickable-row"  id="' . $i->ri_id . '"> ' . $date_report . ' </td>
                 <td  class="clickable-row"  id="' . $i->ri_id . '">' . $fun_nombre . ' ' . substr($fun_paterno, 0, 1) . '.</td>
                 <td class="clickable-row"  id="' . $i->ri_id . '" >' . $i->nombre . '</td>
                 <td class="clickable-row"  id="' . $i->ri_id . '" >' . $i->dep_nombre . '</td>
				  <td  class="clickable-row"  id="' . $i->ri_id . '">' . $i->rc_nombre . '</td>
                 <td class="clickable-row"  id="' . $i->ri_id . '" >' . $i->ri_desc . '</td>';

		/*asignado*/
		if (empty($i->ri_asignado)) {
			echo '<td class="clickable-row"  id="' . $i->ri_id . '">&nbsp;</td>';
		} else {
			$asignado = $this->model_report->getFunID($i->ri_asignado);
			foreach ($asignado as $a) {

				$nom_asignado = $a->nombre_fun;
				$ape_asignado = $a->paterno;
				echo '<td class="clickable-row"  id="' . $i->ri_id . '">' . $nom_asignado . ' ' . $ape_asignado . '</td>';
			}
		}
		/*tiempo estimado*/
		echo '<td class="clickable-row"  id="' . $i->ri_id . '" >' . $i->ri_tiempo . '</td>';
		/*tiempo trasncurrido*/
		echo '<td class="clickable-row"  id="' . $i->ri_id . '" >' . $dias_transcurridos . '</td>';

		echo '<td class="clickable-row"  id="' . $i->ri_id . '" >' . $estado . '</td>
                 <td class="clickable-row"  id="' . $i->ri_id . '" ><span class="label label-' . $color . '">' . $i->rp_nombre . '</span></td>';
		/*comentarios*/
		if (($usuario == $i->ri_asignado) or ($usuario == $i->ri_usuario)) {
			echo ' <td class="comentario icono"  id="' . $i->ri_id . '" ><span class="glyphicon glyphicon-comment" aria-hidden="true"></span></td>';
		} else {
			echo '<td></td>';
		}
		/*cerrar requerimiento*/
		if (($usuario == $i->ri_asignado)) {
			echo '<td class="ok icono"  id="' . $i->ri_id . '" ><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>';
		} else {
			echo '<td></td>';
		}
		/*eliminar*/
		if ($usuario == $i->ri_usuario) {
			echo '<td class="eliminar icono"  id="' . $i->ri_id . '" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></td>
                 </tr>';
		} else {
			echo '<td></td>';
		}
	}

	echo ' </tbody>
									 </table>';

	/*fin*/
} else {
	echo 'no hay resultados para su busqueda';
}

?>