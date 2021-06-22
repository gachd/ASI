<?php


class model_titulo extends CI_Model
{
    function all_titulos()
    {
        $com = $this->db->get('s_titulos');
        return $com->result();
    }

    function nuevo_titulo($data)
    {
        $this->db->insert('s_titulos', $data);
    }

}
