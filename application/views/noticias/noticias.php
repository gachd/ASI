<title>Noticias</title>

<!-- include summernote para editar textos css/js -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>

<!--script de libreria para  galeria-->
<link href="../assets/js/plugins/bootstrap-fileinput-master/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

<script src="../assets/js/plugins/bootstrap-fileinput-master/js/fileinput.min.js" type="text/javascript"></script>

<style>
  @import url('https://fonts.googleapis.com/css?family=Telex');

  body {
    font-size: 12px;
  }

  /*.paneles{padding:0px; margin:15px;}*/
  .tbl-dep {
    text-transform: uppercase;
    font:
  }

  .nav-tabs {
    border-bottom: 2px solid #DDD;
  }

  .nav-tabs>li.active>a,
  .nav-tabs>li.active>a:focus,
  .nav-tabs>li.active>a:hover {
    border-width: 0;
  }

  .nav-tabs>li>a {
    border: none;
    color: #666;
  }

  .nav-tabs>li.active>a,
  .nav-tabs>li>a:hover {
    border: none;
    color: #4285F4 !important;
    background: transparent;
  }

  .nav-tabs>li>a::after {
    content: "";
    background: #4285F4;
    height: 2px;
    position: absolute;
    width: 100%;
    left: 0px;
    bottom: -1px;
    transition: all 250ms ease 0s;
    transform: scale(0);
  }

  .nav-tabs>li.active>a::after,
  .nav-tabs>li:hover>a::after {
    transform: scale(1);
  }

  .tab-nav>li>a::after {
    background: #21527d none repeat scroll 0% 0%;
    color: #fff;
  }

  .tab-pane {
    padding: 15px 0;
  }

  .tab-content {
    padding: 20px
  }

  .card {
    background: #FFF none repeat scroll 0% 0%;
    box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3);
    margin-bottom: 30px;
  }

  .bs-callout {
    padding: 13px 3px;
    margin: 20px 0;
    border: 1px solid #eee;
    border-left-width: 5px;
    border-radius: 3px;
    overflow: hidden;
  }


  .bs-callout h4 {
    font-size: 18px;
    letter-spacing: 5px;
    margin-top: 0px;
    text-transform: uppercase;
    color: darkgray;
    margin-left: 15px;
  }

  #div_instalaciones {
    border-left-color: #ce4844;
  }

  #div_vegetacion {
    border-left-color: #5cb85c;
  }

  #div_recreacion {
    border-left-color: #f0ad4e;
  }

  .table {
    margin-top: 20px;
    text-transform: uppercase;
    font-size: 11px;
  }

  .td_titulo {
    background: #f7f7f7;
    text-transform: uppercase;
    font-size: 10px;
    letter-spacing: 4px;
  }

  .panel-small {
    padding: 0px;
  }

  .pc {
    display: block;
    margin-top: 20px;
  }

  .celular {
    display: none;
  }

  .icono:hover {
    color: #E53235;
  }

  table.dataTable thead>tr>th {
    padding-left: 3px;
    padding-right: 3px;
  }

  #example {
    text-transform: uppercase;
    font-family: monospace;
    font-size: 11px;
  }

  @media screen and (max-width: 728px) {
    .pc {
      display: none;
    }

    .celular {
      display: block;
    }
  }
</style>


<div class="main">
  <nav class="navbar navbar-default nav-titulo">
    <div class="col-md-3">
      <h1 style="text-align:center;">Noticias</h1>
    </div>
    <div class="padre buscador">
      <div class="hijo">
        <!--BOTON AGREGAR-->
        <button type="button" class="btn-nuevo btn btn-success" id="nuevo" style=" margin-left: 15px;">Nuevo</button>
      </div>


    </div>
  </nav>
  <div class="container-fluid">
    <div class="row">
      <div class="row" style=" margin:0 auto 0 auto; width:390px;">
        <div id="respuesta"></div>
        <?php if ($this->session->flashdata('category_success')) { ?>
          <div class="error alert alert-success alert-dismissible " role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <?= $this->session->flashdata('category_success') ?>
          </div>
        <?php } ?>
      </div>
    </div>
    <div class="col-md-6" style="text-align:right;  padding-top: 16px;"></div>
  </div>




  <!-- muestro el panel -->
  <div class="col-md-12">
    <div class="panel panel-default">
      <!-- Default panel contents -->
      <div class="panel-heading">Noticias Publicadas

      </div>

      <div class="panel-body">
        <!-- aqui se imprime la tabla dependencias !-->
        <div class="col-md-12 pc">
          <div class="table-responsive">

            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead style="text-align:center;">
                <tr>
                  <th>Id</th>
                  <th>Titulo</th>
                  <th>Fecha</th>
                  <th>Actualizar</th>
                  <th>Eliminar</th>
                </tr>
              </thead>
              <tbody>

                <?php
                foreach ($noti as $i) {
                  # muestro las noticias
                  echo '  <tr>
          <td  class="clickable-row"  id="' . $i->id . '"> ' . $i->id . ' </td>
          <td  class="clickable-row"  id="' . $i->titulo . '"> ' . $i->titulo . ' </td>
          <td  class="clickable-row"  id="' . $i->fecha . '"> ' . $i->fecha . ' </td>
         ';

                  echo '
                <td>
                 <button type="button" class="btn btn-default btn-xs editar"  id=" ' . $i->id . ' ">
                  <span class="glyphicon glyphicon-cog" aria-hidden="true"></span></button>
                </td>

                <td>
                 <button type="button" class="btn btn-default btn-xs eliminar"  id=" ' . $i->id . ' "> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                </td>
                 </tr>
               ';
                }

                ?>




              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>


</div>



<!-- **************************** MODAL DEL NUEVO *********************************** -->
<!-- **************************** MODAL DEL NUEVO *********************************** -->
<!-- **************************** MODAL DEL NUEVO *********************************** -->
<!-- **************************** MODAL DEL NUEVO *********************************** -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nueva Noticia</h4>
      </div>

      <div id="res-in"><?php echo validation_errors(); ?></div>
      <div class="modalbody" style="display: inline-block;padding-top: 15px;">

        <form enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>noticias/inicio/agregar">

          <!-- tipo  -->
          <div class="col-md-6 form-group">
            <label for="txt_tipo">Publicación para :</label>
            <select class="form-control" name="txt_tipo" id="txt_tipo">
              <option value="0"> Stadio </option>
              <option value="1"> Instituto </option>
              <option value="2"> Ambos </option>
            </select>
          </div>

          <div class="col-md-6 form-group">
            <label for="txt_fecha">Fecha:</label>
            <input type="text" class="form-control" name="txt_fecha" id="txt_fecha">
          </div>
          <!-- Titulo y Fecha -->
          <div class="col-md-12 form-group">
            <label for="txt_titulo">Titulo :</label>
            <input type="text" class="form-control" placeholder="ej: Actividad de Inicio" name="txt_titulo" id="txt_titulo">
          </div>

          <br />
          <!--FOTOS DE LA NOTICIA-->

          <div class="col-md-12 form-group">
            <label for="txt_tipo">Galeria de Imagenes :</label>

            <input id="archivos" name="imagenes[]" type="file" multiple=true class="file-loading">
          </div>

          <div class="col-md-12 form-group">
            <div class="col-md-12 form-group">
              <label for="txt_descripcion">Contenido de Noticia.</label>
            </div>
            <!-- Descripcion -->
            <textarea class="summernote" name="txt_descripcion" id="txt_descripcion"></textarea>
          </div>

      </div>

      <div class="modal-footer">

        <button type="submit" class="btn btn-success">Publicar </button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

      </form>
    </div>

  </div>
</div>
</div>


<!-- **************************** MODAL DEL EDITAR *********************************** -->
<!-- **************************** MODAL DEL EDITAR *********************************** -->
<!-- **************************** MODAL DEL EDITAR *********************************** -->
<!-- **************************** MODAL DEL EDITAR *********************************** -->

<div id="myModaleditar" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Actualizar Noticia</h4>
      </div>
      <div id="res-in"><?php echo validation_errors(); ?></div>
      <div class="modalbody" style="display: inline-block;padding-top: 15px;">

        <form action="<?php echo base_url() ?>noticias/inicio/actualizar" role="form" method="post">


          <!--************************* IMPRIMO EL CONTENIDO DE LA VENTANA *****************-->
          <div class="col-md-12" id="contenido_editar">

          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Guardar </button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>

        </form>
      </div>

    </div>
  </div>
</div>

<script>
  jQuery(document).ready(function($) {
    /*$('#myModal').modal('show'); */

    /*MOSTRAR EL MODAL NUEVO*/
    $(".btn-nuevo").click(function() {
      $('#myModal').modal('show');
    });



    /* *************** MOSTRAR MODAL EDITAR ******************* */
    $(".editar").click(function() {
      trid = $(this).attr('id');
      $.post("<?php echo base_url() ?>noticias/inicio/consulta_noticias", {
        trid: trid
      }, function(data) {
        $("#contenido_editar").html(data);
        $('#myModaleditar').modal('show');

        $(".eliminar_foto").click(function() {
          //window.location = $(this).data("href");
          trid = $(this).attr('id');
          console.log(trid);
          //Ingresamos un mensaje a mostrar
          var mensaje = confirm("¿Esta seguro de eliminar la imagen?");
          //Detectamos si el usuario acepto el mensaje
          if (mensaje) {
            $.post("<?php echo base_url() ?>noticias/inicio/eliminar_foto", {
              trid: trid
            }, function(data) {
              /* $('#myModaleditar').modal('hide');*/
            });
          }

        });


        $.datepicker.regional['es'] = {
          closeText: 'Cerrar',
          prevText: '<Ant',
          nextText: 'Sig>',
          currentText: 'Hoy',
          monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
          monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
          dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
          dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
          dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
          weekHeader: 'Sm',
          dateFormat: 'yy/mm/dd',
          firstDay: 1,
          isRTL: false,
          showMonthAfterYear: false,
          yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['es']);
        $(function() {
          $("#txt_fecha_edit").datepicker();
        });

        $('#txt_descripcion_edit').summernote();

        $("#archivos_edit").fileinput({
          uploadUrl: "https://www.stadioitalianodiconcepcion.cl/ASI/noticias/inicio/actualizar",
          //uploadUrl: "http://localhost/stadio/ASI/noticias/inicio/actualizar",
          uploadAsync: true,
          minFileCount: 1,
          maxFileCount: 20,
          showUpload: false,
          showRemove: false
        });

      });


    });


    $(".collapse.in").each(function() {
      $(this).siblings(".panel-heading").find(".glyphicon").addClass("glyphicon-minus").removeClass("glyphicon-plus");
    });

    // Toggle plus minus icon on show hide of collapse element
    $(".collapse").on('show.bs.collapse', function() {
      $(this).parent().find(".glyphicon").removeClass("glyphicon-plus").addClass("glyphicon-minus");
    }).on('hide.bs.collapse', function() {
      $(this).parent().find(".glyphicon").removeClass("glyphicon-minus").addClass("glyphicon-plus");
    });
  });

  /*modificar estado incidente*/
  jQuery(document).ready(function($) {
    $(".eliminar").click(function() {
      //window.location = $(this).data("href");
      trid = $(this).attr('id');
      console.log(trid);
      //Ingresamos un mensaje a mostrar
      var mensaje = confirm("¿esta seguro de eliminarlo?");
      //Detectamos si el usuario acepto el mensaje
      if (mensaje) {
        $.post("<?php echo base_url() ?>noticias/inicio/eliminar", {
          trid: trid
        }, function(data) {
          location.reload();
        });
      }

    });



    $('#example').DataTable();

  });


  $.datepicker.regional['es'] = {
    closeText: 'Cerrar',
    prevText: '<Ant',
    nextText: 'Sig>',
    currentText: 'Hoy',
    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
    weekHeader: 'Sm',
    dateFormat: 'yy/mm/dd',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''
  };
  $.datepicker.setDefaults($.datepicker.regional['es']);
  $(function() {
    $("#txt_fecha").datepicker();

  });

  /*cargo sumernote*/
  $(document).ready(function() {
    $('#txt_descripcion').summernote();

  });


  $("#archivos").fileinput({
    uploadUrl: "https://www.stadioitalianodiconcepcion.cl/ASI/noticias/inicio/agregar",
    //uploadUrl: "http://localhost/stadio/ASI/noticias/inicio/agregar",
    uploadAsync: true,
    minFileCount: 1,
    maxFileCount: 20,
    showUpload: false,
    showRemove: false
  });

  /*lo que no funca*/
  jQuery(document).ready(function($) {
    $("#btn_agregar_mas").click(function() {
      $("#panel").each(function() {

        display = $(this).css("display");
        if (display == "block") {
          $(this).fadeOut('slow', function() {
            $(this).css({
              "display": "none"
            });
          });
        } else {
          $(this).fadeIn('slow', function() {
            $(this).css("display", "block");
          });
        }

      });
    });
  });

  /*mostrar masimagenes
     function showmasimagenes() {
      element = document.getElementById("panel");
      check = document.getElementById("btn_agregar_mas");
      if (check.checked) {
           element.style.display='block';
        }
      else {
           element.style.display='none';
      }
  }
    */
</script>

</html>