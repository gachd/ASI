
<?php



if (!function_exists('obtenerFechaEnLetra')) {



    function obtenerFechaEnLetras($fecha)
    {

        /**
         * Función que convierte una fecha en formato Y-m-d a una fecha en letras
        * @param $fecha Fecha en formato Y-m-d
         *  @return string  */


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



