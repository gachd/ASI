 <?php

	class model_socios extends CI_Model
	{

		function cargas_del_socio($rut){

			
			
			$this->db->select('*');
			$this->db->from('s_cargas_socios c,s_personas p');
			$this->db->where('c.s_personas_prsn_rut= p.prsn_rut');			
			$this->db->where('c.estado_carga',0);			
			$this->db->where('c.s_socios_prsn_rut',$rut);			
			/* $this->db->group_by('c.s_socios_prsn_rut'); */
			$consulta = $this->db->get(); 

			$consulta = $consulta->result();

			return $consulta;

		}





		function all_personas()
		{

			$p = $this->db->query('SELECT DISTINCT p.prsn_nombres, p.prsn_apellidopaterno,p.prsn_apellidomaterno,p.prsn_rut,s.estado from s_personas p, s_socios s where p.prsn_rut = s.prsn_rut');

			return $p->result();
		}


		function InfoSocio ($rut){

			$this->db->select('*');
			$this->db->from('s_socios');
			$this->db->where('prsn_rut', $rut);
			$this->db->group_by('prsn_rut');


			$consulta = $this->db->get(); 

			$consulta = $consulta->result();

			return $consulta[0];
		}

		function Info_All_Socios_Actios(){

			$this->db->select('*');
			$this->db->from('s_socios s, s_personas p');
			$this->db->where('s.prsn_rut = p.prsn_rut');
			$this->db->where('s.estado',0);	
			$this->db->group_by('s.prsn_rut');


			$consulta = $this->db->get(); 

			$consulta = $consulta->result();

			return $consulta;
		}


		function all_cargas()
		{

			$car = $this->db->query('SELECT DISTINCT p.prsn_nombres, p.prsn_apellidopaterno,p.prsn_apellidomaterno,p.prsn_rut,s.estado_carga from s_personas p, s_cargas_socios s where p.prsn_rut = s.s_personas_prsn_rut');

			return $car->result();
		}


		function ValidarSocio($rut)
		{
			
			// Validar que no sea socio
			$p = $this->db->query('SELECT * from s_personas p, s_socios s where p.prsn_rut=s.prsn_rut AND p.prsn_rut = "' . $rut . '" ');
			//  $resultado=mysql_query($consulta) or die (mysql_error());

			if ($p->num_rows() > 0) {
				return 1; //existe
			} else {
				return 0; //no existe registro
			}
		}

		function all_parentesco()
		{

			$parent = $this->db->get('s_parentesco');

			return $parent->result();
		}





		function all_corporaciones()
		{

			$corp = $this->db->get('corporaciones');

			return $corp->result();
		}



		function all_sociospat()
		{

			$sociospat = $this->db->query('SELECT DISTINCT p.prsn_rut,p.s_estado_civil_estacivil_id, p.prsn_nombres,p.prsn_apellidopaterno, p.prsn_apellidomaterno  FROM s_personas as p , s_socios as s WHERE p.prsn_rut = s.prsn_rut');

			return $sociospat->result();
		}



		function getSocios($rut)
		{



			$socio =  $this->db->query('SELECT DISTINCT p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno,p.prsn_rut,s.id_socio, s.cond_id, s.cond2_id, s.tipo_id FROM s_personas p , s_socios s WHERE s.prsn_rut = "' . $rut . '" AND s.prsn_rut = p.prsn_rut');





			return $socio->result();
		}



		function factura($id_socio, $id_cuota, $rut)
		{



			$factura =  $this->db->query('SELECT * FROM s_factura f, s_metodo_pago mp WHERE f.s_cuota_ordinaria_id_cuota = "' . $id_cuota . '" AND f.s_socios_prsn_rut = "' . $rut . '" AND f.s_socios_id_socio=  "' . $id_socio . '" AND f.metodo_pago_idmetodo_pago = mp.idmetodo_pago');





			return $factura->result();
		}





		function getIdSocio($rut)
		{



			$id =  $this->db->query('SELECT DISTINCT id_socio FROM s_socios  WHERE prsn_rut = "' . $rut . '"');





			return $id->result();
		}

		function IdSocio($rut)
		{



			$id =  $this->db->query('SELECT id_socio, corporacion FROM s_socios  WHERE prsn_rut = "' . $rut . '"');





			return $id->result();
		}



		function IdSocioCorp($rut, $rut_corp)
		{



			$id =  $this->db->query('SELECT id_socio FROM s_socios  WHERE prsn_rut = "' . $rut . '" AND corporacion = "' . $rut_corp . '"');

			return $id->result();
		}

		function buscarpagos($id, $id_s)
		{

			$sql = $this->db->query('SELECT * FROM s_factura WHERE s_socios_id_socio = "' . $id_s . '" AND s_cuota_ordinaria_id_cuota = "' . $id . '"');
			return $sql->result();
		}



		function estado_cuota($id, $rut_socio, $id_s)
		{



			$estado = $this->db->query('SELECT estado from s_cuotaord_socios WHERE s_socios_prsn_rut = "' . $rut_socio . '" AND s_socios_id_socio = "' . $id_s . '" AND cuota_ordinaria_id_cuota = "' . $id . '"');

			return $estado->result();
		}



		function detalle_cuota($id, $rut_socio, $id_s)
		{



			$estado = $this->db->query('SELECT * from s_cuotaord_socios WHERE s_socios_prsn_rut = "' . $rut_socio . '" AND s_socios_id_socio = "' . $id_s . '" AND cuota_ordinaria_id_cuota = "' . $id . '"');

			return $estado->result();
		}





		function nomb_corp($rut_corp)
		{



			$nombre = $this->db->query('SELECT * FROM  corporaciones  WHERE  co_rut = "' . $rut_corp . '"');



			return $nombre->result();
		}











		function cant_corp($rut)
		{



			$cant = $this->db->query('SELECT * FROM s_personas p , s_socios s, corporaciones c WHERE s.prsn_rut = "' . $rut . '" AND s.prsn_rut = p.prsn_rut AND s.corporacion = c.co_rut');



			return $cant->result();
		}



		function cuotas($rut)
		{

			$cuotas = $this->db->query('SELECT * from s_cuotaord_socios c, s_personas p, s_cuota_ordinaria co WHERE c.s_socios_prsn_rut = p.prsn_rut AND c.s_socios_prsn_rut = "' . $rut . '" AND c.cuota_ordinaria_id_cuota = co.id_cuota');

			return $cuotas->result();
		}



		function all_metpagos()
		{

			$metpago = $this->db->query('SELECT * FROM s_metodo_pago WHERE 1');

			return $metpago->result();
		}



		function datos_cuota($sem, $ano)
		{

			$cuota = $this->db->query('SELECT * FROM s_cuota_ordinaria WHERE semestre = "' . $sem . '" AND ano = "' . $ano . '"');

			return $cuota->result();
		}



		function detalle_pago($id, $rut)
		{

			$pago = $this->db->query('SELECT * FROM s_cuotaord_socios WHERE cuota_ordinaria_id_cuota = "' . $id . '" AND s_socios_prsn_rut = "' . $rut . '"');

			return $pago->result();
		}



		function consultar_obs($rut)
		{

			$obs = $this->db->query('SELECT obs_estado FROM s_cargas_socios WHERE s_personas_prsn_rut = "' . $rut . '" ');

			return $obs->result();
		}





		function corp_socios($rut)
		{



			$corp = $this->db->query('SELECT s.fecha_registro,p.prsn_rut,s.corporacion, c.co_nombre, s.n_registro FROM s_personas p , s_socios s, corporaciones c WHERE s.prsn_rut = "' . $rut . '" AND s.prsn_rut = p.prsn_rut AND s.corporacion = c.co_rut');

			return $corp->result();
		}



		function all_cuotas()
		{



			$ano = $this->db->query('SELECT DISTINCT ano FROM `s_cuota_ordinaria` WHERE 1');

			return $ano->result();
		}





		function cumpleaños_hoy()
		{
			$cumple = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres,p.prsn_apellidopaterno,p.prsn_apellidomaterno, p.prsn_fechanacimi, p.prsn_email, TIMESTAMPDIFF(YEAR,p.prsn_fechanacimi,CURDATE()) AS edad FROM s_personas p, s_socios s WHERE DAY(p.prsn_fechanacimi)=DAY(NOW()) AND MONTH(p.prsn_fechanacimi)=MONTH(NOW()) AND p.prsn_rut = s.prsn_rut AND s.estado = 0');
			return $cumple->result();
		}

		function prox_cumpleaños()
		{
			$cumple = $this->db->query('SELECT DISTINCT(p.prsn_rut) as rut, p.prsn_nombres,p.prsn_apellidopaterno,p.prsn_apellidomaterno, p.prsn_fechanacimi, p.prsn_email, TIMESTAMPDIFF(YEAR,p.prsn_fechanacimi,CURDATE()) AS edad FROM s_personas p, s_socios s WHERE DAY(p.prsn_fechanacimi) < DAY(DATE_ADD(CURDATE(),INTERVAL 5 DAY)) AND DAY(p.prsn_fechanacimi) > DAY(NOW()) AND MONTH(p.prsn_fechanacimi)=MONTH(NOW()) AND p.prsn_rut = s.prsn_rut AND s.estado = 0 order by DAY(p.prsn_fechanacimi) asc');
			return $cumple->result();
		}

		function ant_cumpleaños()
		{
			$cumple = $this->db->query('SELECT DISTINCT(p.prsn_rut) as rut, p.prsn_nombres,p.prsn_apellidopaterno,p.prsn_apellidomaterno, p.prsn_fechanacimi, p.prsn_email, TIMESTAMPDIFF(YEAR,p.prsn_fechanacimi,CURDATE()) AS edad FROM s_personas p, s_socios s WHERE DAY(p.prsn_fechanacimi) > DAY(DATE_SUB(CURDATE(),INTERVAL 5 DAY)) AND DAY(p.prsn_fechanacimi) < DAY(NOW()) AND MONTH(p.prsn_fechanacimi)=MONTH(NOW()) AND p.prsn_rut = s.prsn_rut AND s.estado = 0 order by DAY(p.prsn_fechanacimi) asc');
			return $cumple->result();
		}

		function persona($rut)
		{



			//$this->db->where("prsn_rut",$rut);				
			
			//$persona = $this->db->query('SELECT * FROM s_personas, s_condicion_laboral,s_estado_civil,s_nacionalidades,s_comunas,s_provincia,s_regiones WHERE prsn_rut="' . $rut . '" AND s_condicion_laboral_condlab_id = condlab_id AND s_estado_civil_estacivil_id = estacivil_id AND s_nacionalidades_nac_id = nac_id AND s_comunas_comuna_id = comuna_id AND s_provincia_provincia_id = provincia_id AND s_regiones_region_id=region_id');
			
			
			$persona = $this->db->query('SELECT * FROM s_personas p, s_condicion_laboral labo,s_estado_civil civil,s_nacionalidades pais,s_comunas comu,s_provincia provi,s_regiones regi WHERE prsn_rut="'.$rut.'" AND s_condicion_laboral_condlab_id = condlab_id AND s_estado_civil_estacivil_id = estacivil_id AND s_nacionalidades_nac_id = nac_id AND p.s_comunas_comuna_id = comu.comuna_id AND comu.s_provincia_provincia_id = provi.provincia_id AND provi.s_regiones_region_id=regi.region_id');





			return $persona->result();
		}





		function patrocinadores($rut)
		{

			//$this->db->where("pat_patrocinador",$rut);	

			//$patrocinadores = $this ->db->get('s_patrocinador');	

			$query = $this->db->query('SELECT p.prsn_rut,pat.s_socios_prsn_rut, pat.s_socios_prsn_rut1,p.prsn_nombres,p.prsn_apellidopaterno, p.prsn_apellidomaterno  FROM s_personas p, s_patrocinador_has_s_socios pat WHERE pat.s_socios_prsn_rut = "' . $rut . '" AND pat.s_socios_prsn_rut1 = p.prsn_rut');

			return $query->result();
		}



		function patrocinados($rut)
		{

			$patrocinadores = $this->db->query('SELECT p.prsn_rut,pat.s_socios_prsn_rut, pat.s_socios_prsn_rut1,p.prsn_nombres,p.prsn_apellidopaterno, p.prsn_apellidomaterno  FROM s_personas p, s_patrocinador_has_s_socios pat WHERE pat.s_socios_prsn_rut1 = "' . $rut . '" AND pat.s_socios_prsn_rut = p.prsn_rut');

			return $patrocinadores->result();

			//$this->db->where("pat_socio",$rut);		

			//$patrocinados = $this ->db->get('s_patrocinador');	

			// return $query->result();


		}



		function cargas($rut)
		{



			$cargas = $this->db->query('SELECT c.certificado,c.estudiante,c.estado_carga,p.prsn_fono_casa,p.prsn_fono_movil,p.prsn_email,p.prsn_rut,pa.pt_nombre,p.prsn_fechanacimi,p.prsn_apellidopaterno,p.prsn_apellidomaterno,p.prsn_nombres,c.s_personas_prsn_rut, c.s_socios_id_socio, c.s_socios_prsn_rut, c.s_parentesco_pt_id FROM s_cargas_socios c, s_personas p,s_parentesco pa WHERE c.s_socios_prsn_rut = "' . $rut . '" AND p.prsn_rut = c.s_personas_prsn_rut AND pa.pt_id = c.s_parentesco_pt_id ');

			//	$cargas = $this ->db->get('s_cargas_socios');	



			return $cargas->result();
		}



		function actCargaPers($data, $rutCarga)
		{

			$this->db->where('prsn_rut', $rutCarga);

			$this->db->update('s_personas', $data);
		}



		function actualizar_carg($data_carg, $rutCarga)
		{ //actualiza tabla s_cargas_socios

			$this->db->where('s_personas_prsn_rut', $rutCarga);

			$this->db->update('s_cargas_socios', $data_carg);
		}





		function cargasSocios($rutsocio, $rutcarga)
		{



			$cargas = $this->db->query('SELECT c.certificado,c.estudiante,c.estado_carga,p.prsn_fono_casa,p.prsn_fono_movil,p.prsn_email,p.prsn_rut,pa.pt_nombre,p.prsn_fechanacimi,p.prsn_apellidopaterno,p.prsn_apellidomaterno,p.prsn_nombres,p.prsn_sexo,p.prsn_email,c.s_personas_prsn_rut, c.s_socios_id_socio, c.s_socios_prsn_rut, c.s_parentesco_pt_id FROM s_cargas_socios c, s_personas p,s_parentesco pa WHERE c.s_socios_prsn_rut = "' . $rutsocio . '" AND "' . $rutcarga . '" = c.s_personas_prsn_rut AND c.s_personas_prsn_rut = p.prsn_rut AND pa.pt_id = c.s_parentesco_pt_id ');

			//	$cargas = $this ->db->get('s_cargas_socios');	



			return $cargas->result();
		}

		function sociosDatos($rut)
		{

			$socios = $this->db->query('SELECT c.cond_id, c.nombre as nombCond, cond.cond2_id, cond.cond2_nombre as nombCond2, t.tipo_id, t.nombre as nombTipo, sc.id_subcond, sc.nombre as nombSub FROM s_socios s, s_condicion2 cond, s_condicion c, s_tipo_socio t, s_subcond sc WHERE s.prsn_rut = "' . $rut . '" AND cond.cond2_id = s.cond2_id AND c.cond_id = s.cond_id AND t.tipo_id = s.tipo_id AND t.subcond = sc.id_subcond');


			//  $socios = $this ->db->query('SELECT * FROM s_socios s, s_condicion2 cond, s_condicion c, s_tipo_socio t, s_subcond sc WHERE s.prsn_rut = "'.$rut.'" AND cond.cond2_id = s.cond2_id AND c.cond_id = s.cond_id AND t.tipo_id = s.tipo_id AND t.subcond = sc.id_subcond');

			return $socios->result();
		}



		function socio_corp($rut, $rut_corp)
		{

			$this->db->where("prsn_rut", $rut);

			$this->db->where("corporacion", $rut_corp);

			$corp = $this->db->query('SELECT * FROM s_socios WHERE prsn_rut = "' . $rut . '" AND corporacion = "' . $rut_corp . '"');

			return $corp->result();
		}



		function all_nacionalidades()
		{

			$nac = $this->db->get('s_nacionalidades');

			return $nac->result();
		}



		function all_comunas()
		{

			$this->db->order_by('comuna_nombre', 'ASC');
			$com = $this->db->get('s_comunas');
			

			
			return $com->result();
		}



		function all_condicion()
		{

			$cond = $this->db->get('s_condicion');

			return $cond->result();
		}

		function all_condicion2()
		{

			$cond2 = $this->db->get('s_condicion2');

			return $cond2->result();
		}



		function all_condicionlab()
		{

			$condlab = $this->db->get('s_condicion_laboral');

			return $condlab->result();
		}



		function all_estadocivil()
		{

			$estadocivil = $this->db->get('s_estado_civil');

			return $estadocivil->result();
		}





		function all_socios()
		{



			$socios = $this->db->get('s_socios');

			return $socios->result();
		}

		function all_tipo()
		{



			//$tipo = $this->db->query('SELECT * FROM s_tipo_socio t, s_subcond s WHERE t.subcond = s.id_subcond');
			$tipo = $this->db->query('SELECT t.nombre ,t.tipo_id FROM s_tipo_socio t, s_subcond s WHERE t.subcond = s.id_subcond');

			return $tipo->result();
		}

		function all_subcond()
		{



			$tipo = $this->db->get('s_subcond');

			return $tipo->result();
		}



		function Allcuotas()
		{



			$cuotas = $this->db->get('s_cuota_ordinaria');

			return $cuotas->result();
		}





		function insert_cuotas($data)
		{



			$this->db->insert('s_cuotaord_socios', $data);
		}



		function consulta_cuotas($id, $id_socio, $rut)
		{



			$this->db->select('cuota_ordinaria_id_cuota');

			$this->db->from('s_cuotaord_socios');

			$this->db->where('cuota_ordinaria_id_cuota', $id);

			$this->db->where('s_socios_id_socio', $id_socio);

			$this->db->where('s_socios_prsn_rut', $rut);



			$consulta = $this->db->get();

			// $query = $this ->db->query('SELECT cuota_ordinaria_id_cuota from s_cuotaord_socios where cuota_ordinaria_id_cuota = "'.$id.'" AND s_socios_id_socio = "'.$id_socio.'" AND s_socios_prsn_rut = "'.$rut.'"');

			//return $consulta ->result();

			// echo mysql_error();

			// $consulta = $this ->db->get('s_cuotaord_socios');

			if ($consulta->num_rows() > 0) {

				return 1;
			} else {



				return 0;
			}





			//   return $consulta ->result();









		}



		function allSoocios()
		{



			$rut = $this->db->query('SELECT DISTINCT prsn_rut FROM `s_socios` WHERE 1');

			return $rut->result();
		}


		function allSoociosVal()
		{

			$this->db->distinct();

			$this->db->select('prsn_rut');

			$this->db->from('s_socios');

			$this->db->where('estado', '0');

			$rut = $this->db->get();


			//$rut = $this->db->query('SELECT DISTINCT prsn_rut FROM `s_socios` WHERE estado = 0');

			return $rut->result();
		}
		
		function es_Activo($rut)
		{
			$this->db->distinct();

			$this->db->select('prsn_rut');

			$this->db->from('s_socios');

			$this->db->where('estado', '0');

			$this->db->where(' prsn_rut', $rut);

			$rut = $this->db->get();


			//$rut = $this->db->query('SELECT DISTINCT prsn_rut FROM `s_socios` WHERE estado = 0');

			return $rut->result();

		}





		function socios_activos()
		{

			$this->db->distinct();

			$this->db->select('prsn_rut');

			$this->db->from('s_socios');

			$this->db->where('estado', 0);



			$query2 = $this->db->get();

			$returnArray    = array();

			$returnArray['num_rows'] = $query2->num_rows();  //get num_rows before you do the result()

			return $returnArray;
		}

		function socios_baja()
		{

			$this->db->distinct();

			$this->db->select('prsn_rut');

			$this->db->from('s_socios');

			$this->db->where('estado', 1);



			$query2 = $this->db->get();

			$returnArray    = array();

			$returnArray['num_rows'] = $query2->num_rows();  //get num_rows before you do the result()

			return $returnArray;
		}

		function socios_inactivos()
		{

			$this->db->distinct();

			$this->db->select('prsn_rut');

			$this->db->from('s_socios');

			$this->db->where('tipo_id', 4);



			$query2 = $this->db->get();

			$returnArray    = array();

			$returnArray['num_rows'] = $query2->num_rows();  //get num_rows before you do the result()

			return $returnArray;
		}



		function mostrar_socios($estado, $rut_corp)
		{



			$this->db->select('prsn_rut');

			$this->db->from('s_socios');

			$this->db->where('estado', $estado);

			$this->db->where('corporacion', $rut_corp);



			$query2 = $this->db->get();

			$num_rows = $query2->num_rows();

			return $num_rows;
		}

		function mostrar_sociosb($estado, $rut_corp)
		{



			$this->db->select('prsn_rut');

			$this->db->from('s_socios');

			$this->db->where('tipo_id', $estado);

			$this->db->where('corporacion', $rut_corp);



			$query2 = $this->db->get();

			$num_rows = $query2->num_rows();

			return $num_rows;
		}



		function insertar($data)
		{

			$this->db->insert('s_personas', $data);
		}

		function insertar_carg($data)
		{

			$this->db->insert('s_cargas_socios', $data);
		}



		function ins_depor($rut, $depor)
		{



			$this->db->where('prsn_rut', $rut);

			$this->db->update('s_personas', $depor);

			// $query2 = $this->db->get(); 



		}





		function ultimoId()
		{

			$this->db->select_max('prsn_id');

			$this->db->from('s_personas');

			$query2 = $this->db->get();

			// $num_rows = $query2->num_rows();

			$res2 = $query2->result_array();

			$result = $res2[0]['prsn_id'];

			return $result;
		}



		function insertarSocCorp($data)
		{


			$this->db->query('SET FOREIGN_KEY_CHECKS  = 0');
			$this->db->insert('s_socios', $data);
			$this->db->query('SET FOREIGN_KEY_CHECKS = 1');
		}

		function insertarSocPatro($data)
		{

			$this->db->insert('s_patrocinador_has_s_socios', $data);
		}



		function actualizarSocio($data, $rut)
		{

			$this->db->where('prsn_rut', $rut);

			$this->db->update('s_personas', $data);
		}

		function updateSocio($data, $rut)
		{

			$this->db->where('prsn_rut', $rut);

			$this->db->update('s_socios', $data);
		}



		function act_estado($data, $rut_corp, $rut)
		{

			$this->db->where('prsn_rut', $rut);

			$this->db->where('corporacion', $rut_corp);

			$this->db->update('s_socios', $data);
		}





		function IdPersona($rut)
		{



			$idprsn =  $this->db->query('SELECT prsn_id FROM s_personas  WHERE prsn_rut = "' . $rut . '"');





			return $idprsn->result();
		}



		function cuotaOrd($ano, $sem)
		{



			$cuotaord =  $this->db->query('SELECT * FROM s_cuota_ordinaria  WHERE ano = "' . $ano . '" AND semestre = "' . $sem . '" ');

			return $cuotaord->result();
		}



		function insertarResolucion($data)
		{

			$this->db->insert('s_resoluciones', $data);

			return $this->db->insert_id();
		}


		function funcionario($rut)
		{

			$usuario =  $this->db->query('SELECT * FROM funcionario  WHERE rut = "' . $rut . '"');

			return $usuario->result();
		}

		function notificaciones($rut)
		{

			$query =  $this->db->query('SELECT * FROM s_resoluciones  WHERE s_socios_prsn_rut = "' . $rut . '" ');

			return $query->result();
		}

		function insertarCuota($data)
		{

			$this->db->insert('s_cuota_ordinaria', $data);

			return $this->db->insert_id();
		}



		function ultimoId_cuota()
		{

			$this->db->select_max('id_cuota');

			$this->db->from('s_cuota_ordinaria');

			$query2 = $this->db->get();

			// $num_rows = $query2->num_rows();

			$res2 = $query2->result_array();

			$result = $res2[0]['id_cuota'];

			return $result;;
		}

		function impagos()
		{

			$query = $this->db->query('SELECT DISTINCT(cuota.cuota_ordinaria_id_cuota), cuota.s_socios_prsn_rut,cuota.saldo,cuota.total_pagado FROM s_socios s, s_cuotaord_socios cuota, s_cuota_ordinaria c WHERE s.prsn_rut = cuota.s_socios_prsn_rut AND cuota.cuota_ordinaria_id_cuota = c.id_cuota AND s.estado = 0 AND cuota.estado = 0 AND cuota.total_pagado <> 0');
			return $query->result();
		}

		function datosCuota($id)
		{

			$query = $this->db->query('SELECT valor FROM s_cuota_ordinaria WHERE id_cuota = "' . $id . '"');
			$res2 = $query->result_array();

			$result = $res2[0]['valor'];
			return $result;
		}


		function actCuota($data, $sem, $ano)
		{

			$this->db->where('semestre', $sem);

			$this->db->where('ano', $ano);

			$this->db->update('s_cuota_ordinaria', $data);
		}



		function actualizarPago($data, $rut, $id)
		{

			$this->db->where('cuota_ordinaria_id_cuota', $id);

			$this->db->where('s_socios_prsn_rut', $rut);

			$this->db->update('s_cuotaord_socios', $data);
		}



		function insertarFact($data)
		{

			$this->db->insert('s_factura', $data);
		}

		function tipoSocios($tipo)
		{

			$cant = $this->db->query('SELECT  DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno, prsn_fechanacimi from s_personas p, s_socios s where p.prsn_rut = s.prsn_rut AND s.tipo_id = "' . $tipo . '"');



			return $cant->result();
		}
		function CondSocio($tipo)
		{

			$cant = $this->db->query('SELECT  DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno, prsn_fechanacimi from s_personas p, s_socios s where p.prsn_rut = s.prsn_rut AND s.cond_id = "' . $tipo . '"');



			return $cant->result();
		}
		function Cond2Socio($tipo)
		{

			$cant = $this->db->query('SELECT  DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno, prsn_fechanacimi from s_personas p, s_socios s where p.prsn_rut = s.prsn_rut AND s.cond2_id = "' . $tipo . '"');



			return $cant->result();
		}

		function tipoSocios2($tipo1, $tipo2)
		{

			$cant = $this->db->query('SELECT  DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno, prsn_fechanacimi from s_personas p, s_socios s where p.prsn_rut = s.prsn_rut AND s.tipo_id > 1 AND s.tipo_id < 4');



			return $cant->result();
		}

		function detalleGraficoC($min, $max)
		{

			$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno, prsn_fechanacimi from s_personas p, s_cargas_socios s where p.prsn_rut = s.s_personas_prsn_rut AND (YEAR(CURDATE())-YEAR(prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) BETWEEN "' . $min . '" AND "' . $max . '"');



			return $cant->result();
		}



		function detalleGrafico($min, $max)
		{



			$cant = $this->db->query('SELECT  DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno, prsn_fechanacimi, s.estado from s_personas p, s_socios s where p.prsn_rut = s.prsn_rut AND s.estado = 0 AND (YEAR(CURDATE())-YEAR(prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) BETWEEN "' . $min . '" AND "' . $max . '" order by prsn_fechanacimi');



			return $cant->result();
		}

		function detalleGenerosS($gen)
		{



			$cant = $this->db->query('SELECT  DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno, p.prsn_fechanacimi, s.estado from s_personas p, s_socios s where p.prsn_rut = s.prsn_rut AND  s.estado = 0 AND p.prsn_sexo = "' . $gen . '" ');



			return $cant->result();
		}

		function detalleGenerosC($gen)
		{



			$cant = $this->db->query('SELECT  DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno, prsn_fechanacimi, q.estado from s_personas p, s_cargas_socios  s, s_socios q where p.prsn_rut = s.s_personas_prsn_rut AND q.estado = 0 AND p.prsn_sexo = "' . $gen . '" AND q.prsn_rut = s.s_socios_prsn_rut order by p.prsn_apellidopaterno');



			return $cant->result();
		}

		function detalleGraficoGenC($min, $max, $gen)
		{

			$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno, prsn_fechanacimi, s.estado from s_personas p, s_cargas_socios s where p.prsn_sexo = "' . $gen . '" AND s.estado = 0 AND   p.prsn_rut = s.s_personas_prsn_rut AND (YEAR(CURDATE())-YEAR(prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) BETWEEN "' . $min . '" AND "' . $max . '"');

			return $cant->result();
		}

		function detalleGraficoGen($min, $max, $gen)
		{



			$cant = $this->db->query('SELECT  DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno, prsn_fechanacimi, s.estado from s_personas p, s_socios s where p.prsn_sexo = "' . $gen . '" AND s.estado = 0 AND p.prsn_rut = s.prsn_rut AND (YEAR(CURDATE())-YEAR(prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) BETWEEN "' . $min . '" AND "' . $max . '" order by prsn_fechanacimi');



			return $cant->result();
		}

		function date_agenda($fecha1)
		{
			$query = $this->db->query('SELECT * FROM a_socios s, a_visita v, a_jornada j WHERE s.rut_socio = v.a_socios_rut_socio AND v.a_jornada_ida_jornada = j.id_jornada AND j.inicio = "' . $fecha1 . '"');
			return $query->result();
		}
		function date_agenda_externo($fecha1)
		{
			$query = $this->db->query('SELECT * FROM a_externo e, a_visita_externo v, a_jornada j WHERE e.rut_externo = v.rut_externo AND v.id_jornada = j.id_jornada AND j.inicio = "' . $fecha1 . '"');
			return $query->result();
		}

		function cargas_visita($visita)
		{
			$query = $this->db->query('SELECT * FROM a_cargas_has_a_visita cv, a_cargas c WHERE cv.a_visita_ida_visita = "' . $visita . '" AND c.rut_carga = cv.a_cargas_rut_carga');
			return $query->result();
		}



		function cantidad($min, $max)
		{



			$cant = $this->db->query('SELECT COUNT(DISTINCT(p.prsn_rut)) as cant, s.estado from s_personas p, s_socios s where p.prsn_rut = s.prsn_rut AND s.estado = 0 AND (YEAR(CURDATE())-YEAR(prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) BETWEEN "' . $min . '" AND "' . $max . '"');



			$res2 = $cant->result_array();

			$result = $res2[0]['cant'];

			return $result;
		}

		function cantidadGen($min, $max, $gen)
		{



			$cant = $this->db->query('SELECT COUNT(DISTINCT(p.prsn_rut)) as cant, s.estado from s_personas p, s_socios s where p.prsn_sexo = "' . $gen . '" AND p.prsn_rut = s.prsn_rut AND s.estado = 0 AND (YEAR(CURDATE())-YEAR(prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) BETWEEN "' . $min . '" AND "' . $max . '"');



			$res2 = $cant->result_array();

			$result = $res2[0]['cant'];

			return $result;
		}

		function SociosGen($gen)
		{



			$cant = $this->db->query('SELECT COUNT(DISTINCT(p.prsn_rut)) as cant, s.estado from s_personas p, s_socios s where p.prsn_sexo = "' . $gen . '" AND p.prsn_rut = s.prsn_rut AND s.estado = 0');



			$res2 = $cant->result_array();

			$result = $res2[0]['cant'];

			return $result;
		}

		function CargasGen($gen)
		{



			$cant = $this->db->query('SELECT COUNT(DISTINCT(p.prsn_rut)) as cant from s_personas p, s_cargas_socios s, s_socios q where p.prsn_sexo = "' . $gen . '" AND p.prsn_rut = s.s_personas_prsn_rut AND q.estado = 0 AND q.prsn_rut = s.s_socios_prsn_rut');



			$res2 = $cant->result_array();

			$result = $res2[0]['cant'];

			return $result;
		}

		function cantidadCargas($min, $max)
		{

			$cant = $this->db->query('SELECT COUNT(DISTINCT(p.prsn_rut)) as cant from s_personas p, s_cargas_socios s, s_socios q where p.prsn_rut = s.s_personas_prsn_rut AND q.prsn_rut = s.s_socios_prsn_rut AND q.estado = 0 AND  (YEAR(CURDATE())-YEAR(prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) BETWEEN "' . $min . '" AND "' . $max . '"');



			$res2 = $cant->result_array();

			$result = $res2[0]['cant'];

			return $result;
		}

		function cantidadCargasGen($min, $max, $gen)
		{

			$cant = $this->db->query('SELECT COUNT(DISTINCT(p.prsn_rut)) as cant from s_personas p, s_cargas_socios s, s_socios q where p.prsn_sexo = "' . $gen . '" AND q.prsn_rut = s.s_socios_prsn_rut AND q.estado = 0 AND  p.prsn_rut = s.s_personas_prsn_rut AND (YEAR(CURDATE())-YEAR(prsn_fechanacimi) + IF(DATE_FORMAT(CURDATE(),"%m-%d") > DATE_FORMAT(prsn_fechanacimi,"%m-%d"), 0 , -1 ) ) BETWEEN "' . $min . '" AND "' . $max . '"');



			$res2 = $cant->result_array();

			$result = $res2[0]['cant'];

			return $result;
		}

		function TipoSocio($tipo)
		{



			$cant = $this->db->query('SELECT COUNT(DISTINCT(p.prsn_rut)) as cant from s_personas p, s_socios s where p.prsn_rut = s.prsn_rut AND s.tipo_id = "' . $tipo . '" AND s.estado = 0');



			$res2 = $cant->result_array();

			$result = $res2[0]['cant'];

			return $result;
		}

		function CondisionSocio($tipo)
		{
			$cant = $this->db->query('SELECT COUNT(DISTINCT(p.prsn_rut)) as cant from s_personas p, s_socios s where p.prsn_rut = s.prsn_rut AND s.cond_id = "' . $tipo . '" ');



			$res2 = $cant->result_array();

			$result = $res2[0]['cant'];

			return $result;
		}
		function Condision2Socio($tipo)
		{
			$cant = $this->db->query('SELECT COUNT(DISTINCT(p.prsn_rut)) as cant from s_personas p, s_socios s where p.prsn_rut = s.prsn_rut AND s.cond2_id = "' . $tipo . '"');



			$res2 = $cant->result_array();

			$result = $res2[0]['cant'];

			return $result;
		}



		function num_cuota($año, $inicio)
		{



			$cant = $this->db->query('SELECT id_cuota FROM s_cuota_ordinaria WHERE semestre = "' . $inicio . '" AND ano = "' . $año . '"');

			$res2 = $cant->result_array();

			$result = $res2[0]['id_cuota'];

			return $result;
		}

		function verificarCuota($rutSocio, $idCuota)
		{



			$cant = $this->db->query('SELECT total_pagado FROM s_cuotaord_socios WHERE cuota_ordinaria_id_cuota = "' . $idCuota . '" AND s_socios_prsn_rut = "' . $rutSocio . '"');

			$res2 = $cant->result_array();

			if (($cant->num_rows()) != 0) {

				return 1;
			} else {

				return 0;
			}

			// $result = $res2[0]['total_pagado'];

			//return $result;



		}

		function ultima_cuota($rut)
		{

			$query = $this->db->query('SELECT s_cuota_ordinaria.ano, s_cuota_ordinaria.semestre, s_cuotaord_socios.cuota_ordinaria_id_cuota FROM  s_cuotaord_socios, s_cuota_ordinaria WHERE s_cuotaord_socios.cuota_ordinaria_id_cuota = s_cuota_ordinaria.id_cuota  AND s_cuotaord_socios.s_socios_prsn_rut = "' . $rut . '" AND s_cuotaord_socios.estado = 1 order by s_cuotaord_socios.cuota_ordinaria_id_cuota desc LIMIT 1');
			return $query->result();
		}

		function ultimaCuota($rut)
		{

			$query = $this->db->query('SELECT s_cuotaord_socios.cuota_ordinaria_id_cuota as cuota, s_cuota_ordinaria.ano as ano , s_cuota_ordinaria.semestre as semestre FROM  s_cuotaord_socios, s_cuota_ordinaria,s_socios WHERE s_cuotaord_socios.cuota_ordinaria_id_cuota = s_cuota_ordinaria.id_cuota  AND s_cuotaord_socios.s_socios_prsn_rut = "' . $rut . '" AND s_cuotaord_socios.estado = 1 order by s_cuotaord_socios.cuota_ordinaria_id_cuota desc LIMIT 1');
			return $query->result();
		}


		function insertAsignarCuota($data)
		{

			$this->db->insert('s_cuotaord_socios', $data);

			return $this->db->insert_id();
		}

		function sociosVigentes()
		{
			$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno,p.prsn_fechanacimi, s.tipo_id FROM s_personas p, s_socios s WHERE s.prsn_rut = p.prsn_rut AND s.estado = 0 order by p.prsn_apellidopaterno');

			return $cant->result();
		}
		function sociosActivos()
		{
			$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno, s.tipo_id FROM s_personas p, s_socios s WHERE s.prsn_rut = p.prsn_rut AND s.estado = 0 AND s.tipo_id = 1 order by p.prsn_apellidopaterno asc');

			return $cant->result();
		}

		function sociosHonorarios()
		{
			$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno, s.tipo_id FROM s_personas p, s_socios s WHERE s.prsn_rut = p.prsn_rut AND s.estado = 0 AND (s.tipo_id = 3 OR s.tipo_id = 2) order by p.prsn_apellidopaterno');

			return $cant->result();
		}

		function saldoSocio($rut)
		{
			setlocale(LC_MONETARY, 'es_CL');
			$cant = $this->db->query('SELECT SUM(saldo) as saldo FROM `s_cuotaord_socios` WHERE `s_socios_prsn_rut` = "' . $rut . '"');
			$res2 = $cant->result_array();
			$result = $res2[0]['saldo'];
			$deuda = number_format($result, 0, ",", ".");
			return $deuda;
		}
		function pagadoSocio($rut)
		{
			setlocale(LC_MONETARY, 'es_CL');
			$cant = $this->db->query('SELECT SUM(total_pagado) as total FROM `s_cuotaord_socios` WHERE `s_socios_prsn_rut` = "' . $rut . '"');
			$res2 = $cant->result_array();
			$result = $res2[0]['total'];
			$pagado = number_format($result, 0, ",", ".");
			return $pagado;
		}

		function fechaReg($rut)
		{
			$cant = $this->db->query('SELECT MIN(fecha_registro) as fecha FROM `s_socios` WHERE `prsn_rut` = "' . $rut . '"');
			$res2 = $cant->result_array();
			$result = $res2[0]['fecha'];

			return $result;
		}

		function eliminar_cuota($rut, $cuota)
		{

			$query = $this->db->query('DELETE FROM `s_cuotaord_socios` WHERE cuota_ordinaria_id_cuota < "' . $cuota . '" AND s_socios_prsn_rut = "' . $rut . '"');

			//return $query -> result();
		}

		function agendaSocios()
		{

			$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno, p.prsn_email, p.prsn_fono_movil, p.prsn_fono_casa FROM s_personas p, s_socios s WHERE s.prsn_rut = p.prsn_rut AND s.estado = 0 AND s.tipo_id >= 1 AND  s.tipo_id <= 3 order by p.prsn_apellidopaterno asc');

			return $cant->result();
		}
		function agendaActivos()
		{

			$cant = $this->db->query('SELECT DISTINCT(p.prsn_rut), p.prsn_nombres, p.prsn_apellidopaterno, p.prsn_apellidomaterno, p.prsn_email, p.prsn_fono_movil, p.prsn_fono_casa FROM s_personas p, s_socios s WHERE s.prsn_rut = p.prsn_rut AND s.estado = 0 AND s.tipo_id = 1 order by p.prsn_apellidopaterno asc');

			return $cant->result();
		}



		function sociosAll()
		{

			$cant = $this->db->query('');

			return $cant->result();
		}









	}







	?>