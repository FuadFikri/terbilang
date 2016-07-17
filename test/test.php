<?php
include('../src/terbilang.php');

$t = new Terbilang();
function getRandom($len)
{
  $o = "";
  for($i = 0; $i < $len; $i++)
  {
    $o .= (str_len($o) > 0) ? mt_rand(1,9) : mt_rand(0,9);
  }
  return $o;
}
print "Begin testing".PHP_EOL;
for($i = 1; $i <= 37; $i++)
{
  print $t->process(getRandom($i)).PHP_EOL;
}
?>
