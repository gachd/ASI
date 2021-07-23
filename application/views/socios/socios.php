<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>SOCIOS</title>
</head>
<style>
  .ico.badge.badge-success {
    background-color: #008928;

  }

  .ico.badge.badge-danger {

    background-color: #e10000;

  }

  body {

    font-size: 12px;

    height: 0%;



  }

  a.button {

    -webkit-appearance: button;

    -moz-appearance: button;

    appearance: button;



    text-decoration: none;

    color: initial;

  }





  #drop {

    display: inline-block;

  }

  ul#dropdown-menu {

    min-width: 500px;

    margin-top: 2px;

  }

  .dropdown-notify {

    display: block;

    padding: 10px 15px;

  }

  .dropdown-notify:hover {

    background: #eee;

  }

  .dropdown-notify-btn {

    border: 2px solid #00a99d;

    border-radius: 5px;

    padding: 6px 10px 6px 10px;

    background: white;

    text-transform: uppercase;

    font-weight: 500;

    color: #173e88;

  }

  .dropdown-notify-header {

    color: white;

    margin-top: -8px;

    border-top-left-radius: 5px;

    border-top-right-radius: 5px;

    background: #347ab8;

    font-weight: 700;

  }

  .dropdown-notify-header:hover {

    background: #347ab8;

    color: white;

    text-decoration: none;

  }

  #dropdown-menu a {

    color: #333;

  }

  #dropdown-menu a:hover {

    color: #333;

    text-decoration: none;

  }

  #bubble {

    background: #F93943;

  }

  .fa-envelope-o {

    font-size: 18px;

    position: relative;

    top: 1px;

    left: -3px;

    margin-right: 2px;

    color: #173e88;

  }

  .notify-title {

    font-weight: 700;

  }

  .notify-message {

    margin-bottom: 5px;

  }

  .notify-date {

    margin-bottom: 0px;

    font-size: 12px;

    letter-spacing: 1px;

  }

  .menu {

    padding: 10px 10px 10px 10px;

    margin-bottom: 0px;

  }

  .menu nav {

    margin-bottom: 0px;



  }

  #example img {

    width: 25px;

  }

  #example tbody td {

    padding-bottom: 0px;

  }
</style>

<body>







  <div class="main">

    <!--<div class="header">

  		<div class="container">

  			<div class="row">

  				<h1>Administración Socios</h1>

  			</div>

  		</div>

  	</div>-->



    <div class="page-content">

      <div class="menu row well">



        <div class="content-box-large">
          <div class="col-md-3">
            <h1>Administración Socios</h1>
          </div>

          <div class="col-md-9">
            <div class="btn-group" style="float: right;">
              <button type="button" class="btn btn-primary" id="menuprincipal"><span class="badge"><i class="glyphicon glyphicon-home"></i> Menú <br> Principal</span></button>
              <button type="button" class="btn btn-danger" id="menupagos"><span class="badge"><i class="glyphicon glyphicon-usd"></i>Menú <br> Pagos</span></button>
              <button type="button" class="btn btn-warning" id="gestionsocios"><span class="badge"><i class="glyphicon glyphicon-lock"></i>Gestión <br> Socios</span></button>
              <button type="button" class="btn btn-success" id="dato_pagos"><span class="badge"><i class="glyphicon glyphicon-signal"></i>Datos <br> Socios</span></button>
              <button type="button" class="btn btn-info" id="agenda"><span class="badge"><i class="glyphicon glyphicon-envelope"></i>Agenda <br> Socios</span></button>



              <!-- <div class="dropdown" id="drop">  

  <button class="dropdown-notify-btn"  id="dLabel" type="button"><img  src="<?php echo base_url(); ?>assets/images/ico-cumple.png"><span class="badge" id="bubble"><?php echo $cumple ?></span><span class="caret"></span>

  </button>

  <?php if ($cumple != 0) {
    echo '<ul class="dropdown-menu" id="dropdown-menu">
    <li class="dropdown-notify dropdown-notify-header">Cumpleaños</li>';
    for ($i = 0; $i < $cumple; $i++) {
      $rut =  $cumpleañeros[$i];
      $datos = $this->model_socios->persona($rut);
      foreach ($datos as $d) {

        echo '

      <li class="dropdown-notify">

        <p class="notify-title">' . $d->prsn_nombres . ' ' . $d->prsn_apellidopaterno . '</p>

        <p class="notify-msg">' . $rut . '</p>

        <p class="notify-date">' . $edad[$i] . ' años</p>

      </li>';
      }
    }

  ?>

  

        

  </ul>

   <?php } ?>

   </div>-->

            </div>

          </div>



          <!-- <div class="col-md-5">
            <nav class="navbar navbar-default nav-titulo">
              <div class="col-md-3">
                <label style="text-align:center;">GENERADOR DE LISTADOS</label>
              </div>
              <div class="col-md-6">  
              
                <form class="form-inline">
                  <div class="form-group">
                    <label>Tipo:</label>
                    <select class="form-control " name="tipo" id="select_tipo">
                      <option value="">seleccionar</option>
                      <option value="1">Completo</option>
                      <option value="2">Socios activos</option>
                      <option value="3">Socios honorarios</option>
                      <option value="4">Socios al día</option>
                      <option value="5">Socios con deuda</option>
                    </select>
                  </div>
                </form>
              </div>
              <div class="col-md-3">
                <a href="#" title="Exportar" id="pdf" class="descargar btn btn-sm btn-warning"><span class="glyphicon glyphicon-circle-arrow-down"></span> Descargar PDF</a>
              </div>



            </nav>

          </div>-->



        </div>



      </div>

      <div class="row" id="mostrarSocios">

        <div class="col-md-12">



          <div class="content-box-large">

            <div class="panel-heading">

              <div class="panel-title">LISTADO DE SOCIOS</div>

            </div>

            <div class="panel-body">

              <div class="table-responsive">

                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">

                  <thead>

                    <tr>



                      <th width="28%">Rut</th>

                      <th width="50%">Nombre Completo</th>

                      <th width="7%">Tipo Socio</th>

                      <th width="3%">Centro</th>

                      <th width="3%">Atletico</th>

                      <th width="3%">Concordia</th>

                      <th width="3%">Stadio</th>

                      <th width="3%">Scuola</th>

                      <th>Último Pago</th>

                      <th>Cuota Social</th>







                    </tr>

                  </thead>

                  <tbody>

                    <?php if (!empty($socios)) {

                      $corp = [];

                      $corp[0] = '70331500-3';

                      $corp[1] = '71888800-k';

                      $corp[2] = '72265900-7';

                      $corp[3] = '65106820-7';

                      $corp[4] = '65467840-5';





                      foreach ($socios as $s) {





                        echo '<tr class="odd gradeX">';

                        echo '<td><div class="col-md-9">' . $s->prsn_rut . '</div><div class="col-md-3"><a  href="' . base_url() . '/socios/ficha/detalle/' . $s->prsn_rut . '"><span class="ico badge badge-info"><i class="glyphicon glyphicon-search"></i></span></a></div>';

                        //

                        echo '<td>' . $s->prsn_nombres . ' ' . $s->prsn_apellidopaterno . ' ' . $s->prsn_apellidomaterno . '</td>';



                        if (($s->tipo_id == 3) || ($s->tipo_id == 2)) {

                          $tiposocio = 1;

                          echo '<td><div hidden>' . $tiposocio . '</div><center><img title="Honorario" src="' . base_url() . 'assets/images/honorario.png"></center></td>';
                        } else {

                          $tiposocio = 0;

                          echo '<td><div hidden>' . $tiposocio . '</div><center><img  src="' . base_url() . 'assets/images/socio_activo.png"></center></td>';
                        }





                        (string) $rut = $s->prsn_rut;

                        for ($i = 0; $i < 5; $i++) {

                          $corpora = $this->model_socios->socio_corp($rut, $corp[$i]);

                          if (!empty($corpora)) {

                            $estado = 1;

                            echo '<td><div hidden>' . $estado . '</div><center><span class="ico badge badge-success"><i class="glyphicon glyphicon-ok"></i></span></center></td>';
                          } else {

                            $estado = 0;

                            echo '<td><div hidden>' . $estado . '</div><center><span class="ico badge badge-danger"><i class="glyphicon glyphicon-remove"></i></span></center></td>';
                          }
                        }



                        if ($tiposocio == 1) {

                          echo '<td  style="color:#043596;font-weight: bold;font-family: Arial;"><center>No aplica</center></td>';

                          echo '<td><center><span class="label label-primary">Exento de pago</span></center></td>';
                        } else {



                          $ult_pago = $this->model_socios->ultima_cuota($rut);

                          foreach ($ult_pago as $u) {

                            echo '<td style="color:#043596;font-weight: bold;font-family: Arial;"><center>' . $u->ano . '-' . $u->semestre . '</center></td>';
                          }



                          $saldo = $this->model_socios->saldoSocio($rut);

                          $nuevorut = explode("-", $rut);

                          if ($saldo > 0) {

                            echo '<td><center><a class="button" href="' . base_url() . '/socios/socios/detallePagos/' . $rut . '"><span class="label label-danger">$' . $saldo . '</span></a></center></td>';
                          } else {

                            echo '<td><center><a class="button" href="' . base_url() . '/socios/socios/detallePagos/' . $rut . '"><span class="label label-success">$0</span></a></center></td>';
                          }
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

        </div>

      </div>

    </div>

  </div>

  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/chartJS/Chart.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- <script src="https://code.jquery.com/jquery.js"></script> -->
<!-- jQuery UI -->
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->


<script src="<?php echo base_url(); ?>/assets/vendors/datatables/js/jquery.dataTables.min.js"></script>

<script src="<?php echo base_url(); ?>/assets/vendors/datatables/dataTables.bootstrap.js"></script>

<script src="<?php echo base_url(); ?>/assets/js/custom.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/tables.js"></script>



</body>

<script type="text/javascript">
  $("#menuprincipal").click(function() {

    window.location.href = "<?php echo base_url(); ?>socios/inicio";

  });

  $("#menupagos").click(function() {

    window.location.href = "<?php echo base_url(); ?>socios/pago_cuota";

  });

  $("#dLabel").click(function() {

    window.location.href = "<?php echo base_url(); ?>socios/mod_cumple";

  });

  $("#gestionsocios").click(function() {

    window.location.href = "<?php echo base_url(); ?>socios/gestionsocios";

  });

  $("#dato_pagos").click(function() {

    window.location.href = "<?php echo base_url(); ?>socios/dashboard";

  });
  $("#agenda").click(function() {

    window.location.href = "<?php echo base_url(); ?>socios/agenda";

  });

  function detallePagos(rut) {

    var rutSocio = rut;



    $.ajax({ //empieza funcion que envia valores a controlador



      cache: false,



      type: "POST",



      data: {
        "rut": rutSocio
      },



      url: "<?php echo base_url() ?>socios/socios/detallePagos",



      success: function(data) {





      }

    });

  }



  $("a[id=pdf]").click(function() {

    /*alert('Evento click sobre un input text con id="nombre2"');*/

    informe = $('#select_tipo').val();

    url = "<?php echo base_url(); ?>socios/socios/informes/" + informe;

    window.open(url, '_blank');

  });



  $('#drop').hover(function() {

    $(this)

      .find('#dropdown-menu')

      .delay(100)

      .stop(true, true)

      .fadeIn(500);

  }, function() {

    $(this)

      .find('#dropdown-menu')

      .stop(true, true)

      .delay(500)

      .fadeOut(500);

  });

  $(document).ready(function() {

    $('#example').DataTable({
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
</script>

</html>