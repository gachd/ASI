<?php class  cambiacond extends CI_Controller
{



  function __construct()
  {

    parent::__construct();

    $this->load->library('session');

    $this->load->helper('url');

    $this->load->helper('form');

    $this->load->library('form_validation');

    $this->load->library('session');

    $this->load->library('mpdf60/Mpdf');

    $this->load->model('model_socios');
  }

  public function index()
  {

    $data['personas'] = $this->model_socios->all_personas();

    $this->load->view('plantilla/Head_v1');

    $this->load->view('socios/cambiacond', $data);

    $this->load->view('plantilla/Footer');
  }



  public function mostrar_socio()
  {

    // $rut_socio= $this->uri->segment('4');

    $rut = $this->input->post('rut');
    $Activo = $this->model_socios->es_Activo($rut);

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



    $this->load->view('socios/cambiar_cond', $data);
   
    } else {

      header('HTTP/1.1 500 Internal Server Booboo');
      header('Content-Type: application/json; charset=UTF-8');
      die(json_encode(array('message' => 'ERROR', 'code' => 1337)));


    }
  
  } //fin funcion mostrar_socio



  public function cargar_doc()
  {

    $rutSocio = $_POST['rut'];

    $fecha = $_POST['fecha'];

    $cond = $_POST['cond'];

    $cond2 = $_POST['cond2'];

    $tipo = $_POST['tipo'];

    $obs = $_POST['obs'];

    $DATA = json_decode($_POST['data']);



    for ($i = 0; $i < count($DATA); $i++) {

      //$micarpeta = 0;

      $rut_corp = $DATA[$i]->rut_corp;



      // $fecha_actual = date("Y-m-d");

      $micarpeta = './docSocios/' . $rutSocio . '/' . $rut_corp;

      //  echo $micarpeta;

      if (!file_exists($micarpeta)) {

        mkdir($micarpeta, 0777, true);
      }



      $id_socio = $this->model_socios->IdSocioCorp($rutSocio, $rut_corp);

      foreach ($id_socio as $row_idsocio) {

        $id_socioNew = $row_idsocio->id_socio;
      }

      $datos = array(



        'motivo_resol' => 'BAJA SOCIO',

        'fecha_resol' => $fecha,

        's_socios_id_socio' => $id_socioNew,

        's_socios_prsn_rut' => $rutSocio,

        'obs_resol' => $obs,

        'arch_resol' => 1,

        'id_cond' => $cond,

        'id_cond2' => $cond2,

        'id_tipo' => $tipo
      );



      $id_resol = $this->model_socios->insertarResolucion($datos); //crea una nueva resolucion en la base de datos 



      //actualizar estado de socio

      $dataAct = array(

        'cond_id' => $cond,

        'cond2_id' => $cond2,

        'tipo_id' => $tipo,

        'fecha_retiro' => $fecha,

        'estado' => 1
      );

      $this->model_socios->act_estado($dataAct, $rut_corp, $rutSocio);



      //crea archivo respaldo

      $config['upload_path'] = $micarpeta;

      $config['file_name'] =  $id_resol;

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
