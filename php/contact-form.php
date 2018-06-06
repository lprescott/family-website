<?php
  if($_POST['formSubmit'] == "Submit")
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
            header('Location: /../form/inquiries/failure.html');  
            exit;
        } 

        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcTgV0UAAAAADTU_7kiaFHUA6GI2Aq4JrsR6bLa&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
        if($response.success==false){
            exit;
        }

        $varName = $_POST['name'];
        $varEmail = $_POST['email'];
        $varPhone = $_POST['phone'];
        $varSubject = $_POST['subject'];
        $varComment = $_POST['comment'];
        $to = "info@presport.us";
        $msg = wordwrap($varComment,70);
        $header = "From: $varEmail"; 

        /* All data */
        if(!empty($_POST['telephone']) && !empty($_POST['subject'])){
            $msg .= "\n\n$varName\n$varEmail\n$varPhone";
            mail($to,$varSubject,$msg,$header);
        }

        /* missing telephone */
        if(empty($_POST['telephone']) && !empty($_POST['subject'])){
            $msg .= "\n\n$varName\n$varEmail";
            mail($to,$varSubject,$msg,$header);
        }

        /* missing subject */
        if(empty($_POST['subject']) && !empty($_POST['telephone'])){
            $msg .= "\n\n$varName\n$varEmail\n$varPhone";
            mail($to,"PresPort Contact Form",$msg,$header);
        }

        /* missing telephone and subject */
        if(empty($_POST['telephone']) && empty($_POST['subject'])){
            $msg .= "\n\n$varName\n$varEmail";
            mail($to,"PresPort Contact Form",$msg,$header);
        }

        header('Location: /../form/inquiries/success.html');  
        exit;
    }
?>