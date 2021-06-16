<?php

/*header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-type:   application/x-msexcel; charset=utf-8");
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="actividades.xls"');
header('Cache-Control: max-age=0');*/
if($excel == 1 ){
    header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
    header("Content-type:   application/x-msexcel; charset=utf-8");
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="actividades.xls"');
    header('Cache-Control: max-age=0');
    echo'<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />';
}
//$actividades = $this -> model_actividades -> getAllRango($inicio,$termino);
//echo $this -> db -> last_query();



	
?>



<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
<style>
  body{
  
  margin:0 auto;
  font-size: 12px;
  font-family: monospace;
  
  }

.blanco{ background:#fff !important;}
.table-hover>tbody>tr.blanco:hover>td{background:#F4F4F4;}
.verde{background:#ebf6e7 !important}
.azul{background:#f0f2fd !important;}
.warning{background:#fcf8e3 !important;}
.danger{background:#F2DEDE !important;}


#mitabla {border: 1px solid #000; border-collapse: collapse;text-transform: uppercase;}
#mitabla  td  {
    border: 1px solid #000;
    min-width: 0.6em;
    padding: 3px;
    vertical-align: middle;
    text-transform: uppercase;
   font-size: 10px;}
.tdcenter{text-align: center;}

thead {
   
    letter-spacing: 3px;
  }
th{padding: 5px;
   border: 1px solid #000;
   text-align: center;
   text-transform: uppercase;
    background: #e6e6e6;
} 
h1{font-size:18px;}
h2{font-size:14px}
td {padding: 5px 10px;
    text-align: left ;

}

</style>
<div class="container">
  <div class="row justify-content-md-center">
    <div class="col-md-4">
      <img style="width: 150px;" src="<?php echo base_url(); ?>/assets/images/logo_instituciones_mini.png" alt="Instituciones Italianas">
    </div>
    <div class="col-md-6">
      <center><h1>Programación de Actividades<h1></h1><center>
    </div>
  </div>
  
</div>

<table width="100%">
      						<tbody>
      							
      								<tr>
      									<td><?php

  	$dias = array("Domingo","Lunes ","Martes ","Miercoles ","Jueves","Viernes","Sabado");
		$meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
		  $rango_fecha = $dias[date('w',strtotime($inicio))]." ".date('d',strtotime($inicio))." de ".$meses[date('n',strtotime($inicio))-1]. " del ".date('Y',strtotime($inicio)) ;
     

			 if($inicio <> $termino){
        $rango_fecha.=' - ';      
       $rango_fecha.= $dias[date('w',strtotime($termino))]." ".date('d',strtotime($termino))." de ".$meses[date('n',strtotime($termino))-1]. " del ".date('Y',strtotime($termino)) ;
      }


			
			echo $rango_fecha;

//Salida: Viernes 24 de Febrero del 2012
 
?>

</td>
          </tr>
        </tbody>
      </table>

<table width="100%" id="mitabla" align="left" >
      		<thead>

    <tr>
      <th>día</th>
      <th>fecha</th>
      <th>inicio</th>
      <th>termino</th>
      <th>categoria</th>
      
     
      <th>lugar</th>
      <th>responsable</th>
      
      <th># Prsns</th>
      <th>Estado</th>
       <th>Observaciones</th>
    </tr>
    <thead>
    <tbody>
    <?php
			//echo 'inicio:'.$inicio.' termino:'.$termino.'<br>';
      setlocale(LC_ALL, 'es_ES').': ';
			/*for($i=$inicio;$i<=$termino;$i++){*/
        //echo '<br>'.$i.'<br>';
        $actividades = $this -> model_actividades -> det_actividades_pdf($inicio,$termino);
       // echo $this-> db -> last_query();
        //echo'<br>';
        //var_dump($actividades);
        //echo "<br>";
        foreach($actividades as $a){
        $fecha_act= $a -> act_fecha;
        $categoria = $a -> act_ctg_id;
        $estado = $a -> act_estado;

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
                      <td>'.iconv('ISO-8859-1', 'UTF-8', strftime('%A',  strtotime("".$a -> fecha.""))).'</td>
                      <td>'.iconv('ISO-8859-1', 'UTF-8', strftime('%d/%b/%y',  strtotime("".$a -> fecha.""))).'</td>
                        <td class="tdcenter">'.date("H:i",strtotime($a -> inicio)).'</td>
                        <td class="tdcenter">'.date("H:i",strtotime($a -> termino)).'</td>
                        <td>'.$a -> ctg_nombre.'<br>'.$a -> sctg_nombre.'</td>
                        <td>';
            $dep= $this -> model_actividades -> getDepen($a -> act_id); 
            foreach($dep as $d ){
                echo ''.$d -> dep_nombre.' <br>';
            } 
            echo'</td>
                <td>'.$a -> act_responsable.'<br>'.$a -> act_empresa.'</td>
                
                <td class="tdcenter">'.$a -> total.'</td>';
                   if($estado == 1){
                      echo '<td class="tdcenter">Suspendido</td>';
                     }else{
                      echo '<td class="tdcenter">-</td>';
                     }
                
                echo'<td>'.$a -> act_evento.'</td>
            </tr>';
      }
     /* }*/


//echo $i.'<br>';

			

			
			
	 ?>
    

  </tbody>
</table>










