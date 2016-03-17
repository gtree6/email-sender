<?php
session_start();

$message;

//checking if posted inputs are empty and validate if all is ok
//require going back if missing field
    if (!empty($_POST['questionField'] && !empty($_POST['nameField'] && !empty($_POST['mailField'])))) {
        $question = validate_input($_POST['questionField']);
        $name = validate_input($_POST['nameField']);
        $mail = validate_input($_POST['mailField']);
        $geno_mail = "geno.shishkov@mentormate.com";
        
        echo $question. " from " . $name . " with email: " . $mail;
        $message = "Hello, \r\nthis is an automated e-mail from my php email-sending script. "
                . " It contains my question to you, my name and my contact e-mail.";
        $message .= "\r\nMy question is: " . $question;
        $message .= "\r\nSent from: " . $name;
        $message .= "\r\nE-mail: " . $mail;
        
        $headers = "From: " . $mail . "\r\n" .
            "CC: geno.shishkov@mentormate.com";
        send_email($message, $mail, $headers);
        
        echo "<br>".$message;
    } else {
        echo "You have missed a required input field. Please, fill it in before submitting.";
        echo "<br><b><a href='javascript:history.go(-1)'>Go back</a></b>";
    }
    
    //validating functuon
    function validate_input($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }
    
    function send_email($msg, $mail, $hdrs) {
        $email = mail("georgi.trifonov@mentormate.com", "Test", $msg, $hdrs);
        if($email){
            echo "<h2>Thank you for using our mail form</h2>";
          }else{
            echo "<h2>Mail sending failed.</h2>"; 
          }
    }
?>