<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="UTF-8">

  <title>Document</title>

  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/chartJS/Chart.min.js"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
</head>
<style>
  .ico.badge.badge-success {
    background-color: #08c222;
  }

  .ico.badge.badge-danger {
    background-color: #ff0000;
  }

  body {
    font-size: 12px;
  }

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

<body>



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
          <div class="col-md-2">
            <button type="button" class="btn btn-primary" id="menuprincipal"><span class="badge"><i class="glyphicon glyphicon-home"></i> Menú <br> Principal</span></button>
          </div>
          <div class="col-md-2">
            <button type="button" class="btn btn-success" id="newaccionista"><span class="badge"><i class="glyphicon glyphicon-plus"></i> Nuevo <br> Accionista</span></button>
          </div>
          <div class="col-md-6">
            <nav class="navbar navbar-default nav-titulo">
              <div class="col-md-3">
                <label style="text-align:center;">GENERADOR DE LISTADOS</label>
              </div>
              <div class="col-md-6">

                <!-- tipo informe -->
                <form class="form-inline">
                  <div class="form-group">
                    <label>Tipo:</label>

                    <select class="form-control " name="tipo" id="select_tipo">
                      <option value="">seleccionar</option>
                      <option value="1">Todos</option>

                    </select>

                  </div>
                </form>
              </div>
              <div class="col-md-3">
                <a href="#" title="Exportar PDF" id="pdf" class="descargar btn btn-sm btn-warning"><span class="glyphicon glyphicon-circle-arrow-down"></span> Descargar PDF</a>

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
                <td>Total de acciones</td>
              </tr>
              <tr class="bg-success">
                <td>Emitidas</td>
                <td><strong>
                    <div class="col-md-7"><?php echo $emitidas ?> </div>
                  </strong></td>
              </tr>
              <tr class="bg-warning">
                <td>Saldo acciones suscritas</td>
                <td></td>
              </tr>


            </table>

          </div>
          <div class="row">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="datos">
              <thead class="thead-light">
                <tr>
                  <th width="40%">Accionist </th>
                  <th>Fecha</th>
                  <th># Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($ultimos)) {
                  foreach ($ultimos as $u) {
                    echo '<tr class="odd gradeX">';
                    echo '<td>' . $u->prsn_nombres . ' ' . $u->prsn_apellidopaterno . '</td>';
                    echo '<td>' . $u->fecha_emision . '</td>';
                    echo '<td>' . $u->numero_acciones . '</td>';
                  }
                }
                ?>
              </tbody>
            </table>

          </div>
        </div>

      </div>
      <div class="row" id="mostrarSocios">
        <div class="col-md-12">

          <div class="content-box-large">
            <div class="panel-heading">
              <div class="panel-title">LISTADO DE ACCIONISTAS</div>
            </div>
            <div class="panel-body">
              <div class="table-responsive">
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


                      echo '<tr class="odd gradeX">';
                      echo '<td><div class="col-md-7">' . $s->prsn_rut . '</div><div class="col-md-4"><a  href=inicio/editar/' . $s->id_accionista . '><span class="ico badge badge-info">Editar</span></a></div></td>';
                      echo '<td><div class="col-md-7">' . $s->prsn_nombres . '</td>';
                      echo '<td><div class="col-md-7">' . $s->prsn_apellidopaterno . '</td>';
                      echo '<td><div class="col-md-7">' . $s->prsn_apellidomaterno . '</td>';
                      echo '<td><div class="col-md-7">' . $s->numero_acciones . '</td>';
                      $rut = $s->prsn_rut;

                      $titulo = $this->model_accionistas->nro_titulo($rut);
                      if (!empty($titulo)) {
                        echo '<td>';
                        foreach ($titulo as $t) {
                          echo ' #' . $t->nro_titulo . ' ';
                        }
                        echo '</td>';
                      }

                      echo '<td>                                  
                        
                        <a href=editar/
                         class="btn btn-primary" 
                          data-toggle="modal" 
                          data-target="#exampleModal" 
                          data-id="@mdo"

                          >Editar</a>                        
                        </br>
                        <a href="">Baja </a>
                        </td>';



                      echo '</tr>';
                    }

                    ?>
                    <a href=""></a>

                  </tbody>
                </table>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
                      </div>
                      <div class="modal-body">
                        <form>
                          <div class="form-group">
                            <label for="recipient-name" class="control-label">Recipient:</label>
                            <input type="text" class="form-control" id="recipient-name">
                          </div>
                          <div class="form-group">
                            <label for="message-text" class="control-label">Message:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Send message</button>
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




  <link href="<?php echo base_url(); ?>/assets/vendors/datatables/dataTables.bootstrap.css" rel="stylesheet" media="screen">

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://code.jquery.com/jquery.js"></script>
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






$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})




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


  $("#menuprincipal").click(function() {
    window.location.href = "<?php echo base_url(); ?>socios/inicio";
  });
  $("#newaccionista").click(function() {
    window.location.href = "<?php echo base_url(); ?>accionistas/nuevo_accionista";
  });


  $("a[id=pdf]").click(function() {
    /*alert('Evento click sobre un input text con id="nombre2"');*/
    informe = $('#select_tipo').val();
    url = "<?php echo base_url(); ?>accionistas/inicio/informes/" + informe;
    window.open(url, '_blank');
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