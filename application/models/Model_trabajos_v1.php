<?php 
 class model_trabajos extends CI_Model{
	 
	 
	 /****trabajos***/////
	 
	   function getTrabajos($id){ 
		$this->db->where("tb_id",$id);		  
			 $trabajos = $this ->db->get('trabajos');	
			 if($trabajos -> num_rows() > 0){
				 return $trabajos->result();
				 }
	 }
	   function insertar ($data){
		 $this -> db -> insert('trabajos', $data);
		  }	

	 
	 
	   function getFuncionario(){ 
			$this->db->where("tipo","2");
			$this -> db -> order_by('paterno','asc');
			$funcionario = $this ->db->get('funcionario');	
			
			if($funcionario -> num_rows() > 0){
					 return $funcionario->result();
					 }	 
	   }
	    
	   function getCategorias(){ 
		$this->db->where("faena","1");
		$this->db->where("ctg_habilitado","0");
		  $this -> db -> order_by('ctg_nombre','asc');
			 $categorias = $this ->db->get('categoria');	
		
		
			 
			 if($categorias -> num_rows() > 0){
				 return $categorias->result();
				 }
		 
		 
	 }
	 
	function getCategoriasID($id){ 
            if($id<>0){
            	$this->db->where("ctg_id",$id);
            }
        $this->db->where("faena","1");
		$this->db->where("ctg_habilitado","0");
		$this -> db -> order_by('ctg_nombre','asc');
		$categorias = $this ->db->get('categoria');	
		    if($categorias -> num_rows() > 0){
				 return $categorias->result();
		    }
	}
	 
	   function getSubcate(){ 
	    $this->db->where("sctg_habilitado","0");
	    $this->db->where("sctg_tipo","1");
	    $this -> db -> order_by('categoria_ctg_id','asc');
		$this -> db -> order_by('sctg_nombre','asc');
		$subcategorias = $this ->db->get('sub_categoria');
		if($subcategorias -> num_rows() > 0){
			return $subcategorias->result();
		}
		 
		 
	 }
	
       function getSubcateID($categoria){ 
       	    $this->db->join('categoria', 'sub_categoria.categoria_ctg_id=categoria.ctg_id');
	        $this->db->where("sctg_habilitado","0");
	        $this->db->where("sctg_id",$categoria);
		    $this -> db -> order_by('categoria_ctg_id','asc');
		    $this -> db -> order_by('sctg_nombre','asc');
			 $subcategorias = $this ->db->get('sub_categoria');
			 
			 if($subcategorias -> num_rows() > 0){
				 return $subcategorias->result();
				 }
		 }

	function getDepen(){ 
	     $this->db->where('dep_habilitado = 0');
		 $this -> db -> order_by('letra','asc');
		 
			 $dep = $this ->db->get('dependencia');
			 
			 if($dep -> num_rows() > 0){
				 return $dep->result();
				 }
	}


    function getDepenID($sector){ 
    	if($sector <> 0){$this->db->where('sector',$sector);}

    	
	     $this->db->where('dep_habilitado = 0');
		 $this -> db -> order_by('letra','asc');
		 
			 $dep = $this ->db->get('dependencia');
			 
			 if($dep -> num_rows() > 0){
				 return $dep->result();
				 }
	}

	 
	 function getSector(){ 
	   		 $sec = $this->db->where('id <>','7');  
			 $sec = $this ->db->get('sectores');
			 
			 if($sec -> num_rows() > 0){
				 return $sec->result();
				 }
		 
		 
	 }

	 function getSectorID($id){ 
         if($id<>0){
         	$sec=$this->db->where('id = '.$id.''); 	
         }

	 		 
		$sec = $this ->db->get('sectores');
		if($sec -> num_rows() > 0){
		    return $sec->result();
		}
		 
		 
	 }
	 
	 
	 			  
		  
function insertar_pl_mensual ($data){
		 $this -> db -> insert('plan_temporada', $data);
		  }		  
		  
function dele_pl_mensual($categoria,$mes,$year){
		$this->db->delete('plan_temporada', array('pl_subcategoria' => $categoria, 'pl_temporada' => $mes,'pl_year' => $year));
		}	  
		  
		  
	    function MaxTRAB(){
			 $this->db->select_max('tb_id');
			 $sqlMax = $this->db->get('trabajos');
			 return $sqlMax -> result();			
			}
	 
	  function InserDep($dep){
			$this -> db -> insert('trabajos_has_dependencia', $dep);
			}	
		
		
		function funcionario_has_trabajos ($dataFunAct){
		 $this -> db -> insert('funcionario_has_trabajos', $dataFunAct);
		}

		function fun_realiza_tb($fun,$tb){
			$this->db->where('funcioanrio ="'.$fun.'"');
			$this->db->where('trabajo ='.$tb.'');
			$ft = $this ->db->get('funcionario_has_trabajos');
			 
			 if($ft -> num_rows() > 0){
				 return $ft->result();
				 }

		}
		function delete_funtb($id){
            $this->db->where('trabajo', $id);
            $this->db->delete('funcionario_has_trabajos');
        }



		  
		function getAll($fecha){
			if($fecha ==""){
				$query = $this -> db -> query ('select actividades.*,categoria.ctg_nombre,sub_categoria.sctg_nombre
                    from actividades INNER JOIN categoria ON actividades.act_ctg_id = categoria.ctg_id INNER JOIN sub_categoria ON actividades.act_sctg_id = sub_categoria.sctg_id Where YEAR(actividades.act_fecha) =YEAR(CURRENT_DATE()) and MONTH(actividades.act_fecha) =MONTH(CURRENT_DATE()) ORDER BY actividades.act_fecha ASC');
			}else{
				$query = $this -> db -> query ('select actividades.*,categoria.ctg_nombre,sub_categoria.sctg_nombre
                    from actividades
                    INNER JOIN categoria ON actividades.act_ctg_id = categoria.ctg_id 
                    INNER JOIN sub_categoria ON actividades.act_sctg_id = sub_categoria.sctg_id
                    WHERE actividades.act_fecha = "'.$fecha.'"
                    ORDER BY actividades.act_inicio ASC');
			}
			return $query -> result();
		}
		 
		 /********RESUMEN TRABAJOS MES*****/
		 
		public function trabajos_mes($s,$d,$m,$y){
 $query_mes = $this -> db -> query ('SELECT Count(trabajos_has_dependencia.trabajo) AS TOTAL_TB, trabajos_has_dependencia.sctg_id, Month(tb_fecha) AS MES, trabajos_has_dependencia.dependencia,YEAR(tb_fecha) AS anno
FROM (((trabajos_has_dependencia LEFT JOIN trabajos ON trabajos_has_dependencia.trabajo = trabajos.tb_id) INNER JOIN categoria ON trabajos_has_dependencia.ctg_id = categoria.ctg_id) INNER JOIN sub_categoria ON trabajos_has_dependencia.sctg_id = sub_categoria.sctg_id) INNER JOIN dependencia ON trabajos_has_dependencia.dependencia = dependencia.dep_id
GROUP BY trabajos_has_dependencia.sctg_id, Month(tb_fecha), trabajos_has_dependencia.dependencia
HAVING trabajos_has_dependencia.sctg_id="'.$s.'" AND mes='.$m.' AND trabajos_has_dependencia.dependencia="'.$d.'"  AND anno='.$y.'');
 return $query_mes -> result();
			 
			 }


/*trabajos  mes por categoria */

public function trabajos_mes_categoria($c,$m,$y){

$query=$this->db->query('SELECT Count(trabajos_has_dependencia.trabajo) AS TOTAL_TB, trabajos_has_dependencia.sctg_id, Month(tb_fecha) AS MES, trabajos_has_dependencia.dependencia,YEAR(tb_fecha) AS anno
FROM (((trabajos_has_dependencia LEFT JOIN trabajos ON trabajos_has_dependencia.trabajo = trabajos.tb_id) INNER JOIN categoria ON trabajos_has_dependencia.ctg_id = categoria.ctg_id) INNER JOIN sub_categoria ON trabajos_has_dependencia.sctg_id = sub_categoria.sctg_id) INNER JOIN dependencia ON trabajos_has_dependencia.dependencia = dependencia.dep_id
GROUP BY trabajos_has_dependencia.sctg_id, Month(tb_fecha)
HAVING trabajos_has_dependencia.sctg_id='.$c.' AND mes='.$m.' AND  anno="'.$y.'"');
return $query -> result();

}


			 
	 /**************RESUMEN TRABJOS/MES/SUBCATEGORIA/SECTOR*********///////		 
			 
			 
		public function total_tb_sector_subcat($s,$d,$m,$y){
 $query_trabjos_categoria_mes = $this -> db -> query('SELECT Count(trabajos.tb_id) AS total, 
Month(tb_fecha) AS mes,
 Year(tb_fecha) AS anno,
  sub_categoria.sctg_id, 
  sub_categoria.sctg_nombre,
   categoria.ctg_nombre,
    dependencia.sector
      FROM (categoria INNER JOIN (trabajos_has_dependencia INNER JOIN (trabajos INNER JOIN sub_categoria ON trabajos.tb_sctg_id = sub_categoria.sctg_id) ON trabajos_has_dependencia.trabajo = trabajos.tb_id) ON categoria.ctg_id = sub_categoria.categoria_ctg_id)
       INNER JOIN dependencia ON trabajos_has_dependencia.dependencia = dependencia.dep_id
GROUP BY Month(tb_fecha), Year(tb_fecha), sub_categoria.sctg_id, sub_categoria.sctg_nombre, categoria.ctg_nombre, dependencia.sector
HAVING 
	mes='.$m.' AND anno='.$y.' AND sub_categoria.sctg_id='.$s.' AND dependencia.sector='.$d.'');
 return $query_trabjos_categoria_mes -> result();}
			 
		 
		 /**** planificacion**/
		 
		 public function plan_mes($sub,$dep,$mes,$year){
			  $query_plan = $this -> db -> query ('SELECT  *
FROM plan_temporada
WHERE `pl_subcategoria`="'.$sub.'" AND `pl_temporada`='.$mes.' AND `pl_dependencia`="'.$dep.'" AND `pl_year`="'.$year.'"');
 return $query_plan -> result();
  }

  /***********BUSCAR POR RANGO DE FECHA**************/
		 
function getAllRango($fecha1, $fecha2){
	$querywr = $this -> db -> query ('SELECT *, categoria.ctg_nombre, sub_categoria.sctg_nombre
                          FROM `trabajos` 
                          INNER JOIN categoria on trabajos.tb_ctg_id = categoria.ctg_id
                          INNER JOIN sub_categoria on trabajos.tb_sctg_id = sub_categoria.sctg_id
                          WHERE trabajos.tb_fecha between "'.$fecha1.'" and "'.$fecha2.'"
                          ORDER BY trabajos.tb_fecha ASC');
    return $querywr -> result();

}

/*********BUSCAR POR FECHA**************/
function trabajos_fecha($fecha){
	$querywr = $this -> db -> query ('SELECT *, categoria.ctg_nombre, sub_categoria.sctg_nombre
                          FROM `trabajos` 
                          INNER JOIN categoria on trabajos.tb_ctg_id = categoria.ctg_id
                          INNER JOIN sub_categoria on trabajos.tb_sctg_id = sub_categoria.sctg_id
                          WHERE trabajos.tb_fecha = "'.$fecha.'" ORDER BY trabajos.tb_fecha ASC');
    return $querywr -> result();

}


		 
		 
function getDepenciaAct($act){  // dependencia por actividad
	    $dep_act= $this -> db -> query ('SELECT *, dependencia.dep_nombre
                    FROM `actividades_has_dependencia`
                    INNER JOIN dependencia  ON actividades_has_dependencia.dep_id_ad = dependencia.dep_id
                    WHERE actividades_has_dependencia.act_id_ad = '.$act.' 
                    ORDER BY dependencia.dep_nombre');
		return $dep_act -> result();
	}
		 
		 
	function getAllWORK($fechaw){
		 
		 if($fechaw ==""){
			   $queryw = $this -> db -> query ('SELECT *, categoria.ctg_nombre, sub_categoria.sctg_nombre
FROM `trabajos` 
INNER JOIN categoria on trabajos.tb_ctg_id = categoria.ctg_id
INNER JOIN sub_categoria on trabajos.tb_sctg_id = sub_categoria.sctg_id
Where YEAR(trabajos.tb_fecha) =YEAR(CURRENT_DATE()) and MONTH(trabajos.tb_fecha) =MONTH(CURRENT_DATE())
ORDER BY trabajos.tb_fecha ASC');
			 }else{
			   $queryw = $this -> db -> query ('SELECT *, categoria.ctg_nombre, sub_categoria.sctg_nombre
FROM `trabajos` 
INNER JOIN categoria on trabajos.tb_ctg_id = categoria.ctg_id
INNER JOIN sub_categoria on trabajos.tb_sctg_id = sub_categoria.sctg_id
WHERE trabajos.tb_fecha = "'.$fechaw.'"
ORDER BY trabajos.tb_fecha ASC');
}
		
		  return $queryw -> result();
		 }
		 
		 
		 /************TOTAL PLANIFICACION POR CATEGORIA Y SECTOR***************////////
		 
		 function totalPlan($subcategoria,$sector,$month){
			 
			 $query_totalPlan = $this -> db -> query ('SELECT planificacion_mensual.fecha, Sum(planificacion_mensual.cantidad) AS total, planificacion_mensual.pl_subcategoria, dependencia.sector
FROM planificacion_mensual INNER JOIN dependencia ON planificacion_mensual.pl_dependencia = dependencia.dep_id
GROUP BY planificacion_mensual.fecha, planificacion_mensual.pl_subcategoria, dependencia.sector
HAVING (((planificacion_mensual.fecha)='.$month.') AND ((planificacion_mensual.pl_subcategoria)='.$subcategoria.') AND ((dependencia.sector)='.$sector.'));
');			 
 return $query_totalPlan -> result();
			 
			 }
/************TOTAL PLANIFICACION POR SUBCATEGORIA**************////////
function totalPlanCategoria($subcategoria,$month,$year){
			 
			$query_totalPlan = $this -> db -> query ('SELECT planificacion_mensual.fecha, Sum(planificacion_mensual.cantidad) AS total, planificacion_mensual.pl_subcategoria, dependencia.sector, planificacion_mensual.year as anni
FROM planificacion_mensual INNER JOIN dependencia ON planificacion_mensual.pl_dependencia = dependencia.dep_id
GROUP BY planificacion_mensual.fecha, planificacion_mensual.pl_subcategoria
HAVING (((planificacion_mensual.fecha)='.$month.') AND (planificacion_mensual.pl_subcategoria)='.$subcategoria.') AND anni='.$year.'');			 
            return $query_totalPlan -> result();
			 
			 }




		 
		 
		 
		 
	function getFuncionarioWORK($trabajo){ 
			$funWORK = $this->db->query("SELECT funcionario.nombre_fun, funcionario.paterno,funcionario.rut
								FROM `funcionario_has_trabajos`
								INNER JOIN funcionario ON funcionario_has_trabajos.funcioanrio = funcionario.rut
								WHERE `trabajo`=".$trabajo."
								ORDER BY paterno");
			 return $funWORK -> result(); 
	   }

	//DEPENDENCIA POR TRABAJO   
	function getDepWORK($depw){ 
			$depWORK = $this->db->query("SELECT `dependencia`, dependencia.dep_nombre
									FROM `trabajos_has_dependencia` 
									INNER JOIN dependencia ON trabajos_has_dependencia.dependencia = dependencia.dep_id
									where `trabajo` = ".$depw."
									ORDER by dependencia.dep_nombre asc");
			 return $depWORK -> result(); 
	   }




	function trabajos_has_dependencia($work){
		 
		 $this->db->where('trabajo = '.$work.'');
		 $dep_work = $this ->db->get('trabajos_has_dependencia');
		 if($dep_work -> num_rows() > 0){
				 return $dep_work->result();
		 }
	  }
	function planificacion ($plan){
	  
	   $this -> db -> insert('planificacion', $plan);
	  }		  
	function actualizar($array,$id){  
		
		$this->db->set($array);
		$this->db->where('tb_id',$id);
		$this->db->update('trabajos'); 
		/* $this->db->update('trabajos', $array,$id);*/
		}
	
	function getsubcategoria($categoria){
			
          if($categoria<>0){$this->db->where("categoria_ctg_id",$categoria);}

			 $this->db->join('categoria', 'sub_categoria.categoria_ctg_id=categoria.ctg_id');
			 $this->db->where("sctg_habilitado","0");
			  $this->db->where("faena","1");
			
		  $this -> db -> order_by('	categoria_ctg_id','asc');
			 $subcategorias = $this->db->get("sub_categoria");
			 if($subcategorias -> num_rows() > 0){
				 return $subcategorias->result();
				 }

 	 }//fin function
	function getFaenaCategoria($categoriaFaena){
		 	 $this->db->select('faena');
			 $this->db->where("ctg_id",$categoriaFaena);
			 $faena = $this->db->get("categoria");
			 if($faena -> num_rows() > 0){
				 return $faena->result();
			 }
		 }
	function eliminar_dep($d){
		$this->db->where('trabajo',$d);
		return $this->db->delete('trabajos_has_dependencia');
	}
	function eliminar_fun($f){
		$this->db->where('trabajo',$f);
		return $this->db->delete('funcionario_has_trabajos');
	}
	
	function eliminar_plan($p){
		$this->db->where('trabajos',$p);
		return $this->db->delete('planificacion');
	}
	
	
	function eliminar_tb($id){
		$this->db->where('tb_id',$id);
		return $this->db->delete('trabajos');
	}


    //DASHBOAR CONTROL TRABAJOS 

    // TRABAJOS / PLANIFICACION /PORCENTAJE /DEPENDENCIA VIEW consolidado_TR3
    function  dep_planificadovsrealizado($dep_id){
    	$query = $this -> db -> query ('SELECT `dep_nombre`,SUM(`total_t`)as realizado,SUM(`total_p`) as planificado,`sector`, ROUND ((((SUM(total_t))/(SUM(total_p)))*100)) as porcentaje
            FROM `consolidado_RP2`
            WHERE `mes` = MONTH(CURDATE())  AND consolidado_RP2.year= YEAR(NOW()) AND dep_id='.$dep_id.'
            GROUP  BY `dep_nombre`');			 
        return $query-> result();
    }

    //FUNCIONARIOS STADIO
    function funcionarios_stadio(){
    	$funcionario=$this->db->where("tipo",2);
    	$funcionario=$this->db->where("habilitado",0);
    	$funcionario = $this->db->get("funcionario");
		if($funcionario -> num_rows() > 0){
		    return $funcionario->result();
		}

    }

    //veo si hay actividades en la fecha y dependencia seleccionada

function actv_rango_cerrado_depe($inicio,$fin,$depen){
	$query=$this->db->query('select actividades.act_inicio,actividades.act_termino, categoria.ctg_nombre, sub_categoria.sctg_nombre from actividades_has_dependencia 
            INNER JOIN actividades ON actividades_has_dependencia.act_id_ad = actividades.act_id 
            INNER JOIN categoria ON actividades.act_ctg_id = categoria.ctg_id
            INNER JOIN sub_categoria ON actividades.act_sctg_id = sub_categoria.sctg_id
            WHERE ("'.$inicio.'" <=`act_fecha_termino` AND  "'.$fin.'" >=`act_fecha`) AND `dep_id_ad`='.$depen.'
            order BY actividades.act_fecha  ASC');
	return $query-> result();
}

function cargar_trabajos($date,$categoria,$subcategoria,$dependencia){
$query=$this->db->query('select tb_fecha,tb_sctg_id,tb_ctg_id,dependencia,tb_estado,tb_planificado
	FROM trabajos_has_dependencia
	INNER JOIN trabajos ON trabajos_has_dependencia.trabajo= trabajos.tb_id
	WHERE tb_fecha="'.$date.'" AND tb_ctg_id='.$categoria.' AND tb_sctg_id='.$subcategoria.' AND dependencia='.$dependencia.'');
    return $query-> result();
}

function planificacion_temporada($sub,$dep,$temp,$year){
	$this->db->where('pl_subcategoria ='.$sub.'');
	$this->db->where('pl_dependencia = '.$dep.'');
	$this->db->where('pl_temporada ='.$temp.'');
	$this->db->where('pl_year ='.$year.'');
	$dep = $this ->db->get('plan_temporada');
	if($dep -> num_rows() > 0){
	 return $dep->result();
	}
}

function feriados($fecha){

    $query=$this->db->where('fecha',$fecha);
	$query = $this->db->get('feriados');
	 return $query-> result();
}

function Alltrabajos_mes($mes,$year){
	$query=$this->db->where('MONTH(tb_fecha)',$mes);
	$query=$this->db->where('YEAR(tb_fecha)',$year);
	$query = $this->db->get('trabajos');
	 return $query-> result();
}

// DISPONIBILIDAD DIAS DE TRABAJO

function disp_trabajo($dep,$sub){
	$query=$this->db->where('dependencia',$dep);
	$query=$this->db->where('subcategoria',$sub);
	$query = $this->db->get('disp_trabajo');
	 return $query-> result();
}


function delete_disp($sector,$sub){
	if($sector == 0){
		$query=$this->db->query('DELETE FROM `disp_trabajo`  WHERE   subcategoria='.$sub.'');
	}else{
		$query=$this->db->query('DELETE FROM `disp_trabajo`  WHERE sector ='.$sector.' AND subcategoria='.$sub.'');
	}
	 return $query;
}

function insertar_disp ($data){
		 $this -> db -> insert('disp_trabajo', $data);
		  }	

function trabajos_mes_subcategoria($mes,$year,$sub){
	 $query=$this->db->query('SELECT tb_fecha,`dependencia`, dependencia.dep_nombre, trabajos_has_dependencia.`sctg_id`, sub_categoria.sctg_nombre,trabajos_has_dependencia.`ctg_id`,categoria.ctg_nombre,tb_estado
FROM `trabajos_has_dependencia`
INNER JOIN trabajos ON trabajos_has_dependencia.trabajo= trabajos.tb_id
INNER JOIN dependencia on trabajos_has_dependencia.dependencia = dependencia.dep_id
INNER JOIN categoria on trabajos_has_dependencia.ctg_id = categoria.ctg_id
INNER JOIN sub_categoria on trabajos_has_dependencia.sctg_id = sub_categoria.sctg_id
WHERE MONTH(tb_fecha)='.$mes.' AND YEAR(tb_fecha)='.$year.' AND trabajos_has_dependencia.sctg_id='.$sub.'
ORDER BY trabajos_has_dependencia.`ctg_id`');
	 return $query-> result();
        

}
//trabajos que se rea<lizan en un dia por subactegoria y dependencia
function subcategoria_dep_dia($fecha,$dep,$sub){
		/* $query=$this->db->query('SELECT tb_fecha,`dependencia`, dependencia.dep_nombre, trabajos_has_dependencia.`sctg_id`, sub_categoria.sctg_nombre,trabajos_has_dependencia.`ctg_id`,categoria.ctg_nombre,tb_estado,dependencia.letra, dependencia.sector
FROM `trabajos_has_dependencia`
INNER JOIN trabajos ON trabajos_has_dependencia.trabajo= trabajos.tb_id
INNER JOIN dependencia on trabajos_has_dependencia.dependencia = dependencia.dep_id
INNER JOIN categoria on trabajos_has_dependencia.ctg_id = categoria.ctg_id
INNER JOIN sub_categoria on trabajos_has_dependencia.sctg_id = sub_categoria.sctg_id
WHERE tb_fecha="'.$fecha.'" AND trabajos_has_dependencia.sctg_id='.$sub.'
ORDER BY trabajos_has_dependencia.`ctg_id`');*/

$query=$this->db->query('SELECT tb_fecha
FROM `trabajos_has_dependencia`
INNER JOIN trabajos ON trabajos_has_dependencia.trabajo= trabajos.tb_id
WHERE tb_fecha="'.$fecha.'" AND sctg_id='.$sub.' AND dependencia='.$dep.'');


	 return $query-> result();
}




//dependencias con trabajo segun categoria y mes

function work_categoria_mes($mes,$year,$sub){
		 $query=$this->db->query('SELECT `dependencia`, dependencia.dep_nombre, trabajos_has_dependencia.`sctg_id`,  dependencia.sector
FROM `trabajos_has_dependencia`
INNER JOIN trabajos ON trabajos_has_dependencia.trabajo= trabajos.tb_id
INNER JOIN dependencia on trabajos_has_dependencia.dependencia = dependencia.dep_id
WHERE month(tb_fecha)='.$mes.' AND year(tb_fecha)='.$year.' AND trabajos_has_dependencia.sctg_id='.$sub.'
GROUP BY dependencia.dep_id
ORDER BY dependencia.sector asc
');
	 return $query-> result();
}



function trabajos_actualizar($mes,$year,$sub,$sector){
if($sector==0){
$query=$this->db->query('select * FROM `trabajos` WHERE `tb_sctg_id`='.$sub.' AND year(tb_fecha) ='.$year.' AND month(`tb_fecha`)='.$mes.'');
}
else{
	$query=$this->db->query('SELECT tb_id,tb_fecha,tb_sctg_id,dependencia.sector  FROM trabajos_has_dependencia 
INNER JOIN trabajos on trabajos_has_dependencia.trabajo = trabajos.tb_id
INNER JOIN dependencia on trabajos_has_dependencia.dependencia = dependencia.dep_id
WHERE month(tb_fecha)='.$mes.' and year(tb_fecha) ='.$year.' and tb_sctg_id='.$sub.' and dependencia.sector='.$sector.'');
}
return $query-> result();
}


function total_funcionarios($fecha){
	$query=$this->db->query('SELECT COUNT(funcionario) as total
FROM turno_has_funcionario
INNER JOIN turno ON turno_has_funcionario.turno = turno.t_id
WHERE fecha="'.$fecha.'" and turno.trabaja = 0 AND tipo_funcionario = 2');

return $query-> result();
}
function total_guardias($fecha){
	$query=$this->db->query('SELECT COUNT(funcionario) as total
FROM turno_has_funcionario
INNER JOIN turno ON turno_has_funcionario.turno = turno.t_id
WHERE fecha="'.$fecha.'" and turno.trabaja = 0 AND tipo_funcionario = 4');

return $query-> result();
}


//ACTUALIZAR TRABAJO (trabajo realizado)

function update_trabajo($id,$data){
$this->db->where('tb_id', $id);
$this->db->update('trabajos', $data);
	
}


//trabajo - dependencia por rango de fecha y subcategoria

function work_dep_porfechaysub($inicio,$fin,$subcategoria){

$query=$this->db->query('SELECT trabajos_has_dependencia.sctg_id, trabajos_has_dependencia.dependencia, dependencia.dep_nombre, trabajos.tb_fecha FROM `trabajos_has_dependencia` INNER JOIN trabajos ON trabajos_has_dependencia.trabajo = trabajos.tb_id INNER JOIN dependencia ON trabajos_has_dependencia.dependencia = dependencia.dep_id WHERE `sctg_id` = '.$subcategoria.' AND ("'.$fin.'" <= trabajos.tb_fecha_termino AND "'.$inicio.'" >=trabajos.tb_fecha)');
return $query-> result();

}


/* sub_categoria de trabajos que se han realizado en una dependencia especifica*/
function subcate_realizadas_dependencia($dep){

$query=$this->db->query('SELECT categoria.ctg_nombre, sub_categoria.sctg_nombre,sub_categoria.sctg_id
FROM `trabajos_has_dependencia`
INNER JOIN categoria on trabajos_has_dependencia.ctg_id = categoria.ctg_id
INNER JOIN sub_categoria on trabajos_has_dependencia.sctg_id = sub_categoria.sctg_id
	WHERE `dependencia` ='.$dep.'
	GROUP BY sctg_id
ORDER BY categoria.ctg_nombre');
return $query-> result();

}
/*ultimos diez trabajos que se han realizado en una dependencia segun subcategoria*/

function ultimos_diez_subcategoria($sub_categoria,$depe){

$query=$this->db->query('SELECT tb_fecha,trabajos.tb_tipo_responsable,(tb_fecha - tb_fecha_termino) as duracion
 FROM `trabajos_has_dependencia`
 INNER JOIN trabajos on trabajos_has_dependencia.trabajo = trabajos.tb_id
  WHERE `dependencia` = '.$depe.' 
  AND tb_estado=1 
  AND sctg_id = '.$sub_categoria.'
  ORDER BY trabajos.tb_fecha DESC LIMIT 10');
return $query-> result();

}




/*********REALIZADOS PLANIFICADOS / RANGO FECHA /SUBCATEGORIA**************/
function realizados_planificados($inicio,$termino,$sub){

$query=$this->db->query('SELECT COUNT(tb_fecha) as RP FROM trabajos_has_dependencia 
INNER JOIN trabajos on trabajos_has_dependencia.trabajo = trabajos.tb_id

 WHERE (tb_fecha_termino<="'.$termino.'" AND tb_fecha >= "'.$inicio.'") AND tb_sctg_id='.$sub.' AND tb_estado=1 AND tb_planificado=0');
return $query-> result();

}


/*********NO REALIZADOS PLANIFICADOS / RANGO FECHA/SUBCATEGORIA **************/
function no_realizados_planificados($inicio,$termino,$sub){

$query=$this->db->query('SELECT COUNT(tb_id) as NRP FROM `trabajos` 

	WHERE (tb_fecha_termino<="'.$termino.'" AND tb_fecha >= "'.$inicio.'") AND tb_sctg_id='.$sub.' AND tb_estado=0 AND tb_planificado=0');
return $query-> result();

}


/*********TOTAL PLANIFICADOS / RANGO FECHA/SUBCATEGORIA **************/
function total_planificados($inicio,$termino,$sub){

$query=$this->db->query('SELECT COUNT(tb_id) as TP FROM `trabajos` WHERE (tb_fecha_termino<="'.$termino.'" AND tb_fecha >= "'.$inicio.'") AND tb_sctg_id='.$sub.' AND tb_planificado=0');
return $query-> result();

}



/*********REALIZADOS NO PLANIFICADOS / RANGO FECHA/SUBCATEGORIA **************/
function realizados_no_planificados($inicio,$termino,$sub){

$query=$this->db->query('SELECT COUNT(tb_fecha) as NP FROM trabajos_has_dependencia 
INNER JOIN trabajos on trabajos_has_dependencia.trabajo = trabajos.tb_id 

	WHERE (tb_fecha_termino<="'.$termino.'" AND tb_fecha >= "'.$inicio.'") AND tb_sctg_id='.$sub.' AND tb_estado=1 AND tb_planificado=1');
return $query-> result();

}


/************categorias planificadas de trabajos por rango de trbajos***************/

function categorias_planificadas($inicio,$termino){

$query=$this->db->query('SELECT tb_sctg_id, sub_categoria.sctg_nombre FROM `trabajos` INNER JOIN sub_categoria on trabajos.tb_sctg_id = sub_categoria.sctg_id WHERE (tb_fecha_termino<="'.$termino.'" AND tb_fecha >= "'.$inicio.'") GROUP BY (tb_sctg_id) ORDER by sctg_nombre');
return $query-> result();

}



 }

		 
		
?>