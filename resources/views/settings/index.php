<!--
 |
 | In $plugin you'll find an instance of Plugin class.
 | If you'd like can pass variable to this view, for example:
 |
 | return PluginClassName()->view( 'dashboard.index', [ 'var' => 'value' ] );
 |
-->

<div class="wpxmp-settings wrap">
  <h2><?php _e( 'Maintenance Pro', WPXMAINTENANCEPRO_TEXTDOMAIN ) ?></h2>

  <?php if ( isset( $feedback ) ) : ?>
    <div class="notice notice-success is-dismissible">
      <p>
        <?php echo $feedback ?>
      </p>
    </div>
  <?php endif; ?>

    <div class="wpbones-tabs">
      <?php echo WPXMaintenanceProLight()->view( 'settings.scheduling' )->with( 'selected_tab', $selected_tab ) ?>
      <?php echo WPXMaintenanceProLight()->view( 'settings.template' )->with( 'selected_tab', $selected_tab ) ?>
      <?php echo WPXMaintenanceProLight()->view( 'settings.rules' )->with( 'selected_tab', $selected_tab ) ?>
      <?php echo WPXMaintenanceProLight()->view( 'settings.messages' )->with( 'selected_tab', $selected_tab ) ?>
    </div>

</div>