<?php //begin php
session_start();
/*
L.R.Prescott
A PHP script to collect a client side form submission and email it to info@presport.us.
6/9/2018
*/
if ($_POST['formSubmit'] == "Send Message") {
	$message = "";
	$title = "";
	$icon = "";
	// if google recaptcha is empty or name, email or comment werent supplied set error message
	if (!isset($_POST['g-recaptcha-response']) || empty($_POST['g-recaptcha-response'])) {
		$message = "Empty Google recaptcha.";
		$title = "Error!";
		$icon = "error";
	}
	else
	if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['comment'])) {
		$message = "Required information missing.";
		$title = "Error!";
		$icon = "error";
	}
	// check google recaptcha, if bot
	$recaptchaResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcTgV0UAAAAADTU_7kiaFHUA6GI2Aq4JrsR6bLa&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
	if ($recaptchaResponse . success == false) {
		$message = "Recaptcha failed to authenticate.";
		$title = "Error!";
		$icon = "error";
	}
	// if error message isnt empty, exit
	if (!empty($message)) {
		$_SESSION['sessionMessage'] = $message;
		$_SESSION['sessionTitle'] = $title;
		$_SESSION['sessionIcon'] = $icon;
		header("Location: submit.php");
		exit;
	}
	$varSubject = "";
	// store supplied info
	$varName = $_POST['name'];
	$varEmail = $_POST['email'];
	$varSubject = $_POST['subject'];
	$varComment = $_POST['comment'];
	// if subject message isnt empty, set
	if (empty($varSubject)) {
		$varSubject = "PresPort Contact Form";
	}
	// dest
	$to = "info@presport.us";
	// today
	$varToday = date("F j, Y, g:i a");
	/* start message with header */
	$varMessage = "<i>Automatically generated header</i><br />" . "From: " . $varName . " (" . $varEmail . ")<br />" . "Sent: " . $varToday . "<br />" . "To: " . $to . " (PresPort)<br />" . "Subject: " . $varSubject . "<br /><hr>";
	// create headers for mail func
	$headers = "From: " . $varEmail . "\r\n";
	$headers.= "Reply-To: " . $varEmail . "\r\n";
	$headers.= "MIME-Version: 1.0\r\n";
	$headers.= "Content-Type: text/html; charset=UTF-8\r\n";
	$varMessage.= $varComment;
	if (mail($to, $varSubject, $varMessage, $headers)) {
		// success here
		$title = "Success!";
		$message = "Your message has sent successfully.";
		$icon = "success";
		$_SESSION['sessionMessage'] = $message;
		$_SESSION['sessionTitle'] = $title;
    $_SESSION['sessionIcon'] = $icon;
    header("Location: submit.php");
		exit;
	}
	else {
		// error
		$message = "Could not send email.";
		$title = "Error!";
		$icon = "error";
		$_SESSION['sessionMessage'] = $message;
		$_SESSION['sessionTitle'] = $title;
    $_SESSION['sessionIcon'] = $icon;
    header("Location: submit.php");
		exit;
	}
}
?>
<!-- end php -->

<!doctype html>
<html class="no-js" lang="en">

<head>

  <meta name="robots" content="index, follow">
  <meta name="keywords" content="prescott, presport, presport.us, information technology, program management consulting services, creative writing, secondary education in English language arts, medicine, nursing, computer science, mathematics">

  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Contact Us</title>
  <meta name="description" content="Presport is the Prescott family hub – geographically located the capital district of New York State. The Prescott family has a total of 20 years (and counting) in upper-level education, leading to expertise in a plethora of areas; they include: information technology, program management consulting services, creative writing, secondary education in English language arts, medicine, nursing,computer science, and mathematics.">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="apple-touch-icon" sizes="180x180" href="/img/icons/apple-touch-icon.png">
  <link rel="icon" type="image/x-icon" sizes="32x32" href="/img/icons/favicon-32x32.png">
  <link rel="icon" type="image/x-icon" sizes="16x16" href="/img/icons/favicon-16x16.png">
  <link rel="manifest" href="/img/icons/site.webmanifest">
  <link rel="mask-icon" href="/img/icons/safari-pinned-tab.svg" color="#5bbad5">
  <link rel="shortcut icon" href="/img/icons/favicon.ico" type="image/x-icon">
  <meta name="msapplication-TileColor" content="#2b5797">
  <meta name="msapplication-config" content="/img/icons/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">

  <link rel="manifest" href="site.webmanifest">

  <link href="css/open-sans.css" rel="stylesheet">
  <link href="css/font-awesome.css" rel="stylesheet">

  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.css">

  <script src="sweetalert2/dist/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="sweetalert2/dist/sweetalert2.min.css">

  <script src='https://www.google.com/recaptcha/api.js'></script>
  <script src="js/ckeditor5/ckeditor.js"></script>

</head>

<body>
  <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

  <!-- Start site/application content here -->
  <div id="main">
  <header class="rounded-corners shadow-hover margin-header">
      <nav class="nav">
        <ul class="rounded-corners">

          <li class="center home-button">
            <a style="padding: 10px 10px 10px 10px !important; " title="Home" href="index.html">
              <img alt="Home" src="/img/Home.png" height="40px">
            </a>
          </li>

          <!-- people dropdown -->
          <li class="dropdown desktop-button">
            <a onmouseover="changeCaret('desktop-menu-1', 1)" onmouseout="changeCaret('desktop-menu-1', 0)">People
              <i id="desktop-menu-1" style="font-size: 12px;" class="fas fa-angle-down"></i>
            </a>

            <ul>
              <li onmouseover="changeCaret('desktop-menu-1', 1)" onmouseout="changeCaret('desktop-menu-1', 0)" class="top-dropdown-item"
                style="width: 200px;">
                <a class="incomplete" href="/people/dprescottsr.html">Drew Prescott, Sr.</a>
              </li>
              <li onmouseover="changeCaret('desktop-menu-1', 1)" onmouseout="changeCaret('desktop-menu-1', 0)" style="width: 200px;">
                <a href="/people/kprescott.html">Karen Prescott</a>
              </li>
              <li onmouseover="changeCaret('desktop-menu-1', 1)" onmouseout="changeCaret('desktop-menu-1', 0)" style="width: 200px;">
                <a class="incomplete" href="customErrors/under_construction.html">Barbara Prescott</a>
              </li>
              <li onmouseover="changeCaret('desktop-menu-1', 1)" onmouseout="changeCaret('desktop-menu-1', 0)" class="bottom-dropdown-item"
                style="width: 200px;">
                <a href="/people/lprescott.html">Luke Prescott</a>
              </li>
            </ul>

          </li>

          <!-- property dropdown-->
          <li class="dropdown desktop-button">
            <a onmouseover="changeCaret('desktop-menu-2', 1)" onmouseout="changeCaret('desktop-menu-2', 0)">Property
              <i id="desktop-menu-2" style="font-size: 12px;" class="fas fa-angle-down"></i>
            </a>

            <ul>
              <li onmouseover="changeCaret('desktop-menu-2', 1)" onmouseout="changeCaret('desktop-menu-2', 0)" class="top-dropdown-item"
                style="width: 123.77px;">
                <a class="incomplete" href="customErrors/under_construction.html">Inside</a>
              </li>
              <li onmouseover="changeCaret('desktop-menu-2', 1)" onmouseout="changeCaret('desktop-menu-2', 0)" style="width: 123.77px;">
                <a class="incomplete" href="customErrors/under_construction.html">Outside</a>
              </li>
              <li onmouseover="changeCaret('desktop-menu-2', 1)" onmouseout="changeCaret('desktop-menu-2', 0)" class="bottom-dropdown-item"
                style="width: 123.77px;">
                <a class="incomplete" href="customErrors/under_construction.html">Location</a>
              </li>
            </ul>
          </li>

          <!-- projects dropdown-->
          <li class="dropdown desktop-button">
            <a onmouseover="changeCaret('desktop-menu-3', 1)" onmouseout="changeCaret('desktop-menu-3', 0)">Projects
              <i id="desktop-menu-3" style="font-size: 12px;" class="fas fa-angle-down"></i>
            </a>
            <ul>
              <li onmouseover="changeCaret('desktop-menu-3', 1)" onmouseout="changeCaret('desktop-menu-3', 0)" class="top-dropdown-item"
                style="width: 200px;">
                <a href="/projects/matrix.html">Matrix</a>
              </li>
              <li onmouseover="changeCaret('desktop-menu-3', 1)" onmouseout="changeCaret('desktop-menu-3', 0)" class="bottom-dropdown-item"
                style="width: 200px;">
                <a href="/projects/mandelbrot.html">Mandelbrot Set</a>
              </li>
            </ul>
          </li>

          <a title="Contact Us" href="contact.php">
            <li class="contact-button">
              <span style="font-size: 25px; color: rgb(75,75,75);">
                <i class="fas fa-mail-bulk"></i>
              </span>
            </li>
          </a>

          <li class="dropdown mobile-button">
            <a title="Menu">
              <span style="font-size: 30px; color: rgb(75,75,75);">
                <i class="fas fa-bars"></i>
              </span>
            </a>

            <ul>
              <li id="people" class="top-dropdown-item" style="width: 270px;">
                <a title="Click to toggle." href="../customErrors/PleaseEnableJavascript.html" onclick="toggleMenu('person', 'projects', 'mobile-menu-1');return false;">People
                  <i id="mobile-menu-1" style="font-size: 12px;" class="fas fa-angle-down"></i>
                </a>
              </li>
              <li class="sub-item person" style="display: none; width: 270px;">
                <a href="/people/dprescottsr.html">Drew Prescott, Sr.</a>
              </li>
              <li class="sub-item person" style="display: none; width: 270px;">
                <a href="/people/karenprescott.html">Karen Prescott</a>
              </li>
              <li class="sub-item person" style="display: none; width: 270px;">
                <a href="customErrors/under_construction.html">Barbara Prescott</a>
              </li>
              <li class="sub-item person" style="display: none; width: 270px;">
                <a href="/people/lprescott.html">Luke Prescott</a>
              </li>
              <li id="property" style="width: 270px;">
                <a title="Click to toggle." href="../customErrors/PleaseEnableJavascript.html" onclick="toggleMenu('property', 'projects', 'mobile-menu-2');return false;">Property
                  <i id="mobile-menu-2" style="font-size: 12px;" class="fas fa-angle-down"></i>
                </a>
              </li>
              <li class="sub-item property" style="display: none; width: 270px;">
                <a href="customErrors/under_construction.html">Inside</a>
              </li>
              <li class="sub-item property" style="display: none; width: 270px;">
                <a href="customErrors/under_construction.html">Outside</a>
              </li>
              <li class="sub-item property" style="display: none; width: 270px;">
                <a href="customErrors/under_construction.html">Location</a>
              </li>
              <li id="projects" class="bottom-dropdown-item" style="width: 270px;">
                <a title="Click to toggle." href="../customErrors/PleaseEnableJavascript.html" onclick="toggleMenu('project', 'projects', 'mobile-menu-3');return false;">Projects
                  <i id="mobile-menu-3" style="font-size: 12px;" class="fas fa-angle-down"></i>
                </a>
              </li>
              <li class="sub-item project" style="display: none; width: 200px;">
                <a href="../projects/matrix.html">Matrix</a>
              </li>
              <li class="sub-item bottom-dropdown-item project" style="display: none; width: 200px;">
                <a href="../projects/mandelbrot.html">Mandelbrot Set</a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </header>

    <form method="POST" id="contact-form" class="flex-col flex-container">
      <div class="item form-input">
        <label for="name" id="name-label">
          Name
          <input type="text" id="name" name="name" required>
        </label>
      </div>
      <div class="item form-input">
        <label for="email" id="email-label">
          E-mail
          <input type="email" id="email" name="email" required>
        </label>
      </div>
      <div class="item form-input">
        <label for="subject" id="subject-label">
          Subject
          <input type="text" id="subject" name="subject">
        </label>
      </div>
      <div class="item " style="padding: 0px; overflow: hidden;">
        <textarea name="comment" id="comment"></textarea>
        <script>
          ClassicEditor
            .create(document.querySelector('#comment'), {
              toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',
                'undo', 'redo'
              ]
            })
            .catch(error => {
              console.log(error);
            });

        </script>
      </div>
      <div class="flex-row container rounded-corners nobackground" style="margin: 10px;">
        <div id="recaptcha-container" class="item nobackground form-recaptcha" style="flex-basis: 50%; text-align: right;">
          <div style="display: inline-block;" class="g-recaptcha" data-sitekey="6LcTgV0UAAAAAChaBvDs9rlYtpXPUeGJRF3Xzsrs"></div>
        </div>
        <div id="submit-container" class="item nobackground form-submit" style="flex-basis: 50%; text-align: left;">
          <input class="shadow-hover" style="display: inline-block;" type="submit" id="submit" name="formSubmit" value="Send Message">
        </div>
      </div>
    </form>

    <footer class="rounded-corners padded shadow-hover margin-footer">
      <div class="footer-spacing">
        Powered by javascript, and
        <a class="link-style" href="technologies.html">these</a> technologies.
        <br>
        General questions, comments, or concerns? Contact us
        <a class="link-style" href="contact.php">here</a>
        , or by
        <a class="link-style" href="mailto:info@presport.us">email</a>.
        This website was designed and built by Luke Prescott.
        <br>
        Any and all trademarks or logos used throughout this website are the property of their respective owners.
      </div>
    </footer>
  </div> <!-- end main -->

  <!-- End site/application content here -->
  <script src="js/vendor/modernizr-3.6.0.min.js"></script>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script>
    window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')

  </script>
  <script src="js/plugins.js"></script>
  <script src="js/main.js"></script>
</body>

</html>
