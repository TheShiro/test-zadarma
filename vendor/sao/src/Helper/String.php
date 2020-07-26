<?php

namespace sao\Helper;

class String
{

	public static function getNameClass($class)
	{
		$class = explode("\\", $class);
		preg_match_all("/[A-Z][^A-Z]*?/U", end($class), $ret);
		return strtolower($ret[0][0]);
	}

	public static function numberToString($str)
	{
		$newstr="";
		if ($str=="0") return "ноль";

		if (strlen($str)>1 && substr($str,strlen($str)-2,1)=="1") {
	        switch(substr($str,strlen($str)-1,1)) {
		        case "0": $newstr="десять";break;
		        case "1": $newstr="одиннадцать";break;
		        case "2": $newstr="двенадцать";break;
		        case "3": $newstr="тринадцать";break;
		        case "4": $newstr="четырнадцать";break;
		        case "5": $newstr="пятнадцать";break;
		        case "6": $newstr="шестнадцать";break;
		        case "7": $newstr="семнадцать";break;
		        case "8": $newstr="восемнадцать";break;
		        case "9": $newstr="девятнадцать";break;
		    }
		} else {
	        switch(substr($str,strlen($str)-1,1)) {
		        case "1": $newstr=" один";break;
		        case "2": $newstr=" два";break;
		        case "3": $newstr=" три";break;
		        case "4": $newstr=" четыре";break;
		        case "5": $newstr=" пять";break;
		        case "6": $newstr=" шесть";break;
		        case "7": $newstr=" семь";break;
		        case "8": $newstr=" восемь";break;
		        case "9": $newstr=" девять";break;
		    }

		    if (strlen($str)>1) {
		        switch(substr($str,strlen($str)-2,1)) {
			        case "2": $newstr="двадцать ".$newstr;break;
			        case "3": $newstr="тридцать ".$newstr;break;
			        case "4": $newstr="сорок ".$newstr;break;
			        case "5": $newstr="пятьдесят ".$newstr;break;
			        case "6": $newstr="шестьдесят ".$newstr;break;
			        case "7": $newstr="семьдесят ".$newstr;break;
			        case "8": $newstr="восемьдесят ".$newstr;break;
			        case "9": $newstr="девяносто ".$newstr;break;
			    }
			}
		}

		if (strlen($str)>2) {
			switch(substr($str,strlen($str)-3,1)) {
				case "1": $newstr="сто ".$newstr;break;
			    case "2": $newstr="двести ".$newstr;break;
			    case "3": $newstr="триста ".$newstr;break;
			    case "4": $newstr="четыреста ".$newstr;break;
			    case "5": $newstr="пятьсот ".$newstr;break;
			    case "6": $newstr="шестьсот ".$newstr;break;
			    case "7": $newstr="семьсот ".$newstr;break;
			    case "8": $newstr="восемьсот ".$newstr;break;
			    case "9": $newstr="девятьсот ".$newstr;break;
			}
		}

		if (strlen($str)>3) {
			if (strlen($str)>4 && substr($str,strlen($str)-5,1)=="1") {
		        switch(substr($str,strlen($str)-4,1)) {
			        case "0": $newstr="десять тысяч ".$newstr;break;
			        case "1": $newstr="одиннадцать тысяч ".$newstr;break;
			        case "2": $newstr="двенадцать тысяч ".$newstr;break;
			        case "3": $newstr="тринадцать тысяч ".$newstr;break;
			        case "4": $newstr="четырнадцать тысяч ".$newstr;break;
			        case "5": $newstr="пятнадцать тысяч ".$newstr;break;
			        case "6": $newstr="шестнадцать тысяч ".$newstr;break;
			        case "7": $newstr="семнадцать тысяч ".$newstr;break;
			        case "8": $newstr="восемнадцать тысяч ".$newstr;break;
			        case "9": $newstr="девятнадцать тысяч ".$newstr;break;
			    }
			} else {
		        switch(substr($str,strlen($str)-4,1)) {
			        case "0": if (strlen($str)>6 && substr($str,strlen($str)-6,3)=="000") {} else {$newstr="тысяч ".$newstr;}break;
			        case "1": $newstr="одна тысяча ".$newstr;break;
			        case "2": $newstr="две тысячи ".$newstr;break;
			        case "3": $newstr="три тысячи ".$newstr;break;
			        case "4": $newstr="четыре тысячи ".$newstr;break;
			        case "5": $newstr="пять тысяч ".$newstr;break;
			        case "6": $newstr="шесть тысяч ".$newstr;break;
			        case "7": $newstr="семь тысяч ".$newstr;break;
			        case "8": $newstr="восемь тысяч ".$newstr;break;
			        case "9": $newstr="девять тысяч ".$newstr;break;
			    }

			    if (strlen($str)>4) {
			        switch(substr($str,strlen($str)-5,1)) {
				        case "2": $newstr="двадцать ".$newstr;break;
				        case "3": $newstr="тридцать ".$newstr;break;
				        case "4": $newstr="сорок ".$newstr;break;
				        case "5": $newstr="пятьдесят ".$newstr;break;
				        case "6": $newstr="шестьдесят ".$newstr;break;
				        case "7": $newstr="семьдесят ".$newstr;break;
				        case "8": $newstr="восемьдесят ".$newstr;break;
				        case "9": $newstr="девяносто ".$newstr;break;
				    }
				}
			}
		}

		if (strlen($str)>5) {
			switch(substr($str,strlen($str)-6,1)) {
			#       case "0": $newstr="сто ".$newstr;break;
				case "1": $newstr="сто ".$newstr;break;
			    case "2": $newstr="двести ".$newstr;break;
			    case "3": $newstr="триста ".$newstr;break;
			    case "4": $newstr="четыреста ".$newstr;break;
			    case "5": $newstr="пятьсот ".$newstr;break;
			    case "6": $newstr="шестьсот ".$newstr;break;
			    case "7": $newstr="семьсот ".$newstr;break;
			    case "8": $newstr="восемьсот ".$newstr;break;
			    case "9": $newstr="девятьсот ".$newstr;break;
			}
		}

		if (strlen($str)>6) {
			if (strlen($str)>7 && substr($str,strlen($str)-8,1)=="1") {
		        switch(substr($str,strlen($str)-7,1)) {
			        case "0": $newstr="десять миллионов ".$newstr;break;
			        case "1": $newstr="одиннадцать миллионов ".$newstr;break;
			        case "2": $newstr="двенадцать миллионов ".$newstr;break;
			        case "3": $newstr="тринадцать миллионов ".$newstr;break;
			        case "4": $newstr="четырнадцать миллионов ".$newstr;break;
			        case "5": $newstr="пятнадцать миллионов ".$newstr;break;
			        case "6": $newstr="шестнадцать миллионов ".$newstr;break;
			        case "7": $newstr="семнадцать миллионов ".$newstr;break;
			        case "8": $newstr="восемнадцать миллионов ".$newstr;break;
			        case "9": $newstr="девятнадцать миллионов ".$newstr;break;
			    }
			} else {
		        switch(substr($str,strlen($str)-7,1)) {
			        // case "0": if() $newstr="миллионов ".$newstr;break;
			        case "0": if (strlen($str)>9 && substr($str,strlen($str)-9,3)=="000") {} else {$newstr="миллионов ".$newstr;}break;
			        case "1": $newstr="один миллион ".$newstr;break;
			        case "2": $newstr="два миллиона ".$newstr;break;
			        case "3": $newstr="три миллиона ".$newstr;break;
			        case "4": $newstr="четыре миллиона ".$newstr;break;
			        case "5": $newstr="пять миллионов ".$newstr;break;
			        case "6": $newstr="шесть миллионов ".$newstr;break;
			        case "7": $newstr="семь миллионов ".$newstr;break;
			        case "8": $newstr="восемь миллионов ".$newstr;break;
			        case "9": $newstr="девять миллионов ".$newstr;break;}
			    if (strlen($str)>7) {
			        switch(substr($str,strlen($str)-8,1)) {
				        case "2": $newstr="двадцать ".$newstr;break;
				        case "3": $newstr="тридцать ".$newstr;break;
				        case "4": $newstr="сорок ".$newstr;break;
				        case "5": $newstr="пятьдесят ".$newstr;break;
				        case "6": $newstr="шестьдесят ".$newstr;break;
				        case "7": $newstr="семьдесят ".$newstr;break;
				        case "8": $newstr="восемьдесят ".$newstr;break;
				        case "9": $newstr="девяносто ".$newstr;break;
				    }
				}
			}
		}

		if (strlen($str)>8) {
			switch(substr($str,strlen($str)-9,1)) {
				// case "0": $newstr="сто ".$newstr;break;
			    case "1": $newstr="сто ".$newstr;break;
			    case "2": $newstr="двести ".$newstr;break;
			    case "3": $newstr="триста ".$newstr;break;
			    case "4": $newstr="четыреста ".$newstr;break;
			    case "5": $newstr="пятьсот ".$newstr;break;
			    case "6": $newstr="шестьсот ".$newstr;break;
			    case "7": $newstr="семьсот ".$newstr;break;
			    case "8": $newstr="восемьсот ".$newstr;break;
			    case "9": $newstr="девятьсот ".$newstr;break;
			}
		}

		if (strlen($str)>9) {
			if (strlen($str)>10 && substr($str,strlen($str)-11,1)=="1") {
		        switch(substr($str,strlen($str)-10,1)) {
			        case "0": $newstr="десять миллиардов ".$newstr;break;
			        case "1": $newstr="одиннадцать миллиардов ".$newstr;break;
			        case "2": $newstr="двенадцать миллиардов ".$newstr;break;
			        case "3": $newstr="тринадцать миллиардов ".$newstr;break;
			        case "4": $newstr="четырнадцать миллиардов ".$newstr;break;
			        case "5": $newstr="пятнадцать миллиардов ".$newstr;break;
			        case "6": $newstr="шестнадцать миллиардов ".$newstr;break;
			        case "7": $newstr="семнадцать миллиардов ".$newstr;break;
			        case "8": $newstr="восемнадцать миллиардов ".$newstr;break;
			        case "9": $newstr="девятнадцать миллиардов ".$newstr;break;
			    }
			} else {
		        switch(substr($str,strlen($str)-10,1)) {
			        case "0": $newstr="миллиардов ".$newstr;break;
			        case "1": $newstr="один миллиард ".$newstr;break;
			        case "2": $newstr="два миллиарда ".$newstr;break;
			        case "3": $newstr="три миллиарда ".$newstr;break;
			        case "4": $newstr="четыре миллиарда ".$newstr;break;
			        case "5": $newstr="пять миллиардов ".$newstr;break;
			        case "6": $newstr="шесть миллиардов ".$newstr;break;
			        case "7": $newstr="семь миллиардов ".$newstr;break;
			        case "8": $newstr="восемь миллиардов ".$newstr;break;
			        case "9": $newstr="девять миллиардов ".$newstr;break;
			    }

			    if (strlen($str)>10) {
			        switch(substr($str,strlen($str)-11,1)) {
				        case "2": $newstr="двадцать ".$newstr;break;
				        case "3": $newstr="тридцать ".$newstr;break;
				        case "4": $newstr="сорок ".$newstr;break;
				        case "5": $newstr="пятьдесят ".$newstr;break;
				        case "6": $newstr="шестьдесят ".$newstr;break;
				        case "7": $newstr="семьдесят ".$newstr;break;
				        case "8": $newstr="восемьдесят ".$newstr;break;
				        case "9": $newstr="девяносто ".$newstr;break;
				    }
				}
			}
		}

		if (strlen($str)>11) {
			switch(substr($str,strlen($str)-12,1)) {
				// case "0": $newstr="сто ".$newstr;break;
			    case "1": $newstr="сто ".$newstr;break;
			    case "2": $newstr="двести ".$newstr;break;
			    case "3": $newstr="триста ".$newstr;break;
			    case "4": $newstr="четыреста ".$newstr;break;
			    case "5": $newstr="пятьсот ".$newstr;break;
			    case "6": $newstr="шестьсот ".$newstr;break;
			    case "7": $newstr="семьсот ".$newstr;break;
			    case "8": $newstr="восемьсот ".$newstr;break;
			    case "9": $newstr="девятьсот ".$newstr;break;
			}
		}
		return $newstr;
	}

}

?>