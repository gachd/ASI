 <?php

	class model_informe extends CI_Model
	{

		function corp_all(){

			$this->db->select('*');
			$this->db->from('corporaciones');

			
			$consulta = $this->db->get();
			$consulta = $consulta->result();
			return $consulta;

		}





		function activos()
		{

			$sql = $this->db->query("SELECT DISTINCTROW p.prsn_rut, p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno,p.prsn_sexo,p.prsn_email, s.tipo_id,YEAR(CURDATE())-YEAR(p.prsn_fechanacimi)+IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(p.prsn_fechanacimi,'%m-%d'), 0 , -1 ) AS edad FROM s_personas p, s_socios s WHERE s.prsn_rut = p.prsn_rut AND s.estado = 0  AND (s.tipo_id=1 OR s.tipo_id = 3 OR s.tipo_id = 2) order by p.prsn_apellidopaterno");

			return $sql->result();
		}

		function activos_corp($corp)
		{

			$sql = $this->db->query("SELECT DISTINCTROW p.prsn_rut, p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno,p.prsn_sexo,p.prsn_email, s.tipo_id,YEAR(CURDATE())-YEAR(p.prsn_fechanacimi)+IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(p.prsn_fechanacimi,'%m-%d'), 0 , -1 ) AS edad FROM s_personas p, s_socios s WHERE s.prsn_rut = p.prsn_rut AND s.estado = 0  AND s.tipo_id=1 AND s.corporacion ='" . $corp . "' order by p.prsn_apellidopaterno");

			return $sql->result();
		}



		function corp_rangoS($min, $max, $sexo, $corp)
		{




			if ($sexo == 2 || $sexo == 3) {


				if ($sexo == 2) {
					$gen = 1;
				}
				if ($sexo == 3) {
					$gen = 0;
				}


				$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno,p.prsn_sexo,p.prsn_apellidomaterno,p.prsn_email, prsn_fechanacimi from s_personas p, s_socios s where p.prsn_rut = s.prsn_rut AND s.corporacion ="' . $corp . '" AND p.prsn_sexo = "' . $gen . '" AND s.estado = 0  AND s.tipo_id=1 AND  (YEAR(CURDATE())-YEAR(prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) BETWEEN "' . $min . '" AND "' . $max . '"');

				return $cant->result();
			} else {

				//ambos
				$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno,p.prsn_sexo,p.prsn_email, prsn_fechanacimi from s_personas p, s_socios s where p.prsn_rut = s.prsn_rut AND s.corporacion ="' . $corp . '" AND s.estado = 0  AND s.tipo_id=1 AND  (YEAR(CURDATE())-YEAR(prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) BETWEEN "' . $min . '" AND "' . $max . '"');
			}

			return $cant->result();
		}


		function corp_mayorS($mayor, $sexo, $corp)
		{




			if ($sexo == 2 || $sexo == 3) {


				if ($sexo == 2) {
					$gen = 1;
				}
				if ($sexo == 3) {
					$gen = 0;
				}


				$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno,p.prsn_sexo,p.prsn_apellidomaterno,p.prsn_email, prsn_fechanacimi from s_personas p, s_socios s where p.prsn_rut = s.prsn_rut AND s.corporacion ="' . $corp . '" AND p.prsn_sexo = "' . $gen . '" AND s.estado = 0  AND s.tipo_id=1 AND  (YEAR(CURDATE())-YEAR(prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) >= "' . $mayor . '"');

				return $cant->result();
			} else {

				//ambos
				$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno,p.prsn_sexo,p.prsn_email, prsn_fechanacimi from s_personas p, s_socios s where p.prsn_rut = s.prsn_rut AND s.corporacion ="' . $corp . '" AND s.estado = 0  AND s.tipo_id=1 AND  (YEAR(CURDATE())-YEAR(prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) >= "' . $mayor . '"');

			
			}
			

			return $cant->result();
		}
		function corp_menorS($menor, $sexo, $corp)
		{




			if ($sexo == 2 || $sexo == 3) {


				if ($sexo == 2) {
					$gen = 1;
				}
				if ($sexo == 3) {
					$gen = 0;
				}


				$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno,p.prsn_sexo,p.prsn_apellidomaterno,p.prsn_email, prsn_fechanacimi from s_personas p, s_socios s where p.prsn_rut = s.prsn_rut AND s.corporacion ="' . $corp . '" AND p.prsn_sexo = "' . $gen . '" AND s.estado = 0  AND s.tipo_id=1 AND  (YEAR(CURDATE())-YEAR(prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) <= "' . $menor . '"');

				return $cant->result();
			} else {

				//ambos
				$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno,p.prsn_sexo,p.prsn_email, prsn_fechanacimi from s_personas p, s_socios s where p.prsn_rut = s.prsn_rut AND s.corporacion ="' . $corp . '" AND s.estado = 0  AND s.tipo_id=1 AND  (YEAR(CURDATE())-YEAR(prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) <= "' . $menor . '"');
			}

			return $cant->result();
		}


		function consolidado_rangoS($min, $max, $sexo)
		{


			if ($sexo == 2 || $sexo == 3) {


				if ($sexo == 2) {
					$gen = 1;
				}
				if ($sexo == 3) {
					$gen = 0;
				}


				$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno,p.prsn_sexo,p.prsn_apellidomaterno,p.prsn_email, prsn_fechanacimi from s_personas p, s_socios s where p.prsn_rut = s.prsn_rut  AND p.prsn_sexo = "' . $gen . '" AND s.estado = 0  AND s.tipo_id=1 AND  (YEAR(CURDATE())-YEAR(prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) BETWEEN "' . $min . '" AND "' . $max . '"');

				return $cant->result();
			} else {

				//ambos
				$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno,p.prsn_sexo,p.prsn_email, prsn_fechanacimi from s_personas p, s_socios s where p.prsn_rut = s.prsn_rut  AND s.estado = 0  AND s.tipo_id=1 AND  (YEAR(CURDATE())-YEAR(prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) BETWEEN "' . $min . '" AND "' . $max . '"');
			}

			return $cant->result();
		}



		function consolidado_mayorS($mayor, $sexo)
		{


			if ($sexo == 2 || $sexo == 3) {


				if ($sexo == 2) {
					$gen = 1;
				}
				if ($sexo == 3) {
					$gen = 0;
				}


				$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno,p.prsn_sexo,p.prsn_apellidomaterno,p.prsn_email, prsn_fechanacimi from s_personas p, s_socios s where p.prsn_rut = s.prsn_rut  AND p.prsn_sexo = "' . $gen . '" AND s.estado = 0  AND s.tipo_id=1 AND  (YEAR(CURDATE())-YEAR(prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) >= "' . $mayor . '"');

				return $cant->result();
			} else {

				//ambos
				$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno,p.prsn_sexo,p.prsn_email, prsn_fechanacimi from s_personas p, s_socios s where p.prsn_rut = s.prsn_rut  AND s.estado = 0  AND s.tipo_id=1 AND  (YEAR(CURDATE())-YEAR(prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) >= "' . $mayor . '"');
			}

			return $cant->result();
		}

		function consolidado_menorS($menor, $sexo)
		{


			if ($sexo == 2 || $sexo == 3) {


				if ($sexo == 2) {
					$gen = 1;
				}
				if ($sexo == 3) {
					$gen = 0;
				}


				$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno,p.prsn_sexo,p.prsn_apellidomaterno,p.prsn_email, prsn_fechanacimi from s_personas p, s_socios s where p.prsn_rut = s.prsn_rut  AND p.prsn_sexo = "' . $gen . '" AND s.estado = 0  AND s.tipo_id=1 AND  (YEAR(CURDATE())-YEAR(prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) <= "' . $menor . '"');

				return $cant->result();
			} else {

				//ambos
				$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno,p.prsn_sexo,p.prsn_email, prsn_fechanacimi from s_personas p, s_socios s where p.prsn_rut = s.prsn_rut  AND s.estado = 0  AND s.tipo_id=1 AND  (YEAR(CURDATE())-YEAR(prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) <= "' . $menor . '"');
			}

			return $cant->result();
		}

		//INFORMES CARGA	



		function consolidado_rangoC($min, $max, $sexo)
		{


			if ($sexo == 2 || $sexo == 3) {


				if ($sexo == 2) {
					$gen = 1;
				}
				if ($sexo == 3) {
					$gen = 0;
				}


				$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno,p.prsn_sexo,p.prsn_apellidomaterno,s.s_socios_prsn_rut,s.s_parentesco_pt_id, p.prsn_fechanacimi from s_personas p, s_cargas_socios s, s_socios soc where p.prsn_rut = s.s_personas_prsn_rut   AND s.s_socios_prsn_rut=soc.prsn_rut AND s.s_personas_prsn_rut= p.prsn_rut AND soc.estado = 0  AND (soc.tipo_id=1 OR soc.tipo_id=2 OR soc.tipo_id=3) AND s.estado_carga=1 AND p.prsn_sexo = "' . $gen . '" AND  (YEAR(CURDATE())-YEAR(p.prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(p.prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) BETWEEN "' . $min . '" AND "' . $max . '"');

				return $cant->result();
			} else {

				//ambos
				$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno,p.prsn_sexo,p.prsn_apellidomaterno,s.s_socios_prsn_rut,s.s_parentesco_pt_id, p.prsn_fechanacimi from s_personas p, s_cargas_socios s, s_socios soc where p.prsn_rut = s.s_personas_prsn_rut  AND s.s_socios_prsn_rut=soc.prsn_rut AND s.s_personas_prsn_rut= p.prsn_rut AND soc.estado = 0  AND (soc.tipo_id=1 OR soc.tipo_id=2 OR soc.tipo_id=3) AND s.estado_carga=1 AND  (YEAR(CURDATE())-YEAR(p.prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(p.prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) BETWEEN "' . $min . '" AND "' . $max . '"');
			}

			return $cant->result();
		}

		function consolidado_mayorC($mayor, $sexo)
		{


			if ($sexo == 2 || $sexo == 3) {


				if ($sexo == 2) {
					$gen = 1;
				}
				if ($sexo == 3) {
					$gen = 0;
				}


				$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno,p.prsn_sexo,p.prsn_apellidomaterno,s.s_socios_prsn_rut,s.s_parentesco_pt_id, p.prsn_fechanacimi from s_personas p, s_cargas_socios s, s_socios soc where p.prsn_rut = s.s_personas_prsn_rut   AND s.s_socios_prsn_rut=soc.prsn_rut AND s.s_personas_prsn_rut= p.prsn_rut AND soc.estado = 0  AND (soc.tipo_id=1 OR soc.tipo_id=2 OR soc.tipo_id=3) AND s.estado_carga=1 AND p.prsn_sexo = "' . $gen . '" AND  (YEAR(CURDATE())-YEAR(p.prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(p.prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) >="' . $mayor . '"');

				return $cant->result();
			} else {

				//ambos
				$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno,p.prsn_sexo,p.prsn_apellidomaterno,s.s_socios_prsn_rut,s.s_parentesco_pt_id, p.prsn_fechanacimi from s_personas p, s_cargas_socios s, s_socios soc where p.prsn_rut = s.s_personas_prsn_rut  AND s.s_socios_prsn_rut=soc.prsn_rut AND s.s_personas_prsn_rut= p.prsn_rut AND soc.estado = 0  AND (soc.tipo_id=1 OR soc.tipo_id=2 OR soc.tipo_id=3) AND s.estado_carga=1 AND  (YEAR(CURDATE())-YEAR(p.prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(p.prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) >= "' . $mayor . '"');
			}

			return $cant->result();
		}


		function consolidado_menorC($menor, $sexo)
		{


			if ($sexo == 2 || $sexo == 3) {


				if ($sexo == 2) {
					$gen = 1;
				}
				if ($sexo == 3) {
					$gen = 0;
				}


				$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno,p.prsn_sexo,p.prsn_apellidomaterno,s.s_socios_prsn_rut,s.s_parentesco_pt_id, p.prsn_fechanacimi from s_personas p, s_cargas_socios s, s_socios soc where p.prsn_rut = s.s_personas_prsn_rut   AND s.s_socios_prsn_rut=soc.prsn_rut AND s.s_personas_prsn_rut= p.prsn_rut AND soc.estado = 0  AND (soc.tipo_id=1 OR soc.tipo_id=2 OR soc.tipo_id=3) AND s.estado_carga=1 AND p.prsn_sexo = "' . $gen . '" AND  (YEAR(CURDATE())-YEAR(p.prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(p.prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) <="' . $menor . '"');

				return $cant->result();
			} else {

				//ambos
				$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno,p.prsn_sexo,p.prsn_apellidomaterno,s.s_socios_prsn_rut,s.s_parentesco_pt_id, p.prsn_fechanacimi from s_personas p, s_cargas_socios s, s_socios soc where p.prsn_rut = s.s_personas_prsn_rut  AND s.s_socios_prsn_rut=soc.prsn_rut AND s.s_personas_prsn_rut= p.prsn_rut AND soc.estado = 0  AND (soc.tipo_id=1 OR soc.tipo_id=2 OR soc.tipo_id=3) AND s.estado_carga=1 AND  (YEAR(CURDATE())-YEAR(p.prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(p.prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) <= "' . $menor . '"');
			}

			return $cant->result();
		}



		function corp_rangoC($min, $max, $sexo, $corp)
		{


			if ($sexo == 2 || $sexo == 3) {


				if ($sexo == 2) {
					$gen = 1;
				}
				if ($sexo == 3) {
					$gen = 0;
				}


				$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno,p.prsn_sexo,p.prsn_apellidomaterno,s.s_socios_prsn_rut,s.s_parentesco_pt_id, p.prsn_fechanacimi from s_personas p, s_cargas_socios s, s_socios soc where p.prsn_rut = s.s_personas_prsn_rut  AND soc.corporacion ="' . $corp . '"   AND s.s_socios_prsn_rut=soc.prsn_rut AND s.s_personas_prsn_rut= p.prsn_rut AND soc.estado = 0  AND (soc.tipo_id=1 OR soc.tipo_id=2 OR soc.tipo_id=3) AND s.estado_carga=1 AND p.prsn_sexo = "' . $gen . '" AND  (YEAR(CURDATE())-YEAR(p.prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(p.prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) BETWEEN "' . $min . '" AND "' . $max . '"');

				return $cant->result();
			} else {

				//ambos
				$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno,p.prsn_sexo,p.prsn_apellidomaterno,s.s_socios_prsn_rut,s.s_parentesco_pt_id, p.prsn_fechanacimi from s_personas p, s_cargas_socios s, s_socios soc where p.prsn_rut = s.s_personas_prsn_rut AND soc.corporacion ="' . $corp . '"  AND s.s_socios_prsn_rut=soc.prsn_rut AND s.s_personas_prsn_rut= p.prsn_rut AND soc.estado = 0  AND (soc.tipo_id=1 OR soc.tipo_id=2 OR soc.tipo_id=3) AND s.estado_carga=1 AND  (YEAR(CURDATE())-YEAR(p.prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(p.prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) BETWEEN "' . $min . '" AND "' . $max . '"');
			}

			return $cant->result();
		}


		function corp_mayorC($mayor, $sexo, $corp)
		{


			if ($sexo == 2 || $sexo == 3) {


				if ($sexo == 2) {
					$gen = 1;
				}
				if ($sexo == 3) {
					$gen = 0;
				}


				$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno,p.prsn_sexo,p.prsn_apellidomaterno,s.s_socios_prsn_rut,s.s_parentesco_pt_id, p.prsn_fechanacimi from s_personas p, s_cargas_socios s, s_socios soc where p.prsn_rut = s.s_personas_prsn_rut  AND soc.corporacion ="' . $corp . '"   AND s.s_socios_prsn_rut=soc.prsn_rut AND s.s_personas_prsn_rut= p.prsn_rut AND soc.estado = 0  AND (soc.tipo_id=1 OR soc.tipo_id=2 OR soc.tipo_id=3) AND s.estado_carga=1 AND p.prsn_sexo = "' . $gen . '" AND  (YEAR(CURDATE())-YEAR(p.prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(p.prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) >="' . $mayor . '"');

				return $cant->result();
			} else {

				//ambos
				$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno,p.prsn_sexo,p.prsn_apellidomaterno,s.s_socios_prsn_rut,s.s_parentesco_pt_id, p.prsn_fechanacimi from s_personas p, s_cargas_socios s, s_socios soc where p.prsn_rut = s.s_personas_prsn_rut AND soc.corporacion ="' . $corp . '"  AND s.s_socios_prsn_rut=soc.prsn_rut AND s.s_personas_prsn_rut= p.prsn_rut AND soc.estado = 0  AND (soc.tipo_id=1 OR soc.tipo_id=2 OR soc.tipo_id=3) AND s.estado_carga=1 AND  (YEAR(CURDATE())-YEAR(p.prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(p.prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) >="' . $mayor . '"');
			}

			return $cant->result();
		}


		function corp_menorC($menor, $sexo, $corp)
		{


			if ($sexo == 2 || $sexo == 3) {


				if ($sexo == 2) {
					$gen = 1;
				}
				if ($sexo == 3) {
					$gen = 0;
				}


				$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno,p.prsn_sexo,p.prsn_apellidomaterno,s.s_socios_prsn_rut,s.s_parentesco_pt_id, p.prsn_fechanacimi from s_personas p, s_cargas_socios s, s_socios soc where p.prsn_rut = s.s_personas_prsn_rut  AND soc.corporacion ="' . $corp . '"   AND s.s_socios_prsn_rut=soc.prsn_rut AND s.s_personas_prsn_rut= p.prsn_rut AND soc.estado = 0  AND (soc.tipo_id=1 OR soc.tipo_id=2 OR soc.tipo_id=3) AND s.estado_carga=1 AND p.prsn_sexo = "' . $gen . '" AND  (YEAR(CURDATE())-YEAR(p.prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(p.prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) <="' . $menor . '"');

				return $cant->result();
			} else {

				//ambos
				$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno,p.prsn_sexo,p.prsn_apellidomaterno,s.s_socios_prsn_rut,s.s_parentesco_pt_id, p.prsn_fechanacimi from s_personas p, s_cargas_socios s, s_socios soc where p.prsn_rut = s.s_personas_prsn_rut AND soc.corporacion ="' . $corp . '"  AND s.s_socios_prsn_rut=soc.prsn_rut AND s.s_personas_prsn_rut= p.prsn_rut AND soc.estado = 0  AND (soc.tipo_id=1 OR soc.tipo_id=2 OR soc.tipo_id=3) AND s.estado_carga=1 AND  (YEAR(CURDATE())-YEAR(p.prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(p.prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) <="' . $menor . '"');
			}

			return $cant->result();
		}








		//Fin de Iformes carga









		function cargas_activos($rut)
		{

			$sql = $this->db->query("SELECT DISTINCT(s_personas_prsn_rut) as rut_carga,s_socios_prsn_rut as rut_socio,prsn_nombres,prsn_apellidopaterno,prsn_apellidomaterno,c.s_parentesco_pt_id,prsn_sexo,YEAR(CURDATE())-YEAR(p.prsn_fechanacimi)+IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(p.prsn_fechanacimi,'%m-%d'), 0 , -1 ) AS edad FROM s_cargas_socios c,s_personas p WHERE c.s_socios_prsn_rut=" . "'$rut'" . " AND c.s_personas_prsn_rut= p.prsn_rut");

			return $sql->result();
		}



		function cargas_activosALL()
		{

			$sql = $this->db->query("SELECT DISTINCT(s_personas_prsn_rut) as rut_carga,s_socios_prsn_rut as rut_socio,prsn_nombres,prsn_apellidopaterno,prsn_apellidomaterno,prsn_sexo,s_parentesco_pt_id,YEAR(CURDATE())-YEAR(p.prsn_fechanacimi)+IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(p.prsn_fechanacimi,'%m-%d'), 0 , -1 ) AS edad FROM s_cargas_socios c,s_personas p ,s_socios s WHERE c.s_socios_prsn_rut=s.prsn_rut AND c.s_personas_prsn_rut= p.prsn_rut AND s.estado = 0  AND (s.tipo_id=1 OR s.tipo_id=2 OR s.tipo_id=3) AND c.estado_carga=1 ");

			return $sql->result();
		}


		function cargas_activosALL_array()
		{

			$sql = $this->db->query("SELECT  DISTINCT(s_personas_prsn_rut) as rut_carga,s_socios_prsn_rut as rut_socio,prsn_nombres,prsn_apellidopaterno,prsn_apellidomaterno,prsn_sexo,s_parentesco_pt_id,YEAR(CURDATE())-YEAR(p.prsn_fechanacimi)+IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(p.prsn_fechanacimi,'%m-%d'), 0 , -1 ) AS edad FROM s_cargas_socios c,s_personas p ,s_socios s WHERE c.s_socios_prsn_rut=s.prsn_rut AND c.s_personas_prsn_rut= p.prsn_rut AND s.estado = 0  AND s.tipo_id=1 AND c.estado_carga=1");

			return $sql->result_array();
		}
		function activos_array()
		{

			$sql = $this->db->query("SELECT DISTINCTROW p.prsn_rut, p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno,p.prsn_sexo, s.tipo_id,YEAR(CURDATE())-YEAR(p.prsn_fechanacimi)+IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(p.prsn_fechanacimi,'%m-%d'), 0 , -1 ) AS edad FROM s_personas p, s_socios s WHERE s.prsn_rut = p.prsn_rut AND s.estado = 0  AND s.tipo_id=1 order by p.prsn_apellidopaterno");

			return $sql->result_array();
		}





		function rangoC($min, $max, $genero)

		{



			if ($genero == 'hombre' || $genero == 'mujer') {


				if ($genero == 'hombre') {
					$gen = 1;
				}
				if ($genero == 'mujer') {
					$gen = 0;
				}

				$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno,p.prsn_sexo,p.prsn_apellidomaterno,s.s_socios_prsn_rut,s.s_parentesco_pt_id, prsn_fechanacimi from s_personas p, s_cargas_socios s where p.prsn_rut = s.s_personas_prsn_rut AND p.prsn_sexo = "' . $gen . '" AND  (YEAR(CURDATE())-YEAR(prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) BETWEEN "' . $min . '" AND "' . $max . '"');

				return $cant->result();
			}


			$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno,p.prsn_sexo,s.s_socios_prsn_rut,s.s_parentesco_pt_id, prsn_fechanacimi from s_personas p, s_cargas_socios s where p.prsn_rut = s.s_personas_prsn_rut AND (YEAR(CURDATE())-YEAR(prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) BETWEEN "' . $min . '" AND "' . $max . '"');



			return $cant->result();
		}



		function rangoS($min, $max, $genero)

		{



			if ($genero == 'hombre' || $genero == 'mujer') {


				if ($genero == 'hombre') {
					$gen = 1;
				}
				if ($genero == 'mujer') {
					$gen = 0;
				}

				$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno,p.prsn_sexo,p.prsn_apellidomaterno,p.prsn_email, prsn_fechanacimi from s_personas p, s_socios s where p.prsn_rut = s.prsn_rut AND p.prsn_sexo = "' . $gen . '" AND s.estado = 0  AND s.tipo_id=1 AND  (YEAR(CURDATE())-YEAR(prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) BETWEEN "' . $min . '" AND "' . $max . '"');

				return $cant->result();
			}


			$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno,p.prsn_sexo,p.prsn_email, prsn_fechanacimi from s_personas p, s_socios s where p.prsn_rut = s.prsn_rut AND s.estado = 0  AND s.tipo_id=1 AND  (YEAR(CURDATE())-YEAR(prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) BETWEEN "' . $min . '" AND "' . $max . '"');



			return $cant->result();
		}












		function informes_estadosSocios($rutCorp, $tipoFecha, $desdeFecha, $hastaFecha,$estadoActual)
		{
			

			if ($rutCorp == "Todas") {


				if ($tipoFecha == "1") {

				
					//incorporaciones

					$sql = $this->db->query("SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno,p.prsn_sexo,p.prsn_apellidomaterno,p.prsn_email, p.prsn_fechanacimi,p.prsn_fono_movil,s.fecha_registro, s.fecha_retiro from s_personas p, s_socios s WHERE p.prsn_rut = s.prsn_rut  AND s.estado = '"."$estadoActual"."'  AND s.fecha_registro BETWEEN '"."$desdeFecha"."' AND '".$hastaFecha."'  ORDER BY s.fecha_registro");
 
					return $sql->result();
				}
				if ($tipoFecha == "2") {
					//bajas

					$sql = $this->db->query("SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno,p.prsn_sexo,p.prsn_apellidomaterno,p.prsn_email, p.prsn_fechanacimi,p.prsn_fono_movil,s.fecha_registro, s.fecha_retiro from s_personas p, s_socios s WHERE p.prsn_rut = s.prsn_rut AND s.estado = '"."$estadoActual"."'  AND s.fecha_retiro BETWEEN '"."$desdeFecha"."' AND '".$hastaFecha."' ORDER BY s.fecha_retiro");

					return $sql->result();
				}
			} else {

				if ($tipoFecha == "1") {

					//incorporaciones

					$sql = $this->db->query("SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno,p.prsn_sexo,p.prsn_apellidomaterno,p.prsn_email, p.prsn_fechanacimi,p.prsn_fono_movil,s.fecha_registro, s.fecha_retiro from s_personas p, s_socios s WHERE p.prsn_rut = s.prsn_rut AND s.estado = '"."$estadoActual"."' AND s.corporacion = '"."$rutCorp"."' AND s.fecha_registro BETWEEN '"."$desdeFecha"."' AND '".$hastaFecha."' ORDER BY s.fecha_registro");

					
					return $sql->result();
				}
				if ($tipoFecha == "2") {
					//bajas

					$sql = $this->db->query("SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno,p.prsn_sexo,p.prsn_apellidomaterno,p.prsn_email, p.prsn_fechanacimi,p.prsn_fono_movil,s.fecha_registro, s.fecha_retiro from s_personas p, s_socios s WHERE p.prsn_rut = s.prsn_rut AND s.estado = '"."$estadoActual"."' AND s.corporacion = '"."$rutCorp"."' AND s.fecha_retiro BETWEEN '"."$desdeFecha"."' AND '".$hastaFecha."' ORDER BY s.fecha_retiro");


					
					return $sql->result();
				}
			}
		}

		function estados_sociosHistorico($rutCorp, $tipoFecha, $desdeFecha, $hastaFecha,$estado)
		{

			$this->db->select('p.prsn_nombres, p.prsn_apellidopaterno,p.prsn_sexo,p.prsn_apellidomaterno,p.prsn_email, p.prsn_fechanacimi,p.prsn_fono_movil,s.fecha_registro,s.estado');
			$this->db->from('s_personas p, s_socios s');
			$this->db->where('s.corporacion',$rutCorp);
			$this->db->where('s.estado',$estado);
			$this->db->where('s.fecha_registro <= ', $desdeFecha);
			
			$consulta = $this->db->get();
			$consulta = $consulta->result();
			return $consulta;

		}





	}


	?>