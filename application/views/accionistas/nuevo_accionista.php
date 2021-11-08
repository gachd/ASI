<!DOCTYPE html>

<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/styleAccion.css">
    <meta charset="UTF-8">

    <title>Nuevo Accionista</title>



</head>
<style>
    .oculto {
        display: none;
    }

    form {
        color: #008000;
        padding-bottom: 20px;
    }

    form .form-control {

        padding: 12px 20px;
        height: auto;
        border-radius: 2px;
    }
</style>



<body>

    <div class="salto_linea">
        <br>
        <br>
        <br>
    </div>
    <div class="main">



        <div class="container-fluid">

            <form action="<?php echo base_url(); ?>accionistas/nuevo_accionista/agregaraccionista" method="post" enctype="multipart/form-data">
                <div class="container">
                    <h2>Datos Personales</h2>





                    <div class="form-group col-md-4">
                        <label for="first-name">Rut</label>
                        <input type="text" value="<?php echo $rut  ?>" class="form-control" placeholder="Rut" id="Rut" pattern="\d{3,8}-[\d|kK]{1}" title="Debe ser un Rut válido" name="rut" required disabled>
                        <input id="prodId" name="rutP" type="hidden" value="<?php echo $rut  ?>">

                    </div>

                    <div class="form-group col-md-4" id="tipoP">

                        <label>Tipo de Persona</label>
                        <br>

                        <label class="radio-inline"><input type="radio" name="optradio" value="0" required>Natural</label>

                        <label class="radio-inline"><input type="radio" name="optradio" value="1">Juridica</label>




                    </div>



                    <div class="form-group col-md-4">
                        <label for="first-name">Nombre</label>
                        <input type="text" class="form-control" pattern="^[A-ZÀ-ÿ'\u00d1]+(\s*[A-ZÀ-ÿ'\u00d1]*)*[A-ZÀ-ÿ'\u00d1]+$" placeholder="Nombre" name="nombres" id="Nombre" required onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
                    </div>

                    <div class="form-group col-md-4 oculto" id="divapellidoP">
                        <label for="first-name">Apellido Paterno</label>
                        <input type="text" class="form-control" pattern="^[A-ZÀ-ÿ'\u00d1]+(\s*[A-ZÀ-ÿ'\u00d1]*)*[A-ZÀ-ÿ'\u00d1]+$" placeholder="Apellido Paterno" name="ApellidoP" id="ApellidoP" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
                    </div>
                    <div class="form-group col-md-4 oculto" id="apellidoM">
                        <label for="first-name">Apellido Materno</label>
                        <input type="text" class="form-control" pattern="^[A-ZÀ-ÿ'\u00d1]+(\s*[A-ZÀ-ÿ'\u00d1]*)*[A-ZÀ-ÿ'\u00d1]+$" placeholder="Apellido Materno" name="ApellidoM" id="ApellidoM" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
                    </div>

                    <div class="form-group col-md-4 oculto" id="divfechaN">
                        <label for="first-name">Fecha Nacimiento</label>
                        <input readonly style="background-color: white;" type="text" autocomplete="off" class="form-control" placeholder="Fecha de Nacimiento" id="FechaN" name="FechaN">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="first-name">Email</label>
                        <input type="email" name="Correo" class="form-control" placeholder="correo@correo.cl" id="Correo" title="Debe ser un Correo Valido" required onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="first-name">Fono</label>
                        <input type="text" name="Fono" class="form-control" placeholder="Telefono" id="Fono" minlength="8" maxlength="9" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="first-name">Dirección </label>
                        <input type="text" name="Direccion" class="form-control" placeholder="Calle #123" id="Direccion" required>
                    </div>



                    <div class="form-group col-md-4">
                        <label for="region">Region</label>

                        <select class="form-control" name="region" id="region" required>
                            <option value=""> Seleccionar </option>
                            <?php
                            foreach ($region as $i) {

                                echo ' <option value="' . $i->region_id   . '" ' . set_select("region", $i->region_id) . '>' . $i->region_nombre . '</option>';
                            }

                            ?>
                        </select>
                    </div>


                    <div class="form-group col-md-4">
                        <label for="provincia">Provincia</label>

                        <select class="form-control" name="provi" id="provi" required>
                            <option value=""> Seleccionar </option>


                        </select>
                    </div>


                    <div class="form-group col-md-4">
                        <label for="comuna">Comuna</label>

                        <select class="form-control" name="comu" id="comu" required>
                            <option value=""> Seleccionar </option>


                        </select>
                    </div>



                    <div class="form-group col-md-4 oculto" id="divestdoC">
                        <label for="estado civil">Estado Civil</label>
                        <select class="form-control" name="estadocivil" id="estadocivil">
                            <option value=""> Seleccionar </option>
                            <?php
                            foreach ($estado_civil as $i) {

                                echo ' <option value="' . $i->estacivil_id . ' "   ' . set_select("estado_civil", $i->estacivil_id) . '>' . $i->estacivil_nombre . '</option>';
                            }
                            ?>

                        </select>
                    </div>


                    <div class="form-group col-md-4 oculto " id="divgenero">
                        <label>Género</label>
                        <div class="radio">
                            <label class="radio-inline">
                                <input type="radio" name="sexo" id="gen1" value="1">Masculino</label>
                            <label class="radio-inline">
                                <input type="radio" name="sexo" value="0">Femenino</label>
                        </div>
                    </div>





                    <div class="clearfix"></div>

                </div>

                <br>
                <br>
                <br>



                <!-- Datos de accionista -->
                <div class="container">
                    <h2>Datos de Accionista</h2>



                    <div class="form-group col-md-4">
                        <label for="libro">Libro</label>
                        <select class="form-control" name="libro" id="libro">
                            <option value=""> Seleccionar </option>
                            <?php
                            foreach ($libro as $i) {

                                echo ' <option value="' . $i->id_libro . '"   ' . set_select("libro", $i->id_libro) . '>' . $i->id_libro . '</option>';
                            }
                            ?>

                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="first-name">Foja</label>
                        <input type="text" name="foja" class="form-control" placeholder="Foja" id="Foja" required onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
                    </div>

                    <div class="form-group col-md-4">
                        <label ">Fecha Ingreso</label>
                        <input type=" text" autocomplete="off" class="form-control" placeholder="Fecha de Ingreso" id="FechaIgreso" name="fechaIng" style="background-color: white;" readonly required>

                    </div>

                    <div class="form-group col-md-4">
                        <label for="miarchivo[]">Documentos Accionista</label>
                        <div class="form-inline">
                            <div class="input-group">
                                <input type="file" class="form-control" id="miarchivo[]" name="miarchivo[]" accept="application/pdf,image/gif,image/png,image/jpg,image/jpeg" required onchange="valida_archivo(this)">
                                <div class="input-group-btn">
                                    <a href="javascript:void(0);" class="btn btn-primary form-control" id="agregar_archivo"><i class="glyphicon glyphicon-plus"></i></a>
                                </div>
                            </div>
                            <div id=nuevo_archivo>

                            </div>
                        </div>
                    </div>


                </div>

                <br>
                <br>
                <br>


                <div class="container">

                    <div class="form-group col-md-4" id="divaccion">
                        <label>Accion</label>
                        <div class="radio">
                            <label class="radio-inline">
                                <input type="radio" required name="accion" id="accionN" value="1">Nueva</label>
                            <label class="radio-inline">
                                <input type="radio" name="accion" value="0">Cesion</label>
                        </div>
                    </div>
                    <div class="form-group col-md-4 oculto" id="AccionesNuevoT">
                        <label>Acciones del nuevo Accionista</label>
                        <input min="1" type="number" name="NuevaAcionesTitulo" class="form-control" placeholder="Acciones nuevo socio" id="NuevaAcionesTitulo" autocomplete="off">
                    </div>
                    <div class="form-group col-md-4" id="NumeroNuevoT">
                        <label>Numero de Titulo</label>
                        <input min="1" type="number" name="NumeroTitulo" class="form-control" placeholder="Nro del Titulo" id="NumeroTitulo" autocomplete="off">
                    </div>
                    <div class="form-group col-md-4">
                        <label ">Fecha Titulo</label>
                        <input type=" text" readonly style="background-color: white;" autocomplete="off" class="form-control" placeholder="Fecha de titulo" id="fechaT" name="fechaT" required>
                    </div>

                    <div class="form-group col-md-4 procedente oculto" id="Aprocedente">
                        <label for="Titulop">Titulo Procedente</label>

                        <select class="form-control" name="TituloP" id="TituloP">
                            <option value=""> Seleccionar </option>


                        </select>
                    </div>



                    <input type="hidden" id="AccionesANT" name="AccionesANT">
                    <input type="hidden" id="IdAccionistaANT" name="IdAccionistaANT">




                    <div class="form-group col-md-4 oculto" id="DivNumeroaTransferir">
                        <label>Numero de acciones a tranferir</label>
                        <input min="1" type="number" name="NumNuevoCesion" class="form-control" placeholder="Numero a Tranferir" id="NumNuevoCesion" autocomplete="off">
                    </div>


                    <div class="form-group col-md-4 oculto" id="DivFechaCesion">
                        <label ">Fecha Cesion</label>
                        <input type=" text" autocomplete="off" readonly style="background-color: white;" class="form-control" placeholder="Fecha cesion accion" id="fechaC" name="fechaC" required>
                    </div>











                    <!-- <div class="field_wrapper">
                        <div>
                            <select class="form-control" name="field_name[]" id="comu" required>
                            <option value=""> Seleccionar </option>
                            <option value="1" >1</option> <option value="2" >2</option> <option value="3" >3</option>
                            

                        </select>
                            <a href="javascript:void(0);" class="add_button" title="Add field"><img src="add-icon.png" /></a>
                        </div>
                    </div> -->
                    <!-- <div class="form-group " id="tipoAccion">
                        <label>Tipo de Accion</label>
                        <div class="radio">
                            <label class="radio-inline">
                                <input type="radio" name="optaccion" value="1" required>Nueva</label>

                        </div>
                    </div>
                    <div class="form-group">
                        <label ">Numero de Acciones</label>
                        <input type=" number" class="form-control" placeholder="Numero acciones" name="NumAcciones" id="numacciones" required>
                    </div> -->







                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <button class="btn btn-info btn-lg btn-responsive" id="guardar"> <span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>

                </div>



            </form>



        </div>




    </div>

    <script type="text/javascript">
        function valida_archivo(archivo) {

            var nombre_archivo = archivo.value; //obtengo el nombre del archvo
            var idxpunto = nombre_archivo.lastIndexOf(".") + 1; // ubicacion del punto de extension
            var extension = nombre_archivo.substr(idxpunto, nombre_archivo.length).toLowerCase(); // otengo la extension del archivo

            var archivos_permitidos = ["jpg", "jpeg", "png", "pdf", ""]; // extensiones en minusculas

            if (archivos_permitidos.includes(extension)) { //validamos la extension del archivos

            } else {


                swal({
                    title: "Archivo invalido",
                    text: "Solo Archivos:  jpg/jpeg ,PNG y PDF",
                    icon: "error",
                    button: "Aceptar",
                });

                archivo.value = "";

            }

        }




        //agregar archivo
        $("#agregar_archivo").click(function() {
            var html = '';

            html += '<div class="input-group" id="inputFormRow">';
            html += '<input type="file" class="form-control" id="miarchivo[]" name="miarchivo[]" accept="application/pdf,image/gif,image/png,image/jpg,image/jpeg" required onchange="valida_archivo(this)">';
            html += '<div class="input-group-btn">';
            html += '<a href="javascript:void(0);" class="btn btn-danger form-control" id="remover"><i class="glyphicon glyphicon-minus"></i></a>';
            html += '</div>';


            $('#nuevo_archivo').append(html);
        });

        // Remover archivo
        $(document).on('click', '#remover', function() {
            $(this).closest('#inputFormRow').remove();
        });





        $.datepicker.regional['es'] = {
            closeText: 'Cerrar',
            prevText: '< Ant',
            nextText: 'Sig >',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércole xs', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
            dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
            weekHeader: 'Sm',
            dateFormat: 'dd/mm/yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        };






        $(function() {

            $.datepicker.setDefaults($.datepicker.regional['es']);

            $("#FechaN").datepicker({
                dateFormat: "yy-mm-dd",
                changeMonth: true,
                changeYear: true,
                maxDate: "-18y",
                yearRange: "-100:+0"

            });

            $("#fechaT,#fechaC,#FechaIgreso").datepicker({
                dateFormat: "yy-mm-dd",
                changeYear: true,
                maxDate: +0,
                yearRange: "-100:+0",


            });

        });



        $('#tipoP input').on('change', function() {

            var personaT = $('input[name=optradio]:checked', '#tipoP').val()

            switch (personaT) {

                case "0":

                    $("#divapellidoP").show();
                    $('#ApellidoP').prop('required', true);
                    $("#apellidoM").show();
                    $('#ApellidoM').prop('required', true);
                    $("#divfechaN").show();
                    $('#FechaN').prop('required', true);
                    $("#divestdoC").show();
                    $('#estadocivil').prop('required', true);
                    $("#divgenero").show();
                    $('#gen1').prop('required', true);


                    break;

                case "1":

                    $("#divapellidoP").hide();
                    $('#ApellidoP').prop('required', false).val('');

                    $("#apellidoM").hide();
                    $('#ApellidoM').prop('required', false).val('');

                    $("#divfechaN").hide();
                    $('#FechaN').prop('required', false).val('');

                    $("#divestdoC").hide();
                    $('#estadocivil').prop('required', false).val('');

                    $("#divgenero").hide();

                    $('#gen1').prop('required', false).val('');
                    $('input[name=sexo]:checked').prop('checked', false);



                    break;


            }



        });




        $(document).ready(function() {



            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>accionistas/titulos/obtenerTitulos",
                success: function(response) {

                    $('#TituloP').html(response).fadeIn();


                },
                error: function() {
                    alert('Ocurrio un error en el servidor ..');
                }
            });

            $("#TituloP").change(function() {
                var tituloP = $(this).val();




                if (tituloP != '') {
                    $.ajax({
                        type: "POST",
                        data: {
                            id: tituloP
                        },
                        url: "<?php echo base_url(); ?>accionistas/titulos/obtenerAccionesTitulo",
                        success: function(r) {


                            var embargo = r.embargo;
                            var accionesEmbargo = r.acciones_embargadas;



                            var Id_accionistaAnt = r.id_accionista;
                            var t = r.numero_acciones;


                            if (embargo == 1) {

                                t = t - accionesEmbargo;

                                swal({
                                    title: 'Titulo con ' + accionesEmbargo + ' acciones embargadas',
                                    icon: "warning",
                                    button: "OK",
                                });

                            }

                            $('#AccionesANT').attr("value", t);

                            $('#IdAccionistaANT').attr("value", Id_accionistaAnt);

                            $('#NumNuevoCesion').attr("max", t);
                            $('#NumNuevoCesion').attr("placeholder", "Maximo a tranferir " + t);


                        },
                        error: function() {
                            alert('Ocurrio un error en el servidor ..');
                        }
                    });
                };






            });







            // Bloqueamos el SELECT de los cursos
            $("#provi").prop('disabled', true);
            $("#comu").prop('disabled', true);


            // Hacemos la lógica que cuando nuestro SELECT cambia de valor haga algo
            $("#region").change(function() {
                $("#comu").prop('disabled', true);

                $('#comu').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');



                // Guardamos el select de cursos
                var provincia = $("#provi");

                // Guardamos el select de alumnos
                var region = $(this);

                if ($(this).val() != '') {
                    $.ajax({
                        data: {

                            id: region.val()
                        },
                        url: "<?php echo base_url(); ?>/accionistas/nuevo_accionista/ProvinciaporRegion",
                        type: 'POST',
                        dataType: 'json',
                        beforeSend: function() {
                            region.prop('disabled', true);
                        },
                        success: function(r) {
                            region.prop('disabled', false);

                            // Limpiamos el select
                            provincia.find('option').remove();
                            provincia.append('<option value=""> Seleccionar </option>')

                            $(r).each(function(i, v) { // indice, valor
                                provincia.append('<option value="' + v.provincia_id + '">' + v.provincia_nombre + '</option>');
                            })
                            provincia.prop('disabled', false);



                        },
                        error: function() {
                            alert('Ocurrio un error en el servidor ..');
                            region.prop('disabled', false);
                        }
                    });
                } else {
                    provincia.find('option').remove();
                    provincia.prop('disabled', true);
                }
            })



            $("#provi").change(function() {
                // Guardamos el select de cursos
                var comuna = $("#comu");

                // Guardamos el select de alumnos
                var provincia = $(this);

                if ($(this).val() != '') {
                    $.ajax({
                        data: {
                            id: provincia.val()
                        },
                        url: "<?php echo base_url(); ?>/accionistas/nuevo_accionista/ComunaporProvincia",
                        type: 'POST',
                        dataType: 'json',
                        beforeSend: function() {
                            provincia.prop('disabled', true);
                        },
                        success: function(r) {
                            provincia.prop('disabled', false);

                            // Limpiamos el select
                            comuna.find('option').remove();
                            comuna.append('<option value=""> Seleccionar </option>')

                            $(r).each(function(i, v) { // indice, valor
                                comuna.append('<option value="' + v.comuna_id + '">' + v.comuna_nombre + '</option>');
                            })

                            comuna.prop('disabled', false);
                        },
                        error: function() {
                            alert('Ocurrio un error en el servidor ..');
                            provincia.prop('disabled', false);
                        }
                    });
                } else {
                    comuna.find('option').remove();
                    comuna.prop('disabled', true);
                }
            })
        })







        $('#divaccion input').on('change', function() {

            var accion = $('input[name=accion]:checked', '#divaccion').val()

            switch (accion) {

                case "0": //cesion

                    $("#Aprocedente").show();
                    $('#TituloP').prop('required', true);

                    $("#DivNumeroaTransferir").show();
                    $('#NumNuevoCesion').prop('required', true);

                    $("#AccionesNuevoT").hide();
                    $("#AccioniesNuevoT").prop('required', false).val('');


                    $("#DivFechaCesion").show();
                    $('#fechaC').prop('required', true);





                    break;

                case "1": //nueva


                    $("#Aprocedente").hide();
                    $('#TituloP').prop('required', false).val('');

                    $("#DivNumeroaTransferir").hide();
                    $('#NumNuevoCesion').prop('required', false).val('');

                    $("#AccionesNuevoT").show();
                    $("#AccioniesNuevoT").prop('required', true);

                    $("#DivFechaCesion").hide();
                    $('#fechaC').prop('required', false).val('');



                    break;


            }



        });
    </script>






</body>

</html>