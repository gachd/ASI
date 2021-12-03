<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="UTF-8">

  <title>MENU Accionitas</title>


</head>

<style>
  .table_wrapper {
    display: block;

    white-space: nowrap;
  }

  .ico.badge.badge-success {
    background-color: #08c222;
  }

  .ico.badge.badge-danger {
    background-color: #ff0000;
  }

  /* body {
    font-size: 12px;
  } */

  a.button {
    -webkit-appearance: button;
    -moz-appearance: button;
    appearance: button;

    text-decoration: none;
    color: initial;
  }

  #datos {
    font-size: 14px;
  }
</style>



<!-- aviso cada 3 años-->
<?php


$aviso = $todo_sa[0]->aviso_acciones;

$fecha_aviso = new DateTime($todo_sa[0]->aviso_acciones);
$hoy = new Datetime(date('Y/m/d'));
$dif_año = $hoy->diff($fecha_aviso);
$año = $dif_año->y;


if ($año >= 3) {

?>

  <!--   <script>
    swal({
      title: "AVISO",
      text: "No se pueden realizar ventas de acciones",
      icon: "error",
      button: "OK",
    });
  </script> -->


<?php } ?>






<?php if (!empty($bajas)) {  ?>
  <div class="bg-danger col-md-offset-8 col-md-2 fixeded">
    <h5>Hay accionistas sin titulo</h5>

    <div><a href="inicio/bajas" class="btn btn-danger">ver</a></div>

  </div>
<?php }  ?>




<div class="main">


  <div class="container-fluid ">


    <ul class="breadcrumb">

      <li><a href="<?php echo base_url()  ?>accionistas/inicio">Inicio</a></li>

      <li>Sociedad Anonima</li>
    </ul>

  </div>

  <div class="header">

    <div class="container">

      <div class="row">

        <h1 class="h1">Sociedad Anónima</h1>

      </div>

    </div>

  </div>


  <div class="page-content">

    <div class="row well">


      <div class="col-md-offset-3 col-md 6">

        <div class="col-md-2">

          <a class="btn btn-warning btn-block" href="<?php echo base_url(); ?>accionistas/SA/ordinaria"><span class="badge btn-block"><i class="glyphicon glyphicon-briefcase"></i> Junta <br>Ordinaria</span></a>
          <br>
        </div>


        <div class="col-md-2">

          <a class="btn btn-success btn-block" href="<?php echo base_url(); ?>accionistas/SA/extraordinaria"><span class="badge btn-block"><i class="glyphicon glyphicon-credit-card"></i> Junta<br>Extraordinaria</span></a>
          <br>
        </div>


        <div class="col-md-2">

          <a class="btn btn-primary btn-block" href="<?php echo base_url(); ?>accionistas/SA/directorio"><span class="badge btn-block"><i class="glyphicon glyphicon-align-justify"></i> Directorio<br>SA</span></a>
          <br>

        </div>



      </div>
    </div>




    <div class="container">

      <div>

        <h5>

          <span>
            La sociedad anónima Stadio Italiano fue creada en el año de 2001, con el objetivo de promover el deporte y la cultura italiana.
            <br>
            <br>
            Acualmente se compone del sigueinte directorio:

          </span>

        </h5>

      </div>

      <div class="row panel">

        <div id="div_directorio" class="table-responsive">

          <table class="table">

            <thead>

              <tr>
                <th>Rut</th>
                <th>Nombre</th>
                <th>Cargo</th>
                <th>Fecha Nombramiento</th>

              </tr>

            </thead>

            <tbody>

            <?php $noMostrar =array ("fecha","gerente"); ?>


              <?php foreach ($directorio  as $indexDir => $Dir) { ?>




                <?php if (!in_array($indexDir,$noMostrar)){  ?>


                  <?php if ($indexDir != "director") { ?>

                    <tr>
                      <td> <?php echo  $Dir->prsn_rut ?> </td>
                      <td> <?php echo  $Dir->prsn_nombres . ' ' . $Dir->prsn_apellidopaterno . ' ' . $Dir->prsn_apellidomaterno ?> </td>
                      <td> <?php echo strtoupper($indexDir) ?> </td>
                      <td> <?php echo $directorio["fecha"] ?> </td>
                    </tr>

                  <?php } else { ?>

                    <?php foreach ($Dir as $indexDirec => $Directores) { ?>

                      <tr>
                        <td> <?php echo  $Directores->prsn_rut ?> </td>
                        <td> <?php echo  $Directores->prsn_nombres . ' ' . $Directores->prsn_apellidopaterno . ' ' . $Directores->prsn_apellidomaterno ?> </td>
                        <td> <?php echo strtoupper($indexDir) ?> </td>
                        <td> <?php echo $directorio["fecha"] ?> </td>
                      </tr>
                    <?php } ?>

                  <?php } ?>
                <?php  }  ?>
              <?php } ?>

            </tbody>
          </table>

        <table class="table">
          <thead>
            <th>Gerente</th>
          </thead>
          <tbody>
            <tr>
              <td> <?php echo $directorio["gerente"] ?> </td>
            </tr>
          </tbody>
        </table>

        </div>

      </div>




    </div>





    <div class="well row">



      <div class="resultados">

        <div class="col-md-8">

          <div id="graficoParticipacion"></div>

        </div>




      </div>

      <div class="col-md-4">
        <div class="row">
          <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="datos">

            <tr class="bg-primary">
              <td>Suscritas</td>
              <td><?php echo $sa ?></td>
            </tr>
            <tr class="bg-success">
              <td>Emitidas</td>
              <td><strong>
                  <?php echo $emitidas ?>
                </strong></td>
            </tr>
            <tr class="bg-warning">
              <td>Saldo acciones suscritas</td>
              <td><?php echo $saldo ?></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
            </tr>
            <?php if ($no_entregados > 0) : ?>
              <tr class="bg-danger">
                <td>Titulos por entregar</td>
                <td>

                  <a href="<?php echo base_url(); ?>accionistas/titulos/entregados" class="btn btn-danger"><?php echo $no_entregados ?></a>


                  <?php if ($no_entregados == 0) : ?>
                    <?php echo $no_entregados ?>
                  <?php endif; ?>

                </td>
              </tr>

            <?php endif; ?>


          </table>

        </div>
        <div class="row panel">
          <h5>Ultimos Accionitas</h5>
          <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="datos">
            <thead class="thead-light">
              <tr>
                <th width="40%">Accionistas </th>
                <th>Fecha</th>
                <th># Acciones</th>
              </tr>
            </thead>
            <tbody>

              <?php if (!empty($ultimos)) {

                foreach ($ultimos as $u) {
                  echo '<tr class="odd gradeX">';
                  echo '<td>' . $u->prsn_nombres . ' ' . $u->prsn_apellidopaterno . '</td>';
                  echo '<td>' . $u->fecha . '</td>';
                  echo '<td>' . $u->accionesA . '</td>';
                  echo '</tr>';
                }
              }
              ?>
            </tbody>
          </table>

        </div>
      </div>





    </div>




  </div> <!--  page content -->


</div> <!-- main -->








<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/chartJS/Chart.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- <script src="https://code.jquery.com/jquery.js"></script> -->
<!-- jQuery UI -->
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->



<!-- Latest compiled and minified CSS -->









<script type="text/javascript">
  $(document).ready(function() {

    $.ajax({
      url: "<?php echo base_url(); ?>accionistas/inicio/mostrarGrafico1",
      dataType: 'json',
      contentType: "application/json; charset=utf-8",
      method: "GET",
      success: function(data) {

        console.log(data);

        options.series[0].data = data;

        var chart = new Highcharts.Chart(options);

      },
      error: function(data) {

        console.log(data);
      }
    });

  });

  var options = {
    chart: {
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: 'pie',
      renderTo: 'graficoParticipacion'
    },
    title: {
      text: 'Accionistas S.A.'
    },
    tooltip: {
      pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
      pie: {
        allowPointSelect: true,
        point: {
          events: {
            click: function() {

              console.log(this);



            },



          }

        },

        cursor: 'pointer',

        dataLabels: {

          enabled: true,

          //format: '<b>{point.name}</b>: {point.percentage:.1f} %',

          format: '<b>{point.name}</b>: {point.y}',

          style: {

            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'

          }

        },



        showInLegend: true

      }

    },

    series: [{}]

  };
</script>

</html>