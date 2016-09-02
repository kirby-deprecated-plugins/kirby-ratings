<?php
use JensTornell\Ratings as Ratings;

class RatingsField extends BaseField {
	static public $fieldname = 'ratings';
	static public $assets = array(
		'css' => array(
			'style.css',
			'stars.css'
		)
	);

	public function input() {
		$html = tpl::load( __DIR__ . DS . 'template.php', $data = array(
			'field' => $this,
			'page' => $this->page()
		));
		return $html;
	}
}
