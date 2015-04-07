<?php
if( !defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

abstract class SP_Module {

	protected $sp;
	protected $module_name;
	protected $module_dir;
	protected $module_url;
	protected $post_type;

	public function __construct( $sp, $filespec, $module_name, $post_type = null ){
		$this->sp = $sp;
		$this->module_name = $module_name;
		$this->module_dir = dirname( $filespec );
		$this->module_url = SP_PLUGIN_URL_SRC . "modules/$module_name/";
		$this->post_type = empty( $post_type ) ==  false ? $post_type : "sp_$module_name";
	}

	public function init(){
	}

	public function register_post_types(){
	}
	
	public function admin_menu(){
	}

	public function add_submenu_page( $adminmenu ){
	}

	public function admin_init(){
	}

	public function admin_enqueue_scripts(){
	}

	protected function view( $view, $model = array() ){ ?>
		<div class="wrap"><?php
			include( sprintf( '%s/views/%s.view.php', $this->module_dir, $view ) ); ?>
		</div><?php
	}

}
