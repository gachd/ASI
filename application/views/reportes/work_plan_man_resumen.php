<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>.totales{background: #ccc; text-align: center; font-weight: 600;}
.planificacion{margin-bottom: 15px; font-family: monospace; text-transform: uppercase ;}
.cantidad{text-align: center;}
.mes{text-align: center;}
.sector{padding-right: 5px; min-width: 100px; max-width: 100px;}
h3{text-transform: uppercase;}
</style>
</head>
<body>
	<h2>PLAN DE MANTENIMIENTO SECTORES <?php echo $year; ?></h2>
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
     $categoria= $this -> model_trabajos -> categorias_plan_temporada_anual($year);

    foreach ($categoria as $c) {
		$id_categoria=$c -> pl_categoria;
		echo'<h3>'.$c -> ctg_nombre.'</h3>';
		 $subcategorias= $this -> model_trabajos ->subcategorias_plan_temporada_anuales($year,$id_categoria);
		foreach ($subcategorias as $s) {
		    $id_sub = $s -> pl_subcategoria;
		    echo'<table width="800" border="1" class="planificacion">
                 <tbody>
                   <tr>
                   <td class="proceso">'.$s -> sctg_nombre.'</td>';
                   for ($i=1; $i <= 12 ; $i++) { 

         	            //TEMPORADA DEL MES
         	            if($i > 3 and $i < 11  ){$nom_temporada="Temp.Baja";}
         	            else{ /*temporada alta*/ $nom_temporada="Temp.Alta";}

         	         

         	            echo'<td class="mes"><span style="font-size:10px;">'.$nom_temporada.'</span> '.$meses[$i-1].'</td>';
                    }
                   echo'</tr>';


                   /*****************************totales SECTORES****************/
                    $sectores = $this -> model_trabajos -> sectores_plantemporada_anuales($year,$id_sub);
                    foreach ($sectores as $s) {
                    	echo'<tr>';
                    	$id_sector = $s -> sector;
                    	echo '<td  class="sector">Sector '.$id_sector.'</td>';
                    	for ($i=1; $i <= 12 ; $i++) { 
                    	 	// NUMero de DIAS DEL MES
         	                 $numero_dias = cal_days_in_month(CAL_GREGORIAN, $i, $year);
         	                $numero_semanas = ((countSemanasMes($year,$i))-1); /* quito una contada en el mes */
                            //$numero_semanas = round($numero_dias /7);
                    	 	echo'<td class="cantidad">';
                    	 	$total = 0;
         	                if($i > 3 and $i < 11  ){/*TEMPORADA BAJA*/$temporada=1;}
         	                	                else{ /*temporada alta*/ $temporada=2;}
         	                	//$total='SELECT dependencia.sector, sum(pl_cantidad) as cantidad, pl_periocidad, pl_subcategoria, pl_temporada FROM `plan_temporada` INNER JOIN dependencia ON plan_temporada.pl_dependencia = dependencia.dep_id WHERE `pl_year` = '.$year.' and `pl_subcategoria`= '.$id_sub.' AND pl_temporada = '.$temporada.' AND sector = '.$id_sector.' GROUP by pl_periocidad, sector ORDER BY sector DESC';
         	               $cantidades_sector= $this -> model_trabajos -> cantidad_sectores_plan_anuales($year,$id_sub,$temporada,$id_sector);
         	                 //echo $this-> db -> last_query();
                             
                        	 //echo '<td>'.$total.'</td>';
         	                if(!empty($cantidades_sector)){
         	                foreach ($cantidades_sector as $cs) {
                        	    $cantidad_cs = $cs -> cantidad;
                        	    $sector_cs = $cs -> sector;
                        	    $pl_periocidad_cs = $cs -> pl_periocidad;
                        	    $pl_subcategoria_cs = $cs -> pl_subcategoria ;
                        	    $cantidad_total="0";
                        	    $color="";

                        	    switch ($pl_periocidad_cs) {
                        	    	
                        	        case 3: // DIARIO
                        	        	$cantidad_total = ($cantidad_cs * $numero_dias );
                        	        	$color ="yellow";
                        	        	break;
                        	        case 4 :// SEMANAL:
                        	        	$cantidad_total = ($cantidad_cs * $numero_semanas);
                        	        	$color ="red";
                        	        	break;
                        	        case 5:
                        	        	$cantidad_total = ($cantidad_cs * ($numero_semanas * 5));
                        	        	$color ="green";
                        	        	break;
                        	        default: // MENSUAL y ANUL 
                        	    		$cantidad_total = $cantidad_cs;
                        	    		break;
                        	    }
                                // echo '*<span style="background:'.$color.'">'.$cantidad_total.' </span> - '.$pl_periocidad_cs.'*<br>';
                                $total += $cantidad_total;
                            }
                                 echo'<span>'.$total.'</span></td>';
                            } echo'</td>';

         	            }
                    
                    	echo'</tr>';
                    }
                     /***************************totales *********************/

                    echo'
                    <tr><td>TOTALES</td>';

                    for ($i=1; $i <= 12 ; $i++) { 
                    	 $tm_total =0;
                    	$tm_numero_dias = cal_days_in_month(CAL_GREGORIAN, $i, $year);
         	            $tm_numero_semanas = ((countSemanasMes($year,$i))-1);
                        //$tm_numero_semanas = round($tm_numero_dias/7);
                    	  if($i > 3 and $i < 11  ){/*TEMPORADA BAJA*/$temporada=1;}
         	                	                else{ /*temporada alta*/ $temporada=2;}


                    	echo'<td class="totales">';
                        $totales_mes = $this -> model_trabajos -> totalcantidad__plan_anuales($year,$id_sub,$temporada);

                        if(!empty($totales_mes)){
                           foreach ($totales_mes as $tm) {
                        	$tm_cantidad = $tm -> cantidad;
                        	$tm_periocidad = $tm -> pl_periocidad;
                        	switch ($tm_periocidad) {
                        	    	
                        	        case 3: // DIARIO
                        	        	$tm_cantidad_total = ($tm_cantidad * $tm_numero_dias );
                        	        	$tm_color ="yellow";
                        	        	break;
                        	        case 4 :// SEMANAL:
                        	        	$tm_cantidad_total = ($tm_cantidad * $tm_numero_semanas);
                        	        	$tm_color ="red";
                        	        	break;
                        	        case 5:
                        	        	$tm_cantidad_total = ($tm_cantidad * ($tm_numero_semanas * 5));
                        	        	$tm_color ="green";
                        	        	break;
                        	        default: // MENSUAL y ANUL 
                        	    		$tm_cantidad_total = $tm_cantidad;
                        	    		break;
                        	    }

                        	    $tm_total += $tm_cantidad_total;
                        	   
                           }

                    	   echo' '.$tm_total.'</td>';
                        }else{echo "</td>";}

                    }

                    echo'</tr>
                    </tbody>
                </table>';
        }
	}















    ?>

</body>
</html>