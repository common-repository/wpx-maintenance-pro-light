<?php

/**
 * Plugin Name: WPX Maintenance Pro Light
 * Plugin URI: http://undolog.com
 * Description: Maintenance Pro is the best way to let visitors know your website is down for maintenance
 * Version: 2.3.0
 * Author: Giovambattista Fazioli
 * Author URI: http://undolog.com
 * Text Domain: wpx-maintenance-pro
 * Domain Path: localization
 *
 */

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels nice to relax.
|
*/
use WPXMaintenanceProLight\WPBones\Foundation\Plugin;

require_once __DIR__ . '/bootstrap/autoload.php';

/*
|--------------------------------------------------------------------------
| Bootstrap the plugin
|--------------------------------------------------------------------------
|
| We need to bootstrap the plugin.
|
*/

// comodity define for text domain
define('WPXMAINTENANCEPRO_TEXTDOMAIN', 'wpx-maintenance-pro');

$GLOBALS[ 'WPXMaintenanceProLight' ] = require_once __DIR__ . '/bootstrap/plugin.php';

if (! function_exists('WPXMaintenanceProLight')) {

  /**
   * Return the instance of plugin.
   *
   * @return Plugin
   */
    function WPXMaintenanceProLight()
    {
        return $GLOBALS[ 'WPXMaintenanceProLight' ];
    }
}
