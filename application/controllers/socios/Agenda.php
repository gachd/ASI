<?php


class  agenda extends CI_Controller {
	function __construct() {

            parent::__construct();

		$this->load->library('session');
	    $this->load->helper('url');
	    $this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('model_accionistas');
		$this->load->model('model_socios');
	//	$this->load->library('mpdf60/Mpdf');
		$this->load->model('model_socios');

	}

public function index(){

		//$data['personas'] = $this -> model_socios -> all_personas();

	   
	    
        $data['agenda'] = $this -> model_socios -> agendaSocios();
        
		$this->load->view('plantilla/Head_v1');
		$this->load->view('socios/agenda',$data);
		$this->load->view('plantilla/Footer');		

	}

public  function mostrarActivos() {


	
			//$data = array();
			
			$arrayCli = "";
			$data = $this -> model_socios -> agendaSocios();
			foreach ($data as $s) {
			    $arrayCli.='{
			    	"paterno" => "'.$s->prsn_apellidopaterno.'",
			    	"materno" => "'.$s->prsn_apellidomaterno.'",
			    	"nombres" => "'.$s->prsn_nombres.'",
			    	"email" => "'.$s->prsn_email.'",
			    	"fono" => "'.$s->prsn_fono_movil.'" 	
			    },';    
			}
		
	//	$arrayCli = substr($arrayCli, 0,strlen($arrayCli) - 1);
	//	echo '{"data":['.$arrayCli.']}';
		return response()->json($data);
    
}



  

}
?>