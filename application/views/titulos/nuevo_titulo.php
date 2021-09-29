<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/styleAccion.css">
    <meta charset="UTF-8">

    <title>Nuevo Accionista</title>



</head>

<div class="salto_linea">
    <br>
    <br>
    <br>

</div>

<div class="container">
    <div class="container">

        <ul class="breadcrumb">
            <li><a href="<?php echo base_url()  ?>/accionistas/inicio">Inicio</a></li>
            <li><a href="<?php echo base_url()  ?>/accionistas/titulos">Titulos</a></li>

            <li>Nuevo Titulo</li>
        </ul>
    </div>

    <div class="container well">





        <div class="container-fluid">
            <form action="<?php echo base_url(); ?>accionistas/titulos/guadarNuevoTitulo" method="post">
                <div class="container">
                    <h1>Nuevo Titulo</h1>
                    <br>
                    <br>
                    <br>

                    <div class="form-group col-md-4">



                        <label for="accionista">Accionista</label>

                        <select class="form-control" name="accionistaID" id="accionista_select" required>
                            <option value=""> Seleccionar </option>
                            <?php
                            foreach ($accionista as $i) {

                                echo ' <option value="' . $i->id_accionista . '" >' . $i->prsn_rut . '&nbsp;' . $i->prsn_nombres . '&nbsp;' . $i->prsn_apellidopaterno . '</option>';
                            }
                            ?>

                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Numero de Titulo</label>
                        <input min="1" type="number" name="NumeroTitulo" class="form-control" placeholder="Nro del Titulo" id="NumeroTitulo" autocomplete="off" required>
                    </div>

                    <div>

                        <div class="form-group col-md-3">
                            <label for="fecha">Fecha Titulo</label>
                            <input type="text" autocomplete="off" class="form-control" id="fecha" name="fechaT" required>
                        </div>



                    </div>



                    <div class="form-group col-md-4">
                        <label for="fecha">Numero de acciones</label>
                        <input type="number" class="form-control" min="1" name="NumAC" required>
                    </div>


                    <div class="col-md-12">
                        <button type="Guadar" class="btn btn-primary">Guardar</button>

                    </div>
                </div>



            </form>
        </div>

    </div>
</div>











<script>
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

        $("#fecha").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,


        });
    });
</script>