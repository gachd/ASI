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

    .nav-tabs>li>a>span {
      display: none;
    }

    .nav-tabs>li>a {
      padding: 5px 5px;
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


  function formatFecha($fecha)
  {
    if ($fecha) {
      return date("d/m/Y", strtotime($fecha));
    } else {
      return "";
    }
  }



  setlocale(LC_ALL, 'es_ES') . ': ';

  if (!empty($datos_personales)) {



    $nombre = $datos_personales->prsn_nombres;

    $ap_paterno = $datos_personales->prsn_apellidopaterno;

    $ap_materno = $datos_personales->prsn_apellidomaterno;

    $fecha_nacimiento = $datos_personales->prsn_fechanacimi;

    $email = $datos_personales->prsn_email;

    $telefono = $datos_personales->prsn_fono_casa;

    $celular = $datos_personales->prsn_fono_movil;

    $fono_job = $datos_personales->prsn_fono_trabajo;

    $profesion = $datos_personales->prsn_profesion;

    $direccion_job = $datos_personales->prsn_direccion_empresa;

    $empresa_job = $datos_personales->prsn_empresa;

    $sexo = $datos_personales->prsn_sexo;

    $descendiente = $datos_personales->prsn_descendiente;

    $direccion = $datos_personales->prsn_direccion;

    $poblacion = $datos_personales->prsn_sectorvive;

    $comuna = $datos_personales->comuna_nombre;

    $provincia = $datos_personales->provincia_nombre;

    $region = $datos_personales->region_nombre;

    $estado_civil = $datos_personales->estacivil_nombre;

    $nacionalidad = $datos_personales->nac_nombre;

    $dep = $datos_personales->int_deport;

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
      $poblacion_txt = $poblacion . '';
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




  function  Ver_ArchivosFitness($directorio)
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


  $direccion_personal = $direccion_txt  . $poblacion_txt  . $comuna  . $provincia . $region;


  ?>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>


  </div>


  <div class="main">

    <div class="container-fluid">

      <div class="row">

        <div class="panel panel-default">

          <div class="panel-heading" style="overflow: hidden;">

            <div class="col-md-2">
              <center>
                <img alt="User Pic" src="<?php FotoPerfil($fitness->path) ?>" id="profile-image1" class="img-circle img-responsive img-thumbnail">
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

                              <td>Sexo</td>

                              <td><?php echo $sexo_txt; ?></td>

                            </tr>

                            <tr>

                              <td>fecha de nacimiento</td>

                              <td><?php echo  formatFecha($fecha_nacimiento); ?></td>

                            </tr>


                            <tr>

                              <td>Telefono</td>

                              <td><?php echo $celular ?></td>

                            </tr>

                            <tr>

                              <td width="31%">Correo</td>

                              <td width="69%"><?php echo $email; ?></td>

                            </tr>

                            <tr>

                              <td width="31%">Dirección</td>

                              <td width="69%"><?php echo $direccion_personal ?></td>

                            </tr>





                          </tbody>

                        </table>

                      </div>

                      <!--DATOS DE CONTACTO -->



                      <!--DATOS DE FITNESS -->

                      <div class="bs-callout bs-callout-green col-md-4 panel panel-default">

                        <h4>Datos fitness</h4>




                        <table width="100%" class="table tbl-datos">

                          <tbody>

                            <tr>

                              <td width="31%">Estatura</td>

                              <td width="69%"><?php echo $fitness->estatura . " M."; ?></td>

                            </tr>

                            <tr>

                              <td width="31%">Peso</td>

                              <td width="69%"><?php echo $fitness->peso . " KG."; ?></td>

                            </tr>

                            <tr>

                              <td width="31%">IMC</td>

                              <td width="69%"><?php echo $fitness->imc . " mm."; ?> </td>

                            </tr>
                            <tr>

                              <td width="31%">Patologias de base</td>

                              <td width="69%"><?php echo $fitness->patologias_base; ?> </td>

                            </tr>
                            <tr>

                              <td width="31%">PC Bicipital</td>

                              <td width="69%"><?php echo $fitness->pc_bicipital . " mm."; ?> </td>

                            </tr>
                            <tr>

                              <td width="31%">PC Tricipital</td>

                              <td width="69%"><?php echo $fitness->pc_tricipital . " mm."; ?> </td>

                            </tr>

                            <tr>

                              <td width="31%">PC Subescapular</td>

                              <td width="69%"><?php echo $fitness->pc_subescapular . " mm."; ?> </td>

                            </tr>

                            <tr>

                              <td width="31%">PC Suprailiaco</td>

                              <td width="69%"><?php echo $fitness->pc_suprailiaco . " mm."; ?> </td>

                            </tr>

                            <tr>

                              <td width="31%">PC Muslo</td>

                              <td width="69%"><?php echo $fitness->pc_muslo . " mm."; ?> </td>

                            </tr>

                            <tr>

                              <td width="31%">PC Abdominal</td>

                              <td width="69%"><?php echo $fitness->pc_abdominal . " mm."; ?> </td>

                            </tr>

                            <tr>

                              <td width="31%">PC pecho</td>

                              <td width="69%"><?php echo $fitness->pc_pecho . " mm."; ?> </td>

                            </tr>

                            <tr>

                              <td width="31%">PC axilar</td>

                              <td width="69%"><?php echo $fitness->pc_axilar . " mm."; ?> </td>

                            </tr>
                            <tr>

                              <td width="31%">PC pierna</td>

                              <td width="69%"><?php echo $fitness->pc_pierna . " mm."; ?> </td>

                            </tr>
                            <tr>

                              <td width="31%">objetivos</td>

                              <td width="69%"><?php echo $fitness->objetivos; ?> </td>

                            </tr>





                          </tbody>

                        </table>




                      </div>

                      <!--DATOS documentos -->
                      <div class="bs-callout bs-callout-green col-md-4 panel panel-default">

                        <h4>Archivos</h4>


                        <table width="100%" class="table tbl-datos">

                          <tbody>

                            <tr>



                              <td width="100%"> <?php Ver_ArchivosFitness($fitness->path); ?></td>

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