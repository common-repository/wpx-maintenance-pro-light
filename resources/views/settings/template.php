<input id="tab-2"
       type="radio"
       name="tabs"
  <?php checked( $selected_tab, 'tab-2' ) ?>
       aria-hidden="true"/>
<label for="tab-2"
       tabindex="0"><?php _e( 'Template' ) ?></label>

<div class="wpbones-tab">

  <form method="post"
        action="">
    <?php wp_nonce_field( 'wpx-maintenance-pro-settings' ); ?>
    <input type="hidden"
           name="selected_tab"
           value="tab-2"/>

    <table class="form-table">
      <tbody>

      <tr>
        <th scope="row">
          <label for="template/template"><?php _e( 'Template', WPXMAINTENANCEPRO_TEXTDOMAIN ) ?></label>
        </th>
        <td>
          <select name="template/template"
                  id="template/template">
            <option <?php selected( 'wp_die', $plugin->options->get( 'template.template' ) ) ?>
                value="wp_die"><?php _e( 'Standard WordPress wp_die', WPXMAINTENANCEPRO_TEXTDOMAIN ) ?></option>
            <option <?php selected( 'theme-503', $plugin->options->get( 'template.template' ) ) ?>
                value="theme-503"><?php _e( '503.php in the current theme', WPXMAINTENANCEPRO_TEXTDOMAIN ) ?></option>
          </select>
          <br/>
          <small>
            <?php _e( 'Choose the design to be used for your Maintenance Mode screen.', WPXMAINTENANCEPRO_TEXTDOMAIN ) ?>
          </small>
        </td>
      </tr>

      <tr>
        <th scope="row">
          <label for="template/page_title"><?php _e( 'Page title', WPXMAINTENANCEPRO_TEXTDOMAIN ) ?></label>
        </th>
        <td>
          <input type="text"
                 id="template/page_title"
                 name="template/page_title"
                 value="<?php echo $plugin->options->get( 'template.page_title' ) ?>"/>
          <br/>
          <small>
            <?php _e( 'This is the page title for the Maintenance Mode page.', WPXMAINTENANCEPRO_TEXTDOMAIN ) ?>
          </small>
        </td>
      </tr>

      <tr>
        <th scope="row">
          <label for="template/title"><?php _e( 'Title', WPXMAINTENANCEPRO_TEXTDOMAIN ) ?></label>
        </th>
        <td>
          <input type="text"
                 id="template/title"
                 name="template/title"
                 value="<?php echo $plugin->options->get( 'template.title' ) ?>"/>
          <br/>
          <small>
            <?php _e( 'This is the HTML title of the Maintenance Mode page.', WPXMAINTENANCEPRO_TEXTDOMAIN ) ?>
          </small>
        </td>
      </tr>

      <tr>
        <th scope="row">
          <label for="template/note"><?php _e( 'Note', WPXMAINTENANCEPRO_TEXTDOMAIN ) ?></label>
        </th>
        <td>
          <textarea id="template/note"
                    name="template/note"><?php echo $plugin->options->get( 'template.note' ) ?></textarea>
          <br/>
          <small>
            <?php _e( 'A brief note that will be included in the Maintenance Mode page.', WPXMAINTENANCEPRO_TEXTDOMAIN ) ?>
          </small>
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