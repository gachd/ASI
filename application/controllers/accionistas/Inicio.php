<?php

require_once APPPATH . '/vendor/autoload.php';


class inicio extends CI_Controller
{



   function __construct()
   {

      parent::__construct();

      $this->load->library('session');

      $this->load->model('model_reportes');

      $this->load->model('model_socios');
      $this->load->model('model_libro');
      $this->load->model('model_titulo');
      $this->load->model('model_persona');
      $this->load->model('model_accionistas');

      $this->load->model('model_trabajos');

      $this->load->model('model_turnos');

      $this->load->model('model_actividades');
      $this->load->model('model_sa');


      $this->load->model('model_socios');
      $this->load->model('model_accionistas');

      $this->load->helper('url');

      $this->load->helper('form');

      $this->load->library('form_validation');

      $this->load->library('session');

      $this->load->library('mpdf60/Mpdf');
   }





   public function index()
   {



      $data['accionistas'] = $this->model_accionistas->accionistas();
      $data['ultimos'] = $this->model_accionistas->ultimos();

      $no_entregados = $this->model_titulo->nro_titulos_no_entregados();
      $data['no_entregados'] =  $no_entregados[0]->no_entregados;


      $emitidas = $this->model_accionistas->totalemitidas();

      $totalemitidas = $emitidas[0]->total_emitidas;
      $data['emitidas'] = $totalemitidas;


      $sa = $this->model_sa->datos_sa();
      $total_acciones = $sa[0]->Acciones;
      $data['sa'] = $total_acciones;

      $saldo =  $total_acciones - $totalemitidas;

      $data['saldo'] = $saldo;










      $this->load->view('plantilla/Head_v1');

      $this->load->view('accionistas/inicio', $data);

      $this->load->view('plantilla/Footer');
   }



   // public function mostrarGrafico()
   // {
   //    $accionistas = $this->model_accionistas->accionistas();

   //    $data = [];

   //    $rango = [];
   //    $nombres = [];

   //    $i = 0;
   //    $cont = 0;
   //    foreach ($accionistas as $s) {

   //       $nro_acciones = $s->nro_acciones;

   //       if ($nro_acciones != 1) {
   //          $rango[$i] = $nro_acciones;
   //          if ($s->prsn_apellidopaterno == '') {
   //             $nombres[$i] = $s->prsn_nombres;
   //          } else {
   //             $nombres[$i] = $s->prsn_nombres . ' ' . $s->prsn_apellidopaterno;
   //          }
   //          $i = $i + 1;
   //       } else {
   //          $cont = $cont + 1;
   //       }
   //    }

   //    $rango[$i] = $cont;
   //    $nombres[$i] = 'MINORITARIOS';
   //    $i = $i + 1;
   //    for ($j = 0; $j < $i; $j++) {
   //       $data[] = [(string)$nombres[$j], (int)$rango[$j]];
   //    }

   //    echo json_encode($data);
   // }






   public function mostrarGrafico1()
   {
      $accionistas = $this->model_accionistas->nro_acciones_all();




      $data = [];

      $rango = [];
      $nombres = [];

      $i = 0;
      $cont = 0;

      foreach ($accionistas as $s) {

         $nro_acciones = $s->numero_acciones;

         if ($nro_acciones != 1) {

            if ($s->prsn_apellidopaterno == '') {
               $nombres[$i] = $s->prsn_nombres;
               $rango[$i] = $s->numero_acciones;
            } else {
               $nombres[$i] = $s->prsn_nombres . ' ' . $s->prsn_apellidopaterno;
               $rango[$i] = $s->numero_acciones;
            }
            $i = $i + 1;
         } else {
            $cont = $cont + 1;
         }
      }





      for ($j = 0; $j < $i; $j++) {
         $data[] = [(string)$nombres[$j], (int)$rango[$j]];
      }

      $data[$j] = ["MINORISTAS", $cont];



      echo json_encode($data, JSON_UNESCAPED_UNICODE);
   }


   public function editar($id)

   {

      $data['accionista'] = $this->model_accionistas->datosaccionista($id);

      $data['comunas']   = $this->model_persona->all_comunas();
      $data['laboral']   = $this->model_persona->all_condicionlab();
      $data['estado_civil']   = $this->model_persona->all_estadocivil();
      $data['provincia']   = $this->model_persona->all_provincias();
      $data['region']   = $this->model_persona->all_region();




      $this->load->view('plantilla/Head_v1');

      $this->load->view('accionistas/update_accionista', $data);

      $this->load->view('plantilla/Footer');
   }


   public function ver($id)

   {

      $data['accionista'] = $this->model_accionistas->datosaccionista($id);

      $data['titulos'] = $this->model_accionistas->validar_estado($id);







      $this->load->view('plantilla/Head_v1');

      $this->load->view('accionistas/show_accionista', $data);

      $this->load->view('plantilla/Footer');
   }


   public function verFechas()

   {
      // $data['accionista'] = $this->model_accionistas->datosaccionista($id);

      // $data['titulos'] = $this->model_accionistas->validar_estado($id);
      $data[] = '';






      $this->load->view('plantilla/Head_v1');

      $this->load->view('accionistas/por_fechas', $data);

      $this->load->view('plantilla/Footer');
   }


   public function informe_fechas_accionistas()

   {



      $tipo = $this->input->post('tipoinforme');
      $fecha1 = $this->input->post('fecha1');
      $fecha2 = $this->input->post('fecha2');


      switch ($tipo) {
         case 0:

            $result = $this->model_accionistas->buscar_por_fecha_baja($fecha1, $fecha2, $tipo);
            break;



         case 1:

            $result = $this->model_accionistas->buscar_por_fecha_activo($fecha1, $fecha2, $tipo);
            break;
      }


      print_r(json_encode($result));
   }


   public function informe_fechas_accionistas2()

   {



      $tipo = $this->input->post('tipoinforme');
      $data['fecha1'] = $fecha1 = $this->input->post('fecha1');
      $data['fecha2'] = $fecha2 = $this->input->post('fecha2');



      $cabecera = "";
      $pie = "<div>Pág {PAGENO}/{nb}</div>";
      $orientacion = "P";



      switch ($tipo) {
         case 0:

            $data['accionista'] = $this->model_accionistas->buscar_por_fecha_baja($fecha1, $fecha2, $tipo);
            var_dump($data);
            $html = $this->load->view('accionistas/reporte_bajas', $data, true);
            break;





         case 1:

            $data['accionista'] = $this->model_accionistas->buscar_por_fecha_activo($fecha1, $fecha2, $tipo);
            $html = $this->load->view('accionistas/reporte_incorporacion', $data, true);
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



      switch ($informe) {
         case 1:
            $data['accionista'] = $this->model_accionistas->accionistas_alfabetico();
            $html = $this->load->view('accionistas/reporte_accionistaCMF', $data, true);
            break;
         case 2:
            $data['accionista'] = $this->model_accionistas->accionistas_mayoritarios();
            $html = $this->load->view('accionistas/reporte_mayoritarios', $data, true);
            break;

         default:

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
   }
}
