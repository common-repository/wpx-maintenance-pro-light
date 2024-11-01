<input id="tab-1"
       type="radio"
       name="tabs"
  <?php checked( $selected_tab, 'tab-1' ) ?>
       aria-hidden="true"/>
<label for="tab-1"
       tabindex="0"><?php _e( 'Scheduling' ) ?></label>

<div class="wpbones-tab">
  <form method="post"
        action="">
    <?php wp_nonce_field( 'wpx-maintenance-pro-settings' ); ?>
    <input type="hidden"
           name="selected_tab"
           value="tab-1"/>

    <table class="form-table">
      <tbody>

      <tr>
        <th scope="row">
          <label for="scheduling/enable"><?php _e( 'Enable Now', WPXMAINTENANCEPRO_TEXTDOMAIN ) ?></label>
        </th>
        <td>
          <?php
          echo WPXMaintenanceProLight\PureCSSSwitch\Html\HtmlTagSwitchButton::name( 'scheduling/enable' )
                                                                            ->id( 'scheduling/enable' )
                                                                            ->checked( $plugin->options->get( 'scheduling/enable' ) );
          ?>
          <small>
            <?php _e( 'If you enable this option the starting and ending dates below will be ignored.', WPXMAINTENANCEPRO_TEXTDOMAIN ) ?>
          </small>
        </td>
      </tr>

      <tr>
        <th scope="row">
          <label for="scheduling/date_start"><?php _e( 'Starting date', WPXMAINTENANCEPRO_TEXTDOMAIN ) ?></label>
        </th>
        <td>
          <?php echo WPXMaintenanceProLight\Html::datetime()->value( $plugin->options->get( 'scheduling.date_start' ) )->name( 'scheduling/date_start' )->complete( true ) ?>
        </td>
      </tr>

      <tr>
        <th scope="row">
          <label for="scheduling/date_expire"><?php _e( 'Ending date', WPXMAINTENANCEPRO_TEXTDOMAIN ) ?></label>
        </th>
        <td>
          <?php echo WPXMaintenanceProLight\Html::datetime()->value( $plugin->options->get( 'scheduling.date_expire' ) )->name( 'scheduling/date_expire' )->complete( true ) ?>
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