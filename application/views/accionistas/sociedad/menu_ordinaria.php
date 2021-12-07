<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>

<style>
    iframe img {
        width: 300px;
        height: auto;
    }
</style>



<div class="main">

    <div class="container-fluid ">


        <ul class="breadcrumb">
            <li><a href="<?php echo base_url()  ?>accionistas/inicio">Inicio</a></li>
            <li><a href="<?php echo base_url()  ?>accionistas/SA">Menu SA</a></li>
            <li>Junta Ordinaria</li>
        </ul>

    </div>

    <div class="container-fluid">


        <h2>Junta Ordinaria</h2>

        <div class="row" style="padding: 20px;">

            <div class="col-md-offset-8">

                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal_nueva_junta">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    Nueva <br>Junta Ordinaria
                </button>

            </div>

        </div>


        <div class="panel row" id="div_tabla_juntas">




        </div>

        <div class="modal fade " id="ver_carta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

            <div class="modal-dialog  main container-fluid" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Carta Notariada</h4>
                    </div>
                    <div class="modal-body">
                        
                     

                            <iframe src="" class="" id="carta_frame" frameborder="0" style="width: 100%; height: 500px;"></iframe>

                  

                    </div>

                    <div class="modal-footer">

                    </div>

                </div>
            </div>
        </div>





        <!--  modal nueva junta -->
        <div class="modal fade " id="modal_nueva_junta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg main" role="document">
                <form id="form_ingreso_nuevo_junta" action="<?php echo base_url() ?>/accionistas/SA/nueva_junta" method="POST">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Nueva Junta Ordinaria</h4>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="motivo_junta">Motivo de Junta</label>
                                        <input type="text" autocomplete="off" class="form-control" id="motivo_junta" name="motivo_junta" placeholder="Nombre de la Junta" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fecha_junta">Fecha de la Junta</label>
                                        <input type="date" class="form-control" id="fecha_junta" name="fecha_junta" placeholder="Fecha de la Junta" required>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="tipo_junta" value="<?php echo $tipo_junta ?>">


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="carta_junta">Archivo Carta Notariada</label>
                                        <input type="file" class="form-control" id="carta_junta" name="carta_junta" placeholder="Archivo Carta Notariada" required>
                                    </div>
                                </div>

                            </div>







                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <div id="respuesta"></div>
                        </div>
                </form>
            </div>
        </div>

        <!-- FIN modal nueva junta -->




        <!--  <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="participantes_junta">Participantes</label>
                                            <select name="participantes_junta[]" multiple id="participantes_junta" class="form-control" required>

                                            </select>

                                        </div>
                                    </div> -->





    </div>



</div>












<script>
    function cargaTabla() {

        DIV = $('#div_tabla_juntas');

        DIV.empty();



        $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>/accionistas/SA/obtenerJuntas",
            data: {
                tipo_junta: <?php echo $tipo_junta ?>
            },
            dataType: "json",

            success: function(info) {

                let base_url = "<?php echo base_url() ?>";
                console.log(info);

                let html = "";

                html += `   <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="table_juntas">

                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Asunto</th>
                                        <th>Carta</th>
                                        <th>Acciones</th>
                                    </tr>


                                </thead>
                
                `;

                html += `<tbody id="tbody_table_juntas">`;

                for (let i = 0; i < info.length; i++) {

                    html += `
                               <tr>
                                   <td>${info[i].fecha_junta}</td>
                                   <td>${info[i].asunto_junta}</td>

                                   <td>
                                       <button class="btn" data-toggle="modal" data-target="#ver_carta" data-ruta="${base_url}${info[i].path_carta_junta}"><span class="glyphicon glyphicon-eye-open"></span></button>
                                   </td>

                                   <td>
                                   <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal_accion_accionista" data-rut="${info[i].id_junta}" data-accion="editar" data-backdrop="static" data-keyboard="false"><span class="glyphicon glyphicon-pencil"></span></button>
                                   <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal_accion_accionista" data-rut="${info[i].id_junta}" data-accion="ver" data-backdrop="static" data-keyboard="false"><i class="glyphicon glyphicon-list-alt"></i> Ver</button>
                                   </td>
                               </tr>
                           `;

                }

                html += `       </tbody>
                
                    </table>`;

                DIV.html(html);

                $('#table_juntas').DataTable({
                    "order": [
                        [0, "DESC"]
                    ],

                    "oLanguage": spain
                });

            },
            error: function(error) {

                swal({
                    title: "Error",
                    text: "No se pudo cargar la tabla",
                    type: "error",
                    confirmButtonText: "Cerrar",
                });
            }

        });



    }


    cargaTabla();




    $('#ver_carta').on('show.bs.modal', function(evento) {


        var button = $(evento.relatedTarget);
        var ruta = button.data('ruta');
        var modal = $(this);
        modal.find('#carta_frame').attr('src', ruta);

        $(this).find('.modal-body').css({
            'max-height': '100%'
        });


    });








    document.getElementById('carta_junta').onchange = function(e) {

        valida_archivo(this);
    }



    function valida_archivo(archivo) {

        var nombre_archivo = archivo.value; //obtengo el nombre del archvo
        var idxpunto = nombre_archivo.lastIndexOf(".") + 1; // ubicacion del punto de extension
        var extension = nombre_archivo.substr(idxpunto, nombre_archivo.length).toLowerCase(); // otengo la extension del archivo

        var archivos_permitidos = ["jpg", "jpeg", "png", "pdf"]; // extensiones en minusculas

        if (archivos_permitidos.includes(extension)) { //validamos la extension del archivos

        } else {


            swal({
                title: "Archivo no permitido",
                text: "Solo Archivos:  jpg/jpeg ,PNG y PDF",
                icon: "error",
                button: "Aceptar",
            });

            archivo.value = "";

        }

    }




    $(document).ready(function() {




    });



    /*   var accionistasJson = <?php echo $accionistasjson; ?>;

      function llenar_select_participantes_junta() {

          var participantes = $('#participantes_junta');

          participantes.empty();

          participantes.append('<option value="">Seleccione un participante</option>'); 

          $.each(accionistasJson, function(index, ValorElemento) {

              participantes.append('<option value="' + index + '">' + ValorElemento + '</option>');

          });

          participantes.selectpicker('refresh');


      }

      llenar_select_participantes_junta(); */


    /* function ajuste_area(textarea) {
        textarea.style.height = "1px";
        textarea.style.height = (17 + textarea.scrollHeight) + "px";
    } */





    $('#form_ingreso_nuevo_junta').submit(function(e) {

        e.preventDefault();

        form = $(this);

        url = $(this).attr('action');

        type = $(this).attr('method');

        var formData = new FormData($(this)[0]);



        $.ajax({
            url: url,
            type: type,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,

            beforeSend: function() {

                $('#respuesta').html('<div class="spinner"></div>');

            },
            success: function(data) {

                $('#respuesta').empty();
                cargaTabla();
                $('#modal_nueva_junta').modal('hide');

                swal({
                    title: "¡Correcto!",
                    text: "Se ha ingresado correctamente la junta",
                    icon: "success",
                    button: "Aceptar",
                });


                form[0].reset();

            },
            error: function(data) {

                $('#respuesta').empty();

                swal("Error", "No se pudo guardar el registro", "error");

            }
        });





    });
</script>