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









    <div class="container">



      <form class=" row well" action="<?php echo base_url(); ?>accionistas/titulos/entregar" method="post" id="form_entregar_titulo">
        <h3><strong>Entrega de titulo</strong></h3>

        <div class="col-md-8 " style="padding-top: 50px;">

          <div class="col-md-5">
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
          <div class="col-md-5">

            <label>Seleccione Fecha entrega</label>
            <input class="form-control" type="date" name="fecha" id="Fecha" autocomplete="off" required>

          </div>
          <div class="col-md-2" style="padding-top: 23px;">
            <button type="submit" id="cesion" class="btn btn-default">Entregar</button>
          </div>

        </div>











      </form>


    </div>



    <div class="container well ">
      <div class="panel panel-default table-responsive">
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




<script>
  $("#menuprincipal").click(function() {
    window.location.href = "<?php echo base_url(); ?>accionistas/inicio";
  });



  $("#form_entregar_titulo").submit(function(e) {
    e.preventDefault();


    let form = $(this);
    let url = $(this).attr('action');
    let method = $(this).attr('method');

    let data = $(this).serialize();


    $.ajax({


      method: method,
      url: url,
      data: data,


      success: function(response) {
       
        form.trigger('reset');
        swal("Titulo entregado", "Entrega registrada con exito", "success").then(function() {
          window.location.href = "<?php echo base_url(); ?>accionistas/titulos/entregados";
        });


      }
    });


  });



  $('#grid').DataTable({
    "language": spain,
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
</script>

</html>