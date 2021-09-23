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

  .tbl-afiliacion {
    color: #353535;

    font-size: 10px;

    text-transform: capitalize;

    border: 1px #b9b6b6 solid;

  }

  .n_registro {
    text-align: center;
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
    color: #fff;
  }

  .tab-pane {
    padding: 15px 0;
  }

  .tab-content {
    padding: 20px;
    overflow: hidden;
  }

  .nav-tabs>li {
    width: 20%;
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



  table#pagos tbody>tr>td {

    text-align: center;

  }

  table#pagos thead>tr>td {

    text-align: center;

  }



  .bloqueado {
    color: #9a9a99;
    background: yellow;
  }



  .fixed {

    position: fixed;

    background: #fff;

    z-index: 10;

    width: 100%;

  }

  .padding {

    padding-top: 70px;

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

    .padding {

      padding-top: 210px;

    }

  }









  /*==================================================

 * left tab

 ===============================================

 */
</style>



<div class="main">

  <div class="container-fluid">

    <div class="row fixed">



      <div class="col-sm-6">

        <div class="panel panel-default">

          <div class="panel-heading" style="overflow: hidden;">

            <div class="col-sm-1">

              <label for="">RUT</label>

            </div>

            <div class="col-md-6">

              <input autocomplete="on" type="text" class="form-control" name="rut_socio" id="rut_socio" placeholder="Ej: 11111111-1" value="<?php echo set_value('rut_socio'); ?>">

              <span id="rut_socio" style="display:none;color:red;">Rut incorrecto</span>

            </div>

            <div class="col-md-4">



              <button id="enviar" type="button" class="btn btn-info">

                <span class="glyphicon glyphicon-search"></span>

              </button>



            </div>

          </div>

          <div style="display:none;" id="msg" class="alert alert-success">¡Bien hecho! se guardo correctamente</div>

        </div>

      </div>

      <div class="col-sm-6">

        <div class="panel panel-default">

          <div class="panel-heading" style="overflow: hidden;">

            <button id="bajaCarg" type="button" class="btn btn-success">GUARDAR</button>

            <a href="<?php echo base_url(); ?>socios/m_cargas" type="button" class="btn btn-info">Volver</a>

          </div>

        </div>

      </div>





    </div>



    <div class="row padding">

      <div id="mostrar">































      </div>

    </div>

  </div>

</div>

</div>



















</div>







<script src="<?php echo base_url(); ?>assets/js/autocomplete.js"></script>

<script type="text/javascript">
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

    $("#txt_fechaS").datepicker();

  });

  $(function() {

    $("#nacCarga").datepicker();

  });

  $(function() {

    $("#fecha_pago").datepicker();

  });

  var socios = [

    <?php

    $socios = $this->model_socios->allSoocios();

    foreach ($socios as $s) {

      echo '"' . $s->prsn_rut . '",';
    }

    ?>

  ];



  autocomplete(document.getElementById("rut_socio"), socios);



  $("#enviar").click(function() {

    rut = $('#rut_socio').val();



    //alert(rut);

    //    $('#edit_socios').html('<div><img src="<?php echo base_url() ?>assets/images/loading.gif"/></div>');



    $.post("<?php echo base_url() ?>socios/bajacarga/mostrar_datos", {

        rut: rut

      },

      function(data) {

        $("#mostrar").html(data)

        //        $("#edit_socios").html(data);           

        //  $("#valores").css("display","block")        



      });

  });
</script>