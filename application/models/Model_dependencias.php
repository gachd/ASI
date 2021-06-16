<?php 
 class model_dependencias extends CI_Model{
	 
	 function getSector(){ 
	   		  $sec = $this->db->where('categoria <>',0);
			 $sec = $this ->db->get('sectores');
			
			 
			 if($sec -> num_rows() > 0){
				 return $sec->result();
				 }
	 }
	 function getDepen_subsector($id){ 
	     $this->db->where('dep_habilitado = 0');
		 $this->db->where('sub_sector = '.$id.'');
		 $this -> db -> order_by('letra','asc');
		 
			 $dep = $this ->db->get('dependencia');
			 
			 if($dep -> num_rows() > 0){
				 return $dep->result();
				 }
		 }

	function getDepen_sector($sector){ 
	    $this->db->where('sector = '.$sector.'');
	    $this->db->where('dep_habilitado = 0');
		$this -> db -> order_by('letra','asc');
		$dep = $this ->db->get('dependencia');
		if($dep -> num_rows() > 0){
		 return $dep->result();
		}
    }

    //subsectores por sector
	function getSub_sector($id){
		$this->db->where('sector = '.$id.'');
		$this -> db -> order_by('letra','asc');
		$dep = $this ->db->get('sub_sectores');
		if($dep -> num_rows() > 0){
			return $dep->result();
		}
				 
				 } 

    // subsector segun id
	function getSubsector($id){
		$this->db->where('id = '.$id.'');
		$this -> db -> order_by('letra','asc');
		$dep = $this ->db->get('sub_sectores');
		if($dep -> num_rows() > 0){
			return $dep->result();
		}
				 
				 } 

	function getEquipo($t){
		$this->db->where('tipo = '.$t.'');
		$this -> db -> order_by('nombre','asc');
		$dep = $this ->db->get('equipo');
		if($dep -> num_rows() > 0){
			return $dep->result();
		}
				 
				 } 
		 
		 
	 function insert_dependencias ($data){
		 $this -> db -> insert('dependencia', $data);
		  }	
		  /* max id _dependencias*/	
	 function maxid(){
		  $query=$this->db->query("SELECT MAX(`dep_id`) AS max_id FROM dependencia");
		  return $query->result();
		 }	
		  /* max id _dependencias_tipo*/
		function maxid_tipo_dep(){
		  $query=$this->db->query("SELECT MAX(`id`) AS max_id FROM dependencias_tipo");
		  return $query->result();
		 } 
		 
	function getSubDependencia($id){ 
	    $dep= $this->db->query('SELECT * FROM `sub_dependencias` WHERE `dependencia` = '.$id.' AND `habilitado` = 0');
		   return $dep->result();}
    function getTipoDepen($id){ 
	    $tipo= $this->db->query('SELECT tipo, dep_tipos.nom_tipo
        FROM `dependencias_tipo` 
        INNER JOIN dep_tipos ON dependencias_tipo.tipo = dep_tipos.id
       WHERE dependencia = '.$id.'');
		   if($tipo -> num_rows() > 0){
				 return $tipo->result();
				 }}
	
	
   
 		
	function permiso_insertar($id){
	    $query = $this -> db -> query ('SELECT * FROM user_permiso WHERE id_usuario LIKE "'.$id.'" AND ((id_permiso = 8 AND `insertar` = 1) OR (id_permiso = 6))');
	  return $query -> result();
	}	

	function sctg_depend($dep){

		$query = $this -> db -> query ('SELECT `sctg_id`,`dependencia` FROM trabajos_has_dependencia
INNER JOIN trabajos on trabajos_has_dependencia.trabajo = trabajos.tb_id
WHERE dependencia='.$dep.'
GROUP BY sctg_id');
	return $query -> result();

	}
/*medidas dependencia*/
function medidas_dependencia($dep){

		$query = $this -> db -> query ('SELECT alto,ancho,largo,(ancho*largo)m_cuadrados,observaciones,dep_nombre FROM `dependencia` WHERE `dep_id`='.$dep.'');
	return $query -> result();

	}
 

function dias_transcurridos($sctg_id,$dep_id){

	$query=$this-> db -> query('SELECT trabajos.tb_fecha, trabajos.tb_estado, DATEDIFF(curdate(),tb_fecha) as transcurrido FROM `trabajos_has_dependencia` INNER JOIN trabajos on trabajos_has_dependencia.trabajo = trabajos.tb_id
	 WHERE `sctg_id` = '.$sctg_id.' AND `dependencia` = '.$dep_id.' and trabajos.tb_estado=1 
	 ORDER BY tb_fecha DESC LIMIT 1');
	return $query -> result();
}

function dias_faltan($sctg_id,$dep_id){

	$query=$this-> db -> query('SELECT trabajos.tb_fecha, trabajos.tb_estado, DATEDIFF(tb_fecha,curdate()) as falta FROM `trabajos_has_dependencia` INNER JOIN trabajos on trabajos_has_dependencia.trabajo = trabajos.tb_id
	 WHERE `sctg_id` = '.$sctg_id.' AND `dependencia` = '.$dep_id.' and trabajos.tb_estado=0  and  tb_fecha>=CURDATE() 
ORDER BY `trabajos`.`tb_fecha` ASC LIMIT 1');
	return $query -> result();
}


/* ---------------------------------------------------------------------------------- */


/*retorno los datos de la dependencia*/
public function getdependencia ($datofiltrador)
{
		$depen = $this->db->where('dep_id', $datofiltrador);
		$depen = $this->db->get('dependencia');

		return $depen -> result();
}


public function det_dep($id)
{
	$sql = $this->db->query('SELECT dependencia.*, sub_sectores.nombre, sub_sectores.id, dep_estado.estado FROM `dependencia`
INNER JOIN sub_sectores on dependencia.sub_sector = sub_sectores.id
INNER JOIN dep_estado on dependencia.dep_habilitado = dep_estado.id
WHERE `dep_id` = '.$id.'');
	return $sql -> result();
}



/*retorno los datos de sector*/
public function retorno_sectores()
{
	$sectores = $this->db->query('SELECT `id`,`nombre`,`categoria` 
								FROM `sectores`');
	return $sectores -> result();
}
/*retorno los subsectores*/
public function retorno_subsectores($filtrador)
{
	$subsectores = $this ->db->query('SELECT `id`,`nombre`,`letra`,`sector`
									 FROM `sub_sectores`
									  WHERE `sector`='.$filtrador.'');
	return $subsectores -> result();
}

/* retorno de todas las dependencias tipos para ver si debo o no imprimir el tipo boton actualizar*/
public function all_dependencias()
{
	$todas = $this->db->query('SELECT `id`,`tipo`,`dependencia`,`sub_sector`,`sector`
	FROM `dependencias_tipo` 
		GROUP BY `dependencia`');
	return $todas -> result();
}

/*retorna todas las dependencias*/
public function alldepend($fillsector,$fillsub)
{
	$todas = $this->db->query('SELECT `dep_id`,`dep_nombre`,`dep_critico`,`dep_habilitado`,`sub_sector`,`sector`,`letra` FROM `dependencia` where `sub_sector`='.$fillsector.'&& `sub_sector`='.$fillsub.'');

	return $todas -> result();
}

/*RETORNA EL TIPO de una dependencia */
public function tiporeturn($id){
	$datos = $this ->db->query('SELECT `tipo`
      FROM `dependencias_tipo` 
    WHERE `dependencia`='.$id.'');
	return $datos -> result();
}


/*retorno de tipo de instalacion ejem : edificacion etc */

public function consultas_instalacion($solicitud)
{
	# consultas tipo estructura
	if ($solicitud=="1") {
		$datos = $this ->db->query('SELECT `material_nombre`,`id_tipo` FROM `materiales` 
			WHERE `id_tipo`='.$solicitud.'');
		return $datos -> result();
	}
	#consulta 
	if ($solicitud =="2") {
		#consulta por los materiales
		$datos = $this ->db->query('SELECT `id_tipo`,`material_nombre` FROM `materiales` where `id_tipo`
		 ='.$solicitud.'');
		
		return $datos -> result();
	}
	if ($solicitud =="3") {
		# consulta para el tipo de piso
		$datos = $this ->db->query('SELECT `id_tipo`,`material_nombre` FROM `materiales` where `id_tipo`
		 ='.$solicitud.'');

		return $datos ->result();
	}

	if ($solicitud =="4") {
		# consulta materiales ventana
		$datos = $this ->db->query('SELECT `id_tipo`,`material_nombre` FROM `materiales` where `id_tipo`
		 ='.$solicitud.'');
		return $datos -> result();
	}
	if ($solicitud =="5") {
		# consulta techumbre
		$datos = $this ->db->query('SELECT `id_tipo`,`material_nombre` FROM `materiales` where `id_tipo`
		 ='.$solicitud.'');
		return $datos -> result();
	}

	if ($solicitud =="6") {
		# consulta 
		$datos = $this ->db->query('SELECT `id_tipo`,`material_nombre` FROM `materiales` where `id_tipo`
		 ='.$solicitud.'');
		return $datos -> result();
	}

}

/* -----------------------------------------------------------------------------------*/

/*consultas vegetacion tipo*/

public function retorno_tipo_vegetacion()
{
	# retorna los tipos de vegetacion
	$datos = $this ->db->query('SELECT `vegtipo_id`,`vegtipo_tipo` FROM `vegetacion_tipo`');
	return $datos -> result();
}

public function retorno_categoria_vegetacion()
{ #retorna la categoria de la vegetacion
	$datos = $this ->db->query('SELECT `vegcat_id`,`vegcat_categoria`,`vegcat_tipo` FROM `vegetacion_categoria`');
	return $datos -> result();
}

public function vegetacion_datos($id)
{
	# retorna los datos de la vegetacion seleccionada
	$datos = $this ->db->query('SELECT `veg_id`,`veg_fecha_plantacion`,`veg_categoria`,`veg_tipo`,`veg_tipo_riego`,`veg_cantidad`,`veg_habilitado`,`dependencias_tipo_id`,`sub_sector`,`dependencia`,`sector` FROM `vegetacion` 
		WHERE `dependencia`='.$id.'');

	return $datos ->result();
}

public function datos_veg_depen($id)
{
	# retorna ancho largo y altura
	$datos = $this ->db->query('SELECT `ancho`,`largo`,`alto` FROM `dependencia` WHERE `dep_id`='.$id.'');
	return $datos ->result();
}

/* --------------------- recreacion -------------------------- */

public function recreacion_datos($id)
{
	# retorna los datos de la recreacion seleccionada

	$datos = $this->db->query('SELECT * FROM `recreacion`
	 WHERE `dependencia` = '.$id.'');
	return $datos -> result();
}


/*eliminar de dependencias_tipo*/
function eliminar_dependencias_tipo($id){
$this->db->where('dependencia',$id);
return $this->db->delete('dependencias_tipo');
}
/*insertar dependencias_tipo*/
public function insert_dependencias_tipo($data)
{
	$this->db->insert('dependencias_tipo', $data); 
}

/*actualizar tabla dependencia*/

public function actualiza_dependencia($id,$data){
	# actualizo
	$this->db->where('dep_id',$id);
	return $this->db->update('dependencia',$data);
}



/*consultar el id al cual pertenece una instalacion*/
public function consultar_id_depen_tipo($tipo,$id_dep)
{
    $datos = $this->db->query('SELECT `id` FROM `dependencias_tipo` WHERE `dependencia`= '.$id_dep.' and `tipo` ='.$tipo.'');
	return $datos ->result();
}

/*retorno de medidas*/
public function medidas_depend($id)
{
	$datos = $this->db->query('SELECT `observaciones`,`ancho`,`largo`,`alto` 
		FROM dependencia WHERE `dep_id`='.$id.'');

	return $datos ->result();
}


//subcategorias con temporadas planificadas

public function sub_pl_temp($dep)
{
	$sql = $this->db->query('SELECT plan_temporada.pl_subcategoria, sub_categoria.sctg_nombre,categoria.ctg_nombre FROM `plan_temporada` INNER JOIN categoria on plan_temporada.pl_categoria = categoria.ctg_id INNER JOIN sub_categoria on plan_temporada.pl_subcategoria = sub_categoria.sctg_id WHERE `pl_dependencia` = '.$dep.' AND pl_year=YEAR(CURDATE()) GROUP by (pl_subcategoria)');

	return $sql ->result();
}

//planificacion temporada, subcategoria,dependencia
public function pl_temp($dep,$sub,$temp)
{
	$sql = $this->db->query('SELECT plan_temporada.pl_subcategoria,plan_temporada.pl_temporada,plan_temporada.pl_periocidad, plan_temporada.pl_cantidad, periocidad.abreviatura,periocidad.periocidad
FROM `plan_temporada`
INNER JOIN periocidad on plan_temporada.pl_periocidad = periocidad.id
WHERE pl_dependencia = '.$dep.' AND pl_year=YEAR(CURDATE()) AND pl_subcategoria='.$sub.' AND pl_temporada='.$temp.'');

	return $sql ->result();
}

/*eliminar de dependencias_tipo*/
function eliminar_caracteristicas_dep($id){
$this->db->where('id_dep',$id);
return $this->db->delete('dep_caracterisitcas');
}

function getCaracteristicas(){ 
	$this -> db -> order_by('c_nombre','asc');
	$query = $this ->db->get('caracteristicas');
	if($query -> num_rows() > 0){
		return $query->result();
	}
}
function insert_caract_dep ($data){
	$this -> db -> insert('dep_caracterisitcas', $data);
}	

function getCaract_dep($id){ 
	$sql = $this->db->query('SELECT `id_caracteristica`,caracteristicas.c_nombre,`detalle`,`id_dep`
      FROM dep_caracterisitcas
      INNER JOIN caracteristicas ON dep_caracterisitcas.id_caracteristica = caracteristicas.c_id
       WHERE id_dep='.$id.'');
	   return $sql ->result();
}


function deshabilitar_dependencia($id){
$this->db->set('dep_habilitado',1);
$this->db->where('dep_id', $id);
$this->db->update('dependencia'); 
}


//informacion subsector 
function detalle_subsector($id){
	$sql = $this->db->query('SELECT SUM(ancho*largo) AS mt, sub_sectores.nombre, sub_sectores.id, sub_sectores.sector, COUNT(dep_id) as total_dep FROM `dependencia` INNER JOIN sub_sectores ON dependencia.sub_sector = sub_sectores.id WHERE `sub_sector`='.$id.'');
	   return $sql ->result();
}
function npersonas_subsector($id){
	$sql = $this->db->query('SELECT SUM(detalle) as total FROM `dep_caracterisitcas` WHERE `id_sub_sector`='.$id.' AND (id_caracteristica=28 OR id_caracteristica=29)');
	   return $sql ->result();
}
function npersonas_dep($id){
	$sql = $this->db->query('SELECT SUM(detalle) as total FROM `dep_caracterisitcas` WHERE `id_dep`='.$id.' AND (id_caracteristica=28 OR id_caracteristica=29)');
	   return $sql ->result();
}
function tipos_subsector($id){
	$sql = $this->db->query('SELECT `tipo`, dep_tipos.nom_tipo
FROM `dependencias_tipo` 
INNER JOIN dep_tipos on dependencias_tipo.tipo = dep_tipos.id
WHERE `sub_sector` = '.$id.' GROUP BY tipo order by nom_tipo ASC ');
	   return $sql ->result();
}

function resdep_subsector($id){
	$sql = $this->db->query('SELECT dep_id,dep_nombre,ancho, largo, alto, (ancho * largo) AS mt, dep_estado.estado, dependencias_tipo.tipo FROM dependencias_tipo INNER JOIN dependencia on dependencias_tipo.dependencia = dependencia.dep_id INNER JOIN dep_estado ON dependencia.dep_habilitado = dep_estado.id
WHERE dependencias_tipo.`sub_sector` = '.$id.'');
	   return $sql ->result();
}
function mt_construidos($id){
	$sql = $this->db->query('SELECT SUM(dependencia.ancho*dependencia.largo) as mtc
FROM `dependencias_tipo`
INNER JOIN dependencia on dependencias_tipo.dependencia = dependencia.dep_id
WHERE dependencias_tipo.sub_sector='.$id.' AND `tipo` = 2');
	   return $sql ->result();
}

function medidas_canchas($id){
	$sql = $this->db->query('SELECT *  FROM `dep_caracterisitcas` WHERE `id_dep` = '.$id.' AND (id_caracteristica=30 OR id_caracteristica=31 OR id_caracteristica=32)');
	   return $sql ->result();
}


function caracteristicas_dep($id){
	$sql = $this->db->query('SELECT caracteristicas.c_nombre,dep_caracterisitcas.detalle,caracteristicas.c_id
FROM `dep_caracterisitcas`
INNER JOIN caracteristicas on dep_caracterisitcas.id_caracteristica = caracteristicas.c_id
WHERE `id_dep` ='.$id.'');
	   return $sql ->result();
}
function trabajos_dep($id){
	$sql = $this->db->query('SELECT tb_id,tb_fecha,(tb_fecha_termino-tb_fecha) AS dif,tb_planificado,tb_responsable,tb_tipo_responsable,
sub_categoria.sctg_nombre,categoria.ctg_nombre,tb_descripcion,tb_tipo_responsable
FROM `trabajos_has_dependencia`
INNER JOIN trabajos on trabajos_has_dependencia.trabajo = trabajos.tb_id
INNER JOIN sub_categoria on trabajos_has_dependencia.sctg_id = sub_categoria.sctg_id
INNER JOIN categoria on trabajos_has_dependencia.ctg_id = categoria.ctg_id
WHERE `dependencia` = '.$id.' AND tb_estado = 1
ORDER BY  tb_fecha DESC limit 10');
	   return $sql ->result();
}
function funcionarios_tb($id){
	$sql = $this->db->query('SELECT funcionario.rut, funcionario.nombre_fun, funcionario.paterno
FROM `funcionario_has_trabajos` 
INNER JOIN funcionario on funcionario_has_trabajos.funcioanrio = funcionario.rut
WHERE `trabajo`='.$id.'
ORDER BY funcionario.paterno DESC');
	   return $sql ->result();
}
function actividades_dep($id){
	$sql = $this->db->query('SELECT act_fecha,(act_fecha-act_fecha_termino) as dif, (act_nsocios+act_nprsns) as prsns, act_responsable, sub_categoria.sctg_nombre FROM `actividades_has_dependencia` INNER JOIN actividades on actividades_has_dependencia.act_id_ad = actividades.act_id INNER JOIN sub_categoria on actividades.act_sctg_id = sub_categoria.sctg_id WHERE `dep_id_ad`='.$id.' AND act_fecha < curdate() ORDER BY actividades.act_fecha DESC limit 10');
	   return $sql ->result();
}
}
?>