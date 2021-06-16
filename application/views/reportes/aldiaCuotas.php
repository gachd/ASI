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

#mitabla {border: 1px solid #000; border-collapse: collapse;text-transform: uppercase;width: 100%;}
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
   font-size: 12px;
 }
 #apellidop
 {
  text-align: left;
 }
  #apellidom
 {
  text-align: left;
 }


  #nombres{
  text-align: left;
 }
</style>



<?php 
$ci = &get_instance();
$ci->load->model('model_socios');
setlocale(LC_ALL, 'es_ES').': ';	

$hoy = date("Y-m-d H:i:s");
$hooy = date("d-m-Y");
$ayer = '16-06-2020';
//$ultimo = date('d-m-Y', '17-06-2020');

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
              <td colspan="2"><h2>Informe de Socios al día</h2></td> 
              <td></td>             
            </tr>
            <tr><td></td><td></td><td></td></tr>
            <tr>
              <td align="left" colspan="2"><?php echo 'Actualización de cuotas al '.$ayer; ?></td>
              <td  align="right" colspan="2" >Cuota actual <strong>2020-1</strong></td>
            </tr>
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
            <th>RUT</th>
            <th>APELLIDO PATERNO</th>
            <th>APELLIDO MATERNO</th>
            <th>NOMBRES</th>           
            <th>ÚLTIMO PAGO</th>
            <th>TOTAL PAGADO</th>
          
          </tr>
          </thead>
          <tbody>
            <?php
            $cont = 1;
             foreach ($activos as $a) {
               echo '<tr class="odd gradeX">';
               (string) $rut = $a->prsn_rut;  
                    $ult_pago = $this->model_socios->ultima_cuota($rut);
                foreach ($ult_pago as $u) {
                  if($u->ano == 2020 && $u->semestre == 1){
                        echo '<td>'.$cont.'</td>';
                        echo '<td >' . $a->prsn_rut . '</td>';                          
                        echo '<td id="apellidop">' . $a->prsn_apellidopaterno . '</td>';
                        echo '<td id="apellidom">' . $a->prsn_apellidomaterno . '</td>';
                        echo '<td id="nombres">' . $a->prsn_nombres . '</td>';
                        echo '<td>'.$u->ano.'-'.$u->semestre.'</td>';
                         $total = $this->model_socios->pagadoSocio($rut);
                        echo '<td>$' . $total . '</td>';
                        $cont++;
                  }
                 
                    echo '</tr>';
                    
              }
            }
             ?>
          </tbody>
        </table>     
        </div>
            </div>







