<?php
if( !defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

abstract class SP_Shortcode {

	protected $sp;

	public function __construct( $sp ){
		$this->sp = $sp;
	}

	public function shortcode($atts = array(), $content = ''){
	}
}
