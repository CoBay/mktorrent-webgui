<?php

namespace CoBay\mktorrent_webgui\Lib;


class MkTorrentCommand {
	
	protected		$_trackers = [];
	protected		$_web_seeds = [];
	protected		$_piece_size = 18;
	protected		$_threads = 1;
	protected		$_private = true;
	protected		$_no_date = true;
	protected		$_comment;
	protected		$_output;
	protected		$_name;
	protected		$_target;
	
	public			$str;

	/*	Magic Methods
	*/
	public function __construct(){
		
	}
	public function __toString(){
		if( is_null( $this->str ) ){
			$this->_gen_command();
		}
		return $this->str;
	}

	/*	Protected Methods
	*/
	protected function _check_required(){
		$passed = true;
		$required = '';
		$SE = ', ';
		
		if( count( $this->_trackers) <= 0){
			$passed = false;
			$required .= 'Tracker/Announce URL' . $SE;
		}
		
		if($this->_piece_size > 24 || $this->_piece_size < 15){
			$passed = false;
			$required .= 'Proper Piece Size' . $SE;
			
		}
		
		if( $this->_threads < 1){
			$passed = false;
			$required .= 'Proper Thread Use Number' . $SE;
		}
		
		
		// Throw an InputRequirement Exception if any of the checks failed.
		if( $passed !== true){
			Throw New \CoBay\mktorrent_webgui\Exceptions\InputRequirement('Not all Required Information [' . rtrim($required, $SE) . '] was provided.');
		}
	}
	protected function _command_segment( string $prop, $values):string {
		$r = ' -' . $prop . ' ';
		if( is_int( $values ) ){
			$r .= $values;
		}else if( is_string( $values) ){
			$r .= '"' . $values . '"';
		}else{
			$r .= '"' . implode( '" -' . $prop . ' "', $values) . '"';
		}
		return $r;
	}
	protected function _gen_command(){
		$this->_check_required();
		$str = 'mktorrent ';
		
		// Include Date
		if( $this->_no_date ){
			$str .= ' -d';
		}
		
		// Private
		if( $this->_private ){
			$str .= ' -p';
		}
		
		// Threads
		$str .= $this->_command_segment('t', $this->_threads);
		
		// Piece Size
		$str .= $this->_command_segment('l', $this->_piece_size);
		
		// Trackers / Announce URLs
		$str .= $this->_command_segment( 'a', $this->_trackers);
		
		// Name
		if( !is_null( $this->_name) ){
			$str .= $this->_command_segment( 'n', $this->_name);
		}
		
		// Output
		if( !is_null( $this->_output) ){
			$str .= $this->_command_segment( 'o', $this->_output);
		}
		
		// Web Seeds
		if( count( $this->_web_seeds) > 0){
			$str .= $this->_command_segment( 'w', $this->_web_seeds);
		}
		
		// Comment
		if( !is_null( $this->_comment) ){
			$str .= $this->_command_segment( 'c', addcslashes($this->_comment, '"') );
		}
		
		// Add Target
		$str .= ' "' . $this->_target . '"';
		
		// Save the resulting string
		$this->str = $str;
	}
	protected function _format_input( string $input):string {
		return preg_replace('/[^a-z0-9\.\/\:_\-]+/i', '', $input);
	}
	/*	Public Methods
	*/
	public function addTracker( string $trackerPath){
		$this->_trackers[] = $this->_format_input( $trackerPath);
	}
	public function addWebSeed( string $webSeedPath){
		$this->_web_seeds[] = $this->_format_input( $webSeedPath );
	}
	public function comment( string $comment){
		$this->_comment = $comment;
	}
	public function isPrivate( bool $state = true){
		$this->_private = $state;
	}
	public function name( string $name){
		$this->_name = $name;
	}
	public function noDate( bool $state = true){
		$this->_no_date = $state;
	}
	public function output( string $outputPath){
		$this->_output = trim($outputPath);
	}
	public function pieceSize( int $size){
		$this->_piece_size = $size;
	}
	public function target( string $target ){
		$this->_target = $target;
	}
	public function threads( int $num){
		$this->_threads = $num;
	}
	
}