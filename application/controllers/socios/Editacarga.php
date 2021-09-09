<?php

//defined('BASEPATH') OR exit('No direct script access allowed');



class editaCarga extends CI_Controller
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





    $this->load->view('plantilla/Head_v1');

    $this->load->view('socios/editaCarga', $data);

    $this->load->view('plantilla/Footer');
  }



  public function mostrar_datos()
  {

    // $rut_socio= $this->uri->segment('4');

    $rut = $this->input->post('rut');

    $Activo = $this->model_socios->es_Activo($rut);



    //    $paso = $this->input->post('enviar');

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




      $this->load->view('socios/editar_Carga', $data);
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

    $datosCargas = $this->model_socios->persona($rutCarga);

    $parentesco = $this->model_socios->all_parentesco();


    if ($cargasSocios) {

      foreach ($cargasSocios as $cs) {

        $parent = $cs->s_parentesco_pt_id;

        $parent_nom = $cs->pt_nombre;

        $nombre = $cs->prsn_nombres;

        $paterno = $cs->prsn_apellidopaterno;

        $materno = $cs->prsn_apellidomaterno;

        $sexo = $cs->prsn_sexo;

        $nac = $cs->prsn_fechanacimi;

        $celu = $cs->prsn_fono_movil;

        $mail = $cs->prsn_email;

        $est = $cs->estudiante;

        $cert = $cs->certificado;







        if ($est == 1) {

          $estudia = 'SI';

          $estudia2 = 'NO';

          $est2 = 2;
        } else {

          $estudia = 'NO';

          $estudia2 = 'SI';

          $est2 = 1;
        }





        if ($sexo == 1) {

          $sexo_nom = 'MASCULINO';

          $sexo2 = 0;

          $sexo2_nom = 'FEMENINO';
        } else {

          $sexo_nom = 'FEMENINO';

          $sexo2 = 1;

          $sexo2_nom = 'MASCULINO';
        }
      }


      $data['sexo2_nom'] = $sexo2_nom;

      $data['sexo2'] = $sexo2;

      $data['sexo_nom'] = $sexo_nom;

      $data['est2'] = $est2;

      $data['estudia2'] = $estudia2;

      $data['estudia'] = $estudia;

      $data['cert'] = $cert;

      $data['mail'] = $mail;

      $data['celu'] = $celu;

      $data['nac'] = $nac;

      $data['materno'] = $materno;

      $data['paterno'] = $paterno;

      $data['nombre'] = $nombre;

      $data['parent_nom'] = $parent_nom;

      $data['parent_nom'] = $parent_nom;

      $data['parent'] = $parent;

      $data['parentesco'] = $parentesco;

      $data['datosCargas'] = $datosCargas;

      $data['parent'] = $parent;

      $data['cargas'] = $cargas;

      $data['rutCarga'] = $rutCarga;

      $data['sexo'] = $sexo;

      $data['est'] = $est;

      $data['rutSocio'] = $rutSocio;


      $this->load->view('socios/modificarCarga', $data);
    } else {

      header('HTTP/1.1 500 Internal Server Booboo');
      header('Content-Type: application/json; charset=UTF-8');
      die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
    }
  }



  public function test_foto_subir()

  {
    $this->load->view('socios/test_foto');


  }
  public function test_foto()
  {

   var_dump($_POST);

  

   

    if ($_POST['valido'] == 1) {
      $var_paso = 1;
    } else {
      $var_paso = 0;
    }


    if ($var_paso == 1) {
      echo 'entro';


      // $fecha_actual = date("Y-m-d");

      $micarpeta = 'docSocios/fotos/';



      if (!file_exists($micarpeta)) {

        mkdir($micarpeta, 0777, true);
      }

      $config['upload_path'] = $micarpeta;

      $config['file_name'] =  'fotito';

      $config['allowed_types'] = 'gif|jpg|png';

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
    else {
      echo 'error';
    }
    
  }


  



  public function editacarga()
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



    //$prsn_id = $this -> model_socios -> ultimoId();





    //Por cada objeto que encuentra en el array lo separa y crea una query

    //  $q[$i]         = "UPDATE TABLA SET CAMPO1 = '".."', CAMPO2 = '".$DATA[$i]->desc."' WHERE ID =".$DATA[$i]->id;    

    $rutCarga = $_POST['rutCarga'];



    $data = array(

      'prsn_apellidopaterno' => $_POST['paternoCarga'],

      'prsn_apellidomaterno' => $_POST['maternoCarga'],

      'prsn_nombres' => $_POST['nombreCarga'],

      'prsn_fechanacimi' => $_POST['fechaNac'],

      'prsn_sexo' => $_POST['sexo'],

      'prsn_email' =>  $_POST['mailCarga'],

      'prsn_fono_movil' => $_POST['celuCarga']
    );



    $this->model_socios->actCargaPers($data, $rutCarga);



    $fechanacimiento =  $_POST['fechaNac'];

    list($ano, $mes, $dia) = explode("-", $fechanacimiento);

    $ano_diferencia  = date("Y") - $ano;

    $mes_diferencia = date("m") - $mes;

    $dia_diferencia   = date("d") - $dia;

    if ($dia_diferencia < 0 && $mes_diferencia < 0) {

      $ano_diferencia--;
    }







    $carg_estud = $_POST['estudiante'];

    if ($carg_estud == 0 && $ano_diferencia > 18) {

      $estado_carga = 1;
    } else {

      $estado_carga = 0;
    }



    $data_carg = array(

      's_personas_prsn_rut' => $_POST['rutCarga'],

      's_socios_id_socio' => $id_s,

      's_socios_prsn_rut' => $rut_socio,

      's_parentesco_pt_id' => $_POST['parentesco'],

      'estado_carga' => $estado_carga,

      'obs_estado' => 0,

      'estudiante' => $_POST['estudiante'],

      'certificado' => $_POST['cert']
    );



    $this->model_socios->actualizar_carg($data_carg, $rutCarga);



    //$prsn_id = $prsn_id + 1;



    $rut_carga = $_POST['rutCarga'];



    if (!empty($_POST['doc'])) {
      $var_paso = 1;
    } else {
      $var_paso = 0;
    }


    if ($var_paso != 1) {
      echo 'entro';


      // $fecha_actual = date("Y-m-d");

      $micarpeta = './docSocios/' . $rut_socio . '/cargas/' . $rut_carga . '/';



      if (!file_exists($micarpeta)) {

        mkdir($micarpeta, 0777, true);
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
    } else {
      echo 'error';
    }
  }
}
