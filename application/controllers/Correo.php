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
