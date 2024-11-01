<?php

/*
|--------------------------------------------------------------------------
| Plugin Menus routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the menu routes for a plugin.
| In this context the route are the menu link.
|
*/

return [
  'wpx_maintenance_pro_light_slug_menu' => [
    "menu_title" => "Maintenance Pro",
    'capability' => 'manage_options',
    'icon'       => 'dashicons-controls-pause',
    'items'      => [
      [
        "menu_title" => "Settings",
        'capability' => 'manage_options',
        'route'      => [
          'get'  => 'Settings\SettingsController@index',
          'load' => 'Settings\SettingsController@load',
          'post' => 'Settings\SettingsController@saveSettings',
        ],
      ]
    ]
  ]
];
