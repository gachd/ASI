<?php

header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-type:   application/x-msexcel; charset=utf-8");
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="actividades.xls"');
header('Cache-Control: max-age=0');?>

<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
<style>

.blanco{ background:#fff !important;}
.table-hover>tbody>tr.blanco:hover>td{background:#F4F4F4;}
.verde{background:#ebf6e7 !important}
.azul{background:#f0f2fd !important;}
.warning{background:#fcf8e3 !important;}
.danger{background:#F2DEDE !important;}


table{
    border-collapse: collapse;
    font-size: 12px;
	vertical-align:middle;
	text-transform:capitalize;
	 text-align:center;
}
 
th {
    font-weight: bold;
   /* background-color: #E1E1E1;*/
    /*padding:5px;*/
}
 
h1{font-size:18px;}
h2{font-size:14px}
 
 td {
    padding: 5px 10px;
	
}


</style>

<table width="100%" border="1">
  <tbody>
    <tr>
      <td><table width="100%" id="mitabla" border="1" align="left"  style="vertical-align:top; text-transform:capitalize;"   >
  
  <thead>
    <tr>
      <th colspan="9"><table width="100%" border="1" style="text-align:center;">
        <tbody>
          <tr>
            <td><h1>Programación de Actividades<h1></td>
          </tr>
          <tr>
            <td><?php 
	  	$dias = array("Domingo","Lunes ","Martes ","Miercoles ","Jueves","Viernes","Sabado");
$meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
   'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
		
			
			echo $dias[date('w',strtotime($inicio))]." ".date('d',strtotime($inicio))." de ".$meses[date('n',strtotime($inicio))-1]. " del ".date('Y',strtotime($inicio)) ;
			echo' - ';
			
			echo $dias[date('w',strtotime($termino))]." ".date('d',strtotime($termino))." de ".$meses[date('n',strtotime($termino))-1]. " del ".date('Y',strtotime($termino)) ;
			
//Salida: Viernes 24 de Febrero del 2012
 
?>

</td>
          </tr>
        </tbody>
      </table></th>
      </tr>
    <tr>
      <th>fecha</th>
      <th>inicio</th>
      <th>termino</th>
      <th>categoria</th>
      <th>sub-categoria</th>
      <th>descripción</th>
      <th>lugar</th>
      <th>responsable</th>
      <th># Prsns</th>
    </tr>
    <thead>
    <tbody>
    <?php
			
			
			foreach($actividades as $i){
				
				
				$semana= $dias[date("w",strtotime($i -> act_fecha))];
				
				$dia = date("d",strtotime($i ->act_fecha));
				
				$num_sem=date("W",strtotime($i -> act_fecha));
				
				$num_sem_hoy= date("W");
				
				 $categoria = $i -> act_ctg_id;
				 $class='class="blanco"';
				 
				 switch($categoria) {
					 case 1:
					   $class='class="warning"';
						break;
					 case 3:
					   $class='class="verde"';
						break;
					 }
				 
				
				
				
				echo '  <tr '.$class.'>
                                        
										 <td>'.$semana.' '.$dia.'</td>
                                       <td>'.date("H:i",strtotime($i -> act_inicio)).'</td>
                                        <td>'.date("H:i",strtotime($i -> act_termino)).'</td>
                                        <td>'.$i -> ctg_nombre.'</td>
                                        <td>'.$i -> sctg_nombre.'</td>
										<td>'.$i -> act_evento.'</td>
                                        <td>';
										
							$dep= $this -> model_actividades -> getDepen($i -> act_id);	
							
							  foreach($dep as $d ){
								    echo ''.$d -> dep_nombre.' <br>';
								  
								  }	
								
								echo'</td>
									
                                    <td>'.$i -> act_responsable.'</td>
								    <td>'.$i -> act_nprsns.'</td>
									 
									</tr>';
			}
			
			
			
					
			
			foreach($trabajos as $t){

				$semanat= $dias[date("w",strtotime($t -> tb_fecha))];
				$diat = date("d",strtotime($t ->tb_fecha));
				
				$num_semt=date("W",strtotime($t -> tb_fecha));
				
				$num_sem_hoyt= date("W");
				
				
				$class='class="azul"';
				if((date("N",strtotime($t ->tb_fecha))== 6 ) or (date("N",strtotime($t ->tb_fecha))== 7 )){
					 
					 $class='class="danger"';
					}
				
				echo '  <tr '.$class.'>
                                        
										<td>'.$semanat.' '.$diat.'</td>
                                        <td>'.date("H:i",strtotime($t -> tb_inicio)).'</td>
                                        <td>'.date("H:i",strtotime($t -> tb_termino)).'</td>
                                        <td>'.$t -> ctg_nombre.'</td>
                                        <td>'.$t -> sctg_nombre.'</td>
										<td>'.$t -> tb_descripcion.'</td>

                                        <td>';
										
										
										/*dependencia*/
										
										$id_work= $t -> tb_id;
										$fun_work = $this -> model_trabajos -> getDepWORK("".$id_work."");	
										//var_dump( $fun_work);
										foreach($fun_work  as $fw){
											 echo''.$fw -> dep_nombre .'</br>' ;
										}
										
										echo'</td>
										<td>';
										
										
										/*responsable*/
										
										if($t -> tb_tipo_responsable  == 1) {
											
											$id_work= $t -> tb_id;
										$fun_work = $this -> model_trabajos -> getFuncionarioWORK("".$id_work."");	
										//var_dump( $fun_work);
										foreach($fun_work  as $fw){
											 echo''.$fw -> nombre_fun.' '.$fw -> paterno.'</br>' ;
										}

									  }
									  else {
										  
										  echo $t -> tb_responsable;
										  }
										 echo'</td>
										<td></td>
									 ';
									 
								 echo' </tr>';
			}
			
	 ?>
    

  </tbody>
</table></td>
    </tr>
  </tbody>
</table>








