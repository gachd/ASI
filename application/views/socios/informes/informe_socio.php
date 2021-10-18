<head>
    <!-- Latest compiled and minified CSS -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    td,
    th {
        padding: 5px;
        font-family: monospace;
        font-size: 12px;
        text-transform: uppercase;
        text-align: center;
    }

    .td-cont-totales {
        vertical-align: top;
        padding: 15px;
    }



    .tbl-segmentacion td {
        text-align: left;
    }

    .titulo-doc {
        font-size: 24px;
        letter-spacing: 2px;
        font-weight: 600;
    }

    .negrita {
        font-size: 12px;
        font-weight: 900;
    }

    .subtitulo-doc {
        font-size: 14px;
        letter-spacing: 1px;
        border-bottom: 1px solid #ccc;
        padding-bottom: 7px;
        width: 90%;
    }

    .texto {
        font-family: monospace;
        text-transform: inherit;
        font-size: 16px;
    }
</style>



<?php
$ci = &get_instance();
$ci->load->model('model_informe');
setlocale(LC_ALL, 'es_ES') . ': ';

$hoy = date("Y-m-d H:i:s");
$hooy = date("d-m-Y");




function getPuntosRut($rut)
{

    $rutTmp = explode("-", $rut);

    return number_format($rutTmp[0], 0, "", ".") . '-' . $rutTmp[1];
}

function getEstado($estado)
{

    if ($estado == 0) {

        return ("De Baja");
    }
    if ($estado == 1) {

        return ("Activo");
    }
}

function getSexo($sexo)
{

    if ($sexo == 1) {
        return ("Masculino");
    }
    if ($sexo == 0) {
        return ("Femenino");
    }
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

function getEdad($fecha)
{


    
    $nacimiento = new DateTime($fecha);
    $hoy = new Datetime(date('Y/m/d'));
    $diff = $hoy->diff($nacimiento);
    return $diff->y;
}


?>



<div class="panel-heading">
    <div class="panel-title">
        <table width="100%" border="0">
            <tbody>
                <tr>
                    <td width="30%" rowspan="2" align="left" style="padding-bottom:15px;"><img src="<?php echo base_url(); ?>/assets/images/logo_instituciones_mini.png" width="130" style="margin-right:25px;" /></td>

                    <?php switch ($corp) {
                        case 1:
                            echo '<td colspan="2" class="titulo-doc">Consolidado</td>';
                            break;
                        case 2:
                            echo '<td colspan="2" class="titulo-doc">Stadio Italiano Di Concepción</td>';
                            break;
                        case 3:
                            echo '<td colspan="2" class="titulo-doc">Scuola Italiana Di Concepcion</td>';
                            break;
                        case 4:
                            echo '<td colspan="2" class="titulo-doc">Centro Italiano De Concepcion</td>';
                            break;
                        case 5:
                            echo '<td colspan="2" class="titulo-doc">Stadio Atletico Italiano</td>';
                            break;
                        case 6:
                            echo '<td colspan="2" class="titulo-doc">Sociedad Italiana De Socorros Mutuos</td>';
                            break;
                    } ?>




                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td align="left" class="" colspan="2"><?php echo 'Regristro de socios al ' . $hooy; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


<div class="panel-body">
    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" border="" class="table table-striped table-bordered center ">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Rut</th>
                    <th>Nombre</th>
                    <th>Edad</th>
                    <th>Sexo</th>
                    <th>Correo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($activos as $s) : ?>
                    <?php $cotS = $cotS + 1; ?>


                    <tr class="odd gradeX">

                        <td><?php echo $cotS  ?></td>
                        <td><?php echo getPuntosRut($s->prsn_rut) ?></td>
                        <td><?php echo $s->prsn_nombres . " " . $s->prsn_apellidopaterno . " " . $s->prsn_apellidomaterno  ?></td>
                        <td><?php echo getEdad($s->prsn_fechanacimi) ?></td>
                        <td><?php echo getSexo($s->prsn_sexo) ?></td>
                        <td><?php echo $s->prsn_email ?></td>

                    </tr>



                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>