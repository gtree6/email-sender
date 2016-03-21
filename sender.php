<?php
session_start();

/*checking if posted inputs are empty
 *require going back if missing field
 *initializing classes and calling their methods
 * recording $_session variables 
 */
if (!empty($_POST['questionField'] && !empty($_POST['nameField'] && !empty($_POST['mailField'])))) {

    $validate = new Validator();
    $validateMail = new EmailValidator();
    $send = new Sender();
    $compose = new Composer();

    $question = $validate->validate_input(filter_input(INPUT_POST, 'questionField'));
    $name = $validate->validate_input(filter_input(INPUT_POST, 'nameField'));
    $mail = $validate->validate_input(filter_input(INPUT_POST, 'mailField'));
    $mail = $validateMail->validate_mail($mail);

    $_SESSION['user_name'] = $name;
    $_SESSION['user_mail'] = $mail;

    $headers = $compose->composeHeader($mail);
    $message = $compose->composeMessage($question, $name, $mail);

    $send->send_email($message, $headers);

} else {
    echo "You have missed a required input field. Please, fill it in before submitting.";
    echo "<br><b><a href='javascript:history.go(-1)'>Go back</a></b>";
}


class Validator {
    /**
     * Basic security for input.
     * 
     * @param string $input - the user input
     * @return string $input - the validated harmless input
     */

    function validate_input($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }
}

class EmailValidator {
    /*
     * Check if provided e-mail is valid.
     * 
     * @param string $mail = the e-mail to check
     * @return string $mail = valid e-mail
     */
    
    function validate_mail($mail) {
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL) === false) {
            //echo("$mail is a valid email address");
            
            return $mail;
        } else {
            echo("<h3>$mail is not a valid email address</h3>");
            echo "<br><b><a href='javascript:history.go(-1)'>Go back</a></b>";
            exit();
        }
    }
}

class Sender {
    /**
     * 
     * Sends the e-mail.
     * 
     * @param string $msg - the message 
     * @param string $hdrs - the headers
     */
    function send_email($msg, $hdrs) {
        $email = mail("georgi.trifonov@mentormate.com", "Week 2 Task", $msg, $hdrs);
        if($email){
            echo "<h2>E-Mail Successfully sent</h2>";
          }else{
            echo "<h2>Mail sending failed.</h2><br><b><a href='javascript:history.go(-1)'>Go back</a></b>"; 
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
        $msg = "Hello, <br> This is an automated e-mail from my php email-sending script. It contains my question to you, my name and my contact e-mail.<br>";
        $msg .= "<b>My question is:</b> " . $question ."<br>";
        $msg .= "<b>Sent from:</b> " . $name . "<br>";
        $msg .= "<b>E-mail:</b> " . $mail . "\r\n";

        return $msg;
    }

    function composeHeader($mail) {
        $hdr = "MIME-Version: 1.0 \r\n";
        $hdr .= "Content-Type: text/html; charset=UTF-8\r\n";
        $hdr .= "From: " . $mail;

        return $hdr;
    }

}
?>