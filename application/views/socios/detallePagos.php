<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="UTF-8">

  <title>Document</title>


</head>
<style>
.ico.badge.badge-success{
  background-color: #008928;
}
.ico.badge.badge-danger{
background-color: #e10000;
}
body {
	font-size: 12px;
}
.contenedor {
  height: 165px;
}
#pagos .btn{
  height: 23px;
  padding: 4px;
  padding-top: 0px;
}
.valores span{
  background: #008928;
    color: white;
    font-size: 1.4em;
    padding: 4px;
    border-radius: 10px;
    font-weight: bold;
}
.info_det {
  position: fixed;
    z-index: 1;
  padding-top: 15px;
  padding-bottom: 0px;
  width: 94%; 
  margin-left: 0px;
  
  
}
#rut, #fecha{
  font-size: 16px;
}
#nombre{
  font-size: 14px;
}
.valores label{
  width: 53%;
  font-size: 14px;
  margin-top: 22px;
  margin-bottom: 15px;
 
}
.datos label{
  font-size: 1.3em;
  width: 30%;
  margin-bottom: 10px;
  text-align: center;
}

#inicio{
  margin-left: 10px;
  margin-top: 30px; 

}

.valores{
  padding-bottom: 20px;
}
#pagos tbody td{
  font-size: 14px;
  text-align: center;
}
#pagos thead td{
  font-size: 16px;
  font-weight: bold;
  text-align: center;
  text-transform: uppercase;
}
.datos span{
  background: #e10000;
}
.modal-header{
  background: #008928;
}
.detCuotas td {
  background: #e10000!important;
  color: white;
  font-weight: bold;
  padding: 5px;
  font-size: 18px;
  font-weight: 700;
}
.detCorp th{
  font-size: 16px;
  text-align:center; 
  color:black;
  padding: 5px;
}
.detCorp td{
  padding: 5px;
}
.table>tbody>tr>td {
  padding: 4px!important;
}




</style>
 <?php

  function getPuntosRut( $rut ){

  $rutTmp = explode( "-", $rut );

  return number_format( $rutTmp[0], 0, "", ".") . '-' . $rutTmp[1];

  }

   setlocale(LC_ALL, 'es_ES').': ';

  foreach ($datos_personales as $dp) {



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



   ?>
<body>



  <div class="main">
  	

  	<div class="page-content">  
    <div class="contenedor" style="border:1px solid #ddd">		
  	 <div class="info_det row well ">  	 	
  	 		<div class="content-box-large">  	 			         
          <div class="col-md-5 datos">
            <div style="width: 100%; border:3px solid white;padding: 10px;">
              <div class="row">
              <label class="col-md-4" for="nombre">Nombre</label>
              <span class="label col-md-8" id="nombre"><?php echo $nombre.' '.$ap_paterno.' '.$ap_materno; ?></span>
              </div>
              <div class="row">
              <label class="col-md-4"  for="rut">Rut</label>
              <span class="label col-md-8" id="rut"><?php echo getPuntosRut($rut) ?></span>
              </div>
              <div class="row">
              <label class="col-md-4"  for="fecha">Fecha Registro</label>
              <span class="label col-md-8" id="fecha"><?php echo $fechaReg; ?></span>
              </div>
            </div>
          </div>  
          <div class="col-md-6 valores">
             <div style="width: 100%;height: 100%; border:3px solid white;display: inline-block;">
               
                <div class="col-md-6">
                <label for="span_total">Pagado Cuotas</label>
                <span  id="span_total"></span>
                <label for="span_deuda">Deuda Total</label>
                <span  id="span_deuda"></span>
                </div>
               <div class="col-md-6">
                <label for="span_npagas">Cuotas Pagas</label>
                <span  id="span_npagas"></span>
                <label for="span_ndeudas">Cuotas Impagas</label>
                <span  id="span_ndeudas"></span>
              </div>
            </div>
          </div>
          <div class="col-md-1" style="padding: 0px;">
          <button type="button" class="btn btn-success" id="inicio"><span class="badge">Volver</span></button>            
          </div> 
  	 		</div>
  	 	
  	 </div>
    </div>

      <div class="row" id="mostrarSocios">
      <div class="col-md-12">

              <div class="panel panel-default">

               

                <div class="panel-body">
               <div class="table-responsive">
                  <table width="100%" id="pagos" class="table table-bordered table-hover">

                  <thead>

                  <tr>

                    <td style="width: 5%;">Año</td>

                    <td style="width: 5%;">Semestre</td>
                    <td style="width: 10%;">Cuota($)</td>

                    <td style="width: 10%;">Pagado($)</td>

                    <td>Observación</td>

                    <td style="width: 10%;">Estado</td>

                    <td style="width: 5%;">Detalle</td>                    

                  </tr>

                  </thead>

                  <tbody>

                     <?php
                     $saldo_total = 0;
                     $total = 0;
                     $cont_pagada = 0;
                     $cont_deuda = 0;
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
                              $cont_pagada = $cont_pagada + 1;
                              $ico_estado = '<span style="color:#008928;"><i class="glyphicon glyphicon-ok"></i></span>';

                            }else{

                                $es = 'Impaga';
                                $cont_deuda = $cont_deuda + 1;
                                $ico_estado = '<span style="color:#e10000;"><i class="glyphicon glyphicon-remove"></i></span>';

                              }
                            if($pagado < $valor && $pagado != 0){
                              $ico_estado = '<span style="color:#f7ce04;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>';

                            }

                                echo'<tr>

                                    <td>'.$ano.'</td>

                                    <td>'.$sem.'</td>
                                    <td>'.'$'.number_format($valor, 0, ",", ".").'</td>

                                    <td>'.'$'.$pag.'</td>

                                    <td>'.$obser.'</td>

                                    <td>'.$ico_estado.'</td>

               <td><button type="button" class="btn btn-default" data-toggle="modal" href="#modalcuotas"  id="'.$id_cuota.'" onClick="selPersona(\''.$id_cuota.'\',\''.$ano.'\',\''.$sem.'\',\''.$rut.'\');">  <span class="glyphicon glyphicon-edit"></span></button></td>';



                                 echo'</tr>';

                              }



                              

                             

                           

                        ?>

                      

                   </tbody>

                </table>

          <?php $total_pag = number_format($total, 0, ",", "."); ?>
          <?php $total_sal = number_format($saldo_total, 0, ",", "."); ?>

         <input type="hidden" name="total" id="total" value="<?php echo $total_pag; ?>">
         <input type="hidden" name="deuda" id="deuda" value="<?php echo $total_sal; ?>">
         <input type="hidden" name="cont_pagada" id="cont_pagada" value="<?php echo $cont_pagada; ?>">
         <input type="hidden" name="cont_deuda" id="cont_deuda" value="<?php echo $cont_deuda; ?>">



<!-- Modal -->

        <div class="modal fade" id="modalcuotas" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content" style="width: 800px;">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>                          

                       </div>
                    <div class="modal-body">                        

                         <div id="modal_cuotas"></div>

                    <div class="form-group">   
                         </div>
                    </div>
                    <div class="modal-footer">
                        <!--Uso la funcion onclick para llamar a la funcion en javascript-->                      

                    </div>

                </div>

            </div>

        </div>

        

</div>

</div>

</div>



</div>
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

$(document).ready(function(){
  const total = $('#total').val();
  const deuda = $('#deuda').val();
  const cont_deuda = $('#cont_deuda').val();
  const cont_pagada = $('#cont_pagada').val();

  $('#span_total').text('$' + total);
  $('#span_deuda').text('$' +deuda);
  $('#span_ndeudas').text(cont_deuda);
  $('#span_npagas').text(cont_pagada);
  
});
</script>
</html>