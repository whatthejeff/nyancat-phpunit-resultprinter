--TEST--
phpunit --debug -c ../_files/phpunit.xml ../_files/ResultPrinterTest.php
--FILE--
<?php
$_SERVER['TERM']    = 'linux';
$_SERVER['argv'][1] = '--debug';
$_SERVER['argv'][2] = '-c';
$_SERVER['argv'][3] = dirname(__FILE__) . '/_files/phpunit.xml';
$_SERVER['argv'][4] = dirname(__FILE__) . '/_files/ResultPrinterTest.php';

require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/vendor/autoload.php';
PHPUnit_TextUI_Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann.

Configuration read from %s


Starting test 'ResultPrinterTest::testSuccess'.
.
Starting test 'ResultPrinterTest::testFailure'.
[41;37mF[0m
Starting test 'ResultPrinterTest::testError'.
[31;1mE[0m
Starting test 'ResultPrinterTest::testSkipped'.
[36;1mS[0m
Starting test 'ResultPrinterTest::testIncomplete'.
[33;1mI[0m

Time: %i %s, Memory: %sMb

There was 1 error:

1) ResultPrinterTest::testError
%s

%s:%i

--

There was 1 failure:

1) ResultPrinterTest::testFailure
Failed asserting that false is true.

%s:%i
[37;41m                                                                           [0m
[37;41mFAILURES!                                                                  [0m
[37;41mTests: 5, Assertions: 2, Failures: 1, Errors: 1, Incomplete: 1, Skipped: 1.[0m

