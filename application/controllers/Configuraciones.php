<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Configuraciones extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        $this->load->model("model_login");
        $this->load->model("model_socios");

        if ($this->session->userdata('logueado')) {

            if (!in_array("0", $_SESSION['permisos_principal'])) {
                redirect(base_url() . 'calendario');
            } else {
                echo "SuperUser<br><br>";  // borrar else{} si no se necesita
            }
        } else {
            redirect(base_url() . 'login');
        }
    }
    public function index()
    {
    }
    public function index_all()
    {


        echo "Index_all";

        $pathArchivos = "archivos/";

        index_all($pathArchivos);
    }

    public function path_socios_antiguos()
    {

        $socios = $this->model_socios->sociosAll();


        $pathPadre = "archivos/socios/";

        foreach ($socios as $socio) {
            
            $rutsocio = $socio->prsn_rut;
            $path = $pathPadre . $rutsocio;

            if(!$socio->path){

    
                $datos = array(
                    'path' => $path,
                    
                );

                echo $path . "<br>";
    
                $this->model_socios->updateSocio($datos, $rutsocio);

            }else{
                echo $rutsocio." ya tiene path, ".$path."<br>";
            }

         

           
        }

        
    }
}
