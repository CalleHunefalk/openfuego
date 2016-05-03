<?php namespace OpenFuego;
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

if (\OpenFuego\VERBOSE == TRUE) {
	ini_set('display_errors', 1);
	ini_set('error_reporting', E_ALL);
}
else {
	ini_set('display_errors', 0);
}

require_once(__DIR__ . '/lib/TwitterOAuth/TwitterOAuth.php');
require_once(__DIR__ . '/lib/Phirehose/UserstreamPhirehose.php');

spl_autoload_register(function($className) {
	    // project-specific namespace prefix
		$prefix = 'Abraham\\TwitterOAuth\\';

		// base directory for the namespace prefix
		$base_dir = __DIR__ . '/lib/TwitterOAuth/';

		// does the class use the namespace prefix?
		$len = strlen($prefix);
		
		// Check first for TwitterOAuth
		if (strncmp($prefix, $class, $len) !== 0) {
			$className = str_replace('OpenFuego' . '\\', '', $className);
			$className = strtr($className, '\\', DIRECTORY_SEPARATOR);	
			$path = __DIR__ . '/' . $className . '.class.php';

			if (is_readable($path)) {
				include_once($path);
			}
		}
		else
		{
			// TwitterOAuth namespace
			// get the relative class name
			$relative_class = substr($className, $len);

			// replace the namespace prefix with the base directory, replace namespace
			// separators with directory separators in the relative class name, append
			// with .php
			$file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

			// if the file exists, require it
			if (file_exists($file)) {
				require $file;
			}
		}
		

});


/* Setting miscellaneous constants */
define(__NAMESPACE__ . '\BASE_DIR', __DIR__);
define(__NAMESPACE__ . '\TMP_DIR', BASE_DIR . '/tmp');
define(__NAMESPACE__ . '\POSTMASTER', __NAMESPACE__ . '@' . __NAMESPACE__ . '.local'); // from address on error e-mails

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