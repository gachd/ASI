<?php
require_once APPPATH . '/vendor/autoload.php';

class  inicio extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('model_reportes');
		$this->load->model('model_trabajos');
		$this->load->model('model_turnos');
		$this->load->model('model_socios');
		$this->load->model('Socio_model');
		
		$this->load->model('model_actividades');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		//$this->load->library('mpdf60/Mpdf');
	}


	public function index()
	{

		$data['categorias'] = $this->model_actividades->getCategorias();
		$data['work_categorias'] = $this->model_trabajos->getCategorias();


		$this->load->view('plantilla/Head');
		$this->load->view('reportes/inicio', $data);
		$this->load->view('plantilla/Footer');
	}

	public function fillsubcategorias()
	{

		$ctg  = $this->input->post('micategoria');
		echo ' <option value="0"> Todos</option>';

		if ($ctg <> 0) {
			/*echo' <option value="0"> '.$ctg.'lllego</option>';*/
			$subcatg = $this->model_actividades->getsubcategoria($ctg);
			foreach ($subcatg as $fila) {
				echo ' <option value="' . $fila->sctg_id . '" ' . set_select("subcategoria", $fila->sctg_id) . '>' . $fila->sctg_nombre . '</option>';
			}
		} else {
			echo ' <option value="0"> Seleccionar</option>';
		}
	}

	public function fillinformes()
	{
		echo '<option value="">Seleccionar</option>';
		$tipo = $this->input->post('tipo');
		$informes = $this->model_reportes->tipo_reportes($tipo);
		foreach ($informes as $i) {
			echo '<option value="' . $i->id . '">' . $i->informe . ' </option>';
		}
	}

	public function select_funcionario()
	{

		$tipo_fun  = $this->input->post('tipo_fun');
		$tipo_inst = $this->input->post('tipo_inst');

		if ($tipo_fun <> 0) {
			/*echo' <option value="0"> '.$ctg.'lllego</option>';*/
			echo '<option value="0">Todos</option>';
			$funcionario = $this->model_turnos->getFuncionarioTipo($tipo_fun, $tipo_inst);
			foreach ($funcionario as $f) {
				echo ' <option value="' . $f->rut . '" ' . set_select("subcategoria", $f->rut) . '>' . $f->nombre_fun . ' ' . $f->paterno . '</option>';
			}
		} else {
			echo ' <option value="0"> Todos</option>';
		}
	}

	function fillsubcategoriaswork()
	{

		$ctg  = $this->input->post('micategoria');

		if ($ctg <> 0) {
			echo ' <option value="0"> Todos</option>';
			$subcatg = $this->model_trabajos->getsubcategoria($ctg);
			foreach ($subcatg as $fila) {
				echo ' <option value="' . $fila->sctg_id . '" ' . set_select("subcategoria", $fila->sctg_id) . '>' . $fila->sctg_nombre . '</option>';
			}
		} else {
			echo ' <option value="0"> Seleccionar</option>';
		}
	}

	function informes()
	{
		

		$informe = "" . $this->uri->segment('4') . "";
		$date_inicio = "" . $this->uri->segment('5') . "";
		$date_termino = "" . $this->uri->segment('6') . "";
		$excel = "" . $this->uri->segment('7') . "";
		$categoria = "" . $this->uri->segment('8') . "";
		$subcategoria = "" . $this->uri->segment('9') . "";
		$pdf = "" . $this->uri->segment('10') . "";
		$op = "" . $this->uri->segment('11') . "";
		/*  turnos */
		$year = "" . $this->uri->segment('11') . "";
		$mes = "" . $this->uri->segment('12') . "";
		$tipo_fun = "" . $this->uri->segment('13') . "";
		$tipo_inst = "" . $this->uri->segment('14') . "";
		$fun = "" . $this->uri->segment('15') . "";
		$work_categorias = "" . $this->uri->segment('16') . "";
		$work_subcategoria = "" . $this->uri->segment('17') . "";


		if (empty($informe)) {
			$informe = $this->input->post('informe');
		}
		if (empty($date_inicio)) {
			$date_inicio = $this->input->post('date_inicio');
		}
		if (empty($date_termino)) {
			$date_termino = $this->input->post('date_termino');
		}
		if (empty($excel)) {
			$excel = $this->input->post('excel');
		}
		if (empty($pdf)) {
			$pdf = $this->input->post('pdf');
		}
		if (empty($categoria)) {
			$categoria = $this->input->post('categoria');
		}
		if (empty($subcategoria)) {
			$subcategoria = $this->input->post('subcategoria');
		}
		if (empty($year)) {
			$year = $this->input->post('year');
		}
		if (empty($mes)) {
			$mes = $this->input->post('mes');
		}
		if (empty($tipo_fun)) {
			$tipo_fun = $this->input->post('tipo_fun');
		}
		if (empty($tipo_inst)) {
			$tipo_inst = $this->input->post('tipo_inst');
		}
		if (empty($fun)) {
			$fun = $this->input->post('fun');
		}
		if (empty($work_categorias)) {
			$work_categorias = $this->input->post('work_categorias');
		}
		if (empty($work_subcategoria)) {
			$work_subcategoria = $this->input->post('work_subcategoria');
		}



		$hoy = date("Y-m-d H:i:s");
		$data['inicio'] = $date_inicio;
		$data['termino'] = $date_termino;
		$data['excel'] = $excel;
		$data['categoria'] = $categoria;
		$data['subcategoria'] = $subcategoria;
		$data['op'] = $op;
		$data['year'] = $year;
		$data['mes'] = $mes;
		$data['tipo_funcionario'] = $tipo_fun;
		$data['tipo_institucion'] = $tipo_inst;
		$data['funcionario'] = $fun;
		$data['work_categorias'] = $work_categorias;
		$data['work_subcategoria'] = $work_subcategoria;
		$cabecera = "";
		$pie = "<div>Pág {PAGENO}/{nb}</div>";
		$orientacion = "L";


		if ($pdf == 1) {
			switch ($informe) {
				case 1:
					$html = $this->load->view('reportes/work_semana2', $data, true);
					break;

				case 2:
					$html = $this->load->view('reportes/turnos_rango_fecha', $data, true);
					break;
				case 3:
					$html = $this->load->view('reportes/work_control_planificacion', $data, true);
					break;
				case 4:
					$html = $this->load->view('reportes/activity_consolidado', $data, true);
					break;
				case 5:
					$html = $this->load->view('reportes/work_planificacion', $data, true);
					break;
				case 6:
					$html = $this->load->view('reportes/activity_report3', $data, true);
					$cabecera = "Programación de Actividades";

					break;
				case 7:
					$html = $this->load->view('reportes/op_report', $data, true);
					$cabecera = "orden de pago";
					$orientacion = "P";

					break;

				case 8:
					$html = $this->load->view('reportes/turnos_mensual', $data, true);
					$cabecera = "Turnos";
					break;
				case 9:
					$html = $this->load->view('reportes/work_plan_man_periocidad', $data, true);
					$cabecera = "Plan de mantención";
					$orientacion = "P";
					break;

				case 10:
					$html = $this->load->view('reportes/work_plan_man_resumen', $data, true);
					break;
				case 11:
					$html = $this->load->view('reportes/work_plan_trabajos_mes', $data, true);
					break;
				case 12:
					$html = $this->load->view('reportes/work_calendario', $data, true);
					$orientacion = "P";
					break;
				case 13:
					$html = $this->load->view('reportes/agendamiento', $data, true);
					$orientacion = "P";
					break;

				default:
					# code...
					break;
			}
			//$html = mb_convert_encoding($html, 'UTF-8', 'ISO-8859-1');
			ob_end_clean();

			$html = html_entity_decode($html);
			$mpdf = new \Mpdf\Mpdf(['debug' => true]);
			//  $stylesheet = file_get_contents(base_url().'/assets/css/pdf.css'); // la ruta a tu css 
			// $mpdf->WriteHTML($stylesheet,1);
			$mpdf->AddPage($orientacion);
			$mpdf->SetHTMLHeader($cabecera);
			$mpdf->shrink_tables_to_fit = 1;
			$mpdf->WriteHTML($html);
			$mpdf->SetHTMLFooter($pie);
			$mpdf->Output();

			
		} else {
			switch ($informe) {
				case 1:
					$this->load->view('reportes/work_semana', $data);
					break;

				case 2:
					$this->load->view('reportes/turnos_rango_fecha', $data);
					break;
				case 3:
					$this->load->view('reportes/work_control_planificacion', $data);
					break;
				case 4:
					$this->load->view('reportes/activity_consolidado', $data);
					break;
				case 5:
					$this->load->view('reportes/work_planificacion', $data);
					break;
				case 6:
					$this->load->view('reportes/activity_report', $data);
					break;
				case 7:
					$this->load->view('reportes/op_report', $data);
					break;
				case 8:
					$html = $this->load->view('reportes/turnos_mensual', $data);
					break;
				case 9:
					$html = $this->load->view('reportes/work_plan_man_periocidad', $data);
					break;
				case 10:
					$html = $this->load->view('reportes/work_plan_man_resumen', $data);
					break;
				case 11:
					$html = $this->load->view('reportes/work_plan_trabajos_mes', $data);
					break;
				case 12:
					$html = $this->load->view('reportes/work_calendario', $data);
					break;
				case 13:
					$html = $this->load->view('reportes/agendamiento', $data);

					break;
				default:
					# code...
					break;
			}
		}
	}
}
