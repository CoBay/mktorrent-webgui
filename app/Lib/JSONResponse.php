<?php


namespace CoBay\mktorrent_webgui\Lib;

class JSONResponse {
	
	protected	$_errno = 0;
	protected	$_errmsg;
	protected	$_data = [];
	
	
	
	/*	Protected Methods
	*/
	protected function _utf_string_check($i){
		if( !function_exists( 'mb_convert_encoding' )){ // Needed to convert non-utf8 strings
			return $i;
		}
		if( is_array($i) ){
			foreach( $i as $k=>$v){
				$i[$k] = $this->_utf_string_check($v);
			}
		}else if( is_string($i)){
			if( !preg_match('//u', $i) ){ // Check if UTF-8 String
			
				return mb_convert_encoding($i, 'UTF-8', 'UTF-8');
				
			}
		}
		return $i;
	}
	
	/*	Public Methods
	*/
	public function add( /* mixed */ $data, string $name = NULL){
		$data = $this->_utf_string_check( $data );
		
		if( is_null( $name ) ){
			$this->_data[] = $data;
		}else{
			$this->_data[$this->_utf_string_check( trim($name) )] = $data;
		}
	}
	public function error( int $errno = 403){
		$this->_errno = $errno;
		$this->_data = [];
	}
	public function get():string{
		$parts = [
			'errno' => $this->_errno,
			'errmsg' => self::ErrMsg($this->_errno),
			'data' => $this->_data,
		];
		
		if(version_compare(PHP_VERSION, '5.3.0', '>=') === true){
			$return = json_encode( $bits, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_FORCE_OBJECT );
		}else{
			$return = json_encode( $bits );
		}
		json_encode(
		if( !$return){
			Throw New \CoBay\mktorrent_webgui\Exceptions\DataCreation('JSON Creation Error: ' . self::JSON_ERR_MSG());
			
		}
		return $return;
	}
	public function output(){
		if( headers_sent()){
			Throw New \CoBay\mktorrent_webgui\Exceptions\Output('Headers Sent, cannot output JSON');
		}
		
		$content = $this->get();
		
		header('Content-Type: application/json; charset=utf-8');
		header('Content-Length: ' . strlen($content) );
		header('Cache-Control: max-age=0');
		header('X-Custom: JSONResponse');
		echo $content;
		exit;
	}
	
	// Common Errors
	public function forbidden(){
		$this->error( 403 );
	}
	public function notFound(){
		$this->error(404);
	}
	public function unauthorized(){
		$this->error(401);
	}
	public function internalError(){
		$this->error(500);
	}
	public function serviceNotAvailable(){
		$this->error(503);
	}
	public function badRequest(){
		$this->error(400);
	}
	public function invalid(){
		$this->badRequest();
	}
	
	/*	Public Static Methods
	*/
	public static ErrMsg( int $errno = 999):string {
		$msg = [
			0   => '',
			303 => 'Other',
			400 => 'Bad Request',
			401 => 'Unauthorized',
			403 => 'Forbidden',
			404 => 'Not Found',
			406 => 'Not Acceptable',
			409 => 'Conflict',
			500 => 'Internal Server Error',
			501 => 'Not Implemented',
			503 => 'Service Unavailable',
			504 => 'Timeout',
			999 => 'Unknown',
		];
		if( !isset($msg[$errno])){
			$errno = 999;
		}
		return $msg[$errno];
	}
	public static JSON_ERR_MSG():string {
		$id = json_last_error();
		$msgs = [
			JSON_ERROR_NONE  => "No error has occurred",
			JSON_ERROR_DEPTH  => "The maximum stack depth has been exceeded",
			JSON_ERROR_STATE_MISMATCH  => "Invalid or malformed JSON",
			JSON_ERROR_CTRL_CHAR  => "Control character error, possibly incorrectly encoded",
			JSON_ERROR_SYNTAX  => "Syntax error",
			JSON_ERROR_UTF8  => "Malformed UTF-8 characters, possibly incorrectly encoded",
			JSON_ERROR_RECURSION  => "One or more recursive references in the value to be encoded",
			JSON_ERROR_INF_OR_NAN  => "One or more NAN or INF values in the value to be encoded",
			JSON_ERROR_UNSUPPORTED_TYPE  => "A value of a type that cannot be encoded was given"
		];
		$newConstants = [
			'JSON_ERROR_INVALID_PROPERTY_NAME'  => "A property name that cannot be encoded was given",
			'JSON_ERROR_UTF16'  => "Malformed UTF-16 characters, possibly incorrectly encoded"
		];
		
		foreach($newConstants as $constant=>$msg){
			if( defined($constant)){
				$msgs[constant($constant)] = $msg;
			}
		}
			

		return ((isset($msgs[$id]))? $msgs[$id] : 'Unknown');
	}
}