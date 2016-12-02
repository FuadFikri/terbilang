<?php
class Terbilang
{
  private $tri_digit_ext = Array("", "ribu", "juta", "miliar", "triliun", "kuadriliun", "kuintiliun", "sekstiliun", "septiliun", "oktiliun", "noniliun", "desiliun");
  private $bi_digit_ext = Array("puluh", "belas", "ratus");
  private $number = Array("nol","satu","dua","tiga","empat","lima","enam","tujuh","delapan","sembilan");
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
      if($i == 2 /* in other word: $i-1 = 1 */ && intval($triplet) == 1)
      {
        $return = "seribu" . (strlen($return) > 0 ? " " . $return : "");
        continue;
      } else {
        $return = $this->processTriple($triplet) . /* fix spaces at the end of the string */($i >= 2 ? " " . $this->tri_digit_ext[$i-1] : "") . (strlen($return) > 0 ? " " . $return : "");
      }
    }

    $return = str_replace($this->to_replace, $this->replacement, $return);
    return $return;
  }

  public function toWordSingleRep($number)
  {
    $number = $this->getNumberOnly($number);
    $len = strlen($number);
    $return = "";
    for ($i=0; $i < $len; $i++) {
      $return .= $this->number[intval($number[$i])];
      if($i != $len-1)
        $return .= " ";
    }
    return $return;
  }

  public function toNumberSingleRep($words)
  {
    return $this->toNumberInternal($words, true);
  }
  public function toNumber($words)
  {
    return $this->toNumberInternal($words, false);
  }
  private function toNumberInternal($words, $single_rep = false)
  {
    $words = str_replace(array_merge($this->replacement, array("seribu")), array_merge($this->to_replace, array("satu ribu")), $words);
    $words = preg_replace('/([A-Za-z]+) belas/', 'satu puluh $1', $words);
    $words = str_replace($this->number, array_keys($this->number), $words);
    $arrayword = explode(" ", $words);
    $duplet = array(1 => "puluh", 2 => "ratus");
    $ret = "";

    $arrayword = array_reverse($arrayword);
    $triple_pad = 0;
    for ($i=0; $i < count($arrayword); $i++) {
      $cur = $arrayword[$i];
      if(in_array($cur, $this->tri_digit_ext))
      {
        $triple_pad = (3 * intval(array_keys($this->tri_digit_ext, $cur)[0]));
        $ret = str_pad($ret, $triple_pad, "0", STR_PAD_LEFT);
      } else if(in_array($cur, $duplet)) {
        $double_pad = intval(array_keys($duplet, $cur)[0]);
        $ret = str_pad($ret, $triple_pad + $double_pad, "0", STR_PAD_LEFT);
      } else {
        if(intval($cur) == 0 && ((!$single_rep) ||  ($single_rep && $cur != "0")))
          continue; // skip adding unnecessary char, like : x puluh, x belas will be returned as 0, and 10
        $ret = $cur . $ret;
      }
    }

    return $ret;
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
        $return = $this->bi_digit_ext[2] . (strlen($return) > 0 ? " " . $return : "");

      else if(($i == 1 && $len == 3) || ($i == 0 && $len == 2))
        $return = $this->bi_digit_ext[0] . (strlen($return) > 0 ? " " . $return : "");

      else if((($i == 2 && $len == 3) || ($i == 1 && $len == 2)) && $next == 1 && $cur != 0)
      {
        $return = $this->bi_digit_ext[1] . (strlen($return) > 0 ? " " . $return : "");
        $i -= 1;
      }
      $return = $this->number[$cur] . (strlen($return) > 0 ? " " . $return : "");
    }
    return $return;
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
