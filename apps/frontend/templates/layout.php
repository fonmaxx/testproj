<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>
  		<?php include_slot('title', 'Jobeet - Your best job board') ?>
	</title>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_javascripts() ?>
    <?php include_stylesheets() ?>
  	<link rel="alternate" type="application/atom+xml" title=<?php echo "Latest Jobs"?>
  		  href="<?php echo url_for('job', array('sf_format' => 'atom'), true) ?>" />
  	<?php use_javascript('jQuery_1.8.3.js') ?>
  	<?php use_javascript('search.js') ?>
  	<?php  use_helper('I18N')?>
  </head>
  <body>
    <div id="container">
      <div id="header">
        <div class="content">
          	<h1>
  				<a href="<?php echo url_for('homepage') ?>">
    				<img src="/images/logo.jpg" alt="Jobeet Job Board" />
  				</a>
			</h1>
          <div id="sub_header">
            <div class="post">
              <h2><?php echo 'Ask for people'?></h2>
              <div>
                <a href="<?php echo url_for('job_new') ?>"><?php echo 'Post a Job'?></a>
              </div>
            </div>
            <div class="search">
            	<h2><?php echo 'Ask for a job'?></h2>
				<form action="<?php echo url_for('job_search') ?>" method="get">
  					<input type="text" name="query" value="<?php echo $sf_request->getParameter('query') ?>" id="search_keywords" />
  					<input type="submit" value="search" />
  					<img id="loader" src="/legacy/images/loader.gif" style="vertical-align: middle; display: none" />
   					<div class="help">
    					<?php echo __('Enter some keywords (city, country, position, ...)')?>
  					</div>
				</form>
            </div>
          </div>
        </div>
      </div>

      <div id="content">
        <?php if ($sf_user->hasFlash('notice')): ?>
          <div class="flash_notice">
            <?php echo $sf_user->getFlash('notice') ?>
          </div>
        <?php endif ?>

        <?php if ($sf_user->hasFlash('error')): ?>
          <div class="flash_error">
            <?php echo $sf_user->getFlash('error') ?>
          </div>
        <?php endif ?>

        <div id="job_history">
  			<?php echo __('Recent viewed jobs:')?>
  			<ul>
    			<?php foreach ($sf_user->getJobHistory() as $job): ?>
      			<li>
        			<?php echo link_to($job->getPosition().' - '.$job->getCompany(), 'job_show_user', $job) ?>
      			</li>
    			<?php endforeach ?>
  			</ul>
		</div>


        <div class="content">
          <?php echo $sf_content ?>
        </div>
      </div>

      <div id="footer">
        <div class="content">
          <span class="symfony">
            <img src="/images/jobeet-mini.png" />
            powered by <a href="http://www.symfony-project.org/">
            <img src="/images/symfony.gif" alt="symfony framework" />
            </a>
          </span>
          <ul>
            <li><a href=""><?php echo __('About Jobeet')?></a></li>
            <li class="feed"> <a href="<?php echo url_for('job', array('sf_format' => 'atom')) ?>"><?php echo __('Full feed')?></a></li>
            <li class="last"><a href="<?php echo url_for('affiliate_new') ?>"><?php echo __('Become an affiliate')?></a></li>
            <li class="last"><a href="<?php echo url_for('api') ?>"><?php echo __('Affiliate api')?></a></li>
          </ul>
          <?php include_component('language', 'language') ?>
        </div>
      </div>
    </div>
  </body>
</html>
