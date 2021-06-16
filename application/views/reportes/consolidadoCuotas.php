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
 #apellidos{
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
              <td colspan="2"><h2>Informe Cuotas Socios</h2></td> 
              <td></td>             
            </tr>
            <tr><td></td><td></td><td></td></tr>
            <tr>
              <td align="left" colspan="2"><?php echo 'Actualización de cuotas al '.$ayer; ?></td>
              <td  align="right" colspan="2" >Última cuota asignada <strong>2020-2</strong></td>
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
            <th>NOMBRES</th>
            <th>APELLIDOS</th>
            <th>ULTIMO PAGO</th>
            <th>DEUDA TOTAL</th>
          </tr>
          </thead>
          <tbody>
            <?php
            $cont = 1;
             foreach ($activos as $a) {
               (string) $rut = $a->prsn_rut;
              echo '<tr class="odd gradeX">';
                        echo '<td>'.$cont.'</td>';$cont++;
                        echo '<td >' . $a->prsn_rut . '</td>';  
                        echo '<td id="nombres">' . $a->prsn_nombres . '</td>';
                        echo '<td id="apellidos">' . $a->prsn_apellidopaterno . ' ' . $a->prsn_apellidomaterno . '</td>';

                         $ult_pago = $this->model_socios->ultima_cuota($rut);

                          foreach ($ult_pago as $u) {

                            echo '<td style="color:#043596;font-weight: bold;font-family: Arial;"><center>' . $u->ano . '-' . $u->semestre . '</center></td>';
                          }

                         $saldo = $this->model_socios->saldoSocio($rut);

                         

                          if ($saldo > 0) {

                            echo '<td>$' . $saldo . '</td>';
                          } else {

                            echo '<td>$0</td>';
                          }
                     echo '</tr>';

              }
             ?>
          </tbody>
        </table>     
        </div>
            </div>







