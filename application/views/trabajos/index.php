
 <link href="<?php echo base_url(); ?>/assets/css/trabajos/nueva.css" rel="stylesheet">

<div class="main">
  <nav class="navbar navbar-default nav-titulo">
    <div class="col-md-3">
        <h1 style="text-align:center;">NUEVO TRABAJO</h1>
    </div>
  </nav>
  <div class="container-fluid">
    <div class="col-md-12">
      <?php echo form_open(base_url().'trabajos/nuevo/newtrabajo'); ?>
      <?php echo validation_errors(); ?>
     
        <!--panel datos trabajo-->
      <div class="col-md-6">
        <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><i class="fa fa-group fa-fw"></i> Trabajo</h3>
        </div>
        <div class="panel-body">
                <div class="col-md-12">
                  <label><input type="checkbox" name="periodo" id="periodo" value="1" onchange="javascript:showperiodo()"> &nbsp; Periodo </label>
                </div>          
                <!--fecha inicio-->
                <div class="col-md-4">
                  <label for="date">Fecha Inicio:</label>
                  <input class="form-control w_fecha" type="text" name="txt_fecha" id="txt_fecha"  value="<?php echo set_value('txt_fecha');?>">
                </div>
                <!--fecha termino-->
                <div class="col-md-4" id="div_periodo" style="display:none;">
                  <label for="txt_fecha_termino">Fecha termino:</label>
                  <input class="form-control" type="text" name="txt_fecha_termino" id="txt_fecha_termino"  value="<?php echo set_value('txt_fecha_termino');?>">
                </div>
                <!--hora inicio-->
                <div class="col-md-4">
                  <label for="time">Inicio:</label>
                  <input name="txt_inicio" type="time" class="form-control w_fecha" id="time" autocomplete="on" value="<?php echo set_value('txt_inicio');?>">
                </div>
                <!--hora termnino-->
                <div class="col-md-4">
                  <label for="time2">Termino:</label>
                  <input class="form-control w_fecha" type="time" name="txt_termino"  id="time2" autocomplete="on" value="<?php echo set_value('txt_termino');?>">
                </div>
                <!--categoria-->
                <div class="col-md-4">
                  <label for="select">Categoria:</label>
                  <select class="form-control" name="categoria" id="categoria">
                    <option value="0"> Selccionar </option>
                    <?php
                    foreach($categorias as $i){
                      echo ' <option value="'.$i->ctg_id.'" '.set_select("categoria",$i->ctg_id).'>'.$i->ctg_nombre.'</option>';
                    }
                    ?>
                  </select>
                </div>
                <!--subcategoria-->
                <div class="col-md-4">
                  <label for="select2">Sub-Categoria:</label>
                  <select class="form-control" name="subcategoria" id="subcategoria">
                    <option value="0"> Selccionar </option>
                  </select>
                </div>

                <div class="col-md-4">
                  <label for="s_planificado">planificado:</label>
                  <select class="form-control" name="s_planificado" id="s_planificado">
                    <option value="0"> Selccionar </option>
                        <option value="1">No</option>
                        <option value="0">Si</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="s_realizado">Realizado:</label>
                  <select class="form-control" name="s_realizado" id="s_realizado">
                    <option value="0"> Selccionar </option>
                        <option value="0">No</option>
                        <option value="1">Si</option>
                  </select>
                </div>
                <!--descripcion-->
                <div class="col-md-12">
                  <label>Descripción</label>
                  <input class="form-control" name ="txt_descripcion" value="<?php echo set_value('txt_descripcion');?>">
                </div>
          
        </div>
        </div>
      </div>
        <!--panel fucnionarios-->
      <div class=" col-md-6">
                <div class="col-md-12" style="margin-top:15px;">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="panel-title"><i class="fa fa-group fa-fw"></i> Responsable</h3>
                    </div>
                    <div class="panel-body">
                      <!--tipo responsable-->
                      <div class="col-md-12">
                        <label for="number">Responsable:</label>
                        <p>
                        <label> <input type="radio" name="tipo_responsable" value="1" id="fun"  checked="checked" >Funcionario</label>&nbsp;
                        <label><input type="radio" name="tipo_responsable" value="2" id="ext">Externo</label>
                        <br>
                        </p>
                      </div>
                      <div class="col-md-12">
                        <!--externo-->
                        <div id="extDiv" class="none">
                          <input class="form-control" type="text" name="txt_responsable" id="textfield" value="<?php echo set_value('txt_responsable');?>">
                        </div>
                        <!--funcionarios-->
                        <div id="funDiv" >
                          <?php
                          echo'<table width="100%" border="0"><tbody><tr>';
                          $x=1;
                          foreach($funcionario as $i){
                            echo'<td style="vertical-align: middle;text-transform: capitalize;"><label><input type="checkbox" name="fun[]"  value="'.$i->rut.'" style="margin-right:5px;">'.$i->nombre_fun.' '.$i->paterno.'</label></td>';
                            if(1==$x){
                              echo" </tr>";
                              $x=0;
                            }
                            $x++;
                          }
                          echo'</tbody></table>';
                          ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
      </div>
         <!--panel dependencia-->
      <div class="col-md-12" style="margin-top:15px;">
                <div  class="col-md-12 ">
                  <div class="panel panel-default" >
                    <div class="panel-heading">
                      <h3 class="panel-title"><i class="fa fa-home fa-fw"></i> Dependencias</h3>
                    </div>
                    <div class="panel-body">
                      <?php
                      
                      foreach($sectores as $rows_sec){

                        
                        $id_sector = $rows_sec -> id;
                        echo'<table width="200" border="1" class="sector">
                        <tbody>
                        <thead>
                        <th colspan="3">'.$rows_sec -> nombre.'</th>
                        </thead>';
                         /*depe/sector*/
                        foreach($depend as $rows){
                          $sector = $rows -> sector;
                          if ($sector==$id_sector){
                            echo'	 <tr>
		                                <td><input type="checkbox" name="dep[]"  value="'.$rows->dep_id.'" id="'.$rows->dep_id.'"  class="css-checkbox" style="margin-right:3px;"></td>
		                                <td> <label for="'.$rows->dep_id.'" class="css-label" >'.$rows->letra.'</label></td>
                                    <td><label class="css-label" for="'.$rows->dep_id.'">'.$rows->dep_nombre.'</label> </td>
                                    </tr>';
                                  }
                        }/*depe/sector*/
                        echo'</tbody></table>';
                      }
                      ?>
                        
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12" style="text-align:right;" >
                    <br><input type="reset" name="reset" id="reset" value="Cancelar" class="btn btn-danger">
                     <input type="submit" name="submit" id="submit" value="Guardar" class="btn btn-success">
                  </div>
      </div>
      <?php echo form_close(); ?>
    </div> <!-- /.container-fluid -->
  </div>
   <div class="col-md-12" id="activ_fechas"></div>              
</div><!-- /#main -->

<script type="text/javascript">

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
$("#txt_fecha").datepicker();
$("#txt_fecha_termino").datepicker();

});


 function showperiodo() {
        element = document.getElementById("div_periodo");
        check = document.getElementById("periodo");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }

/*funcion ajax que llena el combo dependiendo de la categoria seleccionada*/
$(document).ready(function(){
	
	$( "#edit_fecha" ).datepicker();



   $("#categoria").change(function () {
           $("#categoria option:selected").each(function () {
            micategoria=$('#categoria').val();
            $.post("<?php  echo base_url()?>trabajos/nuevo/fillsubcategorias", {
				 micategoria: micategoria}, function(data){
            $("#subcategoria").html(data);
            });            
        });
   })
});




$(document).ready(function(){
   $("#edit_categoria").change(function () {
           $("#edit_categoria option:selected").each(function () {
            micategoria=$('#edit_categoria').val();
            $.post("<?php  echo base_url()?>trabajos/nuevo/fillsubcategorias", {
				 micategoria: micategoria}, function(data){
            $("#edit_subcategoria").html(data);
            });            
        });
   })
});

$(document).ready(function(){
   $(".btn-editar").click(function () {
                      idworkd=$(this).attr('id');
            $.post("<?php  echo base_url()?>trabajos/nuevo/depwork", {
				 idworkd: idworkd}, function(data){
            $("#dep_edit").html(data);
            });            
        
   })
});

/*fin de la funcion ajax que llena el combo dependiendo de la categoria seleccionada*/

$(document).ready(function() {
    $('#example').DataTable();
} );


$(document).ready(function() {
	$("#txt_fecha").each(
		function(index, value) {
			$(this).change(cantidad_cambiada)
		}
	);
});
 
function cantidad_cambiada(){
	/*alert("Me han llamado desde el campo: " + $("#txt_fecha").val());*/
	
            txt_fecha=$('#txt_fecha').val();
            $.post("<?php  echo base_url()?>trabajos/nuevo/activFecha", {
				 txt_fecha: txt_fecha}, function(data){
            $("#activ_fechas").html(data);
			 $('#example').DataTable();
            });            
   }
   
   /*eliminar
   
   function eliminar(){
	if (confirm("¿Realmente desea eliminarlo?")){ 
		alert("El registro ha sido eliminado.") }
		else { 
		return false
	}
}
	

*/

//con esta funcion pasamos los paremtros a los text del modal.
selPersona = function(descripcion,fecha,inicio,termino,responsable,categoria,subcategoria,dependencia,id,tipo){
	$('#edit_descripcion').val(descripcion);
	$('#edit_fecha').val(fecha);
	$('#edit_inicio').val(inicio);
	$('#edit_termino').val(termino);
	$('#edit_responsable').val(responsable);
	$("#edit_categoria").val(categoria);
	$("#edit_subcategoria").val(subcategoria);
	$("#edit_dependencia").val(dependencia);
	$("#edit_id").val(id);
	
	
};

$(function() {
    $('input[type="radio"]').change(function() {
        var rad = $(this).attr('id');           
            $('#' + rad + 'Div').show();
            $('#' + rad + 'Div').siblings('div').hide();
    });
});
$(document).ready(function(){
   $(".btn-editar").click(function () {
                      idwork=$(this).attr('id');
            $.post("<?php  echo base_url()?>trabajos/nuevo/funwork", {
				 idwork: idwork}, function(data){
            $("#fun_edit").html(data);
			
			 $('input[type="radio"]').change(function() {
        var rad = $(this).attr('id');           
            $('#' + rad + 'Div').show();
            $('#' + rad + 'Div').siblings('div').hide();
    });
			
			
			
            });            
        
   })
});




</script>