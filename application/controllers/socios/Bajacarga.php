<?php

//defined('BASEPATH') OR exit('No direct script access allowed');



class bajaCarga extends CI_Controller
{



  function __construct()
  {

    parent::__construct();

    $this->load->library('session');

    $this->load->model('model_socios');

    $this->load->helper('url');

    $this->load->helper('form');

    $this->load->library('form_validation');

    $this->load->library('calendar');

    $this->load->library('session');
  }



  public function index()
  {

    $date  = "";

    $data['personas']  = $this->model_socios->all_personas($date);

    $data['nacionalidad']  = $this->model_socios->all_nacionalidades($date);

    $data['comunas']  = $this->model_socios->all_comunas($date);

    $data['laboral']  = $this->model_socios->all_condicionlab($date);

    $data['estado_civil']  = $this->model_socios->all_estadocivil($date);

    $data['corporacion'] = $this->model_socios->all_corporaciones();

    $data['socio_pat'] = $this->model_socios->all_sociospat();

    $data['parentesco'] = $this->model_socios->all_parentesco();



    $this->load->view('plantilla/Head');

    $this->load->view('socios/bajaCarga', $data);

    $this->load->view('plantilla/Footer');
  }



  public function mostrar_datos()
  {

    // $rut_socio= $this->uri->segment('4');

    $rut = $this->input->post('rut');



    //    $paso = $this->input->post('enviar');



    $Activo = $this->model_socios->es_Socio($rut);


    if ($Activo) {


      $data['corporaciones'] = $this->model_socios->all_corporaciones();



      $data['datos'] = $this->model_socios->persona($rut);

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

      $data['parentesco'] = $this->model_socios->all_parentesco();





      $this->load->view('socios/baja_Carga', $data);
    } else {


      header('HTTP/1.1 500 Internal Server Booboo');
      header('Content-Type: application/json; charset=UTF-8');
      die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
    }
  }



  public function datosCarga()
  {



    $rutCarga = $_POST['rutCarga'];

    $rutSocio = $_POST['rutSocio'];



    $cargas = $this->model_socios->cargas($rutSocio);

    $cargasSocios = $this->model_socios->cargasSocios($rutSocio, $rutCarga);

    if ($cargasSocios) {

      $datosCargas = $this->model_socios->persona($rutCarga);

      $parentesco = $this->model_socios->all_parentesco();



      $data["rutCarga"] = $rutCarga;


      $data["cargasSocios"] = $cargasSocios;


      $this->load->view('socios/bajaCarga_datosCarga', $data);
    } else {

      header('HTTP/1.1 500 Internal Server Booboo');
      header('Content-Type: application/json; charset=UTF-8');
      die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
    }
  }



  public function baja_carga()
  {





    $fecha = date('Y-m-d');

    $rutCarga    = $_POST['rutCarga'];
    $obs_anterior = "";



    $consultar_obs =  $this->model_socios->consultar_obs($rutCarga);

    foreach ($consultar_obs as $cs) {

      $obs_anterior .= $cs->obs_estado;
    }



    $estado   = $_POST['estado'];



    if (!empty($obs_anterior)) {

      $obs    = $fecha . '-[' . $_POST['obs'] . ']';

      $obs_final = $obs_anterior . '/' . $obs;
    } else {

      $obs_final = $fecha . '-[' . $_POST['obs'] . ']';
    }



    //  $obs_final = $obs_anterior



    $data_carg = array(

      'estado_carga' => $estado,

      'obs_estado' => $obs_final
    );


    $this->model_socios->actualizar_carg($data_carg, $rutCarga);
  }
}
