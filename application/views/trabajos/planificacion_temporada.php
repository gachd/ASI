<style>
/*sector*/

 .css-label{text-transform:uppercase; font-size: 12px;}
 .sector {border:1px solid #ccc;
 	float: left;
    margin-left: 15px;
	margin-bottom:15px;
}
 .sector th{ font-size:12px;
 text-transform:uppercase;
  padding:5px;}
 table.sector td {
padding:5px;
border:none;
}

.cant {width: 35px;
    height: 35px;
    padding: 5px;
    font-weight: 600;
	}
		
.hijo{padding-right: 15px;
padding-bottom: 7px;}		

#dep_guardar{margin-top: 15px;}


</style>
<div class="main">
 <?php echo form_open(base_url().'trabajos/planificacion_temporada/guardar'); ?>
 <?php echo validation_errors(); ?>
  <nav class="navbar navbar-default nav-titulo">
    <div class="col-md-3">
        <h1 style="text-align:center;">planificacion Temporada</h1>
    </div>
    <!-- AÑO -->
      <div class="hijo">
        <label for="year">Año:</label>
        <select class="form-control" name="year" id="year">
         <?php 
         	$inicio = 2017;
         	$fin = date('Y');

         	for($i = $inicio; $i<=$fin;$i++){
         		echo '<option value="'.$i.'">'.$i.'</option>';
         	}
          ?>
          
         
        </select>
      </div>
          <!-- temporada -->
      <div class="hijo">
        <label for="mes">Temporada:</label>
        <select class="form-control" name="mes" id="mes">
          <option value="1">Baja</option>
          <option value="2">Alta</option>
        </select>
      </div>
          <!-- categoria -->
      <div class="hijo">
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
          <!-- sub-categoria -->
      <div class="hijo">
        <label for="select2">Sub-Categoria:</label>
        <select class="form-control" name="subcategoria" id="subcategoria">
        <option value="0"> Selccionar </option>
        </select>
      </div>
          <!-- btn cargar -->
      <div class="hijo">
         <button type="button" class="btn btn-primary" id="enviar">Cargar</button>
      </div>
       </nav>
       <!-- CONTENEDOR -->








       <div id="dep_guardar">
          <?php if ($this->session->flashdata('category_success')) { ?>
          <div class="error alert alert-success alert-dismissible  col-md-4" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <?= $this->session->flashdata('category_success') ?> </div>
          <?php } ?>
          <h3>Instrucciones</h3>
          <div>
            <ul>
              <li> Seleccione el Año y temporada que desea planificar</li>
              <li> Seleccione la Categoria y Subcategoria a planificar</li>
              <li> Haga click en  el boton cargar , podra vizualizar lo planificado para la SUB-CATEGORIA en el mes seleccionado</li>
              <li>Complete en las casillas las cantidades de trabajo para cada dependencia<br>* si no hay trabajos para la dependencia dejar la casilla en blanco</li>
              <li> Haga click en el boton guardar</li>
            </ul>
         </div>
       </div>
  <?php echo form_close(); ?>
 </div>

<script>
$(document).ready(function(){
	
	//$( "#edit_fecha" ).datepicker();

			$("#enviar").click(function () {		 
           /*idact=$(this).attr('id');*/
		     categoria=$('#categoria').val();
			mes=$('#mes').val();
			subcategoria=$('#subcategoria').val();
			year=$('#year').val();
            $.post("<?php  echo base_url()?>trabajos/planificacion_temporada/cargar", {
			mes: mes, categoria: categoria, subcategoria:subcategoria, year:year}, function(data){
			 	$("#dep_guardar").html(data);
				});   
		   });
		   


   $("#categoria").change(function () {
           $("#categoria option:selected").each(function () {
            micategoria=$('#categoria').val();
            $.post("<?php  echo base_url()?>trabajos/planificacion_temporada/fillsubcategorias", {
				 micategoria: micategoria}, function(data){
            $("#subcategoria").html(data);
            });            
        });
   })
   
   
   
});
</script>