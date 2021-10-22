<?php
class TestCarga extends CI_Controller
{


        function __construct()
        {

                parent::__construct();

                $this->load->library('session');
                $this->load->helper(array('form', 'url'));
        }




        public function index()
        {
                $this->load->view('plantilla/Head');

                $this->load->view('socios/testcarga', array(
                        'error' => '',
                        'subido' => ''
                ));

                $this->load->view('plantilla/Footer');
        }


        public function cargar()
        {
                $nombre = $this->input->post('nombre');
                $fecha = date('d-m-Y_H-i-s');
                $path = './uploads/accionistas/'.$nombre;

                if (!file_exists($path)) {
                        mkdir($path, 0777, true);
                    }



                $config['upload_path'] =  $path;
                $config['allowed_types'] = 'pdf';
                $config['file_name'] = $nombre."_".$fecha;
                $config['max_size'] = "50000";
                $config['max_width'] = "2000";
                $config['max_height'] = "2000";

              

                $this->load->library('upload', $config);
                $this->upload->initialize($config);            
    
                if ($this->upload->do_upload('userfile')) {                        
        
                    $this->upload->data();    
                }                        
                       
                        
                      
                        
                       
        }
}
