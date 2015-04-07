<?php
if ( !defined('ABSPATH') ) { die('-1'); }

require_once( dirname(__FILE__) . '/models/sp_user.model.class.php' );

class SP_UserModule extends SP_Module  {

	var $user;

	public function __construct( $sp ) {
		parent::__construct( $sp, __FILE__, 'user' );
	}

	public function init() {

		$this->user = new SP_User();

		$this->register_post_types();

		add_shortcode( $this->post_type, array( &$this, 'shortcode' ), 20 );
	}	

	public function register_post_types(){

		// This should be part of the theme, but the we register it just in case.
		//
		add_theme_support( 'post-thumbnails' ); 

		$post_type_args = array(
			'description' => __( 'Stuffed Pepper User Picture - replaces avatar.', 'stuffed-pepper' ),
			'public' => false,
			'can_export' => false,
			'delete_with_user' => false,
			'supports' => array( 'thumbnail' )
		);

		register_post_type( 'userphoto', $post_type_args );

		flush_rewrite_rules();
	}

	public function add_submenu_page( $adminmenu ){
		
		$this->page_title = $adminmenu->page_title.' - Users';
		$this->menu_label = 'Users';
		$this->menu_slug = $adminmenu->menu_slug.'-user';

		add_submenu_page( $adminmenu->menu_slug, $this->page_title, $this->menu_label, 'administrator', $this->menu_slug, array( $this, 'admin_page' ));
	}

	public function admin_page() { 
		$this->view( 'user_module' );
	}

	public function shortcode( $atts = array(), $content = '' ) {

		global $post;
		global $wpdb;

		//$this->view( 'user_shortcode' );
		//return '<div>SP_UserModule</div>';

		$output = array();

		$output[] = '<div class="sp_user_shortcode">';
		$output[] = '<ul class="sp_user_properties">';
		$output[] = sprintf( '<li><label>logged_in</label> %s</li>', $this->user->logged_in );
		$output[] = sprintf( '<li><label>is_visitor</label> %s</li>', $this->user->is_visitor );
		$output[] = sprintf( '<li><label>is_admin</label> %s</li>', $this->user->is_admin );
		$output[] = sprintf( '<li><label>COOKIEHASH</label> %s</li>', COOKIEHASH );

		$output[] = '<ul>';
		$output[] = '</div>';

		return implode( '', $output );
	}

}

