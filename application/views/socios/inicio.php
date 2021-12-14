<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>Socios</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/view/styleInicio.css">
</head>

<body>



  <div class="main">

    <div class="container">



      <div class="row">

        <h1>Módulo Socios</h1>

      </div>

      <div class="well row estado">

        <div class="col-md-4 col-sm-6 col-xxs-12">

          <center><img src="<?php echo base_url(); ?>assets/images/activo.png">

            <button id="btnactivo" class="label label-success">

              <span class="badge"><?php echo $activos['num_rows']; ?></span> Activos</button>
          </center>

        </div>

        <div class="col-md-4 col-sm-6 col-xxs-12">

          <center><img src="<?php echo base_url(); ?>assets/images/inactivo.png">

            <button class="label label-warning" id="btninactivo">

              <span class="badge"><?php echo $inactivos['num_rows']; ?></span> Inactivos

            </button>
          </center>

        </div>

        <div class="col-md-4 col-sm-6 col-xxs-12">

          <center><img src="<?php echo base_url(); ?>assets/images/baja.png">

            <button id="btnbaja" class="label label-danger">

              <span class="badge"><?php echo $baja['num_rows']; ?></span> Bajas

            </button>
          </center>

        </div>

      </div>

      <div class="row" id="mostrar"> </div>



      <div class="well row socios" id="contenido">

        <div class="col-md-4 col-sm-6 col-xxs-12 ">

          <center>

            <a class="btn" href="<?php echo base_url(); ?>socios/m_socios"><img class="img-responsive" type="button" src="<?php echo base_url(); ?>assets/images/socio.png"></a>

          </center>

          <center><button onclick="location.href='<?php echo base_url(); ?>socios/m_socios'" type="button" class="btn-socio"><strong>MANTENEDOR <br> SOCIOS</strong></button></center>



        </div>

        <div class="col-md-4 col-sm-6 col-xxs-12">

          <center>

            <a class="btn" href="<?php echo base_url(); ?>socios/m_cargas"><img class="img-responsive" type="button" src="<?php echo base_url(); ?>assets/images/cargas.png"></a>

          </center>

          <center><button onclick="location.href='<?php echo base_url(); ?>socios/m_cargas'" type="button" class="btn-cargas"><strong>MANTENEDOR <br> CARGAS</strong></button></center>



        </div>

        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xxs-12">

          <center>

            <a class="btn" href="<?php echo base_url(); ?>socios/m_cuotas"><img class="img-responsive" type="button" src="<?php echo base_url(); ?>assets/images/cuotas.png"></a>

          </center>

          <center><button onclick="location.href='<?php echo base_url(); ?>socios/m_cuotas'" type="button" class="btn-cuota"><strong>MANTENEDOR <br> CUOTA ORDINARIA</strong></button></center>



        </div>

        <div class="col-md-4 col-sm-6 col-xxs-12">

          <center>

            <a class="btn" href="<?php echo base_url(); ?>socios/m_resoluciones"><img class="img-responsive" type="button" src="<?php echo base_url(); ?>assets/images/resoluciones.png"></a>

          </center>

          <center><button onclick="location.href='<?php echo base_url(); ?>socios/m_resoluciones'" type="button" class="btn-res"><strong>RESOLUCIONES</strong></button></center>

        </div>

        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xxs-12">

          <center>

            <a class="btn" href="<?php echo base_url(); ?>socios/m_pagos"><img class="img-responsive" type="button" src="<?php echo base_url(); ?>assets/images/pagosocio.png"></a>

          </center>

          <center><button onclick="location.href='<?php echo base_url(); ?>socios/m_pagos'" type="button" class="btn-pago"><strong>PAGOS</strong></button></center>

        </div>

        <div class="col-md-4 col-sm-6 col-xxs-12">

          <center>

            <a class="btn" href="<?php echo base_url(); ?>socios/Graficoedad"><img class="img-responsive" type="button" src="<?php echo base_url(); ?>assets/images/estadisticas.png"></a>

          </center>

          <center><button onclick="location.href='<?php echo base_url(); ?>socios/Graficoedad'" type="button" class="btn-estadistica"><strong>ESTADISTICAS</strong></button></center>

        </div>

        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xxs-12">

          <center>

            <a class="btn" href="<?php echo base_url(); ?>socios/informes"><img class="img-responsive" type="button" src="<?php echo base_url(); ?>assets/images/informe.png"></a>

          </center>

          <center><button onclick="location.href='<?php echo base_url(); ?>socios/informes'" type="button" class="btn-informe"><strong>INFORMES</strong></button></center>

        </div>


        <div class="col-md-4 col-sm-6 col-xxs-12">

          <center>

            <a class="btn" href="<?php echo base_url(); ?>socios/socios"><img class="img-responsive" type="button" src="<?php echo base_url(); ?>assets/images/socio.png"></a>

          </center>

          <center><button onclick="location.href='<?php echo base_url(); ?>socios/socios'" type="button" class="btn-cargas"><strong>LISTADO DE SOCIOS</strong></button></center>

        </div>


        <div class="col-md-4 col-sm-6 col-xxs-12">

          <center>

            <a class="btn" href="<?php echo base_url(); ?>socios/fitness"><img class="img-responsive" type="button" src="<?php echo base_url(); ?>assets/images/mancuernas.png"></a>

          </center>

          <center><button onclick="location.href='<?php echo base_url(); ?>socios/fitness'" type="button" class="btn-socio"><strong>FITNESS</strong></button></center>

        </div>
        <div class="clearfix visible-sm-block"></div>
        <div></div>





      </div>

    </div>

  </div>

</body>

</html>

<script type="text/javascript">

  
  $("#btnactivo").click(function() {

    var estado = 0;

    $('#contenido').hide();

    // $('#mostrar').show();

    $('#mostrar').html('<div class = "spinner"></div>');



    $.post("<?php echo base_url() ?>socios/inicio/mostrarcantidad", {

        estado: estado

      },

      function(data) {

        $("#mostrar").html(data);

        //  $("#valores").css("display","block")        



      });

  });



  $("#btninactivo").click(function() {

    var estado = 4;

    $('#contenido').hide();

    // $('#mostrar').show();

    $('#mostrar').html('<div class = "spinner"></div>');



    $.post("<?php echo base_url() ?>socios/inicio/mostrarcantidad", {

        estado: estado

      },

      function(data) {

        $("#mostrar").html(data);

        //  $("#valores").css("display","block")        



      });

  });



  $("#btnbaja").click(function() {

    //rut=$('#rut_socio').val();  

    //alert(rut);

    var estado = 1;



    $('#contenido').hide();

    // $('#mostrar').show();

    $('#mostrar').html('<div class = "spinner"></div>');



    $.post("<?php echo base_url() ?>socios/inicio/mostrarcantidad", {

        estado: estado

      },

      function(data) {
        console.log(data);

        $("#mostrar").html(data);

        //  $("#valores").css("display","block")        



      });

  });
</script>