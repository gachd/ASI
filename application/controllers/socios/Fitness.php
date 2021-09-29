<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Fitness extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();

        $this->load->library('session');

        $this->load->helper('url');

        $this->load->helper('form');

        $this->load->library('form_validation');

        $this->load->library('mpdf60/Mpdf');

        $this->load->model('model_socios');

        $this->load->model('model_accionistas');
    }


    public function index()
    {
        $result = [];
        $cargas = [];
        $socios = $this->model_socios->Info_All_Socios_Actios();

        for ($i = 0; $i < count($socios); $i++) {

            $result = $this->model_socios->cargas_del_socio($socios[$i]->prsn_rut);

            if (!empty($result)) {

                for ($j = 0; $j < count($result); $j++) {

                    array_push($cargas, $result[$j]);
                }
            }
        }

        for ($i = 0; $i < count($cargas); $i++) {
            array_push($socios, $cargas[$i]);
        }









        $data["socios"] = $socios;




        $this->load->view('plantilla/Head_v1');

        $this->load->view('socios/fitness/Index', $data);

        $this->load->view('plantilla/Footer');
    }

    public function buscarSocio()
    {

        $rut = $this->input->post('rut');
        $accion = $this->input->post('accion');

   

        if ($accion == "Ver") {


            $data['corporaciones'] = $this->model_socios->all_corporaciones();

            $data['rut'] = $rut;

            $data['datos_personales'] = $this->model_socios->persona($rut);

            $data['patrocinadores'] = $this->model_socios->patrocinadores($rut);

            $data['patrocinados'] = $this->model_socios->patrocinados($rut);

            $data['cargas'] = $this->model_socios->cargas($rut);

            $data['cuotas'] = $this->model_socios->cuotas($rut);

            $data['InfoSocio'] = $this->model_socios->InfoSocio($rut);

            $this->load->view('socios/fitness/ver_ficha', $data);
        }
        if ($accion == "Editar") {



            $data['corporaciones'] = $this->model_socios->all_corporaciones();

            $data['datos'] = $this->model_socios->persona($rut);

            $data['socioData'] = $this->model_socios->InfoSocio($rut);

            $data['sociosDatos'] = $this->model_socios->sociosDatos($rut);

            $data['patrocinadores'] = $this->model_socios->patrocinadores($rut);

            $data['patrocinados'] = $this->model_socios->patrocinados($rut);

            $data['cargas'] = $this->model_socios->cargas($rut);

            $data['cuotas'] = $this->model_socios->cuotas($rut);

            $data['estado_civil2'] = $this->model_socios->all_estadocivil();

            $data['nac'] = $this->model_socios->all_nacionalidades();

            $data['comuna'] = $this->model_socios->all_comunas();

            $data['condicion_lab'] = $this->model_socios->all_condicionlab();

            $data['condicion'] = $this->model_socios->all_condicion();

            $data['condicion2'] = $this->model_socios->all_condicion2();

            $data['tipo'] = $this->model_socios->all_tipo();

            $data['subCond'] = $this->model_socios->all_subcond();



            $this->load->view('socios/editar_socio', $data);
        }
    }
}
