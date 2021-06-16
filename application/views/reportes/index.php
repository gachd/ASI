<style>

#div-nuevo{ transition: opacity 1s ease-out;}
.row-turnos{ 
  
  margin: 5px;
  text-transform: uppercase;
  font-size: 11px;
  padding: 0px 0px 5px 0px;
}
.cont-turnos{  /*background: red;*/  
  padding: 0px;border-bottom: 1px solid #c7c7c7; 
     font-size: 12px;
    letter-spacing: 4px;
    font-family: monospace;
    color: grey;
}
.cont-funcionarios{padding-left: 7px;}
.panel-turnos {padding: 5px;}
.tbl_actividades {text-transform: uppercase; font-size: 11px;}
.horario{font-weight: 600; font-size: 13px;}
.glyphicon-earphone{padding-right: 5px;}
.observaciones{border: none;
    font-style: oblique;
    text-transform: lowercase;
    background: #f3f3f3;
 }
.tbl_trabajos{text-transform: uppercase; font-size: 11px;}

.buscador{width: 50%;}
.organizacion{    position: relative;
    top: 7px;
    font-size: 15px;
    text-align: center;
    border: 1px solid #ccc;
    padding: 4px;
}

#div_calendario{

  text-align: center;
  -webkit-text-align: center;  
  -moz-text-align: center;
  -ms-text-align: center;

  padding: 15px;
  -webkit-padding: 15px;
  -moz-padding: 15px;
  -ms-padding: 15px;

}

#dependencia{padding:15px;}
  #segmentacion{visibility: hidden;}

  select.input-sm{
    text-transform: uppercase;
    font-size: 11px;
}


span.categoria{      font-size: 8px;
    color: #fff;
    letter-spacing: 2px;
    padding: 3px;
    text-transform: uppercase;}
    p.text_subcategoria{margin-top:2px;}
    i.text_segmentacion{font-size: 9px;}

.scrollbar{overflow: auto;
max-height:  400px;}
/* Let's get this party started */

::-webkit-scrollbar {
  width: 9px;
  height: 9px;
}
::-webkit-scrollbar-button {
  width: 0px;
  height: 0px;
}
::-webkit-scrollbar-thumb {
  background: #;D97F7F
  border: 0px none #ffffff;
  border-radius: 72px;
}
::-webkit-scrollbar-thumb:hover {
  background: #c0c0c0;
}
::-webkit-scrollbar-thumb:active {
  background: #808080;
}
::-webkit-scrollbar-track {
  background: #dadada;
  border: 0px none #ffffff;
  border-radius: 50px;
}
::-webkit-scrollbar-track:hover {
  background: #dadada;
}
::-webkit-scrollbar-track:active {
  background: #dadada;
}
::-webkit-scrollbar-corner {
  background: transparent;
}

.cont-hora{    border: 1px solid #dadada;
   /*padding: 3px;*/
    font-size: 12px;
    text-align: center;
    font-weight: 600;
    color: grey;
    border-radius: 2px;
    width: 12%;
  float: left;
    box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.2);}
/*.cont-actividades{    width: 86%;
  
    float: left;
    border: 1px solid rgba(0,0,0,.125);
    margin-left: 5px;
    padding: 5px;
    box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.2);
    margin-bottom: 17px;
}*/
.cont-actividades:hover {
    background: #ffffd8;
    cursor: pointer;
}
.titulo{    border-bottom: 1px solid #bbbbbb;
    margin-bottom: 6px;
      width: 80%;}


/* CSS by GenerateCSS.com */
.cont-actividades ul {list-style-type: disc;
    padding: 14px;
list-style-position: inside;}

.cont-actividades li {padding: 0px;
margin: 0px;}

.n_persns{width: 20%;
    float: left;
    font-size: 12px;
    padding: 5px;
    text-align:  center;
    /* border: 1px solid #bbbbbb; */
    letter-spacing: 1px;
    font-weight: 600;
    color: #848080;}

    #det_actividad{padding: 0;}
.detalle_titulo{
    padding: 5px;
    color: white;
    font-size: 20px;
    text-transform: uppercase;}
.fecha_seleccionada{color:#000; text-transform:lowercase; text-align: center;}
 .dia{font-size: 14px;}
 .mes{font-size: 14px;}   
 .num_dia{    font-size: 37px;
    line-height: 0.8;
    font-weight: 700;} 
.det_fecha{background: #777777;
    color: white;
    padding: 4px;
    margin-top: 3px;
    font-size: 13px;}
.det_hora{padding-top: 15px;
    font-size: 20px;
    font-weight: 600}
.det_duracion{    background: #cac5c5;
    margin-top: 15px;
    padding: 5px;}
.num_duracion{    background: white;
    text-align: center;
    padding: 0px;
    font-weight: 600;}
.dia_duracion{    color: white;
    text-align: center;
    padding: 3px 0px;}
.fecha_duracion{    font-size: 11px;
    margin-top: 15px;
    padding: 0px 0px 0px 4px;}    
.cont-card{padding:5px;}
.card{padding: 6px;
    background: white;
    min-height: 100px;
    margin-top: 5px;
      overflow: auto;}

.card h1{margin-top: 8px;
    margin-bottom: 10px;
    color: #333;
    margin: 0 0 15px;
    line-height: 1.75rem;
    font-weight: 700;
    font-size: 1.25rem;}

ul.fullstats {
    padding: 0;
    width: 100%;

    margin: 6px 0 0;
    border-top: 1px solid #e8e8e8;
    float: left;
    list-style-type: none;
}

ul.fullstats li {
    width: 33.33333333%;
    float: left;
    text-align: center;
    font-size: 10px;
    line-height: 10px;
    color: #999;
    border-left: 1px solid #e8e8e8;
    padding: 11px 0;
}

ul.fullstats li:last-child { 
 border-right:  1px solid #e8e8e8;
 height: 100%;
}

ul.fullstats li span {
    display: block;
    font-size: 16px;
    line-height: 18px;
    color: #333;
}

.responsable{    text-transform: uppercase;
    font-family: monospace;
    font-size: 13px;}

.btn-group{float: right !important;}

#tbl_calendarizacion{ max-height: 250px; overflow: auto; }

#cont-det-actividades{display: none;}

.titulo-trabajo{    text-transform: uppercase;
    letter-spacing: 4px;}

    .cont-trabajo{    border-bottom: 1px solid #bfbfbf;
    overflow: auto;
    margin-bottom: 5px;
    border-bottom-style: dashed;}

    .body_actividades{ padding: 5px 0px;  }
    #cont_list_actividades{padding: 0px 5px;}

    .panel-turnos .table{    text-transform: capitalize;}

   tr.highlighted td {
    background: #ffffd8;
}

#table_actividades{    border: solid #ccc 1px;
    font-size: 10px;
    text-transform: uppercase;}
.autocomplete-items {
  /*position: absolute;*/
  position: inherit;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}
.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}
.autocomplete-items div:hover {
  /*when hovering an item:*/
  background-color: #e9e9e9; 
}
.autocomplete-active {
  /*when navigating through the items using the arrow keys:*/
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}

.legend-dep{margin: 3px;
    font-size: 12px;
    width: unset;
    font-weight: 700;
    padding: 6px;
    border: none}
  .fieldset-dep{border: 1px solid silver;
    padding: 5px;}


  .nombre_actividad {
    font-size: 15px;
    font-style: oblique;
    text-transform: lowercase;
}
</style>
 <link href="<?php echo base_url(); ?>/assets/css/actividades/nueva.css" rel="stylesheet">
  
  <script  src="<?php echo base_url(); ?>assets/js/autocomplete.js"></script>



<div class="main" >

   <!--CALENDARIZACION-->

  <div id="modal_calendar" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Calendarizacion</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <input name="cal_id" id="cal_id" type="hidden"/>
              <div class="col-md-4">
               <label for="time">Fecha:</label>
               <input name="cal_date" type="date"  class="form-control input-sm " id="cal_date" value="">
              </div>
              <div class="col-md-4">
               <label for="time">Hr. Inicio:</label>
               <input name="cal_inicio" type="time" placeholder="00:00" class="form-control input-sm " id="cal_inicio" autocomplete=" on" value="">
              </div>
              <div class="col-md-4">
               <label for="time">Hr. Termino:</label>
               <input name="cal_termino" type="time" placeholder="00:00" class="form-control input-sm " id="cal_termino" autocomplete=" on" value="">
              </div>
              <div class="col-md-12" style="padding-top: 15px;">
                <p><textarea rows="4" id="cal_desc"  class="form-control input-sm" placeholder="Comparte tu opinión con el autor!"> </textarea></p>               
              </div>
              <div class="col-sm-12"  style="text-align: right;padding: 15px;">
                <button type="button" class="btn btn-warning" id="save_cal">Guardar</button>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12" id="tbl_calendarizacion"> 
                
              </div>
            </div>        
          </div>
      </div>
    </div>
  </div>



<!--********************************MODAL AGREGAR********************************-->

  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
       <?php 
          /*print_r($this->session->all_userdata());*/
          echo form_open(base_url().'actividades/nueva/newactividad'); ?>
          <?php echo validation_errors(); ?>
         

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nueva Actividad</h4>
      </div>
      <div class="modal-body">
        
      
        <div class="row">
          
          <div class="col-md-4"><label for="select">Categoria:</label>
            <select class="form-control input-sm input-sm"  name="categoria" id="categoria">
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
          <label><input type="checkbox" name="periodo" id="periodo" value="1" onchange="javascript:showperiodo()" > &nbsp; Periodo </label>
          <label><input type="checkbox" name="reiterativo" id="reiterativo" value="1" onchange="javascript:showdias()" > &nbsp; reiterativo </label>
        </div>
        <div class="col-md-12" id="div_dias" style="display:none;">
              <label><input type="radio" name="dia_semana" value="1"> Lunes</label>
              <label><input type="radio" name="dia_semana" value="2"> Martes</label>
              <label><input type="radio" name="dia_semana" value="3"> Miercoles</label>
              <label><input type="radio" name="dia_semana" value="4"> Jueves</label>
              <label><input type="radio" name="dia_semana" value="4"> Viernes</label>
              <label><input type="radio" name="dia_semana" value="6"> Sabado</label>
              <label><input type="radio" name="dia_semana" value="7"> Domingo</label>
        </div>
        <div class="col-md-3">
          <label for="date">Fecha inicio:</label>
          <input class="form-control input-sm" type="text" name="txt_fecha" id="txt_fecha"  >
        </div>
        <div class="col-md-3" id="div_periodo" style="display:none;">
          <label for="txt_fecha_termino">Fecha termino:</label>
          <input class="form-control input-sm" type="text" name="txt_fecha_termino" id="txt_fecha_termino" >
        </div>
        <div class="col-md-3">
          <label for="time">Inicio:</label>
          <input name="txt_inicio" type="time" placeholder="00:00" class="form-control input-sm w_fecha" id="txt_inicio" autocomplete="on" value="<?php echo set_value('txt_inicio');?>">
        </div>
        <div class="col-md-3" id="div_termino"  >
          <label for="time2">Termino:</label>
          <input class="form-control input-sm w_fecha" type="time" placeholder="00:00" name="txt_termino"  id="txt_termino" autocomplete="on" value="<?php echo set_value('txt_termino');?>">
        </div>
        <div class="col-md-3" id="div_termino_rept" style="display:none;">
          <label for="time2">Termino:</label>
          <input class="form-control input-sm w_fecha" type="time" placeholder="00:00" name="txt_termino_rept"  id="txt_termino_rept" autocomplete="on" value="<?php echo set_value('txt_termino');?>">
        </div>
        </div>
          <div class="row" id="div_calendario" > </div>



        
        <div class="row">
          <div class="col-md-6">
              <label for="empresa">Organiza</label>
              <select name="sel_organiza" id="sel_organiza" class="form-control input-sm">
               <option value="">Seleccionar</option>
               <option value="Stadio">Stadio</option>
               <option value="Scuola">Scuola</option>
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
            <input class="form-control input-sm input-sm" type="text" name="txt_responsable" id="txt_responsable" value="<?php echo set_value('txt_responsable');?>">
          </div>
          <div class="col-md-6">
            <label for="txt_fono">Telefono:</label>
            <input class="form-control input-sm" type="text" name="txt_fono" id="txt_fono" value="<?php echo set_value('txt_fono');?>">
          </div>
          <div class="col-md-6">
            <label for="txt_mail">Correo:</label>
            <input class="form-control input-sm" type="email" name="txt_mail" id="txt_mail" value="<?php echo set_value('txt_fono');?>">
          </div>
          
        </div>
        <div class="row">
          <div class="col-md-3">
            <label for="number">N° Prsn:</label>
            <input required class="form-control input-sm input-sm" type="number" name="txt_cantidad" id="number" value="<?php echo set_value('txt_cantidad');?>">
          </div>
          <div class="col-md-3">
            <label for="txt_socios">N° Socios:</label>
            <input class="form-control input-sm" type="number" name="txt_socios" id="txt_socios" value="<?php echo set_value('txt_socios');?>">
          </div>
          <div class="col-md-12">
            <label>Observaciones</label>
            <input class="form-control input-sm input-sm" name ="txt_actividad" value="<?php echo set_value('txt_actividad');?>">
          </div>
          
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <input type="submit" name="submit" id="submit" value="Guardar" class="btn btn-success">
      </div>
      </form>
      <?php echo form_close(); ?>
    </div>
  </div>  
 </div>

 <div>
<nav class="navbar navbar-default nav-titulo">
  <div class="col-md-3">
        <h1 style="text-align:center;"><?php 
      $url =$this->uri->segment('4');
      
      setlocale(LC_ALL, 'es_ES').': ';
    echo iconv('ISO-8859-1', 'UTF-8', strftime('%A %d de %B de %Y',  strtotime("".$url."")));
  
     ?></h1>
  </div>

     <div class="buscador padre">
          <div class="col-md-4">
               <?php $usuario=$this->session->userdata('id');
               $permiso= $this -> model_actividades -> permiso_insertar($usuario);
               if(!empty($permiso)){
                echo' <button type="button" class="btn-nuevo btn btn-default" id="nuevo">Nuevo</button>';
              }
              ?>
              <button type="button" class="btn btn-default" id="buscar_rango">Buscar</button>
    </div>
      <div class="col-md-5" id="div-buscar" style="border: 1px solid rgba(0, 0, 0, 0.125);border-radius: 0.25rem; display:none;">
        <form action="<?php echo base_url(); ?>actividades/nueva/toexcel" id="frmExcel" name="frmExcel" method="post">
          <table width="100%" border="0">
            <tbody>
            <tr>
              <td width="13%" valign="bottom">
                <label>Desde :<input class="form-control input-sm input-sm w_fecha" type="text" name="buscar_inicio" id="buscar_inicio" style="width:128px;" ></label>
              </td>
              <td width="13%" valign="bottom" style="padding-left:6px;">
                <label>Hasta :<input class="form-control input-sm w_fecha" type="text" name="buscar_termino" id="buscar_termino" style="width:128px;" ></label>
              </td>
              <td width="7%" valign="bottom" style="padding: 6px 12px;"><input type="button" name="button" id="buscar" value="Buscar"></td>
              <tr>
                <td colspan="3"><h6> Descargar</h6> &nbsp;<a href="#" onClick="generar_reporte_excel()" title="Exportar Excel" ><img src="<?php echo base_url(); ?>assets/images/xls-flat.png" width="40" style="float:left;"/></a><a href="#" title="Exportar Excel" id="pdf"  ><img src="<?php echo base_url(); ?>assets/images/pdf-flat.png" width="40" style="float:left;"/></a>
                </td>
              </tr>
            </tr>
            <tr>
              <td colspan="5" align="center"><div></div></td>
            </tr>
          </tbody>
        </table>
      </form>
    </div>

            
            
            </div>

</nav>



          
            <!-- mensajes de error -->
             <div class="row">
             <div class="col-md-3">            
            <?php if ($this->session->flashdata('category_success')) { ?>
         <div class="error alert alert-success alert-dismissible " role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <?= $this->session->flashdata('category_success') ?> </div>
    <?php } ?>
            </div>
            </div>
            
            <!-- NUEVA ACTIVIDAD --> 
            <div class="col-md-12" id="div-nuevo" style="display:none;">  
<div class="panel panel-primary">
                <!-- Page Heading -->
                <div class="panel-heading">
     <h3 class="panel-title"><i class="fa fa-plus-square"></i> Nuevo</h3>
   </div>
   <div class="panel-body">
                <!-- /.row -->
				<div class="row">
                  <div class="col-md-12">                       
                     <!-- /.row -->
               </div> <!-- /.container-fluid -->
               </div>
    </div>           
</div>
</div>

  <div class=" col-md-12"  id="activ_fechas">


<!-- ACTIVIDADES -->
 <div class="col-md-12"  id="select_actividad" style="
    margin-top: 15px;
">  
   <div class="panel panel-default"> 
      <div class="panel-heading"> ACTIVIDADES</div>
       <div class="panel-body body_actividades" >

  <input type="hidden" id="txt_fechasel" value="<?php echo $fecha; ?>"/>
        <div class="scrollbar col-md-6" id="cont_list_actividades"> 

          <table width="100%" id="table_actividades" border="1" class="table table-condensed" style="    border: solid #ccc 1px;">
  <thead>
    <tr>
      <th>Fecha</th>
      <th>Horario</th>
      <th>Actividad</th>
      <th>Dependencia</th>
      <th>Nº Prsns.</th>
    </tr>
  </thead>
  <tbody>
     <?php
        foreach($query as $i){
          $socios = $i -> act_nsocios;
          $externos = $i -> act_nprsns;
          $total_prsns= $socios + $externos;

          echo'  <tr  class="cont-actividades" id="'.$i -> act_id.'"  >
      <td>&nbsp;</td>
      <td>'.date("H:i",strtotime($i -> act_inicio)).' '.date("H:i",strtotime($i -> act_termino)).'</td>
      <td> '.$i -> sctg_nombre.'<br><span class="categoria" style="background: '.$i -> ctg_color.';">'.$i -> ctg_nombre.'</span><br>'.$i-> act_nombre.'</td>
      <td><ul>';
          $dep= $this -> model_actividades -> getDepen($i -> act_id);
          foreach($dep as $d ){echo '<li>'.$d -> dep_nombre.'</li>';}
      echo'</ul></td>
      <td>'.$total_prsns.' </td>
    </tr>';
        }
      ?>
  </tbody>
</table>

              
        </div>


      <div class="col-md-6" id="cont-det-actividades" >
        <div class="col-md-12" id="det_actividad" style="border: 1px solid #e8e8e8;">
          
        </div>
      </div>   
  </div><!-- /.row --> 
           
              
    </div>     
 </div>


   <!-- TRABAJOS -->

<div class="col-md-4">
  <div class="panel panel-default">
    <div class="panel-heading"> TRABAJOS </div>
    <div class="panel-body" style="padding: 5px 0px;">
     

        <?php
         $n=0;
         foreach($trabajos as $t){

              $tipo_trabajo[] = $t -> sctg_nombre;
              
            }
            $tipo_trabajo_unique = array_unique($tipo_trabajo);  
            //var_dump($data_unique);

            foreach ($tipo_trabajo_unique as $tt) {

                  echo' <div class="cont-trabajo">
                  <div class="col-md-3 titulo-trabajo">'.$tt.'</div>
      <div class="col-md-9">
          <ul>';
foreach($trabajos as $t){

  

    if( $t -> sctg_nombre == $tt){

  

          $id_work= $t -> tb_id;
                    $fun_work = $this -> model_actividades -> getDepWORK("".$id_work.""); 
                    //var_dump( $fun_work);
                    foreach($fun_work  as $fw){
                       echo'<li>'.$fw -> dep_nombre .'</li>' ;
                    }
                   
                    

    }
    # code...
  }

      echo' </ul>
        </div>
        </div>';

     
                    /*responsable*/
                    
                   /* if($t -> tb_tipo_responsable  == 1) {
                      $id_work= $t -> tb_id;
                    $fun_work = $this -> model_actividades -> getFuncionarioWORK("".$id_work.""); 
                    //var_dump( $fun_work);
                    foreach($fun_work  as $fw){
                       echo''.$fw -> nombre_fun.' '.$fw -> paterno.'</br>' ;
                    }

                    }*/
                    /*else {
                      
                      echo $t -> tb_responsable;
                      }*/
                
      }
       ?>
    </div>
  </div>
</div>

  <!--TURNOS personal stdio-->
<div class="col-md-3">
  <div class="panel panel-default">
    <div class="panel-heading"> TURNOS</div>
    <div class="panel-body panel-turnos">
   <H1>PERSONAL STADIO </H1>
      <?php 
      echo'<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Funcionario</th>
      <th scope="col">Turno</th>
    </tr>
  </thead>
  <tbody>';
   $i=0;
   foreach ($personal_stadio as $ps) {
    $turno = $ps -> turno;
      if (( $turno <> 4) && ( $turno <> 5) && ( $turno <> 14) && ( $turno <> 16)){
    $i++;
     echo'
    <tr>
      <th scope="row">'.$i.'</th>
      <td>'.substr($ps->nombre_fun,0,1).'. '.$ps->paterno.'<br></td>
      <td>'.$ps -> nom_turno.' </td>
     
    </tr>
    ';
  }
   }
 
    echo'
  </tbody>
</table>';

       ?>
<h1>GUARDIAS</h1>
     <?php 
      echo'<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Funcionario</th>
      <th scope="col">Turno</th>
    </tr>
  </thead>
  <tbody>';
   $i=0;
    foreach ($guardias as $g) {
      $turno = $g -> turno;
      if (( $turno <> 13) && ( $turno <> 15) && ( $turno <> 17)){
        $i++;
        echo'<tr>
        <th scope="row">'.$i.'</th>
        <td>'.substr($g->nombre_fun,0,1).'. '.$g->paterno.'<br></td>
        <td>'.$g -> nom_turno.' </td>
        </tr>';
      }
    }
 
    echo'
  </tbody>
</table>';

       ?>
    </div>
  </div>
</div>



  


      
    </div>
  </div>  
</div>






 

   
  <div class="row">
           <div id="turnos"></div>
           </div>   
                     <!-- *************************MODAL EDITAR ****************************-->
<div class="modal fade" id="myModalEditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Editar Actividad</h4>
        
      </div>
      <div class="modal-body">
      <?php echo form_open(base_url().'actividades/nueva/actualizar'); ?>
          <form role="form" method="post">

            <div class="row"><!--row categoria -->
              <!-- Categoria -->
              <div class="col-md-6">
                <label for="select">Categoria:</label>
                <select class="form-control input-sm" name="edit_categoria" id="edit_categoria">
                  <option value="0"> Selccionar </option>
                  <?php
                  foreach($categorias as $i){
                   echo ' <option value="'.$i->ctg_id.'" '.set_select("categoria",$i->ctg_id).'>'.$i->ctg_nombre.'</option>';
                  }
                  ?>
                </select>
              </div>
              <!-- Sub-Categoria -->
              <div class="col-md-6">
                <label for="select2">Sub-Categoria:</label>
                <select class="form-control input-sm" name="edit_subcategoria" id="edit_subcategoria">
                  <option value="0"> Selccionar </option>
                  <?php foreach($subcategorias as $sc){
                    echo ' <option value="'.$sc->sctg_id.'" '.set_select("categoria",$sc->sctg_id).'>'.$sc->sctg_nombre.'</option>';
                  }?>
                </select>
              </div>
              <!-- NOMBRE ACTIVIDAD EDITAR -->
              <div class="col-md-12">
            <label for="nomact_edit">Nombre Actividad:</label>
            <input class="form-control input-sm input-sm" type="text" name="nomact_edit" id="nomact_edit" value="">
          </div>
            </div><!-- /.row categoria -->
            <div class="row"> <!-- dependencias / fecha -->
              <!--IMPRIMO LAS DEPENDENCIAS-->
              <div class="col-md-12" id="dep_edit"></div>
              <!--Fecha:-->
              <div class="col-md-4">
                <label for="date">Fecha:</label>
                <input class="form-control input-sm input-sm" type="text" name="edit_fecha" id="edit_fecha" >
              </div>
              <!--Inicio (00:00):-->
              <div class="col-md-4">
                <label for="time">Inicio (00:00):</label>
                <input name="edit_inicio" type="time" placeholder="00:00" class="form-control input-sm w_fecha" id="edit_inicio" autocomplete="on">
              </div>
              <!--Termino (00:00)-->
              <div class="col-md-4">
                <label for="time2">Termino (00:00):</label>
                <input class="form-control input-sm w_fecha" type="time" placeholder="00:00" name="edit_termino"  id="edit_termino">
              </div>
        		</div>
            <div class="row">
              
              <div class="col-md-3">
                <label for="number">N° prsn:</label>
                <input class="form-control input-sm" type="number" min="0" name="edit_cantidad" id="edit_cantidad">
              </div>
              <div class="col-md-3">
                <label for="txt_socios">N° Socios:</label>
                <input class="form-control input-sm" type="number" name="edit_socios" id="edit_socios" value="">
              </div>
            </div>
            <div class="row">
               <div class="col-md-6">
              <label for="empresa">Organiza</label>
              <select name="edit_organiza" id="edit_organiza" class="form-control input-sm">
               <option value="">Seleccionar</option>
               <option value="Stadio">Stadio</option>
               <option value="Scuola">Scuola</option>
               <option value="Instituto de Cultura">Instituto de Cultura</option>
               <option value="Tercero">Tercero</option>
              </select>
          </div>
          <div class="col-md-6 autocomplete">
            <label for="empresa">Empresa/Institución</label>
             <input id="edit_empresa" type="text" name="edit_empresa" class="form-control input-sm input-sm">
          </div>
              <div class="col-md-6">
                <label for="textfield">Responsable:</label>
                <input class="form-control input-sm" type="text" name="edit_responsable" id="edit_responsable">
              </div>
              <div class="col-md-6">
                <label for="txt_fono">Telefono:</label>
                <input class="form-control input-sm" type="text" name="edit_fono" id="edit_fono" value="">
              </div>
              <div class="col-md-6">
                <label for="edit_correo">Correo:</label>
                <input class="form-control input-sm" type="email" name="edit_correo" id="edit_correo" value="">
              </div>
               <div class="col-md-12">
                <label>Observaciones</label>
                <input class="form-control input-sm" name ="edit_observaciones" id="edit_observaciones">
              </div>
             <!--VARIBLE HIDDEN-->

             <input class="form-control input-sm" type="hidden" name="edit_id" id="edit_id"  >
             
              <!--************************** SE MUESTRAN LAS DEPENDICIAS **************************-->
        
            
                 </div>
                 
                 
                      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        
        
         </form> <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>
                
           

        </div><!-- /#page-wrapper -->
        

    <!-- /#wrapper -->

<script type="text/javascript">

/*An array containing all the country names in the world:*/
var responsable = [
   <?php 
    $responsable = $this -> model_actividades -> responsables(); 
    foreach ($responsable as $r) {
      echo'"'.$r -> act_responsable.'",';
    }
   ?>
];

var empresas = [
   <?php 
    $empresa = $this -> model_actividades -> empresas(); 
    foreach ($empresa as $e) {
      echo'"'.$e -> act_empresa.'",';
    }
   ?>
];

var telefonos = [
   <?php 
    $telefono = $this -> model_actividades -> telefonos(); 
    foreach ($telefono as $t) {
      echo'"'.$t -> act_fono.'",';
    }
   ?>
];


/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("txt_empresa"), empresas);
autocomplete(document.getElementById("txt_responsable"), responsable);
autocomplete(document.getElementById("txt_fono"), telefonos);








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
$("#txt_fecha").datepicker();
$("#txt_fecha_termino").datepicker();
$("#buscar_inicio").datepicker();
$("#buscar_termino").datepicker();

});

$(document).ready(function() {

$("#sel_organiza").change(function(){
  if(this.value == "Tercero"){ 
    $("#txt_empresa").attr("disabled", false);
  }else{
    $("#txt_empresa").attr("disabled", true);
  }
})

/************NOMBRE ACTIVIDAD**********/

$("#categoria").change(function(){
  if((this.value == "3")||(this.value == "4")||(this.value == "13")||(this.value == "22")||(this.value == "23")||(this.value == "24")){ 
    $("#txt_nomact").attr("disabled", false);
  }else{
    $("#txt_nomact").attr("disabled", true);
  }
})




	
	
$( "#edit_fecha" ).datepicker();
		
	
	/*	$("#txt_fecha").each(
		function(index, value) {
			$(this).change(cantidad_cambiada)
		}
	);*/
	
	
			$(".editar").click(function () {		 
            idact=$(this).attr('id');
            $.post("<?php  echo base_url()?>actividades/nueva/depact", {
			idact: idact}, function(data){
			 	$("#dep_edit").html(data);
				});   
		   });
   
    $("#save_cal").click(function () {     
            cal_id=$('#cal_id').val();
            cal_date=$('#cal_date').val();
            cal_inicio=$('#cal_inicio').val();
            cal_termino=$('#cal_termino').val();
            cal_desc=$('#cal_desc').val();

            $.post("<?php  echo base_url()?>actividades/nueva/new_calendarizacion", {
      cal_id: cal_id,cal_date:cal_date,cal_inicio:cal_inicio,cal_termino:cal_termino,cal_desc:cal_desc}, function(data){
        $("#tbl_calendarizacion").html(data);
        $(".div_calendar").html(data);
         $('input[type="time"]').val('');
          $('input[type="time"]').val('');
          $('#cal_desc').val('');
          $(".error").fadeOut(5000);
        });   
       });
   
	
	

});
/*funcion ajax que llena el combo dependiendo de la categoria seleccionada*/
$(document).ready(function(){
   $("#categoria").change(function () {
           $("#categoria option:selected").each(function () {
            micategoria=$('#categoria').val();
            $.post("<?php  echo base_url()?>actividades/nueva/fillsubcategorias", {
				 micategoria: micategoria}, function(data){
          $("#subcategoria").html(data);
          $("#segmentacion").empty(); //elimina todo dentro del div VACIA DOM

        });   


        });
   })
});
$(document).ready(function(){
   $("#edit_categoria").change(function () {
           $("#edit_categoria option:selected").each(function () {
            micategoria=$('#edit_categoria').val();
            $.post("<?php  echo base_url()?>actividades/nueva/fillsubcategorias", {
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
            $.post("<?php  echo base_url()?>actividades/nueva/filldependencias", {
				 categoriaDep: categoriaDep}, function(data){
            $("#dependencia").html(data);
            });            
        });
   })
});

$(document).ready(function(){
   $("#subcategoria").change(function () {
           $("#subcategoria option:selected").each(function () {
            subcategoria=$('#subcategoria').val();
            $.post("<?php  echo base_url()?>actividades/nueva/fillsegmentacion", {
         subcategoria: subcategoria}, function(data){
          $("#segmentacion").css('visibility', 'visible');
            $("#segmentacion").html(data);
            });            
        });
   })
});

$(document).ready(function(){
   $("#edit_categoria").change(function () {
           $("#edit_categoria option:selected").each(function () {
            categoriaDep=$('#edit_categoria').val();
            $.post("<?php  echo base_url()?>actividades/nueva/filldependencias", {
				 categoriaDep: categoriaDep}, function(data){
            $("#dep_edit").html(data);
            


            });            
        });
   })
});

/*funcion ajax de invento aer si funca */


//con esta funcion pasamos los paremtros a los text del modal.
selPersona = function(actividad,fecha,inicio,termino,responsable,cantidad,categoria,subcategoria,socios,fono,empresa,organiza,nomact,correo,id){
	$('#edit_observaciones').val(actividad);
	$('#edit_fecha').val(fecha);
	$('#edit_inicio').val(inicio);
	$('#edit_responsable').val(responsable);
	$('#edit_cantidad').val(cantidad);
	$('#edit_termino').val(termino);
	$("#edit_categoria").val(categoria);
	$("#edit_subcategoria").val(subcategoria);
  $("#edit_fono").val(fono);
  $("#edit_socios").val(socios);
	$("#edit_id").val(id);
  $("#edit_organiza").val(organiza);
  $("#nomact_edit").val(nomact);
  $("#edit_empresa").val(empresa);
  $("#edit_correo").val(correo);


  /************************************************/
  /*muestro el dato del id del hidden*/
  //console.log($("#edit_id").val());
  id_actividad_v=$('#edit_id').val();
      $.post("<?php  echo base_url()?>actividades/nueva/consulta_dependencias", {
      id_actividad_v: id_actividad_v
         }, function(data){
          $("#dep_edit").html(data);
           $('#example').DataTable();
      
            }); 
  //jQuery('#dep_edit').append('<p><strong>mensaje de prueba</strong></p>');

};

modalcalendarizacion = function(id){$("#cal_id").val(id);};

 function showperiodo() {
        element = document.getElementById("div_periodo");
        check = document.getElementById("periodo");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }

     function showdias() {
        dias = document.getElementById("div_dias");
        periodo = document.getElementById("div_periodo");
        termino_rept = document.getElementById("div_termino_rept");
        termino = document.getElementById("div_termino");

        check = document.getElementById("reiterativo");
        if (check.checked) {
            dias.style.display='block';
            periodo.style.display='block';
            termino_rept.style.display='block';
            termino.style.display='none';
        }
        else {
            dias.style.display='none';
            periodo.style.display='none';
             termino_rept.style.display='none';
             termino.style.display='block';
        }
    }
	
jQuery(document).ready(function($) {	

$("#nuevo").click(function () {
	$('#myModal').modal('show');
});
	});	



	
	jQuery(document).ready(function($) {	
$("#buscar_rango").click(function () {
      $("#div-buscar").each(function() {/*
        visible = $(this).css("visibility");
        if(visible == "visible") {
          $(this).fadeOut('slow',function() {
           $(this).css({"display":"block","visibility":"hidden"});
          });
        } else {
          $(this).fadeIn('slow',function() {
            $(this).css("visibility","visible");
          });
        }
      */
	  
	   display = $(this).css("display");
        if(display == "block") {
          $(this).fadeOut('slow',function() {
           $(this).css({"display":"none"});
          });
        } else {
          $(this).fadeIn('slow',function() {
            $(this).css("display","block");
          });
        }
	  
	  });
    });
	});	
	
$("input[id=buscar]").click(function(){
		/*alert('Evento click sobre un input text con id="nombre2"');*/
		 inicio=$('#buscar_inicio').val();
		 termino=$('#buscar_termino').val();
            $.post("<?php  echo base_url()?>actividades/nueva/activFechaRango", {
				 inicio: inicio,
				 termino: termino				 
				 }, function(data){
					$("#activ_fechas").html(data);
					 $('#example').DataTable();
			
            }); 
	});

	
  function generar_reporte_excel(){
	   document.getElementById("frmExcel").submit();
	   }
     $("a[id=pdf]").click(function(){
		/*alert('Evento click sobre un input text con id="nombre2"');*/
		 inicio=$('#buscar_inicio').val();
		 termino=$('#buscar_termino').val();
		 url =  "<?php echo base_url(); ?>actividades/nueva/topdf/"+inicio+"/"+termino;
      window.open(url, '_blank');
			
	});
	   


$(document).ready(function(){
   $("#txt_termino").change(function () { 
   termino=$('#txt_fecha_termino').val();
   inicio=$('#txt_fecha').val();
   hr_inicio=$('#txt_inicio').val();
   hr_termino=$('#txt_termino').val();
   $.post("<?php echo base_url()?>actividades/nueva/fechas_actividad", {
         inicio: inicio,
         termino: termino,
         hr_inicio: hr_inicio,
         hr_termino: hr_termino        
         }, function(data){
          $("#div_calendario").html(data);
        });          
        
   })

$('#table_actividades tr').click(function() {
    $('#table_actividades tr').removeClass('highlighted');
    $(this).addClass('highlighted');
});


$(".cont-actividades").click(function(){
  id =  $(this).attr('id');
  fecha_sel = $("#txt_fechasel").val();
  //$("#select_actividad").animate({width: '100%'}, "slow");
  $("#cont-actividades").css("background-color", "#000000");
  $("#cont_list_actividades").removeClass("col-md-12").addClass("col-md-6");
  $("#cont-det-actividades").show();
  //alert("fecha" + fecha_sel);
  $.post("<?php echo base_url()?>actividades/nueva/detalle_actividad", {id: id,fecha_sel:fecha_sel},
    function(data){
          $("#det_actividad").html(data);
          $("#new_calendar").click(function () {
              $('#modal_calendar').modal('show');
          });
          // ficha tecnica dependencias
          $(".print").click(function(){
          id =  $(this).attr('id');
            url =  "<?php echo base_url(); ?>actividades/nueva/ft_actividad/"+id;
            window.open(url, '_blank');
          });
    }); 
})



});


	
</script>


