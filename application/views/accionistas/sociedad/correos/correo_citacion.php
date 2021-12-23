<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="x-apple-disable-message-reformatting">
  <title></title>

  <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet" />
  <!--[if mso]>
  <style>
    table {border-collapse:collapse;border-spacing:0;border:none;margin:0;}
    div, td {padding:0;}
    div {margin:0 !important;}
  </style>
  <noscript>
    <xml>
      <o:OfficeDocumentSettings>
        <o:PixelsPerInch>96</o:PixelsPerInch>
      </o:OfficeDocumentSettings>
    </xml>
  </noscript>
  <![endif]-->
  <style>
    table,
    td,
    div,
    h1,
    p {
      font-family: Arial, sans-serif;
    }

    @media screen and (max-width: 530px) {
      .unsub {
        display: block;
        padding: 8px;
        margin-top: 14px;
        border-radius: 6px;
        background-color: #555555;
        text-decoration: none !important;
        font-weight: bold;
      }

      .col-lge {
        max-width: 100% !important;
      }
    }

    @media screen and (min-width: 531px) {
      .col-sml {
        max-width: 27% !important;
      }

      .col-lge {
        max-width: 73% !important;
      }
    }
  </style>
</head>
<?php $anno  = date('Y'); ?>

<body style="margin:0;padding:0;word-spacing:normal;background-color:#f6f8f1;">
  <div role="article" aria-roledescription="email" lang="es" style="text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#f6f8f1;" ">
        <table role=" presentation" style="width:100%;border:none;border-spacing:0; ">
    <tr>
      <td align="center" style="padding:0;">
        <!--[if mso]>
          <table role="presentation" align="center" style="width:600px;">
          <tr>
          <td>
          <![endif]-->
        <div style="
                    width:100%;
                    max-width:700px;
                    border:none;border-spacing:0;
                    text-align:left;
                    font-family:Arial,
                    sans-serif;font-size:16px;
                    line-height:22px;
                    border-style:solid;  ;
                    border-width:1px ;
                    border-color:rgba(0, 0, 0, 0.219);">

          <table role="presentation">

            <tr>
              <td tyle="padding:15px;background-color:#ffffff;">

                <a href="https://www.stadioitalianodiconcepcion.cl/" style="text-decoration:none;">
                  <img src="<?php echo base_url() . "/assets/images/logo_instituciones_mini.png" ?>" width="120" alt="Stadio Italiano di Concepción" style="width:120px;max-width:80%;height:auto;border:none;text-decoration:none;color:#ffffff;">
                  <img class="" src="<?php echo base_url() . "/accionistas/SA/rastreoCorreoJunta?code=" . $hash ?>" width="1" height="1" border="0" alt="" />
                </a>
              </td>
            </tr>

            <!--Contenido -->
            <tr>



              <td style="padding:30px;background-color:#ffffff;">
                <h1 style="margin-top:0;margin-bottom:16px;font-size:22px;line-height:32px;font-weight:bold;letter-spacing:-0.02em;">
                  <?php echo $destinatario ?>
                </h1>
                <p style="margin:0;">

                  <span style="font-size:16px;">

                    <?php echo $mensaje ?>


                  </span>

                </p>
              </td>

            </tr>

            <!--Fin Contenido -->




            <tr>
              <td style="padding:20px;text-align:center;font-size:12px;background-color:#03632b;color:#cccccc;">


                <p style="margin:0 0 8px 0;">
                

                  <a href="https://www.instagram.com/stadioitalianodiccp/" style="text-decoration:none;">
                    <img src="<?php echo base_url() . "/assets/images/iconos/instagram-blanco.png" ?>" width="34" height="34" alt="i" style="display:inline-block;color:#cccccc;">
                  </a>

                  <a href="https://www.facebook.com/stadioitalianodiccp/" style="text-decoration:none;">
                    <img src="<?php echo base_url() . "/assets/images/iconos/facebook-blanco.png" ?>" width="34" height="34" alt="f" style="display:inline-block;color:#cccccc;">
                  </a>

                </p>
                <p style="margin:0;font-size:14px;line-height:15px;">

                  <span style="font-size:15px;">
                    <a href="https://stadioitalianodiconcepcion.cl/" style="text-decoration:none;color:#fffafa;">
                      &reg; Stadio Italiano di
                      Concepcion, <?php echo $anno  ?>
                    </a>
                  </span>

                </p>

                <p style="margin:0;font-size:14px;line-height:15px;">

                  <span style="font-size:15px;">
                    <a href="mailto:circolo@enti-italiani.cl">
                      <font color="#ffffff">circolo@enti-italiani.cl</font>
                    </a>
                  </span>

                </p>
              </td>
            </tr>
          </table>

        </div>
        <!--[if mso]>
          </td>
          </tr>
          </table>
          <![endif]-->
      </td>
    </tr>
    </table>
  </div>
</body>

</html>