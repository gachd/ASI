<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="UTF-8">

  <title>Document</title>

  <?php echo form_open(base_url() . 'socios/nuevo_socio/newsocio'); ?>

  <?php echo validation_errors(); ?>

</head>

<style>
  .error {
    display: block;
  }

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



  .legend-dep {
    margin: 3px;

    font-size: 12px;

    width: unset;

    font-weight: 700;

    padding: 6px;

    border: none
  }

  .fieldset-dep {
    border: 1px solid silver;

    padding: 5px;
  }

  label {
    margin-top: 5px;
  }

  .tbl-afiliacion {
    color: #353535;

    font-size: 10px;

    text-transform: capitalize;

    border: 1px #b9b6b6 solid;

  }

  .n_registro {

    text-align: center;



  }



  .n_registro input {

    height: 10px;

  }



  .card-title {
    border-left: 3px solid #4b7006;

    color: #4b7006;

    margin: 5px 0px 5px 0px;

    padding: 10px;

    font-weight: 600;

    text-transform: uppercase;

  }







  .bs-callout {

    /*padding: 20px;*/

    padding: 0px 10px;

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

    float: left;



  }



  .tbl-datos {
    font-size: 11px;
    text-transform: uppercase;
  }

  .pat {
    font-size: 10px;
  }

  .box-pat {
    max-height: 127px;

    overflow: auto;
  }

  .box-pat>ul {
    padding-left: 5px;
  }

  .box-pat>ul>li>a {
    color: #333;
  }





  /*tab panel*/

  .nav-tabs {
    border-bottom: 2px solid #DDD;
  }

  .nav-tabs>li.active>a,
  .nav-tabs>li.active>a:focus,
  .nav-tabs>li.active>a:hover {
    border-width: 0;
  }

  .nav-tabs>li>a {
    border: none;
    color: #ffffff;
    background: #4b7006;
    height: 50px;
  }

  .nav-tabs>li.active>a,
  .nav-tabs>li>a:hover {
    border: none;
    color: #4b7006 !important;
    background: #fff;
  }

  .nav-tabs>li>a::after {
    content: "";
    background: #4b7006;
    height: 2px;
    position: absolute;
    width: 100%;
    left: 0px;
    bottom: -1px;
    transition: all 250ms ease 0s;
    transform: scale(0);
  }

  .nav-tabs>li.active>a::after,
  .nav-tabs>li:hover>a::after {
    transform: scale(1);
  }

  .tab-nav>li>a::after {
    background: #4b7006 none repeat scroll 0% 0%;
    color: #fff
  }

  .tab-pane {
    padding: 15px 0;
  }

  .tab-content {
    padding: 20px;
    overflow: hidden;
  }

  .nav-tabs>li {
    width: 16%;
    text-align: center;
  }

  .card {
    background: #FFF none repeat scroll 0% 0%;
    box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3);
    margin-bottom: 30px;
  }





  @media all and (max-width:724px) {

    .nav-tabs>li>a>span {
      display: none;
    }

    .nav-tabs>li>a {
      padding: 5px 5px;
    }

  }



  table.registro_socios {
    font-size: 12px;
  }

  table.registro_socios tbody {
    text-align: center;
  }

  .r_coorp {
    text-align: left;
  }



  .historial {
    max-height: 240px;

    overflow: overlay;
  }

  table.historial_coorp {
    width: 100%;
    font-size: 12px;
  }

  table.historial_coorp th {

    vertical-align: bottom;

    border-bottom: 2px solid #dee2e6;

    color: #555555;

    padding: 1.05rem 0.75rem;

    text-transform: capitalize;

    letter-spacing: 1px;

  }



  table.historial_coorp tr {
    padding-bottom: 20px;
  }

  table.historial_coorp tr:last-child {

    border-bottom: none;

  }

  table.historial_coorp td {
    border-top: 1px solid #ccc;

    padding: 1.05rem 0.75rem;
  }



  table.datos_coorp {
    font-size: 12px;
    text-transform: capitalize;
  }

  table.datos_coorp td {
    padding: 4px 3px;
  }



  .n_accion {
    font-size: 50px;

    text-align: center;

  }



  .desc_accion {
    border-right: none;
    border-left: none;
  }



  .desc_accion .list-group-item:first-child {
    border-radius: none;
  }



  /*==================================================

 * left tab

 * ===============================================*/







  .tabs-left>.nav-tabs {

    float: left;

    /*margin-right: 19px;*/

    border: none;

  }



  .tabs-below>.nav-tabs,
  .tabs-right>.nav-tabs,
  .tabs-left>.nav-tabs {

    border-bottom: 0;

  }



  .tabs-left>.nav-tabs>li,
  .tabs-right>.nav-tabs>li {

    float: none;

    text-align: left;

    width: 100%;

  }



  .tabs-left>.nav-tabs>li>a {

    margin-right: -1px;

    -webkit-border-radius: 4px 0 0 4px;

    -moz-border-radius: 4px 0 0 4px;

    border-radius: 4px 0 0 4px;

  }

  .tabs-left>.nav-tabs>li>a,
  .tabs-right>.nav-tabs>li>a {

    min-width: 74px;

    margin-right: 0;

    margin-bottom: 3px;

    background-color: #4b7006;

    border-radius: 0px;

    color: white;

    font-size: 11px;

  }



  .tabs-left>.nav-tabs .active>a,
  .tabs-left>.nav-tabs .active>a:hover,
  .tabs-left>.nav-tabs .active>a:focus {

    border-color: #ddd transparent #ddd #ddd;

    background-color: #fff;

    color: dimgrey;

    border: none;

  }



  .left-tab-process .tab-content {

    background-color: #fff;

    margin-left: 131px;

    padding: 0px 15px;
  }



  .tab-content>.active,
  .pill-content>.active {

    display: block;

  }



  .book-process-ltab {

    max-width: 131px;
  }



  .left-tab-process .tab-pane {

    padding: 0px 1px;

    min-height: 442px;

  }



  .left-tab-process h4 {

    color: #536779;
  }







  .term-fa {

    margin-right: 7px;

    font-size: 11px;

    margin-left: -18px;

    color: #2EA72F;
  }



  .tac-content {

    background-color: #ccc;
  }





  .det_accion {
    border-right: none;

    border-left: none;
  }



  table#reg_accion thead>tr>td {
    background: #f5f5f5;

    text-transform: uppercase;

    font-size: 11px;

    vertical-align: inherit;
  }

  table#cargas thead>tr>td {
    background: #f5f5f5;

    text-transform: uppercase;

    font-size: 11px;

    vertical-align: inherit;
  }



  table#cargas tbody>tr>td {
    font-size: 10px;
  }

  table#tablacargas tbody>tr>td {
    font-size: 12px;
  }



  .bloqueado {
    color: #9a9a99;
    background: yellow;
  }



  /*==================================================

 * left tab

 * ===============================================*/













  /*==================================================

 * left tab

 * ===============================================*/



  @media (max-width:768px) {

    .tabs-left>.nav-tabs>li>a,
    .tabs-right>.nav-tabs>li>a {

      width: 95px;

      margin-right: 0;

      padding: 5px 8px;

      font-size: 12px;

      margin-bottom: 3px;

      background-color: #536779;

      border-radius: 0px;

      color: white;

    }



    .left-tab-process .tab-pane {

      padding: 13px 11px;

      min-height: 335px;

    }



    .left-tab-process .tab-content {

      background-color: #F1F1F1;

      margin-left: 95px;

    }

  }







  /*==================================================

}

}

 * left tab

 * ===============================================


*/

  #det_pagos td {
    background: #e10000 !important;
    color: white;
    font-weight: bold;
    padding: 5px;
    font-size: 18px;
    font-weight: 700;
  }
</style>

<body>



  <?php echo form_open(base_url() . 'socios/pago_cuota/ano');

  echo form_open(base_url() . 'socios/pago_cuota/metodo_pago');

  echo validation_errors(); ?>



  <div class="main">

    <div class="container-fluid">

      <div class="row">

        <div class="col-sm-6">

          <div class="panel panel-default">

            <div class="panel-heading" style="overflow: hidden;">

              <div class="col-sm-1">

                <label for="">RUT</label>

              </div>

              <div class="col-md-6">

                <input autocomplete="on" type="text" class="form-control" name="rut_socio" id="rut_socio" placeholder="Ej: 11111111-1" value="<?php echo set_value('rut_socio'); ?>"> <span id="rut_socio" style="display:none;color:red;">Rut incorrecto</span></td>

              </div>

              <div class="col-md-4">



                <button id="enviar" type="button" class="btn btn-success">Buscar</button>



              </div>





            </div>



          </div>

        </div>

        <div class="col-sm-6">

          <div class="panel panel-default">

            <div class="panel-heading" style="overflow: hidden;">

              <div class="col-md-6">

                <table>

                  <tbody>

                    <tr>

                      <td><button disabled="disabled" type="button" id="pagar" class="btn btn-primary">Pagar</button></td>

                      <td><button disabled="disabled" type="button" id="detalle" class="btn btn-danger">Ver Detalle</button></td>



                    </tr>

                  </tbody>

                </table>

              </div>

            </div>

          </div>

        </div>

      </div>





    </div>









    <div class="container-fluid">



      <div class="row">

        <div class="col-sm-6">

          <div class="panel panel-default">

            <div class="panel-heading" style="overflow: hidden;">

              <div id="datos_socios"></div>

            </div>

          </div>

        </div>

        <div class="col-sm-6">

          <div class="panel panel-default">

            <div class="panel-heading" style="overflow: hidden;">

              <div style="display:none;" id="cuotas">

                <table>

                  <thead>

                    <th colspan="3">Cuota Ordinaria</th>

                  </thead>

                  <tbody>

                    <tr>

                      <td width="8px">Año:</td>

                      <td width="25%"><select class="form-control" name="ano" id="ano" width="5%">

                          <option value="0">Seleccionar</option>

                          <?php

                          foreach ($ano as $row_ano) {

                            $id = $row_ano->ano;

                            echo ' <option value="' . $id . '">' . $id . '</option>';
                          }

                          ?>

                        </select></td>

                      <td>Semestre:</td>

                      <td> <select class="form-control" name="sem" id="sem">

                          <option value="0"> Seleccionar </option>

                          <option value="1">1</option>

                          <option value="2">2</option>



                        </select> </td>

                    </tr>

                  </tbody>

                </table>

                <div style="display:none;" id="valor">

                  <div id="alerta" style="display:none;" class="alert alert-danger">

                    <strong>Error!</strong> NO EXISTE CUOTA ASOCIADA.

                  </div>

                </div>



              </div>

            </div>

          </div>

        </div>



      </div>

    </div>











    <div class="container-fluid">

      <div class="row">

        <div class="panel panel-default" id="pagos" style="display:none;">

          <div class="panel-body">



            <div class="alert alert-success" id="alerta2">

              <button type="button" class="close" data-dismiss="alert">x</button>

              <strong>Correcto! </strong>

              Pago realizado exitosamente

            </div>



          </div>

          <center>
            <h2>Módulo Pago Cuota Ordinaria</h2>
          </center>



          <table class="table table-bordered">

            <tbody>

              <tr>

                <td>Total Pagado</td>

                <td><input type="text" class="form-control" name="monto" id="monto"></td>
                <span id="errorMonto" style="display:none;color:red;">Monto debe ser numero</span>

                <td>Método de Pago</td>

                <td><select class="form-control" name="met_pago" id="met_pago" width="5%">

                    <option value="0">Seleccionar</option>

                    <?php

                    foreach ($met_pago as $row_mp) {

                      $nombre = $row_mp->nombre_mp;

                      $id_mp = $row_mp->idmetodo_pago;

                      echo ' <option value="' . $id_mp . '">' . $nombre . '</option>';
                    }

                    ?>

                  </select></td>

                <td>Nº Documento</td>

                <td><input type="text" class="form-control" name="num_doc" id="num_doc"></td>

              </tr>

              <tr>

                <td>Fecha de Pago</td>

                <td><input class="form-control w_fecha" type="text" name="fecha_pago" id="fecha_pago" value="<?php echo set_value('fecha_pago'); ?>"></td>

                <td>Observación</td>

                <td colspan="3"><textarea id="obs_pago" class="form-control" rows="3"></textarea></td>

              </tr>

              <tr>

                <td colspan="6"><button id="btn_pago" type="button" class="btn btn-warning">Aceptar</button></td>

              </tr>



            </tbody>

          </table>



        </div>

      </div>

    </div>



    <div class="container-fluid">

      <div class="row">

        <div class="panel panel-default" id="det_pagos" style="display:none;">

          <div class="panel-body">





          </div>

        </div>

      </div>

    </div>



  </div>

  </div>



  <?php echo form_close(); ?>

</body>

</html>

<script src="<?php echo base_url(); ?>assets/js/autocomplete.js"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery.redirect.min.js"></script>

<script type="text/javascript">
  var socios = [

    <?php

    $socios = $this->model_socios->allSoocios();

    foreach ($socios as $s) {

      echo '"' . $s->prsn_rut . '",';
    }

    ?>

  ];



  autocomplete(document.getElementById("rut_socio"), socios);

  $.datepicker.regional['es'] = {

    closeText: 'Cerrar',

    prevText: '<Ant',

    nextText: 'Sig>',

    currentText: 'Hoy',

    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],

    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],

    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],

    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],

    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],

    weekHeader: 'Sm',

    dateFormat: 'yy/mm/dd',

    firstDay: 1,

    isRTL: false,

    showMonthAfterYear: false,

    yearSuffix: ''

  };

  $.datepicker.setDefaults($.datepicker.regional['es']);

  $(function() {

    $("#txt_fecha").datepicker();

  });

  $(function() {

    $("#nac_carga").datepicker();

  });

  $(function() {

    $("#fecha_pago").datepicker();

  });



  $(document).ready(function() {

    $("#alerta2").hide();



    $("#sem").change(function() {

      $('#asigCuota').remove();

      $("#alerta").fadeOut();

      $("#valor").css("display", "grid");

      $('#met_pago').prop('selectedIndex', 0);

      $("#pagos").css("display", "none");

      $("#det_pagos").css("display", "none");

      $('#tableID').remove();

      $("#sem option:selected").each(function() {

        sem = $('#sem').val();

        ano = $('#ano').val();

        rut = $('#rut_socio').val();

        $.post("<?php echo base_url() ?>socios/pago_cuota/valor_cuota", {

          sem: sem,

          ano: ano,

          rut: rut
        }, function(data) {

          var valores = eval(data);
          if (valores[0] == 0) {

            var valor_formateado = valores[1];

            var fecha_emi = valores[2];

            var fecha_vnto = valores[3];

            var es_cuota = valores[4];

            var estado = valores[5];



            jQuery('#monto').keyup(function(tecla) {

              var monto = $('#monto').val();

              var filtro = /^([0-9]{9}$)/;

              //if(tecla.charCode < 48 || tecla.charCode > 57) 

              if (!filtro.test(monto)) {

                if (!(monto < 48 || monto > 57)) {

                  //alert('Please provide a valid email address');

                  monto = $('#monto').val('');

                  $('#errorMonto').show();



                  //return false;

                } else {

                  $('#errorMonto').hide()

                }

              } else {

                $('#errorMonto').hide()

              }

            });


            $("#detalle").prop("disabled", false);



            // $("#valor").html(data);

            $("#valor").append($('<table>').attr({
              id: 'tableID',
              class: 'table-bordered table-striped'
            }));

            $("#tableID").append($('<tbody>')

              .append($('<tr>')

                .append($('<td>')

                  .append($('<label>').text('Valores')

                  )

                )

              )

            );

            $('#tableID > tbody > tr').append('<td>$' + valor_formateado + '</td>');

            $('#tableID > tbody ').append('<tr><td>Emisión</td><td>' + fecha_emi + '</td></tr>');

            $('#tableID > tbody ').append('<tr><td>Vencimiento</td><td>' + fecha_vnto + '</td></tr>');

            if (estado == 1) {

              $("#pagar").prop("disabled", 'disabled');

              $('#tableID > tbody ').append('<tr><td>Estado</td><td>Pagado</td></tr>');

            } else {

              $("#pagar").prop("disabled", false);

              $('#tableID > tbody ').append('<tr><td>Estado</td><td id="estado" data="' + estado + '">No Pagado</td></tr>');

            }

            $("#valor").css("display", "grid");



          } else {

            $("#alerta").fadeIn(1500);

            $("#pagar").prop("disabled", 'disabled');

            $("#detalle").prop("disabled", 'disabled');

            $("#valor").after($('<button>').attr({
              id: 'asigCuota',
              class: 'btn btn-success',
              type: 'button'
            }).text('Asignar Cuota'));

            //$("#alerta").fadeOut(5000);

          }



        });

      });

    })

    $("#ano").change(function() {

      $('#sem').prop('selectedIndex', 0);

      $('#met_pago').prop('selectedIndex', 0);

      $("#valor").css("display", "none");

      $("#pagos").css("display", "none");

      $("#det_pagos").css("display", "none");

      $("#pagar").prop("disabled", true);

      $("#detalle").prop("disabled", true);





    })

  });



  $("#enviar").click(function() {

    $("#detalle").prop("disabled", true);

    $("#pagar").prop("disabled", true);

    $('#sem').prop('selectedIndex', 0);

    $('#ano').prop('selectedIndex', 0);

    $('#met_pago').prop('selectedIndex', 0);

    $("#cuotas").css("display", "none");

    $("#pagos").css("display", "none");

    $("#det_pagos").css("display", "none");

    $("#valor").css("display", "none");

    $('#datos_socios').html('<div><img src="<?php echo base_url() ?>assets/images/loading.gif"/></div>');

    rut = $('#rut_socio').val();



    $.post("<?php echo base_url() ?>socios/Pago_cuota/mostrar_socio", {

        rut_socio: rut

      },

      function(data) {

        $("#datos_socios").html(data);

        //  $("#valores").css("display","block")



        $("#cuotas").css("display", "block");

      });

  });



  $("#pagar").click(function() {



    $('#monto').val('');

    $('#fecha_pago').val('');

    $('#met_pago').val('');

    $('#num_doc').val('');

    $('#obs_pago').val('');

    //  $('#pagos').html('<div><img src="<?php echo base_url() ?>assets/images/loading.gif"/></div>');

    var otraDiv = $("<div>").attr({
      id: 'pagos'
    });

    var es = $("#estado").attr("data");



    if (es == 0) {



      $("#pagos").css("display", "grid");

      $("#det_pagos").css("display", "none");

      rut = $('#rut_socio').val();

      sem = $('#sem').val();

      ano = $('#ano').val();



      // $.post("<?php echo base_url() ?>socios/pago_cuota/mostrar_socio", {

      rut_socio: rut





    } else {

      alert('Cuota Pagada');

    }



  });



  //});



  $("#detalle").click(function() {



    $("#det_pagos").html('<div><img src="<?php echo base_url() ?>assets/images/loading.gif"/></div>');

    $("#det_pagos").css("display", "grid");

    $("#pagos").css("display", "none");

    rut = $('#rut_socio').val();

    sem = $('#sem').val();

    ano = $('#ano').val();



    $.post("<?php echo base_url() ?>socios/pago_cuota/detalle_cuotas", {

      sem: sem,

      ano: ano,

      rut: rut
    }, function(data) {

      $("#det_pagos").html(data);



      $("#det_pagos").css("display", "block");



    });



  });





  $('#cargar_cuotas').click(function() {



    url = "<?php echo base_url() ?>socios/ficha/cargar_cuotas";

    window.open(url, '_blank');







  });

  $("#btn_pago").click(function() {
    var monto1 = document.getElementById('monto').value.length;
    var fecha1 = document.getElementById('fecha_pago').value.length;
    var met_pago1 = document.getElementById('met_pago').value.length;
    var doc1 = document.getElementById('num_doc').value.length;
    var obs1 = document.getElementById('obs_pago').value.length;


    if (monto1 == 0 || fecha1 == 0 || $('#met_pago').val().trim() === '' || doc1 == 0) {

      alert('Complete todos los campos');



      $('#btn_pago').attr('href', 'javascript:void(0)');



    } else {


      // $('#pagos').html('<div><img src="<?php echo base_url() ?>assets/images/loading.gif"/></div>');

      rut = $('#rut_socio').val();

      monto = $('#monto').val();

      fecha = $('#fecha_pago').val();

      met_pago = $('#met_pago').val();

      doc = $('#num_doc').val();

      obs = $('#obs_pago').val();

      sem = $('#sem').val();

      ano = $('#ano').val();



      $.post("<?php echo base_url() ?>socios/pago_cuota/pagar_cuota", {

          rut: rut,

          monto: monto,

          fecha: fecha,

          met_pago: met_pago,

          doc: doc,

          obs: obs,

          sem: sem,

          ano: ano
        },

        function(data) {

          //$("#pagos").html(data);

          $("#alerta2").fadeTo(2000, 500).slideUp(500, function() {

            $("#alerta2").slideUp(500);

          });

          // $("#alerta2").fadeOut(1500);   



          setTimeout('redirreccionar()', 3000);







          //  $("#valores").css("display","block")           

        });
    }
  });


  function redirreccionar() {



    //  $("#pagos").css("display","none"); 

    btnEnviar = $("#enviar");

    btnEnviar.click();

  }

  $(document).on("click", "#asigCuota", function() {

    //$(this).next().toggle();

    // window.location='<?php echo base_url() ?>socios/Asignarcuota';

    rut = $('#rut_socio').val();



    $.redirect('<?php echo base_url() ?>socios/Asignarcuota/buscarsocio', {
      'rutSocio': rut,
      'paso': 1
    });

  });
</script>