 <?php 

class model_accionistas extends CI_Model{



	function insertar($data)
	{

		$this->db->insert('s_accionista', $data);
	}

	 function accionistas(){

	 	$p = $this ->db->query('SELECT SUM(t.numero_acciones)as numero_acciones, p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno, a.prsn_rut FROM s_accionista a, s_titulos t, s_personas p WHERE a.prsn_rut = p.prsn_rut AND a.id_accionista = t.id_accionista GROUP BY  t.id_accionista');

		return $p -> result();

	}

	function nro_acciones($rut){

	 	$p = $this ->db->query('SELECT SUM(t.numero_acciones) as total FROM s_accionista a, s_titulos t, s_personas p WHERE a.prsn_rut = p.prsn_rut AND a.id_accionista = t.id_accionista AND a.prsn_rut = "'.$rut.'"  ');
         $res2 = $p->result_array();

         $result = $res2[0]['total'];
		return $result;

	}

	function nro_acciones_all(){

		$p = $this ->db->query('SELECT SUM(t.numero_acciones)as numero_acciones, p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno, a.prsn_rut FROM s_accionista a, s_titulos t, s_personas p WHERE a.prsn_rut = p.prsn_rut AND a.id_accionista = t.id_accionista GROUP BY  t.id_accionista');
		
		return $p -> result();
	}

	function datos_ac($rut){

	 	$p = $this ->db->query('SELECT  * from s_accionista a ,s_titulos t , s_transaccion tr where a.prsn_rut = "'.$rut.'"  AND tr.id_accionista = a.id_accionista');
	 	return $p-> result();
        

	}

	function nro_titulo($rut){
		$p = $this ->db->query('SELECT  t.id_titulos as nro_titulo from s_accionista a, s_titulos t where  a.id_accionista = t.id_accionista AND a.prsn_rut = "'.$rut.'"  ');

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