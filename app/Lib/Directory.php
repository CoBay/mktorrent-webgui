<?php

namespace CoBay\mktorrent_webgui\Lib;


class Directory {
	
	protected		$_base;
	protected		$_handle;
	
	protected		$_dirs = [];
	protected		$_files = [];
	
	/*	Magic Methods
	*/
	public function __construct( string $path){
		$path = realpath( $path ) .  DS;
		if( !is_dir( $path ) ){
			Throw New CoBay\mktorrent_webgui\Exceptions\InvalidInput('The path "' . $path .'" is not a valid Directory.');
		}else if( !is_readable( $path ) ){
			Throw New CoBay\mktorrent_webgui\Exceptions\FilePermissions('The permissions of "' . $path . '" are such that I will not be able to work with it.');
		}
		
		$this->_base = $path;
		
		$this->_handle = opendir( $path );
		
		if( $this->_handle === false){
			Throw New CoBay\mktorrent_webgui\Exceptions\ServerError('Couldn\'t open directory "' . $path . '", although the checks had passed.');
		}
		
		
		$this->_scan_dir();
	}
	public function __destruct(){
		if( $this->_handle ){
			closedir( $this->_handle);
		}
	}

	/*	Protected Methods
	*/
	protected function _scan_dir(){
		while( $path = readdir( $this->_handle )){
			if( $path !== '.' && $path !== '..'){
				if( is_dir( $this->_base . $path)){
					$this->_dirs[] = $path;
				}else{
					$this->_files[] = $path;
				}
			}
		}
		natcasesort( $this->_dirs );
		natcasesort( $this->_files );
	}
	
	/*	Public Methods
	*/
	public function size( bool $recursive = true):int{
		$size = 0;
		if( $recursive ){
			foreach( $this->_dirs as $dir){
				$sd = new self( $this->_base . $dir);
				$size += $sd->size( true );
				unset($sd);
			}
		}
		
		foreach( $this->_files as $file){
			$size += filesize( $this->_base . $file);
		}
		
		return $size;
	}
	public function files( bool $fullPath = true):array {
		$r = [];
		foreach( $this->_files as $file){
			$r[] = (($fullPath)? $this->_base : '') . $file;
		}
		return $r;
	}
	public function dirs( bool $fullPath = true):array {
		$r = [];
		foreach( $this->_dirs as $dir){
			$r[] = (($fullPath)? $this->_base : '') . $dir .  DS;
		}
		return $r;
	}
	public function ls( bool $fullPath = true):array {
		$r = [];
		foreach( $this->_dirs as $dir){
			$r[] = (($fullPath)? $this->_base : '') . $dir .  DS;
		}
		foreach( $this->_files as $file){
			$r[] = (($fullPath)? $this->_base : '') . $file;
		}
		return $r;
	}
	
}