<?php
define("PATH_ROOT", dirname(__FILE__));
if(file_exists($PATH = (PATH_ROOT . "/../src/terbilang.php")))
{
  include($PATH);
}else
  include("/home/travis/build/darksqueeze/terbilang/src/terbilang.php");

$t = new Terbilang();
function getRandom($len)
{
  $o = "";
  for($i = 0; $i < $len; $i++)
  {
    $o .= (strlen($o) > 0) ? mt_rand(1,9) : mt_rand(0,9);
  }
  return $o;
}
print "Begin testing".PHP_EOL;
for($i = 1; $i <= 36; $i++)
{
  print $t->process(getRandom($i)).PHP_EOL;
}
?>
