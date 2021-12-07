<?php

class model_sa extends CI_Model
{


    function datos_sa()
    {

        $p = $this->db->query('SELECT * FROM sa');

        return $p->result();
    }

    #Directorio SA

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
        $this->db->where('estado_directorio', 1);
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

    function actualizar_directorio($id, $data)
    {
        $this->db->where('id_directorio', $id);
        $this->db->update('sa_directorio', $data);
    }


    #############################
    #Juntas SA
    ##############################
    function nueva_junta($DataJunta)
    {

        $this->db->insert('sa_juntas', $DataJunta);

    }

    function alljunta($tipos)
    {
        $this->db->select('*');
        $this->db->from('sa_juntas');
        $this->db->where('tipo_junta', $tipos);
        $this->db->order_by('fecha_junta', 'ASC');
      
        $query = $this->db->get();
        return $query->result();
    }

    function ingresoDetalleJunta($DataDetalleJunta)
    {
        $this->db->insert('sa_junta_detalle', $DataDetalleJunta);
    }

    function obtenerDetallerJunta($idJunta)
    {
        $this->db->select('*');
        $this->db->from('sa_junta_detalle');
        $this->db->where('id_junta', $idJunta);
        $this->db->order_by('fecha_detalle', 'ASC');
        $query = $this->db->get();
        return $query->result();
        
    }

    function resgitrarCorreoEnviado($dataEnviado)

    {

        $this->db->insert('sa_junta_envio_correo', $dataEnviado);

    }
   



    

}
