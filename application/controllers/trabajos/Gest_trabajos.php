<?php class gest_trabajos extends CI_Controller {

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
		    $categoria=7;
			$mes = date("m"); // Mes actual 
			$data['dependencias'] = $this -> model_trabajos -> getDepen();
		    $data['subcategoria'] = $this -> model_trabajos -> getsubcategoria($categoria);
	        $data['sectores'] = $this -> model_trabajos->getSector();	
		    $data['categorias'] = $this -> model_trabajos->getCategorias();	
		    $this->load->view('plantilla/Head_v1');
		    $this->load->view('trabajos/gestion_trabajos',$data);
		    $this->load->view('plantilla/Footer');		

	    }
	
	function toexcel(){
			
		$data["mes"]  = $this->input->post('mes');
		$data["year"]  = $this->input->post('year');
		$sector=$this->input->post('select_sector');
		echo $sector.'sector<br>';

		$categoria  = $this->input->post('categoria');
		$data["cat"]  = $this->input->post('categoria');
		

		$data["subcategoria"] = $this -> model_trabajos -> getsubcategoria($categoria);	
		$data["dependencias"] = $this -> model_trabajos -> getDepenID($sector);
		echo $this->db->last_query();
		$data["sectores"] = $this -> model_trabajos->getSectorID($sector);	

		//print_r($data['cat']);
		$this->load->view('reportes/control_trabajos_report',$data);
		}
	
	
	
	 function control_trabajos (){
		$categoria  = $this->input->post('micategoria');
		$mes  = $this->input->post('mimes');
		$year  = $this->input->post('miyear');
		$id_sector=$this->input->post('sector');
		
		//echo $id_sector;
	
		
		$dependencias = $this -> model_trabajos -> getDepen();
		$subcategoria = $this -> model_trabajos -> getsubcategoria($categoria);
		$sectores = $this -> model_trabajos->getSectorID($id_sector);	
		
		
		echo' <table id="highlight-table"  class="table-bordered table-striped">
        <thead>
           <tr>
              <th>dependencia</th>';
             
              foreach($subcategoria as $row_sub){
                $sctg_nombre = $row_sub -> sctg_nombre;
				
				$tipo =  $row_sub -> sctg_tipo;
				if ($tipo == 1){echo' <th colspan="3" style="background:rgba(0, 202, 73, 0.18);" >'.$sctg_nombre.'</th>'; }
				else {echo' <th colspan="3">'.$sctg_nombre.'</th>';}
				
                 
				  }
              
          echo'</tr>
          <tr>
          <td>&nbsp;</td>';
        
              foreach($subcategoria as $row_sub){
        
                 echo' <td><span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span></td>
				  <td>#</td>
		  <td><span style="font-weight: 900;font-size: 15px;">%</span></td>';
				  }
           
         echo' </tr>
           </thead> 
             <tbody>';
     
		foreach($sectores as $row_sector){
			 $id_sector = $row_sector -> id;
			 echo'<tr>
			 <td colspan="40" style="    background: rgba(0, 147, 255, 0.06);
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 10px;
    text-align: center;">'.$row_sector -> nombre.'</td></tr>';
			 
			 foreach($dependencias as $row_d){
                
                $dep_id = $row_d -> dep_id;
                $dep_nombre = $row_d -> dep_nombre;
				$dep_sector = $row_d -> sector;
				
				if($dep_sector == $id_sector){  echo '<tr>
		
              <td>'.$row_d -> letra.'.&nbsp;'.$dep_nombre.'</td>';
			 
			   foreach($subcategoria as $rs){
                    $sctg_id = $rs -> sctg_id;
                    $this->load->model('model_trabajos');
                    $trabajos_mes = $this -> model_trabajos->trabajos_mes($sctg_id,$dep_id,$mes,$year);
					$plan_mes = $this -> model_trabajos->plan_mes($sctg_id,$dep_id,$mes,$year);
                        $totalTB=0;
						$cantdTB=0;
						$cantMES=1;
                      
			 
			 			/*planificacion*/
			              if(count($plan_mes)==0){echo'<td>&nbsp;</td>'; $cantMES=0;}
						  else{  foreach($plan_mes as $pm){
							  $cantdTB=$pm -> cantidad;
                              echo'<td>'.$pm -> cantidad.'</td>';
                                }
						 }
						    /*compruebo si hay trabajos */
                        if(count($trabajos_mes)==0) { echo'<td>&nbsp;</td>';}
                        /*hay trabajos NO ESTA VACIO*/
                        else{foreach($trabajos_mes as $tm){
							if($cantMES==0){ echo'<td style="background:rgba(0, 255, 33, 0.21);">'.$tm -> TOTAL_TB.'</td>';}
							else{echo'<td>'.$tm -> TOTAL_TB.'</td>';}
								 $totalTB=$tm -> TOTAL_TB;
                                }
           				 } 
						 
						  /******porcentaje*******/
						
							//If it's not 0 then divide
							if($cantdTB != 0){
							  $result = ($totalTB*100)/$cantdTB;//is set to number divided by x
							  
							  $resultb=round($result);
							  
							  if ($resultb < 10){
	echo '<td style="border-right: #10c518 3px dashed; background:rgba(255, 0, 0, 0.21);">'.$resultb.'%</td>';
								  }else{
	  echo '<td style="border-right: #10c518 3px dashed;">'.$resultb.'%</td>';
								  }
							}
							//if it is zero than set it to null
							else{
							  $resultb = null;//is set to null
							     echo '<td style="border-right: #10c518 3px dashed;">'.$resultb.'</td>';
							}
						 
						 
						/* if ($totalTB == 0 and $cantdTB ==0){
							 echo'<td>-</td>';
							 }
							 else{					 $porce=(($totalTB*100)/$cantdTB);	
					  echo '<td>'.$porce.'%</td>'; 
								}*/
						 
        }  
			  
			  }
        
      
              
              
               
              ' </tr>';
                }
			 
			 
			 
			}
		
		
        
   
        
         echo' </tbody>
        </table>';
		
		}
	
	
	
	 
	 
}
?>