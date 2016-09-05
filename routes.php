<?php
use JensTornell\Ratings as Ratings;

kirby()->routes(array(
	array(
		'pattern' => 'plugin.ratings/(:all)',
		'method' => 'POST',
		'action' => function($uid) {
			$post['id'] = $uid;
			$post['value'] = get('value');
			$post['secret'] = get('secret');

			if( ! site()->languages() ) {
				new Ratings\LanguageSwitcherFrontend();
			} else {
				new Ratings\LanguageSwitcherFrontendMultilang();
			}


			Ratings\isValidIP( $post );
			Ratings\canVote( $post );
			Ratings\isHuman( $post );
			Ratings\isRating( $post );

			new Ratings\Blacklist( $post );

			Ratings\isPage( $post );

			new Ratings\Vote( $post );

			$array = array(
				'success' => true,
			);
			echo json_encode($array);
		}
	),
	array(
		'pattern' => 'plugin.ratings.delete.blacklist/(:all)',
		'method' => 'GET',
		'action' => function($uid) {
			if( ! site()->user() ) {
				return site()->visit( site()->errorPage() );
			}

			if( page( $uid . '/blacklist' ) ) {
				try {
					page( $uid . '/blacklist' )->delete(true);
				} catch(Exception $e) {}
			}

			$panel_root_url = c::get('plugin.ratings.panel.root.url', u() . '/panel');
			$back_url = $panel_root_url . '/pages/' . page( $uid )->id() . '/edit';

			go($back_url);
		}
	),
	array(
		'pattern' => 'plugin.ratings.delete.votes/(:all)',
		'method' => 'GET',
		'action' => function($uid) {
			if( ! site()->user() ) {
				return site()->visit( site()->errorPage() );
			}

			if( page( $uid )) {
				try {
					page( $uid )->update(array(
						'rating_1' => null,
						'rating_2' => null,
						'rating_3' => null,
						'rating_4' => null,
						'rating_5' => null
					));

				} catch(Exception $e) {}

				$panel_root_url = c::get('plugin.ratings.panel.root.url', u() . '/panel');
				$back_url = $panel_root_url . '/pages/' . page( $uid )->id() . '/edit';

				go($back_url);
			}
		}
	)
));

function ratingReset($post) {
	try {
		if( page( $post['id'] . '/blacklist' ) ) {
			page( $post['id'] . '/blacklist' )->delete();
		}
	} catch(Exception $e) {
	}
}
