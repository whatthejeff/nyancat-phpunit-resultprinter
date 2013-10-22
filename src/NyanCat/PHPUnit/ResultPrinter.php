<?php

/*
 * This file is part of the Nyan Cat result printer for PHPUnit.
 *
 * (c) Jeff Welch <whatthejeff@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NyanCat\PHPUnit;

use NyanCat\Cat;
use NyanCat\Rainbow;
use NyanCat\Team;
use NyanCat\Scoreboard;

use Fab\Factory as FabFactory;

/**
 * Mmmm poptarts...
 *
 * -_-_-_-_,------,
 * -_-_-_-_|   /\_/\
 * -_-_-_-^|__( ^ .^)
 * -_-_-_-  ""  ""
 *
 * @author Jeff Welch <whatthejeff@gmail.com>
 */
class ResultPrinter extends \PHPUnit_TextUI_ResultPrinter
{
    /**
     * The Nyan Cat scoreboard.
     *
     * @var NyanCat\Scoreboard
     */
    private $scoreboard;

    /**
     * {@inheritdoc}
     */
    public function __construct($out = NULL, $verbose = FALSE, $colors = FALSE, $debug = FALSE)
    {
        $this->scoreboard = new Scoreboard(
            new Cat(),
            new Rainbow(
                FabFactory::getFab(
                    empty($_SERVER['TERM']) ? 'unknown' : $_SERVER['TERM']
                )
            ),
            array(
                new Team('pass', 'green', '^'),
                new Team('fail', 'red', 'o'),
                new Team('pending', 'cyan', '-'),
            ),
            5,
            array($this, 'write')
        );

        parent::__construct($out, $verbose, true, $debug);
    }

    /**
     * {@inheritdoc}
     */
    protected function writeProgress($progress)
    {
        if($this->debug) {
            return parent::writeProgress($progress);
        }

        $this->scoreboard->score($progress);
    }

    /**
     * {@inheritdoc}
     */
    protected function printHeader()
    {
        if (!$this->debug) {
            if (!$this->scoreboard->isRunning()) {
                $this->scoreboard->start();
            }
            $this->scoreboard->stop();
        }

        parent::printHeader();
    }

    /**
     * {@inheritdoc}
     */
    public function addError(\PHPUnit_Framework_Test $test, \Exception $e, $time)
    {
        if ($this->debug) {
            return parent::addError($test, $e, $time);
        }

        $this->writeProgress('fail');
        $this->lastTestFailed = TRUE;
    }

    /**
     * {@inheritdoc}
     */
    public function addFailure(\PHPUnit_Framework_Test $test, \PHPUnit_Framework_AssertionFailedError $e, $time)
    {
        if ($this->debug) {
            return parent::addFailure($test, $e, $time);
        }

        $this->writeProgress('fail');
        $this->lastTestFailed = TRUE;
    }

    /**
     * {@inheritdoc}
     */
    public function addIncompleteTest(\PHPUnit_Framework_Test $test, \Exception $e, $time)
    {
        if ($this->debug) {
            return parent::addIncompleteTest($test, $e, $time);
        }

        $this->writeProgress('pending');
        $this->lastTestFailed = TRUE;
    }

    /**
     * {@inheritdoc}
     */
    public function addSkippedTest(\PHPUnit_Framework_Test $test, \Exception $e, $time)
    {
        if ($this->debug) {
            return parent::addSkippedTest($test, $e, $time);
        }

        $this->writeProgress('pending');
        $this->lastTestFailed = TRUE;
    }

    /**
     * {@inheritdoc}
     */
    public function startTestSuite(\PHPUnit_Framework_TestSuite $suite)
    {
        if ($this->debug) {
            return parent::startTestSuite($suite);
        }

        if ($this->numTests == -1) {
            parent::startTestSuite($suite);
            $this->scoreboard->start();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function endTest(\PHPUnit_Framework_Test $test, $time)
    {
        if ($this->debug) {
            return parent::endTest($test, $time);
        }

        if (!$this->lastTestFailed) {
            $this->writeProgress('pass');
        }

        if ($test instanceof \PHPUnit_Framework_TestCase) {
            $this->numAssertions += $test->getNumAssertions();
        }

        else if ($test instanceof \PHPUnit_Extensions_PhptTestCase) {
            $this->numAssertions++;
        }

        $this->lastTestFailed = FALSE;
    }
}
