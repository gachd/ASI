<!doctype html>
<?php
setlocale(LC_ALL, 'es_ES').': ';
    $actividades = $this -> model_actividades -> actividad_id($id);
foreach($actividades as $i){
                  $nombre = $i -> act_nombre ; 
                  $correo = $i -> act_correo ; 
                  $inicio = $i -> act_fecha ; 
                  $termino = $i -> act_fecha_termino ; 
                  $act_inicio = $i -> act_inicio;
                  $act_termino = $i -> act_termino;
                  $socios = $i -> act_nsocios;
                  $externos = $i -> act_nprsns;
                  $total_prsns= $socios + $externos;
                  $categoria = $i -> ctg_nombre;
                  $subcategoria = $i -> sctg_nombre;
                  $id = $i -> act_id;
                  $color = $i -> ctg_color;
                  $responsable = $i -> act_responsable;
                  $empresa = $i -> act_empresa;
                  $observaciones = $i ->  act_evento;
                  $fono = $i -> act_fono;
                  $organiza = $i -> act_organizacion;
                  $operacion = strtotime($termino) - strtotime($inicio);
                  $dif_dias = (($operacion/(60*60*24))+1);
                  if($dif_dias > 1){$dias='días';}else{$dias='día';}
                  if(empty($fono)){$fono="No Registrado";}
                  if($i -> act_externo  == 1) {$txt_externo ="INTERNO";}else{$txt_externo="EXTERNo";}
}
 ?>


<html>
<head>
<meta charset="utf-8">
<title><?php echo $subcategoria ?></title>
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
 
  table{border: 1px solid #000; border-collapse: collapse;}
  thead {
    background: #e6e6e6;
    letter-spacing: 3px;
  }
  th{padding: 5px;
    border-bottom: 2px solid #000;}
  table.calendar td  {
    border-bottom: 1px solid #ccc;
    padding: 3px;
  }
  
  .subcategoria{    font-size: 23px;
    text-transform: uppercase;}
 .titulo_list{ 
    background: #cccccc;
    -webkit-background: #cccccc;
  
     text-align: center;}   

</style>
<body>
<table  style="border:none;">
    
   <tbody><tr style="border:none;">
              <th style="text-align:left;" colspan="6">STADIO ITALAINO DI CONCEPCIÓN<br>
                Impreso el <?php setlocale(LC_ALL, 'es_ES').': '; 
                $hoy = date("Y-m-d H:i:s"); 
                 echo ' '.iconv('ISO-8859-1', 'UTF-8', strftime('%A %e/%b/%g - %H:%I',  strtotime("".$hoy.""))).''; ?></th></tr>
                
  </tbody></table>
<div id="contenedor">
<h1 style="text-align: center;">DESCRIPCIÓN ACTIVIDAD</h1>
<table width="600" >
  <tbody>
    <?php 
        if($inicio <> $termino){ 
        /*********** MAS DE  DÍA **************/
        $num=2;
            $horario_act = $this -> model_actividades -> maxmin_horario_act($id);
            foreach($horario_act as $ha){
              $fecha_min = $ha -> inicio;
              $hora_min = $ha -> hinicio;
              $fecha_max = $ha -> termino;
              $hora_max = $ha -> htermino;
            }
        $print_fecha='<td width="44">Desde </td>
      <td width="172">: '.iconv('ISO-8859-1', 'UTF-8', strftime('%a %d/%b/%y',  strtotime($fecha_min))).' '.date("H:i",strtotime($hora_min)).' hr.</td>
    </tr>
    <tr>
      <td>Hasta</td>
      <td>: '.iconv('ISO-8859-1', 'UTF-8', strftime('%a %d/%b/%y',  strtotime($fecha_max))).' '.date("H:i",strtotime($hora_max)).' hr.</td>
    </tr>';
        }else{
          /********* un dia ********/
          $num=3;
          $print_fecha=' <td>Fecha</td>
         <td>: '.iconv('ISO-8859-1', 'UTF-8', strftime('%a %d/%b/%y',  strtotime($inicio))).' </td>
      </tr>
      <tr>
    
      <td width="44">Desde </td>
      <td width="172">: '.date("H:i",strtotime($act_inicio)).' hr.</td>
    </tr>
    <tr>
      <td>Hasta</td>
      <td>: '.date("H:i",strtotime($act_termino)).' hr.</td>
    </tr>';}
    ?>
    <tr>
      <td width="370" rowspan="<?php echo $num; ?>"><?php echo $categoria?><br>
       <span class="subcategoria"><?php echo $subcategoria?></span><br>
       <span ><?php echo $nombre?></span>
     </td>
     <!--  -->
       <?php echo $print_fecha; ?>
  </tbody>
</table>
<table width="600" >
  <thead>
    <tr>
      <th colspan="2" class="titulo_list" style="border-right: 2px solid #fff;">DEPENDENCIA</th>
      <th colspan="2" class="titulo_list">PERSONAS</th>
    </tr>
   </thead>
    <tbody>
    <tr>
      <td colspan="2" rowspan="3"><ul>
        <?php
         $dep= $this -> model_actividades -> getDepen($id);
                      foreach($dep as $d ){
                                          echo '<li>'.$d -> dep_nombre.'</li>';
                      }

         ?>
      </ul></td>
      <td width="16%">&nbsp;&nbsp;SOCIOS</td>
      <td width="34%">: <?php echo $socios?></td>
    </tr>
    <tr>
      <td>&nbsp;&nbsp;EXTERNOS</td>
      <td>: <?php echo $externos?></td>
    </tr>
    <tr>
      <td>&nbsp;&nbsp;TOTAL</td>
      <td>: <?php echo $total_prsns?></td>
    </tr>
  </tbody>
</table>
<table width="600" >
  <thead>
    <tr>
      <th colspan="2" class="titulo_list">RESPONSABLE</th>
    </tr>
   </thead>
   <tbody>
    <tr>
      <td width="93">INSTITUCIÓN</td>
      <td width="497">: <?php  if($organiza == "Tercero") {echo $empresa;}else{echo $organiza;} ?></td>
    </tr>
    <tr>
      <td>CONTACTO</td>
      <td>: <?php echo $responsable?></td>
    </tr>
    <tr>
      <td>TELEFONO</td>
      <td>: <?php echo $fono ?></td>
    </tr>
    <tr>
      <td>CORREO</td>
      <td>: <?php echo $correo ?></td>
    </tr>
  </tbody>
</table>

<table width="600"  class="calendar">
  <thead>
    <tr>
      <th colspan="4" class="titulo_list">CALENDARIZACION</th>
     </tr>
     </thead>
   <tbody>
    <tr>
      <td width="150" style="text-align: center">FECHA</td>
      <td width="78" style="text-align: center">INICIO</td>
      <td width="78" style="text-align: center">TERMINO</td>
      <td style="text-align: center" >DETALLE</td>
    </tr>
    <?php
    $calendarizacion = $this -> model_actividades -> calendarizacion($id);
    if(!empty($calendarizacion)){
        foreach ($calendarizacion as $c) {
                  $fecha = $c -> fecha;
                  $inicio = $c -> hr_inicio;
                  $termino = $c -> hr_termino;
                  $descripcion = $c -> descripcion;
                  setlocale(LC_ALL, 'es_ES').': ';
      echo'
      <tr>
      <td>'.iconv('ISO-8859-1', 'UTF-8', strftime('%A %d/%b/%y',  strtotime("".$fecha.""))).'</td>
      <td style="text-align: center">'.date("H:i",strtotime($inicio)).'</td>
      <td style="text-align: center">'.date("H:i",strtotime($termino)).'</td>
      <td>'.$descripcion.'</td>
    </tr>';
    }
  }else{echo "<tr><td colspan=4>No Registra</td></tr>";}

?>
    
  </tbody>
</table>

<?php if(!empty($observaciones)){
  echo'<table width="600" border="0" style="border:none !important; margin-top: 25px;">
  <tbody>
    <tr>
      <td width="109">Observaciones</td>
      <td width="481">: '.$observaciones.'</td>
    </tr>
  </tbody>
</table>';
}
?>


</div>
</body>
</html>
