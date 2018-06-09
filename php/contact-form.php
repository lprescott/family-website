<?php
  if($_POST['formSubmit'] == "Send Message")
    {
        $errorMessage = "";
        $captcha = $_POST["g-recaptcha-response"];

        if(empty($_POST["g-recaptcha-response"])){
            $errorMessage .= "<li>Recaptcha is missing.</li>";
        } 
        else if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['comment'])) {
            $errorMessage .= "<li>Required information is missing.</li>";
        }
        
        if(!empty($errorMessage)) {
            echo $errorMessage;
            header('Location: /../form/failure.html');  
            exit;
        } 

        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcTgV0UAAAAADTU_7kiaFHUA6GI2Aq4JrsR6bLa&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
        if($response.success==false){
            exit;
        }

        $varName = $_POST['name'];
        $varEmail = $_POST['email'];
        $varSubject = $_POST['subject'];
        $varComment = $_POST['comment'];
        $to = "info@presport.us";

        $varToday = date("F j, Y, g:i a");
         
        /* Derive message */
        $varMessage = "From: " . $varName . " (" . $varEmail . ")<br>"
            . "Sent: " . $varToday . "<br>"
            . "To: " . $to . " (PresPort)<br>"
            . "Subject: " . $varSubject . "<br><hr>";

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

        header('Location: /../form/success.html');  
        exit;
    }
?>