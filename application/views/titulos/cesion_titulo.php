<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/styleAccion.css">
    <meta charset="UTF-8">

    <title>Cesion de titulo</title>



</head>

<div class="salto_linea">
  <br>
  <br>
  <br>

</div>

<div class="container">



    <div class="main">





        <div class="container-fluid">

            <div class="container">

                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url()  ?>accionistas/inicio">Inicio</a></li>
                    <li><a href="<?php echo base_url()  ?>accionistas/titulos">Titulos</a></li>

                    <li>Cesion de Titulo</li>
                </ul>
            </div>
            <form action="<?php echo base_url(); ?>accionistas/titulos/guadarCesionTitulo" method="post">
                <div class="container well">
                    <h1>Cesion Titulos</h1>
                    <br>
                    <br>
                    <br>


                    <div class="form-group col-md-3">

                        <label for="accionista">Titulo anterior</label>

                        <select class="form-control" name="tituloAnterior" id="tituloAnterior" required>
                            <option value=""> Seleccionar </option>
                            <?php
                            foreach ($titulos as $t) {

                                echo ' <option value="' . $t->id_titulos . '" >' . $t->id_titulos . '&nbsp;' . $t->prsn_nombres . '&nbsp;' . $t->prsn_apellidopaterno . '</option>';
                            }
                            ?>

                        </select>
                    </div>

                    <div class="form-group col-md-3">



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
                    <input type="hidden" id="AccionesANT" name="AccionesANT">
                    <input type="hidden" id="IdAccionistaANT" name="IdAccionistaANT">




                    <div class="form-group col-md-3" id="DivNumeroaTransferir">
                        <label>Numero de acciones a tranferir</label>
                        <input min="1" type="number" name="NumNuevoCesion" class="form-control" placeholder="Numero a Tranferir" id="NumNuevoCesion" autocomplete="off">
                    </div>



                    <div class="form-group col-md-3">
                        <label for="fecha">Fecha Tranferencia</label>
                        <input type="text" autocomplete="off" class="form-control" id="fechaTrans" name="fechaTrans" required>

                    </div>

                    <div class="form-group col-md-4">
                        <label>Numero de Titulo</label>
                        <input min="1" type="number" name="NumeroTitulo" class="form-control" placeholder="Nro del Titulo" id="NumeroTitulo" autocomplete="off" required>
                    </div>

                    
                    <div class="form-group col-md-3">
                        <label for="fecha">Fecha Nuevo Titulo</label>
                        <input type="text" autocomplete="off" class="form-control" id="fechaNtitulo" name="fechaNtitulo" required>
                    </div>

                    <div class="col-md-12">

                        <button type="Guardar" class="btn btn-default">Guardar</button>

                    </div>


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

   

   


    $("#tituloAnterior").change(function() {
        var tituloP = $(this).val();

        

        $('#accionista_select').val('');
        $('#NumNuevoCesion').val('');
        $('#fechaTrans').val('');
        $('#NumeroTitulo').val('');
        $('#fechaNtitulo').val('');



        if (tituloP != '') {
            $.ajax({
                type: "POST",
                data: {
                    id: tituloP
                },
                url: "<?php echo base_url(); ?>accionistas/titulos/obtenerAccionesTitulo",
                success: function(r) {

                    console.log(r);
                    
                    var embargo= r.embargo;
                    var accionesEmbargo = r.acciones_embargadas;

                    var Id_accionistaAnt = r.id_accionista;

                    var t = r.numero_acciones;

                    //ocultos para el post
                    $('#AccionesANT').attr("value", t);
                    $('#IdAccionistaANT').attr("value", Id_accionistaAnt);

                    //cambio dinamico del maximo a transferir

                    if (embargo==1){

                        t=t-accionesEmbargo;
                        toastr.warning('Titulo con '+ accionesEmbargo +' acciones embargadas');                     
                    }
                    
                    $('#NumNuevoCesion').attr("max", t);
                    $('#NumNuevoCesion').attr("placeholder", "Maximo a tranferir " + t);

                },
                error: function() {
                    alert('Ocurrio un error en el servidor ..');
                }
            });
        };

       






    });
</script>