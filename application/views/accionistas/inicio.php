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







<body class="">

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
        <!-- row well -->


        <div class="col-md-1">
          <a href="<?php echo base_url(); ?>accionistas/nuevo_accionista" class="btn btn-success"><span class="badge"><i class="glyphicon glyphicon-plus"></i> Nuevo <br> Accionista</span></a>

        </div>
        <div class="col-md-1">
          <a href="<?php echo base_url(); ?>accionistas/titulos" class="btn btn-primary"><span class="badge"><i class="glyphicon glyphicon-ok"></i> Titulos <br> Accionista</span></a>

        </div>
        <div class="col-md-1">
          <a href="<?php echo base_url(); ?>accionistas/inicio/menu_corriente" class="btn btn-danger"><span class="badge"><i class="glyphicon glyphicon-book"></i> Cuenta<br>Accionista</span></a>

        </div>
        <div class="col-md-1">
          <a href="<?php echo base_url(); ?>accionistas/SA" class="btn btn-info"><span class="badge"><i class="glyphicon glyphicon-tower"></i>Sociedad <br>Anonima</span></a>

        </div>
        <div class="col-md-1">
          <a href="<?php echo base_url(); ?>accionistas/inicio/verfechas" class="btn btn-warning"><span class="badge"><i class="glyphicon glyphicon-search"></i> Buscar <br>Fecha</span></a>

        </div>
        <div class="col-md-1">
          <br>

        </div>

        <div class="col-md-6">

          <nav class="navbar navbar-default nav-titulo">

            <div class="col-md-3">
              <label style="text-align:center;">GENERADOR DE LISTADOS</label>
            </div>

            <div class="col-md-6">
              <!-- tipo informe -->
              <div class="form-inline">

                <div class="form-group">
                  <label>Formato:</label>

                  <select class="form-control" name="tipo" id="select_formato">

                    <option value="">seleccionar</option>
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

              </div>
            </div>


          </nav>
        </div>



      </div> <!-- row well -->



    <!--   <div class="container">

        <div class="row">
          <div class="col-md-6 panel">
            <div class="widget">
              <div class="widget-header">
                <h5>Accicones</h5>


              </div>
              <div class="widget-content ">
                
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
            </div>
          </div>

          <div class="col-md-6 panel">
            <div class="widget">
              <div class="widget-header row">
                <h5>Ultimos Accionitas</h5>

              </div>
              <div class="widget-content">
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


        </div>

      </div>

 -->















      <div class="row panel table-responsive" id="mostrarAccionistas">
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

                      <th width="14%">Rut</th>
                      <th width="20%">Nombre</th>
                      <th width="20%">Apellido Paterno</th>
                      <th width="20%">Apellido Materno</th>
                      <th width="4%">Cantidad Acciones</th>
                      <th width="10%">N° Título </th>
                      <th width="10%">Acciones </th>



                    </tr>
                  </thead>
                  <tbody>

                    <?php foreach ($accionistas as $a) {     ?>


                      <tr class="odd gradeX">

                        <td>
                          <?php if ($s->prsn_fallecido == "1") { ?>

                            <?php echo $a->prsn_rut  ?>

                            <span class="pull-right text-right">&#10015; <span style="display:none;">Muerte</span> </span>

                          <?php } else { ?>

                            <?php echo $a->prsn_rut ?>

                          <?php } ?>

                        </td>
                        <td><?php echo $a->prsn_nombres ?></td>
                        <td><?php echo $a->prsn_apellidopaterno ?></td>
                        <td><?php echo $a->prsn_apellidomaterno ?></td>
                        <td><?php echo $a->numero_acciones ?></td>
                        <td>
                          <?php

                          $rut = $a->prsn_rut;
                          $titulo = $this->model_accionistas->nro_titulo($rut); ?>



                          <?php if (!empty($titulo)) { ?>


                            <?php foreach ($titulo as $t) { ?>



                              <?php echo '#' . $t->nro_titulo . " " ?>

                            <?php  } ?>



                          <?php }  ?>

                        </td>
                        <td>

                          <a href="<?php echo base_url(); ?>accionistas/inicio/editar/<?php echo $a->id_accionista ?>" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>

                          <a href="<?php echo base_url(); ?>accionistas/inicio/ver/<?php echo $a->id_accionista ?>" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-list-alt"></i> Ver</a>
                        </td>

                      </tr>

                    <?php  } ?>








                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>
      </div>


    </div> <!--  page content -->


  </div> <!-- main -->





  <link href="<?php echo base_url(); ?>/assets/vendors/datatables/dataTables.bootstrap.css" rel="stylesheet" media="screen">



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

      "order": [
        [1, "asc"]
      ],

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