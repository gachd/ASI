<?php



class inicio extends CI_Controller
{



   function __construct()
   {

      parent::__construct();

      $this->load->library('session');

      $this->load->model('model_reportes');

      $this->load->model('model_trabajos');

      $this->load->model('model_turnos');

      $this->load->model('model_actividades');

      $this->load->model('model_socios');
      $this->load->model('model_accionistas');

      $this->load->helper('url');

      $this->load->helper('form');

      $this->load->library('form_validation');

      $this->load->library('session');

      $this->load->library('mpdf60/Mpdf');
   }





   public function index()
   {



      $data['accionistas'] = $this->model_accionistas->accionistas();
      $data['ultimos'] = $this->model_accionistas->ultimos();
      $suscritas = $this->model_accionistas->suscritas();

      foreach ($suscritas as $s) {

         $capital = $s->capital;
         $actual = $s->total_actual;
         $emitidas = $capital - $actual;
      }
      $poremitir = $this->model_accionistas->poremitir();
      foreach ($poremitir as $p) {

         $cont = $p->cont;
      }


      $data['suscritas'] = $capital;
      $data['saldo'] = $actual;
      $data['emitidas'] = $emitidas;
      $data['cont'] = $cont;


      $this->load->view('plantilla/Head_v1');

      $this->load->view('accionistas/inicio', $data);

      $this->load->view('plantilla/Footer');
   }



   public function mostrarGrafico()
   {

      $accionistas = $this->model_accionistas->accionistas();

      $data = [];

      $rango = [];
      $nombres = [];

      $i = 0;
      $cont = 0;
      foreach ($accionistas as $s) {

         $nro_acciones = $s->nro_acciones;

         if ($nro_acciones != 1) {
            $rango[$i] = $nro_acciones;
            if ($s->prsn_apellidopaterno == '') {
               $nombres[$i] = $s->prsn_nombres;
            } else {
               $nombres[$i] = $s->prsn_nombres . ' ' . $s->prsn_apellidopaterno;
            }
            $i = $i + 1;
         } else {
            $cont = $cont + 1;
         }
      }

      $rango[$i] = $cont;
      $nombres[$i] = 'MINORITARIOS';
      $i = $i + 1;
      for ($j = 0; $j < $i; $j++) {
         $data[] = [(string)$nombres[$j], (int)$rango[$j]];
      }

      echo json_encode($data);
   }


   public function listadoLibros (){



   }
}


