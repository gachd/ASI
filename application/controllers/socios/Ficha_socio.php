<?php
require_once APPPATH . '/vendor/autoload.php';


class  ficha_socio extends CI_Controller
{



	function __construct()
	{

		parent::__construct();

		$this->load->library('session');

		$this->load->helper('url');

		$this->load->helper('form');

		$this->load->library('form_validation');

		$this->load->library('session');

		$this->load->library('mpdf60/Mpdf');

		$this->load->model('model_socios');
	}



	public function index()
	{



		$this->load->view('plantilla/Head_v1');

		$this->load->view('socios/ficha_socio');

		$this->load->view('plantilla/Footer');
	}





	function ficha_socios()
	{


		$cabecera = "";
		//$pie = "<div>Pág {PAGENO}/{nb}</div>";
		$orientacion = "P";


		$html = $this->load->view('socios/formatofichasocio', [], true);

		ob_end_clean();
		$html = html_entity_decode($html);

		$mpdf = new \Mpdf\Mpdf(['debug' => true]);
		$mpdf->AddPage($orientacion);
		$mpdf->SetHTMLHeader($cabecera);
		$mpdf->shrink_tables_to_fit = 1;
		$mpdf->WriteHTML($html);
		
		$mpdf->Output();


	}
}
