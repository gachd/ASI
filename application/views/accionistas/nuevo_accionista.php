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

<body>

    <div class="main">


        <div class="container-fluid">
            <div class="container" id="advanced-search-form">
                <h2>Nuevo Accionista</h2>

                <div class="form-group">
                    <label>Tipo de Persona</label>
                    <div class="radio">
                        <label class="radio-inline">
                            <input type="radio" name="optradio" value="Natural" required>Natural</label>
                        <label class="radio-inline">
                            <input type="radio" name="optradio" value="Juridica">Juridica</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="first-name">Rut</label>
                    <input type="text"  class="form-control" placeholder="Rut" id="Rut" pattern="\d{3,8}-[\d|kK]{1}" title="Debe ser un Rut válido" required>

                </div>

                <div class="form-group">
                    <label for="first-name">Nombres</label>
                    <input type="text" class="form-control" placeholder="Nombres" id="Nombre" required onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
                </div>

                <div class="form-group">
                    <label for="first-name">Apellido Paterno</label>
                    <input type="text" class="form-control" placeholder="Apellido Paterno" id="ApellidoP" required onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
                </div>
                <div class="form-group">
                    <label for="first-name">Apellido Materno</label>
                    <input type="text" class="form-control" placeholder="Apellido Materno" id="AppelidoM" required onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
                </div>

                <div class="form-group">
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





                <div class="form-group">
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


                <div class="form-group">
                    <label>Género</label>
                    <div class="radio">
                        <label class="radio-inline">
                            <input type="radio" name="sexo" value="1" required>Masculino</label>
                        <label class="radio-inline">
                            <input type="radio" name="sexo" value="0">Femenino</label>
                    </div>
                </div>





                <div class="clearfix"></div>
                <button class="btn btn-info btn-lg btn-responsive" id="guardar"> <span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>

            </div>
        </div>


        <div class="conntainer-fluid">
            <div class="container">

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
    </script>
</body>

</html>