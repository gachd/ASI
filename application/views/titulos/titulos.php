<!DOCTYPE html>

<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">

  <meta charset="UTF-8">

  <title>Titulos</title>





</head>

<style>
  td div {
    margin: auto;
  }


  .name {
    padding-left: 15px;
    width: 60px;
    display: inline-block;
  }

  .number {
    width: 40px;
    display: inline-block;
    text-align: right;
  }

  .centrado {
    text-align: center;
  }
</style>


<div class="salto_linea">
  <br>

</div>



<body>



  <div class="main">
    <div class="container ">

      <!-- <button type="button" class="btn btn-primary" id="menuprincipal"><span class="badge"><i class="glyphicon glyphicon-home"></i> Menú <br> Principal</span></button> -->

      <ul class="breadcrumb">
        <li><a href="/ASI/accionistas/inicio">Inicio</a></li>

        <li>Titulos</li>
      </ul>

    </div>

    <div class="container well" >
      <h3><strong>Titulos</strong></h3>
      <br>



      <div class="col-md-4" style="padding-bottom: 10px;">
        <a href="<?php echo base_url(); ?>accionistas/titulos/nuevoTitulo" class="btn btn-lg btn-block btn-success">Nuevo</a>
      </div>

      <div class="col-md-4" style="padding-bottom: 10px;">
        <a href="<?php echo base_url(); ?>accionistas/titulos/cesionTitulo" class="btn btn-lg btn-block btn-warning">Cesion</a>
      </div>

      <div class="col-md-4" style="padding-bottom: 10px;">
        <a href="<?php echo base_url(); ?>accionistas/titulos/entregados" class="btn-lg btn-block btn btn-info">Pendientes</a>
      </div>





    </div>





    <div class="container well" >
      <h3><strong>HISTORIAL TITULOS ACTIVOS</strong></h3>
      <br>

      <form action="<?php echo base_url(); ?>accionistas/titulos/historial_titulo" method="post" class="form-inline">


        <div class="form-group  col-md-4">
          <label>Seleccione titulo</label>



          <select class="form-control" name="Titulo" id="Titulo" required>
            <option value=""> Seleccionar </option>
            <?php
            foreach ($titulos as $i) {

              echo ' <option value="' . $i->id_titulos   . '" >' . $i->id_titulos . '</option>';
            }

            ?>
          </select>
          <?php if ($this->session->flashdata('Mensaje')) {  ?>


            <script>
              toastr.warning("<?php echo $this->session->flashdata('Mensaje'); ?>");
            </script>

          <?php } ?>
          <?php if ($this->session->flashdata('embargo')) {  ?>


            <script>
              swal({
                title: "Titulo Actualizado con exito",
                icon: "success",
                button: "OK",
              });
            </script>

          <?php } ?>

        </div>

        <div class="col-md-4 ">

          <button type="submit" id="cesion" class="btn btn-primary">Buscar</button>

        </div>











      </form>


    </div>


    <div class="container table-responsive div-wrapper well" >


      <h4><strong>TITULOS ACTIVOS</strong></h4>
      <br>
      <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="grid">
        <thead>
          <tr>


            <th>Nro Titulo</th>
            <th>Acciones</th>
            <th>Fecha Emision</th>
            <th>Poseedor</th>
            <th>Rut</th>
            <th>Fecha de entrega</th>
            <th>Acciones <br> embargadas</th>







          </tr>
        </thead>

        <tbody>



          <?php foreach ($titulos as $t) {    ?>


            <tr>

              <td class="centrado"><?php echo $t->id_titulos ?></td>
              <td class="centrado"><?php echo $t->numero_acciones  ?></td>
              <td class="centrado"><?php echo $t->fecha ?></td>
              <td><?php echo $t->prsn_nombres . ' ' . $t->prsn_apellidopaterno . ' ' . $t->prsn_apellidomaterno  ?></td>
              <td class="centrado"><?php echo $t->prsn_rut  ?></td>
              <td class="centrado">
                <?php if ($t->fecha_entrega) { ?>

                  <?php echo $t->fecha_entrega  ?>

                <?php } else { ?>

                  NO ENTREGADA

                <?php } ?>
              </td>

              <td class="text-left">
                <span >

                  <?php if ($t->embargo) { ?>



                    <?php echo $t->acciones_embargadas  ?>


                  <?php } else { ?>

                    No

                  <?php } ?>
                </span>


                <span class="pull-right text-right">
                  <form action="<?php echo base_url(); ?>accionistas/titulos/embargo" method="post">
                    <input type="hidden" name="idT" value="<?php echo $t->id_titulos ?>">
                    <input type="hidden" name="RutA" value="<?php echo $t->prsn_rut ?>">

                    <button class="">Editar</button>

                    <!--  <a href="<?php echo base_url()  ?>accionistas/titulos/embargo/<?php echo $t->id_titulos ?>"><span class="label label-info">Editar</span></a> -->
                  </form>

                </span>


              </td>


            </tr>

          <?php } ?>








        </tbody>

      </table>

    </div>










    <br>
    <br>







    </>

</body>
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

<script>
  $("#menuprincipal").click(function() {
    window.location.href = "<?php echo base_url(); ?>accionistas/inicio";
  });



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


  $('#grid2').DataTable({
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
</script>

</html>