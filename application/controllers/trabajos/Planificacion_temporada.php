<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class planificacion_temporada extends CI_Controller {

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
		
		$this->load->view('plantilla/Head');
		$this->load->view('trabajos/planificacion_temporada',$data);
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
		
	public function guardar(){
		    //OK
		    $depend = $this -> model_trabajos->getDepen();	
		    $mes =   $this->input->post('mes');
		    $year = $this->input->post('year');
		    $sub_categoria = $this->input->post('subcategoria');
		    $this -> model_trabajos -> dele_pl_mensual($sub_categoria,$mes,$year); // vacio lo ingresado			
		    foreach($depend as $rows_dep){
			$id_dep = $rows_dep ->dep_id;
		    $text = $this->input->post(''.$id_dep.'');
		    $periocidad= $this->input->post('periocidad'.$id_dep.'');
		   
		        if($text <> 0){

		            $data = array(
		     	    'pl_temporada' => $this->input->post('mes'),
				    'pl_year' => $this->input->post('year'),
				    'pl_categoria' => $this->input->post('categoria'),
				    'pl_subcategoria' => $this->input->post('subcategoria'),
				    'pl_dependencia' => $id_dep,
				    'pl_periocidad' => $periocidad,
				    'pl_cantidad' => $this->input->post(''.$id_dep.''));
				  /* echo('<pre>');
				   print_r($data);
				   echo('</pre>');*/
		            $this -> model_trabajos -> insertar_pl_mensual($data);//guardo la data
			    }


		    }
		    if($this->db->affected_rows() > 0){
		    $this->session->set_flashdata('category_success', 'Agregado exitosamente.');
		    redirect (base_url().'trabajos/planificacion_temporada');
	        }else{echo'error';}
	}
			
			
	public function cargar(){
		$depend= $this -> model_trabajos->getDepen();	
		$sectores = $this -> model_trabajos->getSector();
		$categorias = $this -> model_trabajos->getCategorias();	
        $select_mes = $_POST['mes'];//temporada		
		$select_categoria=$_POST['categoria'];
		$select_subcategoria=$_POST['subcategoria'];
		$select_year=$_POST['year'];
		/*echo 'temporada '.$select_mes.' <br>';
		echo 'cat '.$select_categoria.' <br>';
		echo 'S-cat '.$select_subcategoria.' <br>';*/
		    foreach($sectores as $rows_sec){
		    $id_sector = $rows_sec -> id;
		    echo'<table border="1" class="sector col-md-3">
		      <tbody>
		      <thead style="    background: aliceblue;">
		      <th colspan="4">'.$rows_sec -> nombre.'</th>
		      </thead>';
		    /*depe/sector*/
		  	foreach($depend as $rows){
		  	$id_dep = $rows -> dep_id;
		  	$sector = $rows -> sector;
		  	    if ($sector==$id_sector){
		  		echo'	 <tr style="    border-bottom: 1px dotted #c3c0c0;">
		  		<td> <label for="'.$rows->dep_id.'" class="css-label" >'.$rows->letra.'</label></td>
		  		<td ><label class="css-label" for="'.$rows->dep_id.'">'.$rows->dep_nombre.'</label> </td>';
		  		$plan = $this -> model_trabajos->plan_mes($select_subcategoria,$id_dep,$select_mes,$select_year);
		  		$this -> db->last_query();
		  		if(count($plan)==0){
		  		    echo'<td>
		  		        <select name="periocidad'.$rows->dep_id.'">
                             <option value="2">Mensual</option>
                             <option value="4">Semanal</option>
                             <option value="3">Diario</option>
                             <option value="5">Diario Hábil</option>
                        </select>
		  		         </td>
                        <td><input type="text" class="cant" name="'.$rows->dep_id.'" id="'.$rows->dep_id.'"></td>
                        </tr>';
                }else{
                	    foreach($plan as $rowsp){
                	    $cantidad = $rowsp-> pl_cantidad;
					    $periocidad = $rowsp-> pl_periocidad;
                        echo'
                        <td>
		  		        <select name="periocidad'.$rows->dep_id.'">
                             <option value="2"'; if($periocidad==2){ echo'selected';}echo'>Mensual</option>
                             <option value="4"'; if($periocidad==4){ echo'selected';}echo'>Semanal</option>
                             <option value="3"'; if($periocidad==3){ echo'selected';}echo'>Diario</option>
                             <option value="5"'; if($periocidad==5){ echo'selected';}echo'>Diario Hábil</option>
                        </select>
		  		         </td>
		  		         <td><input type="text" class="cant" name="'.$rows->dep_id.'" id="'.$rows->dep_id.'" value="'.$cantidad.'"></td></                 tr>';
                        }
				    }
	            }
		
		    }
		    echo'</tbody></table>';
		}
		echo'<div class="col-md-12" style="text-align:right;" ><br>
		<input type="reset" name="reset" id="reset" value="Cancelar" class="btn btn-danger">
		<input type="submit" name="submit" id="submit" value="Guardar" class="btn btn-success"></div>';
	
	}
}
	
	?>