
   



<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>assets/icon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url(); ?>assets/icon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/icon/favicon-16x16.png">
  <link rel="manifest" href="<?php echo base_url(); ?>assets/icon/site.webmanifest">
  <link rel="mask-icon" href="<?php echo base_url(); ?>assets/icon/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#2b5797">
  <meta name="theme-color" content="#ffffff">








  <title>Stadio Italiano Di Concepcion</title>
  <link href="<?php echo base_url(); ?>/assets/css/login.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>/assets/css/bootstrap.min.css" rel="stylesheet">
  <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery.js"></script>
  <style type="text/css">
    #msg {
      margin-top: 10px;
    }
  </style>
</head>

<body>
<!-- <h1> <?php echo $_SERVER['SERVER_ADDR']?></h1> -->
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="login-page">
        <div class="form">
          <?php echo form_open(base_url() . 'login'); ?>
          <?php echo validation_errors(); ?>
          <form class="login-form">
            <div class="row">
              <div class="col-md-4 logo"><img width="150" src="https://www.stadioitalianodiconcepcion.cl/ASI/assets/images/logo_instituciones.png"></div>
              <div class="col-md-8">
                <input type="text" placeholder="Usuario" name="username" />
                <input type="password" placeholder="Contraseña" name="password" />
                <button>ingresar</button>
                <p class="message"> No estas registrado?
                  <a href="mailto:cuenta@demail.com">Clicka para enviar email a soporte</a>
                
                </p>
                <?php echo form_close(); ?>
              </div>
            </div>
            <div class="row-fluid">
              <?php if ($_POST['msj'] == 1) { ?>
                <div id="msg">
                  <div class="alert alert-danger" id="msg-alert">
                    <strong>ACCESO DENEGADO!</strong><br> Favor ingrese sus datos correctamente.
                  </div>
                </div>
              <?php } ?>
            </div>
          </form>

        </div>

      </div>
    </div>
  </div>
</body>

</html>

<doctype html>