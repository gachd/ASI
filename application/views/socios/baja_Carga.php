<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="UTF-8">

  <title>Document</title>

</head>

<style>
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



  .condiciones td {

    width: 25%
  }



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



  /*==================================================

 * left tab

 * ===============================================*/



  #estado {

    width: 30px;

  }



  #nomCarga {

    font-size: 30px;

  }

  #datosCarga {

    font-size: 18px;

  }

  #datosCarga span {

    font-size: 18px;

  }







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

 * left tab

 * ===============================================
</style>

<body>



  <?php

  setlocale(LC_ALL, 'es_ES') . ': ';



  if (!empty($datos)) {

    foreach ($datos as $dp) {

      $rut = $dp->prsn_rut;

      $nombre = $dp->prsn_nombres;

      $ap_paterno = $dp->prsn_apellidopaterno;

      $ap_materno = $dp->prsn_apellidomaterno;

      $fecha_nacimiento = $dp->prsn_fechanacimi;

      $email = $dp->prsn_email;

      $telefono = $dp->prsn_fono_casa;

      $celular = $dp->prsn_fono_movil;

      $fono_job = $dp->prsn_fono_trabajo;

      $profesion = $dp->prsn_profesion;

      $direccion_job = $dp->prsn_direccion_empresa;

      $empresa_job = $dp->prsn_empresa;

      $sexo = $dp->prsn_sexo;

      $descendiente = $dp->prsn_descendiente;

      $direccion = $dp->prsn_direccion;

      $poblacion = $dp->prsn_sectorvive;

      $com_nombre = $dp->comuna_nombre;

      $com_id = $dp->comuna_id;

      $provincia = $dp->provincia_nombre;

      $region = $dp->region_nombre;

      $ecivil_nomb = $dp->estacivil_nombre;

      $ecivil_id = $dp->estacivil_id;

      $nacnombre = $dp->nac_nombre;

      $nacid = $dp->nac_id;

      $condlab_id = $dp->condlab_id;

      $condlab_nomb = $dp->condlab_nombre;

      $nacimiento = $dp->prsn_nac;

      $depor = $dp->int_deport;







      $deportes = explode(",", $depor);

      $validar = array(0, 0, 0, 0, 0, 0, 0);

      for ($i = 0; $i < count($deportes); $i++) {

        $indice = intval($deportes[$i]) - 1;

        $validar[$indice] = 1;
      }
    }



    if ($sexo == 1) {

      $sexo_txt = "Masculino";

      $sexo2 = 0;

      $sexo_2 = "Femenino";
    } else {

      $sexo_txt = "Femenino";

      $sexo2 = 1;

      $sexo_2 = "Masculino";
    }

    //   if(!empty($direccion)){$direccion_txt= $direccion.', ';}

    //   if(!empty($poblacion)){$poblacion_txt= $poblacion.', ';}





  }

  if (!empty($datos)) {

    foreach ($sociosDatos as $sd) {

      $cond_id = $sd->cond_id;

      $cond_nom = $sd->nombCond;

      $cond2_id = $sd->cond2_id;

      $cond2_nom = $sd->nombCond2;

      $tipo_id = $sd->tipo_id;

      $tipo_nom = $sd->nombTipo;

      $subcond = $sd->id_subcond;

      $subcond_nom = $sd->nombSub;
    }
  }



  ?>





  <div class="panel panel-default">

    <div class="panel-heading" style="overflow: hidden;">



      <div class="col-md-8">

        <div class="panel panel-default">

          <div class="panel-heading" style="background-color:#4b7006;color: white; "><label>SOCIO</label></div>

          <div class="panel-body">

            <div class="col-md-3">

              <img style="width: 70%" alt="User Pic" src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" id="profile-image1" class="img-circle img-responsive">



            </div>

            <div class="col-md-9">

              <form class="form-inline">

                <div class="form-group">

                  <label style="font-size: 25px"><?php echo $rut ?></label>

                  <input type="hidden" name="rutSocio" id="rutSocio" value="<?php echo $rut ?>">

                </div>

                <div class="form-group">

                  <label style="font-size: 22px"><?php echo $nombre ?> <?php echo $ap_paterno ?> <?php echo $ap_materno ?></label>

                </div>

                <div class="form-group span">

                  <label>RUT CARGA</label>

                  <select class="form-control" name="cargas" id="cargas" onchange="">

                    <option value="0">SELECCIONAR</option>

                    <?php

                    foreach ($cargas as $cg) {

                      echo ' <option value="' . $cg->prsn_rut . '">' . $cg->prsn_rut . '</option>';

                      // echo '<input type="hidden" name="C_parentesco" value="'.$i->prsn_rut.'">';



                    } ?>



                  </select>

                </div>

              </form>

            </div>

          </div>

        </div>

      </div>

      <div class="col-md-4">

        <div class="panel panel-default">

          <div class="panel-heading" style="background-color:#4b7006;color: white; "><label>CORPORACIONES</label></div>

          <div class="panel-body">

            <table width="100%" border="1" class="tbl-afiliacion">

              <thead>

                <tr>
                  <th width="80%">Corporación</th>

                  <th width="20%">Nº Registro</th>
                </tr>

              </thead>

              <tbody>

                <?php

                if (!empty($corporaciones)) {

                  foreach ($corporaciones as $c) {

                    $rut_corp = $c->co_rut;

                    if ($rut_corp <> "96942660-9") {

                      echo '<tr>

                               <td class="r_coorp">' . $c->co_nombre . ' </td>';



                      $corp = $this->model_socios->socio_corp($rut, $rut_corp);

                      //var_dump($corp);

                      if (!empty($corp)) {

                        foreach ($corp as $ci) {

                          $ci_n_registro = $ci->n_registro;

                          $ci_libro  = $ci->n_libro;

                          $ci_fecha_registro = $ci->fecha_registro;

                          $ci_fecha_retiro = $ci->fecha_retiro;

                          $ci_condicion = $ci->estado;

                          //$ci_color = $ci -> cond_color;

                          $ci_color = '#1bbd1b';



                          echo '<td>' . $ci_n_registro . '</td>';
                        }

                        echo '</tr>';
                      } else {

                        echo '<td>-</td>';
                      }
                    }
                  }
                }

                ?>

              </tbody>

            </table>

          </div>

        </div>

      </div>

    </div>

    <div class="panel-body">

      <div class="container-fluid">

        <div class="row">

          <div class="col-md-12">

            <!-- Nav tabs -->



            <ul class="nav nav-tabs" role="tablist">

              <li role="presentation" id="tipo_socio">

                <a href="" aria-controls="settings" role="tab" data-toggle="tab">

                  <i class="fa fa-plus-square-o"></i> 

                  <span>DAR DE BAJA CARGA</span>

                </a>

              </li>

            </ul>

          </div>

        </div>

        <!-- Tab panes -->

        <div class="row" id="contenido">





        </div>

      </div>

    </div>

  </div>













  </div>



  </div>





  </div>









</body>

</html>

<script type="text/javascript">
  $(document).ready(function() {

    $(".deporte").click(function(evento) {



      var valor = $(this).val();



      if (valor == 'deporte_no') {



        $("#div2").css("display", "none");

      } else {



        $("#div2").css("display", "block");

      }

    });



    if ($('.deporte').prop('checked')) {



      $("#div2").css("display", "block");

    }

  });



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

    $("#nacCarga").datepicker();

  });







  $(document).ready(function() {

    $("select[name=cargas]").change(function() {



      var rut_carga = $('select[name=cargas]').val();

      var rut_socio = $('#rutSocio').val();



      $.post("<?php echo base_url() ?>socios/bajacarga/datosCarga", {

          rutCarga: rut_carga,

          rutSocio: rut_socio

        },

        function(data) {

          $("#contenido").html(data)

          //        $("#edit_socios").html(data);           

          //  $("#valores").css("display","block")        



        });



      // $('input[name=valor1]').val($(this).val());

    });
  });
</script>