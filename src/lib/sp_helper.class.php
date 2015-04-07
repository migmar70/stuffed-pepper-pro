<?php
class SP_Helper {

	/**
	 * 
	 */
	public function get_request_url(){

		$protocol = 'http';

		if ( isset( $_SERVER["HTTPS"] ) && strtolower( $_SERVER["HTTPS"] ) == "on" )
			$protocol .= "s";

		return $protocol.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	}

	/**
	 * 
	 */
	public static function get_post_value( $key, $default_value = '' ) {
		return isset( $_POST[ $key ] ) ? trim( $_POST[ $key ] ) : $default_value;
	}

	/**
	 * 
	 */
	public static function get_post_value_sql( $key, $default_value = '' ) {
		return isset( $_POST[ $key ] ) ? trim( esc_sql( $_POST[ $key ] ) ) : $default_value;
	}

	/**
	 * 
	 */
	public static function get_post_int( $key, $default_value = 0 ) {
		return isset( $_POST[ $key ] ) ? absint( $_POST[ $key ] ) : $default_value;
	}

	/**
	 * 
	 */
	public static function get_post_int_sql( $key, $default_value = 0 ) {
		return isset( $_POST[ $key ] ) ? absint( esc_sql( $_POST[ $key ] ) ) : $default_value;
	}
	
	/**
	 * 
	 */
	public static function error_message( $field, $message ){
		return (object)array( 'field' => $field, 'message' => __( $message, 'stuffed-pepper' ) );
	}
	
	/**
	 * 
	 */
	public static function add_error_message( $field, $message, $errors = null ){
		if( $errors == null )
			$errors = array();
		$errors[] = SP_Helper::error_message( $field, $message );
		return $errors;
	}

	/**
	 * 
	 */
	public static function ajax_result( $result ){
		die( json_encode( array( 
			'success' => $result->success, 
			'errors' => $result->errors,
			'data' => $result->data
		) ) );
	}

	public static function ajax_result_create( $success = true, $errors = array()  ){
		die( json_encode( array( 
			'success' => $success, 
			'errors' => $errors,
			'data' => null
		) ) );
	}

	public static function add_http( $url ) {
		if( ! empty( $url ) )
		    if ( ! preg_match( "~^(?:f|ht)tps?://~i", $url ) )
		        $url = "http://" . $url;
	    return $url;
	}	

}
