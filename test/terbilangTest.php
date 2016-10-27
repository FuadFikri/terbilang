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
    $samples = Array(
      "Rp5710666123" => "lima miliar tujuh ratus sepuluh juta enam ratus enam puluh enam ribu seratus dua puluh tiga",
      ".5.7.1.0.6.6.6.1.2.3." => "lima miliar tujuh ratus sepuluh juta enam ratus enam puluh enam ribu seratus dua puluh tiga",
      "100" => "seratus",
      "101" => "seratus satu",
      "107" => "seratus tujuh",
      "117" => "seratus tujuh belas",
      "127" => "seratus dua puluh tujuh",
      "200" => "dua ratus",
      "210" => "dua ratus sepuluh",
      "209" => "dua ratus sembilan",
      "211" => "dua ratus sebelas",
      "212" => "dua ratus dua belas",
      "100000" => "seratus ribu",
      "100123" => "seratus ribu seratus dua puluh tiga",
      "100100" => "seratus ribu seratus",
      "100010" => "seratus ribu sepuluh",
      "100001" => "seratus ribu satu",
      "100111" => "seratus ribu seratus sebelas",
      "100127" => "seratus ribu seratus dua puluh tujuh",
      "1100" => "seribu seratus",
      "1101" => "seribu seratus satu",
      "1107" => "seribu seratus tujuh",
      "1117" => "seribu seratus tujuh belas",
      "1127" => "seribu seratus dua puluh tujuh",
      "1200" => "seribu dua ratus",
      "1210" => "seribu dua ratus sepuluh",
      "2209" => "dua ribu dua ratus sembilan",
      "2211" => "dua ribu dua ratus sebelas",
      "2212" => "dua ribu dua ratus dua belas",
      "21100" => "dua puluh satu ribu seratus",
      "21101" => "dua puluh satu ribu seratus satu",
      "21107" => "dua puluh satu ribu seratus tujuh",
      "21117" => "dua puluh satu ribu seratus tujuh belas",
      "21127" => "dua puluh satu ribu seratus dua puluh tujuh",
      "22200" => "dua puluh dua ribu dua ratus",
      "22210" => "dua puluh dua ribu dua ratus sepuluh",
      "22209" => "dua puluh dua ribu dua ratus sembilan",
      "23211" => "dua puluh tiga ribu dua ratus sebelas",
      "10212" => "sepuluh ribu dua ratus dua belas"
    );
    foreach($samples as $sample => $expectation)
    {
      $this->assertEquals($expectation, $a->toWord($sample));
    }
  }
}
?>
