<style>
  .audio {
    display: none
  }
</style>
<div class="main">
  <div class="container">



    <h3>Validar entrada</h3>
    <div class="linea_separacion "></div>

    <div class="from-group">
    
    <h4>Selecciones una Camara</h4>
    <select id="select" class="form-control"></select>


    </div>

    <br>
    <canvas class="col-md-6"></canvas>
    
    <ul></ul>
    <audio id="audio" class="audio" controls>
      <source type="audio/wav" src=" <?php echo base_url() . "assets/audio/beep_qr.mp3"  ?>">
    </audio>
  </div>
</div>


<script type="text/javascript" src="<?php echo base_url() ?>assets/js/qrcodelib.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/webcodecamjs.js"></script>

<script type="text/javascript">

  var decoder = new WebCodeCamJS("canvas").buildSelectMenu('select', 'environment|back').init().play();

  document.getElementById('select').addEventListener('change', function() {

    decoder.stop().play();

  });

 

// SONIDO AL DETECTAR QR
  var beep = document.getElementById("audio");



  // ESTE ES EL QUE SE EJECUTA AL DETECTAR UN CODIGO QR , NO BORRAR

  function resultado(res) {

    codigo = res.code;
    beep.play();
    decoder.pause();
    //decoder.stop();

    if (confirm(`Socio ${codigo}?`)) {
      decoder.play();
    } else {
      decoder.play();
    }


  };
</script>