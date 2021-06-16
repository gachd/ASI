<?php

//defined('BASEPATH') OR exit('No direct script access allowed');



class bajaCarga extends CI_Controller {



	function __construct() {		 

      parent::__construct();

	    $this->load->library('session');

	    $this->load->model('model_socios');

	    $this->load->helper('url');

	    $this->load->helper('form');

	    $this->load->library('form_validation');

	    $this->load->library('calendar');

	    $this->load->library('session');
     }



	public function index(){
    
    $date  = "";

		$data['personas']	=$this -> model_socios -> all_personas($date);	

		$data['nacionalidad']	=$this -> model_socios -> all_nacionalidades($date);

		$data['comunas']	=$this -> model_socios -> all_comunas($date);

		$data['laboral']	=$this -> model_socios -> all_condicionlab($date);

		$data['estado_civil']	=$this -> model_socios -> all_estadocivil($date);

		$data['corporacion'] = $this-> model_socios->all_corporaciones();

		$data['socio_pat'] = $this-> model_socios->all_sociospat();

		$data['parentesco'] = $this-> model_socios->all_parentesco();

			

    $this->load->view('plantilla/Head');

		$this->load->view('socios/bajaCarga',$data);

		$this->load->view('plantilla/Footer');	

	}



	public function mostrar_datos(){

       // $rut_socio= $this->uri->segment('4');

        $rut = $this->input->post('rut');



    //    $paso = $this->input->post('enviar');

   

		$data['corporaciones']= $this -> model_socios -> all_corporaciones();

	

		$data['datos'] = $this -> model_socios -> persona($rut);

        $data['sociosDatos'] = $this -> model_socios -> sociosDatos($rut);

		$data['patrocinadores'] = $this -> model_socios -> patrocinadores($rut);

		$data['patrocinados'] = $this -> model_socios -> patrocinados($rut);

		$data['cargas'] = $this -> model_socios -> cargas($rut);

		$data['cuotas'] = $this -> model_socios -> cuotas($rut);

		$data['estado_civil2'] = $this -> model_socios -> all_estadocivil();

		$data['nac'] = $this -> model_socios -> all_nacionalidades();

		$data['comuna']= $this -> model_socios -> all_comunas();

		$data['condicion_lab'] = $this -> model_socios -> all_condicionlab();

        $data['condicion'] = $this -> model_socios -> all_condicion();

        $data['condicion2'] = $this -> model_socios -> all_condicion2();

        $data['tipo'] = $this -> model_socios -> all_tipo();

        $data['subCond'] = $this -> model_socios ->all_subcond();

        $data['parentesco'] = $this-> model_socios->all_parentesco();



       

        	$this->load->view('socios/baja_Carga',$data);

    

		



       

               







 }



 public function datosCarga(){



    $rutCarga = $_POST['rutCarga'];

    $rutSocio = $_POST['rutSocio'];

    

    $cargas = $this -> model_socios -> cargas($rutSocio);

    $cargasSocios = $this -> model_socios -> cargasSocios($rutSocio,$rutCarga);

    $datosCargas = $this -> model_socios -> persona($rutCarga);

    $parentesco = $this-> model_socios->all_parentesco();



    foreach($cargasSocios as $cs){

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

          $estado = $cs->estado_carga;



          if($estado == 0){

            $estado_nom = 'ACTIVO';

            $estado2 = 1;

            $estado_nom2 = 'INACTIVO';

          }else{

            $estado_nom = 'INACTIVO';

            $estado_nom2 = 'ACTIVO';

            $estado2 = 0;

          }





          if ($est == 1) {

            $estudia = 'SI';

            $estudia2 = 'NO';

            $est2 = 0;

          }else{

            $estudia = 'NO';

            $estudia2 = 'SI';

            $est2 = 1;

          }





          if($sexo == 1){

            $sexo_nom = 'MASCULINO';

            $sexo2 = 0;

            $sexo2_nom = 'FEMENINO';



          }else{

            $sexo_nom = 'FEMENINO';

            $sexo2 = 1;

            $sexo2_nom = 'MASCULINO';

          }

                        

                         }



    ?>

    <div class="col-md-6 col-sm-6 col-xs-12">

      <div class="panel panel-default"> 

        <div class="panel-body">

                   <form class="form-horizontal"> 

                    <div class="form-group">

                      <div class="col-sm-12">

                      <label id="nomCarga"><?php echo $nombre.' '.$paterno.' '.$materno ?></label>  

                      </div> 

                    </div>

                       <div class="form-group">

                           <div class="col-sm-6">

                              <label id="datosCarga">RUT: <?php echo $rutCarga ?></label>   

                           </div> 

                           <div class="col-sm-6">              

                              <label id="datosCarga">PARENTESCO: <?php echo $parent_nom ?></label>

                           </div>

                       </div> 

                        <div class="form-group">

                           <div class="col-sm-6">

                              <label id="datosCarga">NACIMIENTO: <?php echo $nac ?></label>   

                           </div> 

                           <div class="col-sm-6">              

                              <label id="datosCarga">GÉNERO: <?php echo $sexo_nom ?></label>

                           </div>

                       </div> 

                       <div class="form-group">

                           <div class="col-sm-6">

                              <label id="datosCarga">CELULAR: <?php echo $celu ?></label>   

                           </div> 

                           <div class="col-sm-6">              

                              <label id="datosCarga">EMAIL: <?php echo $mail ?></label>

                           </div>

                       </div>

                       <div class="form-group">

                           <div class="col-sm-6">

                              <label id="datosCarga">ESTUDIANTE: <?php echo $estudia ?></label>   

                           </div>                           

                       </div> 







                    </form> 

        </div>

      </div>

    </div></div>



<div class="col-md-6 col-sm-6 col-xs-12">

      <div class="panel panel-default"> 

        <div class="panel-body">

           <form class="form-horizontal"> 

                      <div class="form-inline">   

                      <div class="col-sm-4">                    

                        <label>ESTADO</label>

                      </div> 

                        <select class="form-control" name="est_carga" id="est_carga">                       

                             <option value="<?php echo $estado;?>"><?php echo $estado_nom;?></option>

                             <option value="<?php echo $estado2;?>"><?php echo $estado_nom2;?></option>

                       </select>

                      </div>  

                      <div class="form-inline"> 

                      <div class="col-sm-4">                          

                        <label>OBSERVACIONES</label>

                      </div>

                        <textarea id="obs_estado" rows="10" cols="50" class="form-control"></textarea>

                        <input type="hidden" name="rutCarga" id="rutCarga" value="<?php echo $rutCarga ?>">

                      </div>                     

                                           

                   </form>

<script type="text/javascript">



$(document).ready(function() {

  var btnGuardar = $("#bajaCarg");

  btnGuardar.click(function() {

  var rutCarga = $("#rutCarga").val();      

  var estCarga = $("#est_carga option:selected").val();

  var obs = $("#obs_estado").val();

  var formData = new FormData();  



    

      //Ojo: En este caso 'foto' será el nombre con el que recibiremos el archivo en el servidor

      formData.append('rutCarga', rutCarga);

      formData.append('estado', estCarga);  

      formData.append('obs', obs);      

      //console.log(formData);

     // formData.append('rut', )

      $.ajax({

        url: "<?php echo base_url()?>socios/bajacarga/baja_carga",

        data: formData,

        type: 'POST',

        contentType: false,

        processData: false,

        success: function(resultados) {



          console.log("Petición terminada. Resultados", resultados);

       // $('#msg').fadeIn();     

         // setTimeout(function() {

           //        $("#msg").fadeOut();           

             //},5000);

            //setTimeout("window.location.href = '<?php echo base_url()?>socios/editacarga'",3500);

          

        }



      });

   

  });

});



           

  //});

</script>

                   <?php

 }



 public function baja_carga(){



   

      $fecha = date('Y-m-d');

    	$rutCarga    = $_POST['rutCarga'];



     $consultar_obs =  $this -> model_socios -> consultar_obs($rutCarga);

      foreach($consultar_obs as $cs){

          $obs_anterior = $cs->obs_estado;

        }



      $estado    = $_POST['estado'];



      if(!empty($obs_anterior)){

        $obs    = $fecha .'-['. $_POST['obs'] .']';

        $obs_final = $obs_anterior .'/'. $obs;

      }else{

        $obs_final = $fecha .'-['. $_POST['obs'] .']';

      }

      

    //  $obs_final = $obs_anterior

            	

    $data_carg = array(                  

                  'estado_carga' => $estado,

                  'obs_estado' => $obs_final);



     $this -> model_socios -> actualizar_carg($data_carg,$rutCarga);



 



  





}

    

     



 

}

?>