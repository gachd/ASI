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
		function getSub_sector($id){
		 $this->db->where('sector = '.$id.'');
		 $this -> db -> order_by('letra','asc');
		 
			 $dep = $this ->db->get('sub_sectores');
			 
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
		 
		  
	 function insert_dependencia_tipo ($data){
		 $this -> db -> insert('dependencias_tipo', $data);
		  }	
		  
	 function insert_instalaciones($data){
		 $this -> db -> insert('instalaciones', $data);
		  }	
	 function insert_vegetacion($data){
		 $this -> db -> insert('vegetacion', $data);
		  }	
	function insert_recreacion($data){
		 $this -> db -> insert('recreacion', $data);
		  }	
		  
		  
   function tipo_vegetacion(){ 
			 $tipo = $this ->db->get('vegetacion_tipo');
			 if($tipo -> num_rows() > 0){
				 return $tipo->result();
				 }
	 }	
	 
	  function categoria_veg($tipo){ 
	   		  $categoria = $this->db->where('vegcat_tipo',$tipo);
			 $categoria = $this ->db->get('vegetacion_categoria');
			
			 
			 if($categoria -> num_rows() > 0){
				 return $categoria->result();
				 }
	 }	  
		 
	function getSubDependencia($id){ 
	    $dep= $this->db->query('SELECT * FROM `sub_dependencias` WHERE `dependencia` = '.$id.' AND `habilitado` = 0');
		   return $dep->result();
				 
    }
	 function getTipoDepen($id){ 
	    $tipo= $this->db->query('SELECT tipo, dep_tipos.nom_tipo
 FROM `dependencias_tipo` 
INNER JOIN dep_tipos ON dependencias_tipo.tipo = dep_tipos.id
 WHERE dependencia = '.$id.'');
		   if($tipo -> num_rows() > 0){
				 return $tipo->result();
				 }
				 
		 }
	
	function getInstalaciones($id){ 
	   		  $ins = $this->db->where('dependencia', $id);
			   $ins = $this->db->where('inst_habilitado', 0);
			 $ins = $this ->db->get('instalaciones');
			
			 
			 if($ins -> num_rows() > 0){
				 return $ins->result();
				 }
	 }
	 
	 function getVegetacion($id){ 
	   		  $query = $this->db->query('SELECT `veg_fecha_plantacion`,`veg_categoria`,`veg_tipo`,`veg_tipo_riego`,vegetacion_categoria.vegcat_categoria, vegetacion_tipo.vegtipo_tipo,veg_cantidad
FROM `vegetacion`
INNER JOIN vegetacion_categoria ON vegetacion.veg_categoria = vegetacion_categoria.vegcat_id
INNER JOIN vegetacion_tipo ON vegetacion.veg_tipo = vegetacion_tipo.vegtipo_id
WHERE `dependencia` = '.$id.' and veg_habilitado=0');
			  if($query -> num_rows() > 0){
				 return $query->result();
				 }
	 }
	function getRecreacion($id){ 
				$recreacion = $this->db->where('dependencia', $id);
				$recreacion = $this->db->where('r_habilitado',0);
				$recreacion = $this ->db->get('recreacion');
				if($recreacion -> num_rows() > 0){
					 return $recreacion->result();
				}
	 	  }

    function deshabilitar_dependencia($sb){
		$this->db->set('dep_habilitado', 1);
		$this->db->where('dep_id', $sb);
		$this->db->update('dependencia');
	}
 	function deshabilitar_instalacion($sb){
		$this->db->set('inst_habilitado', 1);
		$this->db->where('dependencia', $sb);
		$this->db->update('instalaciones');
	}
	function deshabilitar_vegetacion($sb){
		$this->db->set('veg_habilitado', 1);
		$this->db->where('dependencia', $sb);
		$this->db->update('vegetacion');
	}
	function deshabilitar_recreacion($sb){
		$this->db->set('r_habilitado', 1);
		$this->db->where('dependencia', $sb);
		$this->db->update('recreacion');
	}	
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

		$query = $this -> db -> query ('SELECT alto,ancho,largo,(ancho*largo)m_cuadrados FROM `dependencia` WHERE `dep_id`='.$dep.'');
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

}
?>