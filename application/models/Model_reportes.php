<?php 
 class model_reportes extends CI_Model{


 	 function tipo_reportes($tipo){
		$query= $this-> db-> query ('SELECT * FROM `informes` WHERE `tipo` = '.$tipo.' ORDER BY informe ASC');
        return $query -> result();
		 }
	 }