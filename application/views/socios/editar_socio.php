<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="UTF-8">

  <title>Document</title>

</head>

<style>
  @media only screen and (min-width: 0px) and (max-width: 550px) {


    .td_reponsive {
      display: inline-block;
      padding: 3px;
      width: 100%;
    }


  }

  .bs-callout-green h4 {

    color: #4b7006;

  }


  /* Linea de color verde en el borde de las columnas  */

  .bs-callout-green {

    border-left: 5px solid #4b7006;


  }


  .nav-tabs>li>a {
    border: none;
    color: #ffffff;
    background: #4b7006;
    height: 50px;
    border-left-color: #4b7006;
    font-size: 14px;
  }


  .nav-tabs>li>a:hover {
    border: none;
    color: #fff;
    background: #73ab0a;

  }

  .nav-tabs>li.active>a {

    border: none;
    color: #4b7006;
    background: #fff;


  }

  /* deshabilita el boton de las pestañas  */
  .inactivo {
    pointer-events: none;
    cursor: default;
  }





  /* Color a los input radio  */

  input[type='radio']:after {
    width: 15px;
    height: 15px;
    border-radius: 15px;
    top: -2px;
    left: -1px;
    position: relative;
    background-color: #d1d3d1;
    content: '';
    display: inline-block;
    visibility: visible;
    border: 2px solid white;
  }

  input[type='radio']:checked:after {
    width: 15px;
    height: 15px;
    border-radius: 15px;
    top: -2px;
    left: -1px;
    position: relative;
    background-color: #4b7006;
    content: '';
    display: inline-block;
    visibility: visible;
    border: 2px solid white;
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

  .condiciones td {

    width: 60%;

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
    background-color: yellow;
  }


  .subida_oculto {
    display: none;
  }

  .img-responsive {

    cursor: pointer;
    object-fit: cover;
    object-position: center center;
    width: 120px;
    height: 120px;

  }

  /*==================================================

 * left tab

 * ===============================================*/













  /*==================================================

 * left tab

 * ===============================================



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
*/




  /*==================================================

 * left tab

 * ===============================================*/
</style>

<body>



  <?php


  function FotoPerfil($dir)
  {

    //valido que se encuentre directorio en base de datos
    if (!empty($dir)) {

      if (is_dir($dir)) {

        $dir = $dir . "/perfil";
        $ignorados = array('.', '..', '.svn', '.htaccess');
        $archivos = array();
        $urlBase = base_url();

        foreach (scandir($dir) as $listado) {

          //validor los elementos oermitidos
          if (!in_array($listado, $ignorados)) {

            //valido que el elemto no sea un directorio
            if (!is_dir($dir . '/' . $listado)) {


              $archivos[$listado] = filemtime($dir . '/' . $listado);
            }
          }
        }
        //ordeno del mas reciente al mas antiguo gracias al filetime
        arsort($archivos);

        $archivos = array_keys($archivos);

        //valido que el directorio no este vacio
        if (empty($archivos)) {

          echo base_url() . "assets/images/camara-icon.png";
        } else {

          //muestro la foto mas reciente

          echo ($urlBase . $dir . '/' . $archivos[0]);
        }
      } else {

        echo base_url() . "assets/images/camara-icon.png";
      }
    } else {
      echo base_url() . "assets/images/camara-icon.png";
    }
  }




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

      $cond_nom = $sd->cond_nombre;

      $cond2_id = $sd->cond2_id;

      $cond2_nom = $sd->cond2_nombre;

      $tipo_id = $sd->tipo_id;

      $tipo_nom = $sd->tipo_nombre;

      $subcond = $sd->subcond;

      $subcond_nom = $sd->subcond_nom;
    }
  }



  ?>





  <div class="panel panel-default">

    <div class="panel-heading" style="overflow: hidden;">

      <div class="col-md-2">
        <center>

          <label for="imagen_perfil">
            <img alt="Foto SOCIO" src="<?php FotoPerfil($socioData->path); ?>" id="img_perfil" class="img-circle img-responsive img-thumbnail">
          </label>
          <div class="subida_oculto">
            <input type="file" name="img_perfil" id="imagen_perfil" accept="image/png,image/jpeg,image/jpg" onchange="ver_foto()">
          </div>


        </center>


      </div>

      <div class="col-md-6">

        <input type="text" id="nombres" name="nombres" value="<?php echo $nombre ?>" class="form-control" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">

        <span id="errorNom" style="display:none;color:red;">incorrecto</span>

        <input type="text" id="paterno" name="paterno" value="<?php echo $ap_paterno ?>" class="form-control" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">

        <span id="errorPat" style="display:none;color:red;">incorrecto</span>

        <input type="text" id="materno" name="materno" value="<?php echo $ap_materno ?>" class="form-control" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">

        <span id="errorMat" style="display:none;color:red;">incorrecto</span>





      </div>

      <div class="col-md-4">

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

      <div class="panel-body">

        <div class="row">

          <div class="col-md-12">

            <!-- Nav tabs -->

            <div class="card">

              <ul class="nav nav-tabs" role="tablist">

                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-list-alt"></i>  <span>Antecedentes Personales</span></a></li>

                <li role="presentation" id="dep"><a href="#depor" id="dep" aria-controls="settings" role="tab" data-toggle="tab"><i class="fa fa-futbol-o"></i>  <span>Intereses Deportivos</span></a></li>



                <li role="presentation" id="carg"><a href="#extra" id="carg" aria-controls="settings" role="tab" data-toggle="tab"><i class="fa fa-plus-square-o"></i>  <span>Cargas Familiares</span></a></li>













              </ul>



              <!-- Tab panes -->

              <div class="tab-content" style="background: #f8f8f8;">



                <div role="tabpanel" class="tab-pane active" id="home">

                  <!-- datos personales -->

                  <div class="bs-callout bs-callout-green col-md-4 panel panel-default">

                    <h4>Datos Personales</h4>

                    <table width="100%" class="table tbl-datos">

                      <tbody>

                        <tr>

                          <td class="td_reponsive" width="31%">Sexo</td>

                          <td class="td_reponsive" width="69%"><select class="form-control" id="sexo" name="sexo">

                              <option value="<?php echo $sexo; ?>"><?php echo $sexo_txt; ?></option>

                              <option value="<?php echo $sexo2; ?>"><?php echo $sexo_2; ?></option>

                            </select>



                        </tr>

                        <tr>

                          <td class="td_reponsive">Fecha de nacimiento</td>

                          <td class="td_reponsive"><input class="form-control w_fecha" type="text" name="txt_fecha" id="txt_fecha" value="<?php echo $fecha_nacimiento; ?>"></td>

                        </tr>

                        <tr>

                          <td class="td_reponsive">Lugar nacimiento</td>

                          <td class="td_reponsive"><input type="text" class="form-control" id="nac" name="nac" value="<?php echo $nacimiento; ?>" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"></td>

                        </tr>



                        <tr>

                          <td class="td_reponsive">Estado civil</td>

                          <td class="td_reponsive">

                            <select class="form-control input-sm" name="estado_civil" id="estadocivil">

                              <option value="<?php echo $ecivil_id; ?>"><?php echo $ecivil_nomb; ?></option>

                              <?php

                              foreach ($estado_civil2 as $es) {

                                if ($es->estacivil_id !=  $ecivil_id) {

                                  echo ' <option value="' . $es->estacivil_id . '" ' . set_select("estado_civil", $es->estacivil_id) . '>' . $es->estacivil_nombre . '</option>';
                                }
                              }

                              ?>

                            </select>

                          </td>

                        </tr>

                        <tr>

                          <td class="td_reponsive">Nacionalidad</td>

                          <td class="td_reponsive"><select class="form-control input-sm" name="nacionalidad" id="nacionalidad">

                              <option value="<?php echo $nacid; ?>"><?php echo $nacnombre; ?></option>

                              <?php

                              foreach ($nac as $n) {

                                if ($n->nac_id !=  $nacid) {

                                  echo ' <option value="' . $n->nac_id . '" ' . set_select("nacionalidad", $n->nac_id) . '>' . $n->nac_nombre . '</option>';
                                }
                              }

                              ?>

                            </select>

                          </td>

                        </tr>

                        <tr>

                          <td class="td_reponsive">Descendiente:</td>

                          <td class="td_reponsive">
                            <div class="form-check">

                              <?php if ($descendiente == 1) { ?>

                                <input class="form-check-input" type="radio" name="descendiente" id="desc1" value="1" checked>

                                <label class="form-check-label" for="desc1">Si</label>

                                <input class="form-check-input" type="radio" name="descendiente" id="desc2" value="0">

                                <label class="form-check-label" for="desc2">No</label>

                              <?php } else { ?>

                                <input class="form-check-input" type="radio" name="descendiente" id="desc1" value="1">

                                <label class="form-check-label" for="desc1">Si</label>

                                <input class="form-check-input" type="radio" name="descendiente" id="desc2" value="0" checked>

                                <label class="form-check-label" for="desc2">No</label>

                              <?php } ?>



                            </div>
                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                  <!--DATOS DE CONTACTO -->

                  <div class="bs-callout bs-callout-green col-md-4 panel panel-default">

                    <h4>Datos de Contacto</h4>

                    <table width="100%" class="table tbl-datos">

                      <tbody>

                        <tr>

                          <td class="td_reponsive" width="31%">Telefono Fijo</td>

                          <td class="td_reponsive" width="69%">

                            <input type="tel" name="telefono" id="tel_fijo" value="<?php echo $telefono ?>" class="form-control">

                            <span id="error2" style="display:none;color:red;">Teléfono incorrecto</span>
                          </td>

                        </tr>

                        <tr>

                          <td class="td_reponsive">Celular</td>

                          <td class="td_reponsive"><input type="tel" name="celular" id="tel_cel" value="<?php echo $celular ?>" class="form-control">

                            <span id="error3" style="display:none;color:red;">Celular incorrecto</span>
                          </td>

                        </tr>

                        <tr>

                          <td class="td_reponsive">Correo</td>

                          <td class="td_reponsive"><input type="email" name="email" id="email" value="<?php echo $email; ?>" class="form-control" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">

                            <span id="error" style="display:none;color:red;">Email incorrecto</span>
                          </td>

                        </tr>

                        <tr>

                          <td class="td_reponsive">Dirección</td>

                          <td class="td_reponsive"><input type="text" name="direccion" id="direccion" class="form-control" value="<?php echo $direccion; ?>" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"></td>

                        </tr>

                        <tr>

                          <td class="td_reponsive">Sector</td>

                          <td class="td_reponsive"><input type="text" name="poblacion" id="sector" class="form-control" value="<?php echo $poblacion; ?>" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"></td>

                        </tr>

                        <tr>

                          <td class="td_reponsive">Comuna</td>

                          <td class="td_reponsive">

                            <select class="form-control input-sm" name="comuna" id="comu">

                              <option value="<?php echo $com_id; ?>"><?php echo $com_nombre; ?></option>

                              <?php

                              foreach ($comuna as $c) {

                                if ($c->comuna_id !=  $com_id) {

                                  echo ' <option value="' . $c->comuna_id . '" ' . set_select("comuna", $c->comuna_id) . '>' . $c->comuna_nombre . '</option>';
                                }
                              }

                              ?>

                            </select>
                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                  <!--DATOS DE trabajo -->

                  <div class="bs-callout bs-callout-green col-md-4 panel panel-default">

                    <h4>Antecedentes Laborales</h4>

                    <table width="100%" class="table tbl-datos">

                      <tbody>

                        <tr>

                          <td class="td_reponsive" width="31%">Situación Laboral</td>

                          <td class="td_reponsive" width="69%">

                            <select class="form-control input-sm" name="situacion_lab" id="laboral">

                              <option value="<?php echo $condlab_id; ?>"><?php echo $condlab_nomb; ?></option>

                              <?php

                              foreach ($condicion_lab as $cl) {

                                if ($cl->condlab_id !=  $condlab_id) {

                                  echo ' <option value="' . $cl->condlab_id . '" ' . set_select("situacion_lab", $cl->condlab_id) . '>' . $cl->condlab_nombre . '</option>';
                                }
                              }

                              ?>

                            </select>
                          </td>

                        </tr>

                        <tr>

                          <td class="td_reponsive">Actividad o Profesión</td>

                          <td class="td_reponsive"><input type="text" name="actividad" id="prof" class="form-control" value="<?php echo $profesion; ?>" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"></td>

                        </tr>

                        <tr>

                          <td class="td_reponsive">Empresa</td>

                          <td class="td_reponsive"><input type="text" name="empresa" id="emp" class="form-control" value="<?php echo $empresa_job; ?>" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"></td>

                        </tr>

                        <tr>

                          <td class="td_reponsive">Dirección</td>

                          <td class="td_reponsive"><input type="text" name="direc_empresa" id="direc_emp" class="form-control" value="<?php echo $direccion_job; ?>" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"></td>

                        </tr>

                        <tr>

                          <td class="td_reponsive">Telefono</td>

                          <td class="td_reponsive"><input type="text" name="fono_empresa" id="tel_emp" class="form-control" value="<?php echo $fono_job; ?>"></td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                  <div class="bs-callout bs-callout-green col-md-6 panel panel-default col-md-offset-3" id="ArchivosAccionista">

                    <label for="arch_socio">Documentos Socio</label>
                    <div class="input-group" id="inputFormRow" style="padding-bottom:10px;">

                      <a href="javascript:void(0);" class="btn btn-primary form-control" id="agregar_archivo">Agregar <i class="glyphicon glyphicon-plus"></i></a>

                    </div>
                    <div id=nuevo_archivo>



                    </div>
                  </div>

                </div>


                <div class="clearfix"></div>



                <div role="tabpanel" class="tab-pane" id="extra">

                  <div class="col-md-12">

                    <div class="panel panel-default">

                      <div class="panel-heading">Datos cargas familiares</div>

                      <div class="panel-body table-responsive">

                        <table width="100%" id="cargas" class="table table-bordered table-hover">

                          <thead>

                            <tr>

                              <td>Estado</td>

                              <td>parentesco</td>

                              <td>rut</td>

                              <td>nombre</td>

                              <td>fecha nacimiento</td>

                              <td>edad</td>

                              <td>telefono</td>

                              <td>mail</td>

                              <td>estudiante</td>

                              <td>certificado<br>

                                alumno regular</td>

                            </tr>

                          </thead>

                          <tbody>

                            <?php

                            //var_dump($cargas);

                            function calculaedad($fechanacimiento)
                            {

                              list($ano, $mes, $dia) = explode("-", $fechanacimiento);

                              $ano_diferencia  = date("Y") - $ano;

                              $mes_diferencia = date("m") - $mes;

                              $dia_diferencia   = date("d") - $dia;

                              if ($dia_diferencia < 0 || $mes_diferencia < 0)

                                $ano_diferencia--;

                              return $ano_diferencia;
                            }



                            foreach ($cargas as $c) {

                              $id_parentesco = $c->s_parentesco_pt_id;

                              $edad = calculaedad($c->prsn_fechanacimi);

                              $bloqueo = $c->estado_carga;

                              $class_bloq = "";

                              $estado = "";

                              if ($bloqueo == 1) {
                                $estado = "Bloqueado";
                              } else {
                                $estado = "Activo";
                              }

                              if (($edad > 18) && ($id_parentesco == 2)) {
                                $class_bloq = "bloqueado";
                              }

                              if ($c->prsn_email == '0') {
                                $email = '-';
                              } else {
                                $email = $c->prsn_email;
                              }

                              if ($c->prsn_fono_movil == 0) {
                                $celu = '-';
                              } else {
                                $celu = $c->prsn_fono_movil;
                              }

                              if ($c->prsn_fono_casa == 0) {
                                $fono = '-';
                              } else {
                                $fono = $c->prsn_fono_casa;
                              }

                              if ($c->estudiante == 1) {
                                $est = 'SI';
                              } else {
                                $est = 'NO';
                              }

                              if ($c->certificado == 1) {
                                $cert = '';
                                $img = '<a target="_blank" href="' . base_url() . '/uploads/' . $c->prsn_rut . '.pdf"><img width="20px" src="' . base_url() . '/assets/images/pdf-flat.png"></a>';
                              } else {
                                $cert = 'NO';
                                $img = '';
                              }

                              echo '<tr class="' . $class_bloq . '">

                                    <td>' . $estado . '</td>

                                    <td>' . $c->pt_nombre . '</td>

                                    <td>' . $c->prsn_rut . '</td>

                                    <td>' . $c->prsn_nombres . ' ' . $c->prsn_apellidopaterno . ' ' . $c->prsn_apellidomaterno . '</td>

                                    <td>' . $c->prsn_fechanacimi . '</td>

                                    <td>' . $edad . '</td>

                                    <td>' . $celu . ' / ' . $fono . '</td>

                                    <td>' . $email . '</td>

                                    <td>' . $est . '</td>

                                    <td><center>' . $cert . '' . $img . '</center></td>                                     

                                  </tr>';
                            }

                            ?>



                            <tr>

                              <td>&nbsp;</td>

                              <td>&nbsp;</td>

                              <td>&nbsp;</td>

                              <td>&nbsp;</td>

                              <td>&nbsp;</td>

                              <td>&nbsp;</td>

                              <td>&nbsp;</td>

                              <td>&nbsp;</td>

                              <td>&nbsp;</td>

                              <td>&nbsp;</td>

                            </tr>

                          </tbody>

                        </table>





                      </div>

                    </div>

                  </div>

                </div>





                <div role="tabpanel" class="tab-pane" id="depor">

                  <div class="col-md-3">

                    <div class="panel panel-default">

                      <div class="panel-heading">Practica deporte:</div>

                      <div class="panel-body box-pat">

                        <table width="100%">

                          <tbody>

                            <?php if (!empty($depor)) { ?>

                              <tr>

                                <td>

                                  <input type="radio" class="deporte" name="deporte" id="deporte_si" value="deporte_si" checked> Si

                                </td>

                                <td>

                                  <input type="radio" class="deporte" name="deporte" id="deporte_no" value="deporte_no"> No

                                </td>

                              </tr>

                            <?php } else { ?>

                              <tr>

                                <td>

                                  <input type="radio" class="deporte" name="deporte" id="deporte_si" value="deporte_si"> Si

                                </td>

                                <td>

                                  <input type="radio" class="deporte" name="deporte" id="deporte_no" value="deporte_no" checked> No

                                </td>

                              </tr>





                            <?php   } ?>

                          </tbody>

                        </table>

                      </div>

                    </div>

                  </div>

                  <div id="div2" style="display:none;" class="col-md-7">

                    <div class="panel panel-default">

                      <div class="panel-heading">Deportes:</div>

                      <div class="panel-body box-pat">

                        <table width="100%">

                          <tbody>



                            <tr>

                              <td><label><input name="chek_dep" <?php if ($validar[0] == 1) {
                                                                  echo 'checked';
                                                                } ?> type="checkbox" value="1"> Fútbol</label></td>

                              <td><label><input name="chek_dep" <?php if ($validar[1] == 1) {
                                                                  echo 'checked';
                                                                } ?> type="checkbox" value="2"> Basketball</label></td>

                              <td><label><input name="chek_dep" <?php if ($validar[2] == 1) {
                                                                  echo 'checked';
                                                                } ?> type="checkbox" value="3"> Tenis</label></td>

                            </tr>

                            <tr>

                              <td><label><input name="chek_dep" <?php if ($validar[3] == 1) {
                                                                  echo 'checked';
                                                                } ?> type="checkbox" value="4"> Tiro al Plato</label></td>

                              <td><label><input name="chek_dep" <?php if ($validar[4] == 1) {
                                                                  echo 'checked';
                                                                } ?> type="checkbox" value="5"> Natación</label></td>

                              <td><label><input name="chek_dep" <?php if ($validar[5] == 1) {
                                                                  echo 'checked';
                                                                } ?> type="checkbox" value="6"> Voleiball</label></td>

                            </tr>

                            <tr>

                              <td><label><input name="chek_dep" <?php if ($validar[6] == 1) {
                                                                  echo 'checked';
                                                                } ?> type="checkbox" value="7"> Pool</label></td>

                            </tr>



                          </tbody>

                        </table>

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





</body>

</html>

<script type="text/javascript">
  //agregar archivo
  var ArchivosSubir = 0;
  $("#agregar_archivo").click(function() {
    var html = '';


    html += '<div class="input-group" id="inputFormRow" style="padding-bottom:10px;">';
    html += '<input type="file" class="form-control" id="arch_socio" name="arch_socio[]" accept="application/pdf,image/gif,image/png,image/jpg,image/jpeg" required>';
    html += '<div class="input-group-btn">';
    html += '<a href="javascript:void(0);" class="btn btn-danger form-control" id="remover"><i class="glyphicon glyphicon-minus"></i></a>';
    html += '</div>';
    html += '</div>';


    $('#nuevo_archivo').append(html);
    ArchivosSubir++;
  });

  // Remover archivo
  $(document).on('click', '#remover', function() {
    $(this).closest('#inputFormRow').remove();
    ArchivosSubir--;
  });



  var validar_subida = 0;

  function ver_foto() {
    var img = document.getElementById('img_perfil');
    var inputFile = document.getElementById('imagen_perfil').files[0];
    var reader = new FileReader();

    reader.onloadend = function() {
      img.src = reader.result;

    }

    if (inputFile) {
      reader.readAsDataURL(inputFile);
      validar_subida = 1;
    } else {
      img.src = "<?php FotoPerfil($socioData->path) ?>";
      validar_subida = 0;
    }
  }




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

    $("#txt_fecha").datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: '-100:+0',
    });

  });

  $(function() {

    $("#nac_carga").datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: '-100:+0',
    });

  });



  jQuery(document).ready(function() {

    var vrfSocioMail = 0;
    var vrfSocioPat = 0;
    var vrfSocioMat = 0;
    var vrfSocioNom = 0;


    function validaInputSocio() {

      if (vrfSocioMail == 1 || vrfSocioPat == 1 || vrfSocioMat == 1 || vrfSocioNom == 1) {
        $("#guardar").attr("disabled", 'disabled');

      } else {
        $("#guardar").prop("disabled", false);

      }
    }



    jQuery('#tel_fijo').keyup(function(tecla) {

      var cel = $('#tel_fijo').val();

      var filtro = /^([0-9]{9}$)/;

      //if(tecla.charCode < 48 || tecla.charCode > 57) 

      if (!filtro.test(cel)) {

        if (!(cel < 48 || cel > 57)) {

          //alert('Please provide a valid email address');

          cel = $('#tel_fijo').val('');

          $('#error2').show();

          cel.focus;

          return cel;

          //return false;

        } else {

          $('#error2').hide()

        }

      } else {

        $('#error2').hide()

      }





    });

    jQuery('#tel_cel').keyup(function(tecla) {

      var cel = $('#tel_cel').val();

      var filtro = /^([0-9]{9}$)/;

      //if(tecla.charCode < 48 || tecla.charCode > 57) 

      if (!filtro.test(cel)) {

        if (!(cel < 48 || cel > 57)) {

          //alert('Please provide a valid email address');

          cel = $('#tel_cel').val('');

          $('#error3').show();


          cel.focus;

          return cel;

          //return false;

        } else {

          $('#error3').hide()


        }

      } else {

        $('#error3').hide()

      }





    });





    jQuery('#email').keyup(function() {

      var email = $('#email').val();

      var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

      if (!filter.test(email)) {

        //alert('Please provide a valid email address');

        $('#error').show();
        vrfSocioMail = 1;
        validaInputSocio();

        email.focus;

        //return false;

      } else {

        $('#error').hide();
        vrfSocioMail = 0;
        validaInputSocio();

      }

    });



    jQuery('#paterno').keyup(function() {



      var paterno = $('#paterno').val();



      var filtro = /^[a-zA-Z ÁÉÍÓÚÑ-]*$/;

      if (!filtro.test(paterno)) {

        //alert('Please provide a valid email address');

        $('#errorPat').show();

        paterno.focus;

        vrfSocioPat = 1;
        validaInputSocio();

        //return false;

      } else {



        $('#errorPat').hide();
        vrfSocioPat = 0;
        validaInputSocio();

      }



    });

    jQuery('#materno').keyup(function() {



      var materno = $('#materno').val();



      var filtro = /^[a-zA-Z ÁÉÍÓÚÑ-]*$/;

      if (!filtro.test(materno)) {

        //alert('Please provide a valid email address');

        $('#errorMat').show();

        materno.focus;

        vrfSocioMat = 1;
        validaInputSocio();

        //return false;

      } else {

        $('#errorMat').hide();

        vrfSocioMat = 0;
        validaInputSocio();

      }



    });

    jQuery('#nombres').keyup(function() {



      var materno = $('#nombres').val();



      var filtro = /^[a-zA-Z ÁÉÍÓÚÑ-]*$/;

      if (!filtro.test(materno)) {

        //alert('Please provide a valid email address');

        $('#errorNom').show();

        materno.focus;

        vrfSocioNom = 1;
        validaInputSocio();



        //return false;

      } else {



        $('#errorNom').hide();

        vrfSocioNom = 0;
        validaInputSocio();

      }



    });

  });
</script>