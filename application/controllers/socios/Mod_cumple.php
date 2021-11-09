<?php 



class mod_cumple extends CI_Controller {

	   function __construct() {

            parent::__construct();

		$this->load->library('session');

		$this->load->model('model_reportes');

		$this->load->model('model_trabajos');

		$this->load->model('model_turnos');

        $this->load->model('model_actividades');

        $this->load->model('model_socios');
        $this->load->model('model_accionistas');

	    $this->load->helper('url');

	    $this->load->helper('form');

		$this->load->library('form_validation');

		$this->load->library('session');

		$this->load->library('mpdf60/Mpdf');

	}



	

	public function index(){

	 
		
        $data['cumpleañeros'] = $this -> model_socios->cumpleaños_hoy(); 
        $data['prox_cumple'] = $this -> model_socios->prox_cumpleaños(); 
        $data['ant_cumple'] = $this -> model_socios->ant_cumpleaños();  

		$this->load->view('plantilla/Head');

		$this->load->view('socios/mod_cumple',$data);

		$this->load->view('plantilla/Footer');		

	}
}