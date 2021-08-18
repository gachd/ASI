<?php

//defined('BASEPATH') OR exit('No direct script access allowed');



class nuevo_socio extends CI_Controller
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




      $data['personas']   = $this->model_socios->all_personas($date);

      $data['nacionalidad']   = $this->model_socios->all_nacionalidades($date);

      $data['comunas']   = $this->model_socios->all_comunas($date);

      $data['laboral']   = $this->model_socios->all_condicionlab($date);

      $data['estado_civil']   = $this->model_socios->all_estadocivil($date);

      $data['corporacion'] = $this->model_socios->all_corporaciones();

      $data['socio_pat'] = $this->model_socios->all_sociospat();

      $data['parentesco'] = $this->model_socios->all_parentesco();






      $this->load->view('plantilla/Head_v1');

      //$this->load->view('socios/index', $data);

      $this->load->view('socios/agregarSocio', $data);

      $this->load->view('plantilla/Footer');
   }







   public function cargar_cert()
   {





      $mi_archivo = 'certificado';

      $config['upload_path'] = './uploads';

      $config['file_name'] = $this->input->post('rutCarga');

      $config['allowed_types'] = "*";

      $config['max_size'] = "50000";

      $config['max_width'] = "2000";

      $config['max_height'] = "2000";



      $this->load->library('upload', $config);



      if (!$this->upload->do_upload($mi_archivo)) {

         //*** ocurrio un error

         $error = $this->upload->display_errors();

         // $this->load->view('socios/index', $error);



         // echo $this->upload->display_errors();

         //return;

      }



      $data['uploadSuccess'] = $this->upload->data();
   }





   public function newsocio()
   {

      $this->form_validation->set_error_delimiters('<div class="error alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');



      $data['nacionalidad'] = $this->model_socios->all_nacionalidades();

      $data['estado_civil'] = $this->model_socios->all_estadocivil();

      $data['comunas'] = $this->model_socios->all_comunas();

      $data['corporacion'] = $this->model_socios->all_corporaciones();

      $data['socio_pat'] = $this->model_socios->all_sociospat();

      $data['parentesco'] = $this->model_socios->all_parentesco();

      $this->load->view('socios/index', $data);
   }








   public function ValidaSocio()
   {
      $rut = $_POST['rut'];
      $valida = $this->model_socios->ValidarSocio($rut);
      echo $valida;
   }








   public function test()
   {



      $date  = "";




      $data['personas']   = $this->model_socios->all_personas($date);

      $data['nacionalidad']   = $this->model_socios->all_nacionalidades($date);

      $data['comunas']   = $this->model_socios->all_comunas($date);

      $data['laboral']   = $this->model_socios->all_condicionlab($date);

      $data['estado_civil']   = $this->model_socios->all_estadocivil($date);

      $data['corporacion'] = $this->model_socios->all_corporaciones();

      $data['socio_pat'] = $this->model_socios->all_sociospat();

      $data['parentesco'] = $this->model_socios->all_parentesco();






      $this->load->view('plantilla/Head_v1');

      $this->load->view('socios/agregarSocio', $data);

      $this->load->view('plantilla/Footer');
   }




   public function nuevo_socio_agregar()
   {


      $DatosP = json_decode($_POST['DatosP']);
      $DatosDeportes = json_decode($_POST['DatosDeportes']);
      $DatosCorp = json_decode($_POST['DatosCorp']);
      $DatosCargas = json_decode($_POST['DatosCargas']);

      $this->agregarSocio($DatosP);
      $this->agregarDep($DatosDeportes);
      $this->reg_Socio($DatosCorp);
      $this->agregaCarga($DatosCargas);

      
   }








   //funciones private




   private function agregarSocio($DatosP)
   {



      $prsn_id = $this->model_socios->ultimoId();



      $data = array(

         'prsn_id' => $prsn_id = $prsn_id + 1,

         'prsn_rut' => $rut_socio  =  $DatosP->rut,  //$this->input->post('rut'),

         'prsn_apellidopaterno' => $paterno =$DatosP->paterno,  // $this->input->post('paterno'),

         'prsn_apellidomaterno' => $materno =$DatosP->materno,  // $this->input->post('materno'),

         'prsn_nombres' => $nombres = $DatosP->nombres,  // $this->input->post('nombres'),

         'prsn_fechanacimi' => $fecha_nac = $DatosP->fecha_nac,  // $this->input->post('fecha_nac'),

         'prsn_sexo' => $sexo = $DatosP->sexo,  // $this->input->post('sexo'),

         'prsn_descendiente' => $desc =$DatosP->desc,  // $this->input->post('desc'),

         'prsn_direccion' =>  $direc = $DatosP->direc,  // $this->input->post('direc'),

         'prsn_sectorvive' => $sector = $DatosP->sector,  //$this->input->post('sector'),

         'prsn_email' =>  $email = $DatosP->email,  //$this->input->post('email'),

         'prsn_fono_casa' => $tel_fijo =$DatosP->tel_fijo,  // $this->input->post('tel_fijo'),

         'prsn_fono_movil' => $tel_cel =$DatosP->tel_cel,  // $this->input->post('tel_cel'),

         'prsn_fono_trabajo' => $tel_emp  = $DatosP->tel_emp,  //$this->input->post('tel_emp'),

         'prsn_profesion' => $prof = $DatosP->prof,  //$this->input->post('prof'),

         'prsn_tipo' => $prsn_tipo = 0,

         'prsn_direccion_empresa' => $direc_emp =$DatosP->direc_emp,  // $this->input->post('direc_emp'),

         'prsn_foto' => $prsn_foto = 0,

         'prsn_fallecido' => $prsn_fallecido = 0,

         'prsn_empresa' => $emp = $DatosP->emp,  //$this->input->post('emp'),

         's_nacionalidades_nac_id' => $nacionalidad = $DatosP->nacionalidad,  //$this->input->post('nacionalidad'),

         's_condicion_laboral_condlab_id' => $laboral =$DatosP->laboral,  // $this->input->post('laboral'),

         's_estado_civil_estacivil_id' => $estadocivil =$DatosP->estadocivil,  // $this->input->post('estadocivil'), //persona natural

         's_comunas_comuna_id' => $comu = $DatosP->comu,  //$this->input->post('comu'),

         'prsn_nac' => $nac = $DatosP->nac,  //$this->input->post('nac')
      );

      var_dump($data);
      $this->model_socios->insertar($data); //INSERT PERSONAS
   }



   private function reg_Socio($DatosCorp)
   {

     /*  $DATA     = json_decode($_POST['data']);

      $DATA_P    = json_decode($_POST['data_p']); 
      
      $rut_socio    = $_POST['rut'];
      
      */
      
      $DATA   = $DatosCorp->Coporacion;

      $DATA_P = $DatosCorp->Patrocinador;

      $rut_socio = $DatosCorp->rutSocio;



      

      $estado = 0; // 0 vigente 1 no vigente

      $tipo_id = 1; //1 activo; 2 honorario merito ; 3 honorario antiguedad; 4 ausentes; 5 empresa

      $cond_id = 4; //4 ninguna; 1 renuncia;2 fallecido;3 expulsion;

      $cond2_id = 4; //4 ninguna; 1 morocidad;2 pernisioso;3 suspension;



      $rut_patro1 = $DATA_P[0]->rut_pat;

      $rut_patro2 = $DATA_P[1]->rut_pat;





      for ($i = 0; $i < count($DATA); $i++) {



         //$prsn_id = $this -> model_socios -> ultimoId();

         //Por cada objeto que encuentra en el array lo separa y crea una query

         //  $q[$i]         = "UPDATE TABLA SET CAMPO1 = '".."', CAMPO2 = '".$DATA[$i]->desc."' WHERE ID =".$DATA[$i]->id;    

         if ($DATA[$i]->nacionalidad == 2 || $DATA[$i]->nacionalidad == 3) {

            $italiano = 0;
         } else {

            $italiano = 1;
         }

         $data = array(



            'prsn_rut' => $rut_socio,

            'corporacion' => $DATA[$i]->rut_corp,

            'cond_id' => $cond_id,

            'cond2_id' => $cond2_id,

            'tipo_id' => $tipo_id,

            'n_registro' => $DATA[$i]->num_reg,

            'n_libro' => $DATA[$i]->num_lib,

            'observaciones' =>  'Sin Observaciones',

            'fecha_registro' => $DATA[$i]->fecha_reg,

            'fecha_retiro' =>  '0000-00-00',

            'italiano' => $italiano,

            'estado' => $estado
         );



         $this->model_socios->insertarSocCorp($data);

         var_dump($data);

      }

      $id_soc = $this->model_socios->getIdSocio($rut_socio); //Consulta para obtener id socio

      $primerRegistro = true;

      foreach ($id_soc as $row_idsocio) {

         if ($primerRegistro) {

            $id_socioNew = $row_idsocio->id_socio;

            $primerRegistro = false; //Nos aseguramos que solo se ejecute una vez

         }
      }



      for ($i = 0; $i < count($DATA_P); $i++) {



         //$prsn_id = $this -> model_socios -> ultimoId();

         //Por cada objeto que encuentra en el array lo separa y crea una query

         //  $q[$i]         = "UPDATE TABLA SET CAMPO1 = '".."', CAMPO2 = '".$DATA[$i]->desc."' WHERE ID =".$DATA[$i]->id;    



         $id_pat = $this->model_socios->getIdSocio($DATA_P[$i]->rut_pat); //Consulta para obtener id socio

         $primerRegistro = true;

         foreach ($id_pat as $row_idsocio) {

            if ($primerRegistro) {

               $id_p = $row_idsocio->id_socio;

               $primerRegistro = false; //Nos aseguramos que solo se ejecute una vez

            }
         }

         $data_p = array(



            's_socios_id_socio' => $id_socioNew, //nuevo socio     

            's_socios_prsn_rut' => $rut_socio,

            's_socios_id_socio1' => $id_p, //id socio patrocinador

            's_socios_prsn_rut1' => $DATA_P[$i]->rut_pat
         );



         $this->model_socios->insertarSocPatro($data_p);
         var_dump($data_p);
      } //fin for para agregar cargas  











   }







   private function agregarDep($DatosDeportes)
   {


      /*  $rut = $_POST['rut'];
      $arr = json_decode($_POST['arr']); */

      $rut = $DatosDeportes->rutSocio;
      $arr = $DatosDeportes->Deportes;


      $deportes = implode(", ", $arr);

      $data = array(

         'int_deport' => $deportes

      );

      var_dump($data);


      //Insertar deportes

      $this->model_socios->ins_depor($rut, $data);
   }




   private function agregaCarga($DatosCargas)
   {



      $DATA     = $DatosCargas->Cargas;
      $rut_socio    = $DatosCargas->RutSocio;


      var_dump($DATA);
      var_dump($rut_socio);

      // $DATA     = json_decode($_POST['data']);

     // $rut_socio    = $_POST['rut'];



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

      for ($i = 0; $i < count($DATA); $i++) {


         //Por cada objeto que encuentra en el array lo separa y crea una query

         //  $q[$i]         = "UPDATE TABLA SET CAMPO1 = '".."', CAMPO2 = '".$DATA[$i]->desc."' WHERE ID =".$DATA[$i]->id;    
         $data = array(

            'prsn_id' => $prsn_id = $prsn_id + 1,

            'prsn_rut' => $DATA[$i]->rut,

            'prsn_apellidopaterno' => $DATA[$i]->pat,

            'prsn_apellidomaterno' => $DATA[$i]->mat,

            'prsn_nombres' => $DATA[$i]->nomb,

            'prsn_fechanacimi' => $DATA[$i]->nac,

            'prsn_sexo' => 3,

            'prsn_descendiente' => 3,

            'prsn_direccion' =>  $direccion,

            'prsn_sectorvive' => $poblacion,

            'prsn_email' =>  $DATA[$i]->mail,

            'prsn_fono_casa' => $telefono,

            'prsn_fono_movil' => $DATA[$i]->cel,

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
         var_dump($data);





         if ($DATA[$i]->est == 'NO') {

            $est = 0;
         } else {

            $est = 1;
         }

         $data_carg = array(

            's_personas_prsn_rut' => $DATA[$i]->rut,

            's_socios_id_socio' => $id_s,

            's_socios_prsn_rut' => $rut_socio,

            's_parentesco_pt_id' => $DATA[$i]->parent,

            'estado_carga' => 0,

            'obs_estado' => 0,

            'estudiante' => $est,

            'certificado' => $DATA[$i]->cert
         );

         var_dump($data_carg);

         $this->model_socios->insertar_carg($data_carg);



         $prsn_id = $prsn_id + 1;

         echo $prsn_id;
      } //fin for para agregar cargas
   }
}
