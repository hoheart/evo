<?php

namespace HHP\Router;

use HHP\App;
use HHP\HttpRequest;

class Redirector {

	/**
	 * Create a new Redirector instance.
	 *
	 * @param URLGenerator $generator        	
	 * @return void
	 */
	public function __construct () {
	}

	static public function Instance () {
		static $me = null;
		if (null == $me) {
			$me = new self();
		}
		
		return $me;
	}

	/**
	 * Create a new redirect response to the "home" route.
	 */
	public function home () {
		return $this->to('/');
	}

	/**
	 * Create a new redirect response to the previous location.
	 */
	public function back (HttpRequest $req) {
		$app = App::Instance();
		$ref = $req->getHeader('referer');
		
		return $this->to($ref);
	}

	/**
	 * Create a new redirect response to the current URI.
	 */
	public function refresh (HttpRequest $req) {
		return $this->to($req->getURI());
	}

	/**
	 * Create a new redirect response to the given path.
	 *
	 * @param string $path        	
	 * @param int $status        	
	 * @param array $headers        	
	 * @param bool $secure        	
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function to ($path) {
		header('Location: ' . $path, null, 302);
		
		exit(0);
	}
}
