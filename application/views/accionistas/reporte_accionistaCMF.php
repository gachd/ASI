<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
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



    #mitabla {
        border: 1px solid #000;
        border-collapse: collapse;
        text-transform: uppercase;
    }

    #mitabla td {
        border: 1px solid #000;
        min-width: 0.6em;
        padding: 3px;
        vertical-align: middle;
        text-transform: uppercase;
        font-size: 10px;
    }

    #mitabla th {
        border: 1px solid #000;
        min-width: 0.6em;
        padding: 3px;
        vertical-align: middle;
        text-transform: uppercase;
        font-size: 12px;
    } 
</style>



<?php
$ci = &get_instance();
$ci->load->model('model_socios');
setlocale(LC_ALL, 'es_ES') . ': ';

$hoy = date("Y-m-d H:i:s");
$hooy = date("d-m-Y");

function getPuntosRut($rut)
{

    $rutTmp = explode("-", $rut);

    return number_format($rutTmp[0], 0, "", ".") . '-' . $rutTmp[1];
}
?>



<div class="panel-heading">
    <div class="panel-title">
        <table width="100%" border="0">
            <tbody>
                <tr>
                    <td width="30%" rowspan="2" align="left" style="padding-bottom:15px;"><img src="<?php echo base_url(); ?>/assets/images/logo_instituciones_mini.png" width="130" style="margin-right:25px;" /></td>
                    <td colspan="2">
                        <h2>Listado de accionistas </h2>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td align="left" colspan="2"><?php echo 'Registro de accionistas al ' . $hooy; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


<div class="panel-body">
    <div class="table-responsive ">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered center" id="mitabla">
            <thead>
                <tr>

                    <th>#</th>
                    <th>Rut</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                    <th>Incorporación</th>

                </tr>
            </thead>
            <tbody>

                <?php if (!empty($accionista)) : ?>

                    <?php foreach ($accionista as $s) : ?>

                        <?php $cont = $cont + 1; ?>

                        <tr class="odd gradeX">

                            <td><?php echo $cont ?></td>
                            <td><div class="col-md-7"> <?php echo getPuntosRut($s->prsn_rut) ?> </div></td>
                            <td><?php echo $s->prsn_nombres . " " . $s->prsn_apellidopaterno . " " . $s->prsn_apellidomaterno ?></td>
                            <td><?php echo $s->numero_acciones ?></td>
                            <td><?php echo  $s->fecha  ?></td>

                        </tr>
                        
                    <?php endforeach; ?>
                <?php endif; ?>
                php

            </tbody>
        </table>
    </div>
</div>