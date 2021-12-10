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

    function obtenerDetalleJunta($idJunta)
    {
        $this->db->select('*');
        $this->db->from('sa_junta_detalle');
        $this->db->where('id_junta', $idJunta);
        $this->db->order_by('fecha_detalle', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    function obtenerUltimaJunta($fecha, $motivo, $tipoJunta)
    {
        $this->db->select('*');
        $this->db->from('sa_juntas');
        $this->db->where('fecha_junta', $fecha);
        $this->db->where('asunto_junta', $motivo);
        $this->db->where('tipo_junta', $tipoJunta);
        $this->db->order_by('fecha_junta', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    //correos junta

    function RegitrarCorreoEnviado($dataEnviado)
    {

        $this->db->insert('sa_junta_envio_correo', $dataEnviado);
    }

    function ObtenerCorreo_NoEnviados($id_junta)
    {


        $this->db->select('*');
        $this->db->from('sa_junta_envio_correo');
        $this->db->where('id_junta', $id_junta);
        $this->db->where('correo_enviado', 0);
        $this->db->order_by('fecha_envio', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    function ObtenerCorreo_Enviados($id_junta)
    {


        $this->db->select('*');
        $this->db->from('sa_junta_envio_correo');
        $this->db->where('id_junta', $id_junta);
        $this->db->where('correo_enviado', 1);
        $this->db->order_by('fecha_envio', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
}
