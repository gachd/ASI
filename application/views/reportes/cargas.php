<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="UTF-8">

  <title>Document</title>


</head>
<style>
.ico.badge.badge-success{
  background-color: #08c222;
}
.ico.badge.badge-danger{
background-color: #ff0000;
}
body {
  font-size: 12px;
}
#rut{
  font-size: 14px;
}
#nombre{
  font-size: 14px;
}
tbody td {
  text-align: center;
}
thead td {
  text-align: center;
  font-weight: bold;
}
thead td .titulo { 
font-weight:  bold;
 }


</style>
 <?php

  function getPuntosRut( $rut ){

  $rutTmp = explode( "-", $rut );

  return number_format( $rutTmp[0], 0, "", ".") . '-' . $rutTmp[1];

  }

   setlocale(LC_ALL, 'es_ES').': ';

  foreach ($datos_personales as $dp) {


     $rut = $dp-> prsn_rut;
     $nombre = $dp -> prsn_nombres ;

     $ap_paterno = $dp -> prsn_apellidopaterno ;

     $ap_materno = $dp -> prsn_apellidomaterno ;

     $fecha_nacimiento = $dp -> prsn_fechanacimi;

     $email = $dp -> prsn_email;

     $telefono = $dp -> prsn_fono_casa;

     $celular = $dp -> prsn_fono_movil;

     $fono_job = $dp -> prsn_fono_trabajo;

     $profesion = $dp -> prsn_profesion;

     $direccion_job = $dp -> prsn_direccion_empresa;

     $empresa_job = $dp -> prsn_empresa;

     $sexo = $dp -> prsn_sexo;

     $descendiente = $dp -> prsn_descendiente;

     $direccion = $dp -> prsn_direccion;

     $poblacion = $dp -> prsn_sectorvive;

     $comuna = $dp -> comuna_nombre;

     $provincia = $dp -> provincia_nombre;

     $region = $dp -> region_nombre;

     $estado_civil = $dp -> estacivil_nombre;

     $nacionalidad = $dp -> nac_nombre;

     $dep = $dp -> int_deport;    

     $deportes = explode(",", $dep );


     if($sexo == 1) {$sexo_txt ="Masculino";}else{$sexo_txt ="Femenino";}

     if(!empty($direccion)){$direccion_txt= $direccion.', ';}

     if(!empty($poblacion)){$poblacion_txt= $poblacion.', ';}





  }
 setlocale(LC_ALL, 'es_ES').': '; 

$hoy = date("Y-m-d H:i:s");
$hooy = date("d-m-Y");


   ?>
<body>



  <div class="">
     <div class="panel-title">
                 <table width="100%" border="0" style="margin-bottom: 40px;">
          <tbody>
            <tr>
              <td width="15%" rowspan="2" align="left" style="padding-bottom:15px;"><img src="<?php echo base_url(); ?>/assets/images/logo_instituciones_mini.png" width="130" style="margin-right:25px;"/></td>
              <td colspan="2"><h2>INFORME DE CARGAS FAMILIARES</h2></td> 
              <td></td>             
            </tr>
            <tr><td></td><td></td><td></td></tr>
            
          </tbody>
        </table>
      </div>
      <div class="row well">
      
        <div class="content-box-large">         
          <div class="col-md-4">
            <table width="100%" style="border:solid 1px black; margin-bottom: 30px;padding: 5px;">
               <caption style="font-size: 12px;" ><strong>DATOS SOCIO</strong></caption>
              <tr>
                <td width="10%"><label class="titulo">NOMBRE:</label></td>
                <td width="40%"> <span class="label label-info" id="nombre"><?php echo $nombre.' '.$ap_paterno.' '.$ap_materno; ?></span>  </td>
                <td width="5%"><label class="titulo">RUT:</label></td>
                <td width="15%"> <span class="label label-info" id="rut"><?php echo getPuntosRut($rut) ?></span>   </td>
                <td width="20%"><label class="titulo">FECHA REGISTRO:</label></td>
                <td width="10%"><span class="label label-info" id="rut"><?php echo $fechaReg; ?></span> </td>
              </tr>
            </table> 
             <table border="1" style="margin-bottom: 30px;">
              <caption><strong>CORPORACIONES</strong></caption>
              <tr>
                <?php
                  foreach ($corp as $c) {
                    echo '<td>'.$c-> co_nombre.'</td>';
                  }
                 ?>
              </tr>
               <tr>
                <?php
                  foreach ($corp as $c) {
                    echo '<td>N° '.$c-> n_registro.'</td>';
                  }
                 ?>
              </tr>
            </table> 
          </div>
          
        </div>
      
     </div>
<div class="panel panel-default">

               

                <div class="panel-body">

              <table width="100%" id="cargas" border="1" class="table table-bordered table-hover">
                 <caption style="font-size: 12px;" ><strong>DETALLE</strong></caption>
                  <thead>
                  <tr>
                  
                    <td>PARENTESCO</td>
                    <td>RUT</td>
                    <td>NOMBRE</td>
                    <td>FECHA NACIMIENTO</td>
                    <td>EDAD</td>
                    <td>TELEFONO</td>
                    <td>MAIL</td>
                    <td>ESTUDIANTE</td>                   

                  </tr>

                  </thead>

                  <tbody>

                    <?php 

                    //var_dump($cargas);

                    function calculaedad($fechanacimiento){

                      list($ano,$mes,$dia) = explode("-",$fechanacimiento);

                      $ano_diferencia  = date("Y") - $ano;

                      $mes_diferencia = date("m") - $mes;

                      $dia_diferencia   = date("d") - $dia;

                      if ($dia_diferencia < 0 || $mes_diferencia < 0)

                        $ano_diferencia--;

                      return $ano_diferencia;

                    }

                  

                           foreach ($cargas as $c) {

                    $id_parentesco = $c -> s_parentesco_pt_id;

                    if(!empty($c -> prsn_fechanacimi)){
                    $edad = calculaedad ($c -> prsn_fechanacimi);
                   }else{
                    $edad = '-';
                   }

                    $bloqueo = $c-> estado_carga;

                    $class_bloq="";

                    $estado="";

                    if($bloqueo == 1 ) {$estado = "Bloqueado";}else{$estado= "Activo";}

                    if(($edad > 18) && ( $id_parentesco == 2) ){$class_bloq="bloqueado";}

                    if($c -> prsn_email == '0'){$email = '-';}else{$email=$c -> prsn_email;}

                    if($c -> prsn_fono_movil == 0){$celu = '-';}else{$celu=$c -> prsn_fono_movil;}

                    if($c -> prsn_fono_casa == 0){$fono = '-';}else{$fono=$c -> prsn_fono_casa;}

                    if($c -> estudiante == 1){$est = 'SI';}else{$est='NO';}

                    if($c -> certificado == 1){$cert = '';$img='<a target="_blank" href="'.base_url().'/uploads/'.$c -> prsn_rut.'.pdf"><img width="20px" src="'.base_url().'/assets/images/pdf-flat.png"></a>';}else{$cert='NO';$img='';}

                             echo'<tr class="'.$class_bloq.'">

                                   

                                    <td>'.$c -> pt_nombre.'</td>

                                    <td>'.$c -> prsn_rut.'</td>

                                    <td>'.$c -> prsn_nombres.' '.$c -> prsn_apellidopaterno.' '.$c -> prsn_apellidomaterno.'</td>

                                    <td>'.$c -> prsn_fechanacimi.'</td>

                                    <td>'.$edad.'</td>

                                    <td>'.$celu.' / '.$fono.'</td>

                                    <td>'.$email.'</td>

                                    <td>'.$est.'</td>
                                   
                                  </tr>';

                           }

                    ?>

                  

                 
                   </tbody>

                  </table>



                    

                </div>

              </div>
            </div>
</body>
</html>