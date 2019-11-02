<?php

namespace CoBay\mktorrent_webgui\Lib;

class Autoloader {
	
	private	 static		$_root;
	
	
	
	public static function Init(){
		self::$_root = \CoBay\mktorrent_webgui\ROOT;
		
		spl_autoload_register(['self', 'Load']);
	}
	public static function Load( string $classname):bool {
		$classname = substr( $classname, 23); // Remove CoBay\mktorrent_webgui\
		$fp = self::$_root . str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';

		if( file_exists( $fp ) ){
			require $fp;
			return true;
		}
		
		return false;
	}
}