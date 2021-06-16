<?php class  ficha_socio extends CI_Controller {



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

		

		$this->load->view('plantilla/Head');

	    $this->load->view('socios/ficha_socio');

		$this->load->view('plantilla/Footer');



				

	}





   function ficha_socios(){



           // include("mpdf/mpdf.php");

            $html=$this->load->view('socios/formatofichasocio',$data,true);

            $html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');

	        $mpdf = new mPDF('utf-8', [216,330], 0,'',10,10,10,10,5,5,'P');

	        //$mpdf = SetDisplayMode("fullpage");

	       // $mpdf->AddPage($orientacion);

	       // $mpdf->SetHTMLHeader($cabecera);

	      //  $mpdf->SetHTMLFooter($pie);

	        $mpdf->shrink_tables_to_fit =1;

	       // $stylesheet = file_get_contents('assets/css/bootstrap.css');	        

            //$mpdf->WriteHTML($stylesheet, 1);

           // $style = file_get_contents('assets/css/Print-PDF.css');

            //$mpdf->WriteHTML($style, 2);            

	        $mpdf->WriteHTML($html);

	       // $mpdf->SetHTMLFooter($pie);

	        $mpdf->Output();

	}







}