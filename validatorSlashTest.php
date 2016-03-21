<?php
require_once('sender.php');

class ValidatorSlashTest extends PHPUnit_Framework_TestCase 
{
    public function testValidate_input() {
        $testValidator = new Validator();
        $testInput = $testValidator->validate_input("a\/b");
        $this->assertNotContains("\\", $testInput);
    }
}
?>
