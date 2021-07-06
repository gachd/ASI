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
            <form action="<?php echo base_url();?>accionistas/inicio/informe_fechas_accionistas" method="POST" > 
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
                    <input class="form-control" type="text" name="fecha2" id="Fecha2" autocomplete="off" required >


                </div>


                <div class="form-group">
                    <button id="cesion" class="btn btn-default btn-lg btn-block">Buscar</button>
                </div>







            </form>


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
</script>

</html>