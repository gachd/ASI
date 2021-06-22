 <?php 

class model_accionistas extends CI_Model{



	function insertar($data)
	{

		$this->db->insert('s_accionista', $data);
	}

	 function accionistas(){

	 	$p = $this ->db->query('SELECT  * from s_accionista a, s_personas p where a.prsn_rut = p.prsn_rut');

		return $p -> result();

	}

	function nro_acciones($rut){

	 	$p = $this ->db->query('SELECT SUM(a.nro_acciones) as total from s_accionista a, s_titulos t where a.prsn_rut = "'.$rut.'" AND ');
         $res2 = $p->result_array();

         $result = $res2[0]['total'];
		return $result;

	}

	function datos_ac($rut){

	 	$p = $this ->db->query('SELECT  * from s_accionista a ,s_titulos t , s_transaccion tr where a.prsn_rut = "'.$rut.'"  AND tr.id_accionista = a.id_accionista');
	 	return $p-> result();
        

	}

	function nro_titulo($rut){
		$p = $this ->db->query('SELECT  t.nro_titulo from s_accionista a, s_titulos t where a.prsn_rut = "'.$rut.'" ');

		return $p -> result();
	}


	function suscritas(){

		$p = $this ->db->query('SELECT * from s_acciones');
		return $p -> result();
	}


	function poremitir(){

		$p = $this ->db->query('SELECT count(estado) as cont from s_titulos where estado = 0');
		return $p -> result();
	}


    function ultimos(){
    	$p = $this ->db->query('SELECT * from s_accionista a, s_personas p where a.prsn_rut = p.prsn_rut limit 5');
    	return $p -> result();
    }

	function ultimoId()
	{

		$this->db->select_max('id_accionista');

		$this->db->from('s_accionista');

		$query2 = $this->db->get();

		// $num_rows = $query2->num_rows();

		$res2 = $query2->result_array();

		$result = $res2[0]['id_accionista'];

		return $result;
	}


}







?>