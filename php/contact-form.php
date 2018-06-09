<?php
    /*
        L.R.Prescott
        A PHP script to collect a client side form submission and email it to info@presport.us.
        6/9/2018
    */
    if($_POST['formSubmit'] == "Send Message") {

        //instance vars
        $errorMessage = ""; 
        $captcha = $_POST["g-recaptcha-response"]; //google recaptcha

        //if google recaptcha is empty or name, email or comment werent supplied set error message
        if(empty($_POST["g-recaptcha-response"])){
            $errorMessage .= "<li>Recaptcha is missing.</li>";
        } 
        else if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['comment'])) {
            $errorMessage .= "<li>Required information is missing.</li>";
        }
        
        //if error message isnt empty print error and exit after redirect
        if(!empty($errorMessage)) {
            echo $errorMessage;
            header('Location: /../form/failure.html');  
            exit;
        } 

        //check google recaptcha, if bot, exit
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcTgV0UAAAAADTU_7kiaFHUA6GI2Aq4JrsR6bLa&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
        if($response.success==false){
            exit;
        }

        //store supplied info
        $varName = $_POST['name'];
        $varEmail = $_POST['email'];
        $varSubject = $_POST['subject'];
        $varComment = $_POST['comment'];

        //dest
        $to = "info@presport.us";

        //today
        $varToday = date("F j, Y, g:i a");
        
        /* start message with header */
        $varMessage = "From: " . $varName . " (" . $varEmail . ")<br>"
            . "Sent: " . $varToday . "<br>"
            . "To: " . $to . " (PresPort)<br>"
            . "Subject: " . $varSubject . "<br><hr>";

        // create headers for mail func
        $headers = "From: " . $varEmail . "\r\n";
        $headers .= "Reply-To: ".  $varEmail . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        /* not missing subject */
        if( !empty($_POST['subject'])){
            $varMessage.=$varComment;
            mail($to,$varSubject,$varMessage,$headers);
        }

        /* missing subject */
        if(empty($_POST['subject'])){
            $varMessage.=$varComment;
            mail($to,"PresPort Contact Form",$varMessage,$headers);
        }

        //success here
        header('Location: /../form/success.html');  
        exit;
    }
?>