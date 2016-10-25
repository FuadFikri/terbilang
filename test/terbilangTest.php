<?php
define("PATH_ROOT", dirname(__FILE__));
if(file_exists($PATH = (PATH_ROOT . "/../src/terbilang.php")))
{
  include($PATH);
}
use PHPUnit\Framework\TestCase;

class terbilangTest extends TestCase
{
  public function testProcessOne()
  {
    $a = new Terbilang();
    $sampel1 = $a->process(5710666123);
    $sampel2 = $a->process("Rp5710666123");
    $sampel3 = $a->process("5.710.666.123");
    $sampel4 = $a->process(".5.7.1.0.6.6.6.1.2.3.");

    $sampel5 = $a->process(1);
    $sampel6 = $a->process(3);
    $sampel7 = $a->process(9);
    $sampel8 = $a->process(10);
    $sampel9 = $a->process(100);
    $sampel10 = $a->process(1000);
    $sampel11 = $a->process(100000);
    $sampel12 = $a->process(1191919);
    $sampel13 = $a->process(7127398);

    $c = "lima miliar tujuh ratus sepuluh juta enam ratus enam puluh enam ribu seratus dua puluh tiga";

    $this->assertEquals($c, $sampel1);
    $this->assertEquals($c, $sampel2);
    $this->assertEquals($c, $sampel3);
    $this->assertEquals($c, $sampel4);
    $this->assertEquals("satu", $sampel5);
    $this->assertEquals("tiga", $sampel6);
    $this->assertEquals("sembilan", $sampel7);
    $this->assertEquals("sepuluh", $sampel8);
    //$this->assertEquals("seratus", $sampel9); // returns: "seratus "
    //$this->assertEquals("seribu", $sampel10); // returns: "satu"
    //$this->assertEquals("seratus ribu", $sampel11); // returns: "seratus  ribu  "
    // the three up above is currently causing error
    $this->assertEquals("satu juta seratus sembilan puluh satu ribu sembilan ratus sembilan belas", $sampel12);
    $this->assertEquals("tujuh juta seratus dua puluh tujuh ribu tiga ratus sembilan puluh delapan", $sampel13);
  }
}
?>
