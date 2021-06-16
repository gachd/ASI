<?php

class model_login extends CI_Model
{

	public function login($username, $password)
	{

		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$consulta =  $this->db->get('usuarios');
		$resultado = $consulta->row();
		return $resultado;
	}



	function menu_principal($usuario)
	{

		$query = $this->db->query('SELECT permisos.perm_principal
									FROM `user_permiso` 
									INNER JOIN permisos on user_permiso.id_permiso = permisos.perm_id
									WHERE id_usuario ="' . $usuario . '"
									GROUP BY permisos.perm_principal');


		if ($query) {
			return $query->result();
		} else {
			$r = $this->db->last_query();
			echo $r;
		}
	}




	function sub_menu($usuario, $menu)
	{

		if ($usuario == 0) {
			$query = $this->db->query('SELECT * FROM `permisos` WHERE `perm_principal` =' . $menu . ' ');
		} else {
			$query = $this->db->query('SELECT id_usuario,id_permiso,permisos.perm_desc,permisos.perm_principal,permisos.perm_nombre,permisos.perm_ruta
										FROM `user_permiso` 
										INNER JOIN permisos on user_permiso.id_permiso = permisos.perm_id
										WHERE id_usuario = "' . $usuario . '" AND `perm_principal`=' . $menu . '');
		}


		if ($query) {
			return $query->result();
		} else {
			$r = $this->db->last_query();
			echo $r;
		}
	}
}
