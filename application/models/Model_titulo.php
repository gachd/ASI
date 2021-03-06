<?php


class model_titulo extends CI_Model
{
    function all_titulos()
    {
        $com = $this->db->get('s_titulos');
        return $com->result();
    }

    function infoTituloID($idT)
    {
        $this->db->select('*');
        $this->db->where('id_titulos', $idT);
        $sql = $this->db->get('s_titulos');
        $result = $sql->result();
        return $result[0];
    }


    function nuevo_titulo($data)
    {
        $this->db->insert('s_titulos', $data);
    }

    function titulosactivos()
    {

        $p = $this->db->query('SELECT t.id_titulos, p.prsn_nombres,p.prsn_apellidopaterno , p.prsn_apellidomaterno,p.prsn_rut, a.id_accionista,t.numero_acciones, t.fecha ,t.fecha_entrega,t.embargo,t.acciones_embargadas  FROM s_titulos t, s_personas p, s_accionista a WHERE t.estado = 1 AND p.prsn_rut= a.prsn_rut and t.id_accionista= a.id_accionista GROUP by t.id_titulos ORDER BY t.id_titulos ASC');
        return $p->result();
    }
    function titulosactivos_transmision()
    {


        $this->db->select('id_titulos, p.prsn_nombres,p.prsn_apellidopaterno , p.prsn_apellidomaterno,p.prsn_rut, a.id_accionista,t.numero_acciones, t.fecha ,t.fecha_entrega,t.embargo,t.acciones_embargadas');
        $this->db->from('s_titulos t, s_personas p, s_accionista a');
        $this->db->where('t.estado', 1);
        $this->db->where('transmision = 1');
        $this->db->where('p.prsn_rut = a.prsn_rut');
        $this->db->where('t.id_accionista = a.id_accionista');
        $this->db->group_by('t.id_titulos');
        $this->db->order_by('t.id_titulos', 'ASC');
        $p = $this->db->get();

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

    function updatetitulos($data, $id)
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
        $p = $this->db->query('SELECT t.id_titulos,t.numero_acciones,t.id_accionista,t.embargo, t.acciones_embargadas FROM s_titulos t WHERE t.id_titulos = "' . $id_titulo . '"');
        return $p->result();
    }

    function historial_titulo($id)
    {


        $p = $this->db->query('SELECT * FROM s_titulos t, cesion_titulo c, s_accionista a, s_personas p WHERE c.tiulo_actual ="' . $id . '" AND c.tiulo_actual = t.id_titulos AND a.id_accionista= t.id_accionista AND a.prsn_rut= p.prsn_rut');
        return $p->result_array();
    }
    function titulos_no_entregados()
    {


        $p = $this->db->query('SELECT * FROM s_titulos t, s_accionista a, s_personas p WHERE t.estado = 1 AND t.entrega = 0 AND p.prsn_rut= a.prsn_rut AND t.id_accionista = a.id_accionista GROUP by t.id_titulos');
        return $p->result();
    }

    function nro_titulos_no_entregados()
    {


        $p = $this->db->query('SELECT COUNT(t.id_titulos) no_entregados FROM s_titulos t, s_accionista a, s_personas p WHERE t.estado = 1 AND t.entrega = 0 AND p.prsn_rut= a.prsn_rut AND t.id_accionista = a.id_accionista ');
        return $p->result();
    }

    function IdAccionistaDelTitulo($idTitulo)
    {


        $this->db->select('a.id_accionista');
        $this->db->from('s_titulos t, s_accionista a');
        $this->db->where('t.id_titulos', $idTitulo);
        $this->db->where('t.id_accionista = a.id_accionista');

        $p = $this->db->get();

        return $p->result();
    }


    function titulos_con_tranferencia_recibida($id_titulo)
    {


        $this->db->select('*');
        $this->db->from('s_titulos as t, cesion_titulo as c');
        $this->db->where('c.tiulo_actual = t.id_titulos');
        $this->db->where('t.id_titulos', $id_titulo);

        $p = $this->db->get();

        return $p->result_array();
    }
    function titulos_con_tranferencia_realizada($id_titulo)
    {


        $this->db->select('*');
        $this->db->from('s_titulos as t, cesion_titulo as c');
        $this->db->where('c.titulo_origen = t.id_titulos');
        $this->db->where('t.id_titulos', $id_titulo);

        $p = $this->db->get();

        return $p->result_array();
    }

    function DatosAccionistaDelTitulo($id_titulo)
    {

        $this->db->select('*');
        $this->db->from('s_accionista AS a,s_titulos AS t,s_personas AS p');
        $this->db->where('t.id_accionista = a.id_accionista');
        $this->db->where('t.id_titulos', $id_titulo);
        $this->db->where('a.prsn_rut = p.prsn_rut');
        $p = $this->db->get();
        return $p->result_array();
    }
}
