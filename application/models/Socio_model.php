<?php
class Socio_model extends CI_Model{
    function __construct()
    {
       //$this->load->database();
    }

    function guardarSocio($data){
        $this->db->insert("a_agenda",$data);

        if($this->db->affected_rows() > 0 ){
            return true;
        }else{
            return false;
        }
    }

    function updateSocio($datos,$rut){
        //Se hace el where para actualizar el registro que se desea
        $this->db->where('rut', $rut);
        //Se hace el update a la tabla con los datos enviados
        $update=$this->db->update('a_agenda', $datos);
        return $update;
        //echo $update;
    }

    function socioexiste($rut){
        
        $this->db->select('*');
        $this->db->from('s_personas p, s_socios s');
        $this->db->where('p.prsn_rut = s.prsn_rut');
        
        $this->db->where('s.prsn_rut',$rut);
        $this->db->where('p.ingreso=1');
        $this->db->group_by("s.prsn_rut");

        $consulta = $this->db->get();
        return $resultado = $consulta->result_array();
    
    }
    function socioexiste2($rut){
        
        $this->db->select('*');
        $this->db->from('s_personas p, s_socios s');
        $this->db->where('p.prsn_rut = s.prsn_rut');
        
        $this->db->where('s.prsn_rut',$rut);
        $this->db->where('p.ingreso=1');
        $this->db->group_by("s.prsn_rut");

        $consulta = $this->db->get();
        //return $resultado = $consulta->result_array();
        if(!empty ($consulta)){
            return true;
        }else{
            return false;
        }
    
    }
    function socioexiste3($rut){
        //var_dump($rut);

            $this->db->select('*');
            $this->db->from('s_personas p, s_socios s');
            $this->db->where('p.prsn_rut = s.prsn_rut');

        
            $this->db->where('s.prsn_rut',$rut);
            $this->db->where('p.ingreso=1');
            $this->db->group_by("s.prsn_rut");
            
            $consulta = $this->db->get();//hace la consulta
            $consulta=$consulta->result_array();//devuelve lo consultado
            return $consulta;

        }

    function cargaexiste($rut){

        //select * from s_personas p JOIN s_socios s JOIN s_cargas_socios c on p.prsn_rut = s.prsn_rut and p.prsn_rut = c.s_socios_prsn_rut and s.prsn_rut = "8100116-2" and p.ingreso=1 GROUP by s.prsn_rut
        

        $this->db->select('*');
        $this->db->from('s_personas p ,s_cargas_socios c');
        
        $this->db->where('p.prsn_rut = c.s_personas_prsn_rut');
        
        $this->db->where('c.s_personas_prsn_rut',$rut);
  
        $this->db->group_by("c.s_personas_prsn_rut");

        $consulta = $this->db->get();
        return $resultado = $consulta->result_array();
    
    }

    function a_socioExiste($rut){
  
        $this->db->select('*');
        $this->db->from('a_agenda');
        $this->db->where('rut',$rut);

        $consulta = $this->db->get();
        $resultado = $consulta->result_array();
        if(!empty ($resultado)){
            //echo "rut existe en agenda";
            return true;
        }else{
            //echo "rut no existe en agenda";
            return false;
        }
        //return $resultado = $consulta->result_array();
    
    }
    function cargarFecha(){
  
        //toma la hora de santiago de chile
        date_default_timezone_set('America/Santiago');
        //$fecha ="21-08-26";
        $fechaactual = date("Y-m-d");
        //echo $fechaactual;
        $this->db->select('*');
        $this->db->from('a_jornada_1');
        $this->db->where('inicio > ',$fechaactual);
       
        $consulta = $this->db->get();
        return $consulta->result();
    
    }

    function cargarSector(){
  
        $this->db->select('*');
        $this->db->from('a_sector');
        $this->db->where_not_in('id_sector','7');//no carga el poligo e ni casino
        $this->db->where_not_in('id_sector','8');
       
        $consulta = $this->db->get();
        return $consulta->result();
    
    }
    function cargarfechaxsector($sector){

         //toma la hora de santiago de chile
         date_default_timezone_set('America/Santiago');
         //$fecha ="21-08-26";
         $fechaactual = date("Y-m-d");
         $horaactual= date("H");
         if($horaactual>"17"){
            $fechaactual = date("Y-m-d",strtotime($fechaactual."+ 1 days")); 
            
        }
        $this->db->select ('*');
        $this->db->from('a_bloque b, a_jornada_1 j');
        
        $this->db->where('b.id_jornada = j.id_jornada');
        $this->db->where('b.id_sector',$sector);

        $this->db->where('inicio > ',$fechaactual);

        $this->db->group_by('j.inicio');
       
        $consulta = $this->db->get();
        return $consulta->result_array();
    
    }

    function cargarhora($valor_fecha,$valor_sector){
  
        $this->db->select('*');
        $this->db->from('a_bloque');
        $this->db->where('id_jornada',$valor_fecha);
        $this->db->where('id_sector',$valor_sector);
       
        $consulta = $this->db->get();
        return $consulta->result_array();
    
    }
    function cargarcantidad($valor_sector,$valor_fecha,$valor_hora){
  
        $this->db->select('*');
        $this->db->from('a_bloque');
        $this->db->where('id_jornada',$valor_fecha);
        $this->db->where('id_sector',$valor_sector);
        $this->db->where('id_bloque',$valor_hora);
       
        $consulta = $this->db->get();
        return $consulta->result_array();
    
    }
    function sociosall(){
        
        $this->db->select('*');
        $this->db->from('s_personas p, s_socios s');
        $this->db->where('p.prsn_rut = s.prsn_rut');
        
        //$this->db->where('s.prsn_rut',$rut);
        $this->db->where('p.ingreso=1');
        $this->db->group_by("s.prsn_rut");

        $consulta = $this->db->get();
        return $resultado = $consulta->result_array();
    
    }
    function cargasall(){

        //select * from s_personas p JOIN s_socios s JOIN s_cargas_socios c on p.prsn_rut = s.prsn_rut and p.prsn_rut = c.s_socios_prsn_rut and s.prsn_rut = "8100116-2" and p.ingreso=1 GROUP by s.prsn_rut
        
        $this->db->select('*');
        $this->db->from('s_personas p ,s_cargas_socios c');
        
        $this->db->where('p.prsn_rut = c.s_personas_prsn_rut');
        //$this->db->where('c.s_personas_prsn_rut',$rut);
  
        $this->db->group_by("c.s_personas_prsn_rut");

        $consulta = $this->db->get();
        return $resultado = $consulta->result_array();
    
    }
    function modificar_capactual($idbloque,$cantidadActual){
        $dato = array(
            
            "cap_actual" =>$cantidadActual+1,
            
        );

        $this->db->where('id_bloque', $idbloque);

        $update=$this->db->update('a_bloque', $dato);
        return $update;
    
    }
    function modificar_capactualdinamico($idbloque,$cantidadActual,$largoarray){
        $dato = array(
            
            "cap_actual" =>$cantidadActual+$largoarray+1,
            
        );

        $this->db->where('id_bloque', $idbloque);

        $update=$this->db->update('a_bloque', $dato);
        return $update;
    
    }
    function guardarvisista1($datos){

        $this->db->insert("a_visita_1",$datos);

        if($this->db->affected_rows() > 0 ){
            return true;
        }else{
            return false;
        }
    
    }
    function validarVisita($idbloque, $rut){
  
        $this->db->select('*');
        $this->db->from('a_visita_1');
        $this->db->where('id_bloque',$idbloque);
        $this->db->where('rut_agenda',$rut);
       
        $consulta = $this->db->get();
        return $consulta->result_array();
    
    }
    function guardarAcompañantes($compa,$nombres,$apellido1,$apellido2){
        $dato = array(           
            "rut_acompanante" =>$compa,
            "nombres" =>$nombres,
            "paterno" =>$apellido1,
            "materno" =>$apellido2,
            "parentesco" =>"opcion",
            "telefono" =>0,         
        );
        $this->db->insert("a_acompanante",$dato);

        if($this->db->affected_rows() > 0 ){
            return true;
        }else{
            return false;
        }
    
    }
    function ultimoIda_visita($rut){
        
        $this->db->select('MAX(id_visita) as id_visita');
        $this->db->from('a_visita_1');
        $this->db->where('rut_agenda',$rut);

        $consulta = $this->db->get();
        return $resultado = $consulta->result_array();
    
    }
    function ultimoIda_acompañantes($rut){
        
        $this->db->select('MAX(id_acompanante) AS id_acompanante');
        $this->db->from('a_acompanante');
        $this->db->where('rut_acompanante',$rut);

        $consulta = $this->db->get();
        return $resultado = $consulta->result_array();
    
    }
    function Guardardetallevisita($id_visita,$ultimoIdacompanante){
        $datos = array(
            "id_acompanante" => $ultimoIdacompanante,
            "id_visita" => $id_visita,
        );
        $this->db->insert("a_detalle_visita",$datos);

        if($this->db->affected_rows() > 0 ){
            return true;
        }else{
            return false;
        }
    }
    function DatosVisitacorreo($idbloque,$rut){
        $query = $this->db->query('SELECT j.inicio ,b.hora_inicio,b.cap_actual,b.cap_maxima,s.nombre_sector, ag.rut,ag.nombres,ag.paterno,ag.materno,av.id_visita,av.invitados,av.id_bloque,ag.correo
        from a_jornada_1 j join a_bloque b on j.id_jornada = b.id_jornada 
        JOIN a_sector s on b.id_sector = s.id_sector 
        JOIN a_agenda ag join a_visita_1 av on ag.rut=av.rut_agenda and b.id_bloque = av.id_bloque
        where ag.rut = "' .$rut .'" and av.id_bloque = "' .$idbloque. '" ');

        return $query->result_array();

    }
    function DatosVisitaacompanantes($id){
        $query = $this->db->query('SELECT Acom.rut_acompanante , Acom.nombres,Acom.paterno,Acom.materno
        FROM a_acompanante as Acom , a_visita_1 as  Visi, a_detalle_visita as DeVi 
        WHERE Visi.id_visita = "' .$id. '" 
        and DeVi.id_visita = Visi.id_visita
        AND DeVi.id_acompanante = Acom.id_acompanante');

        return $query->result_array();

    }
//SQL PARA INFORME ASI
    function date_agenda( $fecha1 )

		{

			//$query = $this->db->query('SELECT * FROM a_socios s, a_visita v, a_jornada j WHERE s.rut_socio = v.a_socios_rut_socio AND v.a_jornada_ida_jornada = j.id_jornada AND j.inicio = "' . $fecha1 . '"');
            $query = $this->db->query('SELECT j.inicio ,b.hora_inicio,b.cap_actual,b.cap_maxima,s.nombre_sector, ag.rut,ag.nombres,ag.paterno,ag.materno,av.id_visita,av.invitados from a_jornada_1 j join a_bloque b on j.id_jornada = b.id_jornada JOIN a_sector s on b.id_sector = s.id_sector JOIN a_agenda ag join a_visita_1 av on ag.rut=av.rut_agenda and b.id_bloque = av.id_bloque where j.inicio="' .$fecha1. '"');

			return $query->result();

		}
        function date_agenda_externo($fecha1)

		{

			//$query = $this->db->query('SELECT * FROM a_externo e, a_visita_externa v, a_bloque b WHERE e.rut_externo = v.rut_externo AND v.id_jornada = b.id_jornada AND b.inicio = "' . $fecha1 . '"');
            $query = $this->db->query('
            SELECT aex.rut_externo,aex.nombres,aex.paterno,aex.materno,s.nombre_sector,b.hora_inicio
            from a_jornada_1 j join a_bloque b 
            on j.id_jornada = b.id_jornada JOIN a_sector s on b.id_sector = s.id_sector 
            JOIN a_visita_externa ave on b.id_bloque = ave.id_bloque join a_externo_1 aex on ave.rut_externo = aex.rut_externo
            where s.id_sector = 7 and j.inicio= "' . $fecha1 . '" ');

			return $query->result();

		}



		function cargas_visita($visita)

		{

			//$query = $this->db->query('SELECT * FROM a_detalle_visita ad, a_acompanante ac WHERE ad.id_visita = "' . $visita .'" ');

            $query= $this->db->query('SELECT Acom.rut_acompanante , Acom.nombres,Acom.paterno,Acom.materno
            FROM a_acompanante as Acom , a_visita as  Visi, a_detalle_visita as DeVi 
            WHERE Visi.id_visita = "' . $visita . '"
            AND DeVi.id_visita = Visi.id_visita
            AND DeVi.id_acompanante = Acom.id_acompanante');

			return $query->result();

		}
    
}

?>