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
                icon: "success",
            });
        </script>

    <?php } ?>

    <?php
    /*print_r($this->session->all_userdata());*/
    echo form_open(base_url() . 'turnos/planificacion/guardar', array('id' => 'form_planificacion'));
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
                <?php
                $year = annio_planificar();

                for ($i = $year; $i >= 2016; $i--) {
                    echo '<option value="' . $i . '">' . $i . '</option>';
                }
                ?>

            </select>
        </div>
        <!--mes-->
        <div class="col-md-2">
            <!--   <div class="input-form-sm"> -->
            <label for="mes">Mes:</label>
            <select class="form-control form-control-sm" name="mes" id="mes">
                <?php

                $meses = obtener_meses();
                foreach ($meses as $key => $value) {
                    echo '<option value="' . $key . '">' . $value . '</option>';
                }

                ?>
            </select>
            <!--     </div>-->
        </div>
        <!--tipo-->
        <!--  <div class="input-form-sm">-->
        <div class="col-md-2">
            <label for="tipo_funcionario">Tipo:</label>
            <select class="form-control" name="tipo_funcionario" id="tipo_funcionario">
                <!--  <option value="0">Seleccionar</option> -->
                <!--       <option value="2">Personal Stadio</option>
                <option value="4">Guardias</option>
                <option value="5">Cocina Stadio</option>
                <option value="6">Auxiliares Galeria</option> -->
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
    $('#form_planificacion').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        let method = form.attr('method');
        var data = form.serialize();
        
 
     $.ajax({
         type: method,
         url: url,
         data: data,
         dataType: 'json',
         
         success: function (rJson) {

            console.log(rJson);

            

            $('#planificacion').empty();

            swal({
                title: "Turnos",
                text: "Planificación cargada correctamente",
                icon: "success",
            });
             
         }
     });

      
    });



    $.get("<?php echo base_url() ?>turnos/planificacion/carga_tipo", function(data) {

        $('#tipo_funcionario').html(data);

    });


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

        $('#planificacion').html('<div class="spinner"></div>');

        tipo_funcionario = $('#tipo_funcionario').val();
        funcionario = $('#funcionario').val();
        mes = $('#mes').val();
        year = $('#year').val();





        if (tipo_funcionario == 0) {

            swal({
                title: "Seleccione una opción",
                text: "Debe seleccionar un tipo de funcionario",
                icon: "warning",
            });

            $('#planificacion').empty();

        } else {


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
        }



    });

    /*$('select').on('change', function(ev) {
    $(this).attr('class', '').addClass($(this).children(":selected").attr("id"));
    });*/
</script>