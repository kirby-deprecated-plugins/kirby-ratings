<?php
namespace JensTornell\Ratings;
use JensTornell\Ratings as Ratings;
use f;
use visitor;

class LanguageSwitcherPanel {
	function __construct() {
		$this->userLanguage = substr( site()->user()->language(), 0, 2 );
		$this->folderpath = kirby()->roots()->plugins() . DS . 'kirby-ratings' . DS . 'languages';
		$this->filepath = $this->folderpath . DS . $this->userLanguage . '.php';
		$this->defaultFilepath = $this->folderpath . DS . 'en.php';

		if( f::exists( $this->filepath ) ) {
			require_once $this->filepath;
		} else {
			require_once $this->defaultFilepath;
		}
	}
}

class LanguageSwitcherFrontend {
	function __construct() {
		$this->folderpath = kirby()->roots()->plugins() . DS . 'kirby-ratings' . DS . 'languages';
		$this->filepath = $this->folderpath . DS . visitor::acceptedLanguageCode() . '.php';
		$this->defaultFilepath = $this->folderpath . DS . 'en.php';

		if( f::exists( $this->filepath ) ) {
			require_once $this->filepath;
		} else {
			require_once $this->defaultFilepath;
		}
	}
}

if( function_exists('panel') ) {
	new Ratings\LanguageSwitcherPanel();
} else {
	new Ratings\LanguageSwitcherFrontend();
}
