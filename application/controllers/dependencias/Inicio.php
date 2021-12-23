<?php
class inicio extends CI_Controller
{

	function __construct()
	{

		parent::__construct();
		$this->load->model('model_dependencias');
		$this->load->model('model_trabajos');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('mpdf60/Mpdf');
	}


	public function index()
	{
		$data['sector'] = $this->model_dependencias->getSector();
		//$data['tipo_vegetacion']=$this->model_dependencias->tipo_vegetacion();
		$this->load->view('plantilla/Head');
		$this->load->view('dependencias/inicio', $data);
		$this->load->view('plantilla/Footer');
	}
	/*IMPRIME LAS DEPENDENCIAS */
	function dependencias()
	{

		$sub_sector = $this->input->post('subsector');
		$sector = $this->input->post('sector');
		$todas = $this->model_dependencias->all_dependencias();


		if (!empty($sector)) {


			if ($sub_sector <> 0) {
				$subdep = $this->model_dependencias->getDepen_subsector($sub_sector);
			} else {
				$subdep = $this->model_dependencias->getDepen_sector($sector);
				/*echo $this->db->last_query();*/
			}
			if (empty($subdep)) {
				echo 'No registra Dependencias';
			} else {

				echo ' <table class="table table-hover tbl-dep" >
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
				foreach ($subdep as $sd) {
					echo '<tr>
						<td class="sub_dep" id="' . $sd->dep_id . '">' . $sd->dep_id . '</td>
						<td class="sub_dep" id="' . $sd->dep_id . '">' . $sd->dep_nombre . '</td>
						<td class="sub_dep" id="' . $sd->dep_id . '">';
					$id_subdep = $sd->dep_id;
					/*tipo dependencia*/
					$tipo_subdepen = $this->model_dependencias->getTipoDepen($id_subdep);

					if (!empty($tipo_subdepen)) {
						foreach ($tipo_subdepen as $t) {
							$categoria = "";

							switch ($t->tipo) {

								case  1:
									$categoria = '<span class="label label-success">' . $t->nom_tipo . '</span>';
									break;

								case 2:
									$categoria = '<span class="label label-primary">' . $t->nom_tipo . '</span>';
									break;

								case 3:
									$categoria = '<span class="label label-warning ">' . $t->nom_tipo . '</span>';
									break;
								case 4:
									$categoria = '<span class="label label-warning ">' . $t->nom_tipo . '</span>';
									break;
							}

							echo $categoria . '<br>';
						}
					}
					/* boton eliminar */
					echo '</td>
					 <td>
					 
					 <button type="button" class="btn btn-default btn-xs eliminar"  id="' . $sd->dep_id . '"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
					 
					</td>

					</td>
						   <td>
					 <button type="button" class="btn btn-default btn-xs editar"  id="' . $sd->dep_id . '">
					  <span class="glyphicon glyphicon-cog" aria-hidden="true"></span></button>
					</td>
					 
					 ';
					foreach ($todas as $objeto) {


						if ($sd->dep_id == $objeto->dependencia) {
							/* boton actualizar */
						}
					}
				}
			}
		} else {

			$todas = $this->model_dependencias->all_dependencias();
			






			echo 'error';
		}
	}

	function contenedor_dependencia()
	{
		$sd  = $this->input->post('id');
		$medidas = $this->model_dependencias->medidas_dependencia($sd);
		foreach ($medidas as $m) {
			$ancho = $m->ancho;
			$largo = $m->largo;
			$alto = $m->alto;
			$mt2 = round($m->m_cuadrados, 2);
			$obs = $m->observaciones;
			$nombre_dep = $m->dep_nombre;
		}
		echo '<div class="card">
        <input type="hidden" value="' . $sd . '"  id="id_dep_report"/>
		<h2 class="titulo-dep">' . $nombre_dep . '<a href="#" title="Exportar PDF" id="r_dep"  ><button type="button" class="btn btn-info btn-sm" style="margin-left:15px;"><span class="glyphicon glyphicon-print"></span> FT. Dependencia</button></a></h1> 
                <ul class="nav nav-tabs"  role="tablist">
                    <li role="presentation"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">especificación tecnica</a></li>
                    
                    <li role="presentation"  class="active"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Mantención</a></li>
                    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
                    <li role="presentation"> <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Trabajos</a></li>
                </ul>
                <!-- Tab panes -->
         <div class="tab-content" style="overflow: auto;" >';

		//echo $sd;
		echo '<div role="tabpanel" class="tab-pane " id="home">
      	<div class="col-md-3">

      		
      		<table class="table">
							  <tbody>
							  <tr>
								  <td class="td_titulo">Ancho</td>
								  <td>' . $ancho . '</td></tr>
								  <tr>
								  <td  class="td_titulo">Largo</td>
								  <td>' . $largo . '</td></tr>
								  <tr>
								  <td  class="td_titulo">Alto</td>
								  <td>' . $alto . '</td>
								  </tr>
								  <tr>
								  <td  class="td_titulo">mt&sup2;</td>
								  <td> ' . $mt2 . ' </td>
								  </tr>
								</tr>
							</tbody>
			</table>


      		</div>
      		<div class="col-md-9"><img src="' . base_url() . 'assets/images/dependencias/' . $sd . '.jpg" alt="Smiley face" height="150" width="300"></div>';


		//CARACTERISTICAS
		$caract_dep = $this->model_dependencias->getCaract_dep($sd);
		$ic = 0;
		if (!empty($caract_dep)) {
			echo '<div class="col-md-12">
      	     <table class="table">
				<tbody>
				<tr>';
			foreach ($caract_dep as $cd) {
				$ic++;
				echo '
				       <td class="td_titulo">' . $cd->c_nombre . '</td>
				       <td>' . $cd->detalle . '</td>';
				if ($ic % 2 == 0) {
					echo '</tr>';
				}
			}
			echo '</tbody>
			</table>
			</div>';
		} else {
			echo "no registra caracteristicas";
		}

		if (empty($obs)) {
			$obs = "no se registran";
		}
		echo '<div class="col-md-12">
      	     <table class="table">
				<tbody> 
				  <tr>
				     <td class="td_titulo">Observaciones</td>
				     <td>' . $obs . '</td>
				  </tr>

				</tbody>
			  </table>
			  </div>';





		echo '</div>';



		/**TRABAJOS***/
		echo '<div role="tabpanel" class="tab-pane active" id="profile" style="overflow: auto;">
             <div class="col-md-12">
                      <div class="panel panel-default"  style="min-height: 180px;">
                          <div class="panel-heading"  style=" display: table;">
                              <div class="hijo select_buscar">
            <label for="select" class="input-sm">Categoria:</label>
             <select class="form-control input-xs" name="categoria" id="categoria">
                <option value="0"> Selccionar </option>';
		$categorias = $this->model_trabajos->getCategorias();
		foreach ($categorias as $i) {
			echo ' <option value="' . $i->ctg_id . '" ' . set_select("categoria", $i->ctg_id) . '>' . $i->ctg_nombre . '</option>';
		}

		echo '</select>
        </div>
        <div class="hijo select_buscar">
            <label for="select2" class="input-sm">Sub-Categoria:</label>
            <select class="form-control input-xs" name="subcategoria" id="subcategoria">
                <option value="0"> Selccionar </option>
            </select>


        </div>
        <div class="hijo"><button type="button" class="btn btn-xs" id="buscar">Buscar</button></div>
        <a href="#" title="Exportar Trabajos" id="r_work"><button type="button" class="btn btn-info btn-sm" style="margin-left:15px;"><span class="glyphicon glyphicon-print"></span> R. Trabajos</button></a>

                          </div>
                           <div class="panel-body" id="work_buscados">
    <table class="table table-bordered table-sm work_buscados" width="700" border="0">
    <thead>
      <tr class="table-info">
      <th>fecha</th>
      <th>Duración</th>
      <th>categoria</th>
      <th>sub-categoria</th>
      <th>observaciones</th>
      <th>responsable</th>
      </tr>
    </thead>
    <tbody>';

		$trabajos = $this->model_trabajos->trabajos_dependencia($sd, 0);


		if (!empty($trabajos)) {
			if ($t->tb_fecha_termino < $t->tb_fecha) {
				$duracion = "";
			} else {
				$duracion = ($t->duracion + 1) . 'día';
			}
			foreach ($trabajos as $t) {
				setlocale(LC_ALL, 'es_ES') . ': ';
				echo ' <tr>
      <td>' . iconv('ISO-8859-1', 'UTF-8', strftime('%d/%b/%Y',  strtotime("" . $t->tb_fecha . ""))) . '</td>
      <td>' . $duracion . '</td>
      <td>' . $t->ctg_nombre . '</td>
      <td>' . $t->sctg_nombre . '</td>
      <td>' . $t->tb_descripcion . '</td>
      <td>';
				$operarios = $this->model_trabajos->getFuncionarioWORK($t->tb_id);
				if (!empty($operarios)) {
					foreach ($operarios as $o) {
						echo $o->nombre_fun . ' ' . $o->paterno . '<br>';
					}
				} else {
					echo $t->tb_responsable;
				}

				echo '</td></tr>';
				# code...
			}
		}


		echo '
   
   
                                </tbody>
                              </table>
                           </div>
                      </div>
            </div>';
		echo '</div>';

		//PLANIFICACION MANTENIMIENTO
		echo ' <div role="tabpanel" class="tab-pane " id="messages">';
		$pl_mant_subcat = $this->model_dependencias->sub_pl_temp($sd);
		//echo $this-> db -> last_query();


		echo '
		<div class="panel panel-default col-md-12">
            <div class="panel-heading">mantencion Recomendada</div>
            <div class="panel-body">
                <table class="table table-bordered">
                <thead>
                 <tr>
                 <th scope="col">Categoria</th>
                  <th scope="col">Tipo Trabajo</th>
                  <th scope="col">Temp. Baja</th>
                  <th scope="col">Temp. Alta</th>
                  <th scope="col">Ultima vez <br> realizado</th>
                  <th scope="col">días transc</th>
                  </tr>
                </thead>
                <tbody>';

		foreach ($pl_mant_subcat as $pl_sb) {
			$id_sub = $pl_sb->pl_subcategoria;
			echo '<tr>
                    	<td>' . $pl_sb->ctg_nombre . '</td>
                    	<td> ' . $pl_sb->sctg_nombre . '</td>';
			//TEMPORADA BAJA
			$plmant1 = $this->model_dependencias->pl_temp($sd, $id_sub, 1);
			if (!empty($plmant1)) {
				foreach ($plmant1 as $uno) {
					echo '<td>' . $uno->pl_cantidad . ' ' . $uno->abreviatura . '</td>';
				}
			} else {
				echo "<td>-</td>";
			}
			$plmant2 = $this->model_dependencias->pl_temp($sd, $id_sub, 2);
			if (!empty($plmant2)) {
				foreach ($plmant2 as $dos) {
					echo '<td>' . $dos->pl_cantidad . ' ' . $dos->abreviatura . '</td>';
				}
			} else {
				echo "<td>-</td>";
			}
			// dias transcurridos
			$dias_trans = $dias_transcurridos = $this->model_dependencias->dias_transcurridos($id_sub, $sd);
			//mes actual
			$mes = date("m");
			setlocale(LC_ALL, 'es_ES') . ': ';
			$periocidad_temp = "";
			if (!empty($dias_trans)) {
				//TEMPORADA ACTUAL
				if ($mes > 3 and $mes < 11) {
					/*BAJA*/
					$temporada = 1;
					$periocidad_temp = $uno->pl_periocidad;
				} else {
					/*ALTA*/
					$temporada = 2;
					$periocidad_temp = $dos->pl_periocidad;
				}

				foreach ($dias_trans as $dtrans) {
					$x = $dtrans->transcurrido;
					$txt_periocidad = "";
					$ndias_trans = $dtrans->transcurrido;
					switch ($periocidad_temp) {
						case '4': //semanal
							$ndias_trans = $ndias_trans / 7;
							if ($ndias_trans > 1) {
								$txt_periocidad = "semanas";
							} else {
								$txt_periocidad = "semana";
							}
							break;
						case '2'; //mensual
							$ndias_trans = $ndias_trans / 30;
							if ($ndias_trans > 1) {
								$txt_periocidad = "meses";
							} else {
								$txt_periocidad = "mes";
							}

							break;
						case '1'; //anual
							$ndias_trans = $ndias_trans / 365;
							if ($ndias_trans > 1) {
								$txt_periocidad = "años";
							} else {
								$txt_periocidad = "año";
							}
							break;
						default:
							if ($ndias_trans > 1) {
								$txt_periocidad = "dias";
							} else {
								$txt_periocidad = "día";
							}
							break;
					}

					echo '<td>' . iconv('ISO-8859-1', 'UTF-8', strftime('%d/%b/%Y',  strtotime("" . $dtrans->tb_fecha . ""))) . '</td><td>' . round($ndias_trans) . ' ' . $txt_periocidad . ' </td>';
				}
			} else {
				echo "<td>-</td><td>-</td>";
			}






			echo ' 
                       
                        </tr>';
		}
		echo '</tbody>
                </table>
                  

                <table class="detalle">
                <thead>
                <tr>';

		$query = $this->db->get('periocidad');
		foreach ($query->result() as $row) {
			echo '<td class="td-digla">' . $row->abreviatura . '</td>
                   <td>' . $row->periocidad . '</td>
                   <td>' . $row->descripcion . '</td>
                   </tr>';
		}

		echo '
                 
             

                </thead>
                <tbody></tbody>
                </table>
                 



            </div>
        </div>';
		echo '</div>';
		echo '
                <div role="tabpanel" class="tab-pane" id="settings">
                <div class="row" id="new_equipo"><button type="button" class="btn btn-primary btn-sm">Small button</button></div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passage..</div>';
		echo '</div> <!-- tab-content-->
        </div> <!-- card -->';
	}



	function trabajos_buscados()
	{
		$dep  = $this->input->post('dep');
		$sub  = $this->input->post('sub');
		//echo $dep.'-'.$sub;	
		$trabajos = $this->model_trabajos->trabajos_dependencia($dep, $sub);
		// var_dump($trabajos);
		if (!empty($trabajos)) {

			echo '<table class="table table-bordered table-sm work_buscados" width="700" border="0">
    <thead>
      <tr class="table-info">
      <th>fecha</th>
      <th>Duración</th>
      <th>categoria</th>
      <th>sub-categoria</th>
      <th>observaciones</th>
      <th>responsable</th>
      </tr>
    </thead>
    <tbody>';
			foreach ($trabajos as $t) {

				if ($t->tb_fecha_termino < $t->tb_fecha) {
					$duracion = "";
				} else {
					$duracion = ($t->duracion + 1) . 'día';
				}
				echo ' <tr>
      <td>' . iconv('ISO-8859-1', 'UTF-8', strftime('%d/%b/%Y',  strtotime("" . $t->tb_fecha . ""))) . '</td>

      <td>' . $duracion . '</td>
      <td>' . $t->ctg_nombre . '</td>
      <td>' . $t->sctg_nombre . '</td>
      <td>' . $t->tb_descripcion . '</td>
      <td>';

				$operarios = $this->model_trabajos->getFuncionarioWORK($t->tb_id);
				if (!empty($operarios)) {
					foreach ($operarios as $o) {
						echo $o->nombre_fun . ' ' . $o->paterno . '<br>';
					}
				} else {
					echo $t->tb_responsable;
				}


				echo '</td></tr>';
			}
			echo '</tbody>
       </table>';
		} else {
			echo "<p>No se registran trabajos en esta categoria</p>";
		}
	}


	function select_subsector()
	{
		$sector  = $this->input->post('sector');
		$sub_sector = $this->model_dependencias->getSub_sector($sector);
		echo '<option value=""> Todos </option>';
		foreach ($sub_sector as  $s) {
			echo ' <option value="' . $s->id . '" ' . set_select("sector", $s->did) . '>' . $s->nombre . '</option>';
		}
	}
	function select_dependencia()
	{
		$subsector  = $this->input->post('subsector');
		$dependencia = $this->model_dependencias->getDepen_subsector($subsector);
		echo '<option value=""> Selccionar </option>';
		foreach ($dependencia as  $d) {
			echo ' <option value="' . $d->dep_id . '" ' . set_select("sector", $d->dep_id) . '>' . $d->dep_nombre . '</option>';
		}
		echo '<option value="0" style="color:red;"> NUEVO </option>';
	}

	function select_categoria_vegetacion()
	{
		$tipo_veg  = $this->input->post('tipo');
		$cat_veg = $this->model_dependencias->categoria_veg($tipo_veg);
		echo '<option value=""> Selccionar </option>';
		echo $tipo_veg;
		echo '<----->tipo <br>';
		$query = $this->db->last_query();
		echo $query;
		foreach ($cat_veg as  $cv) {
			echo ' <option value="' . $cv->vegcat_id . '" ' . set_select("sector", $cv->vegcat_id) . '>' . $cv->vegcat_categoria . '</option>';
		}
	}

	/*NUEVA DEPENDENCIA*/
	function nuevo()
	{
		/*$this->form_validation->set_error_delimiters('<div class="error alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>'); 	
		
		//insertar tabala subdependencia
		
		$this -> form_validation -> set_rules('subsector','','required');
		$this -> form_validation -> set_rules('depen','','required');
		$this -> form_validation -> set_rules('sector','','required');
		if($this -> form_validation -> run() === false){
		$data['sector']=$this->model_dependencias->getSector();
		$data['tipo_vegetacion']=$this->model_dependencias->tipo_vegetacion();
		$this->load->view('plantilla/Head');
		$this->load->view('dependencias/inicio',$data);
		$this->load->view('plantilla/Footer');	
			}
		else{*/

		$tipo = $_POST['chk_tipo'];
		$nom_subdep = $_POST['subdependencia'];
		$sector = $_POST['sector'];
		//$dependencia=$_POST['depen'];
		$subsector = $_POST['subsector'];
		$observaciones = $_POST['observaciones'];
		$ancho = $_POST['ancho'];
		$largo = $_POST['largo'];
		$alto = $_POST['alto'];
		$n_caract = $_POST['num_caracteristica'];
		$id_dep = "";
		/*if ($dependencia == 0){*/
		/*INSERT dependencia*/
		$data_dep = array(
			'dep_nombre' => $nom_subdep,
			'sub_sector' => $subsector,
			'sector' => $sector,
			'ancho' => $ancho,
			'largo' => $largo,
			'alto' => $alto,
			'observaciones' => $observaciones
		);
		$this->model_dependencias->insert_dependencias($data_dep);
		$ultimo = $this->model_dependencias->maxid();
		foreach ($ultimo as $u) {
			$id_dep = $u->max_id;
		}/* FIN busca ultimo id ingresado tabla subdependencia id_sd*/
		/*}*//*fin dependencia 0*/
		//else{$id_dep = $dependencia;}
		////INSERTO subdependencia-tipo
		foreach ($tipo as $t) {
			$tipo_sd = $t; //echo $tipo_sd;			
			$data_dep_tipo = array(
				'sub_sector' => $subsector,
				'dependencia' => $id_dep,
				'sector' => $sector,
				'tipo' => $tipo_sd
			);
			$this->model_dependencias->insert_dependencia_tipo($data_dep_tipo);
			$maxid_dep_tipo = $this->model_dependencias->maxid_tipo_dep();
			foreach ($maxid_dep_tipo as $m) {
				$dep_tipo = $m->max_id;
			}
		}/*termino de rrecorrer el tipo seleccionado en formulario*/

		//INSERTAR CARACTERISTICAS
		for ($i = 0; $i < $n_caract; $i++) {

			$caract = $_POST['caracteristica' . $i . ''];
			$txt_caract = $_POST['desc' . $i . ''];

			$data_caract = array(
				'id_dep' => $id_dep,
				'id_sub_sector' => $subsector,
				'id_sector' => $sector,
				'id_caracteristica' => $caract,
				'detalle' => $txt_caract
			);
			$this->model_dependencias->insert_caract_dep($data_caract);
		}
	}


	function eliminar()
	{
		$id = $_POST['trid'];
		/*$this -> model_dependencias -> deshabilitar_vegetacion($id);
		$this -> model_dependencias -> deshabilitar_instalacion($id);
		$this -> model_dependencias -> deshabilitar_recreacion($id);*/
		$this->model_dependencias->deshabilitar_dependencia($id);
		$this->session->set_flashdata('category_success', 'Eliminado correctamente.');
		echo '<script>location.href = "' . base_url() . 'dependencias/inicio"</script>';
	}

	/* ******************** RETORNA LOS DATOS DE LA VENTANA ********************** */
	/* ******************** RETORNA LOS DATOS DE LA VENTANA ********************** */
	/* ******************** RETORNA LOS DATOS DE LA VENTANA ********************** */

	/* ---------------------DATOS ACTUALIZAR -------------------------*/
	public function datosdepend()
	{
		$id = $this->input->post('trid');
		//echo "<h2>ID:".$id."</h2>";
		$dependencias = $this->model_dependencias->getdependencia($id);
		$sectores = $this->model_dependencias->getSector();
		$subsectores = $this->model_dependencias->getSub_sector($dependencias[0]->sector);
		/*$v_sec=$dependencias[0]->sector;
    $v_sub=$dependencias[0]->sub_sector;
    $todasdepend = $this -> model_dependencias -> alldepend($v_sec,$v_sub );
    */
		/*TIPO DE SECTOR*/
		$query_tipos = $this->db->get('dep_tipos');
		$tipo = $this->model_dependencias->tiporeturn($id);

		$selected = "";
		$habilitado = $dependencias[0]->dep_habilitado;
		echo '<div class="col-md-6 form-group">
   <label>Etado: <select class="form-control" name="habilitado_edit" id="habilitado_edit">';
		$estados = $this->db->get('dep_estado');
		foreach ($estados->result() as $row) {
			$id_hab = $row->id;
			if ($id_hab == $habilitado) {
				$selected = "selected";
			}
			echo '<option value="' . $row->id . '" ' . $selected . '>' . $row->estado . '</option>';
			$selected = "";
		}
		echo '</select></label></div>';
		echo '<div class="col-md-12 form-group"><label style="margin-right:15px;"><input type="hidden" id="id_dependencia" name="id_dependencia_edit" value="' . $id . '">';
		foreach ($query_tipos->result() as $row) {
			$check_tipo = "";
			if (!empty($tipo)) {
				foreach ($tipo as $object) {
					if ($object->tipo == $row->id) {
						$check_tipo = "checked";
					}
				}
			}
			echo ' <label><input type="checkbox" name="chk_tipo_edit[]" value="' . $row->id . '" ' . $check_tipo . '> ' . $row->nom_tipo . '</label>';
		}

		/***sector y subdependencia , nombre medidas****/
		echo '</div>
	 <!-- SECTOR -->
          <div class="col-md-6 form-group" >
            <label for="select">Sector:</label>
            <input type="hidden" name="sector_edit" value="' . $dependencias[0]->sector . '"/>
            <select class="form-control" disabled>
            <option value=""> Selccionar </option>
            <option value="0"> Selccionar </option>';
		foreach ($sectores as  $se) {
			if ($se->id == $dependencias[0]->sector) {
				echo '
                    <option selected value="' . $se->id . '" ' . set_select("sector", $se->id) . '>' . $se->nombre . '</option>
                    ';
			} else {
				echo ' 
                    <option value="' . $se->id . '" ' . set_select("sector", $se->id) . '>' . $se->nombre . '</option>';
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
            <input type="hidden" name="subsector_edit" value="' . $dependencias[0]->sub_sector . '"/>
            <select class="form-control" disabled>
            <option value=""> Selccionar </option>
            ';
		foreach ($subsectores as  $sub) {
			if ($sub->id == $dependencias[0]->sub_sector) {
				echo '
            <option selected value="' . $sub->id . '" ' . set_select("subsector", $sub->id) . '>' . $sub->nombre .
					'</option>
            ';
			} else {


				echo ' 
            <option value="' . $sub->id . '" ' . set_select("subsector", $sub->id) . '>' . $sub->nombre . '</option>
            ';
			}
		}

		echo
		'
            </select>
          </div>
          <!-- NOMBRE DEPENDENCIA -->

          <div class="col-md-6 form-group">
            <label for="nombre_edit">Nombre:<input type="text" name="nombre_edit" id="nombre_edit"  class="form-control" maxlength="50" value="' . $dependencias[0]->dep_nombre . '"></label>

          </div>
          
          <!-- MEDIDAS -->
          <div class="col-md-6">';

		/* -----------medidas ---------*/
		echo '
             <label for="ancho_edit">
             Ancho:
             <input type="text" name="ancho_edit" id="ancho_edit" style="width:70px;" class="form-control" 
             value="' . $dependencias[0]->ancho . '" >
             </label>

             <label for="largo_edit">
             Largo:
             <input type="text" name="largo_edit" id="largo_edit" style="width:70px;" class="form-control" 
             value="' . $dependencias[0]->largo . '">
             </label>
             <label for="alto_edit">
             Alto:
             <input type="text" name="alto_edit" id="alto_edit" style="width:70px;" class="form-control" 
             value="' . $dependencias[0]->alto . '">
             </label>';
		echo '</div>';

		//****CARACTERISTICAS*****
		echo '<div class="col-md-12">
          <label>Caracteristicas:</label>';

		$caract_depend = $this->model_dependencias->getCaract_dep($id);
		$caracteristicas = $this->model_dependencias->getCaracteristicas();
		//var_dump($caract_depend);
		$count = 0;
		foreach ($caract_depend as $cd) {

			echo '<div class="row" id="divcarct' . $cd->id_caracteristica . '" style="margin-bottom:5px;"><select class="caracteristica form-control select-car" name="edit_caract' . $count . '">
        	    <option value="' . $cd->id_caracteristica . '">' . $cd->c_nombre . '</option>';


			foreach ($caracteristicas as $c) {
				echo '<option value="' . $c->c_id . '">' . $c->c_nombre . '</option>';
			}
			echo '</select>
            <input type="text" style="width: 60%;" value="' . $cd->detalle . '" name="desc_edit' . $count . '" class="form-control text-car">
            <button type="button" class="btn btn-default btn-xs delete_caeact" id="' . $cd->id_caracteristica . '"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
        	</div>';

			$count++;
		}
		echo '
        <input type="hidden" id="ultimo" value="' . $count . '"/>
        </div>
        <div class="col-md-12">
            <label><strong>Agregar Caracteristicas:</strong>
            <select name="num_caract_edit" class="form-control" id="num_caract_edit" onchange="select_edit_caracteristicas(this)">
              <option value="0">Seleccionar...</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
            </select>
            </label>
            </div>
            <div class="col-md-12">
                <div id="cajas_edit"></div>
                
                
            </div>
          ';
		/******<OBSERVACIONES>********/

		echo '
           <div class="col-md-12">
          <label for="observaciones_edit">Observaciones:
          </label>
          <textarea style="width:100%; min-height:160px; margin-top:15px;" name="observaciones_edit"
           >' . $dependencias[0]->observaciones . '</textarea></div>
      
      </div>
     	 ';
	}


	public function actualizar()
	{
		$id_dep = $this->input->post('id_dependencia_edit');
		$sector_edit = $this->input->post('sector_edit');
		$subsector_edit = $this->input->post('subsector_edit');
		$tipo_editar = $this->input->post('chk_tipo_edit[]');
		$nombre_edit = $this->input->post('nombre_edit');
		$ancho_edit = $this->input->post('ancho_edit');
		$largo_edit = $this->input->post('largo_edit');
		$alto_edit = $this->input->post('alto_edit');
		$observaciones_edit = $this->input->post('observaciones_edit');
		$habilitado_edit = $this->input->post('habilitado_edit');
		$result = "";
		$data_update_dep = array(
			'dep_nombre' => $nombre_edit,
			'ancho' => $ancho_edit,
			'largo' => $largo_edit,
			'alto' => $alto_edit,
			'observaciones' => $observaciones_edit,
			'dep_habilitado' => $habilitado_edit
		);
		$this->model_dependencias->actualiza_dependencia($id_dep, $data_update_dep);
		$this->model_dependencias->eliminar_dependencias_tipo($id_dep);
		foreach ($tipo_editar as $te) {
			$data_dep_tipo = array(
				'tipo' => $te,
				'dependencia' => $id_dep,
				'sub_sector' => $subsector_edit,
				'sector' => $sector_edit,
			);
			$this->model_dependencias->insert_dependencias_tipo($data_dep_tipo);
			$result .= "actualizo dependencia";
		}

		$this->model_dependencias->eliminar_caracteristicas_dep($id_dep);
		//INSERTAR CARACTERISTICAS
		for ($i = 0; $i <= 12; $i++) {

			if ((!empty($_POST['edit_caract' . $i . ''])) && (!empty($_POST['desc_edit' . $i . '']))) {
				$caract = $_POST['edit_caract' . $i . ''];
				$txt_caract = $_POST['desc_edit' . $i . ''];

				if ((!empty($caract)) && (!empty($txt_caract))) {
					$data_caract = array(
						'id_dep' => $id_dep,
						'id_sub_sector' => $subsector_edit,
						'id_sector' => $sector_edit,
						'id_caracteristica' => $caract,
						'detalle' => $txt_caract
					);
					$this->model_dependencias->insert_caract_dep($data_caract);
					$result .= "actualizo caracteristicas";
				}
			}
		}


		//NUEVAS CARACTERISTICAS
		for ($i = 0; $i <= 12; $i++) {

			if ((!empty($_POST['new_edit_caract' . $i . ''])) && (!empty($_POST['txt_crt_edit' . $i . '']))) {
				$newcaract = $_POST['new_edit_caract' . $i . ''];
				$newtxt_caract = $_POST['txt_crt_edit' . $i . ''];
				if ((!empty($newcaract)) && (!empty($newtxt_caract))) {
					$data_newcaract = array(
						'id_dep' => $id_dep,
						'id_sub_sector' => $subsector_edit,
						'id_sector' => $sector_edit,
						'id_caracteristica' => $newcaract,
						'detalle' => $newtxt_caract
					);
					$this->model_dependencias->insert_caract_dep($data_newcaract);
					$result .= "actualizo nuevas caracteristicas";
				}
			}
		}

		//var_dump($this->db);

		$this->session->set_flashdata('category_success', '' . $result . '');
		redirect(base_url() . 'dependencias/inicio');
	}
	public function fillcaracteristicas()
	{
		echo '<option value="">Selecionar ...</option>';

		$caracteristicas = $this->model_dependencias->getCaracteristicas();
		foreach ($caracteristicas as $c) {
			echo '<option value="' . $c->c_id . '">' . $c->c_nombre . '</option>';
		}
	}

	public function new_equipo()
	{

		echo 'nuevo equipo';
	}

	public function select_equipos()
	{

		$tipo  = $this->input->post('tipo');
		$equipos = $this->model_dependencias->getEquipo($tipo);
		echo '<option value="">Seleccionar...</option>
		<option value="0"> Nuevo </option>';
		foreach ($equipos as  $e) {
			echo ' <option value="' . $e->id . '">' . $e->nombre . '</option>';
		}
	}
	//ficha tecnica
	public function ft_subsectores()
	{
		$id_s = $this->uri->segment(4);
		$data['id'] = $this->uri->segment(4);
		//$this->load->view('reportes/dep_subsectores',$data);
		$html = $this->load->view('reportes/dep_subsectores', $data, true);
		$pie = "<div>Pág. {PAGENO}/{nb}</div>";

		$subsector = $this->model_dependencias->getSubsector($id_s);
		$cabecera = '<div style="color:#ccc;text-transform:capitalize; text-align:right;" >Ficha Técnica Subsector -' . $subsector[0]->nombre . '</div>';
		$mpdf = new mPDF('', 'Letter');
		$mpdf->AddPage('P');
		$mpdf->SetHTMLHeader($cabecera);
		$mpdf->shrink_tables_to_fit = 1;
		$mpdf->WriteHTML($html);
		$mpdf->SetHTMLFooter($pie);
		$mpdf->Output();
	}
	public function ft_dependencia()
	{

		$data['id'] = $this->uri->segment(4);
		//$this->load->view('reportes/dep_dependecias',$data);
		$html = $this->load->view('reportes/dep_dependecias', $data, true);
		$pie = "<div>Ficha Técnica  <br> {PAGENO}/{nb}</div>";
		$cabecera = "div>stadio italiano di concepción</div>";


		$mpdf = new mPDF('', 'Letter');
		$mpdf->AddPage('P');
		$mpdf->SetHTMLHeader($cabecera);
		$mpdf->shrink_tables_to_fit = 1;
		$mpdf->WriteHTML($html);
		$mpdf->SetHTMLFooter($pie);
		$mpdf->Output();
	}

	public function report_trabajos()
	{

		$data['id'] = $this->uri->segment(4);
		$data['sub'] = $this->uri->segment(5);
		//$this->load->view('reportes/work_dependencia',$data);
		$html = $this->load->view('reportes/work_dependencia', $data, true);
		$pie = "<div>{PAGENO}/{nb}</div>";
		$cabecera = '<div style="color:#ccc">Trabajos Realizados</div>';


		$mpdf = new mPDF('', 'Letter');
		$mpdf->AddPage('P');
		$mpdf->SetHTMLHeader($cabecera);
		$mpdf->shrink_tables_to_fit = 1;
		$mpdf->WriteHTML($html);
		$mpdf->SetHTMLFooter($pie);
		$mpdf->Output();
	}
}
