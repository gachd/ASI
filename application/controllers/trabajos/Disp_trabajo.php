<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class disp_trabajo extends CI_Controller {

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
		$this->load->view('trabajos/disp_trabajo',$data);
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
		    $allsubcategorias=$this->model_trabajos->getSubcate();
		  


//CARGO LA PLANIFICACION GUARDADA.      
		    echo' <table id="highlight-table"  class="table-bordered table-striped">
		    <thead>
		    <tr>
              <th></th>
              <th>Lun</th>
              <th>Ma</th>
              <th>Mie</th>
              <th>Jue</th>
              <th>Vie</th>
              <th>Sab</th>
              <th>Dom</th>


              </thead>
            <tbody>';
           
            foreach($sectores as $row_sector){
                $id_sector = $row_sector -> id;
                echo'<tr>
                <td colspan="40" style="background: rgba(0, 147, 255, 0.06);font-size: 14px;font-weight: 700;letter-spacing:10px;text-align: center;">'.$row_sector -> nombre.'</td>
                </tr>';
                $c = "A";
                $il=1;

              
                foreach($dependencias as $row_d){

                	$dep_id = $row_d -> dep_id;
                	$dep_nombre = $row_d -> dep_nombre;
                	$dep_estado = $row_d -> dep_estado;
                	$dep_habilitado = $row_d -> dep_habilitado;
                	$dep_sector = $row_d -> sector;
                	if($dep_sector == $id_sector){
                		if ($il <> 1){
                			$c++;
                		}

                		 $il++;

                		
                		

                		echo '<tr>
                		<td>'.$c.'.&nbsp;'.$dep_nombre.'</td>';
                		$disp_trabajo = $this -> model_trabajos->disp_trabajo($dep_id,$subcategoria);

                		$chek2="";

                		//lun - sab
                		for($i = 1; $i <= 6; $i++) {
                			$checked="";
                			
                			 foreach ($disp_trabajo as $dp) {
                			 	$dia=$dp-> dia;
                			 	if ($dia == $i) {
                			 		$checked="checked";
                			 	}
                			 	if($dia == 0){
                			 		$chek2="checked";
                			 	}
                			 }

                			echo'<td><input type="checkbox" value="'.$i.'" name="'.$dep_id.'-'.$i.'" '.$checked.'></td>';
                		}
                		//dom

                		echo'<td><input type="checkbox" value="0" name="'.$dep_id.'-0" '.$chek2.' ></td>';
                		
                	}
                echo'</tr>';
                }
            }
            echo' </tbody></table> <input type="submit" name="submit" id="submit" value="Guardar" class="btn btn-success">';
    }	

	function guardar(){
		$mes  = $this->input->post('mes');
		$year  = $this->input->post('year');
		$sector = $this->input->post('select_sector');
		$categoria  = $this->input->post('categoria');
		$subcategoria=$this->input->post('subcategoria');
		$dependencias = $this -> model_trabajos -> getDepenID($sector);

		  $this -> model_trabajos -> delete_disp($sector,$subcategoria);
		

      

		for($i = 0; $i <= 6; $i++) {
			foreach($dependencias as $row_d){
				$dep_id = $row_d -> dep_id;
				 $checkbox = $this->input->post(''.$dep_id.'-'.$i.'');
				if(isset($checkbox)){//echo $dep_id.' - '.$i.'<br>';
				 	$data = array(
                    'categoria' => $categoria,
					'subcategoria' => $subcategoria,
					'dependencia' => $dep_id,
					'sector' =>$sector,
					'dia' =>$i,
								
                    );
				 	
				    $this -> model_trabajos -> insertar_disp($data);
				   
				  
				    	 	
				}
			}
		}
		if($this->db->affected_rows() > 0){
		                $this->session->set_flashdata('category_success', 'Agregado exitosamente.');
		                redirect (base_url().'trabajos/disp_trabajo');
	                }else{echo'error';}	
	}




}
	?>