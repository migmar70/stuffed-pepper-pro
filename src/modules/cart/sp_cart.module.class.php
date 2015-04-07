<?php
if ( !defined('ABSPATH') ) { die('-1'); }

class SP_CartModule extends SP_Module  {

	public function __construct( $sp ) {
		parent::__construct( $sp, __FILE__, 'cart' );
	}

	public function init() {
	}	

	public function add_submenu_page( $adminmenu ){
		
		$this->page_title = $adminmenu->page_title.' - Cart Module';
		$this->menu_label = 'Cart Module';
		$this->menu_slug = $adminmenu->menu_slug.'-cart';

		add_submenu_page( $adminmenu->menu_slug, $this->page_title, $this->menu_label, 'administrator', $this->menu_slug, array( $this, 'admin_page' ));
	}

	public function admin_page() { 
		$this->view( 'cart' );
	}
}

