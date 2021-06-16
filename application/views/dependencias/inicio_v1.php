
<title>Dependencias</title>


<style>
body{ font-size:12px;}
/*.paneles{padding:0px; margin:15px;}*/
.tbl-dep{ text-transform:uppercase; font:}
.nav-tabs { border-bottom: 2px solid #DDD; }
    .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover { border-width: 0; }
    .nav-tabs > li > a { border: none; color: #666; }
        .nav-tabs > li.active > a, .nav-tabs > li > a:hover { border: none; color: #4285F4 !important; background: transparent; }
        .nav-tabs > li > a::after { content: ""; background: #4285F4; height: 2px; position: absolute; width: 100%; left: 0px; bottom: -1px; transition: all 250ms ease 0s; transform: scale(0); }
    .nav-tabs > li.active > a::after, .nav-tabs > li:hover > a::after { transform: scale(1); }
.tab-nav > li > a::after { background: #21527d none repeat scroll 0% 0%; color: #fff; }
.tab-pane { padding: 15px 0; }
.tab-content{padding:20px}

.card {background: #FFF none repeat scroll 0% 0%; box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3); margin-bottom: 30px; }

.bs-callout {
    padding: 13px 3px;
    margin: 20px 0;
    border: 1px solid #eee;
    border-left-width: 5px;
    border-radius: 3px;
	overflow:hidden;
}


.bs-callout h4 {
    font-size: 18px;
    letter-spacing: 5px;
    margin-top: 0px;
    text-transform: uppercase;
    color: darkgray;
	margin-left:15px;
}

#div_instalaciones{border-left-color: #ce4844;}
#div_vegetacion{border-left-color: #5cb85c;}
#div_recreacion{border-left-color: #f0ad4e;}

.table{
	    margin-top: 20px;
    text-transform: uppercase;
    font-size: 11px;}
	
.td_titulo{
	    background: #f7f7f7;
    text-transform: uppercase;
    font-size: 10px;
    letter-spacing: 4px;}

.panel-small{padding:0px ;}

span.ndias {
        color: #337ab7;
    text-transform: capitalize;;
}
.fdias{    color: #337ab7;
    text-transform: capitalize;}
.mas{cursor: pointer;}

</style>


<div class="main">
  <nav class="navbar navbar-default nav-titulo">
    <div class="col-md-3">
        <h1 style="text-align:center;">DEPENDENCIAS</h1>
    </div>
    <div class="padre buscador">
      <div class="hijo">
      <label for="select_sector">Sector:</label>
            <select class="form-control" name="select_sector" id="select_sector">
                <option value="0">Todos</option>
                 <?php 
      $sector_array=$sector;
      
      foreach($sector_array as $s){
               echo '<option value="'.$s->id.'">'.$s->id.'</option>';}
               ?> 
                
            </select>
      </div>
      <div class="hijo" style=" padding: 0px 5px 0px 5px;">
        <label for="select_subsector">Sub-Sector:</label>
            <select class="form-control" name="select_subsector" id="select_subsector">
                <option value="0">Todos</option>              
            </select>
      </div>
      <div class="hijo"> <button type="button" class="btn btn-primary " id="enviar">Cargar</button></div>
    </div>
  </nav>
  <div class="container-fluid">
    <div class="row">
      <div class="row" style=" margin:0 auto 0 auto; width:390px;">
        <div id="respuesta"></div>
        <?php if ($this->session->flashdata('category_success')) { ?>
        <div class="error alert alert-success alert-dismissible " role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <?= $this->session->flashdata('category_success') ?>
        </div>
        <?php } ?>
      </div>
    </div> 
    <div class="col-md-6" style="text-align:right;  padding-top: 16px;"></div>  
  </div>      
            
            


            <!-- SUB_DEPENDENCIAS-->
            <div class="col-md-4">
                <div class="panel panel-default">
                  <!-- Default panel contents -->
                  <div class="panel-heading">Sub-Dependencias
                    <?php $usuario=$this->session->userdata('id');
                    $permiso= $this -> model_dependencias -> permiso_insertar($usuario);
                    if(!empty($permiso)){echo'  <button type="button" class="btn-nuevo btn btn-default" id="nuevo" style=" margin-left: 15px;">Nuevo</button>';}
                      ?>
                  </div>
                  <div class="panel-body" id="subdep" >
                        <!-- aqui se imprime la tabla dependencias !-->
                  </div>
                </div>
            </div>
         
            
  


  <div class="col-md-8" id="cont-subdependencia">
    <!-- Nav tabs -->
    
  </div>
            
            </div>
            
            </div>
            
            
  <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nueva Sub-Dependencia</h4>
      </div>
      <div id="res-in"><?php echo validation_errors(); ?></div>
      <div class="modalbody" style="display: inline-block;padding-top: 15px;" >
        <form id="form-subdependencia" method="post" action="<?php echo base_url(); ?>dependencias/inicio/nuevo">
      <!-- OPCIONES -->
          <div class="col-md-12 form-group">
            <label style="margin-right:15px;"><input type="checkbox" name="chk_tipo[]" id="chk_instalacion" value="2" onchange="javascript:showinstalacion()"> Instalación</label>
            <label><input type="checkbox" name="chk_tipo[]" id="chk_vegetacion" value="1" onchange="javascript:showvegetacion()"  >Vegetación</label>
            <label><input type="checkbox" name="chk_tipo[]" id="chk_recreacion" value="3" onchange="javascript:showrecreacion()" >Recreacion</label>
          </div>
          <!-- SECTOR -->
          <div class="col-md-6 form-group" >
            <label for="select">Sector:</label>
            <select class="form-control" name="sector" id="form_sector">
              <option value=""> Selccionar </option>
              <option value="0"> Selccionar </option>
              <?php
              foreach($sector_array as  $se){
                echo ' <option value="'.$se->id.'" '.set_select("sector",$se->id).'>'.$se->nombre.'</option>';}
                ?>
            </select>
          </div>
          <!-- SUB-SECTOR -->
          <div class="col-md-6 form-group">
            <label for="select2">Sub Sector:</label>
            <select class="form-control" name="subsector" id="form_subsector" >
              <option value=""> Selccionar </option>
            </select>
          </div>
          <!-- DEPENDENCIA -->
          <div class="col-md-6 form-group">
            <label for="select2">Dependencia:</label>
            <select class="form-control" name="depen" id="select_depen" >
              <option value=""> Selccionar </option>
            </select>
          </div>
          <!-- NOMBRE DEPENDENCIA -->
          <div class="col-md-6 form-group">
            <label for="subdependencia">Nombre:<input type="text" name="subdependencia" id="subdependencia"  class="form-control" maxlength="50"></label>
          </div>
          <!-- MEDIDAS -->
          <div class="col-md-6">
             <label for="ancho">Ancho:<input type="text" name="ancho" id="ancho" style="width:50px;" class="form-control"></label>
             <label for="largo">Largo:<input type="text" name="largo" id="largo" style="width:50px;" class="form-control"></label>
             <label for="alto">Alto:<input type="text" name="alto" id="alto" style="width:50px;" class="form-control"></label>
          </div>
          <div id="div_instalaciones" class="bs-callout col-md-12" style="display:none;">
            <h4>Instalación</h4>
            <div class="col-md-6 form-group">
              <label for="tipo_instalacion">Tipo:</label>
              <select class="form-control" name="tipo_instalacion" id="tipo_instalacion">
                <option value=""> Selccionar </option>
                <option value="Edificación"> Edificación </option>
                <option value="Vial"> Vial </option>
                <option value="Otro"> Otro </option>
              </select>
            </div>
            <div class="col-md-12 form-group">
              <label for="material">Material:
                <select class="form-control" name="material" id="material">
                  <option value=""> Seleccionar </option>
                  <option value="No Aplica"> No Aplica</option>
                  <option value="Ceramico"> Cerámico</option>
                  <option value="Hormigón">Hormigón</option>
                  <option value="Madera"> Madera</option>
                  <option value="Metalicos"> Metálicos</option>
                  <option value="Petreos"> Pétreos</option>
                  <option value="Plastico"> Plástico</option>
                  <option value="Ladrillo"> Ladrillo</option>
                  <option value="Ladrillo Princesa"> Ladrillo Princesa</option>
                  </select>
              </label>
            
            <label for="prioridad">Color pintura:<input type="text" name="color" id="color" style="width:150px;" class="form-control"></label>
            <label for="piso">Piso:
              <select class="form-control" name="piso" id="piso">
                <option value=""> Seleccionar </option>
                <option value="No Aplica"> No Aplica</option>
                <option value="Ceramico"> Ceramico </option>
                <option value="Piso Flotante"> Piso Flotante</option>
                <option value="Madera"> Madera</option>
              </select>
            </label>
            
              <label for="cocina">Cocina:
            </label>
            
                <label>
                  <input type="radio" name="cocina" value="1" id="RadioGroup1_0">
                  Si</label>
                
            <label>
                  <input type="radio" name="cocina" value="0" id="RadioGroup1_1">
                  No</label>
            
            
              <label for="cocina"> </label>
            
       </div>
       <div class="col-md-4 form-group">
       <label for="ventana">Tipo Ventana:</label>
           <select class="form-control" name="ventana" id="ventana" >
           <option value="No Aplica">No Aplica</option>
            <option value=""> Selccionar </option>
            <option value="PVC">PVC</option>
            <option value="Aluminio">Aluminio</option>
            <option value="Madera">Madera</option>
            
        </select>
        </div>
       <div class="col-md-4 form-group">
        <label for="techumbre">Techumbre:</label>
           <select class="form-control" name="techumbre" id="techumbre">
            <option value=""> Selccionar </option>
             <option value="No Aplica"> No Aplica </option>
          <option value="Teja Asfaltica">Teja Asfaltica</option>
          <option value="Policarbonato">Policarbonato</option>
          <option value="Fibrocemento">Fibrocemento</option>
          <option value="Zinc">Zinc</option>
        </select>
        </div>
       <div class="col-md-4 form-group">
        
        <label for="bajada_agua">Bajada de agua:</label>
           <select class="form-control" name="bajada_agua" id="bajada_agua">
            <option value=""> Selccionar </option>
             <option value="No Aplica"> No Aplica </option>
             <option value="Hojalata"> Hojalata </option>
              <option value="Galvanizada"> Galvanizada </option>
               <option value="PVC"> PVC </option>
                <option value="Plástica"> Plástica </option>
        </select>
        </div>
       <div class="col-md-2 form-group">
         <label for="n_puertas">Nº Puertas:
            <input type="text" name="n_puertas" id="n_puertas"  class="form-control"></label>
        
               </div>
       <div class="col-md-3 form-group" style="padding:0px;">
         <label for="escalera">Escalera:
            </label>
            
                <label>
                  <input type="radio" name="escalera" value="1" id="escalera">
                  Si</label>
                
            <label>
                  <input type="radio" name="escalera" value="0" id="escalera">
                  No</label>
        </div>
       <div class="col-md-3 form-group">
         <label for="bano">Baño:
            </label>
            
                <label>
                  <input type="radio" name="bano" value="1" id="bano">
                  Si</label>
                
            <label>
                  <input type="radio" name="bano" value="0" id="bano">
                  No</label>
        </div>
       <div class="col-md-4 form-group">
         <label for="camarines">camarines:
            </label>
            
                <label>
                  <input type="radio" name="camarines" value="1" id="camarines">
                  Si</label>
                
            <label>
                  <input type="radio" name="camarines" value="0" id="camarines">
                  No</label>
        </div>
       <div class="col-md-12 form-group">
          <div class="col-md-2 form-group" style="padding:5px;">
         <label for="n_bano">Nº Baños:
            <input type="text" name="n_bano" id="n_bano"  class="form-control"></label>
        
               </div>
               
                 <div class="col-md-2 form-group" style="padding:5px;">
         <label for="n_urinario">Nº Urinarios:
            <input type="text" name="n_urinario" id="n_urinario"  class="form-control"></label>
        
               </div>
               
                 <div class="col-md-3 form-group" style="padding:5px;">
         <label for="n_lavamanos">Nº Lavamanos:
            <input type="text" name="n_lavamanos" id="n_lavamanos"  class="form-control"></label>
        
               </div>
               
               <div class="col-md-2 form-group" style="padding:5px;">
         <label for="n_duchas">Nº Duchas:
            <input type="text" name="n_duchas" id="n_duchas"  class="form-control"></label>
        
               </div>
               
                <div class="col-md-2 form-group" style="padding:5px;">
         <label for="n_camarinos">Nº Camarinos:
            <input type="text" name="n_camarinos" id="n_camarinos"  class="form-control"></label>
        
               </div>
               
               </div>
       <div class="col-md-3 form-group">
        <label for="fosa">Fosa:
            </label>
            
                <label>
                  <input type="radio" name="fosa" value="1" id="fosa_si">
                  Si</label>
                
            <label>
                  <input type="radio" name="fosa" value="0" id="fosa_no">
                  No</label>
       </div>
        <div class="col-md-3 form-group">
        <label for="n_fosa">Nº Fosas:
            <input type="number" name="n_fosa" id="n_fosa"  class="form-control"></label>
       </div>
          </div>
         
         <div id="div_vegetacion" class="bs-callout col-md-12" style="display:none;" >
          <h4>Vegetación</h4> 
         <div class="col-md-6 form-group" ><label for="tipo_veg">Tipo Vegetación:</label>
            <select class="form-control" name="tipo_veg" id="tipo_veg">
             <option value=""> Selccionar </option>
              <?php 
		  foreach($tipo_vegetacion as  $tv){
				echo ' <option value="'.$tv->vegtipo_id.'" '.set_select("sector",$tv->vegtipo_id).'>'.$tv->vegtipo_tipo.'</option>';
			}	
		
		?>
             
              
            
          </select></div>
          
          <div class="col-md-6 form-group" ><label for="categoria_veg">Categoria:</label>
            <select class="form-control" name="categoria_veg" id="categoria_veg">
             <option value=""> Selccionar </option>
             
            
          </select></div>
          
          <div class="col-md-3 form-group" ><label for="fecha_plantacion">Fecha Plantación:</label>
          <input type="text" name="fecha_plantacion" id="fecha_plantacion"  class="form-control"></div>
          
           <div class="col-md-3 form-group" ><label for="veg_cantidad">Cantidad:</label>
          <input type="number" name="veg_cantidad" id="veg_cantidad"  class="form-control"></div>
          
          <div class="col-md-6 form-group" ><label for="tipo_riego">Tipo Riego:</label>
            <select class="form-control" name="tipo_riego" id="tipo_riego">
             <option value=""> Selccionar </option>
              <option value="MANUAL"> MANUAL </option>
               <option value="ASPERSOR AUTOMATICO"> ASPERSOR AUTOMATICO </option>
                  <option value="ASPERSOR MANUAL"> ASPERSOR MANUAL </option>
            
          </select></div>
          
         </div> 
          <!-- recreacion -->
          <div id="div_recreacion" class="bs-callout col-md-12" style="display:none;" >
            <h4>Recreación</h4> 
            <div class="col-md-6 form-group" >
              <label for="tipo_recreacion">Tipo Recreación:</label>
              <select class="form-control" name="tipo_recreacion" id="tipo_recreacion">
                <option value=""> Selccionar </option>
                <option value="deportivo"> DEPORTIVO </option>
                <option value="social"> SOCIAL </option>
              </select>
            </div>
            <div class="col-md-6 form-group" >
              <label for="superficie">Superficie:</label>
              <select class="form-control" name="superficie" id="superficie">
                <option value="Cesped"> Cesped </option>
                <option value="Arcilla"> Arcilla</option>
                <option value="Cemento">Cemento</option>
                <option value="Sintética">Sintética</option>
                <option value="Arena">Arena</option>
              </select>
            </div>
          </div>
          
           <div class="col-md-12">
          <label for="observaciones">Observaciones:</label><textarea style="width:100%; min-height:160px; margin-top:15px;" name="observaciones"></textarea></div>
      
      </div>
                   
      <div class="modal-footer">
      
       <button type="submit"  class="btn btn-success">Guardar </button>
       <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
      </div>
      
</form>
    </div>

  </div>
</div>
</div>


<script>
function popu(){
	 $(".dependencia").click(function() {
		  id =  $(this).attr('id');
		 $.post("<?php  echo base_url()?>dependencias/inicio/dependencias", {
				 id: id}, function(data){
            $("#subdep").html(data);
		 });
	  });
	}

 //variable ver mas
  var arrayText=Array();

jQuery(document).ready(function($) {
	/*$('#myModal').modal('show'); */







   	
	 $(".btn-nuevo").click(function() {
		$('#myModal').modal('show'); 
		});
	

 $(".collapse.in").each(function(){
        $(this).siblings(".panel-heading").find(".glyphicon").addClass("glyphicon-minus").removeClass("glyphicon-plus");
    });
    
    // Toggle plus minus icon on show hide of collapse element
    $(".collapse").on('show.bs.collapse', function(){
        $(this).parent().find(".glyphicon").removeClass("glyphicon-plus").addClass("glyphicon-minus");
    }).on('hide.bs.collapse', function(){
        $(this).parent().find(".glyphicon").removeClass("glyphicon-minus").addClass("glyphicon-plus");
    });


function carga_sd(){
	
	id =  $(this).attr('id');
		 $.post("<?php  echo base_url()?>dependencias/inicio/contenedor_dependencia", {
				 id: id}, function(data){
            $("#cont-subdependencia").html(data);
            // bucle por todos los objetos con el class texto
    $(".texto").each(function(){
 
      // apuntador al primer span dentro de la clase .texto
      var firstDiv=$(this).find("span:first-child");
 
      // revisamos que el texto sea superior a 100 caracteres para
      // cortarlo
      if(firstDiv.html().length>19)
      {
        // añadimos el texto entero en un array de JavaScript
        arrayText.push(firstDiv.html());
 
        // ponemos el texto cortado a 100 caracteres
        firstDiv.html(firstDiv.html().substr(0,19)+"...");
 
        // Agregamos un span que nos permitira visualizar más texto
        // La clase "cortado", unicamente nos identifica si estamos
        // viendo el contenido entero o cortado.
        // Añadimos un id con el indice del array, para posteriormente
        // poder mostrar el texto completo.
        $(this).append("<span class='mas cortado' id='"+(arrayText.length-1)+"'>(más)</span>");
      }
 
      // mostramos el contenido de la clase texto (por defecto esta con
      // display:none;
      $(this).show();
    });
    // Evento que se ejecuta cuando se pulsa la clase mas
    $(".texto .mas").click(function(){
 
      // Si disponemos de la clase "menos" quiere decir que estamos
      // mostrando el contenido cortado
      if($(this).hasClass("cortado"))
      {
        // añadimos al <span> anterior al pulsado el contenido entero
        // del array de valores. Para saber el indice del array 
        // obtenemos el id del span donde se ha hecho click.
        $(this).prev("span").html(arrayText[$(this).attr("id")]);
 
        // modificamos el texto a "(menos)" y eliminamos la clase "cortado"
        $(this).html("(menos)").removeClass("cortado");
      }else{
        // añadimos al <span> anterior al pulsado el contenido cortado
        // del array de valores. Para saber el indice del array 
        // obtenemos el id del span donde se ha hecho click.
        $(this).prev("span").html(arrayText[$(this).attr("id")].substr(0,19)+"...");
 
        // modificamos el texto a "(mas)" y añadimos la clase "cortado"
        $(this).html("(más)").addClass("cortado");
      }
    });
		 });
	}


 $(".sub_dep").click(carga_sd);

 //sector -> dependencia 
	function eliminar(){
		     
		 trid =  $(this).attr('id');
		 
		 //Ingresamos un mensaje a mostrar
var mensaje = confirm("¿esta seguro de eliminarlo?"+trid);
//Detectamos si el usuario acepto el mensaje
if (mensaje) {
 $.post("<?php  echo base_url()?>dependencias/inicio/eliminar", {
				 trid: trid}, function(data){
            $("#respuesta").html(data);
            }); 
}
//Detectamos si el usuario denegó el mensaje
//else {
//alert("¡Haz denegado el mensaje!");
//}
		 
		  
		 
		 
		
    
			}
  $("#enviar").click(function() {
		  //id =  $(this).attr('id');
      sector=$('#select_sector').val();
    subsector=$('#select_subsector').val();
		 $.post("<?php  echo base_url()?>dependencias/inicio/dependencias", {
				 sector: sector, subsector: subsector}, function(data){
            $("#subdep").html(data);
			 $(".sub_dep").click(carga_sd);
			 $(".eliminar").click(eliminar);
      

		 });
	  });
	  

// tipo vegetacion --> categoria vegetacion
 	   $("#tipo_veg").change(function () {
           tipo=$('#tipo_veg').val();
            $.post("<?php  echo base_url()?>dependencias/inicio/select_categoria_vegetacion", {
				 tipo: tipo}, function(data){
            $("#categoria_veg").html(data);
            });            
       
   });

	 
	
});

	
	
	
    function showinstalacion() {
        element = document.getElementById("div_instalaciones");
        check = document.getElementById("chk_instalacion");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }
	
	   function showvegetacion() {
        element = document.getElementById("div_vegetacion");
        check = document.getElementById("chk_vegetacion");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }
	
	   function showrecreacion() {
        element = document.getElementById("div_recreacion");
        check = document.getElementById("chk_recreacion");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }
	
	//selec form secto -> dependencia
	jQuery(document).ready(function($) {
		
		
		 
		
		
	   $("#sector").change(function () {
           sector=$('#sector').val();
            $.post("<?php  echo base_url()?>dependencias/inicio/select_dependencia", {
				 sector: sector}, function(data){
            $("#depen").html(data);
            });            
       
   })
	});
	
	$(document).ready(function(){
	   $("#select_sector").change(function () {
           $("#select_sector option:selected").each(function () {
            sector=$('#select_sector').val();
            $.post("<?php  echo base_url()?>dependencias/inicio/select_subsector", {
				 sector: sector}, function(data){
            $("#select_subsector").html(data);
            });            
        });
   })

     $("#form_sector").change(function () {
           $("#form_sector option:selected").each(function () {
            sector=$('#form_sector').val();
            $.post("<?php  echo base_url()?>dependencias/inicio/select_subsector", {
         sector: sector}, function(data){
            $("#form_subsector").html(data);
            });            
        });
   })


   $("#form_subsector").change(function () {
           $("#form_subsector option:selected").each(function () {
            subsector=$('#form_subsector').val();
            $.post("<?php  echo base_url()?>dependencias/inicio/select_dependencia", {
				 subsector: subsector}, function(data){
            $("#select_depen").html(data);
            });            
        });
   })
});

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
$("#fecha_plantacion").datepicker();
});
</script>

</html>