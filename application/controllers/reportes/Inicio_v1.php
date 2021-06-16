<?php class  inicio extends CI_Controller {

	function __construct() {
            parent::__construct();
		$this->load->library('session');
		$this->load->model('model_trabajos');
		$this->load->model('model_turnos');
            $this->load->model('model_actividades');
	      $this->load->helper('url');
	      $this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
	}
	
	
	public function index(){
	
		$data['categorias'] = $this -> model_actividades->getCategorias();		
         
		
		$this->load->view('plantilla/Head');
		$this->load->view('reportes/inicio',$data);
		$this->load->view('plantilla/Footer');		
	}

	public function fillsubcategorias (){
			
			$ctg  = $this->input->post('micategoria');
			echo' <option value="0"> Todos</option>';
			
			if($ctg <> 0 ){
				/*echo' <option value="0"> '.$ctg.'lllego</option>';*/
				$subcatg= $this -> model_actividades -> getsubcategoria($ctg);
				foreach($subcatg as $fila){
				echo ' <option value="'.$fila->sctg_id.'" '.set_select("subcategoria",$fila->sctg_id).'>'.$fila->sctg_nombre.'</option>';
					}
			}else{
					echo' <option value="0"> Seleccionar</option>';
				 }
	}

	function informes (){

		$informe ="".$this->uri->segment('4')."";
		$date_inicio ="".$this->uri->segment('5')."";
		$date_termino ="".$this->uri->segment('6')."";
		$excel ="".$this->uri->segment('7')."";
		$categoria ="".$this->uri->segment('8')."";
		$subcategoria ="".$this->uri->segment('9')."";
        

		if(empty($informe)) {$informe = $this->input->post('informe');}
		if(empty($date_inicio)) {$date_inicio = $this->input->post('date_inicio');}
		if(empty($date_termino)) {$date_termino = $this->input->post('date_termino');}
		if(empty($excel)) {$excel = $this->input->post('excel');}
		if(empty($categoria)) {$categoria = $this->input->post('categoria');}
		if(empty($subcategoria)) {$subcategoria = $this->input->post('subcategoria');}


     	$data['inicio']= $date_inicio;
		$data['termino']= $date_termino;
		$data['excel']= $excel;
		$data['categoria']= $categoria;
		$data['subcategoria']= $subcategoria;

				switch ($informe) {
			case 1:
			    $this->load->view('reportes/work_semana',$data);
			break;

			case 2:
			    $this->load->view('reportes/turnos_rango_fecha',$data);
			break;
			case 3:
			    $this->load->view('reportes/work_control_planificacion',$data);
			break;
			case 4:
			    $this->load->view('reportes/activity_consolidado',$data);
			break;
			
			default:
				# code...
				break;
		}

		
	}


}
?>