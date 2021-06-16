<?php class  gestionsocios extends CI_Controller {



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

		$data['personas'] = $this -> model_socios -> all_personas();

		$this->load->view('plantilla/Head');

		$this->load->view('socios/gestionsocios',$data);

		$this->load->view('plantilla/Footer');		

	}



public function mostrar_socio(){

       // $rut_socio= $this->uri->segment('4');

        $rut = $this->input->post('rut');

    $data = '';

		$data['corporaciones']= $this -> model_socios -> all_corporaciones();

	

		$data['datos'] = $this -> model_socios -> persona($rut);

    $data['sociosDatos'] = $this -> model_socios -> sociosDatos($rut);

		$data['patrocinadores'] = $this -> model_socios -> patrocinadores($rut);

		$data['patrocinados'] = $this -> model_socios -> patrocinados($rut);

		$data['cargas'] = $this -> model_socios -> cargas($rut);

		$data['cuotas'] = $this -> model_socios -> cuotas($rut);

		$data['estado_civil2'] = $this -> model_socios -> all_estadocivil();

		$data['nac'] = $this -> model_socios -> all_nacionalidades();

		$data['comuna']= $this -> model_socios -> all_comunas();

		$data['condicion_lab'] = $this -> model_socios -> all_condicionlab();

    $data['condicion'] = $this -> model_socios -> all_condicion();

    $data['condicion2'] = $this -> model_socios -> all_condicion2();

    $data['tipo'] = $this -> model_socios -> all_tipo();

    $data['subCond'] = $this -> model_socios ->all_subcond();



		$this->load->view('socios/gestionSocio',$data);;



       
 }//fin funcion mostrar_socio

 public function guardarNotificacion()   {

      $rutSocio = $_POST['rut'];

      $fecha = $_POST['fecha'];

      $motivo = $_POST['mot'];

      $contacto = $_POST['tipCont'];      

      $obs = $_POST['obs'];      
 	   
      $usuario = $this->session->userdata('id');

   
        //$micarpeta = 0;

               

     // $fecha_actual = date("Y-m-d");
    
      $micarpeta = './docNotificaciones/'.$rutSocio;

    //  echo $micarpeta;

       if (!file_exists($micarpeta)) {

             mkdir($micarpeta, 0777, true);

         }

     if($motivo == 1){
     	$motivo_resol = 'COBRANZA';
     }

     $datosSocios = $this -> model_socios ->getSocios($rutSocio);

      foreach ($datosSocios as $row_socio) {

            $cond = $row_socio -> cond_id;
            $cond2 = $row_socio -> cond2_id;
            $tipo = $row_socio -> tipo_id;
            $id_socio = $row_socio -> id_socio;


                 }


      $datos = array(         

     	 'motivo_resol' => $motivo_resol,     

         'fecha_resol' => $fecha,

         's_socios_id_socio' => $id_socio,

         's_socios_prsn_rut' => $rutSocio,

         'obs_resol' => $obs,

         'arch_resol' => 1,

         'id_cond' => $cond,

         'id_cond2' => $cond2,

         'id_tipo' => $tipo,

         'tip_contacto' => $contacto,

         'funcionario' => $usuario);


    
     

      $id_resol = $this -> model_socios -> insertarResolucion($datos); //crea una nueva resolucion en la base de datos 

 

     //crea archivo respaldo

        $config['upload_path'] = $micarpeta;       

        $config['file_name'] =  $id_resol;

        $config['allowed_types'] = 'pdf|jpg|png';

        $config['max_size'] = 2048;

       

        $this->load->library('upload', $config);

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('doc')) { #Aquí me refiero a "foto", el nombre que pusimos en FormData

            $error = array('error' => $this->upload->display_errors());

            echo json_encode($error);            

           }else {

            echo json_encode(true);



        }

        



    }
}