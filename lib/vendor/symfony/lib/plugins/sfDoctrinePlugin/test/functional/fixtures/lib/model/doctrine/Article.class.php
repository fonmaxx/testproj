<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Article extends BaseArticle {
	public function getTestingNonColumn() {
		return 'test-' . $this->slug;
	}
}
