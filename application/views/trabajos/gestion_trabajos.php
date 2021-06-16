<style>
table { table-layout:fixed !important;  width: @table_width !important;}
table>tbody>tr>td, table>tbody>tr>th, table>tfoot>tr>td, table>tfoot>tr>th, table>thead>tr>td, table>thead>tr>th {
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
	text-transform:uppercase;}
.slim { width: 88px; }
.column-hover { background:#eee; }
.row-hover { background:#ddd; }
.cell-hover { background:#fffea1; }
</style>
	<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/mootools1_4_0.js"></script>
<script>

window.addEvent('domready',function(){
	// variables and settings
	var table = document.id('highlight-table');
	table.getElements('td').each(function(el) {
		var parent = el.getParent('tr');
		var siblings = parent.getElements('td');
		var index = siblings.indexOf(el) + 1;
		var childSelector = 'tr td:nth-child(' + index + ')';
		//add events to the table cell
		el.addEvents({
			mouseenter: function() {
				//this column
				table.getElements(childSelector).addClass('column-hover');
				//this row
				parent.addClass('row-hover');
				//this cell
				el.addClass('cell-hover');
			},
			mouseleave: function() {
				//this column
				table.getElements(childSelector).removeClass('column-hover');
				//this row
				parent.removeClass('row-hover');
				//this cell
				el.removeClass('cell-hover');
			}
		});
	});
});
	</script>
<div id="page-wrapper">

<div class="container-fluid">
    <div class="col-md-12">
    
     <h1 style="text-align:center;">CONTROL DE TRABAJOS</h1>
         <div class="panel panel-default">
         
         <div class="panel-heading">
             <h3 class="panel-title" style="text-align:center;">TRABAJOS REALIZADOS V/S  PLANIFICADOS</h3>
           </div>
           
           <div class="panel-body">
           <form action="<?php echo base_url(); ?>trabajos/gest_trabajos/toexcel" id="frmExcel" name="frmExcel" method="post">
           
           <div class="col-md-2">
                <label for="year">Año:</label>
                <select class="form-control" name="year" id="year">
                    <option value="2017">2017</option>
                </select>
             </div>

             <div class="col-md-2">
                <label for="select_sector">Sector:</label>
                <select class="form-control" name="select_sector" id="select_sector">
                    <option value="0">Todos</option> 
                        <?php
                           foreach($sectores as $row_sector){
			                 $id_sector = $row_sector -> id;
                            echo' <option value="'.$id_sector.'">'.$id_sector.'</option>';
			                }
     
                        ?>
                </select>
            </div>
            <div class="col-md-2">
 <label for="mes">Mes:</label>
   <select class="form-control" name="mes" id="mes">
            <option value="1">Enero</option>
            <option value="2">Febrero</option>
            <option value="3">Marzo</option>
            <option value="4">Abril</option>
            <option value="5">Mayo</option>
            <option value="6">Junio</option>
            <option value="7">Julio</option>
            <option value="8">Agosto</option>
            <option value="9">Septiembre</option>
            <option value="10">Octubre</option>
            <option value="11">Noviembre</option>
            <option value="12">Diciembre</option>
        </select>
 
 </div>
           
           
<div class="col-md-2">

		<label for="select">Categoria:</label>
        <select class="form-control" name="categoria" id="categoria">
        	<option value="0">Todos</option> 
         <option value="0"> Selccionar </option>
        <?php 
		
		 	foreach($categorias as $i){
				echo ' <option value="'.$i->ctg_id.'" '.set_select("categoria",$i->ctg_id).'>'.$i->ctg_nombre.'</option>';
			}	
		
		?>
        
        </select>
           
      </div>

      <div class="col-md-1"><button type="button" id="target" class="btn btn-success" >Cargar</button></div>
      
      <div class="col-md-1">
        

       <a href="#" onClick="generar_reporte_excel()" title="Exportar Excel" ><img src="<?php echo base_url(); ?>assets/images/xls-flat.png" width="40" style="float:left;"/></a></div>




</form>
     <div id="table_wrapper" class="col-md-12" style="margin-top:15px;">
  <div id="tbody">
      
        
              </div>  
        </div>

        
           </div>
        </div>
    </div>
</div>


<script type="text/javascript">


	/*funcion ajax que llena el combo dependiendo de la categoria seleccionada*/


	$( "#target" ).click(function() {

		$('#tbody').html('<div><img src="<?php  echo base_url()?>assets/images/loading.gif"/></div>');
             micategoria=$('#categoria').val();
			mimes=$('#mes').val();
			miyear=$('#year').val();
			sector=$('#select_sector').val();
            $.post("<?php  echo base_url()?>trabajos/gest_trabajos/control_trabajos", {
				 micategoria: micategoria,miyear: miyear, mimes: mimes,sector:sector}, function(data){
            $("#tbody").html(data);
			window.addEvent('domready',function(){
	// variables and settings
	var table = document.id('highlight-table');
	table.getElements('td').each(function(el) {
		var parent = el.getParent('tr');
		var siblings = parent.getElements('td');
		var index = siblings.indexOf(el) + 1;
		var childSelector = 'tr td:nth-child(' + index + ')';
		//add events to the table cell
		el.addEvents({
			mouseenter: function() {
				//this column
				table.getElements(childSelector).addClass('column-hover');
				//this row
				parent.addClass('row-hover');
				//this cell
				el.addClass('cell-hover');
			},
			mouseleave: function() {
				//this column
				table.getElements(childSelector).removeClass('column-hover');
				//this row
				parent.removeClass('row-hover');
				//this cell
				el.removeClass('cell-hover');
			}
		});
	});
});
			
			
            });     
});


  function generar_reporte_excel(){
	   document.getElementById("frmExcel").submit();
	   }
	
	

	

</script>