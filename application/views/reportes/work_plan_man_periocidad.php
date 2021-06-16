

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Plan MAntenimiento</title>
</head>
<style>
#contenedor{
      margin: 0 auto;
      text-align:left;
      width:100%;
      font-family: monospace;
      text-transform: uppercase ;
    }
    #impreso{font-size: 11px; font-family: monospace;}
	.planificacion{margin-bottom: 15px; font-family: monospace; text-transform: uppercase ; border-collapse: none;}
	.proceso{max-width:200px; font-weight: 600;}
    table.planificacion th{background: #ccc;}
	.dependencia{max-width: 200px;width: 200px;min-width: 200px;text-transform: uppercase ; }
	.mes{padding: 5px;}
    .totales{    text-align: center;
    line-height: 10px;
    padding: 5px;}
</style>
<body>
     <table  style="border:none;"  id="impreso">
    
   <tbody><tr style="border:none;">
              <th style="text-align:left;" colspan="6">STADIO ITALAINO DI CONCEPCIÓN<br>
                Impreso el <?php setlocale(LC_ALL, 'es_ES').': '; 
                $hoy = date("Y-m-d H:i:s"); 
                 echo ' '.iconv('ISO-8859-1', 'UTF-8', strftime('%A %e/%b/%g - %H:%I',  strtotime("".$hoy.""))).''; ?></th></tr>
                
  </tbody></table>
    <div id="contenedor">

    
    <!--  PLAN DEPENDENCIAS POR PERIOCIDAD -->

	<h1 style="text-align: center;"> PLAN DE MANTENIMIENTO <?php echo $year; ?><br><i style="text-align: center; font-size: 10px; text-transform: lower; line-height: 1px;">A continuación se detalle el nuemero optimo de veces que debe realizarse un proceso en las distintas dependencias</i></h1>
     
	<?php 
	 
	 $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
     // contar dias de la semana
    function countSemanasMes ($ano, $mes) {
        $data = new DateTime("$ano-$mes-01");
        $dataFimMes = new DateTime($data->format('Y-m-t'));

        $numSemanaInicio = $data->format('W');
        $numSemanaFinal  = $dataFimMes->format('W') + 1;

        // Última semana do ano pode ser semana 1
        $numeroSemanas = ($numSemanaFinal < $numSemanaInicio)  
            ? (52 + $numSemanaFinal) - $numSemanaInicio
            : $numSemanaFinal - $numSemanaInicio;

        return $numeroSemanas;
    }
    $categoria= $this -> model_trabajos -> categorias_plan_temporada_anual($year,$work_categorias);
	foreach ($categoria as $c) {
		$id_categoria=$c -> pl_categoria;

		echo'<h3>'.$c -> ctg_nombre.'</h3>';

        $subcategorias= $this -> model_trabajos ->subcategorias_plan_temporada_anuales($year,$id_categoria,$work_subcategoria);
		foreach ($subcategorias as $s) {
		$id_sub = $s -> pl_subcategoria;
		echo'<table width="800" border="1" class="planificacion">
  <thead>
    <tr>
      <th class="proceso">'.$s -> sctg_nombre.'</th>';
      
         for ($i=1; $i <= 12 ; $i++) { 
         	if($i > 3 and $i < 11  ){$nom_temporada="T.BAJA";}
         	else{ /*temporada alta*/ $nom_temporada="T.ALTA";}
            $numero_dias = cal_days_in_month(CAL_GREGORIAN, $i, $year);
                        $numero_semanas = ((countSemanasMes($year,$i))-1); /* quito una contada en el mes anterior*/
         	echo'<th class="mes">'.$meses[$i-1].'<br><span style="font-size:10px;">'.$nom_temporada.'<br>días:'.$numero_dias.'<br>
                             sem: '.$numero_semanas.'</span></th>';
         }
	echo'</tr></thead>
    <tbody>
    ';
      $dependencias = $this -> model_trabajos -> dep_plantemporada_anuales($year,$id_sub);
    foreach ($dependencias as $d) {
        echo'<tr>';
    	$id_dep = $d -> pl_dependencia;
    	echo '<td class="dependencia">'.$d -> dep_nombre.'</td>';
       for ($i=1; $i <= 12 ; $i++) { 
         	if($i > 3 and $i < 11  ){
         		/*TEMPORADA BAJA*/$temporada=1;}
         		else{ /*temporada alta*/ $temporada=2;}

       // echo'<td> dep: '.$id_dep.'</td>';

        $cantidad = $this -> model_trabajos -> cantidad_plan_anual($year,$id_sub,$id_dep,$temporada);
        $total = 0;
         if(!empty($cantidad)){
            $c_numero_dias = cal_days_in_month(CAL_GREGORIAN, $i, $year);
            $c_numero_semanas = ((countSemanasMes($year,$i))-1);
            //$c_numero_semanas = round($c_numero_dias/7);
             foreach ($cantidad as $cant) {
         	   $numero = $cant -> pl_cantidad;
         	   $sigla = $cant -> periocidad;
               $periocidad = $cant -> pl_periocidad;
               $cantidad_total="0";
               $color="";

                                switch ($periocidad) {
                                    
                                    case 3: // DIARIO
                                        $cantidad_total = ($numero * $c_numero_dias );
                                        $color ="yellow";
                                        break;
                                    case 4 :// SEMANAL:
                                        $cantidad_total = ($numero * $c_numero_semanas);
                                        $color ="red";
                                        break;
                                    case 5:
                                        $cantidad_total = ($numero * ($c_numero_semanas * 5));
                                        $color ="green";
                                        break;
                                    default: // MENSUAL y ANUL 
                                        $cantidad_total = $numero;
                                        break;
                                }
                $total += $cantidad_total;
         	   echo'<td class="totales"><b>'.$total.'</b><br><span style="font-size:9px;">'.$numero.' '.$sigla.'</span></td>';
            }
         }else{echo "<td> </td>";}
         }
    	echo"</tr>";
    }
	}



    echo'
      
      
  </tbody>
</table>';
	}
	?>
</div>	
</body>
</html>