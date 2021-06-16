<?php

//defined('BASEPATH') OR exit('No direct script access allowed');



class editcuota extends CI_Controller {



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

    $this->load->view('socios/editCuota',$data);

    $this->load->view('plantilla/Footer');  

  }



public function mostrar_datos(){

       // $rut_socio= $this->uri->segment('4');

        $ano = $this->input->post('ano');        

        $sem = $this->input->post('sem');



    //    $paso = $this->input->post('enviar');

   //$data = '';

    $data['cuota'] = $this -> model_socios->Allcuotas();

    $data['cuotaOrd'] = $this -> model_socios->cuotaOrd($ano,$sem);

       

            $this->load->view('socios/edit_cuota',$data);

    

        



       

               







 }



 public function act_cuota(){

    

    $sem = $_POST['sem'];

    $ano = $_POST['año'];

    $data = array(         

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



      $this -> model_socios -> actCuota($data,$sem,$ano); 

 }



   

}

?>