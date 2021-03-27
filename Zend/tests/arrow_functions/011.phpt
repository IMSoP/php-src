--TEST--
Arrow functions capturing variables invisibly
--FILE--
<?php

class ScopeLog {
    public function __construct(private string $description) {
        echo "Test '{$this->description}'...\n";
    }
    public function __destruct() {
        echo "Cleaning up '{$this->description}'\n";
    }
}

$a = new ScopeLog('Closure dumps variable');
$fn = fn() {
    var_dump($a);
};
echo "Unsetting \$a...\n";
unset($a);
echo "Unsetting \$fn...\n";
unset($fn);

$a = new ScopeLog('Closure immediately over-writes variable');
$fn = fn() {
    $a = 42;
};
echo "Unsetting \$a...\n";
unset($a);
echo "Unsetting \$fn...\n";
unset($fn);

$a = new ScopeLog('Closure over-writes variable and then dumps it');
$fn = fn() {
    $a = 42;
    var_dump($a);
};
echo "Unsetting \$a...\n";
unset($a);
echo "Unsetting \$fn...\n";
unset($fn);

$a = new ScopeLog('Closure dumps variable and then over-writes it');
$fn = fn() {
    var_dump($a);
    $a = 42;
};
echo "Unsetting \$a...\n";
unset($a);
echo "Unsetting \$fn...\n";
unset($fn);

$a = new ScopeLog('Closure conditionally over-writes variable');
$fn = fn() {
    if (false) $a = 6;
    var_dump($a);
};
echo "Unsetting \$a...\n";
unset($a);
echo "Unsetting \$fn...\n";
unset($fn);

$a = new ScopeLog('Closure unsets variable before use');
$fn = fn() {
    unset($a);
    var_dump(isset($a));
};
echo "Unsetting \$a...\n";
unset($a);
echo "Unsetting \$fn...\n";
unset($fn);

$a = new ScopeLog('Closure unsets variable after use');
$fn = fn() {
    var_dump(isset($a));
    unset($a);
};
echo "Unsetting \$a...\n";
unset($a);
echo "Unsetting \$fn...\n";
unset($fn);

?>
--EXPECT--
Test 'Closure dumps variable'...
Unsetting $a...
Unsetting $fn...
Cleaning up 'Closure dumps variable'
Test 'Closure immediately over-writes variable'...
Unsetting $a...
Unsetting $fn...
Cleaning up 'Closure immediately over-writes variable'
Test 'Closure over-writes variable and then dumps it'...
Unsetting $a...
Unsetting $fn...
Cleaning up 'Closure over-writes variable and then dumps it'
Test 'Closure dumps variable and then over-writes it'...
Unsetting $a...
Unsetting $fn...
Cleaning up 'Closure dumps variable and then over-writes it'
Test 'Closure conditionally over-writes variable'...
Unsetting $a...
Unsetting $fn...
Cleaning up 'Closure conditionally over-writes variable'
Test 'Closure unsets variable before use'...
Unsetting $a...
Unsetting $fn...
Cleaning up 'Closure unsets variable before use'
Test 'Closure unsets variable after use'...
Unsetting $a...
Unsetting $fn...
Cleaning up 'Closure unsets variable after use'
