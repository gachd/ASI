<!DOCTYPE html>

<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/styleAccion.css">
    <meta charset="UTF-8">

    <title>Nuevo Accionista</title>



</head>
<style>

</style>

<body>

    <div class="main">
        <div class="col-md-2">

            <a href="<?php echo base_url(); ?>accionistas/inicio" class="btn btn-primary"><span class="badge"><i class="glyphicon glyphicon-home"></i> Menú <br> Principal</span></a>
        </div>



        <div class="container-fluid">

            <form action="<?php echo base_url(); ?>accionistas/nuevo_accionista/updateaccionista" method="post">
                <div class="container" id="advanced-search-form">
                    <h2>Edicion de Rut : <?php echo $accionista[0]->prsn_rut  ?></h2>
                    <input type="hidden" value="<?php echo $accionista[0]->prsn_rut  ?>" name="rutA">
                    <input type="hidden" value="<?php echo $accionista[0]->prsn_id  ?>" name="idP">




                    <div class="form-group">
                        <label for="first-name">Nombre</label>
                        <input type="text" value="<?php echo $accionista[0]->prsn_nombres  ?>" class="form-control" placeholder="Nombre" name="nombres" id="Nombre" required onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
                    </div>

                    <div class="form-group oculto" id="divapellidoP">
                        <label for="first-name">Apellido Paterno</label>
                        <input type="text" value="<?php echo $accionista[0]->prsn_apellidopaterno  ?>" class="form-control" placeholder="Apellido Paterno" name="ApellidoP" id="ApellidoP" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
                    </div>
                    <div class="form-group oculto" id="apellidoM">
                        <label for="first-name">Apellido Materno</label>
                        <input value="<?php echo $accionista[0]->prsn_apellidomaterno  ?>" type="text" class="form-control" placeholder="Apellido Materno" name="ApellidoM" id="ApellidoM" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
                    </div>

                    <div class="form-group oculto" id="divfechaN">
                        <label for="first-name">Fecha Nacimiento</label>
                        <input value="<?php echo $accionista[0]->prsn_fechanacimi  ?>" type="text" autocomplete="off" class="form-control" placeholder="Fecha de Nacimiento" id="FechaN" name="FechaN">
                    </div>

                    <div class="form-group">
                        <label for="first-name">Email</label>
                        <input value="<?php echo $accionista[0]->prsn_email  ?>" type="email" name="Correo" class="form-control" placeholder="correo@correo.cl" id="Correo" title="Debe ser un Correo Valido" required onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
                    </div>

                    <div class="form-group">
                        <label for="first-name">Fono</label>
                        <input value="<?php echo $accionista[0]->prsn_fono_movil  ?>" type="text" name="Fono" class="form-control" placeholder="Telefono" id="Fono" minlength="8" maxlength="9" required>
                    </div>

                    <div class="form-group">
                        <label for="first-name">Dirección </label>
                        <input value="<?php echo $accionista[0]->prsn_direccion  ?>" type="text" name="Direccion" class="form-control" placeholder="Calle #123" id="Direccion" required>
                    </div>



                    <div class="form-group">
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


                    <div class="form-group">
                        <label for="provincia">Provincia</label>

                        <select class="form-control" name="proviP" id="provi" required>
                            <option value=""> Seleccionar </option>
                            <?php
                            foreach ($provincia as $i) {

                                echo ' <option value="' . $i->provincia_id  . '" ' . set_select("provincia", $i->provincia_id) . '>' . $i->provincia_nombre . '</option>';
                            }

                            ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="comuna">Comuna</label>

                        <select class="form-control" name="comuna" id="comu" required>
                            <option value=""> Seleccionar </option>
                            <?php
                            foreach ($comunas as $i) {

                                echo ' <option value="' . $i->comuna_id . '" ' . set_select("comuna", $i->comuna_id) . '>' . $i->comuna_nombre . '</option>';
                            }

                            ?>
                        </select>
                    </div>



                    <div class="form-group oculto" id="divestdoC">
                        <label for="estado civil">Estado Civil</label>
                        <select class="form-control" name="estadocivilP" id="estadocivil" required>
                            <option value=""> Seleccionar </option>
                            <?php
                            foreach ($estado_civil as $i) {

                                echo ' <option value="'. $i->estacivil_id .'"' . set_select("estado_civil", $i->estacivil_id) . '>' . $i->estacivil_nombre . '</option>';
                            }
                            ?>

                        </select>
                    </div>






                    <div class="clearfix"></div>
                    <button class="btn btn-info btn-lg btn-responsive" id="guardar"> <span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>

                </div>
                <!-- Datos de accionista -->

            </form>
           





            <div class="container" id="advanced-search-form">







            </div>
        </div>




    </div>
    </body>

    <script type="text/javascript">
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
            $("#FechaIgreso").datepicker({
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