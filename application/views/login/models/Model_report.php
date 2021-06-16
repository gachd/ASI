<?php 
 class model_report extends CI_Model{
	 
	 function getSector(){ 
	   		 
			 $sec = $this ->db->get('sectores');
			 
			 if($sec -> num_rows() > 0){
				 return $sec->result();
				 }
	 }
	 
	 function getDepen($id){ 
	     $this->db->where('dep_habilitado = 0');
		 $this->db->where('sector = '.$id.'');
		 $this -> db -> order_by('letra','asc');
		 
			 $dep = $this ->db->get('dependencia');
			 
			 if($dep -> num_rows() > 0){
				 return $dep->result();
				 }
		 
		 
	 }
	 function getDepenID($id){ 
	     $this->db->where('dep_habilitado = 0');
		 $this->db->where('dep_id = '.$id.'');
		 $this -> db -> order_by('letra','asc');
		 
			 $dep = $this ->db->get('dependencia');
			 
			 if($dep -> num_rows() > 0){
				 return $dep->result();
				 }
	 }
	 
	 function insert_incident ($data){
		 $this -> db -> insert('report_incidentes', $data);
		  }
    
	/*incidentes pendientes por usuario*/
	 function getIncidentes($usuario){ 
	 switch($usuario){
		 /*GERENTE*/
		 case "10457797-0";/*E.Sanchez*/
		  case "15173239-9";/*M. Salgado*/
		  case "16895551-0";/*v.venegas*/
		 $trabajos = $this->db->query('SELECT `ri_id`,`ri_asignado`,`ri_usuario`,`ri_fecha_report`,report_categoria.rc_nombre,report_prioridad.rp_nombre, sectores.nombre,dependencia.dep_nombre,`ri_prioridad`,`ri_estado`,ri_desc,ri_tiempo,ri_fecha_cierre
FROM `report_incidentes` 
INNER JOIN report_categoria ON report_incidentes.ri_categoria = report_categoria.rc_id 
INNER JOIN report_prioridad ON report_incidentes.ri_prioridad = report_prioridad.rp_id
INNER JOIN sectores ON report_incidentes.ri_sector = sectores.id
INNER JOIN dependencia ON report_incidentes.ri_dep = dependencia.dep_id
WHERE `ri_estado`=0 ORDER BY ri_fecha_report DESC');
break;
/*SCUOLA*/
case "15218480-8":
		 $trabajos = $this->db->query('SELECT `ri_id`,`ri_asignado`,`ri_usuario`,`ri_fecha_report`,report_categoria.rc_nombre,report_prioridad.rp_nombre, sectores.nombre,dependencia.dep_nombre,dependencia.dep_id,`ri_prioridad`,`ri_estado`,ri_desc,ri_tiempo,ri_fecha_cierre
FROM `report_incidentes` 
INNER JOIN report_categoria ON report_incidentes.ri_categoria = report_categoria.rc_id 
INNER JOIN report_prioridad ON report_incidentes.ri_prioridad = report_prioridad.rp_id
INNER JOIN sectores ON report_incidentes.ri_sector = sectores.id
INNER JOIN dependencia ON report_incidentes.ri_dep = dependencia.dep_id
WHERE `ri_estado`=0 AND dep_id=16 ORDER BY ri_fecha_report DESC');
break;
default:
$trabajos = $this->db->query('SELECT `ri_id`,`ri_asignado`,`ri_usuario`,`ri_fecha_report`,report_categoria.rc_nombre,report_prioridad.rp_nombre, sectores.nombre,dependencia.dep_nombre,`ri_prioridad`,`ri_estado`,ri_desc,ri_tiempo,ri_fecha_cierre
FROM `report_incidentes` 
INNER JOIN report_categoria ON report_incidentes.ri_categoria = report_categoria.rc_id 
INNER JOIN report_prioridad ON report_incidentes.ri_prioridad = report_prioridad.rp_id
INNER JOIN sectores ON report_incidentes.ri_sector = sectores.id
INNER JOIN dependencia ON report_incidentes.ri_dep = dependencia.dep_id
WHERE (`ri_asignado`="'.$usuario.'" OR `ri_usuario`="'.$usuario.'") AND `ri_estado`=0 ORDER BY ri_fecha_report DESC');
 }
	 

			 if($trabajos -> num_rows() > 0){
				 return $trabajos->result();
				 }
	 }

	 
	 
	 
	 function getIncidentesID($id){ 
	 		 $this->db->where('ri_id = "'.$id.'"');
			 $trabajos = $this ->db->get('report_incidentes');	
			 if($trabajos -> num_rows() > 0){
				 return $trabajos->result();
				 }
	 }
	 function updateIncidente($id){
		$this->db->query('UPDATE report_incidentes
SET `ri_estado` =1, ri_fecha_cierre=NOW()
WHERE `ri_id`='.$id.'');
		 }
	 function deleteIncidente($id){
		 $this->db->query('DELETE FROM report_incidentes WHERE ri_id ='.$id.' AND  ri_estado=0');
	 }
	 function getIncidentesFecha($inicio,$termino,$usuario){ 
	 
	 
		 
	 switch($usuario){
		 /*GERENTE*/
		 case "10457797-0":
		 $trabajos = $this->db->query('SELECT `ri_id`,`ri_asignado`,`ri_usuario`,`ri_fecha_report`,report_categoria.rc_nombre,report_prioridad.rp_nombre, sectores.nombre,dependencia.dep_nombre,`ri_prioridad`,`ri_estado`,ri_desc,ri_tiempo,ri_fecha_cierre
FROM `report_incidentes` 
INNER JOIN report_categoria ON report_incidentes.ri_categoria = report_categoria.rc_id 
INNER JOIN report_prioridad ON report_incidentes.ri_prioridad = report_prioridad.rp_id
INNER JOIN sectores ON report_incidentes.ri_sector = sectores.id
INNER JOIN dependencia ON report_incidentes.ri_dep = dependencia.dep_id
Where  `ri_fecha_report` BETWEEN "'.$inicio.'" and "'.$termino.'"
ORDER BY ri_fecha_report DESC');
break;
/*SCUOLA*/
case "15218480-8":
		 $trabajos = $this->db->query('SELECT `ri_id`,`ri_asignado`,`ri_usuario`,`ri_fecha_report`,report_categoria.rc_nombre,report_prioridad.rp_nombre, sectores.nombre,dependencia.dep_nombre,dependencia.dep_id,`ri_prioridad`,`ri_estado`,ri_desc,ri_tiempo,ri_fecha_cierre
FROM `report_incidentes` 
INNER JOIN report_categoria ON report_incidentes.ri_categoria = report_categoria.rc_id 
INNER JOIN report_prioridad ON report_incidentes.ri_prioridad = report_prioridad.rp_id
INNER JOIN sectores ON report_incidentes.ri_sector = sectores.id
INNER JOIN dependencia ON report_incidentes.ri_dep = dependencia.dep_id
WHERE  (`ri_fecha_report` BETWEEN "'.$inicio.'" and "'.$termino.'") AND dep_id=16 ORDER BY ri_fecha_report DESC');
break;
default:
$trabajos = $this->db->query('SELECT `ri_id`,`ri_asignado`,`ri_usuario`,`ri_fecha_report`,report_categoria.rc_nombre,report_prioridad.rp_nombre, sectores.nombre,dependencia.dep_nombre,`ri_prioridad`,`ri_estado`,ri_desc,ri_tiempo,ri_fecha_cierre
FROM `report_incidentes` 
INNER JOIN report_categoria ON report_incidentes.ri_categoria = report_categoria.rc_id 
INNER JOIN report_prioridad ON report_incidentes.ri_prioridad = report_prioridad.rp_id
INNER JOIN sectores ON report_incidentes.ri_sector = sectores.id
INNER JOIN dependencia ON report_incidentes.ri_dep = dependencia.dep_id
WHERE (`ri_asignado`="'.$usuario.'" OR `ri_usuario`="'.$usuario.'") AND (`ri_fecha_report` BETWEEN "'.$inicio.'" and "'.$termino.'")
ORDER BY ri_fecha_report DESC');
 }
	 

			 if($trabajos -> num_rows() > 0){
				 return $trabajos->result();
				 }
	 
		
		
	 }
	 
	 
	 function getPrioridad(){ 
	   	$sec = $this ->db->get('report_prioridad');
		if($sec -> num_rows() > 0){
			return $sec->result();
		}
	}
	 function getPrioridadID($id){ 
		$this->db->where('rp_id ='.$id.'');
	   	$sec = $this ->db->get('report_prioridad');
		if($sec -> num_rows() > 0){
			return $sec->result();
		}
	}
	
	 function getCategoria(){ 
	   	$sec = $this ->db->get('report_categoria');
		if($sec -> num_rows() > 0){
			return $sec->result();
		}
	}
	 function getCategoriaID($id){ 
		$this->db->where('rc_id ='.$id.'');
	   	$sec = $this ->db->get('report_categoria');
		if($sec -> num_rows() > 0){
			return $sec->result();
		}
	}
	
	 function getFunID($id){ 
		 $this->db->where('rut = "'.$id.'"');
 		 $fun = $this ->db->get('funcionario');
			 if($fun -> num_rows() > 0){
				 return $fun->result();
				 }
	 }
	 
	 
	 function getComentID($id){ 
		 $this->db->where('rc_incidente = "'.$id.'"');
 		 $fun = $this ->db->get('report_comentarios');
			 if($fun -> num_rows() > 0){
				 return $fun->result();
				 }
	 }
	 function insert_coment ($data){
		 $this -> db -> insert('report_comentarios', $data);
		  }
	 function deleteComent($id){
		 $this->db->query('DELETE FROM report_comentarios WHERE rc_incidente ='.$id.'');
	 }
	 
	 
	  function getasg()/*ASIGNADOS*/{ 
	   	$asg = $this ->db->get('report_asignado');
		if($asg -> num_rows() > 0){
			return $asg->result();
		}
	}
	  function getAsignados(){ 
			 $trabajos = $this ->db->get('report_asignado ');	
			 if($trabajos -> num_rows() > 0){
				 return $trabajos->result();
				 }
	 }
	  function editarAsignado($id_asignado,$id_incidente){ 
	   	$this->db->set('ri_asignado', $id_asignado);
		$this->db->where('ri_id', $id_incidente);
		$this->db->update('report_incidentes'); // gives UPDATE `mytable` SET `field` = 'field+1' WHERE `id` = 2
		}
		
		function editartiempo($tiempo,$id_incidente){ 
	   	$this->db->set('ri_tiempo', $tiempo);
		$this->db->where('ri_id', $id_incidente);
		$this->db->update('report_incidentes'); // gives UPDATE `mytable` SET `field` = 'field+1' WHERE `id` = 2
		}
		
		
		
	  function selectEstado($id){
		 $this->db->where('ri_id = "'.$id.'"');
 		 $estado = $this ->db->get('report_incidentes');
			 if($estado -> num_rows() > 0){
				 return $estado->result();
				 }
			
		}
	  function getfuncionario($rut){ 
		$this->db->where('rut ="'.$rut.'"');
	   	$sec = $this ->db->get('funcionario');
		if($sec -> num_rows() > 0){
			return $sec->result();
		}
	   }
	  function funcionario_depto($depto){
		$this->db->where('report_cat ="'.$depto.'"');
		$this->db->where('habilitado =0');
	   	$sec = $this ->db->get('funcionario');
		if($sec -> num_rows() > 0){
			return $sec->result();
		}
	  }
     
	
	 
 }
	
 ?>