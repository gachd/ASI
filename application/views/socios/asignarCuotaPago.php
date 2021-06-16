<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<style type="text/css">
  .error { display: block; }
.autocomplete-items {
  /*position: absolute;*/
  position: inherit;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}
.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}
.autocomplete-items div:hover {
  /*when hovering an item:*/
  background-color: #e9e9e9; 
}
.autocomplete-active {
  /*when navigating through the items using the arrow keys:*/
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
#nombre {  font-size: 20px;}
#paterno{  font-size: 20px;}
#materno{  font-size: 20px;}
.ico {
  background-color: #08c222;
 

}
#Detcuotas label {margin: auto;width: 100%;text-align: center;}
</style>
<body>


 
  <div class="main">
    <div class="container-fluid" id="contenedor"> 
      <div class="panel panel-default">
          <div class="panel-heading" style="overflow: hidden;">
            <div class="col-sm-6"><h1>ASIGNAR CUOTA ORDINARIA</h1></div>
            <div class="col-sm-6"><input class="btn btn-danger" type="button" value="VOLVER A PAGOS" id="ir_pagos"></div>

          </div>
      <div class="panel-body">
    <div class="row">
          
          
           <div class="well col-sm-6">
                   <center><label>Datos Socio</label></center>
                  <center>
                   <label id="nombre"><?php echo $nombre; ?></label> 
                   <label id="paterno"><?php echo $paterno; ?></label> 
                   <label id="materno"><?php echo $materno; ?></label>
                 </center>
                  
                  
                  <div class="col-md-8">
                    <center><label style="font-size: 14px;" >Corporaciones</label></center>
                    <ul>
                      <?php 
                      $largo = count($arrNomb);
                      for($i=0;$i<$largo;$i++){
                        $j= $i +1;
               echo '<li id="corp'.$j.'">'.$arrNomb[$i].'</li>';
                      }
                     
                      ?>
                      
                      
                    </ul>
                    
                   
                  </div>
                  
                  <div class="col-md-4" style="">
                    <center><label >Fecha Registro</label></center>
                    <ul>
                       <?php 
                      $largo = count($arrNomb);
                      for($i=0;$i<$largo;$i++){
                        $j= $i +1;
               echo '<li id="fecha'.$j.'">'.$arrFech[$i].'</li>';
                      }
                     
                      ?>                    
                    </ul>
                  </div>
          </div> 
           <div class="well col-sm-6"  id="Detcuotas">
         <center><label style="font-size: 20px;font-family: fantasy;">Detalle Cuotas</label></center>
         <div id="otraDiv">
           <?php
            for($i=0;$i<$cant;$i++){
              $j= $i+1;
              $var = explode('-', $arrCuota[$i]);
              $año = $var[0];
              $sem = $var[1];
              $rutSocio = explode('-', $rut);
              $rutS = $rutSocio[0];

              
             echo   '<div class="row" id="Divcuota'.$j.'">
                       <div class="col-md-4" id="cuota'.$j.'">
                       <label>Cuota'.$arrCuota[$i].'</label>
                       </div>';
                   if($arrEcuota[$i] == 0){
                $estCuota = 'No Asociada';
                echo '<div class="col-md-4" id="estado'.$j.'">
                       <label>'.$estCuota.'</label>
                       </div>
                       <div class="col-md-4" id="btn'.$j.'">
          <input onclick=selCuota('.$año.','.$sem.','.$rutS.') class="btn btn-danger" type="button" value="ASOCIAR" id="asociar'.$j.'"></div>';
              }else{
                $estCuota = 'Asociada';
                echo '<div class="col-md-4" id="estado'.$j.'">
                       <label>'.$estCuota.'</label>
                       </div>
                       <div class="col-md-4" id="btn'.$j.'">
                       <span class="ico badge badge-success" id="correcto'.$j.'"><i class="glyphicon glyphicon-ok"></i></span>
         </div>';
              }    
                       

                echo    '</div>';
                  }
           ?>

         </div>
       </div>        
       </div>
     
    </div>
 </div>
 
</div>
</div>

</body>
<script  src="<?php echo base_url(); ?>assets/js/autocomplete.js"></script>

<script type="text/javascript">
   
$(document).ready(function() {

btnPagos = $("#ir_pagos");
    
btnPagos.click(function() {
  window.location.href = "<?php  echo base_url()?>socios/Pago_cuota";
 

});

selCuota= function(cuota,sem,rut){
  // $('#ano').val(ano);
 rutInt = rut.toString();
 
 var rutSocio = rutInt + '-' +calculaDigitoVerificador(rutInt);
 var año = cuota;
 var sem = sem; 

  $.ajax({
        type:'POST',
        url: '<?php echo base_url()?>socios/Asignarcuota/asignarCuota',
        data:{'rutSocio':rutSocio,'año':año,'sem':sem},
        
       
        success: function(data) {
         // btnBuscar = $("#buscar");
          //btnBuscar.click();
             location.reload();  
    
   
        }
      });

};



  });

/*
 * Calcula digito verificador
 */
calculaDigitoVerificador = function (rut) {
  // type check
  if (!rut || !rut.length || typeof rut !== 'string') {
    return -1;
  }
  // serie numerica
  var secuencia = [2,3,4,5,6,7,2,3];
  var sum = 0;
  //
  for (var i=rut.length - 1; i >=0; i--) {
    var d = rut.charAt(i)
    sum += new Number(d)*secuencia[rut.length - (i + 1)];
  };
  // sum mod 11
  var rest = 11 - (sum % 11);
  // si es 11, retorna 0, sino si es 10 retorna K,
  // en caso contrario retorna el numero
  return rest === 11 ? 0 : rest === 10 ? "K" : rest;
};
</script>