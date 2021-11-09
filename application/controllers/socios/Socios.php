<?php 

require_once APPPATH.'/vendor/autoload.php';

class socios extends CI_Controller {

	

   function __construct() {

     parent::__construct();
		$this->load->library('session');	       
    $this->load->model('model_socios');
	  $this->load->helper('url');
    $this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');

		//$this->load->library('mpdf60/Mpdf');

	}



	

	public function index(){

	 /*  $meshoy = date('m');
     $diahoy = date('d');
     $cont = 0;
     $cumpleañeros = [];
     $edad = [];
     $num_cuota = 0;

		//$data['activos'] = $this -> model_socios->socios_activos();	

		//$data['inactivos'] = $this -> model_socios->socios_inactivos();	

			
    $socios = $this -> model_socios->sociosVigentes();
         
     foreach($socios as $s){
          $nac = $s-> prsn_fechanacimi;
          $mesnac = date('m', strtotime($nac)); 
          $dianac = date('d', strtotime($nac)); 



          $rut = $s-> prsn_rut;
          $fechaReg =  $this -> model_socios->fechaReg($rut);
          $datoFecha = explode("-", $fechaReg);

          $año = $datoFecha[0];
          $mes = $datoFecha[1];

          if($mes < 6){

           $inicio = 1;

        }else{

            $inicio = 2;

        }

    /*    $num_cuota =  $this -> model_socios -> num_cuota($año,$inicio); 

        if(!empty($num_cuota)){
           $eliminar = $this -> model_socios -> eliminar_cuota($rut,$num_cuota); 
        }

      //  $eliminar = $this -> model_socios -> eliminar_cuota($rut,$num_cuota); 
      if(($meshoy == $mesnac) && ($diahoy == $dianac)){
          $cont = $cont + 1;
          $cumpleañeros[] = $rut;
          
         list($ano,$mes,$dia) = explode("-",$nac);

                      $ano_diferencia  = date("Y") - $ano;

                      $mes_diferencia = date("m") - $mes;

                      $dia_diferencia   = date("d") - $dia;

                      if ($dia_diferencia < 0 || $mes_diferencia < 0)

                        $ano_diferencia--;

                      $edad[] = $ano_diferencia;
        
       }

     }
		$data['cumpleañeros'] = $cumpleañeros;
    $data['cumple'] = $cont;
    $data['edad'] = $edad;*/
    
    $cumpleañeros =  $this -> model_socios->cumpleaños_hoy();


    $cumple = count($cumpleañeros);




    $data['socios'] = $this -> model_socios->sociosVigentes();  

    $data['cumpleañeros'] = $cumpleañeros; 
    $data['cumple'] = $cumple; 
   
    


		$this->load->view('plantilla/Head');

		$this->load->view('socios/socios',$data);

		$this->load->view('plantilla/Footer');		

	}




	 function detallePagos(){

   $rut= $this->uri->segment(4);
    $data['rut']=$rut;

    $data['datos_personales'] = $this -> model_socios -> persona($rut);
    $data['cuotas'] = $this -> model_socios -> cuotas($rut); 
    $data['fechaReg'] =  $this -> model_socios->fechaReg($rut); 

     $this->load->view('plantilla/Head');
    $this->load->view('socios/detallePagos',$data);
    $this->load->view('plantilla/Footer');    
 
    
  }





	

  function informes (){

    $informe ="".$this->uri->segment('4')."";
    


    if(empty($informe)) {
      
      $informe = $this->input->post('informe');
      
    }
    



        $hoy = date("Y-m-d H:i:s");  
   
        $cabecera="";
        $pie = "<div>Pág {PAGENO}/{nb}</div>";
        $orientacion="L";
        
  
        
          switch ($informe) {
      case 1:
          $data['socios'] = $this -> model_socios->sociosVigentes();
          $html=$this->load->view('reportes/consolidado',$data,true);
      break;
      case 2:
          $data['socios'] = $this -> model_socios->sociosActivos();
          $html=$this->load->view('reportes/consolidado',$data,true);
      break;
     case 3:
          $data['socios'] = $this -> model_socios->sociosHonorarios();
          $html=$this->load->view('reportes/consolidado',$data,true);
      break;
      case 4:
          $data['socios'] = $this -> model_socios->sociosActivos();
          $html=$this->load->view('reportes/consolidado2',$data,true);
      break;
      case 5:
          $data['socios'] = $this -> model_socios->sociosActivos();//informe socios con deuda
          $html=$this->load->view('reportes/consolidado3',$data,true);
      break;


      default:
        # code...
        break;
        }
        //$html = mb_convert_encoding($html, 'UTF-8', 'ISO-8859-1');
          ob_end_clean();
          $html = html_entity_decode($html);
          $mpdf = new \Mpdf\Mpdf(['debug'=>true]); 
        //  $stylesheet = file_get_contents(base_url().'/assets/css/pdf.css'); // la ruta a tu css 
           // $mpdf->WriteHTML($stylesheet,1);
          $mpdf->AddPage($orientacion);
          $mpdf->SetHTMLHeader($cabecera);
          $mpdf->shrink_tables_to_fit =1;
          $mpdf->WriteHTML($html);
          $mpdf->SetHTMLFooter($pie);
          $mpdf->Output();
      
        




    

}
      

    
 }
