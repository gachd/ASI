<?php 
class model_dash extends CI_Model{

function total_categorias(){

	 $query = $this -> db -> query ('select count(act_id) as total, `ctg_nombre`,`year`
from actividades_anuales
WHERE year=YEAR(NOW())
group by `ctg_nombre`
ORDER BY  total DESC;');
	 return $query -> result();

 }
 function total_concecionario(){
 	$esp = $this -> db -> query ("SET lc_time_names = 'es_MX'");

	 $query = $this -> db -> query ('SELECT month(`act_fecha`) as n_mes,`sctg_nombre`,`mes`, COUNT(`act_id`) as total
FROM `actividades_anuales`
WHERE `year`=YEAR(NOW()) and `act_ctg_id` = 1
GROUP BY sctg_nombre
ORDER BY n_mes');
	 return $query -> result();

 }
}
 ?>
