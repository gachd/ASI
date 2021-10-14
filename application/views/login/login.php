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


  <link href="<?php echo base_url(); ?>/assets/css/bootstrap.min.css" rel="stylesheet">
  <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery.js"></script>
  <style type="text/css">
    @charset "utf-8";

    /* CSS Document */

    .form {
      overflow: auto;
      position: relative;
      z-index: 1;
      background: rgba(255, 255, 255, 0.47058823529411764);
      max-width: 558px;
      margin: 0 auto 100px;
      padding: 45px;
      text-align: center;
      box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
    }

    .form input {
      font-family: "Roboto", sans-serif;
      outline: 0;
      background: #f2f2f2;
      width: 100%;
      border: 0;
      margin: 0 0 15px;
      padding: 15px;
      box-sizing: border-box;
      font-size: 14px;
    }

    .form button {
      font-family: "Roboto", sans-serif;
      text-transform: uppercase;
      outline: 0;
      background: #4CAF50;
      width: 100%;
      border: 0;
      padding: 15px;
      color: #FFFFFF;
      font-size: 14px;
      -webkit-transition: all 0.3 ease;
      transition: all 0.3 ease;
      cursor: pointer;
    }

    .form button:hover,
    .form button:active,
    .form button:focus {
      background: #43A047;
    }

    .form .message {
      margin: 15px 0 0;
      color: #000;
      font-size: 12px;
    }

    .form .message a {
      color: red;
      text-decoration: none;
    }

    .form .register-form {
      display: none;
    }

    .container {
      position: relative;
      z-index: 1;
      max-width: 300px;
      margin: 0 auto;
    }

    .container:before,
    .container:after {
      content: "";
      display: block;
      clear: both;
    }

    .container .info {
      margin: 50px auto;
      text-align: center;
    }

    .container .info h1 {
      margin: 0 0 15px;
      padding: 0;
      font-size: 36px;
      font-weight: 300;
      color: #1a1a1a;
    }

    .container .info span {
      color: #4d4d4d;
      font-size: 12px;
    }

    .container .info span a {
      color: #000000;
      text-decoration: none;
    }

    .container .info span .fa {
      color: #EF3B3A;
    }

    body {
      /* Location of the image */
      background-image: url(<?php echo base_url() ?>/assets/images/fondo_login.jpg);
      /* Image is centered vertically and horizontally at all times */
      background-position: center center;
      /* Image doesn't repeat */
      background-repeat: no-repeat;
      /* Makes the image fixed in the viewport so that it doesn't move when 
   the content height is greater than the image height */
      background-attachment: fixed;
      /* This is what makes the background image rescale based on its container's size */
      background-size: cover;
      /* Pick a solid background color that will be displayed while the background image is loading */
      background-color: #464646;
      /* SHORTHAND CSS NOTATION
 * background: url(background-photo.jpg) center center cover no-repeat fixed;
 */
    }


    /* For mobile devices */

    @media only screen and (max-width: 767px) {
      body {
        /* The file size of this background image is 93% smaller
   * to improve page load speed on mobile internet connections */
        background-image: url(<?php echo base_url() ?>/assets/images/fondo_login.jpg);
      }
    }


    .logo {
      padding-top: 30px;
    }

    #msg {
      margin-top: 10px;
    }
  </style>
</head>


<body>

  <!--  <span> <?php
                phpinfo();

                echo '<pre>';
                var_dump($_SERVER);
                echo '</pre>' ?></span>
 -->
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
                  <a href="mailto:cuenta@mail.com">Enviar email a soporte</a>

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