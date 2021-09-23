<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness</title>
</head>


<style>
    .modal-dialog {

        top: 10%;

    }
</style>

<body>





    <div class="main">

        <div class="container">


            <div class="row table-responsive">


                <table id="tabla_socios" class="table tabla_dinamica" style="overflow-x: auto;">

                    <thead>

                        <th>Rut</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Edad</th>
                        <th>Acciones</th>

                    </thead>
                    <tbody>


                        <?php foreach ($socios as $s) { ?>

                            <tr>
                                <td><?php echo $s->prsn_rut ?></td>
                                <td><?php echo $s->prsn_nombres ?></td>
                                <td><?php echo $s->prsn_apellidopaterno . " " . $s->prsn_apellidomaterno   ?></td>
                                <td><?php echo $s->prsn_fechanacimi ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal_Beneficiario" data-rut="<?php echo $s->prsn_rut ?>" data-accion="Ver" data-backdrop="static" data-keyboard="false">
                                        Ver
                                    </button>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal_Beneficiario" data-rut="<?php echo $s->prsn_rut ?>" data-accion="Editar" data-backdrop="static" data-keyboard="false">
                                        Editar

                                    </button>
                                </td>

                            </tr>

                        <?php } ?>


                    </tbody>


                </table>


            </div>

        </div>

        <!-- Modal -->


        <div class="modal fade container-fluid " id="Modal_Beneficiario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class=" container-fluid " role="document">


                <div class="modal-content" id="contenido_modal">


                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>


                    </div>
                    <div class="modal-body" id="body_modal">
                      <!--   <form>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Recipient:</label>
                                <input type="text" class="form-control" id="recipient-name">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Message:</label>
                                <textarea class="form-control" id="message-text"></textarea>
                            </div>
                        </form> -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Send message</button>
                    </div>


                </div>
            </div>
        </div>

        <!--   fin modal -->





    </div>














</body>





<script type="text/javascript">
    $('#Modal_Beneficiario').on('show.bs.modal', function(event) {






        var boton = $(event.relatedTarget);
        console.log(boton);

        var rut = boton.data('rut');
        var accion = boton.data('accion');


        

        $.ajax({
            type: "POST",
            url: "<?php echo base_url()  ?>socios/fitness/buscarSocio",
            data: {

                rut: rut,
                accion:accion,

            },
           
            success: function(datos) {

              

                $("#body_modal").append(datos);
                



            }
        });









        /* 
                var modal = $(this);

                modal.find('.modal-title').text(rut + ' ' + accion);

                modal.find('.modal-body input').val(rut) */

    })

    $('#Modal_Beneficiario').on('hidden.bs.modal', function(e) {
        $("#body_modal").empty();
    });





    $(document).ready(function() {
        $('#tabla_socios').DataTable();
    });
</script>

</html>