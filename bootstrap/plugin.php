<?php

/*
|--------------------------------------------------------------------------
| Create The Plugin
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Bones plugin instance
| which serves as the "glue" for all the components.
|
*/

$plugin = new \WPXMaintenanceProLight\WPBones\Foundation\Plugin(
  realpath( __DIR__ . '/../' )
);

/*
|--------------------------------------------------------------------------
| Actions and filters
|--------------------------------------------------------------------------
|
| Feel free to insert your actions and filters.
|
*/

/*
|--------------------------------------------------------------------------
| Return The Plugin
|--------------------------------------------------------------------------
|
| This script returns the plugin instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

/**
 * Fire when the plugin is loaded
 */
do_action( 'wpx-maintenance-pro-light_loaded' );

return $plugin;