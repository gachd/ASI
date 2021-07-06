<!DOCTYPE html>

<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/styleAccion.css">
    <meta charset="UTF-8">

    <title>Nuevo Accionista</title>



</head>
<style>

</style>
<br>
<br><br><br>

<?php

$sum = 0;
foreach ($titulos as $t) {



    $sum = $sum + $t->numero_acciones;
}
//var_dump($accionista);


?>

<body>

    <div class="main">


        <div class="col-md-1">

            <a href="<?php echo base_url(); ?>accionistas/inicio" class="btn btn-primary"><span class="badge"><i class="glyphicon glyphicon-home"></i> Menú <br> Principal</span></a>
        </div>

        <div class="container bootstrap snippets bootdey">
            <div class="panel-body inf-content">
                <div class="row">
                    <div class="col-md-4">
                        <img alt="" style="width: 150px;" title="" class="img-circle img-thumbnail isTooltip" src="<?php echo base_url(); ?>assets\img\icon_accionista.png" data-original-title="Usuario">

                    </div>
                    <div class="col-md-6">
                        <strong>Accionista</strong><br>
                        <div class="table-responsive">
                            <table class="table table-user-information">
                                <tbody>
                                    <tr>
                                        <td>
                                            <strong>
                                                <span class="glyphicon glyphicon-asterisk text-primary"></span>
                                                Rut
                                            </strong>
                                        </td>
                                        <td class="text-primary">
                                            <?php

                                            echo $accionista[0]->prsn_rut;



                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>
                                                <span class="glyphicon glyphicon-user  text-primary"></span>
                                                Nombre
                                            </strong>
                                        </td>
                                        <td class="text-primary">
                                            <?php

                                            echo $accionista[0]->prsn_nombres;
                                            echo (' ');
                                            echo $accionista[0]->prsn_apellidopaterno;
                                            echo (' ');
                                            echo $accionista[0]->prsn_apellidomaterno;



                                            ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <strong>
                                                <span class="glyphicon glyphicon-envelope text-primary"></span>
                                                Correo
                                            </strong>
                                        </td>
                                        <td class="text-primary">
                                            <?php

                                            echo $accionista[0]->prsn_email;

                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>
                                                <span class="glyphicon glyphicon-calendar text-primary"></span>
                                                Fecha de Integracion
                                            </strong>
                                        </td>
                                        <td class="text-primary">
                                            <?php

                                            echo $accionista[0]->fecha;

                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>
                                                <span class="glyphicon glyphicon text-primary"></span>
                                                Domicilio
                                            </strong>
                                        </td>
                                        <td class="text-primary">
                                            <?php

                                            echo $accionista[0]->prsn_direccion;
                                            echo (' ,');
                                            echo $accionista[0]->comuna_nombre;
                                            echo (', ');
                                            echo $accionista[0]->provincia_nombre;
                                            echo (', ');
                                            echo $accionista[0]->region_nombre;

                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>
                                                <span class="glyphicon glyphicon text-primary"></span>
                                                Fono
                                            </strong>
                                        </td>
                                        <td class="text-primary">
                                            <?php

                                            echo $accionista[0]->prsn_fono_movil;
                                       
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>
                                                <span class="glyphicon glyphicon text-primary"></span>
                                                Libro/Foja
                                            </strong>
                                        </td>
                                        <td class="text-primary">
                                            <?php

                                            echo $accionista[0]->libro_accionista;
                                            echo (' / ');
                                            echo $accionista[0]->foja_accionista;

                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>
                                                <span class="glyphicon glyphicon text-primary"></span>
                                                Acciones total
                                            </strong>
                                        </td>
                                        <td class="text-primary">
                                            <?php

                                            echo $sum;
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>
                                                <span class="glyphicon glyphicon text-primary"></span>
                                                Titulos
                                            </strong>
                                        </td>
                                        <td class="text-primary">

                                            <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Titulo </th>
                                                        <th>Fecha</th>
                                                        <th>Acciones</th>

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php

                                                    foreach ($titulos as $t) {

                                                        echo '<tr>';


                                                        echo '<td>' . $t->id_titulos . '</td>';
                                                        echo '<td>' . $t->fecha . '</td>';
                                                        echo '<td>' . $t->numero_acciones . '</td>';



                                                        echo '</tr>';
                                                    }


                                                    ?>


                                                </tbody>
                                            </table>



                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>










    </div>
</body>



</html>