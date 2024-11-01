<input id="tab-4"
       type="radio"
       name="tabs"
  <?php checked( $selected_tab, 'tab-4' ) ?>
       aria-hidden="true">
<label for="tab-4"
       tabindex="0"><?php _e( 'Messages' ) ?></label>

<div class="wpbones-tab">
  <form method="post"
        action="">
    <?php wp_nonce_field( 'wpx-maintenance-pro-settings' ); ?>
    <input type="hidden"
           name="selected_tab"
           value="tab-4"/>
    <table class="form-table">
      <tbody>

      <tr>
        <th scope="row">
          <label
              for="messages/enable_send_mail"><?php _e( 'Enable a send mail', WPXMAINTENANCEPRO_TEXTDOMAIN ) ?></label>
        </th>
        <td>
          <?php
          echo WPXMaintenanceProLight\PureCSSSwitch\Html\HtmlTagSwitchButton::name( 'messages/enable_send_mail' )
                                                                                ->id( 'messages/enable_send_mail' )
                                                                                ->checked( $plugin->options->get( 'messages/enable_send_mail' ) );
          ?>
        </td>
      </tr>

      <tr>
        <th scope="row">
          <label for="messages/email"><?php _e( 'EMail', WPXMAINTENANCEPRO_TEXTDOMAIN ) ?></label>
        </th>
        <td>
          <input type="email"
                 id="messages/email"
                 name="messages/email"
                 value="<?php echo $plugin->options->get( 'messages.email' ) ?>"/>
        </td>
      </tr>

      <tr>
        <th scope="row">
          <label
              for="messages/enable_message_login"><?php _e( 'Enable a warning message into the backend login form', WPXMAINTENANCEPRO_TEXTDOMAIN ) ?></label>
        </th>
        <td>
          <?php
          echo WPXMaintenanceProLight\PureCSSSwitch\Html\HtmlTagSwitchButton::name( 'messages/enable_message_login' )
                                                                                ->id( 'messages/enable_message_login' )
                                                                                ->checked( $plugin->options->get( 'messages/enable_message_login' ) );
          ?>
        </td>
      </tr>

      <tr>
        <th scope="row">
          <label for="messages/message_login"><?php _e( 'Message', WPXMAINTENANCEPRO_TEXTDOMAIN ) ?></label>
        </th>
        <td>
        <textarea id="messages/message_login"
                  name="messages/message_login"><?php echo $plugin->options->get( 'messages.message_login' ) ?></textarea>
        </td>
      </tr>

      <tr>
        <th scope="row">
          <label
              for="messages/enable_message_admin"><?php _e( 'Enable a warning message into the backend', WPXMAINTENANCEPRO_TEXTDOMAIN ) ?></label>
        </th>
        <td>
          <?php
          echo WPXMaintenanceProLight\PureCSSSwitch\Html\HtmlTagSwitchButton::name( 'messages/enable_message_admin' )
                                                                                ->id( 'messages/enable_message_admin' )
                                                                                ->checked( $plugin->options->get( 'messages/enable_message_admin' ) );

          ?>
        </td>
      </tr>

      <tr>
        <th scope="row">
          <label for="messages/message_admin"><?php _e( 'Message', WPXMAINTENANCEPRO_TEXTDOMAIN ) ?></label>
        </th>
        <td>
        <textarea id="messages/message_admin"
                  name="messages/message_admin"><?php echo $plugin->options->get( 'messages.message_admin' ) ?></textarea>
        </td>
      </tr>

      <tr>
        <th scope="row">
          <label
              for="messages/enable_message_footer"><?php _e( 'Enable a warning message into the frontend footer', WPXMAINTENANCEPRO_TEXTDOMAIN ) ?></label>
        </th>
        <td>
          <?php
          echo WPXMaintenanceProLight\PureCSSSwitch\Html\HtmlTagSwitchButton::name( 'messages/enable_message_footer' )
                                                                                ->id( 'messages/enable_message_footer' )
                                                                                ->checked( $plugin->options->get( 'messages/enable_message_footer' ) );
          ?>
        </td>
      </tr>

      <tr>
        <th scope="row">
          <label for="messages/message_footer">
            <?php _e( 'Message', WPXMAINTENANCEPRO_TEXTDOMAIN ) ?>
          </label>
        </th>
        <td>
        <textarea id="messages/message_footer"
                  name="messages/message_footer"><?php echo $plugin->options->get( 'messages.message_footer' ) ?></textarea>
        </td>
      </tr>

      </tbody>
    </table>

    <p class="submit clearfix">
      <button name="reset-to-default"
              data-confirm="<?php _e( 'Warning! Are you sure to reset all setting to default values?', WPXMAINTENANCEPRO_TEXTDOMAIN ) ?>"
              class="button button-secondary"><?php _e( 'Reset to default', WPXMAINTENANCEPRO_TEXTDOMAIN ) ?></button>
      <button class="button button-primary"><?php _e( 'Save changes', WPXMAINTENANCEPRO_TEXTDOMAIN ) ?></button>
    </p>

  </form>
</div>