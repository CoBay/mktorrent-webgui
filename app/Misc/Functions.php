<?php

namespace CoBay\mktorrent_webgui;

use CoBay\mktorrent_webgui\Exceptions\ConfigException;
// Functions for mktorrent-webgui



function config( string $name){
	Global $Config;
	list( $section, $name) = explode( ':', $name);
	if( !isset($Config[$section][$name])){
		if( !isset($Config[$section])){
			Throw New ConfigException ('Missing Config Section "' . $section . '"');
		}else{
			Throw New ConfigException ('Missing Config Item "' . $name . '"');
		}
	}
	
	return $Config[$section][$name];
}


function exceptionCatchAll_log( $e ){
	$elog = new Lib\Logger('exceptions');
	$msg = 'Uncaught "' . get_class($e) . '" Exception: ' . $e->getMessage() . PHP_EOL;
	$msg .= 'File: ' . $e->getFile() . ' [' . $e->getLine() . ']' . PHP_EOL;
	$msg .= $e->getTraceAsString() . PHP_EOL;
	$msg .= '-----------------------------' . PHP_EOL;
	$elog->add($msg);
	
}
function exceptionCatchAll_display($e){
	echo '<p style="font-family: Arial;font-size: 16px;color: #F00;white-space: pre;background-color: #333;padding: 30px 60px;border-radius: 20px;">';
	echo '<b><small> "' . get_class($e) . '" Exception Not Caught</small></b>:<br><br><span style="color: #00BEEF;font-size: 22px;">' . $e->getMessage() . '</span><br><br><small style="color: #BEEF00;"><b>' . $e->getFile() . '</b> [' . $e->getLine() . ']</small>' . PHP_EOL . PHP_EOL;
	echo '<br><span style="color: #EEE;">' . $e->getTraceAsString() . '</span>';
	echo '</p>';
	
	exceptionCatchAll_log( $e );
}

