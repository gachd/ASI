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
/*IMPRIME LAS DEPENDENCIAS */
function dependencias(){
	
			$sub_sector= $this->input->post('subsector');
			$sector= $this->input->post('sector');
			$todas= $this -> model_dependencias -> all_dependencias();
			
	
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
							/* boton eliminar */
					 echo'</td>
					 <td>
					 
					 <button type="button" class="btn btn-default btn-xs eliminar"  id="'.$sd->dep_id.'"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
					 
					</td>
					 
					 ';
					 foreach ($todas as $objeto ) {
						 
					 
					 if ($sd->dep_id == $objeto->dependencia ) {
						 /* boton actualizar */
					
						   echo'</td>
						   <td>
					 <button type="button" class="btn btn-default btn-xs editar"  id="'.$sd->dep_id.'">
					  <span class="glyphicon glyphicon-cog" aria-hidden="true"></span></button>
					</td>';
					 }
											
									
					 }
					 
					  }
					}
					
				}else{
			 echo 'error';
					}
			
		}
	
	function contenedor_dependencia(){
		echo'<div class="card">
                <ul class="nav nav-tabs"  role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">especificación</a></li>
                    <li role="presentation"> <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Trabajos</a></li>
                    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li>
                    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
                </ul>
                <!-- Tab panes -->
         <div class="tab-content" style="    overflow: auto;" >';
      	$sd  = $this->input->post('id');
      	$medidas= $this -> model_dependencias -> medidas_dependencia($sd);
      	//echo $sd;
      	echo'<div role="tabpanel" class="tab-pane active " id="home">';

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

		     	echo $id_tipo.'<br>';
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
							//$inst_alto = $in -> inst_alto;
							$inst_urinarios = $in -> inst_urinarios;
							$inst_lavamanos = $in -> inst_lavamanos;
							$inst_duchas = $in -> inst_duchas;
							$inst_camarines = $in -> inst_camarines;
							$inst_ncamarines = $in -> inst_ncamarines;
							$inst_fosa = $in -> inst_fosa;
							$inst_nfosa = $in -> inst_nfosa;
						}
						echo'<div class="table-responsive col-md-12" id="tb_infraestructura">
						<div class="col-md-6">
						<h4><span class="label label-primary">'.$t -> nom_tipo.'</span></h4>
						</div>
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
							</div>';
					}
				}elseif ($id_tipo == 3){
				    $recreacion= $this -> model_dependencias -> getRecreacion($sd);
					if (!empty($recreacion)){
					    	foreach($recreacion as $r){
							    //$r_largo = $r-> r_largo;
							    //$r_ancho =$r -> r_ancho;
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
						        		  <td></td>
						        		  <td class="td_titulo">Ancho</td>
						        		  <td></td>
						        		</tr>
						        		
						        	 </tbody>
						        </table>
						        </div>';	/*fin div #tb_recreacion*/ 
					}
				}

		     	
		    }
		}
      	echo'</div>';



        /**TRABAJOS***/
      	echo'<div role="tabpanel" class="tab-pane" id="profile" style="overflow: auto;">';

      	 
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

		//PLANIFICACION MANTENIMIENTO
		echo' <div role="tabpanel" class="tab-pane" id="messages">';
		$pl_mant_subcat= $this -> model_dependencias -> sub_pl_temp($sd);
		//echo $this-> db -> last_query();


       echo'
		<div class="panel panel-default col-md-6">
            <div class="panel-heading">planificaion de mantencion</div>
            <div class="panel-body">
                <table class="table table-striped">
                <thead>
                 <tr>
                  <th scope="col">Trabajo</th>
                  <th scope="col">Temp. Baja</th>
                  <th scope="col">Temp. Alta</th>
                  </tr>
                </thead>
                <tbody>';
                    foreach ($pl_mant_subcat as $pl_sb) {
                    	$id_sub = $pl_sb -> pl_subcategoria;
                    	echo'<tr>
                    	<td>'.$pl_sb -> ctg_nombre .' / '.$pl_sb-> sctg_nombre.'</td>';

                    	//TEMPORADA BAJA

                    	$plmant1= $this -> model_dependencias -> pl_temp($sd,$id_sub,1);
                    	    foreach ($plmant1 as $uno) {
                    	    	echo'<td>'.$uno -> pl_cantidad.'</td>';
                    	    }
                    	$plmant2= $this -> model_dependencias -> pl_temp($sd,$id_sub,2);
                    	    foreach ($plmant2 as $dos) {
                    	    	echo'<td>'.$dos -> pl_cantidad.'</td>';
                    	    }


                       echo' 
                       
                        </tr>';
                    }                    
                echo'</tbody>
                </table>
            </div>
        </div>';
        echo'</div>';
		echo'
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
		
			/* ******************** RETORNA LOS DATOS DE LA VENTANA ********************** */
			/* ******************** RETORNA LOS DATOS DE LA VENTANA ********************** */
			/* ******************** RETORNA LOS DATOS DE LA VENTANA ********************** */
public function datosdepend()
{	
	$id = $this -> input -> post('trid');

	echo $id;

	$dependencias = $this -> model_dependencias -> getdependencia($id);
	$sectores = $this -> model_dependencias -> retorno_sectores();
	$subsectores = $this -> model_dependencias -> retorno_subsectores($dependencias[0]->sector);


	$v_sec=$dependencias[0]->sector;
	$v_sub=$dependencias[0]->sub_sector;
	$todasdepend = $this -> model_dependencias -> alldepend($v_sec,$v_sub );

/*retorna el tipo*/
$tipo = $this -> model_dependencias -> tiporeturn($id);
$v ="0";
$i ="0";
$r ="0";
/*cargar datos de form de instalacion*/
$instalacion_form = $this -> model_dependencias -> instalacion_form($id);

/*carga datos de form de recreacion*/  
$recreacion_form = $this -> model_dependencias -> recreacion_form($id);

/*para cargar la informacion de los select del form de instalacion*/
$consultas_intalacion_tipo = $this-> model_dependencias -> consultas_instalacion('1');
$consultas_instalacion_material = $this-> model_dependencias -> consultas_instalacion('2');
$consultas_instalacion_piso = $this-> model_dependencias -> consultas_instalacion('3');
$consultas_instalacion_ventana = $this -> model_dependencias -> consultas_instalacion('4');
$consultas_instalacion_techumbre = $this -> model_dependencias -> consultas_instalacion('5');
$consultas_instalacion_bajada_agua = $this -> model_dependencias -> consultas_instalacion('6');
/*vegetacion*/
$retorno_tipo_vegetacion = $this -> model_dependencias -> retorno_tipo_vegetacion();
$retorno_categoria_vegetacion = $this -> model_dependencias -> retorno_categoria_vegetacion();
$retorno_vegetacion_datos = $this -> model_dependencias -> vegetacion_datos($id);

/*retorno medidas*/
$retorno_medidas_veg= $this -> model_dependencias -> datos_veg_depen($id);
/*recreacion*/
$recreacion_datos = $this -> model_dependencias -> recreacion_datos($id);
/*medidas depend*/ 
$medidas_depend =$this -> model_dependencias->medidas_depend($id);

/* ---------------------------------------fin de consultas -----------------------------*/
  


/*carga de datos*/
echo '<div class="col-md-12 form-group">

		 <label style="margin-right:15px;">';

		echo '<input type="hidden" id="id_dependencia" name="id_dependencia_edit" value="'.$id.'">';

foreach ($tipo as $object) {
	

		 if ($object->tipo=="1" && $v=="0") {
		 	# si es 1 es vegetacion || jardineria
		 	echo' <label>
          <input type="checkbox" name="chk_vegetacion_edit" id="chk_vegetacion_edit" value="1" onchange="javascript:showvegetacion_edit()" checked> Vegetación
          </label>';
          $v="1";
		 }
		 
		 if ($object->tipo=="2" && $i=="0") {
		 	# si es 2 es infraestructura
		 	echo' 
		 	<input type="checkbox" name="chk_instalacion_edit" id="chk_instalacion_edit" value="2" onchange="javascript:showinstalacion_edit()" checked > Instalación
         </label>
		 	';
		 	 $i="1";
		 }
		 if ($object->tipo=="3" && $r=="0") {
		 	# si es 3 es recreacion
		 	echo '<label>
          <input type="checkbox" name="chk_recreacion_edit" id="chk_recreacion_edit" value="3" onchange="javascript:showrecreacion_edit()" checked > Recreación
          </label>';
          $r="1";
		 }
         
}



	if ($i=="0") {
	echo'
			 	<input type="checkbox" name="chk_instalacion_edit" id="chk_instalacion_edit" value="2" onchange="javascript:showinstalacion_edit()"  > Instalación
	         </label>
			 	';
	}
	if ($v=="0") {
		 	echo' <label>
          <input type="checkbox" name="chk_vegetacion_edit" id="chk_vegetacion_edit" value="1" onchange="javascript:showvegetacion_edit()" > Vegetación
          </label>';
	}
	if ($r=="0") {
		echo '<label>
          <input type="checkbox" name="chk_recreacion_edit" id="chk_recreacion_edit" value="3" onchange="javascript:showrecreacion_edit()"  > Recreación
          </label>';
	}
         

          echo'</div>

           <!-- SECTOR -->
          <div class="col-md-6 form-group" >
            <label for="select">Sector:</label>
            <select class="form-control" name="sector" id="form_sector">
            <option value=""> Selccionar </option>
            <option value="0"> Selccionar </option>';

            /*aca*/
            foreach($sectores as  $se){
            	if ($se->id == $dependencias[0]->sector) {
            echo '
            <option selected value="'.$se->id.'" '.set_select("sector",$se->id).'>'.$se->nombre.'</option>
            ';
            	}
            	else
            	{

            	
            echo ' 
            <option value="'.$se->id.'" '.set_select("sector",$se->id).'>'.$se->nombre.'</option>
            ';
        	}
           }
           echo '
           </select>
           </div>
           ';
            
            echo '
             <!-- SUB-SECTOR -->
          <div class="col-md-6 form-group">
            <label for="select2">Sub Sector:</label>
            <select class="form-control" name="subsector" id="form_subsector" >
            <option value=""> Selccionar </option>
            ';
            foreach($subsectores as  $sub){
            	if ($sub->id == $dependencias[0]->sub_sector) {
            echo '
            <option selected value="'.$sub->id.'" '.set_select("subsector",$sub->id).'>'.$sub->nombre.
            '</option>
            ';
            	}
            	else
            	{

            	
            echo ' 
            <option value="'.$sub->id.'" '.set_select("subsector",$sub->id).'>'.$sub->nombre.'</option>
            ';
        	}
           }
			
			echo
            '
            </select>
          </div>

          <!-- DEPENDENCIA -->
          <div class="col-md-6 form-group">
            <label for="select2">Dependencia:</label>
            <select class="form-control" name="depen" id="select_depen" >
            <option value=""> Selccionar </option>';
            foreach ($todasdepend as $objeto ) {
              if ($objeto->dep_id==$id) {
                echo ' 
            <option selected value="'.$objeto->dep_id.'" '.set_select("subsector",$objeto->dep_id).'>'.$objeto->dep_nombre.'</option>';
              }
              else
              {
                 echo ' 
            <option value="'.$objeto->dep_id.'" '.set_select("subsector",$objeto->dep_id).'>'.$objeto->dep_nombre.'</option>';
              }
            	   
            }

            echo'
            </select>
          </div>

          <!-- NOMBRE DEPENDENCIA -->
          <div class="col-md-6 form-group">
            <label for="subdependencia">Nombre:<input type="text" name="subdependencia" id="subdependencia"  class="form-control" maxlength="50" value="'.$dependencias[0]->dep_nombre.'"></label>

          </div>
          
          <!-- MEDIDAS -->
          <div class="col-md-6">';
          /* -------------------------------medidas -------------------------------*/
          

              echo '
             <label for="ancho_edit">
             Ancho:
             <input type="text" name="ancho_edit" id="ancho_edit" style="width:50px;" class="form-control" 
             value="'.$medidas_depend[0]->ancho.'" >
             </label>

             <label for="largo_edit">
             Largo:
             <input type="text" name="largo_edit" id="largo_edit" style="width:50px;" class="form-control" 
             value="'.$medidas_depend[0]->largo.'">
             </label>
             <label for="alto_edit">
             Alto:
             <input type="text" name="alto_edit" id="alto_edit" style="width:50px;" class="form-control" 
             value="'.$medidas_depend[0]->alto.'">
             </label>
         ';

            

       

         echo '</div>';


         /*-------------- INSTALACION ---------------------------------------------------*/
         /*INSTALACION OJO EL DISPLAY DESPLIEGA O NO*/
         /*si es infraestructura*/
         /*todo infraestructura*/
         foreach ($tipo as $t) {

          if($t->tipo == 2){

            echo ' <div id="div_instalaciones_editar" class="bs-callout col-md-12" style="display:block !important;">

         <h4>Instalación</h4>
            <div class="col-md-6 form-group">
              <label for="tipo_instalacion_edit">Tipo:</label>';
              echo'
              <select class="form-control" name="tipo_instalacion_edit" id="tipo_instalacion_edit">
                <option value=""> Selccionar </option>';
                foreach ($consultas_intalacion_tipo as $objeto) {

                  if ($objeto->material_nombre == $instalacion_form[0]->inst_tipo) {
                     echo' 
                   <option selected value="'.$objeto->material_nombre.'" '.set_select("tipo_select",$objeto->material_nombre).
                   '>'.$objeto->material_nombre.' </option>'
                   ;
                  }
                  else
                  {
                     echo' 
                   <option  value="'.$objeto->material_nombre.'" '.set_select("tipo_select",$objeto->material_nombre).
                   '>'.$objeto->material_nombre.' </option>'
                   ;
                  }
                }

           
               
            echo'  </select>
            </div>

            
            <div class="col-md-12 form-group">
              <label for="material_edit">Material:
                <select class="form-control" name="material_edit" id="material_edit">
                  <option value=""> Seleccionar </option>';
                  
                  foreach ($consultas_instalacion_material as $objeto) {
                    # code...
                    if ($objeto->material_nombre==$instalacion_form[0]->inst_material) {
                      echo' 
                   <option selected value="'.$objeto->material_nombre.'" '.set_select("material_select",$objeto->material_nombre).
                   '>'.$objeto->material_nombre.' </option>'
                   ;
                    }else{
                   echo' 
                   <option value="'.$objeto->material_nombre.'" '.set_select("material_select",$objeto->material_nombre).
                   '>'.$objeto->material_nombre.'</option>'
                   ;
                   }
                  }
                  
                  
                  echo'</select>
              </label>
            
            <label for="prioridad">Color pintura:';
            
            echo'
            <input type="text" name="color_edit" id="color_edit" style="width:150px;" value="'.$instalacion_form[0]->inst_pintura.'" class="form-control">
            </label>';
            
            echo'
            <label for="piso_edit">Piso:
              <select class="form-control" name="piso_edit" id="piso_edit">
                <option value=""> Seleccionar </option>';

                foreach ($consultas_instalacion_piso as $objeto) {
                   if ($objeto->material_nombre==$instalacion_form[0]->inst_piso) {
                      echo' 
                   <option selected value="'.$objeto->material_nombre.'" '.set_select("piso_select",$objeto->material_nombre).
                   '>'.$objeto->material_nombre.' </option>'
                   ;
                    }else{
                   echo' 
                   <option value="'.$objeto->material_nombre.'" '.set_select("piso_select",$objeto->material_nombre).
                   '>'.$objeto->material_nombre.'</option>'
                   ;
                   }


                }
              
              echo'
              </select>
            </label>
            
            
            ';

            if ($instalacion_form[0]->inst_cocina=="0") {
              # tiene cocina o no
              echo '
              <br/>
                <label for="cocina_edit">Cocina:
            </label>
              <label>
                  <input type="radio"  name="cocina_edit" value="1" id="RadioGroup1_0">
                  Si</label>
                  <label>
                  <input type="radio" checked name="cocina_edit" value="0" id="RadioGroup1_1">
                  No
              </label>

                  ';
            }
            else
            {
              echo'
              <br/> 
              <label for="cocina_edit">Cocina:
            </label>
              <label>
                  <input type="radio" checked name="cocina_edit" value="1" id="RadioGroup1_0">
                  Si
              </label>
              <label>
                  <input type="radio"  name="cocina_edit" value="0" id="RadioGroup1_1">
                  No
              </label>
            
            
              <label for="cocina_edit"> </label>';
            }
                
                
           
            echo '
       </div>
       <div class="col-md-4 form-group">
       <label for="ventana_edit">Tipo Ventana:</label>
           <select class="form-control" name="ventana_edit" id="ventana_edit" >';
         
                foreach ($consultas_instalacion_ventana as $objeto) {
                   if ($objeto->material_nombre==$instalacion_form[0]->inst_ventana) {
                      echo' 
                   <option selected value="'.$objeto->material_nombre.'" '.set_select("ventana_select",$objeto->material_nombre).
                   '>'.$objeto->material_nombre.' </option>'
                   ;
                    }
                    else
                    {
                   echo' 
                   <option value="'.$objeto->material_nombre.'" '.set_select("ventana_select",$objeto->material_nombre).
                   '>'.$objeto->material_nombre.'</option>'
                   ;
                   }


                }
            echo '
        </select>
        </div>
       <div class="col-md-4 form-group">
        <label for="techumbre_edit">Techumbre:</label>
           <select class="form-control" name="techumbre_edit" id="techumbre_edit">
            <option value=""> Selccionar </option>';
             foreach ($consultas_instalacion_techumbre as $objeto) {
                   if ($objeto->material_nombre==$instalacion_form[0]->inst_techumbre) {
                      echo' 
                   <option selected value="'.$objeto->material_nombre.'" '.set_select("techumbre_select",$objeto->material_nombre).
                   '>'.$objeto->material_nombre.' </option>'
                   ;
                    }
                    else
                    {
                   echo' 
                   <option value="'.$objeto->material_nombre.'" '.set_select("ventana_select",$objeto->material_nombre).
                   '>'.$objeto->material_nombre.'</option>'
                   ;
                   }


                }

             
        echo '</select>
        </div>

       <div class="col-md-4 form-group">
        
        <label for="bajada_agua_edit">Bajada de agua:</label>

           <select class="form-control" name="bajada_agua_edit" id="bajada_agua_edit">
            <option value=""> Selccionar </option>
        '; 
                foreach ($consultas_instalacion_bajada_agua as $objeto) {
                   if ($objeto->material_nombre==$instalacion_form[0]->inst_bajadadeagua) {
                      echo' 
                   <option selected value="'.$objeto->material_nombre.'" '.set_select("bajada_agua_select",$objeto->material_nombre).
                   '>'.$objeto->material_nombre.' </option>'
                   ;
                    }
                    else
                    {
                   echo' 
                   <option value="'.$objeto->material_nombre.'" '.set_select("bajada_agua_select",$objeto->material_nombre).
                   '>'.$objeto->material_nombre.'</option>'
                   ;
                   }


                }


        echo'
        </select>
        </div>
       <div class="col-md-2 form-group">
         <label for="n_puertas_edit">Nº Puertas:
            <input type="text" name="n_puertas_edit" id="n_puertas_edit"  value="'.$instalacion_form[0]->inst_npuertas.' " class="form-control"></label>
        
               </div>
       <div class="col-md-3 form-group" style="padding:0px;">';
       if ($instalacion_form[0]->inst_escalera =="1") {
         echo'
          <label for="escalera_edit">Escalera:
            </label>
            
                <label>
                  <input type="radio" checked name="escalera_edit" value="1" id="escalera">
                  Si</label>
                
            <label>
                  <input type="radio" name="escalera_edit" value="0" id="escalera">
                  No</label>
        </div>
         ';
       }else{
        echo'
          <label for="escalera_edit">Escalera:
            </label>
            
                <label>
                  <input type="radio"  name="escalera_edit" value="1" id="escalera">
                  Si</label>
                
            <label>
                  <input type="radio" checked name="escalera_edit" value="0" id="escalera">
                  No</label>
        </div>
         ';

       }
        
        echo'
       <div class="col-md-3 form-group">
       ';
       if ($instalacion_form[0]->inst_bano=="1") {
       echo '
         <label for="bano_edit">Baño:
            </label>
            
                <label>
                  <input type="radio" checked name="bano_edit" value="1" id="bano">
                  Si</label>
                
            <label>
                  <input type="radio" name="bano_edit" value="0" id="bano">
                  No</label>
        </div>
       ';
       

       }else{
         echo '
         <label for="bano_edit">Baño:
            </label>
            
                <label>
                  <input type="radio" checked name="bano_edit" value="1" id="bano">
                  Si</label>
                
            <label>
                  <input type="radio" name="bano_edit" value="0" id="bano">
                  No</label>
        </div>
       ';
       }

        echo'
       <div class="col-md-4 form-group">
       ';
       if ($instalacion_form[0]->inst_camarines == "1") {
        echo'
         <label for="camarines_edit">camarines:
            </label>
            
                <label>
                  <input type="radio" checked name="camarines_edit" value="1" id="camarines_edit">
                  Si</label>
                
            <label>
                  <input type="radio" name="camarines_edit" value="0" id="camarines_edit">
                  No</label>
        </div>';
       }else
       {
         echo'
         <label for="camarines_edit">camarines:
            </label>
            
                <label>
                  <input type="radio"  name="camarines_edit" value="1" id="camarines_edit">
                  Si</label>
                
            <label>
                  <input type="radio" checked name="camarines_edit" value="0" id="camarines_edit">
                  No</label>
        </div>';
       }
       

        echo'
       <div class="col-md-12 form-group">
          <div class="col-md-2 form-group" style="padding:5px;">
         <label for="n_bano_edit">Nº Baños:
            <input type="text" name="n_bano_edit" id="n_bano_edit"  value="'.$instalacion_form[0]->inst_bano.' "  class="form-control"></label>
        
               </div>
               
                 <div class="col-md-2 form-group" style="padding:5px;">
         <label for="n_urinario_edit">Nº Urinarios:
            <input type="text"  value="'.$instalacion_form[0]->inst_urinarios.' " name="n_urinario_edit" id="n_urinario_edit"  class="form-control"></label>
        
               </div>
               
                 <div class="col-md-3 form-group" style="padding:5px;">
         <label for="n_lavamanos_edit">Nº Lavamanos:
            <input type="text" name="n_lavamanos_edit"  value="'.$instalacion_form[0]->inst_lavamanos.' " id="n_lavamanos_edit"  class="form-control"></label>
        
               </div>
               
               <div class="col-md-2 form-group" style="padding:5px;">
         <label for="n_duchas_edit">Nº Duchas:
            <input type="text" name="n_duchas_edit" id="n_duchas_edit"  value="'.$instalacion_form[0]->inst_duchas.' "   class="form-control"></label>
        
               </div>
               
                <div class="col-md-2 form-group" style="padding:5px;">
         <label for="n_camarinos_edit">Nº Camarinos:
            <input type="text" name="n_camarinos_edit" value="'.$instalacion_form[0]->inst_ncamarines.' " id="n_camarinos_edit"  class="form-control"></label>
        
               </div>
               
               </div>
       <div class="col-md-3 form-group">
       ';
       if ($instalacion_form[0]->inst_fosa=="1") {
         echo'
        <label for="fosa_edit">Fosa:
            </label>
            
                <label>
                  <input type="radio" checked name="fosa_edit" value="1" id="fosa_si">
                  Si</label>
                
            <label>
                  <input type="radio" name="fosa_edit" value="0" id="fosa_no">
                  No</label>
       </div>
       ';
       }else
       {
         echo'
        <label for="fosa_edit">Fosa:
            </label>
            
                <label>
                  <input type="radio"  name="fosa_edit" value="1" id="fosa_si">
                  Si</label>
                
            <label>
                  <input type="radio" checked name="fosa_edit" value="0" id="fosa_no">
                  No</label>
       </div>
       ';
       }
       
/* todo2 */
       echo'
        <div class="col-md-3 form-group">
        <label for="n_fosa_edit">Nº Fosas:
            <input type="number" name="n_fosa_edit" id="n_fosa"  value="'.$instalacion_form[0]->inst_nfosa.'"  class="form-control"></label>
     </div>

     </div>
';  
}

  /*segunda plantilla*/

            echo ' <div id="div_instalaciones_editar" class="bs-callout col-md-12" style="display:none !important;">

         <h4>Instalación</h4>
            <div class="col-md-6 form-group">
              <label for="tipo_instalacion">Tipo:</label>';
              echo'
              <select class="form-control" name="tipo_instalacion" id="tipo_instalacion">
                <option selected value=""> Selccionar </option>';
                foreach ($consultas_intalacion_tipo as $objeto) {

                  
                     echo' 
                   <option value="'.$objeto->material_nombre.'" '.set_select("tipo_select",$objeto->material_nombre).
                   '>'.$objeto->material_nombre.' </option>';
                  
                
              }

            echo'  </select>
            </div>

            
            <div class="col-md-12 form-group">
              <label for="material">Material:
                <select class="form-control" name="material" id="material">
                  <option selected value=""> Seleccionar </option>';
                  
                  foreach ($consultas_instalacion_material as $objeto) {
                    
                      echo' 
                   <option  value="'.$objeto->material_nombre.'" '.set_select("material_select",$objeto->material_nombre).
                   '>'.$objeto->material_nombre.' </option>';
                   
                    }
                  
                  
                  
                  echo'</select>
              </label>
            
            <label for="prioridad">Color pintura:';
            
            echo'
            <input type="text" name="color" id="color" style="width:150px;"  class="form-control">
            </label>';
            
            echo'
            <label for="piso">Piso:
              <select class="form-control" name="piso" id="piso">
                <option selected value=""> Seleccionar </option>';

                foreach ($consultas_instalacion_piso as $objeto) {

                      echo' 
                   <option  value="'.$objeto->material_nombre.'" '.set_select("piso_select",$objeto->material_nombre).
                   '>'.$objeto->material_nombre.' </option>';
                   }

              
              echo'
              </select>
            </label>
            
            
            ';

      
              # tiene cocina o no
              echo '
              <br/>
                <label for="cocina">Cocina:
            </label>
              <label>
                  <input type="radio"  name="cocina" value="1" id="RadioGroup1_0">
                  Si</label>
                  <label>
                  <input type="radio" name="cocina" value="0" id="RadioGroup1_1">
                  No
              </label>

                  ';
         
                
                
           
            echo '
       </div>
       <div class="col-md-4 form-group">
       <label for="ventana">Tipo Ventana:</label>
           <select class="form-control" name="ventana" id="ventana" >';
         
                foreach ($consultas_instalacion_ventana as $objeto) {
                  
                      echo' 
                   <option selected value="'.$objeto->material_nombre.'" '.set_select("ventana_select",$objeto->material_nombre).
                   '>'.$objeto->material_nombre.' </option>'
                   ;
                }

            echo '
        </select>
        </div>
       <div class="col-md-4 form-group">
        <label for="techumbre">Techumbre:</label>
           <select class="form-control" name="techumbre" id="techumbre">
            <option selected value=""> Selccionar </option>';
             foreach ($consultas_instalacion_techumbre as $objeto) {
                      echo' 
                   <option  value="'.$objeto->material_nombre.'" '.set_select("techumbre_select",$objeto->material_nombre).
                   '>'.$objeto->material_nombre.' </option>'
                   ;          
                }

             
        echo '</select>
        </div>

       <div class="col-md-4 form-group">
        
        <label for="bajada_agua">Bajada de agua:</label>

           <select class="form-control" name="bajada_agua" id="bajada_agua">
            <option selected value=""> Selccionar </option>
        '; 
                foreach ($consultas_instalacion_bajada_agua as $objeto) {
                      echo' 
                   <option  value="'.$objeto->material_nombre.'" '.set_select("bajada_agua_select",$objeto->material_nombre).
                   '>'.$objeto->material_nombre.' </option>'
                   ;
              }


        echo'
        </select>
        </div>
       <div class="col-md-2 form-group">
         <label for="n_puertas">Nº Puertas:
            <input type="text" name="n_puertas" id="n_puertas"  class="form-control"></label>
        
               </div>
       <div class="col-md-3 form-group" style="padding:0px;">';
       
         echo'
          <label for="escalera">Escalera:
            </label>
            
                <label>
                  <input type="radio" name="escalera" value="1" id="escalera">
                  Si</label>
                
            <label>
                  <input type="radio" name="escalera" value="0" id="escalera">
                  No</label>
        </div>
         ';
      
        
        echo'
       <div class="col-md-3 form-group">
       ';
     
       echo '
         <label for="bano">Baño:
            </label>
            
                <label>
                  <input type="radio"  name="bano" value="1" id="bano">
                  Si</label>
                
            <label>
                  <input type="radio" name="bano" value="0" id="bano">
                  No</label>
        </div>
       ';
       

  

        echo'
       <div class="col-md-4 form-group">
       ';
    
        echo'
         <label for="camarines">camarines:
            </label>
            
                <label>
                  <input type="radio" name="camarines" value="1" id="camarines">
                  Si</label>
                
            <label>
                  <input type="radio" name="camarines" value="0" id="camarines">
                  No</label>
        </div>';
     
       

        echo'
       <div class="col-md-12 form-group">
          <div class="col-md-2 form-group" style="padding:5px;">
         <label for="n_bano">Nº Baños:
            <input type="text" name="n_bano" id="n_bano"   class="form-control"></label>
        
               </div>
               
                 <div class="col-md-2 form-group" style="padding:5px;">
         <label for="n_urinario">Nº Urinarios:
            <input type="text"   name="n_urinario" id="n_urinario"  class="form-control"></label>
        
               </div>
               
                 <div class="col-md-3 form-group" style="padding:5px;">
         <label for="n_lavamanos">Nº Lavamanos:
            <input type="text" name="n_lavamanos" id="n_lavamanos"  class="form-control"></label>
        
               </div>
               
               <div class="col-md-2 form-group" style="padding:5px;">
         <label for="n_duchas">Nº Duchas:
            <input type="text" name="n_duchas" id="n_duchas"   class="form-control"></label>
        
               </div>
               
                <div class="col-md-2 form-group" style="padding:5px;">
         <label for="n_camarinos">Nº Camarinos:
            <input type="text" name="n_camarinos"  id="n_camarinos"  class="form-control"></label>
        
               </div>
               
               </div>
       <div class="col-md-3 form-group">
       ';
      
         echo'
        <label for="fosa">Fosa:
            </label>
            
                <label>
                  <input type="radio"  name="fosa" value="1" id="fosa_si">
                  Si</label>
                
            <label>
                  <input type="radio" name="fosa" value="0" id="fosa_no">
                  No</label>
       </div>
       ';

 
       

       echo'
        <div class="col-md-3 form-group">
        <label for="n_fosa">Nº Fosas:
            <input type="number" name="n_fosa" id="n_fosa" class="form-control"></label>
     </div>

     </div>
';  


 }






/* ---------------------------- vegetacion -----------------------*/
 foreach ($tipo as $t) {

          if($t->tipo == 1){
            echo '
     <div id="div_vegetacion_edit" class="bs-callout col-md-12" style="display:block;" >
          <h4>Vegetación</h4> 
          
         <div class="col-md-6 form-group" ><label for="tipo_veg_edit">Tipo Vegetación:</label>
            <select class="form-control" name="tipo_veg_edit" id="tipo_veg_edit">
             <option value=""> Selccionar </option>
    ';



     foreach($retorno_tipo_vegetacion as  $objeto){
      if ($retorno_vegetacion_datos[0]->veg_tipo == $objeto->vegtipo_id) {
        echo '<option selected value="'.$objeto->vegtipo_id.'" '.set_select("tipo_veg_edit",$objeto->vegtipo_id).'>'.$objeto->vegtipo_tipo.'</option>';
      }else
      {
        echo '<option value="'.$objeto->vegtipo_id.'" '.set_select("tipo_veg_edit",$objeto->vegtipo_id).'>'.$objeto->vegtipo_tipo.'</option>';

      }
        
       } 

       

       echo '
        </select></div>
          
          <div class="col-md-6 form-group" ><label for="categoria_veg_edit">Categoria:</label>
            <select class="form-control" name="categoria_veg_edit" id="categoria_veg_edit">
             <option value=""> Selccionar </option>
             ';
            
         foreach($retorno_categoria_vegetacion as  $objeto){

          if ($retorno_vegetacion_datos[0]->veg_categoria == $objeto->vegcat_id) {
            echo '<option selected value="'.$objeto->vegcat_id.'" '.set_select("categoria_veg_edit",$objeto->vegcat_id).'>'.$objeto->vegcat_categoria.'</option>';
          }else
          {
            echo '<option value="'.$objeto->vegcat_id.'" '.set_select("categoria_veg_edit",$objeto->vegcat_id).'>'.$objeto->vegcat_categoria.'</option>';

          }
           
       } 


            echo'
          </select></div>


          <div class="col-md-3 form-group" ><label for="fecha_plantacion_edit">Fecha Plantación:</label>
          <input type="text" name="fecha_plantacion_edit" id="fecha_plantacion_edit" 
          value=" '.$retorno_vegetacion_datos[0]->veg_fecha_plantacion.' " class="form-control"></div>
          
          <div class="col-md-3 form-group" ><label for="veg_cantidad_edit">Cantidad:</label>
          <input type="number" name="veg_cantidad_edit" id="veg_cantidad_edit" 
          value="'.$retorno_vegetacion_datos[0]->veg_cantidad.'" class="form-control"></div>
          
          <div class="col-md-6 form-group" ><label for="tipo_riego_edit">Tipo Riego:</label>
           <select class="form-control" name="tipo_riego_edit" id="tipo_riego_edit">
            <option value=""> Selccionar </option>';
            
           if ($retorno_vegetacion_datos[0]->veg_tipo_riego=="MANUAL") {
             # code...
            echo '
            <option value="MANUAL" selected> MANUAL </option>
            <option value="ASPERSOR AUTOMATICO"> ASPERSOR AUTOMATICO </option>
            <option value="ASPERSOR MANUAL"> ASPERSOR MANUAL </option>
            ';
           }
           if ($retorno_vegetacion_datos[0]->veg_tipo_riego=="ASPERSOR AUTOMATICO") {
             # code...
            echo '
            <option value="MANUAL" > MANUAL </option>
            <option value="ASPERSOR AUTOMATICO" selected> ASPERSOR AUTOMATICO </option>
            <option value="ASPERSOR MANUAL"> ASPERSOR MANUAL </option>
            ';
           }
           if ($retorno_vegetacion_datos[0]->veg_tipo_riego=="ASPERSOR MANUAL") {
             # code...
             echo '
            <option value="MANUAL" > MANUAL </option>
            <option value="ASPERSOR AUTOMATICO" selected> ASPERSOR AUTOMATICO </option>
            <option value="ASPERSOR MANUAL" selected> ASPERSOR MANUAL </option>
            ';
           }
           
            echo'
          </select></div>
          
         </div> 
';

          }
}

/*segundo formulario*/

echo '
     <div id="div_vegetacion_edit" class="bs-callout col-md-12" style="display:none;" >
          <h4>Vegetación</h4> 
          
         <div class="col-md-6 form-group" ><label for="tipo_veg">Tipo Vegetación:</label>
            <select class="form-control" name="tipo_veg" id="tipo_veg">
             <option selected value=""> Selccionar </option>
    ';



     foreach($retorno_tipo_vegetacion as  $objeto){

      
        echo '<option value="'.$objeto->vegtipo_id.'" '.set_select("tipo_veg",$objeto->vegtipo_id).'>'.$objeto->vegtipo_tipo.'</option>';

      
        
       } 

       

       echo '
        </select></div>
          
          <div class="col-md-6 form-group" ><label for="categoria_veg">Categoria:</label>
            <select class="form-control" name="categoria_veg" id="categoria_veg">
             <option value=""> Selccionar </option>
             ';
            
         foreach($retorno_categoria_vegetacion as  $objeto){

 
          
            echo '<option value="'.$objeto->vegcat_id.'" '.set_select("categoria_veg",$objeto->vegcat_id).'>'.$objeto->vegcat_categoria.'</option>';

          }
           
       


            echo'
          </select></div>


          <div class="col-md-3 form-group" ><label for="fecha_plantacion">Fecha Plantación:</label>
          <input type="text" name="fecha_plantacion" id="fecha_plantacion" 
           class="form-control"></div>
          
          <div class="col-md-3 form-group" ><label for="veg_cantidad">Cantidad:</label>
          <input type="number" name="veg_cantidad" id="veg_cantidad" 
           class="form-control"></div>
          
          <div class="col-md-6 form-group" ><label for="tipo_riego">Tipo Riego:</label>
           <select class="form-control" name="tipo_riego" id="tipo_riego">
            <option selected value=""> Selccionar </option>';
            
           if ($retorno_vegetacion_datos[0]->veg_tipo_riego=="MANUAL") {
             # code...
            echo '
            <option value="MANUAL" selected> MANUAL </option>
            <option value="ASPERSOR AUTOMATICO"> ASPERSOR AUTOMATICO </option>
            <option value="ASPERSOR MANUAL"> ASPERSOR MANUAL </option>
            ';
           }
           if ($retorno_vegetacion_datos[0]->veg_tipo_riego=="ASPERSOR AUTOMATICO") {
             # code...
            echo '
            <option value="MANUAL" > MANUAL </option>
            <option value="ASPERSOR AUTOMATICO" selected> ASPERSOR AUTOMATICO </option>
            <option value="ASPERSOR MANUAL"> ASPERSOR MANUAL </option>
            ';
           }
           if ($retorno_vegetacion_datos[0]->veg_tipo_riego=="ASPERSOR MANUAL") {
             # code...
             echo '
            <option value="MANUAL" > MANUAL </option>
            <option value="ASPERSOR AUTOMATICO" selected> ASPERSOR AUTOMATICO </option>
            <option value="ASPERSOR MANUAL" selected> ASPERSOR MANUAL </option>
            ';
           }
           
           if ($retorno_vegetacion_datos[0]->veg_tipo_riego !="ASPERSOR MANUAL" && 
            $retorno_vegetacion_datos[0]->veg_tipo_riego !="ASPERSOR AUTOMATICO" &&
            $retorno_vegetacion_datos[0]->veg_tipo_riego !="MANUAL") {
             echo '
            <option value="MANUAL" > MANUAL </option>
            <option value="ASPERSOR AUTOMATICO" > ASPERSOR AUTOMATICO </option>
            <option value="ASPERSOR MANUAL"> ASPERSOR MANUAL </option>
            ';
           }
            echo'
          </select></div>
          
         </div> 
';





foreach ($tipo as $t) {

          if($t->tipo == 3){
            echo'
         <!-- recreacion -->
          <div id="div_recreacion_edit" class="bs-callout col-md-12" style="display:block;" >
            <h4>Recreación</h4> 
            <div class="col-md-6 form-group" >
              <label for="tipo_recreacion_edit">Tipo Recreación:</label>
              <select class="form-control" name="tipo_recreacion_edit" id="tipo_recreacion_edit">
                <option value=""> Selccionar </option>';
                if ($recreacion_datos[0]->r_tipo=="deportivo" ) {
                   echo'
                <option selected value="deportivo"> DEPORTIVO </option>
                <option value="social"> SOCIAL </option>';
                }
                if ($recreacion_datos[0]->r_tipo=="social") {
                  echo'
                <option value="deportivo"> DEPORTIVO </option>
                <option selected value="social"> SOCIAL </option>';
                }
              
              echo
              '</select>
            </div>
            <div class="col-md-6 form-group" >
              <label for="superficie_edit">Superficie:</label>
              <select class="form-control" name="superficie_edit" id="superficie_edit">';

                if ($recreacion_datos[0]->r_superficie=="Cesped") {
                  echo'
                <option selected value="Cesped"> Cesped </option>
                <option value="Arcilla"> Arcilla</option>
                <option value="Cemento">Cemento</option>
                <option value="Sintética">Sintética</option>
                <option value="Arena">Arena</option>
                ';
                }
                if ($recreacion_datos[0]->r_superficie=="Arcilla") {
                  echo'
                <option value="Cesped"> Cesped </option>
                <option selected value="Arcilla"> Arcilla</option>
                <option value="Cemento">Cemento</option>
                <option value="Sintética">Sintética</option>
                <option value="Arena">Arena</option>
                ';
                }
                if ($recreacion_datos[0]->r_superficie=="Cemento") {
                  echo'
                <option value="Cesped"> Cesped </option>
                <option value="Arcilla"> Arcilla</option>
                <option selected value="Cemento">Cemento</option>
                <option value="Sintética">Sintética</option>
                <option value="Arena">Arena</option>
                ';
                }
                if ($recreacion_datos[0]->r_superficie=="Sintética") {
                  echo'
                <option value="Cesped"> Cesped </option>
                <option value="Arcilla"> Arcilla</option>
                <option value="Cemento">Cemento</option>
                <option selected value="Sintética">Sintética</option>
                <option value="Arena">Arena</option>
                ';
                }
               if ($recreacion_datos[0]->r_superficie=="Arena") {
                  echo'
                <option value="Cesped"> Cesped </option>
                <option value="Arcilla"> Arcilla</option>
                <option value="Cemento">Cemento</option>
                <option value="Sintética">Sintética</option>
                <option selected value="Arena">Arena</option>
                ';
                }

                
                echo '
              </select>
            </div>
          </div>';
          }
    }



/*  SEGUNDO FORMULARIO */

echo'
         <!-- recreacion -->
          <div id="div_recreacion_edit" class="bs-callout col-md-12" style="display:none;" >
            <h4>Recreación</h4> 
            <div class="col-md-6 form-group" >
              <label for="tipo_recreacion">Tipo Recreación:</label>
              <select class="form-control" name="tipo_recreacion" id="tipo_recreacion">
                <option selected value=""> Selccionar </option>';
               
                  echo'
                <option value="deportivo"> DEPORTIVO </option>
                <option  value="social"> SOCIAL </option>';
                
              
              echo
              '</select>
            </div>
            <div class="col-md-6 form-group" >
              <label for="superficie">Superficie:</label>
              <select class="form-control" name="superficie" id="superficie">

                <option value="Cesped"> Cesped </option>
                <option value="Arcilla"> Arcilla</option>
                <option value="Cemento">Cemento</option>
                <option value="Sintética">Sintética</option>
                <option value="Arena">Arena</option>
                ';

                echo '
              </select>
            </div>
          </div>';





echo '
           <div class="col-md-12">
          <label for="observaciones_edit">Observaciones:
          </label>
          <textarea style="width:100%; min-height:160px; margin-top:15px;" name="observaciones_edit"
           >'.$medidas_depend[0]->observaciones.'</textarea></div>
      
      </div>
     	 ';

/* -------------------------------------------- fin ventana imprimir editar -------------------*/
}
/* -------------------------------------------- fin ventana imprimir editar -------------------*/



/* -----------------------------------------actualizar -------------------------*/
/* -------------------------------------------- fin ventana imprimir editar -------------------*/

public function actualizar()
{
  /*id depen seleccionada a editar + los 3 checkbox principales */
          $id_dependencia_seleccionada = $this->input->post('id_dependencia_edit');
          $op_veg = $this->input->post('chk_vegetacion_edit');
          $op_ins = $this->input->post('chk_instalacion_edit');
          $op_rec = $this->input->post('chk_recreacion_edit');

          /*saber si existe en la tabla*/
          $is_jardineria= $this -> model_dependencias  -> 
          esta_en_la_tabla( $id_dependencia_seleccionada,1);

          $is_infraestructura= $this -> model_dependencias  ->
           esta_en_la_tabla( $id_dependencia_seleccionada,2);

          $is_recreacion= $this -> model_dependencias  ->
           esta_en_la_tabla( $id_dependencia_seleccionada,3);

/*retorno el id maximo de la tabla dependencias_tipo*/
$id_max = $this-> model_dependencias->maxid_tipo_dep();

/*retorno el id maximo de la tabla dependencia*/
$maxi_depen = $this-> model_dependencias->maxid();


/* --------------------------INSTALACION-----------------------------*/ 


if (empty($op_ins)==false){
          $dependencias_tipo_no_existe = array(
          'id'=>(((int)$id_max )+ 1), 
          'tipo' => 2,
          'dependencia' =>(int) $this->input->post('id_dependencia_edit'),
          'sub_sector' => (int) $this->input->post('subsector'),
          'sector' => (int) $this->input->post('sector')
         // 'observaciones' => $this->input->post('observaciones')
          );

          $dependencia = array(
          'sector' => $this->input->post('sector'),
          'sub_sector' => $this->input->post('subsector'),
          'dep_nombre' => $this->input->post('subdependencia'),
          'ancho' => $this ->input->post('ancho_edit'),
          'largo' => $this ->input->post('largo_edit'),
          'alto' => $this ->input->post('alto_edit'),
          'observaciones' => $this->input->post('observaciones_edit')
          );
          $dependencias_tipo_si_existe = array(
          //'id'=>$id_max+1, 
          'tipo' => 2,
          'dependencia' =>(int) $this->input->post('id_dependencia_edit'),
          'sub_sector' => (int) $this->input->post('subsector'),
          'sector' => (int) $this->input->post('sector'),
          //'observaciones' => $this->input->post('observaciones')
          );

/*retorno del id al cual pertenece dentro de dependencia_tipo*/
$id_depen_tipo_pertenece =$this-> model_dependencias -> consultar_id_depen_tipo(2,$id_dependencia_seleccionada);
       /* ---------------------- tomo los datos de instalacion --------------------------*/
      
        // infraestructura
    foreach ($is_infraestructura as $key) {
            //si esta en la tabla dependencias tipos
            if ( (int)$key->cuantos > 0 ) {
              
                $ancho = $_POST['ancho_edit'];
                $largo = $_POST['largo_edit'];
                $alto = $_POST['alto_edit'];
                $tipo_instalacion=$_POST['tipo_instalacion_edit'];
                $color=$_POST['color_edit'];
                $piso=$_POST['piso_edit'];
                $ventana=$_POST['ventana_edit'];
                $techumbre=$_POST['techumbre_edit'];
                $bajada_agua=$_POST['bajada_agua_edit'];
                $escalera=$_POST['escalera_edit'];
                $bano=$_POST['bano_edit'];
                $camarines=$_POST['camarines_edit'];
                $n_bano=$_POST['n_bano_edit'];
                $n_urinario=$_POST['n_urinario_edit'];
                $n_lavamanos=$_POST['n_lavamanos_edit'];
                $n_duchas=$_POST['n_duchas_edit'];
                $n_camarinos=$_POST['n_camarinos_edit'];
                $materia=$_POST['material_edit'];
                $cocina=$_POST['cocina_edit'];
                $fosa=$_POST['fosa_edit'];
                $n_fosa=$_POST['n_fosa_edit'];
                $n_puertas=$_POST['n_puertas_edit'];

                     $data_i=array(
                 //"inst_largo" => $largo,
                 //"inst_ancho" => $ancho,   
                 "inst_tipo" => $tipo_instalacion,
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
                 //"inst_alto" =>$alto,
                 "inst_urinarios" => $n_urinario,
                 "inst_lavamanos" => $n_lavamanos,
                 "inst_duchas" => $n_duchas,
                 "inst_camarines" => $camarines,
                 "inst_ncamarines" => $n_camarinos,
                 "inst_fosa" => $fosa,
                 "inst_nfosa" => $n_fosa,
                // "dependencias_tipo_id" =>$maxi_depen,
                 'sub_sector' =>  $this->input->post('subsector'),
                 'dependencia' => $id_dependencia_seleccionada,
                 'sector' => $this->input->post('sector')
              );
                  # actualizo los datos de infraestructura y tipo_dependencia
                  $this->model_dependencias->actualizar_tipo_dependencia($id_dependencia_seleccionada,2,$dependencias_tipo_si_existe);

                  
                  $this->model_dependencias->actualizar_instalacion($id_dependencia_seleccionada,$id_depen_tipo_pertenece[0]->id,$data_i);

                  $this->model_dependencias-> actualizar_depen($id_dependencia_seleccionada,$dependencia);
                  //echo'| actualizo instalacion |';
           /*         $this->session->set_flashdata('category_success', 'Actualizado correctamente.');
  redirect (base_url().'dependencias/inicio');*/

            }else{
 var_dump($_POST['cocina']);
                $ancho = $_POST['ancho_edit'];
                $largo = $_POST['largo_edit'];
                $alto = $_POST['alto_edit'];
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

                  $data_i_nuevo=array(
                // "inst_largo" => $largo,
                 //"inst_ancho" => $ancho,   
                 "inst_tipo" => $tipo_instalacion,
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
                 //"inst_alto" =>$alto,
                 "inst_urinarios" => $n_urinario,
                 "inst_lavamanos" => $n_lavamanos,
                 "inst_duchas" => $n_duchas,
                 "inst_camarines" => $camarines,
                 "inst_ncamarines" => $n_camarinos,
                 "inst_fosa" => $fosa,
                 "inst_nfosa" => $n_fosa,
                 "dependencias_tipo_id" =>(((int)$maxi_depen)+1),
                 'sub_sector' =>  $this->input->post('subsector'),
                 'dependencia' => $id_dependencia_seleccionada,
                 'sector' => $this->input->post('sector')
              );
                 
              # agrego a las dependencias
            $this-> model_dependencias ->insert_dependencia_tipo($dependencias_tipo_no_existe);
            $this -> model_dependencias ->insert_instalaciones($data_i_nuevo);
           // var_dump($data_i_nuevo);
           // echo '| agrego a dependencias y instalacion |';
           /* $this->session->set_flashdata('category_success', 'Agregado correctamente.');
  redirect (base_url().'dependencias/inicio');*/
            }

          }
          }else{
            /*retorno del id al cual pertenece dentro de dependencia_tipo*/
            $id_depen_tipo_pertenece =$this-> model_dependencias -> consultar_id_depen_tipo(2,$id_dependencia_seleccionada);

           if (empty($id_depen_tipo_pertenece)==false){
              
			$this-> model_dependencias ->eliminar_instalacion($id_dependencia_seleccionada,$id_depen_tipo_pertenece[0]->id);
              $this-> model_dependencias ->eliminar_dependencias_tipo($id_dependencia_seleccionada,2);

             
                  // echo'| elimina la instalacion y dependencia |';
  /* $this->session->set_flashdata('category_success', 'Eliminado correctamente.');
  redirect (base_url().'dependencias/inicio');*/
           
                   }
            }
          
 
/*--------------------------------------VEGETACION ----------------------------*/      
if (empty($op_veg)==false){
    
   $dependencia = array(
          'sector' => $this->input->post('sector'),
          'sub_sector' => $this->input->post('subsector'),
          'dep_nombre' => $this->input->post('subdependencia'),
          'ancho' => $this ->input->post('ancho_edit'),
          'largo' => $this ->input->post('largo_edit'),
          'alto' => $this ->input->post('alto_edit'),
          'observaciones' => $this->input->post('observaciones_edit')
          );

       
          $dependencias_tipo_no_existe = array(
          'id'=>(((int)$id_max )+ 1), 
          'tipo' => 1,
          'dependencia' =>(int) $this->input->post('id_dependencia_edit'),
          'sub_sector' => (int) $this->input->post('subsector'),
          'sector' => (int) $this->input->post('sector'),
          //'observaciones' => $this->input->post('observaciones')
          );

          $dependencias_tipo_si_existe = array(
          //'id'=>$id_max+1, 
          'tipo' => 1,
          'dependencia' =>(int) $this->input->post('id_dependencia_edit'),
          'sub_sector' => (int) $this->input->post('subsector'),
          'sector' => (int) $this->input->post('sector'),
          //'observaciones' => $this->input->post('observaciones')
          );

          /*retorno del id al cual pertenece dentro de dependencia_tipo*/
$id_depen_tipo_pertenece =$this-> model_dependencias -> consultar_id_depen_tipo(1,$id_dependencia_seleccionada);



        // jardineri
    foreach ($is_jardineria as $key) {
            //si esta en la tabla dependencias tipos
            if ( (int)$key->cuantos > 0 ) {
                 
                  $veg_tipo=$_POST['tipo_veg_edit'];
                  $veg_categoria=$_POST['categoria_veg_edit'];
                  $veg_plantacion=$_POST['fecha_plantacion_edit'];
                  $veg_riego=$_POST['tipo_riego_edit'];
                  $veg_cantidad=$_POST['veg_cantidad_edit'];

                      $data_j=array(
                   "veg_fecha_plantacion" => $veg_plantacion ,
                   "veg_categoria" =>$veg_categoria ,
                   "veg_tipo" => $veg_tipo,
                   "veg_tipo_riego" => $veg_riego ,
                   "veg_cantidad" => $veg_cantidad ,
                  // "dependencias_tipo_id" => $id_depen_tipo_pertenece,
                   "sub_sector" =>  $this->input->post('subsector'),
                   "dependencia" => $id_dependencia_seleccionada,
                   "sector" => $this->input->post('sector'));
                

               # actualizo los datos de jardineri y tipo_dependencia
                  $this->model_dependencias->actualizar_tipo_dependencia($id_dependencia_seleccionada,1,$dependencias_tipo_si_existe);
  
                  $this->model_dependencias->actualizar_vegetacion($id_dependencia_seleccionada,$id_depen_tipo_pertenece[0]->id,$data_j);
                
                  $this->model_dependencias-> actualizar_depen($id_dependencia_seleccionada,$dependencia);

                //  echo'| actualizo vegetacion |';
             /*   $this->session->set_flashdata('category_success', 'Actualizado correctamente.');
  redirect (base_url().'dependencias/inicio');*/
            }else{

                  $veg_tipo_n=$_POST['tipo_veg'];
                  $veg_categoria_n=$_POST['categoria_veg'];
                  $veg_plantacion_n=$_POST['fecha_plantacion'];
                  $veg_riego_n=$_POST['tipo_riego'];
                  $veg_cantidad_n=$_POST['veg_cantidad'];   
                    
                    $data_j_nuevo=array(
                   "veg_fecha_plantacion" => $veg_plantacion_n ,
                   "veg_categoria" =>$veg_categoria_n ,
                   "veg_tipo" => $veg_tipo_n,
                   "veg_tipo_riego" => $veg_riego_n ,
                   "veg_cantidad" => $veg_cantidad_n ,
                   "dependencias_tipo_id" => (((int)$maxi_depen)+1),
                   "sub_sector" =>  $this->input->post('subsector'),
                   "dependencia" => $id_dependencia_seleccionada,
                   "sector" => $this->input->post('sector'));  

              # agrego a las dependencias
            $this-> model_dependencias ->insert_dependencia_tipo($dependencias_tipo_no_existe);
            $this -> model_dependencias ->insert_vegetacion($data_j_nuevo);
             
           /* $this->session->set_flashdata('category_success', 'Agregado correctamente.');
  redirect (base_url().'dependencias/inicio');*/
            
            }

          }
          }else{
                # si no esta seleccionado lo borro
            if (empty($id_depen_tipo_pertenece)==false){
				$this-> model_dependencias ->eliminar_vegetacion($id_dependencia_seleccionada,$id_depen_tipo_pertenece[0]->id);
                  $this-> model_dependencias ->eliminar_dependencias_tipo($id_dependencia_seleccionada,1);
                  
                   //echo'| elimina la vegetacion y dependencia |';
  /*$this->session->set_flashdata('category_success', 'Eliminado correctamente.');
  redirect (base_url().'dependencias/inicio');*/
                }
            }

/* --------------------------RECREACION-----------------------------*/ 


if (empty($op_rec)==false){

          $dependencia = array(
          'sector' => $this->input->post('sector'),
          'sub_sector' => $this->input->post('subsector'),
          'dep_nombre' => $this->input->post('subdependencia'),
          'ancho' => $this ->input->post('ancho_edit'),
          'largo' => $this ->input->post('largo_edit'),
          'alto' => $this ->input->post('alto_edit'),
          'observaciones' => $this->input->post('observaciones_edit')
          );

          $dependencias_tipo_no_existe = array(
          'id'=>(((int)$id_max )+ 1), 
          'tipo' => 3,
          'dependencia' =>(int) $this->input->post('id_dependencia_edit'),
          'sub_sector' => (int) $this->input->post('subsector'),
          'sector' => (int) $this->input->post('sector'),
          //'observaciones' => $this->input->post('observaciones')
          );

          $dependencias_tipo_si_existe = array(
          //'id'=>$id_max+1, 
          'tipo' => 3,
          'dependencia' =>(int) $this->input->post('id_dependencia_edit'),
          'sub_sector' => (int) $this->input->post('subsector'),
          'sector' => (int) $this->input->post('sector'),
         // 'observaciones' => $this->input->post('observaciones')
          );

/*retorno del id al cual pertenece dentro de dependencia_tipo*/
$id_depen_tipo_pertenece =$this-> model_dependencias -> consultar_id_depen_tipo(3,$id_dependencia_seleccionada);

        // recreacion
    foreach ($is_recreacion as $key) {
            //si esta en la tabla dependencias tipos
            if ( (int)$key->cuantos > 0 ) {
              
               $rec_tipo=$_POST['tipo_recreacion_edit'];
               $rec_superficie=$_POST['superficie_edit'];
               $rec_ancho=$_POST['ancho_edit'];
               $rec_largo=$_POST['largo_edit'];

                $data_r =array(
             //  'r_largo' => $rec_largo,
             //  'r_ancho' => $rec_ancho ,
               'r_superficie' => $rec_superficie,
               'r_tipo' => $rec_tipo ,
               'sub_sector' =>  $this->input->post('subsector'),
               'dependencia' => $id_dependencia_seleccionada,
               'sector' => $this->input->post('sector')
                );

                  # actualizo los datos de infraestructura y tipo_dependencia
                  $this->model_dependencias->actualizar_tipo_dependencia($id_dependencia_seleccionada,3,$dependencias_tipo_si_existe);

                  $this->model_dependencias->actualizar_recreacion($id_dependencia_seleccionada,$id_depen_tipo_pertenece[0]->id,$data_r);

                 $this->model_dependencias-> actualizar_depen($id_dependencia_seleccionada,$dependencia);
                     
                //  echo'| actualizo recreacion |';
               /*   $this->session->set_flashdata('category_success', 'Actualizado correctamente.');
  redirect (base_url().'dependencias/inicio');*/

            }else{

                  $rec_ancho=$_POST['ancho_edit'];
                  $rec_largo=$_POST['largo_edit'];
                  $rec_tipo_n=$_POST['tipo_recreacion'];
                  $rec_superficie_n=$_POST['superficie'];

                  $data_r_nuevo=array(
                 // 'r_largo' => $rec_largo,
                 //  'r_ancho' => $rec_ancho ,
                   'r_superficie' => $rec_superficie_n,
                   'r_tipo' => $rec_tipo_n ,
                   'r_habilitado' =>0,
                   'dependencias_tipo_id' => (((int)$maxi_depen)+1),
                   'sub_sector' =>  $this->input->post('subsector'),
                   'dependencia' => $id_dependencia_seleccionada,
                   'sector' => $this->input->post('sector')
                    );

              
              # agrego a las dependencias
            $this-> model_dependencias ->insert_dependencia_tipo($dependencias_tipo_no_existe);
            $this -> model_dependencias ->insert_recreacion($data_r_nuevo);

            //echo '| agrego a dependencias y recreacion |';    
         /*   $this->session->set_flashdata('category_success', 'Agregado correctamente.');
  redirect (base_url().'dependencias/inicio');*/
            }

          }
          }else{

               /*retorno del id al cual pertenece dentro de dependencia_tipo*/
            $id_depen_tipo_pertenece =$this-> model_dependencias -> consultar_id_depen_tipo(3,$id_dependencia_seleccionada);
              if (empty($id_depen_tipo_pertenece)==false){
				$this-> model_dependencias ->eliminar_recreacion($id_dependencia_seleccionada,$id_depen_tipo_pertenece[0]->id);
                    $this-> model_dependencias ->eliminar_dependencias_tipo($id_dependencia_seleccionada,3);
                   

                  //echo '| elimina la recreacion y dependencia |';
                   /*$this->session->set_flashdata('category_success', 'Eliminado correctamente.');
  redirect (base_url().'dependencias/inicio');*/
                   }
			}
			
  $this->session->set_flashdata('category_success', 'Acción realizada con éxito.');
  redirect (base_url().'dependencias/inicio');
    
}


}
	?>