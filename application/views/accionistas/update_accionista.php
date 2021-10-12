<!DOCTYPE html>

<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/styleAccion.css">
    <meta charset="UTF-8">

    <title>Edicion Accionista</title>



</head>
<style>
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

    <div class="main">

        <div class="salto_linea">
            <br>
            <br>
            <br>
        </div>

        <div class="container">

            <ul class="breadcrumb">
                <li><a href="<?php echo base_url()  ?>accionistas/inicio">Inicio</a></li>

                <li>Editar Accionista</li>
            </ul>
        </div>






        <form action="<?php echo base_url(); ?>accionistas/nuevo_accionista/updateaccionista" method="post" enctype="multipart/form-data" autocomplete="off">

            <div class="container">
                <h2 style="text-align:center;">Edicion de Rut : <?php echo $accionista[0]->prsn_rut  ?></h2>
                <br>
                <br>
                <input type="hidden" value="<?php echo $accionista[0]->prsn_rut ?>" name="rutA">
                <input type="hidden" value="<?php echo $accionista[0]->prsn_id ?>" name="idP">




                <div class="form-group col-md-4">
                    <label for="first-name">Nombre</label>
                    <input type="text" value="<?php echo $accionista[0]->prsn_nombres  ?>" class="form-control" pattern="^[A-ZÀ-ÿ'\u00d1]+(\s*[A-ZÀ-ÿ'\u00d1]*)*[A-ZÀ-ÿ'\u00d1]+$" placeholder="Nombre" name="nombres" id="Nombre" required onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
                </div>

                <div class="form-group col-md-4" id="divapellidoP">
                    <label for="first-name">Apellido Paterno</label>
                    <input type="text" value="<?php echo $accionista[0]->prsn_apellidopaterno  ?>" pattern="^[A-ZÀ-ÿ'\u00d1]+(\s*[A-ZÀ-ÿ'\u00d1]*)*[A-ZÀ-ÿ'\u00d1]+$" class="form-control" placeholder="Apellido Paterno" name="ApellidoP" id="ApellidoP" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
                </div>
                <div class="form-group col-md-4" id="apellidoM">
                    <label for="first-name">Apellido Materno</label>
                    <input value="<?php echo $accionista[0]->prsn_apellidomaterno  ?>" pattern="^[A-ZÀ-ÿ'\u00d1]+(\s*[A-ZÀ-ÿ'\u00d1]*)*[A-ZÀ-ÿ'\u00d1]+$" type="text" class="form-control" placeholder="Apellido Materno" name="ApellidoM" id="ApellidoM" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
                </div>

                <div class="form-group col-md-4" id="divfechaN">
                    <label for="first-name">Fecha Nacimiento</label>
                    <input value="<?php echo $accionista[0]->prsn_fechanacimi  ?>" type="date" autocomplete="off" class="form-control fecha" placeholder="Fecha de Nacimiento" id="FechaN" name="FechaN">
                </div>

                <div class="form-group col-md-4">
                    <label for="first-name">Email</label>
                    <input value="<?php echo $accionista[0]->prsn_email  ?>" type="email" name="Correo" class="form-control" placeholder="correo@correo.cl" id="Correo" title="Debe ser un Correo Valido" required onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
                </div>

                <div class="form-group col-md-4">
                    <label for="first-name">Fono</label>
                    <input value="<?php echo $accionista[0]->prsn_fono_movil  ?>" type="text" name="Fono" class="form-control" placeholder="Telefono" id="Fono" minlength="8" maxlength="9" required>
                </div>

                <div class="form-group col-md-4">
                    <label for="first-name">Dirección </label>
                    <input value="<?php echo $accionista[0]->prsn_direccion  ?>" type="text" name="Direccion" class="form-control" placeholder="Calle #123" id="Direccion" required>
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
                    <label for="provi">Provincia</label>

                    <select class="form-control" name="proviP" id="provi" required>
                        <option value=""> Seleccionar </option>
                        <?php
                        foreach ($provincia as $i) {

                            echo ' <option value="' . $i->provincia_id  . '" ' . set_select("provincia", $i->provincia_id) . '>' . $i->provincia_nombre . '</option>';
                        }

                        ?>
                    </select>
                </div>


                <div class="form-group col-md-4">
                    <label for="comu">Comuna</label>

                    <select class="form-control" name="comuna" id="comu" required>
                        <option value=""> Seleccionar </option>
                        <?php
                        foreach ($comunas as $i) {

                            echo ' <option value="' . $i->comuna_id . '" ' . set_select("comuna", $i->comuna_id) . '>' . $i->comuna_nombre . '</option>';
                        }

                        ?>
                    </select>
                </div>



                <div class="form-group col-md-4" id="divestdoC">
                    <label for="estadocivil">Estado Civil</label>
                    <select class="form-control" name="estadocivilP" id="estadocivil" required>
                        <option value=""> Seleccionar </option>
                        <?php
                        foreach ($estado_civil as $i) {

                            echo ' <option value="' . $i->estacivil_id . '"' . set_select("estado_civil", $i->estacivil_id) . '>' . $i->estacivil_nombre . '</option>';
                        }
                        ?>

                    </select>
                </div>

                <?php if ($accionista[0]->prsn_fallecido == "0") { ?>

                    <div class="form-group col-md-4">
                        <label for="fallecido">Fallecido</label>
                        <select class="form-control" name="fallecido" id="fallecido" required>
                            <option value="NO" selected>NO</option>
                            <option value="SI">SI</option>
                        </select>


                    </div>

                <?php } ?>







                <div class="form-group col-md-4" id="ArchivosAccionista">
                    <label for="miarchivo[]">Documentos Accionista</label>
                    <div class="form-inline" style="padding-bottom:15px;">

                        <a href="javascript:void(0);" class="btn btn-primary form-control" id="agregar_archivo">Agregar <i class="glyphicon glyphicon-plus"></i></a>


                    </div>
                    <div id=nuevo_archivo class="form-inline">



                    </div>
                </div>






                <div class="clearfix"></div>






            </div>

            <div id="div_fallecido" class="container">




            </div>









            <br><br>
            <br>

            <div style="text-align:center;" id="div_guardar">

                <button class="btn btn-info btn-lg btn-responsive" id="guardar"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>

            </div>

        </form>






        <div class="container">


        </div>


    </div>





</body>

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





    $("#agregar_archivo").click(function() {
        var html = '';

        html += '<div class="input-group" id="inputFormRow"  style="padding-bottom:10px;">';
        html += '<input type="file" class="form-control" id="miarchivo" name="miarchivo[]" accept="application/pdf,image/gif,image/png,image/jpg,image/jpeg" onchange="valida_archivo(this)" required>';
        html += '<div class="input-group-btn">';
        html += '<a href="javascript:void(0);" class="btn btn-danger form-control" id="remover"><i class="glyphicon glyphicon-minus"></i></a>';
        html += '</div>';
        html += '</div>';


        $('#nuevo_archivo').append(html);
    });

    // Remover archivo
    $(document).on('click', '#remover', function() {
        $(this).closest('#inputFormRow').remove();
    });




    //fallecido
    function agregar_archivo_fallecido() {
        var html = '';

        html += '<div class="input-group" id="inputFormRow" style="padding-bottom:10px;">';
        html += '<input type="file" class="form-control" id="archivos_fallecido" name="archivos_fallecido[]" accept="application/pdf,image/gif,image/png,image/jpg,image/jpeg" required onchange="valida_archivo(this)">';
        html += '<div class="input-group-btn">';
        html += '<a href="javascript:void(0);" class="btn btn-danger form-control" id="remover"><i class="glyphicon glyphicon-minus"></i></a>';
        html += '</div>';
        html += '</div>';


        $('#nuevo_archivo_fallecido').append(html);
    };

    // Remover archivo
    $(document).on('click', '#remover', function() {
        $(this).closest('#inputFormRow').remove();
    });




    $("#fallecido").change(function() {
        var html = '';

        if ($(this).val() == "SI") {

            $('#div_fallecido').empty();

            html += '<h3 style="text-align:center;">Datos Fallecido</h3>';
            html += '<br>';
            html += '<br>';

            html += '<div class="form-group col-md-4">';
            html += '<label for="comunidad">Comunidad Hereditaria</label>';
            html += '<input type="text" name="comunidad" class="form-control" placeholder="Nombre comunidad hereditaria" id="comunidad" required onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">';
            html += '</div>';

            html += '<div class="form-group col-md-4">';
            html += '<label for="fecha_fallecimiento">Fecha Fallecimiento</label>';
            html += '<input type="text" name="fecha_fallecimiento"  id ="fecha_fallecimiento" class="form-control" placeholder="Nombre comunidad hereditaria" id="comunidad" required >';
            html += '</div>';


            html += '<div class="form-group col-md-4" >';
            html += '<label for="archivos_fallecido">Documentos Asociados</label>';
            html += '<div class="">';
            html += '<div class="input-group" style="padding-bottom:10px;">';
            html += '<input type="file" class="form-control" id="archivos_fallecido" name="archivos_fallecido[]" accept="application/pdf,image/gif,image/png,image/jpg,image/jpeg" required onchange="valida_archivo(this)">';
            html += '<div class="input-group-btn">';
            html += '<a href="javascript:void(0);" class="btn btn-primary form-control" id="agregar_fallecido" onclick=agregar_archivo_fallecido()><i class="glyphicon glyphicon-plus"></i></a>';
            html += '</div>';
            html += '</div>';
            html += '<div id="nuevo_archivo_fallecido">';
            html += '</div>';
            html += '</div>';



            $('#div_fallecido').append(html);

            $("#fecha_fallecimiento").datepicker({
                dateFormat: "yy-mm-dd",
                changeMonth: true,
                changeYear: true,
                maxDate: +0,
                yearRange: "-100:+0",

            });



        } else {

            $('#div_fallecido').empty();


        }
    });







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








    $(function() {

        $.datepicker.setDefaults($.datepicker.regional['es']);

        $("#FechaN").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0"

        });
        $("#FechaIgreso,#fecha_fallecimiento").datepicker({
            dateFormat: "yy-mm-dd",
            yearRange: "-100:+0"


        });

        $("#region").val('<?php echo $accionista[0]->region_id ?>');
        $("#provi").val('<?php echo $accionista[0]->provincia_id  ?>');
        $("#comu").val('<?php echo $accionista[0]->s_comunas_comuna_id  ?>');
        $("#estadocivil").val('<?php echo $accionista[0]->s_estado_civil_estacivil_id ?>');


    });
</script>


</html>