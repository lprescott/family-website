<?php
  if($_POST['formSubmit'] == "Submit")
  {
    $errorMessage = "";

    if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['comment'])) {
        $errorMessage .= "<li>Required information is missing.</li>";
    }

    $varName = $_POST['name'];
    $varEmail = $_POST['email'];
    $varPhone = $_POST['phone'];
    $varSubject = $_POST['subject'];
    $varComment = $_POST['comment'];

    $to = "info@presport.us";

    if(!empty($errorMessage)) {
        echo("<p>There was an error with your form:</p>\n");
        echo("<ul>" . $errorMessage . "</ul>\n");
    } 

    $msg = wordwrap($varComment,70);
    $header = "From: $varEmail"; 

    /* All data */
    if(!empty($_POST['telephone']) && !empty($_POST['subject'])){
        $msg .= "\n\n$varName\n$varEmail\n$varPhone";
        mail($to,$varSubject,$msg,$header);
        echo "Your message was sent successfully. Thank You!";
    }

    /* missing telephone */
    if(empty($_POST['telephone']) && !empty($_POST['subject'])){
        $msg .= "\n\n$varName\n$varEmail";
        mail($to,$varSubject,$msg,$header);
        echo "Your message was sent successfully. Thank You!";
    }

    /* missing subject */
    if(empty($_POST['subject']) && !empty($_POST['telephone'])){
        $msg .= "\n\n$varName\n$varEmail\n$varPhone";
        mail($to,"PresPort Contact Form",$msg,$header);
        echo "Your message was sent successfully. Thank You!";
    }

    /* missing telephone and subject */
    if(empty($_POST['telephone']) && empty($_POST['subject'])){
        $msg .= "\n\n$varName\n$varEmail";
        mail($to,"PresPort Contact Form",$msg,$header);
        echo "Your message was sent successfully. Thank You!";
    }
}
?>