<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {


    function __construct()
    {
  
      parent::__construct();  
      $this->load->library('session');  
      $this->load->helper('url');  
      $this->load->helper('form');  
      $this->load->library('form_validation');  
      $this->load->library('mpdf60/Mpdf');  
      $this->load->model('model_socios');  
      $this->load->model('model_accionistas');
    }
   


	public function index()
	{
		$this->load->view('welcome_message');

	}


    public function todosocio(){

        $this->db->select_max('id_accionista');
        $query = $this->db->get('s_accionista');
        $data=$query->result_array();

        

        echo($data[0]['id_accionista']);




    }
}

