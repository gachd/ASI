<style type="text/css">
    
    .subcabecera{background:grey;
        text-align: center;
        letter-spacing: 15px;
      text-transform: uppercase;
      font-weight: 600;}

      .funcionario{text-transform: capitalize;}

      .centrado{text-align: center;}
</style>

<?php 
        
$ci = &get_instance();
//$ci->load->model("menu_model");

$ci->load->model('model_trabajos');
$ci->load->model('model_turnos');
$ci->load->model('model_actividades');

$allsubcategorias=$ci-> model_trabajos ->getSubcate();
setlocale(LC_ALL, 'es_ES').': ';    
$fecha1 = $inicio;
$fecha2 = $termino;
$hoy = date("Y-m-d H:i:s"); 
$operacion = strtotime($fecha1) - strtotime($fecha2);
$colspan = (round($operacion/(60*60*24))*-1)+2;




        
echo'<table>
   <tr style="border:none;" style="font-family: monospace;text-transform: lowercase;font-size:12px;">
              <th style="text-align:left;" colspan="6">COORPORACIONES ITALIANAS DE CONCEPCIÓN<br>
                Impreso el '.iconv('ISO-8859-1', 'UTF-8', strftime('%A %d/%b/%y',  strtotime("".$hoy.""))).'</th></tr>
                 <tr style="border:none;">
              <th colspan="6" style="font-size:20px; text-transform:uppercase;text-align:left;">PLANIFICACION SEMANA '.iconv('ISO-8859-1', 'UTF-8', strftime('%A %d/%b/%y',  strtotime("".$fecha1.""))).' - '.iconv('ISO-8859-1', 'UTF-8', strftime('%A %d/%b/%y',  strtotime("".$fecha2.""))).' </th></tr>
    </table>
        <table border="1" style="font-family: monospace;text-transform: lowercase;font-size:12px;">
            <thead>
                   <tr>
              <th class="cab_mes"></th>';
for($i=$fecha1;$i<=$fecha2;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){
    echo'<th class="fecha">'.iconv('ISO-8859-1', 'UTF-8', strftime('%A',  strtotime("".$i.""))).' '.iconv('ISO-8859-1', 'UTF-8', strftime('%d',  strtotime("".$i.""))).'</th>';
    }
        echo '</tr>  <tr>
            <td>Personal</td>';
            for($i=$fecha1;$i<=$fecha2;$i = date("Y-m-d", strtotime($i ."+ 1 days"))) {


                $total_funcionarios=$this->model_trabajos->total_funcionarios($i);
                foreach ($total_funcionarios as $tf) {
                    echo '<td class="centrado">'.$tf -> total .'</td>';
                }

            }
        echo'</tr>';
        // GUARDIAS
        echo'</tr>';
        echo'<tr>
            <td >Guardias</td>';
        for($i=$fecha1;$i<=$fecha2;$i = date("Y-m-d", strtotime($i ."+ 1 days"))) {            
            $total_funcionarios=$this->model_trabajos->total_guardias($i);
            foreach ($total_funcionarios as $tf) {
                echo '<td class="centrado">'.$tf -> total .'</td>';
            }
        }
        echo'</tr>';
        //TOTAL DE PERSONAS
        echo'<tr>
             <td>Nº Personas</td>';
        for($i=$fecha1;$i<=$fecha2;$i = date("Y-m-d", strtotime($i ."+ 1 days"))) { 
            $total_prsns_dia=$this->model_actividades->total_prsns_dia($i);
            foreach ($total_prsns_dia as $ad) {
                echo '<td class="centrado">'.$ad -> total .'</td>';
            }
        }
        echo'</tr></thead>';
         echo'<tbody>';
               ///TURNOS funcionarios              
            $funcionarios_stadio=$this->model_turnos->getFun_stadio_guardia();
            $personal=0;
            $guardias=0;
            foreach ($funcionarios_stadio as $fs) {
                if ($fs->tipo == 2 AND $personal == 0){
                    echo '<tr><td colspan="'.$colspan.'" class="subcabecera">Personal Stadio<td></tr>';
                     $personal ++;
                 }
                 if ($fs->tipo == 4 AND $guardias == 0){
                    echo '<tr><td colspan="'.$colspan.'" class="subcabecera">guardias<td></tr>';
                     $guardias ++;
                 }
                 $rut_fun = $fs->rut;
                 echo '<tr><td class="funcionario">'.substr($fs -> nombre_fun, 0,1).'. '.$fs -> paterno.'</td>';
                 for($i=$fecha1;$i<=$fecha2;$i = date("Y-m-d", strtotime($i ."+ 1 days"))) {
                    
                    $turno_fun=$this->model_turnos->turno_dia_funcionario($rut_fun,$i);
                    echo '<td class="centrado">';
                    foreach ($turno_fun as $tf) {
                        $sigla=$tf-> t_id;
                        if($sigla == 4 || $sigla==13){
                            echo '<span style="color:#FF5722;text-transform: uppercase;">D</span>';
                        }
                         else{
                            if($sigla == 5){
                                echo '<span style="color:#2196F3;text-transform: uppercase;">C</span>';

                            }else{

                                 if($sigla == 14 || $sigla == 15){ echo '<span style="color:#2196F3;text-transform: uppercase;">L</span>';}
                                    else{
                                         if($sigla == 16 || $sigla == 17){

                                            echo'<span style="color:#d57fb3;text-transform: uppercase;">V</span>';

                                         }else{
                                            echo "x";
                                         }

                                        
                                    }
                            }
                            
                        }
                        //echo $tf-> sigla;
                    }
                    echo "</td>";
                }
                echo"</tr>";
            }


            //ACTIVIDADES
            $categorias=$ci-> model_actividades ->categoria_fecha_actv($fecha1,$fecha2);
            foreach ($categorias as $cat) {
                $id_categoria=$cat -> ctg_id;
                $nombre_categoria = $cat -> ctg_nombre;
                echo '<tr><td colspan="'.$colspan.'" class="subcabecera">'.$nombre_categoria.'</td></tr>';
                $subcategorias_actv=$ci->model_actividades->subcategoria_fecha_actv($fecha1,$fecha2,$id_categoria);
                if(!empty($subcategorias_actv)){
                    foreach ($subcategorias_actv as $sa) {
                        $idsub_actv = $sa -> act_sctg_id;
                        echo'<tr><td>'.$sa -> sctg_nombre .'</td>';

                        for($i=$fecha1;$i<=$fecha2;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){
                 
                    $num_personas=$this->model_actividades->num_personas_actv($i,$idsub_actv);
                    foreach ($num_personas as $np) {
                        echo '<td class="centrado">'.$np->total.'</td>';
                    }
                }

                        echo'</tr>';
                    }
                    
                }
            }

            //trabajos

            
            $allsubcategorias=$this->model_trabajos->getSubcate();
           
          foreach ($allsubcategorias as $sub) {
                $id_sub=$sub -> sctg_id;
                 $trabajos_sub_mes=$this->model_trabajos->getAllRangoSub($fecha1,$fecha2,$id_sub);
                if(!empty($trabajos_sub_mes)){
                    $id_subcategoria=$sub-> sctg_id;
                    echo '<tr><td  colspan="'.$colspan.'" class="subcabecera">'.$sub -> sctg_nombre.'</td></tr>';
                    $dep_work_subcategoria_mes=$this->model_trabajos->depe_work_subcategoria_fecha($fecha1,$fecha2,$id_subcategoria);
                   foreach ($dep_work_subcategoria_mes as $wcm) {
                        $id_dep=$wcm -> dependencia;
                        echo "<tr><td>".$wcm -> dep_nombre ."</td>";
                        for($i=$fecha1;$i<=$fecha2;$i = date("Y-m-d", strtotime($i ."+ 1 days"))) {
                                //$date="".$year."-".$mes."-".$i."";
                                $subcategoria_dep_dia=$this->model_trabajos->subcategoria_dep_dia($i,$id_dep,$id_subcategoria);
                                if(!empty($subcategoria_dep_dia)){
                                    echo '<td class="centrado">x</td>';
                                 }else{ echo "<td></td>";}
                        }
                            echo"</tr>";
                    }
                }
            }

            echo "</tbody></table></div>";







    ?>