<?php
include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new JobeetTestFunctional(new sfBrowser());
$browser->loadData();

$browser->
info('1 - Web service security')->

info('  1.1 - A token is needed to access the service')->
get('/api/foo/10/jobs.xml/programming-design')->
with('response')->
begin()->
isStatusCode(404)->
end()->

info('  1.2 - An inactive account cannot access the web service')->
get('/api/symfony/10/jobs.xml/programming-design')->
with('response')->
begin()->
isStatusCode(404)->
end()->

info('  1.3 - A category set must be valid')->
get('/api/sensio_labs/10/jobs.xml/programming-asd')->
with('response')->
begin()->
isStatusCode(404)->
end()->

info('  1.4 - write format of num')->
get('/api/sensio_labs/1a/jobs.xml/programming-asd')->
with('response')->
begin()->
isStatusCode(404)->
end()->

info('  1.5 - отсутствует формат запроса')->
get('/api/sensio_labs/10/programming')->
with('response')->
begin()->
isStatusCode(404)->
end()->

info('2 - The jobs returned are limited to the categories configured for the affiliate')->
get('/api/sensio_labs/15/jobs.xml/programming')->
with('request')->isFormat('xml')->
with('response')->begin()->
isValid()->
checkElement('job', 15)->
end()->

info('3 - The web service supports the JSON format')->
get('/api/sensio_labs/15/jobs.json/programming')->
with('request')->isFormat('json')->
with('response')->
begin()->
matches('/"category"\: "Programming"/')->
end()->

info('4 - The web service supports the YAML format')->
get('/api/sensio_labs/10/jobs.yaml/programming-design')->
with('response')->
begin()->
isHeader('content-type', 'text/yaml; charset=utf-8')->
matches('/category\: Programming/')->
end()->

info('5- проверка работы формы')->
info('5.1- валидность данных- соответсвие ожидаемому формату')->
get('/en/api')->click('get list',array('api'=>array(
		'num'=>'1a',
		'cat'=>array('asd','programming'),
		'type'=>'asd'
		)))->
with('form')->
begin()->
isError('token','required')->
isError('num','invalid')->
isError('type','invalid')->
isError('cat','invalid')->
end()->

info('5.2- валидность данных- проверка на required')->
get('/en/api')->click('get list',array('api'=>array()))->
with('form')->
begin()->
isError('token','required')->
isError('num','required')->
isError('type')->
isError('cat')->
end()->

info('5.2- отображение результата')->
get('/en/api')->click('get list',array('api'=>array(
		'num'=>'10',
		'cat'=>array('design','programming'),
		'type'=>'xml',
		'token'=>'sensio_labs'
		)))->
with('response')->begin()->
isHeader('content-type', 'text/xml; charset=utf-8')->
isValid()->
checkElement('job', 10)->
end();