<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">s
  <title>Dashboard</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/complemento/css/jquery-jvectormap.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/complemento/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
	       folder instead of downloading all of them to reduce the load. -->
  <link href="<?php echo base_url(); ?>/assets/vendors/datatables/dataTables.bootstrap.css" rel="stylesheet" media="screen">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<style type="text/css">
  table th {
    text-align: center;
  }

  table td {
    text-align: center;
  }

  .loading,
  .loading:after {
    border-radius: 50%;
    width: 10em;
    height: 10em;
  }

  .loading {
    margin: 60px auto;
    font-size: 10px;
    position: relative;
    text-indent: -9999em;
    border-top: 1.1em solid rgba(6, 111, 203, 0.88);
    border-right: 1.1em solid rgba(6, 111, 203, 0.88);
    border-bottom: 1.1em solid rgba(6, 111, 203, 0.88);
    border-left: 1.1em solid #ffffff;
    -webkit-transform: translateZ(0);
    -ms-transform: translateZ(0);
    transform: translateZ(0);
    -webkit-animation: load8 1.1s infinite linear;
    animation: load8 1.1s infinite linear;
  }

  @-webkit-keyframes load8 {
    0% {
      -webkit-transform: rotate(0deg);
      transform: rotate(0deg);
    }

    100% {
      -webkit-transform: rotate(360deg);
      transform: rotate(360deg);
    }
  }

  @keyframes load8 {
    0% {
      -webkit-transform: rotate(0deg);
      transform: rotate(0deg);
    }

    100% {
      -webkit-transform: rotate(360deg);
      transform: rotate(360deg);
    }
  }
</style>

<body>
  <div class="main">
    <section class="content">
      <div class="row">
        <div class="col-md-4">
          <div class="col-md-12 ">
            <div class="info-box">
              <span class="info-box-icon bg-aqua"><img src="<?php echo base_url(); ?>assets/images/socio_activo.png"></span>
              <?php
              $act = count($activos);
              $hon = count($honorario);
              $total = (int)$act + (int)$hon;

              ?>
              <div class="info-box-content">
                <span class="info-box-text">Activos</span>
                <span style="font-size: 2.5em;" class="info-box-number"><?php echo count($activos) ?> / <?php echo $total ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-12 ">
            <div class="info-box">
              <span class="info-box-icon bg-red"><img src="<?php echo base_url(); ?>assets/images/honorario.png"></span>

              <div class="info-box-content">
                <span class="info-box-text">Honorarios</span>
                <span style="font-size: 2.5em;" class="info-box-number"><?php echo count($honorario) ?> / <?php echo $total ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-12 ">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Generar Informe</h3>
                <div class="box-tools pull-right">
                  <!-- Buttons, labels, and many other things can be placed here! -->
                  <!-- Here is a label for tabla_soc -->
                  <span class="label label-primary"><i class="fa fa-list-alt" aria-hidden="true"></i></span>
                </div>
                <!-- /.box-tools -->
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="col-md-12" style="padding-top: 5px;">
                  <span class="label label-success col-md-6" style="font-family: Arial, Helvetica, sans-serif;font-size: 1em">Completo</span>
                  <a href="#" id="pdf1">
                    <span class="box-tools pull-right"><img src="<?php echo base_url(); ?>assets/images/pdf-icono30x30.png"></span>
                  </a>
                </div>
                <div class="col-md-12" style="padding-top: 5px;">
                  <span class="label label-danger col-md-6" style="font-family: Arial, Helvetica, sans-serif;font-size: 1em;">Morosidad</span>
                  <a href="#" id="pdf2">
                    <span class="box-tools pull-right"><img src="<?php echo base_url(); ?>assets/images/pdf-icono30x30.png"></span>
                  </a>
                </div>
                <div class="col-md-12" style="padding-top: 5px;">
                  <span class="label label-primary col-md-6" style="font-family: Arial, Helvetica, sans-serif;font-size: 1em;">Al Día</span>
                  <a href="#" id="pdf3">
                    <span class="box-tools pull-right"><img src="<?php echo base_url(); ?>assets/images/pdf-icono30x30.png"></span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div id="grafico2">
            <div id="loadingDiv" class="spinner"></div>
          </div>
        </div>
      </div>

      <div class="row" style="margin-top: 40px;">
        <div class="box box-default">
          <div class="box-body">
            <div class="table-responsive">

              <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="tabla_soc">
                <thead>
                  <th>RUT</th>
                  <th>NOMBRE</th>
                  <th>ULTIMO PAGO</th>
                  <th>DEUDA TOTAL</th>
                </thead>
                <tbody>
                  <?php
                  foreach ($activos as $a) {
                    (string) $rut = $a->prsn_rut;
                    echo '<tr class="odd gradeX">';
                    echo '<td>' . $a->prsn_rut . '</td>';
                    echo '<td>' . $a->prsn_nombres . ' ' . $a->prsn_apellidopaterno . ' ' . $a->prsn_apellidomaterno . '</td>';

                    $ult_pago = $this->model_socios->ultima_cuota($rut);

                    if ($ult_pago) {

                      foreach ($ult_pago as $u) {


                        echo '<td style="color:#043596;font-weight: bold;font-family: Arial;"><center>' . $u->ano . '-' . $u->semestre . '</center></td>';
                      }
                    } else {
                      echo '<td style="color:#043596;font-weight: bold;font-family: Arial;"><center>-</center></td>';
                    }


                    $saldo = $this->model_socios->saldoSocio($rut);



                    if ($saldo > 0) {

                      echo '<td>$' . $saldo . '</td>';
                    } else {

                      echo '<td>$0</td>';
                    }
                    echo '</tr>';
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </section>
  </div>

  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/chartJS/Chart.min.js"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>





  <!-- Latest compiled and minified CSS -->
  <script type="text/javascript">
   


    $(document).ready(function() {

   

      $('#tabla_soc').DataTable({
        "language": spain,
      });


      $.ajax({
        url: "<?php echo base_url(); ?>socios/dashboard/mostrarGrafico",
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        method: "GET",
        success: function(data) {
          console.log(data);
          data = JSON.parse(data);


          options.series[0].data = data;

          var chart = new Highcharts.Chart(options);
          chart.setTitle({
            text: 'N° de pagos por semestre'
          });
        },
        error: function(data) {
          alert("error");
          $("#grafico2").html(data);
        }
      });


    });
    var options = {
      chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie',
        renderTo: 'grafico2'
      },
      title: {
        text: 'N° de pagos por semestre'
      },
      tooltip: {
        //pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
      },
      plotOptions: {
        pie: {
          allowPointSelect: true,
          point: {
            events: {
              click: function() {

                // alert('value: ' + this.name);

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


    $("a[id=pdf1]").click(function() {
      var informe = 'consolidado';
      url = "<?php echo base_url(); ?>socios/dashboard/informes/" + informe;
      window.open(url, '_blank');

    });
    $("a[id=pdf2]").click(function() {
      var informe = 'morosidad';
      url = "<?php echo base_url(); ?>socios/dashboard/informes/" + informe;
      window.open(url, '_blank');

    });
    $("a[id=pdf3]").click(function() {
      var informe = 'aldia';
      url = "<?php echo base_url(); ?>socios/dashboard/informes/" + informe;
      window.open(url, '_blank');

    });
  </script>
</body>

</html>