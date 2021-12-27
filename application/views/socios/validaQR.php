<style>

#audio{
display: none
}

</style>
<div class="main">
  <div class="container">



    <h3>Testqr</h3>
    <hr>
    <select id="select" class="form-control"></select>
    <br>
    <canvas class="col-md-6"></canvas>
    <hr>
    <input type="hidden" name="qr_texto" id="qr_texto">
    <hr>
    <ul></ul>
    <audio id="audio" controls>   
      <source type="audio/wav" src=" <?php echo base_url()."assets/audio/beep_qr.mp3"  ?>">
    </audio>
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

  };

  var audio = document.getElementById("audio");



  function resultado(res) {

    codigo = res.code;
    audio.play();
    decoder.pause();
    //decoder.stop();

    if (confirm(`Socio ${codigo}?`)) {
      decoder.play();
    } else {
      decoder.play();
    }


  };
</script>