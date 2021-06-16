<?php
class model_actividades extends CI_Model
{

	function trabajos_depen($dep, $fecha, $inicio, $termino)
	{
		$query = $this->db->query("SELECT `dependencia`,trabajos.tb_fecha,trabajos.tb_inicio,trabajos.tb_termino
FROM `trabajos_has_dependencia`
INNER JOIN trabajos on trabajos_has_dependencia.trabajo = trabajos.tb_id
WHERE trabajos.tb_fecha = '" . $fecha . "' 
	AND dependencia = " . $dep . "
	AND (`tb_inicio` BETWEEN '" . $inicio . "' AND '" . $termino . "')
    OR (`tb_termino` BETWEEN '" . $inicio . "' AND '" . $termino . "')");
		return $query->result();
	}

	/*SELECT SUBDATE(now(),WEEKDAY(now())) as primer_dia,ADDDATE(now(),6-WEEKDAY(now())) as ultimo_dia*/

	function getAll($fecha)
	{

		if ($fecha == "") {
			$query = $this->db->query('select actividades.*,categoria.ctg_nombre,sub_categoria.sctg_nombre
from actividades INNER JOIN categoria ON actividades.act_ctg_id = categoria.ctg_id INNER JOIN sub_categoria ON actividades.act_sctg_id = sub_categoria.sctg_id
WHERE YEARWEEK(`act_fecha`,1) = YEARWEEK(now(),1)
OR
YEARWEEK(`act_fecha_termino`,1) = YEARWEEK(now(),1)');
		} else {
			$query = $this->db->query('select actividades.*,categoria.ctg_nombre,sub_categoria.sctg_nombre
from actividades
INNER JOIN categoria ON actividades.act_ctg_id = categoria.ctg_id 
INNER JOIN sub_categoria ON actividades.act_sctg_id = sub_categoria.sctg_id
WHERE "' . $fecha . '" <=`act_fecha_termino` AND  "' . $fecha . '" >=`act_fecha`
ORDER BY actividades.act_inicio ASC');
		}

		return $query->result();
	}



	function getAllRango($fecha1, $fecha2)
	{
		$query = $this->db->query('select actividades.*,categoria.ctg_nombre,sub_categoria.sctg_nombre
from actividades
INNER JOIN categoria ON actividades.act_ctg_id = categoria.ctg_id
INNER JOIN sub_categoria ON actividades.act_sctg_id = sub_categoria.sctg_id 
WHERE "' . $fecha2 . '" >= `act_fecha_termino` AND  "' . $fecha1 . '" <=`act_fecha`
order BY actividades.act_fecha,actividades.act_inicio  ASC');
		return $query->result();
	}



	function getAllWORK($fechaw)
	{

		if ($fechaw == "") {
			$queryw = $this->db->query('SELECT *, categoria.ctg_nombre, sub_categoria.sctg_nombre
FROM `trabajos` 
INNER JOIN categoria on trabajos.tb_ctg_id = categoria.ctg_id
INNER JOIN sub_categoria on trabajos.tb_sctg_id = sub_categoria.sctg_id
WHERE YEARWEEK(`tb_fecha`) = YEARWEEK(now())');
		} else {
			$queryw = $this->db->query('SELECT *, categoria.ctg_nombre, sub_categoria.sctg_nombre
FROM `trabajos` 
INNER JOIN categoria on trabajos.tb_ctg_id = categoria.ctg_id
INNER JOIN sub_categoria on trabajos.tb_sctg_id = sub_categoria.sctg_id
WHERE trabajos.tb_fecha = "' . $fechaw . '"
ORDER BY categoria.ctg_nombre ASC');
		}

		return $queryw->result();
	}
	function getFuncionarioWORK($trabajo)
	{
		$funWORK = $this->db->query("SELECT funcionario.nombre_fun, funcionario.paterno,funcionario.rut
								FROM `funcionario_has_trabajos`
								INNER JOIN funcionario ON funcionario_has_trabajos.funcioanrio = funcionario.rut
								WHERE `trabajo`=" . $trabajo . "
								ORDER BY paterno");
		return $funWORK->result();
	}

	function getDepWORK($depw)
	{
		$depWORK = $this->db->query("SELECT `dependencia`, dependencia.dep_nombre
									FROM `trabajos_has_dependencia` 
									INNER JOIN dependencia ON trabajos_has_dependencia.dependencia = dependencia.dep_id
									where `trabajo` = " . $depw . "
									ORDER by dependencia.dep_nombre asc");
		return $depWORK->result();
	}
	function insertar($data)
	{
		$this->db->insert('actividades', $data);
	}


	function planificacion($plan)
	{

		$this->db->insert('planificacion', $plan);
	}

	function funcionario_has_actividades($dataFunAct)
	{
		$this->db->insert('funcionario_has_actividades', $dataFunAct);
	}

	function actualizar($array, $id)
	{

		$this->db->update('actividades', $array, $id);
	}

	function actualizardep($depen, $activ)
	{
		$this->db->where('act_id_ad', $activ);
		$this->db->update('actividades_has_dependencia', $depen);
	}

	function actualizarPlan($plani, $activi)
	{
		$this->db->where('actividades', $activi);
		$this->db->update('planificacion', $plani);
	}

	function MaxActiv()
	{
		$this->db->select_max('act_id');
		$sqlMax = $this->db->get('actividades');
		return $sqlMax->result();
	}

	function InserDep($dep)
	{
		$this->db->insert('actividades_has_dependencia', $dep);
	}
	function getFuncionario()
	{
		$this->db->order_by('nombre_fun', 'asc');
		$funcionario = $this->db->get('funcionario');

		if ($funcionario->num_rows() > 0) {
			return $funcionario->result();
		}
	}

	function getCategorias()
	{
		$this->db->where("faena", "0");
		$this->db->where("ctg_habilitado", "0");
		$this->db->order_by('ctg_nombre', 'asc');
		$categorias = $this->db->get('categoria');



		if ($categorias->num_rows() > 0) {
			return $categorias->result();
		}
	}

	function getSubcate()
	{
		$this->db->where('sctg_habilitado', 0);
		$this->db->order_by('sctg_nombre', 'asc');
		$subcategorias = $this->db->get('sub_categoria');

		if ($subcategorias->num_rows() > 0) {
			return $subcategorias->result();
		}
	}
	function getDepen($act)
	{  // dependencia por actividad
		$dep_act = $this->db->query('SELECT *, dependencia.dep_nombre
FROM `actividades_has_dependencia`
INNER JOIN dependencia  ON actividades_has_dependencia.dep_id_ad = dependencia.dep_id
WHERE actividades_has_dependencia.act_id_ad = ' . $act . ' 
ORDER BY dependencia.dep_nombre');
		return $dep_act->result();
	}
	function getsubcategoria($categoria)
	{
		$this->db->where('sctg_habilitado', 0);
		$this->db->where("categoria_ctg_id", $categoria);
		$subcategorias = $this->db->get("sub_categoria");
		if ($subcategorias->num_rows() > 0) {
			return $subcategorias->result();
		}
	} //fin function
	function getFaenaCategoria($categoriaFaena)
	{
		$this->db->select('faena');
		$this->db->where("ctg_id", $categoriaFaena);
		$faena = $this->db->get("categoria");

		if ($faena->num_rows() > 0) {
			return $faena->result();
		}
	}

	function getcategoriaAct($actividad)
	{
		$this->db->select("act_ctg_id");
		$this->db->where("act_id", $actividad);
		$ctg_act = $this->db->get("actividades");
		return $ctg_act->result();
	}

	function getDependencias($categoriadep)
	{ // dependencia por categoria

		$dep_cat = $this->db->query('SELECT `dep_id_dc`,dependencia.dep_nombre
							FROM `dependencia_has_categoria`
							INNER JOIN dependencia ON dependencia_has_categoria.dep_id_dc = dependencia.dep_id
							WHERE dependencia_has_categoria.ctg_id_dc=' . $categoriadep . '
							Order by dependencia.dep_nombre asc');

		return $dep_cat->result();
	} //fin function	 

	function eliminar_plan($id)
	{
		$this->db->where('actividades', $id);
		return $this->db->delete('planificacion');
	}

	function eliminar_dep($id)
	{
		$this->db->where('act_id_ad', $id);
		return $this->db->delete('actividades_has_dependencia');
	}
	function eliminar_act($id)
	{
		$this->db->where('act_id', $id);
		return $this->db->delete('actividades');
	}

	function autorizar_actividad()
	{
		$query = $this->db->query('select actividades.*,categoria.ctg_nombre,sub_categoria.sctg_nombre
from actividades
INNER JOIN categoria ON actividades.act_ctg_id = categoria.ctg_id
INNER JOIN sub_categoria ON actividades.act_sctg_id = sub_categoria.sctg_id
WHERE `act_ctg_id` =5 AND `autorizacion` = 1
ORDER BY `act_fecha` ASC');

		return $query->result();
	}

	function pago($id)
	{
		$this->db->query('UPDATE actividades
SET `autorizacion` =0
WHERE `act_id`=' . $id . '');
	}
	function permiso_insertar($id)
	{
		$query = $this->db->query('SELECT * FROM user_permiso WHERE id_usuario LIKE "' . $id . '" AND ((id_permiso = 1 AND `insertar` = 1) OR (id_permiso = 6))');
		return $query->result();
	}

	function calendario()
	{

		$query = $this->db->query("SELECT `act_id` as id, concat(`act_fecha`,'T',act_inicio ) as start,concat(`act_fecha_termino`,'T',`act_termino`) as end,
concat(UPPER(SUBSTRING(categoria.ctg_nombre,1,3)),'. ',sub_categoria.sctg_nombre)  as title, categoria.ctg_color as color
FROM `actividades`
INNER JOIN sub_categoria on actividades.act_sctg_id = sub_categoria.sctg_id
INNER JOIN categoria ON actividades.act_ctg_id = categoria.ctg_id");
		/* $query=$this->db->query("SELECT `act_id` as id,`act_fecha` as start,`act_fecha_termino` as end,
concat(sub_categoria.sctg_nombre,' ',`act_evento`) as title, categoria.ctg_color as color
FROM `actividades`
INNER JOIN sub_categoria on actividades.act_sctg_id = sub_categoria.sctg_id
INNER JOIN categoria ON actividades.act_ctg_id = categoria.ctg_id");*/

		return $query->result();
	}


	function actv_rango_cerrado_depe($inicio, $fin, $depen)
	{
		$query = $this->db->query('select *
from actividades_has_dependencia 
INNER JOIN actividades ON actividades_has_dependencia.act_id_ad = actividades.act_id 
WHERE ("' . $fin . '" >= `act_fecha_termino` AND  "' . $inicio . '" <=`act_fecha`) AND (act_sctg_id <> 122 AND act_sctg_id <> 29)  AND dep_id_ad= ' . $depen . '
order BY actividades.act_fecha  ASC');
	}

	function turno_personal_stadio($fecha)
	{
		$query = $this->db->query("SELECT rut,nombre_fun,paterno,funcionario.tipo,funcionario.habilitado,fecha,turno,turno.t_turno as nom_turno, turno.t_inicio, turno.t_termino
        FROM `turno_has_funcionario` 
        INNER JOIN funcionario on turno_has_funcionario.funcionario= funcionario.rut
        INNER JOIN turno on turno.t_id= turno_has_funcionario.turno
        WHERE  funcionario.habilitado=0 AND fecha='" . $fecha . "' AND funcionario.tipo=2");
		return $query->result();
	}
	function turno_guardias($fecha)
	{
		$query = $this->db->query("SELECT rut,nombre_fun,paterno,funcionario.tipo,funcionario.habilitado,fecha,turno,turno.t_turno as nom_turno, turno.t_inicio, turno.t_termino
        FROM `turno_has_funcionario` 
        INNER JOIN funcionario on turno_has_funcionario.funcionario= funcionario.rut
        INNER JOIN turno on turno.t_id= turno_has_funcionario.turno
        WHERE  funcionario.habilitado=0 AND fecha='" . $fecha . "' AND funcionario.tipo=4");
		return $query->result();
	}
	function turnos()
	{
		$this->db->where("habilitado", 0);
		$query = $this->db->get("turno");
		return $query->result();
	}

	

	function actv_mes($mes, $year)
	{


		$query = $this->db->query('SELECT `act_sctg_id`, sub_categoria.sctg_nombre,categoria.ctg_nombre
									FROM `actividades`
									INNER JOIN sub_categoria on actividades.act_sctg_id = sub_categoria.sctg_id
									INNER JOIN categoria on actividades.act_ctg_id = categoria.ctg_id
									WHERE month(act_fecha)=' . $mes . ' and year(act_fecha)=' . $year . '
									GROUP BY act_sctg_id
									ORDER BY ctg_nombre'
								);
		return $query->result();
	}



	function num_personas_actv($fecha, $sub)
	{


		$query = $this->db->query('SELECT SUM(act_nprsns) as total FROM `actividades` WHERE act_fecha="' . $fecha . '"  AND act_sctg_id=' . $sub . '');
		return $query->result();
	}


	function total_prsns_dia($fecha)
	{
		$query = $this->db->query('select SUM(act_nprsns) as total FROM actividades WHERE act_fecha ="' . $fecha . '"');
		return $query->result();
	}
}
