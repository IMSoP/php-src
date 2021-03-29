--TEST--
Bug #80915: Taking a reference to $_SERVER hides it's values from phpinfo()
--FILE--
<?php

$_ENV = [];
$_SERVER = [ 'test' => 'test' ];

$reference =& $_SERVER;

phpinfo(INFO_VARIABLES);

?>
--EXPECT--
phpinfo()

PHP Variables

Variable => Value
$_SERVER['test'] => test
