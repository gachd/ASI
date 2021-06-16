<style>
td, th {
    padding: 5px;
    font-family: monospace;
    font-size: 12px;
    text-transform: uppercase;
    text-align: center;
}
.td-cont-totales {    vertical-align: top;
    padding: 15px;}
.tbl-segmentacion td{text-align: left;}

.titulo-doc{font-size: 24px;
    letter-spacing: 2px;
    font-weight: 600;}

.subtitulo-doc{font-size: 14px;
    letter-spacing: 1px;
    border-bottom: 1px solid #ccc;
    padding-bottom: 7px;
    width: 90%;
}

.texto{font-family: monospace;
    text-transform: inherit;
    font-size: 16px;
}
/*.td-list td{font-size: 11px;}*/

</style>



<?php 
$ci = &get_instance();
$ci->load->model('model_actividades');
setlocale(LC_ALL, 'es_ES').': ';	
$fecha1 = $inicio;
$fecha2 = $termino;
$hoy = date("Y-m-d H:i:s"); 
$cat = $categoria;
$subcat = $subcategoria;

$fecha1_anterior = strtotime ('-1 year' , strtotime($fecha1));
$fecha2_anterior = strtotime ('-1 year' , strtotime($fecha2));

$fecha1_a=$nuevafecha = date ('Y-m-d',$fecha1_anterior);
$fecha2_a=$nuevafecha = date ('Y-m-d',$fecha2_anterior);
 

if($excel == 0 ){
    header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
    header("Content-type:   application/x-msexcel; charset=utf-8");
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="actividades.xls"');
    header('Cache-Control: max-age=0');
    echo'<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />';
}

$actividades = $ci -> model_actividades -> busca_categoria_subcategoria($fecha1,$fecha2,$cat,$subcat);
$total = count($actividades);
if (empty($actividades)) 
	{
    	echo 'No hay registros';
	}
else{

$nombre_ctg= $ci -> model_actividades ->categoriaID($categoria);
 echo '<h1 class="titulo-doc"> Actividades de '.$nombre_ctg[0]->ctg_nombre.' del '.iconv('ISO-8859-1', 'UTF-8', strftime('%d/%b/%y',  strtotime("".$fecha1.""))).' al '.iconv('ISO-8859-1', 'UTF-8', strftime('%d/%b/%y',  strtotime("".$fecha2.""))).'</h1>';



echo'<p class="texto">Se han registrado '.$total.' actividades</p>';
		
	
$total_subcategoria_mes= $ci -> model_actividades ->total_subcategoria_mes($fecha1,$fecha2,$categoria,$subcat);
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); 
if($subcat == 0){

	$total_subcategoria = $ci -> model_actividades -> totalact_sucate_porcategoria($fecha1,$fecha2,$cat);

	echo'<div style="width:50%; float: left;"><h1 class="subtitulo-doc">Total de actividades por subcategoria </h1>

  <table  border="0">
  <tbody>
    <tr>
    <td  class="td-cont-totales">
  <table border="1">
  <tbody>
    <tr>
      <td>SUBCATERGIA</td>
      <td>TOTAL</td>
    </tr>';

    foreach ($total_subcategoria as $ts) {
    	echo'<tr>
      <td style="text-align:left;">'.$ts -> sctg_nombre.'</td>
      <td>'.$ts -> total.'</td>
    </tr>';
	}
    echo'
    <tr>
      <td style="text-align:right;">total</td>
      <td>'.$total.'</td>
    </tr>
  </tbody>
</table></td>';
}

/*********************************TOTAL SEGMENTACION*********************************************************/

$total_segmentacion = $ci -> model_actividades -> total_segmentacion_mes($fecha1,$fecha2,$cat,$subcat);
//echo $this -> db -> last_query();

if(!empty($total_segmentacion)){
foreach ($total_segmentacion as $tss) {
       $nombre_sub[] = $tss -> sctg_nombre;
     }
     $unique_nombre_sub= array_unique($nombre_sub);


echo'<td class="td-cont-totales">
<table  border="1">
  <tbody>';

     foreach ($unique_nombre_sub as $name_sub) {
      echo'<tr>
      <td>'.$name_sub.'</td>
    </tr><tr>
      <td><table border="0" class="tbl-segmentacion">
        <tbody>';
        foreach ($total_segmentacion as $tss) {
           if ($name_sub == $tss -> sctg_nombre){
                if ($tss -> total > 0 ){
                  echo'<tr>
                  <td>'.$tss -> segmentacion.'</td>
                  <td>'.$tss -> total.'</td>
                  </tr>';
                }
           }
        }


          echo'
         
        </tbody>
      </table></td>
    </tr>
    ';
       # code...
     }
    
    echo'
  </tbody>
</table>';
 }
echo'
  </tbody>
</table></div>';
   
     


/*echo('<pre>');
var_dump($total_subcat_seg);
echo('</pre>');*/






if($subcat == 0){
  echo'
<div style="width:50%;float:left;"><h1 class="subtitulo-doc">PERIODO ANTERIOR <span>Desde el '.iconv('ISO-8859-1', 'UTF-8', strftime('%d/%b/%y',  strtotime("".$fecha1_a.""))).' al '.iconv('ISO-8859-1', 'UTF-8', strftime('%d/%b/%y',  strtotime("".$fecha2_a.""))).'</span></h1>';
$actividades_ant = $ci -> model_actividades -> busca_categoria_subcategoria($fecha1_a,$fecha2_a,$cat,$subcat);
$total_ant = count($actividades_ant);

  $total_subcategoria_anterioir = $ci -> model_actividades -> totalact_sucate_porcategoria($fecha1_a,$fecha2_a,$cat);

  echo'

  <table border="1">
  <tbody>
    <tr>
      <td>SUBCATERGIA</td>
      <td>TOTAL</td>
    </tr>';

    foreach ($total_subcategoria_anterioir as $ts) {
      echo'<tr>
      <td style="text-align:left;">'.$ts -> sctg_nombre.'</td>
      <td>'.$ts -> total.'</td>
    </tr>';
  }
    echo'
    <tr>
      <td style="text-align:right;">total</td>
      <td>'.$total_ant.'</td>
    </tr>
  </tbody>
</table>';

echo'</div>';
}










/****calculo maximo y minimo*****/

$max="0";
$min="12";

foreach ($total_subcategoria_mes as $tsm) {
 if ($max < $tsm -> mes) {
 	$max = $tsm -> mes;
 }
           
 if ($min > $tsm -> mes) {
 	$min = $tsm -> mes;
 }

 $sctg_total [] = $tsm -> sctg_nombre;

}

$unique_sctg_total = array_unique($sctg_total);

if($max > 1){

echo'
<div style="width:100%;float:left;">
<h1 class="subtitulo-doc"> Total mensual por subcategoria</h1>
<table  border="1">
  <tbody><tr><td>SUBCATEGORIA</td>';

/****IMPRIMO MESES SEGUN MAX Y MINIMO***/
for ($i = $min; $i < ($max+1); $i++) {
	
    print "<td>".$meses[$i-1]."</td>";
}

   echo' </tr>';
   
      

      	
foreach ($unique_sctg_total as $nom_subcategoria) {
      	echo '<tr><td>'.$nom_subcategoria.'</td>';

      	for ($n = $min; $n < ($max+1); $n++) {



             echo'<td>';
      		foreach ($total_subcategoria_mes as $t) {

      			$nom_sub = $t -> sctg_nombre;
      			$mes_sub = $t -> mes;
      			$total_sub = $t -> total;

      			
      			

      			if($nom_sub == $nom_subcategoria && $mes_sub==$n){ echo '<span style="">'.$total_sub.'</span>';}
      			else{ echo "";}
      		}
      		echo'</td>';
      	}
      	echo '</tr>';
}
   echo' 
  </tbody>
</table>';
}



echo'<div class="row" style="margin:15px;">
<h1 class="subtitulo-doc" >Listado de Actividades </h1><table border="1">
  <thead>
    <tr>
      <td height="24">fecha</td>
      <td height="24">duración</td>
      
      <td>subcategoria</td>
      <td>segmentacion</td>
      <td>organizacion</td>
      
      <td>Hr. inicio</td>
      <td>hr.termino</td>
      <td>responsable</td>
      <td>nº<br> socios</td>
      <td>nº<br> externos</td>
      <td>nº total <br>prsns</td>
      <td>dependencia</td>
      <td>observaciones</td>

    </tr></thead><tbody>';

    foreach ($actividades as $a) {
    	$act_id= $a -> act_id;
      $fecha_inicio = iconv('ISO-8859-1', 'UTF-8', strftime('%a %d/%b/%y',  strtotime("".$a -> act_fecha."")));
      $fecha_termino = iconv('ISO-8859-1', 'UTF-8', strftime('%a %d/%b/%y',  strtotime("".$a -> act_fecha_termino."")));

      if($fecha_termino == $fecha_inicio){$fecha_termino="";}

      $n_externos=$a -> act_nprsns;
      $n_socios=$a -> act_nsocios;
      $total_personas = $n_externos+$n_socios;
      $act_externa=$a -> act_externo;

      if($act_externa== 1){$txt_externa="Int";}else{$txt_externa="ext";}







    	echo'<tr class="td-list">
      <td>'.$fecha_inicio.'<br> '.$fecha_termino.'</td><td>';
      $duracion= $this -> model_actividades -> duracion_dias($act_id);
      foreach($duracion as $du ){echo ''.$du -> duracion.' días';}
      echo'</td><td>'.$a -> sctg_nombre.'</td>
      <td>';
      $seg_act= $this -> model_actividades -> segmentacion_act($act_id);
      foreach($seg_act as $sa ){echo ''.$sa -> segmentacion.' <br>';}

      echo'</td>
      <td>'.$txt_externa.'</td>
      <td>'.date("H:i",strtotime($a -> act_inicio)).'</td>
      <td>'.date("H:i",strtotime($a -> act_termino)).'</td>
      <td>'.$a -> act_responsable.'</td>
      <td>'.$n_socios.'</td>
      <td>'.$n_externos.'</td>
      <td>'.$total_personas.'</td><td>';
      $dep= $this -> model_actividades -> getDepen($act_id);
      foreach($dep as $d ){echo ''.$d -> dep_nombre.' <br>';}
	  echo'</td><td>'.$a -> act_evento.'</td></tr>';
    }
    echo'</tbody>
</table></div></div>';


}





?>