<?php

/*include(dirname(__FILE__).'/bootstrap/Doctrine.php');

function token_query($cat,$token='sensio_labs',$num=10)
{
	$q=Doctrine_Query::create()
        ->select('j.*')
		->from('JobeetJob j')
		->leftJoin('j.JobeetCategory c')
		->leftJoin('c.JobeetAffiliates a')
		->where('a.token =?',$token)
		->andWhereIn('c.slug',$cat)
		->andWhere('j.expires_at > ?', date('Y-m-d H:i:s', time()))
		->addOrderBy( 'j.created_at DESC')
		->andWhere('j.is_activated = ?', 1)
		->limit($num);
	return $q;
}
function make_array($cat,$token='sensio_labs',$num=10)
{
	$param=array(
			'cat'=>$cat,
			'sf_format'=>'xml',
			'num'=>$num,
			'token'=>$token,
			'csrf_token'=>'asdasdasdsda'
	);
	return $param;
}
$param=make_array("programming-design");
//$param=make_array(array('programming','design'));
/*
$asd=Doctrine_Core::getTable('JobeetJob')->getForToken($param)->getFirst()->getData();
$query=token_query(array('programming','design'))->execute()->getFirst()->getData();
var_dump($query);
var_dump($asd);
sfProjectConfiguration::getActive()->loadHelpers('Url');
echo url_for('api_jobs',$param,false);
//var_dump(array('sf_route' => 'api_jobs'));
*/
//echo dirname(__FILE__);
require ".\lib\Support.class.php";
$text='progr';
$text=($a= @iconv('utf-8', 'us-ascii//TRANSLIT', $text))?$a:Support::rus2translit($text);


echo $text;
?>