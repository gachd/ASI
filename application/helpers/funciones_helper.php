
<?php



if (!function_exists('obtenerFechaEnLetra')) {

    /**
     * Función que convierte una fecha en formato Y-m-d a una fecha en letras
     * @param $fecha Fecha en formato Y-m-d
     *  @return string  */


    function obtenerFechaEnLetras($fecha)
    {



        $dia = conocerDiaSemanaFecha($fecha);
        $num = date("j", strtotime($fecha));
        $anno = date("Y", strtotime($fecha));
        $mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
        $mes = $mes[(date('m', strtotime($fecha)) * 1) - 1];
        return $dia . ', ' . $num . ' de ' . $mes . ' del ' . $anno;
    }
}


if (!function_exists('conocerDiaSemanaFecha')) {

    /**
     * Ingresa una fecha en formato Y-m-d y regresa el nombre del día de la semana.
     *  @return dia_semana  */



    function conocerDiaSemanaFecha($fecha)
    {
        $dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
        $dia = $dias[date('w', strtotime($fecha))];
        return $dia;
    }
}


if (!function_exists('ip_hosting')) {

    /**
     * Envia la ip del hosting al servidor,
     * Esto debe cambiar si la ip del servidor cambia
     *  @return ip_hosting  */

    function ip_hosting()
    {
        $ip_hosting = "186.64.118.200";
        return $ip_hosting;
    }
}

if (!function_exists('es_localhost')) {

    /**
     * Envia la ip del hosting al servidor,
     * Esto debe cambiar si la ip del servidor cambia
     *  @return booleano   */

    function es_localhost()
    {
        if ($_SERVER['SERVER_NAME'] == 'localhost' or $_SERVER['SERVER_ADDR'] == '127.0.0.1') {

            return true;
        } else {

            return false;
        }
    }
}

if (!function_exists('formato_fecha')) {

    /**
     * Ingresa la fecha en formato Y-m-d y regresa la fecha en formato d-m-Y
     *  @return fecha   */

    function formato_fecha($fecha)
    {

        if ($fecha != '') {

            $fecha = date("d-m-Y", strtotime($fecha));
        } else {

            $fecha = 'No Registra';
        }
        return $fecha;
    }
}
if (!function_exists('formato_fecha_hora')) {

    /**
     * Ingresa la fecha en formato Y-m-d H:i:s y regresa la fecha en formato d-m-Y H:i:s
     *  @return fecha   */

    function formato_fecha_hora($fecha)
    {

        if ($fecha != '') {

            $fecha = date("H:i:s d-m-Y ", strtotime($fecha));
        } else {

            $fecha = 'No Registra';
        }
        return $fecha;
    }
}


if (!function_exists('annio_planificar')) {

    /**
     * Retorna el año que se puede planificar,
     * entrado noviembre del año actual, se habilita el año siguiente
     *  @return  año  */

    function annio_planificar()
    {

        $annio_actual = date("Y");
        $mes_actual = date("m");
        $annio_siguiente = $annio_actual + 1;

        if ($mes_actual > 10) {

            $annio_planificar = $annio_siguiente;
        } else {

            $annio_planificar = $annio_actual;
        }

        return $annio_planificar;
    }
}
if (!function_exists('obtener_meses')) {

    /**
     * Devuelve un arreglo con los meses del año
     * con indice y nombre segun el mes
     *  @return  arreglo  */


    function obtener_meses()
    {
        $meses = array(
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12  => 'Diciembre'
        );
        return $meses;
    }
}
