<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="UTF-8">

  <title>Ficha Socio <?php echo getPuntosRut($rut); ?> </title>

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

    min-width: 50px;

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

    background: #4b7006;

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

  .img-responsive {


    object-fit: cover;
    object-position: center center;
    width: 120px;
    height: 120px;

  }

 /*  .archivos_socios {


  } */



 
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


  function FotoPerfil($dir)
  {
    //valido que se encuentre directorio en base de datos
    if (!empty($dir)) {

      $dir = $dir . "/perfil";
      $ignorados = array('.', '..', '.svn', '.htaccess');
      $archivos = array();
      $urlBase = base_url();

      if (is_dir($dir)) {

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

          echo 'https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png';
        } else {

          //muestro la foto mas reciente

          echo ($urlBase . $dir . '/' . $archivos[0]);
        }
      } else {

        echo 'https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png';
      }
    } else {
      echo 'https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png';
    }
  }




  function  Ver_ArchivosSocios($directorio)
  {

    $directorio = $directorio . '/docs';


    if (is_dir($directorio)) {

      $listado = scandir($directorio);

      $urlBase = base_url();

      unset($listado[array_search('.', $listado, true)]);

      unset($listado[array_search('..', $listado, true)]);

      /*    var_dump($listado);
        var_dump($directorio); */


      if (count($listado) < 1) {

        echo 'Directorio Vacio';
      } else {



        foreach ($listado as $elemento) {

          if (!is_dir($directorio . '/' . $elemento)) {

            echo '<li style="list-style-type:none;" class="padding"><a href="' . $urlBase . $directorio . '/' . $elemento . '" target="_blank" class="archivos_socios form-control" >' . $elemento . '</a></li>';
          }
          if (is_dir($directorio . '/' . $elemento)) {
            echo '<li style="list-style-type:none;" class="open-dropdown padding"><a href="javascript:void(0)"   class="btn btn-primary ">' . $elemento . '<b class="caret"></b> </a> </li>';
            echo '<ul class="dropdown d-none">';
            Ver_ArchivosSocios($directorio . '/' . $elemento);
            echo '</ul>';
          }
        }
      }
    } else {

      echo 'No existe directorio';
    }
  }



  ?>



  <div class="main">

    <div class="container-fluid">

      <div class="row">

        <div class="panel panel-default">

          <div class="panel-heading" style="overflow: hidden;">

            <div class="col-md-2">
              <center>
                <img alt="User Pic" src="<?php FotoPerfil($InfoSocio->path) ?>" id="profile-image1" class="img-circle img-responsive img-thumbnail">
              </center>
            </div>




            <div class="col-md-6">
              <h2>

                <?php echo $nombre . ' ' . $ap_paterno . ' ' . $ap_materno; ?></h2>

              <p> <b> Rut : <?php echo getPuntosRut($rut); ?></b></p>

            </div>

          

          </div>



          <div class="panel-body">

            <div class="row">

              <div class="col-md-12">

                <!-- Nav tabs -->

                <div class="card">

                  <ul class="nav nav-tabs" role="tablist">


                    <li role="presentation" class="" id="dep"><a href="#depor" id="dep" aria-controls="settings" role="tab" data-toggle="tab"><i class="fa fa-futbol-o"></i>  <span> <br>Salud</span></a></li>

                  



                  </ul>



                  <!-- Tab panes -->

                  <div class="tab-content" style="background: #f8f8f8;">



                    <div role="tabpanel" class="tab-pane active" id="depor">

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

                     

                    

                    </div>

                    <!-- PESTAÑA SOSCIO -->

               
                
                    

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
  $(document).ready(function() {
    var numTabs = $('.nav-tabs').find('li').length;
    var tabWidth = 100 / numTabs;
    var tabPercent = tabWidth + "%";
    $('.nav-tabs li').width(tabPercent);

  });




</script>