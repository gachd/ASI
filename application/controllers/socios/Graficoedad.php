<?php



class graficoedad extends CI_Controller
{



	function __construct()
	{

		parent::__construct();

		$this->load->library('session');

		$this->load->model('model_reportes');

		$this->load->model('model_trabajos');

		$this->load->model('model_turnos');

		$this->load->model('model_actividades');

		$this->load->model('model_socios');

		$this->load->helper('url');

		$this->load->helper('form');

		$this->load->library('form_validation');

		$this->load->library('session');

		$this->load->library('mpdf60/Mpdf');
	}





	public function index()
	{









		$this->load->view('plantilla/Head_v1');

		$this->load->view('socios/graficoedad');

		$this->load->view('plantilla/Footer');
	}

	public function detalle()
	{



		/*function calculaedad($fechanacimiento){

  list($ano,$mes,$dia) = explode("-",$fechanacimiento);

  $ano_diferencia  = date("Y") - $ano;

  $mes_diferencia = date("m") - $mes;

  $dia_diferencia   = date("d") - $dia;

  if ($dia_diferencia < 0 || $mes_diferencia < 0)

    $ano_diferencia--;

  return $ano_diferencia;

}	*/

		if ($_POST['tipo'] == 3) {
			$tipoSocio = $_POST['tipoSocio'];
			if ($tipoSocio == 1) {

				$tipoSoc = $_POST['tipSoc'];



				if ($tipoSoc == 2) {

					$result = $this->model_socios->tipoSocios2($tipoSoc, 3);
				} else {

					$result = $this->model_socios->tipoSocios($tipoSoc);
				}
			}


			if ($tipoSocio == 2) {
				$tipoSoc = $_POST['tipSoc'];
				$result = $this->model_socios->CondSocio($tipoSoc);
			}


			if ($tipoSocio == 3) {
				$tipoSoc = $_POST['tipSoc'];
				$result = $this->model_socios->Cond2Socio($tipoSoc);
			}


			foreach ($result as $res) {

				$rut = $res->prsn_rut;

				$nombre = $res->prsn_nombres;

				$ap_pat = $res->prsn_apellidopaterno;

				$ap_mat = $res->prsn_apellidomaterno;

				$data[] = [$rut, $nombre, $ap_pat, $ap_mat];
			}
		} else {



			$tipo = $_POST['tipo'];



			if (($_POST['genero'] == 1) || ($_POST['genero'] == 0) && ($_POST['genero'] != NULL)) {



				$genero = $_POST['genero'];

				$tipo = $_POST['tipo'];



				if ($tipo == 1) {

					$result = $this->model_socios->detalleGenerosS($genero);
				} else {

					$result = $this->model_socios->detalleGenerosC($genero);
				}

				foreach ($result as $res) {

					$rut = $res->prsn_rut;

					$nombre = $res->prsn_nombres;

					$ap_pat = $res->prsn_apellidopaterno;

					$ap_mat = $res->prsn_apellidomaterno;

					$data[] = [$rut, $nombre, $ap_pat, $ap_mat];
				}
			} else {



				$año1 = $_POST['desde'];

				$año2 = $_POST['hasta'];

				$gen = $_POST['gen'];

				$tipo = $_POST['tipo'];

				$data = [];

				$datos = [];







				if ($tipo == 1) {



					if ($gen == 2) {



						$result = $this->model_socios->detalleGrafico($año1, $año2);
					} else {

						if ($gen == 3) {
							$gen = 1;
						}
						if ($gen == 4) {
							$gen = 0;
						}

						$result = $this->model_socios->detalleGraficoGen($año1, $año2, $gen);
					}
				} else {

					if ($gen == 2) {

						$result = $this->model_socios->detalleGraficoC($año1, $año2);
					} else {

						if ($gen == 3) {
							$gen = 1;
						}
						if ($gen == 4) {
							$gen = 0;
						}

						$result = $this->model_socios->detalleGraficoGenC($año1, $año2, $gen);
					}
				}



				foreach ($result as $res) {

					$rut = $res->prsn_rut;

					$nombre = $res->prsn_nombres;

					$ap_pat = $res->prsn_apellidopaterno;

					$ap_mat = $res->prsn_apellidomaterno;

					//   $edad = calculaedad($res ->prsn_fechanacimi);

					$cumpleanos = new DateTime($res->prsn_fechanacimi);

					$hoy = new DateTime();

					$annos = $hoy->diff($cumpleanos);



					$data[] = [$rut, $nombre, $ap_pat, $ap_mat, $annos->y];



					//  echo json_encode($data);

					// $data [] = [$datos];



				}
			}
		}



		echo json_encode($data);
	}







	public function procesar()
	{



		$tipo = $_POST['tipo'];

		$tipoGraf = $_POST['tipoGraf'];

		$gen = $_POST['gen'];

		$data = [];

		$rango = [];

		$edadesSocios = [];

		$edadesCargas = [];

		$tiposocios = [];

		$generos = [];

		$tiposocios = ['Activo', 'Honorario', 'Ausente', 'Empresa'];
		$condicion = ['RENUNCIA', 'FALLECIDO', 'EXPULSIÓN', 'NINGUNA'];
		$condicion2 = ['MOROSIDAD', 'PERNICIOSO', 'SUSPENSIÓN', 'NINGUNA'];

		$generos = ['Masculino', 'Femenino'];

		$edadesSocios = ['[18-30]', '[31-40]', '[41-50]', '[51-60]', '[61-70]', '[71-80]', '[81-90]', '[91-100]'];

		$edadesCargas = ['[0-10]', '[11-18]', '[19-30]', '[31-40]', '[41-50]', '[51-60]', '[61-70]', '[71-80]', '[81-90]', '[91-100]'];







		if ($tipoGraf == 1 && $tipo == 1 && $gen == 2) {

			$rango[0] = $this->model_socios->cantidad(18, 30);

			$rango[1] = $this->model_socios->cantidad(31, 40);

			$rango[2] = $this->model_socios->cantidad(41, 50);

			$rango[3] = $this->model_socios->cantidad(51, 60);

			$rango[4] = $this->model_socios->cantidad(61, 70);

			$rango[5] = $this->model_socios->cantidad(71, 80);

			$rango[6] = $this->model_socios->cantidad(81, 90);

			$rango[7] = $this->model_socios->cantidad(91, 150);



			for ($i = 0; $i < 8; $i++) {

				$data[] = [(string)$edadesSocios[$i], (int)$rango[$i]];
			}

			//$data2 = array('[18-30]','[31-40]','[41-50]','[51-60]','[61-70]','[71-80]','[81-90]','[91-150]');

			//echo json_encode($data);

			//$series_data = array(20,30,40,10,5);		



			echo json_encode($data);
		}







		if ($gen == 3) {
			$gen = 1;
		}

		if ($gen == 4) {
			$gen = 0;
		}



		if ($tipoGraf == 1 && $tipo == 1 && ($gen == 1 || $gen == 0)) {

			$rango[0] = $this->model_socios->cantidadGen(18, 30, $gen);

			$rango[1] = $this->model_socios->cantidadGen(31, 40, $gen);

			$rango[2] = $this->model_socios->cantidadGen(41, 50, $gen);

			$rango[3] = $this->model_socios->cantidadGen(51, 60, $gen);

			$rango[4] = $this->model_socios->cantidadGen(61, 70, $gen);

			$rango[5] = $this->model_socios->cantidadGen(71, 80, $gen);

			$rango[6] = $this->model_socios->cantidadGen(81, 90, $gen);

			$rango[7] = $this->model_socios->cantidadGen(91, 100, $gen);



			for ($i = 0; $i < 8; $i++) {

				$data[] = [(string)$edadesSocios[$i], (int)$rango[$i]];
			}



			echo json_encode($data);
		}



		if ($tipoGraf == 1 && $tipo == 2 && $gen == 2) {

			$rango[0] = $this->model_socios->cantidadCargas(0, 10);

			$rango[1] = $this->model_socios->cantidadCargas(11, 18);

			$rango[2] = $this->model_socios->cantidadCargas(19, 30);

			$rango[3] = $this->model_socios->cantidadCargas(31, 40);

			$rango[4] = $this->model_socios->cantidadCargas(41, 50);

			$rango[5] = $this->model_socios->cantidadCargas(51, 60);

			$rango[6] = $this->model_socios->cantidadCargas(61, 70);

			$rango[7] = $this->model_socios->cantidadCargas(71, 80);

			$rango[8] = $this->model_socios->cantidadCargas(81, 90);

			$rango[9] = $this->model_socios->cantidadCargas(91, 100);



			for ($i = 0; $i < 10; $i++) {

				$data[] = [(string)$edadesCargas[$i], (int)$rango[$i]];
			}



			echo json_encode($data);
		}

		if ($tipoGraf == 1 && $tipo == 2 && ($gen == 1 || $gen == 0)) {

			$rango[0] = $this->model_socios->cantidadCargasGen(0, 10, $gen);

			$rango[1] = $this->model_socios->cantidadCargasGen(11, 18, $gen);

			$rango[2] = $this->model_socios->cantidadCargasGen(19, 30, $gen);

			$rango[3] = $this->model_socios->cantidadCargasGen(31, 40, $gen);

			$rango[4] = $this->model_socios->cantidadCargasGen(41, 50, $gen);

			$rango[5] = $this->model_socios->cantidadCargasGen(51, 60, $gen);

			$rango[6] = $this->model_socios->cantidadCargasGen(61, 70, $gen);

			$rango[7] = $this->model_socios->cantidadCargasGen(71, 80, $gen);

			$rango[8] = $this->model_socios->cantidadCargasGen(81, 90, $gen);

			$rango[9] = $this->model_socios->cantidadCargasGen(91, 100, $gen);



			for ($i = 0; $i < 10; $i++) {

				$data[] = [(string)$edadesCargas[$i], (int)$rango[$i]];
			}



			echo json_encode($data);
		}





		if ($tipoGraf == 2 && $tipo == 1) {

			$rango[0] = $this->model_socios->SociosGen(1);

			$rango[1] = $this->model_socios->SociosGen(0);



			for ($i = 0; $i < 2; $i++) {

				$data[] = [(string)$generos[$i], (int)$rango[$i]];
			}



			echo json_encode($data);
		}

		if ($tipoGraf == 2 && $tipo == 2) {

			$rango[0] = $this->model_socios->CargasGen(1);

			$rango[1] = $this->model_socios->CargasGen(0);



			for ($i = 0; $i < 2; $i++) {

				$data[] = [(string)$generos[$i], (int)$rango[$i]];
			}



			echo json_encode($data);
		}

		if ($tipoGraf == 3) {

			if ($tipo == 1) {

				$j = 1;

				for ($i = 0; $i < 5; $i++) {

					$rango[$i] = $this->model_socios->TipoSocio($j);

					$j = $j + 1;
				}





				$j = 0;

				for ($i = 0; $i < 5; $i++) {



					if ($i == 1 || $i == 2) {

						if ($i != 2) {

							$suma = $rango[$i] + $rango[$i + 1];

							$data[] = [(string)$tiposocios[$j], (int)$suma];

							$j = $j + 1;
						}
					} else {

						$data[] = [(string)$tiposocios[$j], (int)$rango[$i]];

						$j = $j + 1;
					}
				}
			}

			if ($tipo == 2) {
				$j = 0;
				for ($i = 1; $i < 5; $i++) {

					$rango[$j] = $this->model_socios->CondisionSocio($i);
					$j = $j + 1;
				}





				for ($i = 0; $i < 4; $i++) {

					$data[] = [(string)$condicion[$i], (int)$rango[$i]];
				}
			}
			if ($tipo == 3) {
				$j = 0;
				for ($i = 1; $i < 5; $i++) {

					$rango[$j] = $this->model_socios->Condision2Socio($i);
					$j = $j + 1;
				}





				for ($i = 0; $i < 4; $i++) {

					$data[] = [(string)$condicion2[$i], (int)$rango[$i]];
				}
			}

			echo json_encode($data);
		}
	}




	public function test()
	{

		$edadesSocios = ['[18-30]', '[31-40]', '[41-50]', '[51-60]', '[61-70]', '[71-80]', '[81-90]', '[91-100]'];
		$rango = $this->model_socios->allSoociosVal();
		$json = '[{"prsn_rut":"10139877-3"},{"caca":"10139877-3"}]';
		$decode = json_decode($json);
		var_dump($decode);
	
		$edadesJson = json_encode($edadesSocios);
		var_dump($edadesJson);
	}
}
