<?php 
 class model_noticias extends CI_Model{

/*todas las noticias*/
 	public function all_noticias()
{
	$todas = $this->db->query('SELECT `id`,`titulo`,`fecha`,`descripcion`,`imagen`,`instituto`,`carpeta`,`img_inicio`,`img_fin` FROM `web_actividades` ORDER BY id DESC');

	return $todas -> result();
}
/*10 ultimas noticias*/
 	public function ten_noticias()
{
	$todas = $this->db->query('SELECT `id`,`titulo`,`fecha`,`descripcion`,`imagen`,`instituto`,`carpeta`,`img_inicio`,`img_fin` FROM `web_actividades` ORDER BY id DESC limit 10');

	return $todas -> result();
}
/*20 ultimas noticias*/
 	public function twenty_noticias()
{
	$todas = $this->db->query('SELECT `id`,`titulo`,`fecha`,`descripcion`,`imagen`,`instituto`,`carpeta`,`img_inicio`,`img_fin` FROM `web_actividades` ORDER BY id DESC limit 20');

	return $todas -> result();
}
/* -------------------------------------------------------------------------------------------- */
/*funcion para eliminar noticia*/
	public function eliminar_noticia($id){
		
		$this->db->where('id', $id);
		$this->db->delete('web_actividades');

	}
/* ---------------funcion para eliminar de galeria -----------*/
public function eliminar_galeria($id)
{
	$this->db->where('categoria',$id);
	$this->db->delete('web_galeria');
}


/* ------------------------------------------------------------------------------------------------*/

public function consultar_datos($id)
{
	# consulto datos y retorno
	$datos=$this->db->query('SELECT `instituto` as dato FROM `web_actividades` WHERE `id`='.$id.'');
	return $datos -> result();
}

/* ------------------------------------------------------------------------------------------ */
/*retorno info del estadio*/
public function retorno_datos($id)
{
	$datos=$this->db->query('SELECT `carpeta`,`img_inicio`,`img_fin` FROM `web_actividades` WHERE `id`='.$id.'');
	return $datos -> result();
}

/* ---------------------- agregar nueva noticia ---------------------- */
public function publicar_noticia($noticias)
{

	/*agrego la noticia*/
$this -> db -> insert('web_actividades', $noticias);
}
/* ------------------- agregar galeria ----------------*/
public function galeria_adds($data)
{
	$this -> db -> insert('web_galeria', $data);
	
}


/*----------------id maximo en la tabla noticias*/
public function nroregnoticias()
{
	$resultado=$this->db->query('SELECT MAX(id) as id FROM `web_actividades`');
	return $resultado -> result();
}

/* ---------------id maximo de la tabla galeria ------------*/
public function ultimoreg()
{
	$resultado=$this->db->query('SELECT MAX(id) AS id FROM web_galeria');
	return $resultado ->result();
}
/* --------------------- retorna los registros de la noticia ---------------------*/
public function getNoticias()
{
	# retorna todas las prioridades
	$resultado=$this->db->query('SELECT * FROM web_actividades ORDER BY `id` DESC');
	return $resultado ->result();
}

/*retorna la info de la noticia que deseo editar*/
public function info_edit_noticias($id)
{
	# retorna  la info de las noticias
	$resultado = $this->db->query('SELECT * FROM web_actividades WHERE `id`='.$id.'');
	return $resultado -> result();
}
/*retorna la cantidad de imagenes de acuerdo a la actividad asociada*/
public function cant_img_galeria($id)
{
	$resultado = $this->db->query('SELECT MAX(`id`) as total FROM `web_galeria` WHERE `id`='.$id.'');
	return $resultado -> result();
}
/*consulta tabla galeria*/
public function galeria_retorno($id)
{
	# retorno reg galeria
	$resultado = $this ->db->query('SELECT * FROM `web_galeria` WHERE `id`='.$id.'');
	return $resultado -> result();
}

 }

 ?>