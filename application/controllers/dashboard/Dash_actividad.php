<?php class dash_actividad extends CI_Controller {

	 function __construct() {
		 
        parent::__construct();
		$this->load->library('session');
		$this->load->model('model_dash');
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
		$mes=date('m');
		$year=date("Y");
		$data['categorias']= $this->model_dash->getCategorias();
		$data['total_cat']= $this->model_dash->total_categorias();
		$data['total_mes_cat']= $this->model_dash->toal_mes_categoria();
		$data['total_prsns_mes']= $this->model_dash->total_prsns_mes($mes,$year);
		
		$this->load->view('plantilla/Head_v1');
		$this->load->view('dashboard/dash_actividades',$data);
		$this->load->view('plantilla/Footer');		
	}

	function total_categorias(){

    $data=$this->model_dash->total_categorias();
		 echo json_encode($data);
    }

    function anual(){
    $id=$this->input->post('id');

    $data=$this->model_dash->total_anual($id);
		 echo json_encode($data);
    }

    function total_subcategorias(){
 	$id=$this->input->post('id');
    $data=$this->model_dash->total_subcategorias($id);
		 echo json_encode($data);
    }



   
	  


	}
	?>	
