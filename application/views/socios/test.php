<?php

$this->load->model('model_test');

function getSexo($sexo)
{

  if ($sexo == 1) {
    return ("Masculino");
  }
  if ($sexo == 0) {
    return ("Femenino");
  }
}

function getPuntosRut($rut)
{

  $rutTmp = explode("-", $rut);

  return number_format($rutTmp[0], 0, "", ".") . '-' . $rutTmp[1];
}

function getParentestco($id)
{

  if ($id == 1) {
    return ("CONYUGE");
  }
  if ($id == 2) {
    return ("HIJO/A");
  }
  if ($id == 3) {
    return ("PADRE");
  }
  if ($id == 4) {
    return ("MADRE");
  }
  if ($id == 5) {
    return ("HIJASTRO");
  }
  if ($id == 6) {
    return ("OTRO FAMILIAR");
  }
}


?>

<div class="main">


  <div class="container">
    <h1 class="h1">Socios</h1>
    <div class="row" style="padding-top: 15px;">
      <table class="table table-striped table-bordered">
        <tr>

          <th>Rut</th>
          <th>Nombre</th>
          <th>Edad</th>
          <th>Sexo</th>

        </tr>
        <?php foreach ($socios as $s) : ?>

          <tr>


            <td><?php echo getPuntosRut($s->prsn_rut) ?></td>
            <td><?php echo $s->prsn_nombres . " " . $s->prsn_apellidopaterno . " " . $s->prsn_apellidomaterno ?></td>
            <td><?php echo $s->edad ?></td>
            <td><?php echo getSexo($s->prsn_sexo) ?></td>
            

          </tr>
        <?php endforeach ?>


      </table>

    </div>
  </div>
  <div class="container">
    <h1 class="h1">Cargas</h1>
    <div class="row" style="padding-top: 15px;">
      <table class="table table-striped table-bordered">
        <tr>

          <th>Rut</th>
          <th>Nombre</th>
          <th>Edad</th>
          <th>Sexo</th>
          <th>Socio</th>
          <th>Parentesco</th>

        </tr>
        <?php foreach ($cargas as $s) : ?>

          <tr>


            <td><?php echo getPuntosRut($s->rut_carga) ?></td>
            <td><?php echo $s->prsn_nombres . " " . $s->prsn_apellidopaterno . " " . $s->prsn_apellidomaterno ?></td>
            <td><?php echo $s->edad ?></td>
            <td><?php echo getSexo($s->prsn_sexo) ?></td>
            <td><?php echo getPuntosRut($s->rut_socio) ?></td>
            <td><?php echo getParentestco($s->s_parentesco_pt_id) ?></td> 
          
          </tr>

          <?php endforeach ?>


      </table>

    </div>
  </div>





</div>


<script type="text/javascript">



</script>