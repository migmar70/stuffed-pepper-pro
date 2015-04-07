<?php
if( !defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

class SP_Result {

	public $success = true;
	public $errors = array();
	public $data = null;

	public function __construct(){
	}

	public static function create(){
		return new SP_Result();
	}

	public function success(){
		$this->success = true;
		return $this;
	}

	public function fail(){
		$this->success = false;
		return $this;
	}

	public function with_data( $data ){
		$this->data = $data;
		return $this;
	}

	public function add_error( $string ){
		$this->errors[] = $string;
		return $this;
	}

	public function send( $data = null ){
		die( json_encode( $this ) );
	}
}
