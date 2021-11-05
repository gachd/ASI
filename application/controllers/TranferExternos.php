<?php

use Mpdf\Utils\Arrays;

defined('BASEPATH') OR exit('No direct script access allowed');
        
class TranferExternos extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Externos_model');
    }
    public function index()
    {

        function quitarPuntos($cadena){
            $cadena = str_replace(".", "", $cadena);
            return $cadena;
        }


        $externosO = $this->Externos_model->externos_original();

        foreach ($externosO as $externoO) {
            
            $rut_externo = $externoO->rut_externo;
            $rut_externo = quitarPuntos($rut_externo);


            $nombres = $externoO->nombres;
            $paterno = $externoO->paterno;
            $materno = $externoO->materno;
            $institucion = $externoO->institucion;
            $correo = $externoO->correo; 
            $celular = $externoO->celular;
            $ingreso = $externoO->ingreso;

            echo $rut_externo."<br>";


            $Datos = array(
                'rut_externo' => $rut_externo,
                'nombres' => $nombres,
                'paterno' => $paterno,
                'materno' => $materno,
                'institucion' => $institucion,
                'correo' => $correo,
                'celular' => $celular,
                'ingreso' => $ingreso
            );

           $this->Externos_model->externos_nuevos($Datos);

           
            
           
            
        }

     
                
    }
}




