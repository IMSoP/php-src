--TEST--
Bug #77565 (Incorrect locator detection in ZIP-based phars)
--SKIPIF--
<?php
if (!extension_loaded('phar')) die('skip phar extension not available');
?>
--FILE--
<?php
$phar = new PharData(__DIR__ . '/bug77565.zip');
var_dump($phar['1.zip']->getFilename());
?>
--EXPECT--
string(5) "1.zip"
