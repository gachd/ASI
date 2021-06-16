<style>
    ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    /*background-color: #333333;*/
    }

    li {
    float: left;
    }
    input[type=checkbox]{
                height: 15px;
    width: 15px;
    margin: 5px;}

    .tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;
    opacity: 1;
    }

.tooltip .tooltiptext {
    visibility: hidden;
    width: 150px;
    background-color: #fbd95e;
    color: #272727;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;

    /* Position the tooltip */
    position: absolute;
    z-index: 1;
        left: 50px;
            border: 1px solid #FF9800;
}

.tooltip:hover .tooltiptext {
    visibility: visible;
}

#contenedor{    margin: 25px 15px;}

.table-bordered{    font-family: monospace;
    font-size: 12px;
    text-transform: uppercase;
border: none;}

.nav-titulo{    padding-bottom: 5px;}
.hijo{padding-right: 5px;}
</style>

<div class="main">
<?php echo form_open(base_url().'trabajos/disp_trabajo/guardar');
        echo validation_errors(); ?>
<nav class="navbar navbar-default nav-titulo">
    <div class="col-md-3">
        <h1 style="text-align:center;">DISPONIBILIDAD DE TRABAJOS</h1>
    </div>
    <div class="padre buscador">
        <div class="hijo">
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
        <div class="hijo">
            <label for="select2">Sub-Categoria:</label>
                            <select class="form-control" name="subcategoria" id="subcategoria">
                                <option value="0"> Selccionar </option>
                            </select>
        </div>
        <div class="hijo"><button type="button" class="btn btn-primary" id="enviar">Cargar</button></div>
    </div>
</nav>


 <div id="contenedor">
                            
                        <?php if ($this->session->flashdata('category_success')) { ?>
                        <div class="error alert alert-success alert-dismissible  col-md-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                                <?= $this->session->flashdata('category_success') ?>
                        </div>
                         <?php } ?>
                        <div id="dependencias"></div>
                       
</div>



    
   
             <?php echo form_close(); ?>
</div>
<script>
$(document).ready(function(){ 
   $("#categoria").change(function () {
           $("#categoria option:selected").each(function () {
            micategoria=$('#categoria').val();
            $.post("<?php  echo base_url()?>trabajos/disp_trabajo/fillsubcategorias", {
				 micategoria: micategoria}, function(data){
            $("#subcategoria").html(data);
            });            
        });
   })
});
$( "#enviar" ).click(function() {

		$('#dependencias').html('<div><img src="<?php  echo base_url()?>assets/images/loading.gif"/></div>');
		subcategoria=$('#subcategoria').val();
        categoria=$('#categoria').val();
		mes=$('#mes').val();
		year=$('#year').val();
		sector=$('#select_sector').val();
        $.post("<?php  echo base_url()?>trabajos/disp_trabajo/planificacion", {
        	categoria: categoria,
        	year: year,
        	 mes: mes,
        	 sector:sector,
        	 subcategoria:subcategoria},
        	  function(data){
            $("#dependencias").html(data);
             });     
});
</script>