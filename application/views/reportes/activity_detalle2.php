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
                  $req = $i -> act_req;
                  $fono = $i -> act_fono;
                  $organiza = $i -> act_organizacion;
                  $operacion = strtotime($termino) - strtotime($inicio);
                  $dif_dias = (($operacion/(60*60*24))+1);
                  if($dif_dias > 1){$dias='días';}else{$dias='día';}
                  if(empty($fono)){$fono="No Registrado";}
                  if($i -> act_externo  == 1) {$txt_externo ="INTERNO";}else{$txt_externo="EXTERNO";}
}
 ?>


<html>
<head>
<meta charset="utf-8">
<title><?php echo $subcategoria ?></title>
</head>
<style>
 body{text-transform: uppercase;}
  #contenedor{
  
 
  width:800px;
  height: 600px;}

  .turno{
     text-align:center;
    width: 30%;
   float: right;
    background: #e6e6e6;
    height: 90%
    margin-top:5%;
  }
 .act{
   text-align:left;
    width: 70%;
   float: left;
    background: #e6e6e6;
    height: 90%;
    margin-top:5%;
 } 
 .detalle_titulo{
    padding: 5px;
    color: white;
    font-size: 20px;
    text-transform: uppercase;}
span.categoria{      font-size: 8px;
    color: #fff;
    letter-spacing: 2px;
    padding: 3px;
    text-transform: uppercase;}
    p.text_subcategoria{margin-top:2px;}
    i.text_segmentacion{font-size: 9px;}
 .dia{font-size: 14px;}
 .mes{font-size: 14px;}   
 .num_dia{    font-size: 37px;
    line-height: 0.8;
    font-weight: 700;} 
.det_fecha{background: #777777;
    color: white;
    padding: 4px;
    margin-top: 3px;
    font-size: 13px;}
.det_hora{padding-top: 15px;
    font-size: 20px;
    font-weight: 600}
.det_duracion{  

  background: #cac5c5;
    margin-top: 15px;
    padding: 5px;}
.num_duracion{    background: white;
    text-align: center;
    padding: 0px;
    font-weight: 600;}
.dia_duracion{    color: white;
    text-align: center;
    padding: 3px 0px;}
.fecha_duracion{    font-size: 11px;
    margin-top: 15px;
    padding: 0px 0px 0px 4px;}   
.responsable{    
    text-transform: uppercase;
    font-family: monospace;
    font-size: 11px;}
     .nombre_actividad {
    font-size: 15px;
    font-style: oblique;
    text-transform: uppercase;
}
.cont-card{padding:5px;}
.card{padding: 6px;
    background: white;
    min-height: 50px;
    margin-top: 5px;
      overflow: auto;
     font-size: 0.80rem;}
.dias_dur{
    padding: 2px;
    background: white;
    min-height: 50px;
    margin-top: 3px;
      overflow: auto;
     font-size: 0.80rem;
     text-align: center;
     margin-left:10px; }

.card h1{margin-top: 1px;
    margin-bottom: 8px;
    color: #333;
    margin: 0 0 12px;
    line-height: 1.75rem;
    font-weight: 700;
    font-size: 0.90rem;}

.fecha_seleccionada{color:#000; text-transform:uppercase; text-align: center;}
ul.fullstats li {
    width: 30%;
    float: left;
    text-align: center;
    font-size: 10px;
    line-height: 10px;
    color: #999;
    border-left: 1px solid #e8e8e8;
    
}

ul.fullstats li:last-child { 
 border-right:  1px solid #e8e8e8;
 height: 80%;
}

ul.fullstats li span {
    display: block;
    font-size: 16px;
    line-height: 18px;
    color: #333;
}

#table_actividades{    
    border: solid #ccc 1px;
    font-size: 10px;
    text-transform: uppercase;
    text-align: center;
  }

table#table_actividades th{
   text-align: center;

}

table.recepcion {
  width: 100%;

}
table.recepcion td{
  width: 50%;
}



  .nombre_actividad {
    font-size: 15px;
    font-style: oblique;
    text-transform: uppercase;
}
.turnos h1{margin-top: 2px;
    margin-bottom: 10px;
    color: #333;
    margin: 0 0 15px;
    line-height: 1.75rem;
    font-weight: 700;
    font-size: 1.00rem;
    text-align: center;}
.tablaturnos {
 border: 1px solid black;
    font-size: 12px;
    text-transform: uppercase;
    text-align: center;
    width: 100%;
}
.tablaturnos th,tr{
     border: 1px solid black;
    text-align: center;
    text-transform:uppercase;
}
.tablaturnos td{
     border: 1px solid black;
    text-align: center;
    text-transform:uppercase;
}
.titulo span{
  font-size: 12px;
}



</style>
<body>  
             
<div id="contenedor" >  <!--inicio div contenedor-->
       <div class="row justify-content-md-center" style="margin-bottom: 2%;">
         <div class="col-md-2" style="float: left; width: 20%">
            <img style="width: 120px;" src=" <?php '.base_url().'?>/assets/images/logo-stadio.jpg" alt="Instituciones Italianas">
         </div>
       <div class="titulo" style="float: left; width: 70%;text-align: center">
      <h3><center>Ficha de control de actividades</center></h3>
     <span>Unidad de Control de Gestión  Instituciones Italianas Di Concepcion</span><br>
      <span>Camino a Coronel km 13,5 Concepción</span>
    </div>
  </div>
   
    <div class="turnos" style="float: right; width: 33%; background: #e6e6e6;height: 580px;"><!--inicio div turno-->
       <h1>TURNOS</h1>
      <H1>PERSONAL STADIO </H1>
      <?php 
    $fecha_act = $this -> model_actividades -> fecha_act($id);
  
    foreach ($fecha_act as $f) {
      $fecha_selec = $f -> fecha;
    
    }
      echo'<table class="tablaturnos">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Funcionario</th>
      <th scope="col">Turno</th>
    </tr>
  </thead>
  <tbody>';
   $i=0;
    $personal_stadio = $this -> model_actividades -> turno_personal_stadio($fecha_selec);
   foreach ($personal_stadio as $ps) {
    $turno = $ps -> turno;
      if (( $turno <> 4) && ( $turno <> 5) && ( $turno <> 14) && ( $turno <> 16)){
    $i++;
     echo'
    <tr>
      <td>'.$i.'</td>
      <td>'.substr($ps->nombre_fun,0,1).'. '.$ps->paterno.'<br></td>
      <td>'.$ps -> nom_turno.' </td>
     
    </tr>
    ';
  }
   }
 
    echo'
  </tbody>
</table>';

       ?>
<h1>GUARDIAS</h1>
     <?php
      
     echo'<table class="tablaturnos">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Funcionario</th>
      <th scope="col">Turno</th>
    </tr>
  </thead>
  <tbody>';
 
   $i=0;
    

   $guardias = $this -> model_actividades -> turno_guardias($fecha_selec);
  
    foreach ($guardias as $g) {
      $turno = $g -> turno;
      if (( $turno <> 13) && ( $turno <> 15) && ( $turno <> 17)){
        $i++;
        echo'
        <tr>
        <td>'.$i.'</td>
        <td>'.substr($g->nombre_fun,0,1).'. '.$g->paterno.'<br></td>
        <td>'.$g -> nom_turno.' </td>
        </tr>';
      }
    }
 
    echo'
  </tbody>
</table>';
?>
    </div><!--fin div turno-->

    <div  style="float: left; width: 66%;background: #e6e6e6;height: 580px;"><!--inivio div actividades-->
         <?php  echo'<div class="detalle_titulo" style="background: '.$color.';overflow: hidden;" >

            <div class="col-md-7">
                     <span class="categoria" style="color: white;">'.$categoria.'<br></span> '.$subcategoria.'<br><span 
                     class="nombre_actividad">'.$nombre.'</span></div>';                 


            $seg_act= $this -> model_actividades -> segmentacion_act($id);  
                if(!empty($seg_act)){
                   echo'<div class="col-md-5">segmentacion:
                   <ul>';
                   foreach ($seg_act as $sa) {echo'<i class="text_segmentacion">'.$sa -> segmentacion .'</i> ';}
                    echo'</ul></div>';
                }                      
            echo'
          </div>'; 

     echo'    <div class="col-md-12" style="background: #EFEEEE;">
          <div class="fecha_seleccionada" style="padding-top: 8px;float: left; width: 20%;">';
         

          $date_sel= $this -> model_actividades -> horario_act($id,$fecha_sel);
                        //echo $this-> db -> last_query().'<br>';
                   

                    foreach ($date_sel as $ds) {

                    if(!empty($ds -> fecha)){
                      $a = ''.iconv('ISO-8859-1', 'UTF-8', strftime('%a',  strtotime($ds->fecha))).'';
                      $d = ''.iconv('ISO-8859-1', 'UTF-8', strftime('%d',  strtotime($ds->fecha))).'';
                      $b = ''.iconv('ISO-8859-1', 'UTF-8', strftime('%b',  strtotime($ds->fecha))).'';
                      $y = ''.iconv('ISO-8859-1', 'UTF-8', strftime('%Y',  strtotime($ds->fecha))).'';

                      $hora_inicio = ''.iconv('ISO-8859-1', 'UTF-8', strftime('%H:%M',  strtotime($ds->inicio))).'';
                      $hora_termino = ''.iconv('ISO-8859-1', 'UTF-8', strftime('%H:%M',  strtotime($ds->termino))).'';
                    }else{

                      $a = ''.iconv('ISO-8859-1', 'UTF-8', strftime('%a',  strtotime($inicio))).'';
                      $d = ''.iconv('ISO-8859-1', 'UTF-8', strftime('%d',  strtotime($inicio))).'';
                      $b = ''.iconv('ISO-8859-1', 'UTF-8', strftime('%b',  strtotime($inicio))).'';
                      $y = ''.iconv('ISO-8859-1', 'UTF-8', strftime('%Y',  strtotime($inicio))).'';

                      $hora_inicio = ''.iconv('ISO-8859-1', 'UTF-8', strftime('%H:%M',  strtotime($act_inicio))).'';
                      $hora_termino = ''.iconv('ISO-8859-1', 'UTF-8', strftime('%H:%M',  strtotime($act_termino))).'';
                    }





                      
                    }


                  
                   
          echo'
            <div class="row dia">'.$a.'</div>
            <div class="row num_dia">'.$d.'</div>
            <div class="row mes">'.$b.' '.$y.'</div>
           </div>
          <div class="det_hora" style="float: left; width: 20%;">
              <div clas="row">'.$hora_inicio.' <br> '.$hora_termino.' </div>
          </div>
          <div class="det_duracion" style="float: left; width: 20%;">
          <div class="row" >
               <div class="col-md-12">
                 <div class="num_duracion" style="float: left; ">
                   '.$dif_dias.'
                  </div>
               </div>
               <div class="dia_duracion" style="float: left;">'.$dias.'</div>
          </div> 
        </div>
        <div style="width:25%;float: left;">          
          <div class="dias_dur" >'; 

           if ($dif_dias > 1){
            echo ''.iconv('ISO-8859-1', 'UTF-8', strftime('%a %d/%b/%y',  strtotime($inicio))).' <br>AL<br>'.iconv('ISO-8859-1', 'UTF-8', strftime('%a %d/%b/%y',  strtotime($termino))).'';
          }

          echo'
          </div>   
          </div>      
          </div>
         
  <div class="cont-card" style="float: left; width: 34%;height:8%;">
              <div class="card" >
                <h1>Dependencias</h1>
              <ul>';
                $dep= $this -> model_actividades -> getDepen($id);
                      foreach($dep as $d ){
                                          echo '<li style="font-size:10px;"><span>'.$d -> dep_nombre.'</li></span>';
                      }
              echo'</ul>
            </div>
            </div>
            <div class="cont-card" style="float: right; width: 60%;">
            <div class="card ">
              <h1>Personas</h1>
              <ul class="fullstats">
                <li> <span>'.$socios.'</span>Socios </li>
                <li> <span>'.$externos.'</span>Externos </li>
                <li> <span>'.$total_prsns.'</span>Total </li>
              </ul>
            </div>
            </div>

            <div class="cont-card" style="clear: both;">
              <div class="card">
              <div class="col-md-12">
                <h1>Organiza: ';
                if($organiza == "Tercero") {echo $empresa;}else{echo $organiza;}
                echo'</h1>
              </div>
              <div class="col-md-12">
              <h1>Responsable</h1>
              <div class="responsable"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> '.$responsable.'</div>
              <div class="responsable" style="letter-spacing: 2px;"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>'.$fono.'</div>
              <div class="responsable" style="letter-spacing: 2px;"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>'.$correo.'</div>
              </div>
              </div>
            </div>';

            
            if (!empty($observaciones)){
            echo'<div class="col-md-12 cont-card">
            <div class="card ">
            <h1>Observaciones</h1>
               <div>'.$observaciones.'</div>
            </div>
            </div>';
            }

            if (!empty($req)){
            echo'<div class="col-md-12 cont-card">
            <div class="card ">
            <h1>Requerimientos</h1>
               <div>'.$req.'</div>
            </div>
            </div>';
            }



           
        

    //var_dump($actividades);

   

?>
    </div><!--fin div actividades-->

<div style="clear: both; background: #e6e6e6; height: 260px;margin-top: 1%; "><!--inivio div observaciones-->
     <div class="cont-card" >
            <div class="card" style="height: 11%">
            <h1>Observaciones:</h1>         
               
    </div> </div>
    <div class="cont-card" >            
            <div class="card" style="height: 7%">
            <h1>Recepciona Instalaciones:</h1>
            <table class="recepcion">
              <tr>
                 <td>Nombre:</td>
                 <td>Fecha:</td>
              </tr>
              <tr>
                 <td>Firma:</td>
                 <td>Hora:</td>
              </tr>
            </table>
           
    </div>
</div>

</div><!--fin div observaciones-->

    





        </div>  <!--fin div contenedor-->
   

</body>
</html>
