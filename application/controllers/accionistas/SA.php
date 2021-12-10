<?php


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
        );





        $data['directorio'] = $directorio;




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

            $this->enviarCorreo($tipo_junta, $motivo, $fecha, $pathCarta, $pathPoderes);
        } else {
            //se envia un mensaje de error

            header('HTTP/1.0 500 Internal Server Error');
        }
    }


    private function enviarCorreo($tipoJunta, $motivo, $fecha, $Pathcarta, $Pathpoderes)
    {

        $id_junta = $this->model_sa->obtenerUltimaJunta($fecha, $motivo, $tipoJunta);

        foreach ($id_junta as $index => $junta) {

            $id_junta = $junta->id_junta;
        }


        if ($tipoJunta == 1) {

            $junta = 'Junta Ordinaria';
        }
        if ($tipoJunta == 2) {

            $junta = 'Junta Extraordinaria';
        }

        $formatoFecha = explode("-", $fecha);
        $formatoFecha = $formatoFecha[2] . '/' . $formatoFecha[1] . '/' . $formatoFecha[0];

        $asunto = "Citacion a " . $junta . " el dia " . $formatoFecha;



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


        $this->load->library('email', $config);
        $configuraciones['mailtype'] = 'html'; //esto es para que lea etiquetas html si no leeria texto plano
        $configuraciones['charset'] = 'utf-8';

        $hoy = date("Y-m-d");
        $contadorEnviados = 0;
        $contadorNoEnviados = 0;

        foreach ($accionistas as $index => $a) {



           /*  $this->email->initialize($configuraciones); */

            $correoA = $a->prsn_email;
            $id_accionista = $a->id_accionista;

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
                    "id_junta" => $id_junta,
                    'correo_enviado' => 1,
                    'fecha_envio' =>  $hoy,
                );

                $this->model_sa->RegitrarCorreoEnviado($CorreoEnviadoBD);


                $CorreosEnviados[$contadorEnviados] = $CorreoEnviadoBD;
                $contadorEnviados++;
            } else {

                $CorreoNoEnviadoBD = array(

                    'id_accionista' => $id_accionista,
                    "id_junta" => $id_junta,
                    'correo_enviado' => 0,
                    'fecha_envio' =>  $hoy,
                );
                $Correos_no_enviados[$contadorNoEnviados] = $CorreoNoEnviadoBD;

                $this->model_sa->RegitrarCorreoEnviado($CorreoNoEnviadoBD);  

                
                $contadorNoEnviados++;
            }

           
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

        
    }





    #############################
    #        DIRECTORIO         #
    #############################

    public function directorio()

    {


        $directorio = $this->model_sa->directorio_sa_actual();




        $accionistas = $this->model_accionistas->accionistas();


        $data['accionistas'] = $accionistas;

        $this->load->view('plantilla/Head');
        $this->load->view('accionistas/sociedad/menu_directorio', $data);
        $this->load->view('plantilla/Footer');
    }

    public function nuevo_directorio()
    {


        $directorioActual = $this->model_sa->directorio_sa_actual();

        if (!empty($directorioActual)) {

            foreach ($directorioActual as $IndexDA => $DA) {

                $estado = array(

                    'estado_directorio' => '0',

                );



                $this->model_sa->actualizar_directorio($DA->id_directorio, $estado);
            }
        }



        $directorio = array(

            'fecha_directorio' => $this->input->post('fecha_directorio'),
            'presidente' => $this->input->post('presidente'),
            'vicepresidente' => $this->input->post('vicepresidente'),
            'director1' => $this->input->post('director1'),
            'director2' => $this->input->post('director2'),
            'director3' => $this->input->post('director3'),
            'director4' => $this->input->post('director4'),
            'director5' => $this->input->post('director5'),
            'estado_directorio' => 1,
        );


        return ($this->model_sa->insertar_directorio($directorio));
    }
}
