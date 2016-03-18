<?php
session_start();

$message;

//checking if posted inputs are empty and validate if all is ok
//require going back if missing field
    if (!empty($_POST['questionField'] && !empty($_POST['nameField'] && !empty($_POST['mailField'])))) {
        
        $validate = new Validator();
        $send = new Sender();
        $compose = new Composer();
        
        $question = $validate->validate_input($_POST['questionField']);
        $name = $validate->validate_input($_POST['nameField']);
        $mail = $validate->validate_input($_POST['mailField']);
        
        $_SESSION['user_name'] = $name;
        $_SESSION['user_mail'] = $mail;
        
        $geno_mail = "geno.shishkov@mentormate.com";
        
        echo $question. " from " . $name . " with email: " . $mail;
        
        
        $headers = $compose->composeHeader($mail);
        $message = $compose->composeMessage($question, $name, $mail);

        $send->send_email($message, $headers);
        
        echo "<br>".$message;
    } else {
        echo "You have missed a required input field. Please, fill it in before submitting.";
        echo "<br><b><a href='javascript:history.go(-1)'>Go back</a></b>";
    }
    
    
    class Validator {
        /**
         * Basic security for input.
         * 
         * @param string $input
         * @return string
         */
        
        function validate_input($input) {
            $input = trim($input);
            $input = stripslashes($input);
            $input = htmlspecialchars($input);
            return $input;
        }
    }
    
    class Sender {
        /**
         * 
         * Sends the e-mail.
         * 
         * @param string $msg
         * @param string $hdrs
         */
        function send_email($msg, $hdrs) {
            $email = mail("georgi.trifonov@mentormate.com", "Test", $msg, $hdrs);
            if($email){
                echo "<h2>Mail sent</h2>";
              }else{
                echo "<h2>Mail sending failed.</h2>"; 
              }
        }
    }
    
    class Composer {
    /**
     * 
     * Composes the e-mail message.
     * Composes the headers of the message.
     * 
     * @param string $question - the question asked through the form
     * @param string $name - the name of the sender
     * @param string $mail - the e-mail of the sender
     * @return string
     */    
        function composeMessage($question, $name, $mail) {
            $msg = "Hello, \r\n This is an automated e-mail from my php email-sending script. It contains my question to you, my name and my contact e-mail.<br>";
            $msg .= "<b>My question is:</b> " . $question ."<br>";
            $msg .= "<b>Sent from:</b> " . $name . "<br>";
            $msg .= "<b>E-mail:</b> " . $mail . "\r\n";

            return $msg;
        }
        
        function composeHeader($mail) {
            $hdr = "MIME-Version: 1.0 \r\n";
            $hdr .= "Content-Type: text/html; charset=UTF-8\r\n";
            $hdr .= "From: " . $mail;
            $hdr .= "\r\n   Cc: geno.shishkov@mentormate.com";
            
            return $hdr;
        }
        
    }
?>