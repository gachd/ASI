<?php

//defined('BASEPATH') OR exit('No direct script access allowed');



class titulos extends CI_Controller
{



    function __construct()
    {



        parent::__construct();

        $this->load->library('session');

        $this->load->model('model_socios');
        $this->load->model('model_libro');
        $this->load->model('model_titulo');
        $this->load->model('model_persona');
        $this->load->model('model_accionistas');


        $this->load->helper('url');

        $this->load->helper('form');

        $this->load->library('form_validation');

        $this->load->library('calendar');

        $this->load->library('session');
    }



    public function index()
    
    {

        $data['titulos'] = $this->model_titulo->infoTitulo();


        $this->load->view('plantilla/Head_v1');

        $this->load->view('titulos/titulos',$data);

        $this->load->view('plantilla/Footer');
    }

    public  function nuevoTitulo()
    {


        $data['accionista'] = $this->model_accionistas->accionista_sincontar_accion();


        $this->load->view('plantilla/Head_v1');

        $this->load->view('titulos/nuevo_titulo', $data);

        $this->load->view('plantilla/Footer');
    }

    public  function guadarNuevoTitulo()
    {

        $dataT = array(

            'id_accionista' => $prsn_id = $this->input->post('accionistaID'),

            'numero_acciones' => $num_acciones = $this->input->post('NumAC'),

            'fecha' => $fecha_titulo = $this->input->post('fechaT'),

            'estado' => $estado = 1,


        );





        $this->model_titulo->nuevo_titulo($dataT);



        redirect('accionistas/inicio');
    }



    public  function cesionTitulo()
    {


        $data['titulos'] = $this->model_titulo->titulosactivos();
        $data['accionista'] = $this->model_accionistas->accionista_sincontar_accion();






        $this->load->view('plantilla/Head_v1');

        $this->load->view('titulos/cesion_titulo', $data);

        $this->load->view('plantilla/Footer');
    }


    public  function guadarCesionTitulo()
    {


        $id_accionista = $this->input->post('accionistaID');
        $id_titulo_anterior = $this->input->post('tituloAnterior');
        $acciones = $this->model_titulo->acciones_de_titulo($id_titulo_anterior);

        $ultimoID = $this->model_titulo->ultimoId();
        $ultimo = $ultimoID[0]->maximo;




        $num_acciones = $acciones[0]->numero_acciones;


        $dataAntiguoT = array(


            'estado' => $estado = 0,




        );


        $dataNuevoT = array(


            'id_accionista' => $id_accionista,

            'numero_acciones' => $num_acciones,

            'fecha' => $fecha_titulo = $this->input->post('fechaNtitulo'),

            'estado' => $estado = 1,




        );

        $dataTablaTanferencia = array(


            'titulo_origen ' => $id_titulo_anterior,

            'tiulo_actual' => $ultimo + 1,

            'fecha_cesion' => $fecha_titulo = $this->input->post('fechaTrans'),




        );

        // print_r($_REQUEST['field_name']);



        $this->model_titulo->updatetitulos($dataAntiguoT, $id_titulo_anterior);

        $this->model_titulo->nueva_cesion($dataTablaTanferencia);

        $this->model_titulo->nuevo_titulo($dataNuevoT);




        redirect('accionistas/inicio');
    }











    public function agregarTitulo()
    {



        $prsnID = $this->model_accionistas->ultimoId();
        $prsn_id = $prsnID + 1;

        $rut = $_POST['rutP'];
        $prsn_tipo = $this->input->post('optradio');


        $dataP = array(


            'prsn_id' => $prsn_id,

            'prsn_rut' => $rut,

            'prsn_apellidopaterno' => $paterno = $this->input->post('ApellidoP'),

            'prsn_apellidomaterno' => $materno = $this->input->post('ApellidoM'),

            'prsn_nombres' => $nombres = $this->input->post('nombres'),

            'prsn_fechanacimi' => $fecha_nac = $this->input->post('FechaN'),

            'prsn_sexo' => $sexo = $this->input->post('sexo'),

            'prsn_email' => $correo = $this->input->post('Correo'),


            'prsn_direccion' =>  $direc = $this->input->post('Direccion'),

            'prsn_fono_movil' => $tel_cel = $this->input->post('Fono'),



            'prsn_tipo' => $prsn_tipo,



            'prsn_fallecido' => $prsn_fallecido = 0,


            's_estado_civil_estacivil_id' => $estadocivil = $this->input->post('estadocivil'), //persona natural

            's_comunas_comuna_id' => $comu = $this->input->post('comu'),

            'provincia_id' => $region = $this->input->post('provi'),

            'region_id' => $region = $this->input->post('region'),

        );

        $dataA = array(
            'prsn_rut' => $rut,

            'foja_accionista' => $foja_accionista = $this->input->post('foja'),
            'libro_accionista' => $libro_accionista = $this->input->post('libro'),
        );





        $dataT = array(

            'id_accionista' => $prsn_id,

            'numero_acciones' => $num_acciones = $this->input->post('NumAcciones'),

            //'fecha' => $fecha_titulo = $this->input->post('NumAcciones'),

            'estado' => $estado = 1,






        );



        $this->model_persona->insertar($dataP);

        $this->model_accionistas->insertar($dataA);

        $this->model_titulo->nuevo_titulo($dataT);

        redirect('accionistas/inicio');
    }





    
}
