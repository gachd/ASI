<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>assets/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url(); ?>assets/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/icon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo base_url(); ?>assets/icon/site.webmanifest">
    <link rel="mask-icon" href="<?php echo base_url(); ?>assets/icon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#2b5797">
    <meta name="theme-color" content="#ffffff">
    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
  


    <title>Error Sesion</title>

</head>

<body>

    <div class="container">


        <h2>Acceso restringido. </h2>
        <h5 id="mensaje"> </h5>



        <a class="btn btn-success" href="<?php echo base_url() ?>login">Iniciar sesion</a>

    </div>



    <script>
        function redireccion() {
            document.getElementById('mensaje').innerHTML = 'Será redirigido después de <span id="contador"></span> segundos ...';
            var count =30;
            document.getElementById('contador').innerHTML = count;
            setInterval(function() {
                count--;
                document.getElementById('contador').innerHTML = count;
                if (count == 0) {
                    window.location = '<?php echo base_url() ?>';
                }


            }, 1000); // cada un segundo se ejecuta


        }

     
      


    

        redireccion();
    </script>

</body>

</html>