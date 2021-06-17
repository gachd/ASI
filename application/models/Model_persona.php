<?php


    class model_persona extends CI_Model
    {



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
        function insertar($data)
		{

			$this->db->insert('s_personas', $data);
		}

    }


?>
