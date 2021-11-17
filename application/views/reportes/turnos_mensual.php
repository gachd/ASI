<style>
    

    #contenedor {
        margin: 0 auto;
        text-align: left;
        width: 100%;
        font-family: monospace;
    }

    .turnos {
        font-family: monospace;
        font-weight: 300;

    }

    .funcionario {
        text-transform: capitalize;
        padding-right: 8px;
        padding-bottom: 8px;
        width: 150px;
    }

    table.turnos th {
        background: #f7f7f7;
        border: 1px solid;
        text-align: center;
    }

    td {
        border: 1px solid #000;
        vertical-align: middle;
    }

    table {
        border-collapse: collapse;
    }

    .sigla {
        text-align: center;
        width: 28px;
    }

    .desc_turnos {
        font-size: 12px;
        font-family: monospace;
        text-transform: uppercase;
        margin-top: 16px;
    }

    .horario {
        text-transform: uppercase;
        padding: 5px;
        min-width: 80px;
    }
</style>
<html>

<head>
    <?php
    $data_fun = $this->model_turnos->FuncionarioId($funcionario, $tipo_funcionario);
    $turnos = $this->model_turnos->getTurnoTipo($tipo_funcionario);

    

    setlocale(LC_ALL, 'es_ES') . ': ';
    $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $hoy = date("Y-m-d H:i:s");

    switch ($tipo_funcionario) {
        case 2:
            $titulo = "PERSONAL";
            break;
        case 4:
            $titulo = "GUARDIAS";
            break;
        case 5:
            $titulo = "COSINA";
            break;
        case 6:
            $titulo = "AUX.GALERIA";
            break;

        default:
            # code...
            break;
    }
    switch ($tipo_institucion) {
        case 1:
            $institucion = "STADIO ITALIANO DI CONCEPCIÓN";
            break;
        case 2:
            $institucion = "CENTRO ITALIANO DE CONCEPCIÓN";
            break;

        default:
        $institucion = "";
            break;
    }
    ?>
    <title>TURNOS <?php echo $titulo ?></title>
</head>

<body>


    <div id="contenedor">

        <table class="desc_turnos">
            <tr style="border:none;" style="font-family: monospace;font-size:12px;">
                <th style="text-align:left;" colspan="6"><?php echo $institucion; ?><br>
                    Impreso el <?php echo ' ' . iconv('ISO-8859-1', 'UTF-8', strftime('%A %e/%b/%g - %H:%I',  strtotime("" . $hoy . ""))) . ''; ?></th>
            </tr>
            <tr style="border:none;">
            </tr>
        </table>

        <h2 style="text-align: center;">TURNO <?php echo $titulo; ?> <?php echo $institucion; ?> <br>
            <?php

            echo $meses[$mes - 1] . ' ' . $year; ?>
        </h2>

        <table class="turnos">
            <thead>
                <tr>
                    <th>Funcionario</th>

                    <?php // TH DIAS
                    $numero = cal_days_in_month(CAL_GREGORIAN, $mes, $year);
                    setlocale(LC_ALL, 'es_ES') . ': ';
                    for ($i = 1; $i <= $numero; $i++) {
                        $fecha = '' . $year . '-' . $mes . '-' . $i . '';
                        echo '<th>' . iconv('ISO-8859-1', 'UTF-8', strftime('%a',  strtotime("" . $fecha . ""))) . ' <br> ' . iconv('ISO-8859-1', 'UTF-8', strftime('%d',  strtotime("" . $fecha . ""))) . '</th>';
                    }
                    echo '</thead>
            <tbody>';

                    foreach ($data_fun as $df) {


                        echo '<tr>
            <td class="funcionario">' . substr($df->nombre_fun, 0, 1) . '. ' . $df->paterno . '</td>';
                        for ($i = 1; $i <= $numero; $i++) {
                            $color = "";
                            $turno_asignado = "";
                            $fechab = "" . $year . "-" . $mes . "-" . $i . "";
                            $rut = $df->rut;
                            $turno_funcionario_dia = $this->model_turnos->turno_funcionario_dia($fechab, $rut);
                            
                            $sigla = 'X';
                            if (!empty($turno_funcionario_dia)) {
                                foreach ($turno_funcionario_dia as $tfd) {
                                    $turno_asignado = $tfd->turno;
                                    $color = $tfd->color;
                                    $sigla = $tfd->sigla;
                                }
                            }

                            echo '<td style="background:' . $color . ';     text-align: center;">' . $sigla . '</td>';
                        }
                        echo '</tr>';
                    }
                    ?>
                    </tbody>
        </table>



        <table width="800" border="0" class="desc_turnos">
            <tbody>
                <tr>
                    <?php $desc_turnos = $this->model_turnos->getTurnoTipo($tipo_funcionario);
                    foreach ($desc_turnos as $dt) {
                        echo ' <td  style="background:' . $dt->color . ';" class="sigla">' . $dt->sigla . '</td>
                    <td class="horario">' . $dt->t_turno . '<br>';
                        if ($dt->t_inicio > "00:00:00") {
                            echo date("H:i", strtotime($dt->t_inicio)) . '<br> ' . date("H:i", strtotime($dt->t_termino)) . '</td>';
                        }
                    }
                    ?>


                </tr>
            </tbody>
        </table>

        <div style="width: 300px;
    border-top: 1px solid;
    margin-top: 110px;
    float: right;
    text-align: center;"> Diane Jimenez <br> Supervisora</div>
    </div>
</body>

</html>