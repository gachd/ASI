<style>
    .autocomplete-items {

        /*position: absolute;*/

        position: inherit;

        border: 1px solid #d4d4d4;

        border-bottom: none;

        border-top: none;

        z-index: 99;

        /*position the autocomplete items to be the same width as the container:*/

        top: 100%;

        left: 0;

        right: 0;

    }

    .autocomplete-items div {

        padding: 10px;

        cursor: pointer;

        background-color: #fff;

        border-bottom: 1px solid #d4d4d4;

    }

    .autocomplete-items div:hover {

        /*when hovering an item:*/

        background-color: #0e990ea6;

    }

    .autocomplete-active {

        /*when navigating through the items using the arrow keys:*/

        background-color: #0e990ea6 !important;

        color: #ffffff;

    }
</style>

<div class="main">


    <div class="container-fluid ">


        <ul class="breadcrumb">
            <li><a href="<?php echo base_url()  ?>accionistas/inicio">Inicio</a></li>

            <li>Cuentas Accionistas</li>
        </ul>


    </div>

    <div class="container">

        <div class="row">

            <div class="col-md-12">
                <h2 class="h2">Cuenta corriente de Accionista</h3>
                    <br>

                    <div>
                        <span>Ingrese el rut del accionista para visualizar su información personal, sus registros como accionista como también su historial de transacciones que ha realizado a la fecha </span>
                    </div>
                    <br>

                    <div class="panel panel-default">


                        <div class="panel-heading" style="overflow: hidden;">

                            <div class="col-md-2">

                                <span><strong>Rut Accionista: </strong></span>

                            </div>

                            <div class="col-md-6">

                                <input autocomplete="off" type="text" class="form-control" name="rut_accionista" id="rut_accionista" placeholder="Ej: 11111111-1" value="">

                                <span id="rut_accionista" style="display:none;color:red;">Rut incorrecto</span>

                            </div>

                            <div class="col-md-4">


                                <button id="buscar" type="button" class="btn btn-info">

                                    <span class="glyphicon glyphicon-search"></span>

                                </button>


                            </div>

                        </div>



                    </div>

            </div>
        </div>
    </div>

    <div class="container-fluid">

        <div id="datos_accionista">



        </div>

    </div>


</div>
<script src="<?php echo base_url(); ?>assets/js/autocomplete.js"></script>
<script>
    var accionistas = [

        <?php

        $accionistas = $this->model_accionistas->accionista_sincontar_accion();

        foreach ($accionistas as $a) {

            echo '"' . $a->prsn_rut . '",';
        }

        ?>

    ];



    autocomplete(document.getElementById("rut_accionista"), accionistas);



    $("#buscar").click(function() {

        var rut = $("#rut_accionista").val();

        if (rut == "") {

            $("#rut_accionista").css("border", "1px solid red");

            $("#rut_accionista").focus();

            return false;

        } else {

            $("#rut_accionista").css("border", "1px solid #ccc");
            $("#datos_accionista").empty();
            $("#datos_accionista").addClass("spinner");

            $.ajax({

                url: "<?php echo base_url(); ?>accionistas/inicio/cuentas_corrientes",

                type: "POST",

                data: {

                    rut_accionista: rut

                },

                success: function(data) {

                   
                    $("#datos_accionista").removeClass("spinner");
                    $("#datos_accionista").html(data);

                },
                error: function(data) {

                   swal("Alerta!", "No se encontraron resgistros", "warning");

                    $("#datos_accionista").removeClass("spinner");
                    $("#datos_accionista").empty();
                   


                }


            });
        }

      
    });
</script>