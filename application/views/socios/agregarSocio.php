<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="UTF-8">

  <title>Ingreso de Socios</title>

  <?php echo form_open(base_url() . 'socios/nuevo_socio/newsocio'); ?>

  <?php echo validation_errors(); ?>

</head>

<style>

 /*  TD se adapta pantalla de acuerdo a al ancho del dispositivo */
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
    font-size: 16px;
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



  .img-responsive {
    max-width: 100px;
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

  
</style>

<body>








  <div class="main">




    <div class="container-fluid">



      <div class="row">


        <div class="panel panel-default">
          <br>
          <br>


          <div class="panel-heading" style="overflow: hidden;">

            <div class="col-md-2" style="width: 11%;">

              <img alt="User Pic" src="https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png" id="profile-image1" class="img-circle img-responsive img-thumbnail">

            </div>


            <div class="col-md-8">

              <table style="text-align: center;">

                <tbody>

                  <tr>

                    <td class="td_reponsive">RUT</td>

                    <td class="td_reponsive"><input type="text" class="form-control" id="rut_socio" placeholder="Ej: 11111111-1" oninput="checkRut(this)">

                      <span id="erut_socio" style="display:none;color:red;">Rut incorrecto</span>
                      <span id="eduplicado" style="display:none;color:red;">Rut ya esta registrado</span>
                    </td>

                    <td class="td_reponsive">Nombres</td>

                    <td class="td_reponsive"><input type="text" class="form-control" id="nombres" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">

                      <span id="errorNom" style="display:none;color:red;">incorrecto</span>

                    </td>

                  </tr>



                  <tr>

                    <td class="td_reponsive">Apellido Paterno</td>

                    <td class="td_reponsive"><input type="text" class="form-control" id="ap_paterno" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">

                      <span id="errorPat" style="display:none;color:red;">incorrecto</span>
                    </td>

                    </td>

                    <td class="td_reponsive">Apellido Materno</td>

                    <td class="td_reponsive"><input type="text" class="form-control" id="ap_materno" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">

                      <span id="errorMat" style="display:none;color:red;">incorrecto</span>

                    </td>

                  </tr>

                </tbody>

              </table>



            </div>



          </div>



          <div class="panel-body">

            <div class="row">

              <div class="col-md-12">

                <!-- Nav tabs -->

                <div class="card">

                  <ul class="nav nav-tabs" role="tablist">

                    <li role="presentation" id="h" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-list-alt"></i>  <span>Antecedentes Personales</span></a></li>

                    <li role="presentation" id="dep" class="inactivo"><a href="#depor" id="dep" aria-controls="settings" role="tab" data-toggle="tab"><i class="fa fa-futbol-o"></i>  <span>Deportes</span></a></li>

                    <li role="presentation" id="soc" class="inactivo"><a href="#profile" id="soc" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-user"></i>  <span>Socio</span></a></li>

                    <li role="presentation" id="carg" class="inactivo"><a href="#extra" id="carg" aria-controls="settings" role="tab" data-toggle="tab"><i class="fa fa-plus-square-o"></i>  <span>Cargas Familiares</span></a></li>


                  </ul>



                  <!-- Tab panes -->

                  <div class="tab-content" style="background: #f8f8f8;">







                    <div role="tabpanel" class="tab-pane active" id="home">

                      <!-- datos personales -->
                      <br>
                      <br>
                      <div class="bs-callout bs-callout-green col-md-4 panel panel-default">

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

                              <td>Fecha de nacimiento</td>

                              <td><input class="form-control w_fecha" type="text" name="txt_fecha" id="txt_fecha" value="<?php echo set_value('txt_fecha'); ?>" autocomplete="off"></td>

                            </tr>

                            <tr>

                              <td>Lugar nacimiento</td>

                              <td><input type="text" class="form-control" id="nac" name="nac" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"></td>

                            </tr>

                            <tr>

                              <td>Estado civil</td>

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

                              <td>Nacionalidad</td>

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

                      <div class="bs-callout bs-callout-green col-md-4 panel panel-default">

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

                      <div class="bs-callout bs-callout-green col-md-4 panel panel-default">

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

                    <div role="tabpanel" class="tab-pane " id="profile">

                      <div class="col-md-8">

                        <div class="panel panel-default">

                          <div class="panel-heading">Registro Corporaciones</div>

                          <div class="panel-body table-responsive">

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

                                        <!--  <a type="button" class="btn btn-info" id="mostrarDatos"><span>Consola datos</span></a> -->
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



                          </div>

                          <div class="panel-body table-responsive" id="div3" style="display:none;">
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Agregar</button>

                            <table width="100%" class="table table-bordered table-hover table-border" id="tablacargas" name="tablacargas">

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

                        <a href="#" class="btn btn-success" id="GuardarTodo">Guardar Todo</a>

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

    <div class="modal-dialog" style="width: 80%;">

      <!-- Modal content-->

      <div class="modal-content" style="width: auto;">

        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Carga</h4>

        </div>

        <div class="modal-body">

          <div class="form-group">

            <table class="table table-bordered  table-responsive" id="tablacargas" name="tablacargas">

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
  //Arrays de guadado de datos

  /*   var DatosP = new Array();
    var DatosDeportes = new Array();
    var DatosCorp = new Array();
    var DatosCargas = new Array(); */


  //Variables globales

  var DatosP = new Object();
  var DatosDeportes = new Object();
  var DatosCorp = new Object();
  var DatosCargas = new Object();


 // var validador = 0;



  //funcion para que tabs abarquen todo el espacio en ancho

  $(document).ready(function() {
    var numTabs = $('.nav-tabs').find('li').length;
    var tabWidth = 100 / numTabs;
    var tabPercent = tabWidth + "%";
    $('.nav-tabs li').width(tabPercent);

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

    $("#txt_fecha").datepicker();

  });

  $(function() {

    var numFilas = $("#BodyCorp tr").length;

    var cont = 1;

    for (i = 0; i < numFilas; i++) {

      $("#fecha_reg" + cont).datepicker();

      cont = cont + 1;

    }



  });

  $(function() {

    $("#nac_carga").datepicker();

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


  //AGREGAR CARGAR AL SOCIO

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

    DatosCargas["Cargas"] = DATA;
    DatosCargas["RutSocio"] = rut_socio;

    console.log(DATA);



    //eventualmente se lo vamos a enviar por PHP por ajax de una forma bastante simple y además convertiremos el array en json para evitar cualquier incidente con compativilidades.

    INFO = new FormData();

    

    aInfo = JSON.stringify(DATA);

    console.log(aInfo);



    INFO.append('data', aInfo);



    /*    $.ajax({

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

       }); */





  }



  //Guadar datos de socio en las corporaciones

  // llegan estas tablas por el nombre   <tbody id="BodyCorp"> = TABLAID y   <tbody id="tablePat" = TABLEID

  function grabaSocioCorp(TABLAID, TABLEID) {

    //tenemos 2 variables, la primera será el Array principal donde estarán nuestros datos y la segunda es el objeto tabla

    var DATA = [];

    var DATA_P = [];

    var TABLA = $("#" + TABLAID + " > tr"); // corporaciones

    var TABLE = $("#" + TABLEID + " > tr"); // socios patrocinantes

    var rut_socio = $('#rut_socio').val(); // rut del socio a ingresar

    var nacionalidad = $("#nacionalidad option:selected").val();

    validador = 0;



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




    //Agregamos Socios patrocinadores


    TABLE.each(function() {

      var RUT_PAT = $(this).find("td[id='rut_Soc']").text();

      item_p = {};



      item_p["rut_pat"] = RUT_PAT;

      //una vez agregados los datos al array "item" declarado anteriormente hacemos un .push() para agregarlos a nuestro array principal "DATA".

      DATA_P.push(item_p);





    });

    console.log(DATA_P);

    console.log(DATA);



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

      DatosCorp["Coporacion"] = DATA;
      DatosCorp["Patrocinador"] = DATA_P;
      DatosCorp["rutSocio"] = rut_socio;




      /*       $.ajax({ //empieza funcion que envia valores a controlador

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



            }); */


      $('#guardar_rs').attr('href', '#extra');
      $("li#soc").removeClass("active");

      $("li#carg").addClass("active");
    } else {




      alert('COMPLETE TODOS LOS CAMPOS');
      $('#guardar_rs').attr('href', 'javascript:void(0)');


    }




  }





  //Se agregar socio patrocinador a la tabla de vista para luego agregarla

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

      /*     alert(sel);
          alert(children);
          alert(cont);
 */
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


        $('#errorMail').show();

        vrfSocioMail = 1;
        validaInputSocio();





      } else {

        $('#errorMail').hide()

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


        $('#errorPat').show();




        vrfSocioPat = 1;
        validaInputSocio();
        //return false;

      } else {


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


          cel = $('#tel_fijo').val('');

          $('#errorTel').show();

          cel.focus;

          return cel;



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

      $(this).attr('maxlength', '9');

      var cel = $('#tel_cel').val();

      var filtro = /^([0-9]{9}$)/;

      //if(tecla.charCode < 48 || tecla.charCode > 57) 

      if (!filtro.test(cel)) {

        if (!(cel > 90 || cel < 10)) {

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


        $('#errorMat').show();




        vrfSocioMat = 1;
        validaInputSocio();


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



        $('#errorNom').show();




        vrfSocioNom = 1;
        validaInputSocio();


        //return false;

      } else {



        $('#errorNom').hide();

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

          //guardados de datos en array

          DatosP["rut"] = rut;

          DatosP["nombres"] = nombres;

          DatosP["paterno"] = paterno;

          DatosP["materno"] = materno;

          DatosP["fecha_nac"] = fecha_nac;

          DatosP["tel_fijo"] = tel_fijo;

          DatosP["tel_cel"] = tel_cel;

          DatosP["email"] = email;

          DatosP["direc"] = direc;

          DatosP["prof"] = prof;

          DatosP["direc_emp"] = direc_emp;

          DatosP["tel_emp"] = tel_emp;

          DatosP["estadocivil"] = estadocivil;

          DatosP["nacionalidad"] = nacionalidad;

          DatosP["laboral"] = laboral;

          DatosP["sexo"] = sexo;

          DatosP["comu"] = comu;

          DatosP["sector"] = sector;

          DatosP["emp"] = emp;

          DatosP["desc"] = desc;

          DatosP["nac"] = nac;


          console.log(DatosP);

          $("#rut_socio").attr("disabled", "disabled");

          $("#h").removeClass("active").addClass("inactivo");
          $("#dep").addClass("active");

















          /* 



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







                        }); */



        }



      });
    });



    //validar que socio ya este en base de datos

    $(document).ready(function() {

      $("#rut_socio").blur(function() {

        var rut_socio = $("#rut_socio").val();

        $.post("<?php echo base_url() ?>socios/nuevo_socio/ValidaSocio", {
          rut: rut_socio
        }, function(data) {
          var result = data;
          if (result == 1) {
            $('#eduplicado').show();

            vrfSocioDup = 1;
            validaInputSocio();
          } else {
            $('#eduplicado').hide();
            vrfSocioDup = 0;
            validaInputSocio();


          }

        });

      });
    });


    $("#mostrarDatos").click(function() {
      console.log(DatosP);


    });


    $("#GuardarTodo").click(function() {


      console.log(DatosP);
      console.log(DatosCorp);
      console.log(DatosCargas);
      console.log(DatosDeportes);



      $.ajax({

        cache: false,

        type: "POST",

        dataType: "json",

        data: {


          "DatosP": JSON.stringify(DatosP),
          "DatosCorp": JSON.stringify(DatosCorp),
          "DatosCargas": JSON.stringify(DatosCargas),
          "DatosDeportes": JSON.stringify(DatosDeportes),

        },

        url: "<?php echo base_url() ?>socios/nuevo_socio/nuevo_socio_agregar",

        success: function(data) {

         
          swal({
            title: "Guardado con exito!",
            text: "Socio",
            icon: "success",
          });

        },

        complete : function(xhr, status) {

        alert('Guardado con exito');
    }


      });

    });



    // agregar deportes
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

        DatosDeportes["Deportes"] = arr;
        DatosDeportes["rutSocio"] = rut;

        console.log(DatosDeportes);






/* 
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



        }); */

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