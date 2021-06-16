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
    font-size: 12pt;
	vertical-align:middle;
	text-transform:uppercase !important;
	 text-align:center;
}
 
th {
    font-weight: bold;
   /* background-color: #E1E1E1;*/
    /*padding:5px;*/
}
 
h1{font-size:18pt;}
h2{font-size:14pt}
 
 td {
    padding: 5px 10px;
	font-size:12PX;
	text-transform:uppercase;
	
}


 table, tr, td, th, tbody, thead, tfoot {
     page-break-inside: avoid !important;
}
</style>

<div>
  
</div>

<table width="100%" border="0">
  <tbody>
    
    <tr>
      <td><table width="100%" border="0">
    <tbody>
      <tr>
        <td><H2>PROGRAMACIÓN DE ACTIVIDADES</H2></td>
        <td width="25%" rowspan="2" align="left" style="padding-bottom:15px;"><img src="<?php echo base_url(); ?>assets/images/logo-stadio.jpg" width="130" style="margin-right:25px;"/></td>
      </tr>
    </tbody>
  </table></td>
    </tr>
    <tr>
      <td style="margin-bottom:10px;"><H3><?php 
			
		    setlocale(LC_ALL, 'es_ES').': ';

			echo iconv('ISO-8859-1', 'UTF-8', strftime('%A %d de %B de %Y',  strtotime($inicio)));
			echo' al ';
			echo iconv('ISO-8859-1', 'UTF-8', strftime('%A %d de %B de %Y',  strtotime($termino)));
			
//Salida: Viernes 24 de Febrero del 2012
 
?></H3></td>
    </tr>
    <tr>
      <td><table width="100%" border="1" style="font-size:10px">
        <thead>
            <tr>
      <th>FECHA</th>
      <th>INICIO</th>
      <th>TERMINO</th>
      <th>CATEGORIA</th>
      <th>SUB-CATEGORIA</th>
      <th>DESCRIPCIÓN</th>
      <th>LUGAR</th>
      <th>RESPONSABLE</th>
      <th># PRSNS</th>
    </tr>
    </thead>
    <tbody>
    <?php

    
			
for($i=$inicio;$i<=$termino;$i = date("Y/m/d", strtotime($i ."+ 1 days"))){

//echo $i.'<br>';
$actv = $this -> model_actividades -> getAll($i);
//echo $this->db->last_query().'<br>';
foreach($actv as $a){
 //echo $a-> ctg_nombre.'<br>';
//echo $a -> act_fecha. '<br>'; ;
 $id_act= $a-> act_id;
	$categoria = $a -> act_ctg_id;
	$class='class="blanco"';
	switch($categoria) {
	    case 1:
		    $class='class="warning"';
		break;
		case 3:
		    $class='class="verde"';
		break;
	}//fin categorias
	echo '  <tr '.$class.'>
            <td >';
            echo iconv('ISO-8859-1', 'UTF-8', strftime('%a %d',  strtotime($i)));
            echo'</td>
            <td>'.date("H:i",strtotime($a -> act_inicio)).'</td>
			<td>'.date("H:i",strtotime($a -> act_termino)).'</td>
            <td>'.$a -> ctg_nombre.'</td>
            <td>'.$a -> sctg_nombre.'</td>
            <td>'.$a -> act_evento.'</td>
            <td>';
			

			$dep= $this -> model_actividades -> getDepen($id_act);	

			 foreach($dep as $d ){
				echo $d -> dep_nombre.' <br>';
				//echo $this->db->last_query();
			 }	
			echo'</td>
				 <td>'.$a -> act_responsable.'</td>
				 <td>'.$a -> act_nprsns.' </td>
				</tr>';
       //
           


      }// fin foreach actividades

 }//fin for fechas

	 ?>
    

  </tbody>
      </table></td>
    </tr>
  </tbody>
</table>


