<!DOCTYPE html>

<html lang="en">

<head>

	<meta charset="UTF-8">

	<title>Document</title>

</head>

<style>

table#cantidad{

  border: 1px solid green;

   width: 80%;

  margin: auto;

  margin-top: 10px;

  text-align: center;

}

#cantidad tr td{

  border: 1px solid green;

}

#cantidad th{

   border: 1px solid green;

   text-align: center;

}

table.menu_socios{

  border:1px solid black;

  width: 80%;

  margin: auto;

  margin-top: 10px;

}

table.menu_cargas{

  border:1px solid black;

  width: 80%;

  margin: auto;

  margin-top: 10px;

}

table.menu_pagos{

   border:1px solid black;

  width: 80%;

  margin: auto;

  margin-top: 10px;

}

table.menu_listado{

   border:1px solid black;

  width: 80%;

  margin: auto;

  margin-top: 10px;

}

.menu_socios th{

  border:1px solid black;

  font-size: 20px;

}

.menu_cargas th{

  border:1px solid black;

  font-size: 20px;

}

.menu_pagos th{

  border:1px solid black;

  font-size: 20px;

}

.menu_listado th{

  border:1px solid black;

  font-size: 20px;

}

table img{

  width: 100px;

}

.contenedor{

  width: 500px;

}

h1{

  text-align: center;

  font-size: 30px;

}

.estado{

  width: 50%;

  margin: auto;

}

.estado img{

  width: 40px;

  height: 40px;

}

.badge{

  background: white;

  color: black;

  font-size: 1.5em;

}

.label{

  padding: .5em .6em .4em;

}

#mostrar{

  width: 80%;

  margin: auto;

}

#contenido{

  width: 80%;

  margin: auto;

}

.panel a{

  color: white;



}

.panel{

  width: 60%;

  margin: auto;

  border-color: #4b7006;

}

.panel > .panel-heading{

  background: #4b7006;

  border-color: #4b7006;

}

</style>

<body>



  <div class="main">

      <div class="container">



    <div class="row"><h1>MANTENEDOR CUOTAS SOCIALES</h1></div>

    

    <div class="row" id="mostrar"> </div>

   <div class="well row socios" id="contenido">



    <div class="col-md-4 col-sm-6 col-xxs-12 "> 

    <div class="panel panel-primary">

      <div class="panel-heading">

        <center><a href="<?php echo base_url(); ?>socios/Nuevacuota"><strong>NUEVA CUOTA ORDINARIA</strong></a></center>

      </div>

      <div class="panel-body">

       <center>  

       <a href="<?php echo base_url(); ?>socios/Nuevacuota">

       <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/nuevaCuota.png"></a>

   </center>

      </div>

    </div>

   </div>

  <div class="col-md-4 col-sm-6 col-xxs-12 "> 

    <div class="panel panel-primary">

      <div class="panel-heading">

        <center><a href="<?php echo base_url(); ?>socios/Editcuota"><strong>EDITAR CUOTA ORDINARIA</strong></a></center>

      </div>

      <div class="panel-body">

       <center>  

       <a href="<?php echo base_url(); ?>socios/Editcuota">

       <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/editCuota.png"></a>

   </center>

      </div>

    </div>

   </div>

    <div class="clearfix visible-sm-block"></div> 

    <div class="col-md-4 col-sm-6 col-xxs-12 "> 

    <div class="panel panel-primary">

      <div class="panel-heading">

        <center><a href="<?php echo base_url(); ?>socios/Asignarcuota"><strong>ASIGNAR CUOTA ORDINARIA</strong></a></center>

      </div>

      <div class="panel-body">

       <center>  

       <a href="<?php echo base_url(); ?>socios/Asignarcuota">

       <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/asigCuota.png"></a>

   </center>

      </div>

    </div>

   </div>   

   </div>

</div>

</div>





</body>

</html>

<script type="text/javascript">

 $( "#btnactivo" ).click(function() {

   var estado = 0;

    $('#contenido').hide();

   // $('#mostrar').show();

        $('#mostrar').html('<div><img style="width:100%" src="<?php  echo base_url()?>assets/images/loading.gif"/></div>');

            

        $.post("<?php  echo base_url()?>socios/inicio/mostrarcantidad", {

         estado:estado

         },

            function(data){

            $("#mostrar").html(data);           

          //  $("#valores").css("display","block")        

         

             });     

});



$( "#btninactivo" ).click(function() {

  var estado = 4;

    $('#contenido').hide();

   // $('#mostrar').show();

       $('#mostrar').html('<div><img style="width:100%" src="<?php  echo base_url()?>assets/images/loading.gif"/></div>');

            

        $.post("<?php  echo base_url()?>socios/inicio/mostrarcantidad", {

         estado:estado

         },

            function(data){

            $("#mostrar").html(data);           

          //  $("#valores").css("display","block")        

         

             });     

});



$( "#btnbaja" ).click(function() {

//rut=$('#rut_socio').val();  

  //alert(rut);

    var estado = 1;

   

    $('#contenido').hide();

   // $('#mostrar').show();

    $('#mostrar').html('<div><img style="width:100%" src="<?php  echo base_url()?>assets/images/loading.gif"/></div>');

            

        $.post("<?php  echo base_url()?>socios/inicio/mostrarcantidad", {

          estado:estado

         },

            function(data){

            $("#mostrar").html(data);           

          //  $("#valores").css("display","block")        

         

             });     

});



</script>