--TEST--
phpunit -c ../_files/phpunit.xml --filter notests ../_files/ResultPrinterTest.php
--FILE--
<?php
$_SERVER['TERM']    = 'xterm';
$_SERVER['argv'][1] = '-c';
$_SERVER['argv'][2] = dirname(__FILE__) . '/_files/phpunit.xml';
$_SERVER['argv'][3] = '--filter';
$_SERVER['argv'][4] = 'notests';
$_SERVER['argv'][5] = dirname(__FILE__) . '/_files/ResultPrinterTest.php';

require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/vendor/autoload.php';
PHPUnit_TextUI_Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann.

Configuration read from %s

 [32m0[0m
 [31m0[0m
 [36m0[0m
 
[4A[5C[38;5;154m-[0m
[5C[38;5;154m-[0m
[5C[38;5;154m-[0m
[5C[38;5;154m-[0m
[4A[6C_,------,  
[6C_|  /\_/\  
[6C~|_( - .-) 
[6C ""  ""    
[4A 
 
 
 


Time: %i %s, Memory: %sMb

[30;43mNo tests executed![0m
