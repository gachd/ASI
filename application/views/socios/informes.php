<style type="text/css">


</style>
<div class="main">
  <nav class="navbar navbar-default nav-titulo" style="display: none;">
    <div class="col-md-2">
      <h1 style="text-align:center;">INFORMES</h1>
    </div>
    <div class="col-md-6">
      <div class="row" style="padding-top: 15px;">
        <!-- tipo informe -->
        <div class="col-xs-6">
          <label>Tipo</label>
          <select class="form-control" name="tipo" id="select_tipo">
            <option value="">seleccionar</option>
            <option value="1">PAGOS</option>
            <option value="2">CARGAS</option>
            <option value="3">Honorarios</option>
            <option value="4">Actuvos</option>


          </select>
        </div>
        <div class="col-xs-6">
          <label>Socio</label>
          <select class="form-control" name="tipo" id="select_socio">

            <option value="">seleccionar</option>
            <?php if (!empty($socios)) {

              foreach ($socios as $s) {
                echo '<option value="' . $s->prsn_rut . '">' . $s->prsn_nombres . ' ' . $s->prsn_apellidopaterno . '</option>';
              }
            }
            ?>


          </select>
        </div>
        <div style="padding-top: 15px;">
          <button id="generar" class="btn  btn-primary">cargar</button>
        </div>
      </div>



    </div>
    <div class="col-md-4">
      <a href="" title="Generar PDF" id="pdf" class="descargar btn btn-sm btn-warning"><span class="glyphicon glyphicon-circle-arrow-down"></span> Descargar PDF</a>
    </div>

  </nav>






  <nav class="navbar navbar-default nav-titulo">
    <div class="col-md-2">
      <h1 style="text-align:center;">Informes Socios</h1>
    </div>
    <div class="col-md-6">
      <div class="row" style="padding-top: 15px;">

        <div>
          <div class="radio">
            <label><input type="radio" value="Socios" name="persona" checked>Socios</label>
          </div>
          <div class="radio">
            <label><input type="radio" value="Beneficiarios" name="persona">Beneficiarios</label>
          </div>

          <div id="informes_tipo">


          </div>

          <div class="row"></div>




        </div>






        <div style="padding-top: 15px;">
          <button id="generar_informe" class="btn  btn-primary">Generar informe</button>
        </div>
      </div>




    </div>
    <div class="col-md-4">
      <a href="" title="Generar PDF" id="pdf" class="descargar btn btn-sm btn-warning"><span class="glyphicon glyphicon-circle-arrow-down"></span> Descargar PDF</a>
    </div>

  </nav>



  <div class="col-md-12" id="informes">
    <!-- CONTENDOR INFORMES -->

  </div>
</div>


<script type="text/javascript">


var div_tipos = $('#informes_tipo');

let Socio = $('#select_socio');

$("input[name=persona]").change(function(){  

  let persona = $(this).val();

  let html= '';

  div_tipos.html('');

  if(persona == "Socios"){

    


    html += '<div class="col-xs-6">';
    html += '<label>Socio</label>';
    html += '<select class="form-control" name="tipo" id="select_socio">';
    html += '<option value="">seleccionar</option>';
    <?php if (!empty($socios)) {

      foreach ($socios as $s) {

        echo 'html += \'<option value="' . $s->prsn_rut . '">' . $s->prsn_nombres . ' ' . $s->prsn_apellidopaterno . '</option>\';';

      }
    }
    ?>
    html += '</select>';
    html += '</div>';

    html += '<div class="col-xs-6" id="div_socios">';

    html += '</div>';

    div_tipos.html(html);


  }

  if(persona == "Beneficiarios"){

    html += `

    <div class="col-xs-6">
      <label>Socio</label>
      <select class="form-control" name="tipo" id="select_socio">
        <option value="">seleccionar</option>
        <?php if (!empty($socios)) {

          foreach ($socios as $s) {

            echo '<option value="' . $s->prsn_rut . '">' . $s->prsn_nombres . ' ' . $s->prsn_apellidopaterno . '</option>';

          }
        }
        ?>
      </select>
    </div>  

    `;

    div_tipos.html(html);


    




  }



  
   


});




  $("a[id=pdf]").click(function() {
    /*alert('Evento click sobre un input text con id="nombre2"');*/
    informe = $('#select_tipo').val();
    socio = $('#select_socio').val();
    m = '/';
    formato = 'pdf';
    url = "<?php echo base_url(); ?>socios/informes/pdf/" + formato + "/" + informe + "/" + socio;
    window.open(url, '_blank');
  });


  $("button[id=generar]").click(function() {



    formato = 'view';
    informe = $('#select_tipo').val();
    socio = $('#select_socio').val();

    $.ajax({
      url: "<?php echo base_url(); ?>socios/informes/pdf",
      type: "POST",
      data: {
        formato: formato,
        informe: informe,
        socio: socio
      },
      success: function(data) {
        $('#informes').html(data);
      }
    });






  });
</script>