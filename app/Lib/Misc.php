<?php


Namespace CoBay\mktorrent_webgui\Lib;


class Misc {



	public static function NumCpus():int {
		if( !($num = shell_exec('/bin/grep -c ^processor /proc/cpuinfo')) && !($num = shell_exec('/usr/bin/nproc'))){
			$num = 1;
		}
		$num = (int) $num;
		
		if( $num <= 0){
			$num = 1;
		}
		
		return $num;
	}


}