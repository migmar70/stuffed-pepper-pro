<?php
/*
 * Plugin Name: Stuffed Pepper Pro
 * Plugin URI: http://www.stuffed-pepper.com
 * Description: Stuffed Pepper Pro Plugin.
 * Version: 0.0.0.1
 * Author: Miguel Martinez
 * Author URI: http://miguelmartinez.com/
 */

if( !defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

if ( ! defined( 'WP_CONTENT_DIR' ) ) { define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' ); }
if ( ! defined( 'WP_CONTENT_URL' ) ) { define( 'WP_CONTENT_URL', site_url( 'wp-content') ); }

define('SP_VERSION', "0.0.0.1");
define('SP_PLUGIN_FILE', __FILE__);
define("SP_PLUGIN_DIR", plugin_dir_path(__FILE__));
define("SP_PLUGIN_SRC", SP_PLUGIN_DIR . 'src/');
define("SP_PLUGIN_LIB", SP_PLUGIN_SRC . 'lib/');
define("SP_PLUGIN_URL", plugins_url('stuffed-pepper-pro/') );
define("SP_PLUGIN_URL_SRC", plugins_url('stuffed-pepper-pro/src/') );

require_once( dirname(__FILE__) . '/src/lib/sp_result.class.php' );
require_once( dirname(__FILE__) . '/src/lib/sp_helper.class.php' );
require_once( dirname(__FILE__) . '/src/sp.class.php' );

SP::instance()->start();

register_activation_hook( dirname(__FILE__) .'/src/sp.class.php' , array( 'SP', 'activation_hook' ) );
register_deactivation_hook( dirname(__FILE__) .'/src/sp.class.php', array( 'SP', 'deactivation_hook' ) );

