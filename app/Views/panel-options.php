<?php

namespace CoBay\mktorrent_webgui;


// Pieces Selector HTML
$pieces_default = config('user:pieces_size_default');
$pieces_options = '';
foreach( config('app:piece_sizes') as $num=>$label){
	$default = ($num == $pieces_default)? ' selected="selected"' : '';
	$pieces_options .= "\t\t\t\t\t\t\t" . '<option value="' . $num . '"' . $default . '>' . $label . '</option>' . PHP_EOL;	
}


// Thread Selector HTML
$num_cpus = config('user:cpus_available');
$cpus_default = config('user:cpus_used');
$cpu_options = '';
for($i=1; $i<= $num_cpus; $i++){
	$default = ($i === $cpus_default)? ' selected="selected"' : '';
	$cpu_options .= "\t\t\t\t\t\t\t" . '<option value="' . $i . '"' . $default . '>' . $i . '</option>' . PHP_EOL;
}


$content = <<<EOS
				<div class="panel" id="panel-fs">
					<h4>Options</h4>
					<p id="target-options" class="sub-panel">
						<h4>Comment</h4>
						<textarea name="comment"></textarea>
						<h4>Torrent Piece Size</h4>
						<select name="piece_size">
{$pieces_options}
						</select>
						<h4>Number of Threads</h4>
						<select name="number_threads">
{$cpu_options}
						</select>
						<h4>Private</h4>
						<input type="checkbox" name="private" id="cb-private"><label for="cb-private">Private Torrent/Tracker</label>
					</p>
				</div>

EOS;

