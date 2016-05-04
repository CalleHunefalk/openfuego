<?php namespace CalleHunefalk\OpenFuego;
require_once __DIR__ . "/../vendor/autoload.php";

class TwitterHandle extends \Abraham\TwitterOAuth\TwitterOAuth {

	private $consumerKey;
	private $consumerSecret;
	private $accessToken;
	private $accessTokenSecret;

	public function __construct() {

		$this->consumerKey = \CalleHunefalk\OpenFuego\TWITTER_CONSUMER_KEY;
		$this->consumerSecret = \CalleHunefalk\OpenFuego\TWITTER_CONSUMER_SECRET;
		$this->accessToken = \CalleHunefalk\OpenFuego\TWITTER_OAUTH_TOKEN;
		$this->accessTokenSecret = \CalleHunefalk\OpenFuego\TWITTER_OAUTH_SECRET;
		
		try {
			parent::__construct(
				$this->consumerKey,
				$this->consumerSecret,
				$this->accessToken,
				$this->accessTokenSecret
			);
		}

		catch (\PDOException $e) {
			Logger::error($e);
		}
	}
	
	// Overloading TwitterOAuth's get(), post(), delete() methods to decode JSON as array
	// public function get($url, $parameters = array()) {
		// $response = $this->oAuthRequest($url, 'GET', $parameters);
		// if ($this->format === 'json' && $this->decode_json) {
			// return json_decode($response, TRUE);
		// }
		// return $response;
	// }
	
	// function post($url, $parameters = array()) {
		// $response = $this->oAuthRequest($url, 'POST', $parameters);
		// if ($this->format === 'json' && $this->decode_json) {
			// return json_decode($response, TRUE);
		// }
		// return $response;
	// }
	
	// function delete($url, $parameters = array()) {
		// $response = $this->oAuthRequest($url, 'DELETE', $parameters);
		// if ($this->format === 'json' && $this->decode_json) {
			// return json_decode($response, TRUE);
		// }
		// return $response;
	// }
}
