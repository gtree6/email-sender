<?php
require_once('sender.php');

class ValidatorSpecialcharsTest extends PHPUnit_Framework_TestCase 
{
    public function testValidate_input() {
        $testValidator = new Validator();
        $testInput = $testValidator->validate_input("<b>ASD<b>");
        $this->assertNotContains("<>", $testInput);
    }
}
?>
