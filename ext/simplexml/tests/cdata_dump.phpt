--TEST--
SimpleXML: CDATA should show in var_dump output
--SKIPIF--
<?php if (!extension_loaded("simplexml")) print "skip"; ?>
--FILE--
<?php

$sxe = simplexml_load_string(<<<EOF
<?xml version='1.0'?>
<sxe>
 <elem1>Plain Text</elem1>
 <elem2><![CDATA[CDATA block]]></elem2>
 <elem3>Text before <![CDATA[CDATA block]]></elem3>
 <elem4><![CDATA[CDATA block]]> before text</elem4>
 <elem5>Text, <![CDATA[CDATA block,]]> more text</elem5>
</sxe>
EOF
);

var_dump($sxe);

?>
--EXPECTF--
object(SimpleXMLElement)#%d (5) {
  ["elem1"]=>
  string(10) "Plain Text"
  ["elem2"]=>
  string(11) "CDATA block"
  ["elem3"]=>
  string(23) "Text before CDATA block"
  ["elem4"]=>
  string(23) "CDATA block before text"
  ["elem5"]=>
  string(28) "Text, CDATA block, more text"
}

