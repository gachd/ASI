<!DOCTYPE html>

<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/styleAccion.css">
    <meta charset="UTF-8">

    <title>Bajas Accionistas</title>



</head>
<style>
    .table_wrapper {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }

    input.readonly {
        color: transparent;
        text-shadow: 0 0 0 black;


    }
</style>

<?php if ($this->session->flashdata('exito')) { ?>
    <script>
        toastr.success("Baja con exito");
    </script>


<?php }  ?>




<body>
    <br>
    <br>
    <br>


    <div class="main">

        <div class="container">

            <ul class="breadcrumb">
                <li><a href="<?php echo base_url()  ?>accionistas/inicio">Inicio</a></li>

                <li>Bajas</li>
            </ul>
        </div>









        <div class="container">
            <?php

            ?>
            <h2><strong>Bajas Accionistas</strong></h2>
            <br>
            <h4>Se dara al accionista seleccionado sin algun titulo activo</h4>

            <div class="well row">
                <form action="<?php echo base_url(); ?>accionistas/inicio/dar_debaja" method="POST">


                    <div class="form-group col-md-6">
                        <label for="accionista">Seleciones Accionista</label>
                        <select class="form-control" name="accionista" id="accionista" required>

                            <option value="">Seleccione</option>
                            <?php for ($i = 0; $i < count($bajas); $i++) { ?>

                                <option value="<?php echo $bajas[$i][0]->id_accionista  ?>"><?php echo $bajas[$i][0]->prsn_nombres . ' ' . $bajas[$i][0]->prsn_apellidomaterno . ' ' . $bajas[$i][0]->prsn_apellidopaterno   ?></option>


                            <?php } ?>

                        </select>
                    </div>




                    <div class="form-group col-md-4">
                        <label>Seleccione Fecha</label>
                        <input class="form-control readonly" type="text" name="fecha1" id="Fecha1" autocomplete="off" required>
                    </div>




            </div>

            <div class="col-md-2">
                <div class="form-group">

                    <input class="btn btn-success btn-lg" type="submit" value="Dar de baja">


                </div>



            </div>

            </form>
        </div>

    </div>

    <script>
        $("#Fecha1").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            maxDate: "0y",
            yearRange: "-100:+0"

        });

        $(".readonly").keydown(function(e) {
            e.preventDefault();
        });
    </script>



</body>



</html>