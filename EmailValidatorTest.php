<?php
require_once('sender.php');

class EmailValidatorTest extends PHPUnit_Framework_TestCase 
{
    public function testValidate_email() {
        $testValidator = new Validator();
        $testInput = $testValidator->validate_input("valid.email@email.com");
        $this->assertContains("@", $testInput);
    }
}
?>
