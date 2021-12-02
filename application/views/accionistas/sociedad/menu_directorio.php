<div class="main">


    <div class="container-fluid ">


        <ul class="breadcrumb">
            <li><a href="<?php echo base_url()  ?>accionistas/inicio">Inicio</a></li>
            <li><a href="<?php echo base_url()  ?>accionistas/SA">Menu SA</a></li>
            <li>Directorio SA</li>
        </ul>

    </div>




    <div class="container">


        <div>
            <div class="row">

                <form action="" id="form-directorio" class="">

                    <div class="form-group col-md-3">

                        <label for="presidente">Presidente</label>

                        <select name="presidente" id="id_presidente" class="form-control elecciones" required>
                            <option value="">Seleccione</option>
                            <?php foreach ($accionistas as $indexA => $a) { ?>


                                <option value="<?php echo $a->id_accionista; ?>"><?php echo $a->prsn_nombres . " " . $a->prsn_apellidopaterno . " " . $a->prsn_apellidomaterno  ?></option>


                            <?php } ?>

                        </select>

                    </div>
                    <div class="form-group col-md-3">

                        <label for="vicepresidente">Vicepresidente</label>

                        <select name="vicepresidente" id="id_vicepresidente" class="form-control elecciones" required>
                            <option value="">Seleccione</option>
                            <?php foreach ($accionistas as $indexA => $a) { ?>


                                <option value="<?php echo $a->id_accionista; ?>"><?php echo $a->prsn_nombres . " " . $a->prsn_apellidopaterno . " " . $a->prsn_apellidomaterno  ?></option>


                            <?php } ?>

                        </select>

                    </div>


                    <div class="form-group col-md-3">

                        <label for="director1">Director</label>

                        <select name="director1" id="id_director1" class="form-control elecciones" required>
                            <option value="">Seleccione</option>
                            <?php foreach ($accionistas as $indexA => $a) { ?>

                                <option value="<?php echo $a->id_accionista; ?>"><?php echo $a->prsn_nombres . " " . $a->prsn_apellidopaterno . " " . $a->prsn_apellidomaterno  ?></option>

                            <?php } ?>

                        </select>

                    </div>

                    <div class="form-group col-md-3">

                        <label for="director2">Director</label>

                        <select name="director2" id="id_director2" class="form-control elecciones" required>
                            <option value="">Seleccione</option>
                            <?php foreach ($accionistas as $indexA => $a) { ?>

                                <option value="<?php echo $a->id_accionista; ?>"><?php echo $a->prsn_nombres . " " . $a->prsn_apellidopaterno . " " . $a->prsn_apellidomaterno  ?></option>

                            <?php } ?>

                        </select>

                    </div>

                    <div class="form-group col-md-3">

                        <label for="director3">Director</label>

                        <select name="director3" id="id_director3" class="form-control elecciones" required>
                            <option value="">Seleccione</option>
                            <?php foreach ($accionistas as $indexA => $a) { ?>

                                <option value="<?php echo $a->id_accionista; ?>"><?php echo $a->prsn_nombres . " " . $a->prsn_apellidopaterno . " " . $a->prsn_apellidomaterno  ?></option>

                            <?php } ?>

                        </select>

                    </div>

                    <div class="form-group col-md-3">

                        <label for="director4">Director</label>

                        <select name="director4" id="id_director4" class="form-control elecciones" required>
                            <option value="">Seleccione</option>
                            <?php foreach ($accionistas as $indexA => $a) { ?>

                                <option value="<?php echo $a->id_accionista; ?>"><?php echo $a->prsn_nombres . " " . $a->prsn_apellidopaterno . " " . $a->prsn_apellidomaterno  ?></option>

                            <?php } ?>

                        </select>

                    </div>

                    <div class="form-group col-md-3">

                        <label for="director5">Director</label>

                        <select name="director5" id="id_director5" class="form-control elecciones" required>
                            <option value="">Seleccione</option>
                            <?php foreach ($accionistas as $indexA => $a) { ?>

                                <option value="<?php echo $a->id_accionista; ?>"><?php echo $a->prsn_nombres . " " . $a->prsn_apellidopaterno . " " . $a->prsn_apellidomaterno  ?></option>

                            <?php } ?>

                        </select>

                    </div>





                    <div class="form-group col-md-3">

                        <label for="fecha_directorio">Fecha eleccion</label>

                        <input type="date" id="fecha_directorio" name="fecha_directorio" class="form-control" required>

                    </div>






                    <div class="col-md-6 col-md-offset-4">



                        <input type="submit" value="Registrar" class="btn btn-success">


                    </div>

                </form>
            </div>
        </div>

    </div>

    <div id="resultados">


    </div>


</div>


<script>
    $('#form-directorio').on('change', '.elecciones', function() {

        var select = $(this);


        $('.elecciones').each(function(index, elemento) {

            elemento = $(elemento);

            if (elemento.attr('id') != select.attr('id')) {

                if (elemento.val() == select.val()) {

                    select.val('');
                    swal("Advertencia!", "Accionista ya seleccionado", "warning");
                    elemento.focus();
                }

            }
        });


    });





    $('#form-directorio').submit(function(e) {

        e.preventDefault();

        var formData = new FormData(document.getElementById("form-directorio"));

        $.ajax({
            url: '<?php echo base_url() ?>accionistas/SA/nuevo_directorio',
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta) {
                
                
                swal({
                        title: "Registrado!",
                        text: "Directorio registrado correctamente",
                        icon: "success",
                        buttons: {

                            OK: true,
                        },
                    })
                    .then((ok) => {

                        if (ok) {

                            window.location.href = '<?php echo base_url() ?>accionistas/SA/directorio'

                        } else {
                            window.location.href = '<?php echo base_url() ?>accionistas/SA/directorio'

                        }

                    });

            }
        });

    });
</script>