<?php

//defined('BASEPATH') OR exit('No direct script access allowed');



class nuevaCarga extends CI_Controller
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



    $date = '';



    $data['personas']  = $this->model_socios->all_personas($date);

    $data['nacionalidad']  = $this->model_socios->all_nacionalidades($date);

    $data['comunas']  = $this->model_socios->all_comunas($date);

    $data['laboral']  = $this->model_socios->all_condicionlab($date);

    $data['estado_civil']  = $this->model_socios->all_estadocivil($date);

    $data['corporacion'] = $this->model_socios->all_corporaciones();

    $data['socio_pat'] = $this->model_socios->all_sociospat();

    $data['parentesco'] = $this->model_socios->all_parentesco();





    $this->load->view('plantilla/Head');

    $this->load->view('socios/nuevaCarga', $data);

    $this->load->view('plantilla/Footer');
  }



  public function mostrar_datos()
  {

    // $rut_socio= $this->uri->segment('4');

    $rut = $this->input->post('rut');

    $paso = $this->input->post('enviar');



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



    if ($paso == 1) {

      $this->load->view('socios/agregaCarga', $data);
    }

    if ($paso == 2) {

      $this->load->view('socios/edita_Carga', $data);
    }
  }



  public function agregarCarga()
  {



    //$DATA     = json_decode($_POST['data']);

    $rut_socio    = $_POST['rutSocio'];



    $datos_socio = $this->model_socios->persona($rut_socio);



    foreach ($datos_socio as $dp) {

      $telefono = $dp->prsn_fono_casa;

      $fono_job = $dp->prsn_fono_trabajo;

      $direccion = $dp->prsn_direccion;

      $poblacion = $dp->prsn_sectorvive;

      $com_id = $dp->comuna_id;
    }



    $id_socio = $this->model_socios->getIdSocio($rut_socio); //Consulta para obtener id socio

    $primerRegistro = true;

    foreach ($id_socio as $row_idsocio) {

      if ($primerRegistro) {

        $id_s = $row_idsocio->id_socio;

        $primerRegistro = false; //Nos aseguramos que solo se ejecute una vez

      }
    }

    //print_r($DATA); die();

    //por cada uo de estos arrays vamos a crear una query para poder hacer un update en la base de datos. y para eso necesitamos recorrer el array por cada uno de sus posiciones



    $prsn_id = $this->model_socios->ultimoId();





    //Por cada objeto que encuentra en el array lo separa y crea una query

    //  $q[$i]         = "UPDATE TABLA SET CAMPO1 = '".."', CAMPO2 = '".$DATA[$i]->desc."' WHERE ID =".$DATA[$i]->id;    



    $data = array(

      'prsn_id' => $prsn_id = $prsn_id + 1,

      'prsn_rut' => $_POST['rutCarga'],

      'prsn_apellidopaterno' => $_POST['paternoCarga'],

      'prsn_apellidomaterno' => $_POST['maternoCarga'],

      'prsn_nombres' => $_POST['nombreCarga'],

      'prsn_fechanacimi' => $_POST['fechaNac'],

      'prsn_sexo' => $_POST['sexo'],

      'prsn_descendiente' => 3,

      'prsn_direccion' =>  $direccion,

      'prsn_sectorvive' => $poblacion,

      'prsn_email' =>  $_POST['mailCarga'],

      'prsn_fono_casa' => $telefono,

      'prsn_fono_movil' => $_POST['celuCarga'],

      'prsn_fono_trabajo' => $fono_job,

      'prsn_profesion' => 0,

      'prsn_tipo' => 0,

      'prsn_direccion_empresa' => 0,

      'prsn_foto' => 0,

      'prsn_fallecido' => 0,

      'prsn_empresa' => 0,

      's_nacionalidades_nac_id' => 1,

      's_condicion_laboral_condlab_id' => 5,

      's_estado_civil_estacivil_id' => 1,

      's_comunas_comuna_id' => $com_id,

      'prsn_nac' => 0
    ); //nacimiento  



    $this->model_socios->insertar($data);







    $data_carg = array(

      's_personas_prsn_rut' => $_POST['rutCarga'],

      's_socios_id_socio' => $id_s,

      's_socios_prsn_rut' => $rut_socio,

      's_parentesco_pt_id' => $_POST['parentesco'],

      'estado_carga' => 0,

      'obs_estado' => 0,

      'estudiante' => $_POST['estudiante'],

      'certificado' => $_POST['cert']
    );



    $this->model_socios->insertar_carg($data_carg);



    $prsn_id = $prsn_id + 1;



    $rut_carga = $_POST['rutCarga'];



    if (!empty($_POST['doc'])) {

      $var_paso = 1;
    } else {
      $var_paso = 0;
    }

    if ($var_paso != 1) {



      // $fecha_actual = date("Y-m-d");

      $micarpeta = './docSocios/' . $rut_socio . '/cargas/' . $rut_carga;

      echo $micarpeta;

      if (!file_exists($micarpeta)) {

        mkdir($micarpeta, 777);
      }

      $config['upload_path'] = $micarpeta;

      $config['file_name'] =  $rut_carga;

      $config['allowed_types'] = 'pdf';

      $config['max_size'] = 2048;



      $this->load->library('upload', $config);

      $this->upload->initialize($config);

      if (!$this->upload->do_upload('doc')) { #Aquí me refiero a "foto", el nombre que pusimos en FormData

        $error = array('error' => $this->upload->display_errors());

        echo json_encode($error);
      } else {

        echo json_encode(true);
      }
    }
  }
}
