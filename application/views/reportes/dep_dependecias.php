<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>dependencia</title>
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
.det_dep{border-bottom: 1px double #000;
    padding-bottom: 8px;
    padding-top: 8px;
    border-left: 1px double #000;
    border-right: 1px solid #000;}
 .titulo_list{    width: 598px;
    background: #cccccc;
    -webkit-background: #cccccc;
    border-left: 1px solid #000;
    border-right: 1px solid #000;
     text-align: center;}   
    .tipo{    border: 1px #000;
    border-style: dashed;
    width:598px;
    padding: 6px 0px;
    /* text-align: center; */
    text-transform: uppercase;
    background: #f7f7f7;}

    .nom_caract{    text-transform: uppercase;}
    .dep{font-weight: 600;}

    .tbl_mant{border:1px solid #000;border-collapse: collapse;}
    table.tbl_mant thead th{border-bottom: 1px solid #000; text-transform: uppercase;}
    table.tbl_mant tbody td{border-bottom: 1px solid #ccc;}



    .
</style>
<body>
<?php
$dependencia= $this -> model_dependencias -> det_dep($id);
foreach ($dependencia as $d) {
	$nombre = $d->dep_nombre;
	$id_sub_sector = $d->sub_sector;
	$sector = $d->sector;
	$ancho = $d->ancho;
	$largo = $d->largo;
	$alto = $d->alto;
	$observaciones = $d->observaciones;
	$nombre_sub_sector= $d->nombre;
	$estado = $d->estado;

	if((!empty($ancho))&&(!empty($largo))){
    		$mt = $ancho*$largo;
    	}
}

 ?>
<table>
		
   <tbody><tr style="border:none;">
              <th style="text-align:left;" colspan="6">STADIO ITALAINO DI CONCEPCIÓN<br>
                Impreso el <?php setlocale(LC_ALL, 'es_ES').': '; 
                $hoy = date("Y-m-d H:i:s"); 
                 echo ' '.iconv('ISO-8859-1', 'UTF-8', strftime('%A %e/%b/%g - %H:%I',  strtotime("".$hoy.""))).''; ?></th></tr>
                
	</tbody></table>
<div id="contenedor">
<table  width="600" style="text-align: center;"><tr><td><h1>FICHA TÉCNICA DEPENDENCIA</h1></td></tr></table>
<table width="600" class="detalle">
  <thead>
    <tr>
      <th>código</th>
      <th colspan="4">dependencia</th>
    </tr>
    <tr>
      <th class="nom_sub"><?php echo $id; ?></th>
      <th colspan="4" class="nom_sub">
      	<h2><?php echo $nombre; ?></h2>
      </th>
    </tr>
    <tr>
      <th>sector</th>
      <th>subsector</th>
      <th>
      estado</th>
      <th>medidas<br>
        <span style="font-size: 10px;">(anchoxlargoxalto)</span>        <br>
        </th>
      <th>mt2</th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <td><?php echo $sector; ?></td>
      <td><?php echo $nombre_sub_sector; ?></td>
      <td><?php echo $estado; ?></td>
      <td><?php
        if((!empty($ancho))&&(!empty($largo))){
    	   echo''.$ancho.' x '.$largo.'';
        }

       ?></td>
      <td><?php if(!empty($mt)){echo round($mt,2);} ?></td>
    </tr>
  </tbody>
</table>
<div class="titulo_list">CARACTERISTICAS</div>
<div><table width="600" border="0" class="det_dep">
      <tbody>

      	<?php
$caracteristicas= $this -> model_dependencias -> caracteristicas_dep($id);

foreach ($caracteristicas as $c) {
	echo '
    <tr>
      <td width="109" class="nom_caract">'.$c -> c_nombre.'</td>
      <td width="481" class="nom_dep">: '.$c -> detalle.'</td>
    </tr>';
}
    
      	 ?>
    
    </tbody>
    </table>

    
   </div>
   <div class="titulo_list">CARACTERISTICAS DEPORTIVAS</div>
   <table class="tbl_mant" width="600">
    <tr><td style="text-align: center;">************* Descripción deportiva *************</td></tr>
   </table>
   <div class="titulo_list">RESTRICCIONES TECNICAS</div>
   <table class="tbl_mant" width="600">
                <thead>
                 <tr>
                 <th scope="col">Categoria</th>
                  <th scope="col">Tipo Trabajo</th>
                  <th scope="col">Temp. Baja</th>
                  <th scope="col">Temp. Alta</th>
                  <th scope="col">Ultima vez <br> realizado</th>
                  <th scope="col">días transc</th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                    $pl_mant_subcat= $this -> model_dependencias -> sub_pl_temp($id);
                    echo'';
               
                    foreach ($pl_mant_subcat as $pl_sb) {
                      $id_sub = $pl_sb -> pl_subcategoria;
                      echo'<tr>
                      <td>'.$pl_sb -> ctg_nombre .'</td>
                      <td> '.$pl_sb-> sctg_nombre.'</td>';
                      //TEMPORADA BAJA
                      $plmant1= $this -> model_dependencias -> pl_temp($id,$id_sub,1);
                          if(!empty($plmant1)){
                          foreach ($plmant1 as $uno) {
                            echo'<td>'.$uno -> pl_cantidad.' '.$uno -> abreviatura.'</td>';
                          }
                          }else{echo "<td>-</td>";}
                      $plmant2= $this -> model_dependencias -> pl_temp($id,$id_sub,2);
                      if(!empty($plmant2)){                         
                          foreach ($plmant2 as $dos) {
                            echo'<td>'.$dos -> pl_cantidad.' '.$dos -> abreviatura.'</td>';
                          }
                      }else{echo "<td>-</td>";}
                      // dias transcurridos
                      $dias_trans=$dias_transcurridos= $this -> model_dependencias -> dias_transcurridos($id_sub,$id);
                      //mes actual
                        $mes=date("m");
                        
                        $periocidad_temp="";                    
                      if(!empty($dias_trans)){
                        //TEMPORADA ACTUAL
                        if($mes > 3 and $mes < 11  ){
                          /*BAJA*/$temporada=1;
                           $periocidad_temp=$uno -> pl_periocidad;
                        }else{ 
                          /*ALTA*/ $temporada=2;
                          $periocidad_temp=$dos -> pl_periocidad;
                        }                     

                        foreach ($dias_trans as $dtrans) {
                          $x=$dtrans -> transcurrido;
                          $txt_periocidad ="";
                          $ndias_trans=$dtrans -> transcurrido;
                        switch ($periocidad_temp) {
                          case '4': //semanal
                            $ndias_trans = $ndias_trans/7;
                            if($ndias_trans>1){$txt_periocidad="semanas";}else{$txt_periocidad="semana";}
                            break;
                          case '2';//mensual
                              $ndias_trans = $ndias_trans/30;
                              if($ndias_trans>1){$txt_periocidad="meses";}else{$txt_periocidad="mes";}

                            break;
                          case '1';//anual
                              $ndias_trans = $ndias_trans/365;
                              if($ndias_trans>1){$txt_periocidad="años";}else{$txt_periocidad="año";}
                            break;
                          default:
                          if($ndias_trans>1){$txt_periocidad="dias";}else{$txt_periocidad="día";}
                          break;
                        }    
                                                          
                          echo'<td>'.iconv('ISO-8859-1', 'UTF-8', strftime('%d/%b/%Y',  strtotime("". $dtrans -> tb_fecha.""))).'</td><td>'.round($ndias_trans).' '.$txt_periocidad.' </td>';                        
                          }
                      }else{echo "<td>-</td><td>-</td>";}

                   




                       echo' 
                       
                        </tr>';
                    }
                    ?>
                </tbody>
    </table>
    <div class="titulo_list">ÚLTIMAS 10 MANTENCIONES REALIZADOS</div>
    <table class="tbl_mant" width="600">
      <thead>
        <tr>
      <th>fecha</th>
      <th>duracion</th>
      <th>sub-categoria</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $trabajos= $this -> model_dependencias -> trabajos_dep($id);
       
        foreach ($trabajos as $t) {
           $responsable="";

           if($t -> tb_tipo_responsable <> 1 ){
                   /* $funcionario=$this->model_dependencias->funcionarios_tb($t-> tb_id);
                    foreach ($funcionario as $f) {
                      echo ' '.$f -> nombre_fun.' '.$f -> paterno.'<br>';
                    }*/
               $responsable = $t -> tb_responsable.':';}
         
           /*$planificado = $t -> tb_planificado;
        if($planificado == 0){ $pl ="PL";}else{$pl="N-PL";}*/
          echo'<tr>
               <td>'.iconv('ISO-8859-1', 'UTF-8', strftime('%d/%b/%Y',  strtotime("". $t -> tb_fecha.""))).'</td>
                <td style="text-align:center;">'.($t -> dif + 1).' d</td>
               
               <td style="padding-left:5px;">'.strtoupper ($t -> sctg_nombre).'<br>'.$responsable.''.$t -> tb_descripcion.'</td>
              
              
              </tr>';
         }
         ?>
    
    
      </tbody>
    </table>
     <div class="titulo_list">ÚLTIMAS 10 ACTIVIDADES REALIZADAS</div>
     <table class="tbl_mant" width="600">
      <thead>
        <tr>
      <th>fecha</th>
      <th>duracion</th>
      <th>actividad</th>
      <th>responsable</th>
      
      <th>nº personas</th>
        </tr>
      </thead>
      <tbody>
        <?php 
         $actividades=$this->model_dependencias->actividades_dep($id);
         //echo $this -> db -> last_query();

         foreach ($actividades as $a) {
           echo'<tr>
              <td>'.iconv('ISO-8859-1', 'UTF-8', strftime('%d/%b/%Y',  strtotime("". $a -> act_fecha.""))).'</td>
              <td style="text-align:center;">'.($a -> dif + 1).' d</td>
              <td>'.$a -> sctg_nombre.'</td>
              <td>'.$a -> act_responsable.'</td>
              <td style="text-align:center;">'.$a -> prsns.'</td>
           </tr>';
         }

        ?>
      </tbody>
    </table>
<?php //var_dump($actividades);?>
</div>	
</body>
</html>