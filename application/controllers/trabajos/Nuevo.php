<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class nuevo extends CI_Controller
{

	function __construct()
	{

		parent::__construct();
		$this->load->library('session');
		$this->load->model('model_trabajos');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('calendar');
		$this->load->library('session');
	}


	public function index()
	{

		$date  = "";
		$data['query'] = $this->model_trabajos->getAll($date);
		$data['trabajos']	= $this->model_trabajos->getAllWORK($date);
		// COMBO CATEGORIA
		$data['categorias'] = $this->model_trabajos->getCategorias();
		$data['subcategorias'] = $this->model_trabajos->getSubcate();
		$data['depend'] = $this->model_trabajos->getDepen();
		$data['funcionario'] = $this->model_trabajos->getFuncionario();


		$data['sectores'] = $this->model_trabajos->getSector();
		$this->load->view('plantilla/Head');
		$this->load->view('trabajos/index', $data);
		$this->load->view('plantilla/Footer');
	}


	function activFecha()
	{
		$date  = $this->input->post('txt_fecha');
		$queryActv = $this->model_trabajos->getAll($date);
		/*echo 'llego'.$date.'';*/
		$dias = array("DO", "LU ", "MA ", "MI ", "JU", "VI", "SA");
		$meses = array(
			'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
			'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
		);

		echo '
								  <div class="col-lg-12" id="activ_fechas">
                   ';
		$diasB = array("Domingo", "Lunes ", "Martes ", "Miercoles ", "Jueves", "Viernes", "Sabado");

		$semana_select = $diasB[date("w", strtotime($date))];
		$mes_select = $meses[(date("m", strtotime($date)) - 1)];
		$dia_select = date("d", strtotime($date));

		$num_sem_select = date("W", strtotime($date));
		$sumado = 0;

		foreach ($queryActv as $a) {

			$sumado += $a->act_nprsns;
		}


		echo ' <h2>
								   
								   ' . $semana_select . ' ' . $dia_select . ' ' . $mes_select . ' - ' . $sumado . ' prsns</h2>';



		echo '<div class="table-responsive" >
								 
								 <table id="example"  class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Inicio</th>
                                        <th>Termino</th>
                                        <th>Categoria</th>
                                        <th>Subcategoria</th>
										<th>Descripción</th>                 
                                        <th>Responsable</th>
										<th>Dependencia</th>  
                                         <th>N° Prsns	</th>
										 <th>xx</th>
										
                                    </tr>
                                </thead>
                                <tbody>
                                ';
		$n = 0;
		foreach ($queryActv as $i) {

			$semana = $dias[date("w", strtotime($i->act_fecha))];
			$dia = date("d", strtotime($i->act_fecha));

			$num_sem = date("W", strtotime($i->act_fecha));

			$num_sem_hoy = date("W");

			$categoria = $i->act_ctg_id;
			$class = 'class="blanco"';

			switch ($categoria) {
				case 1:
					$class = 'class="warning"';
					break;
				case 3:
					$class = 'class="verde"';
					break;
			}


			$n++;
			echo '  <tr ' . $class . '>
                                        <td>' . $n . '</td>
										
                                        <td>' . date("H:i", strtotime($i->act_inicio)) . '</td>
                                        <td>' . date("H:i", strtotime($i->act_inicio)) . '</td>
                                        <td>' . $i->ctg_nombre . '</td>
                                        <td>' . $i->sctg_nombre . '</td>
										<td>' . $i->act_evento . '</td>
										<td>' . $i->act_responsable . '</td>
                                        <td>';

			$dep = $this->model_trabajos->getDepenciaAct($i->act_id);

			foreach ($dep as $d) {
				echo '' . $d->dep_nombre . ' <br>';
			}

			echo '</td>
										
										<td>' . $i->act_nprsns . '</td>
									 <td>&nbsp;</td>';

			echo ' </tr>';
		}




		$trabajos = $this->model_trabajos->getAllWORK($date);

		foreach ($trabajos as $t) {

			$semanat = $dias[date("w", strtotime($t->tb_fecha))];
			$diat = date("d", strtotime($t->tb_fecha));

			$num_semt = date("W", strtotime($t->tb_fecha));

			$num_sem_hoyt = date("W");

			$n++;

			$class = 'class="azul"';
			if ((date("N", strtotime($t->tb_fecha)) == 6) or (date("N", strtotime($t->tb_fecha)) == 7)) {

				$class = 'class="danger"';
			}

			echo '  <tr ' . $class . '>
                                        <td>' . $n . '</td>
                                        <td>' . date("H:i", strtotime($t->tb_inicio)) . '</td>
                                        <td>' . date("H:i", strtotime($t->tb_termino)) . '</td>
                                        <td>' . $t->ctg_nombre . '</td>
                                        <td>' . $t->sctg_nombre . '</td>
										<td>' . $t->tb_descripcion . '</td>

                                        <td>';
			/*responsable*/

			if ($t->tb_tipo_responsable  == 1) {

				$id_work = $t->tb_id;
				$fun_work = $this->model_trabajos->getFuncionarioWORK("" . $id_work . "");
				//var_dump( $fun_work);
				foreach ($fun_work  as $fw) {
					echo '' . $fw->nombre_fun . ' ' . $fw->paterno . '</br>';
				}
			} else {

				echo $t->tb_responsable;
			}

			echo '</td>
                                        <td>';

			/*dependencia*/

			$id_work = $t->tb_id;
			$fun_work = $this->model_trabajos->getDepWORK("" . $id_work . "");
			//var_dump( $fun_work);
			foreach ($fun_work  as $fw) {
				echo '' . $fw->dep_nombre . '</br>';
			}

			echo '</td>
										<td></td>
									 <td>';
			if ($num_semt >= $num_sem_hoyt) {
				echo ' <button type="button" class="btn-editar" data-toggle="modal" href="#myModal" id="' . $id_work . '" onClick="selPersona(\'' . $t->tb_descripcion . '\',\'' . $t->tb_fecha . '\',\'' . $t->tb_inicio . '\',\'' . $t->tb_termino . '\',\'' . $t->tb_responsable . '\',\'' . $t->ctg_id . '\',\'' . $t->sctg_id . '\',\'' . $fw->dependencia . '\',\'' . $t->tb_id . '\',\'' . $t->tb_tipo_responsable . '\');"></button> &nbsp;
<button type="button" class="eliminar" onclick="if( confirm(\'¿Seguro?\')){location.href=\'' . base_url() . 'trabajos/nuevo/eliminar/' . $t->tb_id . '\';}"></button>
 </td>';
			}
			echo ' </tr>';
		}






		echo ' </tbody>
                            </table>
							
							</div>    
                   
              </div>';
	}

	public function newtrabajo()
	{

		$this->form_validation->set_error_delimiters('<div class="error alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');

		$this->form_validation->set_rules('txt_fecha', '', 'required');
		$this->form_validation->set_rules('txt_inicio', '', 'required');
		$this->form_validation->set_rules('txt_termino', '', 'required');
		$this->form_validation->set_rules('txt_cantidad', '', 'integer');
		$this->form_validation->set_rules('categoria', '', 'required');
		/*$this -> form_validation -> set_rules('dep','','required');*/

		if ($this->form_validation->run() === false) {
			//ERROR
			$this->load->view('plantilla/head');
			$this->load->view('plantilla/footer');
			//ACTIVIDADES-FECHA
			$date  = $this->input->post('txt_fecha');
			$data['query'] = $this->model_trabajos->getAll($date);
			// COMBO CATEGORIA
			/*$data['query'] = $this -> model_trabajos -> getAll();*/
			$data['categorias'] = $this->model_trabajos->getCategorias();
			$data['depend'] = $this->model_trabajos->getDepen();
			$data['funcionario'] = $this->model_trabajos->getFuncionario();


			$this->load->view('trabajos/index', $data);
		} else {
			//OK
			date_default_timezone_set("Chile/Continental");
			$hoy = date("Y-m-d H:i:s");
			$fecha_termino = $this->input->post('txt_fecha_termino');
			if (empty($fecha_termino)) {
				$fecha_termino = $this->input->post('txt_fecha');
			}
			$data = array(
				'tb_descripcion' => $this->input->post('txt_descripcion'),
				'tb_fecha' => $this->input->post('txt_fecha'),
				'tb_fecha_termino' => $fecha_termino,
				'tb_inicio' => $this->input->post('txt_inicio'),
				'tb_termino' => $this->input->post('txt_termino'),
				'tb_responsable' => $this->input->post('txt_responsable'),
				'tb_tipo_responsable' => $this->input->post('tipo_responsable'),
				'tb_ctg_id' => $this->input->post('categoria'),
				'tb_sctg_id' => $this->input->post('subcategoria'),
				'tb_planificado' => $this->input->post('s_planificado'),
				'tb_estado' => $this->input->post('s_realizado'),
				'tb_actualización' => $hoy,
				'usuario' => $this->session->userdata('id')
			);

			/*INSERT ACTIVIDAD*/

			$this->model_trabajos->insertar($data);

			/*ultima actividad*/

			$resmax = $this->model_trabajos->MaxTRAB();
			foreach ($resmax as $m) {
				$id = $m->tb_id;
			}
			/*INSERT DEPENDENCIA*/

			$depen = $this->input->post('dep');
			/* var_dump($fun);*/
			if (!empty($depen)) {
				foreach ($depen as $d) {
					/*echo ''.$valor.'<br>';*/

					$dep = array(
						'trabajo' => $id,
						'dependencia' => $d,
						'ctg_id' => $this->input->post('categoria'),
						'sctg_id' => $this->input->post('subcategoria'),
					);

					$this->model_trabajos->InserDep($dep);
				}
			}


			/*INSERTAR FUNCIONARIO*/

			if ($this->input->post('tipo_responsable') == 1) {
				$fun = $_POST['fun'];
				/* var_dump($fun);*/
				if (!empty($fun)) {
					foreach ($fun as $valor) {
						/*echo ''.$valor.'<br>';*/

						$trabajo_fun = array(
							'trabajo' => $id,
							'funcioanrio' => $valor,
							'ctg_id' => $this->input->post('categoria'),
							'sctg_id' => $this->input->post('subcategoria')
						);

						$this->model_trabajos->funcionario_has_trabajos($trabajo_fun);
					}
				}
			}


			/*INSERTAR PLANIFICACION*/
			$planificacion = array(
				'tipo' => "1",
				'fecha' =>  $this->input->post('txt_fecha'),
				'trabajos' => $id
			);

			$this->model_trabajos->planificacion($planificacion);




			//ACTIVIDADES-FECHA
			$date  = $this->input->post('txt_fecha');
			$data['query'] = $this->model_trabajos->getAll($date);
			redirect(base_url() . 'trabajos/nuevo');
		}
	}
	public function fillsubcategorias()
	{

		$ctg  = $this->input->post('micategoria');

		if ($ctg <> 0) {
			/*echo' <option value="0"> '.$ctg.'lllego</option>';*/
			$subcatg = $this->model_trabajos->getsubcategoria($ctg);
			foreach ($subcatg as $fila) {
				echo ' <option value="' . $fila->sctg_id . '" ' . set_select("subcategoria", $fila->sctg_id) . '>' . $fila->sctg_nombre . '</option>';
			}
		} else {
			echo ' <option value="0"> Seleccionar</option>';
		}
	}
	public function funwork()
	{

		echo 'llego';

		$work = $this->input->post('idwork');
		$fun_work = $this->model_trabajos->getFuncionarioWORK($work);
		$funcionarios = $this->model_trabajos->getFuncionario();
		$trabajo = $this->model_trabajos->getTrabajos($work);

		$chek1 = '';
		$chek2 = '';
		$div1 = '';
		$div2 = '';
		foreach ($trabajo as $t) {

			$tipo = $t->tb_tipo_responsable;
			$res = $t->tb_responsable;
		}



		echo '  <div class="col-md-12" >
				
				                <div class="panel panel-default" >
								<div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-group fa-fw"></i> Responsable</h3>
                            </div>
<div class="panel-body">
                   <p>
                     <label>';

		if ($tipo == 1) {
			$chek1 = 'checked="checked"';
			$div2 = 'class="none"';
		} else {
			$chek2 = 'checked="checked"';
			$div1 = 'class="none"';
		}

		echo '
                       <input type="radio" name="edit_tipo_responsable" value="1" id="editfun" ' . $chek1 . '>
                       Funcionario</label>
                    &nbsp;
                     <label>
                       <input type="radio" name="edit_tipo_responsable" value="2" id="editext" ' . $chek2 . '>
                       Externo</label>
                     <br>
                   </p>
                   
                   <!-- input -->
                    <div class="col-md-12">    
                  
                <div id="editextDiv" ' . $div2 . ' >   
     <input class="form-control" type="text" name="edit_responsable" id="edit_responsable" value="' . $res . '">
				 </div>
                 
                 <div id="editfunDiv" ' . $div1 . '">';

		echo '<table width="100%" border="0">
  <tbody>
   ';
		echo ' <tr>';
		$x = 1;
		foreach ($funcionarios as $i) {

			$chek = "";
			foreach ($fun_work as $fw) {

				$rut = $fw->rut;
				if ($rut == $i->rut) {
					$chek = 'checked="checked"';
				};
			}
			echo '<td style=" vertical-align: middle;
    text-transform: capitalize;"><label><input type="checkbox" ' . $chek . ' name="edit_funcionario[]" style="margin-right:5px;" value="' . $i->rut . '" >' . $i->nombre_fun . ' ' . $i->paterno . '</label></td> ';


			if (2 == $x) {
				echo " </tr>";
				$x = 1;
			}

			$x++;
		}


		echo '</tbody>
</table>';

		echo '  </div> 
        </div>  <!-- fin input -->
		</div>
		</div>
                 </div>';
	}
	public function depwork()
	{
		echo '<div  class="col-md-12 ">
                
                <div class="panel panel-default" >
                                 <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-home fa-fw"></i> Dependencia</h3>
                            </div>

 <div class="panel-body">

		 <table width="100%" border="0">
  <tbody>
   
		 <tr>';

		$x = 1;
		$dependencia =  $this->model_trabajos->getDepen();
		$workdep = $this->input->post('idworkd');
		$depend = $this->model_trabajos->trabajos_has_dependencia($workdep);

		/*echo $workdep;
		var_dump($dependencia);*/


		foreach ($dependencia as $rows) {

			$chekdep = '';
			foreach ($depend as $dp) {

				$depwork = $dp->dependencia;
				if ($depwork == $rows->dep_id) {
					$chekdep = 'checked="checked"';
				};
			}

			/*echo ' <option value="'.$rows->dep_id_dc.'">'.$rows->dep_nombre.'</option>';*/

			echo '
				 
				<td><label class="css-label"><input type="checkbox" name="edit_dep[]"  value="' . $rows->dep_id . '"  class="css-checkbox" style="margin-right:3px;" ' . $chekdep . '>' . $rows->dep_nombre . ' </label></td>';
			if (3 == $x) {
				echo "</tr> ";
				$x = 0;
			}

			$x++;
		}

		echo '</tbody>
</table>		
       </div>
      </div>
    </div>
';
	}


	public function actualizar()
	{
		date_default_timezone_set("Chile/Continental");
		$hoy = date("Y-m-d H:i:s");
		$usuario = $_SESSION['id'];
		$work = $this->input->post('edit_id');
		$externo = "";
		$tipo_res = $this->input->post('edit_tipo_responsable');
		if ($tipo_res == 2) {
			$externo = $this->input->post('edit_responsable');
		}

		$array = array(
			'tb_descripcion' => $this->input->post('edit_txt_actividad'),
			'tb_fecha' => $this->input->post('edit_fecha'),
			'tb_inicio' => $this->input->post('edit_inicio'),
			'tb_termino' => $this->input->post('edit_termino'),
			'tb_responsable' => $externo,
			'tb_tipo_responsable' => $this->input->post('edit_tipo_responsable'),
			'tb_ctg_id' => $this->input->post('edit_categoria'),
			'tb_sctg_id' => $this->input->post('edit_subcategoria'),
			'tb_actualización' => $hoy,
			'usuario' => $usuario
		);

		/*echo $work;
				echo var_dump($array);*/
		$this->model_trabajos->eliminar_dep($work);
		$this->model_trabajos->eliminar_fun($work);
		$this->model_trabajos->eliminar_plan($work);
		$this->model_trabajos->actualizar($array, $work);




		//INSERT DEPENDENCIA

		$depen = $this->input->post('edit_dep');
		// var_dump($fun);
		if (!empty($depen)) {
			foreach ($depen as $d) {

				$work = $this->input->post('edit_id');
				$dep = array(
					'trabajo' => $work,
					'dependencia' => $d,
					'ctg_id' => $this->input->post('edit_categoria'),
					'sctg_id' => $this->input->post('edit_subcategoria'),
				);

				$this->model_trabajos->InserDep($dep);
			}
		}


		//INSERTAR FUNCIONARIO

		if ($this->input->post('edit_tipo_responsable') == 1) {
			$fun = $_POST['edit_funcionario'];

			/*var_dump($fun);*/

			if (!empty($fun)) {
				foreach ($fun as $valor) {

					$trabajo_fun = array(
						'trabajo' => $work,
						'funcioanrio' => $valor,
						'ctg_id' => $this->input->post('edit_categoria'),
						'sctg_id' => $this->input->post('edit_subcategoria')
					);

					$this->model_trabajos->funcionario_has_trabajos($trabajo_fun);
				}
			}
		}


		//INSERTAR PLANIFICACION
		$planificacion = array(
			'tipo' => "1",
			'fecha' =>  $this->input->post('edit_fecha'),
			'trabajos' => $work
		);

		$this->model_trabajos->planificacion($planificacion);






		/*	$this -> model_trabajos -> actualizardep($dep,$act);
					$this -> model_trabajos -> actualizarPlan($plan,$act);*/


		//redirect (base_url().'trabajos/nuevo');

	}


	//función para eliminar un mensaje dependiendo del id
	public function eliminar()
	{
		$id = $this->uri->segment(4);
		$this->model_trabajos->eliminar_dep($id);
		$this->model_trabajos->eliminar_fun($id);
		$this->model_trabajos->eliminar_plan($id);
		$this->model_trabajos->eliminar_tb($id);
		redirect(base_url() . 'trabajos/nuevo');
	}
}
