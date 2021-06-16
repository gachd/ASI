<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class calendario extends CI_Controller {

	 function __construct() {
		 
        parent::__construct();
		 $this->load->library('session');
		 $this->load->model('model_actividades');
		 $this->load->helper('url');
		 $this->load->library('session');

	 }
	
	
	public function index()
	{
	
		$data['error_message'] = $this->session->flashdata('flash_message');
		$this->load->view('Plantilla/Head');
		$this->load->view('Actividades/calendario',$data);
		$this->load->view('Plantilla/Footer');		

	} 
	
	 function getactivity(){
		$data= $this -> model_actividades -> calendario();
		echo json_encode($data);
		}
	
	


		
	
}

?>