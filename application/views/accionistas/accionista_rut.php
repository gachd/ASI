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
    @media only screen and (min-width: 768px) {

        .margen {
            padding-left: 25%;
            padding-right: 25%;
        }

    }





    form .form-control {

        padding: 12px 20px;
        height: auto;
        border-radius: 2px;

    }



    .btn {
        padding: 12px 20px;
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
        <div class="container">

            <ul class="breadcrumb">
                <li><a href="<?php echo base_url()  ?>accionistas/inicio">Inicio</a></li>
                <li>Nuevo Accionista</li>
            </ul>
        </div>
        <div class="container">


            <div class="center-block margen" style="text-align:center;">

                <h1>Ingrese rut</h1>


                <form action="<?php echo base_url(); ?>accionistas/nuevo_accionista/" method="post">
                    <div class="form-group">

                        <input type="text" class="form-control" id="rut" autocomplete="off" placeholder="11111111-1" name="rut" oninput="checkRut(this)" required>
                        <br>
                        <span style="color:red;"> <?php if ($_POST['msj'] == 1) { ?>
                                <strong>El Rut ya esta registrado</strong><br> Favor ingrese sus datos correctamente. <br><br>
                            <?php } ?> </span>

                        <button type="submit" class="btn btn-primary ">Ingresar</button>


                    </div>



                </form>
            </div>
        </div>
    </div>

</body>


<script>
    $("#menuprincipal").click(function() {
        window.location.href = "<?php echo base_url(); ?>accionistas/inicio";
    });


    function checkRut(rut) {
        // Despejar Puntos
        var valor = rut.value.replace('.', '');
        // Despejar Guión
        valor = valor.replace('-', '');

        // Aislar Cuerpo y Dígito Verificador
        cuerpo = valor.slice(0, -1);
        dv = valor.slice(-1).toUpperCase();

        // Formatear RUN
        rut.value = cuerpo + '-' + dv

        // Si no cumple con el mínimo ej. (n.nnn.nnn)
        if (cuerpo.length < 7) {
            rut.setCustomValidity("RUT Incompleto");
            return false;
        }

        // Calcular Dígito Verificador
        suma = 0;
        multiplo = 2;

        // Para cada dígito del Cuerpo
        for (i = 1; i <= cuerpo.length; i++) {

            // Obtener su Producto con el Múltiplo Correspondiente
            index = multiplo * valor.charAt(cuerpo.length - i);

            // Sumar al Contador General
            suma = suma + index;

            // Consolidar Múltiplo dentro del rango [2,7]
            if (multiplo < 7) {
                multiplo = multiplo + 1;
            } else {
                multiplo = 2;
            }

        }

        // Calcular Dígito Verificador en base al Módulo 11
        dvEsperado = 11 - (suma % 11);

        // Casos Especiales (0 y K)
        dv = (dv == 'K') ? 10 : dv;
        dv = (dv == 0) ? 11 : dv;

        // Validar que el Cuerpo coincide con su Dígito Verificador
        if (dvEsperado != dv) {
            rut.setCustomValidity("RUT Inválido");
            return false;
        }

        // Si todo sale bien, eliminar errores (decretar que es válido)
        rut.setCustomValidity('');
    }
</script>

</html>