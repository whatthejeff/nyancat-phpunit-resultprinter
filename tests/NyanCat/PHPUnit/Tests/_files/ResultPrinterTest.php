<?php

    class ResultPrinterTest extends PHPUnit\Framework\TestCase
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