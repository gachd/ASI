<?php


$ci = &get_instance();
//$ci->load->model("menu_model");

$ci->load->model('model_trabajos');
$ci->load->model('model_turnos');
$ci->load->model('model_actividades');
$sucategorias = $ci -> model_trabajos->getSubcate();
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



echo'   <style>
 
  <!--table
 
  @page
     {mso-header-data:"\000APage &P";
	  mso-number-format:"\#\,\#\#0\.00"; 
	  mso-page-orientation:portrait;
	  margin:0cm 0cm 0cm 0cm;
 }
 
  .style0
     {font-size:8.0pt;
	  font-style:normal;
	  font-family:monospace;}
 
  td
     {mso-style-parent:style0;
	  font-size:8.0pt;
	  font-style:normal;
	  font-family:monospace;}
 
  
 
	</style>
	<table>
   <tr style="border:none;" style="font-family: monospace;text-transform: lowercase;font-size:12px;">
              <th style="text-align:left;" colspan="6">STADIO ITALAINO DI CONCEPCIÓN<br>
               </th></tr>
                 <tr style="border:none;">
              <th colspan="6" style="font-size:20px; text-transform:uppercase;text-align:left;">TRABAJOS SEMANA '.strftime('%e %b %g',  strtotime("".$fecha1."")).' - '.strftime('%e %b %g',  strtotime("".$fecha2."")).' </th></tr>
	</table>
	<table border="1" style="font-family: monospace;text-transform: lowercase;font-size:12px;">
            <thead>
                   <tr>
              <th class="cab_mes"></th>';
for($i=$fecha1;$i<=$fecha2;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){
	echo'<th class="fecha">'.iconv('ISO-8859-1', 'UTF-8', strftime('%A',  strtotime("".$i.""))).' '.iconv('ISO-8859-1', 'UTF-8', strftime('%d',  strtotime("".$i.""))).'</th>';
    }
echo "</tr>";
for($i=$fecha1;$i<=$fecha2;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){
    foreach ($sucategorias as $sc) {
    	$id_sc=$sc -> sctg_id;
    	$work_cat = $ci -> model_trabajos->work_dep_porfechaysub($i,$i,$id_sc);
    	if(!empty($work_cat)){
    		$array_subcategoria[]=$sc -> sctg_id ;

    		$unique_subcat = array_values(array_unique($array_subcategoria));
    	}
    }
}

if(!empty($unique_subcat)){
foreach ($unique_subcat as $usc) {
echo "<tr>";
	$sub_cate = $ci -> model_trabajos->getSubcateID($usc);
	foreach ($sub_cate as $sub_c) {
		echo '<td>'.$sub_c -> sctg_nombre.'</td>';
		for($i=$fecha1;$i<=$fecha2;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){
		    $work_dep = $ci -> model_trabajos->work_dep_porfechaysub($i,$i,$usc);
		    echo "<td>";
		    if(!empty($work_dep)){
		    	foreach ($work_dep as $wp) {
		    	echo $wp -> dep_nombre.'<br style="mso-data-placement:same-cell;" />';
		        }
		    }else{echo "-";}echo "</td>";
	    }
	}
echo "</tr>";
	# code...
}
}

//TURNOS
echo "<tr><td>trabaja</td>";
for($i=$fecha1;$i<=$fecha2;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){

	$fun_trabaja = $ci -> model_turnos->turno_trabaja_fecha($i);
	echo '<td>
	<table>

	
	';
	foreach ($fun_trabaja as $ft) {

		echo '<tr><td>'.substr($ft -> nombre_fun, 0,1).'. '. $ft-> paterno.'</td>';
		echo '<td class="td_sigla" style="background: '.$ft-> color.'; padding: 1px;">'.$ft -> sigla.'</td></tr>';
	}
	echo'</table></td>';

	
}
echo "</tr>";


//NO TRABAJA 
echo "<tr><td>no trabaja</td>";
for($i=$fecha1;$i<=$fecha2;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){

	$fun_NOtrabaja = $ci -> model_turnos->turno_NOtrabaja_fecha($i);
	echo '<td>
	<table>';
	foreach ($fun_NOtrabaja as $nft) {

		echo '<tr><td>'.substr($nft -> nombre_fun, 0,1).'. '. $nft-> paterno.'</td>';
		echo '<td class="td_sigla" style="background: '.$nft-> color.'; padding: 1px;">'.$nft -> sigla.'</td></tr>';
	}
	echo'</table></td>';

	
}
echo "</table>";




 //Impreso el '.strftime('%A %e/%b/%g - %H:%I',  strtotime("".$hoy."")).'




?>