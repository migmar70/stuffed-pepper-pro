<?php
if ( !defined('ABSPATH') ) { die('-1'); }

class SP_AdminMenuModule extends SP_Module  {

	public function __construct( $sp ) {
		parent::__construct( $sp, __FILE__, 'adminmenu' );

		$this->page_title = 'Stuffer Pepper';
		$this->menu_label = 'Stuffer Pepper';
		$this->menu_slug = 'stuffed-pepper';
	}

	public function admin_menu() {
		
		add_menu_page( $this->page_title, $this->menu_label, 'administrator', $this->menu_slug, array( $this, 'admin_page'), 'dashicons-smiley', 3.959599 );
		
		add_submenu_page( $this->menu_slug, $this->page_title, 'Dashboard', 'administrator', $this->menu_slug, array( $this, 'admin_page' ));

		foreach ( $this->sp->modules as $key => $module ){
			if( $key == 'adminmenu' )
				continue;
			$module->admin_menu();
			$module->add_submenu_page( $this );
		}
	}

	public function admin_page() { 
		$this->view( 'dashboard' );
	}

}

