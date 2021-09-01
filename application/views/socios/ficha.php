<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="UTF-8">

  <title>Ficha Socio</title>

</head>

<style>
  @media only screen and (min-width: 0px) and (max-width: 550px) {


    .td_reponsive {
      display: inline-block;
      padding: 3px;
      width: 100%;
    }
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









  .bs-callout-green h4 {

    color: #4b7006;

  }

  .bs-callout-green {

    border-left: 5px solid #4b7006;


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
    width: 14%;
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
    font-size: 10px;
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



  /*==================================================





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
</style>

<body>

  <?php


  function getPuntosRut($rut)
  {

    $rutTmp = explode("-", $rut);

    return number_format($rutTmp[0], 0, "", ".") . '-' . $rutTmp[1];
  }

  setlocale(LC_ALL, 'es_ES') . ': ';

  foreach ($datos_personales as $dp) {



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

    $comuna = $dp->comuna_nombre;

    $provincia = $dp->provincia_nombre;

    $region = $dp->region_nombre;

    $estado_civil = $dp->estacivil_nombre;

    $nacionalidad = $dp->nac_nombre;

    $dep = $dp->int_deport;

    $deportes = explode(",", $dep);











    if ($sexo == 1) {
      $sexo_txt = "Masculino";
    } else {
      $sexo_txt = "Femenino";
    }

    if (!empty($direccion)) {
      $direccion_txt = $direccion . ', ';
    }

    if (!empty($poblacion)) {
      $poblacion_txt = $poblacion . ', ';
    }
  }



  ?>

  <div class="main">

    <div class="container-fluid">

      <div class="row">

        <div class="panel panel-default">

          <div class="panel-heading" style="overflow: hidden;">

            <div class="col-md-1" style="width: 11%;">

              <img alt="User Pic" src="https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png" id="profile-image1" class="img-circle img-responsive img-thumbnail">

            </div>

            <div class="col-md-6">
              <h2>

                <?php echo $nombre . ' ' . $ap_paterno . ' ' . $ap_materno; ?></h2>

              <p> <b> Rut : <?php echo getPuntosRut($rut); ?></b></p>

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

                  ?>

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

                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-list-alt"></i>  <span>Antecedentes <br> Personales</span></a></li>

                    <li role="presentation" id="dep"><a href="#depor" id="dep" aria-controls="settings" role="tab" data-toggle="tab"><i class="fa fa-futbol-o"></i>  <span>Intereses <br> Deportivos</span></a></li>

                    <li role="presentation"><a href="#extra" aria-controls="settings" role="tab" data-toggle="tab"><i class="fa fa-plus-square-o"></i>  <span>Cargas <br> Familiares</span></a></li>

                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-user"></i>  <span> <br>Socio</span></a></li>



                    <li role="presentation"><a href="#cuotas" aria-controls="settings" role="tab" data-toggle="tab"><i class="fa fa-usd"></i>  <span>Cuotas <br> Sociales</span></a></li>

                    <li role="presentation"><a href="#messages" aria-controls="settings" role="tab" data-toggle="tab"><i class="fa fa-briefcase"></i>  <span><br>Acciones</span></a></li>

                    <li role="presentation"><a href="#noti" aria-controls="settings" role="tab" data-toggle="tab"><i class="fa fa-envelope"></i>  <span><br> Notificaciones</span></a></li>



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

                              <td width="31%">Sexo</td>

                              <td width="69%"><?php echo $sexo_txt; ?></td>

                            </tr>

                            <tr>

                              <td>fecha de nacimiento</td>

                              <td><?php echo iconv('ISO-8859-1', 'UTF-8', strftime('%d %b de %Y',  strtotime($fecha_nacimiento))); ?></td>

                            </tr>

                            <tr>

                              <td>estado civil</td>

                              <td><?php echo $estado_civil; ?></td>

                            </tr>

                            <tr>

                              <td>nacionalidad</td>

                              <td><?php echo $nacionalidad; ?></td>

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

                              <td width="69%"><?php echo $telefono ?></td>

                            </tr>

                            <tr>

                              <td>Celular</td>

                              <td><?php echo $celular ?></td>

                            </tr>

                            <tr>

                              <td>Correo</td>

                              <td><?php echo $email; ?></td>

                            </tr>

                            <tr>

                              <td>Dirección</td>

                              <td><?php echo $direccion_txt . '' . $poblacion_txt . '' . $comuna . ', ' . $provincia . ', ' . $region; ?></td>

                            </tr>

                          </tbody>

                        </table>

                      </div>

                      <!--DATOS DE trabajo -->

                      <div class="bs-callout bs-callout-green col-md-4 panel panel-default">

                        <h4>Antecendes Laborales</h4>

                        <table width="100%" class="table tbl-datos">

                          <tbody>

                            <tr>

                              <td width="31%">Situación Laboral</td>

                              <td width="69%">Contrato Fijo</td>

                            </tr>

                            <tr>

                              <td>Actividad o Profesión</td>

                              <td><?php echo $profesion; ?></td>

                            </tr>

                            <tr>

                              <td>Empresa</td>

                              <td><?php echo $empresa_job; ?></td>

                            </tr>

                            <tr>

                              <td>Dirección</td>

                              <td><?php echo $direccion_job; ?></td>

                            </tr>

                            <tr>

                              <td>Telefono</td>

                              <td><?php echo $fono_job; ?></td>

                            </tr>

                          </tbody>

                        </table>

                      </div>

                    </div>

                    <!-- PESTAÑA SOSCIO -->

                    <div role="tabpanel" class="tab-pane" id="profile">

                      <div class="col-md-9">

                        <div class="panel panel-default">

                          <div class="panel-heading">Registro Corporaciones</div>

                          <div class="panel-body table-responsive">

                            <table width="100%" class="registro_socios table table-striped">

                              <thead>

                                <tr>

                                  <th>Corporación</th>

                                  <th>Estado</th>

                                  <th>Nº Registro</th>

                                  <th>Nº Libro</th>

                                  <th>Fecha de registro</th>

                                  <th>Fecha de retiro</th>

                                </tr>

                              </thead>

                              <tbody>

                                <?php

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

                                        $fecha_registro = $ci->fecha_registro;

                                        $ci_fecha_retiro = $ci->fecha_retiro;

                                        $ci_condicion = $ci->estado;

                                        //$ci_color = $ci -> cond_color;

                                        $ci_color = '#1bbd1b';



                                        if ((empty($ci_fecha_retiro)) or ($ci_fecha_retiro == "0000-00-00")) {

                                          $ci_fecha_retiro_b = "-";
                                        } else {

                                          $ci_fecha_retiro_b = $ci_fecha_retiro;
                                        }



                                        if ((empty($fecha_registro)) || ($fecha_registro == "0000-00-00")) {

                                          $fecha_registro_b = "-";
                                        } else {

                                          $fecha_registro_b = $fecha_registro;
                                        }



                                        if ($ci_condicion == 0) {

                                          $estado = 'Vigente';
                                        } else {

                                          $estado = 'No Vigente';
                                        }



                                        echo '

                                  <td><span class="label" style="background:' . $ci_color . ';">' . $estado . '</span></td>

                                  <td>' . $ci_n_registro . '</td>

                                  <td>' . $ci_libro . '</td>

                                  <td>' . $fecha_registro . '</td>

                                  <td>' . $ci_fecha_retiro_b . '</td>';
                                      }
                                    } else {

                                      echo ' <td></td>                                  

                                  <td></td>

                                  <td></td>

                                  <td></td>

                                  <td></td>';
                                    }

                                    echo '</tr>';
                                  }
                                }

                                ?>





                              </tbody>

                            </table>

                          </div>

                        </div>



                      </div>

                      <div class="col-md-3">

                        <div class="panel panel-default">

                          <div class="panel-heading">Socio Patrocinador</div>

                          <div class="panel-body box-pat">

                            <ul>

                              <?php

                              if (!empty($patrocinadores)) {

                                foreach ($patrocinadores as $p) {

                                  echo '<li class="pat"><a href="' . base_url() . '/socios/ficha/detalle/' . $p->prsn_rut . '">' . $p->prsn_apellidopaterno . ' ' . $p->prsn_apellidomaterno . ' ' . $p->prsn_nombres . '</a></li>';
                                }
                              } else {
                                echo "<li>No registra.</li>";
                              }

                              ?>

                            </ul>

                          </div>

                        </div>

                      </div>

                      <div class="col-md-3">
                        <div class="panel panel-default">

                          <div class="panel-heading">Patrocina a : </div>

                          <div class="panel-body box-pat">

                            <ul>

                              <?php

                              if (!empty($patrocinados)) {

                                foreach ($patrocinados as $pp) {

                                  echo '<li class="pat"><a  href="' . base_url() . '/socios/ficha/detalle/' . $pp->prsn_rut . '">' . $pp->prsn_apellidopaterno . ' ' . $pp->prsn_apellidomaterno . ' ' . $pp->prsn_nombres . '</a></li>';
                                }
                              } else {
                                echo "<li>No registra.</li>";
                              }

                              ?>



                            </ul>

                          </div>

                        </div>

                      </div>

                      <!--     <div class="col-md-12" style="padding-top: 15px;">

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







                    </div>
                    <div role="tabpanel" class="tab-pane" id="noti">

                      <div class="col-md-12">

                        <div class="panel panel-default">

                          <div class="panel-heading">Registro de notificaciones </div>

                          <div class="panel-body table-responsive">

                            <table width="100%" id="reg_accion" class="table table-bordered table-hover">

                              <thead>

                                <tr>
                                  <td width="10%">Motivo</td>
                                  <td width="10%">Fecha</td>
                                  <td width="55%">Observación</td>
                                  <td width="15%">Tipo Contacto</td>
                                  <td width="10%">Responsable</td>
                                </tr>
                              </thead>
                              <tbody>

                                <?php
                                $noti = $this->model_socios->notificaciones($rut);

                                //var_dump($corp);

                                if (!empty($noti)) {

                                  foreach ($noti as $n) {
                                    $rutUsuario = $n->funcionario;
                                    $usuario = $this->model_socios->funcionario($rutUsuario);
                                    foreach ($usuario as $u) {
                                      $nombre = $u->nombre_fun;
                                      $paterno = $u->paterno;
                                    }
                                    $fecha = date("d-m-Y", strtotime($n->fecha_resol));


                                    $contacto = $n->tip_contacto;
                                    if ($contacto == 1) {
                                      $tip_contact = 'Teléfonico';
                                    }
                                    if ($contacto == 2) {
                                      $tip_contact = 'Email';
                                    }
                                    if ($contacto == 3) {
                                      $tip_contact = 'Whatsapp';
                                    }
                                    if ($contacto == 4) {
                                      $tip_contact = 'Visita';
                                    }
                                    echo '<tr>
                              <td>' . $n->motivo_resol . '</td>
                              <td>' . $fecha . '</td>
                              <td>' . $n->obs_resol . '</td>
                               <td>' . $nombre . ' ' . $paterno . '</td>
                               <td>' . $tip_contact . '</td>

                              </tr>';
                                  }
                                }



                                ?>

                              </tbody>
                            </table>
                          </div>

                        </div>

                      </div>

                    </div>

                    <div role="tabpanel" class="tab-pane" id="messages">

                      <div class="col-md-3">

                        <div class="panel panel-default">
                          <?php

                          $nro_acciones = $this->model_accionistas->nro_acciones($rut);
                          if (empty($nro_acciones)) {
                            $nro_acciones = 0;
                          }

                          $datos = $this->model_accionistas->datos_ac($rut);
                          $largo = count($datos);

                          $titulos = [];
                          $libro = [];
                          $fojas = [];
                          $i = 0;
                          foreach ($datos as $d) {



                            $titulos[$i] =  $this->model_accionistas->nro_titulo($d->prsn_rut);

                            $libro[$i] = $d->libro_accionista;
                            $fojas[$i] = $d->foja_accionista;
                            $i++;
                          }




                          ?>
                          <div style="text-align: center;">
                            <h2 class="n_accion"><?php echo $nro_acciones; ?></h2><span>Acción</span>
                          </div>

                          <div>
                            <table style="width:100%" class="table table-bordered table-hover" border="0">
                              <tr>
                                <th>N° Título</th>
                                <?php for ($i = 0; $i < $largo; $i++) {
                                  echo '<td><center>';

                                  foreach ($titulos[$i] as $t) {
                                    echo ' #' . $t->nro_titulo;
                                  }
                                  echo '</center></td>';
                                } ?>

                              </tr>
                              <tr>
                                <th>Libro</th>
                                <?php for ($i = 0; $i < $largo; $i++) {
                                  echo '<td><center>' . $libro[$i] . '</center></td>';
                                } ?>
                              </tr>
                              <tr>
                                <th>Fojas</th>
                                <?php for ($i = 0; $i < $largo; $i++) {
                                  echo '<td><center>' . $fojas[$i] . '</center></td>';
                                } ?>
                              </tr>
                            </table>


                          </div>

                        </div>

                      </div>

                      <div class="col-md-9">

                        <div class="panel panel-default">

                          <div class="panel-heading">Registro de acciones </div>

                          <div class="panel-body">

                            <table width="100%" id="reg_accion" class="table table-bordered table-hover" style="text-align: center;">

                              <thead>

                                <tr>

                                  <td>fecha emisión</td>

                                  <td>tipo de <br>transaccion<br></td>

                                  <td>Comprado a </td>

                                  <td>Vendido a</td>

                                  <td>Nº Titulo<br>Nuevo del <br>Comprador</td>

                                  <td>Nº Titulo<br>Inutilizado</td>



                                </tr>

                              </thead>

                              <tbody>
                                <?php

                                foreach ($datos as $d) {

                                  if ($d->tipo == 1) {
                                    $compradoA = '-';
                                    $vendidoA = '-';
                                    $tipoTrans = 'Nueva';
                                    $fecha = $d->fecha;
                                    $titulo = $d->nro_titulo;
                                    $titulo_in = '-';
                                  }


                                  echo '<tr>
                             <td>' . $fecha . '</td>
                             <td>' . $tipoTrans . '</td>
                             <td>' . $compradoA . '</td>
                             <td>' . $vendidoA . '</td>
                             <td>' . $titulo . '</td>
                             <td>' . $titulo_in . '</td>
                             
                             </tr>';
                                }

                                ?>

                              </tbody>

                            </table>

                          </div>

                        </div>

                      </div>

                    </div>

                    <div role="tabpanel" class="tab-pane" id="depor">





                      <div id="div2" class="col-md-7">

                        <div class="panel panel-default">

                          <div class="panel-heading">Deportes:</div>

                          <div class="panel-body ">

                            <ul>

                              <?php

                              for ($i = 0; $i < count($deportes); $i++) {

                                $comp = trim($deportes[$i]);



                                if (strcmp($comp, '1') == 0) {

                                  echo ' <li>Fútbol</li>';
                                }

                                if (strcmp($comp, '2') == 0) {

                                  echo ' <li>Basketball</li>';
                                }

                                if (strcmp($comp, '3') == 0) {

                                  echo ' <li>Tenis</li>';
                                }

                                if (strcmp($comp, '4') == 0) {

                                  echo ' <li>Tiro al Plato</li>';
                                }

                                if (strcmp($comp, '5') == 0) {

                                  echo ' <li>Natación</li>';
                                }

                                if (strcmp($comp, '6') == 0) {

                                  echo ' <li>Voleiball</li>';
                                }

                                if (strcmp($comp, '7') == 0) {

                                  echo ' <li>Pool</li>';
                                }
                              }







                              ?>



                            </ul>

                          </div>

                        </div>

                      </div>



                    </div>

                    <div role="tabpanel" class="tab-pane" id="cuotas">

                      <div class="col-md-12">

                        <div class="panel panel-default">

                          <div class="panel-heading">Pagos Cuotas Sociales</div>

                          <div class="panel-body table-responsive">

                            <table width="100%" id="pagos" class="table table-bordered table-hover">

                              <thead>

                                <tr>

                                  <td style="width: 10%;">Año</td>

                                  <td style="width: 10%;">Semestre</td>

                                  <td>Total Pagado</td>

                                  <td>Observación</td>

                                  <td>Estado</td>

                                  <td>Detalle</td>

                                </tr>

                              </thead>

                              <tbody>

                                <?php

                                foreach ($cuotas as $ct) {

                                  $ano = $ct->ano;

                                  $sem = $ct->semestre;

                                  $pagado = $ct->total_pagado;

                                  $obser = $ct->observ_cuota;

                                  $estado = $ct->estado;

                                  $id_cuota = $ct->cuota_ordinaria_id_cuota;

                                  $pag = number_format($pagado, 0, ",", ".");

                                  $saldo = $ct->saldo;

                                  $saldo_total = $saldo_total + $saldo;

                                  $total = $total + $pagado;

                                  if ($estado == 1) {

                                    $es = 'Pagada';
                                  } else {

                                    $es = 'Impaga';
                                  }

                                  echo '<tr>

                                    <td>' . $ano . '</td>

                                    <td>' . $sem . '</td>

                                    <td>' . '$' . $pag . '</td>

                                    <td>' . $obser . '</td>

                                    <td>' . $es . '</td>

               <td><button type="button" class="btn btn-default" data-toggle="modal" href="#modalcuotas"  id="' . $id_cuota . '" onClick="selPersona(\'' . $id_cuota . '\',\'' . $ano . '\',\'' . $sem . '\',\'' . $rut . '\');">  <span class="glyphicon glyphicon-edit"></span></button></td>';



                                  echo '</tr>';
                                }









                                ?>



                              </tbody>

                            </table>






                            <!-- Modal -->

                            <div class="modal fade" id="modalcuotas" role="dialog">

                              <div class="modal-dialog">

                                <!-- Modal content-->

                                <div class="modal-content" style="width: 800px;">

                                  <div class="modal-header">

                                    <button type="button" class="close" data-dismiss="modal">&times;</button>



                                  </div>

                                  <div class="modal-body">



                                    <div id="modal_cuotas"></div>

                                    <div class="form-group">



                                    </div>

                                  </div>

                                  <div class="modal-footer">

                                    <!--Uso la funcion onclick para llamar a la funcion en javascript-->



                                  </div>

                                </div>

                              </div>

                            </div>





                          </div>
                          <div>
                            <span style="font-size: 24px;"> Total Pagado Cuotas: <?php $total_pag = number_format($total, 0, ",", ".");
                                                                                  echo '$' . $total_pag; ?></span>

                            <br>

                            <span style="font-size: 24px;"> Deuda Total Cuotas: <?php $total_sal = number_format($saldo_total, 0, ",", ".");
                                                                                echo '$' . $total_sal; ?></span>

                          </div>

                        </div>



                      </div>

                    </div>











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

                                  if (!empty($c->prsn_fechanacimi)) {
                                    $edad = calculaedad($c->prsn_fechanacimi);
                                  } else {
                                    $edad = '-';
                                  }

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
  selPersona = function(id, ano, sem, rut) {

    // $('#ano').val(ano);



    rut = rut;

    sem = sem;

    ano = ano;



    $.post("<?php echo base_url() ?>socios/Pago_cuota/detalle_cuotas", {

      sem: sem,

      ano: ano,

      rut: rut
    }, function(data) {

      $("#modal_cuotas").html(data);

    });

  };
</script>