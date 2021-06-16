<style>	
.tbl_pan{
	font-family: monospace;
    font-size: 12px;
    text-transform: lowercase;
}

.cabecera{
    background: #6495ed;
    color: #ffffff;
    text-transform: uppercase;
    letter-spacing: 7px;
    text-align: center;
    font-size: 12px;

}
.subcabecera{    background: #b3b3b3;
    text-align: left;
    letter-spacing: 3px;
    font-size: 12px;}

.cab_mes{       width:130px; min-width:130px;
	max-width: 130px;
    padding: 5px;}

.fecha{ padding: 2px;
    text-align: center;}

    th{width: 30px; max-width: 30px; padding: 2px;}
    .scroll {
   max-height:400px;
    overflow: auto;}




.inline{display: inline;
    width: auto;}



</style>
 <div class="main">

<nav class="navbar navbar-default nav-titulo">
    <div class="col-md-3">
        <h1 style="text-align:center;">PLANIFICACION MENSUAL</h1>
    </div>
    <div class="padre buscador">
        <div class="hijo">
                            <label for="year">Año:</label>
                            <select class="form-control inline" name="year" id="year">
                               <?php 
                                $inicio = 2017;
                                $fin = date('Y');

                                for($i = $inicio; $i<=$fin;$i++){
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                }
                              ?>
                            </select>
        </div>
        <div class="hijo">
        <label for="mes">Mes:</label>
        <select class="form-control inline" name="mes" id="mes">
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
            <button type="button" class="btn btn-primary " id="enviar">Cargar</button>
        </div>
    </div>
       <div class="col-md-3">
        <a href="#" title="Exportar Excel" id="excel" class="descargar btn btn-sm btn-info"><span class="glyphicon glyphicon-circle-arrow-down"></span> Descargar Excel</a>
       
    </div>
</nav>


	<div>

          <div class="col-md-12" id="carga"></div>
			
    </div>

<!--fin .wrapper y content -->
   </div>

</div>   



<script>
$( "#enviar" ).click(function() {

		$('#carga').html('<div><img src="<?php  echo base_url()?>assets/images/loading.gif"/></div>');
		mes=$('#mes').val();
		year=$('#year').val();
		$.post("<?php  echo base_url()?>trabajos/planificacion/carga", {
        	year: year,
        	mes: mes},
        	  function(data){
            $("#carga").html(data);
             });     
});

     
$("a[id=excel]").click(function(){
        /*alert('Evento click sobre un input text con id="nombre2"');*/
    mes=$('#mes').val();
    year=$('#year').val();
        url =  "<?php echo base_url(); ?>trabajos/planificacion/toexcel/"+mes+"/"+year;
      window.open(url, '_blank');
    /*$.post("<?php  echo base_url()?>trabajos/planificacion/toexcel", {
            year: year,
            mes: mes});*/
        });
</script>