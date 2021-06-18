<?php

//defined('BASEPATH') OR exit('No direct script access allowed');



class nuevo_accionista extends CI_Controller
{



	function __construct()
	{



		parent::__construct();

		$this->load->library('session');

		$this->load->model('model_socios');


		$this->load->model('model_persona');


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
				$this->load->view('plantilla/Head');

				$this->load->view('accionistas/accionista_rut');

				$this->load->view('plantilla/Footer');
			} else {
				$rut = $_POST['rut'];
				//redirect('accionistas/nuevo_accionista/datos_persona/'.$rut);



				$date  = "";

				$data['rut'] = $rut;
				$data['comunas']	= $this->model_persona->all_comunas($date);
				$data['laboral']	= $this->model_persona->all_condicionlab($date);
				$data['estado_civil']	= $this->model_persona->all_estadocivil($date);
				$data['provincia']	= $this->model_persona->all_provincias($date);
				$data['region']	= $this->model_persona->all_region($date);



				$this->load->view('plantilla/Head');

				$this->load->view('accionistas/nuevo_accionista', $data);

				$this->load->view('plantilla/Footer');
			}
		}else{
			$this->load->view('plantilla/Head');

			$this->load->view('accionistas/accionista_rut');

			$this->load->view('plantilla/Footer');
		}

	}


	





	public function agregarSocio()
	{



		$prsn_id = $this->model_socios->ultimoId();



		$data = array(

			'prsn_id' => $prsn_id = $prsn_id + 1,

			'prsn_rut' => $rut_socio  = $this->input->post('rut'),

			'prsn_apellidopaterno' => $paterno = $this->input->post('paterno'),

			'prsn_apellidomaterno' => $materno = $this->input->post('materno'),

			'prsn_nombres' => $nombres = $this->input->post('nombres'),

			'prsn_fechanacimi' => $fecha_nac = $this->input->post('fecha_nac'),

			'prsn_sexo' => $sexo = $this->input->post('sexo'),

			'prsn_descendiente' => $desc = $this->input->post('desc'),

			'prsn_direccion' =>  $direc = $this->input->post('direc'),

			'prsn_sectorvive' => $sector = $this->input->post('sector'),

			'prsn_email' =>  $email = $this->input->post('email'),

			'prsn_fono_casa' => $tel_fijo = $this->input->post('tel_fijo'),

			'prsn_fono_movil' => $tel_cel = $this->input->post('tel_cel'),

			'prsn_fono_trabajo' => $tel_emp  = $this->input->post('tel_emp'),

			'prsn_profesion' => $prof = $this->input->post('prof'),

			'prsn_tipo' => $prsn_tipo = 0,

			'prsn_direccion_empresa' => $direc_emp = $this->input->post('direc_emp'),

			'prsn_foto' => $prsn_foto = 0,

			'prsn_fallecido' => $prsn_fallecido = 0,

			'prsn_empresa' => $emp = $this->input->post('emp'),

			's_nacionalidades_nac_id' => $nacionalidad = $this->input->post('nacionalidad'),

			's_condicion_laboral_condlab_id' => $laboral = $this->input->post('laboral'),

			's_estado_civil_estacivil_id' => $estadocivil = $this->input->post('estadocivil'), //persona natural

			's_comunas_comuna_id' => $comu = $this->input->post('comu'),

			'prsn_nac' => $nac = $this->input->post('nac')
		);

		$this->model_socios->insertar($data);
	}
}
