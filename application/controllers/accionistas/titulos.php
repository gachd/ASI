<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Titulos extends CI_Controller {

  
    function __construct()
    {



        parent::__construct();
        //$this->output->enable_profiler(TRUE);

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



        $data['sin_entregar'] = $this->model_titulo->titulos_no_entregados();

        $data['titulos'] = $this->model_titulo->titulosactivos();



        $this->load->view('plantilla/Head_v1');

        $this->load->view('titulos/titulos', $data);

        $this->load->view('plantilla/Footer');
    }

    public  function nuevoTitulo()
    {


        $data['accionista'] = $this->model_accionistas->accionistasALL();


        $this->load->view('plantilla/Head_v1');

        $this->load->view('titulos/nuevo_titulo', $data);

        $this->load->view('plantilla/Footer');
    }
    public  function entregados()
    {

        $data['titulos'] = $this->model_titulo->titulosactivos();


        $data['accionista'] = $this->model_accionistas->accionistas();
        $data['sin_entregar'] = $this->model_titulo->titulos_no_entregados();


        $this->load->view('plantilla/Head_v1');

        $this->load->view('titulos/titulos_no_entregado', $data);

        $this->load->view('plantilla/Footer');
    }


    public  function entregar()
    {

        $fecha = $this->input->post('fecha');
        $id_titulo = $this->input->post('Titulo');

        $dataT = array(




            'entrega' => $estadoEntrega = 1,

            'fecha_entrega' => $fecha,


        );

        $this->model_titulo->updatetitulos($dataT, $id_titulo);

        $script = 'src="https://unpkg.com/sweetalert/dist/sweetalert.min.js">';


        $this->session->set_flashdata('exito', 'Actualizado');

        redirect('accionistas/titulos/entregados', 'refresh');
    }



    public  function guadarNuevoTitulo()

    {

        $NumeroTitulo = $this->input->post('NumeroTitulo');

        $dataT = array(

            'id_titulos ' => $NumeroTitulo,

            'id_accionista' => $prsn_id = $this->input->post('accionistaID'),

            'numero_acciones' => $num_acciones = $this->input->post('NumAC'),

            'fecha' => $fecha_titulo = $this->input->post('fechaT'),

            'estado' => $estado = 1,

            'entrega' => $estadoEntrega = 0,


        );





        $this->model_titulo->nuevo_titulo($dataT);



        redirect('accionistas/inicio');
    }



    public  function cesionTitulo()
    {


        $data['titulos'] = $this->model_titulo->titulosactivos();
        $data['accionista'] = $this->model_accionistas->accionistasALL_Activos();






        $this->load->view('plantilla/Head_v1');

        $this->load->view('titulos/cesion_titulo', $data);

        $this->load->view('plantilla/Footer');
    }


    public function obtenerTitulos()
    {

        // header('Content-Type: application/json');

        $titulos = $this->model_titulo->titulosactivos();
        echo '<option value="">Seleccionar</option>';

        foreach ($titulos as $t) {
            echo '<option value="' . $t->id_titulos . '">' . $t->id_titulos . '  ' . $t->prsn_nombres . ' ' . $t->prsn_apellidopaterno . '</option>';
        }




        // print_r(json_encode($titulos));


    }
    public function obtenerTitulos_transmision()
    {

        // header('Content-Type: application/json');

        $titulos = $this->model_titulo->titulosactivos_transmision();
        echo '<option value="">Seleccionar</option>';

        foreach ($titulos as $t) {
            echo '<option value="' . $t->id_titulos . '">' . $t->id_titulos . '  ' . $t->prsn_nombres . ' ' . $t->prsn_apellidopaterno . '</option>';
        }




        // print_r(json_encode($titulos));


    }


    public function obtenerAccionesTitulo()
    {
        header('Content-Type: application/json');

        $id = $_POST['id'];



        $titulo = $this->model_titulo->AccionesPorTitulo($id);
        $t = $titulo[0];

        print_r(json_encode($t));
    }





    public  function guadarCesionTitulo()
    {





        $id_accionista_que_cede = $this->input->post('IdAccionistaANT');

        $id_accionista_que_recibe = $this->input->post('accionistaID');

        $numero_acciones_titulo_que_cede = $this->input->post('AccionesANT');

        $cantidad_de_acciones_que_se_ceden = $this->input->post('NumNuevoCesion');

        $titulo_que_precede = $this->input->post('tituloAnterior');

        $acciones_nuevo_titulo_anterior = $numero_acciones_titulo_que_cede - $cantidad_de_acciones_que_se_ceden;

        $NumeroTitulo = $this->input->post('NumeroTitulo');


        $ultimoID = $this->model_titulo->ultimoId();
        $ultimo = $ultimoID[0]->maximo;


        if ($acciones_nuevo_titulo_anterior > 0) {

            $dataAntiguoT = array(


                'estado' => $estado = 0,




            );




            $dataT_Nuevo = array(

                'id_titulos ' => $NumeroTitulo,

                'id_accionista' => $id_accionista_que_recibe,

                'numero_acciones' => $cantidad_de_acciones_que_se_ceden,

                'fecha' => $fecha_titulo = $this->input->post('fechaNtitulo'),

                'estado' => $estado = 1,

                'entrega' => $estadoEntrega = 0,

            );


            $dataT_Anterior = array(

                'id_titulos ' => $NumeroTitulo + 1,

                'id_accionista' => $id_accionista_que_cede,

                'numero_acciones' => $acciones_nuevo_titulo_anterior,

                'fecha' => $fecha_titulo = $this->input->post('fechaNtitulo'),

                'estado' => $estado = 1,

                'entrega' => $estadoEntrega = 0,

            );

            $dataTablaTanferencia1 = array(


                'titulo_origen ' => $titulo_que_precede,

                'tiulo_actual' =>  $NumeroTitulo,

                'fecha_cesion' => $fecha_titulo = $this->input->post('fechaTrans'),

            );
            $dataTablaTanferencia2 = array(


                'titulo_origen ' => $titulo_que_precede,

                'tiulo_actual' =>  $NumeroTitulo + 1,

                'fecha_cesion' => $fecha_titulo = $this->input->post('fechaTrans'),

            );



            $this->model_titulo->updatetitulos($dataAntiguoT, $titulo_que_precede);
            $this->model_titulo->nueva_cesion($dataTablaTanferencia1);
            $this->model_titulo->nueva_cesion($dataTablaTanferencia2);
            $this->model_titulo->nuevo_titulo($dataT_Nuevo);
            $this->model_titulo->nuevo_titulo($dataT_Anterior);
        };


        if ($acciones_nuevo_titulo_anterior == 0) {


            $dataAntiguoT = array(


                'estado' => $estado = 0,



            );



            $dataT_Nuevo = array(

                'id_titulos ' => $NumeroTitulo,

                'id_accionista' => $id_accionista_que_recibe,

                'numero_acciones' => $cantidad_de_acciones_que_se_ceden,

                'fecha' => $fecha_titulo = $this->input->post('fechaNtitulo'),

                'estado' => $estado = 1,

                'entrega' => $estadoEntrega = 0,

            );




            $dataTablaTanferencia = array(


                'titulo_origen ' => $titulo_que_precede,

                'tiulo_actual' => $NumeroTitulo,

                'fecha_cesion' => $fecha_titulo = $this->input->post('fechaTrans'),

            );



            $this->model_titulo->updatetitulos($dataAntiguoT, $titulo_que_precede);
            $this->model_titulo->nueva_cesion($dataTablaTanferencia);

            $this->model_titulo->nuevo_titulo($dataT_Nuevo);

            //validar si el accionista tiene itulos activos si no los tiene se da de baja\


            $validar = $this->model_accionistas->validar_estado($id_accionista_que_cede);


            if (empty($validar)) {
                $dataAccionista = array(
                    'estado_accionista' => $estadoaccionista = 0,
                    'fecha_baja' => $fecha = date('Y-m-d'),
                );
                $this->model_accionistas->update($dataAccionista, $id_accionista_que_cede);
            };
        }







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

            'entrega' => $estadoEntrega = 0,






        );



        $this->model_persona->insertar($dataP);

        $this->model_accionistas->insertar($dataA);

        $this->model_titulo->nuevo_titulo($dataT);

        redirect('accionistas/inicio');
    }

    public function embargo()

    {
        $idT = $this->input->post('idT');
        $data["RutA"] = $this->input->post('RutA');

        $data["IdTitulo"] = $idT;
        $data["Titulo"] = $this->model_titulo->infoTituloID($idT);



        $this->load->view('plantilla/Head_v1');

        $this->load->view('titulos/embargo', $data);

        $this->load->view('plantilla/Footer');
    }



    public function guardar_embargo()
    {

        var_dump($this->input->post());

        $OpEmbargo = $this->input->post('Embargos');
        $Numero_Acciones_titulo = $this->input->post('numero_acciones');
        $embargadasOriginal = $this->input->post('acciones_embargadas');
        $TextEmbargadaVista = $this->input->post('cant_embargada');
        $idT = $this->input->post('idT');
        $RutA = $this->input->post('RutA');

        $NuevasEmbargadas = '';



        $archivos = $_FILES["archivos_embargo"];

        $this->Subir_Varios_Embargo($RutA, $archivos);


        if ($OpEmbargo == "SI") {

            $NuevasEmbargadas = $embargadasOriginal + $TextEmbargadaVista;
        }
        if ($OpEmbargo == "NO") {

            $NuevasEmbargadas = $embargadasOriginal - $TextEmbargadaVista;
        }

        if ($NuevasEmbargadas == 0) {
            $dataT = array(

                'embargo' => 0,

                'acciones_embargadas' => $NuevasEmbargadas,

            );
        } else {


            $dataT = array(


                'embargo' => 1,
                'acciones_embargadas' => $NuevasEmbargadas,

            );
        }


        $this->model_titulo->updatetitulos($dataT, $idT);
        $this->session->set_flashdata('embargo', 'Titulo Actualizado');

        redirect('accionistas/titulos');
    }


    public function historial_titulo()
    {

        $idT = $this->input->post('Titulo');

        $historial = $this->model_titulo->historial_titulo($idT);

        if (!empty($historial)) {

            $historial_t = array();
            $i = 0;


            while (!empty($historial)) {


                $i++;

                array_push($historial_t, $historial);
                $historial = $this->model_titulo->historial_titulo($historial[0]['titulo_origen']);
            }


            $data['historial_t'] = $historial_t;
            $data['indice'] = $i;



            $this->load->view('plantilla/Head_v1');

            $this->load->view('titulos/historial_titulo', $data);

            $this->load->view('plantilla/Footer');
        } else {

            $this->session->set_flashdata('Mensaje', 'Sin Historial');

            redirect('accionistas/titulos');
        }
    }


    //private

    private function Subir_Varios_Embargo($user, $archivo)
    {


        $formatos = array('jpg', 'png', 'jpeg', 'gif', 'pdf');

        $fecha = date("Y.m.d_");



        $Dir_archivos = 'archivos/accionista/'; //carpeta donde se guadaran todos los archivos subidos del sistema accionisstas.


        foreach ($archivo['tmp_name'] as $key => $tmp_name) {
            //condicional si el fuchero existe
            if ($archivo["name"][$key]) {
                // Nombres de archivos de temporales


                $archivonombre = $fecha . $archivo["name"][$key];

                $fuente = $archivo["tmp_name"][$key];

                $carpeta = $Dir_archivos . $user . '/Embargo' . '/'; //Declaramos el nombre de la carpeta que guardara los archivos embargados

                if (!file_exists($carpeta)) {

                    mkdir($carpeta, 0777, true) or die("Hubo un error al crear el directorio de almacenamiento");
                }
                var_dump($carpeta);

                //Abrimos el directorio
                $dir = opendir($carpeta);

                $path_archivo = $carpeta . '/' . $archivonombre; //indicamos la ruta de destino de los archivos

                $Tipo_archivo = pathinfo($path_archivo, PATHINFO_EXTENSION);



                if (in_array($Tipo_archivo, $formatos)) {

                    if (move_uploaded_file($fuente, $path_archivo)) {

                        echo "El archivo $archivonombre se han cargado de forma correcta.<br>";
                    } else {

                        echo "Se ha producido un error, por favor revise los archivos e intentelo de nuevo.<br>";
                    }
                } else {

                    echo "Formato del archivo $archivonombre no valido.<br>";
                }

                closedir($dir); //Cerramos la conexion con la carpeta destino


            }
        }
    }
}




