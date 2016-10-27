<?php
class Terbilang
{
  private $x3 = Array("", "ribu", "juta", "miliar", "triliun", "kuadriliun", "kuintiliun", "sekstiliun", "septiliun", "oktiliun", "noniliun", "desiliun");
  private $x1 = Array("puluh", "belas", "ratus");
  private $x0 = Array("nol","satu","dua","tiga","empat","lima","enam","tujuh","delapan","sembilan");
  private $to_replace = Array("satu puluh", "satu ratus", "satu belas");
  private $replacement = Array("sepuluh", "seratus", "sebelas");
  public function toWord($number)
  {
    $number = $this->getNumberOnly($number);
    $len = strlen($number);
    $return = "";

      $section = ceil($len / 3);
      $mod = $len % 3;
      for ($i = 1; $i <= $section ; $i++) {
        if($i == $section && $mod > 0)
          $triplet = substr($number, 0, $mod);
        else
          $triplet = substr($number, $len-$i*3, 3);
        if($i == 2 /*in other word: $i-1 = 1*/ && intval($triplet) == 1)
        {
          $return = "seribu" . (strlen($return) > 0 ? " " . $return : "");
          continue;
        } else {
          $return = $this->processTriple($triplet) . /*fix blank at the end spaces*/($i >= 2 ? " " . $this->x3[$i-1] : "") . (strlen($return) > 0 ? " " . $return : "");
        }
      }
    $return = str_replace($this->to_replace, $this->replacement, $return);
    //$return = substr($return, 0, strlen($return)-2);
    return $return;
  }
  private function processTriple($number)
  {
    $len = strlen($number);
    if($len > 3) return false;
    $return = "";
    for($i = $len-1; $i >= 0; $i--)
    {
      $cur = intval(substr($number, $i, 1));
      if($cur == 0)continue;
      $next = $i-1 < 0 ? -1 : intval(substr($number, $i-1, 1));
      if($i == 0 && $len == 3)
        $return = $this->x1[2] . (strlen($return) > 0 ? " " . $return : "");

      else if(($i == 1 && $len == 3) || ($i == 0 && $len == 2))
        $return = $this->x1[0] . (strlen($return) > 0 ? " " . $return : "");

      else if((($i == 2 && $len == 3) || ($i == 1 && $len == 2)) && $next == 1 && $cur != 0)
      {
        $return = $this->x1[1] . (strlen($return) > 0 ? " " . $return : "");
        $i -= 1;
      }
      $return = $this->x0[$cur] . (strlen($return) > 0 ? " " . $return : "");
    }
    return $return;
    //return substr($return, 0, strlen($return)-1);
  }
  protected function getNumberOnly($n)
	{
		$n = (string)$n;
		$o = "";
		for($i = 0; $i < strlen($n); $i++)
		{
			if(is_numeric($n[$i]))
				$o .= $n[$i];
		}
		return $o;
	}
}
?>
