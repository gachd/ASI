<!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<style>
	 body{
text-align:center;
margin:0 auto;
font-size: 12px;
font-family: monospace;

}
    .contenedor{
margin: 0 auto;
text-align:left;
width:70%;
}



		.tbl_mant{border:1px solid #000;border-collapse: collapse;    text-transform: lowercase; margin-top: 15px;}
    table.tbl_mant thead th{    border: 1px solid #ccc;
    text-transform: uppercase;
    background: aliceblue;
    text-align: center;
    padding: 2px;}
    table.tbl_mant tbody td{border: 1px solid #ccc; padding:7px; text-transform: uppercase; font-size: 11px;}
 i {text-transform: lowercase;}
    .titulo{text-transform: uppercase;}
</style>

<body>
	<div class="contenedor">
		<table>
		
   <tbody><tr style="border:none;">
              <th style="text-align:left;" colspan="6">STADIO ITALAINO DI CONCEPCIÓN<br>
                Impreso el <?php setlocale(LC_ALL, 'es_ES').': '; 
                $hoy = date("Y-m-d H:i:s"); 
                 echo ' '.iconv('ISO-8859-1', 'UTF-8', strftime('%A %e/%b/%g - %H:%I',  strtotime("".$hoy.""))).''; ?></th></tr>
                
	</tbody></table>
	<?php
	$dep  = $id;
     $dependencia = $this  -> model_dependencias -> det_dep($dep);
	 ?>
	<table  width="600" style="text-align: center;"><tr><td><h1 class="titulo">TRABAJOS REALIZADOS en <br><?php echo $dependencia[0] -> dep_nombre; ?> </h1></td></tr></table>
<?php 

	$sub  = $sub;
	//echo $dep.'-'.$sub;	
	 $trabajos= $this -> model_trabajos -> trabajos_dependencia($dep,$sub);
	// var_dump($trabajos);
if(!empty($trabajos)){

	echo '<table width="600" class="tbl_mant" >
    <thead>
      <tr class="table-info">
      <th>fecha</th>
      <th>Duración</th>
      <th>categoria</th>
      <th>sub-categoria</th>
     
      <th>responsable</th>
      </tr>
    </thead>
    <tbody>';
    foreach ($trabajos as $t ){

    	if ($t -> tb_fecha_termino < $t -> tb_fecha){
    		$duracion ="";
    	}else{ $duracion=($t-> duracion+1).'día';}
         echo' <tr>
      <td>'.iconv('ISO-8859-1', 'UTF-8', strftime('%d/%b/%Y',  strtotime("".$t -> tb_fecha.""))).'</td>

      <td>'.$duracion.'</td>
      <td>'.$t-> ctg_nombre.'</td>
      <td>'.$t-> sctg_nombre.'<br><i>'.$t-> tb_descripcion.'</i></td>      
      <td>';
       $operarios = $this -> model_trabajos -> getFuncionarioWORK($t -> tb_id);
      if(!empty($operarios)){
        foreach ($operarios as $o) {
        	echo $o -> nombre_fun.' '. $o -> paterno.'<br>';
        	 
        }
      }else{echo $t -> tb_responsable;}
      
      echo'</td>
       </tr>';
    }
       echo'</tbody>
       </table>';
      }else{echo "<p>No se registran trabajos en esta categoria</p>";}
?>
</div>
</body>
</html>



















