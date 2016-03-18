<?php
session_start();
?>
<html>
    <head>
        <title>Question form</title>
        <style>
            #questionField {height:50px; width:1000px; float:left; clear:right;}
            #questionLabel {float:left;}
            #nameField, #mailField, #nameLabel, #mailLabel {float:left;}
            #nameField, #mailField, #questionField {border: 2px solid red;}
        </style>
    </head>
    <body>
        <div id="container" style="margin-top: 250px" align="center">
           <form action="sender.php" method="post" id="infoForm" name="infoForm">
               <label for="questionField" id="questionLabel">Your question:</label>
               <textarea name="questionField" id="questionField"></textarea>
               <label for="nameField" id="nameLabel">Your name:</label>
               <input type="text" name="nameField" id="nameField" value="<?php echo $_SESSION['user_name']?>">
               <label for="mailField" id="mailLabel">Your email:</label>
               <input type="email" name="mailField" id="mailField" value="<?php echo $_SESSION['user_mail']?>">
               
               <input type='submit' id='submitQuestion' value='Submit/send'>
           </form>
       </div>
    </body>
</html>