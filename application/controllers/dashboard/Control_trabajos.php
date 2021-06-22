<?php class control_trabajos extends CI_Controller {

	function __construct() {
		 
        parent::__construct();
		$this->load->library('session');
		$this->load->model('model_trabajos');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('calendar');
		$this->load->library('session');
		$this->load->library('mpdf60/Mpdf');
	}
	public function index()
	{ 
		$data['sectores']= $this->model_trabajos->getSector();
		
		
		$this->load->view('plantilla/Head_v1');
		$this->load->view('dashboard/dash_control_trabajos',$data);
		$this->load->view('plantilla/Footer');		
	}

} 

?>