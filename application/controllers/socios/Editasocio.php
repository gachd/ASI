<?php class  editasocio extends CI_Controller
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

    $this->load->view('plantilla/Head');

    $this->load->view('socios/editasocio', $data);

    $this->load->view('plantilla/Footer');
  }

  public function mostrar_socio()
  {



    // $rut_socio= $this->uri->segment('4');

    $rut = $this->input->post('rut');

    $Activo = $this->model_socios->es_Socio($rut);


    if ($Activo) {

      //Valida que exista el socio


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
      
    } else {


      header('HTTP/1.1 500 Internal Server Booboo');
      header('Content-Type: application/json; charset=UTF-8');
      die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
    }
  } //fin funcion mostrar_socio




  public function actSocio()
  {

    $rut_socio  = $this->input->post('rut');


    //valido que existan archivos para subir
    if (isset($_FILES["archivosSoc"])) {


      $archivosSoc = $_FILES["archivosSoc"];

      $this->Subir_Archivos_Socio($rut_socio, $archivosSoc);
    }

    if ($_POST['val_foto'] == 1) {

      var_dump($_FILES["foto"]);

      $this->Subir_foto_Socio($rut_socio, $_FILES["foto"]);
    }



    $path = 'archivos/socios/' . $rut_socio;






    $prsn_id = $this->model_socios->IdPersona($rut_socio);





    $arr = json_decode($_POST['arr']);



    // $deportes = json_decode($arr,true);

    // var_dump($deportes);

    // echo $rut;

    $deportes = implode(", ", $arr);

    //echo $deportes;

    $datadp = array('int_deport' => $deportes);



    foreach ($prsn_id as $row_is) {

      $Id = $row_is->prsn_id;
    }

    $data = array(

      'prsn_id' =>  $Id,

      'prsn_rut' => $rut_socio,

      'prsn_apellidopaterno' => $paterno = $this->input->post('paterno'),

      'prsn_apellidomaterno' => $materno = $this->input->post('materno'),

      'prsn_nombres' => $nombres = $this->input->post('nombres'),

      'prsn_fechanacimi' => $fecha_nac = $this->input->post('fecha_nac'),

      'prsn_sexo' => $sexo = $this->input->post('sexo'),

      'prsn_descendiente' => $desc = $this->input->post('desc'),

      'prsn_direccion' =>  $direc = $this->input->post('direc'),

      'prsn_sectorvive' => $sector = $this->input->post('sector'),

      'prsn_email' =>  $email = $this->input->post('email'),

      'prsn_fono_casa' => $tel_fijo = $this->input->post('tel_fijo'),

      'prsn_fono_movil' => $tel_cel = $this->input->post('tel_cel'),

      'prsn_fono_trabajo' => $tel_emp  = $this->input->post('tel_emp'),

      'prsn_profesion' => $prof = $this->input->post('prof'),

      'prsn_tipo' => $prsn_tipo = 0,

      'prsn_direccion_empresa' => $direc_emp = $this->input->post('direc_emp'),

      'prsn_foto' => $prsn_foto = 0,

      'prsn_fallecido' => $prsn_fallecido = 0,

      'prsn_empresa' => $emp = $this->input->post('emp'),

      's_nacionalidades_nac_id' => $nacionalidad = $this->input->post('nacionalidad'),

      's_condicion_laboral_condlab_id' => $laboral = $this->input->post('laboral'),

      's_estado_civil_estacivil_id' => $estadocivil = $this->input->post('estadocivil'), //persona natural

      's_comunas_comuna_id' => $comu = $this->input->post('comu'),

      'prsn_nac' => $nac = $this->input->post('nac'),


    );


    $dataS = array(

      'path' => $path,

    );



    $this->model_socios->actualizarSocio($data, $rut_socio); //ACTUALIZAR s_PERSONAS

    $this->model_socios->updateSocio($dataS, $rut_socio); //ACTUALIZAR s_socios

    $this->model_socios->ins_depor($rut_socio, $datadp);
  }


  //private



  private function Subir_Archivos_Socio($user, $archivo)
  {


    $formatos = array('jpg', 'png', 'jpeg', 'gif', 'pdf');

    $fecha = date("Y.m.d_");



    $Dir_archivos = 'archivos/socios/'; //carpeta donde se guadaran todos los archivos subidos del sistema.


    foreach ($archivo['tmp_name'] as $key => $tmp_name) {
      //condicional si el fichero existe

      if ($archivo["name"][$key]) {
        // Nombres de archivos de temporales


        $archivonombre = $fecha . $archivo["name"][$key];

        $fuente = $archivo["tmp_name"][$key];

        $carpeta = $Dir_archivos . $user . '/docs/'; //Declaramos el nombre de la carpeta que guardara los archivos

        if (!file_exists($carpeta)) {

          mkdir($carpeta, 0777, true) or die("Hubo un error al crear el directorio de almacenamiento");
          index_archivos($carpeta);
        }


        //Abrimos el directorio
        $dir = opendir($carpeta);

        $path_archivo = $carpeta . '/' . $archivonombre; //indicamos la ruta de destino de los archivos

        $Tipo_archivo = pathinfo($path_archivo, PATHINFO_EXTENSION);



        if (in_array($Tipo_archivo, $formatos)) {

          if (move_uploaded_file($fuente, $path_archivo)) {

            echo "El archivo $archivonombre se han cargado de forma correcta.<br>";
          } else {

            echo "Se ha producido un error, por favor revise los archivos e intentelo de nuevo.<br>";
          }
        } else {

          echo "Formato del archivo $archivonombre no valido.<br>";
        }

        closedir($dir); //Cerramos la conexion con la carpeta destino


      }
    }
  }


  private function Subir_foto_Socio($rut_socio, $archivo)
  {

    $fecha = date("Y.m.d_");

    $formatos = array('jpg', 'png', 'jpeg', 'gif');

    $Dir_archivos = 'archivos/socios/' . $rut_socio . '/perfil/';

    $archivonombre =  $fecha . $archivo["name"];

    $fuente = $archivo["tmp_name"];

    if (!file_exists($Dir_archivos)) {

      mkdir($Dir_archivos, 0777, true) or die("Hubo un error al crear el directorio de almacenamiento");
      index_archivos($Dir_archivos);
    }


    $dir = opendir($Dir_archivos);

    $path_archivo = $Dir_archivos . $archivonombre; //indicamos la ruta de destino de los archivos

    $Tipo_archivo = pathinfo($path_archivo, PATHINFO_EXTENSION);


    if (in_array($Tipo_archivo, $formatos)) {

      if (move_uploaded_file($fuente, $path_archivo)) {

        echo "El archivo $archivonombre se han cargado de forma correcta.<br>";
      } else {

        echo "Se ha producido un error, por favor revise los archivos e intentelo de nuevo.<br>";
      }
    } else {

      echo "Formato del archivo $archivonombre no valido.<br>";
    }

    closedir($dir); //Cerramos la conexion con la carpeta destino



  }
}//fin CI_controller
