<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Validacion Entrada</title>
</head>
<script src="https://raw.githubusercontent.com/mebjas/html5-qrcode/master/minified/html5-qrcode.min.js"></script>

<body>
  <div class="main">

    <div class="container">



      <h3>Testqr</h3>
      <hr>

      <br>
      <div style="width: 500px" id="reader"></div>
      <hr>
      <input type="hidden" name="qr_texto" id="qr_texto">
      <hr>
      <ul></ul>
    </div>

  </div>
  <script>
    function onScanSuccess(decodedText, decodedResult) {
      // Handle on success condition with the decoded text or result.
      console.log(`Scan result: ${decodedText}`, decodedResult);
    }

    var html5QrcodeScanner = new Html5QrcodeScanner(
      "reader", {
        fps: 10,
        qrbox: 250
      });
    html5QrcodeScanner.render(onScanSuccess);
  </script>

</body>

</html>