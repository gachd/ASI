<?php 
 class model_header extends CI_Model{
	 
	 
	 public function allEmpleado() {
		  $query = $this->db->get("funcionarios");
		   return $query -> result();
		 }
	 
	 
	 }
 ?>