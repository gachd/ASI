<?php class  ficha extends CI_Controller
{



  function __construct()
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

    $data['personas'] = $this->model_socios->all_personas();

    $this->load->view('plantilla/Head_v1');

    $this->load->view('socios/lista_personas', $data);

    $this->load->view('plantilla/Footer');
  }



  function detalle()
  {

    $data['corporaciones'] = $this->model_socios->all_corporaciones();

    $rut = $this->uri->segment(4);

  	

    $data['rut'] = $rut;

    $data['datos_personales'] = $this->model_socios->persona($rut);

    $data['patrocinadores'] = $this->model_socios->patrocinadores($rut);

    $data['patrocinados'] = $this->model_socios->patrocinados($rut);

    $data['cargas'] = $this->model_socios->cargas($rut);

    $data['cuotas'] = $this->model_socios->cuotas($rut);

    $data['InfoSocio'] = $this->model_socios->InfoSocio($rut);

    



    $this->load->view('plantilla/Head_v1');

    $this->load->view('socios/ficha', $data);

    $this->load->view('plantilla/Footer');
  }







  function cargar_cuotas()
  {

    $cont = 0;





    $socio = $this->model_socios->all_socios();



    foreach ($socio as $row_soc) {
      $id  = $row_soc->id_socio;
      $rut = $row_soc->prsn_rut;
      $cant = $this->model_socios->cant_corp($rut);
      $id_socio = $this->model_socios->getIdSocio($rut);
      $primerRegistro = true;

      foreach ($id_socio as $row_idsocio) {
        if ($primerRegistro) {

          $id_s = $row_idsocio->id_socio;
          $primerRegistro = false; //Nos aseguramos que solo se ejecute una vez
        }
      }

      foreach ($cant as $row_cant) {
        $canti = $row_cant->prsn_rut;
        $cont = $cont + 1;
      }


      $cuotas = $this->model_socios->Allcuotas();



      foreach ($cuotas as $row_cuotas) {
        $id_cuota = $row_cuotas->id_cuota;
        $variable = 0;
        $observ = 'NO PAGADO';


        if ($cont == 5) {
          $valor = $row_cuotas->valor_todas;
        } else {
          $valor = $row_cuotas->valor;
        }



        $num_filas = $this->model_socios->consulta_cuotas($id_cuota, $id_s, $rut);


        if ($num_filas == 0) {

          $data = array(
            'cuota_ordinaria_id_cuota' => $id_cuota,
            'total_pagado' => $variable,
            'observ_cuota' => $observ,
            'saldo' => $valor,
            'pagado_stadio' => $variable,
            'pagado_concordia' => $variable,
            'pagado_atletico' => $variable,
            'pagado_centro' => $variable,
            's_socios_id_socio' => $id_s,
            's_socios_prsn_rut' => $rut,
            'estado' => $variable,
            'pagado_scuola' => $variable
          );

          $insertar_cuota = $this->model_socios->insert_cuotas($data);
        }
      }
    }
  }
}
