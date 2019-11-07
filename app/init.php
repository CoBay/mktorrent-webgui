<?php

namespace CoBay\mktorrent_webgui;


// Filesystem Layout
define( 'DS', DIRECTORY_SEPARATOR);
define( 'APP_ROOT', __DIR__ . DS);
define( 'LIB', APP_ROOT . 'Lib' .  DS);
define( 'CONFIGS', APP_ROOT . 'Configs' .  DS);
define( 'LOGS', APP_ROOT . 'Logs' .  DS);
define( 'TEMP', APP_ROOT . 'Temp' .  DS);
define( 'APP_DATA', APP_ROOT . 'APP_DATA' .  DS);
define( 'VIEWS', APP_ROOT . 'Views' .  DS);
define( 'Misc', APP_ROOT . 'Misc' . DS);


// Load Configs
require CONFIGS . 'app.php';
require CONFIGS . 'user.php';

// Autoloader
require LIB . 'Autoloader.php';
use CoBay\mktorrent_webgui\Lib\Autoloader;

Autoloader::Init();


// Logger
$log = new Lib\Logger('general',false);
$log->empty();


// Function Inclusion
require MISC . 'Functions.php';


// Uncaught Exception Handling
set_exception_handler('\CoBay\mktorrent_webgui\exceptionCatchAll_display');

