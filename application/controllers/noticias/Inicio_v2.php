<?php
class inicio extends CI_Controller {

function __construct() {
		 
        parent::__construct();
        $this->load->model('model_noticias');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library('session');
	}
	
	
	public function index(){
		$noti['noti'] = $this->model_noticias->getNoticias();
		$this->load->view('plantilla/Head_v1');
		$this->load->view('noticias/noticias',$noti);
		$this->load->view('plantilla/Footer');		

	}	

	
/*funcion para listar las noticias*/
function Listar_noticias(){

		$filtrador= $this->input->post('filtrador');
		$todas = $this-> model_noticias -> all_noticias();
		if(!empty($filtrador)){

			/*si selecciono todas retorno todas las noticias*/
			if($filtrador == 3){
				$datos= $this -> model_noticias -> all_noticias();

			}
			/*si selecciono todas retorno 10 ultimas noticias*/
			if($filtrador == 1){
				$datos= $this -> model_noticias -> ten_noticias();

			}
			/*si selecciono todas retorno 20 ultimas noticias*/
			if($filtrador == 2){
				$datos= $this -> model_noticias -> twenty_noticias();

			}



			if(empty($datos)){
			echo'No existen Noticias en su Registro';
			}else{
			 
				  echo' <table class="table table-hover tbl-dep" >
				<thead>
				  <tr>
					<th>#</th>
					<th>Titulo</th>
					<th>Fecha</th>
					<th>Eliminar</th>
					<th>Actualizar</th>
				  </tr>
				</thead>
				<tbody>
			   ';
			 foreach($datos as $sd){
				  echo'<tr>
					<td class="sub_dep" id="'.$sd->id.'">'.$sd->id.'</td>
					<td class="sub_dep" id="'.$sd->id.'">'.$sd->titulo.'</td>
					<td class="sub_dep" id="'.$sd->id.'">'.$sd->fecha.'</td>';
				
				
				/* boton eliminar */
				 echo'</td>
				 <td>
				 
				 <button type="button" class="btn btn-default btn-xs eliminar"  id="'.$sd->id.'"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
				 
				</td>
				 
				 ';
				 foreach ($todas as $objeto ) {
				 	
				 
				 if ($sd->id == $objeto->id ) {
				 	/* boton actualizar */
				
				 	  echo'</td>
				 	  <td>
				 <button type="button" class="btn btn-default btn-xs editar"  id="'.$sd->id.'">
				  <span class="glyphicon glyphicon-cog" aria-hidden="true"></span></button>
				</td>';
				 }
				 	  				 
                                
				 }
				 
				  }
				}
				
			}else{
		 echo 'error';
				} }
				/* ------------ FIN FUNCION ELIMINAR NOTICIAS ----------------- */

/*ELIMINAR NOTICIA*/
/*0 = stadio
1 = instituto
2 = ambas */
    function eliminar(){
		$id = $_POST['trid'];
		$this -> model_noticias -> eliminar_noticia($id);
		//$this -> model_noticias -> eliminar_galeria($id);
	    $this->session->set_flashdata('category_success', 'Eliminado Correctamente.');
				echo'<script>
				window.location.href = "'.base_url().'noticias/inicio";
				</script>';
	}


/* AGREGAR NOTICIA */
public function agregar()
{
/*
$direccion1=getcwd().'/../assets/img/actividades/';
$direccion2=getcwd().'/../assets/img/instituto';

var_dump($direccion1);
var_dump($direccion2);*/


$directorio_actividades = getcwd().'/../assets/img/actividades/';
$directorio_instituto = getcwd().'/../assets/img/instituto/noticias';



       /*NOTICIAS*/
	# tomo los valores de los formularios
	$instituto = $this->input->post('txt_tipo');
	$titulo= $this->input->post('txt_titulo');

	/*cambia los espacios por guiones*/
	$titulo_cambiado = str_replace(" ", "_", $titulo);
		
		# agrego al stadio
	if ($instituto==0) {
		/*existe la carpeta*/
		if (!file_exists($directorio_actividades.'/'.$titulo_cambiado )) {
   				 mkdir($directorio_actividades.'/'.$titulo_cambiado, 0777, true);

   				 	$fecha = $this->input->post('txt_fecha');
					$descripcion = $this->input->post('txt_descripcion');
					$foto_principal = $this->input->post('foto_principal');
					/*la carpeta donde ira*/
	 				$carpeta = '/'.$titulo_cambiado;

	 				// Contar envían por el plugin
				$Imagenes = count(isset($_FILES['imagenes']['name'])?$_FILES['imagenes']['name']:0);
	 					/*ultimo registro de la tabla galeria*/
	 					$r = $this-> model_noticias->ultimoreg();
	 					$array_noticia = array
						( 'id' => ($r[0]->id +1) ,
						'titulo' => $titulo ,
						'fecha' => $fecha ,
						'descripcion' => $descripcion ,
						'imagen' => ($r[0]->id + 1).'.jpg',
						'instituto' => $instituto ,
						'carpeta' => $carpeta,
						'img_inicio' => $r[0]->id + 1,
						'img_fin' => ($r[0]->id + $Imagenes)
						 );

						$this->model_noticias->publicar_noticia($array_noticia);


						/*carpeta donde se ejecuta*/
						$carpetaAdjunta= getcwd()."/imagenes/";

						/*ultimo registro de la tabla noticias*/
	 					$rn = $this -> model_noticias->nroregnoticias();

				for($i = 0; $i < $Imagenes; $i++) {
					/*ultimo registro de la tabla galeria*/
	 					$r = $this-> model_noticias->ultimoreg();
		// El nombre y nombre temporal del archivo que vamos para adjuntar
		$nombreArchivo=isset($_FILES['imagenes']['name'][$i])?$_FILES['imagenes']['name'][$i]:null;
		$nombreTemporal=isset($_FILES['imagenes']['tmp_name'][$i])?$_FILES['imagenes']['tmp_name'][$i]:null;
		
		$rutaArchivo=$directorio_actividades.$carpeta.'/'.($r[0]->id+1).'.jpg';
		move_uploaded_file($nombreTemporal,$rutaArchivo);

			$arraygaleria = array('img' => ($r[0]->id+1).'.jpg', 'actividad' => ($rn[0]->id));
				/*registro en la galeria*/
				$this -> model_noticias -> galeria_adds($arraygaleria); 

				}
		}

	

	}


			# agrego al instituto
	if ($instituto==1) {
/*existe la carpeta*/
		if (!file_exists($directorio_instituto.'/'.$titulo_cambiado )) {
   				 mkdir($directorio_instituto.'/'.$titulo_cambiado, 0777, true);

   				 	$fecha = $this->input->post('txt_fecha');
					$descripcion = $this->input->post('txt_descripcion');
					$foto_principal = $this->input->post('foto_principal');
					/*la carpeta donde ira*/
	 				$carpeta = '/'.$titulo_cambiado;

	 				// Contar envían por el plugin
				$Imagenes = count(isset($_FILES['imagenes']['name'])?$_FILES['imagenes']['name']:0);
	 					/*ultimo registro de la tabla galeria*/
	 					$r = $this-> model_noticias->ultimoreg();
	 					var_dump($titulo);
	 					$array_noticia = array
						( 'id' => ($r[0]->id +1) ,
						'titulo' => $titulo ,
						'fecha' => $fecha ,
						'descripcion' => $descripcion ,
						'imagen' => ($r[0]->id + 1).'.jpg',
						'instituto' => $instituto ,
						'carpeta' => $carpeta,
						'img_inicio' => $r[0]->id + 1,
						'img_fin' => ($r[0]->id + $Imagenes)
						 );

						$this->model_noticias->publicar_noticia($array_noticia);


						/*carpeta donde se ejecuta*/
						$carpetaAdjunta= getcwd()."/imagenes/";

						/*ultimo registro de la tabla noticias*/
	 					$rn = $this -> model_noticias->nroregnoticias();

				for($i = 0; $i < $Imagenes; $i++) {
					/*ultimo registro de la tabla galeria*/
	 					$r = $this-> model_noticias->ultimoreg();
		// El nombre y nombre temporal del archivo que vamos para adjuntar
		$nombreArchivo=isset($_FILES['imagenes']['name'][$i])?$_FILES['imagenes']['name'][$i]:null;
		$nombreTemporal=isset($_FILES['imagenes']['tmp_name'][$i])?$_FILES['imagenes']['tmp_name'][$i]:null;
		
		$rutaArchivo=$directorio_instituto.$carpeta.'/'.($r[0]->id+1).'.jpg';
		move_uploaded_file($nombreTemporal,$rutaArchivo);

			$arraygaleria = array('img' => ($r[0]->id+1).'.jpg', 'actividad' => ($rn[0]->id));
				/*registro en la galeria*/
				$this -> model_noticias -> galeria_adds($arraygaleria); 

				}
		}

		}

		if ($instituto==2) {
			# si es ambas
			/*existe la carpeta*/
		if (!file_exists($directorio_actividades.'/'.$titulo_cambiado )) {

   				 mkdir($directorio_actividades.'/'.$titulo_cambiado, 0777, true);
   				 mkdir($directorio_instituto.'/'.$titulo_cambiado, 0777, true);

   				 	$fecha = $this->input->post('txt_fecha');
					$descripcion = $this->input->post('txt_descripcion');
					$foto_principal = $this->input->post('foto_principal');
					/*la carpeta donde ira*/
	 				$carpeta = '/'.$titulo_cambiado;

	 				// Contar envían por el plugin
				$Imagenes = count(isset($_FILES['imagenes']['name'])?$_FILES['imagenes']['name']:0);
	 					/*ultimo registro de la tabla galeria*/
	 					$r = $this-> model_noticias->ultimoreg();
	 					$array_noticia = array
						( 'id' => ($r[0]->id +1) ,
						'titulo' => $titulo ,
						'fecha' => $fecha ,
						'descripcion' => $descripcion ,
						'imagen' => $r[0]->id+1,
						'instituto' => $instituto ,
						'carpeta' => $carpeta,
						'img_inicio' => ($r[0]->id + 1).'.jpg',
						'img_fin' => ($r[0]->id + $Imagenes)
						 );

						$this->model_noticias->publicar_noticia($array_noticia);


						/*carpeta donde se ejecuta*/
						$carpetaAdjunta= getcwd()."/imagenes/";

						/*ultimo registro de la tabla noticias*/
	 					$rn = $this -> model_noticias->nroregnoticias();

				for($i = 0; $i < $Imagenes; $i++) {
					/*ultimo registro de la tabla galeria*/
	 					$r = $this-> model_noticias->ultimoreg();
		// El nombre y nombre temporal del archivo que vamos para adjuntar
		$nombreArchivo=isset($_FILES['imagenes']['name'][$i])?$_FILES['imagenes']['name'][$i]:null;
		$nombreTemporal=isset($_FILES['imagenes']['tmp_name'][$i])?$_FILES['imagenes']['tmp_name'][$i]:null;
		
		$rutaArchivo1=$directorio_actividades.$carpeta.'/'.($r[0]->id+1).'.jpg';
		$rutaArchivo2=$directorio_instituto.$carpeta.'/'.($r[0]->id+1).'.jpg';

		copy($nombreTemporal,$rutaArchivo2);
		move_uploaded_file($nombreTemporal,$rutaArchivo1);

		

			$arraygaleria = array('img' => ($r[0]->id+1).'.jpg', 'actividad' => ($rn[0]->id));
				/*registro en la galeria*/
				$this -> model_noticias -> galeria_adds($arraygaleria); 

				}
		}
		}

		$this->session->set_flashdata('category_success', 'Agregado correctamente.');
		echo '<script>location.href = "'.base_url().'noticias/inicio"</script>';
 
}

/*retorno los datos de las noticias en formato html concatenado con php*/
public function consulta_noticias()
{
	# tomo el id del formulario
	$id = $this -> input -> post('trid');
	/*retorna los registros de la */
	$consulta = $this->model_noticias->info_edit_noticias($id);



		echo '
                <!-- tipo  -->
          <div class="col-md-6 form-group">
            <label for="txt_tipo">Publicación para :</label>
            <select class="form-control" name="txt_tipo_edit" id="txt_tipo_edit" >';
            if ($consulta[0]->instituto == 0) {
            	# selecciono estadio
            	echo '
            		<option selected value="0"> Stadio </option>
              		<option value="1"> Instituto </option>
              		<option value="2"> Ambos </option>
            	';
            }
            if ($consulta[0]->instituto == 1) {
            	# selecciono instituto
            	echo '
            		<option value="0"> Stadio </option>
              		<option selected value="1"> Instituto </option>
              		<option value="2"> Ambos </option>
            	';
            }
            if ($consulta[0]->instituto == 2) {
            	# selecciono a ambos
            	echo '
            		<option value="0"> Stadio </option>
              		<option value="1"> Instituto </option>
              		<option selected value="2"> Ambos </option>
            	';
            }
              
            
        echo '</select>
        	</div>

          <div class="col-md-6 form-group" >
          <label for="txt_fecha">Fecha:</label>
          <input type="date" class="form-control" name="txt_fecha_edit" id="txt_fecha_edit" value="'.$consulta[0]->fecha.'">
          </div>
          <!-- Titulo y Fecha -->
          <div class="col-md-12 form-group" >
            <label for="txt_titulo">Titulo :</label>
            <input type="text" class="form-control" placeholder="ej: Actividad de Inicio" name="txt_titulo_edit" id="txt_titulo_edit" value="'.$consulta[0]->titulo.'">
          </div> 
          
          <div class="col-md-12 form-group">
          <div class="col-md-12 form-group">
            <label for="txt_descripcion_edit">Contenido de Noticia.</label>
          </div>
          <!-- Descripcion -->
            <textarea class="summernote" name="txt_descripcion_edit" id="txt_descripcion_edit">
            	'.$consulta[0]->descripcion.'
            </textarea>
          </div>

      </div>
          <br/>
          <!--FOTOS DE LA NOTICIA-->
          
          <div class="col-md-12 form-group">
            <label for="txt_tipo">Galeria de Imagenes :</label>

            <div class="row">
            ';
            /* --------------------- proceso para mostrar las imagenes ------------------- */
			$directorio_actividades = 'http://localhost/stadio/assets/img/actividades/';
			$directorio_instituto = 'http://localhost/stadio/assets/img/instituto/noticias';
			$galeria_retorno = $this->model_noticias->galeria_retorno($id);
            /*recorro*/
            foreach ($consulta as $c) {
            	foreach ($galeria_retorno as $key) {
            		# recorro la galeria          	

            	if ($c->instituto == 0) {
                # imprimo las imagenes
	            echo
	            '<img src="'.$directorio_actividades.$c->carpeta.'/'.$key->img.'.jpg'.'" class="img-fondo defaultimg" style="width: 50px; height: 50px;  opacity: 1;"/>
	  			
	  			<button  type="button" class="btn btn-default .eliminar_foto">
	      	    <span class="glyphicon glyphicon-trash"></span>
	    		</button>';
    			}
    			}
    		}
    		echo'
   		   </div>


            <input id="archivos_edit" name="imagenes_edit[]" type="file" multiple=true class="file-loading">
          </div>';


}

/* ----------------------- metodo para actualizar una noticia -------------------- */
public function actualizar($data)
{ # actualizar...

}


}

?>