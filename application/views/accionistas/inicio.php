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


        <?php if ($no_entregados > 0) { ?>



          <div class="col-sm-2">

            <div class="input-group">
              <span class="form-control" style="font-size: 12px;border-radius:4px">
                <a href="<?php echo base_url(); ?>accionistas/titulos/entregados">Titulos sin entregar</a>
              </span>
              <span class="input-group-btn">
                <a href="<?php echo base_url(); ?>accionistas/titulos/entregados" class=" btn btn-danger"><?php echo $no_entregados ?></a>
              </span>
            </div>


          </div>
          <div class="row"></div>




        <?php } ?>


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













      <div class="" id="mostrarAccionistas">
        <div class="container-fluid">

          <div class=" panel panel-default">


            <div class="panel-heading">
              <div class="panel-title">LISTADO DE ACCIONISTAS</div>
            </div>

            <div class="panel-body">
              <div class="table-responsive">
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

                          <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal_accion_accionista" data-rut="<?php echo $a->id_accionista ?>" data-accion="editar" data-backdrop="static" data-keyboard="false"><span class="glyphicon glyphicon-pencil"></span></button>
                          <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal_accion_accionista" data-rut="<?php echo $a->id_accionista ?>" data-accion="ver" data-backdrop="static" data-keyboard="false"><i class="glyphicon glyphicon-list-alt"></i> Ver</button>


                          <!--  <a href="<?php echo base_url(); ?>accionistas/inicio/editar/<?php echo $a->id_accionista ?>" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span></a> -->
                          <!--  <a href="<?php echo base_url(); ?>accionistas/inicio/ver/<?php echo $a->id_accionista ?>" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-list-alt"></i> Ver</a> -->
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



    <div class="modal fade " id="modal_accion_accionista" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">

      <div class="container main " role="document">


        <div class="modal-content" id="contenido_modal">

          <div class="modal-body" id="body_modal">
            <!--   <form>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Recipient:</label>
                    <input type="text" class="form-control" id="recipient-name">
                </div>
                <div class="form-group">
                    <label for="message-text" class="control-label">Message:</label>
                    <textarea class="form-control" id="message-text"></textarea>
                </div>
            </form> -->
          </div>
          <!-- <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

        </div> -->


        </div>
      </div>
    </div>



  </div> <!-- main -->







</body>






<script type="text/javascript">
  $('#modal_accion_accionista').on('show.bs.modal', function(evento) {

    $("#contenido_modal").empty();
    $("#contenido_modal").html("<div class='spinner'></div>");

    var boton = $(evento.relatedTarget);


    var id_accionista = boton.data('rut');
    var accion = boton.data('accion');



    $.ajax({
      type: "POST",
      url: "<?php echo base_url()  ?>accionistas/inicio/editar_ver_accionista",
      data: {

        id_accionista: id_accionista,
        accion: accion,

      },


      success: function(datos) {



        $("#contenido_modal").empty();
        $("#contenido_modal").append(datos);



      },
      error: function(datos) {

        var html = ' <div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>  </div>';

        $("#contenido_modal").empty();
        $("#contenido_modal").append(html);
        $("#modal_accion_accionista .close").click();
        alert("Error de servidor, compruebe conexion");




      }
    });


  })

  $('#modal_accion_accionista').on('hidden.bs.modal', function(e) {
    $("#body_modal").empty();
  });








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
</script>

</html>