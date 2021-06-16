<style>
td, th {
    padding: 5px;
    font-family: monospace;
    font-size: 12px;
    text-transform: uppercase;
    text-align: center;
}
.td-cont-totales {    vertical-align: top;
    padding: 15px;}
.tbl-segmentacion td{text-align: left;}

.titulo-doc{font-size: 24px;
    letter-spacing: 2px;
    font-weight: 600;}

.subtitulo-doc{font-size: 14px;
    letter-spacing: 1px;
    border-bottom: 1px solid #ccc;
    padding-bottom: 7px;
    width: 90%;
}

.texto{font-family: monospace;
    text-transform: inherit;
    font-size: 16px;
}
/*.td-list td{font-size: 11px;}*/

#mitabla {border: 1px solid #000; border-collapse: collapse;text-transform: uppercase;}
#mitabla  td  {
    border: 1px solid #000;
    min-width: 0.6em;
    padding: 3px;
    vertical-align: middle;
    text-transform: uppercase;
   font-size: 10px;}
#mitabla  th  {
    border: 1px solid #000;
    min-width: 0.6em;
    padding: 3px;
    vertical-align: middle;
    text-transform: uppercase;
   font-size: 12px;}
</style>



<?php 
$ci = &get_instance();
$ci->load->model('model_socios');
setlocale(LC_ALL, 'es_ES').': ';	

$hoy = date("Y-m-d H:i:s");
$hooy = date("d-m-Y");

function getPuntosRut( $rut ){

  $rutTmp = explode( "-", $rut );

  return number_format( $rutTmp[0], 0, "", ".") . '-' . $rutTmp[1];

  } 
?>
<div class="panel-heading">
              <div class="panel-title">
                 <table width="100%" border="0">
          <tbody>
            <tr>
              <td width="15%" rowspan="2" align="left" style="padding-bottom:15px;"><img src="<?php echo base_url(); ?>/assets/images/logo_instituciones_mini.png" width="130" style="margin-right:25px;"/></td>
              <td colspan="2"><h2>LISTADO DE SOCIOS ACTIVOS CON DEUDA</h2></td> 
              <td></td>             
            </tr>
            <tr><td></td><td></td><td></td></tr>
            <tr><td align="left" colspan="2"><?php echo 'Registro de socios activos al '.$hooy; ?></td></tr>
          </tbody>
        </table>
              </div>
            </div>
            <div class="panel-body">
              <div class="table-responsive">
              <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="mitabla">
            <thead>
              <tr>
                <th>#</th>
                <th >Rut</th>
                <th >Nombre</th>
                <th >Apellido Paterno</th>
                <th >Apellido Materno</th> 
                <th >Tipo Socio</th>              
                <th >Centro</th>
                <th >Atletico</th>
                <th >Concordia</th>
                <th >Stadio</th>
                <th >Scuola</th>
                <th >Cuota Social</th>

              </tr>
            </thead>
            <tbody>
            <?php   if(!empty($socios)){
              $corp = [];
              $cont = 0;
                          $corp[0] = '70331500-3';
                          $corp[1] = '71888800-k';
                          $corp[2] = '72265900-7';
                          $corp[3] = '65106820-7';
                          $corp[4] = '65467840-5';
                            
                                foreach ($socios as $s) {
                                  (string)$rut = $s-> prsn_rut;
                                  $saldo = $this -> model_socios -> saldoSocio($rut);
                                  if($saldo != 0){
                                  $cont = $cont + 1;

                                  echo '<tr class="odd gradeX">';
                                  echo '<td>'.$cont.'</td>';
                                  echo '<td><div class="col-md-7">'.getPuntosRut($s-> prsn_rut).'</div><div class="col-md-4"><a  href="'.base_url().'/socios/ficha/detalle/'.$s-> prsn_rut.'"><span class="ico badge badge-info"><i class="glyphicon glyphicon-search"></i></span></a></div></td>';
                                  echo '<td>'.$s-> prsn_nombres.'</td>';
                                  echo '<td>'.$s-> prsn_apellidopaterno.'</td>';
                                  echo '<td>'.$s-> prsn_apellidomaterno.'</td>';
                                  if(($s-> tipo_id == 3) || ($s-> tipo_id == 2)){
                                    $tiposocio = 1;
                                    echo '<td><center><img title="Honorario" src="'. base_url().'assets/images/honorario.png"></center></td>';
                                  }else{
                                    $tiposocio = 0;
                                    echo '<td><center><img  src="'. base_url().'assets/images/socio_activo.png"></center></td>';
                                  }
                          
                          
                          
                         for($i = 0 ; $i < 5 ; $i++){
                         $corpora = $this -> model_socios -> socio_corp($rut,$corp[$i]);
                           if(!empty($corpora)){
                            $estado = 1;
                            echo '<td><center><img  src="'. base_url().'assets/images/check.png"></center></td>';
                           }else{
                            $estado = 0;
                             echo '<td><center><img  src="'. base_url().'assets/images/nocheck.png"></center></td>';
                           }
                         }
                         

                         if($tiposocio == 1){
                          echo '<td><center><span class="label label-primary">Exento de pago</span></center></td>';
                         }else{

                          $saldo = $this -> model_socios -> saldoSocio($rut);
                              $nuevorut = explode("-", $rut);
                          
                            if($saldo > 0){
                              echo '<td><center><a class="button" href="'.base_url().'/socios/socios/detallePagos/'.$rut.'"><span class="label label-danger">$'.$saldo.'</span></a></center></td>';
                            } else{
                              echo '<td><center><a class="button" href="'.base_url().'/socios/socios/detallePagos/'.$rut.'"><span class="label label-success">$0</span></a></center></td>';
                            }                           
                           
                         }
                           
                         
                                  
                                  echo '</tr>';

                                }
                              }
            }
                                  ?>              
                        
            </tbody>
          </table>          
        </div>
            </div>







