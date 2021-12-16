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
            <div class="row well">
                <div class="panel panel-default">
                    <h3 class="h3" style="margin-left:13px;">Nuevo Directorio</h3>
                </div>



                <form action="" id="form-directorio" class="">

                    <div class="form-group col-md-3">

                        <label for="">Junta</label>
                        <select name="junta" id="junta" class="form-control" required>
                            <option value="">Seleccione</option>
                            <?php foreach ($juntas as $j) { ?>
                                <option value="<?php echo $j->id_junta ?>"><?php echo formato_fecha($j->fecha_junta) . "  " . $j->asunto_junta ?></option>
                            <?php } ?>
                        </select>

                    </div>

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





                    <!--   <div class="form-group col-md-3">

                        <label for="fecha_directorio">Fecha eleccion</label>

                        <input type="date" id="fecha_directorio" name="fecha_directorio" class="form-control" required>

                    </div> -->

                    <div class="form-group col-md-4 col-md-offset-4" style="text-align: center;">

                        <label for="gerente">Gerente</label>

                        <input type="text" id="gerente" name="gerente" class="form-control" onkeyup="mayusculas(this)" required>

                    </div>






                    <div class="col-md-4 col-md-offset-4" style="text-align: center;">



                        <input type="submit" value="Registrar" class="btn btn-success">


                    </div>

                </form>
            </div>
        </div>



    </div>
    <br>

    <div class="container-fluid ">


        <div class="well">

            <div class="panel panel-default">

                <div class="panel-heading">

                    <h2 class="panel-title">Elecciones Historicas</h2>
                    <br>

                </div>




                <div id="div_tabla_directorio" class="table-responsive">

                </div>
            </div>

        </div>


    </div>




</div>


<script>
    const CargatablaDirectorio = () => {

        divtabla = $('#div_tabla_directorio');


        $.ajax({
            url: '<?php echo base_url("accionistas/SA/getDirectorios") ?>',
            type: 'GET',
            dataType: 'json',
            success: function(data) {


                let directorio = data.directorio;

                console.log(directorio);

                if (directorio) {


                    let html = '';

                    html += `<table class="table table-striped table-bordered table-hover" id="tabla_directorio" style="font-size: 12px;" >
                                <thead>
                                    <tr>
                                        <th>Fecha Eleccion</th>
                                        <th>Presidente</th>
                                        <th>Vicepresidente</th>
                                        <th>Director</th>
                                        <th>Director</th>
                                        <th>Director</th>
                                        <th>Director</th>
                                        <th>Director</th>
                                        <th>Gerente</th>
                                        <th>Junta</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>`;

                    for (let index = directorio.length - 1; index >= 0; index--) {

                        let fecha = directorio[index].fecha;
                        let presidente = directorio[index].presidente;
                        let vice = directorio[index].vicepresidente;
                        let gerente = directorio[index].gerente;
                        let directores = directorio[index].director;
                        let junta = directorio[index].junta;

                        html += `<tr>
                                    <td>${fecha}</td>
                                    <td>${presidente.prsn_nombres} ${presidente.prsn_apellidopaterno} ${presidente.prsn_apellidomaterno}</td>
                                    <td>${vice.prsn_nombres} ${vice.prsn_apellidopaterno} ${vice.prsn_apellidomaterno}</td>
                                    <td>${directores[1].prsn_nombres} ${directores[1].prsn_apellidopaterno} ${directores[1].prsn_apellidomaterno}</td>
                                    <td>${directores[2].prsn_nombres} ${directores[2].prsn_apellidopaterno} ${directores[2].prsn_apellidomaterno}</td>
                                    <td>${directores[3].prsn_nombres} ${directores[3].prsn_apellidopaterno} ${directores[3].prsn_apellidomaterno}</td>
                                    <td>${directores[4].prsn_nombres} ${directores[4].prsn_apellidopaterno} ${directores[4].prsn_apellidomaterno}</td>
                                    <td>${directores[5].prsn_nombres} ${directores[5].prsn_apellidopaterno} ${directores[5].prsn_apellidomaterno}</td>                            
                                    <td>${gerente}</td>
                                    <td>${junta.asunto_junta}</td>
                                </tr>`;

                    }

                    html += `</tbody>
                            </table>`;

                    divtabla.html(html);

                    tabla = $('#tabla_directorio');


                    tabla.DataTable({
                        "language": spain,

                        "order": [
                            [0, "desc"]
                        ],

                    });

                } else {
                    divtabla.html(`<h5>No hay registros</h5>`);
                }




            }
        });

    }

    CargatablaDirectorio();


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
        let formulario = $(this);

        $.ajax({
            url: '<?php echo base_url() ?>accionistas/SA/nuevo_directorio',
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta) {

                formulario.trigger('reset');
                CargatablaDirectorio();



                swal({
                    title: "Registrado!",
                    text: "Directorio registrado correctamente",
                    icon: "success",
                    buttons: {

                        OK: true,
                    },
                })

            }
        });

    });
</script>