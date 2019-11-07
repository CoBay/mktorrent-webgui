<?php

namespace CoBay\mktorrent_webgui;

/* 
	These settings really shouldn't need to be changed.
*/

if( !isset($Config)){
	$Config = [];
}


$Config['app'] = [

	'version_url' => 'https://raw.githubusercontent.com/CoBay/mktorrent-webgui/master/releases/current_version.txt',
	'current_version' => '0.0.1',
	'panel_list' => ['filesystem', 'trackers', 'web-seeds', 'options'],
	'piece_sizes' => ['auto' => 'Auto', '15'=> '32 KiB', '16'=> '64 KiB', '17'=> '128 KiB', '18'=> '256 KiB', '19'=> '512 KiB', '20' => '1 MiB', '21' => '2 MiB', '22' => '4 MiB', '23' => '8 MiB', '24' => '16 MiB'],
];