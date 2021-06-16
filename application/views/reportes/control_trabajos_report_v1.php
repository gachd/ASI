<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-type:   application/x-msexcel; charset=utf-8");
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="actividades.xls"');
header('Cache-Control: max-age=0');?>

<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>
<style>table {
    text-transform:uppercase !important;
}</style>
<body>

	<?php
		$fecha=strftime( "%d-%m-%Y", time() );
		
$n_mes = $mes; 

$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); 
$this->load->model('model_trabajos');
$categoria = $this -> model_trabajos->getCategoriasID($cat);

foreach($categoria as $c){ $nom_categoria = $c -> ctg_nombre;}
  

		/*var_dump($sectores);*/
		echo' <table id="highlight-table"  class="table-bordered table-striped" style="    text-transform: uppercase;">
      
	   
	    <thead>
		  <tr>
    <th colspan="7"><table width="100%" border="0" style="font-size:12px; color:#8F8A8A;">
      <tbody>
        <tr>
          <td width="36%" style="text-align: left;font-size: 16px;font-weight: 600;">'.strtoupper($nom_categoria).'</td>
          <td width="64%" style="text-align:right;">'.$fecha.'</td>
          </tr>
        <tr>
          <td style="text-align: left;font-size: 16px;font-weight: 600;">'.$meses[$n_mes-1].'</td>
          <td style="text-align:right;">stadio italiano di concecion</td>
          </tr>
        </tbody>
    </table></th>
    
  </tr>           <tr>
              <th>dependencia</th>';
             
              foreach($subcategoria as $row_sub){
				  
				  
                $sctg_nombre = $row_sub -> sctg_nombre;
				
				$tipo =  $row_sub -> sctg_tipo;
				if ($tipo == 1){echo' <th colspan="3" style=" text-transform: uppercase;" >'.$sctg_nombre.'</th>'; }
				else {echo' <th colspan="3" style=" text-transform: uppercase;">'.$sctg_nombre.'</th>';}
				
                 
				  }
              
          echo'</tr>
          <tr>
          <td>&nbsp;</td>';
		  $num_subacategoria=((3*count($subcategoria))+1);
        
              foreach($subcategoria as $row_sub){
        
                 echo' <td>p</td>
				  <td>#</td>
		  <td><span style="font-weight: 900;font-size: 15px;">%</span></td>';
				  }
           
         echo' </tr>
           </thead> 
             <tbody>';
     
		foreach($sectores as $row_sector){
			 $id_sector = $row_sector -> id;
			 echo'<tr>
			 <td colspan="'.$num_subacategoria.'" style=" text-transform: uppercase;    background:#f0f9ff  ;
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 10px;
    text-align: center;">'.strtoupper($row_sector -> nombre).'</td></tr>';
			 
			 foreach($dependencias as $row_d){
                
                $dep_id = $row_d -> dep_id;
                $dep_nombre = $row_d -> dep_nombre;
				$dep_sector = $row_d -> sector;
				
				if($dep_sector == $id_sector){  echo '<tr>
		
              <td style="text-transform:uppercase; border: 1px solid #ddd;">'.$row_d -> letra.'.&nbsp;'.strtoupper($dep_nombre).'</td>';
			 
			 /*****************trabajos por DEPENDENCIA*******************/
			   foreach($subcategoria as $rs){
                    $sctg_id = $rs -> sctg_id;
                    $this->load->model('model_trabajos');
                    $trabajos_mes = $this -> model_trabajos->trabajos_mes($sctg_id,$dep_id,$mes,$year);
					$plan_mes = $this -> model_trabajos->plan_mes($sctg_id,$dep_id,$mes,$year);
                        $totalTB=0;
						$cantdTB=0;
						$cantMES=1;
						$sumaP="";
				
                      
			 
			 			/*planificacion*/
			              if(count($plan_mes)==0){echo'<td style="border: 1px solid #ddd;">&nbsp;</td>'; $cantMES=0;}
						  else{  foreach($plan_mes as $pm){
							  $cantdTB=$pm -> cantidad;
							  
							  
                              echo'<td style="border: 1px solid #ddd;">'.$pm -> cantidad.'</td>';
							  $sumaP='<td>10</td>';
							 }
								 
						 }
						    /*compruebo si hay trabajos */
                        if(count($trabajos_mes)==0) { echo'<td style="border: 1px solid #ddd;">&nbsp;</td>';}
                        /*hay trabajos NO ESTA VACIO*/
                        else{foreach($trabajos_mes as $tm){
							if($cantMES==0){ echo'<td style="background:#caffd0;border: 1px solid #ddd;">'.$tm -> TOTAL_TB.'</td>';}
							else{echo'<td>'.$tm -> TOTAL_TB.'</td>';}
								 $totalTB=$tm -> TOTAL_TB;
                                }
           				 } 
						 
						  /******porcentaje*******/
						
							//If it's not 0 then divide
							if($cantdTB != 0){
							  $result = ($totalTB*100)/$cantdTB;//is set to number divided by x
							  
							  $resultb=round($result);
							  
							  if ($resultb < 10){
	echo '<td style="border: 1px solid #ddd; background:#ffcaca ;">'.$resultb.'%</td>';
								  }else{
	  echo '<td style="border: 1px solid #ddd;">'.$resultb.'%</td>';
								  }
							}
							//if it is zero than set it to null
							else{
							  $resultb = null;//is set to null
							     echo '<td style="border: 1px solid #ddd;">'.$resultb.'</td>';
							}
							
						
						 
						 
						/* if ($totalTB == 0 and $cantdTB ==0){
							 echo'<td>-</td>';
							 }
							 else{					 $porce=(($totalTB*100)/$cantdTB);	
					  echo '<td>'.$porce.'%</td>'; 
								}*/
						 
        }  
			  
			  }
            ' </tr>';
                }
				
				/***********TOTALES SECTORES******************/
					$total_tbsector=0;
					$total_plsector=0;
				echo'<tr><td style="border: 1px solid #ddd; background:#c5e97a; border-top:2px solid #000000;">total</td>';
			  foreach($subcategoria as $sctg){
                    $sctgid = $sctg-> sctg_id;
					$this->load->model('model_trabajos');
                    $total_plan = $this -> model_trabajos->totalPlan($sctgid,$id_sector,$mes);
						
						if (empty($total_plan)) {
							echo '<td style="border: 1px solid #ddd; background:#c5e97a; border-top:2px solid #000000;">0</td>';}
							else{
								foreach($total_plan as $tp){
							echo'<td style="border: 1px solid #ddd; background:#c5e97a; border-top:2px solid #000000;">'.$tp -> total.'</td>';
							$total_plsector=$tp -> total;
							}
								
								}
						
					/*total trabajos sector */	
					
				
					
					   $total_trabajos = $this -> model_trabajos->total_tb_sector_subcat($sctgid,$id_sector,$mes,$year);
					   
						if (empty($total_trabajos)) {
							echo '<td style="border: 1px solid #ddd; background:#c5e97a; border-top:2px solid #000000;">0</td>';}
							else{
					   			foreach($total_trabajos as $tt){
									echo'<td style="border: 1px solid #ddd; background:#c5e97a; border-top:2px solid #000000;">'.$tt -> total.'</td>';
									$total_tbsector=$tt -> total;
								}
						    }
					
						 /******porcentaje*******/
						
							//If it's not 0 then divide
							if($total_plsector != 0){
							  $result = ($total_tbsector*100)/$total_plsector;//is set to number divided by x
							  
							  $resultb=round($result);
							  
							  if ($resultb < 10){
	echo '<td style="border: 1px solid #ddd; background:#c5e97a; border-top:2px solid #000000;">'.$resultb.'%</td>';
								  }else{
	  echo '<td style="border: 1px solid #ddd; background:#c5e97a; border-top:2px solid #000000;">'.$resultb.'%</td>';
								  }
							}
							//if it is zero than set it to null
							else{
							  $resultb = null;//is set to null
							     echo '<td style="border: 1px solid #ddd; background:#c5e97a; border-top:2px solid #000000;">&nbsp</td>';
							}
						
						
						
			 }
			 
			 
			 
			 	echo'</tr>';
			 
			}/*TERMINA SECTORES*/
		
		
        
   
        
         echo' </tbody>
        </table>';
        ?>

</body>
</html>