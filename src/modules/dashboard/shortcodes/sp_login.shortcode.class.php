<?php
if ( !defined('ABSPATH') ) { die('-1'); }

class SP_LoginShortcode extends SP_Shortcode {

	public function __construct( $sp ) {
		parent::__construct( $sp );

		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );

		add_shortcode( 'sp_login', array( $this, 'shortcode' ), 20 );
	}

	public function wp_enqueue_scripts(){
		wp_enqueue_style( 'sp_login', plugins_url( 'sp_login.form.css', __FILE__ ), null, '0.0.0.3' );
	}

	public function shortcode( $atts = array(), $content = '' ) {

		$html = array();

		$html[] = '<div id="login" class="login">';
		$html[] = '<form method="post" action="http://stuffed-pepper.local/wp-login.php" id="loginform" name="loginform">';
		$html[] = '<p>';
		$html[] = '		<label for="user_login">Username<br>';
		$html[] = '		<input type="text" size="20" value="" class="input" id="user_login" name="log"></label>';
		$html[] = '</p>';
		$html[] = '<p>';
		$html[] = '		<label for="user_pass">Password<br>';
		$html[] = '		<input type="password" size="20" value="" class="input" id="user_pass" name="pwd"></label>';
		$html[] = '</p>';
		$html[] = '<p class="forgetmenot">';
		$html[] = ' 	<label for="rememberme"><input type="checkbox" value="forever" id="rememberme" name="rememberme"> Remember Me</label>';
		$html[] = '</p>';
		$html[] = '	<p class="submit">';
		$html[] = '		<input type="submit" value="Log In" class="button button-primary button-large" id="wp-submit" name="wp-submit">';
		$html[] = '		<a class="register" href="/register/">Register</a> | <a class="lostpassword" href="/lostpassword/">Lost your password?</a>';
		$html[] = '		<input type="hidden" value="/" name="redirect_to">';
		$html[] = '		<input type="hidden" value="1" name="testcookie">';
		$html[] = '	</p>';
		$html[] = '</form>';
		$html[] = '</div>';

		return implode( '', $html );
	}

}
