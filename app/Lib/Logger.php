<?php

namespace CoBay\mktorrent_webgui\Lib;

use CoBay\mktorrent_webgui\Exceptions\FilePermissions as FilePermissions;

class Logger {
	
	protected		$_fp;
	
	
	public function __construct( string $logname, bool $datebased = true){
		
		if( $datebased ){
			$logname . '-' . date('Y-m-d');
		}
		$this->_fp = LOGS . $logname . '.log';
	}
	
	
	public function add( string $msg, bool $throwOnFail = true ):bool {
		$msg = '[' . date('H:i:s M j Y T') . ']  ' . $msg . PHP_EOL . PHP_EOL;
		$result = @file_put_contents( $this->_fp, $msg, FILE_APPEND);
		
		if( $throwOnFail && $result === false){
			Throw new FilePermissions('Failed To Write To File: ' . $this->_fp);
		}
		return (bool) $result;
	}
	public function empty( bool $throwOnFail = true):bool {
		$result = @file_put_contents( $this->_fp, '');
		
		if( $throwOnFail && $result === false){
			Throw new FilePermissions('Failed To Write To File: ' . $this->_fp);
		}
		
		return (bool) $result;
	}
}