<?php

//defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';
require_once APPPATH . '/vendor/autoload.php';
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\ColumnDimension;
use PhpOffice\PhpSpreadsheet\Worksheet;


class pago_cuota extends CI_Controller
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
    $data['ano'] = $this->model_socios->all_cuotas();
    $data['met_pago'] = $this->model_socios->all_metpagos();

    $this->load->view('plantilla/Head_v1');
    $this->load->view('socios/pago_cuota', $data);
    $this->load->view('plantilla/Footer');
  }



  public function newpago()
  {

    $this->form_validation->set_error_delimiters('<div class="error alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');



    $data['nacionalidad'] = $this->model_socios->all_nacionalidades();
    $data['estado_civil'] = $this->model_socios->all_estadocivil();
    $data['comunas'] = $this->model_socios->all_comunas();
    $data['corporacion'] = $this->model_socios->all_corporaciones();
    $data['socio_pat'] = $this->model_socios->all_sociospat();
    $data['parentesco'] = $this->model_socios->all_parentesco();
    $this->load->view('socios/pago_cuota', $data);
  }


  public function excel()
  {


    $this->load->view('plantilla/Head_v1');
    $this->load->view('socios/leerExcel');
    $this->load->view('plantilla/Footer');
  }
  public function leer_excel()

  {



    $excel = $_FILES["excel"];

    if ($excel) {




      $excelTmp = $excel["tmp_name"];

      $Dir_archivos = 'archivos/excels/';

      $path_archivo = $Dir_archivos . '/' . $excel["name"];



      if (move_uploaded_file($excelTmp, $path_archivo)) {
      }




      $inputFileType = 'Xlsx';

      $inputFileName = $path_archivo;

      $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);

      $reader->setReadDataOnly(true);

      $worksheetData = $reader->listWorksheetInfo($inputFileName);

      $excel = [];

      foreach ($worksheetData as $worksheet) {

        /*    ini_set("xdebug.var_display_max_children", '-1');
      ini_set("xdebug.var_display_max_data", '-1');
      ini_set("xdebug.var_display_max_depth", '-1'); */

        $sheetName = $worksheet['worksheetName'];

        /*     echo "<h4>$sheetName</h4>"; */


        $reader->setLoadSheetsOnly($sheetName);

        $spreadsheet = $reader->load($inputFileName);

        $worksheet = $spreadsheet->getActiveSheet();

        $excel = $worksheet->toArray();

        break 1;
      }



      //borrado de archivos excel

      $files = glob($Dir_archivos . '*'); //obtenemos todos los nombres de los archivos del fichero

      foreach ($files as $files) {
        if (is_file($files)) {

          unlink($files); //elimino el archivo
        }
      }

      function dv($r)
      {
        $sinDigito = $r;
        $s = 1;
        for ($m = 0; $r != 0; $r /= 10) {

          $s = ($s + $r % 10 * (9 - $m++ % 6)) % 11;
        }


        $digito = chr($s ? $s + 47 : 75);

        $rut = $sinDigito . '-' . $digito;

        return $rut;
      }




      $personas = [];


      //primera persona datos: 
      // rut
      // nombre


      $cont = 0;

      $personas[$cont][0] = dv($excel[7][1]);
      $personas[$cont][1] = $excel[7][4];







      for ($i = 1; $i < count($excel); $i++) {
        //filas

        if (strrpos($excel[$i][0], '==========================')) {
          $cont++;

          $personas[$cont][0] = dv($excel[$i + 1][1]);
          $personas[$cont][1] = $excel[$i + 1][4];
        }


        for ($j = 0; $j < count($excel[$i]); $j++) {
          //colummnas

        }
      }

      $Nombre_institucion = $excel[0][0];
      $Rut_institucion = $excel[5][0];

      //elimino el utimo dato que es vacio
      array_pop($personas);


      $data["excel"] = $excel;
      $data["Nombre_institucion"] = $Nombre_institucion;
      $data["Rut_institucion"] = $Rut_institucion;
      $data["saltos"] = count($personas);
      $data["personas"] = $personas;





      echo (json_encode($data));
    }else{
      
      header('HTTP/1.1 500 Internal Server Booboo');
      header('Content-Type: application/json; charset=UTF-8');
      die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
    }
  }





  public function actualizar()
  {


    $impagos = $this->model_socios->impagos();
    foreach ($impagos as $i) {

      $cuota = $i->cuota_ordinaria_id_cuota;
      $rut = $i->s_socios_prsn_rut;
      $pagado = $i->total_pagado;

      $cuota_ant = $cuota - 1;

      $valorCuotaAnt = $this->model_socios->datosCuota($cuota_ant);

      $obs = '';
      if ($pagado == $valorCuotaAnt) {

        $obs = 'AL DIA, VALOR PAGADO CORRESPONDE AL MONTO DE LA CUOTA ANTERIOR';
        $saldo = 0;
        $estado = 1;
      }

      $data = array(
        'observ_cuota' => $obs,
        'saldo' => 0,
        'estado' => 1
      );
      $this->model_socios->actualizarPago($data, $rut, $cuota);
    }
  }



  public function pagar_cuota()
  {

    $rut  = $this->input->post('rut');

    $sem  = $this->input->post('sem');

    $ano  = $this->input->post('ano');

    $monto = $this->input->post('monto');

    $fecha = $this->input->post('fecha');

    $met_pago = $this->input->post('met_pago');

    $doc = $this->input->post('doc');

    $obs = $this->input->post('obs');

    $cont = 0;
    $descrip = 'CO/' . $sem . '' . $ano;

    $dif = 0;

    $var_paso = 0;



    $cant = $this->model_socios->cant_corp($rut); //Consulta para obtener cantidad de corporaciones

    foreach ($cant as $row_cant) {

      $canti = $row_cant->prsn_rut;

      $rut_corp = $row_cant->corporacion;

      $cont = $cont + 1;
    }

    $id_socio = $this->model_socios->getIdSocio($rut); //Consulta para obtener id socio

    $primerRegistro = true;

    foreach ($id_socio as $row_idsocio) {

      if ($primerRegistro) {

        $id_s = $row_idsocio->id_socio;

        $primerRegistro = false; //Nos aseguramos que solo se ejecute una vez

      }
    }

    $cuota = $this->model_socios->datos_cuota($sem, $ano); //Obtener informacion de la cuota a pagar

    foreach ($cuota as $row_cuota) {

      $valor = $row_cuota->valor;

      $vnto = $row_cuota->fecha_vcto;

      $emision = $row_cuota->fecha_emision;

      $id = $row_cuota->id_cuota;

      $valor_todas = $row_cuota->valor_todas;

      $valor_stadio = $row_cuota->valor_stadio;

      $valor_concordia = $row_cuota->valor_concordia;

      $valor_atletico = $row_cuota->valor_atletico;

      $valor_centro = $row_cuota->valor_centro;

      $valor_scuola = $row_cuota->valor_scuola;
    }



    $detalle_cuot = $this->model_socios->detalle_cuota($id, $rut, $id_s);

    foreach ($detalle_cuot as $row_dc) {

      $total_pagado = $row_dc->total_pagado;

      $saldo = $row_dc->saldo;

      $pagado_stadio = $row_dc->pagado_stadio;

      $pagado_concordia = $row_dc->pagado_concordia;

      $pagado_atletico = $row_dc->pagado_atletico;

      $pagado_centro = $row_dc->pagado_centro;

      $pagado_scuola = $row_dc->pagado_scuola;

      $estado = $row_dc->estado;
    }



    if ($cont == 1) {

      $idsocio = $this->model_socios->IdSocio($rut);

      foreach ($idsocio as $row_socio) {

        $id_s = $row_socio->id_socio;

        $rut_corp =  $row_socio->corporacion;
      }

      if ($rut_corp == '65106820-7') {

        $pagado_stadio = $monto;

        $pagado_scuola = 0;

        $pagado_concordia = 0;

        $pagado_centro = 0;

        $pagado_atletico = 0;
      }

      if ($rut_corp == '65467840-5') {

        $pagado_scuola = $monto;

        $pagado_stadio = 0;

        $pagado_concordia = 0;

        $pagado_centro = 0;

        $pagado_atletico = 0;
      }

      if ($rut_corp == '70331500-3') {

        $pagado_centro = $monto;

        $pagado_scuola = 0;

        $pagado_stadio = 0;

        $pagado_concordia = 0;

        $pagado_atletico = 0;
      }

      if ($rut_corp == '71888800-k') {

        $pagado_atletico = $monto;

        $pagado_centro = 0;

        $pagado_scuola = 0;

        $pagado_stadio = 0;

        $pagado_concordia = 0;
      }

      if ($rut_corp == '72265900-7') {

        $pagado_concordia = $monto;

        $pagado_atletico = 0;

        $pagado_centro = 0;

        $pagado_scuola = 0;

        $pagado_stadio = 0;
      }

      $data = array(

        'total_pagado' => $monto,

        'observ_cuota' => $obs,

        'saldo' => 0,

        'pagado_stadio' => $pagado_stadio,

        'pagado_concordia' => $pagado_concordia,

        'pagado_atletico' => $pagado_atletico,

        'pagado_centro' =>  $pagado_centro,

        'estado' => 1,

        'pagado_scuola' =>  $pagado_scuola
      );



      //dividir el monto cancelado en las otras corporaciones

      $this->model_socios->actualizarPago($data, $rut, $id);


      $data_corp = array(

        'fecha_fact' => $fecha,

        'tipo_pago_idtipo_pago' => 1,

        'metodo_pago_idmetodo_pago' => $met_pago,

        'num_comprobante' => $doc,

        'descrip' => $descrip,

        's_cuota_ordinaria_id_cuota' => $id,

        's_socios_id_socio' =>  $id_s,

        's_socios_prsn_rut' => $rut,

        'total_pagado' =>  $monto
      );



      $this->model_socios->insertarFact($data_corp);
    } else {



      if ($cont == 5) {

        $valor = $valor_todas;
      }



      if ($saldo == $valor) { //esto ocurrira cuando no se ha pagado nada anteriormente

        $saldo = $valor - $monto; //esto sera 0 solo si se cancela la deuda total

        $total_pagado = $monto;
      } else { //esto ocurrira si hubo algun pago anterior

        $saldo = $saldo - $monto; //esto sera 0 si se cancela lo que estaba pendiente

        $total_pagado = $total_pagado + $monto;
      }



      if (($saldo == 0) && ($cont == 4)) {

        $estado_cuota = 1;

        $pagado_stadio = $valor_stadio - $pagado_stadio;

        $pagado_concordia = $valor_concordia - $pagado_concordia;

        $pagado_atletico = $valor_atletico - $pagado_atletico;

        $pagado_centro = $valor_centro - $pagado_centro;

        $pagado_scuola = 0;

        $var_paso = 1;
      }

      if (($saldo == 0) && ($cont == 5)) {

        $estado_cuota = 1;

        $pagado_stadio2 = $valor_stadio - $pagado_stadio;
        $pagado_stadio = $valor_stadio;

        $pagado_concordia = $valor_concordia - $pagado_concordia;

        $pagado_atletico = $valor_atletico - $pagado_atletico;

        $pagado_centro = $valor_centro - $pagado_centro;

        $pagado_scuola = $valor_scuola - $pagado_scuola;

        $var_paso = 1;
      }


      if ($var_paso == 0) {

        if (($monto <= $valor_stadio) && ($saldo != 0) && (($cont == 4) || ($cont == 5))) {

          $estado_cuota = 0;

          $pagado_stadio = $monto;

          $pagado_concordia = 0;

          $pagado_atletico = 0;

          $pagado_centro = 0;

          $pagado_scuola = 0;
        } else {

          $dif = $monto - $valor_stadio;
          $pagado_stadio = $valor_stadio;

          if ($dif > $valor_centro) {

            $dif = $dif - $valor_centro;
            $pagado_centro = $valor_centro;

            if ($dif <= $valor_concordia) {

              $pagado_concordia = $dif;
              $pagado_atletico = 0;
              $pagado_scuola = 0;
              $estado_cuota = 0;
            } else {

              $dif = $dif - $valor_concordia;
              $pagado_concordia = $valor_concordia;

              if ($dif <= $valor_stadio) {

                $pagado_atletico = $dif;
                $pagado_scuola = 0;
                $estado_cuota = 0;
              }
            }
          } else {

            $pagado_centro = $dif;
            $dif = 0;
            $pagado_concordia = 0;
            $pagado_atletico = 0;
            $pagado_scuola = 0;
            $estado_cuota = 0;
          }
        }
      }




      $idsocio = $this->model_socios->IdSocio($rut);

      foreach ($idsocio as $row_socio) {

        $id_s = $row_socio->id_socio;

        $rut_corp =  $row_socio->corporacion;



        if ($rut_corp == '65106820-7') {

          $pagado = $pagado_stadio;
        }

        if ($rut_corp == '65467840-5') {

          $pagado = $pagado_scuola;
        }

        if ($rut_corp == '70331500-3') {

          $pagado = $pagado_centro;
        }

        if ($rut_corp == '71888800-k') {

          $pagado = $pagado_atletico;
        }

        if ($rut_corp == '72265900-7') {

          $pagado = $pagado_concordia;
        }

        if ($pagado != 0) {



          $data_corp = array(

            'fecha_fact' => $fecha,

            'tipo_pago_idtipo_pago' => 1,

            'metodo_pago_idmetodo_pago' => $met_pago,

            'num_comprobante' => $doc,

            'descrip' => $descrip,

            's_cuota_ordinaria_id_cuota' => $id,

            's_socios_id_socio' =>  $id_s,

            's_socios_prsn_rut' => $rut,

            'total_pagado' =>  $pagado
          );



          $this->model_socios->insertarFact($data_corp);
        }
      }



      $idsocio = $this->model_socios->IdSocio($rut);

      foreach ($idsocio as $row_socio) {

        $id_s = $row_socio->id_socio;
        $id;

        $pagadocuotas = $this->model_socios->buscarpagos($id, $id_s);
        $suma = 0;

        foreach ($pagadocuotas as $pc) {

          $suma = $suma + $pc->total_pagado;
        }

        $rut_corp =  $row_socio->corporacion;



        if ($rut_corp == '65106820-7') {

          $actstadio = $suma;
        }

        if ($rut_corp == '65467840-5') {

          $actscuola = $suma;
        }

        if ($rut_corp == '70331500-3') {

          $actcentro = $suma;
        }

        if ($rut_corp == '71888800-k') {

          $actatletico = $suma;
        }

        if ($rut_corp == '72265900-7') {

          $actconcordia = $suma;
        }
      }


      $data = array(

        'total_pagado' => $total_pagado,

        'observ_cuota' => $obs,

        'saldo' => $saldo,

        'pagado_stadio' => $actstadio,

        'pagado_concordia' => $actconcordia,

        'pagado_atletico' => $actatletico,

        'pagado_centro' =>  $actcentro,

        'estado' => $estado_cuota,

        'pagado_scuola' =>  $actscuola
      );



      //dividir el monto cancelado en las otras corporaciones

      $this->model_socios->actualizarPago($data, $rut, $id);
    }
  }



  public function valor_cuota()
  {





    $rut_socio  = $this->input->post('rut');

    $sem  = $this->input->post('sem');

    $ano  = $this->input->post('ano');

    $cont = 0;

    $cant = $this->model_socios->cant_corp($rut_socio);

    $id_socio = $this->model_socios->getIdSocio($rut_socio);







    foreach ($cant as $row_cant) {

      $canti = $row_cant->prsn_rut;

      $cont = $cont + 1;
    }









    $cuota = $this->model_socios->datos_cuota($sem, $ano);

    foreach ($cuota as $row_cuota) {

      $valor = $row_cuota->valor;

      $vnto = $row_cuota->fecha_vcto;

      $emision = $row_cuota->fecha_emision;

      $id = $row_cuota->id_cuota;

      $valor_todas = $row_cuota->valor_todas;
    }



    if ($cont == 5) {

      $valor = $valor_todas;
    }


    $primerRegistro = true;

    foreach ($id_socio as $row_idsocio) {

      if ($primerRegistro) {

        $id_s = $row_idsocio->id_socio;
        $estado_cuota = $this->model_socios->estado_cuota($id, $rut_socio, $id_s);
        if ($estado_cuota) {
          $primerRegistro = false; //Nos aseguramos que solo se ejecute una vez
        }
      }
    }










    if (!empty($estado_cuota)) {



      foreach ($estado_cuota as $row_escuota) {

        $es_cuota = $row_escuota->estado;
      }









      if (isset($es_cuota)) {



        if ($es_cuota == 1) {

          $paso = 1;
        }





        $date_em = date_create($emision);

        $date_vnto = date_create($vnto);

        $fecha_emi = date_format($date_em, 'd/m/Y');

        $fecha_vnto = date_format($date_vnto, 'd/m/Y');

        setlocale(LC_ALL, "es_CL");

        $valor_formateado = number_format($valor, 0, ",", ".");

        //date_format($vnto, '%A %d de %B del %Y');



        $data = array(
          0 => 0,

          1 => $valor_formateado,

          2 => $fecha_emi,

          3 => $fecha_vnto,

          4 => $es_cuota,

          5 => $es_cuota
        );

        echo json_encode($data);
      }
    } else {

      $data = array(0 => 1);

      echo json_encode($data);
    }
  }



  public function ano()
  {

    $data['ano'] = $this->model_socios->all_cuotas();

    return $data;
  }



  public function metodo_pago()
  {

    $data['met_pago'] = $this->model_socios->all_metpagos();

    // $data['idmetodo_pago'] = $this-> model_socios->all_metpagos();

    return $data;
  }



  public function mostrar_socio()
  {







    $rut_socio  = $this->input->post('rut_socio');

    $socio = $this->model_socios->getSocios($rut_socio);

    $corporacion = $this->model_socios->corp_socios($rut_socio);



    if (!empty($socio)) {









      echo ' <table id="highlight-table"  class="table-bordered table-striped">

		    <thead>		    

              <th>Datos Personales</th>

              </thead>

            <tbody>';



      foreach ($socio as $row_socio) {

        $nombre = $row_socio->prsn_nombres;

        $paterno = $row_socio->prsn_apellidopaterno;

        $materno = $row_socio->prsn_apellidomaterno;
      }

      $cont = 0;





      echo '<tr>

                <td colspan="40" style="background: rgba(0, 147, 255, 0.06);font-size: 16px;font-weight: 700;letter-spacing:10px;text-align: center;">' . $nombre . " " . $paterno . " " . $materno . '</td>

                </tr>

                <tr>

                  <td><center>Instituciones</td>

                  

                </tr>

                ';





      foreach ($corporacion as $row_corp) {



        $corp = $row_corp->co_nombre;

        echo '<tr>

                <td colspan="40" style="background: rgba(0, 147, 255, 0.06);font-size: 12px;font-weight: 700;letter-spacing:5px;text-align: center;">' . $corp . '</td>

                </tr>';

        $cont = $cont + 1;
      }









      echo ' </tbody></table> ';
    } else {

      echo '<span>SOCIO NO ENCONTRADO</span>';
    }
  }





  public function detalle_cuotas()
  {

    $rut_socio  = $this->input->post('rut');

    $sem  = $this->input->post('sem');

    $ano  = $this->input->post('ano');



    $cuota = $this->model_socios->datos_cuota($sem, $ano);

    foreach ($cuota as $row_cuota) {

      $valor = $row_cuota->valor;

      $vnto = $row_cuota->fecha_vcto;

      $emision = $row_cuota->fecha_emision;

      $id = $row_cuota->id_cuota;

      $valor_todas = $row_cuota->valor_todas;
    }



    $detalle_pago = $this->model_socios->detalle_pago($id, $rut_socio);



    foreach ($detalle_pago as $row_dp) {

      $total_pagado = $row_dp->total_pagado;

      $obser = $row_dp->observ_cuota;

      $saldo = $row_dp->saldo;

      $pagado_st = $row_dp->pagado_stadio;

      $pagado_con = $row_dp->pagado_concordia;

      $pagado_at = $row_dp->pagado_atletico;

      $pagado_cen = $row_dp->pagado_centro;

      $pagado_sc = $row_dp->pagado_scuola;
    }

    setlocale(LC_ALL, "es_CL");

    $total_for = number_format($total_pagado, 0, ",", ".");

    $stadio = number_format($pagado_st, 0, ",", ".");

    $concordia = number_format($pagado_con, 0, ",", ".");

    $atletico = number_format($pagado_at, 0, ",", ".");

    $centro = number_format($pagado_cen, 0, ",", ".");

    $scuola = number_format($pagado_sc, 0, ",", ".");















    // $det_fact = $this-> model_socios->factura($id_st,$id,$rut_socio);



    echo '<center><h3>Detalle Pago Cuotas</h3></center>';

    echo ' <table style="margin:auto;" id="highlight-table"  class="detCuotas table-bordered table-striped" style="margin-top:22px;">		    

         <tbody>';



    echo '   <tr>

             <td >Total Pagado</td>

             <td width="10%" >' . "$" . $total_for . '</td>                       

             <td >Observación</td>

             <td >' . $obser . '</td>

           </tr>';



    echo ' </tbody></table>';



    echo '<div class="panel-group" id="accordion">';

    $idsocio = $this->model_socios->IdSocio($rut_socio);

    $conta = 0;

    foreach ($idsocio as $row_is) {

      $Id = $row_is->id_socio;

      $corp = $row_is->corporacion;

      $conta = $conta + 1;

      $nomb_corp = $this->model_socios->nomb_corp($corp);

      foreach ($nomb_corp as $row_nc) {

        $nombre = $row_nc->co_nombre;
      }

      if ($corp == '65106820-7') {
        $valor = $stadio;
      }

      if ($corp == '71888800-k') {
        $valor = $atletico;
      }

      if ($corp == '72265900-7') {
        $valor = $concordia;
      }

      if ($corp == '70331500-3') {
        $valor = $centro;
      }

      if ($corp == '65467840-5') {
        $valor = $scuola;
      }









      echo '<div class="panel panel-default">

          <div class="panel-heading">

              <h4 class="panel-title">

                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse' . $conta . '">

                  <label style="font-size:15px">' . $nombre . '=</label><label>' . "$" . $valor . '</label></a>

              </h4>

          </div>

       <div id="collapse' . $conta . '" class="panel-collapse collapse">

      <div class="panel-body">';

      echo ' <table id="highlight-table"  class="detCorp table-bordered table-striped" style="margin:auto;" >	

               <thead>		    

              <th>Total Pagado</th>

              <th>Fecha</th>

              <th>Método Pago</th>

              <th>Descripción</th>

              </thead>	   

            <tbody>';

      $det_fact = $this->model_socios->factura($Id, $id, $rut_socio);



      foreach ($det_fact as $row_df) {

        $fecha = $row_df->fecha_fact;

        $num_comp = $row_df->num_comprobante;

        $descrip = $row_df->descrip;

        $total_pag = $row_df->total_pagado;

        $metodo_pago =  $row_df->nombre_mp;

        setlocale(LC_ALL, "es_CL");

        $total_co = number_format($total_pag, 0, ",", ".");

        $date = date_create($fecha);

        $fecha_form = date_format($date, 'd/m/Y');



        echo '   <tr>

             

             <td style="text-align:center;font-size: 16px;font-weight: 700;">' . "$" . $total_co . '</td>                       

             

             <td style="font-size: 16px;font-weight: 700;text-align:center">' . $fecha_form . '</td>

            

             <td style="font-size: 16px;font-weight: 700;text-align:center">' . $metodo_pago . '</td>

            

             <td style="font-size: 16px;font-weight: 700;text-align:center">' . $descrip . '</td>

           </tr>';
      }

      echo ' </tbody></table>';



      echo '</div>

    </div>

  </div>';
    }
  }
}/*cierre controlador*/