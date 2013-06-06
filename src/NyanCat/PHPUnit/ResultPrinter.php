<?php

/*
 * This file is part of the Nyan Cat result printer for PHPUnit.
 *
 * (c) Jeff Welch <whatthejeff@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NyanCat\PHPunit;

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
     * Ansi escape
     */
    const ESC = "\x1b[";
    /**
     * Ansi Normal
     */
    const NND = "\x1b[0m";

    /**
     * The Fab to paint the rainbow with.
     *
     * @var Fab\Fab
     */
    private $fab;

    /**
     * For the shakes
     *
     * @var integer
     */
    private $tick = 0;

    /**
     * Length of the rainbow
     *
     * @var integer
     */
    private $trajectoryWidthMax;
    /**
     * Lines in the rainbow
     *
     * @var integer
     */
    private $numberOfLines = 4;
    /**
     * Length of the cat
     *
     * @var integer
     */
    private $nyanCatWidth = 11;
    /**
     * Length of the scoreboard
     *
     * @var integer
     */
    private $scoreboardWidth = 5;

    /**
     * Holds the rainbow chars
     *
     * @var array
     */
    private $trajectories = array();

    /**
     * Status colors
     *
     * @var array
     */
    private static $paints = array(
        'passes'   => 32,
        'failures' => 31,
        'pending'  => 36
    );

    /**
     * Statuses
     *
     * @var array
     */
    private $stats = array(
        'passes'   => 0,
        'failures' => 0,
        'pending'  => 0
    );

    /**
     * {@inheritdoc}
     */
    public function __construct($out = NULL, $verbose = FALSE, $colors = FALSE, $debug = FALSE)
    {
        $term = empty($_SERVER['TERM']) ? 'unknown' : $_SERVER['TERM'];
        $this->fab = \Fab\Factory::getFab($term);

        for ($i = 0; $i < $this->numberOfLines; $i++) {
            $this->trajectories[] = array();
        }

        parent::__construct($out, $verbose, true, $debug);
    }

    /**
     * Moves the cursor up a given number of lines
     *
     * @param integer $lines The number of lines to move the cursor
     */
    protected function cursorUp($lines)
    {
        $this->write(self::ESC . $lines . 'A');
    }

    /**
     * Adds a new color segment to the rainbow.
     */
    protected function appendRainbow()
    {
        $segment = $this->fab->paint(
            $this->tick ? '_' : '-'
        );

        foreach ($this->trajectories as &$trajectory) {
            if (count($trajectory) >= $this->trajectoryWidthMax) {
                array_shift($trajectory);
            }

            $trajectory[] = $segment;
        }
    }

    /**
     * Draws the scoreboard for the current iteration.
     */
    protected function drawScoreboard()
    {
        foreach ($this->stats as $key => $stat) {
            $this->write(' ');
            $this->write(
                self::ESC . self::$paints[$key] . 'm' . $stat . self::NND
            );
            $this->write("\n");
        }

        $this->write("\n");
        $this->cursorUp($this->numberOfLines);
    }

    /**
     * Draws the rainbow for the current iteration.
     */
    protected function drawRainbow(){

        foreach ($this->trajectories as $line) {
            $this->write(self::ESC . $this->scoreboardWidth . 'C');
            $this->write(implode($line));
            $this->write("\n");
        }

        $this->cursorUp($this->numberOfLines);
    }

    /**
     * Draws the nyan cat for a given status.
     *
     * @param string $status The status (pass/fail/etc)
     */
    protected function drawNyanCat($status)
    {
        $startWidth = $this->scoreboardWidth + count($this->trajectories[0]);

        // Back
        $this->write(self::ESC . $startWidth . 'C');
        $this->write('_,------,');
        $this->write("\n");

        // Ears
        $padding = $this->tick ? '  ' : '   ';
        $this->write(self::ESC . $startWidth . 'C');
        $this->write('_|' . $padding . '/\\_/\\ ');
        $this->write("\n");

        // Face
        $padding = $this->tick ? '_' : '__';
        $tail = $this->tick ? '~' : '^';
        switch ($status) {
            case 'pass':
                $face = '( ^ .^)';
                break;
            case 'fail':
                $face = '( o .o)';
                break;
            default:
                $face = '( - .-)';
        }
        $this->write(self::ESC . $startWidth . 'C');
        $this->write($tail . '|' . $padding . $face . ' ');
        $this->write("\n");

        // Feet
        $padding = $this->tick ? ' ' : '  ';
        $this->write(self::ESC . $startWidth . 'C');
        $this->write($padding . '""  "" ');
        $this->write("\n");

        $this->cursorUp($this->numberOfLines);
    }

    /**
     * {@inheritdoc}
     */
    protected function writeProgress($progress)
    {
        if($this->debug) {
            return parent::writeProgress($progress);
        }

        $this->appendRainbow();
        $this->drawScoreboard();
        $this->drawRainbow();
        $this->drawNyanCat($progress);
        $this->tick = !$this->tick;
    }

    /**
     * {@inheritdoc}
     */
    protected function printHeader()
    {
        if (!$this->debug) {
            if (count($this->trajectories[0]) === 0) {
                $this->writeProgress('end');
            }
            $this->write("\n\n\n\n");
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

        $this->stats['failures']++;
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

        $this->stats['failures']++;
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

        $this->stats['pending']++;
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

        $this->stats['pending']++;
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
            $this->trajectoryWidthMax = $this->maxColumn - $this->nyanCatWidth;
            $this->writeProgress('start');
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
            $this->stats['passes']++;
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
