 <?php

	class model_accionistas extends CI_Model
	{



		function insertar($data)
		{

			$this->db->insert('s_accionista', $data);
		}


		function accionistas()
		{

			$p = $this->db->query('SELECT SUM(t.numero_acciones)as numero_acciones, p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno, a.prsn_rut, a.id_accionista FROM s_accionista a, s_titulos t, s_personas p WHERE t.estado = "1" AND a.prsn_rut = p.prsn_rut AND a.id_accionista = t.id_accionista GROUP BY t.id_accionista');

			return $p->result();
		}


		function nro_acciones($rut)
		{

			$p = $this->db->query('SELECT SUM(t.numero_acciones) as total FROM s_accionista a, s_titulos t, s_personas p WHERE t.estado = "1" AND a.prsn_rut = p.prsn_rut AND a.id_accionista = t.id_accionista AND a.prsn_rut = "' . $rut . '"  ');
			$res2 = $p->result_array();

			$result = $res2[0]['total'];
			return $result;
		}

		function nro_acciones_all()
		{

			$p = $this->db->query('SELECT SUM(t.numero_acciones)as numero_acciones, p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno, a.prsn_rut FROM s_accionista a, s_titulos t, s_personas p WHERE a.prsn_rut = p.prsn_rut AND a.id_accionista = t.id_accionista AND t.estado= 1 GROUP BY  t.id_accionista');

			return $p->result();
		}
		function accionistas_alfabetico()
		{

			$p = $this->db->query('SELECT SUM(t.numero_acciones)as numero_acciones, a.fecha, p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno, a.prsn_rut FROM s_accionista a, s_titulos t, s_personas p WHERE a.prsn_rut = p.prsn_rut AND a.id_accionista = t.id_accionista AND t.estado=1 GROUP BY t.id_accionista ORDER BY p.prsn_nombres ASC');

			return $p->result();
		}


		function accionistas_mayoritarios()
		{

			$p = $this->db->query('SELECT SUM(t.numero_acciones)as numero_acciones, p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno, a.prsn_rut FROM s_accionista a, s_titulos t, s_personas p WHERE a.prsn_rut = p.prsn_rut AND a.id_accionista = t.id_accionista AND t.estado=1 GROUP BY t.id_accionista ORDER BY numero_acciones DESC LIMIT 5');

			return $p->result();
		}



		function datos_ac($rut)
		{

			$p = $this->db->query('SELECT  * from s_accionista a ,s_titulos t , s_transaccion tr where a.prsn_rut = "' . $rut . '"  AND tr.id_accionista = a.id_accionista');
			return $p->result();
		}

		function nro_titulo($rut)
		{
			$p = $this->db->query('SELECT  t.id_titulos as nro_titulo from s_accionista a, s_titulos t where  a.id_accionista = t.id_accionista AND t.estado = 1 AND a.prsn_rut = "' . $rut . '"  ');

			return $p->result();
		}


		function suscritas()
		{

			$p = $this->db->query('SELECT SUM(t.numero_acciones)as suscritas FROM s_accionista a, s_titulos t, s_personas p WHERE a.prsn_rut = p.prsn_rut AND a.id_accionista = t.id_accionista AND t.estado=1');
			return $p->result();
		}

		function accionista_sincontar_accion()
		{

			$p = $this->db->query('SELECT p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno, a.prsn_rut, a.id_accionista FROM s_accionista a, s_personas p WHERE a.prsn_rut = p.prsn_rut ORDER BY a.prsn_rut');
			return $p->result();
		}


		// function poremitir(){

		// 	$p = $this ->db->query('SELECT count(estado) as cont from s_titulos where estado = 0');
		// 	return $p -> result();
		// }


		function ultimos()
		{
			$p = $this->db->query('SELECT SUM(t.numero_acciones) as accionesA, p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno, a.fecha from s_accionista a, s_personas p, s_titulos t where a.prsn_rut = p.prsn_rut AND t.id_accionista=a.id_accionista AND  t.estado=1 GROUP BY t.id_accionista ORDER BY `a`.`fecha` DESC LIMIT 5');
			return $p->result();
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


		function datosaccionista($id)
		{

			$p = $this->db->query('SELECT * FROM s_accionista a, s_personas p ,s_comunas comu, s_provincia pro, s_regiones regi WHERE p.prsn_rut = a.prsn_rut AND comu.comuna_id=p.s_comunas_comuna_id AND pro.provincia_id=p.provincia_id AND regi.region_id=p.region_id AND a.id_accionista = "' . $id . '"');
			return $p->result();
		}

		function totalemitidas()
		{

			$p = $this->db->query('SELECT SUM(t.numero_acciones)as total_emitidas FROM s_accionista a, s_titulos t, s_personas p WHERE a.prsn_rut = p.prsn_rut AND a.id_accionista = t.id_accionista AND t.estado=1');
			return $p->result();
		}
		function validar_estado($ID)
		{

			$p = $this->db->query('SELECT * FROM s_titulos t, s_accionista a WHERE t.id_accionista = a.id_accionista AND t.estado=1 AND a.id_accionista="' . $ID . '"');
			return $p->result();
		}

		function existe($rut)
		{

			$p = $this->db->query('SELECT * FROM s_personas p , s_accionista a WHERE p.prsn_rut = a.prsn_rut AND a.estado_accionista=1 AND p.prsn_rut ="' . $rut . '"');
			return $p->result();
		}

		function update($data, $id)
		{


			$this->db->where('id_accionista', $id);
			$this->db->update('s_accionista', $data);
		}


		function buscar_por_fecha($fecha1, $fecha2,$tipo)
		{

			$p = $this->db->query('SELECT p.prsn_rut,p.prsn_nombres, p.prsn_apellidopaterno,p.prsn_apellidomaterno,a.fecha FROM s_personas p, s_accionista a WHERE p.prsn_rut=a.prsn_rut AND a.estado_accionista='.$tipo.' AND a.fecha<= "'. $fecha2 .'"  AND a.fecha>="' . $fecha1 . '"');
			return $p->result_array();

			
		}
	}







	?>