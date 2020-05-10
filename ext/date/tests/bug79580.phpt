--TEST--
Bug #79580 ('z' specifier doesn't detect leap years)
--FILE--
<?php
echo "Non-leap year:\n";
echo DateTimeImmutable::createFromFormat("z Y", '58 2019')->format('z: Y-m-d'), "\n";
echo DateTimeImmutable::createFromFormat("z Y", '59 2019')->format('z: Y-m-d'), "\n";
echo DateTimeImmutable::createFromFormat("z Y", '60 2019')->format('z: Y-m-d'), "\n";
echo "Leap year:\n";
echo DateTimeImmutable::createFromFormat("z Y", '58 2020')->format('z: Y-m-d'), "\n";
echo DateTimeImmutable::createFromFormat("z Y", '59 2020')->format('z: Y-m-d'), "\n";
echo DateTimeImmutable::createFromFormat("z Y", '60 2020')->format('z: Y-m-d'), "\n";
echo "Mixing month and day-of-year:\n";
echo DateTimeImmutable::createFromFormat("z m Y", '58 3 2019')->format('z: Y-m-d'), "\n";

?>
--EXPECT--
Non-leap year:
58: 2019-02-28
59: 2019-03-01
60: 2019-03-02
Leap year:
58: 2020-02-28
59: 2020-02-29
60: 2020-03-01
Mixing month and day-of-year:
86: 2019-03-28
