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


        <div class="panel row " id="div_tabla_juntas">

        </div>

        


        <div class="modal fade " id="correo_junta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

            <div class="modal-dialog  main container-fluid" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Correo Junta Ordinaria</h4>
                    </div>

                    <div class="modal-body">

                        <input type="hidden" name="id_junta" id="id_junta_correo" value="">


                        <div id="AsuntoCorreo">



                        </div>




                    </div>

                    <div class="modal-footer">

                        <button id="btn_correo_enviar" class="btn btn-primary"><span id="letras_span">Ok</span></button>

                    </div>




                </div>
            </div>
        </div>




        <!-- modal_ver_carta -->

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


                        <a href="javascript:void(0)" id="descargar_carta" class="btn btn-sm btn-warning" download><span class="glyphicon glyphicon-circle-arrow-down"></span> Descargar</a>


                    </div>

                </div>
            </div>
        </div>

        <!--  fin modal ver carta -->


        <!-- modal ver detalle -->

        <div class="modal fade " id="ver_detalle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

            <div class="modal-dialog  main container-fluid" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Detalle Junta Ordinaria</h4>
                    </div>
                    <div class="modal-body">

                        <div id="mostrar_detalle">


                        </div>






                    </div>

                    <div class="modal-footer">

                        <a href="javascript:imprSelec('mostrar_detalle')" class="btn btn-warning">Imprimir</a>




                    </div>

                </div>
            </div>
        </div>


        <!--   fin modal ver detalle -->


        <!--  modal Accion -->
        <div class="modal fade " id="accion_junta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

            <div class="modal-dialog modal-lg main" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                        <h4 class="modal-title" id="myModalLabel">Datelle Junta <strong id="fecha_detalle_negrita"></strong></h4>
                    </div>

                    <form id="form_guardar_detalle" action="<?php echo base_url() ?>/accionistas/SA/guardar_detalle_junta" method="POST">

                        <div class="modal-body">

                            <input type="hidden" name="tipo_junta_detalle" value="<?php echo $tipo_junta ?>">
                            <input type="hidden" name="id_junta_detalle" id="id_junta_detalle" value="">



                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="detalle_junta">Redacte aqui lo ocurrido en la junta ordinaria</label>
                                    <textarea class="form-control" id="detalle_junta" name="detalle_junta" rows="1" required></textarea>

                                </div>
                            </div>






                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Guardar</button>


                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- FIN modal accion -->



        <!--  modal nueva junta -->
        <div class="modal fade " id="modal_nueva_junta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg main" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Nueva Junta Ordinaria</h4>
                    </div>
                    <form id="form_ingreso_nuevo_junta" action="<?php echo base_url() ?>/accionistas/SA/nueva_junta" method="POST">
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="registro_poderes">Registro de Poderes</label>
                                        <input type="file" class="form-control" id="registro_poderes" name="registro_poderes" placeholder="Carta de Poderes" required>
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
        function imprSelec(nombre) {
            var ficha = document.getElementById(nombre);
            var ventimp = window.open(' ', 'popimpr');
            ventimp.document.write(ficha.innerHTML);
            ventimp.document.close();
            ventimp.print();
            ventimp.close();
        }

        function cargaTabla() {

            DIV = $('#div_tabla_juntas');


            DIV.empty();

            DIV.html('<div class="spinner"></div>');


            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>/accionistas/SA/obtenerJuntas",
                data: {
                    tipo_junta: <?php echo $tipo_junta ?>
                },
                dataType: "json",

                success: function(info) {
                    console.log(info);

                    let base_url = "<?php echo base_url() ?>";
                    /* console.log(info); */

                    let html = "";



                    html += `   <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dt-responsive nowrap" id="table_juntas">

                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Asunto</th>
                                        <th>Archivos</th>
                                        <th>Detalle Junta</th>
                                        <th>Correo</th>
                                    </tr>


                                </thead>
                
                `;

                    html += `<tbody id="tbody_table_juntas">`;

                    for (let i = 0; i < info.length; i++) {



                        let boton_detalle = "";

                        if (info[i].detalle) { // si tiene detalle de junta

                            boton_detalle = ` <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#ver_detalle" data-id="${info[i].id_junta}" data-accion="ver" ><span class="glyphicon glyphicon-list-alt"></span> Ver</button>`;


                        } else {

                            boton_detalle = `<button type="button" title="Redactar el detalle de lo ocurrido en Junta" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#accion_junta" data-id="${info[i].id_junta}" data-accion="agregar" ><span  class="glyphicon glyphicon-pencil"></span></button>`;


                        }

                        if (info[i].correo) { //si  existe detalle correo

                            boton_correo = ` <button type="button" title="Ver a los accionista a los que no se le ha enviado correo" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#correo_junta" data-id="${info[i].id_junta}" data-estado="no_enviados" ><span class="glyphicon glyphicon-envelope"></span> Enviar</button>`;


                        } else {
                            boton_correo = `<button title="Ver acconistas informados de junta" type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#correo_junta" data-id="${info[i].id_junta}" data-estado="enviados" ><span class="glyphicon glyphicon-envelope"> Ver</span></button>`;

                        }

                        html += `
                               <tr>
                                   <td>${info[i].fecha_junta}</td>
                                   <td>${info[i].asunto_junta}</td>

                                   <td>
                                       <button class="btn btn-xs " data-toggle="modal" data-target="#ver_carta" data-ruta="${base_url}${info[i].path_carta_junta}"><span class="glyphicon glyphicon-envelope"> Carta</span></button>
                                       <button class="btn btn-xs " data-toggle="modal" data-target="#ver_carta" data-ruta="${base_url}${info[i].path_registro_poderes}"><span class="glyphicon glyphicon-file"> Poderes</span></button>
                                   </td>

                                   <td>                                   
                                        ${boton_detalle}
                                   </td>
                                   <td>                                   
                                        ${boton_correo}
                                   </td>
                                   
                               </tr>
                           `;





                    }

                    html += `       </tbody>
                
                    </table>`;

                    DIV.html(html);

                    $('#table_juntas').DataTable({
                        "order": [
                            [0, "desc"]
                        ],
                        language: spain

                    });

                },
                error: function(error) {
                    DIV.empty();
                    DIV.html(`<div class="alert alert-danger" role="alert">Error al cargar la tabla  
                    <button class="btn btn-danger" onclick="cargaTabla()">Recargar</button>
                    </div>`);

                    swal({
                        title: "Error",
                        text: "No se pudo cargar la tabla",
                        icon: "error",
                        button: "Aceptar",
                        
                    });
                   
                }

            });



        }

        function formatoFecha(texto) {
            return texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g, '$3/$2/$1');
        }

        cargaTabla();

        var ruta_carta = "";


        $('#ver_carta').on('show.bs.modal', function(evento) {


            var button = $(evento.relatedTarget);
            var ruta = button.data('ruta');
            ruta_carta = ruta;
            var modal = $(this);
            btn_ver_carta = $('#descargar_carta');
            btn_ver_carta.attr('href', ruta);





            modal.find('#carta_frame').attr('src', ruta);

            $(this).find('.modal-body').css({
                'max-height': '100%'
            });


        });



        $("#detalle_junta").summernote();


        $('#accion_junta').on('show.bs.modal', function(evento) {


            let button = $(evento.relatedTarget);
            let id = button.data('id');

            let modal = $(this);

            modal.find('#id_junta_detalle').val(id);



        });
        $('#ver_detalle').on('show.bs.modal', function(evento) {


            let button = $(evento.relatedTarget);
            let id = button.data('id');

            url = "<?php echo base_url() ?>accionistas/SA/obtener_detalle_junta";

            let modal = $(this);

            let mostarDetalle = modal.find('#mostrar_detalle')

            mostarDetalle.empty();

            $.ajax({
                type: "post",
                url: url,
                data: {
                    id_junta: id
                },
                dataType: "json",
                success: function(respuesta) {

                    mostarDetalle.html(respuesta.detalle_junta);

                },

                error: function(error) {

                    swal({
                        title: "Error",
                        text: "No se pudo cargar el detalle",
                        type: "error",
                        confirmButtonText: "Cerrar",
                    });

                }


            });



        });



        $('#correo_junta').on('show.bs.modal', function(evento) {


            let button = $(evento.relatedTarget);

            let modal = $(this);

            let id = button.data('id');

            modal.find('#id_junta_correo').val(id);
            let divRespuesta = modal.find('#AsuntoCorreo')

            divRespuesta.html('<div class="spinner"> </div>');


            let estado = button.data('estado');

            let btn_enviar = modal.find('#btn_correo_enviar');
            btn_enviar.css('display', 'none');



            let url = "";

            url = "<?php echo base_url() ?>accionistas/SA/obtener_correo_junta";

            $.ajax({
                type: "POST",
                url: url,
                data: {
                    id_junta: id,
                    estado: estado

                },
                dataType: "json",
                cache: false,


                success: function(data) {

                    NoEnviados = data.correosNo;
                    Enviados = data.correosSI;

                    console.log(NoEnviados);
                    console.log(Enviados);

                    htmlEnviados = `
                    <h4>Enviados</4>
                    <div class="table-responsive" style= "font-size: 12px;">
                    <table class="table table-striped table-bordered table-hover" id="table_correos_enviados">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                    `;

                    if (Enviados) {

                        for (var i = 0; i < Enviados.length; i++) {


                            htmlEnviados += `
                            <tr>
                                <td>${Enviados[i].prsn_nombres} ${Enviados[i].prsn_apellidopaterno} ${Enviados[i].prsn_apellidomaterno} </td>
                                <td>${Enviados[i].prsn_email}</td>
                                <td>${formatoFecha(Enviados[i].fecha_envio)}</td>
                            </tr>
                            `;

                        }

                    } else {

                        htmlEnviados += `
                        <tr>
                            <td colspan="3">No hay correos enviados</td>
                        </tr>
                        `;
                    }

                    htmlEnviados += `
                    </tbody>
                    </table>
                    </div>`;

                    //No enviados


                    htmlNoEnviados = `
                    <h4>No enviados</4>
                    <div class="table-responsive" style= "font-size: 12px;">
                    <table class="table table-striped table-bordered table-hover" id="table_correos_no_enviados">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>`;





                    if (NoEnviados) {

                        for (var i = 0; i < NoEnviados.length; i++) {

                            htmlNoEnviados += `
                                <tr>
                                    <td>${NoEnviados[i].prsn_nombres} ${NoEnviados[i].prsn_apellidopaterno} ${NoEnviados[i].prsn_apellidomaterno} </td>
                                    <td>${NoEnviados[i].prsn_email}</td>
                                    <td>${formatoFecha(NoEnviados[i].fecha_envio)}</td>
                                </tr>
                                `;

                        }

                        btn_enviar.removeClass('btn-primary');
                        btn_enviar.addClass('btn-warning');

                        $("#letras_span").html('Reenviar correos');

                        btn_enviar.attr('data-funcionamiento', 'reenviar');



                    } else {

                        
                        btn_enviar.removeClass('btn-warning');
                        btn_enviar.addClass('btn-success');

                        $("#letras_span").html("Cerrar");

                        btn_enviar.attr('data-funcionamiento', 'cerrar');

                        htmlNoEnviados += `
                        <tr>
                            <td colspan="3">No hay correos no enviados</td>
                        </tr>
                        `;
                    }

                    htmlNoEnviados += `
                    </tbody>
                    </table>
                    </div>`;



                    divRespuesta.html(htmlEnviados + htmlNoEnviados);

                    btn_enviar.css('display', '');



                },
                error: function(error) {

                    divRespuesta.empty();
                    modal.modal('hide');

                    swal({
                        title: "Error",
                        text: "No se pudo cargar el detalle",
                        type: "error",
                        confirmButtonText: "Cerrar",
                    });



                }


            });









        });

        $("#btn_correo_enviar").click(function() {

            let funcionamiento = $(this).attr('data-funcionamiento');

            boton = $(this);



            modalCorreo = $('#correo_junta');

            if (funcionamiento == 'cerrar') {

                modalCorreo.modal('hide');

            } else if (funcionamiento == 'reenviar') {

                let id_junta = modalCorreo.find('#id_junta_correo').val();
               

                boton.html(`Cargando..<i class="fa fa-spinner fa-spin">`);

                let url = "<?php echo base_url() ?>accionistas/SA/reEnvioCorreo";

                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        id_junta: id_junta
                    },
                    cache: false,

                    success: function(data) {

                        cargaTabla();

                        swal({
                            title: "Correos reenviados",
                            text: "Los correos se han reenviado correctamente",
                            icon: "success",
                            button: "Cerrar",
                        });

                     

                        modalCorreo.modal('hide');

                        boton.html(`Reenviar correos`);
                        
                    }

                });

            }








        });









        document.getElementById('carta_junta').onchange = function(e) {

            valida_archivo(this);
        }
        document.getElementById('registro_poderes').onchange = function(e) {

            valida_archivo(this);
        }



        function valida_archivo(archivo) {

            let nombre_archivo = archivo.value; //obtengo el nombre del archvo

            if (nombre_archivo) {


                let idxpunto = nombre_archivo.lastIndexOf(".") + 1; // ubicacion del punto de extension
                let extension = nombre_archivo.substr(idxpunto, nombre_archivo.length).toLowerCase(); // otengo la extension del archivo

                let archivos_permitidos = ["jpg", "jpeg", "png", "pdf"]; // extensiones en minusculas

                if (!archivos_permitidos.includes(extension)) { //validamos la extension del archivos

                    swal({
                        title: "Archivo no permitido",
                        text: "Solo Archivos:  jpg/jpeg ,PNG y PDF",
                        icon: "error",
                        button: "Aceptar",
                    });

                    archivo.value = "";
                }

            } else {
                archivo.value = "";
            }


        }



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

                    cargaTabla();

                    $('#respuesta').empty();
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


        $("#form_guardar_detalle").submit(function(e) {

            e.preventDefault();

            let form = $(this);
            let url = form.attr('action');
            let metodo = form.attr('method');
            let datos = new FormData($(this)[0]);



            $.ajax({

                type: metodo,
                url: url,
                data: datos,
                contentType: false,
                processData: false,

                success: function(respuesta) {

                    cargaTabla();

                    form[0].reset();

                    swal({
                        title: "¡Correcto!",
                        text: "Se ha ingresado correctamente la junta",
                        icon: "success",
                        button: "Aceptar",
                    });

                    $('#accion_junta').modal('hide');
                }
            });

        });
    </script>