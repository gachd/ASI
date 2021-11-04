<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">




  <title>Entrega Titulos</title>



</head>
<style>
  .table_wrapper {
    display: block;
    overflow-x: auto;
    white-space: nowrap;
  }
</style>

<body>



  <div class="main">

    <div class="container">

      <ul class="breadcrumb">
        <li><a href="<?php echo base_url()  ?>accionistas/inicio">Inicio</a></li>
        <li><a href="<?php echo base_url()  ?>accionistas/titulos">Titulos</a></li>

        <li>Entrega de Titulos</li>
      </ul>
    </div>



    <?php

    if ($this->session->flashdata('exito'))

      echo '<script>

    toastr.success("Actualizado");
    
    </script>    
    
    '

    ?>





    <div class="container">



      <form class="form-inline row well" action="<?php echo base_url(); ?>accionistas/titulos/entregar" method="post">
        <h3><strong>Entrega de titulo</strong></h3>

        <div class="form-group col-md-4">
          <label for="Titulo">Seleccione titulo</label>
          <select class="form-control" name="Titulo" id="Titulo" required>
            <option value=""> Seleccionar </option>
            <?php
            foreach ($sin_entregar as $i) {

              echo ' <option value="' . $i->id_titulos   . '" >' . $i->id_titulos . '</option>';
            }

            ?>
          </select>

        </div>

        <div class="form-group col-md-4">
          <label>Seleccione Fecha</label>
          <input class="form-control" type="text" name="fecha" id="Fecha" autocomplete="off" required>
        </div>


        <div class="col-md-4">
          <button type="submit" id="cesion" class="btn btn-default">Entregar</button>
        </div>







      </form>


    </div>



    <div class="container table-responsive well ">
      <div class="">
        <h3><strong>No entregados</strong></h3>
        <br>
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered " id="grid">
          <thead>
            <tr>


              <th>Nro</th>
              <th>Acciones</th>
              <th>Fecha Emision</th>
              <th>Poseedor</th>
              <th>Rut</th>







            </tr>
          </thead>

          <tbody>


            <?php

            foreach ($sin_entregar as $t) {


              echo '<tr class="odd gradeX">';
              echo '<td>' . $t->id_titulos . '</td>';
              echo '<td>' . $t->numero_acciones . '</td>';
              echo '<td>' . $t->fecha . '</td>';
              echo '<td>' . $t->prsn_nombres . ' ' . $t->prsn_apellidopaterno . ' ' . $t->prsn_apellidomaterno . '</td>';
              echo '<td>' . $t->prsn_rut . '</td>';


              echo '</tr>';
            }

            ?>






          </tbody>

        </table>

      </div>

    </div>







    <br>
    <br>







  </div>

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

  $.datepicker.regional['es'] = {
    closeText: 'Cerrar',
    prevText: '< Ant',
    nextText: 'Sig >',
    currentText: 'Hoy',
    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércole xs', 'Jueves', 'Viernes', 'Sábado'],
    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
    weekHeader: 'Sm',
    dateFormat: 'dd/mm/yy',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''
  };


  $(function() {

    $.datepicker.setDefaults($.datepicker.regional['es']);



    $("#Fecha").datepicker({
      dateFormat: "yy-mm-dd",
      changeYear: true,
      yearRange: "-100:+0"


    });;


  });
</script>

</html>