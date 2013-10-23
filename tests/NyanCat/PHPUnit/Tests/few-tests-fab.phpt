--TEST--
phpunit -c ../_files/phpunit.xml ../_files/ResultPrinterTest.php
--FILE--
<?php
$_SERVER['TERM']    = 'linux';
$_SERVER['argv'][1] = '-c';
$_SERVER['argv'][2] = dirname(__FILE__) . '/_files/phpunit.xml';
$_SERVER['argv'][3] = dirname(__FILE__) . '/_files/ResultPrinterTest.php';

require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/vendor/autoload.php';
PHPUnit_TextUI_Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann.

Configuration read from %s

 [32m0[0m
 [31m0[0m
 [36m0[0m
 
[4A[5C[31m-[0m
[5C[31m-[0m
[5C[31m-[0m
[5C[31m-[0m
[4A[6C_,------,  
[6C_|  /\_/\  
[6C~|_( - .-) 
[6C ""  ""    
[4A [32m1[0m
 [31m0[0m
 [36m0[0m
 
[4A[5C[31m-[0m[32m_[0m
[5C[31m-[0m[32m_[0m
[5C[31m-[0m[32m_[0m
[5C[31m-[0m[32m_[0m
[4A[7C_,------,  
[7C_|   /\_/\ 
[7C^|__( ^ .^)
[7C  ""  ""   
[4A [32m1[0m
 [31m1[0m
 [36m0[0m
 
[4A[5C[31m-[0m[32m_[0m[33m-[0m
[5C[31m-[0m[32m_[0m[33m-[0m
[5C[31m-[0m[32m_[0m[33m-[0m
[5C[31m-[0m[32m_[0m[33m-[0m
[4A[8C_,------,  
[8C_|  /\_/\  
[8C~|_( o .o) 
[8C ""  ""    
[4A [32m1[0m
 [31m2[0m
 [36m0[0m
 
[4A[5C[31m-[0m[32m_[0m[33m-[0m[34m_[0m
[5C[31m-[0m[32m_[0m[33m-[0m[34m_[0m
[5C[31m-[0m[32m_[0m[33m-[0m[34m_[0m
[5C[31m-[0m[32m_[0m[33m-[0m[34m_[0m
[4A[9C_,------,  
[9C_|   /\_/\ 
[9C^|__( o .o)
[9C  ""  ""   
[4A [32m1[0m
 [31m2[0m
 [36m1[0m
 
[4A[5C[31m-[0m[32m_[0m[33m-[0m[34m_[0m[35m-[0m
[5C[31m-[0m[32m_[0m[33m-[0m[34m_[0m[35m-[0m
[5C[31m-[0m[32m_[0m[33m-[0m[34m_[0m[35m-[0m
[5C[31m-[0m[32m_[0m[33m-[0m[34m_[0m[35m-[0m
[4A[10C_,------,  
[10C_|  /\_/\  
[10C~|_( - .-) 
[10C ""  ""    
[4A [32m1[0m
 [31m2[0m
 [36m2[0m
 
[4A[5C[31m-[0m[32m_[0m[33m-[0m[34m_[0m[35m-[0m[36m_[0m
[5C[31m-[0m[32m_[0m[33m-[0m[34m_[0m[35m-[0m[36m_[0m
[5C[31m-[0m[32m_[0m[33m-[0m[34m_[0m[35m-[0m[36m_[0m
[5C[31m-[0m[32m_[0m[33m-[0m[34m_[0m[35m-[0m[36m_[0m
[4A[11C_,------,  
[11C_|   /\_/\ 
[11C^|__( - .-)
[11C  ""  ""   
[4A 
 
 
 


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

