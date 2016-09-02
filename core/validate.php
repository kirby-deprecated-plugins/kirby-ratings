<?php
namespace JensTornell\Ratings;
use JensTornell\Ratings as Ratings;
use f;

function canVote( $post ) {
	$page = page( $post['id'] . '/blacklist' );
	if( $page ) {
		$path = $page->root() . DS . md5($_SERVER['REMOTE_ADDR']);
		if( f::exists( $page->root() . DS . md5( $_SERVER['REMOTE_ADDR'] ) ) ) {
			$array = array(
				'success' => false,
				'message' => 'You have already voted!'
			);
			echo json_encode($array);
			die;
		}
	}
}

function isHuman( $post ) {
	$secret = date('Y') * date('n') * strlen($post['id']);

	if( $secret != $post['secret'] ) {
		$array = array(
			'success' => false,
			'message' => 'Wrong secret!'
		);
		echo json_encode($array);
		die;
	}
}

function isRating( $post ) {
	if( empty( $post['value'] ) || $post['value'] < 1 || $post['value'] > 5 ) {
		$array = array(
			'success' => false,
			'message' => 'The voting number is wrong!'
		);
		echo json_encode($array);
		die;
	}
}

function isPage( $post ) {
	$page = page( $post['id'] );
	if( ! $page ) {
		$array = array(
			'success' => false,
			'message' => 'The page does not exist!'
		);
		echo json_encode($array);
		die;
	}
}