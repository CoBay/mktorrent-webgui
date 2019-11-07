<?php

namespace CoBay\mktorrent_webgui;

require '../init.php';

// echo '<pre>';
// var_dump( config('user:base_directory') );

$init_fs = config('user:base_directory');

$panels_content = '';
foreach( config('app:panel_list') as $panel){
	include VIEWS . 'panel-' . $panel . '.php';
	$panels_content .= $content;
	unset($content);
}

echo <<<EOS
<!DOCTYPE html>
<html lang="en-us">
	<head>
		<title>mktorrent-webgui</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		<meta name="robots" content="noindex,nofollow">
		<meta name="application-name" content="mktorrent-webgui">
		<meta name="copyright" content="2019
		<meta name="author" content="CoBay">
		<meta name="author:url" content="https://github.com/CoBay/mktorrent-webgui/">
		
		<link rel="Stylesheet" href="css/styles.css">
	</head>
	<body>
	
		<div id="ContentBox">
			<h3 class="panel-title">mktorrent-webgui</h3>
			<div class="panel-content target-panel">
{$panels_content}				
			</div>
		</div>

	<script type="text/javascript" src="js/main.js"></script>
	</body>
</html>
EOS;
