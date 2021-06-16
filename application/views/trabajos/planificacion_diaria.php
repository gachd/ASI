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

.contenedor {padding:15px;}
.hijo{padding-right: 6px;}


/*    position: relative;
    display: block;
    width: 11px;
    height: 11px;
    border: 1px solid #808080;
    content: "";
    background: #FFF;
}*/
.myinput[type="checkbox"]:after{
    /*position: relative;*/
    display: block;
    /*left: 2px;*/
   /* top: -15px;*/
    width: 15px;
    height: 15px;
    border-width: 1px;
    border-style: solid;
    border-color: #B3B3B3 #dcddde #dcddde #B3B3B3;
    content: "";
    /*background-image: linear-gradient(135deg, #B1B6BE 0%,#FFF 100%);*/
    background-repeat: no-repeat;
    background-position:center;
}

.myinput[type="checkbox"]:disabled:after{
    -webkit-filter: opacity(0.4);
}

.myinput.planificado[type="checkbox"]:checked:after{
    background-image:  url('http://www.stadioitalianodiconcepcion.cl/ASI/assets/images/check_planificado.png')/*, linear-gradient(135deg, #B1B6BE 0%,#FFF 100%)*/;
}

.myinput.planificado[type="checkbox"]:not(:disabled):checked:hover:after{
    background-image:  url('http://www.stadioitalianodiconcepcion.cl/ASI/assets/images/check_planificado.png')/*, linear-gradient(135deg, #8BB0C2 0%,#FFF 100%)*/;
}


.myinput.noplanificado[type="checkbox"]:checked:after{
    background-image:  url('http://www.stadioitalianodiconcepcion.cl/ASI/assets/images/check_noplanificado.png')/*, linear-gradient(135deg, #B1B6BE 0%,#FFF 100%)*/;
}

.myinput.noplanificado[type="checkbox"]:not(:disabled):checked:hover:after{
    background-image:  url('http://www.stadioitalianodiconcepcion.cl/ASI/assets/images/check_noplanificado.png')/*, linear-gradient(135deg, #8BB0C2 0%,#FFF 100%)*/;
}



.myinput[type="checkbox"]:not(:disabled):hover:after{
    /*background-image: linear-gradient(135deg, #8BB0C2 0%,#FFF 100%);*/  
    border-color: #85A9BB #92C2DA #92C2DA #85A9BB;  
}
/*.myinput[type="checkbox"]:not(:disabled):hover:before{
    border-color: #3D7591;
}*/

.myinput.large{
    height:22px;
    width:22px;
}

.myinput.large[type="checkbox"]:before{
    width: 20px;
    height: 20px;
}
.myinput.large[type="checkbox"]:after{
    top: -20px;
    width: 16px;
    height: 16px;
}
.myinput.large.custom[type="checkbox"]:checked:after{
background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGHRFWHRBdXRob3IAbWluZWNyYWZ0aW5mby5jb23fZidLAAAAk0lEQVQ4y2P4//8/AyUYwcAD+OzN/oMwshjRBoA0Gr8+DcbIhhBlAEyz+qZZ/7WPryHNAGTNMOxpJvo/w0/uP0kGgGwGaZbrKgfTGnLc/0nyAgiDbEY2BCRGdCDCnA2yGeYVog0Aae5MV4c7Gzk6CRqAbDM2w/EaQEgzXgPQnU2SAcTYjNMAYm3GaQCxNuM0gFwMAPUKd8XyBVDcAAAAAElFTkSuQmCC')/*, linear-gradient(135deg, #B1B6BE 0%,#FFF 100%)*/;
}
.myinput.large.custom[type="checkbox"]:not(:disabled):checked:hover:after{
background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGHRFWHRBdXRob3IAbWluZWNyYWZ0aW5mby5jb23fZidLAAAAk0lEQVQ4y2P4//8/AyUYwcAD+OzN/oMwshjRBoA0Gr8+DcbIhhBlAEyz+qZZ/7WPryHNAGTNMOxpJvo/w0/uP0kGgGwGaZbrKgfTGnLc/0nyAgiDbEY2BCRGdCDCnA2yGeYVog0Aae5MV4c7Gzk6CRqAbDM2w/EaQEgzXgPQnU2SAcTYjNMAYm3GaQCxNuM0gFwMAPUKd8XyBVDcAAAAAElFTkSuQmCC')/*, linear-gradient(135deg, #8BB0C2 0%,#FFF 100%)*/;
}

</style>

<div class="main">
    <?php 
        /*print_r($this->session->all_userdata());*/
        echo form_open(base_url().'trabajos/planificacion_diaria/guardar');
        echo validation_errors();
    ?>
    <nav class="navbar navbar-default nav-titulo">
        <div class="col-md-3">
            <h1 style="text-align:center;">PLANIFICACIÓN DE TRABAJOS</h1>
        </div>
        <div class="hijo">
            <label for="year">Año:</label>
            <select class="form-control" name="year" id="year">
                <?php 
                    $fin = 2017;
                    $inicio = date('Y');

                    for($i = $inicio; $i>=$fin;$i--){
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                ?>
            </select>
        </div>
        <div class="hijo">
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
        <div class="hijo">
            <button type="button" class="btn btn-primary" id="enviar">Cargar</button>
        </div>
    </nav>



	<div class="contenedor">
        <?php if ($this->session->flashdata('category_success')) { ?>
        <div class="error alert alert-success alert-dismissible  col-md-4" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <?= $this->session->flashdata('category_success') ?>
            </div>
            <?php } ?>
            <div id="dependencias"></div>
            
            <?php echo form_close(); ?>
    </div>

</div>

<script>
$(document).ready(function(){ 
   $("#categoria").change(function () {
           $("#categoria option:selected").each(function () {
            micategoria=$('#categoria').val();
            $.post("<?php  echo base_url()?>trabajos/planificacion_diaria/fillsubcategorias", {
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
        $.post("<?php  echo base_url()?>trabajos/planificacion_diaria/planificacion", {
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