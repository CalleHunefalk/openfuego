<?php namespace CalleHunefalk\OpenFuego;

/**
  * Do not run this file directly.
  * Edit config.php to set up the application.
  * Then run fetch.php at the command line.
  *
  * This file must be included in scripts.
  *
  * Gracias.
**/

if (!defined('PHP_VERSION_ID') || PHP_VERSION_ID < 50608) {
	die(__NAMESPACE__ . ' requires PHP 5.6.9 or higher.');
}

define('OPENFUEGO', TRUE);

require(__DIR__ . '/config.php');

if (isset($argv) && in_array('-v', $argv)) {
	define(__NAMESPACE__ . '\VERBOSE', TRUE);
}

else {
	define(__NAMESPACE__ . '\VERBOSE', FALSE);
}

if (\CalleHunefalk\OpenFuego\VERBOSE == TRUE) {
	ini_set('display_errors', 1);
	ini_set('error_reporting', E_ALL);
}
else {
	ini_set('display_errors', 0);
}

require __DIR__ . '/vendor/autoload.php';

/* Setting miscellaneous constants */
define(__NAMESPACE__ . '\BASE_DIR', __DIR__);
define(__NAMESPACE__ . '\TMP_DIR', BASE_DIR . '/tmp');
define(__NAMESPACE__ . '\POSTMASTER', __NAMESPACE__ . '@' . __NAMESPACE__ . '.local'); // from address on error e-mails
/* Constants Phirehose may be looking for, without namespace prefix */
define('TWITTER_SCREEN_NAME', TWITTER_SCREEN_NAME);
define('TWITTER_CONSUMER_KEY', TWITTER_CONSUMER_KEY);
define('TWITTER_CONSUMER_SECRET', TWITTER_CONSUMER_SECRET);
define('TWITTER_OAUTH_TOKEN', TWITTER_OAUTH_TOKEN);
define('TWITTER_OAUTH_SECRET', TWITTER_OAUTH_SECRET);

if (!is_dir(TMP_DIR)) {
	mkdir(TMP_DIR);
	file_put_contents(TMP_DIR . '/nothing', 'This file was created to initialize the cache directory. You can delete it.');
}

const TWITTER_PREDICATE_LIMIT = 5000;

define(__NAMESPACE__ . '\BITLY_PRO_DOMAINS', serialize(
	array(  // assume these domains are shortened with Bitly
		'bit.ly',
		'bitly.com',
		'j.mp'
	)
));

define(__NAMESPACE__ . '\SHORT_DOMAINS', serialize(
	array(  // domains whose "long" urls are already short
		'twitpic.com',
		'instagr.am',
		'instagram.com',
		'yfrog.com',
		'twitpic.com',
		'vimeo.com',
		'i.imgur.com',
		'mlkshk.com',
		'lockerz.com',
		'path.com',
		'vine.co'
	)
));

const
	DB_DRIVER = 'mysql',
	USER_AGENT = 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
	REFERRER = 'http://google.com';
/*
if (file_exists(OPENFUEGO_DIR . '/openfuego-overrides.php')) {
	include_once(OPENFUEGO_DIR . '/openfuego-overrides.php');
}
*/