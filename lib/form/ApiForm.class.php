<?php

class ApiForm extends sfForm
{
	public function configure()
	{
		$this->widgetSchema['token']=new sfWidgetFormInput();
		$this->widgetSchema->setHelp('token', 'type your token here.');
		$this->validatorSchema['token']=new sfValidatorString(
				array('required' => true),
  				array('required' => 'Type your token!.')
		);

		$categories=Doctrine_Core::getTable('JobeetCategory')->getCategorySet();
		$this->widgetSchema['cat']=new sfWidgetFormChoice(array(
				'choices'  =>$categories ,
				'expanded' => true,
				"multiple"=>true,
				));
		$this->widgetSchema['cat']->setOption('expanded', true);
    	$this->widgetSchema['cat']->setLabel('Categories');
    	$this->widgetSchema->setHelp('cat', 'Choose category, one ore more.');
    	$this->validatorSchema['cat'] =  new sfValidatorChoice(array(
				'choices' => array_keys($categories),
    			'multiple'=>true
				));

    	$this->widgetSchema['num']=new sfWidgetFormInput();
		$this->widgetSchema->setHelp('num', 'type a number of jobs to view.');
		$this->validatorSchema['num']= new sfValidatorAnd(array(
				new sfValidatorInteger(),
				new sfValidatorString(array('required'=>true))
				));


		$types=array("xml"=>"xml","json"=>"json","yaml"=>"yaml");
		$this->widgetSchema['type'] = new sfWidgetFormChoice(array(
					'choices'  => $types,
					'expanded' => true,
					));
		$this->widgetSchema->setHelp('type', 'Choose a type of list to get.');
		$this->validatorSchema['type'] = new sfValidatorChoice(array(
				'choices' => array_keys($types),
		));

		$this->widgetSchema->setNameFormat('api[%s]');
	}
}
