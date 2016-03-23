<?php
require_once('sender.php');

class ValidatorTrimTest extends PHPUnit_Framework_TestCase 
{
    public function testValidate_input() {
        $testValidator = new Validator();
        $testInput = $testValidator->validate_input(" ab ");
        $this->assertNotContains(" ", $testInput);
    }
}

