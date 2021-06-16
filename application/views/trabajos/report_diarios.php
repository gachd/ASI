<style>
@import url('https://fonts.googleapis.com/css?family=Telex');

#example{ text-transform:uppercase;   
    font-family: monospace;
    font-size: 11px;}
.editar {
    background-image: url(<?php  echo base_url()?>/assets/images/edit-bloc.png);
    background-repeat: no-repeat;
    height: 38px;
    width: 34px;
    background-position: center;
    background-size: contain;
    background-color: transparent;
    border: none;
  
}
.editaruser {
    background-image: url(<?php  echo base_url()?>/assets/images/user.png);
    background-repeat: no-repeat;
    height: 38px;
    width: 34px;
    background-position: center;
    background-size: contain;
    background-color: transparent;
    border: none;
  
}
.pc{display:block;margin-top: 20px;}
   .celular{display:none;}
.icono:hover{color:#E53235;}

    table.dataTable thead > tr > th {
    padding-left: 3px;
    padding-right: 3px;
}

@media screen and (max-width: 728px) {
   .pc{display:none;}
   .celular{display:block;}
}
</style>
<?php $usuario=$this->session->userdata('id');
      $tipof= $this -> model_report -> getFunID($usuario);							
                            foreach($tipof as $tf ){
                                $tipo_fun=$tf ->tipo;
                            }?>
<!-- Modal nuevo incidente -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
     <?php
       /*print_r($this->session->all_userdata());*/
    /*echo form_open(base_url().'trabajos/report_diarios/newincident'); */?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nuevo Requerimiento</h4>
      </div>
         
     <?php /*echo validation_errors(); */?>
     
     <div id="res-in"></div>
      <div class="modalbody" style="    display: inline-block;    padding-top: 15px;" >
      
      <form id="form-incidente">
                         
       <div class="col-md-6" ><label for="select">Sector:</label>
            <select class="form-control" name="sector" id="sector">
             
             <?php
      
       if ($tipo_fun == 3){
         echo'<option value="6"> sector 6 </option>';
         }else{
           echo'<option value=""> Selccionar </option>';
        foreach($sector as $s){
                echo'<option value="'.$s->id.'"> '.$s->nombre.' </option>';
                 }
        }?>
            </select></div>
       <div class="col-md-6"><label for="select2">Dependencia:</label>
            <select class="form-control" name="depen" id="depen">
            
             <?php if ($tipo_fun == 3){
         echo'<option value="16"> Scuola</option>';
         }else{ echo'<option value=""> Selccionar </option>';
           }?>
            </select></div>
       <div class="col-md-6" style="margin-top:7px;"><label for="categoria">Departamento:</label>
            <select class="form-control" name="categoria" id="categoria">
              <option value=""> Selccionar </option>
            <?php foreach($categoria as $c){
                echo'<option value="'.$c->rc_id.'"> '.$c->rc_nombre.' </option>';
                 }?>
            </select></div>
       <div class="col-md-6"  style="margin-top:7px;"><label for="prioridad">Prioridad:</label>
            <select class="form-control" name="prioridad" id="prioridad">
              <option value=""> Selccionar </option>
            <?php
       foreach($prioridad as $p){
                echo'<option value="'.$p->rp_id.'"> '.$p->rp_nombre.' </option>';
                 }?>
            </select></div>
            <div class="col-md-12"><textarea style="width:100%; min-height:160px; margin-top:15px;" name="descripcion"></textarea></div>
          </form>
                  </div>
                   
      <div class="modal-footer">
      
       <button type="submit"  class="btn btn-success" onClick="enviar();" >Guardar </button>
       <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
      </div>
      
       <?php /*echo form_close();*/ ?>
    </div>

  </div>
</div>
<!-- Modal comentarios -->
<div id="myNewcoment" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nuevo comentario</h4>
      </div>
      <div id="res-com"></div>
      <div class="modalbody col-md-12" style="display: inline-block;padding-top: 15px;" >
        <form id="form-comentario">
          <div id="insert_coment"> </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit"  class="btn btn-success" onClick="enviar_comentario()">Comentar </button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal responsable -->
<div id="modalasignado" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
     
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Asignacion de Incidente</h4>
      </div>
         
  
      <?php
       /*print_r($this->session->all_userdata());*/
    echo form_open(base_url().'trabajos/report_diarios/actualizar_asignado'); ?>
               
      <div class="modalbody col-md-12" style=" display: inline-block;padding-top:15px;" >
            <div id="asignados"></div>
   </div>
                   
      <div class="modal-footer">
      
      <button type="submit"  class="btn btn-success">Asignar </button>
       <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
      
       <?php echo form_close(); ?>
    </div>

  </div>
</div>




<div class="main">
  <nav class="navbar navbar-default nav-titulo">
    <div class="col-md-3">
        <h1 style="text-align:center;">requerimientos</h1>
    </div>
    <div class="col-md-6" >
      <!-- botonoes-->
      <div class="col-md-12 row" style="text-align:right;padding-top: 16px;">
        <button type="button" class="btn-nuevo btn btn-default">Reportar</button>
        <button type="button" class="btn btn-default" id="buscar">Buscar</button>
      </div>
      <!-- formulario buscar -->
      <div class="col-md-12 row" style="display:none;border: 1px solid #cccccc;margin: 11px 0px;padding-bottom: 15px;" id="div-form">
        <h1 style="border-bottom: 1px #CCCCCC dashed;font-size: 12px;text-transform: uppercase;letter-spacing: 2px;padding-bottom: 7px;">uscar rango de fecha </h1>
        <form action="<?php echo base_url(); ?>trabajos/report_diarios/toexcel" id="frmExcel" name="frmExcel" method="post">
          <table width="100%" border="0">
            <tbody>
              <tr>
                <td width="13%" valign="bottom">
                  <label>Desde :
                  <input class="form-control w_fecha" type="text" name="txt_inicio" id="txt_inicio" style="width:128px;" ></label>
                </td>
                <td width="13%" valign="bottom" style="padding-left:6px;"> <label>Hasta :<input class="form-control w_fecha" type="text" name="txt_termino" id="txt_termino" style="width:128px;" ></label>
                </td>
                <td width="7%" valign="bottom" style="padding: 6px 12px;"><input type="button" name="button" id="buscar" value="Buscar"></td>
                <td width="30%">&nbsp;</td>
                <td width="37%"  valign="bottom" style="padding: 6px 12px;">
                  <h6> Descargar</h6>&nbsp;
                  <a href="#" onClick="generar_reporte_excel()" title="Exportar Excel" ><img src="<?php echo base_url(); ?>assets/images/xls-flat.png" width="40" style="float:left;"/></a>
                </td>
              </tr>
              <tr>
                <td colspan="5" align="center"><div></div></td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>
  </nav>
  <div class="col-md-6">
    <div id="respuesta" class="col-md-12 row" style="margin: 9px;"></div><?php if ($this->session->flashdata('category_success')) { ?>
         <div class="error alert alert-success alert-dismissible col-md-12 row " role="alert" style="margin:15px;"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <?= $this->session->flashdata('category_success') ?> </div>
    <?php } ?>        
  </div>


<!--formato celular-->

<?php 

function dias_transcurridos($fecha_i,$fecha_f)
{
	$dias = (strtotime($fecha_i)-strtotime($fecha_f))/86400;
   $dias = abs($dias); $dias = floor($dias);
   return $dias;
}
if(!empty($incidentes)){
	
		foreach($incidentes as $i){
                                        
                $date_report = date('d/m/y H:i', strtotime($i->ri_fecha_report));
                                        
                $fun= $this -> model_report -> getFunID($i -> ri_usuario);							
                            foreach($fun as $f ){
                                $fun_nombre=$f -> nombre_fun;
                                $fun_paterno=$f -> paterno;
                            }
                
                            if($i -> ri_estado == 0 ){$estado='<span class="label label-success">Abierto</span>';} else {$estado='<span class="label label-default">Cerrado</span>
    ';}		  		
                        
                        switch ($i -> ri_prioridad) {
        case "1":
            $color="info";
            break;
        case "2":
            $color="warning";
            break;
        case "3":
            $color="danger";
            break;
    }
                                        
                echo'
				<div class="col-xs-12 clickable-row celular"  id="'.$i->ri_id.'" style=" line-height: 10px;
    text-transform: uppercase;
    border: 1px solid #ccc;
	    margin: 10px 0px 10px 0px;
    padding: 5px;">
				
				<p> <span style="font-size:14px; font-weight:400;"> '.$date_report.' </span>&nbsp;'.$fun_nombre.' '.substr($fun_paterno, 0, 1).'.</p>
                 <p>'.$estado.'&nbsp;<span class="label label-'.$color.'">'.$i->rp_nombre.'</span></p>
                 <p style="    color: #4b7006;
    padding: 10px;
    /* color: white; */
    font-weight: 600; line-height:10px;">Sector '.$i->nombre.' - '.$i->dep_nombre.'</p>
				  <p style="    background: #eaeaea;line-height:10px;
    padding: 5px;">'.$i->rc_nombre.' : '.$i->ri_desc.'</p>
				 
				
                 </div>
				 
                ';
                 } 
}
?>
                 
           
            
            
 <!--formato pc-->           
           <div class="col-md-12 pc">
                       <div class="table-responsive" >
                                     
                                     <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead style="text-align:center;">
                                            <th>Nº</th>
                                            <th>Fecha</th>
                                            <th>Reporto</th>
                                            <th>Sector</th>
                                            <th>Dependencia</th>
                                            <th>Categoria</th>
                                            <th>Descripción</th>
                                            <th>Asignado a</th>
                                            <th>Tiempo<br>Est.</th>
                                            <th>Tiempo<br>Trans.</th>
                                            <th>Estado</th>
                                            <th>Prioridad</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                            
                                    </thead>
                                    <tbody>
                                    <?php 
									if(!empty($incidentes)){
									foreach($incidentes as $i)
									{
                                        
                                        $date_report = date('d/m/y H:i', strtotime($i->ri_fecha_report));
                                        
                $fun= $this -> model_report -> getFunID($i -> ri_usuario);							
                            foreach($fun as $f ){
                                $fun_nombre=$f -> nombre_fun;
                                $fun_paterno=$f -> paterno;
                            }
                
               if($i -> ri_estado == 0 ){$estado='<span class="label label-success">Pendiente</span>';} else {$estado='<span class="label label-default">Cerrado</span>
    ';}		  		
                        
                        switch ($i -> ri_prioridad) {
        case "1":
            $color="info";
            break;
        case "2":
            $color="warning";
            break;
        case "3":
            $color="danger";
            break;
    }
               
			      $alert_tiempo="";
			   $dias_transcurridos="";
			   $date_requerimiento = date('Y/m/d', strtotime($i->ri_fecha_report));
			   $date_cierre = date('Y/m/d', strtotime($i->ri_fecha_cierre));
			   $fechaactual = date("Y/m/d");
			   if($i->ri_estado == 0 ){
					   
					   $dias_transcurridos=dias_transcurridos($date_requerimiento,$fechaactual);
					   if(($dias_transcurridos > $i-> ri_tiempo) && ($i->ri_tiempo <> 0)){
							$alert_tiempo='style="background:lightyellow;"';
							}
				   
				   }else{
					   $dias_transcurridos=dias_transcurridos($date_requerimiento,$date_cierre);
					   }
						                
                echo'<tr '.$alert_tiempo.'>
			
				 <td  class="clickable-row"  id="'.$i->ri_id.'"> '.$i->ri_id.' </td>
				 <td  class="clickable-row"  id="'.$i->ri_id.'"> '.$date_report.' </td>
                 <td  class="clickable-row"  id="'.$i->ri_id.'">'.$fun_nombre.' '.substr($fun_paterno, 0, 1).'.</td>
                 <td class="clickable-row"  id="'.$i->ri_id.'" >'.$i->nombre.'</td>
                 <td class="clickable-row"  id="'.$i->ri_id.'" >'.$i->dep_nombre.'</td>
				  <td  class="clickable-row"  id="'.$i->ri_id.'">'.$i->rc_nombre.'</td>
                 <td class="clickable-row"  id="'.$i->ri_id.'" >'.$i->ri_desc.'</td>';
				 
				 /*asignado*/
				 if (empty($i-> ri_asignado)) {
    echo '<td class="clickable-row"  id="'.$i->ri_id.'">&nbsp;</td>';
}else{
	  	        	$asignado= $this -> model_report -> getFunID($i -> ri_asignado);	
				    foreach($asignado as $a ){
						
						$nom_asignado= $a -> nombre_fun;
						$ape_asignado = $a -> paterno;
						echo '<td class="clickable-row"  id="'.$i->ri_id.'">'.$nom_asignado.' '.$ape_asignado.'</td>';
						}
				 } 
				 	/*tiempo estimado*/
				echo'<td class="clickable-row"  id="'.$i->ri_id.'" >'.$i->ri_tiempo.' d&iacute;as</td>';
					/*tiempo trasncurrido*/
				echo'<td class="clickable-row"  id="'.$i->ri_id.'" >'.$dias_transcurridos.' d&iacute;as</td>';
				/*estado y prioridad*/
                 echo'<td class="clickable-row"  id="'.$i->ri_id.'" >'.$estado.'</td>
                 <td class="clickable-row"  id="'.$i->ri_id.'" ><span class="label label-'.$color.'">'.$i->rp_nombre.'</span></td>';
				 /*comentarios*/
				 if(($usuario == $i-> ri_asignado)or($usuario == $i-> ri_usuario)){echo' <td class="comentario icono"  id="'.$i->ri_id.'" ><span class="glyphicon glyphicon-comment" aria-hidden="true"></span></td>';
				}else{echo'<td></td>';}
				 /*cerrar requerimiento*/
				  if(($usuario == $i-> ri_asignado)){
					  echo'<td class="ok icono"  id="'.$i->ri_id.'" ><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>';					  						}else{echo'<td></td>';}
				 /*eliminar*/
                  if($usuario == $i -> ri_usuario ){echo'<td class="eliminar icono"  id="'.$i->ri_id.'" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></td>
                 </tr>';}else{echo'<td></td>';}
				
                 }
									}?>
                                    </tbody>
                                    </table>
                           </div>
                  </div>
       </div>
       
     </div>
           
 </div>
</div>

 <div id="modaldesc" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
     <!-- <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nuevo Incidente</h4>
      </div>-->
      <div class="modal-body">
             <div class="rows"> <button type="button" class="close" data-dismiss="modal">&times;</button></div>

            <div id="coment"></div>
                  </div>
     <!-- <div class="modal-footer">
       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
    </div>
   </div>
 </div>

</div>
<script>

//select dependencias
$(document).ready(function(){

$("#sector").change(function () {
           $("#sector option:selected").each(function () {
            sector=$('#sector').val();
            $.post("<?php  echo base_url()?>trabajos/report_diarios/listdepen", {
				 sector: sector}, function(data){
            $("#depen").html(data);
            });            
        });
   });
   $(".comentario").click(function() {
        //window.location = $(this).data("href");
		 id =  $(this).attr('id');
		  
		 $.post("<?php  echo base_url()?>trabajos/report_diarios/ventana_comentario", {
				 id: id}, function(data){
            $("#insert_coment").html(data);
            });  
		 
		$('#myNewcoment').modal('show'); 
    });
	
	  $(".ok").click(function() {
        //window.location = $(this).data("href");
		 trid =  $(this).attr('id');
		  
		 $.post("<?php  echo base_url()?>trabajos/report_diarios/actualizar_estado", {
				 trid: trid}, function(data){
            $("#coment").html(data);
            });  
		 
		
    });
	
     $('#example').DataTable();
});

jQuery(document).ready(function($) {
	
	
});

jQuery(document).ready(function($) {
    $(".btn-nuevo").click(function() {
		$('#myModal').modal('show'); 
		});
});


//modal comentarios de un incidente
jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        //window.location = $(this).data("href");
		 trid =  $(this).attr('id');
		  
		 $.post("<?php  echo base_url()?>trabajos/report_diarios/coment_report", {
				 trid: trid}, function(data){
            $("#coment").html(data);
            });  
		 
		$('#modaldesc').modal('show'); 
    });
});

//modal asignado
jQuery(document).ready(function($) {
    $(".asignado").click(function() {
        //window.location = $(this).data("href");
		 id =  $(this).attr('id');
		  
		 $.post("<?php  echo base_url()?>trabajos/report_diarios/asignado", {
				 id: id}, function(data){
            $("#asignados").html(data);
            });  
		 
		$('#modalasignado').modal('show'); 
    });
});

/*modal comentario*/
jQuery(document).ready(function($) {
    
});


/*modificar estado incidente*/
jQuery(document).ready(function($) {
    $(".eliminar").click(function() {
        //window.location = $(this).data("href");
		 trid =  $(this).attr('id');
		 
		 //Ingresamos un mensaje a mostrar
var mensaje = confirm("¿esta seguro de eliminarlo?");
//Detectamos si el usuario acepto el mensaje
if (mensaje) {
 $.post("<?php  echo base_url()?>trabajos/report_diarios/programa", {
				 trid: trid}, function(data){
            $("#respuesta").html(data);
            }); 
}
//Detectamos si el usuario denegó el mensaje
//else {
//alert("¡Haz denegado el mensaje!");
//}
		 
		  
		 
		 
		
    });
});

/*guara incidente*/
function enviar(){
	var i=jQuery.noConflict();  

 var url = "<?php  echo base_url()?>trabajos/report_diarios/newincident"; // El script a dónde se realizará la petición.
    i.ajax({
           type: "POST",
           url: url,
           data: i("#form-incidente").serialize(), // Adjuntar los campos del formulario enviado.
           success: function(data)
           {
               i("#res-in").html(data); // Mostrar la respuestas del script PHP.
           }
         });

    return false; // Evitar ejecutar el submit del formulario.
 };

function enviar_comentario(){
	var c=jQuery.noConflict();  

 var url = "<?php  echo base_url()?>trabajos/report_diarios/comentarios"; // El script a dónde se realizará la petición.
    c.ajax({
           type: "POST",
           url: url,
           data: c("#form-comentario").serialize(), // Adjuntar los campos del formulario enviado.
           success: function(data)
           {
               c("#res-com").html(data); // Mostrar la respuestas del script PHP.
           }
         });

    return false; // Evitar ejecutar el submit del formulario.
 };
function generar_reporte_excel(){
	   document.getElementById("frmExcel").submit();
	   }


jQuery(document).ready(function($) {
    $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '<Ant',
 nextText: 'Sig>',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'yy/mm/dd',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
$(function () {
$("#txt_inicio").datepicker();
$("#txt_termino").datepicker();

});

$("input[id=buscar]").click(function(){
		/*alert('Evento click sobre un input text con id="nombre2"');*/
		 inicio=$('#txt_inicio').val();
		 termino=$('#txt_termino').val();
            $.post("<?php  echo base_url()?>trabajos/report_diarios/incidentesfecha", {
				 inicio: inicio,
				 termino: termino				 
				 }, function(data){
					$(".table-responsive").html(data);
					 $('#example').DataTable();
					 
					/*$('#example').DataTable();*/
			
            }); 
	});



});
jQuery(document).ready(function($) {
$("#buscar").click(function () {
      $("#div-form").each(function() {
        displaying = $(this).css("display");
        if(displaying == "block") {
          $(this).fadeOut('slow',function() {
           $(this).css("display","none");
          });
        } else {
          $(this).fadeIn('slow',function() {
            $(this).css("display","block");
          });
        }
      });
    });
	});
</script>