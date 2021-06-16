
<style type="text/css">
	 
	 #highlight-table{ font-size: 10px; 
	 font-family: monospace;
	 text-transform: uppercase;  }

	.fecha{ padding: 3px; text-align: center;}
	.cab_mes{ padding: 3px; text-align: center; font-size:13px;}
	.td_sigla{    padding-left: 9px;
    padding-bottom: 5px;}
    .hijo {padding-right: 5px;}

#informes{    position: absolute;
    /*top: 80px;*/
    background:#fff;}

    .contenido{padding-top: 15px;}

.filtro{    float: left;
    max-width: 30%;
    margin-left: 5px;}

</style>
<div class="main">
    <nav class="navbar navbar-default nav-titulo">
        <div class="col-md-2">
            <h1 style="text-align:center;">INFORMES</h1>
        </div>
        <div class="col-md-8">
          <div class="row" style="padding-top: 15px;">
        <!-- tipo informe -->
              <div class="filtro">
          <select class="form-control input-sm" name="tipo" id="select_tipo" style="width: 150px;">
            <option value="">seleccionar</option>
            <option value="1">Actividades</option>
             <option value="2">Trabajos</option>
             <option value="3">Turnos</option>
          </select>
              </div>
              <div class="filtro">
          <select class="form-control input-sm" name="informes" id="select_informe" style="width: 150px;">
             <!--<option value="">seleccionar</option>
            <option value="5">Planificación</option>
   		       <option value="4">A-Consol.de actividades</option>
   		       <option value="1">TR-Ttrabajos semana</option>
             <option value="3">TR-control planificacion trabajos</option>
             <option value="2">TU-turnos</option>-->
   		       
             
           
          </select>
              </div>
              <div class="filtro">
                <input type="date" class="form-control input-sm" name="date_inicio" id="date_inicio" >
              </div>
              <div class="filtro">
                <input type="date" class="form-control input-sm" id="date_termino" name="date_termino" >
              </div>
           </div>


        <div class="row contenido" id="div_4" style="width: 100%;">
        <!-- categoria -->
         <div class="col-md-3"><label for="select">Categoria:</label>
            <select class="form-control input-sm" name="categoria" id="categoria">
              <option value="0"> Selccionar </option>
              <?php
              if ($usuario == "12121019-3"){
                echo'<option value="3">scuola</option>';
              }else{
                foreach($categorias as $i){
                  echo ' <option value="'.$i->ctg_id.'" '.set_select("categoria",$i->ctg_id).'>'.$i->ctg_nombre.'</option>';
                }
              }
              ?>
            </select>
          </div>
          <div class="col-md-4">
            <label for="select2">Sub-Categoria:</label>
            <select class="form-control input-sm" name="subcategoria" id="subcategoria">
              <option value="0"> Selccionar </option>
            </select>
          </div>
        </div>
        <!-- cargar -->  
        <div class="col-md-3 row" style="padding-top: 15px;">
          <button type="button" class="btn btn-primary" id="enviar">Cargar</button>
        </div>


      
    </div>

      <div class="col-md-2">
        <a href="#" title="Exportar Excel" id="excel" class="descargar btn btn-sm btn-info"><span class="glyphicon glyphicon-circle-arrow-down"></span> Descargar Excel</a>

          <a href="#" title="Exportar Excel" id="pdf" class="descargar btn btn-sm btn-warning"><span class="glyphicon glyphicon-circle-arrow-down"></span> Descargar PDF</a>
       
    </div>
       
   </nav>
  
    <div class="col-md-12" id="informes">
    	<!-- CONTENDOR INFORMES -->
    </div>
</div>
<script>
	$( "#enviar" ).click(function() {

		$('#informes').html('<div><img src="<?php echo base_url()?>assets/images/loading.gif"/></div>');
		informe=$('#select_informe').val();
        date_inicio=$('#date_inicio').val();
        date_termino=$('#date_termino').val();
        excel=0;
        pdf=0;
        categoria=$('#categoria').val();
        subcategoria=$('#subcategoria').val();
		$.post("<?php  echo base_url()?>reportes/inicio/informes", {
        	informe: informe,
          date_inicio: date_inicio,
        	date_termino: date_termino,
          excel: excel,
          categoria: categoria,
          subcategoria:subcategoria,
          pdf:pdf},
        	  function(data){
            $("#informes").html(data);
             });     
    });

$("a[id=excel]").click(function(){
        /*alert('Evento click sobre un input text con id="nombre2"');*/
    informe=$('#select_informe').val();
    date_inicio=$('#date_inicio').val();
    date_termino=$('#date_termino').val();
    excel=1;
    pdf=0;
    categoria=$('#categoria').val();
    subcategoria=$('#subcategoria').val();

    url =  "<?php echo base_url(); ?>reportes/inicio/informes/"+informe+"/"+date_inicio+"/"+date_termino+"/"+ excel+"/"+categoria+"/"+subcategoria+"/"+pdf;
      window.open(url, '_blank');
        });
$("a[id=pdf]").click(function(){
        /*alert('Evento click sobre un input text con id="nombre2"');*/
    informe=$('#select_informe').val();
    date_inicio=$('#date_inicio').val();
    date_termino=$('#date_termino').val();
    excel=0;
    pdf=1;
    categoria=$('#categoria').val();
    subcategoria=$('#subcategoria').val();

    url =  "<?php echo base_url(); ?>reportes/inicio/informes/"+informe+"/"+date_inicio+"/"+date_termino+"/"+ excel+"/"+categoria+"/"+subcategoria+"/"+pdf;
      window.open(url, '_blank');
});

$(document).ready(function(){
   $("#categoria").change(function () {
           $("#categoria option:selected").each(function () {
            micategoria=$('#categoria').val();
            $.post("<?php  echo base_url()?>reportes/inicio/fillsubcategorias", {
         micategoria: micategoria}, function(data){
            $("#subcategoria").html(data);
            });            
        });
   })

 $("#select_tipo").change(function () {
           $("#select_tipo option:selected").each(function () {
            tipo=$('#select_tipo').val();
            //alert(tipo);
            $.post("<?php  echo base_url()?>reportes/inicio/fillinformes", {
         tipo: tipo}, function(data){
            $("#select_informe").html(data);
            });            
        });
   })




});


</script>

 <script language="javascript" type="text/javascript">
            $(document).ready(function(){
                $(".contenido").hide();
                $("#select_informe").change(function(){
                $(".contenido").hide();
                    $("#div_" + $(this).val()).show();
                });
            });
</script>