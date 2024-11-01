<?php

/*
|--------------------------------------------------------------------------
| Plugin options
|--------------------------------------------------------------------------
|
| Here is where you can insert the options model of your plugin.
| These options model will store in WordPress options table
| (usually wp_options).
| You'll may get this option by using $plugin->options property
|
*/

return [

  'scheduling' => [
    'enable'      => false,
    'date_start'  => '',
    'date_expire' => '',
  ],

  'template' => [
    'template'   => 'wp_die',
    'page_title' => get_bloginfo( 'name' ),
    'title'      => __( 'Maintenance Mode', WPXMAINTENANCEPRO_TEXTDOMAIN ),
    'note'       => __( 'This website is currently in maintenance mode.', WPXMAINTENANCEPRO_TEXTDOMAIN ),
  ],

  'rules' => [
    'disable_wp_login' => false,
    'ip_address'       => ( isset( $_SERVER[ 'REMOTE_ADDR' ] ) ) ? [ $_SERVER[ 'REMOTE_ADDR' ] ] : [ '127.0.0.1' ],
    'user_roles'       => [ ],
    'users_id'         => [ ],
  ],

  'messages' => [
    'enable_send_mail'      => false,
    'enable_message_login'  => true,
    'enable_message_admin'  => true,
    'enable_message_footer' => true,
    'email'                 => '',
    'message_login'         => __( 'Maintenance mode is enabled.', WPXMAINTENANCEPRO_TEXTDOMAIN ),
    'message_admin'         => __( 'Maintenance mode is enabled.', WPXMAINTENANCEPRO_TEXTDOMAIN ),
    'message_footer'        => __( 'Maintenance mode is enabled.', WPXMAINTENANCEPRO_TEXTDOMAIN ),
  ]

];