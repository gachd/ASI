<?php

use Mpdf\Tag\A;

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

        echo json_encode($Juntas);
    }

    public function nueva_junta()
    {


        $fecha = $this->input->post('fecha_junta');
        $motivo = $this->input->post("motivo_junta");
        $tipo_junta = $this->input->post("tipo_junta"); // 1 ordinaria 2 extraordinaria


        $pathCarta = '';


        if (!empty($_FILES["carta_junta"])) { //subia de archivo cartas

            $carta_junta = $_FILES["carta_junta"];



            if ($tipo_junta == 1) {
                $directorio = 'archivos/sa/junta_ordinaria/';
                $junta = '_junta_ordinaria.';
            }
            if ($tipo_junta == 2) {
                $directorio = 'archivos/sa/junta_extraordinaria/';
                $junta = '_junta_extraordinaria.';
            }

            if (!file_exists($directorio)) {

                mkdir($directorio, 0777, true) or die("Hubo un error al crear el directorio de almacenamiento");
            }


            //Abrimos el directorio
            $dir = opendir($directorio);

            $path_archivo = $directorio . '/' . $carta_junta["name"]; //indicamos la ruta de destino de los archivos

            $tipo_archivo = pathinfo($path_archivo, PATHINFO_EXTENSION);

            $nombreArchivo = $fecha . $junta . $tipo_archivo;

            $pathCarta = $directorio . $nombreArchivo;

            if (move_uploaded_file($carta_junta["tmp_name"], $pathCarta)) {

                $subida = true;
            } else {
                $subida = false;
            }
        }


        $dataJunta = array(
            'fecha_junta' => $fecha,
            'asunto_junta' => $motivo,
            'tipo_junta' => $tipo_junta,
            'path_carta_junta' => $pathCarta,
        );

        $this->model_sa->nueva_junta($dataJunta);
    }

    function correo()

    {

        $this->load->library("phpmailer_library");
        $objMail = $this->phpmailer_library->load();

        var_dump($objMail);


/* 

        

        $this->load->library('email');
        

        $asunto = "Junta Ordinaria  20/06/2020";


        $mensaje = "Hola buenas esta es una prueba de correo llamandoa  citacion de junta ordinaria asdas sdas sasda sdasdasd asd sad as asd assd as se adjunta carta de junta ordinaria";

        $data['mensaje'] = $mensaje;
        $data['asunto'] = $asunto;
  


        # CONFIGURACION DE CORREO

    
        $config["protocol"]  = 'smtp'; //protocolo de envio
        $config["smtp_host"] = 'mail.stadioitalianodiconcepcion.cl'; //servidor de correo
        $config["smtp_port"] = '587'; //Puerto de envio
        $config["smtp_user"] = 'prueba@stadioitalianodiconcepcion.cl'; // Usuario servidor de correo
        $config["smtp_pass"] = 'Stadio.2020'; // Contraseña del correo
        $config["mailtype"]  = 'html'; //Formato de correo
        $config["charset"]   = 'utf-8'; //Codificación
        $config["wordwrap"]  = TRUE; //
        $config['validate'] = true; //Validar datos de correo


        



        $accionistas[0] = array(
            'rut' => '19332562-9',
            'nombre' => 'Juan Lopez',
            'correo' => 'gersonchaparro@gmail.com',

        );
        $accionistas[1] = array(
            'rut' => '11111111-1',
            'nombre' => 'Julio Apeter ',
            'correo' => 'gchaparro@stadioitalianodiconcepcion.cl',

        );

      





        foreach ($accionistas as $a) {




            $data ["accionista"] = $a; ; //Array para enviar los datos a la vista

            $mensaje = $this->load->view('accionistas/sociedad/correo_citacion', $data, TRUE); // carga de vista para el mensaje

            $destinatario = $a["correo"]; // array con los destinatarios

            $this->email->initialize($config);// carga de la libreria email

            $this->email->set_newline("\r\n"); // formato de salto de linea

            $this->email->from('prueba@stadioitalianodiconcepcion.cl','Contacto Stadio'); //direccion de correo que envia

            $this->email->to($destinatario); //direccion de correo que recibe

            $this->email->subject('Citación a Junta Ordinaria'); // asunto del correo

            $this->email->message($mensaje);

            $this->email->attach('C:\xampp\htdocs\ASI\archivos\sa\junta_ordinaria\0123-03-12_junta_ordinaria.pdf');

            if ($this->email->send()) {

                echo 'Email Enviado a .' . $a['rut'];
                
            } else {

                echo 'Error al enviar el email a ' . $a['rut'];
                echo $this->email->print_debugger();
            }
        }
        $this->load->view('accionistas/sociedad/correo_citacion', $data);
 */

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
