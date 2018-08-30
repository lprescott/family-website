<?php 
session_start(); 

require 'contact.php';

$submitTitle = $_SESSION['sessionTitle'];
$submitMessage = $_SESSION['sessionMessage'];
$submitIcon = $_SESSION['sessionIcon'];
?>

<!doctype html>
<html class="no-js" lang="eng">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>PresPort</title>
  <meta name="description" content="Prescott family website.">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="apple-touch-icon" sizes="180x180" href="../img/icons/apple-touch-icon.png">
  <link rel="icon" type="image/x-icon" sizes="32x32" href="../img/icons/favicon-32x32.png">
  <link rel="icon" type="image/x-icon" sizes="16x16" href="../img/icons/favicon-16x16.png">
  <link rel="manifest" href="../img/icons/site.webmanifest">
  <link rel="mask-icon" href="../img/icons/safari-pinned-tab.svg" color="#5bbad5">
  <link rel="shortcut icon" href="../img/icons/favicon.ico" type="image/x-icon">
  <meta name="msapplication-TileColor" content="#2b5797">
  <meta name="msapplication-config" content="../img/icons/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">

  <link rel="manifest" href="../site.webmanifest">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/main.css">
  <link rel="stylesheet" href="../css/inquiries-flex.css">
  <link rel="stylesheet" href="../css/form.css">

  <script src='https://www.google.com/recaptcha/api.js'></script>

</head>

<body>
  <!-- scripts -->
  <script src="../js/vendor/modernizr-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="../js/vendor/jquery-3.3.1.min.js"><\/script>')

  </script>
  <script src="../js/plugins.js"></script>
  <script src="../js/main.js"></script>

  <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
  <script>
    window.ga = function () {
      ga.q.push(arguments)
    };
    ga.q = [];
    ga.l = +new Date;
    //UA-111332341-1
    ga('create', 'UA-XXXXX-Y', 'auto');
    ga('send', 'pageview')

  </script>
  <script src="https://www.google-analytics.com/analytics.js" async defer></script>

  <!-- Sweetalert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script>
    window.onload = function () {

      swal({
        title: "<?php echo $submitTitle ?>",
        text: "<?php echo $submitMessage ?>",
        icon: "<?php echo $submitIcon ?>",
      });

    }

  </script>

</body>

</html>
