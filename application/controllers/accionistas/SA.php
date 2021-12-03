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

        /* $activos = $this->model_accionistas->id_activos(); */


        $directorioActual = $this->model_sa->directorio_sa_actual();


        foreach ($directorioActual as $Index => $directorioA) {

            $presidente = $this->model_accionistas->datosaccionista($directorioA->presidente);
            $presidente = $presidente[0];
            $vicepresidente = $this->model_accionistas->datosaccionista($directorioA->vicepresidente);
            $vicepresidente = $vicepresidente[0];
            $director1 = $this->model_accionistas->datosaccionista($directorioA->director1);
            $director1 = $director1[0];
            $director2 = $this->model_accionistas->datosaccionista($directorioA->director2);
            $director2 = $director2[0];
            $director3 = $this->model_accionistas->datosaccionista($directorioA->director3);
            $director3 = $director3[0];
            $director4 = $this->model_accionistas->datosaccionista($directorioA->director4);
            $director4 = $director4[0];
            $director5 = $this->model_accionistas->datosaccionista($directorioA->director5);
            $director5 = $director5[0];
            $fecha = $directorioA->fecha_directorio;
            $gerente = $directorioA->gerente;
        }

        $directores = array(
            1 => $director1,
            2 => $director2,
            3 => $director3,
            4 => $director4,
            5 => $director5,
        );

        $directorio = array(
            'presidente' => $presidente,
            'vicepresidente' => $vicepresidente,
            'director' => $directores,
            'gerente' => $gerente,
            'fecha' => $fecha,
        );





        $data['directorio'] = $directorio;




        $this->load->view('plantilla/Head');
        $this->load->view('accionistas/menu_sa', $data);
        $this->load->view('plantilla/Footer');
    }


    public function extraordinaria()
    {

        $this->load->view('plantilla/Head');
        $this->load->view('accionistas/sociedad/menu_extraordinaria');
        $this->load->view('plantilla/Footer');
    }
    public function ordinaria()
    {
        $this->load->view('plantilla/Head');
        $this->load->view('accionistas/sociedad/menu_ordinaria');
        $this->load->view('plantilla/Footer');
    }



    //Funciones del directorio

    public function directorio()

    {


        $directorio = $this->model_sa->directorio_sa_actual();




        $accionistas = $this->model_accionistas->accionistas();


        $data['accionistas'] = $accionistas;

        $this->load->view('plantilla/Head');
        $this->load->view('accionistas/sociedad/menu_directorio', $data);
        $this->load->view('plantilla/Footer');
    }

    public function nuevo_directorio()
    {


        $directorioActual = $this->model_sa->directorio_sa_actual();

        if (!empty($directorioActual)) {

            foreach ($directorioActual as $IndexDA => $DA) {

                $estado = array(

                    'estado_directorio' => '0',

                );



                $this->model_sa->actualizar_directorio($DA->id_directorio, $estado);
            }
        }



        $directorio = array(

            'fecha_directorio' => $this->input->post('fecha_directorio'),
            'presidente' => $this->input->post('presidente'),
            'vicepresidente' => $this->input->post('vicepresidente'),
            'director1' => $this->input->post('director1'),
            'director2' => $this->input->post('director2'),
            'director3' => $this->input->post('director3'),
            'director4' => $this->input->post('director4'),
            'director5' => $this->input->post('director5'),
            'estado_directorio' => 1,
        );


        return ($this->model_sa->insertar_directorio($directorio));
    }
}
