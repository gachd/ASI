<style type="text/css">
  #highlight-table {
    font-size: 10px;
    font-family: monospace;
    text-transform: uppercase;
  }

  .fecha {
    padding: 3px;
    text-align: center;
  }

  .cab_mes {
    padding: 3px;
    text-align: center;
    font-size: 13px;
  }

  .td_sigla {
    padding-left: 9px;
    padding-bottom: 5px;
  }

  .hijo {
    padding-right: 5px;
  }

  #informes {
    position: absolute;
    /*top: 80px;*/
    background: #fff;
    text-transform: uppercase;
  }

  .contenido {
    padding-top: 15px;
  }

  .filtro {
    float: left;
    max-width: 50%;
    margin-left: 5px;
  }

  #year,
  #mes {
    display: none;
  }
</style>
<div class="main">
  <nav class="navbar navbar-default nav-titulo">
    <div class="col-md-2">
      <h1 style="text-align:center;">INFORMES</h1>
    </div>
    <div class="col-md-6">
      <div class="row" style="padding-top: 15px;">
        <!-- tipo informe -->
        <div class="filtro">
          <label>Tipo</label>
          <select class="form-control input-sm" name="tipo" id="select_tipo" style="width: 150px;">
            <option value="">seleccionar</option>
            <option value="1">PAGOS</option>
            <option value="2">CARGAS</option>

          </select>
        </div>
        <div class="filtro">
          <label>Socio</label>
          <select class="form-control input-sm" name="tipo" id="select_socio" style="width: 350px;">

            <option value="">seleccionar</option>
            <?php if (!empty($socios)) {

              foreach ($socios as $s) {
                echo '<option value="' . $s->prsn_rut . '">' . $s->prsn_nombres . ' ' . $s->prsn_apellidopaterno . '</option>';
              }
            }
            ?>


          </select>
        </div>

      </div>
    </div>
    <div class="col-md-4">
      <a href="" title="Exportar Excel" id="pdf" class="descargar btn btn-sm btn-warning"><span class="glyphicon glyphicon-circle-arrow-down"></span> Descargar PDF</a>
    </div>

  </nav>

  <div class="col-md-12" id="informes">
    <!-- CONTENDOR INFORMES -->

  </div>
</div>
<script type="text/javascript">
  $("a[id=pdf]").click(function() {
    /*alert('Evento click sobre un input text con id="nombre2"');*/
    informe = $('#select_tipo').val();
    socio = $('#select_socio').val();
    m = '/';
    url = "<?php echo base_url(); ?>socios/informes/pdf/" + informe + m + socio;
    window.open(url, '_blank');
  });
</script>