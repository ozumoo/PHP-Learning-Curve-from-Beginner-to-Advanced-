<?php 

namespace phpUnitTutorial;
class Url 
{
	/**
	 * [sluggify create a nice slug like wordpress]
	 * @param  [type]  $string    [text given]
	 * @param  string  $separator [unqiue opreator]
	 * @param  integer $maxLength [length of url]
	 * @return [type]             [string]
	*/
	public function sluggify($string , $separator = '-',$maxLength = 96)
	{
		$title = iconv('UTF-8','ASCII//TRANSLIT',$string); //TRANSLIT -> converts it to eqivlant like € => EUR
		$title = preg_replace("%[^-/+|\w ]%",'',$title); //replace special character with nothing
		$title = strtolower(trim(substr($title,0,$maxLength),'-')); //lowercase + remove whitespace + [get string with - only]
		$title = preg_replace("/[\/_|+ -]+/", $separator, $title); //replace anystring character with - 

		return $title;
	}
}