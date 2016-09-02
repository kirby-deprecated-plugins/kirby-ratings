<?php
// https://getkirby.com/docs/developer-guide/objects/page

page::$methods['ratingAverage'] = function($page) {
	$values = array(
		$page->rating_1()->int(),
		$page->rating_2()->int(),
		$page->rating_3()->int(),
		$page->rating_4()->int(),
		$page->rating_5()->int(),
	);

	$rating = 0;
	foreach( $values as $key => $value ) {
		if( empty( $value ) ) {
			$value = 0;
		}
		$rating += ( $key + 1 ) * $value;
	}

	if( empty( array_sum($values) ) ) {
		return 3;
	}
	$average = $rating / array_sum($values);
	return round( $average, 1 );
};

page::$methods['ratingCount'] = function($page) {
	$values = array(
		$page->rating_1()->int(),
		$page->rating_2()->int(),
		$page->rating_3()->int(),
		$page->rating_4()->int(),
		$page->rating_5()->int(),
	);
	return array_sum($values);
};