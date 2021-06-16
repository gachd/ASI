<style>
td, th {
    padding: 5px;
    font-family: monospace;
    font-size: 12px;
    text-transform: uppercase;
    text-align: center;
}</style>



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




echo'<table>
   <tr style="border:none;" style="font-family: monospace;font-size:12px;">
              <th style="text-align:left;" colspan="6">STADIO ITALAINO DI CONCEPCIÓN<br>
                Impreso el '.strftime('%A %e/%b/%g - %H:%I',  strtotime("".$hoy."")).'</th></tr>
                 <tr style="border:none;">
              <th colspan="6" style="font-size:20px; text-transform:uppercase;text-align:left;padding:5PX;">CONTROL DE TRABAJOS DESDE EL  '.strftime('%e/%b/%g',  strtotime("".$fecha1."")).' AL '.strftime('%e/%b/%g',  strtotime("".$fecha2."")).' </th></tr>
  </table>

  <BR><table border="1">
  <tbody>
    <tr>
      <td rowspan="2">Trabajos</td>
      <td colspan="2">realizados</td>
      <td rowspan="2">total realizados</td>
      <td rowspan="2">planificados</td>
      <td rowspan="2">planificados <br>No realizados</td>
      <td colspan="2" rowspan="2">% cumpl.</td>
    </tr>
    <tr>
      <td>planificados</td>
      <td>no planficado</td>
    </tr>
   ';

    $getSubcate=$ci-> model_trabajos -> categorias_planificadas($fecha1,$fecha2);
    function porcentaje($total, $parte, $redondear = 2) {
    return round($parte / $total * 100, $redondear);}


foreach ($getSubcate as $sub) {

	$id_sub = $sub -> tb_sctg_id;

	echo' <tr>
      <td style="text-align:left;">'.$sub -> sctg_nombre.'</td>';

    $p_realizados = $ci -> model_trabajos -> realizados_planificados($fecha1,$fecha2,$id_sub);
    foreach ($p_realizados as $pr) {

    	$pl_realizados=$pr -> RP;
    	echo '<td>'.$pl_realizados.'</td>';
    }

    $np_realizados = $ci -> model_trabajos -> realizados_no_planificados($fecha1,$fecha2,$id_sub);
    foreach ($np_realizados as $npr) {
    	$nopl_realizados=$npr -> NP;
    	echo '<td>'.$nopl_realizados.'</td>';
    }


    $total_realizados = $pl_realizados+$nopl_realizados;



      echo'
      <td>'.$total_realizados.'</td>';

    $planificados = $ci -> model_trabajos -> total_planificados($fecha1,$fecha2,$id_sub);

    foreach ($planificados as $p) {
      $total_planificados = $p -> TP;
    	echo '<td>'.$p -> TP.'</td>';
    }


     $no_realizados = $ci -> model_trabajos -> no_realizados_planificados($fecha1,$fecha2,$id_sub);

    foreach ($no_realizados as $nr) {
    	echo '<td>'.$nr -> NRP.'</td>';
    }


    $porcentaje = porcentaje($total_planificados,$total_realizados,2);
    $color="";

    if ($porcentaje < 51 ){ $color="#ff0000";}
    if ($porcentaje >= 51 && porcentaje < 81 ){ $color= "#ff0000";}
    if ($porcentaje >= 81 ){ $color= "#24a50e";}



      echo'<td>'.$porcentaje.'%</td>
      <td><span class="glyphicon glyphicon-certificate" style="color:'.$color.';"></span></td>
    </tr>';
}


  echo'</tbody>
</table>';




?>