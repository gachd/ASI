<?php 
class model_dash extends CI_Model{

function total_anual($categoria){
if($categoria==""){
 $q="select count(act_id) as total, `mes`, month(`act_fecha`) as n_mes
from actividades_anuales
WHERE year=YEAR(NOW()) and `act_sctg_id` <> 29
group by `mes`
ORDER BY  n_mes ASC"; 

}else{

 $q="select count(act_id) as total, `mes`, month(`act_fecha`) as n_mes from actividades_anuales WHERE year=YEAR(NOW()) and act_ctg_id =".$categoria." group by `mes` ORDER BY n_mes ASC";

}

 $this -> db -> query ('SET lc_time_names = "es_MX"');
 $query = $this -> db -> query ($q);
 return $query -> result();

 }


 function total_categorias(){
    $query = $this -> db -> query ('select ROUND(((count(act_id) * 100)/(select count(act_id) 
         from actividades_anuales
         WHERE year=YEAR(NOW()) and `act_sctg_id` <> 29)),2) as porcentaje, ctg_nombre, COUNT(act_id) as total
         from actividades_anuales
         WHERE year=YEAR(NOW()) and `act_sctg_id` <> 29
         group by `ctg_nombre`
         ORDER BY total DESC');
    /*select count(act_id) as value, ctg_nombre as label
         from actividades_anuales
         WHERE year=YEAR(NOW()) and `act_sctg_id` <> 29
         group by `ctg_nombre*/
	return $query -> result();
 }

function total_subcategorias($subcategoria){

if($subcategoria==""){
	 $query = $this -> db -> query ('select ROUND(((count(act_id) * 100)/(select count(act_id) 
         from actividades_anuales
         WHERE year=YEAR(NOW()) and `act_sctg_id` <> 29)),2) as porcentaje, sctg_nombre, COUNT(act_id) as      total,act_ctg_id, `act_sctg_id`
         from actividades_anuales
         WHERE (act_sctg_id <> 122 OR act_sctg_id <> 29) AND year=YEAR(NOW()) 
         group by `sctg_nombre`
          order by total DESC');
}

	else{


    $query = $this -> db -> query ('select ROUND(((count(act_id) * 100)/(select count(act_id) 
         from actividades_anuales
         WHERE year=YEAR(NOW()) and `act_sctg_id` <> 29)),2) as porcentaje, sctg_nombre, COUNT(act_id) as      total,act_ctg_id, `act_sctg_id`
         from actividades_anuales
         WHERE (act_sctg_id <> 122 OR act_sctg_id <> 29) AND year=YEAR(NOW()) and act_ctg_id='.$subcategoria.'
         group by `sctg_nombre`
          order by total DESC');

}
	return $query -> result();
 }



function getCategorias(){ 
	$this->db->where("faena","0");
	$this->db->where("ctg_habilitado","0");
	$this -> db -> order_by('ctg_nombre','asc');
	 $categorias = $this ->db->get('categoria');	
		if($categorias -> num_rows() > 0){
			 return $categorias->result();
		}
}

function toal_mes_categoria(){
$query= $this->db->query("select ROUND(((count(act_id) * 100)/(select count(act_id) 
         from actividades_anuales
         WHERE (MONTH(act_fecha)= MONTH(CURDATE())) AND (YEAR(act_fecha)=YEAR(CURDATE())) and `act_sctg_id` <> 29)),2) as porcentaje,
         ctg_nombre,
         COUNT(act_id) as total
         from actividades_anuales
         WHERE (act_sctg_id <> 122 AND act_sctg_id <> 29) AND ((MONTH(act_fecha)= MONTH(CURDATE())) AND (YEAR(act_fecha)=YEAR(CURDATE())))
         group by `ctg_nombre`
          order by ctg_nombre ASC");
return $query -> result();
}

function total_prsns_mes($mes,$year){


    $query=$this->db->query('select SUM(act_nprsns) as total
FROM actividades
WHERE month(act_fecha)='.$mes.' AND year(act_fecha)='.$year.'');
    return $query -> result();

}


	 
}

 ?>
