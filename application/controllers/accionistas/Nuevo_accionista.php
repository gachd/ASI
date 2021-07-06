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

		if (!empty($_POST['rut'])) {

			$persona = $this->model_accionistas->existe($_POST['rut']);
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


	public function ultimo()
	{

		$Ultimo_Accionista = $this->model_accionistas->ultimoId();
		return ($Ultimo_Accionista);
	}








	public function agregaraccionista()
	{



		$prsnID = $this->model_accionistas->ultimoId();
		$AccionistaNuevo = $prsnID + 1;

		$rut = $_POST['rutP'];
		$prsn_tipo = $this->input->post('optradio');
		$tipoaccion = $this->input->post('accion');




		$dataP = array(


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

			'foja_accionista' => $foja_accionista = $this->input->post('foja'),
			'libro_accionista' => $libro_accionista = $this->input->post('libro'),
			'fecha' => $fechaingreso = $this->input->post('fechaIng'),
			'estado_accionista' => $estadoaccionista = 1,
		);


		$this->model_persona->insertar($dataP);

		$this->model_accionistas->insertar($dataA);


		// MODULO DE TTITULO

		//Nueva


		if ($tipoaccion == 1) {

			$dataT = array(

				'id_accionista' => $AccionistaNuevo,

				'numero_acciones' => $num_acciones = $this->input->post('NuevaAcionesTitulo'),

				'fecha' => $fecha_titulo = $this->input->post('fechaT'),

				'estado' => $estado = 1,
			);

			$this->model_titulo->nuevo_titulo($dataT);
		};



		//Cesion

		if ($tipoaccion == 0) {





			$id_accionista_que_cede = $this->input->post('IdAccionistaANT');

			$id_accionista_que_recibe = $AccionistaNuevo;

			$numero_acciones_titulo_que_cede = $this->input->post('AccionesANT');

			$cantidad_de_acciones_que_se_ceden = $this->input->post('NumNuevoCesion');

			$titulo_que_precede = $this->input->post('TituloP');

			$acciones_nuevo_titulo_anterior = $numero_acciones_titulo_que_cede - $cantidad_de_acciones_que_se_ceden;



			$ultimoID = $this->model_titulo->ultimoId();
			$ultimo = $ultimoID[0]->maximo;


			if ($acciones_nuevo_titulo_anterior > 0) {

				$dataAntiguoT = array(


					'estado' => $estado = 0,




				);




				$dataT_Nuevo = array(

					'id_accionista' => $id_accionista_que_recibe,

					'numero_acciones' => $cantidad_de_acciones_que_se_ceden,

					'fecha' => $fecha_titulo = $this->input->post('fechaT'),

					'estado' => $estado = 1,

				);


				$dataT_Anterior = array(

					'id_accionista' => $id_accionista_que_cede,

					'numero_acciones' => $acciones_nuevo_titulo_anterior,

					'fecha' => $fecha_titulo = $this->input->post('fechaT'),

					'estado' => $estado = 1,

				);

				$dataTablaTanferencia1 = array(


					'titulo_origen ' => $titulo_que_precede,

					'tiulo_actual' => $ultimo + 1,

					'fecha_cesion' => $fecha_titulo = $this->input->post('fechaC'),

				);
				$dataTablaTanferencia2 = array(


					'titulo_origen ' => $titulo_que_precede,

					'tiulo_actual' => $ultimo + 2,

					'fecha_cesion' => $fecha_titulo = $this->input->post('fechaC'),

				);



				$this->model_titulo->updatetitulos($dataAntiguoT, $titulo_que_precede);
				$this->model_titulo->nueva_cesion($dataTablaTanferencia1);
				$this->model_titulo->nueva_cesion($dataTablaTanferencia2);
				$this->model_titulo->nuevo_titulo($dataT_Nuevo);
				$this->model_titulo->nuevo_titulo($dataT_Anterior);
			};


			if ($acciones_nuevo_titulo_anterior == 0) {


				$dataAntiguoT = array(


					'estado' => $estado = 0,



				);




				$dataT_Nuevo = array(

					'id_accionista' => $id_accionista_que_recibe,

					'numero_acciones' => $cantidad_de_acciones_que_se_ceden,

					'fecha' => $fecha_titulo = $this->input->post('fechaT'),

					'estado' => $estado = 1,

				);




				$dataTablaTanferencia = array(


					'titulo_origen ' => $titulo_que_precede,

					'tiulo_actual' => $ultimo + 1,

					'fecha_cesion' => $fecha_titulo = $this->input->post('fechaC'),

				);



				$this->model_titulo->updatetitulos($dataAntiguoT, $titulo_que_precede);
				$this->model_titulo->nueva_cesion($dataTablaTanferencia);

				$this->model_titulo->nuevo_titulo($dataT_Nuevo);


				//validar si el accionista tiene itulos activos si no los tiene se da de baja
				
				$validar = $this->model_accionistas->validar_estado($id_accionista_que_cede);

				
				if (empty($validar)) {
					$dataAccionista= array(
						'estado_accionista' => $estadoaccionista = 0,
						'fecha_baja' => $fecha = date('Y-m-d'),	
					);
					$this->model_accionistas->update($dataAccionista, $id_accionista_que_cede);
					

				};
			};
		};







		redirect('accionistas/inicio');
	}





	public function updateaccionista()
	{




		$idP = $_POST['idP'];




		$dataP = array(






			'prsn_apellidopaterno' => $paterno = $this->input->post('ApellidoP'),

			'prsn_apellidomaterno' => $materno = $this->input->post('ApellidoM'),

			'prsn_nombres' => $nombres = $this->input->post('nombres'),

			'prsn_fechanacimi' => $fecha_nac = $this->input->post('FechaN'),

			

			'prsn_email' => $correo = $this->input->post('Correo'),


			'prsn_direccion' =>  $direc = $this->input->post('Direccion'),

			'prsn_fono_movil' => $tel_cel = $this->input->post('Fono'),





			'prsn_fallecido' => $prsn_fallecido = 0,


			's_estado_civil_estacivil_id' => $estadocivil = $this->input->post('estadocivilP'),

			's_comunas_comuna_id' => $comu = $this->input->post('comuna'),

			'provincia_id' => $region = $this->input->post('proviP'),

			'region_id' => $region = $this->input->post('region'),



		);







		$this->model_persona->update($dataP, $idP);


		redirect('accionistas/inicio');
	}




	public function ProvinciaporRegion()
	{


		header('Content-Type: application/json');


		$id = $_POST['id'];
		$provincia = $this->model_persona->ListarRegionDeProvincia($id);


		print_r(json_encode($provincia));
	}

	public function ComunaporProvincia()
	{


		header('Content-Type: application/json');


		$id = $_POST['id'];
		$comuna = $this->model_persona->ListarProvinciaDecomuna($id);


		print_r(json_encode($comuna));
	}


	public function validar($id)

	{

		$validar = $this->model_accionistas->validar_estado($id);

		if (empty($validar)) {
			echo ('Dar de baja');
		}
	}



}
