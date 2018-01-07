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
PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

Test 'ResultPrinterTest::testSuccess' started
Test 'ResultPrinterTest::testSuccess' ended
Test 'ResultPrinterTest::testFailure' started
Test 'ResultPrinterTest::testFailure' ended
Test 'ResultPrinterTest::testError' started
Test 'ResultPrinterTest::testError' ended
Test 'ResultPrinterTest::testSkipped' started
Test 'ResultPrinterTest::testSkipped' ended
Test 'ResultPrinterTest::testIncomplete' started
Test 'ResultPrinterTest::testIncomplete' ended


Time: %s, Memory: %s

There was 1 error:

1) ResultPrinterTest::testError
%s

%s:%i

--

There was 1 failure:

1) ResultPrinterTest::testFailure
Failed asserting that false is true.

%s:%i

[37;41mERRORS![0m
[37;41mTests: 5[0m[37;41m, Assertions: 2[0m[37;41m, Errors: 1[0m[37;41m, Failures: 1[0m[37;41m, Skipped: 1[0m[37;41m, Incomplete: 1[0m[37;41m.[0m
