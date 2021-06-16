<?php
class model_dependencias extends CI_Model
{

	function getSector()
	{
		$sec = $this->db->where('categoria <>', 0);
		$sec = $this->db->get('sectores');


		if ($sec->num_rows() > 0) {
			return $sec->result();
		}
	}
	function getDepen_subsector($id)
	{
		$this->db->where('dep_habilitado = 0');
		$this->db->where('sub_sector = ' . $id . '');
		$this->db->order_by('letra', 'asc');

		$dep = $this->db->get('dependencia');

		if ($dep->num_rows() > 0) {
			return $dep->result();
		}
	}

	function getDepen_sector($sector)
	{


		$this->db->where('sector = ' . $sector . '');


		$this->db->where('dep_habilitado = 0');
		$this->db->order_by('letra', 'asc');
		$dep = $this->db->get('dependencia');
		if ($dep->num_rows() > 0) {
			return $dep->result();
		}
	}
	function getSub_sector($id)
	{
		$this->db->where('sector = ' . $id . '');
		$this->db->order_by('letra', 'asc');

		$dep = $this->db->get('sub_sectores');

		if ($dep->num_rows() > 0) {
			return $dep->result();
		}
	}

	function insert_dependencias($data)
	{
		$this->db->insert('dependencia', $data);
	}
	/* max id _dependencias*/
	function maxid()
	{
		$query = $this->db->query("SELECT MAX(`dep_id`) AS max_id FROM dependencia");
		return $query->result();
	}
	/* max id _dependencias_tipo*/
	function maxid_tipo_dep()
	{
		$query = $this->db->query("SELECT MAX(`id`) AS max_id FROM dependencias_tipo");
		return $query->result();
	}


	function insert_dependencia_tipo($data)
	{
		$this->db->insert('dependencias_tipo', $data);
	}

	function insert_instalaciones($data)
	{
		$this->db->insert('instalaciones', $data);
	}
	function insert_vegetacion($data)
	{
		$this->db->insert('vegetacion', $data);
	}
	function insert_recreacion($data)
	{
		$this->db->insert('recreacion', $data);
	}


	function tipo_vegetacion()
	{
		$tipo = $this->db->get('vegetacion_tipo');
		if ($tipo->num_rows() > 0) {
			return $tipo->result();
		}
	}

	function categoria_veg($tipo)
	{
		$categoria = $this->db->where('vegcat_tipo', $tipo);
		$categoria = $this->db->get('vegetacion_categoria');


		if ($categoria->num_rows() > 0) {
			return $categoria->result();
		}
	}

	function getSubDependencia($id)
	{
		$dep = $this->db->query('SELECT * FROM `sub_dependencias` WHERE `dependencia` = ' . $id . ' AND `habilitado` = 0');
		return $dep->result();
	}
	function getTipoDepen($id)
	{
		$tipo = $this->db->query('SELECT tipo, dep_tipos.nom_tipo
 FROM `dependencias_tipo` 
INNER JOIN dep_tipos ON dependencias_tipo.tipo = dep_tipos.id
 WHERE dependencia = ' . $id . '');
		if ($tipo->num_rows() > 0) {
			return $tipo->result();
		}
	}

	function getInstalaciones($id)
	{
		$ins = $this->db->where('dependencia', $id);
		$ins = $this->db->where('inst_habilitado', 0);
		$ins = $this->db->get('instalaciones');


		if ($ins->num_rows() > 0) {
			return $ins->result();
		}
	}

	function getVegetacion($id)
	{
		$query = $this->db->query('SELECT `veg_fecha_plantacion`,`veg_categoria`,`veg_tipo`,`veg_tipo_riego`,vegetacion_categoria.vegcat_categoria, vegetacion_tipo.vegtipo_tipo,veg_cantidad
FROM `vegetacion`
INNER JOIN vegetacion_categoria ON vegetacion.veg_categoria = vegetacion_categoria.vegcat_id
INNER JOIN vegetacion_tipo ON vegetacion.veg_tipo = vegetacion_tipo.vegtipo_id
WHERE `dependencia` = ' . $id . ' and veg_habilitado=0');
		if ($query->num_rows() > 0) {
			return $query->result();
		}
	}
	function getRecreacion($id)
	{
		$recreacion = $this->db->where('dependencia', $id);
		$recreacion = $this->db->where('r_habilitado', 0);
		$recreacion = $this->db->get('recreacion');
		if ($recreacion->num_rows() > 0) {
			return $recreacion->result();
		}
	}

	function deshabilitar_dependencia($sb)
	{
		$this->db->set('dep_habilitado', 1);
		$this->db->where('dep_id', $sb);
		$this->db->update('dependencia');
	}
	function deshabilitar_instalacion($sb)
	{
		$this->db->set('inst_habilitado', 1);
		$this->db->where('dependencia', $sb);
		$this->db->update('instalaciones');
	}
	function deshabilitar_vegetacion($sb)
	{
		$this->db->set('veg_habilitado', 1);
		$this->db->where('dependencia', $sb);
		$this->db->update('vegetacion');
	}
	function deshabilitar_recreacion($sb)
	{
		$this->db->set('r_habilitado', 1);
		$this->db->where('dependencia', $sb);
		$this->db->update('recreacion');
	}
	function permiso_insertar($id)
	{
		$query = $this->db->query('SELECT * FROM user_permiso WHERE id_usuario LIKE "' . $id . '" AND ((id_permiso = 8 AND `insertar` = 1) OR (id_permiso = 6))');
		return $query->result();
	}

	function sctg_depend($dep)
	{

		$query = $this->db->query('SELECT `sctg_id`,`dependencia` FROM trabajos_has_dependencia
INNER JOIN trabajos on trabajos_has_dependencia.trabajo = trabajos.tb_id
WHERE dependencia=' . $dep . '
GROUP BY sctg_id');
		return $query->result();
	}
	/*medidas dependencia*/
	function medidas_dependencia($dep)
	{

		$query = $this->db->query('SELECT alto,ancho,largo,(ancho*largo)m_cuadrados FROM `dependencia` WHERE `dep_id`=' . $dep . '');
		return $query->result();
	}


	function dias_transcurridos($sctg_id, $dep_id)
	{

		$query = $this->db->query('SELECT trabajos.tb_fecha, trabajos.tb_estado, DATEDIFF(curdate(),tb_fecha) as transcurrido FROM `trabajos_has_dependencia` INNER JOIN trabajos on trabajos_has_dependencia.trabajo = trabajos.tb_id
	 WHERE `sctg_id` = ' . $sctg_id . ' AND `dependencia` = ' . $dep_id . ' and trabajos.tb_estado=1 
	 ORDER BY tb_fecha DESC LIMIT 1');
		return $query->result();
	}

	function dias_faltan($sctg_id, $dep_id)
	{

		$query = $this->db->query('SELECT trabajos.tb_fecha, trabajos.tb_estado, DATEDIFF(tb_fecha,curdate()) as falta FROM `trabajos_has_dependencia` INNER JOIN trabajos on trabajos_has_dependencia.trabajo = trabajos.tb_id
	 WHERE `sctg_id` = ' . $sctg_id . ' AND `dependencia` = ' . $dep_id . ' and trabajos.tb_estado=0  and  tb_fecha>=CURDATE() 
ORDER BY `trabajos`.`tb_fecha` ASC LIMIT 1');
		return $query->result();
	}


	/* ---------------------------------------------------------------------------------- */


	/*retorno los datos de la dependencia*/
	public function getdependencia($datofiltrador)
	{
		$depen = $this->db->query('SELECT dependencias_tipo.id,dependencias_tipo.tipo,
			dependencias_tipo.dependencia , dependencias_tipo.sub_sector,
			dependencias_tipo.sector
			,dependencia.dep_nombre
			FROM dependencias_tipo INNER JOIN dependencia 
			ON dependencias_tipo.dependencia = dependencia.dep_id
			WHERE dependencias_tipo.dependencia =' . $datofiltrador . '');

		return $depen->result();
	}

	/*retorno los datos de sector*/
	public function retorno_sectores()
	{
		$sectores = $this->db->query('SELECT `id`,`nombre`,`categoria` 
								FROM `sectores`');
		return $sectores->result();
	}
	/*retorno los subsectores*/
	public function retorno_subsectores($filtrador)
	{
		$subsectores = $this->db->query('SELECT `id`,`nombre`,`letra`,`sector`
									 FROM `sub_sectores`
									  WHERE `sector`=' . $filtrador . '');
		return $subsectores->result();
	}

	/* retorno de todas las dependencias tipos para ver si debo o no imprimir el tipo boton actualizar*/
	public function all_dependencias()
	{
		$todas = $this->db->query('SELECT `id`,`tipo`,`dependencia`,`sub_sector`,`sector`
	FROM `dependencias_tipo` 
		GROUP BY `dependencia`');
		return $todas->result();
	}

	/*retorna todas las dependencias*/
	public function alldepend($fillsector, $fillsub)
	{
		$todas = $this->db->query('SELECT `dep_id`,`dep_nombre`,`dep_critico`,`dep_habilitado`,`sub_sector`,`sector`,`letra` FROM `dependencia` where `sub_sector`=' . $fillsector . '&& `sub_sector`=' . $fillsub . '');

		return $todas->result();
	}

	/*RETORNA EL TIPO */
	public function tiporeturn($id)
	{
		$datos = $this->db->query('SELECT `tipo`
FROM `dependencias_tipo` 
WHERE `dependencia`=' . $id . '');
		return $datos->result();
	}

	/* RETORNO DE DATOS RECREACION */

	public function recreacion_form($filtrador)
	{
		$datos = $this->db->query('SELECT *
		FROM `recreacion`
		where `dependencia`=' . $filtrador . '');

		return $datos->result();
	}
	/* RETORNO DE DATOS INSTALACION */
	public function instalacion_form($filtrador)
	{
		$datos = $this->db->query('SELECT *
		FROM `instalaciones`
		WHERE `dependencia`= ' . $filtrador . '');

		return $datos->result();
	}

	/*retorno de tipo de instalacion ejem : edificacion etc */

	public function consultas_instalacion($solicitud)
	{
		# consultas tipo estructura
		if ($solicitud == "1") {
			$datos = $this->db->query('SELECT `material_nombre`,`id_tipo` FROM `materiales` 
			WHERE `id_tipo`=' . $solicitud . '');
			return $datos->result();
		}
		#consulta 
		if ($solicitud == "2") {
			#consulta por los materiales
			$datos = $this->db->query('SELECT `id_tipo`,`material_nombre` FROM `materiales` where `id_tipo`
		 =' . $solicitud . '');

			return $datos->result();
		}
		if ($solicitud == "3") {
			# consulta para el tipo de piso
			$datos = $this->db->query('SELECT `id_tipo`,`material_nombre` FROM `materiales` where `id_tipo`
		 =' . $solicitud . '');

			return $datos->result();
		}

		if ($solicitud == "4") {
			# consulta materiales ventana
			$datos = $this->db->query('SELECT `id_tipo`,`material_nombre` FROM `materiales` where `id_tipo`
		 =' . $solicitud . '');
			return $datos->result();
		}
		if ($solicitud == "5") {
			# consulta techumbre
			$datos = $this->db->query('SELECT `id_tipo`,`material_nombre` FROM `materiales` where `id_tipo`
		 =' . $solicitud . '');
			return $datos->result();
		}

		if ($solicitud == "6") {
			# consulta 
			$datos = $this->db->query('SELECT `id_tipo`,`material_nombre` FROM `materiales` where `id_tipo`
		 =' . $solicitud . '');
			return $datos->result();
		}
	}

	/* -----------------------------------------------------------------------------------*/

	/*consultas vegetacion tipo*/

	public function retorno_tipo_vegetacion()
	{
		# retorna los tipos de vegetacion
		$datos = $this->db->query('SELECT `vegtipo_id`,`vegtipo_tipo` FROM `vegetacion_tipo`');
		return $datos->result();
	}

	public function retorno_categoria_vegetacion()
	{ #retorna la categoria de la vegetacion
		$datos = $this->db->query('SELECT `vegcat_id`,`vegcat_categoria`,`vegcat_tipo` FROM `vegetacion_categoria`');
		return $datos->result();
	}

	public function vegetacion_datos($id)
	{
		# retorna los datos de la vegetacion seleccionada
		$datos = $this->db->query('SELECT `veg_id`,`veg_fecha_plantacion`,`veg_categoria`,`veg_tipo`,`veg_tipo_riego`,`veg_cantidad`,`veg_habilitado`,`dependencias_tipo_id`,`sub_sector`,`dependencia`,`sector` FROM `vegetacion` 
		WHERE `dependencia`=' . $id . '');

		return $datos->result();
	}

	public function datos_veg_depen($id)
	{
		# retorna ancho largo y altura
		$datos = $this->db->query('SELECT `ancho`,`largo`,`alto` FROM `dependencia` WHERE `dep_id`=' . $id . '');
		return $datos->result();
	}

	/* --------------------- recreacion -------------------------- */

	public function recreacion_datos($id)
	{
		# retorna los datos de la recreacion seleccionada

		$datos = $this->db->query('SELECT * FROM `recreacion`
	 WHERE `dependencia` = ' . $id . '');
		return $datos->result();
	}

	/*consulta para actualizar*/
	public function esta_en_la_tabla($dep, $tipo)
	{

		$datos = $this->db->query('SELECT count(*) as cuantos FROM 
		`dependencias_tipo` WHERE `dependencia`=' . $dep . ' && `tipo`=' . $tipo . '');
		return $datos->result();
	}
	/*eliminar de dependencias_tipo*/
	function eliminar_dependencias_tipo($id, $tipo)
	{
		$this->db->where('dependencia', $id);
		$this->db->where('tipo', $tipo);
		return $this->db->delete('dependencias_tipo');
	}
	/*actualizar*/
	public function actualizar_tipo_dependencia($id, $tipo, $data)
	{
		# actualizo
		$this->db->where('dependencia', $id);
		$this->db->where('tipo', $tipo);
		return $this->db->update('dependencias_tipo', $data);
	}

	/*actualizar instalacion*/
	public function actualizar_instalacion($id, $tipo, $data)
	{
		# actualizo
		$this->db->where('dependencia', $id);
		$this->db->where('dependencias_tipo_id', $tipo);
		return $this->db->update('instalaciones', $data);
	}

	function eliminar_instalacion($id, $tipo)
	{
		$this->db->where('dependencia', $id);
		$this->db->where('dependencias_tipo_id', $tipo);
		return $this->db->delete('instalaciones');
	}

	/*actualizar vegetacion*/
	public function actualizar_vegetacion($id, $tipo, $data)
	{
		# actualizo
		$this->db->where('dependencia', $id);
		$this->db->where('dependencias_tipo_id', $tipo);
		return $this->db->update('vegetacion', $data);
	}

	public function eliminar_vegetacion($id, $tipo)
	{
		$this->db->where('dependencia', $id);
		$this->db->where('dependencias_tipo_id', $tipo);
		return $this->db->delete('vegetacion');
	}

	/*eliminar recreacion*/
	public function eliminar_recreacion($id, $tipo)
	{
		$this->db->where('dependencia', $id);
		$this->db->where('dependencias_tipo_id', $tipo);
		return $this->db->delete('recreacion');
	}

	public function actualizar_recreacion($id, $tipo, $data)
	{
		# actualizo
		$this->db->where('dependencia', $id);
		$this->db->where('dependencias_tipo_id', $tipo);
		return $this->db->update('recreacion', $data);
	}


	/*actualizar tabla dependencia*/

	public function actualizar_depen($id, $data)
	{
		# actualizo
		$this->db->where('dep_id', $id);
		return $this->db->update('dependencia', $data);
	}



	/*consultar el id al cual pertenece una instalacion*/
	public function consultar_id_depen_tipo($tipo, $id_dep)
	{
		$datos = $this->db->query('SELECT `id` FROM `dependencias_tipo` WHERE `dependencia`= ' . $id_dep . ' and `tipo` =' . $tipo . '');
		return $datos->result();
	}

	/*retorno de medidas*/
	public function medidas_depend($id)
	{
		$datos = $this->db->query('SELECT `observaciones`,`ancho`,`largo`,`alto` 
		FROM dependencia WHERE `dep_id`=' . $id . '');

		return $datos->result();
	}


	//subcategorias con temporadas planificadas

	public function sub_pl_temp($dep)
	{
		$sql = $this->db->query('SELECT plan_temporada.pl_subcategoria, sub_categoria.sctg_nombre,categoria.ctg_nombre FROM `plan_temporada` INNER JOIN categoria on plan_temporada.pl_categoria = categoria.ctg_id INNER JOIN sub_categoria on plan_temporada.pl_subcategoria = sub_categoria.sctg_id WHERE `pl_dependencia` = ' . $dep . ' AND pl_year=YEAR(CURDATE()) GROUP by (pl_subcategoria)');

		return $sql->result();
	}

	//planificacion temporada, subcategoria,dependencia
	public function pl_temp($dep, $sub, $temp)
	{
		$sql = $this->db->query('SELECT plan_temporada.pl_subcategoria,plan_temporada.pl_temporada, plan_temporada.pl_cantidad, periocidad.periocidad
FROM `plan_temporada`
INNER JOIN periocidad on plan_temporada.pl_periocidad = periocidad.id
WHERE pl_dependencia = ' . $dep . ' AND pl_year=YEAR(CURDATE()) AND pl_subcategoria=' . $sub . ' AND pl_temporada=' . $temp . '');

		return $sql->result();
	}
}
