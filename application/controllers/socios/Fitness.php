<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Fitness extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();

        $this->load->library('session');

        $this->load->helper('url');

        $this->load->helper('form');

        $this->load->library('form_validation');

        $this->load->library('mpdf60/Mpdf');

        $this->load->model('model_socios');

        $this->load->model('model_accionistas');

        $this->load->model('fitness_model');
    }


    public function index()
    {
        $result = [];
        $cargas = [];
        $socios = $this->model_socios->Info_All_Socios_Actios();

        for ($i = 0; $i < count($socios); $i++) {

            $result = $this->model_socios->cargas_del_socio($socios[$i]->prsn_rut);

            if (!empty($result)) {

                for ($j = 0; $j < count($result); $j++) {

                    array_push($cargas, $result[$j]);
                }
            }
        }

        for ($i = 0; $i < count($cargas); $i++) {
            array_push($socios, $cargas[$i]);
        }









        $data["socios"] = $socios;




        $this->load->view('plantilla/Head_v1');

        $this->load->view('socios/fitness/Index', $data);

        $this->load->view('plantilla/Footer');
    }

    public function buscarSocio()
    {

        $rut = $this->input->post('rut');
        $accion = $this->input->post('accion');


        $data['rut'] = $rut;
        $data['comuna'] = $this->model_socios->all_comunas();
        $data['datos_personales'] = $this->model_socios->persona_fitness($rut);
        $data['fitness'] = $this->fitness_model->datosBeneficiario($rut);


        if ($accion == "Ver") {

            $html = $this->load->view('socios/fitness/ver_ficha', $data, true);
        }
        if ($accion == "Editar") {

            $html = $this->load->view('socios/fitness/editar_beneficiario', $data, true);
        }


        echo $html;
    }



    public function agregarDatos()
    {
  
        //Datos Personales
        $rut = $this->input->post("rut_beneficiario");
        $nacimiento = $this->input->post("txt_fecha");
        $celular = $this->input->post("celular");
        $email = $this->input->post("email");
        $direccion = $this->input->post("direccion");
        $sector = $this->input->post("sector");
        $comuna = $this->input->post("comuna");




        //Datos Fitness

        $estatura = $this->input->post("estatura");
        $peso = $this->input->post("peso");
        $imc = $this->input->post("IMC");

        $fono_emergencia = $this->input->post("emergencia");
        $patologias_base = $this->input->post("patologias");

        $pc_bicipital = $this->input->post("pc_bicipital");
        $pc_tricipital = $this->input->post("pc_tricipital");
        $pc_subescapular = $this->input->post("pc_subescapular");
        $pc_suprailiaco = $this->input->post("pc_suprailiaco");
        $pc_muslo = $this->input->post("pc_muslo");
        $pc_abdominal = $this->input->post("pc_abdominal");
        $pc_pecho = $this->input->post("pc_pecho");
        $pc_axilar = $this->input->post("pc_axilar");
        $pc_pierna = $this->input->post("pc_pierna");
        $objetivos = $this->input->post("objetivos");

        $path = 'archivos/fitness/'. $rut;


        //subir foto de perfil

        if (isset($_FILES['img_perfil'])) {

            echo 'existe imagen';

            if (!empty($_FILES['img_perfil']['name'])) {

                $this->Subir_foto_fitness($rut, $_FILES['img_perfil']);
            }
        }

        //subir archivos
        if (isset($_FILES['arch_socio'])) {

            $this->Subir_Archivos_Fitness($rut, $_FILES['arch_socio']);
        }








        $dataPersonal = array(

            'prsn_fechanacimi' => $nacimiento,
            'prsn_fono_movil' => $celular,
            'prsn_email' => $email,
            'prsn_direccion' => $direccion,
            'prsn_sectorvive' => $sector,
            's_comunas_comuna_id' => $comuna

        );


        $dataFitness = array(

            'fitness_prsn_rut' => $rut,
            'estatura'  => $estatura,
            'peso'  => $peso,
            'imc'  => $imc,
            'fono_emergencia'  => $fono_emergencia,
            'patologias_base'  => $patologias_base,
            'pc_bicipital'  => $pc_bicipital,
            'pc_tricipital'  => $pc_tricipital,
            'pc_subescapular'  => $pc_subescapular,
            'pc_suprailiaco'  => $pc_suprailiaco,
            'pc_muslo'  => $pc_muslo,
            'pc_abdominal'  => $pc_abdominal,
            'pc_pecho'  => $pc_pecho,
            'pc_axilar'  => $pc_axilar,
            'pc_pierna'  => $pc_pierna,
            'objetivos'  => $objetivos,
            'path'  => $path
        );








        $existe = $this->fitness_model->existeEnFitness($rut);

        if ($existe) {


            unset($dataFitness['fitness_prsn_rut']);

            $validarF = $this->fitness_model->actualizarBeneficiario($rut, $dataFitness);
        } else {


            $validarF = $this->fitness_model->agregarBeneficiario($dataFitness);
        }

        $validarP = $this->fitness_model->editaPersona($rut, $dataPersonal);

        var_dump($validarP);
        var_dump($$validarF);
    }





    //private

    private function Subir_foto_fitness($rut, $archivo)
    {

        $fecha = date("Y.m.d_");

        $formatos = array('jpg', 'png', 'jpeg', 'gif');

        $Dir_archivos = 'archivos/fitness/' . $rut . '/perfil/';

        $archivonombre =  $fecha . $archivo["name"];

        $fuente = $archivo["tmp_name"];

        if (!file_exists($Dir_archivos)) {

            mkdir($Dir_archivos, 0777, true) or die("Hubo un error al crear el directorio de almacenamiento");
        }


        $dir = opendir($Dir_archivos);

        $path_archivo = $Dir_archivos . $archivonombre; //indicamos la ruta de destino de los archivos

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




    private function Subir_Archivos_Fitness($rut, $archivo)
    {


        $formatos = array('jpg', 'png', 'jpeg', 'pdf');

        $fecha = date("Y.m.d_");



        $Dir_archivos = 'archivos/fitness/'; //carpeta donde se guadaran todos los archivos subidos del sistema.


        foreach ($archivo['tmp_name'] as $key => $tmp_name) {
            //condicional si el fichero existe
            if ($archivo["name"][$key]) {
                // Nombres de archivos de temporales


                $archivonombre = $fecha . $archivo["name"][$key];

                $fuente = $archivo["tmp_name"][$key];

                $carpeta = $Dir_archivos . $rut . '/docs/'; //Declaramos el nombre de la carpeta que guardara los archivos

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
