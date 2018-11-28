<?php
/*
Plugin Name: Modpinn
Plugin URI: https://pressfinesse.com/
Description: Pulling images and stuff from other sites.
Author: Kelvin Craig
Author URI: https://pressfinesse.com/
Text Domain: modpinn
Version: 1.0
*/
if ( ! defined( 'ABSPATH' ) ) {	exit; }

define( 'MODPINN_REQUIRED_WP_VERSION', '4.8' );
define( 'MODPINN_PLUGIN', __FILE__ );
define( 'MODPINN_VERSION', '1.0' );
define( 'MODPINN_PLUGIN_BASENAME', plugin_basename( MODPINN_PLUGIN ) );
define( 'MODPINN_PLUGIN_NAME', trim( dirname( MODPINN_PLUGIN_BASENAME ), '/' ) );
define( 'MODPINN_PLUGIN_DIR', untrailingslashit( dirname( MODPINN_PLUGIN ) ) );

include_once(dirname(__FILE__).'/init.php');
