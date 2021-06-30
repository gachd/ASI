<?php


class model_libro extends CI_Model
{
    function all_libros()
    {
        $com = $this->db->get('s_libro');
        return $com->result();
    }

    
}
