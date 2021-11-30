<?php

foreach ($cargasSocios as $cs) {

  $parent = $cs->s_parentesco_pt_id;

  $parent_nom = $cs->pt_nombre;

  $nombre = $cs->prsn_nombres;

  $paterno = $cs->prsn_apellidopaterno;

  $materno = $cs->prsn_apellidomaterno;

  $sexo = $cs->prsn_sexo;

  $nac = $cs->prsn_fechanacimi;

  $celu = $cs->prsn_fono_movil;

  $mail = $cs->prsn_email;

  $est = $cs->estudiante;

  $cert = $cs->certificado;

  $estado = $cs->estado_carga;



  if ($estado == 0) {

    $estado_nom = 'ACTIVO';

    $estado2 = 1;

    $estado_nom2 = 'INACTIVO';
  } else {

    $estado_nom = 'INACTIVO';

    $estado_nom2 = 'ACTIVO';

    $estado2 = 0;
  }





  if ($est == 1) {

    $estudia = 'SI';

    $estudia2 = 'NO';

    $est2 = 0;
  } else {

    $estudia = 'NO';

    $estudia2 = 'SI';

    $est2 = 1;
  }





  if ($sexo == 1) {

    $sexo_nom = 'MASCULINO';

    $sexo2 = 0;

    $sexo2_nom = 'FEMENINO';
  } else {

    $sexo_nom = 'FEMENINO';

    $sexo2 = 1;

    $sexo2_nom = 'MASCULINO';
  }
}



?>

<div class="col-md-6 col-sm-6 col-xs-12">

  <div class="panel panel-default">

    <div class="panel-body">

      <form class="form-horizontal">

        <div class="form-group">

          <div class="col-sm-12">

            <label id="nomCarga"><?php echo $nombre . ' ' . $paterno . ' ' . $materno ?></label>

          </div>

        </div>

        <div class="form-group">

          <div class="col-sm-6">

            <label id="datosCarga">RUT: <?php echo $rutCarga ?></label>

          </div>

          <div class="col-sm-6">

            <label id="datosCarga">PARENTESCO: <?php echo $parent_nom ?></label>

          </div>

        </div>

        <div class="form-group">

          <div class="col-sm-6">

            <label id="datosCarga">NACIMIENTO: <?php echo $nac ?></label>

          </div>

          <div class="col-sm-6">

            <label id="datosCarga">GÉNERO: <?php echo $sexo_nom ?></label>

          </div>

        </div>

        <div class="form-group">

          <div class="col-sm-6">

            <label id="datosCarga">CELULAR: <?php echo $celu ?></label>

          </div>

          <div class="col-sm-6">

            <label id="datosCarga">EMAIL: <?php echo $mail ?></label>

          </div>

        </div>

        <div class="form-group">

          <div class="col-sm-6">

            <label id="datosCarga">ESTUDIANTE: <?php echo $estudia ?></label>

          </div>

        </div>







      </form>

    </div>

  </div>

</div>
</div>



<div class="col-md-6 col-sm-6 col-xs-12">

  <div class="panel panel-default">

    <div class="panel-body">

      <form class="form-horizontal">

        <div class="form-inline">

          <div class="col-sm-4">

            <label>ESTADO</label>

          </div>

          <select class="form-control" name="est_carga" id="est_carga">

            <option value="<?php echo $estado; ?>"><?php echo $estado_nom; ?></option>

            <option value="<?php echo $estado2; ?>"><?php echo $estado_nom2; ?></option>

          </select>

        </div>

        <div class="form-inline">

          <div class="col-sm-4">

            <label>OBSERVACIONES</label>

          </div>

          <textarea id="obs_estado" rows="10" cols="50" class="form-control"></textarea>

          <input type="hidden" name="rutCarga" id="rutCarga" value="<?php echo $rutCarga ?>">

        </div>



      </form>

      <script type="text/javascript">
        $(document).ready(function() {

          var btnGuardar = $("#bajaCarg");

          btnGuardar.click(function() {

            

            var rutCarga = $("#rutCarga").val();

            var estCarga = $("#est_carga option:selected").val();

            var obs = $("#obs_estado").val();

            var formData = new FormData();





            //Ojo: el nombre del campo del formulario debe ser igual al nombre del campo en PHP

            formData.append('rutCarga', rutCarga);

            formData.append('estado', estCarga);

            formData.append('obs', obs);

            //console.log(formData);

            // formData.append('rut', )

            $.ajax({

              url: "<?php echo base_url() ?>socios/bajacarga/baja_carga",

              data: formData,

              type: 'POST',

              contentType: false,

              processData: false,

              success: function(resultados) {


                swal({
                    title: "Actualizado!",
                    text: "Se ha dado de baja con exito!",
                    icon: "success",
                    buttons: {

                      OK: true,
                    },
                  })
                  .then((ok) => {

                    if (ok) {

                      window.location.href = '<?php echo base_url() ?>socios/Bajacarga'

                    } else {
                      window.location.href = '<?php echo base_url() ?>socios/Bajacarga'

                    }

                  });





              },
              error: function(resultados) {


                swal({
                    title: "Error!!",
                    text: "No se pudo cargar la información!",
                    icon: "error",
                    buttons: {

                      OK: true,
                    },
                  })
                  .then((ok) => {

                    if (ok) {

                      window.location.href = '<?php echo base_url() ?>socios/Bajacarga'

                    } else {
                      window.location.href = '<?php echo base_url() ?>socios/Bajacarga'

                    }

                  });


              }



            });



          });

        });





        //});
      </script>