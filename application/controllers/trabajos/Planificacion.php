<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class planificacion extends CI_Controller {

	function __construct() {
		 
        parent::__construct();
		$this->load->library('session');
		$this->load->model('model_trabajos');
		$this->load->model('model_turnos');
        $this->load->model('model_actividades');
	    $this->load->helper('url');
	    $this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
	}
	
	
	public function index(){
		$data['depend'] = $this -> model_trabajos->getDepen();	
		$data['sectores'] = $this -> model_trabajos->getSector();
		$data['categorias'] = $this -> model_trabajos->getCategorias();	
		$data['funcionarios_stadio'] = $this -> model_trabajos->funcionarios_stadio();	
		
		$this->load->view('plantilla/Head');
		$this->load->view('trabajos/planificacion',$data);
		$this->load->view('plantilla/Footer');		
	}	

	public function carga(){
        $mes  = $this->input->post('mes');
        $year  = $this->input->post('year');
        $hoy=date("Y-m-d H:i:s");
        $allsubcategorias=$this->model_trabajos->getSubcate();

        //numero de días del mes selccionado
        $numero = cal_days_in_month(CAL_GREGORIAN, $mes, $year);
        $colspan=$numero+1;
         echo' <table id="highlight-table"  class="table-bordered table-striped tbl_pan">
            <thead>
            <tr>
              <th class="cab_mes">mes'.$mes.'</th>';
        //imprimos cabecera con los días
               setlocale(LC_ALL, 'es_ES').': ';
            for($i = 1; $i <= $numero; $i++) {
                $fecha=$year.'-'.$mes.'-'.$i;
                echo'<th class="fecha">'.iconv('ISO-8859-1', 'UTF-8', strftime('%a',  strtotime("".$fecha.""))).'<br>'.iconv('ISO-8859-1', 'UTF-8', strftime('%d',  strtotime("".$fecha.""))).'</th>';
            }

            echo'
            </tr>
            <tr>
            <td>Personal</td>';
            for($i = 1; $i <= $numero; $i++) {
                $fecha=$year.'-'.$mes.'-'.$i;
                $total_funcionarios=$this->model_trabajos->total_funcionarios($fecha);
                foreach ($total_funcionarios as $tf) {
                    echo "<td>".$tf -> total ."</td>";
                }

            }

            echo'</tr>';
            echo'
            <tr>
            <td>Guardias</td>';
            for($i = 1; $i <= $numero; $i++) {
                $fecha=$year.'-'.$mes.'-'.$i;
                $total_funcionarios=$this->model_trabajos->total_guardias($fecha);
                foreach ($total_funcionarios as $tf) {
                    echo "<td>".$tf -> total ."</td>";
                }

            }
            

            echo'</tr>';
            echo'<tr>
                 <td>Nº Personas</td>';
                  for($i = 1; $i <= $numero; $i++) {
                $fecha=$year.'-'.$mes.'-'.$i;
                $total_prsns_dia=$this->model_actividades->total_prsns_dia($fecha);
                foreach ($total_prsns_dia as $ad) {
                    echo "<td>".$ad -> total ."</td>";
                }

            }




            echo'</tr></thead></table>';



        echo' <div class="scroll">
        <table id="highlight-table"  class="table-bordered table-striped tbl_pan">
            <thead  style="    visibility: collapse;">
            <tr>
              <th  class="cab_mes">mes'.$mes.'</th>';
        //imprimos cabecera con los días
               setlocale(LC_ALL, 'es_ES').': ';
            for($i = 1; $i <= $numero; $i++) {
                $fecha=$year.'-'.$mes.'-'.$i;
                echo'<th class="fecha">'.iconv('ISO-8859-1', 'UTF-8', strftime('%a',  strtotime("".$fecha.""))).'<br>'.iconv('ISO-8859-1', 'UTF-8', strftime('%d',  strtotime("".$fecha.""))).'</th>';
            }
            echo'</thead>
            <tbody>';
               ///TURNOS funcionarios              
            $funcionarios_stadio=$this->model_turnos->getFun_stadio_guardia();
            $personal=0;
            $guardias=0;
            foreach ($funcionarios_stadio as $fs) {
                if ($fs->tipo == 2 AND $personal == 0){
                    echo '<tr><td colspan="'.$colspan.'" class="cabecera">Personal Stadio<td></tr>';
                     $personal ++;
                 }
                 if ($fs->tipo == 4 AND $guardias == 0){
                    echo '<tr><td colspan="'.$colspan.'" class="cabecera">guardias<td></tr>';
                     $guardias ++;
                 }
                 $rut_fun = $fs->rut;
                 echo "<tr><td>".$fs -> paterno."</td>";
                 for($i = 1; $i <= $numero; $i++) {
                    $fechat="".$year."-".$mes."-".$i."";
                    $turno_fun=$this->model_turnos->turno_dia_funcionario($rut_fun,$fechat);
                    echo "<td>";
                    foreach ($turno_fun as $tf) {
                        $sigla=$tf-> t_id;
                        if($sigla == 4 || $sigla==13){
                            echo '<span style="color:#FF5722;text-transform: uppercase;">D</span>';
                        }
                         else{
                            if($sigla == 5){
                                echo '<span style="color:#2196F3;text-transform: uppercase;">C</span>';

                            }else{

                                 if($sigla == 14 || $sigla == 15){ echo '<span style="color:#2196F3;text-transform: uppercase;">L</span>';}else{echo "x";}
                                



                                
                            }
                            
                        }
                        //echo $tf-> sigla;
                    }
                    echo "</td>";
                }
                echo"</tr>";
            }

            //ACTIVIDADES
            $actividades=$this->model_actividades->actv_mes($mes,$year);
            echo '<tr><td colspan="'.$colspan.'" class="cabecera">actividades<td></tr>';
            $titulo="";
            $count=0;
            foreach ($actividades as $a) {
                $categoria= $a -> ctg_nombre;
                $sub_categoria= $a -> sctg_nombre;
                $act_sctg_id= $a -> act_sctg_id;
                if($titulo <> $categoria){
                    echo'<tr>
                    <td colspan="'.$colspan.'" class="subcabecera">'.$categoria.'<td></tr>';
                    $titulo = $categoria;
                }
                echo'<tr><td>'.$a -> sctg_nombre .'</td>';
                for($i = 1; $i <= $numero; $i++) {
                    $fecha_actv="".$year."-".$mes."-".$i."";
                    $num_personas=$this->model_actividades->num_personas_actv($fecha_actv,$act_sctg_id);
                    foreach ($num_personas as $np) {
                        echo "<td>".$np->total."</td>";
                    }
                }
                echo "</tr>";
            }

            //trabajos
            echo'<tr><td colspan="'.$colspan.'" class="cabecera">trabajos<td></tr>';
           foreach ($allsubcategorias as $sub) {
                $id_sub=$sub -> sctg_id;
                $trabajos_sub_mes=$this->model_trabajos->trabajos_mes_subcategoria($mes,$year,$id_sub);
                if(!empty($trabajos_sub_mes)){
                    $id_subcategoria=$sub-> sctg_id;
                    echo '<tr><td  colspan="'.$colspan.'" class="subcabecera">'.$sub -> sctg_nombre.'</td></tr>';
                    $work_categoria_mes=$this->model_trabajos->work_categoria_mes($mes,$year,$id_sub);
                    foreach ($work_categoria_mes as $wcm) {
                        $id_dep=$wcm -> dependencia;
                        echo "<tr><td>".$wcm -> dep_nombre ."</td>";
                        for($i = 1; $i <= $numero; $i++) {
                                $date="".$year."-".$mes."-".$i."";
                                $subcategoria_dep_dia=$this->model_trabajos->subcategoria_dep_dia($date,$id_dep,$id_subcategoria);
                                if(!empty($subcategoria_dep_dia)){
                                    echo "<td>x</td>";
                                 }else{ echo "<td></td>";}
                        }
                            echo"</tr>";
                    }
                }
            }

            echo "</tbody></table></div>";

    }

    function toexcel(){

        $mes ="".$this->uri->segment('4')."";
         $year ="".$this->uri->segment('5')."";

        //$mes = $this->input->post('mes');
        //$year= $this->input->post('year');
         $data['numeromes'] = $mes;
         $data['numeroyear'] = $year;
         $this->load->view('trabajos/reportes/planificacion_mensual',$data);   
    }

		
    }


	
