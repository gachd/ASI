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

    h4>a {
        color: #000000;
    }

    h4>a:hover,
    h4>a:focus {
        color: #757575;
        text-decoration: none;

    }
</style>

<?php

function getPuntosRut($rut)
{

    $rutTmp = explode("-", $rut);

    return number_format($rutTmp[0], 0, "", ".") . '-' . $rutTmp[1];
}

function getTipoTransaccion($tipo)
{
    /*  
        
        0 = cesion
        1 = nueva      
        2 =  trasmision  
        3 =  canje  
        4 =  anulacion  */



    switch ($tipo) {
        case 0:
            return "Cesion";
            break;
        case 1:
            return "Suscripción";
            break;
        case 2:
            return "Trasmision";

            break;
        case 3:
            return "Canje";

            break;
        case 4:
            return "Anulación";
            break;

        default:
            return $tipo;
            break;
    }
}

function formatFecha($fecha)
{
    return date("d-m-Y", strtotime($fecha));
}

function getEstado($estado)
{
    if ($estado == 1) {
        return "Activo";
    } else {
        return "Inactivo";
    }
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

        unset($listado[array_search('index.html', $listado, true)]);






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



?>






<script>
    $(document).ready(function() {
        $(".open-dropdown").click(function() {
            $(this).next("ul.dropdown").toggleClass('d-none');
        });
    });
</script>








<div class="container well">

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
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    <strong>
                                        <span class="glyphicon glyphicon"></span>
                                        Saldo de Acciones vigente
                                    </strong>
                                </td>
                                <td>
                                    <h1 class="h1">

                                        <?php

                                        echo $sum;
                                        ?>

                                    </h1>
                                </td>
                            </tr>



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
                                        Fecha de Incorporacion
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
                                        Socio
                                    </strong>
                                </td>

                                <td class="">



                                    <?php if (empty($socio)) { ?>

                                        NO
                                    <?php } else {  ?>


                                        <a href="/ASI/socios/ficha/detalle/<?php echo $accionista[0]->prsn_rut ?> " class="btn">
                                            Ficha de socios
                                        </a>
                                        <br>

                                        <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered">
                                            <thead>
                                                <th>Rut Corp</th>
                                                <th>Coporacion</th>
                                                <th>Fecha de Incorporacion</th>
                                            </thead>

                                            <tbody>


                                                <?php foreach ($socio as $s) { ?>

                                                    <tr>

                                                        <td align="center"><?php echo $s->corporacion  ?></td>
                                                        <td align="center"><?php echo $s->co_nombre  ?></td>
                                                        <td align="center"><?php echo  formatFecha($s->fecha_registro)  ?> </td>


                                                    </tr>
                                                <?php } ?>





                                            </tbody>
                                        </table>



                                    <?php } ?>



                                </td>
                            </tr>




                            <tr>
                                <td>
                                    <strong>
                                        <span class="glyphicon glyphicon "></span>
                                        Titulos Activos
                                    </strong>
                                </td>
                                <td class="">

                                    <?php if (!empty($titulos)) { ?>

                                        <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered">
                                            <thead>
                                                <tr>

                                                    <th align="center">Nro Titulo </th>
                                                    <th align="center">Fecha Emision</th>
                                                    <th align="center">Acciones</th>


                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php



                                                foreach ($titulos as $t) { ?>

                                                    <tr>

                                                        <td align="center"><?php echo $t->id_titulos  ?></td>
                                                        <td align="center"><?php echo  formatFecha($t->fecha)  ?> </td>
                                                        <td align="center"><?php echo $t->numero_acciones  ?></td>

                                                    </tr>
                                                <?php } ?>





                                            </tbody>
                                        </table>

                                    <?php } else { ?>

                                        No posee titulos activos
                                    <?php } ?>
                                </td>
                            </tr>




                        </tbody>
                    </table>


                </div>

            </div>
            <?php

            function tipoJunta($tipo)
            {


                if ($tipo == 1) {
                    return "Junta Ordinaria";
                } else if ($tipo == 2) {
                    return "Junta Extraordinaria";
                }
            }

            function enviado($enviado)
            {

                if ($enviado == 1) {
                    return "SI";
                } else if ($enviado == 0) {
                    return "NO";
                }
            }


            ?>

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <h3 class="panel-title"> Registro de Correo</h3>

                    </div>


                    <div class="panel-body">

                        <?php if (!empty($CorreosAccionista)) { ?>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Junta</th>
                                        <th>Motivo Junta</th>
                                        <th>Enviado</th>
                                        <th>Fecha Envio</th>
                                        <th>Recibido</th>
                                        <th>Fecha Apertura Correo</th>
                                        <th>Fecha Ultima Apertura</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($CorreosAccionista as $correo) { ?>

                                        <tr>
                                            <td><?php echo tipoJunta($correo->tipo_junta) ?></td>
                                            <td><?php echo $correo->asunto_junta ?></td>
                                            <td><?php echo enviado($correo->correo_enviado) ?></td>
                                            <td><?php echo formato_fecha($correo->fecha_envio) ?></td>
                                            <td><?php echo enviado($correo->correo_apertura) ?></td>
                                            <td><?php echo formato_fecha_hora($correo->fecha_apertura) ?></td>
                                            <td><?php echo formato_fecha_hora($correo->fecha_apertura) ?></td>


                                        </tr>
                                    <?php } ?>
                                </tbody>


                            </table>

                        <?php } else { ?>

                            <div>
                                 No posee registros de correo.
                            </div>

                        <?php } ?>
                    </div>

                </div>

            </div>

        </div>


        <?php



        /*    echo 'Todos los Titulos';
                var_dump($TitulosHistoricosAccionista);
 */
        /*    echo 'Nuevos';
                var_dump($TitulosSuscritos);
 */
        /*      echo 'Vendidos';
                var_dump($Tranferencia_de_accionesVedidas);
 */
        /*    echo 'Compradas';
                var_dump($Tranferencia_de_accionesCompradas);
 */
        /*   echo 'Historial por titulos Venta';
                var_dump($AccionesOriginalesT); */


        /* 
                echo 'Orden Titulos';
 */





        ?>


    </div>


    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

        <div class="panel panel-default">

            <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" href="#DivHistorico" data-parent="#accordion" aria-expanded="true" aria-controls="DivHistorico">
                        Historico de Titulos
                    </a>

                </h4>
            </div>


            <div id="DivHistorico" class="panel-collapse in collapse " role="tabpanel">

                <div class="panel-body">

                    <div>


                        <table width="100%" class="table table-bordered table-hover" style="text-align: center;">

                            <thead>

                                <tr>

                                    <th><strong>Titulo</strong></th>

                                    <th>Acciones actuales</th>

                                    <th>Fecha de emision Titulo </th>

                                    <th>Estado </th>


                                </tr>

                            </thead>

                            <tbody>


                                <?php foreach ($TitulosHistoricosAccionista as $TitulosHistoricos) { ?>

                                    <tr>
                                        <td><?php echo $TitulosHistoricos->id_titulos  ?></td>
                                        <td><?php echo $TitulosHistoricos->numero_acciones ?></td>
                                        <td><?php echo FormatFecha($TitulosHistoricos->fecha) ?></td>
                                        <td><?php echo getEstado($TitulosHistoricos->estado) ?></td>

                                    </tr>


                                <?php   } ?>






                            </tbody>

                        </table>
                    </div>
                </div>

            </div>
        </div>





        <div class="panel panel-default">

            <div class="panel-heading" role="tab" id="headingOne">

                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" href="#DivSuscritas" data-parent="#accordion" aria-expanded="true" aria-controls="DivSuscritas">
                        Acciones Suscritas
                    </a>
                </h4>
            </div>


            <div id="DivSuscritas" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <?php if (!empty($TitulosSuscritos)) { ?>

                        <table width="100%" class="table table-bordered table-hover" style="text-align: center;">

                            <thead>

                                <tr>

                                    <th><strong>Titulo</strong></th>

                                    <th>Acciones Originales</th>

                                    <th>Fecha de Suscripcion</th>




                                </tr>

                            </thead>

                            <tbody>


                                <?php foreach ($TitulosSuscritos as $TitulosSuscritos) { ?>

                                    <tr>

                                        <td><?php echo $TitulosSuscritos["Titulo"]  ?></td>
                                        <td><?php echo $TitulosSuscritos["Acciones"] ?></td>
                                        <td><?php echo  formatFecha($TitulosSuscritos["Fecha"]) ?></td>

                                    </tr>


                                <?php   } ?>






                            </tbody>

                        </table>

                    <?php } else {

                        echo 'No registra acciones suscritas';
                    } ?>

                </div>
            </div>

        </div>



        <div class="panel panel-default">


            <div class="panel-heading" role="tab" id="headingThree">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" href="#DivVentas" data-parent="#accordion" aria-expanded="true" aria-controls="DivVentas">
                        Venta de acciones
                    </a>
                </h4>
            </div>

            <div id="DivVentas" class="panel-collapse collapse" data-parent="#accordion" role="tabpanel">
                <div class="panel-body">
                    <?php if (!empty($Tranferencia_de_accionesVedidas)) { ?>

                        <table width="100%" class="table table-bordered table-hover" style="text-align: center;">

                            <thead>

                                <tr>

                                    <th><strong>Titulo que vende</strong></th>
                                    <th>Fecha de venta </th>
                                    <th>Tipo de Transaccion</th>
                                    <th>Acciones Vendidas</th>
                                    <th>Rut Comprador</th>
                                    <th>Nombre Comprador</th>
                                    <th>Nuevo Titulo Comprador</th>



                                </tr>

                            </thead>

                            <tbody>


                                <?php foreach ($Tranferencia_de_accionesVedidas as $indexTAV => $TAV) { ?>

                                    <?php foreach ($TAV as $HistorialVenta) { ?>


                                        <tr>
                                            <td><?php echo $indexTAV ?></td>
                                            <td><?php echo formatFecha($HistorialVenta["fecha_cesion"]) ?></td>
                                            <td><?php echo getTipoTransaccion($HistorialVenta["tipo_transferencia"]) ?></td>
                                            <td><?php echo $HistorialVenta["Acciones_Vendidas"] ?></td>
                                            <td><?php echo $HistorialVenta["Comprador_Rut"] ?></td>
                                            <td><?php echo $HistorialVenta["Comprador_Nombres"] . ' ' . $HistorialVenta["Comprador_ApellidoP"] . ' ' . $HistorialVenta["Comprador_ApellidoM"] ?></td>
                                            <td><?php echo $HistorialVenta["tiulo_actual"] ?></td>


                                        </tr>

                                    <?php } ?>


                                <?php   } ?>






                            </tbody>

                        </table>
                    <?php } else {

                        echo 'No registra Venta de acciones a terceros';
                    } ?>

                </div>
            </div>
        </div>


        <div class="panel panel-default">


            <div class="panel-heading" role="tab" id="headingThree">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" href="#DivCompra" data-parent="#accordion" aria-expanded="true" aria-controls="DivCompra">
                        Compra de acciones
                    </a>
                </h4>
            </div>

            <div id="DivCompra" class="panel-collapse collapse " role="tabpanel">
                <div class="panel-body">
                    <?php if (!empty($Tranferencia_de_accionesCompradas)) { ?>

                        <table width="100%" class="table table-bordered table-hover" style="text-align: center;">

                            <thead>

                                <tr>

                                    <th><strong>Titulo </strong></th>
                                    <th>Fecha de compra </th>
                                    <th>Tipo de Transaccion</th>
                                    <th>Acciones compradas</th>
                                    <th>Rut Vendedor</th>
                                    <th>Nombre Vendedor</th>
                                    <th>Titulo que vendio</th>



                                </tr>

                            </thead>

                            <tbody>


                                <?php foreach ($Tranferencia_de_accionesCompradas as $indexTAC => $TAC) { ?>


                                    <tr>
                                        <td><?php echo $indexTAC  ?></td>
                                        <td><?php echo  formatFecha($TAC["fecha_cesion"])  ?></td>
                                        <td><?php echo getTipoTransaccion($TAC["tipo_transferencia"])  ?></td>
                                        <td><?php echo $TAC["Acciones_Compradas"]  ?></td>
                                        <td><?php echo $TAC["Vendedor_Rut"]  ?></td>
                                        <td><?php echo $TAC["Vendedor_Nombres"] . ' ' . $TAC["Vendedor_ApellidoP"] . ' ' . $TAC["Vendedor_ApellidoM"] ?></td>
                                        <td><?php echo $TAC["titulo_origen"]  ?></td>

                                    </tr>


                                <?php   } ?>






                            </tbody>

                        </table>

                    <?php } else {

                        echo 'No registra compra de acciones a terceros';
                    } ?>
                </div>
            </div>
        </div>



    </div>



</div>