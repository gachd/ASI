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
#contenedor{
margin: 0 auto;
text-align:left;
width:70%;}

	.detalle{border:1px solid #000; text-align: center; 
		text-transform: uppercase;}
	table.detalle thead th{background: #cccccc; text-transform: uppercase;}
	.nom_sub{background: none !important;}
.det_dep{
    padding-bottom: 8px;
    padding-top: 8px;
    border-left: 1px solid #000;
    border-right: 1px solid #000;
    border-bottom:  1px solid #000;}
 .titulo_list{    width: 598px;
    background: #cccccc;
    border-left: 1px solid #000;
    border-right: 1px solid #000;
     text-align: center;}   
    .tipo{    border-style: solid;
    border-width: 0px 1px 0px 1px;
    border-color: black;
    width:598px;
    padding: 6px 6px;
    /* text-align: center; */
    text-transform: uppercase;
    background: #f7f7f7;}

    .nom_dep{    text-transform: uppercase;}
    .dep{font-weight: 600;}

    .
</style>
<body>
	<table>
		
   <tbody><tr style="border:none;">
              <th style="text-align:left;" colspan="6">STADIO ITALAINO DI CONCEPCIÓN<br>
                Impreso el <?php setlocale(LC_ALL, 'es_ES').': '; 
                $hoy = date("Y-m-d H:i:s"); 
                 echo ' '.iconv('ISO-8859-1', 'UTF-8', strftime('%A %e/%b/%g - %H:%I',  strtotime("".$hoy.""))).''; ?></th></tr>
                
	</tbody></table>
<div id="contenedor">
<?php 


$det_subsector= $this -> model_dependencias -> detalle_subsector($id);
	$npersonas= $this -> model_dependencias -> npersonas_subsector($id);
	$mtc= $this -> model_dependencias -> mt_construidos($id);
	$tipos= $this -> model_dependencias -> tipos_subsector($id);
	foreach ($det_subsector as $dts) {
		$mt = round($dts -> mt,2);
		$nombre = $dts -> nombre;
		$sector = $dts -> sector;
		$total_dep = $dts -> total_dep;
	}

?>
<table  width="600" style="text-align: center;"><tr><td><h1>FICHA TÉCNICA SUBSECTOR</h1></td></tr></table>
<table width="600" class="detalle">
  <thead>
    <tr>
      <th>código</th>
      <th colspan="4">sub-sector</th>
    </tr>
    <tr>
      <th class="nom_sub"><?php echo '00'. $id?></th>
      <th colspan="4" class="nom_sub">
      	<h2><?php echo $nombre ?></h2>
      </th>
    </tr>
    <tr>
      <th>sector</th>
      <th>nº dependencias</th>
      <th>
      mt&sup2;<br> construidos</th>
      <th>Total <br>mt&sup2;<br>
        </th>
      <th>nº personas</th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <td><?php echo $sector ?></td>
      <td><?php echo $total_dep ?></td>
      <td><?php echo round($mtc[0] -> mtc,2)?></td>
      <td><?php echo $mt ?></td>
      <td><?php echo $npersonas[0]-> total ?></td>
    </tr>
  </tbody>
</table>
<div class="titulo_list">DEPENDENCIAS</div>
<?php $dependencias = $this -> model_dependencias -> resdep_subsector($id);

foreach ($tipos as $t) {
	echo '<div class="tipo">'.$t -> nom_tipo.'</div>';
    
    foreach ($dependencias as $d) {
   $capacidad_dep = $this -> model_dependencias -> npersonas_dep ($d -> dep_id);

    if($t-> tipo == $d -> tipo){

    $ancho = $d -> ancho;
    $largo = $d -> largo;
    $alto = $d -> alto;
    $medidas="";

    if((!empty($ancho))&&(!empty($largo))){
     if(!empty($alto)){
     	$medidas=$ancho.' x '.''.$largo.' x '.$alto.'';
     }else{
     	$medidas=$ancho.' x '.''.$largo.'';
     }
    }

    $medidas_cancha = $this -> model_dependencias -> medidas_canchas($d -> dep_id);
    $c_ancho="";
    $c_largo="";
    $c_marcacion="";
   

    foreach ($medidas_cancha as $mc) {
    	 $id_c = $mc-> id_caracteristica ;
    	if($id_c == 30){$c_ancho = $mc -> detalle;}
    	if($id_c == 31){$c_largo = $mc -> detalle;}
    	if($id_c == 32){$c_marcacion = $mc -> detalle;}
    	
    	if((!empty($c_ancho))&&(!empty($c_largo))){
    		$mt_cancha = $c_ancho*$c_largo;
    	}
    }
	    echo'<div><table width="600" border="0" class="det_dep">
      <tbody>
    <tr class="dep">
      <td width="109">Dependencia</td>
      <td width="481" class="nom_dep">'.$d -> dep_nombre.'</td>
    </tr>
    <tr>
      <td width="109">Código</td>
      <td width="481">'.$d -> dep_id.'</td>
    </tr>
    <tr>
      <td>Estado</td>
      <td>'.$d -> estado.'</td>
    </tr>
    <tr>
      <td>Medidas</td>
      <td>'.$medidas.' </td>
    </tr>
    <tr>
      <td>Mt&sup2;</td>
      <td>'.round($d -> mt,2).'</td>
    </tr>
    <tr>
      <td>Capacidad.</td>
      <td>'.$capacidad_dep[0]-> total.'</td>
    </tr>';
    if((!empty($c_ancho))&&(!empty($c_largo))){
    	echo'<tr>
           <td>Espacio Juego</td>
           <td>'.$c_ancho.' x '.$c_largo.'</td>
    	</tr>
    	<tr>
    	<td>Mt&sup2; de Juego</td>
    	<td>'.round($mt_cancha,2).'</td>
    	</tr>';

    }
    if((!empty($c_marcacion))){
    	echo'<tr>
           <td>marcacion</td>
           <td>'.$c_marcacion.'</td>
    	</tr>';
    }
  echo'</tbody>
    </table>

    </div>';
    }
}
}




?>
</div>
</body>
</html>