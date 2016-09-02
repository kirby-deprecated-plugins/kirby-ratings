<?php
namespace JensTornell\Ratings;
use JensTornell\Ratings as Ratings;

ini_set('html_errors', false);

class Vote {
	function __construct($post) {
		$this->post = $post;
		$this->page = page( $post['id'] );
		$this->add();
	}

	function add() {
		return $this->page->increment('rating_' . $this->post['value']);
	}

	function reset() {
		try {
			$this->page->update(array(
				'rating_1' => 0,
				'rating_2' => 0,
				'rating_3' => 0,
				'rating_4' => 0,
				'rating_5' => 0,
			));
		} catch(Exception $e) {
			echo $e->getMessage();
		}
	}
}
