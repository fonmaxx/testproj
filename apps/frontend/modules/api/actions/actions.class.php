<?php

/**
 * api actions.
 *
 * @package    jobeet
 * @subpackage api
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class apiActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
	public function executeList(sfWebRequest $request)
	{
		$this->jobs = array();
		foreach ($this->getRoute()->getObjects() as $job)
		{
			$this->jobs[$this->generateUrl('job_show_user', $job, true)] = $job->asArray($request->getHost());
		}
		switch ($request->getRequestFormat())
		{
			case 'yaml':
				$this->setLayout(false);
				$this->getResponse()->setContentType('text/yaml');
				break;
		}
	}
	public function executeApi(sfWebRequest $request)
	{

		$this->form = new ApiForm($this->getRequest()->getParameter("api"));
		if ($this->getRequest()->isMethod('post'))
			{
				$this->processForm($request, $this->form);

			}
		$this->form->setDefault("number",10);

	}
	protected function processForm(sfWebRequest $request, sfForm $form)
	{
		$form->bind($request->getParameter($form->getName()));
		if ($form->isValid())
		{

			$this->getList($request);

		}
	}
	protected function getList(sfWebRequest $request)
	{
		$params=$this->getRequest()->getParameter("api");
		$request->setParameter('sf_format',$params['type']);
		$this->job=Doctrine_Core::getTable('JobeetJob')->getForToken($params,true);
		$params['cat']=Support::getString($params['cat']);
		$this->jobs=array();
		$this->url=false;
		$params['sf_format']=$params['type'];
		unset($params['type']);
		unset($params['_csrf_token']);
		//var_dump($params);
		$this->url=$this->generateUrl('api_jobs',$params,true);
		foreach ($this->job as $job)
		{
			$this->jobs[$this->generateUrl('job_show_user', $job, true)] = $job->asArray($request->getHost());
		}
		$this->setTemplate('list');
		switch ($params['sf_format'])
		{
			case 'yaml':
				$this->setLayout(false);
				$this->getResponse()->setContentType('text/yaml');
				break;
		}
	}
}
