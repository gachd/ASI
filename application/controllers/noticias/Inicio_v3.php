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
		$this->load->view('plantilla/Head');
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

	echo "agregar";

$directorio_actividades = getcwd().'/assets/img/actividades';
$directorio_instituto = getcwd().'/../assets/img/instituto/noticias';

       /*NOTICIAS*/
	# tomo los valores de los formularios
	$instituto = $this->input->post('txt_tipo');
	$titulo= $this->input->post('txt_titulo');

	/*cambia los espacios por guiones*/
	$titulo_cambiado = str_replace(" ", "_", $titulo);

	// Contar envían por el plugin
	$Imagenes = count(isset($_FILES['imagenes']['name'])?$_FILES['imagenes']['name']:0);
		
	

		# agrego al stadio
	if ($instituto==0) {
		/*existe la carpeta*/
	echo "paso".$directorio_actividades.'/'.$titulo_cambiado;

		if (!file_exists($directorio_actividades.'/'.$titulo_cambiado )) {

			

   				 mkdir($directorio_actividades.'/'.$titulo_cambiado, 0777, true);

   				 	$fecha = $this->input->post('txt_fecha');
					$descripcion = $this->input->post('txt_descripcion');
					$foto_principal = $this->input->post('foto_principal');
					/*la carpeta donde ira*/
	 				$carpeta = $titulo_cambiado;

	 					/*ultimo registro de la tabla galeria*/
	 					$r = $this-> model_noticias->ultimoreg();

	 					$array_noticia = array
						( 
						'titulo' => $titulo ,
						'fecha' => $fecha ,
						'descripcion' => $descripcion ,
						'imagen' => ($r[0]->id + 1).'.jpg',
						'instituto' => $instituto ,
						'carpeta' => $carpeta,
						'img_inicio' => $r[0]->id + 1,
						'img_fin' => ($r[0]->id + $Imagenes)
						 );

						
						var_dump($array_noticia);



						$this->model_noticias->publicar_noticia($array_noticia);

						/*carpeta donde se ejecuta*/
						$carpetaAdjunta = getcwd()."/imagenes/";

						/*ultimo registro de la tabla noticias*/
	 					$rn = $this -> model_noticias->nroregnoticias();

				for($i = 0; $i < $Imagenes; $i++) {
					/*ultimo registro de la tabla galeria*/
	 					$r = $this-> model_noticias->ultimoreg();
		// El nombre y nombre temporal del archivo que vamos para adjuntar
		$nombreArchivo=isset($_FILES['imagenes']['name'][$i])?$_FILES['imagenes']['name'][$i]:null;
		$nombreTemporal=isset($_FILES['imagenes']['tmp_name'][$i])?$_FILES['imagenes']['tmp_name'][$i]:null;
		
		$rutaArchivo=$directorio_actividades.'/'.$carpeta.'/'.($r[0]->id+1).'.jpg';
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
	 				$carpeta = $titulo_cambiado;

	 		
	 					/*ultimo registro de la tabla galeria*/
	 					$r = $this-> model_noticias->ultimoreg();
	 					$array_noticia = array
						( 
						'titulo' => $titulo ,
						'fecha' => $fecha ,
						'descripcion' => $descripcion ,
						'imagen' => ($r[0]->id + 1).'.jpg',
						'instituto' => $instituto ,
						'carpeta' => $carpeta,
						'img_inicio' => $r[0]->id + 1,
						'img_fin' => ($r[0]->id + $Imagenes)
						 );

						var_dump($array_noticia);

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
		
		$rutaArchivo=$directorio_instituto.'/'.$carpeta.'/'.($r[0]->id+1).'.jpg';
		move_uploaded_file($nombreTemporal,$rutaArchivo);

			$arraygaleria = array('img' => ($r[0]->id+1).'.jpg', 'actividad' => ($rn[0]->id));
				/*registro en la galeria*/
				$this -> model_noticias -> galeria_adds($arraygaleria); 

				}
		}

		}

		if ($instituto==2) {

			echo "ambas";
			# si es ambas
			/*existe la carpeta*/
		if (!file_exists($directorio_actividades.'/'.$titulo_cambiado )) {

   				 mkdir($directorio_actividades.'/'.$titulo_cambiado, 0777, true);
   				 mkdir($directorio_instituto.'/'.$titulo_cambiado, 0777, true);

   				 	$fecha = $this->input->post('txt_fecha');
					$descripcion = $this->input->post('txt_descripcion');
					$foto_principal = $this->input->post('foto_principal');
					/*la carpeta donde ira*/
	 				$carpeta = $titulo_cambiado;

	 					/*ultimo registro de la tabla galeria*/
	 					$r = $this-> model_noticias->ultimoreg();
	 					$array_noticia = array
						( 
						'titulo' => $titulo ,
						'fecha' => $fecha ,
						'descripcion' => $descripcion ,
						'imagen' => $r[0]->id+1,
						'instituto' => $instituto ,
						'carpeta' => $carpeta,
						'img_inicio' => ($r[0]->id + 1).'.jpg',
						'img_fin' => ($r[0]->id + $Imagenes)
						 );

						var_dump($array_noticia);

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
		
		$rutaArchivo1=$directorio_actividades.'/'.$carpeta.'/'.($r[0]->id+1).'.jpg';
		$rutaArchivo2=$directorio_instituto.'/'.$carpeta.'/'.($r[0]->id+1).'.jpg';

		copy($nombreTemporal,$rutaArchivo2);
		move_uploaded_file($nombreTemporal,$rutaArchivo1);

		

			$arraygaleria = array('img' => ($r[0]->id+1).'.jpg', 'actividad' => ($rn[0]->id));
				/*registro en la galeria*/
				$this -> model_noticias -> galeria_adds($arraygaleria); 

				}
		}
		}
		/*

		$this->session->set_flashdata('category_success', 'Agregado correctamente.');
		echo '<script>location.href = "'.base_url().'noticias/inicio"</script>';*/
 
}

/*retorno los datos de las noticias en formato html concatenado con php*/
public function consulta_noticias()
{
	# tomo el id del formulario
	$id = $this -> input -> post('trid');
	/*retorna los registros de la */
	$consulta = $this->model_noticias->info_edit_noticias($id);

		echo '<input type="hidden" id="id_actividad" name="id_actividad" value="'.$id.'">';

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
          
          <br/>
          <!--FOTOS DE LA NOTICIA-->
          
            <div class="col-md-12 form-group">
            <label class="col-md-12 for="txt_tipo">Galeria de Imagenes :</label>';

            $ruta_acti = "http://www.stadioitalianodiconcepcion.cl/assets/img/actividades/";
            $ruta_insti = "http://www.stadioitalianodiconcepcion.cl/assets/img/instituto/noticias/";
            $galeria_reg = $this->model_noticias->info_edit_galeria($id);
      

            foreach ($consulta as $object) {
            	# recorro para mostrar las imagenes
            	foreach ($galeria_reg as $gallery) {
            		# recoro la galeria
            	if ($object->instituto==0) {
            		# si es de tipo 0 es instituto
            		if (empty($object->carpeta)) {
            			# si no esta vacia
            		echo'<br/>';
            		echo '<img class="form-group" style="height:70px;" src="'.$ruta_acti.$gallery->img.'" >';
            		echo '<button type="button" class="btn btn-default btn-xs eliminar_foto" 
            		 id=" '.$gallery->id.' "> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>';
            		  
            		}else{
            			echo'<br/>';
            		echo '<img class="form-group" style="height:70px;" src="'.$ruta_acti.'/'.$object->carpeta.'/'.$gallery->img.'" >';
            		echo '<button type="button" class="btn btn-default btn-xs eliminar_foto" 
            		 id=" '.$gallery->id.' "> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>';
            		
            	    }
            	
            	}
            	    if ($object->instituto==1) {
            		# si es de tipo 0 es instituto
            		if (empty($object->carpeta)) {
            			# si no esta vacia
            		echo'<br/>';
            		echo '<img class="form-group" style="height:70px;" src="'.$ruta_insti.$gallery->img.'" >';
            		echo '<button type="button" class="btn btn-default btn-xs eliminar_foto" 
            		 id=" '.$gallery->id.' "> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>';
            		  
            		}else{
            			echo'<br/>';
            		echo '<img class="form-group" style="height:70px;" src="'.$ruta_insti.'/'.$object->carpeta.'/'.$gallery->img.'" >';
            		echo '<button type="button" class="btn btn-default btn-xs eliminar_foto" 
            		 id=" '.$gallery->id.' "> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>';
            		
            	    }
            	
            	}
            	    if ($object->instituto==2) {
            		# si es de tipo 0 es instituto
            		if (empty($object->carpeta)) {
            			# si no esta vacia
            		echo'<br/>';
            		echo '<img class="form-group" style="height:70px;" src="'.$ruta_insti.$gallery->img.'" >';
            		echo '<button type="button" class="btn btn-default btn-xs eliminar_foto" 
            		 id=" '.$gallery->id.' "> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>';
            		  
            		}else{
            			echo'<br/>';
            		echo '<img class="form-group" style="height:70px;" src="'.$ruta_insti.'/'.$object->carpeta.'/'.$gallery->img.'" >';
            		echo '<button type="button" class="btn btn-default btn-xs eliminar_foto" 
            		 id=" '.$gallery->id.' "> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>';
            		
            	    }
            	
            	}

              }
            
            	 
            }
            /*
            echo

            '  <label class="form-group"  style="margin-right:15px;"><input type="checkbox" name="btn_agregar_mas" id="btn_agregar_mas" value="1" onchange="javascript:showmasimagenes()" class="form-group" > Subire más imagenes</label>

            <div id="panel" name="panel" style="display:none !important;" >
            <label for="txt_tipo"></label>
            <input id="archivos_edit" name="imagenes_edit[]" type="file" multiple=true class="file-loading">
            </div>
          </div>
*/			echo'
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


';

}

/* ----------------------- metodo para actualizar una noticia -------------------- */
public function actualizar()
{ # actualizar...
	$id_actividad = $this->input->post('id_actividad');
	
	/*tomar todos los datos*/
	$titulo = $this->input-> post('txt_titulo_edit');
	$fecha = $this->input-> post('txt_fecha_edit');
	$descripcion = $this->input ->post('txt_descripcion_edit');
	$instituto = $this->input ->post('txt_tipo_edit'); 

	$datos_noti = array('titulo' => $titulo ,
					   'fecha' => $fecha,
					   'descripcion' => $descripcion ,
					   'instituto' => $instituto );
	/*enviar los datos*/
	
	$actualizar = $this->model_noticias->actualizar($datos_noti,$id_actividad);

}

/* ----------------------------metodo para eliminar foto ---------------------- */
public function eliminar_foto()
{
   # tomo el id del formulario
	$id = $this ->input -> post('trid');
	$eliminar=$this->model_noticias->eliminar_jpg($id);
}


}

?>