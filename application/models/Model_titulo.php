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

    function titulosactivos()
    {

        $p = $this->db->query('SELECT t.id_titulos, p.prsn_nombres,p.prsn_apellidopaterno , p.prsn_apellidomaterno FROM s_titulos t, s_personas p, s_accionista a WHERE t.estado = 1 AND p.prsn_rut= a.prsn_rut and t.id_accionista= a.id_accionista GROUP by t.id_titulos ORDER BY t.id_titulos ASC');
        return $p->result();
    }


    function acciones_de_titulo($id)
    {

        $p = $this->db->query('SELECT * FROM s_titulos WHERE estado = 1 AND id_titulos = "' . $id . '"');
        return $p->result();
    }

    function ultimoId()
    {


        $p = $this->db->query('SELECT MAX(id_titulos) as maximo FROM s_titulos');
        return $p->result();
    }

    function updatetitulos($data,$id)
    {
        $this->db->where('id_titulos ', $id);
        $this->db->update('s_titulos', $data);

    }

    function nueva_cesion($data)
    {
        $this->db->insert('cesion_titulo', $data);
    }


    function infoTitulo()
    {


        $p = $this->db->query('SELECT t.id_titulos,t.fecha,t.estado,p.prsn_rut,t.numero_acciones ,p.prsn_nombres,p.prsn_apellidopaterno, p.prsn_apellidomaterno FROM s_titulos t, s_accionista a, s_personas p WHERE a.id_accionista= t.id_accionista AND p.prsn_rut = a.prsn_rut');
        return $p->result();
    }


    function AccionesPorTitulo($id_titulo)
    {
        $p = $this->db->query('SELECT t.id_titulos,t.numero_acciones,t.id_accionista FROM s_titulos t WHERE t.id_titulos = "' . $id_titulo . '"');
        return $p->result();



    }




}