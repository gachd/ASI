<?php

class model_sa extends CI_Model
{


    function datos_sa()
    {

        $p = $this->db->query('SELECT * FROM sa');

        return $p->result();
    }

    #Diretorio SA

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

    #Junta Ordinaria

    function nueva_juntaordinaria($data)
    {
        $this->db->insert('sa_junta_ordinaria', $data);
       
    }
    function actualizar_juntaordinaria($id,$data)
    {
        $this->db->where('id_junta_ordinaria', $id);
        $this->db->update('sa_junta_ordinaria', $data);
        
    }

    function junta_ordinaria_historico()
    {
        $this->db->select('*');
        $this->db->from('sa_junta_ordinaria');
        $this->db->order_by('fecha_junta_ordinaria', 'ASC');
        $query = $this->db->get();
        return $query->result();
       
    }
    function junta_ordinaria_programadas()
    {
       
        $this->db->select('*');
        $this->db->from('sa_junta_ordinaria');
        $this->db->where('estado_junta_ordinaria',1);
        $this->db->order_by('fecha_junta_ordinaria', 'ASC');
        $query = $this->db->get();
        return $query->result();
       
    }

    



    




}
