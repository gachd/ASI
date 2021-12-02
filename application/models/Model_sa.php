<?php

class model_sa extends CI_Model
{


    function datos_sa()
    {

        $p = $this->db->query('SELECT * FROM sa');

        return $p->result();
    }

    function directorios_sa_historico()
    {
        $this->db->select('*');
        $this->db->from('sa_directorio');
        $this->db->order_by('fecha_directorio', 'ASC');
        $query = $this->db->get();
        return $query->result();
       
    }

    function directorio_sa_actual()
    {
        $this->db->select('*');
        $this->db->from('sa_directorio');
        $this->db->where('estado_directorio',1);
        $this->db->order_by('fecha_directorio', 'ASC');

        $query = $this->db->get();
        return $query->result();
       
    }

    function insertar_directorio($data)
    {
        $this->db->insert('sa_directorio', $data);
      

    }

    function baja_directorio($id)
    {
        $this->db->where('id_directorio', $id);
        $this->db->update('sa_directorio', array('estado_directorio' => 0));    
        
    }

    function actualizar_directorio($id,$data)
    {
        $this->db->where('id_directorio', $id);
        $this->db->update('sa_directorio', $data);
        
    }
    




}
