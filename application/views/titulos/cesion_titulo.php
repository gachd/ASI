<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/styleAccion.css">
    <meta charset="UTF-8">

    <title>cesion de titulo</title>



</head>

<div class="container">

    <div class="main">



        <div class="container-fluid">
            <form action="<?php echo base_url(); ?>accionistas/titulos/guadarCesionTitulo" method="post">
                <div class="container" id="advanced-search-form">
                    <h1>Cesion Titulos</h1>
                    <br>
                    <br>
                    <br>
                    <input type="hidden" name="" value="">

                    <div class="form-group">




                        <label for="accionista">Titulo anterior</label>

                        <select class="form-control" name="tituloAnterior" id="tituloAnterior" required>
                            <option value=""> Seleccionar </option>
                            <?php
                            foreach ($titulos as $t) {

                                echo ' <option value="' . $t->id_titulos . '" >' . $t->id_titulos . '</option>';
                            }
                            ?>

                        </select>
                    </div>

                    <div class="form-group">



                        <label for="accionista">Accionista a tranferir</label>

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
                        <label for="fecha">Fecha Tranferencia</label>
                        <input type="text" autocomplete="off" class="form-control" id="fechaTrans" name="fechaTrans" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha">Fecha Nuevo Titulo</label>
                        <input type="text" autocomplete="off" class="form-control" id="fechaNtitulo" name="fechaNtitulo" required>
                    </div>



                    <button type="Guadar" class="btn btn-default">Guardar</button>
                </div>



                <!-- <div class="field_wrapper">
                    <div>
                        <input type="text" name="field_name[]" value="" />
                        <a href="javascript:void(0);" class="add_button" title="Add field"><img src="add-icon.png" /></a>
                    </div>
                </div> -->







            </form>
        </div>



    </div>
</div>











<script>
    $(document).ready(function() {
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="remove-icon.png"/></a></div>'; //New input field html 
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

        $("#fechaNtitulo").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,


        });
        $("#fechaTrans").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,


        });
    });
</script>