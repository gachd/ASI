<!DOCTYPE html>

<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/styleAccion.css">
    <meta charset="UTF-8">

    <title>Embargo Titulo</title>



</head>


<style>
    .table_wrapper {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }

    form {
        color: #008000;
        padding-bottom: 20px;
    }

    form .form-control {

        padding: 12px 20px;
        height: auto;
        border-radius: 2px;
    }
</style>



<?php
 if (is_null( $Titulo->acciones_embargadas)) {

    $Titulo->acciones_embargadas = 0;
 }

$MAX_embargo = $Titulo->numero_acciones -  $Titulo->acciones_embargadas;
$MAX_quitar_embargo = $Titulo->acciones_embargadas;




?>

<body>
    <div class="salto_linea">
        <br>
        <br>
        <br>

    </div>


    <div class="main">





        <div class="container">

            <ul class="breadcrumb">
                <li><a href="<?php echo base_url()  ?>accionistas/inicio">Inicio</a></li>
                <li><a href="<?php echo base_url()  ?>accionistas/titulos">Titulos</a></li>

                <li>Accion Embargada</li>
            </ul>
        </div>









        <div class="container">
            <h3><strong>Embargo Titulo <?php echo $IdTitulo ?></strong></h3>
            <br>

            <div class="well row">
                <form action="<?php echo base_url(); ?>accionistas/titulos/guardar_embargo" method="POST" enctype="multipart/form-data">


                    <div class=" form-group col-md-6">
                        <label for="Embargos">Embargos</label>
                        <select class="form-control" name="Embargos" id="Embargos" required>

                            <option value="">Seleccione</option>
                            <option value="SI">Si</option>
                            <option value="NO">No</option>

                        </select>
                    </div>
                     <input type="hidden" name="numero_acciones" value="<?php echo $Titulo->numero_acciones?>"> 
                     <input type="hidden" name="acciones_embargadas" value="<?php echo $Titulo->acciones_embargadas ?>">
                     <input type="hidden" name="idT" value="<?php echo  $IdTitulo?>">
                     <input type="hidden" name="RutA" value="<?php echo  $RutA?>">




                    <div class="form-group col-md-4 ">
                        <label for="cant_embargada" id="txt_acciones">Cantidad de Accion Embargada</label>
                        <input class="form-control" type="number" name="cant_embargada" id="cant_embargada" autocomplete="off" required>
                    </div>

                    <div class="form-group col-md-4" >
                        <label for="archivos_embargo">Documentos Asociados</label>
                        <div class="">
                            <div class="input-group">
                                <input type="file" class="form-control" id="archivos_embargo" name="archivos_embargo[]" accept="application/pdf,image/gif,image/png,image/jpg,image/jpeg" required>
                                <div class="input-group-btn">
                                    <a href="javascript:void(0);" class="btn btn-primary form-control" id="agregar_archivo"><i class="glyphicon glyphicon-plus"></i></a>
                                </div>
                            </div>
                            <div id=nuevo_archivo>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" style="text-align:center;">
                        <input type="submit" value="Registrar" class="btn btn-primary">
                    </div>


                </form>
            </div>

        </div>


    </div>

</body>




<script type="text/javascript">

var MaxEmbargar =  <?php echo $MAX_embargo ?>;
var MAX_quitar_embargo =  <?php echo $MAX_quitar_embargo ?>;

    $('#Embargos').on('change', function() {

        var opcionEmbargo = $(this).val();
        $('#cant_embargada').val('');


        if (opcionEmbargo == "SI") {

            $('#txt_acciones').text("Cantidad de Accion Embargada");
            $('#cant_embargada').attr({
                "max": MaxEmbargar,
                "min": 1,
                "placeholder":"MAX "+MaxEmbargar
            });
           

        }
        if (opcionEmbargo == "NO") {
            $('#txt_acciones').text("Cantidad de Accion quitar embargo");
            $('#cant_embargada').attr({
                "max": MAX_quitar_embargo, 
                "min": 1,
                "placeholder":"MAX "+MAX_quitar_embargo
            });
           

        }



    });






    $("#agregar_archivo").click(function() {
        var html = '';

        html += '<div class="input-group" id="inputFormRow">';
        html += '<input type="file" class="form-control" id="archivos_embargo" name="archivos_embargo[]" accept="application/pdf,image/gif,image/png,image/jpg,image/jpeg" required>';
        html += '<div class="input-group-btn">';
        html += '<a href="javascript:void(0);" class="btn btn-danger form-control" id="remover"><i class="glyphicon glyphicon-minus"></i></a>';
        html += '</div>';


        $('#nuevo_archivo').append(html);
    });

    // Remover archivo
    $(document).on('click', '#remover', function() {
        $(this).closest('#inputFormRow').remove();
    });
</script>

</html>