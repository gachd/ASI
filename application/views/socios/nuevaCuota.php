<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="UTF-8">

  <title>Document</title>

   <?php echo form_open(base_url().'socios/nuevo_socio/newsocio'); ?>

      <?php echo validation_errors(); ?>

</head>

<style>

  .tbl-afiliacion{ color: #353535;

                   font-size: 10px;

                   text-transform: capitalize; 

                   border: 1px #b9b6b6  solid;

                 }

  .n_registro{

    text-align: center;



  }



  .n_registro input {

    height: 10px;

  }



  .card-title{border-left: 3px solid #4b7006;

    color: #4b7006;

    margin: 5px 0px 5px 0px;

    padding: 10px;

    font-weight: 600;

    text-transform: uppercase;

  }







.bs-callout {

    /*padding: 20px;*/

    padding:0px 10px;

    margin: 2px 5px;

    border: 1px solid #eee;

    border-left-width: 5px;

    border-radius: 3px;

}

.bs-callout-green h4 {

    color: #4b7006;

    }

  .bs-callout-green {

    border-left-color: #4b7006;

    width: 30%;

    float: left ;



}



.tbl-datos{font-size: 11px; text-transform: uppercase;}

.pat{font-size: 10px;}

.box-pat{    max-height: 127px;

    overflow: auto;}

.box-pat > ul{padding-left: 5px;}

.box-pat > ul > li > a {color: #333;}





  /*tab panel*/

  .nav-tabs { border-bottom: 2px solid #DDD; }

    .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover { border-width: 0; }

    .nav-tabs > li > a { border: none; color: #ffffff;background: #4b7006 ;height: 50px;  }

        .nav-tabs > li.active > a, .nav-tabs > li > a:hover { border: none;  color: #4b7006  !important; background: #fff; }

        .nav-tabs > li > a::after { content: ""; background: #4b7006 ; height: 2px; position: absolute; width: 100%; left: 0px; bottom: -1px; transition: all 250ms ease 0s; transform: scale(0); }

    .nav-tabs > li.active > a::after, .nav-tabs > li:hover > a::after { transform: scale(1); }

.tab-nav > li > a::after { background: #4b7006  none repeat scroll 0% 0%; color: #fff; }

.tab-pane { padding: 15px 0; }

.tab-content{padding:20px;overflow: hidden;}

.nav-tabs > li  {width:25%; text-align:center;}

.card {background: #FFF none repeat scroll 0% 0%; box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3); margin-bottom: 30px; }





@media all and (max-width:724px){

.nav-tabs > li > a > span {display:none;} 

.nav-tabs > li > a {padding: 5px 5px;}

}



table.registro_socios{font-size: 12px;}

table.registro_socios tbody{text-align: center;}

.r_coorp{text-align: left;}



.historial{max-height: 240px;

           overflow: overlay;}

table.historial_coorp{width: 100%; font-size: 12px;}

table.historial_coorp th{

                          vertical-align: bottom;

                          border-bottom: 2px solid #dee2e6;

                          color: #555555;

                          padding: 1.05rem 0.75rem;

                          text-transform: capitalize;

                          letter-spacing: 1px;

                        }



    table.historial_coorp tr{    padding-bottom: 20px;}

    table.historial_coorp tr:last-child {

    border-bottom: none;

}

table.historial_coorp td{border-top: 1px solid #ccc;

  padding: 1.05rem 0.75rem;}



  table.datos_coorp{font-size: 12px; text-transform: capitalize;}

  table.datos_coorp td{padding: 4px 3px; }



.n_accion{    font-size: 50px;

    text-align: center;

}



.desc_accion{border-right: none; border-left: none;}



.desc_accion .list-group-item:first-child {border-radius:  none;}



/*==================================================

 * left tab

 * ===============================================*/



 

 

 .tabs-left > .nav-tabs {

    float: left;

    /*margin-right: 19px;*/

    border: none;

}



.tabs-below > .nav-tabs, .tabs-right > .nav-tabs, .tabs-left > .nav-tabs {

    border-bottom: 0;

}



.tabs-left > .nav-tabs > li, .tabs-right > .nav-tabs > li {

    float: none;

    text-align: left;

    width: 100%;

}



.tabs-left > .nav-tabs > li > a {

    margin-right: -1px;

    -webkit-border-radius: 4px 0 0 4px;

    -moz-border-radius: 4px 0 0 4px;

    border-radius: 4px 0 0 4px;

}

.tabs-left > .nav-tabs > li > a, .tabs-right > .nav-tabs > li > a {

    min-width: 74px;

    margin-right: 0;

    margin-bottom: 3px;

    background-color: #4b7006;

    border-radius:0px;

    color: white;

    font-size: 11px;

}



.tabs-left > .nav-tabs .active > a, .tabs-left > .nav-tabs .active > a:hover, .tabs-left > .nav-tabs .active > a:focus {

    border-color: #ddd transparent #ddd #ddd;

      background-color: #fff;

color: dimgrey;

border:none;

}



.left-tab-process .tab-content{

  background-color:#fff;

      margin-left: 131px;

      padding: 0px 15px;}



.tab-content > .active, .pill-content > .active {

    display: block;

}



.book-process-ltab{

  max-width:131px;}

  

.left-tab-process .tab-pane{

    padding: 0px 1px;

    min-height: 442px;

}



.left-tab-process h4{

  color:#536779;}





  

.term-fa{

margin-right: 7px;

    font-size: 11px;

    margin-left: -18px;

    color: #2EA72F;}

    

.tac-content{

    background-color:#ccc;}

  

  

.det_accion{ border-right: none;

border-left: none; }



table#reg_accion thead>tr>td{background: #f5f5f5;

                            text-transform: uppercase;

                            font-size: 11px;

                            vertical-align: inherit;}

table#cargas thead>tr>td{background: #f5f5f5;

                            text-transform: uppercase;

                            font-size: 11px;

                            vertical-align: inherit;}



table#cargas tbody>tr>td{font-size:10px;}

table#tablacargas  tbody>tr>td{font-size:12px;}                            

 

.bloqueado{color:#9a9a99; background: yellow;}





#contenedor {

  width: 99%;

  margin: auto;

}

 

  @media (max-width:768px){

   

}

 



 

   /*==================================================

}

}

 * left tab

 * ===============================================



*/

<?php

$arreglo = array();

$inicio = 2009;

$cont =0;

for($i=0;$i<22;$i++){

//if(!empty($cuota)){

  foreach ($cuota as $c) {

   $año = $c->ano;

   if($inicio == $año){

    $cont = $cont+1;

   }

    

  }



  if($cont != 2){

    $arreglo[$i] = $inicio;  

  }

  

  $inicio = $inicio + 1;

  $cont = 0;



}

$long = count($arreglo);

$arreglo = array_values($arreglo);



  

//}



 ?>



</style>

<body>

 



 

  <div class="main">

    <div class="container-fluid" id="contenedor"> 

      <div class="panel panel-default">

          <div class="panel-heading" style="overflow: hidden;">

            <div class="col-sm-6"><h1>NUEVA CUOTA ORDINARIA</h1></div>

            <div class="col-sm-3"><input class="btn btn-primary" id="reset" type="reset" value="Reset">

              <input id="save" class="btn btn-success" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#miModal" value="Guardar"></div>



          </div>

      <div class="panel-body">

        <div class="well row">

      <form <form class="form-inline">



        <div class="form-group">          

          <label for="input-nombre" class="col-sm-3 control-label" style="font-size: 20px">Valor Semestral Cuota</label> 



          <div class="col-sm-3">  

          <div class="input-group">

              <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>

              <input type="number" name="cuotaSem" id="cuotaSem" class="form-control">   



          </div>

          </div> 

          <div class="col-sm-6">

          <label for="input-nombre" class="col-sm-2 control-label">Año:</label>          

          <div class="col-sm-3">           

            <select id="año">

              <?php

                for ($j=0; $j < $long; $j++) {

        echo ' <option class="form-control" value="'.$arreglo[$j].'" >'.$arreglo[$j].'</option>';

  

              }

               ?>

            </select>

          </div>

           <label for="input-nombre" class="col-sm-3 control-label">Periodo</label>  

           <div class="col-sm-3"> 

            <label>1</label>          

            <input type="checkbox" name="sem1" id="sem1">

            <label>2</label>

            <input type="checkbox" name="sem2" id="sem2" >

          </div>  

        </div>



        </div>

        </form>

     </div>

     <div class="well col-sm-6" id="semestre1" >

      <div class="row">

      <center><label style="font-size: 20px">Periodo 1</label></center>

     </div>



       <label class="col-sm-2 ">Emisión</label>

        <div class="col-sm-4">

       <input class="form-control w_fecha" type="text" name="emi_sem1" id="emi_sem1"  value="">

       </div>

       <label class="col-sm-2 control-label">Vencimiento</label>

        <div class="col-sm-4">

       <input class="form-control w_fecha" type="text" name="venc_sem1" id="venc_sem1"  value="">

       </div>

     </div>

     <div class="well col-sm-6" id="semestre2" >

       <div class="row">

      <center><label style="font-size: 20px">Periodo 2</label></center>

     </div>

       <label class="col-sm-2 ">Emisión</label>

        <div class="col-sm-4">

      <input class="form-control w_fecha" type="text" name="emi_sem2" id="emi_sem2"  value="">

       </div>

       <label class="col-sm-2 control-label">Vencimiento</label>

        <div class="col-sm-4">

        <input class="form-control w_fecha" type="text" name="venc_sem2" id="venc_sem2"  value="">

       </div>

     </div>

       <div class="control-label">

      <div class="col-md-12"><center><label style="font-size: 1.2em">VALORES POR CORPORACIONES</label></center></div>

        <form class="form-inline" id="corp">

        

          <div class="col-md-4 col-sm-6 col-xxs-12">

          <div class="panel panel-success">

             <div class="panel-heading"><center>CENTRO ITALIANO DE CONCEPCION</center></div>

             <div class="panel-body">

              <div class="input-group">

              <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>

              <input type="number"  name="cuotaCentro" id="cuotaCentro" class="form-control">  

                        

              </div>



             </div>

          </div>

          </div>

          <div class="col-md-4 col-sm-6 col-xxs-12">

          <div class="panel panel-success">

             <div class="panel-heading"><center>STADIO ITALIANO DI CONCEPCION</center></div>

             <div class="panel-body">

             <div class="input-group">

              <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>

              <input type="number" name="cuotaStadio" id="cuotaStadio" class="form-control">

              </div>

             </div>

          </div>

          </div>

          

          <div class="col-md-4 col-sm-6 col-xxs-12">

          <div class="panel panel-success">

             <div class="panel-heading"><center>STADIO ATLETICO ITALIANO</center></div>

             <div class="panel-body">

              <div class="input-group">

              <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>

              <input type="number" name="cuotaAtletico" id="cuotaAtletico" class="form-control">

              </div>

            </div>

          </div>

          </div>   

          <div class=" col-md-offset-2 col-md-4 col-sm-6 col-xxs-12">

          <div class="panel panel-success">

             <div class="panel-heading"><center>SOCIEDAD ITALIANA DE SOCORROS MUTUOS</center></div>

             <div class="panel-body">

             <div class="input-group">

              <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>

              <input type="number" name="cuotaSocorros" id="cuotaSocorros" class="form-control">

              </div>

            </div>

          </div>

          </div> 

          <div class="col-md-4 col-sm-6 col-xxs-12">

          <div class="panel panel-primary">

             <div class="panel-heading"><center>SCUOLA ITALIANA DI CONCEPCION</center></div>

             <div class="panel-body">

              <div class="input-group">

              <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>

              <input type="number" name="cuotaScuela" id="cuotaScuola" class="form-control">

              </div>

             </div>

          </div>

          </div>          

          

        

       </form>

      </div>

    </div>

 </div>

</div>

<div id="miModal" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Contenido del modal -->

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

      </div>

      <div class="modal-body">

        <h1>Resumen Nueva Cuota Ordinaria</h1>

        <div class="row">

        <div class="col-sm-3">Año:<label id="añomodal"></label></div>

        <div class="col-sm-9">

            <label>Periodo: 1</label><label id="per1"></label>

            <label>2</label><label id="per2"></label>                                     

        </div>

      </div>

      <div class="row">

        <form >

         <div class="col-sm-8">

          <form class="form-inline">

            <label  style="width: 80%">Stadio Italiano Di Concepcion:</label><label id="valorStadio"></label>

            <label style="width: 80%">Centro Italiano De Concepcion:</label><label id="valorCentro"></label>

            <label style="width: 80%">Stadio Atletico Italiano:</label><label id="valorAtletico"></label>

            <label style="width: 80%">Sociedad Italiana de Socorros Mutuos:</label><label id="valorSocorros"></label>

            <label class="label label-primary" style="font-size:20px;width: 80%">Total Cuota Ordinaria:</label>

            <label style="font-size:18px;" class="label label-primary" id="totalCO"></label>

            <label style="width: 80%">Scuola Italiana Di Concepcion:</label><label id="valorScuola"></label>

            <label class="label label-primary" style="font-size:20px;width: 80%">Total Cuota Ordinaria + Cuota Scuola:</label>

            <label style="font-size:18px;" class="label label-primary"  id="totalMasScuola"></label>



          </form>

          </div>

              

        </form>

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-success" id="EnviarDatos" data-dismiss="modal">Aceptar</button>

        <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>

      </div>

    </div>

  </div>

</div>

</body>

</html>

<script type="text/javascript">

  $.datepicker.regional['es'] = {

 closeText: 'Cerrar',

 prevText: '<Ant',

 nextText: 'Sig>',

 currentText: 'Hoy',

 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],

 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],

 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],

 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],

 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],

 weekHeader: 'Sm',

 dateFormat: 'yy/mm/dd',

 firstDay: 1,

 isRTL: false,

 showMonthAfterYear: false,

 yearSuffix: ''

 };

 $.datepicker.setDefaults($.datepicker.regional['es']);

$(function () {

$("#emi_sem1").datepicker();

});

$(function () {

$("#venc_sem1").datepicker();

});

$(function () {

$("#emi_sem2").datepicker();

});

$(function () {

$("#venc_sem2").datepicker();

});

  $(document).ready(function(){

     $('#reset').click(function() {

          setTimeout("window.location.href = '<?php echo base_url()?>socios/Nuevacuota'",500);  

  });

});

$(document).ready(function(){

     $('#EnviarDatos').click(function() {

          var año =  $("#año option:selected").val();

          var cuotaCentro = $('#cuotaCentro').val();

          var cuotaStadio = $('#cuotaStadio').val();

          var cuotaAtletico = $('#cuotaAtletico').val();

          var cuotaSocorros = $('#cuotaSocorros').val();

          var cuotaScuola = $('#cuotaScuola').val();          

          var cuotaSem = $('#cuotaSem').val();



          var total = parseFloat(cuotaCentro)+ parseFloat(cuotaStadio) + parseFloat(cuotaAtletico) + parseFloat(cuotaSocorros);

          var todas = parseFloat(total)+ parseFloat(cuotaScuola);



          if($('#sem1').prop('checked')==false){

            var per1 = 0;

            var emi_sem1 = 0;

            var venc_sem1 = 0;

          }else{

            var per1 = 1;

            var emi_sem1 = $('#emi_sem1').val();

            var venc_sem1 = $('#venc_sem1').val();

          }

          if($('#sem2').prop('checked')==false){

            var per2 = 0;

            var emi_sem2 = 0;

             var venc_sem2 = 0;

          }else{

            var per2 = 2;

             var emi_sem2 = $('#emi_sem2').val();

             var venc_sem2 = $('#venc_sem2').val();

          }

      var formData = new FormData();  

      formData.append('año', año);

      formData.append('sem', per1);

      formData.append('semm', per2);

      formData.append('cuotaCentro', cuotaCentro);

      formData.append('cuotaStadio', cuotaStadio);

      formData.append('cuotaAtletico', cuotaAtletico);

      formData.append('cuotaSocorros', cuotaSocorros);

      formData.append('cuotaScuola', cuotaScuola);

      formData.append('cuotaSem', cuotaSem);

      formData.append('emi_sem1', emi_sem1);

      formData.append('emi_sem2', emi_sem2);

      formData.append('venc_sem1', venc_sem1);

      formData.append('venc_sem2', venc_sem2);

      formData.append('todas', todas);

      

      $.ajax({

        url: "<?php echo base_url()?>socios/Nuevacuota/agregarCuota",

        data: formData,

        type: 'POST',

        contentType: false,

        processData: false,

        success: function(resultados) {



          console.log("Petición terminada. Resultados", resultados);

        //$('#msg').fadeIn();     

         //setTimeout(function() {

           //        $("#msg").fadeOut();           

          //   },5000);

           setTimeout("window.location.href = '<?php echo base_url()?>socios/Nuevacuota'",3500);

          

        }



      });

  

   



     });

  });  

$(document).ready(function(){

     $('#save').click(function() {

          var año =  $("#año option:selected").val();

          var cuotaCentro = $('#cuotaCentro').val();

          var cuotaStadio = $('#cuotaStadio').val();

          var cuotaAtletico = $('#cuotaAtletico').val();

          var cuotaSocorros = $('#cuotaSocorros').val();

          var cuotaScuola = $('#cuotaScuola').val();



         var total = parseFloat(cuotaCentro)+ parseFloat(cuotaStadio) + parseFloat(cuotaAtletico) + parseFloat(cuotaSocorros);

          var totalMasScuola = parseFloat(total)+ parseFloat(cuotaScuola); 

          $('#añomod').val(año);

          $('#añomodal').text(año);

          $('#valorStadio').text('$'+cuotaStadio);

          $('#valorCentro').text('$'+cuotaCentro);   

          $('#valorAtletico').text('$'+cuotaAtletico);   

          $('#valorSocorros').text('$'+cuotaSocorros);    

          $('#valorScuola').text('$'+cuotaScuola);  

          $('#totalCO').text('$'+total); 

          $('#totalMasScuola').text('$'+totalMasScuola);             



          if($('#sem1').prop('checked')==false){

            $('#iPer1').remove();

            $('#per1').append('<i id="iPer1" class="glyphicon glyphicon-remove"></i>');

          }else{

            $('#iPer1').remove();

            $('#per1').append('<i id="iPer1"  class="glyphicon glyphicon-ok"></i>');

          } 

          if($('#sem2').prop('checked')==false){

            $('#iPer2').remove();

            $('#per2').append('<i id="iPer2"  class="glyphicon glyphicon-remove"></i>');

          }else{

            $('#iPer2').remove();

            $('#per2').append('<i id="iPer2"  class="glyphicon glyphicon-ok"></i>');

          } 

          

          

  });

});

  $(document).ready(function(){

     $('#cuotaCentro').attr('disabled','disabled');

    $('#cuotaStadio').attr('disabled','disabled');

    $('#cuotaScuola').attr('disabled','disabled');

    $('#cuotaSocorros').attr('disabled','disabled');

    $('#cuotaAtletico').attr('disabled','disabled');

  

   if($('#sem1').prop('checked')==false){

     $('#semestre1').hide();

     $('#save').attr('disabled','disabled');

   }

   if($('#sem2').prop('checked')==false){

     $('#semestre2').hide();

     

   }

     $('#sem1').change(function() {

        if(this.checked) {

          $('#semestre1').show();

           $('#save').removeAttr('disabled','disabled');

            //var returnVal = confirm("Are you sure?");

            //$(this).prop("checked", returnVal);

        }else{

          $('#semestre1').hide();

          if($('#sem2').prop('checked')==false){

                

                $('#save').attr('disabled','disabled');

   }

          

        }

               

    });

     $('#sem2').change(function() {

        if(this.checked) {

          $('#semestre2').show();

           $('#save').removeAttr('disabled','disabled');

            //var returnVal = confirm("Are you sure?");

            //$(this).prop("checked", returnVal);

        }else{

          $('#semestre2').hide();

          if($('#sem1').prop('checked')==false){

                

                $('#save').attr('disabled','disabled');

   }

        }

               

    });



  });

  jQuery('#cuotaCentro').blur(function(){



     var valor = $('#cuotaCentro').val();

     var sem = $('#cuotaSem').val();

    



   if(valor > sem){

   // alert('error');

    $('#cuotaStadio').attr('disabled','disabled');

    $('#cuotaScuola').attr('disabled','disabled');

    $('#cuotaSocorros').attr('disabled','disabled');

    $('#cuotaAtletico').attr('disabled','disabled');

    $('#cuotaCentro').focus();

   }else{

     var confirma = confirm("Es correcto el valor ingresado?");

      //  $(this).prop("checked", returnVal);

      if(confirma && valor !=0){



    $('#cuotaCentro').attr('disabled','disabled');

    $('#cuotaStadio').removeAttr('disabled','disabled');

    $('#cuotaScuola').attr('disabled','disabled');

    $('#cuotaSocorros').attr('disabled','disabled');

    $('#cuotaAtletico').attr('disabled','disabled');

       }      

   

   } 



});

  jQuery('#cuotaStadio').blur(function(){



     var centro = $('#cuotaCentro').val();

     var sem = $('#cuotaSem').val();

     var stadio = $('#cuotaStadio').val();

     var sum = parseFloat(centro)+ parseFloat(stadio);

    



   if(sum > sem){   // alert('error');

   

    $('#cuotaScuola').attr('disabled','disabled');

    $('#cuotaSocorros').attr('disabled','disabled');

    $('#cuotaAtletico').attr('disabled','disabled');

    $('#cuotaStadio').focus();

   }else{

      var confirma2 = confirm("Es correcto el valor ingresado?");

      //  $(this).prop("checked", returnVal);

      if(confirma2 && stadio !=0){

     $('#cuotaStadio').attr('disabled','disabled');

     $('#cuotaAtletico').removeAttr('disabled','disabled');

      $('#cuotaScuola').attr('disabled','disabled');

    $('#cuotaSocorros').attr('disabled','disabled');

       }   

     

    

   } 



});

  jQuery('#cuotaAtletico').blur(function(){



     var centro = $('#cuotaCentro').val();

     var sem = $('#cuotaSem').val();

     var stadio = $('#cuotaStadio').val();

     var atletico = $('#cuotaAtletico').val();



     var sum = parseFloat(centro)+ parseFloat(stadio) + parseFloat(atletico);

    



   if(sum > sem){   // alert('error');

   

    $('#cuotaScuola').attr('disabled','disabled');

    $('#cuotaSocorros').attr('disabled','disabled');    

    $('#cuotaAtletico').focus();

   }else{



       var confirma3 = confirm("Es correcto el valor ingresado?");

      //  $(this).prop("checked", returnVal);

      if(confirma3 && atletico !=0){

     $('#cuotaAtletico').attr('disabled','disabled');

     $('#cuotaSocorros').removeAttr('disabled','disabled');

      $('#cuotaScuola').attr('disabled','disabled');

       }  

      

     

    

   } 



});

  jQuery('#cuotaSocorros').blur(function(){



     var centro = $('#cuotaCentro').val();

     var sem = $('#cuotaSem').val();

     var stadio = $('#cuotaStadio').val();

     var atletico = $('#cuotaAtletico').val();

     var socorros = $('#cuotaSocorros').val();



     var sum = parseFloat(centro)+ parseFloat(stadio) + parseFloat(atletico) + parseFloat(socorros);

    



   if(sum == sem){   // alert('error');

   var confirma3 = confirm("Es correcto el valor ingresado?");

      //  $(this).prop("checked", returnVal);

      if(confirma3 && socorros !=0){

     $('#cuotaSocorros').attr('disabled','disabled');

      $('#cuotaScuola').removeAttr('disabled','disabled');  

       }  

      

    

   }else{



      $('#cuotaSocorros').focus();      

      $('#cuotaScuola').attr('disabled','disabled');   

    

   } 



});



  jQuery('#cuotaSem').blur(function(){



     

     var sem = $('#cuotaSem').val();

     if(sem != null){

       var returnVal = confirm("Es correcto el valor ingresado?");

      //  $(this).prop("checked", returnVal);

      if(returnVal){

          $('#cuotaSem').attr('disabled','disabled');  

          $('#cuotaSem').closest('.form-group').removeClass('has-error has-feedback').addClass('has-success has-feedback');

          $('#cuotaSem').closest('.input-group').append('<span class="input-group-addon"><i class="glyphicon glyphicon-ok"></i></span>');

           $('#cuotaCentro').removeAttr('disabled','disabled'); 

         

        }

       

     }



});

  jQuery('#cuotaScuola').blur(function(){



     

     var scuo = $('#cuotaScuola').val();

     if(scuo != null){

       var returnVal = confirm("Es correcto el valor ingresado?");

      //  $(this).prop("checked", returnVal);

      if(returnVal){

      $('#cuotaScuola').attr('disabled','disabled');  

      $('#cuotaScuola').closest('.form-group').removeClass('has-error has-feedback').addClass('has-success has-feedback');

      $('#cuotaScuola').closest('.input-group').append('<span class="input-group-addon"><i class="glyphicon glyphicon-ok"></i></span>');

           

         

        }

       

     }



});

/*$(document).ready(function () {

jQuery.validator.setDefaults({

            highlight: function (element, errorClass, validClass) {

                if (element.type === "radio") {

                    this.findByName(element.name).addClass(errorClass).removeClass(validClass);

                } else {

                    $(element).closest('.form-group').removeClass('has-success has-feedback').addClass('has-error has-feedback');

                    $(element).closest('.form-group').find('i.fa').remove();

                    $(element).closest('.form-group').append('<i class="fa fa-exclamation fa-lg form-control-feedback"></i>');

                }

            },

            unhighlight: function (element, errorClass, validClass) {

                if (element.type === "radio") {

                    this.findByName(element.name).removeClass(errorClass).addClass(validClass);

                } else {

                    $(element).closest('.form-group').removeClass('has-error has-feedback').addClass('has-success has-feedback');

                    $(element).closest('.form-group').find('i.fa').remove();



                    $(element).closest('.form-group').append('<i class="fa fa-check fa-lg form-control-feedback"></i>');

                }

            }

        });});*/

</script>