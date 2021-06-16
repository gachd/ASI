<!DOCTYPE html>
<html>


<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />


<?php 
//$html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');

$ci = & get_instance();
//$ci->load->model("menu_model");

$ci->load->model('model_turnos');

setlocale(LC_ALL, 'es_ES').': ';	
$fecha1 = $inicio;
$fecha2 = $termino;
$hoy = date("Y-m-d H:i:s"); 

$horarios = $this -> model_turnos -> horarios_rango_fecha ($fecha1,$fecha2);
echo '<body style="text-transform: uppercase;">';
echo '<div class="container-fluid" style="border:2px black solid;">';
echo'<div class="container-fluid">
       <div class="row justify-content-md-center">
         <div class="col-md-2">
            <img style="width: 150px;" src="'.base_url().'/assets/images/logo-stadio.jpg" alt="Instituciones Italianas">
         </div>
       <div class="col-md-8">
      <h3><center>TURNOS DE TRABAJO </br> DESDE EL  '.strftime('%e/%b/%g',  strtotime("".$fecha1."")).' AL '.strftime('%e/%b/%g',  strtotime("".$fecha2."")).' </center></h3>
    </div></div></div>';
echo'	<div  class="table-responsive"  style="margin-top:30px;">
 
	<table border="1" style="font-family: monospace;font-size:12px;" class="table" >
            <thead>
                   <tr>
              <th class="cab_mes" style="padding:5px;text-align: center;text-transform: uppercase;">PERSONAL STADIO</th>';
              for($i=$fecha1;$i<=$fecha2;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){
	echo'<th style="padding:5px;text-align: center;text-transform: uppercase;" class="fecha">'.iconv('ISO-8859-1', 'UTF-8', strftime('%A',  strtotime("".$i.""))).' '.iconv('ISO-8859-1', 'UTF-8', strftime('%d',  strtotime("".$i.""))).'</th>';
    }
echo "</tr></thead>";


$horarios = $this -> model_turnos -> horarios_rango_fecha ($fecha1,$fecha2);

foreach ($horarios as $h) {
	$h_inicio= $h -> t_inicio;
	$h_termino = $h-> t_termino;

	 echo'<tr>';
	 echo '<td style="padding:5px;text-align: center;">'.date("H:i", strtotime($h_inicio)).'-'.date("H:i", strtotime($h_termino)).'</td>';
	 for($i=$fecha1;$i<=$fecha2;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){
	 	$turno=$this -> model_turnos -> turno_rango_horario ($i,$h_inicio,$h_termino);
    	echo'<td class="name" style="text-transform: uppercase; padding: 5px;text-align: center;">';
    	foreach ($turno as $key => $t) {
    			echo $t -> nombre.' '.$t-> apellido.' </br>';
          
    	}
    	echo'</td>';
    }

	}
 echo'</tr>
 </table></div>';


/******************************GURDIAS*********************************/
 echo'<div  class="table-responsive" style="margin-top:30px;">
  
	<table border="1"  style="font-family: monospace;font-size:12px;overflow-x: auto;" class="table">
            <thead>
                   <tr>
              <th class="cab_mes" style="padding:5px;text-align: center;text-transform: uppercase;">GUARDIAS</th>';
              for($iG=$fecha1;$iG<=$fecha2;$iG = date("Y-m-d", strtotime($iG ."+ 1 days"))){
	echo'<th style="padding:5px;text-align: center;text-transform: uppercase;" class="fecha">'.iconv('ISO-8859-1', 'UTF-8', strftime('%A',  strtotime("".$iG.""))).' '.iconv('ISO-8859-1', 'UTF-8', strftime('%d',  strtotime("".$iG.""))).'</th>';
    }
echo "</tr></thead>";

$horariosG= $this -> model_turnos -> guardias_horarios_rango_fecha ($fecha1,$fecha2);



foreach ($horariosG as $hG) {
	$hG_inicio= $hG -> t_inicio;
	$hG_termino = $hG-> t_termino;
	 echo'<tr>';
	 echo '<td style="padding:5px;text-align: center;">'.date("H:i", strtotime($hG_inicio)).'-'.date("H:i", strtotime($hG_termino)).'</td>';

	 for($iG=$fecha1;$iG<=$fecha2;$iG = date("Y-m-d", strtotime($iG ."+ 1 days"))){
	 	$turnoG=$this -> model_turnos -> guardias_turno_rango_horario ($iG,$hG_inicio,$hG_termino);
    	echo'<td class="name" style="padding:5px;text-align: center;">';
    	foreach ($turnoG as $tG) {
    			echo $tG -> nombre.' '.$tG-> apellido.' </br>';
    	}
    	echo'</td>';
     }



	

	}
 echo'</tr>
 </table></div>';
 //echo '<span style="font-size:10px;"> Impreso el '.strftime('%A %e/%b/%g - %H:%I',  strtotime("".$hoy."")).'</span>';

echo '</div>';
echo '</body>';
?>
</html>