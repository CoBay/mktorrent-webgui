<?php

namespace CoBay\mktorrent_webgui;

require '../init.php';



// $t = new Lib\MkTorrentCommand();
// $t->addTracker('https://announce.raspi.pw');
// $t->name('Tester');
// $t->output( '/var/ww2/tester.torrent' );
// $t->target( '/var/ww2/--Library--/');
// $t->threads( 4 );
// $t->pieceSize( 15 );
// $t->isPrivate( true );
// $t->noDate( false );
// $t->comment( 'This is only a test' );
// echo $t;


// $d = new Lib\Directory('../');

// echo '<pre>';

// $size = $d->size();

// echo $size . ' bytes' . '<br>' . PHP_EOL;
// echo ($size / 1024) . 'kb' . '<br>' . PHP_EOL;


Throw New \CoBay\mktorrent_webgui\Exceptions\DataCreation('Can\'t create data, as I am useless');