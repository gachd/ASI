<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Correo extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index()
    {

        $this->load->view('plantilla/Head');
        $this->load->view('correo');
        $this->load->view('plantilla/Footer');
    }




    public function envio_correo()

    {

        $mensaje = $this->input->post('mensaje');

        $asunto = $this->input->post('asunto');

        $correo = $this->input->post('email');

        $nombre = $this->input->post('nombre');

        $adjunto = $_FILES['archivo'];

    
         # Se sube el archvio adjunto para poder enviarlo al correo
        


        $directorio = 'archivos/adjuntos_correos/';



        if (!file_exists($directorio)) {

            mkdir($directorio, 0777, true) or die("Erro al crear el directorio");
        }


        $path_archivo = $directorio . '/' . $adjunto["name"]; //indicamos la ruta del rchivo

        $tipo_archivo = pathinfo($path_archivo, PATHINFO_EXTENSION);


        $nombreArchivo = $nombre . "." . $tipo_archivo;

        $pathDocumento = $directorio . $nombreArchivo;


        if (move_uploaded_file($adjunto["tmp_name"], $pathDocumento)) {

            $subida = true;
        } else {
            $subida = false;
        }


        if ($subida) { // Si la subida fue exitosa se envia el correo con el archivo adjunto

            $data['asunto'] = $asunto;
            $data['mensaje'] =  $mensaje;
    
            $data["nombre"] = $nombre;
    
    
            $correo_a_enviar = $this->load->view('accionistas/sociedad/correo_citacion', $data, true);
    
    
            $this->load->library('email');
            //esto es para que lea etiquetas html si no leeria texto plano
            $configuraciones['mailtype'] = 'html';
            $configuraciones['charset'] = 'utf-8';
    
    
            $this->email->initialize($configuraciones);
    
            $this->email->set_newline("\r\n");
    
    
            $this->email->from('prueba@stadioitalianodiconcepcion.cl', "Informaciones Stadio Italiano");
            $this->email->to($correo);
            $this->email->subject($asunto);
            $this->email->message($correo_a_enviar);
    
            $this->email->attach($pathDocumento);
    
            if ($this->email->send()) {
                echo "correo enviado";
            } else {
                echo "correo no enviado";
            }
    
    
    
            $files = glob($directorio . '*'); //obtenemos todos los nombres de los archivos del fichero
    
            foreach ($files as $files) {
                if (is_file($files)) {
    
                    unlink($files); //elimino el archivo
                }
            }




        }else{



        }


       
    }





    public function config_correo()

    {


        $config = array(

            'protocol' => 'smtp', // protocolo de envio
            'smtp_host' => 'mail.stadioitalianodiconcepcion.cl', //servidor de correo
            'smtp_port' => 587, //Puerto de envio
            'smtp_user' => 'prueba@stadioitalianodiconcepcion.cl', // Usuario del correo
            'smtp_pass' => 'Stadio.2020', // Contraseña del correo
            'mailtype' => 'html', //Formato de correo
            'charset' => 'iso-8859-1', //Codificación
            'wordwrap' => TRUE

        );





        $accionistas[0] = array(
            'rut' => '19332562-9',

            'correo' => 'gersonchaparro@gmail.com',

        );
        $accionistas[1] = array(
            'rut' => '11111111-1',

            'correo' => 'gchaparro@stadioitalianodiconcepcion.cl',

        );




        foreach ($accionistas as $a) {



            $data = []; //Array para enviar los datos a la vista

            $mensaje = $this->load->view('accionistas/sociedad/correo_ordinaria', $data, TRUE); // carga de vista para el mensaje

            $destinatarios = $a["correo"]; // array con los destinatarios

            $this->load->library('email', $config); // carga de la libreria email

            $this->email->set_newline("\r\n"); // formato de salto de linea

            $this->email->from('prueba@stadioitalianodiconcepcion.cl'); //direccion de correo que envia

            $this->email->to($destinatarios); //direccion de correo que recibe

            $this->email->subject(utf8_decode('Citación a Junta Ordinaria')); // asunto del correo

            $this->email->message($mensaje);

            if ($this->email->send()) {

                echo 'Email Enviado a .' . $a['rut'];
            } else {

                show_error($this->email->print_debugger());
            }
        }
    }
}
