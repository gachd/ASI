<!DOCTYPE html>

<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
    <br>
    <br>
    <br>


    <div class="main">

        <div class="col-md-1">
            <button type="button" class="btn btn-primary" id="menuprincipal"><span class="badge"><i class="glyphicon glyphicon-home"></i> Menú <br> Principal</span></button>
        </div>







        <div class="container" id="advanced-search-form" style="border:1px solid ">
            <h3><strong>Reporte de Accionistas segun fecha</strong></h3>
            <br>
            <form action="<?php echo base_url(); ?>accionistas/inicio/informe_fechas_accionistas2" method="POST"  target="_blank" >
                <div class="form-group">
                    <label for="Tipoinforme">Tipo de informe</label>
                    <select class="form-control" name="tipoinforme" id="Tipoinforme" required>

                        <option value="">Seleccione</option>
                        <option value="0">Bajas</option>
                        <option value="1">Incorporaciones</option>

                    </select>
                </div>




                <div class="form-group">
                    <label>Seleccione Fecha</label>
                    <input class="form-control" type="text" name="fecha1" id="Fecha1" autocomplete="off" required>
                </div>

                <div class="form-group">
                    <label>Seleccione Fecha</label>
                    <input class="form-control" type="text" name="fecha2" id="Fecha2" autocomplete="off" required>


                </div>


                <div class="form-group">

                    <a href="#" id="Click" class="btn btn-default btn-lg btn-block">Buscar</a>
                </div>
                <div class="form-group">

                    <button class="btn"><span class="glyphicon glyphicon-circle-arrow-down"> PDF</span></button>
                </div>
            </form>













        </div>

        <div class="container" id="advanced-search-form">
            <table class="table table-striped table-bordered" id="Tabla">
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



        $("#Fecha1").datepicker({
            dateFormat: "yy-mm-dd",
            changeYear: true,
            yearRange: "-100:+0"


        });;

        $("#Fecha2").datepicker({
            dateFormat: "yy-mm-dd",
            changeYear: true,
            yearRange: "-100:+0"


        });;
    });









    $("#Click").click(function() {

        $("#Tabla").empty()
        cargarDatos();


    });



    function cargarDatos() {
        var fecha1 = $("#Fecha1");
        var fecha2 = $("#Fecha2");
        var tipo = $("#Tipoinforme");


      

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>accionistas/inicio/informe_fechas_accionistas",
            data: {

                fecha1: fecha1.val(),
                fecha2: fecha2.val(),
                tipoinforme: tipo.val(),
            },


            success: function(response) {

                console.log(response);
                console.log(response.length);

                if (response.length > 4) {

                    //mostrar bajas

                    if (tipo.val() == 0) {

                        var datos = JSON.parse(response);

                        $("#Tabla").append(
                            '<tr><td>Nombre</td>' +
                            '<td>Apellido paterno</td>' +
                            '<td>Baja</td>' +
                            '<td>Estado</td>');
                        

                        console.log(datos)
                        for (i = 0; i < datos.length; i++) {

                            $("#Tabla").append('<tr>' +
                                '<td>' + datos[i].prsn_nombres + '</td>' +
                                '<td>' + datos[i].prsn_apellidopaterno + '</td>' +
                                '<td>' + datos[i].fecha_baja + '</td>' +
                                '<td>' + datos[i].estado_accionista + '</td>' + '</tr>');
                        }



                    }

                    //Mostrar incorporaciones
                    if (tipo.val() == 1) {

                        var datos = JSON.parse(response);

                        $("#Tabla").append(
                            '<tr><td>Nombre</td>' +
                            '<td>Apellido paterno</td>' +
                            '<td>Incorporacion</td>' +
                            '<td>Estado</td>');
                        // alert(fecha1.val() + ' ' + fecha2.val() + ' ' + tipo.val())

                        console.log(datos)
                        for (i = 0; i < datos.length; i++) {

                            $("#Tabla").append('<tr>' +
                                '<td>' + datos[i].prsn_nombres + '</td>' +
                                '<td>' + datos[i].prsn_apellidopaterno + '</td>' +
                                '<td>' + datos[i].fecha + '</td>' +
                                '<td>' + datos[i].estado_accionista + '</td>' + '</tr>');
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



        // for (i = 0; i < DatosJson.alumnoUTP.length; i++) {

        //     $("#Table").append('<tr>' +
        //         '<td align="center" style="dislay: none;">' + DatosJson.alumnoUTP[i].nombre + '</td>' +
        //         '<td align="center" style="dislay: none;">' + DatosJson.alumnoUTP[i].apePaterno + '</td>' +
        //         '<td align="center" style="dislay: none;">' + DatosJson.alumnoUTP[i].edad + '</td>' + '</tr>');
        // }
    }
</script>

</html>