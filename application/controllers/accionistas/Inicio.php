<?php

require_once APPPATH . '/vendor/autoload.php';



use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\ColumnDimension;
use PhpOffice\PhpSpreadsheet\Worksheet;


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

      $data['todo_sa'] = $this->model_sa->datos_sa();

      $activos = $this->model_accionistas->id_activos();


      $bajas = [];



      foreach ($activos as $a) {

         if (empty($this->model_accionistas->validar_estado($a->id_accionista))) {

            array_push($bajas, $this->model_accionistas->datosaccionista($a->id_accionista));
         }
      }

      $data['bajas'] = $bajas;


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

      if ($cont!=0) {
         $data[$j] = ["MINORISTAS", $cont];
        
      }

      



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


   public function bajas()

   {
      $activos = $this->model_accionistas->id_activos();


      $bajas = [];

      foreach ($activos as $a) {

         if (empty($this->model_accionistas->validar_estado($a->id_accionista))) {

            array_push($bajas, $this->model_accionistas->datosaccionista($a->id_accionista));
         }
      }

      $data['bajas'] = $bajas;






      $this->load->view('plantilla/Head_v1');

      $this->load->view('accionistas/bajas', $data);

      $this->load->view('plantilla/Footer');
   }

   public function dar_debaja()
   {

      $id_accionista = $this->input->post('accionista');
      $fecha = $this->input->post('fecha1');


      $baja = array(
			
         'estado_accionista'=> 0,
		);

   $this->model_accionistas->update($baja,$id_accionista);

   $this->session->set_flashdata('exito', 'Actualizado');







      

     

   


		redirect('accionistas/inicio/bajas');
      
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


   function informesExcel()

   {

      $informe = "" . $this->uri->segment('4') . "";



      if (empty($informe)) {
         $informe = $this->input->post('informe');
      }

      if ($informe == 1) {

         $data = $this->model_accionistas->accionistas_alfabetico();
         $this->reporte_excel_all($data, $informe);
      }
      if ($informe == 2) {

         $data = $this->model_accionistas->accionistas_mayoritarios();
         $this->reporte_excel_all($data, $informe);
      }
   }






   //Funciones privadas

   private function reporte_excel_all($data, $tipo)
   {



      $spreadsheet = new Spreadsheet();

      $sheet = $spreadsheet->getActiveSheet();

      $sheet->setCellValue('B1', 'Rut Accionista');
      $sheet->setCellValue('C1', 'Nombre');
      $sheet->setCellValue('D1', 'Incorporacion');
      $sheet->setCellValue('E1', 'Acciones');


      //$data =  $this->model_test->cargas_activosALL();
      $nro = 1;
      $start = 2;
      $total = 0;
      foreach ($data as $c) {

         $sheet->setCellValue('B' . $start, $this->getPuntosRut($c->prsn_rut));
         $sheet->setCellValue('C' . $start, $c->prsn_nombres . " " . $c->prsn_apellidopaterno . " " . $c->prsn_apellidomaterno);
         $sheet->setCellValue('D' . $start, $c->fecha);
         $sheet->setCellValue('E' . $start, $c->numero_acciones);




         $start = $start + 1;
         $nro = $nro + 1;
         $total++;
      }
      $start = $start - 1;

      if ($tipo == 1) {
         $sheet->setCellValue('I5', 'Existen un total de ' . $total . ' accionistas');
         $sheet->getColumnDimension('I')->setAutoSize(true);
      }




      $styleThinBlackBorderOutline = [
         'borders' => [
            'allBorders' => [
               'borderStyle' => Border::BORDER_THIN,
               'color' => ['argb' => 'FF000000'],
            ],
         ],
      ];

      //Agregar Filtros
      $sheet->setAutoFilter('B1:E' . $start);
      //Fuente a Nregrita
      $sheet->getStyle('A1:E1')->getFont()->setBold(true);
      $sheet->getStyle('B1:E' . $start)->applyFromArray($styleThinBlackBorderOutline);
      //Aliniamientado centrado
      //Tamano letra
      $sheet->getStyle('A1:E2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
      $sheet->getStyle('A2:E' . $start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('A1:E' . $start)->getFont()->setSize(12);


      //Custom width for Individual Columns

      $columnas = array('B', 'C', 'D', 'E');

      foreach ($columnas as $col) {
         //$sheet->getColumnDimension($col)->setAutoSize(true);

         $sheet->getColumnDimension($col)->setAutoSize(true);
      }
      $fecha = date('d-m-Y H:i:s');

      $writer = new Xlsx($spreadsheet);

      if ($tipo == 1) {
         $filename = 'Accionistas ' . $fecha;
      }
      if ($tipo == 2) {
         $filename = 'Accionistas Mayoritarios ' . $fecha;
      }


      ob_end_clean();
      header('Content-Type: application/vnd.ms-excel');

      header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');

      header('Cache-Control: max-age=0');

      $writer->save('php://output');
   }











   private function getSexo($sexo)
   {

      if ($sexo == 1) {
         return ("Masculino");
      }
      if ($sexo == 0) {
         return ("Femenino");
      }
   }

   private function getPuntosRut($rut)
   {

      $rutTmp = explode("-", $rut);

      return number_format($rutTmp[0], 0, "", ".") . '-' . $rutTmp[1];
   }

   private function getParentestco($id)
   {

      if ($id == 1) {
         return ("CONYUGE");
      }
      if ($id == 2) {
         return ("HIJO/A");
      }
      if ($id == 3) {
         return ("PADRE");
      }
      if ($id == 4) {
         return ("MADRE");
      }
      if ($id == 5) {
         return ("HIJASTRO");
      }
      if ($id == 6) {
         return ("OTRO FAMILIAR");
      }
   }

   private function getEdad($fechanacimiento)
   {

      list($ano, $mes, $dia) = explode("-", $fechanacimiento);
      $ano_diferencia  = date("Y") - $ano;
      $mes_diferencia = date("m") - $mes;
      $dia_diferencia   = date("d") - $dia;
      if ($dia_diferencia < 0 || $mes_diferencia < 0)
         $ano_diferencia--;
      return $ano_diferencia;
   }
}
