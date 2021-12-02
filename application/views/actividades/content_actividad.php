 <link href="<?php echo base_url(); ?>/assets/css/actividades/content.css" rel="stylesheet">

 <div id="myModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
     <!-- Modal content-->
     <div class="modal-content">
       <?php
        /*print_r($this->session->all_userdata());*/
        echo form_open(base_url() . 'actividades/nueva/newactividad'); ?>
       <?php echo validation_errors(); ?>


       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">Nueva Actividad</h4>
       </div>
       <div class="modal-body">


         <div class="row">

           <div class="col-md-4"><label for="select">Categoria:</label>
             <select class="form-control input-sm input-sm" name="categoria" id="categoria">
               <option value="0"> Selccionar </option>
               <?php
                $usuario = $this->session->userdata('id');
                if ($usuario == "12121019-3") {
                  echo '<option value="3">scuola</option>';
                } elseif ($usuario == "7726718-2") {
                  echo '<option value="25">instituto</option>';
                } else {
                  $categorias = $this->model_actividades->getCategorias();
                  foreach ($categorias as $i) {
                    echo ' <option value="' . $i->ctg_id . '" ' . set_select("categoria", $i->ctg_id) . '>' . $i->ctg_nombre . '</option>';
                  }
                }
                ?>
             </select>
           </div>
           <div class="col-md-4">
             <label for="select2">Sub-Categoria:</label>
             <select class="form-control input-sm input-sm" name="subcategoria" id="subcategoria">
               <option value="0"> Selccionar </option>
             </select>
           </div>
           <div class="col-md-4" id="segmentacion">
             <label for="select2">Segmentacion:</label>
           </div>
           <div class="col-md-12">
             <label for="txt_nomact">Nombre Actividad:</label>
             <input class="form-control input-sm input-sm" type="text" name="txt_nomact" id="txt_nomact" value="">
           </div>
         </div>

         <div class="row">


           <div class="col-md-10" id="dependencia">

             <!-- DEPENDENCIAS -->


           </div>

         </div>
         <div class="row">
           <div class="col-md-12">
             <label><input type="checkbox" name="periodo" id="periodo" value="1" onchange="javascript:showperiodo()"> &nbsp; Periodo </label>
             <label><input type="checkbox" name="reiterativo" id="reiterativo" value="1" onchange="javascript:showdias()"> &nbsp; reiterativo </label>
           </div>
           <div class="col-md-12" id="div_dias" style="display:none;">
             <label><input type="radio" name="dia_semana" value="1"> Lunes</label>
             <label><input type="radio" name="dia_semana" value="2"> Martes</label>
             <label><input type="radio" name="dia_semana" value="3"> Miercoles</label>
             <label><input type="radio" name="dia_semana" value="4"> Jueves</label>
             <label><input type="radio" name="dia_semana" value="5"> Viernes</label>
             <label><input type="radio" name="dia_semana" value="6"> Sabado</label>
             <label><input type="radio" name="dia_semana" value="7"> Domingo</label>
           </div>
           <div class="col-md-3">
             <label for="date">Fecha inicio:</label>
             <input class="form-control input-sm" type="text" name="txt_fecha" id="txt_fecha">
           </div>
           <div class="col-md-3" id="div_periodo" style="display:none;">
             <label for="txt_fecha_termino">Fecha termino:</label>
             <input class="form-control input-sm" type="text" name="txt_fecha_termino" id="txt_fecha_termino">
           </div>
           <div class="col-md-3">
             <label for="time">Inicio:</label>
             <input name="txt_inicio" type="time" placeholder="00:00" class="form-control input-sm w_fecha" id="txt_inicio" autocomplete="on" value="<?php echo set_value('txt_inicio'); ?>">
           </div>
           <div class="col-md-3" id="div_termino">
             <label for="time2">Termino:</label>
             <input class="form-control input-sm w_fecha" type="time" placeholder="00:00" name="txt_termino" id="txt_termino" autocomplete="on" value="<?php echo set_value('txt_termino'); ?>">
           </div>
           <div class="col-md-3" id="div_termino_rept" style="display:none;">
             <label for="time2">Termino:</label>
             <input class="form-control input-sm w_fecha" type="time" placeholder="00:00" name="txt_termino_rept" id="txt_termino_rept" autocomplete="on" value="<?php echo set_value('txt_termino'); ?>">
           </div>
         </div>
         <div class="row" id="div_calendario"> </div>




         <div class="row">
           <div class="col-md-6">
             <label for="empresa">Organiza</label>
             <select name="sel_organiza" id="sel_organiza" class="form-control input-sm">
               <option value="">Seleccionar</option>
               <option value="Stadio">Stadio</option>
               <option value="Scuola">Scuola</option>
               <option value="Concesionario">Concesionario</option>
               <option value="Instituto de Cultura">Instituto de Cultura</option>
               <option value="Tercero">Tercero</option>
             </select>
           </div>
           <div class="col-md-6 autocomplete">
             <label for="empresa">Empresa/Institución</label>
             <input id="txt_empresa" type="text" name="txt_empresa" class="form-control input-sm input-sm">
           </div>

           <div class="col-md-6">
             <label for="txt_responsable">Responsable:</label>
             <input class="form-control input-sm input-sm" type="text" name="txt_responsable" id="txt_responsable" value="<?php echo set_value('txt_responsable'); ?>">
           </div>
           <div class="col-md-6">
             <label for="txt_fono">Telefono:</label>
             <input class="form-control input-sm" type="text" name="txt_fono" id="txt_fono" value="<?php echo set_value('txt_fono'); ?>">
           </div>
           <div class="col-md-6">
             <label for="txt_mail">Correo:</label>
             <input class="form-control input-sm" type="email" name="txt_mail" id="txt_mail" value="<?php echo set_value('txt_fono'); ?>">
           </div>

         </div>
         <div class="row">
           <div class="col-md-3">
             <label for="number">N° Prsn:</label>
             <input required class="form-control input-sm input-sm" type="number" name="txt_cantidad" id="number" value="<?php echo set_value('txt_cantidad'); ?>">
           </div>
           <div class="col-md-3">
             <label for="txt_socios">N° Socios:</label>
             <input class="form-control input-sm" type="number" name="txt_socios" id="txt_socios" value="<?php echo set_value('txt_socios'); ?>">
           </div>
           <div class="col-md-12">
             <label>Observaciones:</label>
             <input class="form-control input-sm input-sm" name="txt_actividad" value="<?php echo set_value('txt_actividad'); ?>">
           </div>

         </div>
         <div class="row">
           <div class="col-md-12">
             <label>Requerimientos:</label>
             <textarea class="form-control" name="txt_req" id="txt_req" rows="3" value="<?php echo set_value('txt_req'); ?>"></textarea>

           </div>
         </div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
         <input type="submit" name="submit" id="submit" value="Guardar" class="btn btn-success">
       </div>

       <?php echo form_close(); ?>
     </div>
   </div>
 </div>


 <script src="<?php echo base_url(); ?>assets/js/autocomplete.js"></script>
 <script type="text/javascript">
   /*CAMPOS AUTOCOMPLETADOS*/
   var responsable = [
     <?php
      $responsable = $this->model_actividades->responsables();
      foreach ($responsable as $r) {
        echo '"' . $r->act_responsable . '",';
      }
      ?>
   ];

   var empresas = [
     <?php
      $empresa = $this->model_actividades->empresas();
      foreach ($empresa as $e) {
        echo '"' . $e->act_empresa . '",';
      }
      ?>
   ];

   var telefonos = [
     <?php
      $telefono = $this->model_actividades->telefonos();
      foreach ($telefono as $t) {
        echo '"' . $t->act_fono . '",';
      }
      ?>
   ];


   /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
   autocomplete(document.getElementById("txt_empresa"), empresas);
   autocomplete(document.getElementById("txt_responsable"), responsable);
   autocomplete(document.getElementById("txt_fono"), telefonos);

   jQuery(document).ready(function($) {
     /*FECHA  DATEPICKER*/
     $.datepicker.regional['es'] = {
       closeText: 'Cerrar',
       prevText: '<Ant',
       nextText: 'Sig>',
       currentText: 'Hoy',
       monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
       monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
       dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
       dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
       dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
       weekHeader: 'Sm',
       dateFormat: 'yy/mm/dd',
       firstDay: 1,
       isRTL: false,
       showMonthAfterYear: false,
       yearSuffix: ''
     };
     $.datepicker.setDefaults($.datepicker.regional['es']);
     $(function() {
       $("#txt_fecha").datepicker();
       $("#txt_fecha_termino").datepicker();
       $("#buscar_inicio").datepicker();
       $("#buscar_termino").datepicker();

     });

     $("#nuevo").click(function() {
       $('#myModal').modal('show');
     });


     $("#sel_organiza").change(function() {
       if (this.value == "Tercero") {
         $("#txt_empresa").attr("disabled", false);
       } else {
         $("#txt_empresa").attr("disabled", true);
       }
     })

     /************NOMBRE ACTIVIDAD**********/

     $("#categoria").change(function() {
       if ((this.value == "3") || (this.value == "4") || (this.value == "13") || (this.value == "22") || (this.value == "23") || (this.value == "24")) {
         $("#txt_nomact").attr("disabled", false);
       } else {
         $("#txt_nomact").attr("disabled", true);
       }
     })

     //categorias --> subdependencia 
     $("#categoria").change(function() {
       $("#categoria option:selected").each(function() {
         micategoria = $('#categoria').val();
         $.post("<?php echo base_url() ?>actividades/nueva/fillsubcategorias", {
           micategoria: micategoria
         }, function(data) {
           $("#subcategoria").html(data);
           $("#segmentacion").empty(); //elimina todo dentro del div VACIA DOM

         });


       });
     })

     // categorias ---> dependencias 

     $("#categoria").change(function() {
       $("#categoria option:selected").each(function() {
         categoriaDep = $('#categoria').val();
         $.post("<?php echo base_url() ?>actividades/nueva/filldependencias", {
           categoriaDep: categoriaDep
         }, function(data) {
           $("#dependencia").html(data);
         });
       });
     })

     // subcategoria ---> segmentacion
     $("#subcategoria").change(function() {
       $("#subcategoria option:selected").each(function() {
         subcategoria = $('#subcategoria').val();
         $.post("<?php echo base_url() ?>actividades/nueva/fillsegmentacion", {
           subcategoria: subcategoria
         }, function(data) {
           $("#segmentacion").css('visibility', 'visible');
           $("#segmentacion").html(data);
         });
       });
     })
     //calendarizacion 
     $("#txt_termino").change(function() {
       termino = $('#txt_fecha_termino').val();
       inicio = $('#txt_fecha').val();
       hr_inicio = $('#txt_inicio').val();
       hr_termino = $('#txt_termino').val();
       $.post("<?php echo base_url() ?>actividades/nueva/fechas_actividad", {
         inicio: inicio,
         termino: termino,
         hr_inicio: hr_inicio,
         hr_termino: hr_termino
       }, function(data) {
         $("#div_calendario").html(data);
       });

     })

   });


   function showperiodo() {
     element = document.getElementById("div_periodo");
     check = document.getElementById("periodo");
     if (check.checked) {
       element.style.display = 'block';
     } else {
       element.style.display = 'none';
     }
   }

   function showdias() {
     dias = document.getElementById("div_dias");
     periodo = document.getElementById("div_periodo");
     termino_rept = document.getElementById("div_termino_rept");
     termino = document.getElementById("div_termino");

     check = document.getElementById("reiterativo");
     if (check.checked) {
       dias.style.display = 'block';
       periodo.style.display = 'block';
       termino_rept.style.display = 'block';
       termino.style.display = 'none';
     } else {
       dias.style.display = 'none';
       periodo.style.display = 'none';
       termino_rept.style.display = 'none';
       termino.style.display = 'block';
     }
   }
 </script>