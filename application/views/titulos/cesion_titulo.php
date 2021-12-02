<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/styleAccion.css">
    <meta charset="UTF-8">

    <title>Transferencias de titulo</title>



</head>


<div>



    <div class="main">





        <div>

            <div class="container">

                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url()  ?>accionistas/inicio">Inicio</a></li>
                    <li><a href="<?php echo base_url()  ?>accionistas/titulos">Titulos</a></li>

                    <li>Transaccion de Acciones</li>
                </ul>
            </div>
            <form action="<?php echo base_url(); ?>accionistas/titulos/guadarCesionTitulo" method="post">
                <div class="container well">
                    <h2>Transaccion de Acciones</h2>
                    <br>
                    <br>
                    <br>

                    <div class="form-group col-md-4">

                        <label for="TipoTransac">Tipo de Transferencia</label>
                        <select class="form-control" id="TipoTransac" name="TipoTransac" required>
                            <option value="">Seleccione una opción</option>
                            <option value="0">Cesion</option>
                            <option value="2">Transmision</option>
                            <option value="3">Canje</option>
                            <option value="4">Anulacion</option>
                        </select>


                    </div>




                    <div class="form-group col-md-3">

                        <label for="accionista">Titulo anterior</label>

                        <select class="form-control" name="tituloAnterior" id="tituloAnterior" required>
                            <option value=""> Seleccionar </option>


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
                        <input min="1" type="number" name="NumNuevoCesion" class="form-control" placeholder="Numero a Tranferir" required id="NumNuevoCesion" autocomplete="off">
                    </div>



                    <div class="form-group col-md-3">
                        <label for="fecha">Fecha Tranferencia</label>
                        <input type="text" autocomplete="off" class="form-control" id="fechaTrans" name="fechaTrans" required>

                    </div>

                    <div class="form-group col-md-4">
                        <label>Numero de Nuevo Titulo</label>
                        <input min="1" type="number" name="NumeroTitulo" class="form-control" placeholder="Nro del Titulo" id="NumeroTitulo" autocomplete="off" required>
                    </div>


                    <div class="form-group col-md-3">
                        <label for="fecha">Fecha Nuevo Titulo</label>
                        <input type="text" autocomplete="off" class="form-control" id="fechaNtitulo" name="fechaNtitulo" required>
                    </div>

                    <div class="form-group col-md-3" id="div_nuevoT_cede">
                        <label for="fecha">Numero Para titulo que cede</label>
                        <input type="text" autocomplete="off" class="form-control" id="NuevoTituloqueCede" name="NuevoTituloqueCede" required>
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
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>accionistas/titulos/obtenerTitulos",
        success: function(response) {

            $('#tituloAnterior').html(response).fadeIn();


        },
        error: function() {
            alert('Ocurrio un error en el servidor ..');
        }
    });





    $(document).ready(function() {


        $("#TipoTransac").change(function() {


            let tipoTransac = $(this).val();

            $('#accionista_select').val('');
            $('#NumNuevoCesion').val('');
            $('#fechaTrans').val('');
            $('#NumeroTitulo').val('');
            $('#fechaNtitulo').val('');




            if (tipoTransac == 0) { //Cesion

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>accionistas/titulos/obtenerTitulos",
                    success: function(response) {

                        $('#tituloAnterior').html(response).fadeIn();


                    },
                    error: function() {
                        alert('Ocurrio un error en el servidor ..');
                    }
                });





            }

            if (tipoTransac == 2) { //Transmision

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>accionistas/titulos/obtener_titulos_transmision",
                    success: function(response) {

                        $('#tituloAnterior').html(response);


                    },
                    error: function() {
                        alert('Ocurrio un error en el servidor ..');
                    }
                });



            }

            if (tipoTransac == 3) { //Canje


                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>accionistas/titulos/obtenerTitulos",
                    success: function(response) {

                        $('#tituloAnterior').html(response).fadeIn();


                    },
                    error: function() {
                        alert('Ocurrio un error en el servidor ..');
                    }
                });


            }
            selectAccionista = $("#accionista_select");

            if (tipoTransac == 4) { //Anulacion 

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>accionistas/titulos/obtenerTitulos",
                    success: function(response) {

                        $('#tituloAnterior').html(response);


                    },
                    error: function() {
                        alert('Ocurrio un error en el servidor ..');
                    }
                });


                selectAccionista.css({
                    'pointer-events': 'none'
                });


            } else {

                selectAccionista.css({
                    'pointer-events': 'auto'
                });
            }






        });



        //embargadas


        $("#tituloAnterior").change(function() {
            var tituloP = $(this).val();




            if (tituloP != '') {
                $.ajax({
                    type: "POST",
                    data: {
                        id: tituloP
                    },
                    url: "<?php echo base_url(); ?>accionistas/titulos/obtenerAccionesTitulo",
                    success: function(r) {


                        var embargo = r.embargo;
                        var accionesEmbargo = r.acciones_embargadas;



                        var Id_accionistaAnt = r.id_accionista;
                        var t = r.numero_acciones;


                        if (embargo == 1) {

                            t = t - accionesEmbargo;

                            swal({
                                title: 'Titulo con ' + accionesEmbargo + ' acciones embargadas',
                                icon: "warning",
                                button: "OK",
                            });

                        }

                        $('#AccionesANT').attr("value", t);

                        $('#IdAccionistaANT').attr("value", Id_accionistaAnt);

                        $('#NumNuevoCesion').attr("max", t);
                        $('#NumNuevoCesion').attr("placeholder", "Maximo a tranferir " + t);


                    },
                    error: function() {
                        alert('Ocurrio un error en el servidor ..');
                    }
                });







            };






        });














        $("#NumeroTitulo, #NuevoTituloqueCede").blur(function() {

            var NuevoT = $(this);
            var NumeroNuevoT = NuevoT.val();



            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>accionistas/titulos/titulos_existentes",
                data: {
                    idTitulo: NumeroNuevoT
                },

                success: function(r) {

                    if (r == 1) {

                        swal({
                            title: "Titulo ya existe",
                            text: "El titulo ya existe",
                            icon: "error",
                            button: "Aceptar",
                        });

                        NuevoT.val('');

                    }

                }
            });

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

        var tipoTrasc = $('#TipoTransac');




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

                    //console.log(r);

                    var embargo = r.embargo;
                    var accionesEmbargo = r.acciones_embargadas;

                    var Id_accionistaAnt = r.id_accionista;

                    var t = r.numero_acciones;

                    //ocultos para el post
                    $('#AccionesANT').attr("value", t);
                    $('#IdAccionistaANT').attr("value", Id_accionistaAnt);

                    //cambio dinamico del maximo a transferir

                    if (embargo == 1) {

                        t = t - accionesEmbargo;
                        toastr.warning('Titulo con ' + accionesEmbargo + ' acciones embargadas');
                    }

                    $('#NumNuevoCesion').attr("max", t);
                    $('#NumNuevoCesion').attr("placeholder", "Maximo a tranferir " + t);

                },
                error: function() {
                    alert('Ocurrio un error en el servidor ..');
                }
            });


            if (tipoTrasc.val() == 4) { //Anular obtener id accionista segun el titulo

                selectAccionista = $("#accionista_select");

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>accionistas/titulos/obtener_accionista_del_Titulo",
                    data: {
                        id_titulo: tituloP
                    },
                    success: function(r) {

                        id_accionista = r.replace(/ /g, "");

                        selectAccionista.val(id_accionista);

                        //desabilitar el click del select



                    }
                });



            }




        };








    });


    //validacion de cantidad de acciones cediendo

    $("#NumNuevoCesion").blur(function() {


        let NumNuevoCesion = $(this).val();

        let MaxAcciones = $(this).attr("max");

        if (NumNuevoCesion > 0) {

            let totalAcciones = MaxAcciones - NumNuevoCesion;

            if (totalAcciones == 0) {


                $('#div_nuevoT_cede').hide();
                $('#NuevoTituloqueCede').attr("required", false);

            } else {

                $('#div_nuevoT_cede').show();
                $('#NuevoTituloqueCede').attr("required", true);

            }

        }
    });
</script>