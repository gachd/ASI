<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Validacion Entrada</title>
</head>

<body>
  <div class="main">

    <div class="container">



      <h3>Testqr</h3>
      <hr>
      <select class="form-control"></select>
      <br>
      <canvas class="container"></canvas>
      <hr>
      <input type="hidden" name="qr_texto" id="qr_texto">
      <hr>
      <ul></ul>
    </div>

  </div>
  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/qrcodelib.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/webcodecamjs.js"></script>
  <script type="text/javascript">
    var decoder = new WebCodeCamJS("canvas").buildSelectMenu('select', 'environment|back').init(arg).play();

    document.getElementById('select').addEventListener('change', function() {
      decoder.stop().play();
    });

    var arg = {
      resultFunction: function(resultado) {

        console.log(resultado);
        $('#qr_texto').val(resultado.code);
        decoder.stop();

        swal({
            title: "Valido!",
            text: "Con el rut: " + $('#qr_texto').val(),
            icon: "success",
          })
          .then((ok) => {
            if (ok) {
              decoder.play();
            } else {
              decoder.play();
            }

          });






      }
    };
  </script>
</body>

</html>