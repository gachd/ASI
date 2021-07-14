<?php

require_once APPPATH . '/vendor/autoload.php';

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

        $data['socios']=$activos;


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


    function socioExcel()
    {
        $activos = $this->model_test->activos();

        $this->export_excel->to_excel($activos, 'listado Socio');



    }
    function cargaExcel()
    {

        $carga = $this->model_test->cargas_activosALL();

        $this->export_excel->to_excel($carga, 'listado Carga');


    }
}
