
<style>#example{ text-transform:uppercase;}</style>
<div id="page-wrapper">
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nuevo Incidente</h4>
      </div>
      <div class="modal-body">
            <?php 
    /*print_r($this->session->all_userdata());*/
    echo form_open(base_url().'trabajos/report_diarios/newincident'); ?>
     <?php echo validation_errors(); ?>
                         <form role="form" >
       <div class="col-md-6"><label for="select">Sector:</label>
            <select class="form-control" name="sector" id="sector">
             <option value="0"> Selccionar </option>
             <?php foreach($sector as $s){
                echo'<option value="'.$s->id.'"> '.$s->nombre.' </option>';
                 }?>
            </select></div>
            <div class="col-md-6"><label for="select2">Dependencia:</label>
            <select class="form-control" name="depen" id="depen">
            <option value="0"> Selccionar </option>
            </select></div>
            <div class="col-md-6"><label for="categoria">Categoria:</label>
            <select class="form-control" name="categoria" id="categoria">
            <?php foreach($categoria as $c){
                echo'<option value="'.$c->rc_id.'"> '.$c->rc_nombre.' </option>';
                 }?>
            </select></div>
            <div class="col-md-6"><label for="prioridad">Prioridad:</label>
            <select class="form-control" name="prioridad" id="prioridad">
            <?php foreach($prioridad as $p){
                echo'<option value="'.$p->rp_id.'"> '.$p->rp_nombre.' </option>';
                 }?>
            </select></div>
            <div class="col-md-12"><textarea style="width:100%; min-height:160px; margin-top:15px;" name="descripcion"></textarea></div>
            <?php echo form_close(); ?>
                           </form>
                  </div>
      <div class="modal-footer">
       <input type="submit" name="submit" id="submit" value="Guardar" class="btn btn-success"> &nbsp;
       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- Container -->
<div class="container-fluid">
 <div class="col-md-12">
    
     <h1 style="text-align:center;">Reporte de Incidentes</h1>
     <div class="panel panel-default">
                         
       <div class="panel-body">
           <button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#myModal" style="    float: right;
    margin: 15px;">  <span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span>
Nuevo</button>
           <div class="col-md-12">
                       <div class="table-responsive" >
                                     
                                     <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                            <th>Fecha</th>
                                            <th>Funcionario</th>
                                            <th>Categoria</th>
                                            <th>Sector</th>
                                            <th>Dependencia</th>
                                            <th>Descripción</th>
                                            <th>Estado</th>
                                            <th>Prioridad</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($incidentes as $i){
                                        
                                        $date_report = date('d/m/y H:i', strtotime($i->ri_fecha_report));
                                        
                $fun= $this -> model_report -> getFunID($i -> ri_usuario);							
                            foreach($fun as $f ){
                                $fun_nombre=$f -> nombre_fun;
                                $fun_paterno=$f -> paterno;
                            }
                
                                        
                $depend= $this -> model_report -> getDepenID($i -> ri_dep);							
                            foreach($depend as $d ){
                                $dependencia=$d -> dep_nombre;
                            }	
                                        
                $catg= $this -> model_report -> getCategoriaID($i -> ri_categoria);							
                            foreach($catg as $c ){
                                $categoria=$c -> rc_nombre;
                            }	
                $priori= $this -> model_report -> getPrioridadID($i -> ri_prioridad);							
                            foreach($priori as $p ){
                                $prioridad=$p -> rp_nombre;
                            }	
                            
                            if($i -> ri_estado == 0 ){$estado='<span class="label label-success">Abierto</span>';} else {$estado='<span class="label label-default">Cerrado</span>
    ';}		  		
                        
                        switch ($i -> ri_prioridad) {
        case "1":
            $color="info";
            break;
        case "2":
            $color="warning";
            break;
        case "3":
            $color="danger";
            break;
    }
                                        
                echo'<tr class="clickable-row"  id="'.$i->ri_id.'">
				 
				 <td> '.$date_report.' </td>
                 <td>'.$fun_nombre.' '.substr($fun_paterno, 0, 1).'.</td>
                 <td>'.$categoria.'</td>
                 <td>'.$i->ri_sector.'</td>
                 <td>'.$dependencia.'</td>
                 <td>'.$i->ri_desc.'</td>
                 <td>'.$estado.'</td>
                 <td><span class="label label-'.$color.'">'.$prioridad.'</span></td>
                
                 </tr>
				 
                ';
                 }?>
                                    </tbody>
                                    </table>
                           </div>
                  </div>
       </div>
       
     </div>
           
 </div>
</div>

 <div id="modaldesc" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
     <!-- <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nuevo Incidente</h4>
      </div>-->
      <div class="modal-body">
            <div id="coment"></div>
                  </div>
     <!-- <div class="modal-footer">
       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
    </div>
   </div>
 </div>
<script>
$(document).ready(function(){

$("#sector").change(function () {
           $("#sector option:selected").each(function () {
            sector=$('#sector').val();
            $.post("<?php  echo base_url()?>trabajos/report_diarios/listdepen", {
				 sector: sector}, function(data){
            $("#depen").html(data);
            });            
        });
   });
   
   
    $('#example').DataTable();
   
});

jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        //window.location = $(this).data("href");
		 trid =  $(this).attr('id');
		  
		 $.post("<?php  echo base_url()?>trabajos/report_diarios/coment_report", {
				 trid: trid}, function(data){
            $("#coment").html(data);
            });  
		 
		$('#modaldesc').modal('show'); 
    });
});

</script>