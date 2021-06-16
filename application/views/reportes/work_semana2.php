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
 
 .princ td     {mso-style-parent:style0;
	  font-size:7.5pt;
	  font-style:normal;
	  font-family:monospace;
	  }

 .tipo_trabajo{
 	font-size:10px;
	text-transform:uppercase;
 }
 ul{
   list-style-type: none;
    
}

.princ th{

	font-size:12px;
	text-transform:uppercase;
	padding:0;
	border: 1px solid black;
}
table.princ {
border: 1px solid black;
}
.princ td{
border: 1px solid black;
}
	</style>';
?>
	<body>
		<div class="row justify-content-md-center" style="margin-bottom: 1%;">
         <div class="col-md-2" style="float: left; width: 20%">
            <img style="width: 150px;" src=" <?php '.base_url().'?>/assets/images/logo-stadio.jpg" alt="Instituciones Italianas">
         </div>
       <div class="titulo" style="float: left; width:80%;">
      <h2><center>Trabajos Semana <?php echo strftime('%e %b %g',  strtotime("".$fecha1."")).' - '.strftime('%e %b %g',  strtotime("".$fecha2.""))?></center></h2>
    
    </div>
  </div>

<table  style="font-family: monospace;text-transform: lowercase;width: 100%;" class="princ">
  <thead>
     <tr>
              <th class="cab_mes"></th>
          <?php
for($i=$fecha1;$i<=$fecha2;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){
	echo'<th class="fecha">'.iconv('ISO-8859-1', 'UTF-8', strftime('%A',  strtotime("".$i.""))).' '.iconv('ISO-8859-1', 'UTF-8', strftime('%d',  strtotime("".$i.""))).'</th>';
    }
?>
</tr>
</thead>
<tbody>
<?php
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


foreach ($unique_subcat as $usc) {
echo "<tr>";
	$sub_cate = $ci -> model_trabajos->getSubcateID($usc);
	foreach ($sub_cate as $sub_c) {
		echo '<td class="tipo_trabajo"><center>'.$sub_c -> sctg_nombre.'</center></td>';
		for($i=$fecha1;$i<=$fecha2;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){
		    $work_dep = $ci -> model_trabajos->work_dep_porfechaysub($i,$i,$usc);
		    echo "<td><ul >";
		    if(!empty($work_dep)){
		    	foreach ($work_dep as $wp) {
		    	echo '<li >'.$wp -> dep_nombre.'<br style="mso-data-placement:same-cell;" /></li>';
		        }
		    }else{echo "-";}
		    echo "</ul></td>";
	    }
	}
echo "</tr>";
	# code...
}


//TURNOS
echo "<tr>
        <td><center>TRABAJA</center></td>";
for($i=$fecha1;$i<=$fecha2;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){

	$fun_trabaja = $ci -> model_turnos->turno_trabaja_fecha($i);
	echo '<td >
	       <table style="width:100%;border:0;"><ul>';
	foreach ($fun_trabaja as $ft) {
        echo' 
          <tr>
             <td><li>'.substr($ft -> nombre_fun, 0,1).'.'. $ft-> paterno.'</li></td>
             <td class="td_sigla" style="background: '.$ft-> color.'; padding: 1px;">'.$ft -> sigla.'</td>
          </tr>';
		
	}
	echo'</ul></table>
	     </td>';

	
}
echo "</tr>";


//NO TRABAJA 
echo "<tr><td><center>NO TRABAJA</center></td>";
for($i=$fecha1;$i<=$fecha2;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){

	$fun_NOtrabaja = $ci -> model_turnos->turno_NOtrabaja_fecha($i);
	echo '<td >
	       <table style="width:100%;border:0;" ><ul>';
	foreach ($fun_NOtrabaja as $nft) {
        echo' 
          <tr>
             <td><li>'.substr($nft -> nombre_fun, 0,1).'.'. $nft-> paterno.'</li></td>
             <td class="td_sigla" style="background: '.$nft-> color.'; padding: 1px;">'.$nft -> sigla.'</td>
          </tr>';
		
		
	}
	echo'</ul></table>
	     </td>';
	
}



?>
</tbody>
</table>


	</body>
	

