<?php


defined('BASEPATH') or exit('No direct script access allowed');

class DumpSQL extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('file');
        $this->load->helper('download');
        $this->load->library('zip');
        $this->load->library('session');
    }

    public function index()
    {


        if ($this->session->username) {

            echo ('<h1>Hola '.$this->session->username.' </h1>');

            $database = ($this->db->database);
            $fecha = date('d-m-Y_H-i-s');

            $path = './SQL/' . $database . '/';

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
                index_archivos($path);
            }

            $this->load->dbutil();
            $db_format = array('format' => 'zip', 'filename' => $database . ' al ' . $fecha . '.sql');
            $backup = $this->dbutil->backup($db_format);
            $dbname = 'Respaldo de ' . $database . ' al ' . $fecha . '.zip';
            $save =  $path . $dbname;

            //Para hacer bakup en directorio
            //write_file($save, $backup);

            //Para bajar el archivo
           
            force_download($dbname,$backup);
            
            



        } else {

            echo ('<h1>Debe iniciar sesion</h1>');
            
            
        }
    }
}
