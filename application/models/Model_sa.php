<?php

class model_sa extends CI_Model
{





    function datos_sa()
    {

        $p = $this->db->query('SELECT * FROM sa');

        return $p->result();
    }


}
