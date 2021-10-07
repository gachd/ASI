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


?>

<?php if ($año >= 3) { ?>

  <script>
    swal({
      title: "AVISO",
      text: "No se pueden realizar ventas de acciones",
      icon: "error",
      button: "OK",
    });
  </script>


<?php } ?>





<body class="">
  <?php if (!empty($bajas)) {  ?>
    <div class="bg-danger col-md-offset-8 col-md-2 fixeded">
      <h5>Hay accionistas sin titulo</h5>

      <div><a href="inicio/bajas" class="btn btn-danger">ver</a></div>

    </div>
  <?php }  ?>




  <div class="main">
    <div class="header">
      <div class="container">


        <div class="row">
          <h1>Administración Accionistas</h1>
        </div>
      </div>
    </div>

    <div class="page-content">
      <div class="row well">

        <div class="content-box-large">

          <div class="col-md-1">
            <button type="button" class="btn btn-success" id="newaccionista"><span class="badge"><i class="glyphicon glyphicon-plus"></i> Nuevo <br> Accionista</span></button>
          </div>
          <div class="col-md-1">
            <button type="button" class="btn btn-primary" id="titulos"><span class="badge"><i class="glyphicon glyphicon-ok"></i> Titulos <br> Accionista</span></button>
          </div>
          <div class="col-md-1">
            <button type="button" class="btn btn-warning" id="fechas"><span class="badge"><i class="glyphicon glyphicon-search"></i> Buscar <br>Fecha</span></button>
          </div>

          <div class="col-md-5">
            <nav class="navbar navbar-default nav-titulo">
              <div class="col-md-3">
                <label style="text-align:center;">GENERADOR DE LISTADOS</label>
              </div>
              <div class="col-md-8">

                <!-- tipo informe -->
                <form class="form-inline">

                  <div class="form-group">
                    <label>Formato:</label>

                    <select class="form-control " name="tipo" id="select_formato">
                      <option value="0">seleccionar</option>
                      <option value="1">Excel</option>
                      <option value="2">PDF</option>

                    </select>
                  </div>

                  <div class="form-group">
                    <label>Tipo:</label>

                    <select class="form-control" name="tipo" id="select_tipo">
                      <option value="0">seleccionar</option>
                      <option value="1">Todos</option>
                      <option value="2">Mayoritarios</option>

                    </select>
                  </div>

                  <div class="form-group">
                    <a href="#" title="Generar" id="pdf" class="descargar btn  btn-sm btn-warning"><span class="glyphicon glyphicon-circle-arrow-down"></span> Descargar</a>

                  </div>

                </form>
              </div>


            </nav>
          </div>

        </div>

      </div>
      <div class="well row">

        <div class="resultados">

          <div class="col-md-8">

            <div id="grafico2"></div>

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






      <div class="row panel table-responsive" id="mostrarSocios">
        <div class="col-md-12">

          <div class="content-box-large">


            <div class="panel-heading">
              <div class="panel-title">LISTADO DE ACCIONISTAS</div>
            </div>

            <div class="panel-body">
              <div class="table  table_wrapper">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="grid">
                  <thead>
                    <tr>

                      <th>Rut</th>
                      <th>Nombre</th>
                      <th>Apellido Paterno</th>
                      <th>Apellido Materno</th>
                      <th>Cantidad Acciones</th>
                      <th>N° Título </th>
                      <th>Acciones </th>



                    </tr>
                  </thead>
                  <tbody>



                    <?php foreach ($accionistas as $s) {


                      echo '<tr class="">';
                      if ($s->prsn_fallecido == "1") {

                        echo '<td class="text-left">' . $s->prsn_rut . ' <span class="pull-right text-right">&#10015; <span style="display:none;">Muerte</span>  </span></td>';
                      } else {

                        echo '<td class="text-left">' . $s->prsn_rut . ' <span class="pull-right text-right"></span></td>';
                      }



                      echo '<td><div>' . $s->prsn_nombres . '</td>';
                      echo '<td><div>' . $s->prsn_apellidopaterno . '</div></td>';
                      echo '<td><div>' . $s->prsn_apellidomaterno . '</div></td>';
                      echo '<td><div>' . $s->numero_acciones . '</div></td>';
                      $rut = $s->prsn_rut;

                      $titulo = $this->model_accionistas->nro_titulo($rut);
                      if (!empty($titulo)) {
                        echo '<td>';
                        foreach ($titulo as $t) {
                          echo ' #' . $t->nro_titulo . ' ';
                        }
                        echo '</td>';
                      }

                      echo '<td><a  href=inicio/editar/' . $s->id_accionista . '><span class="ico badge badge-info">Editar</span></a> <a  href=inicio/ver/' . $s->id_accionista . '><span class="ico badge badge-info">Ver</span></a></td>';



                      echo '</tr>';
                    }

                    ?>
                    <a href=""></a>

                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>





  <link href="<?php echo base_url(); ?>/assets/vendors/datatables/dataTables.bootstrap.css" rel="stylesheet" media="screen">


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
  <!-- Latest compiled and minified CSS -->



</body>






<script type="text/javascript">
  $(document).ready(function() {
    
    $('#grid').DataTable({
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



  $("#titulos").click(function() {
    window.location.href = "<?php echo base_url(); ?>accionistas/titulos";
  });
  $("#newaccionista").click(function() {
    window.location.href = "<?php echo base_url(); ?>accionistas/nuevo_accionista";
  });
  $("#fechas").click(function() {
    window.location.href = "<?php echo base_url(); ?>accionistas/inicio/verfechas";
  });


  $("a[id=pdf]").click(function() {
    /*alert('Evento click sobre un input text con id="nombre2"');*/

    formato = $('#select_formato').val();
    informe = $('#select_tipo').val();

    if (formato == 0 || informe == 0) {
      swal("", "Ingrese una opcion valida", "warning");

    } else {

      if (formato == 1) {
        toastr.options = {
          "closeButton": true
        }

        url = "<?php echo base_url(); ?>accionistas/inicio/informesExcel/" + informe;
        window.open(url, '_parent');
        toastr.success("Informe Generado");


      }
      if (formato == 2) {
        url = "<?php echo base_url(); ?>accionistas/inicio/informes/" + informe;
        window.open(url, '_blank');
      }

    }

  });




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
        chart.setTitle({
          text: 'Accionistas S.A.'
        });
      },
      error: function(data) {
        alert(data);
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
      renderTo: 'grafico2'
    },
    title: {
      text: 'Número de Socios por Edades'
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
</script>

</html>