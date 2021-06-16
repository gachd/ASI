 <style>
 #example{text-transform:uppercase;}
 </style>
 <div id="page-wrapper">
 <div class="container-fluid">
<H1>Arriendo Salón de cumpleaños</H1>
<div class="col-md-6">
<div id="respuesta"></div>
 <?php if ($this->session->flashdata('category_success')) { ?>
         <div class="error alert alert-success alert-dismissible col-md-12 row " role="alert" style="margin:15px;"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <?= $this->session->flashdata('category_success') ?> </div>
    <?php } ?> 
</div>
 <div class="col-lg-12" id="activ_fechas">
                   
                        <div class="table-responsive" >
								 
								 <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        
										<th>Fecha</th>
                                        <th>Hr. Inicio</th>
                                        <th>Hr. Termino</th>
                                       <!-- <th>Categoria</th>-->
                                        <th>Subcategoria</th>
										<th>Socio/Externo</th>
                                       <!--<th>Dependencia</th>-->                                        
                                        <th>Responsable</th>
										 <th></th>
										
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
								$usuario=$this->session->userdata('id');
												
function diferenciaDias($inicio, $fin)
{
    $inicio = strtotime($inicio);
    $fin = strtotime($fin);
    $dif = $fin - $inicio;
    $diasFalt = (( ( $dif / 60 ) / 60 ) / 24);
    return ceil($diasFalt);
}
		
							
					$n=0;			 
		 	foreach($pendientes as $i){

						
				$n++;
		
				$hoy = date("Y-m-d"); 
				$fecha_act = $i -> act_fecha;
				$interval =diferenciaDias($hoy,$fecha_act);
				 $style="";
				 
				 
				 if ($interval < 3) {
					 $style='style="color:#ed143d;"';
					 }
				 
				 
				      /*<td>'.$i -> ctg_nombre.'</td>*/
					  
					  
					  
				
				echo '  <tr '.$style.'>
                                       
										<td>'.date("d/m/Y",strtotime($i -> act_fecha)).'  '.$interval.'</td>
                                        <td>'.date("H:i",strtotime($i -> act_inicio)).' </td>
                                        <td>'.date("H:i",strtotime($i -> act_termino)).'</td>
                                  
                                        <td>'.$i -> sctg_nombre.'</td>
										<td>'.$i -> act_evento.'</td>';
                                       
										
				
				
							/* 
							$dep= $this -> model_actividades -> getDepen($i -> act_id);	
							echo' <td>';
							 foreach($dep as $d ){
								    echo ''.$d -> dep_nombre.' <br>';
								  
								  }
								  echo'</td>';	*/
										echo'										
                                        <td>'.$i -> act_responsable.'</td>
									 <td id="'.$i->act_id.'" class="autorizar"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span> </td>';
								
								 echo' </tr>';
			}	
			
					
			?>
			
			
			
			
		 </tbody>
                            </table>
							
							</div>    
                   
              </div>

</div>
</div>

<script>
jQuery(document).ready(function($) {
    $(".autorizar").click(function() {
        //window.location = $(this).data("href");
		 trid =  $(this).attr('id');
		  
		 $.post("<?php  echo base_url()?>actividades/autorizacion/pago", {
				 trid: trid}, function(data){
            $("#respuesta").html(data);
            });  
		 
		
    });
});
</script>