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

            



          </div>

      <div class="panel-body">

    <div class="row">

     

       <div class="well col-sm-6">

         <center><label>Buscador de Socios</label></center>

        

            <div class="col-sm-2">

                    <label for="">RUT</label>

                  </div>

    <div class="col-md-4">

    <input autocomplete="on" type="text" class="form-control" name="rut_socio" id="rut_socio" placeholder="Ej: 11111111-1" value="<?php echo set_value('rut_socio');?>">

    <span id="rut_socio"  style="display:none;color:red;">Rut incorrecto</span>

                   </div>

                   <div class="col-md-4">                     

                        <button id="buscar" type="button" class="btn btn-info">

                          <span class="glyphicon glyphicon-search"></span>

                        </button>  

                                  

                 </div>           

        

       </div>

       <div class="well col-sm-6" style="float: right;" id="Detcuotas">

         <center><label style="font-size: 20px;font-family: fantasy;">Detalle Cuotas</label></center>

         <div id="otraDiv"></div>

       </div>



       

          

        

         



        

        

     

           <div class="well col-sm-6">

                   <center><label>Datos Socio</label></center>

                  <center> <label id="nombre"></label> <label id="paterno"></label> <label id="materno"></label></center>

                  

                  

                  <div class="col-md-8">

                    <center><label style="font-size: 14px;" >Corporaciones</label></center>

                    <ul>

                      <li style="display: none;" id="corp1"></li>

                      <li style="display: none;" id="corp2"></li>

                      <li style="display: none;" id="corp3"></li>

                      <li style="display: none;" id="corp4"></li>

                      <li style="display: none;" id="corp5"></li>

                    </ul>

                    

                   

                  </div>

                  

                  <div class="col-md-4" style="">

                    <center><label >Fecha Registro</label></center>

                    <ul>

                      <li style="display: none;" id="fecha1"></li>

                      <li style="display: none;" id="fecha2"></li>

                      <li style="display: none;" id="fecha3"></li>

                      <li style="display: none;" id="fecha4"></li>

                      <li style="display: none;" id="fecha5"></li>

                    </ul>

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

   

  var socios = [

   <?php 

    $socios = $this -> model_socios -> allSoociosVal(); 

    foreach ($socios as $s) {

      echo'"'.$s -> prsn_rut.'",';

    }

   ?>

];



autocomplete(document.getElementById("rut_socio"), socios);



$(document).ready(function() {



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

          btnBuscar = $("#buscar");

          btnBuscar.click();

              

    

   

        }

      });



};



btnBuscar = $("#buscar");

    

$("#buscar").click(function() {

  var rutSocio = $("#rut_socio").val();



  $('#otraDiv').remove();

  

  $.ajax({

        type:'POST',

        url: '<?php echo base_url()?>socios/Asignarcuota/buscarsocio',

        data:{'rutSocio':rutSocio},

        

       

        success: function(data) {

             var valores = eval(data);

             var nombre = valores[0];

             var paterno = valores[1];  

             var materno = valores[2];

             var rut = valores[3].toString();

             var cant = valores[8];



           

             var arrCorp1 = valores[4][0];

             var arrCorp2 = valores[4][1];

             var arrCorp3 = valores[4][2];

             var arrCorp4 = valores[4][3];

             var arrCorp5 = valores[4][4];

             var fechaCorp1 = valores[5][0];

             var fechaCorp2 = valores[5][1];

             var fechaCorp3 = valores[5][2];

             var fechaCorp4 = valores[5][3];

             var fechaCorp5 = valores[5][4];    

           

           var otraDiv = $("<div>").attr({id:'otraDiv'});

           $('#Detcuotas').append(otraDiv);



           

           for(var i=0;i<cant;i++){

            var cuota = valores[6][i];

            var estadoCuota = valores[7][i];

            var h = i+1;

            var divCuotas= $("<div>").attr({class:'row',id:'Divcuota'+h});

             var div= $("<div>").attr({class:'col-md-4',id:'cuota'+h});

             

             var label = $("<label>").text('Cuota '+ cuota);

             var div2= $("<div>").attr({class:'col-md-4',id:'estado'+h});

             



            var div3= $("<div>").attr({class:'col-md-4',id:'btn'+h});

             $('#otraDiv').append(divCuotas);

             $('#Divcuota'+h).append(div);

             $('#cuota'+h).append(label);

             $('#Divcuota'+h).append(div2);

            // $('#estado'+h).append(estado);

             $('#Divcuota'+h).append(div3);

            // $('#btn'+h).append(btn);

             $('#asociar'+h).attr('data-id',cuota);

             var result = cuota.split('-');

             var año = result[0];  

             var sem = result[1];



             if(estadoCuota == 0){

               var estado = $("<label>").text('No Asociada');

  var btn = $("<input>").attr({onClick:"selCuota("+año+","+sem+","+rut+")",class:'btn btn-danger',type:'button',value:'ASOCIAR',id:'asociar'+h});

   $('#estado'+h).append(estado);

    $('#btn'+h).append(btn);

             }else{

        var estado = $("<label>").text('Asociada ');

        var btn = $("<span>").attr({class:'ico badge badge-success',id:'correcto'+h});

        var ico = $("<i>").attr({class:'glyphicon glyphicon-ok'});

               $('#estado'+h).append(estado);

                $('#btn'+h).append(btn);

                 $('#correcto'+h).append(ico);

              

             }

             

            

           }

 

            for(var i=1;i<6;i++){

              $('#corp'+i).text('');

              $('#fecha'+i).text('');

            }

             $('#corp1').text('');



             $('#nombre').text(nombre);

             $('#paterno').text(paterno);

             $('#materno').text(materno);

             $('#rut').text(rut);



             if(arrCorp1 != null){

              $('#corp1').css('display','block');

              $('#fecha1').css('display','block');

              $('#corp1').text(arrCorp1);

              $('#fecha1').text(fechaCorp1);

             }

             if(arrCorp2 != null){

              $('#corp2').css('display','block');

              $('#fecha2').css('display','block');

              $('#corp2').text(arrCorp2);

              $('#fecha2').text(fechaCorp2);

             }

             

             if(arrCorp3 != null){

              $('#corp3').css('display','block');

              $('#fecha3').css('display','block');

              $('#corp3').text(arrCorp3);

              $('#fecha3').text(fechaCorp3);

             }



             if(arrCorp4 != null){

              $('#corp4').css('display','block');

              $('#fecha4').css('display','block');

              $('#corp4').text(arrCorp4);

              $('#fecha4').text(fechaCorp4);

             }



             if(arrCorp5 != null){

              $('#corp5').css('display','block');

              $('#fecha5').css('display','block');

              $('#corp5').text(arrCorp5);

              $('#fecha5').text(fechaCorp5);

             }

             

             

            



        }

      });







  });

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