<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Externos_model extends CI_Model 
{
    public function externos_original()
    {

        $this->db->select("*");
        $this->db->from("a_externo");
        $query = $this->db->get();
        return $query->result();

    }               
    
    public function externos_nuevos($Datos)
    {
        return $this->db->insert('a_externo_1', $Datos);

    }

                        
}


/* End of file Externos_model.php and path /application/models/Externos_model.php */

