<?php

namespace CoBay\mktorrent_webgui;

const DS = DIRECTORY_SEPARATOR;
const ROOT = __DIR__ . DS;
const LIB = ROOT . 'Lib' . DS;
const CONFIGS = ROOT . 'configs' . DS;
const LOGS = ROOT . 'logs' . DS;



require LIB . 'Autoloader.php';

use CoBay\mktorrent_webgui\Lib\Autoloader;

Autoloader::Init();



$log = new Lib\Logger('general',false);
$log->empty();



