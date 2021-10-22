<?php

//defined('BASEPATH') OR exit('No direct script access allowed');



class Entrada extends CI_Controller
{



  function __construct()
  {



    parent::__construct();

    $this->load->library('session');

    $this->load->model('model_socios');

    $this->load->helper('url');

    $this->load->helper('form');

    $this->load->library('form_validation');

    $this->load->library('calendar');

    $this->load->library('session');
  }


  public function index()
  {

    $this->load->view('plantilla/Head');

    $this->load->view('socios/validaQR');

    $this->load->view('plantilla/Footer');
  }
}
