<link href="<?php echo base_url(); ?>/assets/css/actividades/nueva.css" rel="stylesheet">



<script src="<?php echo base_url(); ?>/assets/js/validaRutPer.js"></script>




<?php if ($porUrl == 0) { ?>
  <div class="modal-header" >
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

  </div>

  <div class="" id="nueva_actividad">

  <?php } elseif ($porUrl == 1) { ?>

    <div class="main" id="nueva_actividad">

  <?php }  ?>





    <!--CALENDARIZACION-->

    <div id="modal_calendar" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Calendarizacion</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <input name="cal_id" id="cal_id" type="hidden" />
              <div class="col-md-4">
                <label for="time">Fecha:</label>
                <input name="cal_date" type="date" class="form-control input-sm " id="cal_date" value="">
              </div>
              <div class="col-md-4">
                <label for="time">Hr. Inicio:</label>
                <input name="cal_inicio" type="time" placeholder="00:00" class="form-control input-sm " id="cal_inicio" autocomplete=" on" value="">
              </div>
              <div class="col-md-4">
                <label for="time">Hr. Termino:</label>
                <input name="cal_termino" type="time" placeholder="00:00" class="form-control input-sm " id="cal_termino" autocomplete=" on" value="">
              </div>
              <div class="col-md-12" style="padding-top: 15px;">
                <p><textarea rows="4" id="cal_desc" class="form-control input-sm" placeholder="Comparte tu opinión con el autor!"> </textarea></p>
              </div>
              <div class="col-sm-12" style="text-align: right;padding: 15px;">
                <button type="button" class="btn btn-warning" id="save_cal">Guardar</button>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12" id="tbl_calendarizacion">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- EDITAR CALENDARIZACIOn -->
    <div id="modal_editar_calendar" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Editar Calendarización</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <input name="edit_cal_actv" id="edit_cal_actv" type="hidden" />
              <input name="edit_cal_id" id="edit_cal_id" type="hidden" />
              <div class="col-md-4">
                <label for="time">Fecha:</label>
                <input name="edit_cal_date" type="date" class="form-control input-sm " id="edit_cal_date">
              </div>
              <div class="col-md-4">
                <label for="time">Hr. Inicio:</label>
                <input name="edit_cal_inicio" type="time" placeholder="00:00" class="form-control input-sm " id="edit_cal_inicio" autocomplete=" on">
              </div>
              <div class="col-md-4">
                <label for="time">Hr. Termino:</label>
                <input name="edit_cal_termino" type="time" placeholder="00:00" class="form-control input-sm " id="edit_cal_termino" autocomplete=" on">
              </div>
              <div class="col-md-12" style="padding-top: 15px;">
                <p><textarea rows="4" id="edit_cal_desc" class="form-control input-sm" placeholder="Ingrese alguna observación!"> </textarea></p>
              </div>
              <div class="col-sm-12" style="text-align: right;padding: 15px;">
                <button type="button" class="btn btn-warning" id="edit_cal" data-dismiss="modal">Guardar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



    <nav class="navbar navbar-default nav-titulo">
      <div class="col-md-3">
        <h1 style="text-align:center;"><?php
                                        $url = $fecha;

                                        setlocale(LC_ALL, 'es_ES') . ': ';
                                        echo iconv('ISO-8859-1', 'UTF-8', strftime('%A %d de %B de %Y',  strtotime("" . $url . "")));

                                        ?></h1>
      </div>

      <div class="buscador padre">
        <div class="btn-group">
          <?php $usuario = $this->session->userdata('id');
          $permiso = $this->model_actividades->permiso_insertar($usuario);
          if (!empty($permiso)) {
            echo ' <button type="button" class="btn-nuevo btn btn-default" id="nuevo" title="Nueva Actividad"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>';
          }
          ?>
          <!-- era : buscar_rango-->
          <button type="button" class="btn btn-default" id="print_semana" title="Imprimir día"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>
        </div>




      </div>

    </nav>




    <!-- mensajes de error -->
    <div class="row">
      <div class="col-md-3">
        <?php if ($this->session->flashdata('category_success')) { ?>
          <div class="error alert alert-success alert-dismissible " role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <?= $this->session->flashdata('category_success') ?> </div>
        <?php } ?>
      </div>
    </div>

    <!-- NUEVA ACTIVIDAD -->
    <div class="col-md-12" id="div-nuevo" style="display:none;">
      <div class="panel panel-primary">
        <!-- Page Heading -->
        <div class="panel-heading">
          <h3 class="panel-title"><i class="fa fa-plus-square"></i> Nuevo</h3>
        </div>
        <div class="panel-body">
          <!-- /.row -->
          <div class="row">
            <div class="col-md-12">
              <!-- /.row -->
            </div> <!-- /.container-fluid -->
          </div>
        </div>
      </div>
    </div>

    <div class=" col-md-12" id="activ_fechas">


    </div>


    <!-- ACTIVIDADES -->
    <div class="col-md-12" id="select_actividad" style="margin-top: 15px;">
      <div class="panel panel-default">
        <div class="panel-heading"> ACTIVIDADES</div>
        <div class="panel-body body_actividades">

          <input type="hidden" id="txt_fechasel" value="<?php echo $fecha; ?>" />
          <div class="scrollbar col-md-6" id="cont_list_actividades">

            <table width="100%" id="table_actividades" border="1" class="table table-condensed" style="    border: solid #ccc 1px;">
              <thead>
                <tr>
                  <th>Horario</th>
                  <th>Actividad</th>
                  <th>Dependencia</th>
                  <th>Nº Prsns.</th>
                  <th>Estado</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($query as $i) {

                  $socios = $i->act_nsocios;
                  $externos = $i->act_nprsns;
                  $total_prsns = $socios + $externos;

                  echo '  <tr  class="cont-actividades" id="' . $i->act_id . '"  >
      
      <td><ul>' . date("H:i", strtotime($i->act_inicio)) . ' ' . date("H:i", strtotime($i->act_termino)) . '</ul></td>
      <td><ul> ' . $i->sctg_nombre . '<br><span class="categoria" style="background: ' . $i->ctg_color . ';">' . $i->ctg_nombre . '</span><br>' . $i->act_nombre . '</ul></td>
      <td><ul>';
                  $dep = $this->model_actividades->getDepen($i->act_id);
                  foreach ($dep as $d) {
                    echo '<li>' . $d->dep_nombre . '</li>';
                  }
                  echo '</ul></td>
      <td><ul>' . $total_prsns . '</ul></td>';
                  if ($i->act_estado == 0) {
                    echo '<td id="est_act' . $i->act_id . '"><ul><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></ul></td>
     <input name="estado_act" id="estado_act" type="hidden"/>';
                  } else {
                    echo '<td id="est_act' . $i->act_id . '"><ul><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></ul></td>
         <input name="estado_act" id="estado_act" type="hidden"/>';
                  }

                  echo '</tr>';
                }
                ?>
              </tbody>
            </table>


          </div>


          <div class="col-md-6" id="cont-det-actividades">
            <div class="col-md-12" id="det_actividad" style="border: 1px solid #e8e8e8;">

            </div>
          </div>
        </div><!-- /.row -->


      </div>
    </div>


    <!-- TRABAJOS -->

    <div class="col-md-4">
      <div class="panel-group" id="accordion">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a href="#collapse1" data-parent="accordion" data-toggle="collapse">
                <label style="font-size: 15px;">TRABAJOS</label></a>
            </h4>
          </div>
          <!--  <div id="collapse1" class="panel-collapse collapse"> -->
          <div id="collapse1" class="panel">
            <div class="panel-body" style="padding: 5px 0px;">


              <?php

              if (!empty($trabajos)) {
                $n = 0;
                foreach ($trabajos as $t) {

                  $tipo_trabajo[] = $t->sctg_nombre;
                }
                $tipo_trabajo_unique = array_unique($tipo_trabajo);
                //var_dump($data_unique);

                foreach ($tipo_trabajo_unique as $tt) {

                  echo ' <div class="cont-trabajo">
                  <div class="col-md-3 titulo-trabajo">' . $tt . '</div>
      <div class="col-md-9">
          <ul>';
                  foreach ($trabajos as $t) {



                    if ($t->sctg_nombre == $tt) {



                      $id_work = $t->tb_id;
                      $fun_work = $this->model_actividades->getDepWORK("" . $id_work . "");
                      //var_dump( $fun_work);
                      foreach ($fun_work  as $fw) {
                        echo '<li>' . $fw->dep_nombre . '</li>';
                      }
                    }
                    # code...
                  }

                  echo ' </ul>
        </div>
        </div>';


                  /*responsable*/

                  /* if($t -> tb_tipo_responsable  == 1) {
                      $id_work= $t -> tb_id;
                    $fun_work = $this -> model_actividades -> getFuncionarioWORK("".$id_work.""); 
                    //var_dump( $fun_work);
                    foreach($fun_work  as $fw){
                       echo''.$fw -> nombre_fun.' '.$fw -> paterno.'</br>' ;
                    }

                    }*/
                  /*else {
                      
                      echo $t -> tb_responsable;
                      }*/
                }
              } else {
                echo "<p style='padding:5px;'> No se encuentran trabajos registardos</p>";
              }

              ?>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!--TURNOS personal stdio-->
    <div class="col-md-3">
      <div class="panel-group" id="accordion">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a href="#collapse2" data-parent="accordion" data-toggle="collapse">
                <label style="font-size: 15px;">TURNOS</label></a>
            </h4>
          </div>
          <div id="collapse2" class="panel">

            <div class="panel-body panel-turnos">
              <H1>PERSONAL STADIO </H1>
              <?php
              echo '<table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Funcionario</th>
                        <th scope="col">Turno</th>
                    </tr>
                  </thead>

                 <tbody>';
              $i = 0;
              foreach ($personal_stadio as $ps) {

                $turno = $ps->turno;
                if (($turno <> 4) && ($turno <> 5) && ($turno <> 14) && ($turno <> 16)) {
                  $i++;
                  echo '
                      <tr>
                        <th scope="row">' . $i . '</th>
                        <td>' . substr($ps->nombre_fun, 0, 1) . '. ' . $ps->paterno . '<br></td>
                        <td>' . $ps->nom_turno . ' </td>
                      
                      </tr>
                      ';
                }
              }

              echo '
                </tbody>
              </table>';

              ?>
              <h1>GUARDIAS</h1>
              <?php
              echo '<table class="table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Funcionario</th>
                          <th scope="col">Turno</th>
                        </tr>
                      </thead>
                      <tbody>';
              $i = 0;
              foreach ($guardias as $g) {
                $turno = $g->turno;
                if (($turno <> 13) && ($turno <> 15) && ($turno <> 17)) {
                  $i++;
                  echo '<tr>
                       <th scope="row">' . $i . '</th>
                            <td>' . substr($g->nombre_fun, 0, 1) . '. ' . $g->paterno . '<br></td>
                           <td>' . $g->nom_turno . ' </td>
                          </tr>';
                }
              }

              echo  '
                    </tbody>
                    </table>';

              ?>
            </div>

          </div>
        </div>
      </div>
    </div> <!-- Fin turnos persona stadio-->


















    <div class="row">
      <div id="turnos"></div>
    </div>
    <!-- *************************MODAL EDITAR ****************************-->
    <div class="modal fade" id="myModalEditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Editar Actividad</h4>

          </div>
          <div class="modal-body">
            <?php echo form_open(base_url() . 'actividades/nueva/actualizar'); ?>
            <form role="form" method="post">

              <div class="row">
                <!--row categoria -->
                <!-- Categoria -->
                <div class="col-md-6">
                  <label for="select">Categoria:</label>
                  <select class="form-control input-sm" name="edit_categoria" id="edit_categoria">
                    <option value="0"> Selccionar </option>
                    <?php
                    foreach ($categorias as $i) {
                      echo ' <option value="' . $i->ctg_id . '" ' . set_select("categoria", $i->ctg_id) . '>' . $i->ctg_nombre . '</option>';
                    }
                    ?>
                  </select>
                </div>
                <!-- Sub-Categoria -->
                <div class="col-md-6">
                  <label for="select2">Sub-Categoria:</label>
                  <select class="form-control input-sm" name="edit_subcategoria" id="edit_subcategoria">
                    <option value="0"> Selccionar </option>
                    <?php foreach ($subcategorias as $sc) {
                      echo ' <option value="' . $sc->sctg_id . '" ' . set_select("categoria", $sc->sctg_id) . '>' . $sc->sctg_nombre . '</option>';
                    } ?>
                  </select>
                </div>
                <!-- NOMBRE ACTIVIDAD EDITAR -->
                <div class="col-md-12">
                  <label for="nomact_edit">Nombre Actividad:</label>
                  <input class="form-control input-sm input-sm" type="text" name="nomact_edit" id="nomact_edit">
                </div>
              </div><!-- /.row categoria -->
              <div class="row">
                <!-- dependencias / fecha -->
                <!--IMPRIMO LAS DEPENDENCIAS-->
                <div class="col-md-12" id="dep_edit"></div>
                <!--Fecha:-->
                <div class="col-md-4">
                  <label for="date">Fecha:</label>
                  <input class="form-control input-sm input-sm" type="text" name="edit_fecha" id="edit_fecha">
                </div>
                <!--Inicio (00:00):-->
                <div class="col-md-4">
                  <label for="time">Inicio (00:00):</label>
                  <input name="edit_inicio" type="time" placeholder="00:00" class="form-control input-sm w_fecha" id="edit_inicio" autocomplete="on">
                </div>
                <!--Termino (00:00)-->
                <div class="col-md-4">
                  <label for="time2">Termino (00:00):</label>
                  <input class="form-control input-sm w_fecha" type="time" placeholder="00:00" name="edit_termino" id="edit_termino">
                </div>
              </div>
              <div class="row">

                <div class="col-md-3">
                  <label for="number">N° prsn:</label>
                  <input class="form-control input-sm" type="number" min="0" name="edit_cantidad" id="edit_cantidad">
                </div>
                <div class="col-md-3">
                  <label for="txt_socios">N° Socios:</label>
                  <input class="form-control input-sm" type="number" name="edit_socios" id="edit_socios" value="">
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label for="empresa">Organiza</label>
                  <select name="edit_organiza" id="edit_organiza" class="form-control input-sm">
                    <option value="">Seleccionar</option>
                    <option value="Stadio">Stadio</option>
                    <option value="Scuola">Scuola</option>
                    <option value="Instituto de Cultura">Instituto de Cultura</option>
                    <option value="Tercero">Tercero</option>
                  </select>
                </div>
                <div class="col-md-6 autocomplete">
                  <label for="empresa">Empresa/Institución</label>
                  <input id="edit_empresa" type="text" name="edit_empresa" class="form-control input-sm input-sm">
                </div>
                <div class="col-md-6">
                  <label for="textfield">Responsable:</label>
                  <input class="form-control input-sm" type="text" name="edit_responsable" id="edit_responsable">
                </div>
                <div class="col-md-6">
                  <label for="txt_fono">Telefono:</label>
                  <input class="form-control input-sm" type="text" name="edit_fono" id="edit_fono" value="">
                </div>
                <div class="col-md-6">
                  <label for="edit_correo">Correo:</label>
                  <input class="form-control input-sm" type="email" name="edit_correo" id="edit_correo" value="">
                </div>
                <div class="col-md-12">
                  <label>Observaciones</label>
                  <input class="form-control input-sm" name="edit_observaciones" id="edit_observaciones">
                </div>

                <div class="col-md-12">
                  <label>Requerimientos:</label>
                  <textarea class="form-control input-sm" name="edit_req" id="edit_req" rows="3"></textarea>


                </div>
                <!--VARIBLE HIDDEN-->

                <input class="form-control input-sm" type="hidden" name="edit_id" id="edit_id">

                <!--************************** SE MUESTRAN LAS DEPENDICIAS **************************-->


              </div>



          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Actualizar</button>


            </form> <?php echo form_close(); ?>
          </div>
        </div>
      </div>
    </div>



  </div><!-- /#main -->


  <script type="text/javascript">
    jQuery(document).ready(function($) {

      $("#edit_fecha").datepicker();
      $(".editar").click(function() {
        idact = $(this).attr('id');
        $.post("<?php echo base_url() ?>actividades/nueva/depact", {
          idact: idact
        }, function(data) {
          $("#dep_edit").html(data);
        });
      });

      $("#save_cal").click(function() {
        cal_id = $('#cal_id').val();
        cal_date = $('#cal_date').val();
        cal_inicio = $('#cal_inicio').val();
        cal_termino = $('#cal_termino').val();
        cal_desc = $('#cal_desc').val();

        $.post("<?php echo base_url() ?>actividades/nueva/new_calendarizacion", {
          cal_id: cal_id,
          cal_date: cal_date,
          cal_inicio: cal_inicio,
          cal_termino: cal_termino,
          cal_desc: cal_desc
        }, function(data) {
          $("#tbl_calendarizacion").html(data);
          $(".div_calendar").html(data);
          $('input[type="time"]').val('');
          $('input[type="time"]').val('');
          $('#cal_desc').val('');
          delete_calendarizacion();
          $(".error").fadeOut(5000);
        });
      });




      $("#edit_categoria").change(function() {
        $("#edit_categoria option:selected").each(function() {
          micategoria = $('#edit_categoria').val();
          $.post("<?php echo base_url() ?>actividades/nueva/fillsubcategorias", {
            micategoria: micategoria
          }, function(data) {
            $("#edit_subcategoria").html(data);
          });
        });
      })
    });



    $("#edit_categoria").change(function() {
      $("#edit_categoria option:selected").each(function() {
        categoriaDep = $('#edit_categoria').val();
        $.post("<?php echo base_url() ?>actividades/nueva/filldependencias", {
          categoriaDep: categoriaDep
        }, function(data) {
          $("#dep_edit").html(data);



        });
      });
    })


    /*funcion ajax de invento aer si funca */



    selcalendario = function(id, fecha, inicio, termino, desc, actividad) {
      $('#edit_cal_actv').val(actividad);
      $('#edit_cal_id').val(id);
      $('#edit_cal_date').val(fecha);
      $('#edit_cal_inicio').val(inicio);
      $('#edit_cal_termino').val(termino);
      $('#edit_cal_desc').val(desc);

    }


    $("#edit_cal").click(function() {
      actv = $('#edit_cal_actv').val();
      id = $('#edit_cal_id').val();
      fecha = $('#edit_cal_date').val();
      inicio = $('#edit_cal_inicio').val();
      termino = $('#edit_cal_termino').val();
      desc = $('#edit_cal_desc').val();
      $.post("<?php echo base_url() ?>actividades/nueva/edit_calendarizacion", {
        id: id,
        fecha: fecha,
        inicio: inicio,
        termino: termino,
        desc: desc,
        actv: actv
      }, function(data) {
        $(".div_calendar").html(data);
      });
    });
    //con esta funcion pasamos los paremtros a los text del modal.
    selPersona = function(actividad, requeri, fecha, inicio, termino, responsable, cantidad, categoria, subcategoria, socios, fono, empresa, organiza, nomact, correo, id) {
      $('#edit_observaciones').val(actividad);
      $('#edit_req').val(requeri);
      $('#edit_fecha').val(fecha);
      $('#edit_inicio').val(inicio);
      $('#edit_responsable').val(responsable);
      $('#edit_cantidad').val(cantidad);
      $('#edit_termino').val(termino);
      $("#edit_categoria").val(categoria);
      $("#edit_subcategoria").val(subcategoria);
      $("#edit_fono").val(fono);
      $("#edit_socios").val(socios);
      $("#edit_id").val(id);
      $("#edit_organiza").val(organiza);
      $("#nomact_edit").val(nomact);
      $("#edit_empresa").val(empresa);
      $("#edit_correo").val(correo);


      /************************************************/
      /*muestro el dato del id del hidden*/
      //console.log($("#edit_id").val());
      id_actividad_v = $('#edit_id').val();
      $.post("<?php echo base_url() ?>actividades/nueva/consulta_dependencias", {
        id_actividad_v: id_actividad_v
      }, function(data) {
        $("#dep_edit").html(data);
        $('#example').DataTable();

      });
      //jQuery('#dep_edit').append('<p><strong>mensaje de prueba</strong></p>');

    };

    modalcalendarizacion = function(id) {
      $("#cal_id").val(id);
    };
    asistencia = function(id) {

      $.ajax({
        type: "post",
        url: "<?php echo base_url() ?>actividades/nueva/registra_asistencia",
        data: {
          id: id
        },
        success: function(data) {
          // console.log(data);
          $('.main').html(data);

        }


      });
    }
    estado = function(estado) {
      $("#estado_act").val(estado);

      var id = $(this).attr("id");
      var estado = $("#estado_act").val();
      //alert(estado);
      if (estado == 0) {
        $('#btn_inactivo').css("display", "none");
        $('#btn_activo').css("display", "block");
        //alert(estado);
      } else {
        $('#btn_inactivo').css("display", "block");
        $('#btn_activo').css("display", "none");

        //alert(estado);
      }

      $.ajax({
        type: "post",
        url: "<?php echo base_url() ?>actividades/nueva/actualiza_estado",
        data: {
          id: id,
          estado: estado
        },
        success: function(data) {
          console.log(data);
          if (data == 0) {
            // alert('si');
            $('#est_act' + id).html('<ul><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></ul>');
          } else {
            $('#est_act' + id).html('<ul><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></ul>');
            //alert('no');
          }
        }


      });
      /*$.post("<?php echo base_url() ?>actividades/nueva/actualiza_estado", {
            id : id,
            estado : estado
               },function(resp){
                  data = $.trim(data);
                  if(resp == "activo"){
                    $('#est_act').html('<ul><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></ul>')
                  }else{
                    $('#est_act').html('<ul><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></ul>')
                  }

                 }); 
        */

    };



    $("#nuevo").click(function() {

      $('#modal_calendar').modal('show');
    });





    $("#print_semana").click(function() {
      var url_actual = "<?php echo $url ?>";

      var id = url_actual;

      url = "<?php echo base_url(); ?>reportes/inicio/informes/6/" + id + "/" + id + "/0/0/0/1";
      window.open(url, '_blank');
    });


    $("input[id=buscar]").click(function() {
      /*alert('Evento click sobre un input text con id="nombre2"');*/
      inicio = $('#buscar_inicio').val();
      termino = $('#buscar_termino').val();
      $.post("<?php echo base_url() ?>actividades/nueva/activFechaRango", {
        inicio: inicio,
        termino: termino
      }, function(data) {
        $("#activ_fechas").html(data);
        $('#example').DataTable();

      });
    });

    $("#delet_calendar").click(function() {
      alert("alert");
      /* if(confirm("¿estas seguro de eliminar esto?")){
             id=$('#id_calendario').val();
             $.post("<?php echo base_url() ?>actividades/nueva/activFechaRango", {id: id},
              function(data){
            $(".div_calendar").html(data);
             
        
              }); 
      }
      else{
          return false;
      }*/
    });


    function generar_reporte_excel() {
      document.getElementById("frmExcel").submit();
    }
    $("a[id=pdf]").click(function() {
      /*alert('Evento click sobre un input text con id="nombre2"');*/
      inicio = $('#buscar_inicio').val();
      termino = $('#buscar_termino').val();
      url = "<?php echo base_url(); ?>actividades/nueva/topdf/" + inicio + "/" + termino;
      window.open(url, '_blank');

    });





    //ELIMANR CALENDARIZACION
    function delete_calendarizacion() {
      $(".delet_calendar").click(function() {
        //alert(id+'-'+actividad);
        if (confirm("¿estas seguro de eliminar esto?")) {
          id = $(this).attr("id");
          actividad = $("#id_activity").val();
          $.post("<?php echo base_url() ?>actividades/nueva/eliminar_calendarizacion", {
              id: id,
              actividad: actividad
            },
            function(data) {
              $(".div_calendar").html(data);
              delete_calendarizacion();


            });
        } else {
          return false;
        }
      });

    }


    $('#table_actividades tr').click(function() {
      $('#table_actividades tr').removeClass('highlighted');
      $(this).addClass('highlighted');
    });


    $(".cont-actividades").click(function() {

      id = $(this).attr('id');

      fecha_sel = $("#txt_fechasel").val();

      //$("#select_actividad").animate({width: '100%'}, "slow");
      $("#cont-actividades").css("background-color", "#000000");
      $("#cont_list_actividades").removeClass("col-md-12").addClass("col-md-6");
      $("#cont-det-actividades").show();

      //alert("fecha" + fecha_sel);
      $.post("<?php echo base_url() ?>actividades/nueva/detalle_actividad", {
          id: id,
          fecha_sel: fecha_sel
        },
        function(data) {

          $("#det_actividad").html(data);
          $("#new_calendar").click(function() {
            $('#modal_calendar').modal('show');
          });
          // ficha tecnica dependencias
          $(".print").click(function() {

            id = $(this).attr('id');
            fecha_sel = $("#txt_fechasel").val();
            url = "<?php echo base_url(); ?>actividades/nueva/ft_actividad/" + id + '/' + fecha_sel;
            window.open(url, '_blank');
          });

          delete_calendarizacion();


        });
    })

    function GuardarAsist() {
      var numFilas = $("#PersonaSelect tr").length;
      var arr = [];

      if (numFilas >= 1) {
        for (var i = 1; i <= numFilas; i++) {
          item = {};
          item["rut"] = $('#rut' + i).val();

          arr.push(item);

        }
      } else {
        alert('Desea guardar sin asistencia la actividad?')
      }


      data = new FormData();

      aInfo = JSON.stringify(arr);
      var id = $('#actId').val();
      data.append("data", aInfo);
      data.append("id", id);
      console.log(aInfo);
      $.ajax({
        type: "POST",
        data: data,
        url: "<?php echo base_url() ?>actividades/nueva/guardaractividad",
        processData: false,
        contentType: false,
        success: function(data) {
          if (data == 1) {
            alert('Datos guardados correctamente');
            var numFilas = $("#PersonaSelect tr").length;
            for (var i = 1; i <= numFilas; i++) {
              $('#btn' + i).css('display', 'none');
            }
          } else {
            alert('Error, no se guardaron los datos');

          }
        }


      });

    }



    function agregarPersona() {



      var cont = 1;
      var numFilas = $("#PersonaSelect tr").length;
      cont = numFilas + cont;
      ant = cont - 1;
      if ($('#rut' + ant).val() == '') {
        alert('Debe ingresar los datos solicitados');
      } else {
        if ($('#nombrePer' + ant).val() == '' || $('#patPer' + ant).val() == '') {
          alert('Debe ingresar los datos solicitados');
        } else {

          var newtr = '<tr class="item" id="item' + cont + '"  data-id="' + cont + '"  >';
          newtr = newtr + '<td id="rutPersona' + cont + '" class="iCarga" ><input onblur="info(this)" type="text" class="rutPer form-control" id="rut' + cont + '" placeholder="Ej: 11111111-1" oninput="checkRut(this)"><span id="erut' + cont + '"  style="display:none;color:red;">Rut incorrecto</span></td>';
          newtr = newtr + '<td id="nomb' + cont + '" class="rut" ><label id="nombPer' + cont + '"></label></td>';
          newtr = newtr + '<td id="apell' + cont + '" class="nombres" ><label id="ApellPer' + cont + '"></label></td>';
          newtr = newtr + '<td id="tipo' + cont + '" class="paterno" ><label id="tipoPer' + cont + '"></label></td>';

          // newtr = newtr + '<td> <input  class="form-control" id="1" name="precio" value="23" required /></td>';
          // newtr = newtr + '<td><input  class="form-control" id="2" name="cantidad" value="2" required /></td>';
          // newtr = newtr + '<td><input  class="form-control"  id="3" name="total" value="46" required /></td>';
          newtr = newtr + '<td id="btn' + cont + '"><button type="button" class="btn btn-danger btn-xs remove-item"><i class="fa fa-times"></i></button></td></tr>';

          $('#PersonaSelect').append(newtr); //Agrego el Producto al tbody de la Tabla con el id=ProSelected

          RefrescaCarga(); //Refresco Productos


          $('.remove-item').off().click(function(e) {
            $(this).parent('td').parent('tr').remove(); //En accion elimino carga de la Tabla
            if ($('#PersonaSelect tr.item').length == 0)
              $('#PersonaSelect .no-item').slideDown(300);
            RefrescaCarga();
          });
          $('.iCarga').off().change(function(e) {
            RefrescaCarga();
          });


        }
      }
    }

    function RefrescaCarga() {
      var ip = [];
      var i = 0;
      $('#guardar').attr('disabled', true); //Deshabilito el Boton Guardar
      $('.iCarga').each(function(index, element) {
        i++;
        ip.push({
          id_pro: $(this).val()
        });
      });
      // Si la lista de Productos no es vacia Habilito el Boton Guardar
      if (i > 0) {
        $('#guardar').removeAttr('disabled', 'disabled');
      }
      var ipt = JSON.stringify(ip); //Convierto la Lista de Productos a un JSON para procesarlo en tu controlador
      $('#ListaPro').val(encodeURIComponent(ipt));
    }





    function guardar(num) {
      var nombre = $('#nombrePer' + num).val();
      var ap_pat = $('#patPer' + num).val();
      var ap_mat = $('#matPer' + num).val();
      var tipo = $('#tipoSel' + num).val();
      var rut = $('#rut' + num).val();


      $.post("<?php echo base_url() ?>actividades/nueva/guardarPersona", {
          nombre: nombre,
          ap_pat: ap_pat,
          ap_mat: ap_mat,
          tipo: tipo,
          rut: rut
        },
        function(data) {
          var numFilas = $("#PersonaSelect tr").length;
          if (data == 1) {
            $('#nombrePer' + numFilas).attr('disabled', 'disabled');
            $('#patPer' + numFilas).attr('disabled', 'disabled');
            $('#matPer' + numFilas).attr('disabled', 'disabled');
            $('#tipoSel' + numFilas).attr('disabled', 'disabled');
            $('#rut' + numFilas).attr('disabled', 'disabled');
          } else {
            alert('Error, no se guardaron los datos');

          }

        });
    }

    function validar(e, rutPer) {
      var keyCode = (e.which) ? e.which : event.keyCode;
      if (keyCode == 8) {
        return true;
      }
      patron = /[A-Za-z]/;
      tecla_final = String.fromCharCode(keyCode);
      var valid = patron.test(tecla_final);


      if (valid) {

        document.getElementById(rutPer.id).value = document.getElementById(rutPer.id).value.toUpperCase();
      } else {
        //alert(rutPer.value);
        if (keyCode != 32) {
          rutPer.value = rutPer.value.substring(0, rutPer.value.length - 1);
        }
      }

      //Tecla de retroceso para borrar, siempre la permite
      /*  var regex = /^[a-zA-Z ]+$/;
  var valid =  regex.test(rutPer.value);
    // Patron de entrada, en este caso solo acepta numeros y letras 
    if(valid){  
    
    document.getElementById(rutPer.id).value=document.getElementById(rutPer.id).value.toUpperCase();

  }else{
    rutPer.value = rutPer.value.replace(rutPer.wich,'');
  }
    */
    }



    function info(rutPer) {
      // var id = $(rutPer).attr('id');
      var paso = 0
      var valor = rutPer.value;
      var numFilas = $("#PersonaSelect tr").length;

      if (numFilas > 1) {
        for (var i = 1; i < numFilas; i++) {

          if ($('#rut' + i).val() == valor) {
            alert('Ya existe');
            var paso = 1;
          }
        }
      }

      if (paso == 0 && valor != '') {
        //    var x = document.getElementById(e);
        //  alert(x);
        $.post("<?php echo base_url() ?>actividades/nueva/buscarPersona", {
            rut: valor
          },
          function(data) {
            var numFilas = $("#PersonaSelect tr").length;
            var valores = eval(data);
            console.log(data);
            var nombre = valores[0];
            if (nombre != 0) {
              var paterno = valores[1];
              var materno = valores[2];
              var tipoPer = valores[3];
              $('#nombPer' + numFilas).text(nombre.toUpperCase());
              $('#ApellPer' + numFilas).text(paterno.toUpperCase() + ' ' + materno.toUpperCase());
              $('#tipoPer' + numFilas).text(tipoPer.toUpperCase());
              $('#rut' + numFilas).attr('disabled', 'disabled');

            } else {
              $('#nombPer' + numFilas).remove();
              $('#ApellPer' + numFilas).remove();
              $('#tipoPer' + numFilas).remove();

              $('#nomb' + numFilas).append('<input id="nombrePer' + numFilas + '" type="text" class="form-control nombPer" onKeyUp="validar(event,this)">');
              $('#apell' + numFilas).append('<input id="patPer' + numFilas + '" type="text" class="form-control" placeholder="Paterno" onKeyUp="validar(event,this)">');
              $('#apell' + numFilas).append('<input id="matPer' + numFilas + '" type="text" class="form-control" placeholder="Materno" onKeyUp="validar(event,this)">');

              $('#tipo' + numFilas).append('<select id="tipoSel' + numFilas + '" class="form-control">');
              var o = new Option("EXTERNO", "1");
              var oo = new Option("FUNCIONARIO", "2");
              var ooo = new Option("SOCIO", "3");
              var oooo = new Option("BENEFECIARIO", "4");

              /// jquerify the DOM object 'o' so we can use the html method
              $(o).html("EXTERNO");
              $(oo).html("FUNCIONARIO");
              $(ooo).html("SOCIO");
              $(oooo).html("BENEFECIARIO");
              $("#tipoSel" + numFilas).append(o);
              $("#tipoSel" + numFilas).append(oo);
              $("#tipoSel" + numFilas).append(ooo);
              $("#tipoSel" + numFilas).append(oooo);

              $("#btn" + numFilas).append('<button onclick="guardar(' + numFilas + ')"  type="button" class="btn btn-warning btn-xs"><i class="fa fa-floppy-o "></i></button>')

            }

          });
      } else {
        document.getElementById('rut' + numFilas).value = "";

      }
    }
  </script>