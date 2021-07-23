<?php

$this->load->model('model_test');

function getSexo($sexo)
{

  if ($sexo == 1) {
    return ("Masculino");
  }
  if ($sexo == 0) {
    return ("Femenino");
  }
}

function getPuntosRut($rut)
{

  $rutTmp = explode("-", $rut);

  return number_format($rutTmp[0], 0, "", ".") . '-' . $rutTmp[1];
}

function getParentestco($id)
{

  if ($id == 1) {
    return ("CONYUGE");
  }
  if ($id == 2) {
    return ("HIJO/A");
  }
  if ($id == 3) {
    return ("PADRE");
  }
  if ($id == 4) {
    return ("MADRE");
  }
  if ($id == 5) {
    return ("HIJASTRO");
  }
  if ($id == 6) {
    return ("OTRO FAMILIAR");
  }
}

    if ($this->session->flashdata('rango')){

      echo '<script>

      toastr.warning("Rango no valido");
      
      </script>    
      
      ';
  

    }

    if ($this->session->flashdata('carga')){

      echo '<script>

      toastr.warning("No se econtraron datos");
      
      </script>    
      
      ';
  

    }
    if ($this->session->flashdata('socio') == 'vacia' ){

      echo '<script>

      toastr.warning("No se econtraron datos");
      
      </script>    
      
      ';
  

    }
    if ($this->session->flashdata('socio') == 'exito' ){

      echo '<script>

      toastr.success("Informe generado");
      
      </script>    
      
      ';
  

    }


    


?>

<head>

  <meta charset="UTF-8">

  <title>Infomes Socios</title>


</head>

<div class="main">

  <div class="container">


    <form action="<?php echo base_url();?>socios/test/reportes" method="post">


      <div class="well">

        <div class="row panel">




          <div class="col-md-3">

            <div id="infome">

              <label>Infome</label>

              <div class="form-group">

                <select id="informe" name="infomeExcel" class="form-control" required>

                  <option value="" selected >Seleccionar</option>
                  <option value="socio" selected>Socios</option>
                  <option value="carga" selected>Carga</option>


                </select>



              </div>
            </div>



          </div>



          <div class="col-md-3">

            <div id="genero">

              <label>Genero</label>

              <div class="form-group">

                <select id="genero" name="genero" class="form-control" required>

                  <option value="" selected >Seleccionar</option>
                  <option value="ambos" selected>Ambos</option>
                  <option value="hombre" selected>Hombre</option>
                  <option value="mujer" selected>Mujer</option>


                </select>



              </div>
            </div>



          </div>




          <div class="col-md-2">

            <div id="inicio">

              <label>Desde</label>

              <div class="form-group">

                <input class="form-control" required type="number" name="min" id="min">


              </div>
            </div>


    



          </div>

          <div class="col-md-2">

            <div id="termino">

              <label>hasta</label>

              <div class="form-group">

                <input class="form-control" type="number" name="max" id="max">



              </div>
            </div>



          </div>

          <div class="col-md-12 text-center">

            <div class="form-group">

              <input id="generar" class="btn btn-primary" type="submit" name="" id="" value="Generar"  data-loading-text="Generando...">
              


            </div>




          </div>




        </div>

      </div>






    </form>

  </div>




</div>





<div class="container">
  <div class="well">

    <h1 class="h1">Socios</h1>
    <div class="row" style="padding-top: 15px;">
      <table class="table table-striped table-bordered table-responsive" id="gridS">
        <thead>
          <tr>

            
            <th>Rut</th>
            <th>Nombre</th>
            <th>Edad</th>
            <th>Sexo</th>

          </tr>


        </thead>
        

        <?php foreach ($socios as $s) : ?>

          <tr>


            
            <td><?php echo getPuntosRut($s->prsn_rut) ?></td>
            <td><?php echo $s->prsn_nombres . " " . $s->prsn_apellidopaterno . " " . $s->prsn_apellidomaterno ?></td>
            <td><?php echo $s->edad ?></td>
            <td><?php echo getSexo($s->prsn_sexo) ?></td>

          


          </tr>
        <?php endforeach ?>


      </table>

    </div>

  </div>
</div>





<div class="container">
  <div class="well">
    <h1 class="h1">Cargas</h1>
    <div class="row" style="padding-top: 15px;">
      <table class="table table-striped table-bordered" id="gridC">
        <thead>
          <tr>

            <th>Rut</th>
            <th>Nombre</th>
            <th>Edad</th>
            <th>Sexo</th>
            <th>Socio</th>
            <th>Parentesco</th>

          </tr>


        </thead>


        <?php foreach ($cargas as $s) : ?>

          <tr>


            <td><?php echo getPuntosRut($s->rut_carga) ?></td>
            <td><?php echo $s->prsn_nombres . " " . $s->prsn_apellidopaterno . " " . $s->prsn_apellidomaterno ?></td>
            <td><?php echo $s->edad ?></td>
            <td><?php echo getSexo($s->prsn_sexo) ?></td>
            <td><?php echo getPuntosRut($s->rut_socio) ?></td>
            <td><?php echo getParentestco($s->s_parentesco_pt_id) ?></td>

          </tr>

        <?php endforeach ?>


      </table>

    </div>
  </div>
</div>





</div>


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


<script>
  $(document).ready(function() {

    $('#gridS').DataTable({
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
    $('#gridC').DataTable({
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


  $('#generar').on('click', function () {
    var $btn = $(this).button('loading')
    // business logic...
    $btn.button('reset')
  })
</script>