<?php
require_once dirname(__FILE__).'/../bootstrap/unit.php';

$t = new lime_test(4);

$t->comment('::getString testing');
$t->is(Support::getString(array('Design','Programming')), 'Design-Programming', '::getString() преобразует массив в строку вида:1-2');
$t->is(Support::getString('design-programming'), array('design','programming'), '::getString() преобразует строку в массив');
try
{
	Support::getString('design-asd');
	$t->fail('no code should be executed after throwing an exception');
}
catch (Exception $e)
{
	$t->pass('::getString() вернет сообщение об ошибке, если данные не валидны');
}
try {
	Support::getString(false);
	$t->fail('no code should be executed after throwing an exception');
	}
	catch (Exception $e)
	{
		$t->pass('::getString() вернет сообщение об ошибке, если тип данных не строка и не массив');
	}
?>