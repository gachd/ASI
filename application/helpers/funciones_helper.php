
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
     *Se valida si la ip donde se trabaja sea localhost
     * para cambiar parametros de produccion y desarrollo
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
if (!function_exists('index_archivos')) {

    /**
     * Crea un archivo index.html en el directorio recibio
     * para que el navegador no busque archivos,
     * el directorio debe estar creado previamente
     *  @return  index.html  */


    function index_archivos($path_archivos)
    {

        if (file_exists($path_archivos)) {

            $archivo = fopen($path_archivos . "/index.html", "w");

            $html = ('<!DOCTYPE html>
            <html>
            <head>
                <title>Acceso restringido</title>
            </head>
            <body>
            
            <p>Acceso restringido</p>
            
            </body>
            </html>
            ');
            fwrite($archivo, $html);
            fclose($archivo);

            return true;
        } else {

            return false;
        }
    }
}
if (!function_exists('index_all')) {

    /**
     * Crea un archivo index.html en cada uno de los directorios 
     * del proyecto dentro del carpeta en la raiz "archivos"
     *  @return  index.html  */

    function index_all($path_padre)
    {

        if (is_dir($path_padre)) {
            $archivos = scandir($path_padre);

            if (index_archivos($path_padre)) {

                foreach ($archivos as $archivo) {
                    if ($archivo != "." && $archivo != "..") {
                        $pathHijo = $path_padre . $archivo . "/";
                        if (is_dir($pathHijo)) {

                            index_all($pathHijo);
                        }
                    }
                }
            }
        }
    }
}


if (!function_exists('fecha_mayor18')) {

    /**
     * Devuelve la fecha de hoy si es mayor a 18 años
     *  @return  fecha */

    function fecha_mayor18()
    {
        $hoy = date("Y-m-d");

        $annio_actual = date("Y");
        $annio_mayor = $annio_actual - 18;


        $fecha_mayor18 = $annio_mayor . "-" . date("m-d");


        return $fecha_mayor18;
    }
}

if (!function_exists('servidor_correo_junta')) {

    /**
     * Devuelve un arreglo con los datos del servidor de correo
     *  @return  array */

    function servidor_correo_junta()
    {

        $config = array(

            'protocol' => 'smtp', // protocolo de envio
            'smtp_host' => 'mail.stadioitalianodiconcepcion.cl', //servidor de correo
            'smtp_port' => 587, //Puerto de envio
            'smtp_user' => 'informaciones@stadioitalianodiconcepcion.cl', // Usuario del correo
            'smtp_pass' => '#.{5k%]_H&a1', // Contraseña del correo
            'mailtype' => 'html', //Formato de correo
            'charset' => 'utf-8', //Codificación
            'wordwrap' => TRUE
        );

        return $config;
    }
}

if (!function_exists('correo_que_envia')) {

    /**
     * Devuelve array con los datos del remitente del correo
     *  @return  array */

    function correo_que_envia()
    {

        $correo = servidor_correo_junta();

        $correo = $correo['smtp_user'];

        $remiente = array(
            'correo' => $correo,
            'usuario' => 'Informaciones Stadio Italiano'
        );

        return $remiente;
    }
}



if (!function_exists('rellenoString')) {

    /**
     * @param string
     * 
     * Funcion que rellena o corta un string para que cumpla con el formato solictado
     * $limite: numero de caracteres que se quiere que tenga el string
     * $relleno: con lo que rellenaremos el string
     * $posicionRelleno: "der" o "izq"
     * 
     *  @return  string */

    function rellenoString($input, $limite = 100, $relleno = ' ', $posicionRelleno = "der")
    {
        $tamanoInput = mb_strwidth($input, 'UTF-8');
        $recorte = "";


        if ($tamanoInput < $limite) { // si falta por llenar

            $porLlenar = $limite - $tamanoInput;



            if ($posicionRelleno == "izq") { // relleno a la izquierda


                for ($i = 0; $i < $porLlenar; $i++) {

                    $recorte .= $relleno;
                }

                $recorte .= $input;

                return $recorte;
            } elseif ($posicionRelleno == "der") { //relleno a la derecha

                for ($i = 0; $i < $porLlenar; $i++) {

                    $input .= $relleno;
                }
            }

            return $input;
        } else { // si no se recorta a limite

            for ($i = 0; $i < $limite; $i++) {

                $recorte .= $input[$i];
            }
            return $recorte;
        }
    }
}
if (!function_exists('formato_caracteres')) {

    /**
     * @param string
     * 
     * Funcion que cambia los acentos de un string , la letrera "ñ" y los caracteres especiales
     * por su equivalente sin acento y sin tildes
     * 
     *  @return  string */

    function formato_caracteres($cadena)
    {

       //Reemplazamos la A y a
       $cadena = str_replace(
          array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
          array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
          $cadena
       );

       //Reemplazamos la E y e
       $cadena = str_replace(
          array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
          array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
          $cadena
       );

       //Reemplazamos la I y i
       $cadena = str_replace(
          array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
          array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
          $cadena
       );

       //Reemplazamos la O y o
       $cadena = str_replace(
          array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
          array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
          $cadena
       );

       //Reemplazamos la U y u
       $cadena = str_replace(
          array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
          array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
          $cadena
       );

       //Reemplazamos la N, n, C y c
       $cadena = str_replace(
          array('Ñ', 'ñ', 'Ç', 'ç'),	
          array('#', '#', 'C', 'c'),
          $cadena
       );

       //Reemplazamos los caracteres especiales

       $cadena = preg_replace('([^A-Za-z0-9 #])', '', $cadena);



       return $cadena;
    }

}
