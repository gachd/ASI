<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
		#contenedor{
      margin: 0 auto;
      text-align:left;
      width:100%;
      font-family: monospace;
    }
     #impreso{font-size: 11px; font-family: monospace;}
     .planificacion{margin-bottom: 15px; font-family: monospace; text-transform: uppercase ; border-collapse: none; }
     table.planificacion td{text-transform: uppercase;padding: 2px 2px 2px 5px;}
     table.planificacion th {background: #ccc; text-align: center; text-transform: uppercase;}
     .chek{text-align: center; font-size: 10px;}
     .titulo{font-family: monospace; font-size: 18px; text-align: center;text-transform: uppercase;}
	</style>
</head>
<body>
	 <table  style="border:none;" id="impreso">
    
   <tbody><tr style="border:none;">
              <th style="text-align:left;" colspan="6">STADIO ITALAINO DI CONCEPCIÓN<br>
                Impreso el <?php setlocale(LC_ALL, 'es_ES').': '; 
                $hoy = date("Y-m-d H:i:s"); 
                 echo ' '.iconv('ISO-8859-1', 'UTF-8', strftime('%A %e/%b/%g - %H:%I',  strtotime("".$hoy.""))).''; ?></th></tr>
                
  </tbody></table>
  <div id="contenedor">
	<h1 class="titulo">calendario de trabajo <br> <?php 
    
       $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        echo "".$meses[$mes-1]."";
	  ?> del <?php echo $year;?></h1>
	
	<?php
     $categoria= $this -> model_trabajos -> categorias_con_trabajos_planificados($year,$mes,$work_categorias);
    foreach ($categoria as $c) {
		$id_categoria=$c -> ctg_id;
		echo'<h3>'.$c -> ctg_nombre.'</h3>';
		 $sub_categorias=$this -> model_trabajos -> subcategorias_con_trabajos_planificados($year,$mes,$id_categoria,$work_subcategoria);
		  $numero = cal_days_in_month(CAL_GREGORIAN, $mes, $year);
		   foreach ($sub_categorias as $sc) {
		   	    echo'<table width="800" border="1" class="planificacion">
                  <thead>
                    <tr>
                       <th>sector</th>
                      <th class="proceso">';

                $id_subcategoria =$sc -> sctg_id;
                echo $sc-> sctg_nombre.'  </th>'; 
                 setlocale(LC_ALL, 'es_ES').': ';
                 for($i = 1; $i <= $numero; $i++) {
                 	$fecha=$year.'-'.$mes.'-'.$i;
                 	echo'<th>'.iconv('ISO-8859-1', 'UTF-8', strftime('%a %d',  strtotime(     "".$fecha.""))).'</th>';
                 }
                echo'<th>total</th></tr>';

                echo'<tbody>';
            $dependencias=$this -> model_trabajos -> dependencias_con_trabajos_planificados($year,$mes,$id_categoria);
                  
                  foreach ($dependencias as $d) {
                  	$total=0;
                  	$id_dependencia = $d -> dependencia;
                  	echo'<tr>
                  	<td>'.$d -> sector.'</td>
                  <td class="dep">'.$d -> dep_nombre.' </td>';
                    for($i = 1; $i <= $numero; $i++) {
                			$fechab="".$year."-".$mes."-".$i."";
                		$trabajos = $this ->model_trabajos->cargar_trabajos($fechab,$id_categoria,$id_subcategoria,$id_dependencia);
                		if(!empty($trabajos)){echo'<td class="chek">x</td>'; $total ++;}else{echo'<td></td>';}
                		
                	}

                  echo'<td>'.$total.'</td></tr>';
              }
               echo'</tbody>
</table>';  
            }
            

               
    }  
	?>
 </div>
</body>
</html>