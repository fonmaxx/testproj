<?php
class Jobeet
{
	static public function slugify($text)
	{
  		// replace non letter or digits by -
 	 	$text = preg_replace('#[^\\pL\d]+#u', '-', $text);
  		// trim
  		$text = trim($text, '-');
  		// transliterate
  		if (function_exists('iconv'))
  		{
    		$text =($a= @iconv('utf-8', 'us-ascii//TRANSLIT', $text))?$a:Support::rus2translit($text);
  		}

  		// lowercase
  		$text = strtolower($text);

  		// remove unwanted characters
  		$text = preg_replace('#[^-\w]+#', '', $text);

  		if (empty($text))
  		{
    		return 'n-a';
 		 }
  		return $text;
	}
}
?>