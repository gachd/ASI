<style>
    .table_wrapper {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }
</style>


<?php

function getEstado($estado)
{

    if ($estado == 0) {

        return "Inactivo";
    } else {

        return "Activo";
    }
}


?>

<div class="main">

    <div class="salto_linea">

        <br>
    </div>
    <div class="container">
        <div class="container">

            <ul class="breadcrumb">
                <li><a href="<?php echo base_url()  ?>accionistas/inicio">Inicio</a></li>
                <li><a href="<?php echo base_url()  ?>accionistas/titulos">Titulos</a></li>

                <li>Historial de Titulo</li>
            </ul>
        </div>
        <div class="form-group">

        </div>

       



        <div class="table-responsive table_wrapper">
            <h3>Historial del Titulo: <?php echo $historial_t[0][0]['tiulo_actual'] ?></h3>
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="grid">
                <thead>
                    <tr>


                        <th>Titulo Actual</th>
                        <th>Cantidad Acciones</th>
                        <th>Estado Titulo</th>
                        <th>Poseedor Titulo</th>
                        <th>Rut Poseedor</th>
                        <th>Fecha Tranferencia</th>
                        <th>Titulo Origen</th>






                    </tr>
                </thead>

                <tbody>



                    <?php

                    for ($i = 0; $i < $indice; $i++) {    ?>


                        <tr class="odd gradeX">

                            <td> <?php echo $historial_t[$i][0]['tiulo_actual'] ?> </td>
                            <td> <?php echo $historial_t[$i][0]['numero_acciones'] ?> </td>
                            <td> <?php echo getEstado($historial_t[$i][0]['estado'])  ?> </td>
                            <td> <?php echo $historial_t[$i][0]['prsn_nombres'].' '.$historial_t[$i][0]['prsn_apellidopaterno'].' '.$historial_t[$i][0]['prsn_apellidomaterno']   ?></td>
                            <td> <?php echo $historial_t[$i][0]['prsn_rut']?> </td>
                            <td> <?php echo $historial_t[$i][0]['fecha_cesion'] ?> </td>
                            <td> <?php echo $historial_t[$i][0]['titulo_origen'] ?> </td>

<br>
                        </tr>

                    <?php  } ?>






                </tbody>

            </table>

        </div>
    </div>
</div>