<?php
class Terbilang
{
	private $x3 = Array("", "ribu", "juta", "miliar", "triliun", "kuadriliun", "kuintiliun", "sekstiliun", "septiliun", "oktiliun", "noniliun", "desiliun");
	private $x2 = Array("ratus", "seratus");
	private $x1 = Array("puluh", "belas", "sepuluh", "sebelas");
	private $x0 = Array("nol","satu","dua","tiga","empat","lima","enam","tujuh","delapan","sembilan");
	
	public function __construct()
	{
		// constructor
	}
	public function process($n)
	{
		$n = $this->distinguish_num($n); // only get numbers
		$len = strlen($n);
		$head = $len % 3; //0,1,2
		
		$result = "";
		$nhead = 0; $ntail = 0;
		$j = 0;

		if($head > 0)
		{
			$nhead = substr($n, 0, $head);
			$ntail = substr($n, $head);
		}else{
			// if there's no head
			$ntail = $n;
		}

		$sections = ceil(strlen($ntail)/3);
		if($sections > count($this->x3)) return false;

		// process `tail`
		for($i = $sections-1; $i >= 0;$i--)
		{
			if($ntail == 0)break;
			$k = substr($ntail, ($i*3), 3);
			/*
			// the $k is always 3 digits long
			$result = (strlen($k) == 1 ? x0($k) : (strlen($k) == 2 ? x1($k) : x2($k)))." ".$x3[$j] . " " . $result;
			*/
			// fix seribu
			$result = (intval($k) == 1 && $j == 1 ? "seribu" : $this->ratusan($k)." ".$this->x3[$j])." ". $result;
			$j++;
		}
		if($head > 0)
			if($j == 1 /*ribuan*/ && intval($nhead) == 1)
				$result = "seribu ".$result;
			else
			$result = (strlen($nhead) == 1 ? $this->satuan($nhead) : (strlen($nhead) == 2 ? $this->puluhan($nhead) : $this->ratusan($nhead)))." ".$this->x3[$j] . " " . $result;
		return $result;
	}
	
	public function ratusan($n)
	{
		$res = "";
		if(strlen($n) != 3)return false;

		if(substr($n, 0, 1) == 1)
			$res = $this->x2[1];
		else
		{
			$res = substr($n, 0, 1) == 0 ? "" : ($this->satuan(substr($n, 0, 1)) . " " . $this->x2[0]);
		}
		return $res." ". $this->puluhan(substr($n, 1, 2));
	}
	public function puluhan($n)
	{
		if(strlen($n) != 2) return false;
		if($n == 10)return $this->x1[2];
		elseif($n == 11)return $this->x1[3];
		elseif($n > 11 && $n < 20)
		{
			return $this->satuan(substr($n, 1, 1))." ".$this->x1[1];
		}
		else
		{
			return (substr($n, 0, 1) == 0 ? "" : ($this->satuan(substr($n, 0, 1))." ".$this->x1[0]." ")) . $this->satuan(substr($n, 1, 1));
		}
	}
	public function satuan($n, $retnol = true)
	{
		if(strlen($n) != 1) return false;
		if($n == 0 && $retnol == false)return "";
		return $this->x0[$n];
	}
	protected function distinguish_num($n)
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
?>php
