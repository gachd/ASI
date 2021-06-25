<?php


class model_persona extends CI_Model
{


    function existe_persona($rut)
    {

        $this->db->where('prsn_rut', $rut);
        $consulta =  $this->db->get('s_personas');
        $resultado = $consulta->row();
        return $resultado;
    }



    function all_comunas()
    {
        $com = $this->db->get('s_comunas');
        return $com->result();
    }

    function all_condicionlab()
    {
        $condlab = $this->db->get('s_condicion_laboral');
        return $condlab->result();
    }


    function all_estadocivil()
    {
        $estadocivil = $this->db->get('s_estado_civil');
        return $estadocivil->result();
    }

    function all_provincias()
    {
        $provincia = $this->db->get('s_provincia');
        return $provincia->result();
    }
    function all_region()

    {
        $region = $this->db->get('s_regiones');
        return $region->result();
    }


    function update($data,$id)
    {

    
        $this->db->where('prsn_id', $id);
        $this->db->update('s_personas', $data);
    }

    function insertar($data)
    {

        $this->db->insert('s_personas', $data);
    }

    function ultimoId()
    {

        $this->db->select_max('prsn_id');

        $this->db->from('s_personas');

        $query2 = $this->db->get();

        // $num_rows = $query2->num_rows();

        $res2 = $query2->result_array();

        $result = $res2[0]['prsn_id'];

        return $result;
    }


    function ListarRegionDeProvincia($id)
    {

        $p = $this ->db->query('SELECT * FROM s_provincia WHERE s_regiones_region_id = "'.$id.'" ');
        return $p -> result();        
      
    }

    
    function ListarProvinciaDecomuna($id)
    {

        $p = $this ->db->query('SELECT * FROM s_comunas WHERE s_provincia_provincia_id = "'.$id.'" ');
        return $p -> result();        
      
    }




}
