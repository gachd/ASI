<?php
require 'vendor/autoload.php';
require_once APPPATH . '/vendor/autoload.php';
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

class InformesSocio extends CI_Controller
{



    function __construct()
    {

        parent::__construct();
        $this->load->library('session');
        $this->load->model('model_socios');
        $this->load->model('model_informe');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('mpdf60/Mpdf');
    }





    public function index()
    {

        $data['socios'] = $this->model_informe->activos();
        $data['cargas'] = $this->model_informe->cargas_activosALL();

        $this->load->view('plantilla/Head_v1');

        $this->load->view('socios/informes_index', $data);

        $this->load->view('plantilla/Footer');
    }

    function cargas_socio()


    {



        $activos = $this->model_informe->activos();
        $carga = $this->model_informe->cargas_activosALL();
        //var_dump($carga);

        $data['socios'] = $activos;


        foreach ($activos as $s) {

            echo '<h1>Socio</h1>';

            var_dump($s);

            echo '<h2>carga</h2>';

            $cargas = $this->model_informe->cargas_activos($s->prsn_rut);
            if (empty($cargas)) {

                echo '<h1>SIN CARGAS</h1>';


            }else{foreach ($cargas as $c) {
                var_dump($c);
            }}
        }
    }


    private function reporte_socio($data)
    {



        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('B1', 'RUT');
        $sheet->setCellValue('C1', 'Nombre');
        $sheet->setCellValue('D1', 'Edad');
        $sheet->setCellValue('E1', 'Sexo');
        $sheet->setCellValue('F1', 'Correo');

        //$data =  $this->model_informe->activos();
        $total = 0;

        $start = 2;
        foreach ($data as $s) {

            $sheet->setCellValue('B' . $start, $this->getPuntosRut($s->prsn_rut));
            $sheet->setCellValue('C' . $start, $s->prsn_nombres . " " . $s->prsn_apellidopaterno . " " . $s->prsn_apellidomaterno);
            $sheet->setCellValue('D' . $start, $this->getEdad($s->prsn_fechanacimi));
            $sheet->setCellValue('E' . $start, $this->getSexo($s->prsn_sexo));
            $sheet->setCellValue('F' . $start, $s->prsn_email);

            $start = $start + 1;
            $total++;
        }
        $start = $start - 1;


        //Contador de socios seleccionados

        $sheet->setCellValue('G5', 'Se encuentran un total de ' . $total . ' socios');
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
        $sheet->getStyle('A1:F1')->getFont()->setBold(true);
        $sheet->getStyle('B1:F' . $start)->applyFromArray($styleThinBlackBorderOutline);
        //Alignment
        //fONT SIZE
        $sheet->getStyle('A1:F2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A2:F' . $start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1:F' . $start)->getFont()->setSize(12);


        //Custom width for Individual Columns
        $columnas = array('B', 'C', 'D', 'E', 'F');

        foreach ($columnas as $col) {
            //$sheet->getColumnDimension($col)->setAutoSize(true);
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $fecha = date('d-m-Y H:i:s');

        $writer = new Xlsx($spreadsheet);

        //nombre archivo
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

        //$data =  $this->model_informe->cargas_activosALL();
        $nro = 1;
        $start = 2;
        $total = 0;
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
        $start = $start - 1;

        $sheet->setCellValue('I5', 'Se encuentran un total de ' . $total . ' cargas');
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

        if ($max < $min || $min == $max) {
            $this->session->set_flashdata('rango', 'fail');
            redirect('socios/InformesSocio');
        } else {

            if ($informe == 'carga') {


                $data =  $this->model_informe->rangoC($min, $max, $genero);

                if (empty($data)) {


                    $this->session->set_flashdata('carga', 'vacia');
                    redirect('socios/InformesSocio');
                } else {

                    $this->reporte_carga($data);
                }


                //var_dump($data);







            }
            if ($informe == 'socio') {
                echo 'SOCIO';

                $data = $this->model_informe->rangoS($min, $max, $genero);

                if (empty($data)) {


                    $this->session->set_flashdata('socio', 'vacia');
                    redirect('socios/InformesSocio');
                } else {



                    $this->reporte_socio($data);
                }
            }
        }
    }

    public function sociocarga_pdf($corp)


    {


        $data['corp']=$corp;



        $cabecera = "";
        //$pie = "<div>Pág {PAGENO}/{nb}</div>";
        $orientacion = "P";

        switch ($corp) {
            case 1:
                $activos = $this->model_informe->activos();
                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_socio+carga', $data, true);
                break;
            case 2:
                $rutCorp="65106820-7";
                $activos = $this->model_informe->activos_corp($rutCorp);

                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_socio+carga', $data, true);

                break;
            case 3:
                $rutCorp="65467840-5";
                $activos = $this->model_informe->activos_corp($rutCorp);

                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_socio+carga', $data, true);

                break;
            case 4:
                $rutCorp="70331500-3";
                $activos = $this->model_informe->activos_corp($rutCorp);

                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_socio+carga', $data, true);

                break;
            case 5:
                $rutCorp="71888800-k";
                $activos = $this->model_informe->activos_corp($rutCorp);

                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_socio+carga', $data, true);

                break;
            case 6:
                $rutCorp="72265900-7";
                $activos = $this->model_informe->activos_corp($rutCorp);

                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_socio+carga', $data, true);

                break;
        }
        ob_end_clean();
        $html = html_entity_decode($html);

        $mpdf = new \Mpdf\Mpdf(['debug' => true]);
        $mpdf->AddPage($orientacion);
        $mpdf->SetHTMLHeader($cabecera);
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->WriteHTML($html);

        $mpdf->Output();
    }

    public function rangoSocio_pdf($corp,$sexo,$min,$max)


    {


        $data['corp']=$corp;



        $cabecera = "";
        //$pie = "<div>Pág {PAGENO}/{nb}</div>";
        $orientacion = "P";

        switch ($corp) {
            case 1:
                $activos = $this->model_informe->consolidado_rangoS($min, $max, $sexo);
                
                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_socio', $data, true);
                break;
            case 2:
                $rutCorp="65106820-7";
                $activos = $this->model_informe->corp_rangoS($min,$max,$sexo,$rutCorp);

                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_socio', $data, true);

                break;
            case 3:
                $rutCorp="65467840-5";
                $activos = $this->model_informe->corp_rangoS($min,$max,$sexo,$rutCorp);

                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_socio', $data, true);

                break;
            case 4:
                $rutCorp="70331500-3";
                $activos = $this->model_informe->corp_rangoS($min,$max,$sexo,$rutCorp);

                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_socio', $data, true);

                break;
            case 5:
                $rutCorp="71888800-k";
                $activos = $this->model_informe->corp_rangoS($min,$max,$sexo,$rutCorp);

                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_socio', $data, true);

                break;
            case 6:
                $rutCorp="72265900-7";
                $activos = $this->model_informe->corp_rangoS($min,$max,$sexo,$rutCorp);

                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_socio', $data, true);

                break;
        }
        ob_end_clean();
        $html = html_entity_decode($html);

        $mpdf = new \Mpdf\Mpdf(['debug' => true]);
        $mpdf->AddPage($orientacion);
        $mpdf->SetHTMLHeader($cabecera);
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->WriteHTML($html);

        $mpdf->Output();
    }


    public function mayorSocio_pdf($corp,$sexo,$mayor)


    {


        $data['corp']=$corp;



        $cabecera = "";
        //$pie = "<div>Pág {PAGENO}/{nb}</div>";
        $orientacion = "P";

        switch ($corp) {
            case 1:
                $activos = $this->model_informe->consolidado_mayorS($mayor, $sexo);
                
                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_socio', $data, true);
                break;
            case 2:
                $rutCorp="65106820-7";
                $activos = $this->model_informe->corp_mayorS($mayor, $sexo,$rutCorp);

                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_socio', $data, true);

                break;
            case 3:
                $rutCorp="65467840-5";
                $activos = $this->model_informe->corp_mayorS($mayor, $sexo,$rutCorp);

                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_socio', $data, true);

                break;
            case 4:
                $rutCorp="70331500-3";
                $activos = $this->model_informe->corp_mayorS($mayor, $sexo,$rutCorp);

                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_socio', $data, true);

                break;
            case 5:
                $rutCorp="71888800-k";
                $activos = $this->model_informe->corp_mayorS($mayor, $sexo,$rutCorp);

                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_socio', $data, true);

                break;
            case 6:
                $rutCorp="72265900-7";
                $activos = $this->model_informe->corp_mayorS($mayor, $sexo,$rutCorp);

                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_socio', $data, true);

                break;
        }
        ob_end_clean();
        $html = html_entity_decode($html);

        $mpdf = new \Mpdf\Mpdf(['debug' => true]);
        $mpdf->AddPage($orientacion);
        $mpdf->SetHTMLHeader($cabecera);
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->WriteHTML($html);

        $mpdf->Output();
    }

    public function menorSocio_pdf($corp,$sexo,$menor)


    {


        $data['corp']=$corp;



        $cabecera = "";
        //$pie = "<div>Pág {PAGENO}/{nb}</div>";
        $orientacion = "P";

        switch ($corp) {
            case 1:
                $activos = $this->model_informe->consolidado_menorS($menor, $sexo);
                
                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_socio', $data, true);
                break;
            case 2:
                $rutCorp="65106820-7";
                $activos = $this->model_informe->corp_menorS($menor, $sexo,$rutCorp);

                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_socio', $data, true);

                break;
            case 3:
                $rutCorp="65467840-5";
                $activos = $this->model_informe->corp_menorS($menor, $sexo,$rutCorp);

                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_socio', $data, true);

                break;
            case 4:
                $rutCorp="70331500-3";
                $activos = $this->model_informe->corp_menorS($menor, $sexo,$rutCorp);

                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_socio', $data, true);

                break;
            case 5:
                $rutCorp="71888800-k";
                $activos = $this->model_informe->corp_menorS($menor, $sexo,$rutCorp);

                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_socio', $data, true);

                break;
            case 6:
                $rutCorp="72265900-7";
                $activos = $this->model_informe->corp_menorS($menor, $sexo,$rutCorp);

                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_socio', $data, true);

                break;
        }
        ob_end_clean();
        $html = html_entity_decode($html);

        $mpdf = new \Mpdf\Mpdf(['debug' => true]);
        $mpdf->AddPage($orientacion);
        $mpdf->SetHTMLHeader($cabecera);
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->WriteHTML($html);

        $mpdf->Output();
    }









    public function rangoCarga_pdf($corp,$sexo,$min,$max)


    {


        $data['corp']=$corp;



        $cabecera = "";
        //$pie = "<div>Pág {PAGENO}/{nb}</div>";
        $orientacion = "P";

        switch ($corp) {
            case 1:
                $activos = $this->model_informe->consolidado_rangoC($min, $max, $sexo);
                
                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_carga', $data, true);
                break;
            case 2:
                $rutCorp="65106820-7";
                $activos = $this->model_informe->corp_rangoC($min,$max,$sexo,$rutCorp);

                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_carga', $data, true);

                break;
            case 3:
                $rutCorp="65467840-5";
                $activos = $this->model_informe->corp_rangoC($min,$max,$sexo,$rutCorp);

                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_carga', $data, true);

                break;
            case 4:
                $rutCorp="70331500-3";
                $activos = $this->model_informe->corp_rangoC($min,$max,$sexo,$rutCorp);

                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_carga', $data, true);

                break;
            case 5:
                $rutCorp="71888800-k";
                $activos = $this->model_informe->corp_rangoC($min,$max,$sexo,$rutCorp);

                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_carga', $data, true);

                break;
            case 6:
                $rutCorp="72265900-7";
                $activos = $this->model_informe->corp_rangoC($min,$max,$sexo,$rutCorp);

                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_carga', $data, true);
                

                break;
        }
        ob_end_clean();
        $html = html_entity_decode($html);
        

        $mpdf = new \Mpdf\Mpdf(['debug' => true]);
        $mpdf->AddPage($orientacion);
        $mpdf->SetHTMLHeader($cabecera);
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->WriteHTML($html);

       $mpdf->Output();
    }



    public function mayorCarga_pdf($corp,$sexo,$mayor)


    {


        $data['corp']=$corp;



        $cabecera = "";
        //$pie = "<div>Pág {PAGENO}/{nb}</div>";
        $orientacion = "P";

        switch ($corp) {
            case 1:
                $activos = $this->model_informe->consolidado_mayorC($mayor, $sexo);
                
                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_carga', $data, true);
                break;
            case 2:
                $rutCorp="65106820-7";
                $activos = $this->model_informe->corp_mayorC($mayor, $sexo,$rutCorp);

                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_carga', $data, true);

                break;
            case 3:
                $rutCorp="65467840-5";
                $activos = $this->model_informe->corp_mayorC($mayor, $sexo,$rutCorp);

                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_carga', $data, true);

                break;
            case 4:
                $rutCorp="70331500-3";
                $activos = $this->model_informe->corp_mayorC($mayor, $sexo,$rutCorp);

                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_carga', $data, true);

                break;
            case 5:
                $rutCorp="71888800-k";
                $activos = $this->model_informe->corp_mayorC($mayor, $sexo,$rutCorp);

                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_carga', $data, true);

                break;
            case 6:
                $rutCorp="72265900-7";
                $activos = $this->model_informe->corp_mayorC($mayor, $sexo,$rutCorp);

                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_carga', $data, true);

                break;
        }
        ob_end_clean();
        $html = html_entity_decode($html);

        $mpdf = new \Mpdf\Mpdf(['debug' => true]);
        $mpdf->AddPage($orientacion);
        $mpdf->SetHTMLHeader($cabecera);
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->WriteHTML($html);

        $mpdf->Output();
    }


    public function menorCarga_pdf($corp,$sexo,$menor)


    {


        $data['corp']=$corp;



        $cabecera = "";
        //$pie = "<div>Pág {PAGENO}/{nb}</div>";
        $orientacion = "P";

        switch ($corp) {
            case 1:
                $activos = $this->model_informe->consolidado_menorC($menor, $sexo);
                
                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_carga', $data, true);
                break;
            case 2:
                $rutCorp="65106820-7";
                $activos = $this->model_informe->corp_menorC($menor, $sexo,$rutCorp);

                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_carga', $data, true);

                break;
            case 3:
                $rutCorp="65467840-5";
                $activos = $this->model_informe->corp_menorC($menor, $sexo,$rutCorp);

                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_carga', $data, true);

                break;
            case 4:
                $rutCorp="70331500-3";
                $activos = $this->model_informe->corp_menorC($menor, $sexo,$rutCorp);

                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_carga', $data, true);

                break;
            case 5:
                $rutCorp="71888800-k";
                $activos = $this->model_informe->corp_menorC($menor, $sexo,$rutCorp);

                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_carga', $data, true);

                break;
            case 6:
                $rutCorp="72265900-7";
                $activos = $this->model_informe->corp_menorC($menor, $sexo,$rutCorp);

                $data['activos']=$activos;
                $html = $this->load->view('socios\informes\informe_carga', $data, true);

                break;
        }
        ob_end_clean();
        $html = html_entity_decode($html);

        $mpdf = new \Mpdf\Mpdf(['debug' => true]);
        $mpdf->AddPage($orientacion);
        $mpdf->SetHTMLHeader($cabecera);
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->WriteHTML($html);

        $mpdf->Output();
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
