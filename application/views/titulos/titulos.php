<!DOCTYPE html>

<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/styleAccion.css">
    <meta charset="UTF-8">

    <title>Titulos</title>



</head>
<style>

</style>

<body>

    <div class="main">
        <div class="col-md-2">
            <button type="button" class="btn btn-primary" id="menuprincipal"><span class="badge"><i class="glyphicon glyphicon-home"></i> Menú <br> Principal</span></button>
        </div>
        <div class="container" id="advanced-search-form">

            <div class="container-fluid">
                <h3>MENU TITULOS</h3>

                <br>
                <br>
                <br>



                <div class="col-md-5">
                    <button type="submit" id="nuevo" class="btn btn  btn-lg btn-block btn-success">Nuevo</button>
                </div>
                <div class="col-md-5">
                    <button type="submit" id="cesion" class="btn  btn-lg btn-block btn-warning">Cesion</button>
                </div>






            </div>

        </div>

        <div class="container" id="advanced-search-form">
        <h3>Titulos actuales</h3>
        <br>

        <div class="table-responsive">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="grid">
                  <thead>
                    <tr>

                      
                      <th>ID</th>
                      <th>Fecha</th>
                      <th>Estado</th>                      
                      <th>Poseedor</th>
                      <th>Cantidad Acciones</th>
                      
                      


                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($titulos as $s) { 


                      echo '<tr class="odd gradeX">';
                      echo '<td>' . $s->id_titulos . '</td>';
                      echo '<td>' . $s->fecha . '</td>';
                      echo '<td>' . $s->estado . '</td>';
                      echo '<td>' . $s->prsn_nombres . ' ' . $s->prsn_apellidopaterno . '</td>';
                      echo '<td>' . $s->numero_acciones . '</td>';
                        
                      echo '</tr>';
                    }

                    ?>
                    <a href=""></a>

                  </tbody>
                </table>
                
              </div>

        </div>





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
    $("#nuevo").click(function() {
        window.location.href = "<?php echo base_url(); ?>accionistas/titulos/nuevoTitulo";
    });
    $("#cesion").click(function() {
        window.location.href = "<?php echo base_url(); ?>accionistas/titulos/cesionTitulo";
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
</script>

</html>