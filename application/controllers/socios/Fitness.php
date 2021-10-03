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

        $this->load->model('fitness_model');
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


      

            $data['rut'] = $rut;

            $data['datos_personales'] = $this->model_socios->persona($rut);     
            $data['fitness'] = $this->fitness_model->datosBeneficiario($rut);     

  

            $this->load->view('socios/fitness/ver_ficha', $data);
        }
        if ($accion == "Editar") {



            $data['rut'] = $rut;
            $data['datos'] = $this->model_socios->persona($rut);
            $data['fitness'] = $this->fitness_model->datosBeneficiario($rut);     





            $this->load->view('socios/fitness/editar_beneficiario', $data);
        }
    }

    public function agregarDatos()
    {



        $rut = $this->input->post("");
        $estatura = $this->input->post("");
        $peso = $this->input->post("");
        $imc = $this->input->post("");
        $fono_emergencia = $this->input->post("");
        $patologias_base = $this->input->post("");
        $pc_bicipital = $this->input->post("");
        $pc_tricipital = $this->input->post("");
        $pc_subescapular = $this->input->post("");
        $pc_suprailiaco = $this->input->post("");
        $pc_muslo = $this->input->post("");
        $pc_abdominal = $this->input->post("");
        $pc_pecho = $this->input->post("");
        $pc_axilar = $this->input->post("");
        $pc_pierna = $this->input->post("");
        $objetivos = $this->input->post("");



        $data = array(
            'fitness_prsn_rut' => $rut,
            'estatura'  => $estatura,
            'peso'  => $peso,
            'imc'  => $imc,
            'fono_emergencia'  => $fono_emergencia,
            'patologias_base'  => $patologias_base,
            'pc_bicipital'  => $pc_bicipital,
            'pc_tricipital'  => $pc_tricipital,
            'pc_subescapular'  => $pc_subescapular,
            'pc_suprailiaco'  => $pc_suprailiaco,
            'pc_muslo'  => $pc_muslo,
            'pc_abdominal'  => $pc_abdominal,
            'pc_pecho'  => $pc_pecho,
            'pc_axilar'  => $pc_axilar,
            'pc_pierna'  => $pc_pierna,
            'objetivos'  => $objetivos
        );


        $validar = $this->fitness_model->agregarBeneficiario($data);
    }


    public function actualizarDatos()
    {



        $rut = $this->input->post("");
        $estatura = $this->input->post("");
        $peso = $this->input->post("");
        $imc = $this->input->post("");
        $fono_emergencia = $this->input->post("");
        $patologias_base = $this->input->post("");
        $pc_bicipital = $this->input->post("");
        $pc_tricipital = $this->input->post("");
        $pc_subescapular = $this->input->post("");
        $pc_suprailiaco = $this->input->post("");
        $pc_muslo = $this->input->post("");
        $pc_abdominal = $this->input->post("");
        $pc_pecho = $this->input->post("");
        $pc_axilar = $this->input->post("");
        $pc_pierna = $this->input->post("");
        $objetivos = $this->input->post("");



        $data = array(

            'fitness_prsn_rut' => $rut,
            'estatura'  => $estatura,
            'peso'  => $peso,
            'imc'  => $imc,
            'fono_emergencia'  => $fono_emergencia,
            'patologias_base'  => $patologias_base,
            'pc_bicipital'  => $pc_bicipital,
            'pc_tricipital'  => $pc_tricipital,
            'pc_subescapular'  => $pc_subescapular,
            'pc_suprailiaco'  => $pc_suprailiaco,
            'pc_muslo'  => $pc_muslo,
            'pc_abdominal'  => $pc_abdominal,
            'pc_pecho'  => $pc_pecho,
            'pc_axilar'  => $pc_axilar,
            'pc_pierna'  => $pc_pierna,
            'objetivos'  => $objetivos
        );


        $validar = $this->fitness_model->actualizarBeneficiario($rut,$data);

    }




    
}
