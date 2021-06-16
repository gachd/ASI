
<title>Dependencias</title>


<style>
body{ font-size:12px;}
.form-group{overflow: auto;}

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
.select-car{width: 30%;
float: left;
    margin-right: 5px;
    font-weight: 600;}
.text-car{width: 65%; float: left;}

h2.titulo-dep {
    padding: 5px;
    background: whitesmoke;
    text-transform: capitalize;
    border-bottom: 1px solid #cccccc;
}

table.detalle {
    //*order: 1px solid #cccccc;*/
    /* padding: 26px; */
}

.detalle>thead>tr>td{ padding: 2px;
    border-bottom: 4px solid #ffffff;
    background: #F7F8FA;
        text-transform: lowercase;
    font-size: 11px; }

.td-digla{    /* border-right: 1px solid #cccccc; */
    background: #F7F8FA;
    border-left: 5px solid #E4E5E7;
    font-family: Consolas,menlo,monaco,monospace;
    font-size: 12px;
    overflow: hidden;
    padding: 10px;
    text-align: left;
    text-overflow: ellipsis;
    white-space: nowrap;}

.glyphicon-remove{     margin-left: 5px;
    margin-top: 9px;
    color: palevioletred;}

    .input-xs {
  height: 22px;
  padding: 2px 5px;
  font-size: 12px;
  line-height: 1.5; /* If Placeholder of the input is moved up, rem/modify this. */
  border-radius: 3px;
  margin-right: 5px;
}
.select_buscar{padding-right:  5px; text-transform: uppercase;}
.input-sm {
    height: 5px; }
.work_buscados{font-size:9px;}
.table-info, .table-info>td, .table-info>th {
    background-color: #f1f8f9;
}
</style>

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/plugins/chosen_v1.8.3/chosen.css">
 <script src="<?php echo base_url(); ?>assets/js/plugins/chosen_v1.8.3/chosen.jquery.js" type="text/javascript"></script>
  
<div class="main">
  <nav class="navbar navbar-default nav-titulo">
    <div class="col-md-3">
        <h1 style="text-align:center;">DEPENDENCIAS</h1>
    </div>
        
      <div class="col-md-4">
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
      </div>
      <div class="col-md-3">
      <button type="button" class="btn btn-primary " id="enviar">Cargar</button>
      <a href="#" title="Reporte" id="pdf"  ><button type="button" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-print"></span> FT. Subsector</button></a>
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
        <h4 class="modal-title">Ingresar Nueva Dependencia</h4>
      </div>
      <div id="res-in"><?php echo validation_errors(); ?></div>
      <div class="modalbody" style="display: inline-block;padding-top: 15px;" >
        <form id="form-subdependencia" method="post" action="<?php echo base_url(); ?>dependencias/inicio/nuevo">
      <!-- OPCIONES -->
          <div class="col-md-12 form-group">
            <label style="margin-right:15px;"><input type="checkbox" name="chk_tipo[]" id="chk_instalacion" value="2" > Instalación</label>
            <label><input type="checkbox" name="chk_tipo[]" id="chk_vegetacion" value="1"  >Vegetación</label>
            <label><input type="checkbox" name="chk_tipo[]" id="chk_deportivo" value="4">Deportivo</label>
            <label><input type="checkbox" name="chk_tipo[]" id="chk_recreacion" value="3"  >Recreacion</label>
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
          <!--<div class="col-md-6 form-group">
            <label for="select2">Dependencia:</label>
            <select class="form-control" name="depen" id="select_depen" >
              <option value=""> Selccionar </option>
            </select>
          </div>-->
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
          <div class="col-md-12">

            <label for="num_caracteristica" ><strong>Nº Caracteristicas:</strong>
            <select name="num_caracteristica" class="form-control" id="num_caracteristica" onchange="select_caracteristicas(this,'cajas')">
              <option value="0">Seleccionar...</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
            </select>
            </label>
            <div id="cajas"></div>
          
            
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


<!-- **************************** MODAL DEL EDITAR *********************************** -->
<!-- **************************** MODAL DEL EDITAR *********************************** -->
<!-- **************************** MODAL DEL EDITAR *********************************** -->
<!-- **************************** MODAL DEL EDITAR *********************************** -->

<div id="myModaleditar" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Actualizar Sub-Dependencia</h4>
      </div>
      <div class="modalbody" >
      <div id="res-in"><?php echo validation_errors(); ?></div>

     
      <form  action="<?php echo base_url()?>dependencias/inicio/actualizar" role="form" method="post" >
     
     <!--************************* IMPRIMO EL CONTENIDO DE LA VENTANA *****************-->
       <div class="col-md-12" id="dep_edit" style="padding-top: 10px;" >
                    
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


<div id="modal_new_equipo" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Agregar Equipo</h4>
      </div>
      <div class="modalbody" >
      <div id="res-in"><?php echo validation_errors(); ?></div>

     
      <form  action="<?php echo base_url()?>dependencias/inicio/new_equipo" role="form" method="post" >
     
    
       <div class="col-md-12">
          <fieldset>
            <legend>Equipo</legend>
            <div class="col-md-4">
            <label for="eq_tipo" class="col-sm-2 col-form-label">TIPO</label>
            <select class="form-control form-control-sm" name="eq_tipo" id="eq_tipo">
              <?php $eq_tipos = $this->db->get('eq_tipos');
                    foreach ($eq_tipos->result() as $et)
                    {
                       echo '<option value="'.$et -> id.'">'.$et -> tipo.'</option>';
                    }
              ?>
            </select>
            </div>
            <div class="col-md-3">
            <label>cantidad</label>
            <input type="number" name="eq_cantidad" class="form-control input-sm">
            </div>
            <div class="col-md-4">
            <label>Nombre</label>
            <select class="form-control form-control-sm " name="equipo" id="equipo">
            </select>
            <div id="div_neweq" style="background: #e8e42c; padding: 3px;">
              <input type="text" class="form-control input-sm" name="eq_nuevo">
            </div>
            </div>
          </fieldset>
          <!-- datos de compra --> 
          <fieldset>
            <legend>datos de compra</legend>
            <div class="form-group" style="overflow: -webkit-paged-y;">
              <div class="col-md-4">
              <label for="eq_fechacompra">Fecha Compra</label>
              <input type="date" name="eq_fechacompra" class="form-control input-sm">
              </div>            
              <div class="col-md-8">
                <label for="single-label-example">Proveedor</label>
                <select data-placeholder="Selcciona..."  class="sel chosen-select-deselect"  tabindex="15" name="eq_prov">
                  <option value=""></option>
                  <?php $proveedores = $this->db->get('proveedores');
                  foreach ($proveedores->result() as $p)
                    {
                       echo '<option value="'.$p -> pro_rut.'">'.$p -> pro_razonsocial.'</option>';
                    }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-3">
              <label for="eq_precio">Precio</label>
              <input type="number" name="eq_precio" aria-describedby="des_precio"class="form-control input-sm">
              <small id="des_precio" class="form-text text-muted">Precio + iva .</small>
              </div>
              <div class="col-md-3">
              <label for="eq_oc">OC</label>
              <input type="number" name="eq_oc" class="form-control input-sm">
              </div>
              <div class="col-md-3">
              <label for="eq_factura">Nº Factura</label>
              <input type="number" name="eq_factura" class="form-control input-sm">
              </div>
              <div class="col-md-3">
              <label for="eq_fechaexp">Fecha Expiracion</label>
              <input type="date" name="eq_fechaexp" class="form-control input-sm">
              </div>
            </div>
          </fieldset>
          <fieldset>
            <legend>caracteristica</legend>
            <div class="form-group">
              <label for="eq_ncaract" ><strong>Nº Caracteristicas:</strong>
            <select name="eq_ncaract" class="form-control" id="eq_ncaract" onchange="select_caracteristicas(this,'eq_cajas')">
              <option value="0">Seleccionar...</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
            </select>
            </label>
            <div id="eq_cajas"></div>
            </div>
          </fieldset>             
       </div>
                   
      <div class="modal-footer">
       <button type="submit"  class="btn btn-success btn-sm">Guardar </button>
       <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" >Cancelar</button>
      </div>
      
      </form>
      </div>

  </div>
 </div>
</div>


<script>



  jQuery(document).ready(function($) {

    $("a[id=pdf]").click(function(){
    /*alert('Evento click sobre un input text con id="nombre2"');*/
     id=$('#select_subsector').val();
     //termino=$('#buscar_termino').val();
     url =  "<?php echo base_url(); ?>dependencias/inicio/ft_subsectores/"+id;
      window.open(url, '_blank');
      
  });
    // FORMULARIO NUEVO EQUIPO
   
    $('#div_neweq').hide(); 
    $('#equipo').change(function(){
        if($('#equipo').val() == 0) {
            $('#div_neweq').show(); 
        } else {
            $('#div_neweq').hide(); 
        } 
  });

  //select equipo 
  $("#eq_tipo").change(function () {
           $("#eq_tipo option:selected").each(function () {
            tipo=$('#eq_tipo').val();
            $.post("<?php  echo base_url()?>dependencias/inicio/select_equipos", {
         tipo: tipo}, function(data){
            $("#equipo").html(data);
            $( "#equipo" ).removeClass( "sel" );
            $( "#equipo" ).addClass( "sel" );
            $(".sel").chosen({width: "95%", height:"300px"})
            });            
        });
   })
$(".sel").chosen({width: "95%", height:"300px"});


 $("#eq_ncaract").change(function () {
          $("#eq_ncaract option:selected").each(function () {
            num=$('#eq_ncaract').val();
             $.post("<?php  echo base_url()?>dependencias/inicio/fillcaracteristicas",
                   function(data){$(".caracteristica").html(data);});
          });
   })

  });
function eliminar_caract(){
  $( ".delete_caeact" ).click(function() {
     id = $(this).attr('id');
     $("#divcarct"+id).remove();
  //alert( "Handler for .click() called." );
  });
};
function select_caracteristicas(sel,caja){
  var num = sel.value;
    if( !num ) num = sel.options[sel.selectedIndex].value;
    if( !num ) return;
 
 
    num = parseInt( num );
    var dest = document.getElementById(caja);
    dest.innerHTML='';

    for( i = 0; i < num; i++ ) {
      var html="<div><select class=\"caracteristica form-control select-car\" name=\"caracteristica"+i+"\" /> <input type=\"text\" name=\"desc"+i+"\"  class=\"form-control text-car\"/></div>";
                  dest.innerHTML += html;
    }

}
function select_edit_caracteristicas(sel){
  var num = sel.value;
    if( !num ) num = sel.options[sel.selectedIndex].value;
    if( !num ) return;
 
 
    num = parseInt( num );
    var dest = document.getElementById("cajas_edit");
    dest.innerHTML='';

    

    for( i = 0; i < num; i++ ) {
      
      var html="<div><select class=\"caracteristica form-control select-car\" name=\"new_edit_caract"+i+"\" /> <input type=\"text\" name=\"txt_crt_edit"+i+"\"  class=\"form-control text-car\"/></div>";
                  dest.innerHTML += html;
    }

}


$(document).ready(function(){


   $("#num_caracteristica").change(function () {
          $("#num_caracteristica option:selected").each(function () {
            num=$('#num_caracteristica').val();
             $.post("<?php  echo base_url()?>dependencias/inicio/fillcaracteristicas",
                   function(data){$(".caracteristica").html(data);});
          });
   })
});



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



   $("#categoria").change(function () {
           $("#categoria option:selected").each(function () {
            micategoria=$('#categoria').val();
            $.post("<?php  echo base_url()?>trabajos/planificacion_diaria/fillsubcategorias", {
         micategoria: micategoria}, function(data){
            $("#subcategoria").html(data);
            });            
        });
   })


        $("#buscar").click(function () {     
          sub=$('#subcategoria').val();
          dep = id;
          //alert(sub);
          $.post("<?php  echo base_url()?>dependencias/inicio/trabajos_buscados", {
          sub: sub,dep:dep}, function(data){
          $("#work_buscados").html(data); 
          })
        });  


             $("#new_equipo").click(function() {
                $('#modal_new_equipo').modal('show'); 
                 //alert("nuevo equipo");
               });
            // ficha tecnica dependencias
                 $("a[id=r_dep]").click(function(){
                  id=$('#id_dep_report').val();
                   url =  "<?php echo base_url(); ?>dependencias/inicio/ft_dependencia/"+id;
                    window.open(url, '_blank');
                 });

            // report trabajos
                 $("a[id=r_work]").click(function(){
                 sub=$('#subcategoria').val();
             
                   url =  "<?php echo base_url(); ?>dependencias/inicio/report_trabajos/"+id+"/"+sub;
                    window.open(url, '_blank');
                 });

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
    $.post("<?php  echo base_url()?>dependencias/inicio/eliminar", {trid: trid},
      function(data){
               $("#respuesta").html(data);
               }); }
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
      
      
       /* *************** MOSTRAR MODAL EDITAR ******************* */
       $(".editar").click(function () {     
          trid =  $(this).attr('id');
          $.post("<?php  echo base_url()?>dependencias/inicio/datosdepend", {
          trid: trid}, function(data){
          $("#dep_edit").html(data);
          $('#myModaleditar').modal('show'); 
          $.datepicker.regional['es'] = {
                   closeText: 'Cerrar',
                   prevText: '<Ant',
                   nextText: 'Sig>',
                    currentText: 'Hoy',
                   monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre',                   'Noviembre', 'Diciembre'],
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
            $("#fecha_plantacion_edit").datepicker();
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
          eliminar_caract();
          $("#num_caract_edit").change(function () {
          $("#num_caract_edit option:selected").each(function () {
            num=$('#num_caract_edit').val();
             $.post("<?php  echo base_url()?>dependencias/inicio/fillcaracteristicas",
                   function(data){$("[name*='new_edit_caract']").html(data);});
          });
             })
          

        });   
       });



       

		 });
	  });

	  


	 
	
});



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
 $("#fecha_plantacion_edit").datepicker();
 });
      
  

 
</script>

</html>