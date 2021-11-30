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



<?php if ($this->session->flashdata('exito')) {  ?>

  <script>
    toastr.success("Agregado con exito");
  </script>

<?php } ?>



<!-- aviso cada 3 años-->
<?php


$aviso = $todo_sa[0]->aviso_acciones;

$fecha_aviso = new DateTime($todo_sa[0]->aviso_acciones);
$hoy = new Datetime(date('Y/m/d'));
$dif_año = $hoy->diff($fecha_aviso);
$año = $dif_año->y;


if ($año >= 3) {

?>

  <script>
    swal({
      title: "AVISO",
      text: "No se pueden realizar ventas de acciones",
      icon: "error",
      button: "OK",
    });
  </script>


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

        <h1>Administración Accionistas</h1>

      </div>

    </div>

  </div>


  <div class="page-content">



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
        options.series[0].data = data;
        console.log(data);

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


              detalleGrafico(this.name);


            }

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