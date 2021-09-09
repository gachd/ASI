<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous">
</script>

<style>
    .img-responsive {
        cursor: pointer;
        object-fit: cover;
        object-position: center center;
        width: 120px;
        height: 120px;
    }
</style>

<div class="col-md-2">
    <center>

        <label for="imagen_perfil">
            <img alt="Foto SOCIO" src="<?php echo base_url() ?>assets/images/nuevosocio.png" id="img_perfil" class="img-circle img-responsive img-thumbnail">
        </label>
        <div class="subida_oculto">
            <input type="file" name="img_perfil" id="imagen_perfil" accept="image/png,image/jpeg" onchange="ver_foto()">
        </div>


        <button id="subir">Subir</button>





    </center>


</div>

<script>
    //Funcion para ver foto en miniatura
    var validar_subida = 0

    function ver_foto() {
        var img = document.getElementById('img_perfil');
        var inputFile = document.getElementById('imagen_perfil').files[0];
        var reader = new FileReader();

        reader.onloadend = function() {
            img.src = reader.result;
        }

        if (inputFile) {
            reader.readAsDataURL(inputFile);
            validar_subida = 1;
        } else {
            img.src = "<?php echo base_url() ?>assets/images/nuevosocio.png";
            validar_subida = 0;
        }
    }

    var btnGuardar = $("#subir");


    btnGuardar.click(function() {






        //Subiada de imagen
        var formData = new FormData();
        var archivos = document.getElementById('imagen_perfil').files[0];

        console.log(archivos);

        formData.append('doc', archivos);
        formData.append('valido', validar_subida);

        $.ajax({

            url: "http://192.168.20.4/ASI/socios/Editacarga/test_foto",

            data: formData,

            type: 'POST',

            contentType: false,

            processData: false,

            success: function(resultados) {




            }



        });

    });
</script>