<?php
require 'vendor/autoload.php';
defined('BASEPATH') or exit('No direct script access allowed');

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

class Test extends CI_Controller
{



    function __construct()
    {

        parent::__construct();
        $this->load->library('session');
        $this->load->model('model_socios');
        $this->load->model('model_test');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('mpdf60/Mpdf');
    }





    public function index()
    {

        $data['socios'] = $this->model_test->activos();
        $data['cargas'] = $this->model_test->cargas_activosALL();
        $this->load->view('plantilla/Head_v1');

        $this->load->view('socios/test', $data);

        $this->load->view('plantilla/Footer');
    }

    function cargas_socio()


    {



        $activos = $this->model_test->activos();
        $carga = $this->model_test->cargas_activosALL();
        //var_dump($carga);

        $data['socios'] = $activos;


        //  foreach ($activos as $s) {

        //      echo '<h1>Socio</h1>';

        //      var_dump($s);

        //      echo '<h2>carga</h2>';

        //      $cargas = $this->model_test->cargas_activos($s->prsn_rut);

        //      foreach ($cargas as $c) {
        //          var_dump($c);
        //      }

        //  }

        var_dump($carga);
    }


    private function reporte_socio($data)
    {



        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('B1', 'RUT');
        $sheet->setCellValue('C1', 'Nombre');
        $sheet->setCellValue('D1', 'Edad');
        $sheet->setCellValue('E1', 'Sexo');

        //$data =  $this->model_test->activos();
        $total=0;

        $start = 2;
        foreach ($data as $s) {

            $sheet->setCellValue('B' . $start, $this->getPuntosRut($s->prsn_rut));
            $sheet->setCellValue('C' . $start, $s->prsn_nombres . " " . $s->prsn_apellidopaterno . " " . $s->prsn_apellidomaterno);
            $sheet->setCellValue('D' . $start, $this->getEdad($s->prsn_fechanacimi));
            $sheet->setCellValue('E' . $start, $this->getSexo($s->prsn_sexo));

            $start = $start + 1;
            $total++;
        }

        
        //Contador de socios seleccionados

        $sheet->setCellValue('G5', 'Se encuentran un total de '.$total.' socios');
        $sheet->getColumnDimension('G')->setAutoSize(true);


        $styleThinBlackBorderOutline = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];

        $sheet->setAutoFilter('B1:E' . $start);
        //Font BOLD
        $sheet->getStyle('A1:E1')->getFont()->setBold(true);
        $sheet->getStyle('B1:E' . $start)->applyFromArray($styleThinBlackBorderOutline);
        //Alignment
        //fONT SIZE
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

        $filename = 'Socios ' . $fecha;
        ob_end_clean();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }



    private function reporte_carga($data)
    {



        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('B1', 'Rut Carga');
        $sheet->setCellValue('C1', 'Nombre');
        $sheet->setCellValue('D1', 'Edad');
        $sheet->setCellValue('E1', 'Sexo');
        $sheet->setCellValue('F1', 'Parentesco');
        $sheet->setCellValue('G1', 'Rut Socio');

        //$data =  $this->model_test->cargas_activosALL();
        $nro = 1;
        $start = 2;
        $total=0;
        foreach ($data as $c) {

            $sheet->setCellValue('B' . $start, $this->getPuntosRut($c->prsn_rut));
            $sheet->setCellValue('C' . $start, $c->prsn_nombres . " " . $c->prsn_apellidopaterno . " " . $c->prsn_apellidomaterno);
            $sheet->setCellValue('D' . $start, $this->getEdad($c->prsn_fechanacimi));
            $sheet->setCellValue('E' . $start, $this->getSexo($c->prsn_sexo));
            $sheet->setCellValue('F' . $start, $this->getParentestco($c->s_parentesco_pt_id));
            $sheet->setCellValue('G' . $start, $this->getPuntosRut($c->s_socios_prsn_rut));

            $start = $start + 1;
            $nro = $nro + 1;
            $total++;
        }

        $sheet->setCellValue('I5', 'Se encuentran un total de '.$total.' cargas');
        $sheet->getColumnDimension('I')->setAutoSize(true);



        $styleThinBlackBorderOutline = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];

        //Agregar Filtros
        $sheet->setAutoFilter('B1:G' . $start);
        //Fuente a Nregrita
        $sheet->getStyle('A1:G1')->getFont()->setBold(true);
        $sheet->getStyle('B1:G' . $start)->applyFromArray($styleThinBlackBorderOutline);
        //Aliniamientado centrado
        //Tamano letra
        $sheet->getStyle('A1:G2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A2:G' . $start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1:G' . $start)->getFont()->setSize(12);


        //Custom width for Individual Columns

        $columnas = array('B', 'C', 'D', 'E', 'F', 'G');

        foreach ($columnas as $col) {
            //$sheet->getColumnDimension($col)->setAutoSize(true);

            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        $fecha = date('d-m-Y H:i:s');

        $writer = new Xlsx($spreadsheet);

        $filename = 'Cargas ' . $fecha;
        ob_end_clean();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }





    public function reportes()
    {

        $informe = $this->input->post('infomeExcel');
        $genero = $this->input->post('genero');
        $min = $this->input->post('min');
        $max = $this->input->post('max');

        var_dump($informe);
        var_dump($genero);
        var_dump($min);
        var_dump($max);

    


        if ($informe == 'carga') {
            echo 'CARGA';
            echo $genero;

            $data =  $this->model_test->rangoC($min, $max, $genero);  

            
            //var_dump($data);

            $this->reporte_carga($data);




            
        }
        if ($informe == 'socio') {
            echo 'SOCIO';

            $data = $this->model_test->rangoS($min, $max, $genero);
            //var_dump($data);

            $this->reporte_socio($data);
        }
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
