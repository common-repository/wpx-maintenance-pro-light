<?php

namespace WPXMaintenanceProLight\Providers;

use WPXMaintenanceProLight\WPBones\Support\ServiceProvider;

class WPXMaintenanceProManagerServiceProvider extends ServiceProvider
{

  protected $plugin;

  public function register()
  {
    $this->plugin = WPXMaintenanceProLight();

    // Fires when the maintenance status is changed.
    add_action( 'wpxmp_status_changed', [ $this, 'wpxmp_status_changed' ] );

    add_action( 'wpxmp_options_saved', [ $this, 'registerReminders' ] );

    // Set the headers to prevent caching for the different browsers.
    nocache_headers();

    $rules = (object) $this->plugin->options->get( 'rules' );

    // default
    $bypass = false;

    // Check if this IP Address is in the exclude ip addresses list
    if ( isset( $rules->ip_address ) && ! empty( $rules->ip_address ) ) {
      $bypass = in_array( $_SERVER[ 'REMOTE_ADDR' ], $rules->ip_address );
    }

    /**
     * Filter the custom bypass.
     *
     * @param bool $bypass Set to TRUE to bypass the maintenance.
     */
    $bypass = apply_filters( 'wpxmp_bypass', $bypass );

    if ( $bypass ) {
      return;
    }

    if ( $this->isMaintenance() ) {

      // Fires in the login page header after scripts are enqueued.
      add_action( 'login_head', [ $this, 'login_head' ], 1 );

      // get current user
      $currentUser = new \WP_User();

      $userRoles = $this->plugin->options->get( 'rules.user_roles', [ ] );
      $userIds   = $this->plugin->options->get( 'rules.users_id', [ ] );

      if ( ! is_admin() &&
           ! in_array( $GLOBALS[ 'pagenow' ], [ 'wp-login.php' ] ) &&
           ! $this->hasCurrentUserRoles( $userRoles ) &&
           ! in_array( $currentUser->ID, $userIds )
      ) {
        if ( ! is_admin() ) {

          // Fires before determining which template to load.
          add_action( 'template_redirect', [ $this, 'display503' ] );
        }
        else {
          $this->display503();
        }
      }
      else {
        //$this->registerReminders();
      }
    }
  }

  /**
   * Fires when the maintenance status is changed.
   *
   * @since 1.2.0
   *
   * @param bool $status Current maintenance status.
   */
  public function wpxmp_status_changed( $status )
  {

    $email = $this->plugin->options->get( 'messages.email' );

    // Check if preferences send mail is enabled
    if ( (bool) $this->plugin->options->get( 'messages.enable_send_mail' ) && ! empty( $email ) ) {

      // Prepare message
      $status = empty( $status ) ? __( 'Disabled' ) : __( 'Enabled' );

      // Message stack
      $message = [ ];

      // Date
      $message[] = sprintf( __( 'Date: %s' ), date_i18n( get_option( 'date_format' ), time() ) );

      if ( is_user_logged_in() ) {
        $user      = wp_get_current_user();
        $message[] = sprintf( __( 'Current user logged in: %s (%s)' ), $user->display_name, $user->user_email );
      }

      $message[] = sprintf( __( 'Maintenance Mode is %s' ), $status );
      $message[] = sprintf( __( 'On %s' ), get_bloginfo( 'url' ) );

      // Send mail
      $result = wp_mail( $email, sprintf( 'Maintenance Pro %s on %s', $status, get_bloginfo( 'url' ) ), implode( "\n\n", $message ) );
    }
  }

  /**
   * Register some filters and actions to display in backend and frontend an alter to remind that the maintenance mode
   * is enabled.
   */
  public function registerReminders()
  {
    if( $this->isMaintenance() ) {

      // Get messages preferences
      $messages = ( object ) $this->plugin->options->get( 'messages' );

      if ( (bool) $messages->enable_message_login ) {
        add_filter( 'login_message', [ $this, 'login_message' ] );
      }

      if ( (bool) $messages->enable_message_admin ) {
        add_action( 'admin_notices', [ $this, 'admin_notices' ] );
      }

      if ( (bool) $messages->enable_message_footer ) {
        add_action( 'wp_footer', [ $this, 'wp_footer' ] );
      }
    }
  }

  /**
   * Display a notice on top head in backend
   */
  public function admin_notices()
  {
    ?>
    <div class="error">
      <h3><?php _e( 'Maintenance', WPXMAINTENANCEPRO_TEXTDOMAIN ) ?></h3>
      <p><strong><?php echo $this->plugin->options->get( 'messages.message_admin' ) ?></strong></p>
    </div>
    <?php
  }

  /**
   * Fires in the login page header after scripts are enqueued.
   *
   * When the WordPess login head is loaded, we check if maintenance mode is enabled. If TRUE, then redirect to
   * head url. This method check for IP address bypass.
   *
   * @since WP 2.1.0
   */
  public function login_head()
  {
    // Get rules.
    $rules = (object) $this->plugin->options->get( 'rules' );

    if ( (bool) $rules->disable_wp_login ) {
      if ( ! in_array( $_SERVER[ 'REMOTE_ADDR' ], $rules->ip_address ) ) {
        wp_safe_redirect( '/' );
        exit();
      }
    }
  }

  /**
   * Display a notice on login form
   */
  public function login_message()
  {
    return sprintf( '<div id="login_error"><p>%s</p></div>', $this->plugin->options->get( 'messages.message_login' ) );
  }

  /**
   * Display a notice on bottom fotter in frontned
   */
  public function wp_footer()
  {
    ?>
    <div style="position:fixed;bottom:0;width:100%;height:40px;background:red;z-index:9999">
      <p style="text-align:center; color:white; line-height:40px; font-size:18px;">
        <?php echo $this->plugin->options->get( 'messages.message_footer' ) ?>
        <a href="<?php echo admin_url() ?>"
           style="color:white; text-decoration:underline;"><?php _e( 'Go to WP Admin', WPXMAINTENANCEPRO_TEXTDOMAIN ) ?></a>
      </p>
    </div>
    <?php
  }

  public function display503()
  {
    /**
     * Fires when display the maintenance page.
     */
    do_action( 'wpxmp_display_503' );

    /**
     * Filter the list of available template.
     */
    $template = apply_filters( 'wpxmp_template_type', $this->plugin->options->get( 'template.template' ) );

    switch ( $template ) {

      // Standard WordPress maintenance
      case 'wp_die':
        wp_die( $this->plugin->options->get( 'template.note' ), $this->plugin->options->get( 'template.title' ) );
        break;

      // Custom 503 page.
      case 'theme-503':
        $path_to_load = sprintf( '%s%s', trailingslashit( TEMPLATEPATH ), '503.php' );
        include( $path_to_load );
        break;

      default:

        /**
         * Fires when a custom template type is selected.
         *
         * The dynamic portion of the hook name, $template, refers to the custom template type.
         */
        do_action( 'wpxmp_load_template-' . $template->template );

        break;
    }
    exit();
  }

  /**
   * Return TRUE if the maintenance mode is enabled from backend or can be enabled for date range.
   *
   * @return bool
   */
  protected function isMaintenance()
  {
    // Get scheduling preferences
    $scheduling = (object) $this->plugin->options->get( 'scheduling' );

    // Used to trigger a change
    $currentState = (bool) $scheduling->enable;

    $newState = $currentState;

    // If the date range is set then update the configuration too
    if ( ! empty( $scheduling->date_start ) || ! empty( $scheduling->date_expire ) ) {

      // Date range override manual enabling
      $newState = $this->isTimeInRange( $scheduling->date_start, $scheduling->date_expire );

      if( $currentState != $newState ) {
        $this->plugin->options->set( 'scheduling.enable', $newState );

        if( ! $newState ) {
          $this->plugin->options->set( 'scheduling.date_start', '' );
          $this->plugin->options->set( 'scheduling.date_expire', '' );
        }
      }
    }

    if ( $currentState != $newState ) {
      /**
       * Fires when the maintenance status is changed.
       *
       * @param bool $status Current maintenance status.
       */
      do_action( 'wpxmp_status_changed', $newState );
    }

    return $newState;
  }

  /**
   * Return TRUE if now `time()` is between `$start` and `$expry`.
   *
   * @param int $start  Start date.
   * @param int $expiry Expiry date.
   *
   * @return bool
   */
  protected function isTimeInRange( $start, $expiry )
  {
    // Check empty
    if ( empty( $start ) && empty( $expiry ) ) {
      return false;
    }

    // Get now
    $now = time();

    // Default
    $start  = empty( $start ) ? $now : strtotime( $start );
    $expiry = empty( $expiry ) ? $now : strtotime( $expiry );

    // Stability
    if ( ! is_numeric( $start ) || ! is_numeric( $expiry ) ) {
      return false;
    }

    // Wrong range
    if ( $start > $expiry ) {
      return false;
    }

    return ( $start <= $now && $expiry >= $now );

  }

  protected function hasCurrentUserRoles( $roles )
  {
    global $wp_roles;

    if ( ! isset( $wp_roles ) ) {
      $wp_roles = new \WP_Roles();
    }

    // get current user
    $currentUser = new \WP_User();

    foreach ( (array) $roles as $role ) {
      if ( in_array( $role, $currentUser->roles ) ) {
        return true;
      }
    }

    return false;
  }

}