<?php

    class ResultPrinterTest extends PHPUnit_Framework_TestCase
    {
        public function testSuccess()
        {
            $this->assertTrue(true);
        }

        public function testFailure()
        {
            $this->assertTrue(false);
        }

        public function testError()
        {
            strpos();
        }

        public function testSkipped()
        {
            $this->markTestSkipped('Skipped');
        }

        public function testIncomplete()
        {
            $this->markTestIncomplete('Incomplete');
        }
    }

?>