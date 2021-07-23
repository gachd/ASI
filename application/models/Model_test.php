 <?php

	class model_test extends CI_Model
	{




		function activos()
		{

			$sql = $this->db->query("SELECT DISTINCTROW p.prsn_rut, p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno,p.prsn_sexo, s.tipo_id,YEAR(CURDATE())-YEAR(p.prsn_fechanacimi)+IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(p.prsn_fechanacimi,'%m-%d'), 0 , -1 ) AS edad FROM s_personas p, s_socios s WHERE s.prsn_rut = p.prsn_rut AND s.estado = 0  AND s.tipo_id=1 order by p.prsn_apellidopaterno");

			return $sql->result();
		}

		function cargas_activos($rut)
		{

			$sql = $this->db->query("SELECT s_personas_prsn_rut as rut_carga,s_socios_prsn_rut as rut_socio,prsn_nombres,prsn_apellidopaterno,prsn_apellidomaterno,prsn_sexo,YEAR(CURDATE())-YEAR(p.prsn_fechanacimi)+IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(p.prsn_fechanacimi,'%m-%d'), 0 , -1 ) AS edad FROM s_cargas_socios c,s_personas p WHERE c.s_socios_prsn_rut=" . "'$rut'" . " AND c.s_personas_prsn_rut= p.prsn_rut");

			return $sql->result();
		}

		function cargas_activosALL()
		{

			$sql = $this->db->query("SELECT  DISTINCT(s_personas_prsn_rut) as rut_carga,s_socios_prsn_rut as rut_socio,prsn_nombres,prsn_apellidopaterno,prsn_apellidomaterno,prsn_sexo,s_parentesco_pt_id,YEAR(CURDATE())-YEAR(p.prsn_fechanacimi)+IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(p.prsn_fechanacimi,'%m-%d'), 0 , -1 ) AS edad FROM s_cargas_socios c,s_personas p ,s_socios s WHERE c.s_socios_prsn_rut=s.prsn_rut AND c.s_personas_prsn_rut= p.prsn_rut AND s.estado = 0  AND s.tipo_id=1");

			return $sql->result();
		}


		function cargas_activosALL_array()
		{

			$sql = $this->db->query("SELECT  DISTINCT(s_personas_prsn_rut) as rut_carga,s_socios_prsn_rut as rut_socio,prsn_nombres,prsn_apellidopaterno,prsn_apellidomaterno,prsn_sexo,s_parentesco_pt_id,YEAR(CURDATE())-YEAR(p.prsn_fechanacimi)+IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(p.prsn_fechanacimi,'%m-%d'), 0 , -1 ) AS edad FROM s_cargas_socios c,s_personas p ,s_socios s WHERE c.s_socios_prsn_rut=s.prsn_rut AND c.s_personas_prsn_rut= p.prsn_rut AND s.estado = 0  AND s.tipo_id=1");

			return $sql->result_array();
		}
		function activos_array()
		{

			$sql = $this->db->query("SELECT DISTINCTROW p.prsn_rut, p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno,p.prsn_sexo, s.tipo_id,YEAR(CURDATE())-YEAR(p.prsn_fechanacimi)+IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(p.prsn_fechanacimi,'%m-%d'), 0 , -1 ) AS edad FROM s_personas p, s_socios s WHERE s.prsn_rut = p.prsn_rut AND s.estado = 0  AND s.tipo_id=1 order by p.prsn_apellidopaterno");

			return $sql->result_array();
		}

		function rangoC($min, $max, $genero)

		{
			


			if ($genero == 'hombre' || $genero == 'mujer' ) {
				
				
				if($genero == 'hombre'){
					$gen = 1;
				}
				if($genero == 'mujer'){
					$gen = 0;
				}

				$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno,p.prsn_sexo,p.prsn_apellidomaterno,s.s_socios_prsn_rut,s.s_parentesco_pt_id, prsn_fechanacimi from s_personas p, s_cargas_socios s where p.prsn_rut = s.s_personas_prsn_rut AND p.prsn_sexo = "'.$gen .'" AND  (YEAR(CURDATE())-YEAR(prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) BETWEEN "' . $min . '" AND "' . $max . '"');

				return $cant->result();
			}


				$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno,p.prsn_sexo,s.s_socios_prsn_rut,s.s_parentesco_pt_id, prsn_fechanacimi from s_personas p, s_cargas_socios s where p.prsn_rut = s.s_personas_prsn_rut AND (YEAR(CURDATE())-YEAR(prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) BETWEEN "' . $min . '" AND "' . $max . '"');



			return $cant->result();
		}

		

		function rangoS($min, $max, $genero)

		{
			


			if ($genero == 'hombre' || $genero == 'mujer' ) {
				
				
				if($genero == 'hombre'){
					$gen = 1;
				}
				if($genero == 'mujer'){
					$gen = 0;
				}

				$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno,p.prsn_sexo,p.prsn_apellidomaterno,p.prsn_email, prsn_fechanacimi from s_personas p, s_socios s where p.prsn_rut = s.prsn_rut AND p.prsn_sexo = "'.$gen .'" AND s.estado = 0  AND s.tipo_id=1 AND  (YEAR(CURDATE())-YEAR(prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) BETWEEN "' . $min . '" AND "' . $max . '"');

				return $cant->result();
			}


				$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno,p.prsn_sexo,p.prsn_email, prsn_fechanacimi from s_personas p, s_socios s where p.prsn_rut = s.prsn_rut AND s.estado = 0  AND s.tipo_id=1 AND  (YEAR(CURDATE())-YEAR(prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) BETWEEN "' . $min . '" AND "' . $max . '"');



			return $cant->result();
		}
	}


	?>