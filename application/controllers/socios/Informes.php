<?php

require_once APPPATH . '/vendor/autoload.php';

class informes extends CI_Controller
{



  function __construct()
  {

    parent::__construct();
    $this->load->library('session');
    $this->load->model('model_socios');
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->library('session');

    //$this->load->library('mpdf60/Mpdf');

  }





  public function index()
  {

    $data['socios'] = $this->model_socios->sociosVigentes();

    $this->load->view('plantilla/Head');

    $this->load->view('socios/informes', $data);

    $this->load->view('plantilla/Footer');
  }


  function pdf()
  {
    $formato = "" . $this->uri->segment('4') . "";
    $informe = "" . $this->uri->segment('5') . "";
    $rut = "" . $this->uri->segment('6') . "";

    if (empty($informe)) {
      $formato = $this->input->post('formato');
      $informe = $this->input->post('informe');
      $rut = $this->input->post('socio');
    }




    $hoy = date("Y-m-d H:i:s");

    $cabecera = "";
    $pie = "<div>Pág {PAGENO}/{nb}</div>";
    $orientacion = "P";

    
    



    switch ($informe) {
      case 1:
        $data['datos_personales'] = $this->model_socios->persona($rut);
        $data['cuotas'] = $this->model_socios->cuotas($rut);
        $data['fechaReg'] =  $this->model_socios->fechaReg($rut);
        $data['corp'] = $this->model_socios->corp_socios($rut);
        //   $data['socios'] = $this -> model_socios->sociosVigentes();
        $html = $this->load->view('reportes/pagosocios', $data, true);
        break;
      case 2:
        $data['fechaReg'] =  $this->model_socios->fechaReg($rut);
        $data['datos_personales'] = $this->model_socios->persona($rut);
        $data['cargas'] = $this->model_socios->cargas($rut);
        $data['corp'] = $this->model_socios->corp_socios($rut);
        $data['socios'] = $this->model_socios->sociosActivos();
        $html = $this->load->view('reportes/cargas', $data, true);
        break;
      case 3:
        $data['socios'] = $this->model_socios->sociosHonorarios();
        $html = $this->load->view('reportes/consolidado', $data, true);
        break;
      case 4:
        $data['socios'] = $this->model_socios->sociosActivos();
        $html = $this->load->view('reportes/consolidado2', $data, true);
        break;

      default:
        # code...
        break;
    }

    if ($formato == "pdf") {

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

      echo $html;
      
    }



  }
}
