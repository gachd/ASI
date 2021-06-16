<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class planificacion extends CI_Controller {

	function __construct() {
		 
        parent::__construct();
		$this->load->library('session');
		$this->load->model('model_turnos');
	    $this->load->helper('url');
	    $this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
	}
	
	
	public function index(){
		$data['turnos']=$this->model_turnos->getTurno();
		
		$this->load->view('plantilla/Head');
		$this->load->view('turnos/planificacion',$data);
		$this->load->view('plantilla/Footer');		
	}
	public function select_funcionario (){
			
			$tipo_fun  = $this->input->post('tipo_fun');
			
			if($tipo_fun <> 0 ){
				/*echo' <option value="0"> '.$ctg.'lllego</option>';*/
				echo'<option value="0">Todos</option>';
				$funcionario= $this -> model_turnos -> getFuncionarioTipo($tipo_fun);
				foreach($funcionario as $f){
				echo ' <option value="'.$f->rut.'" '.set_select("subcategoria",$f->rut).'>'.$f->nombre_fun.' '.$f->paterno.'</option>';
					}
					
			}else{
					echo' <option value="0"> Todos</option>';
				 }
	}
	function cargar(){

		$mes  = $this->input->post('mes');
		$year  = $this->input->post('year');
		$funcionario=$this->input->post('funcionario');
		$tipo_funcionario=$this->input->post('tipo_funcionario');
		
		/*echo 'funcionario:'.$funcionario.'<br>';
		echo 'tipo_funcionario:'.$tipo_funcionario.'<br>';
		echo 'year:'.$year.'<br>';
		echo 'mes:'.$mes.'<br>';*/
		$data_fun=$this -> model_turnos -> FuncionarioId($funcionario,$tipo_funcionario);
		$turnos=$this -> model_turnos -> getTurnoTipo($tipo_funcionario);

		/*echo $this->db->last_query();*/
		echo' 
        <div class="table-responsive">
		<table  class="table table-bordered table-hover tb_planificacion">
		    <thead>
		    <tr>
            <th>Funcionario</th>';
        // TH DIAS
        $numero = cal_days_in_month(CAL_GREGORIAN, $mes, $year);
        setlocale(LC_ALL, 'es_ES').': ';
        for($i = 1; $i <= $numero; $i++) {
        	$fecha=''.$year.'-'.$mes.'-'.$i.'';
        	echo'<th>'.iconv('ISO-8859-1', 'UTF-8', strftime('%a',  strtotime("".$fecha.""))).' <br> '.iconv('ISO-8859-1', 'UTF-8', strftime('%d',  strtotime("".$fecha.""))).'</th>';
        }
        echo'</thead>
            <tbody>';
            
       foreach ($data_fun as $df) {

       	   
        	echo'<tr>
        	<td style="width: 100px;">'.substr($df -> nombre_fun, 0, 1).'. '.$df->paterno.'</td>';
        	for($i = 1; $i <= $numero; $i++) {
        		$color="";
		$turno_asignado="";
                $fechab="".$year."-".$mes."-".$i."";
                $rut=$df->rut;
                $turno_funcionario_dia=$this-> model_turnos-> turno_funcionario_dia($fechab,$rut);
                
                if(!empty($turno_funcionario_dia)){
                	foreach ($turno_funcionario_dia as $tfd) {
                	$turno_asignado= $tfd-> turno;
                	$color = $tfd -> color;
                    }
                }

             
             
                echo'<td>
                
                <select id="turnos" name="turno'.$df->rut.''.$i.'" style="background:'.$color.'">
                <option value=""></option>';

                foreach ($turnos as $t) {
                	$selected="";
                	$id_turno=$t->t_id;

                	if($turno_asignado == $id_turno){
                	$selected="selected";
                	}
                echo'<option style="background:'.$t->color.'" id="'.$t->sigla.'" value="'.$t->t_id.'" name="'.$t->t_id.'-'.$i.'" '.$selected.' class="'.$t->sigla.'">'.$t ->sigla.'</option>';
                }
                echo'
                </select>
                </td>';

            }
        	echo'</tr>';
        	
        }
            echo'</tbody>
            </table>
            <input type="submit" name="submit" id="submit" value="Guardar" class="btn btn-success">
            </div>';
	}

	function guardar(){
		$mes  = $this->input->post('mes');
		$year  = $this->input->post('year');
		$funcionario=$this->input->post('funcionario');
		$tipo_funcionario=$this->input->post('tipo_funcionario');
		$data_fun=$this -> model_turnos -> FuncionarioId($funcionario,$tipo_funcionario);
		$this -> model_turnos -> delet_plan_turno($mes,$tipo_funcionario,$year,$funcionario);

		$a=$this->db->last_query();
		//$turnos=$this -> model_turnos -> getTurnoTipo($tipo_funcionario);
		$numero = cal_days_in_month(CAL_GREGORIAN, $mes, $year);
		foreach ($data_fun as $df) {
			$selected="";
			for($i = 1; $i <= $numero; $i++) {
				$turno=$this->input->post('turno'.$df->rut.''.$i.'');
				if(!empty($turno)){
					$data = array(
                    'fecha' => ''.$year.'-'.$mes.'-'.$i.'',
					'funcionario' => $df->rut,
					'tipo_funcionario' => $df->tipo,
					'turno' =>$turno,
					'usuario' => $this->session->userdata('id')				
                    );
                /*echo('<pre>');var_dump($data);echo('</pre>');*/
                /*INSERTO turnos funcioncionario*/	
				$this -> model_turnos -> insertar_turno($data);
				
				}
			}

		}

		/*echo $funcionario;
		echo "<br>";
		echo $a;*/
		if($this->db->affected_rows() > 0){
		                $this->session->set_flashdata('category_success', 'Agregado exitosamente.');
		                redirect (base_url().'turnos/planificacion');
	                }else{echo'error';}


	}
}	

?>