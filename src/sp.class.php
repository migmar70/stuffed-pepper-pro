<?php
if( !defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

require_once( dirname(__FILE__) . '/lib/sp_model.class.php' );
require_once( dirname(__FILE__) . '/lib/sp_module.class.php' );
require_once( dirname(__FILE__) . '/lib/sp_shortcode.class.php' );
require_once( dirname(__FILE__) . '/modules/user/sp_user.module.class.php' );
require_once( dirname(__FILE__) . '/modules/cart/sp_cart.module.class.php' );
require_once( dirname(__FILE__) . '/modules/coupon/sp_coupon.module.class.php' );
require_once( dirname(__FILE__) . '/modules/paypal/sp_paypal.module.class.php' );
require_once( dirname(__FILE__) . '/modules/mailchimp/sp_mailchimp.module.class.php' );
require_once( dirname(__FILE__) . '/modules/product/sp_product.module.class.php' );
require_once( dirname(__FILE__) . '/modules/recipe/sp_recipe.module.class.php' );
require_once( dirname(__FILE__) . '/modules/adminmenu/sp_adminmenu.module.class.php' );
require_once( dirname(__FILE__) . '/modules/dashboard/sp_dashboard.module.class.php' );

require_once( dirname(__FILE__) . '/widgets/sp_bidsketch.widget.class.php' );

class SP {

	private static $_instance;

	public static function instance() {
		if ( ! isset( self::$_instance ) )
			self::$_instance = new self;
		return self::$_instance;
	}

	public static function activation_hook(){
	}

	public static function deactivation_hook(){
	}

	protected function __construct( ) {
	}

	public function start(){
		add_action('plugins_loaded', array( $this, 'plugins_loaded' ) );
	}

	public function plugins_loaded(){

		add_action( 'widgets_init', array( $this, 'widgets_init' ) );

		$this->modules = array( 
			'user' => new SP_UserModule( $this ),
			'cart' => new SP_CartModule( $this ),
			'coupon' => new SP_CouponModule( $this ),
			'paypal' => new SP_PaypalModule( $this ),
			'mailchimp' => new SP_MailchimpModule( $this ),
			'product' => new SP_ProductModule( $this ),
			'recipe' => new SP_RecipeModule( $this ),
			'adminmenu' => new SP_AdminMenuModule( $this ),
			'dashboard' => new SP_DashboardModule( $this ),
		);

		add_action( 'init', array( $this, 'init' ) );
	}

	public function init(){

		foreach ($this->modules as $module)
			$module->init();

		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'admin_init', array( $this, 'admin_init' ) );
	}

	public function admin_menu(){
		$this->modules['adminmenu']->admin_menu();
	}

	public function admin_init(){

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

		foreach ($this->modules as $module)
			$module->admin_init();
	}

	public function admin_enqueue_scripts(){

		wp_enqueue_script( 'angular', SP_PLUGIN_URL_SRC.'js/angular/1.3.0/angular.min.js', null, '1.3.0', true );
		wp_enqueue_script( 'stuffed-pepper', SP_PLUGIN_URL_SRC.'js/sp.js', array('jquery', 'jquery-ui-sortable'), '2.0.0.1', true );

		wp_enqueue_style( 'stuffed-pepper', SP_PLUGIN_URL_SRC.'css/sp.css' );

		foreach ($this->modules as $module)
			$module->admin_enqueue_scripts();
	}

	public function widgets_init(){

		register_widget( 'SP_Widget_Text_Bidsketch' );

	} // end-function widget_init
}
