<div class="main">
    <form action="<?php echo base_url() . 'correo/envio_correo' ?>" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="">Nombre</label>
            <input type="text" name="nombre" class="form-control" placeholder="Ingrese su nombre" required>

        </div>

        <div>
            <label for="">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Ingrese su email" required>
        </div>

        <div class="form-group">
            <label for="">Asunto</label>
            <input type="text" name="asunto" class="form-control" placeholder="Ingrese su nombre" required>

        </div>

        <div class="form-group">
            <label for="">Asunto</label>
            <textarea class="form-control" name="mensaje" id="mensaje" cols="30" rows="10" required></textarea>

        </div>

        <div class="form-group">
            <label for="">Adjuntar archivo</label>
            <input type="file" name="archivo" class="form-control" required>

        </div>

        <div class="form-group">
            <input type="submit" value="Enviar" class="btn btn-primary">

        </div>
        




    </form>


</div>