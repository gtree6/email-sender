<?php
require_once('sender.php');

class ComposerTest extends PHPUnit_Framework_TestCase
{
    public function testComposeMessage()
    {
        $testComposer = new Composer();
        $testMessage = $testComposer->composeMessage("question? Hello?", "name", "email@email");
        $this->assertContains('Hello', $testMessage);
    }
}
?>