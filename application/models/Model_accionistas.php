 <?php

	class model_accionistas extends CI_Model
	{



		function insertar($data)
		{

			$this->db->insert('s_accionista', $data);
		}

		function insertar_comundad_hereditaria($data)
		{

			$this->db->insert('comunidad_hereditaria', $data);
		}


		function accionistas_es_socio($rut)
		{

			$this->db->select('*');
			$this->db->from('s_socios as s,corporaciones as c');
			$this->db->where('s.prsn_rut', $rut);
			$this->db->where('s.estado', 0);
			$this->db->where('s.corporacion = c.co_rut');

			$p = $this->db->get();

			return $p->result();
		}



		function accionistas()
		{

			$this->db->select('SUM(t.numero_acciones)as numero_acciones, p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno, a.prsn_rut, a.id_accionista,p.prsn_fallecido');
			$this->db->from('s_accionista a, s_titulos t, s_personas p');
			$this->db->where('t.estado', 1);
			$this->db->where('a.prsn_rut = p.prsn_rut');
			$this->db->where('a.id_accionista = t.id_accionista');
			$this->db->group_by('t.id_accionista');

			$Q = $this->db->get();

			return $Q->result();

		}
		function accionistasALL()
		{

			$p = $this->db->query('SELECT p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno, a.prsn_rut, a.id_accionista FROM s_accionista a, s_titulos t, s_personas p WHERE  a.prsn_rut = p.prsn_rut AND a.id_accionista = t.id_accionista GROUP BY t.id_accionista');

			return $p->result();
		}
		function accionistasALL_Activos()
		{

			$p = $this->db->query('SELECT p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno, a.prsn_rut, a.id_accionista FROM s_accionista a, s_titulos t, s_personas p WHERE  a.prsn_rut = p.prsn_rut AND a.id_accionista = t.id_accionista AND a.estado_accionista="1" GROUP BY t.id_accionista');

			return $p->result();
		}

		function id_activos()
		{

			$p = $this->db->query('SELECT id_accionista FROM  s_accionista WHERE estado_accionista= "1"');

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

			$p = $this->db->query('SELECT SUM(t.numero_acciones)as numero_acciones, p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno,a.fecha, a.prsn_rut FROM s_accionista a, s_titulos t, s_personas p WHERE a.prsn_rut = p.prsn_rut AND a.id_accionista = t.id_accionista AND t.estado=1 GROUP BY t.id_accionista ORDER BY numero_acciones DESC LIMIT 5');

			return $p->result();
		}



		function datos_ac($rut)
		{

			//$p = $this->db->query('SELECT  * from s_accionista a ,s_titulos t , s_transaccion tr where a.prsn_rut = "' . $rut . '"  AND tr.id_accionista = a.id_accionista');
			$p = $this->db->query('SELECT  * from s_accionista a ,s_titulos t where a.prsn_rut = "' . $rut . '"  AND t.id_accionista = a.estado_accionista group by a.id_accionista');
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
			//Ultimo ID de persona

			$p = $this->db->query('select MAX(prsn_id) as maximo FROM s_personas ');
			return $p->result();
		}
		function ultimoIdAccionista()
		{
			//Ultimo ID de accionusta

			$p = $this->db->query('select MAX(id_accionista) as maximo FROM s_accionista');
			return $p->result();
		}
		function ultimoIdTitulo()
		{
			//Ultimo ID de titulo

			$p = $this->db->query('select MAX(id_titulos) as maxTitulo FROM s_titulos');
			return $p->result();
		}


		function datosaccionista($id)
		{

			//$p = $this->db->query('SELECT DISTINCT a.id_accionista, p.prsn_rut,a.fecha,a.foja_accionista,a.libro_accionista,a.estado_accionista,a.fecha_baja,a.path,p.prsn_apellidopaterno,p.prsn_apellidomaterno,p.prsn_nombres,p.prsn_fechanacimi,p.prsn_sexo,p.prsn_direccion,p.prsn_email,p.prsn_fono_movil,p.prsn_tipo,p.s_estado_civil_estacivil_id,p.s_comunas_comuna_id,p.region_id,p.provincia_id, a.foja_accionista  FROM s_accionista a, s_personas p ,s_comunas comu, s_provincia pro, s_regiones regi WHERE p.prsn_rut = a.prsn_rut AND comu.comuna_id=p.s_comunas_comuna_id AND a.id_accionista = "'.$id.'"');
			$p = $this->db->query('SELECT * FROM s_accionista a, s_personas p ,s_comunas comu, s_provincia pro, s_regiones regi WHERE p.prsn_rut = a.prsn_rut AND comu.comuna_id=p.s_comunas_comuna_id AND pro.provincia_id=comu.s_provincia_provincia_id AND regi.region_id=pro.s_regiones_region_id AND a.id_accionista = "' . $id . '"');
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

			$p = $this->db->query('SELECT a.prsn_rut,a.id_accionista  FROM s_personas p , s_accionista a WHERE p.prsn_rut = a.prsn_rut  AND p.prsn_rut ="' . $rut . '"');
			return $p->result();
		}
		function existeSocio($rut)
		{

			$p = $this->db->query('SELECT s.prsn_rut  FROM s_personas p , s_socios s WHERE p.prsn_rut = s.prsn_rut  AND p.prsn_rut ="' . $rut . '"');
			return $p->result();
		}

		function existePersona($rut)
		{

			/*$p = $this->db->query('SELECT s.prsn_rut  FROM s_personas p , s_socios s WHERE p.prsn_rut = s.prsn_rut  AND p.prsn_rut ="' . $rut . '"'); */

			$this->db->select('*');
			$this->db->from('s_personas');
			$this->db->where('prsn_rut', $rut);

			$p = $this->db->get();

			return $p->result();
		}

		function update($data, $id)
		{


			$this->db->where('id_accionista', $id);
			$this->db->update('s_accionista', $data);
		}


		function buscar_por_fecha_activo($fecha1, $fecha2, $tipo)
		{

			$p = $this->db->query('SELECT p.prsn_rut,p.prsn_nombres, p.prsn_apellidopaterno,p.prsn_apellidomaterno,a.fecha,a.estado_accionista, a.fecha_baja FROM s_personas p, s_accionista a WHERE p.prsn_rut=a.prsn_rut AND a.estado_accionista=' . $tipo . ' AND a.fecha<= "' . $fecha2 . '"  AND a.fecha>="' . $fecha1 . '"');
			return $p->result_array();
		}

		function buscar_por_fecha_baja($fecha1, $fecha2, $tipo)
		{

			$p = $this->db->query('SELECT p.prsn_rut,p.prsn_nombres, p.prsn_apellidopaterno,p.prsn_apellidomaterno,a.fecha,a.estado_accionista, a.fecha_baja FROM s_personas p, s_accionista a WHERE p.prsn_rut=a.prsn_rut AND a.estado_accionista=' . $tipo . ' AND a.fecha_baja<= "' . $fecha2 . '"  AND a.fecha_baja>="' . $fecha1 . '"');
			return $p->result_array();
		}

		function HistorialTitulosporAccionista($id_accionista)
		{


			//funcion que obtiene todos los titulos por el id del accionista sean activos o inactivos


			$this->db->select('*');
			$this->db->from('s_titulos');
			$this->db->where('id_accionista', $id_accionista);

			$p = $this->db->get();
			return $p->result();
		}

		function TitulosActivosporAccionista($id_accionista)
		{

			$this->db->select('*');
			$this->db->from('s_titulos');
			$this->db->where('id_accionista', $id_accionista);
			$this->db->where('estado', 1);

			$p = $this->db->get();
			return $p->result();
		}

		function datos_accionista_por_rut($rut_accionista)
		{


			$this->db->select('*');
			$this->db->from('s_accionista');
			$this->db->where('prsn_rut', $rut_accionista);
			$p = $this->db->get();
			return $p->result();
		}

		function accionistaInactivo($id_accionista)
		{

			$this->db->select('*');
			$this->db->from('s_accionista');
			$this->db->where('id_accionista', $id_accionista);
			$this->db->where('estado_accionista', 0);
			$p = $this->db->get();
			return $p->result();
		}
	}


	?>