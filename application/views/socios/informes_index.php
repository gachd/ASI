<?php

$this->load->model('model_informe');

function getSexo($sexo)
{

  if ($sexo == 1) {
    return ("Masculino");
  }
  if ($sexo == 0) {
    return ("Femenino");
  }
}

function getPuntosRut($rut)
{
  if (!empty($rut)) {

    $rutTmp = explode("-", $rut);

    return number_format($rutTmp[0], 0, "", ".") . '-' . $rutTmp[1];
  }
}

function getParentestco($id)
{

  if ($id == 1) {
    return ("CONYUGE");
  }
  if ($id == 2) {
    return ("HIJO/A");
  }
  if ($id == 3) {
    return ("PADRE");
  }
  if ($id == 4) {
    return ("MADRE");
  }
  if ($id == 5) {
    return ("HIJASTRO");
  }
  if ($id == 6) {
    return ("OTRO FAMILIAR");
  }
}

if ($this->session->flashdata('rango')) {

  echo '<script>

      toastr.warning("Rango no valido");
      
      </script>    
      
      ';
}

if ($this->session->flashdata('carga')) {

  echo '<script>

      toastr.warning("No se econtraron datos");
      
      </script>    
      
      ';
}
if ($this->session->flashdata('socio') == 'vacia') {

  echo '<script>

      toastr.warning("No se econtraron datos");
      
      </script>    
      
      ';
}
if ($this->session->flashdata('socio') == 'exito') {

  echo '<script>

      toastr.success("Informe generado");
      
      </script>    
      
      ';
}






?>

<head>

  <meta charset="UTF-8">

  <title>Infomes Socios</title>




</head>

<div class="main" style="padding-top: 50px;">

  <div class="container well">

    <form action="<?php echo base_url(); ?>socios/InformesSocio/reportes" method="post">

      <div class="row panel">

        <div class="col-md-3">
          <div id="infome">
            <label>Infome</label>
            <div class="form-group">
              <select id="informe" name="infomeExcel" class="form-control" required>

                <option value="" selected>Seleccionar</option>
                <option value="socio" selected>Socios</option>
                <option value="carga" selected>Carga</option>

              </select>
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div id="genero">
            <label>Genero</label>
            <div class="form-group">
              <select id="genero" name="genero" class="form-control" required>

                <option value="" selected>Seleccionar</option>
                <option value="ambos" selected>Ambos</option>
                <option value="hombre" selected>Hombre</option>
                <option value="mujer" selected>Mujer</option>

              </select>
            </div>
          </div>
        </div>


        <div class="col-md-2">
          <div id="inicio">
            <label>Desde</label>
            <div class="form-group">
              <input class="form-control" required type="number" name="min" id="min">
            </div>
          </div>
        </div>


        <div class="col-md-2">
          <div id="termino">
            <label>hasta</label>
            <div class="form-group">
              <input class="form-control" type="number" name="max" id="max">
            </div>
          </div>
        </div>


        <div class="col-md-12 text-center">

          <div class="form-group">
            <input id="Excel" class="btn btn-primary" type="submit" name="" id="" value="Generar Excel " data-loading-text="Generando...">

          </div>

        </div>


      </div>

    </form>

  </div>






  <div class="container well">
    <h3 class="well"><strong>Informes Edades</strong></h3>


    <div class="col-md-3 well">

      <label for="">Corporacion</label>
      <select name="corp" id="corp" class="form-control" required>
        <option value="">Seleccionar...</option>
        <option value="1">Consolidado</option>
        <option value="2">Stadio Italiano Di Concepción</option>
        <option value="3">Scuola Italiana Di Concepcion</option>
        <option value="4">Centro Italiano De Concepcion</option>
        <option value="5">Stadio Atletico Italiano</option>
        <option value="6">Sociedad Italiana De Socorros Mutuos</option>
      </select>

    </div>



    <div class="col-md-2 well">

      <label for="">Tipo Persona</label>
      <select name="persona" id="persona" class="form-control" required>

        <option value="">Seleccionar...</option>
        <option value="1">Socios + Cargas</option>
        <option value="2">Socio</option>
        <option value="3">Carga</option>

      </select>

    </div>


    <div id="div_genero" class="col-md-2 well" style="display:none">

      <label for="">Genero</label>
      <select name="sexo" id="sexo" class="form-control" required>

        <option value="">Seleccionar...</option>
        <option value="1">Ambos</option>
        <option value="2">Hombre</option>
        <option value="3">Mujer</option>

      </select>

    </div>


    <div class="col-md-2 ">



      <div id="div_edad_socio" style="display:none" class="well">
        <label for="">Edad</label>

        <select name="edad_socio" id="edad_socio" class="form-control" required>

          <option value="">Seleccionar...</option>
          <option value="1">Personalizado</option>
          <option value="2">Mayor que</option>
          <option value="3">Menor que</option>
          <option value="4">[18-30]</option>
          <option value="5">[31-40]</option>
          <option value="6">[41-50]</option>
          <option value="7">[51-60]</option>
          <option value="8">[61-70]</option>
          <option value="9">[71-80]</option>
          <option value="10">[81-90]</option>
          <option value="11">[91-100]</option>
          <option value="12">[101-110]</option>

        </select>

      </div>

      <div id="div_edad_carga" style="display:none" class="well">
        <label for="">Edad</label>

        <select name="edad_carga" id="edad_carga" class="form-control" required>

          <option value="">Seleccionar...</option>
          <option value="1">Personalizado</option>
          <option value="2">Mayor que</option>
          <option value="3">Menor que</option>
          <option value="4">[0-10]</option>
          <option value="5">[11-18]</option>
          <option value="6">[19-28]</option>
          <option value="7">[28-40]</option>
          <option value="8">[41-50]</option>
          <option value="9">[61-70]</option>
          <option value="10">[71-80]</option>
          <option value="11">[81-90]</option>
          <option value="12">[91-100]</option>

        </select>

      </div>





    </div>

    <div class="col-md-2">


      <div id="div_desde" style="display:none" class="well">

        <label>Desde</label>
        <input class="form-control" required type="number" name="minimo" id="minimo">

        <label>hasta</label>
        <input class="form-control" type="number" name="maximo" id="maximo">
      </div>

      <div id="div_mayor" style="display:none" class="well">
        <label>Mayor que </label>
        <input class="form-control" required type="number" name="mayor" id="mayor">
      </div>

      <div id="div_menor" style="display:none" class="well">

        <label>Menor que</label>
        <input class="form-control" type="number" name="menor" id="menor">
      </div>



    </div>

    <div class="col-md-12 text-center">

      <div class="form-group">


      </div>

      <div class="form-group" ">
        <!-- <a href=" #!" id="vista" class="btn btn-danger ">Ver</a> -->
        <div class="" style="max-width: 100px;margin: auto;">
          <a href="#!" id="pdf" class="btn btn-danger" style="width: 100%; margin: auto; max-width: 100x;">PDF</a>

        </div>



      </div>


    </div>
  </div>







  <div class="container well">
    <h3 class="well"><strong>Informes por Estados</strong></h3>
    <strong></strong>

    <?php


  //  $sql =  $activos = $this->model_informe->estados_sociosHistorico("65106820-7", "1", "2001-09-20", "2021-09-20", "0");

    //var_dump($sql);





    ?>

    <div class="col-md-3 well">

      <label for="">Corporacion</label>
      <select name="corpFechas" id="corpFechas" class="form-control" required>
        <option value="">Seleccionar...</option>
        <option value="1">Consolidado</option>
        <option value="2">Stadio Italiano Di Concepción</option>
        <option value="3">Scuola Italiana Di Concepcion</option>
        <option value="4">Centro Italiano De Concepcion</option>
        <option value="5">Stadio Atletico Italiano</option>
        <option value="6">Sociedad Italiana De Socorros Mutuos</option>
      </select>

    </div>

    <div class="col-md-2 well">

      <label for="">Tipo</label>
      <select name="Incorporaciones" id="IncorporacionesFecha" class="form-control" required>
        <option value="">Seleccionar...</option>
        <option value="1">Incorporaciones</option>
        <option value="2">Bajas</option>
      </select>

    </div>



    <div class="col-md-2 well">

      <label>Desde</label>
      <div class="">
        <input class="form-control" type="text" name="desdeFecha" id="desdeFecha" style="background-color: white;" autocomplete="off" readonly>
      </div>
    </div>

    <div class="col-md-2 well">
      <label>Hasta</label>
      <div class="">
        <input class="form-control" type="text" name="hastaFecha" id="hastaFecha" style="background-color: white;" autocomplete="off" readonly>
      </div>

    </div>


    <div class="col-md-2 well">

      <label for="Estado_socio">Estado Actual</label>
      <select name="Incorporaciones" id="estado_socio" class="form-control" required>
        <option value="">Seleccionar...</option>
        <option value="0">Activo</option>
        <option value="1">Inactivo</option>
        <option value="2">Todos</option>
      </select>

    </div>

    <div class="col-md-12 text-center">

      <div class="form-group">


      </div>

      <div class="form-group">
        <!-- <a href=" #!" id="vista" class="btn btn-danger ">Ver</a> -->
        <div class="" style="max-width: 100px;margin: auto;">
          <a href="javascript:void(0)" id="FechasPDF" class="btn btn-danger" style="width: 100%; margin: auto; max-width: 100x;">PDF</a>

        </div>



      </div>

      
      
    </div>
    
    
    
    
  </div>
  









  <div class="container well div-wrapper">
    <h1 class="h2">Tablas</h1>

    <table class="table table-bordered table-hover panel tablaVista" id="tablaVista">

    </table>
  </div>




  <div class="container well div-wrapper">


    <h1 class="h1">Socios</h1>

    <table class="table table-bordered table-hover panel gridJQuery ">
      <thead>
        <tr>


          <th>Rut</th>
          <th>Nombre</th>
          <th>Edad</th>
          <th>Sexo</th>

        </tr>


      </thead>


      <?php foreach ($socios as $s) : ?>

        <tr>



          <td><?php echo getPuntosRut($s->prsn_rut) ?></td>
          <td><?php echo $s->prsn_nombres . " " . $s->prsn_apellidopaterno . " " . $s->prsn_apellidomaterno ?></td>
          <td><?php echo $s->edad ?></td>
          <td><?php echo getSexo($s->prsn_sexo) ?></td>




        </tr>
      <?php endforeach ?>


    </table>




  </div>





  <div class="container well div-wrapper">
    <div class="">
      <h1 class="h1">Cargas</h1>
      <div class="" style="padding-top: 15px;">
        <table class="table table-bordered table-hover panel gridJQuery" style="width:100%">
          <thead>
            <tr>

              <th>Rut</th>
              <th>Nombre</th>
              <th>Edad</th>
              <th>Sexo</th>
              <th>Socio</th>
              <th>Parentesco</th>

            </tr>


          </thead>


          <?php foreach ($cargas as $s) : ?>

            <tr>


              <td><?php echo getPuntosRut($s->rut_carga) ?></td>
              <td><?php echo $s->prsn_nombres . " " . $s->prsn_apellidopaterno . " " . $s->prsn_apellidomaterno ?></td>
              <td><?php echo $s->edad ?></td>
              <td><?php echo getSexo($s->prsn_sexo) ?></td>
              <td><?php echo getPuntosRut($s->rut_socio) ?></td>
              <td><?php echo getParentestco($s->s_parentesco_pt_id) ?></td>

            </tr>

          <?php endforeach ?>


        </table>

      </div>
    </div>
  </div>





</div>


<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/chartJS/Chart.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<!-- <script src="https://code.jquery.com/jquery.js"></script> -->
<!-- jQuery UI -->
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->


<script src="<?php echo base_url(); ?>/assets/vendors/datatables/js/jquery.dataTables.min.js"></script>

<script src="<?php echo base_url(); ?>/assets/vendors/datatables/dataTables.bootstrap.js"></script>

<script src="<?php echo base_url(); ?>/assets/js/custom.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/tables.js"></script>
<!-- Latest compiled and minified CSS -->


<script type="text/javascript">
  $.datepicker.regional['es'] = {
    closeText: 'Cerrar',
    prevText: '< Ant',
    nextText: 'Sig >',
    currentText: 'Hoy',
    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércole xs', 'Jueves', 'Viernes', 'Sábado'],
    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
    weekHeader: 'Sm',
    dateFormat: 'dd/mm/yy',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''
  };





  $(function() {
    $.datepicker.setDefaults($.datepicker.regional['es']);

    $('#desdeFecha, #hastaFecha').datepicker({
      changeMonth: true,
      changeYear: true,
      maxDate: +0,
      yearRange: "-100:+0",
      beforeShow: rangoCustom,
      dateFormat: "yy-mm-dd",
    });

  });

  function rangoCustom(input) {

    if (input.id == 'hastaFecha') {
      var minDate = new Date($('#desdeFecha').val());

      minDate.setDate(minDate.getDate() + 1)

      return {
        minDate: minDate

      };
    }

    return {}

  }








  $(document).ready(function() {

    $('.gridJQuery').DataTable({

      "responsive": true,

      "oLanguage": {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst": "Primero",
          "sLast": "Último",
          "sNext": "Siguiente",
          "sPrevious": "Anterior"
        },
        "oAria": {
          "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
      }
    });






  });

  $("#Pantalla").click(function() {


    $("#tablaVista").removeClass('tablaVista');
    $("#tablaVista").empty();
    cargarDatos();


  });

  function tablaJQ() {
    $('.tablaVista').DataTable({

      "responsive": true,

      "oLanguage": {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst": "Primero",
          "sLast": "Último",
          "sNext": "Siguiente",
          "sPrevious": "Anterior"
        },
        "oAria": {
          "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
      }
    });


  }




  function cargarDatos() {


    var fecha1 = '2002-05-01';
    var fecha2 = '2020-08-02';
    var tipo = 1;

    console.log(fecha1)
    console.log(fecha2)
    console.log(tipo)




    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>accionistas/inicio/informe_fechas_accionistas",
      data: {

        fecha1: fecha1,
        fecha2: fecha2,
        tipoinforme: tipo,
      },


      success: function(response) {

        console.log(response);
        console.log(response.length);

        if (response.length > 4) {

          //mostrar bajas

          if (tipo == 0) {

            var datos = JSON.parse(response);

            $("#tablaVista").append(
              '<th><td>Nombre</td>' +
              '<td>Apellido paterno</td>' +
              '<td>Baja</td>' +
              '<td>Estado</td></th>');


            console.log(datos)
            for (i = 0; i < datos.length; i++) {

              $("#tablaVista").append('<tr>' +
                '<td>' + datos[i].prsn_nombres + '</td>' +
                '<td>' + datos[i].prsn_apellidopaterno + '</td>' +
                '<td>' + datos[i].fecha_baja + '</td>' +
                '<td>' + datos[i].estado_accionista + '</td>' + '</tr>');
            }

          }

          //Mostrar incorporaciones
          if (tipo == 1) {

            var datos = JSON.parse(response);

            $("#tablaVista").append(
              '<thead><<th>Nombre</th>' +
              '<th>Apellido paterno</th>' +
              '<th>Incorporacion</th>' +
              '<th>Estado</th></thead>');

            console.log(datos)
            for (i = 0; i < datos.length; i++) {

              $("#tablaVista").append('<tr>' +
                '<td>' + datos[i].prsn_nombres + '</td>' +
                '<td>' + datos[i].prsn_apellidopaterno + '</td>' +
                '<td>' + datos[i].fecha + '</td>' +
                '<td>' + datos[i].estado_accionista + '</td>' + '</tr>');
            }
            $("#tablaVista").addClass('tablaVista');
            tablaJQ();


          }

        } else {

          swal({
            title: "No se encontraron registros",
            icon: "info",
            button: "OK",
          });
        }
      },
      error: function() {

        $("#tablaVista").append(

          '<thead>' +
          '<tr><td>Nombre</td>' +
          '<td>Apellido paterno</td>' +
          '<td>Incorporacion</td>' +
          '<td>Estado</td>' +
          '</thead>' +
          ' <tr><td>xax </td> aa <td> aa </td><td></td><td></td></tr>'
        );


        swal({
          title: "Error",
          icon: "error",
          button: "OK",
        });

      }
    });
  }



  $('#persona').on('change', function() {

    $('#div_edad_socio').hide();
    $('#div_edad_carga').hide();
    $('#div_mayor').hide();
    $('#div_menor').hide();
    $('#div_desde').hide();


    $("#edad_socio").val("");
    $("#edad_carga").val("");






    if (this.value == 1) {
      $('#div_edad_socio').hide();
      $('#div_genero').hide();
    }
    if (this.value == 2) {
      $('#div_edad_socio').show();
      $('#div_genero').show();
    }
    if (this.value == 3) {
      $('#div_edad_carga').show();
      $('#div_genero').show();
    }
  })


  $('#edad_socio').on('change', function() {

    $('#div_desde').hide();
    $('#div_mayor').hide();
    $('#div_menor').hide();

    $("#minimo").val("");
    $("#mayor").val("");

    $("#maximo").val("");
    $("#menor").val("");



    if (this.value == 1) {
      $('#div_desde').show();
    }
    if (this.value == 2) {
      $('#div_mayor').show();
    }
    if (this.value == 3) {
      $('#div_menor').show();
    }
    if (this.value == 4) {
      $("#minimo").val("18");
      $("#maximo").val("30");
    }
    if (this.value == 5) {
      $("#minimo").val("31");
      $("#maximo").val("40");
    }
    if (this.value == 6) {
      $("#minimo").val("41");
      $("#maximo").val("50");
    }
    if (this.value == 7) {
      $("#minimo").val("51");
      $("#maximo").val("60");
    }
    if (this.value == 8) {
      $("#minimo").val("61");
      $("#maximo").val("70");
    }
    if (this.value == 9) {
      $("#minimo").val("71");
      $("#maximo").val("80");
    }
    if (this.value == 10) {
      $("#minimo").val("81");
      $("#maximo").val("90");
    }
    if (this.value == 11) {
      $("#minimo").val("91");
      $("#maximo").val("100");
    }
    if (this.value == 12) {
      $("#minimo").val("101");
      $("#maximo").val("110");
    }




  })
  $('#edad_carga').on('change', function() {

    $('#div_desde').hide();
    $('#div_mayor').hide();
    $('#div_menor').hide();


    $("#minimo").val("");
    $("#mayor").val("");
    $("#maximo").val("");
    $("#menor").val("");





    if (this.value == 1) {
      $('#div_desde').show();
    }
    if (this.value == 2) {
      $('#div_mayor').show();
    }
    if (this.value == 3) {
      $('#div_menor').show();
    }

    if (this.value == 4) {
      $("#minimo").val("0");
      $("#maximo").val("10");
    }
    if (this.value == 5) {
      $("#minimo").val("11");
      $("#maximo").val("18");
    }
    if (this.value == 6) {
      $("#minimo").val("19");
      $("#maximo").val("28");
    }
    if (this.value == 7) {
      $("#minimo").val("29");
      $("#maximo").val("40");
    }
    if (this.value == 8) {
      $("#minimo").val("41");
      $("#maximo").val("50");
    }
    if (this.value == 9) {
      $("#minimo").val("61");
      $("#maximo").val("70");
    }
    if (this.value == 10) {
      $("#minimo").val("71");
      $("#maximo").val("80");
    }
    if (this.value == 11) {
      $("#minimo").val("81");
      $("#maximo").val("90");
    }
    if (this.value == 12) {
      $("#minimo").val("91");
      $("#maximo").val("100");
    }



  })



  var corp;
  var persona;
  var sexo;
  var edad_socio;
  var edad_carga;
  var min;
  var max;
  var mayor;
  var menor;




  $("#pdf").click(function() {
    corp = $("#corp option:selected").val();
    persona = $("#persona option:selected").val();
    sexo = $("#sexo option:selected").val();
    edad_socio = $("#edad_socio option:selected").val();
    edad_carga = $("#edad_carga option:selected").val();

    min = $("#minimo").val();
    max = $("#maximo").val();
    mayor = $("#mayor").val();
    menor = $("#menor").val();

    if (corp != '') {


      if (persona != '') {

        switch (persona) {

          case "1":

            if (corp == '1') {
              url = "<?php echo base_url(); ?>socios/InformesSocio/sociocarga_pdf/" + corp;

              console.log(url);
              window.open(url);

        


            }
            if (corp == '2') {
              url = "<?php echo base_url(); ?>socios/InformesSocio/sociocarga_pdf/" + corp;
              console.log(url);
              window.open(url, '_blank');


            }
            if (corp == '2') {
              url = "<?php echo base_url(); ?>socios/InformesSocio/sociocarga_pdf/" + corp;
              console.log(url);
              window.open(url, '_blank');

            }
            if (corp == '3') {
              url = "<?php echo base_url(); ?>socios/InformesSocio/sociocarga_pdf/" + corp;
              console.log(url);
              window.open(url, '_blank');

            }
            if (corp == '4') {
              url = "<?php echo base_url(); ?>socios/InformesSocio/sociocarga_pdf/" + corp;
              console.log(url);
              window.open(url, '_blank');

            }
            if (corp == '5') {
              url = "<?php echo base_url(); ?>socios/InformesSocio/sociocarga_pdf/" + corp;
              console.log(url);
              window.open(url, '_blank');

            }
            if (corp == '6') {
              url = "<?php echo base_url(); ?>socios/InformesSocio/sociocarga_pdf/" + corp;
              console.log(url);
              window.open(url, '_blank');

            }





            break;

          case "2":

            if (sexo != '') {


              if (edad_socio != '') {



                switch (edad_socio) {

                  case "1":

                    if (min == '' || max == '' || max < min) {

                      alert('Ingrese rango valido');

                    } else {


                      console.log('Corp: ' + corp, 'Persona:' + persona, 'sexo: ' + sexo, 'edad_socio: ' + edad_socio, 'rango de: ' + min + ' hasta:' + max);

                      url = "<?php echo base_url(); ?>socios/InformesSocio/rangoSocio_pdf/" + corp + "/" + sexo + "/" + min + "/" + max;
                      window.open(url, '_blank');





                    }


                    break;
                  case "2":


                    if (mayor == '') {

                      alert('Ingrese Mayor que');


                    } else {



                      console.log('Corp: ' + corp, 'Persona:' + persona, 'sexo: ' + sexo, 'edad_socio: ' + edad_socio, 'Mayor que:' + mayor);

                      url = "<?php echo base_url(); ?>socios/InformesSocio/mayorSocio_pdf/" + corp + "/" + sexo + "/" + mayor;
                      window.open(url, '_blank');


                    }
                    break;
                  case "3":

                    if (menor == '' || menor < 1) {


                      if (menor == '') {

                        alert('Ingrese Mayor que');
                      }


                      if (menor < 1) {
                        alert('Debe ser mayor a 1');

                      }




                    } else {


                      console.log('Corp: ' + corp, 'Persona:' + persona, 'sexo: ' + sexo, 'edad_socio: ' + edad_socio, 'Menor que:' + menor);
                      url = "<?php echo base_url(); ?>socios/InformesSocio/menorSocio_pdf/" + corp + "/" + sexo + "/" + menor;
                      window.open(url, '_blank');


                    }

                    break;
                  case "4":

                    console.log('Corp: ' + corp, 'Persona:' + persona, 'sexo: ' + sexo, 'edad_socio: ' + edad_socio, 'rango de: ' + min + ' hasta:' + max);

                    url = "<?php echo base_url(); ?>socios/InformesSocio/rangoSocio_pdf/" + corp + "/" + sexo + "/" + min + "/" + max;
                    window.open(url, '_blank');


                    break;
                  case "5":

                    console.log('Corp: ' + corp, 'Persona:' + persona, 'sexo: ' + sexo, 'edad_socio: ' + edad_socio, 'rango de: ' + min + ' hasta:' + max);

                    url = "<?php echo base_url(); ?>socios/InformesSocio/rangoSocio_pdf/" + corp + "/" + sexo + "/" + min + "/" + max;
                    window.open(url, '_blank');
                    break;
                  case "6":
                    console.log('Corp: ' + corp, 'Persona:' + persona, 'sexo: ' + sexo, 'edad_socio: ' + edad_socio, 'rango de: ' + min + ' hasta:' + max);
                    url = "<?php echo base_url(); ?>socios/InformesSocio/rangoSocio_pdf/" + corp + "/" + sexo + "/" + min + "/" + max;
                    window.open(url, '_blank');
                    break;
                  case "7":
                    console.log('Corp: ' + corp, 'Persona:' + persona, 'sexo: ' + sexo, 'edad_socio: ' + edad_socio, 'rango de: ' + min + ' hasta:' + max);
                    url = "<?php echo base_url(); ?>socios/InformesSocio/rangoSocio_pdf/" + corp + "/" + sexo + "/" + min + "/" + max;
                    window.open(url, '_blank');
                    break;
                  case "8":
                    console.log('Corp: ' + corp, 'Persona:' + persona, 'sexo: ' + sexo, 'edad_socio: ' + edad_socio, 'rango de: ' + min + ' hasta:' + max);
                    url = "<?php echo base_url(); ?>socios/InformesSocio/rangoSocio_pdf/" + corp + "/" + sexo + "/" + min + "/" + max;
                    window.open(url, '_blank');
                    break;
                  case "9":
                    console.log('Corp: ' + corp, 'Persona:' + persona, 'sexo: ' + sexo, 'edad_socio: ' + edad_socio, 'rango de: ' + min + ' hasta:' + max);
                    url = "<?php echo base_url(); ?>socios/InformesSocio/rangoSocio_pdf/" + corp + "/" + sexo + "/" + min + "/" + max;
                    window.open(url, '_blank');
                    break;
                  case "10":
                    console.log('Corp: ' + corp, 'Persona:' + persona, 'sexo: ' + sexo, 'edad_socio: ' + edad_socio, 'rango de: ' + min + ' hasta:' + max);
                    url = "<?php echo base_url(); ?>socios/InformesSocio/rangoSocio_pdf/" + corp + "/" + sexo + "/" + min + "/" + max;
                    window.open(url, '_blank');
                    break;
                  case "11":
                    console.log('Corp: ' + corp, 'Persona:' + persona, 'sexo: ' + sexo, 'edad_socio: ' + edad_socio, 'rango de: ' + min + ' hasta:' + max);
                    url = "<?php echo base_url(); ?>socios/InformesSocio/rangoSocio_pdf/" + corp + "/" + sexo + "/" + min + "/" + max;
                    window.open(url, '_blank');
                    break;
                  case "12":
                    console.log('Corp: ' + corp, 'Persona:' + persona, 'sexo: ' + sexo, 'edad_socio: ' + edad_socio, 'rango de: ' + min + ' hasta:' + max);
                    url = "<?php echo base_url(); ?>socios/InformesSocio/rangoSocio_pdf/" + corp + "/" + sexo + "/" + min + "/" + max;
                    window.open(url, '_blank');
                    break;

                }



              } else {
                alert("Seleccione Edad")
              }




            } else {

              alert("Seleccione Genero")

            }





            break;



          case "3":
            if (sexo != '') {


              if (edad_carga != '') {


                switch (edad_carga) {
                  case "1":


                    if (min == '' || max == '' || max < min) {

                      alert('Ingrese rango valido');

                    } else {

                      console.log('Corp: ' + corp, 'Persona:' + persona, 'sexo: ' + sexo, 'edad_carga: ' + edad_carga, 'rango de: ' + min + ' hasta:' + max);



                      url = "<?php echo base_url(); ?>socios/InformesSocio/rangoCarga_pdf/" + corp + "/" + sexo + "/" + min + "/" + max;
                      window.open(url, '_blank');





                    }


                    break;

                  case "2":


                    if (mayor == '') {

                      alert('Ingrese Mayor que');


                    } else {

                      console.log('Corp: ' + corp, 'Persona:' + persona, 'sexo: ' + sexo, 'edad_carga: ' + edad_carga, 'Mayor que: ' + mayor);

                      url = "<?php echo base_url(); ?>socios/InformesSocio/mayorCarga_pdf/" + corp + "/" + sexo + "/" + mayor;
                      window.open(url, '_blank');



                    }
                    break;

                  case "3":

                    if (menor == '' || menor < 1) {


                      if (menor == '') {

                        alert('Ingrese Menor que');
                      } else {
                        alert('Debe ser mayor a 1');

                      }




                    } else {

                      console.log('Corp: ' + corp, 'Persona:' + persona, 'sexo: ' + sexo, 'edad_carga: ' + edad_carga, 'Menor que: ' + menor);

                      url = "<?php echo base_url(); ?>socios/InformesSocio/menorCarga_pdf/" + corp + "/" + sexo + "/" + menor;
                      window.open(url, '_blank');





                    }

                    break;
                  case "4":
                    console.log('Corp: ' + corp, 'Persona:' + persona, 'sexo: ' + sexo, 'edad_carga: ' + edad_carga, 'rango de: ' + min + ' hasta:' + max);

                    url = "<?php echo base_url(); ?>socios/InformesSocio/rangoCarga_pdf/" + corp + "/" + sexo + "/" + min + "/" + max;
                    window.open(url, '_blank');

                    break;
                  case "5":
                    console.log('Corp: ' + corp, 'Persona:' + persona, 'sexo: ' + sexo, 'edad_carga: ' + edad_carga, 'rango de: ' + min + ' hasta:' + max);

                    url = "<?php echo base_url(); ?>socios/InformesSocio/rangoCarga_pdf/" + corp + "/" + sexo + "/" + min + "/" + max;
                    window.open(url, '_blank');

                    break;
                  case "6":
                    console.log('Corp: ' + corp, 'Persona:' + persona, 'sexo: ' + sexo, 'edad_carga: ' + edad_carga, 'rango de: ' + min + ' hasta:' + max);

                    url = "<?php echo base_url(); ?>socios/InformesSocio/rangoCarga_pdf/" + corp + "/" + sexo + "/" + min + "/" + max;
                    window.open(url, '_blank');

                    break;
                  case "7":
                    console.log('Corp: ' + corp, 'Persona:' + persona, 'sexo: ' + sexo, 'edad_carga: ' + edad_carga, 'rango de: ' + min + ' hasta:' + max);

                    url = "<?php echo base_url(); ?>socios/InformesSocio/rangoCarga_pdf/" + corp + "/" + sexo + "/" + min + "/" + max;
                    window.open(url, '_blank');

                    break;
                  case "8":
                    console.log('Corp: ' + corp, 'Persona:' + persona, 'sexo: ' + sexo, 'edad_carga: ' + edad_carga, 'rango de: ' + min + ' hasta:' + max);

                    url = "<?php echo base_url(); ?>socios/InformesSocio/rangoCarga_pdf/" + corp + "/" + sexo + "/" + min + "/" + max;
                    window.open(url, '_blank');

                    break;
                  case "9":
                    console.log('Corp: ' + corp, 'Persona:' + persona, 'sexo: ' + sexo, 'edad_carga: ' + edad_carga, 'rango de: ' + min + ' hasta:' + max);

                    url = "<?php echo base_url(); ?>socios/InformesSocio/rangoCarga_pdf/" + corp + "/" + sexo + "/" + min + "/" + max;
                    window.open(url, '_blank');

                    break;
                  case "10":
                    console.log('Corp: ' + corp, 'Persona:' + persona, 'sexo: ' + sexo, 'edad_carga: ' + edad_carga, 'rango de: ' + min + ' hasta:' + max);

                    url = "<?php echo base_url(); ?>socios/InformesSocio/rangoCarga_pdf/" + corp + "/" + sexo + "/" + min + "/" + max;
                    window.open(url, '_blank');

                    break;
                  case "11":
                    console.log('Corp: ' + corp, 'Persona:' + persona, 'sexo: ' + sexo, 'edad_carga: ' + edad_carga, 'rango de: ' + min + ' hasta:' + max);

                    url = "<?php echo base_url(); ?>socios/InformesSocio/rangoCarga_pdf/" + corp + "/" + sexo + "/" + min + "/" + max;
                    window.open(url, '_blank');

                    break;
                  case "12":
                    console.log('Corp: ' + corp, 'Persona:' + persona, 'sexo: ' + sexo, 'edad_carga: ' + edad_carga, 'rango de: ' + min + ' hasta:' + max);

                    url = "<?php echo base_url(); ?>socios/InformesSocio/rangoCarga_pdf/" + corp + "/" + sexo + "/" + min + "/" + max;
                    window.open(url, '_blank');

                    break;


                }



              } else {
                alert("Seleccione Edad")
              }



            } else {

              alert("Seleccione Genero")

            }



            break;

        } //fin swicht     

      } else {

        alert("Seleccione Persona")

      }

    } else {

      alert("Seleccione Corporacion")

    }






  });








  $("#FechasPDF").click(function() {

    toastr.options = {
      "closeButton": true,
      "debug": false,
      "showDuration": "300",
      "timeOut": "2500",
    }

    var corpFecha = $("#corpFechas option:selected").val();
    var tipoFecha = $("#IncorporacionesFecha option:selected").val();

    var estado = $("#estado_socio option:selected").val();
    var desdeFecha = $("#desdeFecha").val();
    var hastaFecha = $("#hastaFecha").val();







    if (corpFecha) {

      if (tipoFecha) {

        if (desdeFecha) {

          if (hastaFecha) {

            if (estado) {

              url = "<?php echo base_url(); ?>socios/InformesSocio/FechaEstado_pdf/" + corpFecha + "/" + tipoFecha + "/" + desdeFecha + "/" + hastaFecha + "/" + estado;
              console.log(url);
              window.open(url, '_blank');
                    
            

             

            } else {
              toastr.warning('Seleccione el estado')
            }




          } else {

            toastr.warning('Seleccione hasta cual fecha')
          }



        } else {

          toastr.warning('Seleccione Fecha Inicio')
        }






      } else {

        toastr.warning('Seleccione Tipo de Informe')
      }

    } else {

      toastr.warning('Seleccione Corporacion')
    }



  });
</script>