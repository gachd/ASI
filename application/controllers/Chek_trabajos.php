<?php class chek_trabajos extends CI_Controller {

	function __construct() {
            parent::__construct();
		$this->load->library('session');
		$this->load->model('model_trabajos');
		$this->load->model('model_turnos');
            $this->load->model('model_actividades');
	      $this->load->helper('url');
	      $this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
	}
	
	
	public function index(){
		$data['depend'] = $this -> model_trabajos->getDepen();	
		$data['sectores'] = $this -> model_trabajos->getSector();
		$data['categorias'] = $this -> model_trabajos->getCategorias();	
		$data['funcionario'] = $this -> model_trabajos->funcionarios_stadio();	
            $data['fecha'] = $this->uri->segment(3);
		
		$this->load->view('plantilla/Head_v1');
		$this->load->view('trabajos/chek_trabajos',$data);
		$this->load->view('plantilla/Footer');		
	}

	function trabajos_fecha(){      

		$fecha = $this->input->post('txt_fecha');
		$funcionario = $this -> model_trabajos->funcionarios_stadio();
		$trabajos = $this -> model_trabajos->trabajos_fecha($fecha);

		echo'<div class="table-responsive"> 
            	    <table class="table table-responsive">
            		<thead>
            			<tr>
            				<th>Fecha</th>
            				<th>Trabajo</th>
            				<th>Dependencia</th>
            				<th>Realizado</th>
            				<th>Responsable</th>
            				<th>Observaciones</th>
            			</tr>
            		</thead>
            		<tbody>';

            		foreach ($trabajos as $t) {

            			$tb_id = $t -> tb_id;
                              $tb_estado = $t -> tb_estado;

            			echo'<tr>

            			<td>'.$t -> tb_fecha.'</td>
            			<td>'.$t-> sctg_nombre.'</td>

            			<td>';
            			$dependencia = $this -> model_trabajos->getDepWORK($t -> tb_id);

            			foreach ($dependencia as $d) {

            				echo $d -> dep_nombre;
            				# code...
            			}

                              $checked="";
                              if($tb_estado==1){
                                    $checked="checked";
                              }

            			echo'</td>
            				<td> <input type="checkbox" name="chek'.$tb_id.'" value="1" '.$checked.'></td>
            			
            			<td><!--RESPONSABLE-->
            				
            				<div>
            				<table width="100%" border="0" style="font-size: 9px;">
            				<tbody>
            				<tr>';
            				$x=1;
            				foreach($funcionario as $i){
                                          $rut = $i->rut;
                                          $checked_fun="";

                                          $fun_tb= $this-> model_trabajos ->fun_realiza_tb($rut,$tb_id);
                                          if (!empty($fun_tb)) {
                                                 $checked_fun="checked";
                                          }


            					echo'<td style="vertical-align: middle;text-transform: capitalize;text-align: center;">
            					<label><input type="checkbox" name="'.$tb_id.'fun[]"  value="'.$i->rut.'" style="margin-right:5px;" '.$checked_fun.'> '.$i->paterno.'</label>
            					</td>';
            					/*if(4==$x){
            						echo" </tr>";
            						$x=0;
            					}*/
            					$x++;
            				}
            				echo'</tr></tbody></table>
            			  
            			    </div>
            			</td>';


            			echo'
            			
            			<td><textarea name="desc'.$tb_id.'" id="" cols="30" rows="10" style="    height: 40px;"></textarea></td>
            			

            			</tr>';
            			# code...
            		}

            		echo'</tbody>
            	    </table>
            	    <input type="submit" name="submit" id="submit" value="Guardar" class="btn btn-success"></div>';
	}

	function guardar(){	
		$fecha = $this->input->post('txt_fecha');
		$trabajos = $this -> model_trabajos->trabajos_fecha($fecha);
		foreach ($trabajos as $t) {
			$tb_id = $t -> tb_id;
                  $tb_estado = $t -> tb_estado;
                  $tb_sctg_id = $t -> tb_sctg_id;
                  $tb_ctg_id = $t -> tb_ctg_id;
			$realizado = $this->input->post('chek'.$tb_id.'');
			$descripcion = $this->input->post('desc'.$tb_id.'');
                  $funcionario = $this->input->post(''.$tb_id.'fun');
			if(isset($realizado)){/* trabajo realizado*/
                        $data = array('tb_descripcion' => $descripcion,
					        'tb_tipo_responsable' => 1,
					       'tb_estado' => 1);
                        $this -> model_trabajos -> update_trabajo($tb_id,$data);
                        if((isset($funcionario)) && ($tb_estado == 0)){
                              foreach ($funcionario as $f) {
                                    $id_fun = $f;
                                    $datafun = array(
                                          'funcioanrio' => $id_fun,
                                          'trabajo' => $tb_id,
                                          'sctg_id' => $tb_sctg_id,
                                          'ctg_id' => $tb_ctg_id);
                                    $this -> model_trabajos -> funcionario_has_trabajos ($datafun);
                              }
                        }
                  }else{/* trabajo no realizado*/
                        $data = array('tb_descripcion' => $descripcion,
                                     'tb_estado' => 0,
                                     'tb_tipo_responsable' => "",);
                        $this -> model_trabajos -> update_trabajo($tb_id,$data);
                        $this -> model_trabajos -> delete_funtb($tb_id);
                  }
            }


            echo'
            <script type="text/javascript">
            $(document).ready(function() {

                  alert(“Guardado ”);

            });

            </script>';
       /* if($this->db->affected_rows() > 0){
		                $this->session->set_flashdata('category_success', 'Agregado exitosamente.');
		                redirect (base_url().'trabajos/disp_trabajo');
	                }else{echo'error';}	*/



	}	
}?>