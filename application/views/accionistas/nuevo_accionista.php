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

            <form action="" method="post">
                <div class="container" id="advanced-search-form">
                    <h2>Datos Personales</h2>


                    <div class="form-group">
                        <label for="first-name">Rut</label>
                        <input type="text" value="<?php echo $rut  ?>" class="form-control" placeholder="Rut" id="Rut" pattern="\d{3,8}-[\d|kK]{1}" title="Debe ser un Rut válido" required disabled>

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
                        <input type="text" class="form-control" placeholder="Nombre" id="Nombre" required onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
                    </div>

                    <div class="form-group oculto" id="divapellidoP">
                        <label for="first-name">Apellido Paterno</label>
                        <input type="text" class="form-control" placeholder="Apellido Paterno" id="ApellidoP" required onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
                    </div>
                    <div class="form-group oculto" id="apellidoM">
                        <label for="first-name">Apellido Materno</label>
                        <input type="text" class="form-control" placeholder="Apellido Materno" id="AppelidoM" required onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
                    </div>

                    <div class="form-group oculto" id="divfechaN">
                        <label for="first-name">Fecha Nacimiento</label>
                        <input type="text" class="form-control" placeholder="Fecha de Nacimiento" id="FechaN" required>
                    </div>

                    <div class="form-group">
                        <label for="first-name">Email</label>
                        <input type="email" class="form-control" placeholder="correo@correo.cl" id="Correo" pattern="[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$" title="Debe ser un Correo Valido" required onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
                    </div>

                    <div class="form-group">
                        <label for="first-name">Fono</label>
                        <input type="text" class="form-control" placeholder="Telefono" id="Fono" required>
                    </div>

                    <div class="form-group">
                        <label for="first-name">Dirección </label>
                        <input type="text" class="form-control" placeholder="Calle #123" id="Direccion" required>
                    </div>






                    <div class="form-group">
                        <label for="comuna">Comuna</label>

                        <select class="form-control" name="comu" id="comu">
                            <option value=""> Seleccionar </option>
                            <?php
                            foreach ($comunas as $i) {

                                echo ' <option value="' . $i->comuna_id . '" ' . set_select("comuna", $i->comuna_id) . '>' . $i->comuna_nombre . '</option>';
                            }

                            ?>
                        </select>
                    </div>




                    <div class="form-group">
                        <label for="provincia">Provincia</label>

                        <select class="form-control" name="provi" id="provi">
                            <option value=""> Seleccionar </option>
                            <?php
                            foreach ($provincia as $i) {

                                echo ' <option value="' . $i->provincia_id  . '" ' . set_select("provincia", $i->provincia_id) . '>' . $i->provincia_nombre . '</option>';
                            }

                            ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="region">Region</label>

                        <select class="form-control" name="region" id="region">
                            <option value=""> Seleccionar </option>
                            <?php
                            foreach ($region as $i) {

                                echo ' <option value="' . $i->region_id   . '" ' . set_select("region", $i->region_id) . '>' . $i->region_nombre . '</option>';
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


                    <div class="form-group " id="divgenero">
                        <label>Género</label>
                        <div class="radio">
                            <label class="radio-inline">
                                <input type="radio" name="sexo" value="1" required>Masculino</label>
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
                        <select class="form-control" name="estadocivil" id="estadocivil">
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
                        <input type="text" class="form-control" placeholder="Foja" id="Foja" required onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
                    </div>

                    <div class="form-group">
                        <label for="first-name">Fecha Ingreso</label>
                        <input type="text" class="form-control" placeholder="Fecha de Ingreso" id="FechaIgreso" required>
                    </div>



                    <div class="clearfix"></div>
                    <button class="btn btn-info btn-lg btn-responsive" id="guardar"> <span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>

                </div>
                <div class="form-group">
                    <label for="">Titulos</label>
                    <select name="titlo" id="tiloid">
                    
                    </select>
                </div>


                












            </form>


            
            <div id="items">
            <button id="add">Agregar Campos</button>
                <div><input type="text" name="input[]">
            </div>
            


















            

          





    </div>

    </div>

    <script type="text/javascript">
        $(function() {
            $("#FechaN").datepicker();
        });

        $(function() {
            $("#txt_fechaIn").datepicker();
        });

        $(function() {
            $("#FechaIgreso").datepicker();
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




        //when the Add Field button is clicked
        $("#add").click(function(e) {

            $("#items").append('<div><input name="input[]" type="text" /><button class="delete">X</button></div>');
        });

        $("body").on("click", ".delete", function(e) {
            $(this).parent("div").remove();
        });


        
    </script>
</body>

</html>