	



/*funcion ajax que llena el combo dependiendo de la categoria seleccionada*/
$(document).ready(function(){
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
/*fin de la funcion ajax que llena el combo dependiendo de la categoria seleccionada*/

$(document).ready(function(){
   $("#categoria").change(function () {
           $("#categoria option:selected").each(function () {
            categoriaDep=$('#categoria').val();
            $.post("<?php  echo base_url()?>trabajos/nuevo/filldependencias", {
				 categoriaDep: categoriaDep}, function(data){
            $("#div_dep").html(data);
            });            
        });
   })
});

$(document).ready(function(){
   $("#edit_categoria").change(function () {
           $("#edit_categoria option:selected").each(function () {
            categoriaDep=$('#edit_categoria').val();
            $.post("<?php  echo base_url()?>trabajos/nuevo/filldependencias", {
				 categoriaDep: categoriaDep}, function(data){
            $("#edit_dependencia").html(data);
            });            
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
            });            
        
   })
});
