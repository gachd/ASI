<style type="text/css">
	
	table{font-size: 10px;}

 #funDiv,#extDiv	{ display: none; }
 .panel-heading{ text-transform: uppercase; }

</style>
<div class="main">
    <?php echo form_open(base_url().'trabajos/chek_trabajos/guardar');?>
    <nav class="navbar navbar-default nav-titulo">
        <div class="col-md-3">
            <h1 style="text-align:center;">CHEK TRABAJOSL</h1>
        </div>
        <div class="col-md-3">
            <input type="date" id="txt_fecha" name="txt_fecha" value="<?php echo $fecha ;?>">
        </div>
   </nav>
	<div class="col-md-12" id="trabajos_fechas">
		

		          <?php

                $funcionario = $this -> model_trabajos->funcionarios_stadio();
        $trabajos = $this -> model_trabajos->trabajos_fecha($fecha);
        setlocale(LC_ALL, 'es_ES').': ';
        echo'<div class="panel panel-default">
            <div class="panel-heading">

                  

            '.iconv('ISO-8859-1', 'UTF-8', strftime('%A %d de %B de %Y',  strtotime("".$fecha.""))).'
            </div>
            <div class="panel-body" >

        <div class="table-responsive"> 
                    <table class="table table-responsive">
                    <thead>
                        <tr>
                    
                            <th>Trabajo</th>
                            <th>Dependencia</th>
                            <th>Realizado<br><label><input type="checkbox" id="checkTodos" />Marcar/Desmarcar Todos</label></th>
                            <th>Responsable</th>
                            <th>Observaciones</th>
                        </tr>
                    </thead>
                    <tbody>';

                    foreach ($trabajos as $t) {

                        $tb_id = $t -> tb_id;
                              $tb_estado = $t -> tb_estado;

                        echo'<tr>

                        <td>'.$t-> sctg_nombre.'</td>

                        <td>';
                        $dependencia = $this -> model_trabajos->getDepWORK($t -> tb_id);

                        foreach ($dependencia as $d) {

                            echo $d -> dep_nombre;
                            # code...
                        }

                              $checked="";
                              if($tb_estado==1){
                                    $checked="checked";
                              }

                        echo'</td>
                            <td> <input class="realizado" type="checkbox" name="chek'.$tb_id.'" value="1" '.$checked.'></td>
                        
                        <td><!--RESPONSABLE-->
                            
                            <div>
                            <table width="100%" border="0" style="font-size: 9px;">
                            <tbody>
                            <tr>';
                            $x=1;
                            foreach($funcionario as $i){
                                          $rut = $i->rut;
                                          $checked_fun="";

                                          $fun_tb= $this-> model_trabajos ->fun_realiza_tb($rut,$tb_id);
                                          if (!empty($fun_tb)) {
                                                 $checked_fun="checked";
                                          }


                                echo'<td style="vertical-align: middle;text-transform: capitalize;text-align: center;">
                                <label><input type="checkbox" name="'.$tb_id.'fun[]"  value="'.$i->rut.'" style="margin-right:5px;" '.$checked_fun.'> '.$i->paterno.'</label>
                                </td>';
                                /*if(4==$x){
                                    echo" </tr>";
                                    $x=0;
                                }*/
                                $x++;
                            }
                            echo'</tr></tbody></table>
                          
                            </div>
                        </td>';


                        echo'
                        
                        <td><textarea name="desc'.$tb_id.'" id="" cols="30" rows="10" style="    height: 40px;"></textarea></td>
                        

                        </tr>';
                        # code...
                    }

                    echo'</tbody>
                    </table>
                    <input type="submit" name="submit" id="submit" value="Guardar" class="btn btn-success">
                    </div>
                      </div>
                  </div>
            </div';

                  
                ?>
            
     <?php echo form_close(); ?>
</div>

<script>


	$('.responsable').change(function(){
    var valorCambiado =$(this).val();
    if(valorCambiado == '2'){
       $('#extDiv').css('display','block');
       $('#funDiv').css('display','none');
     }
     else if(valorCambiado == '1')
     {
        $('#extDiv').css('display','none');
       $('#funDiv').css('display','block');
     }
});


$(document).ready(function() {
	$("#txt_fecha").each(
		function(index, value) {
			$(this).change(fecha)
		}
	);


     $("#checkTodos").change(function () {
      $(".realizado").prop('checked', $(this).prop("checked"));
  });
});
 
function fecha(){
	/*alert("Me han llamado desde el campo: " + $("#txt_fecha").val());*/
	txt_fecha=$('#txt_fecha').val();
    $.post("<?php  echo base_url()?>trabajos/chek_trabajos/trabajos_fecha", {txt_fecha: txt_fecha}, function(data){
            $("#trabajos_fechas").html(data);
             $("#checkTodos").change(function () {
      $(".realizado").prop('checked', $(this).prop("checked"));
  });
    });            
}
</script>