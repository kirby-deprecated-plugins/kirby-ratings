<?php
namespace JensTornell\Ratings;
use JensTornell\Ratings as Ratings;
use f;
use l;
use c;

function isValidIP( $post ) {
	if( in_array( $_SERVER['REMOTE_ADDR'], c::get('plugin.ratings.blocked.ips', []) ) ) {
		$array = array(
			'success' => false,
			'message' => l::get('plugin.ratings.invalid.ip')
		);
		echo json_encode($array);
		die;
	}
}

function canVote( $post ) {
	$page = page( $post['id'] . '/blacklist' );
	if( $page ) {
		$path = $page->root() . DS . md5($_SERVER['REMOTE_ADDR']);
		if( f::exists( $page->root() . DS . md5( $_SERVER['REMOTE_ADDR'] ) ) ) {
			$array = array(
				'success' => false,
				'message' => l::get('plugin.ratings.already.voted', 'You have already voted!')
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
			'message' => l::get('plugin.ratings.invalid.secret', 'The secret number is wrong!')
		);
		echo json_encode($array);
		die;
	}
}

function isRating( $post ) {
	if( empty( $post['value'] ) || $post['value'] < 1 || $post['value'] > 5 ) {
		$array = array(
			'success' => false,
			'message' => l::get('plugin.ratings.invalid.format','The input format is wrong!')
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
			'message' => l::get('plugin.ratings.page.does.not.exist', 'This page does not exist!')
		);
		echo json_encode($array);
		die;
	}
}