<?php
use PHPUnit\Framework\TestCase;

class terbilangTest extends TestCase
{
  public function testProcessOne()
  {
    $a = new Terbilang();
    $b = $a->process(5.710.666.123);

    $c = "lima milyar tujuh ratus sepuluh juta enam ratus enam puluh enam ribu seratus dua puluh tiga";

    $this->assertEquals($c, $b);
  }
}
?>
