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
    max-width: 30%;
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
    <div class="col-md-8">
      <div class="row" style="padding-top: 15px;">
        <!-- tipo informe -->
        <div class="filtro">
          <select class="form-control input-sm" name="tipo" id="select_tipo" style="width: 150px;">
            <option value="">seleccionar</option>
            <option value="1">Actividades</option>
            <option value="2">Trabajos</option>
            <option value="3">Turnos</option>
            <option value="5">Ingreso</option>
          </select>
        </div>
        <div class="filtro">
          <select class="form-control input-sm" name="informes" id="select_informe" style="width: 150px;">


            <?php $hoy = date("Y-m-d");  ?>
          </select>
        </div>
        <div class="filtro">
          <input type="date" class="form-control input-sm" name="date_inicio" id="date_inicio" value="<?php echo $hoy; ?>">
        </div>
        <div class="filtro">
          <input type="date" class="form-control input-sm" id="date_termino" name="date_termino" value="<?php echo $hoy; ?>">
        </div>
        <div class="filtro">
          <select name="year" id="year" class="form-control input-sm">
            <?php
            //$year= date("Y");
            $year = '2021';
            for ($i = $year; $i >= 2016; $i--) {
              echo '<option value="' . $i . '">' . $i . '</option>';
            }

            ?>
          </select>
        </div>
        <div class="filtro">
          <select class="form-control input-sm" name="mes" id="mes">

            <option value="1">Enero</option>
            <option value="2">Febrero</option>
            <option value="3">Marzo</option>
            <option value="4">Abril</option>
            <option value="5">Mayo</option>
            <option value="6">Junio</option>
            <option value="7">Julio</option>
            <option value="8">Agosto</option>
            <option value="9">Septiembre</option>
            <option value="10">Octubre</option>
            <option value="11">Noviembre</option>
            <option value="12">Diciembre</option>
          </select>
        </div>
      </div>

      <div class="row contenido" id="div_8">


        <div class="filtro">
          <select class="form-control input-sm" name="tipo_funcionario" id="tipo_funcionario">
            <option value="" disabled selected>Tipo Personal</option>
            
          </select>
        </div>
        <div class="filtro">
          <select class="form-control input-sm" name="tipo_institucion" id="tipo_institucion">
            <option value="" disabled selected>Institución</option>
            <option value="1">Stadio Italiano di Concepción</option>
            <option value="2">Centro Italiano de Concepción</option>
          </select>
        </div>
        <div class="filtro">
          <select class="form-control input-sm" name="funcionario" id="funcionario" placeholder="funcionario">
            <option value="" disabled selected>Funcionario</option>
          </select>

        </div>
      </div>
      <div class="row " id="div_2" style="padding-top: 15px;">
        <div class="filtro">
          <select class="form-control input-sm" name="work_categorias" id="work_categorias">
            <option value="0">Todos Procesos</option>
            <?php foreach ($work_categorias as $i) {
              echo ' <option value="' . $i->ctg_id . '" ' . set_select("categoria", $i->ctg_id) . '>' . $i->ctg_nombre . '</option>';
            } ?>
          </select>
        </div>
        <div class="filtro">
          <select class="form-control input-sm" name="work_subcategoria" id="work_subcategoria">
            <option value="0"> Selccionar </option>
          </select>
        </div>

      </div>


      <div class="row contenido" id="div_4" style="width: 100%;">
        <!-- categoria -->
        <div class="col-md-3"><label for="select">Categoria:</label>
          <select class="form-control input-sm" name="categoria" id="categoria">
            <option value="0"> Selccionar </option>
            <?php
            if ($usuario == "12121019-3") {
              echo '<option value="3">scuola</option>';
            } else {
              foreach ($categorias as $i) {
                echo ' <option value="' . $i->ctg_id . '" ' . set_select("categoria", $i->ctg_id) . '>' . $i->ctg_nombre . '</option>';
              }
            }
            ?>
          </select>
        </div>
        <div class="col-md-4">
          <label for="select2">Sub-Categoria:</label>
          <select class="form-control input-sm" name="subcategoria" id="subcategoria">
            <option value="0"> Selccionar </option>
          </select>
        </div>
      </div>
      <!-- cargar -->
      <div class="col-md-3 row" style="padding-top: 15px;">
        <button type="button" class="btn btn-primary" id="enviar">Cargar</button>
      </div>



    </div>

    <div class="col-md-2">
      <a href="#" title="Exportar Excel" id="excel" class="descargar btn btn-sm btn-info"><span class="glyphicon glyphicon-circle-arrow-down"></span> Descargar Excel</a>

      <a href="#" title="Exportar Excel" id="pdf" class="descargar btn btn-sm btn-warning"><span class="glyphicon glyphicon-circle-arrow-down"></span> Descargar PDF</a>

    </div>

  </nav>

  <div class="col-md-12" id="informes">
    <!-- CONTENDOR INFORMES -->
  </div>
</div>
<script>



$.get("<?php echo base_url() ?>turnos/planificacion/carga_tipo", function(data) {

$('#tipo_funcionario').html(data);

});



  $("#enviar").click(function() {

    $('#informes').html('<div class="spinner"></div>');

    informe = $('#select_informe').val();
    date_inicio = $('#date_inicio').val();
    date_termino = $('#date_termino').val();
    excel = 0;
    pdf = 0;
    categoria = $('#categoria').val();
    subcategoria = $('#subcategoria').val();
    year = $('#year').val();
    mes = $('#mes').val();
    tipo_fun = $('#tipo_funcionario').val();
    tipo_inst = $('#tipo_institucion').val();
    fun = $('#funcionario').val();
    work_categorias = $('#work_categorias').val();
    work_subcategoria = $('#work_subcategoria').val();

    $.post("<?php echo base_url() ?>reportes/inicio/informes", {
        informe: informe,
        date_inicio: date_inicio,
        date_termino: date_termino,
        excel: excel,
        categoria: categoria,
        subcategoria: subcategoria,
        pdf: pdf,
        year: year,
        mes: mes,
        fun: fun,
        tipo_fun: tipo_fun,
        tipo_inst: tipo_inst,
        work_categorias: work_categorias,
        work_subcategoria: work_subcategoria
      },
      function(data) {
        $("#informes").html(data);
      });
  });

  $("a[id=excel]").click(function() {
    /*alert('Evento click sobre un input text con id="nombre2"');*/
    informe = $('#select_informe').val();
    date_inicio = $('#date_inicio').val();
    date_termino = $('#date_termino').val();
    excel = 1;
    pdf = 0;
    categoria = $('#categoria').val();
    subcategoria = $('#subcategoria').val();
    year = $('#year').val();
    mes = $('#mes').val();
    tipo_fun = $('#tipo_funcionario').val();
    fun = $('#funcionario').val();
    work_categorias = $('#work_categorias').val();
    work_subcategoria = $('#work_subcategoria').val();

    url = "<?php echo base_url(); ?>reportes/inicio/informes/" + informe + "/" + date_inicio + "/" + date_termino + "/" + excel + "/" + categoria + "/" + subcategoria + "/" + pdf + "/" + year + "/" + mes + "/" + tipo_fun +"/"+ tipo_inst + "/" + fun + "/" + work_categorias + "/" + work_subcategoria;
    window.open(url, '_blank');
  });
  $("a[id=pdf]").click(function() {
    /*alert('Evento click sobre un input text con id="nombre2"');*/
    informe = $('#select_informe').val();
    date_inicio = $('#date_inicio').val();
    date_termino = $('#date_termino').val();
    excel = 0;
    pdf = 1;
    categoria = $('#categoria').val();
    subcategoria = $('#subcategoria').val();
    year = $('#year').val();
    mes = $('#mes').val();
    tipo_fun = $('#tipo_funcionario').val();
    tipo_inst = $('#tipo_institucion').val();
    fun = $('#funcionario').val();
    work_categorias = $('#work_categorias').val();
    work_subcategoria = $('#work_subcategoria').val();

    url = "<?php echo base_url(); ?>reportes/inicio/informes/" + informe + "/" + date_inicio + "/" + date_termino + "/" + excel + "/" + categoria + "/" + subcategoria + "/" + pdf + "/" + year + "/" + mes + "/" + tipo_fun +"/"+ tipo_inst + "/" + fun + "/" + work_categorias + "/" + work_subcategoria;
    window.open(url, '_blank');
  });

  $(document).ready(function() {
    
    $("#work_categorias").change(function() {
      $("#work_categorias option:selected").each(function() {
        micategoria = $('#work_categorias').val();
        $.post("<?php echo base_url() ?>reportes/inicio/fillsubcategoriaswork", {
          micategoria: micategoria
        }, function(data) {
          $("#work_subcategoria").html(data);
        });
      });
    })



    $("#categoria").change(function() {
      $("#categoria option:selected").each(function() {
        micategoria = $('#categoria').val();
        $.post("<?php echo base_url() ?>reportes/inicio/fillsubcategorias", {
          micategoria: micategoria
        }, function(data) {
          $("#subcategoria").html(data);
        });
      });
    })

    $("#select_tipo").change(function() {
      $("#select_tipo option:selected").each(function() {
        tipo = $('#select_tipo').val();
        //alert(tipo);
        $.post("<?php echo base_url() ?>reportes/inicio/fillinformes", {
          tipo: tipo
        }, function(data) {
          $("#select_informe").html(data);
        });
      });
    })

    //SELECT FUNCIONARIOS
    $("#tipo_institucion").change(function() {
      $("#tipo_institucion option:selected").each(function() {
        tipo_fun = $('#tipo_funcionario').val();
        tipo_inst = $('#tipo_institucion').val();
        $.post("<?php echo base_url() ?>reportes/inicio/select_funcionario", {
          tipo_fun: tipo_fun,
          tipo_inst: tipo_inst
        }, function(data) {
          $("#funcionario").html(data);
        });
      });
    })


    $("#select_informe").change(function() {



      if ($(this).val() == "8") {
        //alert('value 8 (wich refers to Chef) got selected');
        $('#date_inicio').hide();
        $('#date_termino').hide();
        $('#mes').show();
        $('#year').show();
      } else if ($(this).val() == "9") {
        //alert('value 9 (wich refers to Chef) got selected');
        $('#date_inicio').hide();
        $('#date_termino').hide();
        $('#mes').hide();
        $('#year').show();
      } else if ($(this).val() == "10") {
        //alert('value 9 (wich refers to Chef) got selected');
        $('#date_inicio').hide();
        $('#date_termino').hide();
        $('#mes').hide();
        $('#year').show();
      } else if ($(this).val() == "11") {
        //alert('value 9 (wich refers to Chef) got selected');
        $('#date_inicio').hide();
        $('#date_termino').hide();
        $('#mes').show();
        $('#year').show();
      } else if ($(this).val() == "12") {
        //alert('value 9 (wich refers to Chef) got selected');
        $('#date_inicio').hide();
        $('#date_termino').hide();
        $('#mes').show();
        $('#year').show();
      } else if ($(this).val() == "13") {
        //alert('value 9 (wich refers to Chef) got selected');
        $('#div_2').hide();
        // $('#date_inicio').hide();
        $('#date_termino').hide();
        // $('#mes').show();
        // $('#year').show();
      } else {
        $('#date_inicio').show();
        $('#date_termino').show();
        $('#mes').hide();
        $('#year').hide();
      }

    });


  });
</script>

<script language="javascript" type="text/javascript">
  $(document).ready(function() {
    $(".contenido").hide();
    $("#select_informe").change(function() {
      $(".contenido").hide();
      $("#div_" + $(this).val()).show();
    });
  });
</script>