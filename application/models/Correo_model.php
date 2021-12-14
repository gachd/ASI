<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Correo_model extends CI_Model 
{
                      
    function RegistrarCorreo($dataEnviado)
    {

        $this->db->insert('correo', $dataEnviado);
    }

    function RegistrarAperturaCorreo($hash,$dataUpdate)
    {

        $this->db->where('hash_correo', $hash);
        $this->db->update('correo', $dataUpdate);


       
    }
}



