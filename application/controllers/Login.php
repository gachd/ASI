<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Login extends CI_Controller
{

	function __construct()
	{

		parent::__construct();
		$this->load->library('session');
		$this->load->model('model_login');
		$this->load->helper('url');
	}

	public function index()
	{

		// ruta donde se redirecciona al encontrar sesion iniciada
		$redireccion = base_url() . 'calendario';


		if (isset($this->session->userdata['logueado'])) {

			redirect($redireccion);
		} else {

			$_POST['msj'] = '0';

			if (isset($_POST['password'])) {
				$usuario = $this->model_login->login($_POST['username'], $_POST['password']);




				if ($usuario) {


					$permiso_principal = $this->model_login->menu_principal($usuario->funcionario);
					$cont = 0;

					foreach ($permiso_principal as $permiso) {

						$permisos[$cont] = $permiso->perm_principal;
					}




					$usuario_data = array(
						'id' => $usuario->funcionario,
						'username' => $usuario->username,
						'permisos' => $usuario->permisos,
						'perm_principal' => $permiso_principal,
						'permisos_principal' => $permisos,
						'logueado' => TRUE
					);
					$this->session->set_userdata($usuario_data);


					redirect($redireccion);
				} else {

					$_POST['msj'] = '1';

					//	echo "<br />";


				}
			}


			$this->load->view('login/login');
		}
	}

	function logout()

	{

		$vars = array('id', 'username', 'logueado');
		$this->session->unset_userdata($vars);
		$this->session->sess_destroy();
		redirect('login');




		// $this->session->set_userdata(array('id' => '', 'username' => '', 'permisos' => '', 'logueado' => ''));
		// $this->session->sess_destroy();
		// header("Location:" . base_url() . "");
	}
	function error_404()

	{

		$this->load->view('errors/404');
	}

	public function comprobar_sesion()
	{

		
		if (isset($this->session->userdata['logueado'])) {

			$ESTADO_SESSION = 1;

		} else {

			$ESTADO_SESSION = null;
		}

		echo json_encode($ESTADO_SESSION);

	} 

}
