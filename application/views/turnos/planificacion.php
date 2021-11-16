<style type="text/css">
    #funcionario {
        text-transform: uppercase;
    }

    select#turnos {
        font-size: 11px;
        appearance: none;
        -webkit-appearance: none;
    }

    .tb_planificacion {
        font-size: 11px;
    }

    .tb_planificacion>tbody>tr>td {
        padding: 5px;
        /* text-align: center; */
        text-transform: uppercase;
    }

    .input-form-sm {
        width: 10%;
        float: left;
        /*background: aqua;*/
        margin-right: 15px;
    }


    <?php

    foreach ($turnos as $t) {
        echo 'select.' . $t->sigla . ' { background: ' . $t->color . ' !important; }';
    }


    ?>
</style>

<div class="main">
<?php if ($this->session->flashdata('category_success')) {  ?>

<script>
  swal({
    title: "Turnos",
    text: "<?php echo $this->session->flashdata('category_success'); ?>",
    timer: 4000,
    type: 'success',
    showConfirmButton: false
  });
</script>

<?php } ?>

    <?php
    /*print_r($this->session->all_userdata());*/
    echo form_open(base_url() . 'turnos/planificacion/guardar');
    echo validation_errors();
    ?>
    <nav class="navbar navbar-default nav-titulo">

        <div class="col-md-2">
            <h1 style="text-align:center;">PLANIFICACIÓN DE TURNOS</h1>
        </div>
        <!--año-->
        <div class="col-md-2">
            <label for="year">Año:</label>
            <select class="form-control" name="year" id="year">
                <option value="2021">2021</option>
                <option value="2020">2020</option>
                <option value="2019">2019</option>
                <option value="2018">2018</option>
                <option value="2017">2017</option>

            </select>
        </div>
        <!--mes-->
        <div class="col-md-2">
            <!--   <div class="input-form-sm"> -->
            <label for="mes">Mes:</label>
            <select class="form-control form-control-sm" name="mes" id="mes">
                <option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
            </select>
            <!--     </div>-->
        </div>
        <!--tipo-->
        <!--  <div class="input-form-sm">-->
        <div class="col-md-2">
            <label for="tipo_funcionario">Tipo:</label>
            <select class="form-control" name="tipo_funcionario" id="tipo_funcionario">
               <!--  <option value="0">Seleccionar</option> -->
                <option value="2">Personal Stadio</option>
                <option value="4">Guardias</option>
            </select>
        </div>
        <!--     </div>-->
        <!--funcionario-->
        <!--  <div class="input-form-sm">-->
        <div class="col-md-2">
            <label for="funcionario">Funcionario:</label>
            <select class="form-control" name="funcionario" id="funcionario">
                <option value="0">Todos</option>

            </select>
        </div>
        <!--     </div>-->
        <!--boton-->
        <div class="col-md-2">
            <!--  <div class="input-form-sm">-->
            <button type="button" class="btn btn-primary" id="enviar" style="margin-top: 15px; ">Cargar</button>
            <!--     </div>-->
        </div>

    </nav>









    <div class="panel-body" id="planificacion">

    </div>






</div>

<script>
    $(document).ready(function() {



    $("#tipo_funcionario").change(function() {

        $("#tipo_funcionario option:selected").each(function() {

            tipo_fun = $('#tipo_funcionario').val();

            $.post("<?php echo base_url() ?>turnos/planificacion/select_funcionario", {


                tipo_fun: tipo_fun

            }, function(data) {
                $("#funcionario").empty();
                $("#funcionario").append(data);
            });
        });
    })



    $("#mes , #year, #tipo_funcionario, #funcionario").change(function() {
        
        

        $('#planificacion').empty();


    });









    });








    $("#enviar").click(function() {

        $('#planificacion').html('<div><img src="<?php echo base_url() ?>assets/images/loading.gif"/></div>');

        tipo_funcionario = $('#tipo_funcionario').val();
        funcionario = $('#funcionario').val();
        mes = $('#mes').val();
        year = $('#year').val();


        $.post("<?php echo base_url() ?>turnos/planificacion/cargar", {
                funcionario: funcionario,
                year: year,
                mes: mes,
                tipo_funcionario: tipo_funcionario
            },
            function(data) {
                $('#planificacion').empty();
                $("#planificacion").html(data);


                $('#planificacion select').on('change', function(ev) {
                    $(this).attr('class', '').addClass($(this).children(":selected").attr("id"));
                    //$("select[name*='turno']").addClass($(this).children(":selected").attr("id"));


                });


            });

    });

    /*$('select').on('change', function(ev) {
    $(this).attr('class', '').addClass($(this).children(":selected").attr("id"));
    });*/
</script>