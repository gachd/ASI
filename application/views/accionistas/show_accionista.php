<!DOCTYPE html>

<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <meta charset="UTF-8">

    <title>Ficha Accionista</title>



</head>
<style>
    .d-none {
        display: none;
    }

    .open-dropdown {
        font-weight: bold;
    }

    .padding {

        padding-top: 5px;
        padding-bottom: 5px;

    }
</style>


<?php

function getPuntosRut($rut)
{

    $rutTmp = explode("-", $rut);

    return number_format($rutTmp[0], 0, "", ".") . '-' . $rutTmp[1];
}

function formatFecha($fecha)
{
    return date("d-m-Y", strtotime($fecha));
}

$sum = 0;
foreach ($titulos as $t) {



    $sum = $sum + $t->numero_acciones;
}


function listadoDirectorio($directorio)
{


    if (is_dir($directorio)) {

        $listado = scandir($directorio);

        $urlBase = base_url();

        unset($listado[array_search('.', $listado, true)]);

        unset($listado[array_search('..', $listado, true)]);

        /*    var_dump($listado);
        var_dump($directorio); */


        if (count($listado) < 1) {

            echo 'Directorio Vacio';
        } else {



            foreach ($listado as $elemento) {

                if (!is_dir($directorio . '/' . $elemento)) {

                    echo '<li style="list-style-type:none;" class="padding"><a href="' . $urlBase . $directorio . '/' . $elemento . '" target="_blank" class="form-control">' . $elemento . '</a></li>';
                }
                if (is_dir($directorio . '/' . $elemento)) {
                    echo '<li style="list-style-type:none;" class="open-dropdown padding"><a href="javascript:void(0)"   class="btn btn-primary ">' . $elemento . '<b class="caret"></b> </a> </li>';
                    echo '<ul class="dropdown d-none">';
                    listadoDirectorio($directorio . '/' . $elemento);
                    echo '</ul>';
                }
            }
        }
    } else {

        echo 'No existe directorio';
    }
}
//var_dump($accionista);


?>

<div class="salto_linea">
    <br>
    <br>
    <br>
</div>

<body>

    <script>
        $(document).ready(function() {
            $(".open-dropdown").click(function() {
                $(this).next("ul.dropdown").toggleClass('d-none');
            });
        });
    </script>

    <div class="main">
        <div class="container">

            <ul class="breadcrumb">
                <li><a href="/ASI/accionistas/inicio">Inicio</a></li>

                <li>Ver Accionista</li>
            </ul>
        </div>




        <div class="container ">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <img alt="" style="max-width:150px;" title="" class="img-circle img-thumbnail isTooltip" src="<?php echo base_url(); ?>assets\img\icon_accionista.png" data-original-title="Usuario">


                        <h3>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <strong>

                                                Rut:
                                            </strong>
                                        </td>
                                        <td class="">
                                            <?php

                                            echo getPuntosRut($accionista[0]->prsn_rut);



                                            ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <strong>
                                                <span class="glyphicon glyphicon-user "></span>

                                            </strong>
                                        </td>
                                        <td class="">
                                            <?php

                                            echo $accionista[0]->prsn_nombres;
                                            echo (' ');
                                            echo $accionista[0]->prsn_apellidopaterno;
                                            echo (' ');
                                            echo $accionista[0]->prsn_apellidomaterno;



                                            ?>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </h3>
                    </div>

                    <div class="col-md-8">


                        <div class="">
                            <table class="table ">
                                <tbody>



                                    <tr>
                                        <td>
                                            <strong>
                                                <span class="glyphicon glyphicon-envelope "></span>
                                                Correo
                                            </strong>
                                        </td>
                                        <td class="">
                                            <?php

                                            echo $accionista[0]->prsn_email;

                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>
                                                <span class="glyphicon glyphicon-calendar "></span>
                                                Fecha de Integracion
                                            </strong>
                                        </td>
                                        <td class="">
                                            <?php

                                            echo formatFecha($accionista[0]->fecha);

                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>
                                                <span class="glyphicon glyphicon "></span>
                                                Domicilio
                                            </strong>
                                        </td>
                                        <td class="">
                                            <?php

                                            echo $accionista[0]->prsn_direccion;
                                            echo (' ,');
                                            echo $accionista[0]->comuna_nombre;
                                            echo (' , ');
                                            echo $accionista[0]->provincia_nombre;
                                            echo (' , ');
                                            echo $accionista[0]->region_nombre;

                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>
                                                <span class="glyphicon glyphicon "></span>
                                                Fono
                                            </strong>
                                        </td>
                                        <td class="">
                                            <?php

                                            echo $accionista[0]->prsn_fono_movil;

                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>
                                                <span class="glyphicon glyphicon "></span>
                                                Carpeta con Archivos
                                            </strong>
                                        </td>
                                        <td>
                                            <?php if (is_dir($accionista[0]->path)) {     ?>
                                                <li style="list-style-type:none;" class="open-dropdown padding"><a href="javascript:void(0)" class="btn btn-primary ">Carpeta <b class="caret"></b> </a> </li>
                                                <ul class="dropdown d-none">

                                                    <?php listadoDirectorio($accionista[0]->path) ?>
                                                </ul>
                                            <?php } else { ?>
                                                No existe directorio
                                            <?php } ?>


                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>
                                                <span class="glyphicon glyphicon "></span>
                                                Libro/Foja
                                            </strong>
                                        </td>
                                        <td class="">
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
                                                <span class="glyphicon glyphicon "></span>
                                                Acciones total
                                            </strong>
                                        </td>
                                        <td class="">
                                            <?php

                                            echo $sum;
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>
                                                <span class="glyphicon glyphicon "></span>
                                                Socio
                                            </strong>
                                        </td>
                                        <td class="">



                                            <?php if (empty($socio)) { ?>

                                                NO
                                            <?php } else {  ?>




                                                <a href="/ASI/socios/ficha/detalle/<?php echo $accionista[0]->prsn_rut ?> ">SI</a>

                                            <?php } ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>
                                                <span class="glyphicon glyphicon "></span>
                                                Titulos
                                            </strong>
                                        </td>
                                        <td class="">

                                            <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th align="center">Nro Titulo </th>
                                                        <th align="center">Fecha</th>
                                                        <th align="center">Acciones</th>

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php

                                                    foreach ($titulos as $t) { ?>

                                                        <tr>

                                                            <td align="center"><?php echo $t->id_titulos  ?></td>
                                                            <td align="center"><?php echo $t->fecha  ?> </td>
                                                            <td align="center"><?php echo $t->numero_acciones  ?></td>

                                                        </tr>
                                                    <?php } ?>





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