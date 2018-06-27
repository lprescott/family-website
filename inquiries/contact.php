<?php
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

<!doctype html>
<html class="no-js" lang="eng">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>PresPort</title>
  <meta name="description" content="Prescott family website.">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <script src="../js/p5.min.js"></script>
  <script src="../js/addons/p5.dom.min.js"></script>
  <script src="../js/addons/p5.sound.min.js"></script>
  <script src="../js/ckeditor.js"></script>


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

  <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=latin" rel="stylesheet">

  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/main.css">
  <link rel="stylesheet" href="../css/inquiries-flex.css">
  <link rel="stylesheet" href="../css/form.css">


  <script src='https://www.google.com/recaptcha/api.js'></script>


</head>

<body>

  <!-- Start -->
  <div id="main-container">

    <!-- heading/navbar-->
    <header>
      <nav>
        <ul>

          <!-- Home Button -->
          <li>
            <a title="Home" href="../index.html">
              <img border="0" alt="Home" src="../img/Home.png" height="40">
            </a>
          </li>

          <!-- people dropdown -->
          <li>
            <a>People
              <span class="caret"></span>
            </a>
            <div>
              <ul>
                <li>
                  <a href="../people/drewprescottsr.html">Drew Prescott, Sr.</a>
                </li>
                <li>
                  <a href="../people/karenprescott.html">Karen Prescott</a>
                </li>
                <li>
                  <!-- <a href="/people/drewprescottjr.html">Drew Prescott, Jr.</a> -->
                </li>
                <li>
                  <a href="../people/barbaraprescott.html">Barbara Prescott</a>
                </li>
                <li>
                  <a href="../people/lukeprescott.html">Luke Prescott</a>
                </li>
              </ul>
            </div>
          </li>

          <!-- property dropdown-->
          <li>
            <a>Property
              <span class="caret"></span>
            </a>
            <div>
              <ul>
                <li>
                  <a href="../property/inside.html">Inside</a>
                </li>
                <li>
                  <a href="../property/outside.html">Outside</a>
                </li>
                <li>
                  <a href="../property/location.html">Location</a>
                </li>
              </ul>
            </div>
          </li>

          <!-- projects dropdown-->
          <li>
            <a>Projects
              <span class="caret"></span>
            </a>
            <div>
              <ul>
              </ul>
            </div>
          </li>

          <!-- floating inquiry button-->
          <li class="inquiry-button">
            <a href="contact.php">Inquiries</a>
          </li>
        </ul>
      </nav>
    </header>


    <!-- outer most flex container -->
    <form id='main' class="main-col" method="POST" action="" id="contact-form">
      <half1 id='main' class="main-row outer-flex-box-no-bottom" style="padding:0; background: none; box-shadow: none;">
        <half1 id='main' class="main-col outer-flex-box-no-bottom after" style="background: none; box-shadow: none; margin: 0 20px 0 0; padding: 0;">
          <half1 class="inner-flex-box" style="background: rgb(250, 250, 250); padding: 5px 0 0 0; margin: 0 0 20px 0;">
            <label for="name" id="name-label" style="padding-left: 14px; line-height: 2; font-size: 16px;">
              Name
              <input type="text" id="name" name="name" required>
            </label>
          </half1>
          <half2 class="inner-flex-box" style="background: rgb(250, 250, 250); padding:5px 0 0 0; margin: 0 0 0 0;">
            <label for="email" id="email-label" style="padding-left: 14px; line-height: 2; font-size: 16px;">
              E-mail
              <input type="email" id="email" name="email" required>
            </label>
          </half2>
        </half1>
        <half2 id='main' class='main-col outer-flex-box-no-top before' style="padding-bottom: 10px; padding-top: 0; padding-left: 0; padding-right: 0; text-align:center; background: rgb(250, 250, 250); margin: 0 0 0 0;">
          <half1 id="form-message" style="padding:0; margin-bottom: 0; background: none; box-shadow: none;">
            <h2 style="margin-left: 5px; margin-right: 5px;text-align: center; color: rgb(78, 78, 78);"> Say hi! We would love to hear from you. </h2>
          </half1>
          <half2 id='main' class='main-row wide-container' style="padding:0; margin-top: 0; background: none; box-shadow: none;">
            <innerhalf1 style="padding:5px; background: none; box-shadow: none;">
              <div style="display: inline-block;" class="g-recaptcha" data-sitekey="6LcTgV0UAAAAAChaBvDs9rlYtpXPUeGJRF3Xzsrs"></div>
            </innerhalf1>
            <innerhalf2 style="padding:5px; background: none; box-shadow: none;">
              <div id="submit-container" style=" display: inline-block; font-size: 20px;">
                <input type="submit" id="submit" name="formSubmit" value="Send Message">
              </div>
            </innerhalf2>
          </half2>
        </half2>
      </half1>

      <half1 class="outer-flex-box-no-top" style="background: rgb(250, 250, 250); padding:5px 0 0 0; margin: 0 10px 10px 10px;">
        <label for="subject" id="subject-label" style="padding-left: 14px; line-height: 2; font-size: 16px;">
          Subject
          <input type="text" id="subject" name="subject">
        </label>
      </half1>

      <half2 class="outer-flex-box-no-bottom" style="padding: 0; overflow: hidden;">
        <label for="comment" id="comment-label">
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
        </label>
      </half2>
    </form>

    <!-- footer -->
    <footer>
      <div class="footer-container">
        Powered by
        <a class="link-style" href="https://p5js.org/">p5.js</a> and started with
        <a class="link-style" href="https://html5boilerplate.com/" target="_blank" rel="noopener">html5boilerplate</a>. </br> General questions, comments, or concerns?
        <a class="link-style" href="mailto:info@presport.us?subject=General%20question,%20comment,%20or%20concern."> Contact us!</a>
        This website was designed and built by Luke Prescott.
        </br> Any and all trademarks or logos used throughout this website are the property of their respective owners.
      </div>
    </footer>
  </div>
  <!-- /Start-->

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
    ga('create', 'UA-111332341-1', 'auto');
    ga('send', 'pageview')

  </script>
  <script src="https://www.google-analytics.com/analytics.js" async defer></script>

</body>

</html>
