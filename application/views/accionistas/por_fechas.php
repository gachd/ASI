<!DOCTYPE html>

<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/styleAccion.css">
    <meta charset="UTF-8">

    <title>Titulos</title>



</head>
<style>
    .table_wrapper {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
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
                <li><a href="<?php echo base_url() ?>accionistas/inicio">Inicio</a></li>

                <li>Estado por Fecha</li>
            </ul>
        </div>









        <div class="container">
            <h3><strong>Reporte de Accionistas segun fecha</strong></h3>
            <br>

            <div class="well row">
                <form action="<?php echo base_url(); ?>accionistas/inicio/informe_fechas_accionistas2" method="POST" target="_blank" ">


                    <div class=" form-group col-md-6">
                    <label for="Tipoinforme">Tipo de informe</label>
                    <select class="form-control" name="tipoinforme" id="Tipoinforme" required>

                        <option value="">Seleccione</option>
                        <option value="0">Bajas</option>
                        <option value="1">Incorporaciones</option>

                    </select>
            </div>




            <div class="form-group col-md-4 ">
                <label>Seleccione Fecha Desde</label>
                <input class="form-control" type="date" name="fecha1" id="Fecha1" max="<?php echo date('Y-m-d') ?>" autocomplete="off" required>
            </div>

            <div class="form-group col-md-4 ">
                <label>Seleccione Fecha Hasta</label>
                <input class="form-control" type="date" name="fecha2" id="Fecha2" max="<?php echo date('Y-m-d') ?>" autocomplete="off" required>


            </div>

            <div class="col-md-2">
                <div class="form-group">

                    <a href="#" id="Click" class="btn btn-default btn-lg">Buscar</a>
                </div>
                <div class="form-group">

                    <button class="btn btn-default"><span class="glyphicon glyphicon-circle-arrow-down"> PDF</span></button>
                </div>


            </div>

            

            </form>
        </div>

    </div>

    <div class="container table-responsive">
        <table class="table " id="Tabla">
        </table>



    </div>







    <br>
    <br>







    </div>

</body>
<link href="<?php echo base_url(); ?>/assets/vendors/datatables/dataTables.bootstrap.css" rel="stylesheet" media="screen">

<!-- jQuery necessary for Bootstrap's JavaScript plugins -->

<script src="https://code.jquery.com/jquery.js"></script>

<!-- jQuery UI -->
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->


<script src="<?php echo base_url(); ?>/assets/vendors/datatables/js/jquery.dataTables.min.js"></script>

<script src="<?php echo base_url(); ?>/assets/vendors/datatables/dataTables.bootstrap.js"></script>

<script src="<?php echo base_url(); ?>/assets/js/custom.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/tables.js"></script>

<!-- Latest compiled and minified CSS -->

<script type="text/javascript">
    $("#menuprincipal").click(function() {
        window.location.href = "<?php echo base_url(); ?>accionistas/inicio";
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


        /* 
                $("#Fecha1,#Fecha2").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    maxDate: +0,
                    yearRange: "-100:+0",
                    beforeShow: rangoCustom,
                    dateFormat: "yy-mm-dd",

                });
         */



    });





    function getEstado(estado) {

        if (estado == 1) {

            return "Activo";

        } else {

            return "Inactivo";

        }

    }



    $('#Fecha1').change(function() {


        $('#Fecha2').attr('min', $(this).val())


    });
    $('#Fecha2').change(function() {


        $('#Fecha1').attr('max', $(this).val())


    });


    $("#Click").click(function() {

        if (!$("#Tipoinforme").val() == 0) {

            $("#Tabla").empty()



            if ($("#Fecha1").val() == 0 || $("#Fecha1").val() == 0) {

                swal({
                    title: "Seleccione Fechas",
                    icon: "info",
                    button: "OK",
                });



            } else {

                cargarDatos();

            }




        } else {

            swal({
                title: "Seleccione el tipo de infome",
                icon: "info",
                button: "OK",
            });
        };




    });



    function cargarDatos() {
        var fecha1 = $("#Fecha1");
        var fecha2 = $("#Fecha2");
        var tipo = $("#Tipoinforme");
        $("#Tabla").removeClass('table-bordered');
        $("#Tabla").append('<div class="center-block" ><img src="<?php echo base_url(); ?>assets/img/loader.gif" alt=""></div>');

        





        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>accionistas/inicio/informe_fechas_accionistas",
            data: {

                fecha1: fecha1.val(),
                fecha2: fecha2.val(),
                tipoinforme: tipo.val(),
            },


            success: function(response) {
                $("#Tabla").empty();
                $("#Tabla").addClass('table-bordered');


                console.log(response);
                console.log(response.length);

                if (response.length > 4) {

                    //mostrar bajas

                    if (tipo.val() == 0) {

                        var datos = JSON.parse(response);

                        $("#Tabla").append(
                            '<tr><th>Nombre</th>' +
                            '<th>Apellido paterno</th>' +
                            '<th>Baja</th>' +
                            '<th>Estado Actual</th>');


                        console.log(datos)
                        for (i = 0; i < datos.length; i++) {

                            $("#Tabla").append('<tr>' +
                                '<td>' + datos[i].prsn_nombres + '</td>' +
                                '<td>' + datos[i].prsn_apellidopaterno + '</td>' +
                                '<td>' + datos[i].fecha_baja + '</td>' +
                                '<td>' + getEstado(datos[i].estado_accionista) + '</td>' + '</tr>');
                        }



                    }

                    //Mostrar incorporaciones
                    if (tipo.val() == 1) {

                        var datos = JSON.parse(response);

                        $("#Tabla").append(
                            '<tr><th>Nombre</th>' +
                            '<th>Apellido paterno</th>' +
                            '<th>Incorporacion</th>' +
                            '<th>Estado Actual</th>');
                        // alert(fecha1.val() + ' ' + fecha2.val() + ' ' + tipo.val())

                        console.log(datos)
                        for (i = 0; i < datos.length; i++) {

                            $("#Tabla").append('<tr>' +
                                '<td>' + datos[i].prsn_nombres + '</td>' +
                                '<td>' + datos[i].prsn_apellidopaterno + '</td>' +
                                '<td>' + datos[i].fecha + '</td>' +
                                '<td>' + getEstado(datos[i].estado_accionista) + '</td>' + '</tr>');
                        }




                    }




                } else {

                    swal({
                        title: "No se encontraron registros",
                        icon: "info",
                        button: "OK",
                    });


                }




            },
            error: function() {
                alert('Ocurrio un error en el servidor ..');

            }
        });



    }
</script>

</html>