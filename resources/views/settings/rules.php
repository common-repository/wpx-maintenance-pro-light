<input id="tab-3"
       type="radio"
       name="tabs"
  <?php checked( $selected_tab, 'tab-3' ) ?>
       aria-hidden="true">
<label for="tab-3"
       tabindex="0"><?php _e( 'Rules' ) ?></label>

<div class="wpbones-tab">

  <form method="post"
        action="">
    <?php wp_nonce_field( 'wpx-maintenance-pro-settings' ); ?>
    <input type="hidden"
           name="selected_tab"
           value="tab-3"/>

    <table class="form-table">
      <tbody>

      <tr>
        <th scope="row">
          <label for="rules/disable_wp_login"><?php _e( 'Disable WP Login', WPXMAINTENANCEPRO_TEXTDOMAIN ) ?></label>
        </th>
        <td>
          <?php
          echo WPXMaintenanceProLight\PureCSSSwitch\Html\HtmlTagSwitchButton::name( 'rules/disable_wp_login' )
                                                                                      ->id( 'rules/disable_wp_login' )
                                                                                      ->checked( $plugin->options->get( 'rules/disable_wp_login' ) );
          ?>
          <small>
            <?php _e( 'You can disable standard backend login and manage any IP address you want to enable for. Be careful using this option, and be sure you have an ftp access.', WPXMAINTENANCEPRO_TEXTDOMAIN ) ?>
          </small>
        </td>
      </tr>

      <tr>
        <th scope="row">
          <label for="ip_address"><?php _e( 'Allowed IP Address', WPXMAINTENANCEPRO_TEXTDOMAIN ) ?></label>
        </th>
        <td>
          <div>
            <input type="text"
                   id="ip_address"
                   value="<?php echo $_SERVER[ 'REMOTE_ADDR' ] ?>"
                   title="<?php _e( 'Enter an IP addrees like 193.34.32.21 and click to the right button. For your convenience it\'s already added your IP address.', WPXMAINTENANCEPRO_TEXTDOMAIN ) ?>"/>
            <button data-source="ip_address"
                    data-target="rules/ip_address"
                    class="button button-primary button-small wpxmp-button-add"><?php _e( 'Add' ) ?></button>
          </div>

          <select name="rules/ip_address[]"
                  id="rules/ip_address"
                  multiple>
            <?php
            $items = $plugin->options->get( 'rules.ip_address', [] );

            foreach ( $items as $value ) {
              printf( '<option value="%s">%s</option>', $value, $value );
            }
            ?>
          </select>
          <button data-target="rules/ip_address"
                  class="button button-primary button-small wpxmp-button-remove"><?php _e( 'Remove' ) ?></button>
        </td>
      </tr>

      <tr>
        <th scope="row">
          <label for="user_roles"><?php _e( 'Allowed User Roles', WPXMAINTENANCEPRO_TEXTDOMAIN ) ?></label>
        </th>
        <td>
          <div>
            <select name="user_roles"
                    id="user_roles">
              <?php
              $roles = new WP_Roles();

              foreach ( $roles->role_names as $key => $value ) {
                printf( '<option value="%s">%s</option>', $key, $value );
              }
              ?>
            </select>
            <button data-source="user_roles"
                    data-target="rules/user_roles"
                    class="button button-primary button-small wpxmp-button-add"><?php _e( 'Add' ) ?></button>
          </div>

          <select name="rules/user_roles[]"
                  id="rules/user_roles  "
                  multiple>
            <?php
            $items = $plugin->options->get( 'rules.user_roles', [] );

            foreach ( $items as $key ) {
              if ( in_array( $key, array_keys( $roles->role_names ) ) ) {
                printf( '<option value="%s">%s</option>', $key, $roles->role_names[ $key ] );
              }
            }
            ?>
          </select>
          <button data-target="rules/user_roles"
                  class="button button-primary button-small wpxmp-button-remove"><?php _e( 'Remove' ) ?></button>
        </td>
      </tr>

      <tr>
        <th scope="row">
          <label for="users_id"><?php _e( 'Allowed Users', WPXMAINTENANCEPRO_TEXTDOMAIN ) ?></label>
        </th>
        <td>
          <div>
            <select name="users_id"
                    id="users_id">
              <?php
              $usersQuery = new WP_User_Query( [ 'orderby' => 'ID' ] );

              foreach ( $usersQuery->results as $user ) {
                printf( '<option value="%s">%s</option>', $user->ID, $user->display_name );
              }
              ?>
            </select>
            <button
                data-source="users_id"
                data-target="rules/users_id"
                class="button button-primary button-small wpxmp-button-add"><?php _e( 'Add' ) ?></button>
          </div>

          <select name="rules/users_id[]"
                  id="rules/users_id"
                  multiple>
            <?php
            $items = $plugin->options->get( 'rules.users_id', [] );

            if ( ! empty( $items ) ) {
              $usersQuery = new WP_User_Query( [ 'include' => $items ] );

              foreach ( $usersQuery->results as $user ) {
                printf( '<option value="%s">%s</option>', $user->ID, $user->display_name );
              }
            }
            ?>
          </select>
          <button data-target="rules/users_id"
                  class="button button-primary button-small wpxmp-button-remove"><?php _e( 'Remove' ) ?></button>
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