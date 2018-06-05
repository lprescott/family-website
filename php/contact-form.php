<?php
    $destination = "info@presport.us";
    $default_subject = "Contact Form Submission";

    if(empty($_POST["fullname"]) || empty($_POST["email"]) || empty($_POST["message"])){
        echo "Required fields have not been completed.";
        exit;
    }

    if(!empty($_POST["subject"])){
        $default_subject = $_POST["subject"];
    }

    if(!empty($_POST["telephone"])){
        $default_number = $_POST["telephone"];
    }

    /* fullname */
    $name = $_POST["fullname"];

    /* email */
    $email = $_POST["email"];

    /* telephone */
    $default_number = $_POST["telephone"];

    /* message */
    $message = $_POST["message"];

    /* header */
    $headers = "From: $email";
    

    if(empty($_POST["telephone"])){
        
        $message .= "\n\n$name\n$email";

        /* mail */
        mail($destination,$default_subject,$message,$headers);
    } else{
        $telephone = $_POST["telephone"];
        $message .= "\n\n$name\n$email\n$telephone";

        /* mail */
        mail($destination,$default_subject,$message,$headers);
    }   
?>