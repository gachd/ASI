<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>plan mensual de trabajo</title>
	<style>
    #contenedor{
      margin: 0 auto;
      text-align:left;
      width:100%;
      font-family: monospace;
    }
     #impreso{font-size: 11px; font-family: monospace;}
		.trabajos{font-family: monospace; text-align: center; border-collapse: none;}
		table.trabajos th {background: #ccc; text-align: center; text-transform: uppercase;}
		.dep{text-transform: uppercase;
    text-align: left;
    padding: 2px 0px 2px 5px;}
    .titulo{font-family: monospace; font-size: 18px; text-align: center;text-transform: uppercase;}
    h3{font-size: 14px; text-transform: uppercase;}
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
	  <h1 class="titulo">Plan Mensual de Trabajo <br> <?php 
    
       $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        echo "".$meses[$mes-1]."";
	  ?> del <?php echo $year;?></h1>

	  <?php
        $categoria= $this -> model_trabajos -> categorias_con_trabajos_planificados($year,$mes,$work_categorias);

    foreach ($categoria as $c) {
		$id_categoria=$c -> ctg_id;
		echo'<h3>'.$c -> ctg_nombre.'</h3>';

		echo'<table width="800" border="1" class="trabajos">
              <thead>
                <tr>
                <th width="50">sector</th>
                  <th width="275">sector/dependencia</th>
                ';

                 
                  $sub_categorias=$this -> model_trabajos -> subcategorias_con_trabajos_planificados($year,$mes,$id_categoria);
                    foreach ($sub_categorias as $sc) {
                    	$id_subcategoria =$sc -> sctg_id;
                    	echo'<th>'.$sc-> sctg_nombre.'  </th>';
                    }
                  echo'</tr></thead>';
                  $dependencias=$this -> model_trabajos -> dependencias_con_trabajos_planificados($year,$mes,$id_categoria);
                  foreach ($dependencias as $d) {
                  	$id_dependencia = $d -> dependencia;
                  	echo'<tbody><tr>
                  	<td>'.$d -> sector.'</td>
                  <td class="dep">'.$d -> dep_nombre.' </td>';
                  foreach ($sub_categorias as $sc) {
                    	$id_subcategoria =$sc -> sctg_id;
                  $total_trabajos = $this -> model_trabajos -> total_trabajos_planificados ($year,$mes,$id_subcategoria,$id_dependencia);
                  foreach ($total_trabajos as $tt) {
                  	if ($tt -> total == 0 ){echo'<td></td>';}else{
                  	echo'<td>'.$tt -> total.'</td>';}
                  }
                }
                   

                echo'</tr>';
                  }

                echo'
                      
                <tr>
                  	<td colspan="2"><B>TOTAL</B></td>
                  	';
                  	foreach ($sub_categorias as $sc) {
                    	$id_sub =$sc -> sctg_id;
                    	$total_subs = $this -> model_trabajos -> total_subcategoria_planificada($year,$mes,$id_sub);
                    	foreach ($total_subs as $key => $ts) {
                    		echo'<td><b>'.$ts -> total.'</b></td>';
                    	}

                    }

                  	echo'</tr>
               
              </tbody>
            </table>';
	}
	   ?>
   </div>
</body>
</html>