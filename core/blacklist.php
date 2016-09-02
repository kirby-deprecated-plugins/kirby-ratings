<?php
namespace JensTornell\Ratings;
use JensTornell\Ratings as Ratings;
use f;

class Blacklist {
	function __construct($post) {
		$this->post = $post;
		$this->id = $post['id'];
		$this->filename = md5( $_SERVER['REMOTE_ADDR'] );

		if( $this->createPage() ) {
			$this->createFile();
		}
	}

	function createPage() {
		if( ! $this->pageExists() ) {
			try {
				page()->create( $this->id . '/blacklist', 'blacklist', array(
					'title' => 'Blacklist',
				));
			} catch(Exception $e) {
				$array = array(
					'success' => false,
					'message' => 'Could not save your rating'
				);
				echo json_encode($array);
				die;
			}
		}
		return true;
	}

	function pageExists() {
		return page( $this->post['id'] . '/blacklist' );
	}

	function createFile() {
		f::write( page( $this->post['id'] . '/blacklist')->root() . DS . $this->filename, '' );
	}

	function reset() {
		try {
			page( $this->id . '/blacklist' )->delete();
		} catch(Exception $e) {
		}
	}
}
