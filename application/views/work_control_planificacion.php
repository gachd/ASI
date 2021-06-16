<?php $ci = &get_instance();
//$ci->load->model("menu_model");

$ci->load->model('model_trabajos');
$ci->load->model('model_turnos');
$ci->load->model('model_actividades');
setlocale(LC_ALL, 'es_ES').': ';	
$fecha1 = $inicio;
$fecha2 = $termino;
$hoy = date("Y-m-d H:i:s"); 


if($excel == 0 ){
    header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
    header("Content-type:   application/x-msexcel; charset=utf-8");
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="actividades.xls"');
    header('Cache-Control: max-age=0');
    echo'<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />';
}




echo'<table border="1">
  <tbody>
    <tr>
      <td rowspan="2">Trabajos</td>
      <td colspan="2">realizados</td>
      <td rowspan="2">total realizados</td>
      <td rowspan="2">planificados</td>
      <td rowspan="2">planificados <br>No realizados</td>
      <td rowspan="2">% cumpl.</td>
    </tr>
    <tr>
      <td>planificados</td>
      <td>no planficado</td>
    </tr>
   ';

    $getSubcate=$ci-> model_trabajos -> categorias_planificadas($fecha1,$fecha2);

foreach ($getSubcate as $sub) {

	$id_sub = $sub -> tb_sctg_id;

	echo' <tr>
      <td>'.$id_sub.' '.$sub -> sctg_nombre.'</td>';

    $p_realizados = $ci -> model_trabajos -> realizados_planificados($fecha1,$fecha2,$id_sub);
    foreach ($p_realizados as $pr) {
    	echo '<td>'.$pr -> RP.'</td>';
    }

    $np_realizados = $ci -> model_trabajos -> realizados_no_planificados($fecha1,$fecha2,$id_sub);
    foreach ($np_realizados as $npr) {
    	echo '<td>'.$npr -> NP.'</td>';
    }



      echo'
      <td>&nbsp;</td>';

    $planificados = $ci -> model_trabajos -> total_planificados($fecha1,$fecha2,$id_sub);

    foreach ($planificados as $p) {
    	echo '<td>'.$p -> TP.'</td>';
    }


     $no_realizados = $ci -> model_trabajos -> no_realizados_planificados($fecha1,$fecha2,$id_sub);

    foreach ($no_realizados as $nr) {
    	echo '<td>'.$nr -> NRP.'</td>';
    }




      echo'
      
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>';
}


  echo'</tbody>
</table>';




?>