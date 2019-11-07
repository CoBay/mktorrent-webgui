<?php


namespace CoBay\mktorrent_webgui\Exceptions;


class CustomBaseException extends \Exception {
	const TAB = "\t";
	const TABS = "\t\t";
	const TABS3 = "\t\t\t";
	
	public function logMsg():string{
		return  get_class($this) . ' Exception Caught: ' . PHP_EOL .
				self::TAB . $this->getMessage() . PHP_EOL .
				self::TAB . $this->getFile() . ' [' . $this->getLine() .' ]' . PHP_EOL .
				$this->traceAsString() . PHP_EOL;
	}
	public function displayMsg():string{
		$return = PHP_EOL .  get_class($this) . ' Exception Caught:' . PHP_EOL . '<br /><br />' . PHP_EOL .
			self::TABS3 . '<h3>' . $this->getMessage() . '</h3>' . PHP_EOL .
			self::TABS3 . '<br /><br />' . PHP_EOL .
			self::TABS3 . 'Thrown at:<br />' . PHP_EOL .
			self::TABS3 . 'File: <i>' . $this->getFile() . '</i><br />' . PHP_EOL .
			self::TABS3 . 'Line: <b>' . $this->getLine() . '</b><br />' . PHP_EOL;
		$return .= '<hr>';
		
		$return .= PHP_EOL . '<pre>' . $this->traceAsString() . '<pre>' . PHP_EOL;
		return $return;		
	}
}