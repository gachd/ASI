<div class="col-md-6 col-sm-6 col-xs-12 ">

  <div class="panel panel-default">

    <div class="panel-body ">

      <form class="form-horizontal">

        <div class="">

          <div class="form-group">

            <label>RUT</label>

            <input maxlength="10" type="text" id="rut_carga" class="form-control" value="<?php echo $rutCarga ?>" disabled>

            
            <label>PARENTESCO</label>

            <select class="form-control" name="parentesco" id="parentesco">

              <option value="<?php echo $parent ?>"><?php echo $parent_nom ?></option>

              <?php

              foreach ($parentesco as $i) {
                if ($parent != $i->pt_id) {

                  echo ' <option value="' . $i->pt_id . '" ' . set_select("parentesco", $i->pt_id) . '>' . $i->pt_nombre . '</option>';
                }
              } ?>

            </select>

          </div>

        </div>

        <div class="form-group">

          <label>NOMBRES</label>

          <input type="text" class="form-control" id="nombre_carga" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" value="<?php echo $nombre ?>">

          <span id="error3" style="display:none;color:red;">Nombre incorrecto</span>

        </div>



        <div class="form-group mx-sm-3">

          <label>APELLIDO PATERNO</label>

          <input type="text" class="form-control" id="pat_carga" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" value="<?php echo $paterno ?>">

          <span id="error4" style="display:none;color:red;">Apellido Paterno incorrecto</span>



        </div>





        <div class="form-group mx-sm-3">

          <label>APELLIDO MATERNO</label>

          <input type="text" class="form-control" id="mat_carga" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" value="<?php echo $materno ?>">

          <span id="error5" style="display:none;color:red;">Apellido Materno incorrecto</span>

      </form>

    </div>

  </div>

</div>
</div>



<div class="col-md-6 col-sm-6 col-xs-12">

  <div class="panel panel-default">

    <div class="panel-body">

      <form class="form-horizontal">



        <div class="form-group">

          <label>SEXO</label>

          <select class="form-control" name="sexo_carga" id="sexo_carga">

            <option value="<?php echo $sexo ?>"><?php echo $sexo_nom ?></option>

            <option value="<?php echo $sexo2 ?>"><?php echo $sexo2_nom ?></option>

          </select>



          <label>FECHA NACIMIENTO</label>

          <input class="form-control" type="date" name="nacCarga" id="nacCarga" value="<?php echo $nac; ?>">

        </div>



        <div class="form-group">

          <label>CELULAR</label>

          <input maxlength="9" type="text" class="form-control" id="cel_carga" value="<?php echo $celu; ?>">

          <span id="error2" style="display:none;color:red;">Celular incorrecto</span>

          <label>EMAIL</label>

          <input type="email" class="form-control" id="mail_carga" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" value="<?php echo $mail; ?>">

          <span id="error" style="display:none;color:red;">Email incorrecto</span>

          <label>ESTUDIANTE</label>

          <select class="form-control" name="est_carga" id="est_carga">

            <option value="<?php echo $est; ?>"><?php echo $estudia; ?></option>

            <option value="<?php echo $est2; ?>"><?php echo $estudia2; ?></option>

          </select>

        </div>

        <div class="form-inline">



          <div class="form-control" id="op_cert">

            <label>CERTIFICADO</label>

            <?php if ($cert == 1) {

              $cert2 = 0;

              echo '<label>SI</label><input checked type="radio" name="certi" value="' . $cert . '">

                             <label>NO</label><input type="radio" name="certi" value="' . $cert2 . '">';
            } else {

              $cert2 = 1;

              echo '<label>SI</label><input type="radio" name="certi" value="' . $cert2 . '">

                             <label>NO</label><input checked  type="radio" name="certi" value="' . $cert . '">';
            } ?>

          </div>



          <div class="form-control" id="mod_cert">

            <label>MODIFICAR</label>

            <?php if ($cert == 1) {

              $cert2 = 0;

              echo '<label>SI</label><input  type="radio" name="mod" value="1">

                   <label>NO</label><input checked type="radio" name="mod" value="2">';
            } ?>

          </div>





        </div>

        <div class="form-group">

          <div id="certificado">

            <label>CERTIFICADO ALUMNO REGULAR</label>

            <input class="form-control" accept="application/pdf" id="cert_Carga" type="file">

            <input type="hidden" name="rutSocio" id="rutSocio" value="<?php echo $rutSocio ?>">

            <input type="hidden" name="subido" id="subido" value="">

          </div>

        </div>

      </form>
    </div>

  </div>

</div>


<script type="text/javascript">
  var certCarga = document.getElementById('cert_Carga');
  var rutSocio = $("#rutSocio").val();
  $(document).ready(function() {



    var estudiante = $('#est_carga').val();

    if (estudiante == 0) {

      $('#certificado').hide();

      $('#mod_cert').hide();

      $('#op_cert').hide();

    } else {

      if ($('#op_cert input[name=certi]:radio').is(':checked')) {

        //$("input[name=certi]").change(function(){

        var valor = $("input[name=certi]").val();

        //alert(valor);

        if (valor == 1) {

          $('#certificado').hide();





        } else {

          $('#certificado').show();

          $('#mod_cert').hide();



        }

      }



    }







    $('input[name=mod]').change(function() {

      var val = $(this).val();

      if (val == 1) {

        $('#certificado').show();

      } else {

        $('#certificado').hide();

      }

    });



    $('#est_carga').change(function() {

      var estud = $(this).val();



      if (estud == 0) {

        $('#certificado').hide();

        $('#mod_cert').hide();

        $('#op_cert').hide();







      } else {

        //$('#mod_cert').show();

        $('#op_cert').show();

        $("input[name=certi]").prop('checked', false);



      }

    });



    $("input[name=certi]").change(function() {

      var certi = $(this).val();

      if (certi == 1) {

        $('#certificado').show();

      } else {

        $('#certificado').hide();

      }





    });



  });
</script>