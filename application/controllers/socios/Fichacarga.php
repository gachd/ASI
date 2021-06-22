<?php class  fichacarga extends CI_Controller {



	function __construct() {

            parent::__construct();

		$this->load->library('session');		

	    $this->load->helper('url');

	    $this->load->helper('form');

		$this->load->library('form_validation');

		$this->load->library('session');

		$this->load->library('mpdf60/Mpdf');

		$this->load->model('model_socios');

	}



	

	public function index(){

		$data['personas'] = $this -> model_socios -> all_cargas();

		$this->load->view('plantilla/Head_v1');

		$this->load->view('socios/lista_percarga',$data);

		$this->load->view('plantilla/Footer');		

	}



	function detalle(){

		$data['corporaciones'] = $this -> model_socios -> all_corporaciones();

		$rut= $this->uri->segment(4);

	//	echo 'rut: '.$rut;

		$data['rut']=$rut;

		$data['datos_personales'] = $this -> model_socios -> persona($rut);

		$data['patrocinadores'] = $this -> model_socios -> patrocinadores($rut);

		$data['patrocinados'] = $this -> model_socios -> patrocinados($rut);

		$data['cargas'] = $this -> model_socios -> cargas($rut);

		$data['cuotas'] = $this -> model_socios -> cuotas($rut);



		$this->load->view('plantilla/Head_v1');

		$this->load->view('socios/ficha',$data);

		$this->load->view('plantilla/Footer');		

	}

 }


