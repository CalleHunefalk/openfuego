<?php namespace CalleHunefalk\OpenFuego;

class Logger {
	
	public static $verbose = \CalleHunefalk\OpenFuego\VERBOSE;
	public static $tmp;
	
	public static function debug($message) {
		
		$messageFormatted = self::getTimestamp() . $message . "\n";

		if (self::$verbose) {
			echo $messageFormatted;
		}
	}
	
	public static function info($message) {

		$messageFormatted = self::getTimestamp() . $message . "\n";

		if (self::$verbose) {
			echo $messageFormatted;
		}
		
		// write to log
	}

	public static function error($message) {

		$messageFormatted = self::getTimestamp() . $message . "\n";

		if (self::$verbose) {
			echo $messageFormatted;
		}
		
		// write to log
	}
	
	public static function fatal($message) {
		
		$messageFormatted = self::getTimestamp() . $message . "\n";
		
		if (self::$verbose) {
			echo $messageFormatted;
		}

		else {
			$subject = "OpenFuego encountered a fatal error";
			self::notify($subject, $messageFormatted);	
		}

		// write to log
	}
	
	private static function notify($subject, $message) {
		mail(\OpenFuego\WEBMASTER, $subject, $message, 'From: ' . \CalleHunefalk\OpenFuego\POSTMASTER);
	}
	
	private static function getTimestamp() {
		return '[' . date('Y-m-d H:i:s') . ']: ';
	}
}