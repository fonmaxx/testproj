<?php
class Support
{
	//вернет строку вида "1-2-3"(param=true) либо из строки массив категорий,
	//также проверит валидность строки
	//вернет false если строка не валидна
	static public function getString($string)
	{
		switch (true)
		{
			case is_array($string):
				$s=false;
				foreach($string as $w )
				{
					$s.= $w."-";
				}
				return substr($s,0,-1);

			case is_string($string):
				$category=explode("-",$string);
				$cat=Doctrine_Core::getTable('JobeetCategory')->getCategorySet();
				$v = new sfValidatorChoice(array(
						'choices' => array_keys($cat),
						'multiple'=>true
						));
				try
				{
					$v->clean($category);
				}
				catch(sfValidatorError $e)
				{
					throw new sfError404Exception(sprintf('Set of categories "%s" is not valid.', implode('-',$category)));
					return false;
				}
				return $category;

			default:
				throw new sfError404Exception(sprintf('wrong type of variable: string= "%s" ,expected string or array.', $string));
		}
	}
	static public function rus2translit($string)
	{
		$converter = array(
				'а' => 'a',   'б' => 'b',   'в' => 'v',
				'г' => 'g',   'д' => 'd',   'е' => 'e',
				'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
				'и' => 'i',   'й' => 'y',   'к' => 'k',
				'л' => 'l',   'м' => 'm',   'н' => 'n',
				'о' => 'o',   'п' => 'p',   'р' => 'r',
				'с' => 's',   'т' => 't',   'у' => 'u',
				'ф' => 'f',   'х' => 'h',   'ц' => 'c',
				'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
				'ь' => "'",  'ы' => 'y',   'ъ' => "'",
				'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

				'А' => 'A',   'Б' => 'B',   'В' => 'V',
				'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
				'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
				'И' => 'I',   'Й' => 'Y',   'К' => 'K',
				'Л' => 'L',   'М' => 'M',   'Н' => 'N',
				'О' => 'O',   'П' => 'P',   'Р' => 'R',
				'С' => 'S',   'Т' => 'T',   'У' => 'U',
				'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
				'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
				'Ь' => "'",  'Ы' => 'Y',   'Ъ' => "'",
				'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
		);
		return strtr($string, $converter);
	}
}
?>