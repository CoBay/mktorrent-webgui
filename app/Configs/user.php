<?php

namespace CoBay\mktorrent_webgui;

/* 
	These settings are better changed in the Settings area of the app.
*/

if( !isset($Config)){
	$Config = [];
}


$Config['user'] = [

	'check_for_updates' => true,
	'auto_update' => false,
	'download_updates' => true,
	
	'base_directory' => '/mnt/scratch/Dump/',
	
	'cpus_available' => 4,
	'cpus_used' => 2,
	
	'pieces_size_default' => '19',

];