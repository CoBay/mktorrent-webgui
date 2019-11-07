<?php

namespace CoBay\mktorrent_webgui\Lib;

class Autoloader {
	
	private	 static		$_root;
	
	
	
	public static function Init(){
		self::$_root = APP_ROOT;
		
		spl_autoload_register(['self', 'Load']);
	}
	public static function Load( string $classname):bool {
		$fp = self::$_root . str_replace(['CoBay\\mktorrent_webgui\\','\\'], ['', DIRECTORY_SEPARATOR] , $classname) . '.php';

		if( file_exists( $fp ) ){
			require $fp;
			return true;
		}
		
		return false;
	}
}