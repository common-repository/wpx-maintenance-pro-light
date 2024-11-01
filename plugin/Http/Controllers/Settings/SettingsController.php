<?php

namespace WPXMaintenanceProLight\Http\Controllers\Settings;

use WPXMaintenanceProLight\Http\Controllers\Controller;
use WPXMaintenanceProLight\PureCSSTabs\PureCSSTabsProvider;
use WPXMaintenanceProLight\PureCSSSwitch\PureCSSSwitchProvider;

class SettingsController extends Controller
{

  static $feedback = '';

  public function load()
  {
    $resetTodefault = $this->request->get( 'reset-to-default', null );

    if ( ! is_null( $resetTodefault ) ) {
      WPXMaintenanceProLight()->options->reset();
      self::$feedback = __( 'Settings Reset to default successfully!', WPXMAINTENANCEPRO_TEXTDOMAIN );
    }
    else {
      // Used to trigger a change
      $currentState = (bool) WPXMaintenanceProLight()->options->get( 'scheduling.enable' );

      WPXMaintenanceProLight()
        ->options
        ->update( $this->request->getAsOptions() );

      WPXMaintenanceProLight()
        ->options
        ->set( 'rules.ip_address', $this->request->get( 'rules.ip_address', null ) );

      WPXMaintenanceProLight()
        ->options
        ->set( 'rules.user_roles', $this->request->get( 'rules.user_roles', null ) );

      WPXMaintenanceProLight()
        ->options
        ->set( 'rules.users_id', $this->request->get( 'rules.users_id', null ) );

      $newState = (bool) $this->request->get( 'scheduling.enable' );

      if ( $newState != $currentState ) {

        /**
         * Fires when the maintenance status is changed.
         *
         * @param bool $status Current maintenance status.
         */
        //do_action( 'wpxmp_status_changed', $newState );
      }

      self::$feedback = __( 'Settings updated successfully!', WPXMAINTENANCEPRO_TEXTDOMAIN );
    }

    /**
     * Fires when the options has been saved.
     */
    do_action( 'wpxmp_options_saved' );

  }

  public function index()
  {
    PureCSSTabsProvider::enqueueStyles();
    PureCSSSwitchProvider::enqueueStyles();

    return WPXMaintenanceProLight()
      ->view( 'settings.index' )
      ->with( 'selected_tab', 'tab-1' )
      ->withStyles( 'wpxmp-settings' )
      ->withAdminScripts( 'wpxmp-settings' );
  }

  public function saveSettings()
  {
    PureCSSTabsProvider::enqueueStyles();
    PureCSSSwitchProvider::enqueueStyles();

    return WPXMaintenanceProLight()
      ->view( 'settings.index' )
      ->with( 'feedback', self::$feedback )
      ->with( 'selected_tab', $_POST[ 'selected_tab' ] )
      ->withStyles( 'wpxmp-settings' )
      ->withAdminScripts( 'wpxmp-settings' );
  }
}