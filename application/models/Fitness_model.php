<?php


class Fitness_model extends CI_Model
{
    function agregarBeneficiario($DATA)
    {

        return $this->db->insert('socios_fitness', $DATA);
    }
    function actualizarBeneficiario($RUT, $DATA)
    {


        $this->db->where('fitness_prsn_rut', $RUT);
        return $this->db->update('socios_fitness', $DATA);
    }

    function datosBeneficiario($RUT)
    {

        $this->db->select('*');
        $this->db->from('socios_fitness');
        $this->db->where('fitness_prsn_rut', $RUT);
        $p = $this->db->get();

        return $p->result();
    }


    function allBeneficiarios()
    {

        $this->db->select('*');
        $this->db->from('socios_fitness');
        $p = $this->db->get();

        return $p->result();
    }
}
