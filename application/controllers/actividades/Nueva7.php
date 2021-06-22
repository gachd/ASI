<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class nueva extends CI_Controller {

	 function __construct() {
		 
        parent::__construct();
		$this->load->library('session');
		$this->load->model('model_actividades');
		$this->load->model('model_trabajos');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('calendar');
		$this->load->library('session');
		$this->load->library('mpdf7/src/Mpdf');

	 }
	
	
	public function index()
	{   
     	$date  =  "";
		/*$data['msgs'] = ''; */
		$data['error_message'] = $this->session->flashdata('flash_message');
		$data['query'] = $this -> model_actividades ->getAll($date);		
		// COMBO CATEGORIA
		//$data['categorias'] = $this -> model_actividades->getCategorias();	
		$data['subcategorias'] = $this -> model_actividades->getSubcate();
		$data['trabajos']	=$this -> model_actividades -> getAllWORK($date);	
		//$data['depend'] = $this -> model_actividades->getDepen();	
		$this->load->view('plantilla/Head_v1');
		$this->load->view('actividades/index',$data);
		$this->load->view('plantilla/Footer');	


	}

	public function registra_asistencia(){
           $id = $this->input->post('id');
           $data['act_cal'] =$this -> model_actividades->Act_cal($id);
           $data['asist_per'] = $this -> model_actividades->buscar_asist($id);
		   $this->load->view('actividades/reg_asistencia',$data);

		  
	}

	 public function ver_calendarizacion($id){
 	 $calendarizacion = $this -> model_actividades -> calendarizacion($id);	
 	 echo'<h1>Itinerario</h1> <input type="hidden" value="'.$id.'" id="id_activity">';
                if (!empty($calendarizacion)){
                    echo'<table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">Fecha</th>
                        <th scope="col">Inicio</th>
                        <th scope="col">Termino</th>
                        <th scope="col">Detalle</th>
                        <th scope="col"> Opciones</th>
                      </tr>
                    </thead>
                    <tbody>';
                    foreach ($calendarizacion as $c) {
                    $id_cal = $c -> id;	
            	    $fecha = $c -> fecha;
            	    $inicio = $c -> hr_inicio;
            	    $termino = $c -> hr_termino;
            	    $descripcion = $c -> descripcion;
            	    setlocale(LC_ALL, 'es_ES').': ';
            	    echo'<tr>
                    <td>'.iconv('ISO-8859-1', 'UTF-8', strftime('%A %d/%b/%y',  strtotime("".$fecha.""))).'</td>
                    <td>'.date("H:i",strtotime($inicio)).'</td>
                    <td>'.date("H:i",strtotime($termino)).'</td>
                    <td>'.$descripcion.'</td>
                    <td><div class="btn-group btn-group-xs" role="group" aria-label="Small button group">
                          <button type="button" class="btn btn-default btn-xs" data-toggle="modal" href="#modal_editar_calendar" onclick="selcalendario(\''.$id_cal.'\',\''.$fecha.'\',\''.$inicio.'\',\''.$termino.'\',\''.$descripcion.'\',\''.$id.'\');"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
                          <button type="button" id="'.$id_cal.'" class="btn btn-default btn-xs delet_calendar"><span class="glyphicon  glyphicon-trash" aria-hidden="true"></span></button>
                        </div></td>
                    </tr>';
                    }
                    echo'</tbody>
                    </table>';
                }else{
                	echo "<p>No registra.</p>";
                }

 }
	
	function selectcalendar(){
		$url =$this->uri->segment('4');
		$date  = $url;
		$data['fecha']=$date;
		$data['error_message'] = $this->session->flashdata('flash_message');
		$data['query'] = $this -> model_actividades ->getAll($date);
		$data['personal_stadio'] = $this -> model_actividades ->turno_personal_stadio($date);

		$data['guardias'] = $this -> model_actividades ->turno_guardias($date);
		/*TURNO DE LOS GUARDIAS*/
		$data['turnos_del_dia_guardias'] = $this -> model_actividades -> turnosdeldiaguardias($date);
		$data['turnos'] = $this -> model_actividades ->turnos();

		/*turnos existentes solo en el dia*/
		$data['turnos_del_dia'] = $this -> model_actividades -> turnosdeldia($date);

		// COMBO CATEGORIA
		$data['categorias'] = $this -> model_actividades->getCategorias();	
		$data['subcategorias'] = $this -> model_actividades->getSubcate();
		$data['trabajos']	=$this -> model_actividades -> getAllWORK($date);	
		//$data['depend'] = $this -> model_actividades->getDepen();	
		$this->load->view('plantilla/Head_v1');
		$this->load->view('actividades/index',$data);
		$this->load->view('plantilla/Footer');
	}

	
	
	function activFecha(){
		$dias = array("Domingo","Lunes ","Martes ","Miercoles ","Jueves","Viernes","Sabados");
        $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio','Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        $diasB = array("Domingo","Lunes ","Martes ","Miercoles ","Jueves","Viernes","Sabado");
        $date  = $this->input->post('txt_fecha');
		$queryActv= $this -> model_actividades ->getAll($date);
		 echo' <div class="col-lg-12" id="activ_fechas">';
				 $semana_select= $diasB[date("w",strtotime($date))];
				$mes_select= $meses[(date("m",strtotime($date)) - 1)];
				$dia_select = date("d",strtotime($date));
				
				$num_sem_select=date("W",strtotime($date));
						$sumado =0;
				   		foreach($queryActv as $a){
						 $sumado += $a -> act_nprsns ;
							}
				  echo' <h2> '.$semana_select.' '.$dia_select.' '.$mes_select.' - '.$sumado.' prsns</h2>';
                        echo'<div class="table-responsive" >
								 
				<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                       
										
                                        <th>Inicio</th>
                                        <th>Termino</th>
                                        <th>Categoria</th>
                                        <th>Subcategoria</th>
										 <th>Actividad</th>
                                        <th>Dependencia</th>
                                       
                                        <th>Responsable</th>
                                         <th>N° Prsns	</th>
										  <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                ';
					$n=0;			 
		 	foreach($queryActv as $i){
				
				
				$semana= $dias[date("w",strtotime($i -> act_fecha))];
				$dia = date("d",strtotime($i ->act_fecha));
				
				$num_sem=date("W",strtotime($i -> act_fecha));
				
				$num_sem_hoy= date("W");
				

            

				 $categoria = $i -> act_ctg_id;
				 $class='class="blanco"';
				 
				 switch($categoria) {
					 case 1:
					   $class='class="warning"';
						break;
					 case 3:
					   $class='class="verde"';
						break;
					 }
				 
				
				
				$n++;
				echo '  <tr '.$class.'>
                                        
										 
                                       <td>'.date("H:i",strtotime($i -> act_inicio)).'</td>
                                        <td>'.date("H:i",strtotime($i -> act_termino)).'</td>
                                        <td>'.$i -> ctg_nombre.'</td>
                                        <td>'.$i -> sctg_nombre.'</td>
										<td>'.$i -> act_evento.'</td>
                                        <td>';
										
							$dep= $this -> model_actividades -> getDepen($i -> act_id);	
							
							  foreach($dep as $d ){
								    echo ''.$d -> dep_nombre.' <br>';
								  
								  }	
								
								echo'</td>
									
                                    <td>'.$i -> act_responsable.'</td>
								    <td>'.$i -> act_nprsns.'</td>
									<td>';
										
										$id_usuario=$this->session->userdata('id');
										if(($num_sem >= $num_sem_hoy)&& ($id_usuario == $i -> usuario )){
	echo' <button type="button" class="editar" data-toggle="modal" href="#myModal"  id="'.$i -> act_id.'" onClick="selPersona(\''.$i -> act_evento.'\',\''.$i -> act_req.'\',\''.$i -> act_fecha.'\',\''.$i -> act_inicio.'\',\''.$i -> act_termino.'\',\''.$i -> act_responsable.'\',\''.$i -> act_nprsns.'\',\''.$i -> act_ctg_id.'\',\''.$i -> act_sctg_id.'\',\''.$i -> act_nombre.'\',\''.$i -> act_id.'\');"></button> &nbsp;
                                             <button type="button" class="eliminar" onclick="if( confirm(\'¿Seguro?\')){location.href=\''.base_url().'actividades/nueva/eliminar/'.$i -> act_id.'\';}"></button>
                                              </td>';
                                        }
										
                                   echo'</td> </tr>';
			}	
						
			$trabajos = $this -> model_actividades -> getAllWORK($date);
			
			foreach($trabajos as $t){

				$semanat= $dias[date("w",strtotime($t -> tb_fecha))];
				$diat = date("d",strtotime($t ->tb_fecha));
				
				$num_semt=date("W",strtotime($t -> tb_fecha));
				
				$num_sem_hoyt= date("W");
				
					$class='class="azul"';
				if((date("N",strtotime($t ->tb_fecha))== 6 ) or (date("N",strtotime($t ->tb_fecha))== 7 )){
					 
					 $class='class="danger"';
					}
				
				$n++;
				echo '  <tr '.$class.'>
                                        
                                        <td>'.date("H:i",strtotime($t -> tb_inicio)).'</td>
                                        <td>'.date("H:i",strtotime($t -> tb_termino)).'</td>
                                        <td>'.$t -> ctg_nombre.'</td>
                                        <td>'.$t -> sctg_nombre.'</td>
										<td>'.$t -> tb_descripcion.'</td>

                                        <td>';
										/*responsable*/
										
										if($t -> tb_tipo_responsable  == 1) {
											
											$id_work= $t -> tb_id;
										$fun_work = $this -> model_actividades -> getFuncionarioWORK("".$id_work."");	
										//var_dump( $fun_work);
										foreach($fun_work  as $fw){
											 echo''.$fw -> nombre_fun.' '.$fw -> paterno.'</br>' ;
										}

									  }
									  else {
										  
										  echo $t -> tb_responsable;
										  }
										
										echo'</td>
                                        <td>';
										
										/*dependencia*/
										
										$id_work= $t -> tb_id;
										$fun_work = $this -> model_actividades -> getDepWORK("".$id_work."");	
										//var_dump( $fun_work);
										foreach($fun_work  as $fw){
											 echo''.$fw -> dep_nombre .'</br>' ;
										}									
										
										 echo'</td>
										<td></td>
									 <td>&nbsp;</td>';
 
 


 	 }
			
			
		echo' </tbody>
                            </table>
							</div>
							  </div>';
			
		}
		
	public function newactividad(){
		$this->form_validation->set_error_delimiters('<div class="error alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		$this -> form_validation -> set_rules('txt_fecha','','required');
		$this -> form_validation -> set_rules('txt_inicio','','required');
		$this -> form_validation -> set_rules('txt_termino','','required');
		$this -> form_validation -> set_rules('txt_cantidad','','integer');
		$this -> form_validation -> set_rules('txt_responsable','','required');
		$this -> form_validation -> set_rules('categoria','','required');		
		/*if($this -> form_validation -> run() === false){
			//ERROR
				  $this->load->view('plantilla/head');
				  $this->load->view('plantilla/footer');
				  	  //ACTIVIDADES-FECHA
				$date  = $this->input->post('txt_fecha');
				$data['query'] = $this -> model_actividades ->getAll($date);
					  // COMBO CATEGORIA
  	   			  
				  $data['categorias'] = $this->model_actividades->getCategorias();	
				 $this->load->view('actividades/index',$data);

		}else{*/
			//OK
			date_default_timezone_set("Chile/Continental");
			$hoy=date("Y-m-d H:i:s");
			$fecha_inicio = $this->input->post('txt_fecha');
			$fecha_termino=$this->input->post('txt_fecha_termino');
			$dia_semana = $this->input->post('dia_semana');
			$reiterativo = $this->input->post('reiterativo');
			$periodo = $this->input->post('periodo');
			$segmentacion = $this->input->post('seg');
			$fecha_calendario = $this->input->post('fecha_cal');
			$sel_organiza = $this -> input -> post('sel_organiza');
			$empresa = $this->input->post('txt_empresa');
			$nombre_act = $this->input->post('txt_nomact');
			$e_mail = $this->input->post('txt_mail');


			if (empty ($fecha_termino)){$fecha_termino=$this->input->post('txt_fecha');}
			// 1 = TERCEROS ; 0 = INTERNO
			if ($sel_organiza =="Tercero"){$externo=1;}else{$externo=0;}




			if (empty ($periodo)){

                if($reiterativo == 1){
                	$fechaInicio=strtotime($this->input->post('txt_fecha'));
                    $fechaFin=strtotime($this->input->post('txt_fecha_termino'));
                    
                   
                    //Recorro las fechas y con la función strotime obtengo los lunes
                    //for($i=$fechaInicio; $i<=$fechaFin; $i+=86400){

                   
                    $dia = date('N', (int)$fechaInicio);
                    $diaFin = date('N', (int)$fechaFin);
                   while ($dia != $dia_semana) {
                   	  $fechaInicio = $fechaInicio + 86400;
                   	  $dia = date('N', (int)$fechaInicio);
                   	  if($dia == $dia_semana){break;}
                   } 

                   while ($diaFin != $dia_semana) {
                   	  $fechaFin = $fechaFin - 86400;
                   	  $diaFin = date('N', (int)$fechaFin);
                   	  if($diaFin == $dia_semana){break;}
                   } 
                     $final = (($fechaFin - $fechaInicio)/86400)/7;
                     $diaFecha = date ("Y-m-d", $fechaInicio);
                   var_dump($fechaInicio);
                   var_dump($fechaFin);
                    for($i=0; $i<=(int)$final; $i++){
                    //Sacar el dia de la semana con el modificador N de la funcion date
                       
                     //  $dia = date('N', (int)$numDia);
                            
                            //echo "".$dia_semana."". date ("Y-m-d", $i)."<br>";
                    	    $data = array('act_evento' => $this->input->post('txt_actividad'),
                    	    	         'act_req' => $this->input->post('txt_req'),
                    	    	        'act_nombre' => $this->input->post('txt_nomact'),
					                    'act_fecha' => $diaFecha,
					                    'act_fecha_termino' => $diaFecha,
					                    'act_inicio' => $this->input->post('txt_inicio'),
					                    'act_termino' => $this->input->post('txt_termino_rept'),
					                    'act_nprsns' => $this->input->post('txt_cantidad'),//nº externos
					                    'act_nsocios' => $this->input->post('txt_socios'), // nº socios
					                    'act_responsable' => $this->input->post('txt_responsable'),
					                    'act_fono' => $this->input->post('txt_fono'),
					                    'act_ctg_id' => $this->input->post('categoria'),
					                    'act_sctg_id' =>$this->input->post('subcategoria'),
					                    'act_externo' =>$externo,
					                    'act_organizacion' =>$sel_organiza,
					                    'act_empresa' =>$empresa,
					                    'act_correo' =>$e_mail,
					                    'act_actualizacion' =>$hoy,
					                    'usuario' => $this->session->userdata('id'));
	
                    	    $this -> model_actividades -> insertar($data); //INSERT ACTIVIDADES
                    	    $resmax = $this->model_actividades->MaxActiv();
                    	    foreach($resmax as $m){$id= $m -> act_id;} // MAX ID ACTIVDADES
                    	    $depen= $this->input->post('dep');
                    	    if( !empty($depen)) {
                    	    	foreach($depen as $d){
                    	    		$dep = array('act_id_ad' => $id,
					                             'dep_id_ad' => $d);
					                $this -> model_actividades -> InserDep($dep); // INSERT DEPENDENCIAS
					            }
					        }
					        $planificacion = array('tipo' => "0",
					                                'fecha' => date ("Y-m-d", $diaFecha),
					                                'actividades' => $id);
					        $this -> model_actividades -> planificacion($planificacion);//INSERT PLANIFICACION
					        if( !empty($segmentacion)) {
					        	foreach($segmentacion as $seg){
					        		$data_seg = array('actividades_id' => $id,
					                                  'segmentacion_id' => $seg,
					                                  'subcategoria_id' => $this->input->post('subcategoria'),
					                                  'categoria_id' => $this->input->post('categoria'));
					                $this -> model_actividades -> Insert_actv_seg($data_seg); // INSERT CON SEGMENTACIÓN
						        }
						    }else{
						    	    $data_seg = array('actividades_id' => $id,
					                              'segmentacion_id' => 0,
					                              'subcategoria_id' => $this->input->post('subcategoria'),
					                              'categoria_id' => $this->input->post('categoria'));
					                $this -> model_actividades -> Insert_actv_seg($data_seg); // INSERT SIN SEGMENTACIÓN
					            }
					        
							$data_calendario = array('fecha' => $diaFecha,
					                                'hr_inicio' => $this->input->post('txt_inicio'),
					                                'hr_termino' => $this->input->post('txt_termino_rept'),
					                                'act_id' => $id);
							$this -> model_actividades -> Insert_actividades_calendario($data_calendario); // INSERTO actividades_calendario
						    	
					   // } // fin actividades repetitivas
					    $diaFecha =  date("Y-m-d",strtotime($diaFecha."+ 1 week")); 
					    $numDia = $numDia +  604800;
                    } //fin for recorre dias de semana


                }else{
                	    $data = array('act_evento' => $this->input->post('txt_actividad'),
                	    	 'act_req' => $this->input->post('txt_req'),
                	    	'act_nombre' => $this->input->post('txt_nomact'),
					              'act_fecha' => $this->input->post('txt_fecha'),
					              'act_fecha_termino' => $fecha_termino,
					              'act_inicio' => $this->input->post('txt_inicio'),
					              'act_termino' => $this->input->post('txt_termino'),
					              'act_nprsns' => $this->input->post('txt_cantidad'),//nº externos
					              'act_nsocios' => $this->input->post('txt_socios'), // nº socios
					              'act_responsable' => $this->input->post('txt_responsable'),
					              'act_fono' => $this->input->post('txt_fono'),
					              'act_ctg_id' => $this->input->post('categoria'),
					              'act_sctg_id' =>$this->input->post('subcategoria'),
					              'act_externo' =>$externo,
					              'act_organizacion' =>$sel_organiza,
					              'act_correo' =>$e_mail,
					              'act_empresa' =>$empresa,
					              'act_actualizacion' =>$hoy,
					              'usuario' => $this->session->userdata('id'));
                	    $this -> model_actividades -> insertar($data); //INSERTO ACTIVIDAD
				        $resmax = $this->model_actividades->MaxActiv();
				        foreach($resmax as $m){$id= $m -> act_id;}
				        $depen= $this->input->post('dep');
				        if( !empty($depen)) {
				    	    foreach($depen as $d){
				    		    $dep = array('act_id_ad' => $id,
					                        'dep_id_ad' => $d);
				    		    $this -> model_actividades -> InserDep($dep);
				    	    }			
					    }
					    $planificacion = array('tipo' => "0",
					                           'fecha' =>  $this->input->post('txt_fecha'),
					                           'actividades' => $id);
					    $this -> model_actividades -> planificacion($planificacion);
					    if( !empty($segmentacion)) {
					        	foreach($segmentacion as $seg){
					        		$data_seg = array('actividades_id' => $id,
					                                  'segmentacion_id' => $seg,
					                                  'subcategoria_id' => $this->input->post('subcategoria'),
					                                  'categoria_id' => $this->input->post('categoria'));
					                $this -> model_actividades -> Insert_actv_seg($data_seg); // INSERT CON SEGMENTACIÓN
						        }
						    }else{
						    	    $data_seg = array('actividades_id' => $id,
					                              'segmentacion_id' => 0,
					                              'subcategoria_id' => $this->input->post('subcategoria'),
					                              'categoria_id' => $this->input->post('categoria'));
					                $this -> model_actividades -> Insert_actv_seg($data_seg); // INSERT SIN SEGMENTACIÓN
					            }
					        
							 $data_calendario = array('fecha' => $this->input->post('txt_fecha'),
					                                    'hr_inicio' => $this->input->post('txt_inicio'),
					                                   'hr_termino' => $this->input->post('txt_termino'),
					                                    'act_id' => $id);
							$this -> model_actividades -> Insert_actividades_calendario($data_calendario); // INSERTO actividades_calendario
						    	
				}

				$this->session->set_flashdata('category_success', 'un día.');
		redirect (base_url().'actividades/nueva/selectcalendar/'.date('Y-m-d',strtotime($fecha_inicio)).''); 

			}else{ //  PERIODO VARIOS DIAS

				$data = array(
                    'act_evento' => $this->input->post('txt_actividad'),
                     'act_req' => $this->input->post('txt_req'),
                    'act_nombre' => $this->input->post('txt_nomact'),
					'act_fecha' => $this->input->post('txt_fecha'),
					'act_fecha_termino' => $fecha_termino,
					'act_inicio' => $this->input->post('txt_inicio'),
					'act_termino' => $this->input->post('txt_termino'),
					'act_nprsns' => $this->input->post('txt_cantidad'),//nº externos
					'act_nsocios' => $this->input->post('txt_socios'), // nº socios
					'act_responsable' => $this->input->post('txt_responsable'),
					'act_fono' => $this->input->post('txt_fono'),
					'act_ctg_id' => $this->input->post('categoria'),
					'act_sctg_id' =>$this->input->post('subcategoria'),
					'act_externo' =>$externo,
					'act_organizacion' =>$sel_organiza,
					'act_empresa' =>$empresa,
					'act_actualizacion' =>$hoy,
					'act_correo' =>$e_mail,
					'usuario' => $this->session->userdata('id')			
				);

				$this -> model_actividades -> insertar($data);/*INSERT ACTIVIDAD*/
				$resmax = $this->model_actividades->MaxActiv();
				foreach($resmax as $m){$id= $m -> act_id;} //maximo ID ACTIVIDAD
				$depen= $this->input->post('dep');
				if( !empty($depen)) {
						foreach($depen as $d){
							$dep = array('act_id_ad' => $id,
					                      'dep_id_ad' => $d );
							$this -> model_actividades -> InserDep($dep); // INSERTO DEPENDENCIAS
						}			
				}
				$planificacion = array('tipo' => "0",
					                   'fecha' => date ("Y-m-d", $i),
					                   'actividades' => $id );								
				$this -> model_actividades -> planificacion($planificacion);// inserto planificacion 


				if( !empty($segmentacion)) {
						foreach($segmentacion as $seg){
							$data_seg = array('actividades_id' => $id,
					                      'segmentacion_id' => $seg,
					                      'subcategoria_id' => $this->input->post('subcategoria'),
					                      'categoria_id' => $this->input->post('categoria'));
							$this -> model_actividades -> Insert_actv_seg($data_seg); // INSERT CON SEGMENTACIÓN
						}			
				}else{
					$data_seg = array('actividades_id' => $id,
					                      'segmentacion_id' => 0,
					                      'subcategoria_id' => $this->input->post('subcategoria'),
					                      'categoria_id' => $this->input->post('categoria'));
							$this -> model_actividades -> Insert_actv_seg($data_seg); // INSERT SIN SEGMENTACIÓN
					}


				if( !empty($fecha_calendario)) {

					$msj ="varias fechas";
						foreach($fecha_calendario as $fc){
							$data_calendario = array('fecha' => $fc,
					                      'hr_inicio' => $this->input->post('h_inicio'.$fc.''),
					                      'hr_termino' => $this->input->post('h_termino'.$fc.''),
					                      'act_id' => $id);
							$this -> model_actividades -> Insert_actividades_calendario($data_calendario); // INSERTO actividades_calendario
						}			
				}

				$this->session->set_flashdata('category_success', 'varios dias');
				redirect (base_url().'actividades/nueva/selectcalendar/'.date('Y-m-d',strtotime($fecha_inicio)).''); 
			}
		/*}*/
	}

		
		public function fillsubcategorias (){
			
			$ctg  = $this->input->post('micategoria');
			
			if($ctg <> 0 ){
				/*echo' <option value="0"> '.$ctg.'lllego</option>';*/
				echo' <option value="0"> Seleccionar</option>';
				$subcatg= $this -> model_actividades -> getsubcategoria($ctg);
				foreach($subcatg as $fila){
				echo ' <option value="'.$fila->sctg_id.'" '.set_select("subcategoria",$fila->sctg_id).'>'.$fila->sctg_nombre.'</option>';
					}
			}else{
					echo' <option value="0"> Seleccionar</option>';
				 }
		}
		
    public function fillsegmentacion(){
							
			/*echo' <option value="0"> '.$ctgdep.'lllego</option>';*/
			$subcategoria  = $this->input->post('subcategoria');
			$segmentacion= $this -> model_actividades -> getSegmentacion($subcategoria);
			
			if(!empty($segmentacion)){
				$x=0;
				echo'   
				<label>Segmentacion </label>
				<table width="100%" border="0">
						  <tbody>
							<tr>';
				foreach($segmentacion as $rows){
					$x++;
			//	echo ' <option value="'.$rows->dep_id_dc.'">'.$rows->dep_nombre.'</option>';
			echo'<td><label>
			<input type="checkbox" name="seg[]" value="'.$rows->id.'" style="margin-right:5px;">'.$rows->nombre.'</label></td>';
			
	                		if(1==$x)
                    {
                        echo" </tr>";
	                	$x=0;
                    }
	                		}
	                		echo'  
                     </tbody>
                     </table> ';
			}else{
				echo' <label> Sin segmentación</label>';
				}				
}

		
public function filldependencias(){
							
			/*echo' <option value="0"> '.$ctgdep.'lllego</option>';*/
			$ctgdep  = $this->input->post('categoriaDep');
			
			// $faena= $this -> model_actividades -> getFaenaCategoria($ctgdep);
				//foreach($faena as $f){
					//$fa= $f -> faena;		
			//}	 
		 

			$dependencia= $this -> model_actividades -> getDependencias($ctgdep);
			
			/*var_dump($dependencia);*/
			
			if($ctgdep <> 0 ){
				$x=0;
				echo'
				<fieldset class="fieldset-dep">
              <legend class="legend-dep">Dependencia:</legend>   
				
				<table width="100%" border="0">
						  <tbody>
							<tr>';
				foreach($dependencia as $rows){
					$x++;
			//	echo ' <option value="'.$rows->dep_id_dc.'">'.$rows->dep_nombre.'</option>';
			echo'<td><label>
			<input type="checkbox" name="dep[]" value="'.$rows->dep_id_dc.'" style="margin-right:5px;">'.$rows->dep_nombre.'</label></td>';
			
			if(2==$x)
    {
        echo" </tr>";
		$x=0;
    }
			}
			echo'  
  </tbody>
</table>
 </fieldset>
';
			}else{
				/*NO TIENE DEPENDENCIAS*/echo' ';
				}
				
		}
		
		
		public function actualizar(){ 
		date_default_timezone_set("Chile/Continental");
		$hoy=date("Y-m-d H:i:s");
		$usuario= $_SESSION['id'];

		// 1 = TERCEROS ; 0 = INTERNO
			if ($edit_organiza =="Tercero"){$externo=1;}else{$externo=0;}
		$array = array(
					'act_evento' => $this->input->post('edit_observaciones'),
					'act_req' => $this->input->post('edit_req'),
					'act_fecha' => $this->input->post('edit_fecha'),
					'act_inicio' => $this->input->post('edit_inicio'),
					'act_termino' => $this->input->post('edit_termino'),
					'act_nprsns' => $this->input->post('edit_cantidad'),
					'act_nsocios' => $this->input->post('edit_socios'),
					'act_responsable' => $this->input->post('edit_responsable'),
					'act_ctg_id' => $this->input->post('edit_categoria'),
					'act_externo' =>$this->input->post($externo),
					'act_sctg_id' =>$this->input->post('edit_subcategoria'),
					'act_empresa' =>$this->input->post('edit_empresa'),
					'act_organizacion' =>$this->input->post('edit_organiza'),
					'act_nombre' =>$this->input->post('nomact_edit'),
					'act_correo' =>$this->input->post('edit_correo'),
					'act_fono' =>$this->input->post('edit_fono'),
					'act_actualizacion' =>$hoy,
					'usuario' => $usuario
                );
				
					$id = array('act_id' => $this -> input -> post('edit_id'));
					$act = $this -> input -> post('edit_id');
						
						$this -> model_actividades ->eliminar_plan($act);
						$this -> model_actividades ->eliminar_dep($act);
						$this -> model_actividades -> actualizar($array,$id);
						
					//PLANIFICACION 
					
					$planificacion = array(
					'tipo' => "0",
					'fecha' =>  $this->input->post('edit_fecha'),
					'actividades' => $act
					);			
							
					$this -> model_actividades -> planificacion($planificacion);
				     
				
				
				/*INSERT DEPENDENCIA*/
					
					$depen= $this->input->post('edit_dep');
					$depen_categ= $this->input->post('dep');
					echo 'cargaaaada <br>';
					
							  /* var_dump($fun);*/
                   if(empty($depen)) {
										
							$depen = $depen_categ;			
						}
							
						var_dump($depen);		
										
						foreach($depen as $d){
						/*echo ''.$valor.'<br>';*/
						
						$dep = array(
					'act_id_ad' => $act,
					'dep_id_ad' => $d);
					$this -> model_actividades -> InserDep($dep);
					//var_dump($dep);
						}			
										
				$this->session->set_flashdata('category_success', 'Actualizado Correctamente.');	
				redirect (base_url().'actividades/nueva/selectcalendar/'.date('Y-m-d',strtotime($this->input->post('edit_fecha'))).'');

		}
		
		
		public function depact(){
			
			$id = $this -> input -> post('idact');
			//echo $id;
			 $categ = $this -> model_actividades -> getcategoriaAct($id);
			// var_dump($categ);
		 echo'<div  class="col-md-12 ">
                
              <label> Dependencia: </label>


		 <table width="100%" border="0">
  <tbody>
   
		 <tr>';
		 
		
		
		 foreach($categ as $ctg){
			 $categoria = $ctg -> act_ctg_id;
			 	
			 }
		 
		$dependencia =  $this -> model_actividades->getDependencias($categoria);

	
		$depend = 	 $this -> model_actividades->getDepen($id);	
		
		
		$x=1;
		foreach($dependencia as $rows){
			
			$chekdep='';
			
				foreach($depend as $dp){
		
		$depwork=$dp -> dep_id;
		if($depwork ==$rows->dep_id_dc ) {$chekdep='checked="checked"';};
		
		}
			
				/*echo ' <option value="'.$rows->dep_id_dc.'">'.$rows->dep_nombre.'</option>';*/
				
				echo'
				 
				<td><label class="css-label"><input type="checkbox" name="edit_dep[]"  value="'.$rows->dep_id_dc.'"  class="css-checkbox" style="margin-right:3px;" '.$chekdep.'>'.$rows->dep_nombre.' </label></td>';
			if(1==$x)
    {
        echo"</tr> ";
		$x=0;
    }
    
    $x++;
	
	}
	
	echo'</tbody>
</table>		
       </div>
      </div>
';
		 
			}
		
		
		//función para eliminar un mensaje dependiendo del id
	public function eliminar()
	{
		$id = $this->uri->segment(4);
		$this->model_actividades->eliminar_dep($id);
		$this->model_actividades->eliminar_plan($id);
		$this->model_actividades->eliminar_act($id);
		
		redirect(base_url().'/Calendario');
	}

	function activFechaRango(){
		$inicio  = $this->input->post('inicio');
		$termino  = $this->input->post('termino');
		$dias = array("DOMINGO","LUNES","MARTES","MIERCOLES","JUEVES","VIERNES","SABADO");
        $meses = array('ENE','FEB','MAR','ABR','MAY','JUN','JUL','AGO','SEP','OCT','NOV','DIC');
        $diasB = array("Domingo","Lunes ","Martes ","Miercoles ","Jueves","Viernes","Sabado");
        $mesesb = array('ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JUULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE');
        $queryActv= $this -> model_actividades ->getAllRango($inicio,$termino);
		$titulo = "DESDE: ".date('d',strtotime($inicio))." de ".$mesesb[date('n',strtotime($inicio))-1]. " del ".date('Y',strtotime($inicio)) ;
			$titulo2="";
			 if($inicio <> $termino){
				 $titulo.=' <BR> ';
			
			$titulo2= "HASTA:".date('d',strtotime($termino))." de ".$mesesb[date('n',strtotime($termino))-1]. " del ".date('Y',strtotime($termino)) ;
				 };
				 $sumado =0;
				   		foreach($queryActv as $a){
						 $sumado += $a -> act_nprsns ;
							}
			
			
			echo'<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading"> ACTIVIDADES
					</div>
					<div class="panel-body">
							 <div class="table-responsive">  
							 <table class="table  table-condensed">
							  <thead>
                                    <tr>
										<th>Fecha</th>
                                        <th>Inicio</th>
                                        <th>Termino</th>
                                        <th>Categoria</th>
                                        <th>Subcategoria</th>
										 <th>Descripcion</th>
                                        <th>Dependencia</th>
                                       
                                        <th>Responsable</th>
                                         <th>N° Prsns	</th>
										 
                                    </tr>
                                </thead>
                                <tbody> ';
							 		$n=0;			 
		 	foreach($queryActv as $i){
				
				
				$semana= $dias[date("w",strtotime($i -> act_fecha))];
				$dia = date("d",strtotime($i ->act_fecha));
					$mes=$meses[date('n',strtotime($i ->act_fecha))-1];
				
				$num_sem=date("W",strtotime($i -> act_fecha));
				$num_sem_hoy= date("W");
				
				 $categoria = $i -> act_ctg_id;
				 $class='class="blanco"';
				 
				 switch($categoria) {
					 case 1:
					   $class='class="warning"';
						break;
					 case 3:
					   $class='class="verde"';
						break;
					 }
				 
				
				
				$n++;
				echo '  <tr '.$class.'>
                                        
										 
                                       <td width="11%">'.$semana.', '.$dia.' '.$mes.'</td> 
                                       <td>'.date("H:i",strtotime($i -> act_inicio)).'</td>
                                        <td>'.date("H:i",strtotime($i -> act_termino)).'</td>
                                        <td>'.$i -> ctg_nombre.'</td>
                                        <td>'.$i -> sctg_nombre.'</td>
										<td>'.$i -> act_evento.'</td>
                                        <td>';
										
							$dep= $this -> model_actividades -> getDepen($i -> act_id);	
							
							  foreach($dep as $d ){
								    echo ''.$d -> dep_nombre.' <br>';
								  
								  }	
								
								echo'</td>
									
                                    <td>'.$i -> act_responsable.'</td>
								    <td>'.$i -> act_nprsns.'</td>
									 <td>';
										
										$id_usuario=$this->session->userdata('id');
										 if(($num_sem >= $num_sem_hoy)&& ($id_usuario == $i -> usuario )){
										  echo' <button type="button" class="editar" data-toggle="modal" href="#myModalEditar"  id="'.$i -> act_id.'" onClick="selPersona(\''.$i -> act_evento.'\',\''.$i -> act_fecha.'\',\''.$i -> act_inicio.'\',\''.$i -> act_termino.'\',\''.$i -> act_responsable.'\',\''.$i -> act_nprsns.'\',\''.$i -> act_ctg_id.'\',\''.$i -> act_sctg_id.'\',\''.$i -> act_id.'\');"></button> &nbsp;
										<button type="button" class="eliminar" onclick="if( confirm(\'¿Seguro?\')){location.href=\''.base_url().'actividades/nueva/eliminar/'.$i -> act_id.'\';}"></button>
										 </td>';
 	 }
										
                                   echo'</td> </tr>';
									
			}	
							   echo'</tbody>
                            </table>
							 </div>
					</div>
				</div>
			</div>	

			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading"> TRABAJOS
					</div>
					<div class="panel-body">
							 <div class="table-responsive">  
							 <table class="table  table-condensed"> <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Inicio</th>
                                        <th>Termino</th>
                                        <th>Categoria</th>
                                        <th>Subcategoria</th>
										
										<th>Responsable</th>
                                        <th>Dependencia</th>
                                        
										
                                    </tr>
                                </thead>
                                <tbody> ';
							 $trabajos = $this -> model_trabajos -> getAllRango($inicio,$termino);
			
			foreach($trabajos as $t){

				$semanat= $dias[date("w",strtotime($t -> tb_fecha))];
				$diat = date("d",strtotime($t ->tb_fecha));
				$mest=$meses[date('n',strtotime($t ->tb_fecha))-1];
				
				$num_semt=date("W",strtotime($t -> tb_fecha));
				
				$num_sem_hoyt= date("W");
				
				
				
				$date_t=date_create($t -> tb_fecha);
		
				
					/*$class='class="azul"';
				if((date("N",strtotime($t ->tb_fecha))== 6 ) or (date("N",strtotime($t ->tb_fecha))== 7 )){
					 
					 $class='class="danger"';
					 
					}*/
				
				$n++;
				echo '  <tr>
                                        <td>'.date_format($date_t,"d/m/y").'</td>
                                        <td>'.date("H:i",strtotime($t -> tb_inicio)).'</td>
                                        <td>'.date("H:i",strtotime($t -> tb_termino)).'</td>
                                        <td>'.$t -> ctg_nombre.'</td>
                                        <td>'.$t -> sctg_nombre.'</td>
										

                                        <td>';
										/*responsable*/
										
										if($t -> tb_tipo_responsable  == 1) {
											
											$id_work= $t -> tb_id;
										$fun_work = $this -> model_actividades -> getFuncionarioWORK("".$id_work."");	
										//var_dump( $fun_work);
										foreach($fun_work  as $fw){
											 echo''.$fw -> nombre_fun.' '.$fw -> paterno.'</br>' ;
										}

									  }
									  else {
										  
										  echo $t -> tb_responsable;
										  }
										
										echo'</td>
                                        <td>';
										
										/*dependencia*/
										
										$id_work= $t -> tb_id;
										$fun_work = $this -> model_actividades -> getDepWORK("".$id_work."");	
										//var_dump( $fun_work);
										foreach($fun_work  as $fw){
											 echo''.$fw -> dep_nombre .'</br>' ;
										}									
										
										 echo'</td>
										
									 <td>&nbsp;</td>';
 			}
							 
							 echo' </tbody> </table>
							 </div>
					</div>
				</div>
			</div>	';
		
				
		}

		public function new_calendarizacion(){
			$cal_id=$this->input->post('cal_id');
			$data = array(
				'act_id'=>$this->input->post('cal_id'),
			     'fecha'=>$this->input->post('cal_date'),
			     'hr_inicio'=>$this->input->post('cal_inicio'),
			     'hr_termino'=>$this->input->post('cal_termino'),
			     'descripcion'=>$this->input->post('cal_desc'));
			$sql=$this -> model_actividades -> insertar_calendarizacion($data);
            if($sql){echo '<div class="alert alert-danger"> <strong>Lo Siento!</strong>  ha ocurrido un error al guardar.</div>';}
            else{echo '<div class="alert alert-success error"> <strong>Exito!</strong> se ha gurardado correctamente.</div>';}
            $this -> ver_calendarizacion($cal_id);

		}
		
			function toexcel(){
				echo'******';
			
			$fecha_inicio = $this->input->post('buscar_inicio');
			$fecha_termino= $this->input->post('buscar_termino');
			
			$data['inicio']=$fecha_inicio;
			$data['termino']=$fecha_termino;
			$data['actividades'] = $this -> model_actividades -> getAllRango($fecha_inicio,$fecha_termino);
			$data['trabajos'] = $this -> model_trabajos -> getAllRango($fecha_inicio,$fecha_termino);
			$this->load->view('reportes/activity_report',$data);	
			}
		
function topdf(){
			
	$fecha_inicio= $this->uri->segment(4);
	$fecha_inicio.='/';
	$fecha_inicio.= $this->uri->segment(5);
	$fecha_inicio.='/';
	$fecha_inicio.= $this->uri->segment(6);	
			
	$fecha_termino= $this->uri->segment(7);
	$fecha_termino.='/';
	$fecha_termino.= $this->uri->segment(8);
	$fecha_termino.='/';
	$fecha_termino.= $this->uri->segment(9);
						
	$data['inicio']=$fecha_inicio;
	$data['termino']=$fecha_termino;
	$data['actividades'] = $this -> model_actividades -> getAllRango($fecha_inicio,$fecha_termino);
	$data['trabajos'] = $this -> model_trabajos -> getAllRango($fecha_inicio,$fecha_termino);
			
	//$this->load->view('reportes/pdf_activity_report', $data);
	$html = $this->load->view('/reportes/pdf_activity_report', $data,true);
	/*$cabecera = "<span><b>Mi primer documento PDF dinámico con mPDF</b></span>";*/
	$pie = "<span><i>Creado ".date("d/m/Y")."</i></span>";
	
	
	$mpdf = new mPDF('', 'A4');
	$mpdf->AddPage('L');
	$mpdf->SetHTMLHeader($cabecera);
	$mpdf->shrink_tables_to_fit =1;
	$mpdf->WriteHTML($html);
	$mpdf->SetHTMLFooter($pie);
	$mpdf->Output();
			
}

 public function consulta_dependencias() {
 
			$activi_id  = $this->input->post('id_actividad_v');
			$dependencia= $this -> model_actividades -> getDepen($activi_id);
			
			if($activi_id <> 0 ){
				$x=0;
				echo'   
				<label> Dependencias: </label>
				<table width="100%" border="0">
						  <tbody>
							<tr>';
							
				foreach($dependencia as $rows){
					$x++;
		
			echo'<td><label>
			
			<input type="checkbox" name="dep[]" value="'.$rows->dep_id.'" checked style="margin-right:5px;">'.$rows->dep_nombre.'</label></td>';
			
			if(1==$x)
    {
        echo" </tr>";
		$x=0;
    }
			}
			echo'  
  </tbody>
</table>
';
			}else{
				echo' <option value="0"> vacio</option>';
				}
				

 }

 public function fechas_actividad(){
 	$fecha1  = $this->input->post('inicio');
	$fecha2  = $this->input->post('termino');
	$hr_inicio  = $this->input->post('hr_inicio');
	$hr_termino  = $this->input->post('hr_termino');
	if(!empty($fecha2)){
		echo' <div class="col-md-7">
              <button type="button" class="btn btn-info btn-xs" style="float: right;margin-bottom: 13px;">Actualizar Calendarización</button>
              <table  class="table table-bordered ">
              <thead> <tr>
                    <td>FECHA</td>
                    <td>HR. INICIO</td>
                  </tr></thead>
                <tbody>';
                for($i=$fecha1;$i<=$fecha2;$i = date("Y/m/d", strtotime($i ."+ 1 days"))){
                     echo'<tr>

                            <td><label>
	                        		<input type="checkbox" name="fecha_cal[]" value="'.$i.'" style="margin-right:5px;" checked>'.$i.'</label></td>
                            <td><input type="time" placeholder="00:00" class="form-control input-sm w_fecha" value="'.$hr_inicio.'" name="h_inicio'.$i.'"></td>
                            <td><input type="time" placeholder="00:00" class="form-control input-sm w_fecha" value="'.$hr_termino.'" name="h_termino'.$i.'"></td>
                        

                            </tr>';
                }
                echo'</tbody>
                     </table></div>';

    }
}

 public function actualiza_estado() {
 
			$id  = $this->input->post('id');
			$estado = $this ->input->post('estado');
			
            $act_estado= $this -> model_actividades -> act_estado($id,$estado); 
            if($act_estado == true){
                  echo $estado;


            }
 }	

		
public function detalle_actividad(){

		$id = $this->input->post('id');
		$fecha_sel = $this->input->post('fecha_sel');
		$est = 1;
        $esta = 0;
		setlocale(LC_ALL, 'es_ES').': ';
		$actividades = $this -> model_actividades -> actividad_id($id);
		$actividad_cal = $this -> model_actividades -> actividadCal_id($id,$fecha_sel);
		foreach($actividades as $i){
			            $nombre_activity = $i -> act_nombre ; 
			            $inicio = $i -> act_fecha ; 
			            $termino = $i -> act_fecha_termino ; 
			            $act_inicio = $i -> act_inicio;
			            $act_termino = $i -> act_termino;
                        $socios = $i -> act_nsocios;
                        $externos = $i -> act_nprsns;
                        $total_prsns= $socios + $externos;
                        $categoria = $i -> ctg_nombre;
                        $subcategoria = $i -> sctg_nombre;
                        $id = $i -> act_id;
                        $color = $i -> ctg_color;
                        $responsable = $i -> act_responsable;
                        $empresa = $i -> act_empresa;
                        $observaciones = $i -> 	act_evento;
                        $req = $i -> act_req;
                        $fono = $i -> act_fono;
                        $estado = $i -> act_estado;
                         $correo = $i -> act_correo;
                        $organiza = $i -> act_organizacion;

                        $operacion = strtotime($termino) - strtotime($inicio);
                        $dif_dias = (($operacion/(60*60*24))+1);

                        if($dif_dias > 1){$dias='días';}else{$dias='día';}


                        if(empty($fono)){$fono="No Registrado";}
                        if($i -> act_externo  == 1) {$txt_externo ="INTERNO";}else{$txt_externo="EXTERNo";}

		    echo'<div class="detalle_titulo" style="background: '.$color.';overflow: hidden;" >

		        <div id="cambiardiv" class="col-md-12">
                     <span class="categoria" style="color: white;">'.$categoria.'<br></span> '.$subcategoria.'<br><span 
                     class="nombre_actividad">'.$nombre_activity.'</span>';
                  echo '<div class="row"><div class="col-md-6">';
                      if($estado == 0){
               	 echo'<button type="button" id="btn_inactivo"class="btn btn-danger" onClick="estado(\''.$estado.'\');" style="display:none;">Inactivo</button>
                 <button type="button" id="btn_activo" class="btn btn-success" onClick="estado(\''.$est.'\');" style="display:block;">Activo</button>';
               }else{
               	 echo'<button type="button" id="btn_inactivo"class="btn btn-danger" onClick="estado(\''.$esta.'\');" style="display:block;">Inactivo</button>
                 <button type="button" id="btn_activo" class="btn btn-success" onClick="estado(\''.$estado.'\');" style="display:none;">Activo</button>';
               }
              echo '</div><div class="col-md-6">';
               echo '<button type="button" id="regAsist" onClick="asistencia(\''.$actividad_cal.'\');"><img src="'.base_url().'assets/images/register.png" ></button></div></div>';
               echo '</div>';

            $seg_act= $this -> model_actividades -> segmentacion_act($id);  
                if(!empty($seg_act)){
                	 echo'<div class="col-md-5">segmentacion:
                	 <ul>';
                	 foreach ($seg_act as $sa) {echo'<i class="text_segmentacion">'.$sa -> segmentacion .'</i> ';}
                    echo'</ul></div>';
                }
                       
            echo'
          </div>
          <div class="col-md-12" style="background: #EFEEEE;">
          <div class="col-md-2 fecha_seleccionada" style="padding-top: 8px;">';
          //echo $id.'*****'.$fecha_sel;

          $date_sel= $this -> model_actividades -> horario_act($id,$fecha_sel);
                        //echo $this-> db -> last_query().'<br>';
                   

                   	foreach ($date_sel as $ds) {

                   	if(!empty($ds -> fecha)){
                   		$a = ''.iconv('ISO-8859-1', 'UTF-8', strftime('%a',  strtotime($ds->fecha))).'';
                   		$d = ''.iconv('ISO-8859-1', 'UTF-8', strftime('%d',  strtotime($ds->fecha))).'';
                   		$b = ''.iconv('ISO-8859-1', 'UTF-8', strftime('%b',  strtotime($ds->fecha))).'';
                   		$y = ''.iconv('ISO-8859-1', 'UTF-8', strftime('%Y',  strtotime($ds->fecha))).'';

                   		$hora_inicio = ''.iconv('ISO-8859-1', 'UTF-8', strftime('%H:%M',  strtotime($ds->inicio))).'';
                   		$hora_termino = ''.iconv('ISO-8859-1', 'UTF-8', strftime('%H:%M',  strtotime($ds->termino))).'';
                   	}else{

                   		$a = ''.iconv('ISO-8859-1', 'UTF-8', strftime('%a',  strtotime($inicio))).'';
                   		$d = ''.iconv('ISO-8859-1', 'UTF-8', strftime('%d',  strtotime($inicio))).'';
                   		$b = ''.iconv('ISO-8859-1', 'UTF-8', strftime('%b',  strtotime($inicio))).'';
                   		$y = ''.iconv('ISO-8859-1', 'UTF-8', strftime('%Y',  strtotime($inicio))).'';

                   		$hora_inicio = ''.iconv('ISO-8859-1', 'UTF-8', strftime('%H:%M',  strtotime($act_inicio))).'';
                   		$hora_termino = ''.iconv('ISO-8859-1', 'UTF-8', strftime('%H:%M',  strtotime($act_termino))).'';
                   	}





                   		
                   	}


                  
                   
          echo'
            <div class="row dia">'.$a.'</div>
            <div class="row num_dia">'.$d.'</div>
            <div class="row mes">'.$b.' '.$y.'</div>
           </div>
          <div class="det_hora col-md-2"><div clas="row">'.$hora_inicio.' <br> '.$hora_termino.' </div></div>
          <div class="col-md-1 det_duracion">
          <div class="row" >
               <div class="col-md-12">
                 <div class="col-md-12 num_duracion">
                   '.$dif_dias.'
                  </div>
               </div>
               <div class="col-md-12 dia_duracion">'.$dias.'</div>
          </div> </div>
          <div class="col-md-3 fecha_duracion">'; 
           if ($dif_dias > 1){
          	echo ''.iconv('ISO-8859-1', 'UTF-8', strftime('%a %d/%b/%y',  strtotime($inicio))).' <br> '.iconv('ISO-8859-1', 'UTF-8', strftime('%a %d/%b/%y',  strtotime($termino))).'';
          }

          echo'
          </div>
          <div class="btn-toolbar" role="toolbar">
  <div class="btn-group">';

    $id_usuario=$this->session->userdata('id');
	
	if(($num_sem >= $num_sem_hoy)&& ($id_usuario == $i -> usuario )||($id_usuario == "17036064-8")){
										  echo' 
 
<button type="button" class="btn btn-default" onclick="if( confirm(\'¿Seguro?\')){location.href=\''.base_url().'actividades/nueva/eliminar/'.$i -> act_id.'\';}"> <span class="glyphicon glyphicon-trash"></span></button>
 </td>';
 	 }
					

  echo'<button type="button" class="btn btn-default" data-toggle="modal" href="#myModalEditar"  id="'.$i -> act_id.'" onClick="selPersona(\''.$i -> act_evento.'\',\''.$i -> act_req.'\',\''.$i -> act_fecha.'\',\''.$i -> act_inicio.'\',\''.$i -> act_termino.'\',\''.$i -> act_responsable.'\',\''.$i -> act_nprsns.'\',\''.$i -> act_ctg_id.'\',\''.$i -> act_sctg_id.'\',\''.$i -> n_socios.'\',\''.$i -> act_fono.'\',\''.$i -> act_empresa.'\',\''.$i -> act_organizacion.'\',\''.$i -> act_nombre.'\',\''.$i -> act_correo.'\',\''.$i -> act_id.'\');">  <span class="glyphicon glyphicon-edit"></span></button>   
 
    <button type="button" id="new_calendar" title="Calendarización" class="btn btn-default" onClick="modalcalendarizacion(\''.$id.'\');">
      <span class="glyphicon glyphicon-calendar"></span>
    </button>
    <button type="button" id="'.$id.'" title="Ver Informe" class="btn btn-default print" onClick="modalcalendarizacion(\''.$id.'\');">
      <span class="glyphicon glyphicon-print"></span>
    </button>
 
    
  </div>
  </div>
            <div class="col-md-6 cont-card">
              <div class="card">
                <h1>Dependencias</h1>
              <ul>';
                $dep= $this -> model_actividades -> getDepen($id);
                      foreach($dep as $d ){
                                          echo '<li>'.$d -> dep_nombre.'</li>';
                      }
              echo'</ul>
            </div>
            </div>
            <div class="col-md-6 cont-card">
            <div class="card ">
              <h1>Personas</h1>
              <ul class="fullstats">
                <li> <span>'.$socios.'</span>Socios </li>
                <li> <span>'.$externos.'</span>Externos </li>
                <li> <span>'.$total_prsns.'</span>Total </li>
              </ul>
            </div>
            </div>
            <div class="col-md-12 cont-card">
              <div class="card">
              <div class="col-md-12">
                <h1>Organiza: ';
                if($organiza == "Tercero") {echo $empresa;}else{echo $organiza;}
                echo'</h1>
              </div>
              <div class="col-md-12">
              <h1>Responsable</h1>
              <div class="responsable"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> '.$responsable.'</div>
              <div class="responsable" style="letter-spacing: 2px;"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>'.$fono.'</div>
              <div class="responsable" style="letter-spacing: 2px;"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>'.$correo.'</div>
              </div>
              </div>
            </div>';

            
            if (!empty($observaciones)){
            echo'<div class="col-md-12 cont-card">
            <div class="card ">
            <h1>Observaciones</h1>
               <div>'.$observaciones.'</div>
            </div>
            </div>';
            }

            if (!empty($req)){
            echo'<div class="col-md-12 cont-card">
            <div class="card ">
            <h1>Requerimientos</h1>
               <div>'.$req.'</div>
            </div>
            </div>';
            }



            echo'<div class="col-md-12 cont-card">
            <div class="card ">
           
              <div class="padre">
              <div class="hijo  div_calendar">
            ';            
            
           

              $this -> ver_calendarizacion($id);
              
            echo'</div>
            </div>
          </div>';
        }

		//var_dump($actividades);

	}	
	
public function ft_actividad(){

	$data['id']= $this->uri->segment(4);
	$data['fecha_sel']= $this->uri->segment(5);
	//$this->load->view('reportes/activity_detalle',$data);
	$html = $this->load->view('reportes/activity_detalle2', $data,true);
//	$pie = "<div>Detalle Actividad <br> {PAGENO}/{nb}</div>";
	//$cabecera = "<span><b>Mi primer documento PDF dinámico con mPDF</b></span>";
 
	
	
	$mpdf = new mPDF('', 'Letter');
	$mpdf->AddPage('P');
	$mpdf->SetHTMLHeader($cabecera);
	$mpdf->shrink_tables_to_fit =1;
	$mpdf->WriteHTML($html);
	$mpdf->SetHTMLFooter($pie);
	$mpdf->Output();
	
}

public function edit_calendarizacion(){
	$id = $this->input->post('id');
    $fecha=$this->input->post('fecha');
    $inicio=$this->input->post('inicio');
    $termino=$this->input->post('termino');
    $desc = $this->input->post('desc');  
    $actv = $this->input->post('actv'); 

    $data = array(
       
        'fecha' => $fecha,
        'hr_inicio' => $inicio,
        'hr_termino' => $termino,
        'descripcion' => $desc
);

$this->db->where('id', $id);
$this->db->update('actividades_calendario', $data);

echo '<div class="error alert alert-success alert-dismissible " role="alert"> Actualizado Correctamente.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>  </div>';

$this -> ver_calendarizacion($actv);

}

public function eliminar_calendarizacion(){
    $id = $this->input->post('id');
    $actividad = $this->input->post('actividad');
    $this->db->where('id', $id);
    $this->db->delete('actividades_calendario');
  	echo '<div class="error alert alert-success alert-dismissible " role="alert"> Actualizado Correctamente.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>  </div>';
  	$this -> ver_calendarizacion($actividad);
}



public function buscarPersona(){
	$rut = $this->input->post('rut');
	//var_dump($rut);
   $funcionario = $this -> model_actividades -> BuscarFuncionario($rut);

   if($funcionario != 0){

   	 foreach($funcionario as $d){
             //$rut = $d-> prsn_rut;
             $nombre = $d-> nombre_fun;
             $paterno = $d-> paterno;
             $materno = $d-> materno;


        } 
      $tipoPersona = 'FUNCIONARIO';
   }


    //buscar si rut se encuentra en socios, beneficiarios o funcionarios.
   $sql=$this -> model_actividades -> BuscarPersona($rut);
  // var_dump($sql);
   if($sql != 0){
     foreach($sql as $d){
             $rut = $d-> prsn_rut;
             $nombre = $d-> prsn_nombres;
             $paterno = $d-> prsn_apellidopaterno;
             $materno = $d-> prsn_apellidomaterno;


        } 
   
   $tipoPer=$this -> model_actividades -> TipoPersona($rut);
   
   if($tipoPer == 1){
   	$tipoPersona = 'SOCIO';   	
   }
   if($tipoPer == 2){
   	$tipoPersona = 'BENEFICIARIO';   	
   }
    if($tipoPer == 3){
   	$tipoPersona = 'EXTERNO';   	
   }
   if($tipoPer == 4){
   	$tipoPersona = 'FUNCIONARIO';   	
   }


  }

 if($funcionario != 0 || $sql != 0){
  $data = array(0 => $nombre,
                      1 => $paterno,
                      2 => $materno,
                      3 => $tipoPersona);
        echo json_encode($data); 
}else{
	$data = array(0 => 0);
        echo json_encode($data); 
}

   
 
}
public function guardarPersona(){
	$rut = $this->input->post('rut');
	$nombre = $this->input->post('nombre');
	$paterno = $this->input->post('ap_pat');
	$materno = $this->input->post('ap_mat');
	$tipo = $this->input->post('tipo');
	if($tipo == 4){
		$tipoPersona = 2;//beneficiario
	}
	if($tipo == 1){
		$tipoPersona = 3;//externo
	}
	if($tipo == 2){
		$tipoPersona = 4;//funcionario
	}

	if(empty($materno)){
		$materno = ' ';
	}

	$prsn_id = $this -> model_actividades -> ultimoId();
    
     $data = array(
         'prsn_id' => $prsn_id = $prsn_id + 1, 
     	 'prsn_rut' => $rut,         
         'prsn_apellidopaterno' => $paterno,
         'prsn_apellidomaterno' => $materno,
         'prsn_nombres' => $nombre,
         'prsn_fechanacimi' => '0000-00-00', 
         'prsn_sexo' => 3,     
         'prsn_descendiente' => 0, 
         'prsn_direccion' =>  'SIN INFORMACION',
         'prsn_sectorvive' => 'SIN INFORMACION',
         'prsn_email' => 'SIN INFORMACION',       
         'prsn_fono_casa' => 0,
         'prsn_fono_movil' => 0, 
         'prsn_fono_trabajo' => 0,
         'prsn_profesion' => 'SIN INFORMACION',
         'prsn_tipo' =>'SIN INFORMACION',
         'prsn_tipoPersona' =>$tipoPersona,
         'prsn_direccion_empresa' => 'SIN INFORMACION', 
         'prsn_foto' => 'SIN INFORMACION',         
         'prsn_fallecido' => 3,
         'prsn_empresa' => 'SIN INFORMACION',
         's_nacionalidades_nac_id' => 1,
         's_condicion_laboral_condlab_id' =>5,
         's_estado_civil_estacivil_id' => 6, //persona natural
         's_comunas_comuna_id' => 8101);
      $insertar = $this -> model_actividades -> insertarPersona($data); //INSERT PERSONAS
       if($insertar == true){
       	echo 1;
       }else{
       	echo 0;
       }
}

public function guardaractividad(){
	$datos = array();
	$arr = array();
   $id = $this->input->post('id');
    $arr = json_decode($_POST['data']);
   
    for($i=0; $i <count($arr); $i++) {
           	 	
        $datos[] = array(        
         'act_prsn_rut' => $arr[$i]->rut, 
     	 'id_act' => $id
     	);  


    }
   
   


  
    $insertar = $this -> model_actividades -> insertarActividad($datos); 
    if($insertar == true){
       	echo 1;
       }else{
       	echo 0;
       }

}

}

?>