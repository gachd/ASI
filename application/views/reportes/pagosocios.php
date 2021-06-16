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



  <div class="main">
  	 <div class="panel-title">
                 <table width="100%" border="0">
          <tbody>
            <tr>
              <td width="15%" rowspan="2" align="left" style="padding-bottom:15px;"><img src="<?php echo base_url(); ?>/assets/images/logo_instituciones_mini.png" width="130" style="margin-right:25px;"/></td>
              <td colspan="2"><h2>INFORME DE PAGOS</h2></td> 
              <td></td>             
            </tr>
            <tr><td></td><td></td><td></td></tr>
            
          </tbody>
        </table>
              </div>

  	<div class="page-content">  		
  	 <div class="row well">
  	 	
  	 		<div class="content-box-large">  	 			
          <div class="col-md-4">
            <table width="100%" style="border:solid 1px black; margin-bottom: 30px;padding: 5px;">
              
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
      <div class="row" id="mostrarSocios">
      <div class="col-md-12">          
              
               <div class="table-responsive">

                  <table border="1" width="100%" id="pagos" class="table table-bordered table-hover" style="margin-bottom: 20px;">
                  <caption style="font-size: 12px;" ><strong>DETALLE</strong></caption>
                  <thead>

                  <tr>

                    <td style="width: 10%;">Año</td>

                    <td style="width: 10%;">Semestre</td>
                    <td style="width: 10%;">Valor Cuota</td>

                    <td style="width: 10%;">Total Pagado</td>

                    <td>Observación</td>

                    <td style="width: 10%;">Estado</td>
                                 

                  </tr>

                  </thead>

                  <tbody>

                     <?php
                     $saldo_total = 0;
                     $total = 0;
                     foreach ($cuotas as $ct) {

                             $ano = $ct-> ano;

                             $sem = $ct-> semestre;

                             $pagado = $ct-> total_pagado;

                             $obser = $ct-> observ_cuota;

                             $estado = $ct-> estado;

                             $id_cuota = $ct -> cuota_ordinaria_id_cuota;

                             $pag = number_format($pagado, 0, ",", ".");

                             $saldo =$ct-> saldo;

                             $saldo_total = $saldo_total + $saldo;

                             $total = $total + $pagado;

                             $valor = $ct -> valor;

                             if($estado == 1){

                              $es = 'Pagada';

                            }else{

                                $es = 'Impaga';

                              }

                                echo'<tr>

                                    <td>'.$ano.'</td>

                                    <td>'.$sem.'</td>
                                    <td>'.'$'.$valor.'</td>

                                    <td>'.'$'.$pag.'</td>

                                    <td>'.$obser.'</td>

                                    <td>'.$es.'</td>';

             



                                 echo'</tr>';

                              }



                              

                             

                           

                        ?>

                      

                   </tbody>

                </table>



         <span style="font-size: 20px;"> Total Pagado Cuotas: <?php $total_pag = number_format($total, 0, ",", ".");  echo '$'.$total_pag; ?></span>

         <br>

         <span style="font-size: 20px;"> Deuda Total Cuotas: <?php $total_sal = number_format($saldo_total, 0, ",", ".");  echo '$'.$total_sal; ?></span>



<!-- Modal -->


        


</div>



</div>
<span><?php echo 'Registro de pagos al '.$hooy; ?></span>
     </div>
 </div>
 </div>
 <link href="<?php echo base_url(); ?>/assets/vendors/datatables/dataTables.bootstrap.css" rel="stylesheet" media="screen">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url(); ?>/assets/bootstrap/js/bootstrap.min.js"></script>

    <script src="<?php echo base_url(); ?>/assets/vendors/datatables/js/jquery.dataTables.min.js"></script>

    <script src="<?php echo base_url(); ?>/assets/vendors/datatables/dataTables.bootstrap.js"></script>

    <script src="<?php echo base_url(); ?>/assets/js/custom.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/tables.js"></script>
    <!-- Latest compiled and minified CSS -->



</body>
<script type="text/javascript">
	$( "#inicio" ).click(function() {
		window.location.href = "<?php echo base_url(); ?>socios/socios";
	});
selPersona = function(id,ano,sem,rut){

  // $('#ano').val(ano);



     rut=rut;

    sem= sem;

    ano=ano;

        

       $.post("<?php  echo base_url()?>socios/Pago_cuota/detalle_cuotas", {        

         sem: sem,

         ano: ano,

         rut: rut}, function(data){          

            $("#modal_cuotas").html(data);

});

};
</script>
</html>