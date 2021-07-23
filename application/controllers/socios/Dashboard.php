<?php
require_once APPPATH . '/vendor/autoload.php';

class  dashboard extends CI_Controller
{
   function __construct()
   {

      parent::__construct();

      $this->load->library('session');
      $this->load->helper('url');
      $this->load->helper('form');
      $this->load->library('form_validation');
      $this->load->library('session');
      $this->load->model('model_accionistas');
      $this->load->model('model_socios');
      //	$this->load->library('mpdf60/Mpdf');
      $this->load->model('model_socios');
   }

   public function index()
   {

      //$data['personas'] = $this -> model_socios -> all_personas();



      $data['activos'] = $this->model_socios->sociosActivos();
      $data['honorario'] = $this->model_socios->sociosHonorarios();
      $this->load->view('plantilla/Head_v1');

      $this->load->view('socios/dashboard', $data);

      $this->load->view('plantilla/Footer');
   }



   public function mostrarGrafico()
   {

      $socios = $this->model_socios->sociosActivos();


      $data = [];

      $rango[0] = 0;
      $rango[1] = 0;
      $rango[2] = 0;
      $rango[3] = 0;
      $rango[4] = 0;
      $rango[5] = 0;


      $nombres[0] = '2020-2';
      $nombres[1] = '2020-1';
      $nombres[2] = '2019-2';
      $nombres[3] = '2019-1';
      $nombres[4] = '2018-2';
      $nombres[5] = '2018-1';




      $cont = 0;
      $cont2 = 0;
      foreach ($socios as $s) {

         $rut = $s->prsn_rut;
         $ult_pago = $this->model_socios->ultimaCuota($rut);
         $periodo =  $ult_pago[0]->ano . '-' . $ult_pago[0]->semestre;

         // = $ult_pago['ano'] .'-'.$ult_pago['semestre'];



         for ($i = 0; $i < 6; $i++) {
            if ($nombres[$i] === (string)$periodo) {
               $rango[$i] = $rango[$i] + 1;
               $cont = $cont + 1;
            }
         }

         $cont2 = $cont2 + 1;
      }



      $rango[6] = $cont2 - $cont;
      $nombres[6] = '2017-2 ++';



      for ($j = 0; $j < 7; $j++) {

         $data[] = [(string)$nombres[$j], (int)$rango[$j]];
      }

      echo json_encode($data);
   }


   function informes()
   {

      $informe = "" . $this->uri->segment('4') . "";
      if (empty($informe)) {
         $informe = $this->input->post('informe');
      }




      $hoy = date("Y-m-d H:i:s");
      $cabecera = "";
      $pie = "<div>Pág {PAGENO}/{nb}</div>";
      $orientacion = "P";
      $data['activos'] = $this->model_socios->sociosActivos();


      if ($informe == 'consolidado') {

         $html = $this->load->view('reportes/consolidadoCuotas', $data, true);
      }
      if ($informe == 'morosidad') {

         $html = $this->load->view('reportes/morosidadCuotas', $data, true);
      }
      if ($informe == 'aldia') {

         $html = $this->load->view('reportes/aldiaCuotas', $data, true);
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
   }
}
