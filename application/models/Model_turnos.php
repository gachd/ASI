<?php
class model_turnos extends CI_Model
{

	function FuncionarioId($rut, $tipo)
	{

		if (empty($rut)) {
			$query = $this->db->query('SELECT * FROM funcionario WHERE tipo = ' . $tipo . ' AND habilitado = 0 ORDER BY nombre_fun ASC');
		} else {
			$query = $this->db->query('SELECT * FROM funcionario WHERE rut LIKE "' . $rut . '" AND tipo = ' . $tipo . ' AND habilitado = 0 ORDER BY nombre_fun ASC');
		}
		return $query->result();
	}

	/* function getFuncionarioTipo($tipo, $tipo_inst) */
	function getFuncionarioTipo($tipo)
	{

		$this->db->select('*');
		$this->db->from('funcionario');
		$this->db->where("tipo", $tipo);
		/* 	$this->db->where("tipo_inst", $tipo_inst); */
		$this->db->where("habilitado", 0);
		$this->db->order_by('nombre_fun', 'asc');

		$funcionario = $this->db->get();




		if ($funcionario->num_rows() > 0) {

			return $funcionario->result();
		}
	}

	//funcionarios stadio y guardias
	function getFun_stadio_guardia()
	{
		$this->db->where("habilitado", 0);
		$this->db->where("tipo", 2)->or_where("tipo", 4);


		$this->db->order_by("tipo", "desc");
		$funcionario = $this->db->get('funcionario');
		if ($funcionario->num_rows() > 0) {
			return $funcionario->result();
		}
	}

	function getTurno()
	{
		$this->db->where("habilitado", 0);
		$this->db->order_by('t_turno', 'asc');
		$turno = $this->db->get('turno');
		if ($turno->num_rows() > 0) {
			return $turno->result();
		}
	}
	function getTurnoTipo($tipo)
	{
		$this->db->where("tipo", $tipo);
		$this->db->where("habilitado", 0);
		$this->db->order_by('t_turno', 'asc');
		$turno = $this->db->get('turno');
		if ($turno->num_rows() > 0) {
			return $turno->result();
		}
	}
	function insertar_turno($data)
	{
		$this->db->insert('turno_has_funcionario', $data);
	}
	function turno_funcionario_dia($fecha, $funcionario)
	{
		$query = $this->db->query("SELECT `funcionario`,`tipo_funcionario`,`fecha`,`turno`,turno.sigla,turno.color
                                FROM `turno_has_funcionario`
                                INNER  JOIN turno  on  turno_has_funcionario.turno = turno.t_id
                                WHERE `funcionario` LIKE '" . $funcionario . "' AND `fecha` = '" . $fecha . "'");
		return $query->result();
	}
	function delet_plan_turno($mes, $tipo, $year, $fun)
	{

		if ($fun == 0) {

			$query = $this->db->query('DELETE FROM turno_has_funcionario WHERE tipo_funcionario=' . $tipo . ' AND month(fecha)=' . $mes . ' AND year(fecha)=' . $year . '');
		} else {

			$query = $this->db->query('DELETE FROM turno_has_funcionario WHERE funcionario="' . $fun . '" AND tipo_funcionario=' . $tipo . ' AND month(fecha)=' . $mes . ' AND year(fecha)=' . $year . '');
		}

		return $query;
	}

	function dia_tipofuncionario($tipo, $fecha)
	{


		$query = $this->db->query('SELECT funcionario.nombre_fun, funcionario.paterno, turno.sigla
FROM `turno_has_funcionario` 
INNER JOIN turno on turno_has_funcionario.turno = turno.t_id
INNER JOIN funcionario on turno_has_funcionario.funcionario = funcionario.rut
WHERE `tipo_funcionario` = ' . $tipo . ' AND `fecha` = "' . $fecha . '" AND turno.habilitado=0
ORDER BY  funcionario.paterno  DESC');
		return $query->result();
	}

	function turno_dia_funcionario($rut, $fecha)
	{


		$query = $this->db->query('SELECT funcionario.rut,funcionario.nombre_fun, funcionario.paterno, turno.sigla,turno.t_id
FROM `turno_has_funcionario` 
INNER JOIN turno on turno_has_funcionario.turno = turno.t_id
INNER JOIN funcionario on turno_has_funcionario.funcionario = funcionario.rut
WHERE rut = "' . $rut . '" AND `fecha` = "' . $fecha . '" AND turno.habilitado=0
ORDER BY  funcionario.paterno  DESC');
		return $query->result();
	}


	function turno_trabaja_fecha($fecha)
	{
		$query = $this->db->query('SELECT `turno`, turno.t_turno as nom_turno, turno.sigla,turno.color,funcionario.nombre_fun,funcionario.paterno FROM `turno_has_funcionario` INNER JOIN turno ON turno_has_funcionario.turno = turno.t_id INNER JOIN funcionario ON turno_has_funcionario.funcionario = funcionario.rut WHERE tipo_funcionario= 2 AND `fecha`= "' . $fecha . '" AND (turno <> 4 AND turno <> 5 AND turno <> 14 AND turno <> 16)
 		ORDER BY turno.t_turno DESC');
		return $query->result();
	}

	function turno_NOtrabaja_fecha($fecha)
	{
		$query = $this->db->query('SELECT `turno`, turno.t_turno as nom_turno, turno.sigla,turno.color,funcionario.nombre_fun,funcionario.paterno FROM `turno_has_funcionario` INNER JOIN turno ON turno_has_funcionario.turno = turno.t_id INNER JOIN funcionario ON turno_has_funcionario.funcionario = funcionario.rut WHERE tipo_funcionario= 2 AND `fecha`= "' . $fecha . '" AND (turno = 4 OR turno = 5 OR turno = 14 OR turno=16)
 		ORDER BY turno.t_turno DESC');
		return $query->result();
	}


	function horarios_rango_fecha($inicio, $termino)
	{
		$query = $this->db->query('SELECT turno.t_inicio, turno.t_termino FROM `turno_has_funcionario` INNER JOIN turno ON turno_has_funcionario.turno = turno.t_id INNER JOIN funcionario ON turno_has_funcionario.funcionario = funcionario.rut WHERE turno.tipo= 2 AND ( fecha BETWEEN "' . $inicio . '" AND "' . $termino . '") AND turno.trabaja=0 GROUP BY (t_termino) ORDER BY turno.t_termino ASC');
		return $query->result();
	}

	function turno_rango_horario($fecha, $inicio, $termino)
	{
		$query = $this->db->query('SELECT Upper(funcionario.nombre_fun) as nombre ,Upper(funcionario.paterno) as apellido,t_inicio,t_termino
FROM `turno_has_funcionario` 
INNER JOIN turno ON turno_has_funcionario.turno = turno.t_id
INNER JOIN funcionario ON turno_has_funcionario.funcionario = funcionario.rut
WHERE fecha= "' . $fecha . '" AND t_inicio ="' . $inicio . '" AND t_termino="' . $termino . '" AND turno.tipo=2
ORDER by funcionario.paterno');
		return $query->result();
	}

	function guardias_horarios_rango_fecha($inicio, $termino)
	{
		$query = $this->db->query('SELECT turno.t_inicio, turno.t_termino FROM `turno_has_funcionario` INNER JOIN turno ON turno_has_funcionario.turno = turno.t_id INNER JOIN funcionario ON turno_has_funcionario.funcionario = funcionario.rut WHERE ( fecha BETWEEN "' . $inicio . '" AND "' . $termino . '") AND turno.trabaja=0 AND turno.tipo=4 GROUP BY (t_termino) ORDER BY turno.t_INICIO ASC');
		return $query->result();
	}

	function guardias_turno_rango_horario($fecha, $inicio, $termino)
	{
		$query = $this->db->query('SELECT Upper(funcionario.nombre_fun) as nombre ,Upper(funcionario.paterno) as apellido,t_inicio,t_termino
FROM `turno_has_funcionario` 
INNER JOIN turno ON turno_has_funcionario.turno = turno.t_id
INNER JOIN funcionario ON turno_has_funcionario.funcionario = funcionario.rut
WHERE fecha= "' . $fecha . '" AND t_inicio ="' . $inicio . '" AND t_termino="' . $termino . '" AND turno.tipo=4
ORDER by funcionario.paterno');
		return $query->result();
	}



	function carga_tipo(){

		$this->db->select('*');
		$this->db->from('turno_tipo');
		$this->db->where('habilitado',1);
		$query = $this->db->get();
		return $query->result();

	}
}
