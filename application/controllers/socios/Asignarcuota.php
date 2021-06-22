<?php class  asignarcuota extends CI_Controller {



	function __construct() {

            parent::__construct();

		$this->load->library('session');		

	    $this->load->helper('url');

	    $this->load->helper('form');

		$this->load->library('form_validation');

		$this->load->library('session');

		$this->load->library('mpdf60/Mpdf');

		$this->load->model('model_socios');

	}

public function index(){



		$data['personas'] = $this -> model_socios -> all_personas();



		$this->load->view('plantilla/Head_v1');

		$this->load->view('socios/asignarCuota',$data);

		$this->load->view('plantilla/Footer');		

	}



public function buscarsocio(){



        $rutSocio = $_POST['rutSocio'];

     



        $datos = $this -> model_socios -> persona($rutSocio);

        foreach($datos as $d){

             $rut = $d-> prsn_rut;

             $nombre = $d-> prsn_nombres;

             $paterno = $d-> prsn_apellidopaterno;

             $materno = $d-> prsn_apellidomaterno;





        }

        $datos2 = $this -> model_socios -> corp_socios($rutSocio);

        $i = 0;

        $arrNomb = [];

        $arrFech = [];

        foreach($datos2 as $d2){

             

             $arrNomb[$i] = $d2-> co_nombre; 

             $arrFech[$i] = $d2-> fecha_registro;

             $i = $i+1;



        }

        

        $fechaReg = $arrFech[0];

        $datoFecha = explode("-", $fechaReg);

        $año = $datoFecha[0];

        $mes = $datoFecha[1];

        $añoActual = date("Y");

        $cantAños = $añoActual - $año;

        $mes = intval($mes);

        $año = intval($año);

        

        if($mes < 6){

           $inicio = 1;

        }else{

            $inicio = 2;

        }



        $arrCuota = [];

        $h=0;

        for($i=0;$i<=$cantAños;$i++){            

            

            for($j=$inicio;$j<=2;$j++){

                $num_cuota =  $this -> model_socios -> num_cuota($año,$j);                

                $estado = $this -> model_socios -> verificarCuota($rutSocio,$num_cuota);



                if($estado == 0){

                    $Ecuota = 0;//cuota no asociada al socio



                }else{

                    $Ecuota = 1;//cuota asociada al socio

                }

                $nombCuota = $año.'-'.$j;

                $arrCuota[$h] = $nombCuota;

                $arrEcuota[$h] = $Ecuota;



                $h=$h+1;



                }
            $inicio = 1;
            $año=$año + 1;             

        }

      



        



    if(empty($_POST['paso'])){

        $data = array(0 => $nombre,

                      1 => $paterno,

                      2 => $materno,

                      3 => explode('-', $rutSocio),

                      4 => $arrNomb,

                      5 => $arrFech,

                      6 => $arrCuota,

                      7 => $arrEcuota,

                      8 => $h);

        echo json_encode($data);

    }else{

      $data['nombre'] = $nombre;

      $data['paterno'] = $paterno;

      $data['materno'] = $materno;

      $data['arrNomb'] = $arrNomb;

      $data['arrFech'] = $arrFech;

      $data['arrCuota'] = $arrCuota;

      $data['arrEcuota'] = $arrEcuota;

      $data['cant'] = $h;

      $data['rut'] = $rutSocio;



                     

        //$datos = json_encode($data);

       $this->load->view('plantilla/Head_v1');

       $this->load->view('socios/asignarCuotaPago',$data);

        $this->load->view('plantilla/Footer');  

    }

}





public function asignarCuota(){



$rutSocio = $_POST['rutSocio'];

$año = $_POST['año'];

$sem = $_POST['sem'];



 $num_cuota =  $this -> model_socios -> num_cuota($año,$sem);

 $cons_saldo =  $this -> model_socios -> datos_cuota($sem,$año);

 foreach($cons_saldo as $cs){             

             $saldo = $cs-> valor; 

        }

 $cons_idsocio = $this -> model_socios ->IdSocio($rutSocio);

 $primerRegistro= true;         

       foreach ($cons_idsocio as $row_idsocio) {

                     if($primerRegistro){

                        $id_s = $row_idsocio -> id_socio;                        

                        $primerRegistro= false;//Nos aseguramos que solo se ejecute una vez

                                 }                    

                               }



 $data = array(

                  'cuota_ordinaria_id_cuota' => $num_cuota,

                  'total_pagado' => 0,

                  'observ_cuota' => 'NO PAGADO',

                  'saldo' => $saldo,

                  'pagado_stadio' => 0,

                  'pagado_concordia' => 0,

                  'pagado_atletico' => 0,

                  'pagado_centro' => 0,

                  's_socios_id_socio' => $id_s,

                  's_socios_prsn_rut' => $rutSocio,

                  'estado' => 0,

                  'pagado_scuola' =>0);

 $this -> model_socios -> insertAsignarCuota($data);





}













}//fin CI_controller

