<?php
if ( !defined('ABSPATH') ) { die('-1'); }

require_once( dirname(__FILE__) . '/shortcodes/sp_login.shortcode.class.php' );

class SP_DashboardModule extends SP_Module  {

	public function __construct( $sp ) {
		parent::__construct( $sp, __FILE__, 'dashboard' );

		$this->page_title = 'Dashboard';
		$this->menu_label = 'Dashboard';
		$this->menu_slug = 'stuffed-pepper-dashboard';

		$this->shortcodes = array( 'login' => new SP_LoginShortcode( $sp ) );

	}

	public function init() {

		$this->_page = empty( $_GET['page'] ) ? '' : $_GET['page'];
		$this->_action = empty( $_GET['action'] ) ? '' : $_GET['action'];
		$this->_post_id = empty( $_GET['post'] ) ? '0' : absint( $_GET['post'] );

	}	

	public function shortcode($atts = array(), $content = '' ) {
		
		if( ! is_user_logged_in() ){
			include( sprintf( '%s/views/%s.view.php', $this->module_dir, 'login_or_register' ) );
			return $view;
		}
		
		return '<p>shortcode</p>';		
	}

	public function get_login_view(){
		$this->view( 'login_or_register' );
	}

}

