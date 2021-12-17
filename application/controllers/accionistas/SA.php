<?php

use Mpdf\Tag\A;
use Mpdf\Tag\I;
use MyCLabs\Enum\Enum;
use Psr\Log\NullLogger;

defined('BASEPATH') or exit('No direct script access allowed');

class SA extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();


        $this->load->library('session');
        $this->load->library('mpdf60/Mpdf');
        $this->load->model('model_accionistas');
        $this->load->model('model_titulo');
        $this->load->model('model_sa');
    }



    public function index()
    {



        $data['accionistas'] = $this->model_accionistas->accionistas();

        $data['ultimos'] = $this->model_accionistas->ultimos();

        $no_entregados = $this->model_titulo->nro_titulos_no_entregados();
        $data['no_entregados'] =  $no_entregados[0]->no_entregados;


        $emitidas = $this->model_accionistas->totalemitidas();

        $totalemitidas = $emitidas[0]->total_emitidas;
        $data['emitidas'] = $totalemitidas;


        $sa = $this->model_sa->datos_sa();
        $total_acciones = $sa[0]->Acciones;
        $data['sa'] = $total_acciones;

        $saldo =  $total_acciones - $totalemitidas;

        $data['saldo'] = $saldo;

        $data['todo_sa'] = $this->model_sa->datos_sa();

        /* $activos = $this->model_accionistas->id_activos(); */


        $directorioActual = $this->model_sa->directorio_sa_actual();


        if ($directorioActual) {


            foreach ($directorioActual as $Index => $directorioA) {

                $presidente = $this->model_accionistas->datosaccionista($directorioA->presidente);
                $presidente = $presidente[0];
                $vicepresidente = $this->model_accionistas->datosaccionista($directorioA->vicepresidente);
                $vicepresidente = $vicepresidente[0];
                $director1 = $this->model_accionistas->datosaccionista($directorioA->director1);
                $director1 = $director1[0];
                $director2 = $this->model_accionistas->datosaccionista($directorioA->director2);
                $director2 = $director2[0];
                $director3 = $this->model_accionistas->datosaccionista($directorioA->director3);
                $director3 = $director3[0];
                $director4 = $this->model_accionistas->datosaccionista($directorioA->director4);
                $director4 = $director4[0];
                $director5 = $this->model_accionistas->datosaccionista($directorioA->director5);
                $director5 = $director5[0];
                $fecha = $directorioA->fecha_directorio;
                $gerente = $directorioA->gerente;
                $junta = $this->model_sa->obtenerJuntas($directorioA->directorio_junta);
                $junta = $junta[0];
            }

            $directores = array(
                1 => $director1,
                2 => $director2,
                3 => $director3,
                4 => $director4,
                5 => $director5,
            );

            $directorio = array(
                'presidente' => $presidente,
                'vicepresidente' => $vicepresidente,
                'director' => $directores,
                'gerente' => $gerente,
                'fecha' => $fecha,
                'junta' => $junta,
            );





            $data['directorio'] = $directorio;
        } else {

            $data['directorio'] = null;
        }






        $this->load->view('plantilla/Head');
        $this->load->view('accionistas/menu_sa', $data);
        $this->load->view('plantilla/Footer');
    }

    #############################
    #      JUNTA EXTRAORDINARIA      #
    #############################
    public function extraordinaria()
    {

        $data['accionistas'] = $this->model_accionistas->accionistas();

        foreach ($data['accionistas'] as $index => $a) {

            $accionistajson[$a->id_accionista] =  $a->prsn_nombres . ' ' . $a->prsn_apellidopaterno . ' ' . $a->prsn_apellidomaterno;
        }





        $data['accionistasjson'] = json_encode($accionistajson);

        $data['tipo_junta'] = $tipo_junta = 2; // extraordinaria

        $data['juntasExtra'] = $juntasExtra = $this->model_sa->alljunta($tipo_junta);

        $this->load->view('plantilla/Head');
        $this->load->view('accionistas/sociedad/menu_extraordinaria', $data);
        $this->load->view('plantilla/Footer');
    }


    #############################
    #      JUNTA ORDINARIA      #
    #############################
    public function ordinaria()
    {






        $data['accionistas'] = $this->model_accionistas->accionistas();

        foreach ($data['accionistas'] as $index => $a) {

            $accionistajson[$a->id_accionista] =  $a->prsn_nombres . ' ' . $a->prsn_apellidopaterno . ' ' . $a->prsn_apellidomaterno;
        }





        $data['accionistasjson'] = json_encode($accionistajson);

        $data['tipo_junta'] = $tipo_junta =   1; // ordinaria

        $data['juntaOrdinaria']  = $juntaOrdinaria = $this->model_sa->alljunta($tipo_junta);


        $this->load->view('plantilla/Head');
        $this->load->view('accionistas/sociedad/menu_ordinaria', $data);
        $this->load->view('plantilla/Footer');
    }

    public function obtenerJuntas()
    {


        $tipo_junta =   $this->input->post("tipo_junta"); // ordinaria = 1 , extraordinaria = 2



        $Juntas = $this->model_sa->alljunta($tipo_junta);

        foreach ($Juntas as $index => $junta) {

            $tieneDetalle = $this->model_sa->obtenerDetalleJunta($junta->id_junta);
            $tieneCorreo = $this->model_sa->ObtenerCorreo_NoEnviados($junta->id_junta);
            if ($tieneDetalle) {
                $detalle = $tieneDetalle[0];;
                $Juntas[$index]->detalle = $detalle;
            } else {
                $junta->detalle = null;
            }

            if ($tieneCorreo) {
                $correo = $tieneCorreo[0];
                $Juntas[$index]->correo = $correo;
            } else {
                $junta->correo = null;
            }
        }

        echo json_encode($Juntas);
    }

    public function nueva_junta()
    {


        $fecha = $this->input->post('fecha_junta');
        $motivo = $this->input->post("motivo_junta");
        $tipo_junta = $this->input->post("tipo_junta"); // 1 ordinaria 2 extraordinaria



        if (!empty($_FILES["carta_junta"]) && !empty($_FILES["registro_poderes"])) { //subia de archivo cartas

            $carta_junta = $_FILES["carta_junta"];
            $registro_poderes = $_FILES["registro_poderes"];



            if ($tipo_junta == 1) {
                $directorio = 'archivos/sa/junta_ordinaria';
                $junta = '_junta_ordinaria.';
            }
            if ($tipo_junta == 2) {
                $directorio = 'archivos/sa/junta_extraordinaria';
                $junta = '_junta_extraordinaria.';
            }

            if (!file_exists($directorio)) {

                mkdir($directorio, 0777, true) or die("Hubo un error al crear el directorio de almacenamiento");
                index_archivos($directorio);
            }


            //Abrimos el directorio
            $dir = opendir($directorio);

            $path_archivo = $directorio . '/' . $carta_junta["name"]; //indicamos la ruta de destino de los archivos

            $tipo_archivo = pathinfo($path_archivo, PATHINFO_EXTENSION);

            $nombreArchivo = 'carta_junta_' . $fecha . '.' . $tipo_archivo;

            $directorio2 = $directorio . '/';

            $pathCarta = $directorio2 . $nombreArchivo;

            if (move_uploaded_file($carta_junta["tmp_name"], $pathCarta)) {

                $subidaCarta = true;
            } else {
                $subidaCarta = false;
            }

            // subimos junta de poderes
            $path_archivo = $directorio . '/' . $registro_poderes["name"]; //indicamos la ruta de destino de los archivos

            $tipo_archivo = pathinfo($path_archivo, PATHINFO_EXTENSION);

            $nombreArchivo = 'poderes_junta_' . $fecha . '.' . $tipo_archivo;

            $pathPoderes = $directorio2 . $nombreArchivo;

            if (move_uploaded_file($registro_poderes["tmp_name"], $pathPoderes)) {

                $subidaPoderes = true;
            } else {
                $subidaPoderes = false;
            }
        }



        if ($subidaCarta && $subidaPoderes) {

            $dataJunta = array(

                'fecha_junta' => $fecha,
                'asunto_junta' => $motivo,
                'tipo_junta' => $tipo_junta,
                'path_carta_junta' => $pathCarta,
                'path_registro_poderes' => $pathPoderes,

            );

            $this->model_sa->nueva_junta($dataJunta);

            $accionistas = $this->model_accionistas->accionistas();

            $id_junta = $this->model_sa->obtenerUltimaJunta($fecha, $motivo, $tipo_junta);

            $id_junta = $id_junta[0]->id_junta;





            $Validacion = $this->enviarCorreo($accionistas, $id_junta, $tipo_junta, $motivo, $fecha, $pathCarta, $pathPoderes);

            if ($Validacion['validacion']) {

                echo "Se ha enviado a todos el correo";
                $Enviados = $Validacion['enviados'];

                foreach ($Enviados as $index => $enviado) {

                    $this->model_sa->RegistrarCorreo($enviado);
                }
            } else {

                echo "Alguien falto el envio";

                $Enviados = $Validacion['enviados'];

                $NoEnviados = $Validacion['no_enviados'];


                foreach ($Enviados as $index => $enviado) {

                    $this->model_sa->RegistrarCorreo($enviado);
                }

                foreach ($NoEnviados as $index => $no_enviado) {

                    $this->model_sa->RegistrarCorreo($no_enviado);
                }
            }
        } else {
            //se envia un mensaje de error

            header('HTTP/1.0 500 Internal Server Error');
        }
    }




    private function enviarCorreo($accionistas, $id_junta, $tipoJunta, $motivo, $fecha, $Pathcarta, $Pathpoderes)
    {



        if ($tipoJunta == 1) {

            $junta = 'Junta Ordinaria';
        }
        if ($tipoJunta == 2) {

            $junta = 'Junta Extraordinaria';
        }

        $formatoFecha = explode("-", $fecha);
        $formatoFecha = $formatoFecha[2] . '/' . $formatoFecha[1] . '/' . $formatoFecha[0];

        $asunto = "Citacion a " . $junta . " el dia " . $formatoFecha;

        $data['sociedad'] = 'Sociedad Stadio Italiano di Concepción';
        $data['junta'] = $junta;
        $data['fecha'] = obtenerFechaEnLetras($fecha);

        $accionistas = $this->model_accionistas->datosaccionista("3");


        $config = array(

            'protocol' => 'smtp', // protocolo de envio
            'smtp_host' => 'mail.stadioitalianodiconcepcion.cl', //servidor de correo
            'smtp_port' => 587, //Puerto de envio
            'smtp_user' => 'prueba@stadioitalianodiconcepcion.cl', // Usuario del correo
            'smtp_pass' => 'Stadio.2020', // Contraseña del correo
            'mailtype' => 'html', //Formato de correo
            'charset' => 'utf-8', //Codificación
            'wordwrap' => TRUE

        );



        $data['asunto'] = $motivo;
        $data['junta'] = $junta;


        $this->load->library('email', $config);
        $configuraciones['mailtype'] = 'html'; //esto es para que lea etiquetas html si no leeria texto plano
        $configuraciones['charset'] = 'utf-8';

        $hoy = date("Y-m-d");
        $contadorEnviados = 0;
        $contadorNoEnviados = 0;
        $contadorCorreos = 0;

        foreach ($accionistas as $index => $a) {



            /*  $this->email->initialize($configuraciones); */

            $correoA = $a->prsn_email;
            $id_accionista = $a->id_accionista;

            $hashCorreo = md5(rand());

            $data['hash'] = $hashCorreo;

            $data["accionista"] = $a;

            $mensaje = $this->load->view('accionistas/sociedad/correo_citacion', $data, true);


            $this->email->set_newline("\r\n");
            $this->email->from('prueba@stadioitalianodiconcepcion.cl', "Informaciones Stadio Italiano");
            $this->email->to($correoA);
            $this->email->subject($asunto);
            $this->email->message($mensaje);

            $this->email->attach($Pathcarta);
            $this->email->attach($Pathpoderes);



            if ($this->email->send()) {



                $CorreoEnviadoBD = array(

                    'id_accionista' => $id_accionista,
                    'id_junta' => $id_junta,
                    'correo_enviado' => 1,
                    'fecha_envio' => $hoy,
                    'correo_apertura' => 0,
                    'hash_envio' => $hashCorreo,


                );

                $CorreoEnviados[$contadorEnviados] = $CorreoEnviadoBD;

                $contadorEnviados++;
            } else {

                $CorreoNoEnviadoBD = array(

                    'id_accionista' => $id_accionista,
                    "id_junta" => $id_junta,
                    'correo_enviado' => 0,
                    'fecha_envio' =>  $hoy,
                );




                $Correos_no_enviados[$contadorNoEnviados] = $CorreoNoEnviadoBD;


                $contadorNoEnviados++;
            }

            $contadorCorreos++;
        }
        if ($contadorCorreos == $contadorEnviados) {

            $respuesta = array(

                'validacion' => true,
                'enviados' => $CorreoEnviados,

            );

            return $respuesta;
        } else {


            $respuesta = array(

                'validacion' => false,
                "enviados" => $CorreoEnviados,
                "no_enviados" => $Correos_no_enviados,


            );

            return $respuesta;
        }
    }



    public function guardar_detalle_junta()
    {

        $id_junta = $this->input->post('id_junta_detalle');
        $tipo_junta = $this->input->post('tipo_junta_detalle');
        $detalle_junta = $this->input->post('detalle_junta');

        $fecha_actual = date("Y-m-d");

        $dataJunta = array(
            'id_junta' => $id_junta,
            'detalle_junta' => $detalle_junta,
            'fecha_detalle' => $fecha_actual,
        );

        $this->model_sa->ingresoDetalleJunta($dataJunta);
    }





    public function guardar_correo_junta()
    {

        $id_junta = $this->input->post('id_junta_correo');
        $correo_junta = $this->input->post('correo_junta');

        $fecha_actual = date("Y-m-d");

        $dataJunta = array(
            'id_junta' => $id_junta,
            'correo_junta' => $correo_junta,
            'fecha_correo' => $fecha_actual,
        );

        $this->model_sa->ingresoCorreoJunta($dataJunta);
    }

    public function obtener_detalle_junta()
    {

        $id_junta = $this->input->post('id_junta');

        $detalle = $this->model_sa->obtenerDetalleJunta($id_junta);

        $detalle = $detalle[0];

        echo json_encode($detalle);
    }


    public function obtener_correo_junta()

    {
        $id_junta = $this->input->post('id_junta');
        $estado = $this->input->post('estado');

        if ($estado == "enviados") {



            $correosSI = $this->model_sa->ObtenerCorreo_Enviados($id_junta);
            $data['correosSI'] = $correosSI;
            $data['correosNo'] = null;
        } else if ($estado == "no_enviados") {



            $correosSI = $this->model_sa->ObtenerCorreo_Enviados($id_junta);
            $correosNo = $this->model_sa->ObtenerCorreo_NoEnviados($id_junta);

            if (empty($correosSI)) {
                $data['correosSI'] = null;
            } else {
                $data['correosSI'] = $correosSI;
            }

            $data['correosNo'] = $correosNo;
        }

        echo json_encode($data);
    }


    public function reEnvioCorreo()
    {

        $id_junta = $this->input->post('id_junta');

        if ($id_junta) {

            $accionistas_a_reenviar = $this->model_sa->ObtenerCorreo_NoEnviados($id_junta);
            $DatosJunta = $this->model_sa->obtenerJuntas($id_junta);
            $DatosJunta = $DatosJunta[0];

            $id_junta = $DatosJunta->id_junta;
            $tipo_junta = $DatosJunta->tipo_junta;
            $pathCarta = $DatosJunta->path_carta_junta;
            $pathPoderes = $DatosJunta->path_registro_poderes;
            $fecha_junta = $DatosJunta->fecha_junta;

            $asunto = $DatosJunta->asunto_junta;



            $respuesta = $this->enviarCorreo($accionistas_a_reenviar, $id_junta, $tipo_junta, $asunto, $fecha_junta, $pathCarta, $pathPoderes);



            if ($respuesta["enviados"]) {

                $actualizar = $respuesta["enviados"];
                $hoy = date("Y-m-d");

                foreach ($actualizar as $key => $act) {

                    $HASH = $act["hash_envio"];


                    $DataUpdate = array(
                        'correo_enviado' => 1,
                        'fecha_envio' => $hoy,
                        'hash_envio' =>  $HASH
                    );


                    $this->model_sa->UpdateCorreoNoEnviado($act["id_junta"], $act["id_accionista"], $DataUpdate);
                }
            }
        }
    }

    public function rastreoCorreoJunta()
    {

        //retorna una imagen
        header('Content-Type: image/gif');

        if (isset($_GET['code'])) {

            $codigoRastreo = $_GET["code"];


            $ahora = date("Y-m-d H:i:s");
            $validacion = $this->model_sa->CorreoFueAbierto($codigoRastreo);

            if (empty($validacion)) {


                $data = array(
                    'correo_apertura' => 1,
                    'fecha_apertura' => $ahora,
                    'ultima_apertura' => $ahora,
                );


                $this->model_sa->RegistrarAperturaCorreo($codigoRastreo, $data);
            } else {

                $data = array(

                    'ultima_apertura' => $ahora
                );

                $this->model_sa->RegistrarAperturaCorreo($codigoRastreo, $data);
            }
        }

        exit;
    }





    #############################
    #        DIRECTORIO         #
    #############################

    public function directorio()

    {


        $directorio = $this->model_sa->directorio_sa_actual();

        $juntas = $this->model_sa->juntas_historico();

        $data["juntas"] = $juntas;


        $accionistas = $this->model_accionistas->accionistas();


        $data['accionistas'] = $accionistas;

        $this->load->view('plantilla/Head');
        $this->load->view('accionistas/sociedad/menu_directorio', $data);
        $this->load->view('plantilla/Footer');
    }

    public function nuevo_directorio()
    {

        $junta = $this->input->post('junta');



        $directorioActual = $this->model_sa->directorio_sa_actual();

        if (!empty($directorioActual)) {

            foreach ($directorioActual as $IndexDA => $DA) {

                $estado = array(

                    'estado_directorio' => '0',

                );



                $this->model_sa->actualizar_directorio($DA->id_directorio, $estado);
            }
        }
        $DatosJunta = $this->model_sa->obtenerJuntas($junta);
        $DatosJunta = $DatosJunta[0];

        $fecha = $DatosJunta->fecha_junta;



        $directorio = array(

            'fecha_directorio' => $fecha,
            'presidente' => $this->input->post('presidente'),
            'vicepresidente' => $this->input->post('vicepresidente'),
            'director1' => $this->input->post('director1'),
            'director2' => $this->input->post('director2'),
            'director3' => $this->input->post('director3'),
            'director4' => $this->input->post('director4'),
            'director5' => $this->input->post('director5'),
            'estado_directorio' => 1,
            'gerente' => $this->input->post('gerente'),
            'directorio_junta' => $junta,
        );


        return ($this->model_sa->insertar_directorio($directorio));
    }

    public function  getDirectorios()
    {
        $directoriosH = $this->model_sa->directorios_sa_historico();
        $directorioIndex = 0;

        if ($directoriosH) {


            foreach ($directoriosH as $indexDH => $DH) {

                $presidente = $this->model_accionistas->datosaccionista($DH->presidente);
                $presidente = $presidente[0];
                $vicepresidente = $this->model_accionistas->datosaccionista($DH->vicepresidente);
                $vicepresidente = $vicepresidente[0];
                $director1 = $this->model_accionistas->datosaccionista($DH->director1);
                $director1 = $director1[0];
                $director2 = $this->model_accionistas->datosaccionista($DH->director2);
                $director2 = $director2[0];
                $director3 = $this->model_accionistas->datosaccionista($DH->director3);
                $director3 = $director3[0];
                $director4 = $this->model_accionistas->datosaccionista($DH->director4);
                $director4 = $director4[0];
                $director5 = $this->model_accionistas->datosaccionista($DH->director5);
                $director5 = $director5[0];
                $fecha = $DH->fecha_directorio;
                $gerente = $DH->gerente;
                $junta = $this->model_sa->obtenerJuntas($DH->directorio_junta);
                $junta = $junta[0];


                $directores = array(
                    1 => $director1,
                    2 => $director2,
                    3 => $director3,
                    4 => $director4,
                    5 => $director5,
                );

                $directorio[$directorioIndex] = array(
                    'presidente' => $presidente,
                    'vicepresidente' => $vicepresidente,
                    'director' => $directores,
                    'gerente' => $gerente,
                    'fecha' => $fecha,
                    'junta' => $junta,
                );

                $directorioIndex++;
            }







            $data['directorio'] = $directorio;
        } else {

            $data['directorio'] = null;
        }

        echo json_encode($data);
    }
}
