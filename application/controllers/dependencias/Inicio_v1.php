<?php
class inicio extends CI_Controller {

	 function __construct() {
		 
        parent::__construct();
		 $this->load->model('model_dependencias');
		 $this->load->model('model_trabajos');
		 $this->load->helper('url');
		 $this->load->helper('form');
		 $this->load->library('form_validation');
		 $this->load->library('session');
	 }
	
	
	public function index(){
		$data['sector']=$this->model_dependencias->getSector();
		$data['tipo_vegetacion']=$this->model_dependencias->tipo_vegetacion();
		$this->load->view('plantilla/Head_v1');
		$this->load->view('dependencias/inicio',$data);
		$this->load->view('plantilla/Footer');		

	}
	function dependencias(){
		$sub_sector= $this->input->post('subsector');
		$sector= $this->input->post('sector');
		if(!empty($sector)){


			if($sub_sector <> 0){
				$subdep= $this -> model_dependencias -> getDepen_subsector($sub_sector);

			}else{
			 	$subdep= $this -> model_dependencias -> getDepen_sector($sector);
				/*echo $this->db->last_query();*/
				}
				 if(empty($subdep)){
			  echo'No registra Dependencias';
			 }else{
				  echo' <table class="table table-hover tbl-dep" >
				<thead>
				  <tr>
					<th>#</th>
					<th>Identificador</th>
					<th>Categoria</th>
					<th>&nbsp;</th>
					<th>&nbsp;</th>
				  </tr>
				</thead>
				<tbody>
			   ';
			 foreach($subdep as $sd){
				  echo'<tr>
					<td class="sub_dep" id="'.$sd->dep_id.'">'.$sd->dep_id.'</td>
					<td class="sub_dep" id="'.$sd->dep_id.'">'.$sd->dep_nombre.'</td>
					<td class="sub_dep" id="'.$sd->dep_id.'">';
				$id_subdep=$sd->dep_id;
				/*tipo dependencia*/
				$tipo_subdepen= $this -> model_dependencias -> getTipoDepen($id_subdep);
				
				if(!empty($tipo_subdepen)){
					foreach($tipo_subdepen as $t){
							
								switch($t->tipo){
						
						case  1:
						$categoria='<span class="label label-success">'.$t -> nom_tipo.'</span>';
						break;
						
						case 2:
					     $categoria='<span class="label label-primary">'.$t -> nom_tipo.'</span>';
						 break;
						 
						 case 3:
					     $categoria='<span class="label label-warning ">'.$t -> nom_tipo.'</span>';
						 break;
						}
						
							echo''.$categoria.'<br>';
							
							}
					}
				
				 echo'</td>
				 <td>
				 
				 <button type="button" class="btn btn-default btn-xs eliminar"  id="'.$sd->dep_id.'"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
				 
				</td>
				 
				 ';
				 }
				 
				  }
				
			}else{
		 echo 'error';
				}
		
	}
	
	function contenedor_dependencia(){
		echo'<div class="card">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" ><a href="#home" aria-controls="home" role="tab" data-toggle="tab">especificación</a></li>
                    <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Trabajos</a></li>
                    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li>
                    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content" style="    overflow: auto;" >';
      	$sd  = $this->input->post('id');
      	$medidas= $this -> model_dependencias -> medidas_dependencia($sd);





      	//echo $sd;
      	echo'<div role="tabpanel" class="tab-pane " id="home">';

      	foreach ($medidas as $m) {
      		echo '<div class="col-md-12" style="text-align:right;">

      		
      		<table class="table">
							  <tbody>
							  <tr>
								  <td class="td_titulo">Ancho</td>
								  <td>'.$m->ancho.'</td>
								  <td  class="td_titulo">Largo</td>
								  <td>'.$m->largo.'</td>
								  <td  class="td_titulo">Alto</td>
								  <td>'.$m->alto.'</td>
								  <td  class="td_titulo">mt&sup2;</td>
								  <td> '.round($m -> m_cuadrados,2).' </td>
								</tr>
							</tbody>
			</table>


      		</div>';
      	}





      	$tipo_subdepen= $this -> model_dependencias -> getTipoDepen($sd);
		if (!empty($tipo_subdepen)){
			foreach($tipo_subdepen as $t){
		     	$id_tipo = $t->tipo;
		     	if ($id_tipo == 1) {
		     		$vegetacion= $this -> model_dependencias -> getVegetacion($sd);
		     		if (!empty($vegetacion)){
		     			foreach ($vegetacion as $v){
		     				$veg_fecha_plantacion = $v -> veg_fecha_plantacion;
							$veg_tipo_riego = $v -> veg_tipo_riego;
							$vegtipo_tipo = $v -> vegtipo_tipo;
							$vegcat_categoria = $v -> vegcat_categoria;
							$cantidad = $v -> veg_cantidad;
						}
						echo'
						<div class="col-md-6"><h4><span class="label label-success">'.$t -> nom_tipo.'</span></h4></div>
						<table class="table">
							  <tbody>
							  <tr>
								  <td class="td_titulo">Tipo</td>
								  <td>'.$vegtipo_tipo.'</td>
								  <td  class="td_titulo">Categoria</td>
								  <td>'.$vegcat_categoria.'</td>
								</tr>
								<tr>
								  <td  class="td_titulo">Fecha Plantación</td>
								  <td>'.$veg_fecha_plantacion.'</td>
								  <td  class="td_titulo">Riego</td>
								  <td>'.$veg_tipo_riego.'</td>
								</tr>
								<tr>
								  <td  class="td_titulo">Cantidad</td>
								  <td>'.$cantidad.'</td>
								  <td  class="td_titulo">&nbsp;</td>
								  <td>&nbsp;</td>
								</tr>
							 </tbody>
						</table>
						';
		     		}

		     	}elseif ($id_tipo == 2) {
		     		$instalacion= $this -> model_dependencias -> getInstalaciones($sd);
					if (!empty($instalacion)){
						foreach($instalacion as $in){
							$inst_tipo = $in -> inst_tipo;
							$inst_material = $in -> inst_material;
							$inst_pintura = $in -> inst_pintura;
							$inst_piso = $in -> inst_piso;
							$inst_nbano = $in -> inst_nbano;
							$inst_bano = $in -> inst_bano;
							$inst_cocina = $in -> inst_cocina;
							$inst_ventana = $in -> inst_ventana;
							$inst_techumbre = $in -> inst_techumbre;
							$inst_bajadadeagua = $in -> inst_bajadadeagua;
							$inst_npuertas = $in -> inst_npuertas;
							$inst_escalera = $in -> inst_escalera;
							$inst_alto = $in -> inst_alto;
							$inst_urinarios = $in -> inst_urinarios;
							$inst_lavamanos = $in -> inst_lavamanos;
							$inst_duchas = $in -> inst_duchas;
							$inst_camarines = $in -> inst_camarines;
							$inst_ncamarines = $in -> inst_ncamarines;
							$inst_fosa = $in -> inst_fosa;
							$inst_nfosa = $in -> inst_nfosa;
						}
						echo'<div class="table-responsive col-md-12" id="tb_infraestructura">
						<div class="col-md-6"><h4><span class="label label-primary">'.$t -> nom_tipo.'</span></h4></div>
						
						<table class="table">
							  <tbody>
							  <tr>
								  <td class="td_titulo">Tipo</td>
								  <td>'.$inst_tipo.'</td>
								  <td class="td_titulo">Material</td>
								  <td>'.$inst_material.'</td>
								</tr>
								<tr>
								  <td class="td_titulo">Puertas</td>
								  <td>'.$inst_npuertas.'</td>
								  <td class="td_titulo">Color</td>
								  <td>'.$inst_pintura.'</td>
								</tr>
								<tr>
								  <td class="td_titulo">piso</td>
								  <td>'.$inst_piso.'</td>
								  <td class="td_titulo">ventana</td>
								  <td>'.$inst_ventana.'</td>
								</tr>
								<tr>
								  <td class="td_titulo">techumbre</td>
								  <td>'.$inst_techumbre.'</td>
								  <td class="td_titulo">bajada de agua</td>
								  <td>'.$inst_bajadadeagua.'</td>
								</tr>
								 <tr>
								  <td class="td_titulo">escalera</td>
								  <td>';
								  if($inst_escalera== 1){echo'SI';}else{echo'NO';}
								  echo'</td>
								  <td class="td_titulo">cocina</td>
								  <td>';
								  if($inst_cocina == 1){echo'SI';}else{echo'NO';}
								  echo'</td>
								</tr>
								<tr>
								  
								  <td class="td_titulo">Baños </td>
								  <td>';
								  if($inst_bano == 1){echo'SI';}else{echo'NO';}
								  echo'</td>
								</tr>
								<tr>
								  <td class="td_titulo">Nº WC</td>
								  <td>'.$inst_nbano.'</td>
								  <td class="td_titulo">Nª Urinario</td>
								  <td>'.$inst_urinarios.'</td>
								</tr>
								<tr>
								  <td class="td_titulo" >Nº Lavamanos</td>
								  <td>'.$inst_lavamanos.'</td>
								  <td class="td_titulo">Nº Duchas</td>
								  <td>'.$inst_duchas.'</td>
								</tr>
								<tr>
								  <td class="td_titulo">Camarines</td>
								  <td>';
								  if($inst_camarines == 1){echo'SI';}else{echo'NO';}
								  echo'</td>
								  <td class="td_titulo">Nº Camarines</td>
								  <td>'.$inst_ncamarines.'</td>	
								 </tr>
								 <tr>
								  <td class="td_titulo" >Fosa</td>
								  <td>';
								   if($inst_fosa == 1){echo'SI';}else{echo'NO';}
								   echo'</td>
								  <td class="td_titulo">Nº Fosas</td>
								  <td>'.$inst_nfosa.'</td>
								</tr>
							  </tbody>
							</table>
							<div>';
					}else{
						$recreacion= $this -> model_dependencias -> getRecreacion($sd);
					    if (!empty($recreacion)){
					    	foreach($recreacion as $r){
							    $r_largo = $r-> r_largo;
							    $r_ancho =$r -> r_ancho;
							    $r_superficie = $r -> r_superficie;
							    $r_tipo = $r -> r_tipo;
							}
							echo'<div class="table-responsive col-md-12" id="tb_recreacion">
						        <div class="col-md-6"><h4><span class="label label-warning">'.$t -> nom_tipo.'</span></h4></div>
						        <table class="table">
						        	  <tbody>
						        	  <tr>
						        	  		<tr>
						        		  <td class="td_titulo">Superficie</td>
						        		  <td>'.$r_superficie.'</td>
						        		  <td class="td_titulo">Tipo</td>
						        		  <td>'.$r_tipo.'</td>
						        			</tr>
						        		  <td class="td_titulo">Largo</td>
						        		  <td>'.$r_largo.'</td>
						        		  <td class="td_titulo">Ancho</td>
						        		  <td>'.$r_ancho.'</td>
						        		</tr>
						        		
						        	 </tbody>
						        </table>
						        <div>';	/*fin div #tb_recreacion*/ 
					    }
					}

		     	}
		    }
		}
      	echo'</div>';



        /**TRABAJOS***/
      	echo'<div role="tabpanel" class="tab-pane active" id="profile" style="overflow: auto;">';

      	 
      	 $sub_categorias= $this -> model_trabajos -> subcate_realizadas_dependencia($sd);

      	  if (!empty($sub_categorias)){
      	  	foreach ($sub_categorias as $sc) {
      	  		$id_sc=$sc->sctg_id;
      	  		
      	  		$dias_transcurridos= $this -> model_dependencias -> dias_transcurridos($id_sc,$sd);
      	  		$dias_faltan= $this -> model_dependencias -> dias_faltan($id_sc,$sd);

      	  		
      	  		echo '<div class="col-md-3">
      	  		        <div class="panel panel-default"  style="min-height: 180px;">
      	  		            <div class="panel-heading" style="text-transform: uppercase;
                            font-family: monospace;
                            letter-spacing: 2px;
                            font-size: 12px;
                            color: darkgreen;">'.$sc -> sctg_nombre.'</div>
      	  		             <div class="panel-body" style="text-transform: capitalize;font-family: monospace;padding: 3px;">
      	  		             <div style="background:#8fb4b5;padding: 3px;color: #fbff55;">última vez</div>
      	  		             <div class="texto"><span>';
      	  		$trabajos= $this -> model_trabajos -> ultimos_diez_subcategoria($id_sc,$sd);
      	  		//echo $this -> db -> last_query();
      	  		if (!empty($trabajos)){
      	  			foreach ($trabajos as $t) {
      	  				setlocale(LC_ALL, 'es_ES').': ';
      	  				echo iconv('ISO-8859-1', 'UTF-8', strftime('%a %d  %b  %Y',  strtotime("". $t -> tb_fecha."")));
      	  				 echo "<br>";
      	  				}
      	  			}
      	  			echo'</span></div>';

      	  		             if (!empty($dias_transcurridos)){

                            foreach ($dias_transcurridos as $dt) {
                            	echo'<span class="ndias">'.$dt-> transcurrido.' días trans.</span>';
                            }}


      	  			echo'<div style="background:#8fb4b5;padding: 3px;color: #fbff55;">Próximo</div>';

      	  			         if (!empty($dias_faltan)){

                            foreach ($dias_faltan as $df) {
                            	echo iconv('ISO-8859-1', 'UTF-8', strftime('%a %d  %b  %Y',  strtotime("". $df -> tb_fecha."")));

                            	$n_falta = $df-> falta;
                            	$texto_falta = "";

                            	switch ($n_falta) {
                            		case 0:
                            			$texto_falta='Hoy';
                            			break;
                            		case 1:
                            			$texto_falta='Falta'.$n_falta.' día.';
                            			break;

                            		
                            		default:
                            			$texto_falta='faltan '.$n_falta.' días.';
                            			break;
                            	}

                            	echo'<br><span class="fdias">'.$texto_falta.' </span>';
                            }}else{echo "<p>sin planificar</p>";}




      	  			echo'</div>
      	  		        </div>
      	  		    </div>';
      	  		}
      	  	}
		echo'</div>';


		echo'
                <div role="tabpanel" class="tab-pane" id="messages">Lorem Ipsum is simply dummy text of the printing</div>
                <div role="tabpanel" class="tab-pane" id="settings">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passage..</div>';
        echo'</div> <!-- tab-content-->
        </div> <!-- card -->';}
	
	
	function select_subsector(){
		$sector  = $this->input->post('sector');
		$sub_sector= $this -> model_dependencias -> getSub_sector($sector);
		echo'<option value=""> Todos </option>';
		foreach($sub_sector as  $s){
				echo ' <option value="'.$s->id.'" '.set_select("sector",$s->did).'>'.$s->nombre.'</option>';
			}}
	function select_dependencia(){
		$subsector  = $this->input->post('subsector');
		$dependencia= $this -> model_dependencias -> getDepen_subsector($subsector);
		echo'<option value=""> Selccionar </option>';
		foreach($dependencia as  $d){
				echo ' <option value="'.$d->dep_id.'" '.set_select("sector",$d->dep_id).'>'.$d->dep_nombre.'</option>';
			}
		echo'<option value="0" style="color:red;"> NUEVO </option>';}
	
	function select_categoria_vegetacion(){
		$tipo_veg  = $this->input->post('tipo');
		$cat_veg= $this -> model_dependencias -> categoria_veg($tipo_veg);
		echo'<option value=""> Selccionar </option>';
	   echo $tipo_veg;
	   echo '<----->tipo <br>';
		$query = $this -> db->last_query();
		echo $query;
		foreach($cat_veg as  $cv){
				echo ' <option value="'.$cv->vegcat_id.'" '.set_select("sector",$cv->vegcat_id).'>'.$cv->	vegcat_categoria.'</option>';
		
		}}
	
	/*NUEVA SUBDEPENDENCIA*/
	function nuevo(){
		$this->form_validation->set_error_delimiters('<div class="error alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>'); 	
		
		//insertar tabala subdependencia
		
		$this -> form_validation -> set_rules('subsector','','required');
		$this -> form_validation -> set_rules('depen','','required');
		$this -> form_validation -> set_rules('sector','','required');
		if($this -> form_validation -> run() === false){
		$data['sector']=$this->model_dependencias->getSector();
		$data['tipo_vegetacion']=$this->model_dependencias->tipo_vegetacion();
		$this->load->view('plantilla/Head_v1');
		$this->load->view('dependencias/inicio',$data);
		$this->load->view('plantilla/Footer');	
			}
		else{
			
		$tipo=$_POST['chk_tipo'];
		$nom_subdep=$_POST['subdependencia'];
		$sector=$_POST['sector'];
		$dependencia=$_POST['depen'];
		$subsector=$_POST['subsector'];
		$observaciones=$_POST['observaciones'];
		$ancho=$_POST['ancho'];
		$largo=$_POST['largo'];
		$alto=$_POST['alto'];
		
		 $id_dep="";
		if ($dependencia == 0){
			 /*INSERT dependencia*/
			 $data_dep = array(
                    'dep_nombre' => $nom_subdep,
					'sub_sector' => $subsector,
					'sector' => $sector,
					'ancho' => $ancho,	
					'largo' => $largo,
					'alto' => $alto);
			 $this -> model_dependencias -> insert_dependencias($data_dep);
			 $ultimo = $this -> model_dependencias -> maxid();
				foreach ($ultimo as $u){    
					$id_dep=$u -> max_id;
				}/* FIN busca ultimo id ingresado tabla subdependencia id_sd*/
		}/*fin dependencia 0*/
		else{$id_dep = $dependencia;}
		//tipo chek
		foreach($tipo as $t){
			$tipo_sd=$t; //echo $tipo_sd;
			//INSERT subdependencia-tipo
			$data_dep_tipo = array(
                    'sub_sector' => $subsector,
					'dependencia' => $id_dep,
					'sector' => $sector,	
					'tipo' => $tipo_sd);
			$this -> model_dependencias -> insert_dependencia_tipo($data_dep_tipo);
			$maxid_dep_tipo =$this -> model_dependencias -> maxid_tipo_dep();
			foreach ($maxid_dep_tipo as $m){
				$dep_tipo=$m -> max_id;
			}
			switch ($tipo_sd){
		
		case 1 :
		//echo 'vegetacio <br>';
		$veg_tipo=$_POST['tipo_veg'];
		$veg_categoria=$_POST['categoria_veg'];
		$veg_plantacion=$_POST['fecha_plantacion'];
		$veg_riego=$_POST['tipo_riego'];
		$veg_cantidad=$_POST['veg_cantidad'];
				 
        $data_j=array(
	   "veg_fecha_plantacion" => $veg_plantacion ,
	   "veg_categoria" =>$veg_categoria ,
	   "veg_tipo" => $veg_tipo,
	   "veg_tipo_riego" => $veg_riego ,
	   "veg_cantidad" => $veg_cantidad ,
	   "dependencias_tipo_id" => $dep_tipo,
	   "sub_sector" => $subsector,
	   "dependencia" => $id_dep,
	   "sector" => $sector	);
	   $this -> model_dependencias -> insert_vegetacion($data_j);
	   echo 'guardo vegetacion';
	
				  
		break;
		
		case 2 :
		echo 'instalacion<br>';
		$tipo_instalacion=$_POST['tipo_instalacion'];
		$color=$_POST['color'];
		$piso=$_POST['piso'];
		$ventana=$_POST['ventana'];
		$techumbre=$_POST['techumbre'];
		$bajada_agua=$_POST['bajada_agua'];
		$escalera=$_POST['escalera'];
		$bano=$_POST['bano'];
		$camarines=$_POST['camarines'];
		$n_bano=$_POST['n_bano'];
		$n_urinario=$_POST['n_urinario'];
		$n_lavamanos=$_POST['n_lavamanos'];
		$n_duchas=$_POST['n_duchas'];
		$n_camarinos=$_POST['n_camarinos'];
		$materia=$_POST['material'];
		$cocina=$_POST['cocina'];
		$fosa=$_POST['fosa'];
		$n_fosa=$_POST['n_fosa'];
		$n_puertas=$_POST['n_puertas'];
        $data_i=array(
	   "inst_tipo" =>$tipo_instalacion,
	   "inst_material" => $materia,
	   "inst_pintura" => $color,
	   "inst_piso" => $piso,
	   "inst_nbano" =>$n_bano,
	   "inst_bano" => $bano,
	   "inst_cocina" => $cocina,
	   "inst_ventana" => $ventana,
	   "inst_techumbre" => $techumbre,
	   "inst_bajadadeagua" => $bajada_agua,
	   "inst_npuertas" => $n_puertas,
	   "inst_escalera" => $escalera,
	   "inst_urinarios" => $n_urinario,
	   "inst_lavamanos" => $n_lavamanos,
	   "inst_duchas" => $n_duchas,
	   "inst_camarines" => $camarines,
	   "inst_ncamarines" => $n_camarinos,
	   "inst_fosa" => $fosa,
	   "inst_nfosa" => $n_fosa,
	   "dependencias_tipo_id" =>$dep_tipo,
	   'sub_sector' => $subsector,
	   'dependencia' => $id_dep,
	   'sector' => $sector	
	);
	
	$this -> model_dependencias -> insert_instalaciones($data_i);
	echo 'guardo recreacion';
	/*$this->session->set_flashdata('category_success', 'INSTALACION agregada.');
				redirect (base_url().'dependencias/inicio');
				*/
		break;
		
		case 3 :
		
		echo 'recreacion <br>';
		$rec_tipo=$_POST['tipo_recreacion'];
		$rec_superficie=$_POST['superficie'];
		$rec_ancho=$_POST['ancho_recreacion'];
		$rec_largo=$_POST['largo_recreacion'];
		
		$data_r=array(
	   "r_superficie" => $rec_superficie,
	   "r_tipo" => $rec_tipo ,
	   "dependencias_tipo_id" => $dep_tipo,
	   'sub_sector' => $subsector,
	   'dependencia' => $id_dep,
	   'sector' => $sector	);
	   $this -> model_dependencias -> insert_recreacion($data_r);
	   echo'guardo recreacin<br>';
	   /*$this->session->set_flashdata('category_success', 'RECREACION Agregada.');
				redirect (base_url().'dependencias/inicio');*/
		
		break;
		}
				 
			
			  
			}/*termino de rrecorrer el tipo seleccionado en formulario*/
	
	
	$this->session->set_flashdata('category_success', 'ingresado correctamente.');
				redirect (base_url().'dependencias/inicio');
				
	    
   	
		} /*fin validacion formulario*/
		
		

		
		}


    function eliminar(){
		$id = $_POST['trid'];
		$this -> model_dependencias -> deshabilitar_vegetacion($id);
		$this -> model_dependencias -> deshabilitar_instalacion($id);
		$this -> model_dependencias -> deshabilitar_recreacion($id);
		$this -> model_dependencias -> deshabilitar_dependencia($id);
		$this->session->set_flashdata('category_success', 'Eliminado correctamente.');
		echo '<script>location.href = "'.base_url().'dependencias/inicio"</script>';}

}
	?>