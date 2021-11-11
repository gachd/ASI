<?php

//defined('BASEPATH') OR exit('No direct script access allowed');



class nuevo_accionista extends CI_Controller
{



	function __construct()
	{



		parent::__construct();

		//$this->output->enable_profiler(TRUE);

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



			$persona = $this->model_accionistas->existePersona($_POST['rut']);

			$accionista = $this->model_accionistas->existe($_POST['rut']);

			$socio = $this->model_accionistas->existeSocio($_POST['rut']);






			if ($accionista) { // si existe como accionista

				$_POST['msj'] = '1';
				$this->load->view('plantilla/Head');

				$this->load->view('accionistas/accionista_rut');
				$this->load->view('plantilla/Footer');
			} else { // si no existe como accionista

				$rut = $_POST['rut'];
				$data['rut'] = $rut;
				$data['comunas'] = $this->model_persona->all_comunas();
				$data['laboral'] = $this->model_persona->all_condicionlab();
				$data['estado_civil'] = $this->model_persona->all_estadocivil();
				$data['provincia']	= $this->model_persona->all_provincias();
				$data['region']	= $this->model_persona->all_region();
				$data['libro']	= $this->model_libro->all_libros();


				if ($socio) { // si existe como socio

					//si se valida que hay un socios, solo carga vista para agregar datos de accionista 
					$this->load->view('plantilla/Head');
					$this->load->view('accionistas/nuevo_accionistaSocio', $data);
					$this->load->view('plantilla/Footer');
				} else { //si existe como persona pero no como socio


					// al no ser socio validamos que este registrado en tabla personas

					if ($persona) { // si existe como persona

						$persona = $persona[0];



						$data['persona'] = $persona;


						$this->load->view('plantilla/Head');
						$this->load->view('accionistas/nuevo_accionistaPersona', $data);
						$this->load->view('plantilla/Footer');
					} else { // si no existe como persona y no hay registro en BD

					

						$this->load->view('plantilla/Head');
						$this->load->view('accionistas/nuevo_accionista', $data);
						$this->load->view('plantilla/Footer');
					}
				}
			}
		} else {
			$this->load->view('plantilla/Head');

			$this->load->view('accionistas/accionista_rut');

			$this->load->view('plantilla/Footer');
		}
	}


	public function ultimo()
	{

		$Ultimo_Accionista = $this->model_accionistas->ultimoId();
		return ($Ultimo_Accionista);
	}

	public function test()
	{


		$IDMaximo = $this->model_accionistas->ultimoId();
		$prsnID = $IDMaximo[0]->maximo;
		var_dump($prsnID);


		$IDMaximo = $this->model_accionistas->ultimoIdAccionista();
		$prsnID = $IDMaximo[0]->maximo;
		var_dump($prsnID);
	}








	public function agregaraccionista()
	{


		$MaximoP = $this->model_accionistas->ultimoId(); // ultimo id de persona
		$IDPersona = $MaximoP[0]->maximo; // ultimo id de persona
		$PersonaNuevaID = $IDPersona + 1; // id de nueva persona


		$IDMaximo = $this->model_accionistas->ultimoIdAccionista();
		$prsnID = $IDMaximo[0]->maximo;


		$AccionistaNuevo = $prsnID + 1;

		$rut = $_POST['rutP'];
		$prsn_tipo = $this->input->post('optradio');
		$tipoaccion = $this->input->post('accion');

		$NumeroTitulo = $this->input->post('NumeroTitulo');


		$path = 'archivos/accionista/' . $rut;


		$dataP = array(


			'prsn_id' => $PersonaNuevaID,

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



		);

		$dataA = array(

			'id_accionista' => $AccionistaNuevo,
			'prsn_rut' => $rut,
			'foja_accionista' => $foja_accionista = $this->input->post('foja'),
			'libro_accionista' => $libro_accionista = $this->input->post('libro'),
			'fecha' => $fechaingreso = $this->input->post('fechaIng'),
			'estado_accionista' => $estadoaccionista = 1,
			'path' => $path,
		);


		//si existe persona
		if (isset($_POST['IdPersona'])) {

			$id_persona = $this->input->post('IdPersona');

			// se elimina del array de ingreso el id creado para nueva persona
			unset($dataP['prsn_id']);

			// se actualiza los datos de la persona existente 
			$this->model_persona->update($dataP, $id_persona);
		} else {

			$this->model_persona->insertar($dataP);
		}


		//Subida de archivos 
		$archivo = $_FILES["miarchivo"]; //nombre del input file de la vista

		$this->Subir_Varios($rut, $archivo);



		// Termino subida de archivos


		$this->model_accionistas->insertar($dataA);


		// MODULO DE TTITULO

		//Nueva


		if ($tipoaccion == 1) {

			$dataT = array(


				'id_titulos ' => $NumeroTitulo,

				'id_accionista' => $AccionistaNuevo,

				'numero_acciones' => $num_acciones = $this->input->post('NuevaAcionesTitulo'),

				'fecha' => $fecha_titulo = $this->input->post('fechaT'),

				'estado' => $estado = 1,

				'entrega' => $estadoEntrega = 0,
			);

			$this->model_titulo->nuevo_titulo($dataT);
		};



		//Cesion y transmision

		if ($tipoaccion == 0 || $tipoaccion == 2) {





			$id_accionista_que_cede = $this->input->post('IdAccionistaANT');

			$id_accionista_que_recibe = $AccionistaNuevo;

			$numero_acciones_titulo_que_cede = $this->input->post('AccionesANT');

			$cantidad_de_acciones_que_se_ceden = $this->input->post('NumNuevoCesion');

			$titulo_que_precede = $this->input->post('TituloP');

			$acciones_nuevo_titulo_anterior = $numero_acciones_titulo_que_cede - $cantidad_de_acciones_que_se_ceden;



			$ultimoID = $this->model_titulo->ultimoId();

			$ultimo = $ultimoID[0]->maximo;


			if ($acciones_nuevo_titulo_anterior > 0) {





				$TituloqueTransfiere = array(


					'numero_acciones' => $acciones_nuevo_titulo_anterior,




				); 







				$dataT_Nuevo = array(

					'id_titulos' => $NumeroTitulo,

					'id_accionista' => $id_accionista_que_recibe,

					'numero_acciones' => $cantidad_de_acciones_que_se_ceden,

					'fecha' => $fecha_titulo = $this->input->post('fechaT'),

					'estado' => $estado = 1,

					'entrega' => $estadoEntrega = 0,

				);


			/* 	$dataT_Anterior = array(

					'id_titulos' => $NumeroTitulo + 1,

					'id_accionista' => $id_accionista_que_cede,

					'numero_acciones' => $acciones_nuevo_titulo_anterior,

					'fecha' => $fecha_titulo = $this->input->post('fechaT'),

					'estado' => $estado = 1,

					'entrega' => $estadoEntrega = 0,

				); */



				$dataTablaTanferencia1 = array(


					'titulo_origen ' => $titulo_que_precede,

					'tiulo_actual' => $NumeroTitulo,

					'fecha_cesion' => $fecha_titulo = $this->input->post('fechaC'),

				);
				/* $dataTablaTanferencia2 = array(


					'titulo_origen ' => $titulo_que_precede,

					'tiulo_actual' => $NumeroTitulo + 1,

					'fecha_cesion' => $fecha_titulo = $this->input->post('fechaC'),

				);
 */


				$this->model_titulo->updatetitulos($TituloqueTransfiere, $titulo_que_precede);
				$this->model_titulo->nueva_cesion($dataTablaTanferencia1);

				/* $this->model_titulo->nueva_cesion($dataTablaTanferencia2); */
				
				$this->model_titulo->nuevo_titulo($dataT_Nuevo);

				/* $this->model_titulo->nuevo_titulo($dataT_Anterior); */


				
			};


			if ($acciones_nuevo_titulo_anterior == 0) {


				$dataAntiguoT = array(


					'estado' => $estado = 0,



				);




				$dataT_Nuevo = array(

					'id_titulos ' => $NumeroTitulo,

					'id_accionista' => $id_accionista_que_recibe,

					'numero_acciones' => $cantidad_de_acciones_que_se_ceden,

					'fecha' => $fecha_titulo = $this->input->post('fechaT'),

					'estado' => $estado = 1,


					'entrega' => $estadoEntrega = 0,

				);




				$dataTablaTanferencia = array(


					'titulo_origen ' => $titulo_que_precede,

					'tiulo_actual' => $NumeroTitulo,

					'fecha_cesion' => $fecha_titulo = $this->input->post('fechaC'),

				);



				$this->model_titulo->updatetitulos($dataAntiguoT, $titulo_que_precede);
				$this->model_titulo->nueva_cesion($dataTablaTanferencia);

				$this->model_titulo->nuevo_titulo($dataT_Nuevo);



				//validar si el accionista tiene tituloos activos si no los tiene se da de baja

				$validar = $this->model_accionistas->validar_estado($id_accionista_que_cede);

				if (empty($validar)) {
					$dataAccionista = array(
						'estado_accionista' => $estadoaccionista = 0,
						'fecha_baja' => $fecha = date('Y-m-d'),
					);
					$this->model_accionistas->update($dataAccionista, $id_accionista_que_cede);
				};
			};
		};




		$this->session->set_flashdata('exito', 'Actualizado');


		redirect('accionistas/inicio');
	}



	public function agregaraccionistaSocio()
	{


		$IDMaximo = $this->model_accionistas->ultimoIdAccionista();
		$prsnID = $IDMaximo[0]->maximo;

		$NumeroTitulo = $this->input->post('NumeroTitulo');


		$AccionistaNuevo = $prsnID + 1;

		$rut = $_POST['rutP'];
		$prsn_tipo = $this->input->post('optradio');
		$tipoaccion = $this->input->post('accion');


		/* Subida de archivos */
		$archivo = $_FILES["miarchivo"]; //nombre del input file de la vista

		$this->Subir_Varios($rut, $archivo);

		$path = 'archivos/accionista/' . $rut;



		/* Termino subida de archivos */



		$dataA = array(

			'id_accionista' => $AccionistaNuevo,
			'prsn_rut' => $rut,
			'foja_accionista' => $foja_accionista = $this->input->post('foja'),
			'libro_accionista' => $libro_accionista = $this->input->post('libro'),
			'fecha' => $fechaingreso = $this->input->post('fechaIng'),
			'estado_accionista' => $estadoaccionista = 1,
			'path' => $path,
		);


		$this->model_accionistas->insertar($dataA);


		// MODULO DE TTITULO

		//Nueva


		if ($tipoaccion == 1) {

			$dataT = array(

				'id_titulos ' => $NumeroTitulo,


				'id_accionista' => $AccionistaNuevo,

				'numero_acciones' => $num_acciones = $this->input->post('NuevaAcionesTitulo'),

				'fecha' => $fecha_titulo = $this->input->post('fechaT'),

				'estado' => $estado = 1,

				'entrega' => $estadoEntrega = 0,
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

					'id_titulos ' => $NumeroTitulo,

					'id_accionista' => $id_accionista_que_recibe,

					'numero_acciones' => $cantidad_de_acciones_que_se_ceden,

					'fecha' => $fecha_titulo = $this->input->post('fechaT'),

					'estado' => $estado = 1,

					'entrega' => $estadoEntrega = 0,

				);


				$dataT_Anterior = array(
					'id_titulos ' => $NumeroTitulo + 1,

					'id_accionista' => $id_accionista_que_cede,

					'numero_acciones' => $acciones_nuevo_titulo_anterior,

					'fecha' => $fecha_titulo = $this->input->post('fechaT'),

					'estado' => $estado = 1,

					'entrega' => $estadoEntrega = 0,

				);

				$dataTablaTanferencia1 = array(


					'titulo_origen ' => $titulo_que_precede,

					'tiulo_actual' => $NumeroTitulo,

					'fecha_cesion' => $fecha_titulo = $this->input->post('fechaC'),

				);
				$dataTablaTanferencia2 = array(


					'titulo_origen ' => $titulo_que_precede,

					'tiulo_actual' => $NumeroTitulo + 1,

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

					'id_titulos ' => $NumeroTitulo,

					'id_accionista' => $id_accionista_que_recibe,

					'numero_acciones' => $cantidad_de_acciones_que_se_ceden,

					'fecha' => $fecha_titulo = $this->input->post('fechaT'),

					'estado' => $estado = 1,


					'entrega' => $estadoEntrega = 0,

				);




				$dataTablaTanferencia = array(


					'titulo_origen ' => $titulo_que_precede,

					'tiulo_actual' => $NumeroTitulo,

					'fecha_cesion' => $fecha_titulo = $this->input->post('fechaC'),

				);



				$this->model_titulo->updatetitulos($dataAntiguoT, $titulo_que_precede);
				$this->model_titulo->nueva_cesion($dataTablaTanferencia);

				$this->model_titulo->nuevo_titulo($dataT_Nuevo);


				//validar si el accionista tiene itulos activos si no los tiene se da de baja



				$validar = $this->model_accionistas->validar_estado($id_accionista_que_cede);


				if (empty($validar)) {
					$dataAccionista = array(
						'estado_accionista' => $estadoaccionista = 0,
						'fecha_baja' => $fecha = date('Y-m-d'),
					);
					$this->model_accionistas->update($dataAccionista, $id_accionista_que_cede);
				};
			};
		};




		$this->session->set_flashdata('exito', 'Actualizado');


		redirect('accionistas/inicio');
	}





	public function updateaccionista()
	{




		$idP = $this->input->post('idP');

		$rut = $this->input->post('rutA');


		$prsn_fallecido = 0;

		$Fecha_Muerte = NULL;


		//Si el accionista fallece

		if ($this->input->post('fallecido') == "SI") {

			$prsn_fallecido = 1;


			if (isset($_FILES["archivos_fallecido"])) {

				$archivos_fallecido = $_FILES["archivos_fallecido"]; //nombre del input file de la vista
				var_dump($archivos_fallecido);

				$comunidad = $this->input->post('comunidad');
				$Fecha_Muerte = $this->input->post('fecha_fallecimiento');

				$titulos = $this->model_accionistas->nro_titulo($rut);

				$dataT = array(

					'transmision' => 1,

				);

				$dataComunidad = array(

					'nombre' => $comunidad,

					'rut_accionista' => $rut,

				);


				foreach ($titulos as $t) {

					//se cambia el estado de los titulos que son canditatos a transmison					
					$this->model_titulo->updatetitulos($dataT, $t->nro_titulo);
				}



				$this->Subir_Varios_Fallecido($rut, $archivos_fallecido);

				$this->model_accionistas->insertar_comundad_hereditaria($dataComunidad);
			}
		}


		if (isset($_FILES["miarchivo"])) {

			$archivo = $_FILES["miarchivo"]; //nombre del input file de la vista


			//agregar archivos solo si hay archivos
			if (!empty($archivo)) {

				$this->Subir_Varios($rut, $archivo);

				$dataA =  array(


					'path' => $path = 'archivos/accionista/' . $rut,

				);
				$this->model_accionistas->update($dataA, $idP);
			}
		}








		$dataP = array(




			'prsn_apellidopaterno' => $paterno = $this->input->post('ApellidoP'),

			'prsn_apellidomaterno' => $materno = $this->input->post('ApellidoM'),

			'prsn_nombres' => $nombres = $this->input->post('nombres'),

			'prsn_fechanacimi' => $fecha_nac = $this->input->post('FechaN'),

			'prsn_email' => $correo = $this->input->post('Correo'),

			'prsn_direccion' =>  $direc = $this->input->post('Direccion'),

			'prsn_fono_movil' => $tel_cel = $this->input->post('Fono'),

			'prsn_fallecido' => $prsn_fallecido,

			's_estado_civil_estacivil_id' => $estadocivil = $this->input->post('estadocivilP'),

			's_comunas_comuna_id' => $comu = $this->input->post('comuna'),

			'fecha_muerte' => $Fecha_Muerte,


		);







		$this->model_persona->update($dataP, $idP);





		/* 	if ($prsn_fallecido == 0) {

			redirect('accionistas/inicio');
		} */

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



	public function valida_socio()

	{



		$id = 8;
		$provincia = $this->model_persona->ListarRegionDeProvincia($id);


		echo (json_encode($provincia));
		var_dump($provincia);
	}








	//private


	private function Subir_Varios($user, $archivo)
	{


		$formatos = array('jpg', 'png', 'jpeg', 'gif', 'pdf');

		$fecha = date("Y.m.d_");



		$Dir_archivos = 'archivos/accionista/'; //carpeta donde se guadaran todos los archivos subidos del sistema.


		foreach ($archivo['tmp_name'] as $key => $tmp_name) {
			//condicional si el fuchero existe
			if ($archivo["name"][$key]) {
				// Nombres de archivos de temporales


				$archivonombre = $fecha . $archivo["name"][$key];

				$fuente = $archivo["tmp_name"][$key];

				$carpeta = $Dir_archivos . $user . '/'; //Declaramos el nombre de la carpeta que guardara los archivos

				if (!file_exists($carpeta)) {

					mkdir($carpeta, 0777, true) or die("Hubo un error al crear el directorio de almacenamiento");
				}
				var_dump($carpeta);

				//Abrimos el directorio
				$dir = opendir($carpeta);

				$path_archivo = $carpeta . '/' . $archivonombre; //indicamos la ruta de destino de los archivos

				$Tipo_archivo = pathinfo($path_archivo, PATHINFO_EXTENSION);



				if (in_array($Tipo_archivo, $formatos)) {

					if (move_uploaded_file($fuente, $path_archivo)) {

						echo "El archivo $archivonombre se han cargado de forma correcta.<br>";
					} else {

						echo "Se ha producido un error, por favor revise los archivos e intentelo de nuevo.<br>";
					}
				} else {

					echo "Formato del archivo $archivonombre no valido.<br>";
				}

				closedir($dir); //Cerramos la conexion con la carpeta destino


			}
		}
	}


	private function Subir_Varios_Fallecido($user, $archivo)
	{


		$formatos = array('jpg', 'png', 'jpeg', 'gif', 'pdf');

		$fecha = date("Y.m.d_");



		$Dir_archivos = 'archivos/accionista/'; //carpeta donde se guadaran todos los archivos subidos del sistema.


		foreach ($archivo['tmp_name'] as $key => $tmp_name) {
			//condicional si el fuchero existe
			if ($archivo["name"][$key]) {
				// Nombres de archivos de temporales


				$archivonombre = $fecha . $archivo["name"][$key];

				$fuente = $archivo["tmp_name"][$key];

				$carpeta = $Dir_archivos . $user . '/Fallecido' . '/'; //Declaramos el nombre de la carpeta que guardara los archivos

				if (!file_exists($carpeta)) {

					mkdir($carpeta, 0777, true) or die("Hubo un error al crear el directorio de almacenamiento");
				}
				var_dump($carpeta);

				//Abrimos el directorio
				$dir = opendir($carpeta);

				$path_archivo = $carpeta . '/' . $archivonombre; //indicamos la ruta de destino de los archivos

				$Tipo_archivo = pathinfo($path_archivo, PATHINFO_EXTENSION);



				if (in_array($Tipo_archivo, $formatos)) {

					if (move_uploaded_file($fuente, $path_archivo)) {

						echo "El archivo $archivonombre se han cargado de forma correcta.<br>";
					} else {

						echo "Se ha producido un error, por favor revise los archivos e intentelo de nuevo.<br>";
					}
				} else {

					echo "Formato del archivo $archivonombre no valido.<br>";
				}

				closedir($dir); //Cerramos la conexion con la carpeta destino


			}
		}
	}
}
