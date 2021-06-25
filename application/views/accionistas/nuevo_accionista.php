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
    .oculto {
        display: none;
    }
</style>

<body>

    <div class="main">



        <div class="container-fluid">

            <form action="<?php echo base_url(); ?>accionistas/nuevo_accionista/agregaraccionista" method="post">
                <div class="container" id="advanced-search-form">
                    <h2>Datos Personales</h2>



                    <div class="form-group">
                        <label for="first-name">Rut</label>
                        <input type="text" value="<?php echo $rut  ?>" class="form-control" placeholder="Rut" id="Rut" pattern="\d{3,8}-[\d|kK]{1}" title="Debe ser un Rut válido" name="rut" required disabled>
                        <input id="prodId" name="rutP" type="hidden" value="<?php echo $rut  ?>">

                    </div>

                    <div class="form-group " id="tipoP">
                        <label>Tipo de Persona</label>
                        <div class="radio">
                            <label class="radio-inline">
                                <input type="radio" name="optradio" value="1" required>Natural</label>
                            <label class="radio-inline">
                                <input type="radio" name="optradio" value="2">Juridica</label>
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="first-name">Nombre</label>
                        <input type="text" class="form-control" placeholder="Nombre" name="nombres" id="Nombre" required onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
                    </div>

                    <div class="form-group oculto" id="divapellidoP">
                        <label for="first-name">Apellido Paterno</label>
                        <input type="text" class="form-control" placeholder="Apellido Paterno" name="ApellidoP" id="ApellidoP" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
                    </div>
                    <div class="form-group oculto" id="apellidoM">
                        <label for="first-name">Apellido Materno</label>
                        <input type="text" class="form-control" placeholder="Apellido Materno" name="ApellidoM" id="ApellidoM" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
                    </div>

                    <div class="form-group oculto" id="divfechaN">
                        <label for="first-name">Fecha Nacimiento</label>
                        <input type="text" autocomplete="off" class="form-control" placeholder="Fecha de Nacimiento" id="FechaN" name="FechaN">
                    </div>

                    <div class="form-group">
                        <label for="first-name">Email</label>
                        <input type="email" name="Correo" class="form-control" placeholder="correo@correo.cl" id="Correo" pattern="[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$" title="Debe ser un Correo Valido" required onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
                    </div>

                    <div class="form-group">
                        <label for="first-name">Fono</label>
                        <input type="text" name="Fono" class="form-control" placeholder="Telefono" id="Fono" minlength="8" maxlength="9" required>
                    </div>

                    <div class="form-group">
                        <label for="first-name">Dirección </label>
                        <input type="text" name="Direccion" class="form-control" placeholder="Calle #123" id="Direccion" required>
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

                        <select class="form-control" name="provi" id="provi" required>
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

                        <select class="form-control" name="comu" id="comu" required>
                            <option value=""> Seleccionar </option>
                            

                        </select>
                    </div>



                    <div class="form-group oculto" id="divestdoC">
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


                    <div class="form-group oculto " id="divgenero">
                        <label>Género</label>
                        <div class="radio">
                            <label class="radio-inline">
                                <input type="radio" name="sexo" value="1">Masculino</label>
                            <label class="radio-inline">
                                <input type="radio" name="sexo" value="0">Femenino</label>
                        </div>
                    </div>





                    <div class="clearfix"></div>

                </div>
                <!-- Datos de accionista -->
                <div class="container" id="advanced-search-form">
                    <h2>Datos de Accionista</h2>



                    <div class="form-group">
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

                    <div class="form-group">
                        <label for="first-name">Foja</label>
                        <input type="text" name="foja" class="form-control" placeholder="Foja" id="Foja" required onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
                    </div>

                    <div class="form-group">
                        <label ">Fecha Ingreso</label>
                        <input type=" text" autocomplete="off" class="form-control" placeholder="Fecha de Ingreso" id="FechaIgreso" name="fechaIng" required>
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







                    <div class="clearfix"></div>
                    <button class="btn btn-info btn-lg btn-responsive" id="guardar"> <span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>




                </div>
            </form>




            <div class="container" id="advanced-search-form">








            </div>
        </div>




    </div>

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






        $(function() {

            $.datepicker.setDefaults($.datepicker.regional['es']);

            $("#FechaN").datepicker({
                dateFormat: "yy-mm-dd",
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:-18"

            });
            $("#FechaIgreso").datepicker({
                dateFormat: "yy-mm-dd",


            });;
        });



        $('#tipoP input').on('change', function() {

            var personaT = $('input[name=optradio]:checked', '#tipoP').val()

            switch (personaT) {

                case "1":

                    $("#divapellidoP").show();
                    $("#apellidoM").show();
                    $("#divfechaN").show();
                    $("#divestdoC").show();
                    $("#divgenero").show();


                    break;

                case "2":

                    $("#divapellidoP").hide();
                    $("#apellidoM").hide();
                    $("#divfechaN").hide();
                    $("#divestdoC").hide();
                    $("#divgenero").hide();


                    break;


            }



        });




        $(document).ready(function() {
            // Bloqueamos el SELECT de los cursos
            $("#provi").prop('disabled', true);
            $("#comu").prop('disabled', true);


            // Hacemos la lógica que cuando nuestro SELECT cambia de valor haga algo
            $("#region").change(function() {
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



        $(document).ready(function() {
            var maxField = 10; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML = '<div> <select class="form-control" name="field_name[]" id="comu" required><<option value="1" >1</option> <option value="2" >2</option> <option value="3" >3</option><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="remove-icon.png"/></a></div>'; //New input field html 
            var x = 1; //Initial field counter is 1
            $(addButton).click(function() { //Once add button is clicked
                if (x < maxField) { //Check maximum number of input fields
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); // Add field html
                }
            });
            $(wrapper).on('click', '.remove_button', function(e) { //Once remove button is clicked
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });




        });
    </script>






</body>

</html>