<?php

require_once APPPATH . '/vendor/autoload.php';

use Mpdf\Tag\Input;
use Mpdf\Utils\Arrays;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\F;
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


class inicio extends CI_Controller
{



   function __construct()
   {

      parent::__construct();

      $this->load->library('session');

      $this->load->model('model_reportes');

      $this->load->model('model_socios');

      $this->load->model('model_libro');
      $this->load->model('model_titulo');
      $this->load->model('model_persona');
      $this->load->model('model_accionistas');

      $this->load->model('model_trabajos');

      $this->load->model('model_turnos');

      $this->load->model('model_actividades');
      $this->load->model('model_sa');


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

      $no_entregados = $this->model_titulo->nro_titulos_no_entregados();
      $data['no_entregados'] =  $no_entregados[0]->no_entregados;


      $emitidas = $this->model_accionistas->totalemitidas();

      $totalemitidas = $emitidas[0]->total_emitidas;
      $data['emitidas'] = $totalemitidas;


      $sa = $this->model_sa->datos_sa();
      $total_acciones = $sa[0]->Acciones;
      $data['sa'] = $total_acciones;

      $saldo =  $total_acciones - $totalemitidas;

      $data['saldo'] = $saldo;

      $data['todo_sa'] = $this->model_sa->datos_sa();

      $activos = $this->model_accionistas->id_activos();




      $bajas = [];



      foreach ($activos as $a) {

         if (empty($this->model_accionistas->validar_estado($a->id_accionista))) {

            array_push($bajas, $this->model_accionistas->datosaccionista($a->id_accionista));
         }
      }

      $data['bajas'] = $bajas;


      $this->load->view('plantilla/Head');

      $this->load->view('accionistas/inicio', $data);

      $this->load->view('plantilla/Footer');
   }

   public function editar_ver_accionista()
   {

      $actividad = $this->input->post('accion');
      $id_accionista = $this->input->post('id_accionista');

      if ($actividad == 'editar') {

         $data['accionista'] = $this->model_accionistas->datosaccionista($id_accionista);

         $data['comunas']   = $this->model_persona->all_comunas();
         $data['laboral']   = $this->model_persona->all_condicionlab();
         $data['estado_civil']   = $this->model_persona->all_estadocivil();
         $data['provincia']   = $this->model_persona->all_provincias();
         $data['region']   = $this->model_persona->all_region();


         $this->load->view('accionistas/update_accionista', $data);
      }

      if ($actividad == 'ver') {

         $id = $id_accionista;


         $Tranferencia_de_acciones = array();


         $data['accionista'] = $this->model_accionistas->datosaccionista($id);

         $data['titulos'] = $this->model_accionistas->TitulosActivosporAccionista($id);



         //Consulta a BD por todos los titulos que posee o fueron alguna ves del accionista

         $TitulosHistoricosAccionista = $this->model_accionistas->HistorialTitulosporAccionista($id);




         foreach ($TitulosHistoricosAccionista as $t_h) {





            $HistoricoTitulosVendidos = $this->model_titulo->titulos_con_tranferencia_realizada($t_h->id_titulos);


            //validamos la venta, canje o herencia de acciones

            if (!empty($HistoricoTitulosVendidos)) {


               for ($i = 0; $i < count($HistoricoTitulosVendidos); $i++) {

                  //Consultamos los datos de los compradosres del los titulos

                  $LosQueCompraron = $this->model_titulo->DatosAccionistaDelTitulo($HistoricoTitulosVendidos[$i]['tiulo_actual']);
                  $LosQueCompraron = $LosQueCompraron[0];


                  $HistoricoTitulosVendidos[$i]["Comprador_IdAccionista"] = $LosQueCompraron["id_accionista"];
                  $HistoricoTitulosVendidos[$i]["Comprador_Nombres"] = $LosQueCompraron["prsn_nombres"];
                  $HistoricoTitulosVendidos[$i]["Comprador_ApellidoP"] = $LosQueCompraron["prsn_apellidopaterno"];
                  $HistoricoTitulosVendidos[$i]["Comprador_ApellidoM"] = $LosQueCompraron["prsn_apellidomaterno"];
                  $HistoricoTitulosVendidos[$i]["Comprador_Rut"] = $LosQueCompraron["prsn_rut"];
                  $HistoricoTitulosVendidos[$i]["Acciones_Vendidas"] = $LosQueCompraron["numero_acciones"];
               }



               //Guardamos en un array con indice del mismo numero de titulos del accionista de $TitulosHistoricosAccionista

               $Tranferencia_de_accionesVedidas[$t_h->id_titulos] = $HistoricoTitulosVendidos;
            }

            //Validamos la compra de acciones

            $HistoricoTitulosComprados = $this->model_titulo->titulos_con_tranferencia_recibida($t_h->id_titulos);
            $HistoricoTitulosComprados = $HistoricoTitulosComprados[0];

            if (!empty($HistoricoTitulosComprados)) {



               //Consultamos los datos de los compradosres del los titulos

               $AquienCompro = $this->model_titulo->DatosAccionistaDelTitulo($HistoricoTitulosComprados['titulo_origen']);
               $AquienCompro = $AquienCompro[0];



               $HistoricoTitulosComprados["Vendedor_IdAccionista"] = $AquienCompro["id_accionista"];
               $HistoricoTitulosComprados["Vendedor_Nombres"] = $AquienCompro["prsn_nombres"];
               $HistoricoTitulosComprados["Vendedor_ApellidoP"] = $AquienCompro["prsn_apellidopaterno"];
               $HistoricoTitulosComprados["Vendedor_ApellidoM"] = $AquienCompro["prsn_apellidomaterno"];
               $HistoricoTitulosComprados["Vendedor_Rut"] = $AquienCompro["prsn_rut"];
               $HistoricoTitulosComprados["Acciones_Compradas"] = $HistoricoTitulosComprados['numero_acciones'];

               //Guadamos el historico de acciones compradas y sus titulos

               $Tranferencia_de_accionesCompradas[$t_h->id_titulos] = $HistoricoTitulosComprados;
            } else {

               //si la accion no fue comprada a un tercera es una accion suscrita nueva

               $TitulosSuscritos[$t_h->id_titulos]['Titulo'] = $t_h->id_titulos;

               $TitulosSuscritos[$t_h->id_titulos]['Acciones'] = $t_h->numero_acciones;
               $TitulosSuscritos[$t_h->id_titulos]['Fecha'] = $t_h->fecha;
            }


            //Fin recorrido array de Titulos


         }







         $index = 0;

         if (!empty($Tranferencia_de_accionesVedidas)) {

            foreach ($Tranferencia_de_accionesVedidas as $indice => $value) {





               $contador_canje = 0;
               $contandorVenta = 0;

               /* echo "Venta Titulo".$indice; */




               foreach ($Tranferencia_de_accionesVedidas[$indice] as $acciones) {

                  if ($acciones['tipo_transferencia'] == 3) { //canje

                     $contador_canje = $contador_canje + $acciones["Acciones_Vendidas"];
                  }
               }
               $AccionesOriginalesT[$index]["Titulo"] = $indice;
               $AccionesOriginalesT[$index]["Canjeadas"] = $contador_canje;
               $AccionesOriginalesT[$index]["Vendidas"] = $contandorVenta;
               $AccionesOriginalesT[$index]["Acciones_originales"] = $contador_canje + $acciones["numero_acciones"];


               $index++;
            }
         }


         $data['TitulosHistoricosAccionista'] = $TitulosHistoricosAccionista;
         $data['Tranferencia_de_accionesVedidas'] = $Tranferencia_de_accionesVedidas;
         $data['Tranferencia_de_accionesCompradas'] = $Tranferencia_de_accionesCompradas;



         $data['AccionesOriginalesT'] = $AccionesOriginalesT;


         //resgitrar las acciones realizadas del titulo antes de los canjes

         if (!empty($TitulosSuscritos)) {

            foreach ($TitulosSuscritos as $indexTS => $TS) {

               if (!empty($AccionesOriginalesT)) {

                  foreach ($AccionesOriginalesT as $indexAOT => $AOT) {

                     if ($indexTS == $AOT["Titulo"]) {

                        $TitulosSuscritos[$indexTS]['Acciones'] =  $AOT["Acciones_originales"];
                     }
                  }
               }
            }
         }




         $data['TitulosSuscritos'] = $TitulosSuscritos;






         $rut_accionista = $data['accionista'][0]->prsn_rut;

         $DirAccionista = $data['accionista'][0]->path;







         $data['socio'] = $this->model_accionistas->accionistas_es_socio($rut_accionista);







         $this->load->view('accionistas/show_accionista', $data);
      }
   }





   public function mostrarGrafico1()
   {

      $accionistas = $this->model_accionistas->nro_acciones_all();


      $data = []; // array para almacenar los datos

      $rango = []; //array para almacenar los rangos
      $nombres = []; //nombres de los accionistas

      $i = 0;
      $cont = 0; //contador para los minoritarios

      foreach ($accionistas as $s) {

         $nro_acciones = $s->numero_acciones;

         if ($nro_acciones != 1) { // si es != de 1 se agrega a minoritarios

            if ($s->prsn_apellidopaterno == '') {
               $nombres[$i] = $s->prsn_nombres;
               $rango[$i] = $s->numero_acciones;
               $rut[$i] = $s->prsn_rut;
            } else {
               $nombres[$i] = $s->prsn_nombres . ' ' . $s->prsn_apellidopaterno;
               $rango[$i] = $s->numero_acciones;
               $rut[$i] = $s->prsn_rut;
            }
            $i = $i + 1;
         } else {
            $cont = $cont + 1;
         }
      }





      for ($j = 0; $j < $i; $j++) {

         $data[] = [(string)$nombres[$j], (int)$rango[$j], (string)$rut[$j]];
      }

      if ($cont != 0) {
         $data[$j] = ["MINORISTAS", $cont];
      }





      echo json_encode($data, JSON_UNESCAPED_UNICODE);
   }


   /*   public function editar($id)

   {

      $data['accionista'] = $this->model_accionistas->datosaccionista($id);

      $data['comunas']   = $this->model_persona->all_comunas();
      $data['laboral']   = $this->model_persona->all_condicionlab();
      $data['estado_civil']   = $this->model_persona->all_estadocivil();
      $data['provincia']   = $this->model_persona->all_provincias();
      $data['region']   = $this->model_persona->all_region();




      $this->load->view('plantilla/Head');

      $this->load->view('accionistas/update_accionista', $data);

      $this->load->view('plantilla/Footer');
   } */


   public function ver($id)

   {



      $Tranferencia_de_acciones = array();


      $data['accionista'] = $this->model_accionistas->datosaccionista($id);

      $data['titulos'] = $this->model_accionistas->TitulosActivosporAccionista($id);



      //Consulta a BD por todos los titulos que posee o fueron alguna ves del accionista

      $TitulosHistoricosAccionista = $this->model_accionistas->HistorialTitulosporAccionista($id);




      foreach ($TitulosHistoricosAccionista as $t_h) {





         $HistoricoTitulosVendidos = $this->model_titulo->titulos_con_tranferencia_realizada($t_h->id_titulos);


         //validamos la venta, canje o herencia de acciones

         if (!empty($HistoricoTitulosVendidos)) {


            for ($i = 0; $i < count($HistoricoTitulosVendidos); $i++) {

               //Consultamos los datos de los compradosres del los titulos

               $LosQueCompraron = $this->model_titulo->DatosAccionistaDelTitulo($HistoricoTitulosVendidos[$i]['tiulo_actual']);
               $LosQueCompraron = $LosQueCompraron[0];


               $HistoricoTitulosVendidos[$i]["Comprador_IdAccionista"] = $LosQueCompraron["id_accionista"];
               $HistoricoTitulosVendidos[$i]["Comprador_Nombres"] = $LosQueCompraron["prsn_nombres"];
               $HistoricoTitulosVendidos[$i]["Comprador_ApellidoP"] = $LosQueCompraron["prsn_apellidopaterno"];
               $HistoricoTitulosVendidos[$i]["Comprador_ApellidoM"] = $LosQueCompraron["prsn_apellidomaterno"];
               $HistoricoTitulosVendidos[$i]["Comprador_Rut"] = $LosQueCompraron["prsn_rut"];
               $HistoricoTitulosVendidos[$i]["Acciones_Vendidas"] = $LosQueCompraron["numero_acciones"];
            }



            //Guardamos en un array con indice del mismo numero de titulos del accionista de $TitulosHistoricosAccionista

            $Tranferencia_de_accionesVedidas[$t_h->id_titulos] = $HistoricoTitulosVendidos;
         }

         //Validamos la compra de acciones

         $HistoricoTitulosComprados = $this->model_titulo->titulos_con_tranferencia_recibida($t_h->id_titulos);
         $HistoricoTitulosComprados = $HistoricoTitulosComprados[0];

         if (!empty($HistoricoTitulosComprados)) {



            //Consultamos los datos de los compradosres del los titulos

            $AquienCompro = $this->model_titulo->DatosAccionistaDelTitulo($HistoricoTitulosComprados['titulo_origen']);
            $AquienCompro = $AquienCompro[0];



            $HistoricoTitulosComprados["Vendedor_IdAccionista"] = $AquienCompro["id_accionista"];
            $HistoricoTitulosComprados["Vendedor_Nombres"] = $AquienCompro["prsn_nombres"];
            $HistoricoTitulosComprados["Vendedor_ApellidoP"] = $AquienCompro["prsn_apellidopaterno"];
            $HistoricoTitulosComprados["Vendedor_ApellidoM"] = $AquienCompro["prsn_apellidomaterno"];
            $HistoricoTitulosComprados["Vendedor_Rut"] = $AquienCompro["prsn_rut"];
            $HistoricoTitulosComprados["Acciones_Compradas"] = $HistoricoTitulosComprados['numero_acciones'];

            //Guadamos el historico de acciones compradas y sus titulos

            $Tranferencia_de_accionesCompradas[$t_h->id_titulos] = $HistoricoTitulosComprados;
         } else {

            //si la accion no fue comprada a un tercera es una accion suscrita nueva

            $TitulosSuscritos[$t_h->id_titulos]['Titulo'] = $t_h->id_titulos;

            $TitulosSuscritos[$t_h->id_titulos]['Acciones'] = $t_h->numero_acciones;
            $TitulosSuscritos[$t_h->id_titulos]['Fecha'] = $t_h->fecha;
         }


         //Fin recorrido array de Titulos


      }







      $index = 0;

      if (!empty($Tranferencia_de_accionesVedidas)) {

         foreach ($Tranferencia_de_accionesVedidas as $indice => $value) {





            $contador_canje = 0;
            $contandorVenta = 0;

            /* echo "Venta Titulo".$indice; */




            foreach ($Tranferencia_de_accionesVedidas[$indice] as $acciones) {

               if ($acciones['tipo_transferencia'] == 3) { //canje

                  $contador_canje = $contador_canje + $acciones["Acciones_Vendidas"];
               }
            }
            $AccionesOriginalesT[$index]["Titulo"] = $indice;
            $AccionesOriginalesT[$index]["Canjeadas"] = $contador_canje;
            $AccionesOriginalesT[$index]["Vendidas"] = $contandorVenta;
            $AccionesOriginalesT[$index]["Acciones_originales"] = $contador_canje + $acciones["numero_acciones"];


            $index++;
         }
      }


      $data['TitulosHistoricosAccionista'] = $TitulosHistoricosAccionista;
      $data['Tranferencia_de_accionesVedidas'] = $Tranferencia_de_accionesVedidas;
      $data['Tranferencia_de_accionesCompradas'] = $Tranferencia_de_accionesCompradas;



      $data['AccionesOriginalesT'] = $AccionesOriginalesT;


      //resgitrar las acciones realizadas del titulo antes de los canjes

      if (!empty($TitulosSuscritos)) {

         foreach ($TitulosSuscritos as $indexTS => $TS) {

            if (!empty($AccionesOriginalesT)) {

               foreach ($AccionesOriginalesT as $indexAOT => $AOT) {

                  if ($indexTS == $AOT["Titulo"]) {

                     $TitulosSuscritos[$indexTS]['Acciones'] =  $AOT["Acciones_originales"];
                  }
               }
            }
         }
      }




      $data['TitulosSuscritos'] = $TitulosSuscritos;






      $rut_accionista = $data['accionista'][0]->prsn_rut;

      $DirAccionista = $data['accionista'][0]->path;







      $data['socio'] = $this->model_accionistas->accionistas_es_socio($rut_accionista);





      $this->load->view('plantilla/Head');

      $this->load->view('accionistas/show_accionista', $data);

      $this->load->view('plantilla/Footer');
   }


   public function menu_corriente()
   {


      $this->load->view('plantilla/Head');

      $this->load->view('accionistas/menu_cuentascorrientes');

      $this->load->view('plantilla/Footer');
   }

   public function cuentas_corrientes()
   {
      $accionista = $this->input->post("rut_accionista");

      $dataAccionista = $this->model_accionistas->datos_accionista_por_rut($accionista);

      if (!empty($dataAccionista)) {

         $dataAccionista = $dataAccionista[0];



         $id = $dataAccionista->id_accionista;

         $Tranferencia_de_acciones = array();

         $data['CorreosAccionista'] = $CorreosAccionista = $this->model_accionistas->correos_junta($id);






         $data['accionista'] = $this->model_accionistas->datosaccionista($id);

         $data['titulos'] =  $this->model_accionistas->TitulosActivosporAccionista($id);




         //Consulta a BD por todos los titulos que posee o fueron alguna vez del accionista

         $TitulosHistoricosAccionista = $this->model_accionistas->HistorialTitulosporAccionista($id);




         foreach ($TitulosHistoricosAccionista as $t_h) {





            $HistoricoTitulosVendidos = $this->model_titulo->titulos_con_tranferencia_realizada($t_h->id_titulos);


            //validamos la venta, canje o herencia de acciones

            if (!empty($HistoricoTitulosVendidos)) {


               for ($i = 0; $i < count($HistoricoTitulosVendidos); $i++) {

                  //Consultamos los datos de los compradosres del los titulos

                  $LosQueCompraron = $this->model_titulo->DatosAccionistaDelTitulo($HistoricoTitulosVendidos[$i]['tiulo_actual']);
                  $LosQueCompraron = $LosQueCompraron[0];


                  $HistoricoTitulosVendidos[$i]["Comprador_IdAccionista"] = $LosQueCompraron["id_accionista"];
                  $HistoricoTitulosVendidos[$i]["Comprador_Nombres"] = $LosQueCompraron["prsn_nombres"];
                  $HistoricoTitulosVendidos[$i]["Comprador_ApellidoP"] = $LosQueCompraron["prsn_apellidopaterno"];
                  $HistoricoTitulosVendidos[$i]["Comprador_ApellidoM"] = $LosQueCompraron["prsn_apellidomaterno"];
                  $HistoricoTitulosVendidos[$i]["Comprador_Rut"] = $LosQueCompraron["prsn_rut"];
                  $HistoricoTitulosVendidos[$i]["Acciones_Vendidas"] = $LosQueCompraron["numero_acciones"];
               }



               //Guardamos en un array con indice del mismo numero de titulo del accionista de $TitulosHistoricosAccionista

               $Tranferencia_de_accionesVedidas[$t_h->id_titulos] = $HistoricoTitulosVendidos;
            }

            //Validamos la compra de acciones

            $HistoricoTitulosComprados = $this->model_titulo->titulos_con_tranferencia_recibida($t_h->id_titulos);
            $HistoricoTitulosComprados = $HistoricoTitulosComprados[0];

            if (!empty($HistoricoTitulosComprados)) {



               //Consultamos los datos de los compradosres del los titulos

               $AquienCompro = $this->model_titulo->DatosAccionistaDelTitulo($HistoricoTitulosComprados['titulo_origen']);
               $AquienCompro = $AquienCompro[0];



               $HistoricoTitulosComprados["Vendedor_IdAccionista"] = $AquienCompro["id_accionista"];
               $HistoricoTitulosComprados["Vendedor_Nombres"] = $AquienCompro["prsn_nombres"];
               $HistoricoTitulosComprados["Vendedor_ApellidoP"] = $AquienCompro["prsn_apellidopaterno"];
               $HistoricoTitulosComprados["Vendedor_ApellidoM"] = $AquienCompro["prsn_apellidomaterno"];
               $HistoricoTitulosComprados["Vendedor_Rut"] = $AquienCompro["prsn_rut"];
               $HistoricoTitulosComprados["Acciones_Compradas"] = $HistoricoTitulosComprados['numero_acciones'];

               //Guadamos el historico de acciones compradas y sus titulos

               $Tranferencia_de_accionesCompradas[$t_h->id_titulos] = $HistoricoTitulosComprados;
            } else {

               //si la accion no fue comprada a un tercera es una accion suscrita nueva

               $TitulosSuscritos[$t_h->id_titulos]['Titulo'] = $t_h->id_titulos;

               $TitulosSuscritos[$t_h->id_titulos]['Acciones'] = $t_h->numero_acciones;
               $TitulosSuscritos[$t_h->id_titulos]['Fecha'] = $t_h->fecha;
            }


            //Fin recorrido array de Titulos


         }







         $index = 0;

         if (!empty($Tranferencia_de_accionesVedidas)) {

            foreach ($Tranferencia_de_accionesVedidas as $indice => $value) {





               $contador_canje = 0;
               $contandorVenta = 0;

               /* echo "Venta Titulo".$indice; */




               foreach ($Tranferencia_de_accionesVedidas[$indice] as $acciones) {

                  if ($acciones['tipo_transferencia'] == 3) { //canje

                     $contador_canje = $contador_canje + $acciones["Acciones_Vendidas"];
                  }
               }
               $AccionesOriginalesT[$index]["Titulo"] = $indice;
               $AccionesOriginalesT[$index]["Canjeadas"] = $contador_canje;
               $AccionesOriginalesT[$index]["Vendidas"] = $contandorVenta;
               $AccionesOriginalesT[$index]["Acciones_originales"] = $contador_canje + $acciones["numero_acciones"];


               $index++;
            }
         }

         var_dump($Tranferencia_de_accionesVedidas);

         $data['TitulosHistoricosAccionista'] = $TitulosHistoricosAccionista;
         $data['Tranferencia_de_accionesVedidas'] = $Tranferencia_de_accionesVedidas;
         $data['Tranferencia_de_accionesCompradas'] = $Tranferencia_de_accionesCompradas;



         $data['AccionesOriginalesT'] = $AccionesOriginalesT;


         //resgitrar las acciones realizadas del titulo antes de los canjes

         if (!empty($TitulosSuscritos)) {

            foreach ($TitulosSuscritos as $indexTS => $TS) {

               if (!empty($AccionesOriginalesT)) {

                  foreach ($AccionesOriginalesT as $indexAOT => $AOT) {

                     if ($indexTS == $AOT["Titulo"]) {

                        $TitulosSuscritos[$indexTS]['Acciones'] =  $AOT["Acciones_originales"];
                     }
                  }
               }
            }
         }




         $data['TitulosSuscritos'] = $TitulosSuscritos;






         $rut_accionista = $data['accionista'][0]->prsn_rut;

         $DirAccionista = $data['accionista'][0]->path;







         $data['socio'] = $this->model_accionistas->accionistas_es_socio($rut_accionista);






         $this->load->view('accionistas/cuenta_corriente_accionista', $data);
      } else {


         //send message error header
         header('HTTP/1.1 500 Internal Server Booboo');
         header('Content-Type: application/json; charset=UTF-8');
         die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
      }
   }






   public function verFechas()

   {
      // $data['accionista'] = $this->model_accionistas->datosaccionista($id);

      // $data['titulos'] = $this->model_accionistas->validar_estado($id);
      $data[] = '';






      $this->load->view('plantilla/Head');

      $this->load->view('accionistas/por_fechas', $data);

      $this->load->view('plantilla/Footer');
   }


   public function bajas()

   {
      $activos = $this->model_accionistas->id_activos();


      $bajas = [];

      foreach ($activos as $a) {

         if (empty($this->model_accionistas->validar_estado($a->id_accionista))) {

            array_push($bajas, $this->model_accionistas->datosaccionista($a->id_accionista));
         }
      }

      $data['bajas'] = $bajas;






      $this->load->view('plantilla/Head');

      $this->load->view('accionistas/bajas', $data);

      $this->load->view('plantilla/Footer');
   }

   public function dar_debaja()
   {

      $id_accionista = $this->input->post('accionista');
      $fecha = $this->input->post('fecha1');


      $baja = array(

         'estado_accionista' => 0,
         'fecha_baja' => $fecha,
      );

      $this->model_accionistas->update($baja, $id_accionista);

      $this->session->set_flashdata('exito', 'Actualizado');














      redirect('accionistas/inicio/bajas');
   }





   public function informe_fechas_accionistas()

   {



      $tipo = $this->input->post('tipoinforme');
      $fecha1 = $this->input->post('fecha1');
      $fecha2 = $this->input->post('fecha2');


      switch ($tipo) {
         case 0:

            $result = $this->model_accionistas->buscar_por_fecha_baja($fecha1, $fecha2, $tipo);
            break;



         case 1:

            $result = $this->model_accionistas->buscar_por_fecha_activo($fecha1, $fecha2, $tipo);
            break;
      }


      print_r(json_encode($result));
   }


   public function informe_fechas_accionistas2()

   {



      $tipo = $this->input->post('tipoinforme');
      $data['fecha1'] = $fecha1 = $this->input->post('fecha1');
      $data['fecha2'] = $fecha2 = $this->input->post('fecha2');



      $cabecera = "";
      $pie = "<div>Pág {PAGENO}/{nb}</div>";
      $orientacion = "P";



      switch ($tipo) {
         case 0:

            $data['accionista'] = $this->model_accionistas->buscar_por_fecha_baja($fecha1, $fecha2, $tipo);
            var_dump($data);
            $html = $this->load->view('accionistas/reporte_bajas', $data, true);
            break;





         case 1:

            $data['accionista'] = $this->model_accionistas->buscar_por_fecha_activo($fecha1, $fecha2, $tipo);
            $html = $this->load->view('accionistas/reporte_incorporacion', $data, true);
            break;
      }




      //$html = mb_convert_encoding($html, 'UTF-8', 'ISO-8859-1');
      ob_end_clean();
      $html = html_entity_decode($html);
      $mpdf = new \Mpdf\Mpdf(['debug' => true]);
      //  $stylesheet = file_get_contents(base_url().'/assets/css/pdf.css'); // la ruta a tu css 
      // $mpdf->WriteHTML($stylesheet,1);
      $mpdf->AddPage($orientacion);
      $mpdf->SetHTMLHeader($cabecera);
      $mpdf->shrink_tables_to_fit = 1;
      $mpdf->WriteHTML($html);
      $mpdf->SetHTMLFooter($pie);
      $mpdf->Output();
   }









   function informes()
   {

      $informe = "" . $this->uri->segment('4') . "";



      if (empty($informe)) {
         $informe = $this->input->post('informe');
      }

      $hoy = date("Y-m-d H:i:s");

      $cabecera = "";
      $pie = "<div>Pág {PAGENO}/{nb}</div>";
      $orientacion = "P";



      switch ($informe) {
         case 1:
            $data['accionista'] = $this->model_accionistas->accionistas_alfabetico();
            $html = $this->load->view('accionistas/reporte_accionistaCMF', $data, true);
            break;
         case 2:
            $data['accionista'] = $this->model_accionistas->accionistas_mayoritarios();
            $html = $this->load->view('accionistas/reporte_mayoritarios', $data, true);
            break;

         default:

            break;
      }
      //$html = mb_convert_encoding($html, 'UTF-8', 'ISO-8859-1');
      ob_end_clean();
      $html = html_entity_decode($html);
      $mpdf = new \Mpdf\Mpdf(['debug' => true]);
      //  $stylesheet = file_get_contents(base_url().'/assets/css/pdf.css'); // la ruta a tu css 
      // $mpdf->WriteHTML($stylesheet,1);
      $mpdf->AddPage($orientacion);
      $mpdf->SetHTMLHeader($cabecera);
      $mpdf->shrink_tables_to_fit = 1;
      $mpdf->WriteHTML($html);
      $mpdf->SetHTMLFooter($pie);
      $mpdf->Output();
   }


   function informesExcel()

   {

      $informe = "" . $this->uri->segment('4') . "";



      if (empty($informe)) {
         $informe = $this->input->post('informe');
      }

      if ($informe == 1) {

         $data = $this->model_accionistas->accionistas_alfabetico();
         $this->reporte_excel_all($data, $informe);
      }
      if ($informe == 2) {

         $data = $this->model_accionistas->accionistas_mayoritarios();
         $this->reporte_excel_all($data, $informe);
      }
   }

   public function reporteCMF()
   {

      /**
       * segun circular N° 1481, CMF
       *  REF.: INSTRUYE EL ENVIO POR MEDIO ELECTRONICO, DE INFORMACION CONTENIDA EN LISTA DE ACCIONISTAS (O SOCIOS) DE SOCIEDADES QUE SEÑALA Y REGLAMENTA EL ARTICULO 7º DE LA LEY Nº 18.046. DEROGA CIRCULAR Nº 351 de 1983.  
       */




      $fecha = date("y-m-d"); //fecha actual al moomento de generar el informe

      $fecha = explode("-", $fecha);



      $anoMes = $fecha[0] . $fecha[1];

      $periodo = $fecha[0] . $fecha[1] . $fecha[2];;




      $TXT = "";
      $total_registros = 0;

      $datosSA = $this->model_sa->datos_sa();
      $datosSA = $datosSA[0];


      $razon_social = $datosSA->sa_nombre;

      $rutSA = explode("-", $datosSA->sa_rut); // separo el string del rut por el caracter -  y genero un array con los valores [0] = rut [1] = dv






      $PrimerRegistro = array(

         "TIPO-REGISTRO" => "1",
         "PERIODO" => rellenoString($periodo, 8, " ", "der"),
         "RUT-SOCIEDAD" => rellenoString($rutSA[0], 9, "0", "izq"),
         "DIG-VER-RUT" => rellenoString($rutSA[1], 1, "0", "der"),
         "RAZON-SOCIAL" => rellenoString($razon_social, 100, " ", "der"),
         "FILLER" => rellenoString("", 126, " ", "der"),

      );


      /* var_dump($PrimerRegistro); */

      $PrimeraSeccion = implode("", $PrimerRegistro); // primera seccion del registro , se une todo el array en un string

      $TXT .= $PrimeraSeccion . "\n";
      $total_registros++;





      //Generacion de segunda seccion del registro

      $accionistas = $this->model_accionistas->accionistas_alfabetico_apellido();


      $contador = 0;
      foreach ($accionistas as $indexA => $acc) {


         $rutA = explode("-", $acc->prsn_rut);

         if ($acc->prsn_tipo == "1") {
            $tipoP = "C";
         }

         if ($acc->prsn_tipo == "0") {
            $tipoP = "A";
         }

         $dataP = $this->model_accionistas->datos_personales($acc->prsn_rut);



         $acciones = rellenoString($acc->numero_acciones, 15, "0", "izq");
         $decimales = rellenoString("0", 4, "0", "izq");

         $suscrito = $acciones . $decimales;




         $SegundoRegistro[$contador] = array(

            "TIPO-REGISTRO" => "2", // por el ser el tipo 2 de registro segun el manual
            "SERIE" => "ZZ", // por defecto segun documento
            "RUT-ACCIONISTA" =>  rellenoString(formato_caracteres($rutA[0]), 9, "0", "izq"),
            "VER-RUT-ACCIONISTA" =>  rellenoString($rutA[1], 1, "0", "izq"),
            "TIPO-PERSONA" =>  rellenoString($tipoP, 1, " ", "izq"),
            "NOMBRES" =>  rellenoString(formato_caracteres($acc->prsn_nombres), 80, " ", "der"),
            "APELLIDO-PATERNO" =>  rellenoString(formato_caracteres($acc->prsn_apellidopaterno), 20, " ", "der"),
            "APELLIDO-MATERNO" =>  rellenoString(formato_caracteres($acc->prsn_apellidomaterno), 20, " ", "der"),
            "DOMICILIO" =>  rellenoString(formato_caracteres($acc->prsn_direccion), 40, " ", "der"),
            "CIUDAD" =>  rellenoString(formato_caracteres($dataP->provincia_nombre), 15, " ", "der"),
            "COMUNA" =>  rellenoString(formato_caracteres($dataP->comuna_nombre), 15, " ", "der"),
            "REGION" =>  rellenoString(formato_caracteres($dataP->region_nro_svs), 2, "0", "izq"),
            "TIPO-DATO " =>  "N",
            "SUSCRITO" =>   $suscrito,
            "PAGADO" =>   $suscrito,





         );
         $total_registros++;
         $contador++;
      }

      $SegundaSeccion = array();

      foreach ($SegundoRegistro as $index => $registro) {

         $SegundaSeccion[$index] = implode("", $registro);
         $TXT .= $SegundaSeccion[$index] . "\n";
      }
      /* 
      var_dump($SegundaSeccion); */


      // generacion de cuarta seccion del registro , la tercera seccion del registro no se incluye en el archivo txt
      $total_registros++;
      $CuartoRegistro = array(

         "TIPO-REGISTRO" => "4",
         "REGISTROS" => rellenoString($total_registros, 8, "0", "izq"),
         "FILLER" => rellenoString("", 236, " ", "der"),

      );
      /*  var_dump($CuartoRegistro); */

      $CuartaSeccion = implode("", $CuartoRegistro);
      /*       var_dump($CuartaSeccion); */

      $TXT .= $CuartaSeccion . "\n";


      /* var_dump($TXT); */

      #######   Generamos el archivo TXT ###############

      $nombre_archivo = "RGAC" . $anoMes . ".txt";



      $ruta = "archivos/txt/";

      if (!file_exists($ruta)) {
         mkdir($ruta, 0777, true);
         index_archivos($ruta);
      }


      $ruta_archivo = $ruta . $nombre_archivo;

      $file = fopen($ruta_archivo, "w");

      fwrite($file, $TXT);
      fclose($file);

      $this->load->helper('download');
      $data = file_get_contents($ruta_archivo); //
      $name = $nombre_archivo;
      force_download($name, $data);


      
   }









   //Funciones privadas

   private function reporte_excel_all($data, $tipo)
   {



      $spreadsheet = new Spreadsheet();

      $sheet = $spreadsheet->getActiveSheet();

      $sheet->setCellValue('B1', 'Rut Accionista');
      $sheet->setCellValue('C1', 'Nombre');
      $sheet->setCellValue('D1', 'Incorporacion');
      $sheet->setCellValue('E1', 'Acciones');


      //$data =  $this->model_test->cargas_activosALL();
      $nro = 1;
      $start = 2;
      $total = 0;
      foreach ($data as $c) {

         $sheet->setCellValue('B' . $start, $this->getPuntosRut($c->prsn_rut));
         $sheet->setCellValue('C' . $start, $c->prsn_nombres . " " . $c->prsn_apellidopaterno . " " . $c->prsn_apellidomaterno);
         $sheet->setCellValue('D' . $start, $c->fecha);
         $sheet->setCellValue('E' . $start, $c->numero_acciones);




         $start = $start + 1;
         $nro = $nro + 1;
         $total++;
      }
      $start = $start - 1;

      if ($tipo == 1) {
         $sheet->setCellValue('I5', 'Existen un total de ' . $total . ' accionistas');
         $sheet->getColumnDimension('I')->setAutoSize(true);
      }




      $styleThinBlackBorderOutline = [
         'borders' => [
            'allBorders' => [
               'borderStyle' => Border::BORDER_THIN,
               'color' => ['argb' => 'FF000000'],
            ],
         ],
      ];

      //Agregar Filtros
      $sheet->setAutoFilter('B1:E' . $start);
      //Fuente a Nregrita
      $sheet->getStyle('A1:E1')->getFont()->setBold(true);
      $sheet->getStyle('B1:E' . $start)->applyFromArray($styleThinBlackBorderOutline);
      //Aliniamientado centrado
      //Tamano letra
      $sheet->getStyle('A1:E2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
      $sheet->getStyle('A2:E' . $start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('A1:E' . $start)->getFont()->setSize(12);


      //Custom width for Individual Columns

      $columnas = array('B', 'C', 'D', 'E');

      foreach ($columnas as $col) {
         //$sheet->getColumnDimension($col)->setAutoSize(true);

         $sheet->getColumnDimension($col)->setAutoSize(true);
      }
      $fecha = date('d-m-Y H:i:s');

      $writer = new Xlsx($spreadsheet);

      if ($tipo == 1) {
         $filename = 'Accionistas ' . $fecha;
      }
      if ($tipo == 2) {
         $filename = 'Accionistas Mayoritarios ' . $fecha;
      }


      ob_end_clean();
      header('Content-Type: application/vnd.ms-excel');

      header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');

      header('Cache-Control: max-age=0');

      $writer->save('php://output');
   }












   private function getSexo($sexo)
   {

      if ($sexo == 1) {
         return ("Masculino");
      }
      if ($sexo == 0) {
         return ("Femenino");
      }
   }

   private function getPuntosRut($rut)
   {

      $rutTmp = explode("-", $rut);

      return number_format($rutTmp[0], 0, "", ".") . '-' . $rutTmp[1];
   }

   private function getParentestco($id)
   {

      if ($id == 1) {
         return ("CONYUGE");
      }
      if ($id == 2) {
         return ("HIJO/A");
      }
      if ($id == 3) {
         return ("PADRE");
      }
      if ($id == 4) {
         return ("MADRE");
      }
      if ($id == 5) {
         return ("HIJASTRO");
      }
      if ($id == 6) {
         return ("OTRO FAMILIAR");
      }
   }

   private function getEdad($fechanacimiento)
   {

      list($ano, $mes, $dia) = explode("-", $fechanacimiento);
      $ano_diferencia  = date("Y") - $ano;
      $mes_diferencia = date("m") - $mes;
      $dia_diferencia   = date("d") - $dia;
      if ($dia_diferencia < 0 || $mes_diferencia < 0)
         $ano_diferencia--;
      return $ano_diferencia;
   }
}
