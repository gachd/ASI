<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="UTF-8">

  <title>Document</title>

  <?php echo form_open(base_url() . 'socios/nuevo_socio/newsocio'); ?>

  <?php echo validation_errors(); ?>

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
    width: 25%;
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

 * ===============================================*/
</style>

<body>







  <div class="main">

    <div class="container-fluid">



      <div class="row">

        <div class="panel panel-default">

          <div class="panel-heading" style="overflow: hidden;">

            <div class="col-md-1" style="width: 11%;">

              <img alt="User Pic" src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" id="profile-image1" class="img-circle img-responsive">

            </div>

            <div class="col-md-8">

              <table style="text-align: center;">

                <tbody>

                  <tr>

                    <td>RUT</td>

                    <td><input type="text" class="form-control" id="rut_socio" placeholder="Ej: 11111111-1" oninput="checkRut(this)">

                      <span id="erut_socio" style="display:none;color:red;">Rut incorrecto</span>
                      <span id="eduplicado" style="display:none;color:red;">Rut ya esta registrado</span>
                    </td>

                    <td>Nombres</td>

                    <td><input type="text" class="form-control" id="nombres" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">

                      <span id="errorNom" style="display:none;color:red;">incorrecto</span>

                    </td>

                  </tr>



                  <tr>

                    <td>Apellido Paterno</td>

                    <td><input type="text" class="form-control" id="ap_paterno" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">

                      <span id="errorPat" style="display:none;color:red;">incorrecto</span>
                    </td>

                    </td>

                    <td>Apellido Materno</td>

                    <td><input type="text" class="form-control" id="ap_materno" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">

                      <span id="errorMat" style="display:none;color:red;">incorrecto</span>

                    </td>

                  </tr>

                </tbody>

              </table>



            </div>

            <!--<div class="col-md-4">

 <table width="100%" border="1" class="tbl-afiliacion">

                        <thead>

                          <tr><th width="70%">Corporación</th>

                            <th width="30%">Nº Registro</th></tr>

                        </thead>

                        <tbody>

    <tr>

      <td >centro italiano di concepción</td>

      <td class="n_registro"><input type="text" class="form-control" id="n_registroCI"></td>

    </tr>

    <tr>

      <td>sociedad socorros mutuos concordia</td>

      <td class="n_registro"><input type="text" class="form-control" id="n_registroSMC"></td>

    </tr>

    <tr>

      <td>stadio atletico italiano</td>

      <td class="n_registro"><input type="text" class="form-control" id="n_registroSAI"></td>

    </tr>

    <tr>

      <td>stadio italiano di concepción</td>

      <td class="n_registro"><input type="text" class="form-control" id="n_registroSI"></td>

    </tr>

    <tr>

      <td>scuola italiana di concepcion </td>

      <td class="n_registro"><input type="text" class="form-control" id="n_registroSIC"></td>

    </tr>

    <tr>

      <td>nº acciones </td>

      <td class="n_registro"><input type="text" class="form-control" id="n_acciones"></td>

    </tr>

                        </tbody>

                      </table>

                    </div>-->

          </div>



          <div class="panel-body">

            <div class="row">

              <div class="col-md-12">

                <!-- Nav tabs -->

                <div class="card">

                  <ul class="nav nav-tabs" role="tablist">

                    <li role="presentation" id="home" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-list-alt"></i>  <span>Antecedentes Personales</span></a></li>

                    <li role="presentation" id="dep"><a id="dep" aria-controls="settings" role="tab" data-toggle="tab"><i class="fa fa-futbol-o"></i>  <span>Intereses Deportivos</span></a></li>

                    <li role="presentation" id="soc"><a id="soc" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-user"></i>  <span>Socio</span></a></li>

                    <li role="presentation" id="carg"><a id="carg" aria-controls="settings" role="tab" data-toggle="tab"><i class="fa fa-plus-square-o"></i>  <span>Cargas Familiares</span></a></li>



                    <!--   <li role="presentation" id="acc"><a id="acc" href="#messages" aria-controls="messages" role="tab" data-toggle="tab"><i class="fa fa-briefcase"></i>  <span>Acciones</span></a></li>

          <li role="presentation" id="cuota"><a id="cuota" href="#settings" aria-controls="settings" role="tab" data-toggle="tab"><i class="fa fa-usd"></i>  <span>Cuotas Sociales</span></a></li>-->



                  </ul>



                  <!-- Tab panes -->

                  <div class="tab-content" style="background: #f8f8f8;">







                    <div role="tabpanel" class="tab-pane active" id="home">

                      <!-- datos personales -->

                      <div class="bs-callout bs-callout-green">

                        <h4>Datos Personales</h4>

                        <table width="100%" class="table tbl-datos">

                          <tbody>

                            <tr>

                              <td width="31%">Sexo</td>

                              <td width="69%"><select class="form-control" name="sexo" id="sexo">

                                  <option value="" selected="selected">Seleccionar</option>

                                  <option value="1">MASCULINO</option>

                                  <option value="2">FEMENINO</option>

                                </select>

                              </td>

                            </tr>

                            <tr>

                              <td>fecha de nacimiento</td>

                              <td><input class="form-control w_fecha" type="text" name="txt_fecha" id="txt_fecha" required ?></td>

                            </tr>

                            <tr>

                              <td>lugar nacimiento</td>

                              <td><input type="text" class="form-control" id="nac" name="nac" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"></td>

                            </tr>

                            <tr>

                              <td>estado civil</td>

                              <td><select class="form-control" name="estadocivil" id="estadocivil">

                                  <option value=""> Seleccionar </option>

                                  <?php

                                  foreach ($estado_civil as $i) {

                                    echo ' <option value="' . $i->estacivil_id . '" ' . set_select("estado_civil", $i->estacivil_id) . '>' . $i->estacivil_nombre . '</option>';
                                  }

                                  ?>

                                </select>

                              </td>

                            </tr>

                            <tr>

                              <td>nacionalidad</td>

                              <td><select class="form-control" name="nacionalidad" id="nacionalidad">

                                  <option value=""> Seleccionar </option>

                                  <?php

                                  foreach ($nacionalidad as $i) {

                                    echo ' <option value="' . $i->nac_id . '" ' . set_select("nacionalidad", $i->nac_id) . '>' . $i->nac_nombre . '</option>';
                                  }

                                  ?>

                                </select></td>

                            </tr>

                            <tr>

                              <td>Descendiente:</td>

                              <td>
                                <div class="form-check">



                                  <input class="form-check-input" type="radio" name="descendiente" id="desc1" value="1">

                                  <label class="form-check-label" for="desc1">Si</label>

                                  <input class="form-check-input" type="radio" name="descendiente" id="desc2" value="0" checked>

                                  <label class="form-check-label" for="desc2">No</label>

                                </div>
                              </td>

                            </tr>



                          </tbody>

                        </table>

                      </div>

                      <!--DATOS DE CONTACTO -->

                      <div class="bs-callout bs-callout-green">

                        <h4>Datos de Contacto</h4>

                        <table width="100%" class="table tbl-datos">

                          <tbody>

                            <tr>

                              <td width="31%">Telefono Fijo</td>

                              <td width="69%"><input type="text" id="tel_fijo" class="form-control" placeholder="Ej: 412234567">
                                <span id="errorTel" style="display:none;color:red;">Telefono incorrecto</span>
                              </td>

                            </tr>

                            <tr>

                              <td>Celular</td>

                              <td><input type="text" class="form-control" id="tel_cel" placeholder="Ej: 99234567">
                                <span id="errorCel" style="display:none;color:red;">Celular incorrecto</span>
                              </td>

                            </tr>

                            <tr>

                              <td>Correo</td>

                              <td><input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="ejemplo@correo.com" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
                                <span id="errorMail" style="display:none;color:red;">Email incorrecto</span>
                              </td>

                            </tr>

                            <tr>

                              <td>Dirección</td>

                              <td><input type="text" id="direc" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" class="form-control"></td>

                            </tr>

                            <tr>

                              <td>Sector</td>

                              <td><input type="text" id="sector" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" class="form-control"></td>

                            </tr>

                            <tr>

                              <td>Comuna</td>

                              <td><select class="form-control" name="comu" id="comu">

                                  <option value=""> Seleccionar </option>

                                  <?php

                                  foreach ($comunas as $i) {

                                    echo ' <option value="' . $i->comuna_id . '" ' . set_select("comuna", $i->comuna_id) . '>' . $i->comuna_nombre . '</option>';
                                  }

                                  ?>

                                </select></td>

                            </tr>

                          </tbody>

                        </table>

                      </div>

                      <!--DATOS DE trabajo -->

                      <div class="bs-callout bs-callout-green">

                        <h4>Antecedentes Laborales</h4>

                        <table width="100%" class="table tbl-datos">

                          <tbody>

                            <tr>

                              <td width="31%">Situación Laboral</td>

                              <td width="69%">

                                <select class="form-control" name="laboral" id="laboral">

                                  <option value=""> Seleccionar </option>

                                  <?php

                                  foreach ($laboral as $i) {

                                    echo ' <option value="' . $i->condlab_id . '" ' . set_select("laboral", $i->condlab_id) . '>' . $i->condlab_nombre . '</option>';
                                  }

                                  ?>

                                </select>
                              </td>

                            </tr>

                            <tr>

                              <td>Actividad o Profesión</td>

                              <td><input type="text" class="form-control" id="prof" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"></td>

                            </tr>

                            <tr>

                              <td>Empresa</td>

                              <td><input type="text" class="form-control" id="emp" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"></td>

                            </tr>

                            <tr>

                              <td>Dirección</td>

                              <td><input type="text" class="form-control" id="direc_emp" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"></td>

                            </tr>

                            <tr>

                              <td>Telefono</td>

                              <td><input type="text" class="form-control" id="tel_emp" placeholder="Ej: 412234567">
                                <span id="errorTelEmp" style="display:none;color:red;">Celular incorrecto</span>
                              </td>



                            </tr>

                          </tbody>

                        </table>

                      </div>

                      <div class="row">

                        <div class="col-sm-6">

                          <div class="panel panel-default">

                            <div class="panel-heading" style="overflow: hidden;">

                              <div class="col-md-6">

                                <table>

                                  <tbody>

                                    <tr>

                                      <td>


                                        <button type="button" class="btn btn-info" id="guardar_dp" aria-controls="settings" role="tab" data-toggle="tab"><span>Siguiente</span></button>






                                      </td>





                                    </tr>

                                  </tbody>

                                </table>

                                <div id="info-guardar" data-datper="1"></div>

                              </div>

                            </div>

                          </div>

                        </div>

                      </div>

                    </div>

                    <!-- PESTAÑA INTERESES DEPORTIVOS -->





                    <!-- PESTAÑA SOSCIO -->

                    <div role="tabpanel" class="tab-pane" id="profile">

                      <div class="col-md-8">

                        <div class="panel panel-default">

                          <div class="panel-heading">Registro Corporaciones</div>

                          <div class="panel-body">

                            <table width="100%" class="registro_socios table table-striped" id="tablecorp">

                              <thead>

                                <tr>

                                  <th width="30%">Corporación</th>

                                  <th width="10%"></th>

                                  <th width="20%">Nº Registro</th>

                                  <th width="20%">Nº Libro</th>

                                  <th width="20%">Fecha de registro</th>





                                </tr>

                              </thead>

                              <tbody id="BodyCorp">



                                <?php

                                $cont_corp = 0;

                                foreach ($corporacion as $i) {

                                  if ($i->co_id != 6) {

                                    $cont_corp = $cont_corp + 1  ?>

                                    <tr>

                                      <td style="display:none;" id="rut_corp"><?php echo $i->co_rut ?></td>

                                      <td><label><?php echo $i->co_nombre ?></label></td>

                                      <td id="chek_corp"><input value="1" onclick="activaCorp('Corp<?php echo $cont_corp ?>')" type="checkbox" class="chek_corp form-check-input" id="Corp<?php echo $cont_corp ?>"></td>

                                      <td> <input id="num_reg" disabled="disabled" type="text" class="Corp<?php echo $cont_corp ?> form-control"></td>

                                      <td> <input id="num_libro" disabled="disabled" type="text" class="Corp<?php echo $cont_corp ?> form-control"></td>

                                      <td><input disabled="disabled" class="Corp<?php echo $cont_corp ?> form-control w_fecha" type="text" name="fecha_reg" id="fecha_reg<?php echo $cont_corp ?>" value="<?php echo set_value('fecha_reg'); ?>"></td>

                                    </tr>

                                <?php

                                  }
                                }

                                ?>

                              </tbody>

                            </table>



                          </div>

                        </div>



                      </div>

                      <div class="col-md-4">

                        <div class="panel panel-default">

                          <div class="panel-heading">Socio Patrocinador</div>

                          <div class="panel-body box-pat">

                            <ul>

                              <select class="form-control" name="SocPa" id="SocPa">

                                <option value="0"> Seleccionar </option>

                                <?php

                                foreach ($socio_pat as $i) {

                                  echo ' <option value="' . $i->prsn_rut . '">' . $i->prsn_nombres . ' ' . $i->prsn_apellidopaterno . '</option>';
                                }

                                ?>

                              </select>

                            </ul>

                          </div>

                        </div>

                      </div>

                      <div class="col-md-4">
                        <div class="panel panel-default">

                          <table width="100%">

                            <thead>

                              <tr>

                                <th>Nombre</th>

                                <th>Rut</th>

                                <th></th>

                              </tr>

                            </thead>

                            <tbody id="tablePat" class="tablePat">

                            </tbody>

                          </table>

                        </div>

                      </div>

                      <!--    <div class="col-md-12" style="padding-top: 15px;">

                <div class="panel panel-default">

                  <div class="panel-heading">Historial</div>

                   <div class="panel-body historial">

                                                    <table class="historial_coorp">

                                                      <thead>

                                                     <tr>

                                                      <th>Fecha</th>

                                                       <th>Descripcion</th>

                                                     </tr> 

                                                      </thead>

                                                      <tbody>

                                                     <tr>

                                                      <td>01/12/2018</td>

                                                       <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod

                                                       tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,

                                                       quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo

                                                       consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse

                                                       cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non

                                                       proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>

                                                       

                                                      </tr>

                                                      <tr>

                                                       <td>02/12/2018</td>

                                                       <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod

                                                       tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,

                                                       quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo

                                                       consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse

                                                       cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non

                                                       proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>                                                

                                                      </tr>

                                                      <tr>

                                                       <td>02/12/2018</td>

                                                       <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod

                                                       tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,

                                                       quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo

                                                       consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse

                                                       cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non

                                                       proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>                                                

                                                      </tr>

                                                      </tbody>

                                                    </table>  

                    </div>

                   

                  </div>

            </div>-->





                      <!--<div class="col-md-8">

              <div class=" tabs-left left-tab-process" style="margin-bottom:25px;">

                    <ul class="nav nav-tabs book-process-ltab text-center">

                      <li class="active"><a href="#a" data-toggle="tab">Centro Italiano di Concepción</a></li>

                      <li class=""><a href="#b" data-toggle="tab">Sociedad Socorros Mutuos Concordia</a></li>

                      <li class=""><a href="#c" data-toggle="tab">Stadio Atlético Italiano</a></li>

                      <li class=""><a href="#d" data-toggle="tab">Stadio Italiano di Concepción</a></li>

                      <li class=""><a href="#e" data-toggle="tab">Scuola Italiana di Concepción</a></li>

                      <li class=""><a href="#f" data-toggle="tab">Tohjfgo:</a></li>

                    </ul>

                    <div class="tab-content">

                                             <div class="tab-pane active" id="a">

                                               <h3>Centro Italiano di Concepción</h3>

                                               <div class="col-md-12 row">

                                                  <table width="250" class="datos_coorp">

                                                    <tbody>

                                                      <tr>

                                                        <td width="39%">estado</td>

                                                        <td width="61%"><span class="label label-success">Activo</span> </td>

                                                      </tr>

                                                      <tr>

                                                        <td>nº registro</td>

                                                        <td>: 185</td>

                                                      </tr>

                                                      <tr>

                                                        <td>nº libro</td>

                                                        <td>: 1</td>

                                                      </tr>

                                                      <tr>

                                                        <td>fecha registro</td>

                                                        <td>: 12/08/2018</td>

                                                      </tr>

                                                      <tr>

                                                        <td>fecha retiro</td>

                                                        <td>: -</td>

                                                      </tr>

                                                    </tbody>

                                                  </table>

                                               </div>

                                              

                                             </div>

                                             <div class="tab-pane" id="b">

                                               <div class="">

                                                            <h4>fdgfg:</h4>

                                                            sfdgfsdgfdgsfg

                                                            <p>

                                                               fdgfg.</p>

                                                        </div>

                                             </div>

                                             <div class="tab-pane" id="c">

                                               <p> On bofdgmplfderviewd</p>

                                             

                                             <div class="tab-pane" id="d">

                                               dfgfgfgfg

                                             </div>

                                             

                                             <div class="tab-pane" id="e">

                                               dfgfdgfg

                                             </div>

                                             

                                             <div class="tab-pane" id="f">

                                               dfgdfgfdgfdg

                                             </div>

                                            </div>

                    </div>

              </div>

            </div> -->

                      <div class="row">

                        <div class="col-sm-6">

                          <div class="panel panel-default">

                            <div class="panel-heading" style="overflow: hidden;">

                              <div class="col-md-6">

                                <table>

                                  <tbody>

                                    <tr>

                                      <td>

                                        <a type="button" onclick="grabaSocioCorp('BodyCorp','tablePat');" href="#extra" class="btn btn-info" id="guardar_rs" aria-controls="settings" role="tab" data-toggle="tab"><span>Siguiente</span></a>

                                      </td>





                                    </tr>

                                  </tbody>

                                </table>

                                <div id="info-guardar" data-datper="1"></div>

                              </div>

                            </div>

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

                                <tr>

                                  <td>

                                    <input type="radio" class="deporte" name="deporte" id="deporte_si" value="deporte_si"> Si

                                  </td>

                                  <td>

                                    <input type="radio" class="deporte" name="deporte" id="deporte_no" value="deporte_no" checked> No

                                  </td>

                                </tr>

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

                                  <td><label><input name="chek_dep" type="checkbox" value="1"> Fútbol</label></td>

                                  <td><label><input name="chek_dep" type="checkbox" value="2"> Basketball</label></td>

                                  <td><label><input name="chek_dep" type="checkbox" value="3"> Tenis</label></td>

                                </tr>

                                <tr>

                                  <td><label><input name="chek_dep" type="checkbox" value="4"> Tiro al Plato</label></td>

                                  <td><label><input name="chek_dep" type="checkbox" value="5"> Natación</label></td>

                                  <td><label><input name="chek_dep" type="checkbox" value="6"> Voleiball</label></td>

                                </tr>

                                <tr>

                                  <td><label><input name="chek_dep" type="checkbox" value="7"> Pool</label></td>

                                </tr>

                              </tbody>

                            </table>

                          </div>

                        </div>

                      </div>

                      <div class="row">

                        <div class="col-sm-6">

                          <div class="panel panel-default">

                            <div class="panel-heading" style="overflow: hidden;">

                              <div class="col-md-6">

                                <table>

                                  <tbody>

                                    <tr>

                                      <td>

                                        <a type="button" class="btn btn-info" id="guardar_id" href="#profile" aria-controls="settings" role="tab" data-toggle="tab"><span>Siguiente</span></a>

                                      </td>





                                    </tr>

                                  </tbody>

                                </table>

                                <div id="info-guardar" data-datper="1"></div>

                              </div>

                            </div>

                          </div>

                        </div>

                      </div>

                    </div>



                    <div role="tabpanel" class="tab-pane" id="messages">

                      <div class="col-md-3">

                        <div class="panel panel-default">

                          <div style="text-align: center;">
                            <h2 class="n_accion">1</h2><span>Acción</span>
                          </div>

                          <div>

                            <ul class="list-group desc_accion">



                              <li class="list-group-item det_accion">Nº Titulo: 314</li>

                              <li class="list-group-item det_accion">Libro: 4</li>

                              <li class="list-group-item det_accion">Foja Nº: 5 vta</li>

                            </ul>

                          </div>

                        </div>

                      </div>

                      <div class="col-md-9">

                        <div class="panel panel-default">

                          <div class="panel-heading">Registro de acciones </div>

                          <div class="panel-body">

                            <table width="100%" id="reg_accion" class="table table-bordered table-hover">

                              <thead>

                                <tr>

                                  <td>fecha de <br>

                                    transferencia</td>

                                  <td>tipo de <br>

                                    transferencia <br></td>

                                  <td>Comprador a </td>

                                  <td>Vendido a</td>

                                  <td>Nº Titulo<br>

                                    Nuevo del <br>

                                    Comprador</td>

                                  <td>Nº Titulo<br>

                                    Inutilizado</td>

                                  <td>Saldo</td>

                                </tr>

                              </thead>

                              <tbody>

                                <tr>

                                  <td>&nbsp;</td>

                                  <td>&nbsp;</td>

                                  <td>&nbsp;</td>

                                  <td>&nbsp;</td>

                                  <td>&nbsp;</td>

                                  <td>&nbsp;</td>

                                  <td>&nbsp;</td>

                                </tr>

                                <tr>

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

                    <div role="tabpanel" class="tab-pane" id="settings">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passage..</div>

                    <div role="tabpanel" class="tab-pane" id="extra">



                      </form>

                      <div class="col-md-12">

                        <div class="panel panel-default">

                          <div class="panel-heading">Datos cargas familiares

                            <table>

                              <tbody>

                                <tr>

                                  <input type="radio" class="cargas" name="cargas" id="cargas_si" value="cargas_si"> Si

                                </tr>

                                <tr>

                                  <input type="radio" class="cargas" name="cargas" id="cargas_no" value="cargas_no" checked> No

                                </tr>

                              </tbody>

                            </table>

                            <!-- Trigger the modal with a button -->

                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Agregar</button>

                          </div>

                          <div class="panel-body" id="div3" style="display:none;">

                            <table width="100%" class="table table-bordered table-hover" id="tablacargas" name="tablacargas">

                              <thead>

                                <tr>

                                  <td width="9%">PARENTESCO</td>

                                  <td width="9%">RUT</td>

                                  <td>NOMBRES</td>

                                  <td>APELLIDO<br> PATERNO</td>

                                  <td>APELLIDO<br>MATERNO</td>

                                  <td width="8%">FECHA DE<br> NACIMIENTO</td>

                                  <td>CELULAR</td>

                                  <td>MAIL</td>

                                  <td width="6%">ESTUDIANTE</td>

                                  <td>CERTIFICADO<br>

                                    ALUMNO REGULAR</td>

                                </tr>

                              </thead>

                              <tbody id="CargaSelect">



                              </tbody>

                            </table>



                            <button onclick="grabaTodoTabla('CargaSelect');" type="button" class="btn btn-primary">Guardar</button>

                            <div id="info-guardar"></div>

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



    </div>



  </div>

  <!-- Modal -->

  <div class="modal fade" id="myModal" role="dialog">

    <div class="modal-dialog">

      <!-- Modal content-->

      <div class="modal-content" style="width: 800px;">

        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Carga</h4>

        </div>

        <div class="modal-body">

          <div class="form-group">

            <table width="100%" class="table table-bordered table-hover" id="tablacargas" name="tablacargas">

              <tbody>

                <tr>

                  <td width="11%">PARENTESCO</td>

                  <td width="22%">

                    <select class="form-control" name="parentesco" id="parentesco">

                      <option value="0">SELECCIONAR</option>

                      <?php

                      foreach ($parentesco as $i) {

                        echo ' <option value="' . $i->pt_id . '" ' . set_select("parentesco", $i->pt_id) . '>' . $i->pt_nombre . '</option>';
                      } ?>

                    </select>

                  </td>

                  <td width="8%">RUT</td>

                  <td width="22%"><input maxlength="10" type="text" class="form-control" oninput="checkRut(this)" id="rut_carga" placeholder="Ej: 11111111-1" required>

                    <span id="erut_carga" style="display:none;color:red;">Rut incorrecto</span>
                  </td>

                  <script src="<?php echo base_url(); ?>/assets/js/validarRUT.js"></script>

                  <td width="9%">NOMBRES</td>

                  <td width="24%"><input type="text" class="form-control" id="nombre_carga" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">

                    <span id="error3" style="display:none;color:red;">Nombre incorrecto</span>
                  </td>

                </tr>

                <tr>

                  <td>APELLIDO PATERNO</td>

                  <td width="12%"><input type="text" class="form-control" id="pat_carga" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">

                    <span id="error4" style="display:none;color:red;">Apellido Paterno incorrecto</span>
                  </td>

                  <td>APELLIDO MATERNO</td>

                  <td width="12%"><input type="text" class="form-control" id="mat_carga" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">

                    <span id="error5" style="display:none;color:red;">Apellido Materno incorrecto</span>
                  </td>

                  <td>FECHA DE NACIMIENTO</td>

                  <td width="10%"><input class="form-control w_fecha" type="text" name="nac_carga" id="nac_carga" value="<?php echo set_value('nac_carga'); ?>"></td>

                </tr>

                <td>CELULAR</td>

                <td width="10%"><input maxlength="9" type="text" class="form-control" id="cel_carga">

                  <span id="error2" style="display:none;color:red;">Celular incorrecto</span>

                </td>



                <td>MAIL</td>

                <td colspan="4"><input type="text" class="form-control" id="mail_carga" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">

                  <span id="error" style="display:none;color:red;">Email incorrecto</span>

                </td>



                </tr>

                <tr>

                  <td>ESTUDIANTE</td>

                  <td width="6%"><select class="form-control" name="est_carga" id="est_carga">

                      <option value="0"></option>

                      <option value="1">SI</option>

                      <option value="2">NO</option>

                    </select></td>

                  <td>CERTIFICADO<br>

                    ALUMNO REGULAR</td>

                  <td width="7%">

                    <form action="<?php echo base_url() ?>socios/nuevo_socio/cargar_cert" method="post" enctype="multipart/form-data" target="request">

                      <input type="file" name="certificado">

                      <input type="hidden" name="rutCarga" id="rutCarga" value="">

                      <input type="submit" value="Submit" id="enviarArch">

                      <input type="hidden" name="subido" id="subido" value="">

                    </form>



                  </td>

                  <iframe style="display: none;" id="request"></iframe>

                </tr>



              </tbody>

            </table>

          </div>

        </div>

        <div class="modal-footer">

          <!--Uso la funcion onclick para llamar a la funcion en javascript-->
          <!--agcargasocio para hacer desaparecer el botoon-->
          <button type="button" id="agCargaSocio" class="btn btn-default"><span>Agregar</span></button>

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

    var numFilas = $("#BodyCorp tr").length;

    var cont = 1;

    for (i = 0; i < numFilas; i++) {

      $("#fecha_reg" + cont).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: '-100:+0',
    }
      );

      cont = cont + 1;

    }



  });

  $(function() {

    $("#nac_carga").datepicker(
      {
      changeMonth: true,
      changeYear: true,
      yearRange: '-100:+0',
    }
    );

  });





  $(document).ready(function() {

    $("#rut_carga").keyup(function() {

      var value = $(this).val();

      $("#rutCarga").val(value);

    });

  });

  $(document).ready(function() {

    $("#enviarArch").click(function() {



      $("#subido").val(1);

    });

  });



  function activaCorp(element)

  {

    if ($("#" + element + ":checked").val() == 1) {

      $("." + element).attr('disabled', false);

    } else {

      $("." + element).attr('disabled', 'disabled');

    }

  }





  function rut_carga() {

    var rut = $('#rut_carga').val();

    alert(rut);

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

  });



  $(document).ready(function() {

    $(".cargas").click(function(evento) {



      var valor = $(this).val();



      if (valor == 'cargas_no') {



        $("#div3").css("display", "none");

      } else {



        $("#div3").css("display", "block");

      }

    });

  });

  function RefrescaCarga() {

    var ip = [];

    var i = 0;

    $('#guardar').attr('disabled', true); //Deshabilito el Boton Guardar

    $('.iCarga').each(function(index, element) {

      i++;

      ip.push({
        id_pro: $(this).val()
      });

    });

    // Si la lista de Productos no es vacia Habilito el Boton Guardar

    if (i > 0) {

      $('#guardar').removeAttr('disabled', 'disabled');

    }

    var ipt = JSON.stringify(ip); //Convierto la Lista de Productos a un JSON para procesarlo en tu controlador

    $('#ListaPro').val(encodeURIComponent(ipt));

  }

  function grabaTodoTabla(TABLAID) {

    //tenemos 2 variables, la primera será el Array principal donde estarán nuestros datos y la segunda es el objeto tabla

    var DATA = []

    var TABLA = $("#" + TABLAID + " > tr");

    var rut_socio = $('#rut_socio').val();





    //una vez que tenemos la tabla recorremos esta misma recorriendo cada TR y por cada uno de estos se ejecuta el siguiente codigo

    TABLA.each(function() {

      //por cada fila o TR que encuentra rescatamos 3 datos, el ID de cada fila, la Descripción que tiene asociada en el input text, y el valor seleccionado en un select

      var RUT = $(this).find("td[id='rut_carg']").text(),

        NOMB = $(this).find("td[id='nom_carg']").text(),

        PAT = $(this).find("td[id='pat_carg']").text(),

        MAT = $(this).find("td[id='mat_carg']").text(),

        NAC = $(this).find("td[id='nac_carg']").text(),

        PARENTESCO = $(this).find("td[id='par_carg']").data('parent'),

        CERT = $(this).find("td[id='cert']").data('subido'),

        // PAR  = $(this).find("td[id='par_carg']").data().parent,

        CEL = $(this).find("td[id='cel_carg']").text(),

        MAIL = $(this).find("td[id='mail_carg']").text(),

        EST = $(this).find("td[id='est_carg']").text();



      //entonces declaramos un array para guardar estos datos, lo declaramos dentro del each para así reemplazarlo y cada vez

      item = {};

      //si miramos el HTML vamos a ver un par de TR vacios y otros con el titulo de la tabla, por lo que le decimos a la función que solo se ejecute y guarde estos datos cuando exista la variable ID, si no la tiene entonces que no anexe esos datos.



      item["rut"] = RUT;

      item["nomb"] = NOMB;

      item['pat'] = PAT;

      item["mat"] = MAT;

      item["nac"] = NAC;

      item['parent'] = PARENTESCO;

      item["cel"] = CEL;

      item["mail"] = MAIL;

      item['est'] = EST;

      item['cert'] = CERT;

      //una vez agregados los datos al array "item" declarado anteriormente hacemos un .push() para agregarlos a nuestro array principal "DATA".

      DATA.push(item);



    });

    console.log(DATA);



    //eventualmente se lo vamos a enviar por PHP por ajax de una forma bastante simple y además convertiremos el array en json para evitar cualquier incidente con compativilidades.

    INFO = new FormData();

    aInfo = JSON.stringify(DATA);



    INFO.append('data', aInfo);



    $.ajax({

      cache: false,

      type: "POST",

      dataType: "json",

      data: {
        "data": JSON.stringify(DATA),
        "rut": rut_socio
      },

      url: "<?php echo base_url() ?>socios/nuevo_socio/agregaCarga",

      success: function(data) {

        $("#info-guardar").html(data);

        //Una vez que se haya ejecutado de forma exitosa hacer el código para que muestre esto mismo.

      }

    });





  }





  function grabaSocioCorp(TABLAID, TABLEID) {

    //tenemos 2 variables, la primera será el Array principal donde estarán nuestros datos y la segunda es el objeto tabla

    var DATA = [];

    var DATA_P = [];

    var TABLA = $("#" + TABLAID + " > tr");

    var TABLE = $("#" + TABLEID + " > tr");

    var rut_socio = $('#rut_socio').val();

    var nacionalidad = $("#nacionalidad option:selected").val();
    var validador = 0;


    //una vez que tenemos la tabla recorremos esta misma recorriendo cada TR y por cada uno de estos se ejecuta el siguiente codigo

    TABLA.each(function() {

      //por cada fila o TR que encuentra rescatamos 3 datos, el ID de cada fila, la Descripción que tiene asociada en el input text, y el valor seleccionado en un select    

      var paso = $(this).find("input:checkbox:checked").val();

      if (paso == 1) {



        var RUT_CORP = $(this).find("td[id='rut_corp']").text(),

          REG = $(this).find("input[id='num_reg']").val(),

          LIB = $(this).find("input[id='num_libro']").val(),

          FECHA = $(this).find("input[name='fecha_reg']").val();

        REGLARG = $(this).find("input[id='num_reg']").length;
        LIBLARG = $(this).find("input[id='num_libro']").length;
        FECHALARG = $(this).find("input[name='fecha_reg']").length;

        if (REGLARG == 0 || LIBLARG == 0 || FECHA == 0) {
          validador = 1;


        } else {

          item = {};

          //si miramos el HTML vamos a ver un par de TR vacios y otros con el titulo de la tabla, por lo que le decimos a la función que solo se ejecute y guarde estos datos cuando exista la variable ID, si no la tiene entonces que no anexe esos datos.



          item["rut_corp"] = RUT_CORP;

          item["num_reg"] = REG;

          item['num_lib'] = LIB;

          item["fecha_reg"] = FECHA;

          item["nacionalidad"] = nacionalidad;

          //una vez agregados los datos al array "item" declarado anteriormente hacemos un .push() para agregarlos a nuestro array principal "DATA".

          DATA.push(item);




        }
      }

    });

    console.log(DATA);

    TABLE.each(function() {

      var RUT_PAT = $(this).find("td[id='rut_Soc']").text();

      item_p = {};



      item_p["rut_pat"] = RUT_PAT;

      //una vez agregados los datos al array "item" declarado anteriormente hacemos un .push() para agregarlos a nuestro array principal "DATA".

      DATA_P.push(item_p);





    });

    console.log(DATA_P);



    //eventualmente se lo vamos a enviar por PHP por ajax de una forma bastante simple y además convertiremos el array en json para evitar cualquier incidente con compativilidades.

    INFO = new FormData();

    aInfo = JSON.stringify(DATA);



    INFO.append('data', aInfo);



    INFO_P = new FormData();

    aInfo_p = JSON.stringify(DATA_P);



    INFO_P.append('data', aInfo_p);

    var data1 = JSON.stringify(DATA);
    var data2 = JSON.stringify(DATA_P);



    if (validador != 1) {



      $.ajax({ //empieza funcion que envia valores a controlador

        cache: false,

        type: "POST",

        dataType: "json",

        data: {
          "data": data1,
          "data_p": data2,
          "rut": rut_socio
        },

        url: "<?php echo base_url() ?>socios/nuevo_socio/reg_Socio",

        success: function(data) {

          $("#info-guardar").html(data);

          //Una vez que se haya ejecutado de forma exitosa hacer el código para que muestre esto mismo.

        }



      });
      $('#guardar_rs').attr('href', '#extra');
      $("li#soc").removeClass("active");

      $("li#carg").addClass("active");
    } else {
      alert('COMPLETE TODOS LOS CAMPOS');
      $('#guardar_rs').attr('href', 'javascript:void(0)');
    }


  }



  $("select[name=SocPa]").change(function() {

    //    alert($('select[name=SocPa]').val());

    // agregarSocPat();





    var cont = 1;

    var numFilas = $("#tablePat tr").length;

    cont = numFilas + cont;

    if (cont < 3) {

      var text = $('#SocPa').find(':selected').text(); //Capturo el Nombre del parentesco- Texto dentro del Select

      var sel = $('#SocPa').find(':selected').val();
      if (sel != 0) {
        if (cont == 2) {
          if ($('#Soc2').length > 0) {
            $('#Soc2').attr('id', 'Soc1');
          }
          var children = document.getElementById('Soc1').getElementsByTagName('td')[1].innerHTML;

        }

        if (sel !== children) {

          var newtr = '<tr class="Soc" id="Soc' + cont + '"  data-id="' + cont + '"  >';

          newtr = newtr + '<td id="nom_Soc" class="iSoc" >' + text + '</td>';

          newtr = newtr + '<td id="rut_Soc" class="rut" data-id="' + sel + '" >' + sel + '</td>';

          newtr = newtr + '<td><button type="button" class="btn btn-danger btn-xs remove-Soc"><i class="fa fa-times"></i></button></td></tr>';

          alert(sel);
          alert(children);
          alert(cont);

          $('#tablePat').append(newtr); //Agrego el Producto al tbody de la Tabla con el id=ProSelected

          //    RefrescaCarga();//Refresco Productos



          $('.remove-Soc').off().click(function(e) {

            $(this).parent('td').parent('tr').remove(); //En accion elimino carga de la Tabla

            if ($('#tablePat tr.Soc').length == 0)

              $('#tablePat .no-Soc').slideDown(300);

            RefrescaCarga();

          });

          $('.iSoc').off().change(function(e) {

            RefrescaCarga();

          });

        }
      }
    }

  });








  function limpiarModal() {

    $('#myModal').on('hidden.bs.modal', function() {

      $(this).find("input,textarea,select").val('').end();



    });

  }


  var vrfSocioMail = 0;
  var vrfSocioPat = 0;
  var vrfSocioMat = 0;
  var vrfSocioNom = 0;
  var vrfSocioDup = 0;
  var vrfSocioRut = 0;
  var vrfCargaMail = 0;
  var vrfCargaPat = 0;
  var vrfCargaMat = 0;
  var vrfCargaNom = 0;
  var vrfCargaDup = 0;
  var vrfCargaRut = 0;

  function validaInputCarga() {

    if (vrfCargaMail == 1 || vrfCargaPat == 1 || vrfCargaMat == 1 || vrfCargaNom == 1) {
      $('#agCargaSocio').css('display', 'none');

    } else {
      $('#agCargaSocio').css('display', 'block');

    }
  }

  function validaInputSocio() {

    if (vrfSocioMail == 1 || vrfSocioPat == 1 || vrfSocioMat == 1 || vrfSocioNom == 1 || vrfSocioDup == 1) {
      $('#guardar_dp').css('display', 'none');

    } else {
      $('#guardar_dp').css('display', 'block');

    }
  }
  $(document).ready(function() {



    jQuery('#cel_carga').keyup(function(tecla) {

      var cel = $('#cel_carga').val();

      var filtro = /^([0-9]{9}$)/;

      //if(tecla.charCode < 48 || tecla.charCode > 57) 

      if (!filtro.test(cel)) {

        if (!(cel < 48 || cel > 57)) {

          //alert('Please provide a valid email address');

          cel = $('#cel_carga').val('');

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





    jQuery('#mail_carga').keyup(function() {

      var email = $('#mail_carga').val();

      var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

      if (!filter.test(email)) {

        //alert('Please provide a valid email address');

        $('#error').show();

        email.focus;
        vrfCargaMail = 1;
        validaInputCarga();
        //return false;

      } else {

        $('#error').hide()
        vrfCargaMail = 0;
        validaInputCarga();
      }

    });
    jQuery('#email').keyup(function() {

      var email = $('#email').val();

      var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

      if (!filter.test(email)) {
        //alert('Please provide a valid email address');

        $('#errorMail').show();
        //$('#guardar_dp').css('display','none');
        vrfSocioMail = 1;
        validaInputSocio();



        //return false;

      } else {

        $('#errorMail').hide()
        //$('#guardar_dp').css('display','block');
        vrfSocioMail = 0;
        validaInputSocio();


      }

    });





    jQuery('#nombre_carga').keyup(function() {

      var nombre = $('#nombre_carga').val();

      // nombre.value = nombre.value.toUpperCase();

      var filtro = /^[a-zA-Z ÁÉÍÓÚÑ]*$/;

      if (!filtro.test(nombre)) {

        //alert('Please provide a valid email address');

        $('#error3').show();
        vrfCargaNom = 1;
        validaInputCarga();

        nombre.focus;

        //return false;

      } else {

        $('#error3').hide()
        vrfCargaNom = 0;
        validaInputCarga();

      }



    });

    jQuery('#pat_carga').keyup(function() {

      var paterno = $('#pat_carga').val();

      var filtro = /^[a-zA-Z ÁÉÍÓÚÑ-]*$/;

      if (!filtro.test(paterno)) {

        //alert('Please provide a valid email address');

        $('#error4').show();

        paterno.focus;
        vrfCargaPat = 1;
        validaInputCarga();

        //return false;

      } else {

        $('#error4').hide();
        vrfCargaPat = 0;
        validaInputCarga();

      }



    });

    jQuery('#mat_carga').keyup(function() {



      var materno = $('#mat_carga').val();



      var filtro = /^[a-zA-Z ÁÉÍÓÚÑ-]*$/;

      if (!filtro.test(materno)) {

        //alert('Please provide a valid email address');

        $('#error5').show();

        materno.focus;


        vrfCargaMat = 1;
        validaInputCarga();
        //return false;

      } else {



        $('#error5').hide();
        vrfCargaMat = 0;
        validaInputCarga();

      }



    });

    jQuery('#ap_paterno').keyup(function() {



      var materno = $('#ap_paterno').val();



      var filtro = /^[a-zA-Z ÁÉÍÓÚÑ-]*$/;

      if (!filtro.test(materno)) {

        //alert('Please provide a valid email address');

        $('#errorPat').show();



        //$('#guardar_dp').css('display','none');
        vrfSocioPat = 1;
        validaInputSocio();
        //return false;

      } else {

        //$('#guardar_dp').css('display','block');
        $('#errorPat').hide();
        vrfSocioPat = 0;
        validaInputSocio();




      }



    });

    jQuery('#tel_fijo').keyup(function(tecla) {

      var cel = $('#tel_fijo').val();

      var filtro = /^([0-9]{9}$)/;

      //if(tecla.charCode < 48 || tecla.charCode > 57) 

      if (!filtro.test(cel)) {

        if (!(cel < 48 || cel > 57)) {

          //alert('Please provide a valid email address');

          cel = $('#tel_fijo').val('');

          $('#errorTel').show();

          cel.focus;

          return cel;

          //return false;

        } else {

          $('#errorTel').hide()

        }

      } else {

        $('#errorTel').hide()

      }



    });
    jQuery('#tel_emp').keyup(function(tecla) {

      var cel = $('#tel_emp').val();

      var filtro = /^([0-9]{9}$)/;

      //if(tecla.charCode < 48 || tecla.charCode > 57) 

      if (!filtro.test(cel)) {

        if (!(cel < 48 || cel > 57)) {

          //alert('Please provide a valid email address');

          cel = $('#tel_emp').val('');

          $('#errorTelEmp').show();

          cel.focus;

          return cel;


          //return false;

        } else {

          $('#errorTelEmp').hide();


        }

      } else {

        $('#errorTelEmp').hide()

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

          $('#errorCel').show();

          cel.focus;

          return cel;

          //return false;

        } else {

          $('#errorCel').hide()

        }

      } else {

        $('#error2').hide()

      }



    });

    jQuery('#ap_materno').keyup(function() {



      var materno = $('#ap_materno').val();



      var filtro = /^[a-zA-Z ÁÉÍÓÚÑ-]*$/;

      if (!filtro.test(materno)) {

        //alert('Please provide a valid email address');

        $('#errorMat').show();



        //$('#guardar_dp').css('display','none');
        vrfSocioMat = 1;
        validaInputSocio();
        //return false;

      } else {

        $('#errorMat').hide();

        // $('#guardar_dp').css('display','block');
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

        //$('#guardar_dp').css('display','none');
        vrfSocioNom = 1;
        validaInputSocio();


        //return false;

      } else {



        $('#errorNom').hide();

        //$('#guardar_dp').css('display','block');
        vrfSocioNom = 0;
        validaInputSocio();




      }



    });



    $(document).ready(function() {

      var table = $('#tablecorp')[0];



      $(table).delegate('.tr_clone_add', 'click', function() {

        var thisRow = $(this).closest('tr')[0];

        $(thisRow).clone().insertAfter(thisRow).find('input:text').val('');

      });

    });



    $(document).ready(function() {

      $("#guardar_dp").click(function() {



        var rut = document.getElementById('rut_socio').value.length;

        var nombres = document.getElementById('nombres').value.length;

        var ap_paterno = document.getElementById('ap_paterno').value.length;

        var ap_materno = document.getElementById('ap_materno').value.length;

        var fecha_nac = document.getElementById('txt_fecha').value.length;

        var tel_fijo = document.getElementById('tel_fijo').value.length;

        var tel_cel = document.getElementById('tel_cel').value.length;

        var email = document.getElementById('email').value.length;

        var direc = document.getElementById('direc').value.length;

        var prof = document.getElementById('prof').value.length;

        var direc_emp = document.getElementById('direc_emp').value.length;

        var emp = document.getElementById('emp').value.length;

        var tel_emp = document.getElementById('tel_emp').value.length;

        var sector = document.getElementById('sector').value.length;

        var nac = document.getElementById('nac').value.length;





        if (rut == 0 || nombres == 0 || ap_paterno == 0 || ap_materno == 0 || $('#sexo').val().trim() === '' || fecha_nac == 0 || tel_cel == 0 || email == 0 || direc == 0 || $('#estadocivil').val().trim() === '' || $('#nacionalidad').val().trim() === '' || $('#laboral').val().trim() === '' || $('#comu').val().trim() === '') {

          alert('Complete todos los campos');



          $('#guardar_dp').attr('href', 'javascript:void(0)');



        } else {

          $('#guardar_dp').attr('href', '#depor');

          var rut = $('#rut_socio').val();

          var nombres = $('#nombres').val();

          var paterno = $('#ap_paterno').val();

          var materno = $('#ap_materno').val();

          var fecha_nac = $('#txt_fecha').val();

          var tel_fijo = $('#tel_fijo').val();

          var tel_cel = $('#tel_cel').val();

          var email = $('#email').val();

          var direc = $('#direc').val();

          var prof = $('#prof').val();

          var direc_emp = $('#direc_emp').val();

          var tel_emp = $('#tel_emp').val();

          var estadocivil = $("#estadocivil option:selected").val();

          var nacionalidad = $("#nacionalidad option:selected").val();

          var laboral = $("#laboral option:selected").val();

          var sexo = $("#sexo option:selected").val();

          var comu = $("#comu option:selected").val();

          var sector = $('#sector').val();

          var emp = $('#emp').val();

          var desc = $('input:radio[name=descendiente]:checked').val();

          var nac = $('#nac').val();



          $.post("<?php echo base_url() ?>socios/nuevo_socio/agregarSocio", {

            rut: rut,

            nombres: nombres,

            paterno: paterno,

            materno: materno,

            fecha_nac: fecha_nac,

            tel_fijo: tel_fijo,

            tel_cel: tel_cel,

            email: email,

            direc: direc,

            prof: prof,

            direc_emp: direc_emp,

            tel_emp: tel_emp,

            estadocivil: estadocivil,

            nacionalidad: nacionalidad,

            laboral: laboral,

            sexo: sexo,

            sector: sector,

            comu: comu,

            emp: emp,

            desc: desc,

            nac: nac

          }, function(data) {



            $("li#home").removeClass("active");

            $("li#dep").addClass("active");



            $("#info-guardar").html(data);

            $('#info-guardar').data('datper', 2);

            $("#rut_socio").attr("disabled", "disabled");

            //$('#home a[href="#depor"]').tab('show'); 



          });



        }



      });
    });


    $(document).ready(function() {
      $("#rut_socio").blur(function() {
        var rut_socio = $("#rut_socio").val();
        $.post("<?php echo base_url() ?>socios/nuevo_socio/ValidaSocio", {
          rut: rut_socio
        }, function(data) {
          var result = data;
          if (result == 1) {
            $('#eduplicado').show();
            // $('#guardar_dp').css('display','none');
            vrfSocioDup = 1;
            validaInputSocio();
          } else {
            $('#eduplicado').hide();
            // $('#guardar_dp').css('display','block');
            vrfSocioDup = 0;
            validaInputSocio();


          }

        });

      });
    });

    $(document).ready(function() {

      var arr = [];



      $("#guardar_id").click(function() {

        var rut = $('#rut_socio').val();



        $(":checkbox[name=chek_dep]").each(function() {

          if (this.checked) {

            // agregas cada elemento.

            arr.push($(this).val());

          }

        });



        var dep = $('input:radio[name=deporte]:checked').val();

        if (arr == null || dep == 'deporte_no') {

          arr = 0;



        }





        $.ajax({

          cache: false,

          type: "POST",

          dataType: "json",

          data: {
            "arr": JSON.stringify(arr),
            "rut": rut
          },

          url: "<?php echo base_url() ?>socios/nuevo_socio/agregarDep",

          success: function(data) {





            $("#info-guardar").html(data);

            $('#info-guardar').data('datper', 3);



          }



        });

        $("li#dep").removeClass("active");

        $("li#soc").addClass("active");





      });
    });















  });
  //funcion para el agregar carga en socio para usarlo con JQUERY y validarlo
  $(document).ready(function() {
    btnGuardar1 = $("#agCargaSocio");

    btnGuardar1.click(function() {

      var rutCarga2 = document.getElementById('rut_carga').value.length;
      var nombreCarga2 = document.getElementById('nombre_carga').value.length;
      var paternoCarga2 = document.getElementById('pat_carga').value.length;
      var maternoCarga2 = document.getElementById('mat_carga').value.length;
      var fecha_nac_carga2 = document.getElementById('nac_carga').value.length;

      if (rutCarga2 == 0 || nombreCarga2 == 0 || paternoCarga2 == 0 || maternoCarga2 == 0 || $('#sexo_carga').val() == 0 || fecha_nac_carga2 == 0 || $('#parentesco').val() == 0 || $('#est_carga').val() == 0) {

        alert('Complete todos los campos');
        $('#agCargaSocio').attr('href', 'javascript:void(0)');






      } else {



        var cont = 1;

        var numFilas = $("#CargaSelect tr").length;

        cont = numFilas + cont;

        var sel = $('#parentesco').find(':selected').val(); //Capturo el Value del parentesco

        var text = $('#parentesco').find(':selected').text(); //Capturo el Nombre del parentesco- Texto dentro del Select

        var rut = document.getElementById('rut_carga').value; //Capturo el valor del rut

        var nombres = document.getElementById('nombre_carga').value; //Capturo el valor del nombre

        var paterno = document.getElementById('pat_carga').value; //Capturo el valor del apellido paterno

        var materno = document.getElementById('mat_carga').value; //Capturo el valor del apellido materno

        var fecha_nac = document.getElementById('nac_carga').value; //Capturo el valor de la fecha de nacimiento

        var celu = document.getElementById('cel_carga').value; //Capturo el valor del celular

        var mail = document.getElementById('mail_carga').value; //Capturo el valor del mail

        var sel_est = $('#est_carga').find(':selected').val(); //Capturo el Value del parentesco

        var text_est = $('#est_carga').find(':selected').text(); //Capturo el Nombre del parentesco- Texto dentro del Select

        var subido = document.getElementById('subido').value;

        var sptext = text.split();

        if (subido == 1) {

          sub = 'Si';

        } else {

          sub = 'No';

        }



        var newtr = '<tr class="item" id="item' + cont + '"  data-id="' + cont + '"  >';

        newtr = newtr + '<td id="par_carg" class="iCarga" data-parent="' + sel + '" >' + text + '</td>';

        newtr = newtr + '<td id="rut_carg" class="rut" >' + rut + '</td>';

        newtr = newtr + '<td id="nom_carg" class="nombres" >' + nombres + '</td>';

        newtr = newtr + '<td id="pat_carg" class="paterno" >' + paterno + '</td>';

        newtr = newtr + '<td id="mat_carg" class="materno" >' + materno + '</td>';

        newtr = newtr + '<td id="nac_carg" class="fecha_nac" >' + fecha_nac + '</td>';

        newtr = newtr + '<td id="cel_carg" class="celu" >' + celu + '</td>';

        newtr = newtr + '<td id="mail_carg" class="mail" >' + mail + '</td>';

        newtr = newtr + '<td id="est_carg" class="iProduct" data-estud="' + sel_est + '" >' + text_est + '</td>';

        newtr = newtr + '<td id="cert" class="iProduct" data-subido="' + subido + '" >' + sub + '</td>';

        // newtr = newtr + '<td> <input  class="form-control" id="1" name="precio" value="23" required /></td>';

        // newtr = newtr + '<td><input  class="form-control" id="2" name="cantidad" value="2" required /></td>';

        // newtr = newtr + '<td><input  class="form-control"  id="3" name="total" value="46" required /></td>';

        newtr = newtr + '<td><button type="button" class="btn btn-danger btn-xs remove-item"><i class="fa fa-times"></i></button></td></tr>';



        $('#CargaSelect').append(newtr); //Agrego el Producto al tbody de la Tabla con el id=ProSelected



        RefrescaCarga(); //Refresco Productos

        limpiarModal();




        $('.remove-item').off().click(function(e) {

          $(this).parent('td').parent('tr').remove(); //En accion elimino carga de la Tabla

          if ($('#CargaSelect tr.item').length == 0)

            $('#CargaSelect .no-item').slideDown(300);

          RefrescaCarga();

        });

        $('.iCarga').off().change(function(e) {

          RefrescaCarga();

        });
        //manualmente obliga clickear data-dismiss=modal despues de agregar a la tabla de cargas para el socio
        $("[data-dismiss=modal]").trigger({
          type: "click"
        });

      }
    });
  });
</script>

<!-- <tbody >               

                

                  <tr >

                    <td width="12%">

                      <select class="form-control" name="parentesco" id="parentesco">

                       <option value="0"> Seleccionar </option>

                        <?php

                        foreach ($parentesco as $i) {

                          echo ' <option value="' . $i->pt_id . '" ' . set_select("parentesco", $i->pt_id) . '>' . $i->pt_nombre . '</option>';
                        } ?>

                       </select>;

                    </td>

                    <td width="11%"><input type="text" class="form-control" id="rut_carga" placeholder="Ej: 11111111-1"></td>

                    <td width="15%"><input type="text" class="form-control" id="nombre_carga" ></td>

                    <td width="12%"><input type="text" class="form-control" id="pat_carga" ></td>

                    <td width="12%"><input type="text" class="form-control" id="mat_carga" ></td>

                    <td width="10%"><input class="form-control w_fecha" type="text" name="nac_carga" id="nac_carga"  value="<?php echo set_value('nac_carga'); ?>"></td>                    

                    <td width="10%"><input type="text" class="form-control" id="tel_carga" ></td>

                    <td width="12%"><input type="text" class="form-control" id="mat_carga" ></td>                   

                    <td width="6%"><select class="form-control" name="parentesco" id="parentesco">

                       <option value="0"></option>

                             <option value="1">SI</option>

                             <option value="2">NO</option>

                       </select>;</td>

                    <td width="7%"><div class="checkbox">

                             <label>

                                 <input type="checkbox" value="">

                             </label>

                       </div>

                    </td>

                  </tr>

                  

                   </tbody>-->