<?PHP class autorizacion extends CI_Controller {

	 function __construct() {
		 
        parent::__construct();
		$this->load->library('session');
		 $this->load->model('model_actividades');
		  $this->load->helper('url');
	 }
	
	
	public function index(){
		$data['pendientes'] = $this -> model_actividades ->autorizar_actividad();	
			$this->load->view('plantilla/Head');
		$this->load->view('actividades/autorizacion',$data);
		$this->load->view('plantilla/Footer');		
		
		}
	
	function pago(){
		  $id=$_POST['trid'];
		 $this->model_actividades->pago($id);
		 $this->session->set_flashdata('category_success', 'Autorizado Correctamente.');
		  echo'<script>
				window.location.href = "'.base_url().'actividades/autorizacion";
				</script>';
		
		}
}
    
    ?>