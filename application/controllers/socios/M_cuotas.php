<?php 



class m_cuotas extends CI_Controller {

	

   function __construct() {

            parent::__construct();

		$this->load->library('session');

		$this->load->model('model_reportes');

		$this->load->model('model_trabajos');

		$this->load->model('model_turnos');

        $this->load->model('model_actividades');

        $this->load->model('model_socios');

	    $this->load->helper('url');

	    $this->load->helper('form');

		$this->load->library('form_validation');

		$this->load->library('session');

		$this->load->library('mpdf60/Mpdf');

	}



	

	public function index(){

	

		

         

		

		$this->load->view('plantilla/Head');

		$this->load->view('socios/m_cuotas');

		$this->load->view('plantilla/Footer');		

	}





	





	}





?>