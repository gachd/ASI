<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class planificacion_diaria extends CI_Controller {

	function __construct() {
		 
        parent::__construct();
		$this->load->library('session');
		$this->load->model('model_trabajos');
	    $this->load->helper('url');
	    $this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
	}
	
	
	public function index(){
		$data['depend'] = $this -> model_trabajos->getDepen();	
		$data['sectores'] = $this -> model_trabajos->getSector();
		$data['categorias'] = $this -> model_trabajos->getCategorias();	
		$data['funcionarios_stadio'] = $this -> model_trabajos->funcionarios_stadio();	
		
		$this->load->view('plantilla/Head_v1');
		$this->load->view('trabajos/planificacion_diaria',$data);
		$this->load->view('plantilla/Footer');		
	}	

	public function fillsubcategorias (){
			
			$ctg  = $this->input->post('micategoria');
			
			if($ctg <> 0 ){
				/*echo' <option value="0"> '.$ctg.'lllego</option>';*/
				$subcatg= $this -> model_trabajos -> getsubcategoria($ctg);
				foreach($subcatg as $fila){
				echo ' <option value="'.$fila->sctg_id.'" '.set_select("subcategoria",$fila->sctg_id).'>'.$fila->sctg_nombre.'</option>';
					}
			}else{
					echo' <option value="0"> Seleccionar</option>';
				 }
	}

	function planificacion (){
		 	$categoria  = $this->input->post('categoria');
		    $mes  = $this->input->post('mes');
		    $year  = $this->input->post('year');
		    $id_sector=$this->input->post('sector');
		    $subcategoria=$this->input->post('subcategoria');//echo $id_sector;
		    $dependencias = $this -> model_trabajos -> getDepen();
		    $depen_sector = $this -> model_trabajos -> getDepenID($id_sector);
		    $sectores = $this -> model_trabajos->getSectorID($id_sector);
		    $hoy=date("Y-m-d H:i:s");
		    $year_actual=date("Y");
		    $mes_actual=date("m");
		    $allsubcategorias=$this->model_trabajos->getSubcate();
		    //numero de días del mes selccionado
		    $numero = cal_days_in_month(CAL_GREGORIAN, $mes, $year);
		    setlocale(LC_ALL, 'es_ES');

		   for($i = 1; $i <= $numero; $i++){
		   $date=''.$year.'-'.$mes.'-'.$i.'';
		   $new_date = strtotime($date);
		   $num_week="".date('W',$new_date)."";
		   $array_semana[]=$num_week;
		   $semana = array_values(array_unique($array_semana));
		    } 
		    // DEFINO TEMPORADA
		    if($mes > 3 and $mes < 11  ){/*TEMPORADA BAJA*/$temporada=1;}else{ /*temporada alta*/ $temporada=2;}
		    $trabajos_mes = $this -> model_trabajos -> Alltrabajos_mes($mes,$year);
		    
		    // valido que el mes seleccionado sea igual al actual
		    $fecha_pl=date("1-".$mes."-".$year."");
		    $newfecha_pl = strtotime ( '-10 day' , strtotime ( $fecha_pl ) ) ;
		    $newfecha_pl = date ( 'Y-m-j' , $newfecha_pl );
		    //echo '<br>'.$newfecha_pl;
            if(($hoy > $newfecha_pl)){
            	//valido si ya hay trabajos planificados
            	if(empty($trabajos_mes)){
            		//RECORRO TODAS LAS CATEGORIAS
		    foreach ($allsubcategorias as $sc) {
		    	$id_subcategoria= $sc -> sctg_id;
		    	$id_catg_subcategoria= $sc -> categoria_ctg_id;
		    	//recorro todas las dependencias
		    	foreach($dependencias as $dep){
		    		$id_dep= $dep -> dep_id;
		    		//BUSCO PERIOCIDAD
		    		$pl_temporda = $this->model_trabajos->planificacion_temporada($id_subcategoria,$id_dep,$temporada,$year);
		    		// si hay periocidad ...
		    		if(!empty($pl_temporda)){
		    			unset($dias);
		        	foreach($pl_temporda as $pt){
		        		$cantidad = $pt->pl_cantidad;
		        		$periocidad = $pt->pl_periocidad;
		        	}
		            //SEGUN PERIOCIDAD
		            switch ($periocidad) {
		            	
		    		    case 4:

		    		    $disponibilidad = $this->model_trabajos->disp_trabajo($id_dep,$id_subcategoria);
		    		    $cada=round((7/$cantidad), 0,PHP_ROUND_HALF_DOWN); 
		    		    //$fecha= date("Y-m-d", strtotime("$fecha + ". $cantidad ." days")); //se suman los $x dias
		            	//echo'var: '.$n_veces.'cantidad:'.$cantidad.' semana:'.$sem.' dia: '.$fecha.' dia:'.$i.'<br>';
		            	if (empty($disponibilidad)){

		            		foreach ($semana as $s) {

		            			$week = $s;
		            			$calcWeek = $week - date('W');
		            			$primer_dia = date('Y-m-d', strtotime('Monday ' . ($calcWeek-1) . ' weeks'));
		            			$ultimo_dia= date('Y-m-d', strtotime('Sunday ' . $calcWeek . ' weeks'));
		            			echo $primer_dia.'*****'.$ultimo_dia.'<br>';
		            			for($var = 1; $var <= $cantidad; $var++){

		            				if ($var ==1){
		            					$nuevafecha=$primer_dia;
		            					$dias[]=$nuevafecha;
		            				}else{
		            				$nuevafecha = date('Y-m-d',strtotime ( '+'.$cada.' day' , strtotime ( $nuevafecha ) )) ;}
		            			    $dias[]=$nuevafecha;
		            			    //echo "nueva fecha =".$nuevafecha."<br>";
		            			}
		            		}
		            		$dias_trabajo = array_values(array_unique($dias));

		            		foreach ($dias_trabajo as $dt) {

		            			$fecha_trabajo=$dt;
		            			echo "cada:".$cada."dias  cantidad:".$cantidad." periocidad".$periocidad." depend:".$id_dep."subcategoria".$id_subcategoria;
		            			$data = array(
                                              'tb_fecha' => "$fecha_trabajo",
					                          'tb_fecha_termino' => "$fecha_trabajo",
					                          'tb_ctg_id' => $id_catg_subcategoria,
					                          'tb_sctg_id' =>$id_subcategoria,
					                          'tb_actualización' =>$hoy,
					                          'usuario' => $this->session->userdata('id')				
                                             );

		            			
		            			//INSERT ACTIVIDAD	
				               $this -> model_trabajos -> insertar($data);
				               //ultima actividad			
				               $resmax = $this->model_trabajos->MaxTRAB();
				                foreach($resmax as $m){
				                	$ultimo= $m -> tb_id;
				                }
				                $data_dep = array(
					            'trabajo' => $ultimo,
					            'dependencia' => $id_dep,
					            'ctg_id' => $id_catg_subcategoria,
					            'sctg_id' =>$id_subcategoria);
                                $this -> model_trabajos -> InserDep($data_dep);
                                //INSERTAR PLANIFICACION
				                $planificacion = array(
					            'tipo' => "1",
					            'fecha' => "$fecha_trabajo",
					            'trabajos' => $ultimo
				                );
				                $this -> model_trabajos -> planificacion($planificacion);
				                

                             
		            		}

		            	}else{

		            		for($i = 1; $i <= $numero; $i++){
		                        $dateb=''.$year.'-'.$mes.'-'.$i.'';
		                        $new_dateb = strtotime($dateb);
		                        $num_dia="".date('w',$new_dateb)."";
		            			foreach ($disponibilidad as $d) {
		    		    		    if ($num_dia == $d->dia){
		    		    			$data = array(
                                              'tb_fecha' => "$dateb",
					                          'tb_fecha_termino' => "$dateb",
					                          'tb_ctg_id' => $id_catg_subcategoria,
					                          'tb_sctg_id' =>$id_subcategoria,
					                          'tb_actualización' =>$hoy,
					                          'usuario' => $this->session->userdata('id')				
                                             );
		    		    				//INSERT ACTIVIDAD	
				               $this -> model_trabajos -> insertar($data);
				               //ultima actividad			
				               $resmax = $this->model_trabajos->MaxTRAB();
				                foreach($resmax as $m){
				                	$ultimo= $m -> tb_id;
				                }
				                $data_dep = array(
					            'trabajo' => $ultimo,
					            'dependencia' => $id_dep,
					            'ctg_id' => $id_catg_subcategoria,
					            'sctg_id' =>$id_subcategoria);
                                $this -> model_trabajos -> InserDep($data_dep);
                                //INSERTAR PLANIFICACION
				                $planificacion = array(
					            'tipo' => "1",
					            'fecha' => "$dateb",
					            'trabajos' => $ultimo
				                );
				                $this -> model_trabajos -> planificacion($planificacion);
		    		    			
		    		    		    }
		    		    	    }
		    		    	}

		            		}
		            	
		    		     
		    		   // echo $this->db->last_query();
		    		    //echo('<pre>');
		            	//var_dump($disponibilidad);
		            	//echo('</pre>');
		    		    
		    		    

		    		    break;

		    		    //HABIL
		    		    case 5:
		            	for($i = 1; $i <= $numero; $i++) {
		            		$f=''.$year.'-'.$mes.'-'.$i.'';
		            		$fecha = strtotime($f);
		            		$n_dia=date('w',$fecha);
		            		//0: domingo 6:sabado
		            		if(($n_dia != 0) and ($n_dia!=6)){
		            			$feriados = $this -> model_trabajos->feriados($f);
		            			//SI NO ES FERIADO LO IMPRIME
		            			if(empty($feriados)){
		            				$data = array(
                                              'tb_fecha' => ''.$f.'',
					                          'tb_fecha_termino' => ''.$f.'',
					                          'tb_ctg_id' => $id_catg_subcategoria,
					                          'tb_sctg_id' =>$id_subcategoria,
					                          'tb_actualización' =>$hoy,
					                          'usuario' => $this->session->userdata('id')				
                                             );
		            				//echo('<pre>');
		            				//var_dump($data);
		            				//echo('</pre>');
                                //INSERT ACTIVIDAD	
				                $this -> model_trabajos -> insertar($data);
				               //ultima actividad			
				                $resmax = $this->model_trabajos->MaxTRAB();
				                foreach($resmax as $m){
				                	$ultimo= $m -> tb_id;
				                }

					            $data_dep = array(
					            'trabajo' => $ultimo,
					            'dependencia' => $id_dep,
					            'ctg_id' => $id_catg_subcategoria,
					            'sctg_id' =>$id_subcategoria);
                                $this -> model_trabajos -> InserDep($data_dep);		

                                //INSERTAR PLANIFICACION
				                $planificacion = array(
					            'tipo' => "1",
					            'fecha' => ''.$year.'-'.$mes.'-'.$i.'',
					            'trabajos' => $ultimo
				                );
				                $this -> model_trabajos -> planificacion($planificacion);
				                }
				            }  
		    		    }
		    		    break;

		    		    case 2:
		    		   $disponibilidad = $this->model_trabajos->disp_trabajo($id_dep,$id_subcategoria);
		    		    $cadam=round(($numero/$cantidad), 0,PHP_ROUND_HALF_DOWN); 
		    		    	unset($day_work);
		    		    	if (empty($disponibilidad)){// se puede trabajar todos los dias
		    		    	    $inicio="".$year."-".$mes."-01";
		    		    	    for($var = 1; $var <= $cantidad; $var++){
		    		    	    	if ($var ==1){
		    		    	    		$date=$inicio;
		            		    		$day_work[]=$date;
		            		    	}else{
		            		    		$date = date('Y-m-d',strtotime ( '+'.$cadam.' day' , strtotime ( $date ) )) ;
		            		    	}
		            		    $day_work[]=$date;
		            		}
		            		
		            		}else{//solo se puede trabajar algunos dias
		    		    
		    		    		for($i = 1; $i <= $numero; $i++){
		                            $datem=''.$year.'-'.$mes.'-'.$i.'';
		                            $new_datem = strtotime($datem);
		                            $num_diam="".date('w',$new_datem)."";
		            			    foreach ($disponibilidad as $d) {
		    		    		        if ($num_diam == $d->dia){
		    		    		        	//echo 'dia'.$num_diam.' fecha'.$datem.'<br>';
		    		    		        	$day_work[]=$datem;
		    		    		        }
		    		    		    }
		    		    	    }
		    		    	    $customers = array_slice($day_work, 0, $cantidad);
		    		        }
		    		    	
		    		    	$day_work_unique = array_values(array_unique($day_work));
		    		    	foreach ($day_work_unique as $wu) {

		            			$date_work=$wu;
		            			$data = array(
                                              'tb_fecha' => "$date_work",
					                          'tb_fecha_termino' => "$date_work",
					                          'tb_ctg_id' => $id_catg_subcategoria,
					                          'tb_sctg_id' =>$id_subcategoria,
					                          'tb_actualización' =>$hoy,
					                          'usuario' => $this->session->userdata('id')				
                                             );

		            			
		            			//INSERT ACTIVIDAD	
				               $this -> model_trabajos -> insertar($data);
				               echo "guardo trabajo";
				               //ultima actividad			
				               $resmax = $this->model_trabajos->MaxTRAB();
				                foreach($resmax as $m){
				                	$ultimo= $m -> tb_id;
				                }
				                $data_dep = array(
					            'trabajo' => $ultimo,
					            'dependencia' => $id_dep,
					            'ctg_id' => $id_catg_subcategoria,
					            'sctg_id' =>$id_subcategoria);
                                $this -> model_trabajos -> InserDep($data_dep);
                                echo "guardo trabajo_dep";
                                //INSERTAR PLANIFICACION
				                $planificacion = array(
					            'tipo' => "1",
					            'fecha' => "$date_work",
					            'trabajos' => $ultimo
				                );
				                $this -> model_trabajos -> planificacion($planificacion);
				                echo "guardo planificacion";
				             }
		            	break;


		            	 case 3:
		            	for($i = 1; $i <= $numero; $i++) {
		            		$f=''.$year.'-'.$mes.'-'.$i.'';
		            		$fecha = strtotime($f);
		            		$n_dia=date('w',$fecha);
		            		//0: domingo 6:sabado
		            		/*if(($n_dia != 0) and ($n_dia!=6)){
		            			$feriados = $this -> model_trabajos->feriados($f);
		            			//SI NO ES FERIADO LO IMPRIME
		            			if(empty($feriados)){*/
		            				$data = array(
                                              'tb_fecha' => ''.$f.'',
					                          'tb_fecha_termino' => ''.$f.'',
					                          'tb_ctg_id' => $id_catg_subcategoria,
					                          'tb_sctg_id' =>$id_subcategoria,
					                          'tb_actualización' =>$hoy,
					                          'usuario' => $this->session->userdata('id')				
                                             );
		            				//echo('<pre>');
		            				//var_dump($data);
		            				//echo('</pre>');
                                //INSERT ACTIVIDAD	
				                $this -> model_trabajos -> insertar($data);
				               //ultima actividad			
				                $resmax = $this->model_trabajos->MaxTRAB();
				                foreach($resmax as $m){
				                	$ultimo= $m -> tb_id;
				                }

					            $data_dep = array(
					            'trabajo' => $ultimo,
					            'dependencia' => $id_dep,
					            'ctg_id' => $id_catg_subcategoria,
					            'sctg_id' =>$id_subcategoria);
                                $this -> model_trabajos -> InserDep($data_dep);		

                                //INSERTAR PLANIFICACION
				                $planificacion = array(
					            'tipo' => "1",
					            'fecha' => ''.$year.'-'.$mes.'-'.$i.'',
					            'trabajos' => $ultimo
				                );
				                $this -> model_trabajos -> planificacion($planificacion);
				              /*  }
				            }  */


		    		    }
		    		    break;



		    		    default:
		    		    # code...
		    		    break;
		            }
		            }
		        }
		    }
            	}else{/*echo '<div style="background: red;
    max-width: 50%;
    padding: 8px;
    margin: 11px;
    color: yellow;
    text-transform: uppercase;">YA HAY TRABAJOS GUARDADOS PARA EL MES QUE SE ESTA PLANIFICANDO</div>';*/}
            }else{echo '<div style="background: red;
    max-width: 50%;
    padding: 8px;
    margin: 11px;
    color: yellow;
    text-transform: uppercase;">AUN NO SE PUEDE CARGAR, DEBE ESPERAR HASTA EL '.iconv('ISO-8859-1', 'UTF-8', strftime('%A %d/%b/%y',  strtotime("".$newfecha_pl.""))).' .</div>';}


            


//CARGO LA PLANIFICACION GUARDADA.      
		    echo' <table id="highlight-table"  class="table-bordered table-striped">
		    <thead>
		    <tr>
              <th>mes'.$mes.' (Temp:'.$temporada.')</th>';
              
            setlocale(LC_ALL, 'es_ES').': ';
            for($i = 1; $i <= $numero; $i++) {
            	$fecha=$year.'-'.$mes.'-'.$i;
            	echo'<th>'.iconv('ISO-8859-1', 'UTF-8', strftime('%a %d',  strtotime("".$fecha.""))).'</th>';
            }
            echo'</thead>
            <tbody>';

            foreach($sectores as $row_sector){
                $id_sector = $row_sector -> id;
                echo'<tr>
                <td colspan="40" style="background: rgba(0, 147, 255, 0.06);font-size: 14px;font-weight: 700;letter-spacing:10px;text-align: center;">'.$row_sector -> nombre.'</td>
                </tr>';
                foreach($dependencias as $row_d){
                	$dep_id = $row_d -> dep_id;
                	$dep_nombre = $row_d -> dep_nombre;
                	$dep_sector = $row_d -> sector;
                	if($dep_sector == $id_sector){
                		echo '<tr>
                		<td>'.$row_d -> letra.'.&nbsp;'.$dep_nombre.'</td>';
                		for($i = 1; $i <= $numero; $i++) {
                			$fechab="".$year."-".$mes."-".$i."";
                			$actividad = $this->model_trabajos->actv_rango_cerrado_depe($fechab,$fechab,$dep_id);
                			
                			$trabajos = $this ->model_trabajos->cargar_trabajos($fechab,$categoria,$subcategoria,$dep_id);
                			
                			$clase_estado="";
                			$checked="";
                			$disabled ="";
                			$style_feriado="";
                			$fecha_actual = date('Y-m-d'); 

                			 $feriados = $this -> model_trabajos->feriados($fechab);
		    				 //SI ES FERIADO LO IMPRIME rojo
		    				 if(!empty($feriados))
		    				 {
		    				 	$style_feriado="background:#f9a7a7;";
		    				 }
                			if(!empty($trabajos)){
                				$checked="checked";
                				
                				foreach ($trabajos as $tr) {
                					$estado = $tr -> tb_estado;
                					$planificado = $tr -> tb_planificado;
                				}

                				if ($estado == 1 && $planificado == 0 ){$clase_estado="myinput planificado";}
                				if ($estado == 1 && $planificado == 1 ){$clase_estado="myinput noplanificado";}


                			}
                			if (empty($actividad)) {

                				echo'<td style="'.$style_feriado.'" ><input type="checkbox" class="'.$clase_estado.'" value="'.$i.'" name="'.$dep_id.'-'.$i.'" '.$checked.' '.$disabled.'></td>';
                			}else{
                				echo'<td style="background:#fbd95e;">';
                				echo'<div class="tooltip">
                                    <span class="tooltiptext">';
                                    foreach ($actividad as $a) {


                                     	echo  ''.$a->act_inicio.'-'.$a->act_termino.' <br>'.$a->ctg_nombre.','.$a->sctg_nombre.'<br>';
                                     	# code...
                                    }


                				echo'</span><input type="checkbox" value="'.$i.'" name="'.$dep_id.'-'.$i.'" '.$checked.' '.$disabled.'></div></td>';
                			}

                			
                		}
                	}
                echo'</tr>';
                }
            }
            echo' </tbody></table><input style="margin-top: 15px;"  type="submit" name="submit" id="submit" value="Guardar" class="btn btn-success">';
    }	

	function guardar(){
		$mes  = $this->input->post('mes');
		$year  = $this->input->post('year');
		$sector = $this->input->post('select_sector');
		$categoria  = $this->input->post('categoria');
		$subcategoria=$this->input->post('subcategoria');
		$dependencias = $this -> model_trabajos -> getDepenID($sector);
		date_default_timezone_set("Chile/Continental");
		$hoy=date("Y-m-d H:i:s");
		$numero = cal_days_in_month(CAL_GREGORIAN, $mes, $year);

        $trabajos_actualizar=$this-> model_trabajos -> trabajos_actualizar($mes,$year,$subcategoria,$sector);
        foreach($trabajos_actualizar as $ta){

        	$id_ta= $ta -> tb_id;

        	 $this-> model_trabajos ->eliminar_dep($id_ta);
        	 $this-> model_trabajos ->eliminar_plan($id_ta);
        	 $this-> model_trabajos ->eliminar_tb($id_ta);


        }


		for($i = 1; $i <= $numero; $i++) {
			foreach($dependencias as $row_d){
				$dep_id = $row_d -> dep_id;
				 $checkbox = $this->input->post(''.$dep_id.'-'.$i.'');
				if(isset($checkbox)){//echo $dep_id.' - '.$i.'<br>';
				 	$data = array(
                    'tb_fecha' => ''.$year.'-'.$mes.'-'.$i.'',
					'tb_fecha_termino' => ''.$year.'-'.$mes.'-'.$i.'',
					'tb_ctg_id' => $categoria,
					'tb_sctg_id' =>$subcategoria,
					'tb_actualización' =>$hoy,
					'usuario' => $this->session->userdata('id')				
                    );
				 	/*echo('<pre>');
                    var_dump($data);
                    echo('</pre>');*/
                    /*INSERT ACTIVIDAD*/	
				    $this -> model_trabajos -> insertar($data);
				    /*ultima actividad*/				
				    $resmax = $this->model_trabajos->MaxTRAB();
				    foreach($resmax as $m){
				    	$ultimo= $m -> tb_id;
				    }

					$data_dep = array(
					'trabajo' => $ultimo,
					'dependencia' => $dep_id,
					'ctg_id' => $categoria,
					'sctg_id' =>$subcategoria);
                    $this -> model_trabajos -> InserDep($data_dep);		

                    	/*INSERTAR PLANIFICACION*/
				    $planificacion = array(
					'tipo' => "1",
					'fecha' => ''.$year.'-'.$mes.'-'.$i.'',
					'trabajos' => $ultimo
				    );
				    $this -> model_trabajos -> planificacion($planificacion);
				    	 	
				}
			}
		}
		if($this->db->affected_rows() > 0){
		                $this->session->set_flashdata('category_success', 'Agregado exitosamente.');
		                redirect (base_url().'trabajos/planificacion_diaria');
	                }else{echo'error';}	
	}




}
	?>