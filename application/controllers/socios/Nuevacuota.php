<?php

//defined('BASEPATH') OR exit('No direct script access allowed');



class nuevaCuota extends CI_Controller {



   function __construct() {

     

        parent::__construct();

    $this->load->library('session');

     $this->load->model('model_socios');

     $this->load->helper('url');

     $this->load->helper('form');

     $this->load->library('form_validation');

     $this->load->library('calendar');

     $this->load->library('session');



     

   }



  public function index(){

  

      $date  = "";

    

    $data['personas'] =$this -> model_socios -> all_personas($date);  

    $data['nacionalidad'] =$this -> model_socios -> all_nacionalidades($date);

    $data['comunas']  =$this -> model_socios -> all_comunas($date);

    $data['laboral']  =$this -> model_socios -> all_condicionlab($date);

    $data['estado_civil'] =$this -> model_socios -> all_estadocivil($date);

    $data['corporacion'] = $this-> model_socios->all_corporaciones();

    $data['socio_pat'] = $this-> model_socios->all_sociospat();

    $data['parentesco'] = $this-> model_socios->all_parentesco();

    $data['cuota'] = $this-> model_socios->Allcuotas();

    

  

        $this->load->view('plantilla/Head');

    $this->load->view('socios/nuevaCuota',$data);

    $this->load->view('plantilla/Footer');  

  }





    public function agregarCuota(){



    $ult_id = $this -> model_socios -> ultimoId_cuota();

    $id_cuota = $ult_id + 1;

    $sem1 = $_POST['sem'];

    echo $sem1;

    if($sem1 == 1){

      $data = array(

         'id_cuota' => $id_cuota,

         'semestre' => $sem1, 

         'ano' => $_POST['año'],     

         'valor' => $_POST['cuotaSem'],

         'fecha_vcto' => $_POST['venc_sem1'],

         'fecha_emision' => $_POST['emi_sem1'],

         'valor_uf' => 0,

         'nombre_cuota' => 'Cuota Ordinaria',    

         'valor_stadio' => $_POST['cuotaStadio'], 

         'valor_concordia' =>  $_POST['cuotaSocorros'],

         'valor_atletico' => $_POST['cuotaAtletico'],

         'valor_centro' =>  $_POST['cuotaCentro'],  

         'valor_scuola' => $_POST['cuotaScuola'],

         'valor_anticipo' => 0,

         'valor_todas' => $_POST['todas']); 



      $this -> model_socios -> insertarCuota($data); 

    }

   

   $sem2 = $_POST['semm'];

 echo $sem2;

    if($sem2 == 2){

      $data = array(

         'id_cuota' => $id_cuota+1,

         'semestre' => $sem2, 

         'ano' => $_POST['año'],     

         'valor' => $_POST['cuotaSem'],

         'fecha_vcto' => $_POST['venc_sem2'],

         'fecha_emision' => $_POST['emi_sem2'],

         'valor_uf' => 0,

         'nombre_cuota' => 'Cuota Ordinaria',    

         'valor_stadio' => $_POST['cuotaStadio'], 

         'valor_concordia' =>  $_POST['cuotaSocorros'],

         'valor_atletico' => $_POST['cuotaAtletico'],

         'valor_centro' =>  $_POST['cuotaCentro'],  

         'valor_scuola' => $_POST['cuotaScuola'],

         'valor_anticipo' => 0,

         'valor_todas' => $_POST['todas']); 



      $this -> model_socios -> insertarCuota($data); 

    }



       

    }

      

  

}

?>