

<body style="padding-top:50px;">




  <div class="container well">
    





    <?php if (isset($error)) : ?>
      <?php if ($error) : ?>

        <script>
          toastr.options = {
            "closeButton": true
          }
          toastr.error("<?php echo $error ?>");
          swal("ERROR", "<?php echo $error ?>", "error");
        </script>
      <?php endif; ?>

    <?php endif; ?>



    <?php if (isset($subido)) : ?>
      <?php if ($subido) : ?>

        <script>
          toastr.options = {
            "closeButton": true
          }
          toastr.success("<?php echo $subido ?>");
         
        </script>


      <?php endif; ?>
    <?php endif; ?>

    <?php if (isset($path)) : ?>
      <a href=" <?php $path ?>"></a>
     

    <?php endif; ?>



<?php  ?>

    <form method="post" enctype="multipart/form-data" action="<?php echo base_url() ?>socios/TestCarga/cargar">

      <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" id="nombre" aria-describedby="nombre" placeholder="Nombre" name="nombre" required>
      </div>




      <div class="form-group">
        <label for="file">Subir archivo</label>
        <input type="file" class="form-control-file" id="file" name="userfile" required>
      </div>

      <div class="form-group">

        <button type="submit" class="btn btn-success">Enviar formulario</button>
      </div>



    </form>

    <?php if (isset($path)) : ?>
      <a href=" <?php  echo  base_url()."".$path ?>">AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA</a>
     

    <?php endif; ?>


  </div>




</body>