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
//$ci->load->model("menu_model");

$ci->load->model('model_socios');

setlocale(LC_ALL, 'es_ES').': ';	
$fecha1 = $inicio;

$hoy = date("Y-m-d H:i:s"); 

function getPuntosRut( $rut ){

  $rutTmp = explode( "-", $rut );

  return number_format( $rutTmp[0], 0, "", ".") . '-' . $rutTmp[1];

  } 
$agendas = $this -> model_socios -> date_agenda ($fecha1);
$agenda_externo = $this -> model_socios -> date_agenda_externo ($fecha1);
?>
<div class="panel-heading">
              <div class="panel-title">
                 <table width="100%" border="0">
          <tbody>
            <tr>
              <td width="15%" rowspan="2" align="left" style="padding-bottom:15px;"><img src="<?php echo base_url(); ?>/assets/images/logo_instituciones_mini.png" width="130" style="margin-right:25px;"/></td>
              <td colspan="2"><h2>Listado de socios agendados</h2></td> 
              <td></td>             
            </tr>
            <tr><td></td><td></td><td></td></tr>
            <tr>
            <td  align="center" colspan="4" ><h2>Día <strong><?php echo $fecha1 ?></strong></h2></td>
              <td ></td>
            
            </tr>
          </tbody>
         </table>
              </div>
            </div>

            <div class="panel-body" style="margin-top:30px;">
              <div class="table-responsive">
       <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="mitabla">
          <thead>
            <tr>
         
            <th>RUT</th>
            <th>NOMBRES</th>  
            <th>APELLIDO PATERNO</th>
            <th>APELLIDO MATERNO</th> 
            <th>TIPO</th>
            <th>SECTOR</th>
            <th>HORA INGRESO</th>
            <th>TEMPERATURA</th>
            <th>HORA SALIDA</th>
          
          </tr>
          </thead>
          <tbody>
              <?php 
                $paso = 1;
                foreach ($agendas as $value) {
               
                    echo'<tr>';
                    echo'<td>' .$value ->rut_socio.'</td>';
                    echo'<td>' .$value ->nombres.'</td>';
                    echo'<td>' .$value ->paterno.'</td>';
                    echo'<td>' .$value ->materno.'</td>';
                    echo'<td>Socio</td>';
                    echo'<td>' .$value ->sector.'</td>';
                  
                    echo'<td></td>';
                    echo'<td></td>';
                    echo'<td></td>';
                    echo'</tr>';

                    if($value -> invitados != 0 ){
                        $visita = $value -> id_visita;
                        $cargas = $this -> model_socios -> cargas_visita ($visita);

                        foreach ($cargas as $index) {
                            echo'<tr>';
                            echo'<td>' .$index ->rut_carga.'</td>';
                            echo'<td>' .$index ->nomb_carga.'</td>';
                            echo'<td>' .$index ->paterno_carga.'</td>';
                            echo'<td>' .$index ->materno_carga.'</td>';
                            echo'<td>Carga</td>';
                            echo'<td>' .$value ->sector.'</td>';
                        
                            echo'<td></td>';
                            echo'<td></td>';
                            echo'<td></td>';
                            echo'</tr>';
                        }
                    }
                   

                                      


                }
                foreach ($agenda_externo as $value) {
               
                  echo'<tr>';
                  echo'<td>' .$value ->rut_externo.'</td>';
                  echo'<td>' .$value ->nombres.'</td>';
                  echo'<td>' .$value ->paterno.'</td>';
                  echo'<td>' .$value ->materno.'</td>';
                  echo'<td>Club Aguilas de la Concepción</td>';
                  echo'<td>' .$value ->sector.'</td>';
                
                  echo'<td></td>';
                  echo'<td></td>';
                  echo'<td></td>';
                  echo'</tr>';

              }
              ?>
           
          </tbody>
        </table>     
        </div>
            </div>







