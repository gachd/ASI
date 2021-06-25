<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/styleAccion.css">
    <meta charset="UTF-8">

    <title>Nuevo Accionista</title>



</head>

<div class="container">
    
    <div class="main">



        <div class="container-fluid">
            <form action="<?php echo base_url(); ?>accionistas/titulos/guadarNuevoTitulo" method="post">
                <div class="container" id="advanced-search-form">
                <h1>Nuevo Titulo</h1>
                <br>
                <br>
                <br>
                    <div class="form-group">
                    


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

                    <div class="form-group">
                        <label for="fecha">Fecha Titulo</label>
                        <input type="text" autocomplete="off"class="form-control" id="fecha" name="fechaT" required>
                    </div>

                    <div class="form-group">
                        <label for="fecha">Numero de acciones</label>
                        <input type="number" class="form-control" min="1" name="NumAC" required>
                    </div>


                    <button type="Guadar" class="btn btn-default">Guardar</button>
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