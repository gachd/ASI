<?php

defined('BASEPATH') or exit('No direct script access allowed');

class SA extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();


        $this->load->library('session');
        $this->load->library('mpdf60/Mpdf');
        $this->load->model('model_accionistas');
        $this->load->model('model_titulo');
        $this->load->model('model_sa');

    }



    public function index()
    {


        $data['accionistas'] = $this->model_accionistas->accionistas();
        $data['ultimos'] = $this->model_accionistas->ultimos();

        $no_entregados = $this->model_titulo->nro_titulos_no_entregados();
        $data['no_entregados'] =  $no_entregados[0]->no_entregados;


        $emitidas = $this->model_accionistas->totalemitidas();

        $totalemitidas = $emitidas[0]->total_emitidas;
        $data['emitidas'] = $totalemitidas;


        $sa = $this->model_sa->datos_sa();
        $total_acciones = $sa[0]->Acciones;
        $data['sa'] = $total_acciones;

        $saldo =  $total_acciones - $totalemitidas;

        $data['saldo'] = $saldo;

        $data['todo_sa'] = $this->model_sa->datos_sa();

        $activos = $this->model_accionistas->id_activos();

        $this->load->view('plantilla/Head');
        $this->load->view('accionistas/menu_sa',$data);
        $this->load->view('plantilla/Footer');
    }
}
