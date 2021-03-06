<?php


class Fitness_model extends CI_Model
{
    function editaPersona($RUT, $DATA)
    {
        $this->db->where('prsn_rut ', $RUT);
        return $this->db->update('s_personas', $DATA);
    }
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

        $p = $p->result();

        return $p[0];
    }


    function allBeneficiarios()
    {

        $this->db->select('*');
        $this->db->from('socios_fitness');
        $p = $this->db->get();

        return $p->result();
    }

    function existeEnFitness($rut)
    {
        $this->db->select('fitness_prsn_rut');
        $this->db->from('socios_fitness');
        $this->db->where('fitness_prsn_rut', $rut);
        $p = $this->db->get();
        $resultado = $p->result();

        if (!empty($resultado)) {

            return true;
        } else {

            return false;
        };
    }
}
