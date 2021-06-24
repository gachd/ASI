<?php

//defined('BASEPATH') OR exit('No direct script access allowed');



class nuevo_accionista extends CI_Controller
{



	function __construct()
	{



		parent::__construct();

		$this->load->library('session');

		$this->load->model('model_socios');
		$this->load->model('model_libro');
		$this->load->model('model_titulo');
		$this->load->model('model_persona');
		$this->load->model('model_accionistas');


		$this->load->helper('url');

		$this->load->helper('form');

		$this->load->library('form_validation');

		$this->load->library('calendar');

		$this->load->library('session');
	}



	public function index()
	{
		$_POST['msj'] = '';

		if (isset($_POST['rut'])) {

			$persona = $this->model_persona->existe_persona($_POST['rut']);
			if ($persona) {

				$_POST['msj'] = '1';
				$this->load->view('plantilla/Head_v1');

				$this->load->view('accionistas/accionista_rut');

				$this->load->view('plantilla/Footer');
			} else {
				$rut = $_POST['rut'];
				//redirect('accionistas/nuevo_accionista/datos_persona/'.$rut);



				$date  = "";

				$data['rut'] = $rut;
				$data['comunas']	= $this->model_persona->all_comunas();
				$data['laboral']	= $this->model_persona->all_condicionlab();
				$data['estado_civil']	= $this->model_persona->all_estadocivil();
				$data['provincia']	= $this->model_persona->all_provincias();
				$data['region']	= $this->model_persona->all_region();
				$data['libro']	= $this->model_libro->all_libros();



				$this->load->view('plantilla/Head_v1');

				$this->load->view('accionistas/nuevo_accionista', $data);

				$this->load->view('plantilla/Footer');
			}
		} else {
			$this->load->view('plantilla/Head_v1');

			$this->load->view('accionistas/accionista_rut');

			$this->load->view('plantilla/Footer');
		}
	}
	public function ultimo(){

		echo $Ultimo_Accionista = $this->model_accionistas->ultimoId();
		echo $ultimo = $Ultimo_Accionista +1;
		

	
	}








	public function agregaraccionista()
	{



		$prsn_id = $this->model_persona->ultimoId();
		$rut = $_POST['rutP'];
		$prsn_tipo = $this->input->post('optradio');

		






		$dataP = array(


			'prsn_id' => $prsn_id = $prsn_id + 1,

			'prsn_rut' => $rut,

			'prsn_apellidopaterno' => $paterno = $this->input->post('ApellidoP'),

			'prsn_apellidomaterno' => $materno = $this->input->post('ApellidoM'),

			'prsn_nombres' => $nombres = $this->input->post('nombres'),

			'prsn_fechanacimi' => $fecha_nac = $this->input->post('FechaN'),

			'prsn_sexo' => $sexo = $this->input->post('sexo'),

			'prsn_email' => $correo = $this->input->post('Correo'),


			'prsn_direccion' =>  $direc = $this->input->post('Direccion'),

			'prsn_fono_movil' => $tel_cel = $this->input->post('Fono'),



			'prsn_tipo' => $prsn_tipo,



			'prsn_fallecido' => $prsn_fallecido = 0,


			's_estado_civil_estacivil_id' => $estadocivil = $this->input->post('estadocivil'), //persona natural

			's_comunas_comuna_id' => $comu = $this->input->post('comu'),

			'provincia_id' => $region = $this->input->post('provi'),

			'region_id' => $region = $this->input->post('region'),

		);

		$dataA = array(
			'prsn_rut' => $rut,			
			
			'foja_accionista' => $foja_accionista = $this->input -> post('foja'),
			'libro_accionista' => $libro_accionista = $this->input ->post('libro'),
		);



		

		$dataT = array(
			
			'id_accionista'=> $prsn_id,
			
			'numero_acciones' => $num_acciones = $this->input->post('NumAcciones'),

			'fecha' => $fecha_titulo = $this->input->post('NumAcciones'),
			


		);



		$this->model_persona->insertar($dataP);

		$this->model_accionistas->insertar($dataA);

		$this->model_titulo->nuevo_titulo($dataT);

		redirect('accionistas/inicio');
	}
}
