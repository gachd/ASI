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
                            <?php
                            foreach ($comunas as $i) {

                                echo ' <option value="' . $i->comuna_id . '" ' . set_select("comuna", $i->comuna_id) . '>' . $i->comuna_nombre . '</option>';
                            }

                            ?>
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
                        <label for="libro">libro</label>
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
                    <div class="form-group " id="tipoAccion">
                        <label>Tipo de Accion</label>
                        <div class="radio">
                            <label class="radio-inline">
                                <input type="radio" name="optaccion" value="1" required>Nueva</label>

                        </div>
                    </div>
                    <div class="form-group">
                        <label ">Numero de Acciones</label>
                        <input type=" number" class="form-control" placeholder="Numero acciones" name="NumAcciones" id="numacciones" required>
                    </div>







                    <div class="clearfix"></div>
                    <button class="btn btn-info btn-lg btn-responsive" id="guardar"> <span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>




                </div>
            </form>




            <div class="container" id="advanced-search-form">


                <div class="aditional-questions aditionals text">
                    <div class="aditional-box duplicate-btn">
                        <p class="aditional-text" for="">Pregunta
                            <a class="btn btn-primary agregar add" href="javascript: void(0)" type="button"><span></span>Agregar</a>
                        </p>
                    </div>
                    <div class="duplicate all">
                        <div class="up-box-question" style="text-align: center">
                            <a class="remove-aditional" href="javascript: void(0)"><span class="glyphicon glyphicon-trash icon"></span></a>
                        </div>
                        <div class="box-question" style="text-align: center">
                            <div class="row">
                                <label class="type-question-text">Tipo de Pregunta</label>
                                <div class="col-md-12">
                                    <select class="form-control select" name="">
                                        <option value="1">Text</option>
                                        <option value="2">Verificar</option>
                                    </select>
                                </div>
                                <div class="row ocultar">
                                    <div class="col-md-12">
                                        <label class="type-question-text" for="">Titulo</label>

                                        <div class="form-group">
                                            <input type="text" id="" class="form-control text general" placeholder="Número de indentificación">
                                        </div>
                                    </div>
                                </div>
                                <div class="row verificar">
                                    <div class="text option" style="margin-top:10px; text-align: center">
                                        <a class="btn btn-primary addRow" href="javascript: void(0)" type="button"><span></span>Agregar Opcion</a>
                                    </div>
                                    <br>
                                    <div class="optionRow">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>





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
                yearRange: "-100:+0"

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










        //Cambio del fomulario segun accion nuevo o cedida

        $('#tipoAccion input').on('change', function() {

            var accionT = $('input[name=optaccion]:checked', '#tipoAccion').val()

            switch (accionT) {

                case "1":




                    break;

                case "2":





                    break;


            }



        });







        $(document).ready(function() {

            $('.verificar').hide();
            $('.duplicate').hide();

            var count = 2;

            //duplicate
            $('a.add').on('click', function() {

                //clone
                var row = $('.duplicate').clone();
                $(row).insertAfter('.duplicate-btn');
                $(row).show();

                //add new ids
                $(row).find('select').attr('id', 'select_' + count);
                $(row).find('verificar').attr('id', 'verificar_' + count);

                //remove duplicate class
                $(row).removeClass('duplicate');

                //onchange of select
                $('select').on('change', function() {

                    var value = $(this).val();
                    var select = $(this).parent();
                    if (value == 1) {
                        $(select).siblings('.inputed').show();
                        $(select).siblings('.ocultar').hide();
                    } else {
                        $(select).siblings('.inputed').hide();

                    }
                    if (value == 2) {
                        $(select).siblings('.ocultar').show();
                        $(select).siblings('.verificar').show();
                    } else {
                        $(select).siblings('.verificar').hide();
                        $(select).siblings('.ocultar').show();
                    }

                });

                //click of remove pregunta
                $(".up-box-question").on("click", ".remove-aditional", function() {

                    $(this).closest(".all").remove();

                });

                $(".optionRow").on("click", ".remove-option", function() {

                    $(this).closest(".option-row").remove();

                });
                //Agrega opciones
                $(".addRow").unbind("click");


                $(".addRow").click(function() {
                    var html = "<div class='option-row' id='rowtk" + count + "'><div class='form-group'><div class='input-group select'><input type='text' class='form-control' placeholder='Añade opción' /><span class='input-group-btn'><button class='btn btn-primary remove-option' type='button'><a class='remove-tipe' href='javascript: void(0)'><span class='glyphicon glyphicon-trash' style='color:white'></span></a></button></span></div></div></div>";

                    var form = $(html);

                    $(this).closest(".verificar").find(".optionRow").append(form);

                });
            });
            count++;

        });
    </script>
</body>

</html>