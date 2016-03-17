<?php
//checking if posted inputs are empty and validate if all is ok
//require going back if missing field
    if (!empty($_POST['questionField'] && !empty($_POST['nameField'] && !empty($_POST['mailField'])))) {
        $question = validate_input($_POST['questionField']);
        $name = validate_input($_POST['nameField']);
        $mail = validate_input($_POST['nameField']);
        echo $question. " from " . $name . " with email: " . $mail;
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
?>